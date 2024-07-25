<?php
// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include required files
require '../plugin/phpmailer/src/Exception.php';
require '../plugin/phpmailer/src/PHPMailer.php';
require '../plugin/phpmailer/src/SMTP.php';

// GET HTML CONTENT
$htmlFilePath = "../include/registermail.html";
$html = file_get_contents($htmlFilePath);

include("database.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $userName = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_SPECIAL_CHARS);
    $emailUser = $_POST['email'];
    $password = $_POST['password'];
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO `user`(`userID`, `userName`, `email`, `password`, `userStatus`, `registrationDate`, `role`) VALUES ('','$userName', '$emailUser', '$hash', DEFAULT , DEFAULT,DEFAULT)";

    try {
        mysqli_query($conn,$sql);
        $status = "4";//4:success

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
        $mail->addAddress($emailUser);

        // Email content
        $mail->isHTML(true);
        $recipientName = ($userName);
        $bookingDate = date('F d, Y');
        $html = str_replace('*|FNAME|*', $recipientName, $html);

        // Subject email         
        $mail->Subject = 'MeetBook Registration Confirmation';
        $mail->Body = $html;
        // $mail->addStringAttachment($pdf_content, "Ticket.pdf");

        // Try sending the email and handle exceptions
        try {
            $mail->send();
            echo 'Email sent successfully';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        header("Location:/meetbook/signin.php?status=$status");
        
    } catch (mysqli_sql_exception) {
        $status = "1";//fail
        header("Location:../signup.php?status=$status");
    }
}

?>
