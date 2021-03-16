<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Booking;
use App\Agent;
Use App\AgentAssignment;
Use \Spatie\WebhookClient\Models\WebhookCall;
use Illuminate\Support\Facades\DB;
use App\Webhooks\Aafinance\WebhookHandler;

class BuildAgentAssignment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'agent_assignment:build';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rebuild Agent Assignment Data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $webhookIds = DB::select("select id from webhook_calls where webhook_calls.payload::json ->'EventMessage'->'Job'->>'JobId' is not null");

        foreach($webhookIds as $webhookId)
        {
            $webhook = WebhookCall::find($webhookId->id);
            logger($webhook);
            WebhookHandler::handle($webhook);
        }

        return 0;
    }
}
