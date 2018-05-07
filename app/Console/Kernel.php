<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule) {
        /* $schedule->command('inspire')
          ->dailyAt('13:00')
          ->timezone('America/New_York')
          ->sendOutputTo(storage_path('app/public/cron/scheduled_sms_' . date('Y-m-d H:i:s'))); */
        $schedule->command('inspire')
                ->dailyAt('13:00')
                ->timezone('America/New_York')
                ->appendOutputTo(storage_path('app\public\cron\scheduled_sms.txt'));
        //dd($schedule);
    }

}
