<?php

namespace App\State\Order;

use Spatie\ModelStates\Transition;
use App\State\Order\PendingReturnSchedule;
use App\Order;

class ToCleaningCompleted extends Transition
{
    /** @var Order */
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle()
    {
        $this->order->state = new PendingReturnSchedule($this->order);
        $this->order->vendor_returned_at = now();

        $this->order->save();

        return $this->order;
    }
}
