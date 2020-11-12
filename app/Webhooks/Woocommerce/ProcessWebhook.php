<?php

namespace App\Webhooks\Woocommerce;
use \Spatie\WebhookClient\ProcessWebhookJob;
use App\Webhooks\Woocommerce\WebhookHandler;
use App\Order;

class ProcessWebhook extends ProcessWebhookJob
{
    public function handle(){
       WebhookHandler::handle($this->webhookCall);

       http_response_code(200);
    }
}