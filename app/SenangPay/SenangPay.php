<?php

namespace App\SenangPay;

class SenangPay {

    public $merchantId;
    public $secretKey;

    protected $detail;
    protected $amount;
    protected $orderId;
    protected $name;
    protected $email;
    protected $phone;

    /**-------------------------------------------------------------------------------------------------------------------/    
     *    @description    function description
     */
    public function __construct( $name, $email, $phone_number, $detail, $orderId, $amount)
    {
        $this->merchantId = env('SENANG_PAY_MERCHANT_ID');
        $this->secretKey = env('SENANG_PAY_SECRET');
        $this->detail = $detail;
        $this->amount = $amount;
        $this->orderId = $orderId;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone_number;
    }

    /*--------------------------------------------------------------------------------------------------------------------/	
    *
    *	@description  This will generate hash
    */
    public function generateHash()
    {
        return hash_hmac('sha256', $this->secretKey.$this->detail.$this->amount.$this->orderId, $this->secretKey);
    }

    /*--------------------------------------------------------------------------------------------------------------------/	
    *
    *	@description	This will generate the HTTP query
    */
    public function generateHttpQuery()
    {
        $httpQuery = http_build_query([
            'detail' => $this->detail,
            'amount' => $this->amount,
            'hash' => $this->generateHash(),
            'order_id' => $this->orderId,
            'phone'=> $this->phone,
            'email' => $this->email,
            'name' => $this->name
        ]);

        return $httpQuery;
    }

    /*--------------------------------------------------------------------------------------------------------------------/	
    *    @description  This will send details of payment to SenangPay
    *    @return 
    */
    public function processPayment()
    {
        $url = env('SENANGPAY_PRODUCTION') ? 'https://app.senangpay.my/payment/' : 'https://sandbox.senangpay.my/payment/';
        
        return $url.$this->merchantId.'?'.$this->generateHttpQuery();
    }


    /*--------------------------------------------------------------------------------------------------------------------/	
    *
    *	@description  This will generate the return Hash to match with incoming transaction
    *	@param        $request  "request object from controller"
    */
    protected static function generateReturnHash( $request )
    {
        $secretKey = env('SENANG_PAY_SECRET');
        $str = $secretKey.$request->status_id.$request->order_id.$request->transaction_id.$request->msg;
        $returnHash = hash_hmac('sha256', $str, $secretKey);
        return $returnHash;
    }

    /*--------------------------------------------------------------------------------------------------------------------/	
    *
    *	@description  This will check if the parametered hash is correct and not mess by MITM (Men In The Middle)
    *	@param        $request  "request object from controller"
    */
    public static function checkIfReturnHashCorrect( $request )
    {
        $parameterHash = $request->hash;
        if(static::generateReturnHash( $request) == $parameterHash )
        {
            return true;
        } else {
            return false;
        }
    }

}