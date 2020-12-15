<?php

namespace App\State\Order;

use Spatie\ModelStates\Transition;
use App\State\Order\Returned;
use App\Order;

class ToReturned extends Transition
{
    /** @var Order */
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle()
    {
        $this->order->state = new Returned($this->order);
        $this->order->returned_at = now();

        $this->order->save();

        return $this->order;
    }
}
