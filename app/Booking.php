<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Booking extends Model
{
    protected $fillable = ['gc_id','gc_event_title', 'gc_address', 'gc_event_begins',
        'gc_event_ends', 'gc_description', 'gc_team', 'name', 'phone_no', 'status',
        'receipt_number', 'invoice_number', 'gc_price', 'price', 'service_type',
        'customer_id','deleted_at', 'event_begins', 'event_ends', 'deposit', 'pic',
        'address_1','address_2','address_3','postcode','city','location_state',
        'af_reference', 'remarks', 'team', 'covernote_id', 'aafinance_webhook',
        'aafinance_payment','insured_at', 'aafinance_invoice'];

    use SoftDeletes;
    const TEAM = ['HQ1', 'HQ2', 'HQ3', 'HQ4', 'HQ5', 'HQ6','HQ7', 'HQ8', 'AUX1', 'AUX3', 'AUX4']; //legacy team
    const PIC = ['CS1', 'CS2', 'CS3', 'CS4', 'CS5', 'CS6', 'CS7', 'CS8'];
    const TYPE = ['RES', 'COM', 'HQ'];
    const STATUS = ['APPROVED', 'NOT APPROVED', 'POSTPONED','IN PROGRESS', 'HUTANG', 'RECUCI', 'APPROVED', 'PENDING', 'NOT VALID',];

    protected $dates = ['deleted_at', 'event_ends', 'event_begins', 'gc_event_begins', 'gc_event_ends'];
    protected $casts = [
        'aafinance_webhook' => 'array',
        'aafinance_payment' => 'array',
        'aafinance_invoice' => 'array'
    ];

    public function path()
    {
        return route('booking.show', $this);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function bookingItems()
    {
        return $this->hasMany(BookingItem::class);
    }

    public function agentAsignments()
    {
        return $this->hasMany(AgentAssignment::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function payments()
    {
        return $this->hasMany(InvoicePayment::class);
    }

    public function images()
    {
        return $this->morphMany('App\Image','imageable');
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function followUps()
    {
        return $this->hasOne(FollowUp::class);
    }

    public function fullAddress()
    {
        $addressString = $this->address_1 . "," . $this->address_2 . ","
            .  $this->address_3 . " "  . $this->postcode . ","  . $this->city . ", "
            . $this->location_state;

        $addressString = str_replace(",,", "",$addressString);

        return $addressString;
    }

    public function additions()
    {
        $additions = [];
        if ($this->aafinance_invoice) {
            $additionsData = $this->aafinance_invoice['SalesInvoiceAddtionalCosts'];
        } else {
            $additionsData = $this->aafinance_webhook['JobAddtionalCost'];
        }

        foreach($additionsData as $addition)
        {
            if ($addition['Amount'] > 0) {
                $additionstring =  $addition['Description'] . ' RM ' . $addition['Amount'];
                array_push($additions, $additionstring);
            }
        }

        return $additions;
    }

    public function estimateAdditionsSum()
    {
        $additions = 0;
        if ($this->aafinance_webhook) {
            $additionsData = $this->aafinance_webhook['JobAddtionalCost'];

            foreach($additionsData as $addition)
            {
                if ($addition['Amount'] > 0) {
                    $additions += (float)$addition['Amount'];
                }
            }
        }

        return $additions;
    }

    public function actualAdditionsSum()
    {
        $additions = 0;
        if ($this->aafinance_invoice) {
            $additionsData = $this->aafinance_invoice['SalesInvoiceAddtionalCosts'];

            foreach($additionsData as $addition)
            {
                if ($addition['Amount'] > 0) {
                    $additions += (float)$addition['Amount'];
                }
            }
        }

        return $additions;
    }

    public function deductions()
    {
        $deductions = [];
        if ($this->aafinance_invoice) {
            $deductionsData = $this->aafinance_invoice['SalesInvoiceAddtionalCosts'];
        } else {
            $deductionsData = $this->aafinance_webhook['JobAddtionalCost'];
        }

        foreach($deductionsData as $deduction)
        {
            if ($deduction['Amount'] < 0) {
                $deductionString =  $deduction['Description'] . ' RM ' . $deduction['Amount'];
                array_push($deductions, $deductionString);
            }
        }

        return $deductions;
    }

    public function deposit()
    {
        if (array_key_exists('JobDeposit', $this->aafinance_webhook)) {
            return $this->aafinance_webhook['JobDeposit'] ? $this->aafinance_webhook['JobDeposit']['Amount'] : null;
        }
    }

    public function handledBy()
    {
        return array_key_exists('CreationUser', $this->aafinance_webhook) ? $this->aafinance_webhook['CreationUser'] : '';
    }

    public function productList()
    {
        $productList = [];
        if ($this->aafinance_invoice) {
            foreach($this->aafinance_invoice['SalesInvoiceItems'] as $item)
            {
                $product = "name: " . $item["Product"]["ProductName"]
                    . ", code: " . $item["Product"]["ProductCode"]
                    . ", category: " . $item["Product"]["Category"]
                    . ", price: " . $item["SellPrice"]
                    . ", quantity: " . $item["Quantity"];

                array_push($productList, $product);
            }
        } else {
            foreach($this->aafinance_webhook['JobItems'] as $item)
            {
                $product = "name: " . $item["Product"]["ProductName"]
                    . ", code: " . $item["Product"]["ProductCode"]
                    . ", category: " . $item["Product"]["Category"]
                    . ", price: " . $item["UnitPrice"]
                    . ", quantity: " . $item["Quantity"]
                    . ", remark: " . $item["Remark"];

                array_push($productList, $product);
            }
        }

        return $productList;
    }

    private function sumEstimatedPrice($regex)
    {
        $price = 0;
        foreach($this->aafinance_webhook['JobItems'] as $item)
        {
            if (preg_match($regex, $item["Product"]["ProductCode"])) {
                $itemPrice = $item["UnitPrice"];
                $itemQuantity = $item["Quantity"];

                $price += ($itemPrice * $itemQuantity);
            };
        }

        return $price;
    }

    public function estimatedCkuResidentialPrice()
    {
        $regex = "/^1\d{2}$/";
        return $this->sumEstimatedPrice($regex);
    }

    public function estimatedCkuCommercialPrice()
    {
        $regex = "/^3\d{2}$/";
        return $this->sumEstimatedPrice($regex);
    }

    public function estimatedMcsResidentialPrice()
    {
        $regex = "/^4\d{2}$/";
        return $this->sumEstimatedPrice($regex);
    }

    public function estimatedMcsCommercialPrice()
    {
        $regex = "/^5\d{2}$/";
        return $this->sumEstimatedPrice($regex);
    }

    public function estimatedHqPrice()
    {
        $regex = "/^2\d{2}$/";
        return $this->sumEstimatedPrice($regex);
    }

    public function estimatedHardFloorResidentialPrice()
    {
        $regex = "/^7\d{2}$/";
        return $this->sumEstimatedPrice($regex);
    }

    public function estimatedHardFloorCommercialPrice()
    {
        $regex = "/^8\d{2}$/";
        return $this->sumEstimatedPrice($regex);
    }

    public function estimatedPndPrice()
    {
        $regex = "/^6\d{2}$/";
        return $this->sumEstimatedPrice($regex);
    }

    private function sumActualPrice($regex)
    {
        $price = 0;
        if ($this->aafinance_invoice) {
            foreach($this->aafinance_invoice['SalesInvoiceItems'] as $item)
            {
                if (preg_match($regex, $item["Product"]["ProductCode"])) {
                    $itemPrice = $item["SellPrice"];
                    $itemQuantity = $item["Quantity"];

                    $price += ($itemPrice * $itemQuantity);
                };
            }
        }

        return $price;
    }

    public function actualCkuResidentialPrice()
    {
        $regex = "/^1\d{2}$/";
        return $this->sumActualPrice($regex);
    }

    public function actualCkuCommercialPrice()
    {
        $regex = "/^3\d{2}$/";
        return $this->sumActualPrice($regex);
    }

    public function actualMcsResidentialPrice()
    {
        $regex = "/^4\d{2}$/";
        return $this->sumActualPrice($regex);
    }

    public function actualMcsCommercialPrice()
    {
        $regex = "/^5\d{2}$/";
        return $this->sumActualPrice($regex);
    }

    public function actualHqPrice()
    {
        $regex = "/^2\d{2}$/";
        return $this->sumActualPrice($regex);
    }

    public function actualHardFloorResidentialPrice()
    {
        $regex = "/^7\d{2}$/";
        return $this->sumActualPrice($regex);
    }

    public function actualHardFloorCommercialPrice()
    {
        $regex = "/^8\d{2}$/";
        return $this->sumActualPrice($regex);
    }

    public function actualPndPrice()
    {
        $regex = "/^6\d{2}$/";
        return $this->sumActualPrice($regex);
    }

    public function estimatedDeductionPercentage()
    {
        $deductions = 0;
        $deductionsData = $this->aafinance_webhook['JobAddtionalCost'];
        foreach($deductionsData as $deduction)
        {
            if ($deduction['Amount'] < 0) {
                $deductions =  $deductions + (float)$deduction['Amount'];
            }
        }

        $sumEstimatedPrice = $this->sumEstimatedPrice("/\d*/");
        $deductionPercent = 0;
        if ($sumEstimatedPrice > 0) {
            $deductionPercent = (-$deductions/$sumEstimatedPrice)*100;
        }

        return $deductionPercent;
    }

    public function actualDeductionPercentage()
    {
        if ($this->aafinance_invoice) {
            $deductions = 0;
            $deductionsData = $this->aafinance_invoice['SalesInvoiceAddtionalCosts'];
            foreach($deductionsData as $deduction)
            {
                if ($deduction['Amount'] < 0) {
                    $deductions =  $deductions + (float)$deduction['Amount'];
                }
            }

            $sumActualPrice = $this->sumActualPrice("/\d*/");
            $deductionPercent = (-$deductions/$sumActualPrice)*100;

            return $deductionPercent;
        } else {
            return 0;
        }

    }

    public function afterDeductionCkuEstimates()
    {
        $sumOfCku = $this->estimatedCkuResidentialPrice()
                        + $this->estimatedCkuCommercialPrice()
                        + $this->estimatedHqPrice()
                        + $this->estimatedHardFloorResidentialPrice()
                        + $this->estimatedHardFloorCommercialPrice()
                        + $this->estimatedPndPrice();
        $discount = $this->estimatedDeductionPercentage();

        return $sumOfCku * (100 - $discount) /100;
    }

    public function afterDeductionMcsEstimates()
    {
        $sumOfMcs = $this->estimatedMcsResidentialPrice() + $this->estimatedMcsCommercialPrice();
        $discount = $this->estimatedDeductionPercentage();

        return $sumOfMcs * (100 - $discount) /100;
    }

    public function afterDeductionCkuActual()
    {
        $sumOfCku = $this->actualCkuResidentialPrice()
                        + $this->actualCkuCommercialPrice()
                        + $this->actualHqPrice()
                        + $this->actualHardFloorResidentialPrice()
                        + $this->actualHardFloorCommercialPrice()
                        + $this->actualPndPrice();
        $discount = $this->actualDeductionPercentage();

        return $sumOfCku * (100 - $discount) /100;
    }

    public function afterDeductionMcsActual()
    {
        $sumOfMcs = $this->actualMcsResidentialPrice() + $this->actualMcsCommercialPrice();
        $discount = $this->actualDeductionPercentage();

        return $sumOfMcs * (100 - $discount) /100;
    }

    public function eligibleForInsurance()
    {
        return !$this->covernote_id &&
            $this->event_begins > Carbon::now()->addDays(7) &&
            (
                $this->estimatedCkuResidentialPrice() > 0 ||
                $this->estimatedCkuCommercialPrice() > 0 ||
                $this->estimatedHqPrice() > 0
            ) &&
            $this->customer;
    }

    public function teams()
    {
        $assignments = $this->agentAsignments()->whereIn('agent_assignments.status', ['Accepted', 'Pending'])->get();
        $agents = [];

        foreach($assignments as $assignment)
        {
            $agent = $assignment->agent->fullname . ': ' . $assignment->status;

            array_push($agents, $agent);
        }

        return $agents;
    }
}
