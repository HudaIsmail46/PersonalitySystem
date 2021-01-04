<?php

namespace App\Webhooks\Woocommerce;

use App\Order;
use App\OrderItem;
use App\Customer;
use Carbon\Carbon;
use App\State\Order\Draft;

class WebhookHandler
{
    public static function handle($data)
    {
        $data = json_decode($data, true);
        $payload = $data["payload"];
        
        if (array_key_exists('billing', $payload)) {
            $billing = $payload["billing"];
            $item = $payload["line_items"][0]; //for now we only process pnd, the cart is not mixed with other item
            if ($item['product_id'] == env('PRODUCT_ID', '')) { //hardcoded for now, this is referring for pnd product only
                $customer = Customer::findOrCreate($billing["first_name"] . " " . $billing['last_name'], formatPhoneNo($billing["phone"]));
            
                $customer->update([
                    $customer->address_1 = $billing["address_1"],
                    $customer->address_2 = $billing["address_2"],
                    $customer->postcode =  $billing["postcode"],
                    $customer->city = $billing["city"],
                    $customer->location_state = $billing["state"]
                ]);

                $order = new Order;

                $order->fill([
                    'woocommerce_order_id' => $payload["id"],
                    'quantity' => 0,
                    'deposit_amount' => priceCents(static::valueByKey('_wc_deposits_deposit_amount', $payload["meta_data"])),
                    'price' => 0,
                    'prefered_pickup_datetime' => static::preferedDateTime($payload["meta_data"]),
                    'address_1' => $billing["address_1"],
                    'address_2' => $billing["address_2"],
                    'postcode' => $billing["postcode"],
                    'city' => $billing["city"] ,
                    'location_state' => $billing["state"],
                    'customer_id' => $customer->id,
                    'raw_payload' => json_encode($payload),
                    'state' => Draft::class
                ]);

                $order->save();
                
                for ($i = 0; $i < count($payload["line_items"]) ; $i++) {
                    
                    $order_item = new OrderItem;
        
                    $items = $payload["line_items"][$i];

                    $order_item->fill([
                        'order_id' => $order->id,
                        'quantity' => $items["quantity"],
                        'material' => strtolower(static::valueByKey('carpet-material', $items['meta_data'])),
                        'size' =>  static::getOrdersize($items['meta_data']),
                        'price' => priceCents($items["total"]),
                    ]);
                    
                    $order_item->save();
                }
                
                $total_quantity = $order_item->where('order_id', $order->id)->sum('quantity');
                $total_price = $order_item->where('order_id', $order->id)->sum('price');

                $order->update(['quantity' => $total_quantity, 'price' => $total_price]);
            }
        }
        
        http_response_code(200);
    }

    public static function getOrderSize($data)
    {
        $size = strtolower(static::valueByKey('carpet-size', $data));
        if (preg_match('/Large/i', $size)){
            return 'l';
        } elseif (preg_match('/Medium/i', $size)){
            return 'm';
        } elseif (preg_match('/Small/i', $size)){
            return 's';
        } else {
            return 'xs';
        }
    }

    public static function preferedDateTime($data)
    {
        $date = static::valueByKey("pickup_date", $data);
        $timeRange = static::valueByKey("pickup_time", $data);
        if ($date && $timeRange) {
            $time = [];
            preg_match('/(\d{2}:\d{2})/', $timeRange, $time);
            return $dateTime = Carbon::createFromFormat("yy-m-d H:i", $date." ".$time[0]);
        } else {
            return Carbon::tomorrow();
        }
        

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
