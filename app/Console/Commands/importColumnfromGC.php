<?php

namespace App\Console\Commands;

use App\Booking;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class importColumnfromGC extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'booking:importGcColumn';

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
        $booking_remarks = Booking::whereNull('remarks')->get();
        foreach ($booking_remarks as $booking_remark) {

            $booking_remark->update([
                'remarks' => $booking_remark->gc_description,
            ]);
        }
        $this->info('done');
        $booking_teams = Booking::whereNull('team')->get();
        foreach ($booking_teams as $booking_team) {

            $booking_team->update([
                'team' => $booking_team->gc_team,
            ]);
        }
        $this->info('done');
        $booking_prices = Booking::whereNull('price')->get();
        foreach ($booking_prices as $booking_price) {

            $booking_price->update([
                'price' => $booking_price->gc_price,
            ]);
        }
        $this->info('done');
    }
}
