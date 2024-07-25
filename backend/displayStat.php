<?php

// session_start();

// //fetch room detail
// include("database.php");
$sql_fetch_room = "SELECT * FROM `room`";

// count room
try {
    $resultRoom = mysqli_query($conn, $sql_fetch_room);
    if (mysqli_num_rows($resultRoom) > 0) {
        $totalRoom = mysqli_num_rows($resultRoom);
        $_SESSION["totalRoom"] = $totalRoom;
    } else {
        echo "Could not find room";
    }
} catch (mysqli_sql_exception) {
    echo "Could not find room";
}

//count booking

$sql_count_booking = "SELECT *FROM roombooking";
try {
    $resultBooking = mysqli_query($conn, $sql_count_booking);
    $totalBooking = mysqli_num_rows($resultBooking);

    $_SESSION["totalBooking"] = $totalBooking;
} catch (mysqli_sql_exception) {
    echo "Could not find total meeting";
}

//count user
$sql_count_user = "SELECT *FROM user";
try {
    $resultUser = mysqli_query($conn, $sql_count_user);
    $totalUser = mysqli_num_rows($resultUser);

    $_SESSION["totalUser"] = $totalUser;
} catch (mysqli_sql_exception) {
    echo "Could not find total meeting";
}

//count booking/month

$currentMonth = date("F");

$sql_count_byMonth = "SELECT *from roombooking where monthname(bookingDate)='$currentMonth'";
try {
    $resultbyMonth = mysqli_query($conn, $sql_count_byMonth);


    $totalbyMonth = mysqli_num_rows($resultbyMonth);

    $_SESSION["totalbyMonth"] = $totalbyMonth;
} catch (mysqli_sql_exception) {
    echo "Could not find total meeting";
}
