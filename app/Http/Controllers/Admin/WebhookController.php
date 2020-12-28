<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AuthenticatedController;
use Spatie\WebhookClient\Models\WebhookCall;
use Illuminate\Http\Request;


class WebhookController extends AuthenticatedController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->status;

        $webhooks = WebhookCall::when($status == 'true', function ($q) use ($status) {
                return $q->whereNull('exception');
            })
            ->when($status == 'false', function ($q) use ($status) {
                return $q->whereNotNull('exception');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.webhook.index', compact('webhooks'))
            ->with('i', ($webhooks->get('page', 1) - 1) * 5);
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(WebhookCall $webhook)
    {
        return view('admin.webhook.show', compact('webhook'));
    }
}