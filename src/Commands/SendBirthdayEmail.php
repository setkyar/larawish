<?php

namespace SetKyar\Larawish\Commands;

use Mail;
use App\User;
use Illuminate\Console\Command;

class SendBirthdayEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larawish:email-birthday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Birthday Email to Users';

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
        $users = User::whereDate('birthday', '=', date('Y-m-d'))->get();
 
        foreach($users as $user) {
            // Send the email to user
            Mail::queue('larawish::birthday', ['user' => $user], function ($mail) use ($user) {
                $mail->to($user['email'])
                    ->from(config('larawish.contact_mail'), config('larawish.company'))
                    ->subject(config('larawish.birthday_subject'));
            });
        }
     
        $this->info('Birthday messages sent successfully!');
    }
}
