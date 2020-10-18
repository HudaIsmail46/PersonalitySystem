<?php

use Carbon\Carbon;

if(!function_exists('myLongDateTime')){
    function myLongDateTime(Carbon $dateTime){
        return $dateTime->format('D, dS M Y, H:i:s');
    }
}
