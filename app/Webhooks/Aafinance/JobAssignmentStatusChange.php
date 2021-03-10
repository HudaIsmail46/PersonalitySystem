<?php

namespace App\Webhooks\Aafinance;
use App\Booking;
use Carbon\Carbon;
use App\AgentAssignment;
use App\Webhooks\Aafinance\AafinanceWeebhook;

class JobAssignmentStatusChange extends AafinanceWebhook
{
    public static function handle($data)
    {
        $booking = Booking::firstWhere('af_reference',  $data['Job']['JobId']);
        if ($booking) {
           $assignment = $booking->agentAsignments->where('assignment_id', $data['JobAssignmentId'])->first();
            if ($assignment) {
                $assignment->update([
                    'status'=> $data['Status']
                ]);
            }
        }
    }
}
