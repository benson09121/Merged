<?php
session_start();
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$sender_email = $_SESSION['admin_email'] ?? NULL;
$recipient_email = $_POST['email'] ?? NULL;
$recipient_name = $_POST['name'] ?? NULL;
$message = $_POST['message'] ?? NULL;

//Load Composer's autoloader
require '../../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail -> SMTPDebug = 3;
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;           //Enable verbose debug output
    $mail->isSMTP();                                //Send using SMTP
    $mail->Host       = 'outlook.office365.com';   //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                     //Enable SMTP authentication
    $mail->Username   = 'nud-doms@outlook.com'; //SMTP username
    $mail->Password   = 'Doms-nud2024';           //SMTP password
    $mail->SMTPSecure = 'STARTTLS';            //Enable implicit TLS encryption
    $mail->Port       = 587;                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('nud-doms@outlook.com', 'Disciplinary Office');
    $mail->addAddress($recipient_email, 'Recipeint');     //Add a recipient
   // $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('nud-doms@outlook.com', 'Disciplinary Office');
    //$mail->addCC('cc@example.com');
   // $mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Notice to Clear Violation';
    $mail->Body    = $message;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}