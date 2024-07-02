<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\BirthdayMail;
use App\Models\Mentor;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use App\Utils;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendBirthdayEmails extends Command
{
    use Utils;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:birthday-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Birthday Emails';

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::now()->format('m-d');

        $this->sendBirthdayEmails(User::class, $today, 'user');
        $this->sendBirthdayEmails(Student::class, $today, 'student');
        $this->sendBirthdayEmails(Mentor::class, $today, 'mentor');

        $this->info('All birthday emails have been queued.');
    }

    protected function sendBirthdayEmails($model, $today, $type)
    {
        try {

            $recipients = $model::whereRaw('DATE_FORMAT(dateofbirth, "%m-%d") = ?', [$today])->get();

            foreach ($recipients as $recipient) {
                $message = "This birthday, I wish you abundant happiness and love. May all your dreams turn into reality and may lady luck visit your home today. Happy birthday to one of the sweetest people I've ever known. Dear $recipient->name, you're getting a 50% discount if you enroll in any other course today. This offer is valid for only 24 hours.";

                $this->sendSMS($recipient->mobile, $message);
                Mail::to($recipient->email)->send(new BirthdayMail($recipient, $type));

                $this->info("Queued birthday email to {$type}: " . $recipient->email);
            }

        } catch (\Exception $e) {
            Log::error('Failed to send birthday emails: ' . $e->getMessage());
        }
    }
}
