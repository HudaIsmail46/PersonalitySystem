<?php

namespace App\Webhooks\Aafinance;
use App\Booking;
use App\Agent;
use App\AgentAssignment;
use Carbon\Carbon;
use App\Webhooks\Aafinance\AafinanceWeebhook;
use App\Jobs\ReportBooking;

class JobAssignmentCreated extends AafinanceWebhook
{
    public static function handle($data)
    {
        $booking = Booking::firstWhere('af_reference',  $data['Job']['JobId']);
        $agent = Agent::firstWhere('afinance_id', $data['Agent']['AgentId']);
        if(!$agent){
            $agent = new Agent;
            $agent->fill([
                'afinance_id'=> $data['Agent']['AgentId'],
                'afinance_agent_code'=> $data['Agent']['AgentCode']
            ]);
        }

        $agent->fill([
            'fullname'=> $data['Agent']['Fullname'],
            'nickname'=> $data['Agent']['Nickname'],
            'nric'=> $data['Agent']['Nric'],
            'email'=> $data['Agent']['Email'],
            'phone_number'=> $data['Agent']['PhoneNumber']
        ]);

        $agent->save();

        if ($booking) {
            $assignment = new AgentAssignment;
            $assignment->fill([
                'assignment_id' => $data['JobAssignmentId'],
                'booking_id' => $booking->id,
                'agent_id' =>$agent->id,
                'raw_assignment' => $data,
                'status' => $data['Status'],
                'created_by' => array_key_exists('CreationUser', $data) ? $data['CreationUser'] : ''
            ]);

            $assignment->save();

            ReportBooking::dispatch($booking);
        }
    }
}
