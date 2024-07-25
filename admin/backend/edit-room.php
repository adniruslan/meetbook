
<?php
// DATABASE CONNECTION
include("database.php");
// RETRIEVE POST VALUE
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $roomID = filter_input(INPUT_POST, 'roomID', FILTER_SANITIZE_SPECIAL_CHARS);
    $stateID = filter_input(INPUT_POST, 'stateID', FILTER_SANITIZE_SPECIAL_CHARS);
    $roomName = filter_input(INPUT_POST, 'roomName', FILTER_SANITIZE_SPECIAL_CHARS);

    $address1 = filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_SPECIAL_CHARS);

    $address2 = filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_SPECIAL_CHARS);

    $poscode = filter_input(INPUT_POST, 'poscode', FILTER_SANITIZE_SPECIAL_CHARS);

    $cityID = filter_input(INPUT_POST, 'cityID', FILTER_SANITIZE_SPECIAL_CHARS);

    $minCapacity = filter_input(INPUT_POST, 'minCapacity', FILTER_SANITIZE_NUMBER_INT);

    $maxCapacity = filter_input(INPUT_POST, 'maxCapacity', FILTER_SANITIZE_NUMBER_INT);

    // CHECK ROOMAVAIBALITY
    if (isset($_POST['enableDisable'])) {
        $roomAvailability = '1';
    } else {
        $roomAvailability = '2';
    }

    // UPDATE ROOM
    $sql = "UPDATE `room` SET `roomName`='$roomName',`address1`='$address1',`address2`='$address2',`poscode`='$poscode',`minCapacity`='$minCapacity',`maxCapacity`='$maxCapacity',`roomAvailability`='$roomAvailability',`cityID`='$cityID' WHERE roomName = '$roomName' ";

    try {
        mysqli_query($conn, $sql);
        $status = "1";
    } catch (mysqli_sql_exception) {
        $status = "2";
    }


    header("Location:/meetbook/admin/rooms-edit.php?id=$roomID&state=$stateID&city=$cityID&status=$status");
}


?>