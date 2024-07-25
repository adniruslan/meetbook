<?php
// DATABASE CONNECTION
include("database.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // ternary, 1 IF ISSET, 2 IF !ISSET
    $roomAvailability = isset($_POST['enable_booking']) ? 1 : 2;
    $signupStatus = isset($_POST['enable_signup']) ? 1 : 2;

    // UPDATE SITE SETTING
    $sql_update_setting = "UPDATE `sitesetting` SET `signupStatus`='$signupStatus',`bookingStatus`='$roomAvailability' WHERE id= '1' ";
    // SET ALL ROOM STATUS
    $sql_disable_room = "UPDATE `room` SET `roomAvailability`= '$roomAvailability' ";

    try {
        $result = mysqli_query($conn, $sql_disable_room);
        $result_setting = mysqli_query($conn, $sql_update_setting);
        $status = "1";
        header("Location:/meetbook/admin/settings.php?status=$status");
    } catch (mysqli_sql_exception) {
        $status = "2";
        header("Location:/meetbook/admin/settings.php?status=$status");
    }
}
