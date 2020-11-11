<?php

namespace App\Webhooks\Aafinance;
use App\Booking;
use App\Customer;
use App\BookingItem;
use Carbon\Carbon;

class AafinanceWebhook
{
    public static function dateFromFormat($datetime)
    {
        return Carbon::createFromFormat('Y-m-d\TH:i:s', $datetime);
    }

    public static function createOrUpdateCustomer($data)
    {
        $customer = null;
        $customerData = $data['Customer'];
        if($customerData){
            $phone_no =  $customerData['PhoneNumber'];
            $name = $customerData['Fullname'];
            $address = static::address($customerData);
            $email = $customerData['Email'];
            $nric = $customerData['Nric'];
            $gender = $customerData['Gender'];
            $customer = Customer::findOrCreate($name, $phone_no);
            if($customer){
                $customer->update([
                    'address' => $address,
                    'email' => $email,
                    'nric' => $nric,
                    'gender' => $gender
                ]);
            }
        }

        return $customer;
    }

    public static function address($data)
    {
        return $data['StreetAddress1'] . $data['StreetAddress2'] . $data['City']
            . $data['PostCode'] . $data['State'];
    }

    public static function createOrUpdateBookingItems(Booking $booking, $jobItems)
    {
        $jobItemIds = [];
        foreach($jobItems as $jobItem){
            $bookingItem = BookingItem::firstOrNew([
                'aafinance_reference' => $jobItem['JobItemId'],
                'booking_id' => $booking->id
            ]);
            $bookingItem->fill([
                'aafinance_webhook' => json_encode($jobItem),
                'quantity' => $jobItem['Quantity'],
                'price' => $jobItem['UnitPrice'] ? $jobItem['UnitPrice'] *100 : 0 ,
                'remark' => $jobItem['Remark'],
            ]);

            $bookingItem->save();
            array_push($jobItemIds, $bookingItem->id);
        }
        foreach ($booking->bookingItems as $bookingItem) {
            if(!in_array($bookingItem->id, $jobItemIds)){
                $bookingItem->delete();
            }
        }
    }
}

