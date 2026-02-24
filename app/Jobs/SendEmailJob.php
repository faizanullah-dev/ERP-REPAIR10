<?php

namespace App\Jobs;

use App\UsersMailboxesSent;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $emailDetails;
    protected $userId;

    public function __construct($emailDetails,$userId)
    {
        $this->emailDetails = $emailDetails;
        $this->userId = $userId;
    }
    public function handle()
    {
        $emailDetails = $this->emailDetails; //Get the email details from the queue job.
            Mail::raw($emailDetails['body'], function ($message) use ($emailDetails) {
                if (filter_var($emailDetails['from'], FILTER_VALIDATE_EMAIL) && filter_var($emailDetails['to'], FILTER_VALIDATE_EMAIL)) {
                    $message->from($emailDetails['from'])->to($emailDetails['to'])->subject($emailDetails['subject']);
                    if (!empty($emailDetails['cc']) && filter_var($emailDetails['cc'], FILTER_VALIDATE_EMAIL)) {
                        $message->cc($emailDetails['cc']);
                    }//end if
                    if (!empty($emailDetails['bcc']) && filter_var($emailDetails['bcc'], FILTER_VALIDATE_EMAIL)) {
                        $message->bcc($emailDetails['bcc']);
                    }//end if
                    foreach ($emailDetails['attachments'] as $filePath) {
                        if (file_exists($filePath)){
                            $message->attach($filePath);
                        }//end if .
                    }//end foreach
                }//end if
            });//ends Mail::raw.
        UsersMailboxesSent::create([
            'user_id' => $this->userId??'',
            'configuration_email' => $this->emailDetails['from']??'',
            'to' => $this->emailDetails['to']??'',
            'from' => $this->emailDetails['from']??'',
            'cc' => $this->emailDetails['cc']??'',
            'bcc' => $this->emailDetails['bcc']??'',
            'message' => $this->emailDetails['body'],
            'mail_attachment' => json_encode($this->emailDetails['attachments']),
            'subject' => $this->emailDetails['subject']
        ]);//ends UsersMailboxesSent::create.
        // Save to UsersMailboxesSent here...
    }
}