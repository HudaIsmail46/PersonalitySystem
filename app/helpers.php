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

if (!function_exists('myShortDate')) {
    function myShortDate(Carbon $dateTime)
    {
        return $dateTime->format('dS M Y');
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

