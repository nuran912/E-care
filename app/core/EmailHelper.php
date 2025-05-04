<?php

require_once dirname(__DIR__, 2) . '/vendor/autoload.php'; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailHelper
{
    public static function sendEmail($recipientEmail, $recipientName, $subject, $body)
    {
        $mail = new PHPMailer(true);

        try {
            // SMTP Configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; 
            $mail->SMTPAuth = true;
            $mail->Username = 'ecare2digital@gmail.com';  
            $mail->Password = 'yfbv hbnl opyx pksq'; 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('ecare2digital@gmail.com', 'Ecare Union');   //sender
            $mail->addAddress($recipientEmail, $recipientName);     //recipient

            // Email Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AltBody = strip_tags($body); 

            // Send email
            $mail->send();
            return true; 
        } catch (Exception $e) {
            return false; 
        }
    }
}
