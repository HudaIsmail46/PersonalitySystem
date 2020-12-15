<?php

namespace App\State\Order;

use Spatie\ModelStates\Transition;
use App\State\Order\Collected;
use App\Order;

class ToCollected extends Transition
{
    /** @var Order */
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle()
    {
        $this->order->state = new Collected($this->order);
        $this->order->collected_at = now();

        $this->order->save();

        return $this->order;
    }
}
