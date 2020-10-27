<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Customer;

class ExtractEventDetails
{
    public $namePattern = "/(name|nama)\s*:\s*([a-z\s()&.:]+)\n/";
    public $phonePattern = "/hp[1|2]:\+?(6?\d{3}-?[0-9]{7,})/";
    public $totalPattern = "/grandtotal:rm([0-9,.]*)/";
    public $depositPattern = "/depo:rm([0-9,.]*)/";
    public $discountPattern = "/discount:([0-9]*)%?/";
    // public $items //to be added later
    
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ImportedEventUpdated  $event
     * @return void
     */
    public function handle($event)
    {
        $bookingDescription = $event->booking->gc_description;
        if (!is_null($bookingDescription)) {
            $name = $this->getCustomerName($bookingDescription);
            $phone_no = $this->getPhoneNumber($bookingDescription);
            $customer = Customer::firstOrCreate($name, $phone_no);
            $event->booking->fill([
                'name'=> $name,
                'phone_no'=> $phone_no,
                'gc_price'=> $this->getGrandTotal($bookingDescription),
                'deposit'=> $this->getDeposit($bookingDescription),
                'discount'=> $this->getDiscount($bookingDescription),
                'customer_id'=> $customer ? $customer->id : null
            ]);
            $event->booking->save();
        }

        return true;
    }

    public function getCustomerName($bookingDescription)
    {       
        $output = [];
        $text = strtolower($bookingDescription);
        $match = preg_match($this->namePattern, $text, $output);

        return $match == 0 ? null : $output[2];
    }

    public function getPhoneNumber($bookingDescription)
    {
        $output = [];
        $text = strtolower(preg_replace("/\s+/", '',$bookingDescription));
        $match = preg_match($this->phonePattern, $text, $output);

        return $match == 0 ? null : preg_replace("/-/", '',$output[1]);
    }

    public function getGrandTotal($bookingDescription)
    {       
        $output = [];
        $text = strtolower(preg_replace("/\s+/", '',$bookingDescription));
        $match = preg_match($this->totalPattern, $text, $output);

        return $match == 0 ? null : $this->convertMoney($output[1]);
    }

    public function getDiscount($bookingDescription)
    {       
        $output = [];
        $text = strtolower(preg_replace("/\s+/", '',$bookingDescription));
        $match = preg_match($this->discountPattern, $text, $output);

        return $match == 0 ? null : $this->convertMoney($output[1]);
    }

    public function getDeposit($bookingDescription)
    {       
        $output = [];
        $text = strtolower(preg_replace("/\s+/", '',$bookingDescription));
        $match = preg_match($this->depositPattern, $text, $output);

        return $match == 0 ? null : $this->convertMoney($output[1]);
    }

    private function convertMoney(string $money)
    {
        $cleaned = preg_replace("/,/", '', $money);
        $moneyCents = (float)$cleaned *100;
        return (int)$moneyCents;
    }
}
