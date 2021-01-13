<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Booking;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class IssueInsurance implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $booking;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->eligibleForInsurance() ) {

            $body = [
                'client_mobile' => formatPhoneNo($this->booking->customer->phone_no),
                'client_email' => 'insurance.cleanhero@gmail.com',
                'project_date' => Carbon::parse($this->booking->event_begins)->format('Y-m-d'),
                'project_day' => '1',
                'project_value' => $this->toInt($this->booking->price /100),
                'name_of_contractor' => 'CleanHero Sdn Bhd',
                'name_of_client' => $this->alphabetOnly($this->booking->customer->name),
                'scope_of_work' => 'Carpet And Upholstery Cleaning',
                'project_location' => $this->address($this->booking)
            ];

            $response = Http::withToken(env('SENANGPKS'))
                ->post('https://senangpks.com.my/api/public/api/cleanHero', $body);

            if ($response["message"] == "success" && $response["data"]["covernote_id"]) {
                $this->booking->update([
                    'covernote_id'=> $response["data"]["covernote_id"],
                    'insured_at'=> Carbon::now()
                    ]);
            } else {
                Log::error("booking: " . $this->booking->id . " " . $response["data"]["error_msg"]);
            }

        }
    }

    private function eligibleForInsurance()
    {
        return !$this->booking->covernote_id &&
            ( 
                $this->booking->estimatedCkuResidentialPrice() > 0 ||
                $this->booking->estimatedCkuCommercialPrice() > 0 ||
                $this->booking->estimatedHqPrice() > 0
            ) &&
            $this->booking->customer;
    }

    private function address($booking)
    {
        return $booking->address_1 .', '. $booking->address_2 .', '. $booking->city
            .', '. $booking->postcode .', '. $booking->location_state;
    }

    private function alphabetOnly($string)
    {
        return preg_replace('/[\W\d_]*/i', '', $string);
    }

    private function toInt($float)
    {
        return (int)$float;
    }
}