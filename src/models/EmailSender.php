<?php
declare(strict_types=1);

namespace Models;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP; 

class EmailSender 
{
    public function sendMail($email, $username, $subject, $body)
    {
        $mail = new PHPMailer;
        
        try {
            $mail->isSMTP(); 
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;   
            $mail->Username = "hikequestmail@gmail.com";
            $mail->Password = "oochxflirdmsiysq"; 
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;  

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception('Invalid email address');
            }
        
            $mail->setFrom('hikequestmail@gmail.com', 'HikeQuest');
            $mail->addAddress($email, $username);
            $mail->isHTML(true);         
            $mail->Subject = $subject;
            $mail->Body = "<b>" . htmlspecialchars($body) . "</b>";    
        
            if($mail->send()){
                echo 'Email sent successfully';
            }
        } catch (Exception $e) {
            echo 'Email could not be sent. Error: ', $mail->ErrorInfo;
        }
    }
}
