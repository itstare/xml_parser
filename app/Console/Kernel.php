<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Http\Controllers\CronJobsController;
use App\Models\ImageData;
use App\Models\StringData;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $imageData = ImageData::all();
            $stringData = StringData::all();

            $currentDateTime = Carbon::now();

            foreach ($imageData as $image) {
                if($currentDateTime->gt($image->updated_at->addDays(3))) {
                    $image->delete();
                }
            }

            foreach ($stringData as $string) {
                if($currentDateTime->gt($string->updated_at->addDays(3))) {
                    $string->delete();
                }
            }
        })->daily();
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
