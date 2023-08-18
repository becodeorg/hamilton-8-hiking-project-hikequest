<?php
declare(strict_types=1);

namespace Models;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP; 

class EmailSender 
{
    public function SendRegConfMail($email, $username)
    {
        $mail = new PHPMailer;
        
        try {
            $mail->SMTPDebug = 3;  
            $mail->isSMTP(); 
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;   
            $mail->Username = "hikequestmail@gmail.com";
            $mail->Password = "oochxflirdmsiysq"; 
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;  
        
            $mail->setFrom('hikequestmail@gmail.com', 'HikeQuest');
            $mail->addAddress($email, $username);
            $mail->isHTML(true);         
            $mail->Subject = "Welcome to hikequest";
            $mail->Body = "<b>Hello, you have successfully been subscribed to HikeQuest, Welcome !</b>";    
    
            if($mail->send()){
                echo 'Email sent successfully';
            }
        } catch (Exception $e) {
            echo 'Email could not be sent. Error: ', $mail->ErrorInfo;
        }
    }
}
