<?php

return [
    'configs' => [
        [
            'name' => 'aafinance',
            'signing_secret' => env('WEBHOOK_CLIENT_SECRET'),
            'signature_header_name' => 'Signature',
            'signature_validator' => App\Webhooks\Aafinance\CustomSignatureValidator::class,
            'webhook_profile' => \Spatie\WebhookClient\WebhookProfile\ProcessEverythingWebhookProfile::class,
            'webhook_response' => \Spatie\WebhookClient\WebhookResponse\DefaultRespondsTo::class,
            'webhook_model' => \Spatie\WebhookClient\Models\WebhookCall::class,
            'process_webhook_job' => App\Webhooks\Aafinance\ProcessWebhook::class,
        ],
        [
            'name' => 'booking',
            'signing_secret' => env('WEBHOOK_CLIENT_SECRET'),
            'signature_header_name' => 'Signature',
            'signature_validator' => App\Webhooks\Woocommerce\CustomSignatureValidator::class,
            'webhook_profile' => \Spatie\WebhookClient\WebhookProfile\ProcessEverythingWebhookProfile::class,
            'webhook_response' => \Spatie\WebhookClient\WebhookResponse\DefaultRespondsTo::class,
            'webhook_model' => \Spatie\WebhookClient\Models\WebhookCall::class,
            'process_webhook_job' => App\Webhooks\Woocommerce\ProcessWebhook::class,
        ],
    ],
];
