<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\SendIssueInsurance'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

     
    // protected function schedule(Schedule $schedule)
    // {
    //     $schedule->command('google_calendar:import')
    //         ->everyFifteenMinutes()
    //         ->timezone('Asia/Kuala_Lumpur')
    //         ->between('8:00', '22:00');
    // }

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('issue_insurance:import')
                    ->daily();
    }
    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
