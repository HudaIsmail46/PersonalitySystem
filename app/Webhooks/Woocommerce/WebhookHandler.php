<?php

namespace App\Webhooks\Woocommerce;
use App\Order;
use App\Customer;
use Carbon\Carbon;
use App\State\Order\PendingPickupSchedule;

class WebhookHandler
{
    public static function handle($data)
    {
        $data = json_decode($data, true);
        $payload = $data["payload"];
        $billing = $payload["billing"];
        $item = $payload["line_items"][0];//for now we only process pnd, the cart is not mixed with other item
        if($item['product_id'] == "601294001492"){//hardcoded for now, this is referring for pnd product only
            $customer = Customer::findOrCreate($billing["first_name"]." ".$billing['last_name'], $billing["phone"]);

            $order = new Order;

            $order->fill([
                'quantity'=> $item["quantity"],
                'material' => strtolower(static::valueByKey('carpet-materials', $item['meta_data'])),
                'size' => strtolower(static::valueByKey('carpet-sizes', $item['meta_data'])),
                'price' => $item["total"]*100,
                'prefered_pickup_datetime' => static::preferedDateTime($payload["meta_data"]),
                'address_1' => $billing["address_1"],
                'address_2' => $billing["address_2"] ,
                'postcode' => $billing["postcode"] ,
                'city' => $billing["city"] ,
                'location_state' => $billing["state"],
                'customer_id' => $customer->id,
                'raw_payload' => json_encode($payload),
                'state' => PendingPickupSchedule::class
            ]);
            $order->save();
            logger($order);
        }


       http_response_code(200);
    }

    public static function preferedDateTime($data)
    {
        $date = static::valueByKey("pickup_date", $data);
        $timeRange = static::valueByKey("pickup_time", $data);
        $time = [];
        preg_match('/(\d{2}:\d{2})/', $timeRange, $time);
        $dateTime = Carbon::createFromFormat("yy-m-d H:i", $date." ".$time[0]);
        return $dateTime;
    }

    public static function valueByKey($key, $array)
    {
        foreach($array as $obj){
            if($obj["key"] == $key){
                return $obj["value"];
            }
        }
    }


}