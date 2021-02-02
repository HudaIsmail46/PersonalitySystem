<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $phone_number;
    protected $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(String $phone_number, String $message)
    {
        $this->phone_number = $phone_number;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $query = http_build_query([
            'apiusername'=> env('ONEWAYSMS_USERNAME'),
            'apipassword'=> env('ONEWAYSMS_PASSWORD'),
            'mobileno'=> formatPhoneNo($this->phone_number),
            'senderid'=> 'INFOCH',
            'languagetype'=> '1',
            'message'=> $this->message
        ]);

        if (env('SMS_SEND')) {
            Http::post('http://gateway.onewaysms.com.my:10001/api.aspx?' . $query);
        } else {
            logger('sending sms to' . $this->phone_number . '. msg: ' . $this->message);
        }
        
    }
}
