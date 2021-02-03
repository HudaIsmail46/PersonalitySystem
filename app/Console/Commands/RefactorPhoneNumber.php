<?php

namespace App\Console\Commands;

use App\Customer;
use Illuminate\Console\Command;

class RefactorPhoneNumber extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customer_phone_number:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $customers = Customer::where('phone_no', 'like', '0%')->orWhere('phone_no', 'like', '+601%')->orWhere('phone_no', 'like', '+60%')->orWhere('phone_no', 'like', '6+01%')
            ->orWhere('phone_no', 'like', '6 0%')->orWhere('phone_no', 'like', '6	0%')->get();

        foreach ($customers as $customer) {

            $cleaned_phone_no = formatPhoneNo($customer->phone_no);
            $customer_phone_no = Customer::where('phone_no', $cleaned_phone_no)->first();

            $this->updatePhoneNo($customer_phone_no, $cleaned_phone_no, $customer);
        }
        $this->info('done');


        $customers = Customer::where('phone_no', 'like', '660%')->get();

        foreach ($customers as $customer) {

            $phone_no = preg_replace('/^' . preg_quote('6', '/') . '/', '', $customer->phone_no);
            $cleaned_phone_no = preg_replace('/\D+/', '', $phone_no);
            $customer_phone_no = Customer::where('phone_no', $cleaned_phone_no)->first();

            $this->updatePhoneNo($customer_phone_no, $cleaned_phone_no, $customer);
        }
        $this->info('done');
    }

    public function updatePhoneNo($customer_phone_no, $cleaned_phone_no, $customer)
    {

        if (($customer_phone_no->phone_no ?? '') != $cleaned_phone_no) {
            $customer->fill([
                'phone_no' => $cleaned_phone_no,
            ]);
            $customer->save();
        } else {

            if ($customer_phone_no->bookings || $customer_phone_no->orders || $customer->bookings || $customer->orders) {

                foreach ($customer->bookings as $booking) {

                    $booking->update(['customer_id' => $customer_phone_no->id]);

                    $this->info("Booking for cust:  " . $booking->customer_id);
                }

                foreach ($customer->orders as $order) {

                    $order->update(['customer_id' => $customer_phone_no->id]);

                    $this->info("Order for cust:  " . $order->customer_id);
                }

                $customer->delete();
            }
        }
    }
}
