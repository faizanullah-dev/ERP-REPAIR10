<?php

namespace App\Http\Controllers;

use App\UserMailSend;
use App\UsersMailboxConfiguration;
use Illuminate\Http\Request;
use Webklex\IMAP\Facades\Client;
use Webklex\PHPIMAP\ClientManager;

class EmailCronJobController extends Controller
{
    public function fetchUserSeenEmailsCronJob()
    {
            $usersData = UsersMailboxConfiguration::get();
            foreach ($usersData as $uk => $userData) {
                    $config = [
                        'host' => $userData->mail_host,
                        'port' => $userData->mail_port,
                        'encryption' => $userData->mail_encryption_type,
                        'validate_cert' => true,
                        'username' => $userData->mail_username,
                        'password' => $userData->password,
                    ];
                    $clientManager = new ClientManager();
                    $client = $clientManager->make($config);
                    $client->connect();
                    $folder = $client->getFolder('INBOX');
                    $emails = $folder->query()->unseen()->get();
                    foreach ($emails as $email) {
                        if ($email->getUid() != null) {
                            $userDataUID = UserMailSend::where('user_id', $userData->id)->pluck('uid')->toArray();
                            if (!in_array($email->getUid(), $userDataUID)) {
                                $UsersMailboxes = UserMailSend::create([
                                    'user_id' => $userData->user_id,
                                    'subject' => $email->getSubject(),
                                    'name' => rtrim(preg_replace('/^"/', '', ucwords((string)@$email->getFrom()[0]->personal)), '"'),
                                    'from' => $email->getFrom()[0]->mail,
                                    'to' => $email->getTo(),
                                    'cc' => $email->getCc(),
                                    'bcc' => $email->getBcc(),
                                    'configuration_email' => $userData->mail_username,
                                    'message' => $email->getHTMLBody(true),
                                    'date' => $email->getDate(),
                                    'is_seen' => 1,
                                    'uid' => $email->getUid() ?? 0,
                                ]);
                            }//end if
                        }//end if
                    }//end foreach
            }
            echo 'Email fetching successful.';
    }//function fetchUserSeenEmailsCronJob
    public function fetchUserUnSeenEmailsCronJob(){
        $usersData = UsersMailboxConfiguration::get();
        foreach ($usersData as $uk => $userData) {
            $config = [
                'host' => $userData->mail_host,
                'port' => $userData->mail_port,
                'encryption' => $userData->mail_encryption_type,
                'validate_cert' => true,
                'username' => $userData->mail_username,
                'password' => $userData->password,
            ];
            $clientManager = new ClientManager();
            $client = $clientManager->make($config);
            $client->connect();

            $folder = $client->getFolder('INBOX');
            $emails = $folder->query()->seen()->get();
            foreach ($emails as $email) {
                if ($email->getUid() != null) {
                    $userDataUID = UserMailSend::where('user_id', $userData->id)->pluck('uid')->toArray();
                    if (!in_array($email->getUid(), $userDataUID)) {
                        $UsersMailboxes = UserMailSend::create([
                            'user_id' => $userData->user_id,
                            'subject' => $email->getSubject(),
                            'name' => rtrim(preg_replace('/^"/', '', ucwords((string)@$email->getFrom()[0]->personal)), '"'),
                            'from' => $email->getFrom()[0]->mail,
                            'to' => $email->getTo(),
                            'cc' => $email->getCc(),
                            'configuration_email' => $userData->mail_username,
                            'bcc' => $email->getBcc(),
                            'message' => $email->getHTMLBody(true),
                            'date' => $email->getDate(),
                            'is_seen' => 1,
                            'uid' => $email->getUid() ?? 0,
                        ]);
                    }//end if
                }//end if
            }//end foreach
        }
        echo 'Email fetching successful.';
    }//end fetchUserUnSeenEmailsCronJob function.
}//end class.
