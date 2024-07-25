
<?php
// DATABASE CONNECTION
include("database.php");

// GET POST VALUE
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $room = filter_input(INPUT_POST, 'room', FILTER_SANITIZE_SPECIAL_CHARS);

    $dom = filter_input(INPUT_POST, 'dom', FILTER_SANITIZE_SPECIAL_CHARS);


    $from =  filter_input(INPUT_POST, 'from', FILTER_SANITIZE_SPECIAL_CHARS);

    $to = filter_input(INPUT_POST, 'to', FILTER_SANITIZE_SPECIAL_CHARS);

    $priority = filter_input(INPUT_POST, 'priority', FILTER_SANITIZE_SPECIAL_CHARS);

    $representative = filter_input(INPUT_POST, 'representative', FILTER_SANITIZE_SPECIAL_CHARS);

    $note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_SPECIAL_CHARS);

    
    // CHECK ROOM AVAILABILITY
    $sql_check_availability = "SELECT * FROM `roombooking` WHERE `roomID` = '$room' AND bookingDate = '$dom'
    AND (
        ('$from' >= `startTime` AND '$from' < `endTime`) 
        OR ('$to' > `startTime` AND '$to' <= `endTime`)
        OR (`startTime` >= '$from' AND `endTime` <= '$to')
    )";

    try {
        // IF UNAVAILABLE
        $resultAvailability = mysqli_query($conn, $sql_check_availability);
        if (mysqli_num_rows($resultAvailability) > 0) {
           // 1 = room unavailable
            $status = "1"; 
            header("Location:/meetbook/admin/booking.php?status=$status");
            
        } 
        // IF AVAILABLE INSERT BOOKING
        else {
            $sql = "INSERT INTO `roombooking`(`bookingID`, `userID`, `roomID`, `startTime`, `endTime`, `bookingDate`, `priority`, `remark`) VALUES ('','$representative','$room','$from','$to','$dom','$priority','$note')";

            try {
                mysqli_query($conn, $sql);
                // 2= success
                $status = "2"; 
                header("Location:/meetbook/admin/booking.php?status=$status");

            } catch (mysqli_sql_exception) {
                //3 = fail insert
                $status = "3"; 
                header("Location:/meetbook/admin/booking.php?status=$status");
            }
        }
    } catch (mysqli_sql_exception) {

        echo "error";
    }
}

?>