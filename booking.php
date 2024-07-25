<?php
// db connection
include("backend/database.php");

// retrieve userID
$userID = $_SESSION['userID'];

// fx to loop time option
function displayTime($start, $end, $interval = 1)
{
    while ($start <= $end) {
        // add leading 0
        $formattedStart = sprintf('%02d', $start);
        echo "<option value='{$formattedStart}:00:00' id='{$start}'>{$formattedStart}:00:00</option>";
        $start += $interval;
    }
}

// get the username of user
$sqlUser = "SELECT * FROM user WHERE userID = '$userID' ";
try {
    $resultUser = mysqli_query($conn, $sqlUser);
    if (mysqli_num_rows($resultUser) > 0) {
        while ($rowUser = mysqli_fetch_assoc($resultUser)) {
            $userName = $rowUser['userName'];
            $email = $rowUser['email'];
        }
    }
} catch (mysqli_sql_exception $e) {
    echo "please login first";
}

// check month of the calendar

// if not current month
if (isset($_REQUEST['nextmonth'])) {
    $nextmonth = $_REQUEST['nextmonth'];
    // retrieve date detail
    $month = date("F", strtotime($nextmonth));
    $monthNumeric = date("m", strtotime($nextmonth));
    $year = date("Y", strtotime($nextmonth));
    $currentDay = date("j");
    $daysPerMonth = date("t", strtotime($nextmonth));
    $dayAlphabetic = date("N", strtotime($nextmonth));
    $yearMonth = date("Y-m", strtotime($nextmonth));

    // get the day in the week of the 1st day in the month
    $startDayOfMonth = "{$year}-{$monthNumeric}-1";
    $dayofweek = date('w', strtotime($startDayOfMonth));

    // get total week 
    $totalWeek = ceil($daysPerMonth / 7);
} else {  //for current month
    // retrieve date detail
    $month = date("F");
    $monthNumeric = date("m");
    $year = date("Y");
    $currentDay = date("j");
    $daysPerMonth = date("t");
    $dayAlphabetic = date("N");
    $yearMonth = date("Y-m");

    // get the day in the week of the 1st day in the month
    $startDayOfMonth = "{$year}-{$monthNumeric}-1";
    $dayofweek = date('w', strtotime($startDayOfMonth));

    // get total week 
    $totalWeek = ceil($daysPerMonth / 7);
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
    <link rel="stylesheet" href="css/components/calendar.css" />
    <link rel="stylesheet" href="css/layouts/booking.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/header.css" />
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    <!-- bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/048645d981.js" crossorigin="anonymous"></script>

    <title>Book Room | Meetbook – Easy Meeting Room Booking</title>
</head>

<body <?php if (date("Y-m") == "{$year}-{$monthNumeric}") { ?> onload="disableDay()" <?php } ?>>
    <div class="header overlap">

        <?php
        // header
        include("include/header.php");

        // display status alert 
        if (isset($_REQUEST['status'])) {
            if ($_REQUEST['status'] == '1') {
                echo '<div class="container mt-4">';
                echo '<div class="alert alert-warning" role="alert">';
                echo "Room unavailable on the selected time</div></div>";
            } elseif ($_REQUEST['status'] == '3') {
                echo '<div class="container mt-4">';
                echo '<div class="alert alert-warning" role="alert">';
                echo "Fail to book the room Check the form again.</div></div>";
            } elseif (isset($_REQUEST['status'])) {
                if ($_REQUEST['status'] == '2') {
                    echo '<div class="container mt-4">';
                    echo '<div class="alert alert-success" role="alert">';
                    echo "Room successfully booked</div></div>";
                }
            }
        }

        ?>
        <div class="content">
            <h1>Book Room</h1>
        </div>
    </div>
    <!-- content -->
    <div class="body overlap">
        <div class="content">
            <form action="backend/book-room.php" method="post">
                <div class="booking card">
                    <div class="content">
                        <div>
                            <div class="field">
                                <label for="room">Room</label>
                                <div class="select"> <!-- display selection of room from db -->
                                    <select name="room" id="room" placeholder="Select a Room" required>
                                        <?php
                                        $sqlRoom = "SELECT * FROM `room` WHERE roomAvailability = '1' ";
                                        try {
                                            $resultRoom = mysqli_query($conn, $sqlRoom);
                                            if (mysqli_num_rows($resultRoom) > 0) {
                                                while ($row = mysqli_fetch_assoc($resultRoom)) {
                                                    echo "<option value='{$row['roomID']}'>{$row['roomName']}</option>";
                                                }
                                            } else {
                                                echo "<option>No Room available at the moment</option>";
                                            }
                                        } catch (mysqli_sql_exception) {
                                            echo "error";
                                        } ?>
                                    </select>
                                    <label for="room" class="fa fa-caret-down"></label>
                                </div><!-- display selection of room from db -->
                            </div>

                            <div class="calendar" style="margin-bottom: 20px">
                                <!-- display month -->
                                <div class="month">
                                    <!-- prev month buttoj -->
                                    <?php
                                    if (strtotime("{$year}-{$monthNumeric}") > strtotime(date("Y-m"))) { ?>
                                        <a href="booking.php?nextmonth=<?php echo date('Y-m', strtotime($yearMonth . ' -1 month')); ?>" disabled><i class='fas fa-angle-left' style="color: black;font-size:15px;"></i></a>
                                    <?php } ?>
                                    <!-- month name -->
                                    <?php echo $month . " " . $year; ?>
                                    <!-- next month button -->
                                    <a href="booking.php?nextmonth=<?php echo date('Y-m', strtotime($yearMonth . ' +1 month')); ?>"><i class='fas fa-angle-right' style="color: black;font-size:15px;"></i></a>
                                </div>
                                <div class="dow">
                                    <div>Mon</div>
                                    <div>Tue</div>
                                    <div>Wed</div>
                                    <div>Thu</div>
                                    <div>Fri</div>
                                    <div>Sat</div>
                                    <div>Sun</div>

                                </div>
                                <!-- CALENDAR START -->
                                <div class="dom">

                                    <!-- First week -->
                                    <div class="week">
                                        <?php
                                        $countDiv = 0;
                                        $countLabel = 0;

                                        if ($dayofweek == 1) {
                                            $countDiv = 7;
                                        } elseif ($dayofweek == 2) {
                                            $countDiv = 6;
                                            $countLabel = 1;
                                        } elseif ($dayofweek == 3) {
                                            $countDiv = 5;
                                            $countLabel = 2;
                                        } elseif ($dayofweek == 4) {
                                            $countDiv = 4;
                                            $countLabel = 3;
                                        } elseif ($dayofweek == 5) {
                                            $countDiv = 3;
                                            $countLabel = 4;
                                        } elseif ($dayofweek == 6) {
                                            $countDiv = 2;
                                            $countLabel = 5;
                                        } elseif ($dayofweek == 0) {
                                            $countDiv = 1;
                                            $countLabel = 6;
                                        }

                                        // display <label> according to countlabel
                                        for ($i = 0; $i < $countLabel; $i++) {
                                            echo "<label for=''></label>";
                                        }


                                        // display radio input according to countdiv
                                        $num = 1;
                                        for ($x = 0; $x < $countDiv; $x++) {
                                            $bookDate = "{$year}-{$monthNumeric}-{$num}";

                                        ?>
                                            <input type="radio" name="dom" id="d_<?php echo $num; ?>" value="<?php echo $bookDate ?>" required />
                                            <label for="d_<?php echo $num; ?>" class="" id="l_<?php echo $num; ?>"><?php echo $num; ?></label>
                                        <?php
                                            $num++;
                                        } ?>
                                    </div><!--end display for 1st week-->

                                    <!-- display calendar for the rest of week -->
                                    <?php
                                    for ($i = 1; $i < ($totalWeek - 1); $i++) {
                                    ?>
                                        <div class="week">
                                            <?php
                                            for ($x = 0; $x < 7; $x++) {
                                                $bookDate = "{$year}-{$monthNumeric}-{$num}";
                                            ?>
                                                <input type="radio" name="dom" id="d_<?php echo $num; ?>" value="<?php echo $bookDate ?>" required />
                                                <label for="d_<?php echo $num; ?>" class="" id="l_<?php echo $num; ?>"><?php echo $num; ?></label>
                                            <?php
                                                $num++;
                                            }
                                            ?>
                                        </div>
                                    <?php
                                    }
                                    ?><!-- end display  for the rest of week -->

                                    <!-- last week calendar -->
                                    <div class="week">
                                        <?php
                                        $countDiv = 0;
                                        $countLabel = 0;

                                        // get balance days left 
                                        $balanceDiv = ($daysPerMonth - $num) + 1;

                                        if ($balanceDiv == 7) {
                                            $countDiv = 7;
                                        } elseif ($balanceDiv == 6) {
                                            $countDiv = 6;
                                            $countLabel = 1;
                                        } elseif ($balanceDiv == 5) {
                                            $countDiv = 5;
                                            $countLabel = 2;
                                        } elseif ($balanceDiv == 4) {
                                            $countDiv = 4;
                                            $countLabel = 3;
                                        } elseif ($balanceDiv == 3) {
                                            $countDiv = 3;
                                            $countLabel = 4;
                                        } elseif ($balanceDiv == 2) {
                                            $countDiv = 2;
                                            $countLabel = 5;
                                        } elseif ($balanceDiv == 1) {
                                            $countDiv = 1;
                                            $countLabel = 6;
                                        }

                                        for ($x = 0; $x < $countDiv; $x++) {
                                            $bookDate = "{$year}-{$monthNumeric}-{$num}";

                                        ?>
                                            <input type="radio" name="dom" id="d_<?php echo $num; ?>" value="<?php echo $bookDate; ?>" required />
                                            <label for="d_<?php echo $num; ?>" class="" id="l_<?php echo $num; ?>"><?php echo $num; ?></label>
                                        <?php
                                            $num++;
                                        }

                                        for ($i = 0; $i < $countLabel; $i++) {
                                            echo "<label for=''></label>";
                                        } ?>
                                    </div> <!--end last week calendar -->

                                </div> <!-- end of calendar -->
                            </div>
                            <div class="fields-split">
                                <!-- start time -->
                                <div class="field">
                                    <label for="from">From</label>
                                    <div class="select">
                                        <select name="from" id="from" onchange="endTime()">
                                            <?php displayTime(8, 19); ?>
                                        </select>
                                        <label for="from" class="fa fa-caret-down"></label>
                                    </div>
                                </div>
                                <!-- end time -->
                                <div class="field">
                                    <label for="to">To</label>
                                    <div class="select">
                                        <select name="to" id="to">
                                            <?php displayTime(9, 19); ?>

                                        </select>
                                        <label for="to" class="fa fa-caret-down"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="fields-split">
                                <!-- booking priority -->
                                <div class="field">
                                    <label for="priority">Priority</label>
                                    <div class="select">
                                        <select name="priority" id="priority" required>
                                            <option value="1" selected>Normal</option>
                                            <option value="2">Important</option>
                                            <option value="3">Urgent</option>
                                        </select>
                                        <label for="priority" class="fa fa-caret-down"></label>
                                    </div>
                                    <label for="priority" class="guide">
                                        Mark the meeting as normal, important or urgent.
                                    </label>
                                </div>
                                <!-- representative -->
                                <div class="field">
                                    <label for="representative">Representative</label>
                                    <div class="select">
                                        <select name="representative" id="representative" required>
                                            <option value="<?php echo $userID; ?>"><?php echo $userName; ?></option>
                                        </select>
                                        <label for="representative" class="fa fa-caret-down"></label>
                                        <input type="hidden" name="email" value="<?php echo $email; ?>">
                                        <input type="hidden" name="userName" value="<?php echo $userName; ?>">
                                    </div>
                                    <label for="representative" class="guide">
                                        Set the person in charge for this room.
                                    </label>
                                </div>
                            </div>
                            <!-- remark/note -->
                            <div class="field">
                                <label for="note">Note</label>
                                <textarea id="note" name="note" placeholder="Write reasons for booking.."></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- submit btn -->
                    <div class="card-footer right">
                        <button class="green button">Book Room</button>
                    </div>
                </div>
            </form>
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

        // fx to disable previous day
        function disableDay() {

            var currentdate = "<?php echo $currentDay; ?>";
            // highlight today
            var getID = document.getElementById('l_' + currentdate);
            getID.classList.add("today");
            // disable the previous day
            for (var i = 0; i < currentdate - 1; i++) {
                var date = i + 1;
                document.getElementById("d_" + date).disabled = true;

            }
        }

        // functiom to display selection for endTime
        function endTime() {
            // get the select 
            var select = document.getElementById('to');

            // clear prev option
            select.innerHTML = " ";
            // get value of start booking time
            var startValue = document.getElementById('from').value;
            // convert to date format
            var startTime = new Date('1970-01-01T' + startValue);

            // set limit for end time
            var endValue = new Date('1970-01-01T19:00:00');

            while (startTime <= endValue) {
                // add 1 hour interval
                startTime = new Date(startTime.getTime());
                startTime.setHours(startTime.getHours() + 1);

                // create option
                // toLocalTimeString = get time portion of a date , string form
                // en-us :   American English./ if remove en us, use user environment, maybe 12 or 24 format
                var options = document.createElement('option');
                options.value = startTime.toLocaleTimeString('en-US', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                    hour12: false
                });
                options.innerHTML = startTime.toLocaleTimeString('en-US', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                    hour12: false
                });
                // append option
                select.appendChild(options);


            }
        }
    </script>
</body>

</html>