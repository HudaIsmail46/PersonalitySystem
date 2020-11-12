<?php

namespace App\Webhooks\Woocommerce;
use Illuminate\Http\Request;
use Spatie\WebhookClient\Exceptions\WebhookFailed;
use Spatie\WebhookClient\WebhookConfig;
use Spatie\WebhookClient\SignatureValidator\SignatureValidator;

class CustomSignatureValidator implements SignatureValidator{
    public function isValid(Request $request, WebhookConfig $config): bool
    {
        return true;
   }
}
