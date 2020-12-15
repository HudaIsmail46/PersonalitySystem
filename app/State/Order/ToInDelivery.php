<?php

namespace App\State\Order;

use Spatie\ModelStates\Transition;
use App\State\Order\InDelivery;
use App\Order;

class ToInDelivery extends Transition
{
    /** @var Order */
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle()
    {
        $this->order->state = new InDelivery($this->order);
        $this->order->leave_warehouse_at = now();

        $this->order->save();

        return $this->order;
    }
}
