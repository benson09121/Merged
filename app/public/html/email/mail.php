<?php
session_start();
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// $sender_email = $_SESSION['admin_email'] ?? NULL;
// $details = $_POST['emails'] ?? []; // Expecting an array of associative arrays with 'email' and 'message'

// Load Composer's autoloader
require '../../vendor/autoload.php';

// Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;           // Enable verbose debug output
    $mail->isSMTP();                                // Send using SMTP
    $mail->Host       = 'outlook.office365.com';   // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                     // Enable SMTP authentication
    $mail->Username   = 'doms_nud@outlook.com'; // SMTP username
    $mail->Password   = '$$$$AABCfhe8^(#Q@(#NPDOBG#%OD9';           // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable implicit TLS encryption
    $mail->Port       = 587;                  // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    // Recipients
    $mail->setFrom('nud-doms@outlook.com', 'Disciplinary Office');
    $mail->addReplyTo('nud-doms@outlook.com', 'Disciplinary Office');

    foreach ($details as $detail) {
        $recipient_email = $detail['email'];
        $message = $detail['message'];
        $recipient_name = $detail['student_name'] ?? 'Recipient';

        $mail->clearAddresses(); // Clear all addresses for the new recipient
        $mail->addAddress($recipient_email, $recipient_name); // Add each recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Notice to Clear Violation';
        $mail->Body    = $message;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
    }

    echo 'Messages have been sent';
} catch (Exception $e) {
    echo "Messages could not be sent. Mailer Error: {$mail->ErrorInfo}";
}