<?php

namespace App\State\Order;

use Spatie\ModelStates\Transition;
use App\State\Order\Completed;
use App\Order;
use App\Jobs\ReportOrder;

class ToCompleted extends Transition
{
    /** @var Order */
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle()
    {
        $this->order->state = new Completed($this->order);
        $this->order->save();

        ReportOrder::dispatch($this->order);

        return $this->order;
    }
}
