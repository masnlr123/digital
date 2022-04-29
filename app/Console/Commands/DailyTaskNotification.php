<?php

namespace App\Console\Commands;
use App\User;
use Auth;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\DailyTaskNotice;

class DailyTaskNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send_daily_task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Daily Task Details';

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
     * @return mixed
     */
    public function handle()
    {
            $mdata = array(
                'to' => array('vijay.cs@alliancein.com'),
                'from' => 'vijay.cs@gmail.com',
                'from_name' => 'Vijay.CS',
                'subject' => 'Task Details'
            );
            Mail::to($mdata['to'])->send(new DailyTaskNotice($mdata));

        // Mail::queue('mail.daily_task', [], function ($mail) {
        //     $mail->to('mahimai@alliancein.com')
        //         ->from('noreply@alliancein.com', 'WEB ADMIN')
        //         ->subject('Today Task List!');
        // }
        // );


        $this->info('Email sent successfully!');
    }
}
