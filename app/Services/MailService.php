<?php
/**
 * Created by PhpStorm.
 * User: student
 * Date: 20.03.2019
 * Time: 20:02
 */

namespace app\Services;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

class MailService
{
    private $mail;
    private $usermail;

    public function __construct($user_mail)
    {
        $this->mail = new PHPMailer(true);
        $this->usermail=$user_mail;
    }

    public function sendMail(){
        try {
            //Server settings
            $this->mail->SMTPDebug = 2;                                       // Enable verbose debug output
            $this->mail->isSMTP();                                            // Set mailer to use SMTP
            $this->mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $this->mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $this->mail->Username   = 'myblogtestemail@gmail.com';                     // SMTP username
            $this->mail->Password   = 'testemail';                               // SMTP password
            $this->mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
            $this->mail->Port       = 587;                                    // TCP port to connect to

            //Recipients
            $this->mail->setFrom('myblogtestemail@gmail.com', 'Mailer');
            $this->mail->addAddress($this->usermail, 'User');     // Add a recipient
            $this->mail->addReplyTo('myblogtestemail@gmail.com', 'Information');

            // Content
            $this->mail->isHTML(true);                                  // Set email format to HTML
            $this->mail->Subject = 'Here is the subject';
            $this->mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $this->mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }

}