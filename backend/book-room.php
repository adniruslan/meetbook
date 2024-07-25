
<?php

// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include required files
require '../plugin/phpmailer/src/Exception.php';
require '../plugin/phpmailer/src/PHPMailer.php';
require '../plugin/phpmailer/src/SMTP.php';

// GET HTML CONTENT
$htmlFilePath = "../include/bookmail.html";
$html = file_get_contents($htmlFilePath);

include("database.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // get input
    $room = filter_input(INPUT_POST, 'room', FILTER_SANITIZE_SPECIAL_CHARS);

    $dom = filter_input(INPUT_POST, 'dom', FILTER_SANITIZE_SPECIAL_CHARS);

    $from =  filter_input(INPUT_POST, 'from', FILTER_SANITIZE_SPECIAL_CHARS);

    $to = filter_input(INPUT_POST, 'to', FILTER_SANITIZE_SPECIAL_CHARS);

    $priority = filter_input(INPUT_POST, 'priority', FILTER_SANITIZE_SPECIAL_CHARS);

    $representative = filter_input(INPUT_POST, 'representative', FILTER_SANITIZE_SPECIAL_CHARS);

    $note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_SPECIAL_CHARS);

    // get room detail
    $sql_room = "SELECT roomName FROM room WHERE roomID = '$room'";
    $resultRoom = mysqli_query($conn, $sql_room);
    if($resultRoom){
        while ($row = mysqli_fetch_assoc($resultRoom)) {
            $roomName = $row['roomName'];
        }
    }

    // check availability
    $sql_check_availability = "SELECT * FROM `roombooking` WHERE `roomID` = '$room' AND bookingDate = '$dom'
    AND (
        ('$from' >= `startTime` AND '$from' < `endTime`) 
        OR ('$to' > `startTime` AND '$to' <= `endTime`)
        OR (`startTime` >= '$from' AND `endTime` <= '$to')
    )";

    try {
        $resultAvailability = mysqli_query($conn, $sql_check_availability);
        if (mysqli_num_rows($resultAvailability) > 0) {
            // 1 = room unavailable
            $status = "1";
            header("Location:/meetbook/booking.php?status=$status");
        } //insert into database
        else {
            $sql = "INSERT INTO `roombooking`(`bookingID`, `userID`, `roomID`, `startTime`, `endTime`, `bookingDate`, `priority`, `remark`) VALUES ('','$representative','$room','$from','$to','$dom','$priority','$note')";

            try {
                mysqli_query($conn, $sql);
                // 2= success
                $status = "2";

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
                $recipientName = ($_POST['userName']);
                $bookingDate = date('F d, Y');
                $html = str_replace('*|FNAME|*', $recipientName, $html);
                $html = str_replace('*|DATE:X|*', $bookingDate, $html);
                $html = str_replace('*|BDATE|*', $dom, $html);
                $html = str_replace('*|STARTTIME|*', $from, $html);
                $html = str_replace('*|ENDTIME|*', $to, $html);
                $html = str_replace('*|ROOM|*', $roomName, $html);

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

                header("Location:/meetbook/booking.php?status=$status");
            } catch (mysqli_sql_exception) {
                //3 = fail insert
                $status = "3";
                header("Location:/meetbook/booking.php?status=$status");
            }
        }
    } catch (mysqli_sql_exception) {

        echo "error";
    }
}

// echo $status;

?>
