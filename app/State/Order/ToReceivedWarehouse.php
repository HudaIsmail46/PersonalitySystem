<?php

namespace App\State\Order;

use Spatie\ModelStates\Transition;
use App\State\Order\ReceivedWarehouse;
use App\Order;

class ToReceivedWarehouse extends Transition
{
    /** @var Order */
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle()
    {
        $this->order->state = new ReceivedWarehouse($this->order);
        $this->order->arrived_warehouse_at = now();

        $this->order->save();

        return $this->order;
    }
}
