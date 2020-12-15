<?php

namespace App\State\Order;

use Spatie\ModelStates\Transition;
use App\State\Order\VendorCollected;
use App\Order;

class ToVendorCollected extends Transition
{
    /** @var Order */
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle()
    {
        $this->order->state = new VendorCollected($this->order);
        $this->order->vendor_collected_at = now();

        $this->order->save();

        return $this->order;
    }
}
