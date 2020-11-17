<?php

use Carbon\Carbon;

if(!function_exists('myLongDateTime')){
    function myLongDateTime(Carbon $dateTime){
        return $dateTime->format('D, dS M Y, H:i:s');
    }
}

if(!function_exists('humaniseOrderState')){
    function humaniseOrderState(String $state){
        return str_replace("App\State\Order\\", '', $state);
    }
}

if(!function_exists('orderAddress')){
    function orderAddress(App\Order $order){
        if(!is_null($order->address_1) || !is_null($order->address_2) || !is_null($order->postcode) || !is_null($order->city) || !is_null($order->location_state)){
            $address = $order->address_1 . ", <br/>" . $order->address_2 . ", <br/>" . $order->postcode . ", <br/>" . $order->city . ", <br/>" . $order->location_state;
        } else {
            $address = '-';
        }

        return $address;
    }
}
