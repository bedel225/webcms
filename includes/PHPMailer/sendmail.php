<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require "PHPMailer.php";
require "SMTP.php";
require "Exception.php";

//Create an instance; passing `true` enables exceptions

function sendmail($clientEmail, $subject, $token, $name='username'){
$mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'abdoulrahamanefofana@gmail.com';                     //SMTP username
        $mail->Password   = 'jefptcypaioshflm';                               //SMTP password
        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->CharSet = "utf-8";                                    
    
        //Recipients
        $mail->setFrom('abdoulrahamanefofana@gmail.com', 'webcms');
        $mail->addAddress($clientEmail,$name);     //Add a recipient
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = 'Pour confirmer votre adresse veuillez clicker sur le lien suivant: 
        <a href="http://localhost/WEBCMS/verification.php?token='.$token.'&email='.$clientEmail.'">Confirmation email </a>';
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
