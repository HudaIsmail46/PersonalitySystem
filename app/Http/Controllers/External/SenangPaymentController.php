<?php

namespace App\Http\Controllers\External;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\SenangPay\SenangPay;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SenangPaymentController extends Controller
{
    public function pay(Order $order)
    {
        $senangPay = new SenangPay(
            $order->customer->name,
            $order->customer->email,
            $order->customer->phone_no,
            'Cleanhero_Carpet_Cleaning_#'.$order->id,
            'pnd#'.$order->id,
            $order->balance_to_pay() / 100
        );

        return redirect()->away($senangPay->processPayment());
    }

    public function senangReturn(Request $request)
    {
        if (SenangPay::checkIfReturnHashCorrect($request)) {
            if (preg_match('/pnd#\d+/', $request->order_id)) {
                $id = str_replace('pnd#', '', $request->order_id);
                $order = Order::find($id);
                $encId = Crypt::encryptString($id);
                if( $request->status_id == 1 )
                {
                    $order->fill([
                        'paid_at' => Carbon::now(),
                        'senang_transaction_id' => $request->transaction_id,
                        'payment_method' => "SenangPay"
                    ]);
                    $order->save();
                } else {
                    Log::error("order: " . $request->order_id . " " . $request->msg);
                }

                return redirect()->route('customer_order.show', $encId);
            } else {
                $wordpressUrl = env('WORDPRESS_CALLBACK');
                $query = \Request::getQueryString();
                return redirect()->away($wordpressUrl.'?'.$query);
            }   
        }
    }
}
