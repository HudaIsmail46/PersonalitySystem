<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStates\HasStates;
use App\State\Order\OrderState;
use App\State\Order\Draft;
use App\State\Order\PendingPickupSchedule;
use App\State\Order\PendingReturnSchedule;
use App\State\Order\PickupScheduled;
use App\State\Order\ReturnScheduled;
use App\State\Order\InDelivery;
use App\State\Order\Collected;
use App\State\Order\Returned;
use App\State\Order\ReceivedWarehouse;
use App\State\Order\VendorCollected;
use App\State\Order\InHouseCleaning;
use App\State\Order\Completed;
use App\State\Order\Reprocessing;
use App\State\Order\ToCollected;
use App\State\Order\ToReceivedWarehouse;
use App\State\Order\ToVendorCollected;
use App\State\Order\ToCleaningCompleted;
use App\State\Order\ToReturned;
use App\State\Order\ToInDelivery;

class Order extends Model
{

    protected $fillable = [
        'size', 'material', 'price', 'prefered_pickup_datetime', 'actual_length',
        'actual_width', 'actual_material', 'actual_price', 'customer_id', 'state', 'quantity',
        'address_1', 'address_2', 'address_3', 'postcode', 'city', 'location_state', 'raw_payload',
        'payment_method', 'paid_at', 'woocommerce_order_id', 'deposit_paid_at', 'deposit_payment_method',
        'deposit_amount', 'collected_at', 'arrived_warehouse_at', 'vendor_collected_at',
        'vendor_returned_at', 'leave_warehouse_at', 'returned_at'
    ];

    use SoftDeletes;
    use HasStates;

    const SIZES = ['s', 'm', 'l'];
    const MATERIALS = ['wool', 'cotton', 'silk', 'synthetic'];
    const PAYMENTS = ['cash', 'bank transfer', 'fpx'];
    protected $dates = ['prefered_pickup_datetime','paid_at', 'deposit_paid_at',
        'collected_at', 'arrived_warehouse_at', 'vendor_collected_at', 'vendor_returned_at',
        'leave_warehouse_at', 'returned_at'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function runnerJobs()
    {
        return $this->hasMany(RunnerJob::class);
    }

    protected function registerStates(): void
    {
        $this
            ->addState('state', OrderState::class)
            ->default(Draft::class)
            ->allowTransitions([
                [Draft::class, PendingPickupSchedule::class],
                [Draft::class, ReceivedWarehouse::class],
                [PendingPickupSchedule::class, PickupScheduled::class],
                [PickupScheduled::class, Collected::class, ToCollected::class],
                [PickupScheduled::class, PendingPickupSchedule::class],
                [Collected::class, ReceivedWarehouse::class, ToReceivedWarehouse::class],
                [ReceivedWarehouse::class, VendorCollected::class, ToVendorCollected::class],
                [ReceivedWarehouse::class, InHouseCleaning::class],
                [[VendorCollected::class, InHouseCleaning::class], PendingReturnSchedule::class, ToCleaningCompleted::class],
                [InDelivery::class, PendingReturnSchedule::class],
                [PendingReturnSchedule::class, ReturnScheduled::class],
                [PendingReturnSchedule::class, Returned::class, ToReturned::class],
                [ReturnScheduled::class, InDelivery::class, ToInDelivery::class],
                [InDelivery::class, Returned::class, ToReturned::class],
                [Returned::class, PendingPickupSchedule::class],
                [Returned::class, Completed::class]
            ]);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($order) {
            foreach ($order->runnerJobs()->get() as $runnerJobs) {
                $runnerJobs->delete();
            }
        });
    }
}
