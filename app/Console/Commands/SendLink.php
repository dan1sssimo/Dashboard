<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Mail\CoworkersMsg;
use Illuminate\Support\Facades\Mail;

class SendLink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:link';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $emails = User::pluck("email")->toArray();
        foreach($emails as $email)
        {
            $link = "https://davedashboard.dev.yeducoders.com/test/$email";
            if($link)
            {
                Mail::to($email)->send(new CoworkersMsg($email, $link));
            }
        }

        return 0;
    }
}
