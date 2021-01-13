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
use App\State\Order\ToCompleted;

class Order extends Model
{

    protected $fillable = [
        'size', 'material', 'price', 'prefered_pickup_datetime', 'actual_length',
        'actual_width', 'actual_material', 'actual_price', 'customer_id', 'state', 'quantity',
        'address_1', 'address_2', 'address_3', 'postcode', 'city', 'location_state', 'raw_payload',
        'payment_method', 'paid_at', 'woocommerce_order_id', 'deposit_paid_at', 'deposit_payment_method',
        'deposit_amount', 'collected_at', 'arrived_warehouse_at', 'vendor_collected_at',
        'vendor_returned_at', 'leave_warehouse_at', 'returned_at', 'notice_ambilan_ref',
        'walk_in_customer', 'created_by', 'discount_type', 'discount_rate'
    ];

    use SoftDeletes;
    use HasStates;

    const SIZES = ['xs', 's', 'm', 'l'];
    const MATERIALS = ['wool', 'cotton', 'silk', 'synthetic', 'shaggy'];
    const PAYMENTS = ['cash', 'bank transfer', 'fpx'];
    protected $dates = ['prefered_pickup_datetime','paid_at', 'deposit_paid_at',
        'collected_at', 'arrived_warehouse_at', 'vendor_collected_at', 'vendor_returned_at',
        'leave_warehouse_at', 'returned_at'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
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

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
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
                [PendingReturnSchedule::class, ReturnScheduled::class],
                [PendingReturnSchedule::class, Returned::class, ToReturned::class],
                [ReturnScheduled::class, InDelivery::class, ToInDelivery::class],
                [InDelivery::class, Returned::class, ToReturned::class],
                [[InDelivery::class,ReturnScheduled::class], PendingReturnSchedule::class],
                [Returned::class, Draft::class],
                [Returned::class, Completed::class, ToCompleted::class],
                [Completed::class, Draft::class]
            ]);
    }

    public function balance_to_pay()
    {
        return $this->price - $this->deposit_amount - $this->discount();
    }

    public function discount()
    {
        return ($this->discount_rate / 100) * $this->price;
    }

    public function deductions()
    {
        $deduction = '';
        if ($this->discount_rate) {
            $deduction = $this->discount_type . " " . $this->discount_rate . '% RM' . $this->discount() / 100;
        }
        return $deduction;
    }

    public function totalPrice()
    {
        return $this->price - $this->discount();
    }

    public function fullAddress()
    {
        $addressString = $this->address_1 . "," . $this->address_2 . ","
            .  $this->address_3 . " "  . $this->postcode . ","  . $this->city . ", "
            . $this->location_state;

        $addressString = str_replace(",,", "",$addressString);

        return $addressString;
    }

    public function productList()
    {
        $productList = [];
        
        foreach($this->orderItems as $item)
        {
            $product = "material: " . $item->material
                . ", size: " . $item->size
                . ", quantity: " . $item->quantity
                . ", price: " . $item->price / 100 ;

            array_push($productList, $product);
        }

        return $productList;
    }

    protected static function boot()
    {
        parent::boot();

      static::deleting(function($order) {
         foreach ($order->runnerJobs()->get() as $runnerJob) {
            $runnerJob->delete();
        }
        foreach ($order->Orderitems()->get() as $orderItem) {
                $orderItem->delete();
         }
      });
    }
}