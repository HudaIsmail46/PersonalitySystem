<?php

use Carbon\Carbon;

if (!function_exists('myLongDateTime')) {
    function myLongDateTime(Carbon $dateTime)
    {
        return $dateTime->format('D, dS M Y, H:i:s');
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
        if (!is_null($order->address_1) || !is_null($order->address_2) || !is_null($order->postcode) || !is_null($order->city) || !is_null($order->location_state)) {
            $address = $order->address_1 . ", <br/>" . $order->address_2 . ", <br/>" . $order->postcode . ", <br/>" . $order->city . ", <br/>" . $order->location_state;
        } else {
            $address = '-';
        }

        return $address;
    }
}

if (!function_exists('bookingAddress')) {
    function bookingAddress(App\Booking $booking)
    {
        if (!is_null($booking->address_1) || !is_null($booking->address_2) || !is_null($booking->postcode) || !is_null($booking->city) || !is_null($booking->location_state)) {
            $address = $booking->address_1 . ", <br/>" . $booking->address_2 . ", <br/>" . $booking->postcode . ", <br/>" . $booking->city . ", <br/>" . $booking->location_state;
        } else {
            $address = '-';
        }

        return $address;
    }
}
