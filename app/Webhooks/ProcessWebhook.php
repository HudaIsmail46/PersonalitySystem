<?php

namespace App\Webhooks;
use \Spatie\WebhookClient\ProcessWebhookJob;
use App\Webhooks\Aafinance\WebhookHandler;

class ProcessWebhook extends ProcessWebhookJob
{
    public function handle(){
       WebhookHandler::handle($this->webhookCall);

       http_response_code(200);
    }
}