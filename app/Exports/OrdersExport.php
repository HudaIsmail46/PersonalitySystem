<?php

namespace App\Exports;

use App\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct($orders)
    {
        $this->orders = $orders;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->orders;
    }

    public function headings(): array
    {
        return [
            '#',
            'WooCommerce Order Ref',
            'Name',
            'Phone No',
            'Prefered Date Time',
            'Address',
            'Product',
            'Created By',
            'Estimated Price',
            'Total Invoice',
            'Discount',
            'Discount Rate',
            'Payment Status',
            'Collected At',
            'Arrived Warehouse At ',
            'Vendor Collected At ',
            'Vendor Returned At',
            'Runner PickUp At',
            'Customer Received At',
            'Status'
        ];
    }

    public function map($order): array
    {
        return [
            $order->id,
            $order->woocommerce_order_id,
            $order->customer ? $order->customer->name : '',
            $order->customer ? (string)$order->customer->phone_no : '',
            $order->prefered_pickup_datetime,
            $order->fullAddress(),
            implode("\n", $order->productList()),
            $order->creator->name ?? "Athir",
            ($order->price) / 100,
            $order->totalPrice() / 100,
            $order->discount_type ?? '',
            $order->discount_rate? $order->discount_rate . '%' : '',
            $order->paymentStatus(),
            $order->collected_at,
            $order->arrived_warehouse_at,
            $order->vendor_collected_at,
            $order->vendor_returned_at,
            $order->runner_pickup_at,
            $order->customer_received_at,
            humaniseOrderState($order->state)
        ];
    }
}
