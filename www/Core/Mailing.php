<?php

namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require __DIR__  . '/vendor/autoload.php';


class Mailing
{

    private $mail;
    private $subject;
    private $body;
    private $recipent;


    private function __construct()
    {
        $this->mail = new PHPMailer(true);
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }

    public function getBody()
    {
        return $this->body;
    }


    public static function sendMail($email)
    {

       $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'pharaonpapyrus1@gmail.com';
            $mail->Password = '1AQW&aqw';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('contact@adamagassama.com', 'Service Informatique');
            $mail->addAddress($email);
            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Nouvel Utilisateur';
            $mail->Body    = 'Bonjour un nouveau compte vient dêtre créé pour vous !!!';
            $mail->send();
            echo 'Message envoyé ';
        } catch (Exception $e) {
            echo "Message ne pas être envoyé. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}