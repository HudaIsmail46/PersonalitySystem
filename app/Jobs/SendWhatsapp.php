<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SendWhatsapp implements ShouldQueue
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
        if (env('WHATSAPP_SEND')) {
            Http::post('https://api.watext.com/hook/message', [
                'apikey' => env('WHATSAPP_KEY'),
                'phone' => $this->phone_number,
                'message' => $this->message
            ]);
        } else {
            logger('sending whatsapp to' . $this->phone_number . '. msg: ' . $this->message);
        }
        
    }
}
