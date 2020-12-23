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
            $addressString = $order->address_1 . ", <br/>" . $order->address_2 . ", <br/>" . $order->address_3 . ", <br/>" . $order->postcode . ", <br/>" . $order->city . ", <br/>" . $order->location_state . "<br/>";
            if($addressString !== null){
                $address = $addressString . "<a href='https://www.google.com/maps/place/{$addressString}' target='blank'> <i class='fas fa-map-marked-alt icon-blue'></i></a>";
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
             $addressString = $booking->address_1 . ", <br/>" . $booking->address_2 . ", <br/>" . $booking->address_3 . ", <br/>" . $booking->postcode . ", <br/>" . $booking->city . ", <br/>" . $booking->location_state;
             if($addressString !== null){
                $address = $addressString . "<a href='https://www.google.com/maps/place/{$addressString}' target='blank'> <i class='fas fa-map-marked-alt icon-blue'></i></a>";
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
            $addressString = $customer->address_1 . ", <br/>" . $customer->address_2 . ", <br/>" . $customer->address_3 . ", <br/>" . $customer->postcode . ", <br/>" . $customer->city . ", <br/>" . $customer->location_state;
            if($addressString !== null){
                $address = $addressString . "<a href='https://www.google.com/maps/place/{$addressString}' target='blank'> <i class='fas fa-map-marked-alt icon-blue'></i></a>";
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