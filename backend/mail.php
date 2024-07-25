<?php

// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include required files
require '../plugin/phpmailer/src/Exception.php';
require '../plugin/phpmailer/src/PHPMailer.php';
require '../plugin/phpmailer/src/SMTP.php';

// Load HTML content from bookmail.html
$htmlFilePath = "../include/bookmail.html";
$html = file_get_contents($htmlFilePath);

if (isset($_POST["send"])) {
    // Create PHPMailer instance
    $mail = new PHPMailer(true);

    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'youremail@gmail.com';
    $mail->Password   = 'iidhpsgntzgsbawd';
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;

    // Sender email & name
    $mail->setFrom('youremail@gmail.com', 'meetbook');

    // Recipient email
    $mail->addAddress($_POST['email']);

    // Email content
    $mail->isHTML(true);
    $recipientName = '';
    $bookingDate = date('F d, Y');
    $html = str_replace('*|FNAME|*', $recipientName, $html);
    $html = str_replace('*|DATE:X|*', $bookingDate, $html);

    // Subject email         
    $mail->Subject = 'MeetBook Booking Confirmation';
    $mail->Body = $html;
    // $mail->addStringAttachment($pdf_content, "Ticket.pdf");

    // Try sending the email and handle exceptions
    try {
        $mail->send();
        echo 'Email sent successfully';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
