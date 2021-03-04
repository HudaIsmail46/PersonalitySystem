<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\GenerateDailyReport;

class DailyReportGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily_report:calculate {--date= : Date eg 13/1/2021}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate Todays Productivity';

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
        $dateString = $this->option('date');
        GenerateDailyReport::dispatchNow($dateString);

        return 0;
    }
}
