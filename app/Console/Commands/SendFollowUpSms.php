<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendSms;
use App\FollowUp;

class SendFollowUpSms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'follow_up_sms:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send all due sms';

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
        $firstSms = FollowUp::dueFirstSms()->with('customer')->get();
        $secondSms = FollowUp::dueSecondSms()->with('customer')->get();
        $thirdSms = FollowUp::dueThirdSms()->with('customer')->get();
        $sales_person_rotation = $this->sales_person_rotation($thirdSms->count());

        foreach($firstSms as $follow_up){
            if ($follow_up->voucher_percent == 20) {
                $msg = config('follow_up_sms.firstVoucher.sms1');
            } else {
                $msg = config('follow_up_sms.secondVoucher.sms1');
            }
            SendSms::dispatch($follow_up->customer->phone_no, $msg);
        }

        foreach($secondSms as $follow_up){
            if ($follow_up->voucher_percent == 20) {
                $msg = config('follow_up_sms.firstVoucher.sms2');
            } else {
                $msg = config('follow_up_sms.secondVoucher.sms2');
            }
            SendSms::dispatch($follow_up->customer->phone_no, $msg);
        }

        foreach($thirdSms as $follow_up){
            if ($follow_up->voucher_percent == 20) {
                $msg = config('follow_up_sms.firstVoucher.sms3');
            } else {
                $msg = config('follow_up_sms.secondVoucher.sms3');
            }
            SendSms::dispatch($follow_up->customer->phone_no, $msg);
            $follow_up->update(['sales_person' => array_shift($sales_person_rotation)]);
        }
    }

    private function sales_person_rotation(Int $lead_count)
    {
        $sales_person = FollowUp::SALES_PERSON_ROTATION;
        shuffle($sales_person);
        $count = (int)($lead_count / count($sales_person)) + 1;
        $rotation = [];
        for ($i = 0 ; $i < $count; $i++){ 
            foreach ($sales_person as $sale_person) {
                array_push($rotation, $sale_person);
            }
        }

        return $rotation;
    }
}