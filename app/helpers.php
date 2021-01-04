<?php

use Carbon\Carbon;

if (!function_exists('myLongDateTime')) {
    function myLongDateTime(Carbon $dateTime)
    {
        return $dateTime->format('D, dS M Y, H:i:s');
    }
}

if (!function_exists('myShortDateTime')) {
    function myShortDateTime(Carbon $dateTime)
    {
        return $dateTime->format('d/m/Y, H:i');
    }
}

if (!function_exists('myTime')) {
    function myTime(Carbon $dateTime)
    {
        return $dateTime->format('H:i:s');
    }
}

if (!function_exists('myDate')) {
    function myDate(Carbon $dateTime)
    {
        return $dateTime->format('D, dS M Y');
    }
}

if (!function_exists('humaniseOrderState')) {
    function humaniseOrderState(String $state)
    {
        $newVar = str_replace("App\State\Order\\", "", $state);
        return preg_replace('/([a-z])([A-Z])/s', '$1 $2', $newVar);
    }
}

if (!function_exists('orderAddress')) {
    function orderAddress(App\Order $order)
    {
        if (!is_null($order->address_1) || !is_null($order->address_2) || !is_null($order->address_3) || !is_null($order->postcode) || !is_null($order->city) || !is_null($order->location_state)) {
            $addressString = $order->address_1 . ","  . $order->address_2 . ","  . $order->address_3 . " "  . $order->postcode . ","  . $order->city . ", "  . $order->location_state  ;

            $cleanUpAddress = str_replace(",,", "",$addressString);
            if($cleanUpAddress !== null){
                $address = $cleanUpAddress . "<a href='http://maps.google.com/maps?q={$cleanUpAddress}' target='blank'> <i class='fas fa-map-marked-alt icon-blue'></i></a>";
            }

        } else {
            $address = '-';
        }

        return $address;
    }
}

if (!function_exists('bookingAddress')) {
    function bookingAddress(App\Booking $booking)
    {
        if (!is_null($booking->address_1) || !is_null($booking->address_2) || !is_null($booking->address_3) || !is_null($booking->postcode) || !is_null($booking->city) || !is_null($booking->location_state)) {
             $addressString = $booking->address_1 . "," . $booking->address_2 . ","  .  $booking->address_3 . " "  . $booking->postcode . ","  . $booking->city . ", "  . $booking->location_state;

            $cleanUpAddress = str_replace(",,", "",$addressString);
            if($cleanUpAddress !== null){
                $address = $cleanUpAddress . "<a href='http://maps.google.com/maps?q={$cleanUpAddress}' target='blank'> <i class='fas fa-map-marked-alt icon-blue'></i></a>";
            }

        } else {
            $address = '-';
        }

        return $address;
    }
}

if (!function_exists('customerAddress')) {
    function customerAddress(App\Customer $customer)
    {
        if (!is_null($customer->address_1) || !is_null($customer->address_2) || !is_null($customer->address_3) || !is_null($customer->postcode) || !is_null($customer->city) || !is_null($customer->location_state)) {
            $addressString = $customer->address_1 . "," . $customer->address_2 . "," . $customer->address_3 . " " . $customer->postcode . "," . $customer->city . ", " . $customer->location_state ;

            $cleanUpAddress = str_replace(",,", "",$addressString);
            if($cleanUpAddress !== null){
                $address = $cleanUpAddress . "<a href='http://maps.google.com/maps?q={$cleanUpAddress}' target='blank'> <i class='fas fa-map-marked-alt icon-blue'></i></a>";

            }
        } else {
            $address = '-';
        }

        return $address;
    }
}

if (!function_exists('formatPhoneNo')) {
    function formatPhoneNo(String $phone_no)
    {
        if (preg_match('/^6/', $phone_no) || preg_match('/[\[^\+\]]/', $phone_no)) {
            $phone_number = preg_replace('/\D+/', '', $phone_no);
        } else {
            $phone = preg_replace('/\D+/', '', $phone_no);
            $phone_number =  "6" . $phone;
        }
        return $phone_number;
    }
}

if (!function_exists('priceCents')) {
    function priceCents($price)
    {
        return $price ? $price * 100 : 0;
    }
}
