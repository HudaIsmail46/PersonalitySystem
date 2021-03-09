<?php

namespace App\Webhooks\Aafinance;
use App\Webhooks\Aafinance\NewJobAdded;
use App\Webhooks\Aafinance\ExistingJobEdited;
use App\Webhooks\Aafinance\ExistingJobDeleted;
use App\Webhooks\Aafinance\JobAssignmentCreated;
use App\Webhooks\Aafinance\NewSalesInvoicePaymentAdded;
use App\Webhooks\Aafinance\SalesInvoiceAdded;
use App\Webhooks\Aafinance\JobAssignmentCancelled;

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
        case "ExistingJobAssignmentAssigned":
            JobAssignmentCreated::handle($eventMessage);
            break;
        case "ExistingJobAssignmentCancelled":
            JobAssignmentCancelled::handle($eventMessage);
            break;
        case "ExistingJobAssignmentDecline":
            JobAssignmentCancelled::handle($eventMessage);
            break;
        case "NewSalesInvoicePaymentAdded":
            NewSalesInvoicePaymentAdded::handle($eventMessage);
            break;
        case "NewSalesInvoiceAdded":
            SalesInvoiceAdded::handle($eventMessage);
            break;
        case "ExistingSalesInvoiceEdited":
            SalesInvoiceAdded::handle($eventMessage);
            break;
        default:
            break;
        }

       http_response_code(200);
    }
}
