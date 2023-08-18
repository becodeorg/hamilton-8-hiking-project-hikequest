<?php
declare(strict_types=1);

namespace Controllers;

use Exception;
use Models\EmailSender;

class MailController
{
    public function SendMailConfirmation (string $email, string $username) {
        try {
            $newMail = (new EmailSender())->SendRegConfMail( $email, $username);
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
}


