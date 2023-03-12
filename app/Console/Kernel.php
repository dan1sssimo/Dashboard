<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Mail\CowokersMsg;
use Illuminate\Support\Facades\Mail;
use App\Console\Commands\SendLink;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected $commands = [
        'App\Console\Commands\SendLink'
    ];
    protected function schedule(Schedule $schedule)
    {
//        $schedule->call(function () {
//            $users = DB::table('users')->get();
//            foreach($users as $user)
//            {
//                $email = $user->email;
//                $name = $user->name;
//                $link = "https://davedashboard.dev.yeducoders.com/test/$email";
//                Mail::to($email)->send(new CoworkersMsg($name, $link));
//            }
//        })->everyMinute();

        $schedule->command('email:link')->monthlyOn(6, '10:00');
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
