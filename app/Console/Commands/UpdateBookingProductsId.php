<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\BookingItem;
use App\BookingProduct;

class UpdateBookingProductsId extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'booking_product:update_id';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find and update booking product id in booking items';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $booking_items = BookingItem::whereNull('booking_product_id')->get();
        foreach ($booking_items as $booking_item) {
            $products_id = $booking_item->aafinance_webhook['Product']['ProductId'];
            $id = BookingProduct::where('product_id', $products_id)->pluck('id')->first();
            if ($id != null) {

                $booking_item->fill([
                    'booking_product_id' => $id,
                ]);
                $booking_item->save();
                $this->info("Booking Product Id updated");
            }
        }
        return 0;
    }
}
