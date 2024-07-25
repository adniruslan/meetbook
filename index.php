<?php

// db connection
include("backend/database.php");

// for statistic
include("backend/displayStat.php");

if (!isset($_SESSION['userID'])) {
    header('Location: backend/logout.php');
    exit;
}

// get setting for site, disable bookroom according to setting
$sql_status = "SELECT * FROM `sitesetting` ";
try {
    $result = mysqli_query($conn, $sql_status);
    if (mysqli_num_rows($result) > 0) { //return how many row
        while ($row = mysqli_fetch_assoc($result)) {
            $bookingStatus = $row['bookingStatus'];
        }
    }
} catch (mysqli_sql_exception) {

    echo "no status found";
}

//get user status

$userID = $_SESSION['userID'];
$sql_statusUser = "SELECT * FROM `user` WHERE userID = '$userID' ";
try {
    $result = mysqli_query($conn, $sql_statusUser);
    if (mysqli_num_rows($result) > 0) { //return how many row
        while ($row = mysqli_fetch_assoc($result)) {
            $userStatus = $row['userStatus'];
        }
    }
} catch (mysqli_sql_exception) {

    echo "no status found";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />


    <link rel="stylesheet" href="css/global.css" />
    <link rel="stylesheet" href="css/components/card.css" />
    <link rel="stylesheet" href="css/components/stats.css" />
    <link rel="stylesheet" href="css/components/input.css" />
    <link rel="stylesheet" href="css/components/header.css" />
    <link rel="stylesheet" href="css/components/badge.css" />
    <link rel="stylesheet" href="css/components/button.css" />
    <link rel="stylesheet" href="css/components/heading.css" />
    <link rel="stylesheet" href="css/components/hamburgers.css" />
    <link rel="stylesheet" href="css/layouts/dashboard.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/header.css" />
    <link rel="stylesheet" href="css/alert.css" />



    <script src="https://kit.fontawesome.com/048645d981.js" crossorigin="anonymous"></script>

    <title>Dashboard | Meetbook – Easy Meeting Room Booking</title>

    <style>

    </style>
</head>

<body>
    <div class="header overlap">
        <!-- header -->
        <?php
        include("include/header.php");
        // display alert for booking unavailable
        if ($bookingStatus == 2 || $userStatus != 1) { ?>
            <br>
            <div class="alert-notice">
                <!-- click x icon, set to display none -->
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                We are sorry, room booking is unavailable at the moment.
            </div>

        <?php }
        ?>

        <div class="content">
            <h1>Dashboard</h1>
        </div>
    </div>
    <!-- content -->
    <div class="body overlap">
        <!-- statistic -->
        <div class="stats-container">
            <div class="wrapper">
                <div class="stats">
                    <div class="label">Total Rooms</div>
                    <div class="value"><?php echo $_SESSION["totalRoom"]; ?></div>
                </div>
                <div class="stats">
                    <div class="label">Total Meetings</div>
                    <div class="value"><?php echo $_SESSION["totalBooking"]; ?></div>
                </div>
                <div class="stats">
                    <div class="label">Total Users</div>
                    <div class="value"><?php echo $_SESSION["totalUser"]; ?></div>
                </div>
                <div class="stats">
                    <div class="label">Meetings (<?php echo date("F"); ?>)</div>
                    <div class="value"><?php echo $_SESSION["totalbyMonth"]; ?></div>
                </div>
            </div>
        </div>
        <!-- booking schedule -->
        <div class="content large" style="padding-top: 15px">
            <div class="card timeline">
                <div class="rooms">
                    <div class="head">
                        <h5 class="heading">Rooms</h5>
                        <?php if ($bookingStatus == '1' && $userStatus == '1' ) { ?>
                            <a href="booking.php" class="small white button" id="bookLink">Book Room</a>
                        <?php } else{ ?>
                            <span class="small white button" style="pointer-events: none; opacity: 0.5;"> Book Room</span>

                        <?php } ?>
                    </div>
                    <!-- display room -->
                    <?php include("include/display-room.php") ?>
                </div>
                <div class="content">
                    <div class="time-container">
                        <div class="time">
                            <div>08:00</div>
                        </div>
                        <div class="time">
                            <div>09:00</div>
                        </div>
                        <div class="time">
                            <div>10:00</div>
                        </div>
                        <div class="time">
                            <div>11:00</div>
                        </div>
                        <div class="time">
                            <div>12:00</div>
                        </div>
                        <div class="time">
                            <div>13:00</div>
                        </div>
                        <div class="time">
                            <div>14:00</div>
                        </div>
                        <div class="time">
                            <div>15:00</div>
                        </div>
                        <div class="time">
                            <div>16:00</div>
                        </div>
                        <div class="time">
                            <div>17:00</div>
                        </div>
                        <div class="time">
                            <div>18:00</div>
                        </div>
                        <div class="time">
                            <div>19:00</div>
                        </div>
                        <div class="time">
                            <div>20:00</div>
                        </div>
                    </div>
                    <!-- display booking -->
                    <?php include("include/display-booking.php") ?>
                </div>
            </div>
        </div>

        <!-- responsive-mobile view -->
        <div class="content mobile">
            <div style="display: flex; align-items: center; margin-bottom: 20px">
                <h4 class="heading" style="margin: 0; margin-right: auto">Rooms</h4>
                <a id="bookRoom" class="small white button">Book Room</a>
            </div>

            <!-- fetch all room -->
            <?php $sql_fetch_room = "SELECT * FROM `room`";
            // $currentDate = date("Y-m-d");
            $currentDate = "2023-12-27";

            // create booking table 
            try {
                $resultRoom = mysqli_query($conn, $sql_fetch_room);
                if (mysqli_num_rows($resultRoom) > 0) {
                    while ($row = mysqli_fetch_assoc($resultRoom)) {
                        $roomID = $row['roomID']; ?>
                        <div class="room-group">
                            <h5 class="heading">
                                <?php echo $row['roomName']; ?>
                                <div class="subheading"><?php echo $row['address1']; ?></div>
                            </h5>
                        </div>
                        <?php $sql_booking = "SELECT t1.userID, t1.startTime, t1.endTime, t1.bookingDate, t1.roomID, t2.userName 
                        FROM roombooking as t1 
                        INNER JOIN user as t2 ON t1.userID = t2.userID 
                        WHERE t1.bookingDate = '$currentDate' AND t1.roomID = '$roomID' ";
                        try {
                            $resultBooking = mysqli_query($conn, $sql_booking);
                            if (mysqli_num_rows($resultBooking) > 0) {
                                while ($rowBooking = mysqli_fetch_assoc($resultBooking)) { ?>
                                    <div class="card marked">
                                        <div class="content">
                                            <h6 class="heading">
                                                <div class="kicker"><?php echo $rowBooking['startTime'] . " –" . $rowBooking['endTime'] ?></div>
                                                <?php echo $rowBooking['userName'] ?>
                                            </h6>
                                        </div>
                                    </div>

                                <?php }
                            } else { ?>
                                <!-- for room with no booking  -->
                                <div class="card marked">
                                    <div class="content">
                                        <h6 class="heading">
                                            <div class="kicker"></div>
                                            No Booking for the day
                                        </h6>
                                    </div>
                                </div>

            <?php }
                        } catch (mysqli_sql_exception) {
                            echo "";
                        }
                    }
                }
            } catch (mysqli_sql_exception) {
                echo "no rooms";
            } ?>
        </div>
    </div>
    </div>

    <script>
        function openMenu() {
            var menu = document.getElementById("menu");
            var hamburger = document.getElementById("hamburger");
            if (menu.classList && hamburger.classList) {
                menu.classList.toggle("open");
                hamburger.classList.toggle("is-active");
            }
        }
    </script>
</body>

</html>