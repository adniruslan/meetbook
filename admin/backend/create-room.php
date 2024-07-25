
<?php
// DATABASE CONNECTION
include("database.php");
// GET POST VALUE
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $roomName = filter_input(INPUT_POST, 'roomName', FILTER_SANITIZE_SPECIAL_CHARS);

    $address1 = filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_SPECIAL_CHARS);

    $address2 =  filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_SPECIAL_CHARS);

    $poscode = filter_input(INPUT_POST, 'poscode', FILTER_SANITIZE_SPECIAL_CHARS);

    $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_SPECIAL_CHARS);

    $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_SPECIAL_CHARS);

   
    // INSERT ROOM
    $sql_insert = "INSERT INTO `room`(`roomID`, `roomName`, `address1`, `address2`, `poscode`, `minCapacity`, `maxCapacity`, `roomAvailability`, `cityID`) VALUES ('','$roomName','$address1','$address2','$poscode', DEFAULT,DEFAULT,DEFAULT,'$city')";
    try {
        $result = mysqli_query($conn, $sql_insert);
        $status = "1";
        header("Location:/meetbook/admin/rooms.php?status=$status");


    } catch (mysqli_sql_exception) {
        $status = "2";
         header("Location:/meetbook/admin/rooms-create.php?status=$status");                
        
    }
}



?>