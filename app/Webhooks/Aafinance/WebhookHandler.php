<?php

namespace App\Webhooks\Aafinance;
use App\Webhooks\Aafinance\NewJobAdded;
use App\Webhooks\Aafinance\ExistingJobEdited;
use App\Webhooks\Aafinance\ExistingJobDeleted;
// use App\Webhooks\Aafinance\NewAgentAdded;
// use App\Webhooks\Aafinance\ExistingAgentEdited;
// use App\Webhooks\Aafinance\NewAgentAssignmentAdded;
// use App\Webhooks\Aafinance\ExistingAgentDeleted;
use App\Webhooks\Aafinance\NewJobAttendanceAdded;
// use App\Webhooks\Aafinance\ExistingJobAssignmentAssigned;
// use App\Webhooks\Aafinance\ExistingJobAssignmentAccepted;
// use App\Webhooks\Aafinance\ExistingJobAssignmentCancelled;

class WebhookHandler
{
    public static function handle($data)
    {
        $data = json_decode($data, true);
        $eventType = $data['payload']['EventType'];
        $eventMessage = $data['payload']['EventMessage'];

        switch ($eventType) {
        case 'NewJobAdded':
            NewJobAdded::handle($eventMessage);
            break;
        case 'ExistingJobEdited':
            ExistingJobEdited::handle($eventMessage);
            break;
        case "ExistingJobDeleted":
            ExistingJobDeleted::handle($eventMessage);
            break;
        case "NewJobAttendanceAdded":
            NewJobAttendanceAdded::handle($eventMessage);
            break;
        default:
            break;
      }

       http_response_code(200);
    }
}

// Ignoring these webhooks for now,
// case 'NewAgentAdded':
//     NewAgentAdded::handle($eventMessage);
//     break;
// case 'ExistingAgentEdited':
//     ExistingAgentEdited::handle($eventMessage);
//     break;
// case "NewAgentAssignmentAdded":
//     NewAgentAssignmentAdded::handle($eventMessage);
//     break;
// case 'ExistingAgentDeleted':
//     ExistingAgentDeleted::handle($eventMessage);
//     break;
// case "ExistingJobAssignmentAssigned":
//     ExistingJobAssignmentAssigned::handle($eventMessage);
//     break;
// case "ExistingJobAssignmentAccepted":
//     ExistingJobAssignmentAccepted::handle($eventMessage);
//     break;
// case "ExistingJobAssignmentCancelled":
//     ExistingJobAssignmentCancelled::handle($eventMessage);
//     break;