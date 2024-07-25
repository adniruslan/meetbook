<div class="rows">
    <?php
    // set how many pixel per hour
    $pixel_per_hour = 75;

    // get current date
    // $currentDate = "2023-12-27";
    $currentDate = date("Y:m:d");

    // fetch all room
    $sql_fetch_room = "SELECT * FROM `room`";
    try {
        $resultRoom = mysqli_query($conn, $sql_fetch_room);
        if (mysqli_num_rows($resultRoom) > 0) {
            while ($row = mysqli_fetch_assoc($resultRoom)) {
                // create div for the room
                echo "<div class='row' style='width: 780px'>";
                $roomID = $row['roomID'];

                // get all booking detail for the room on the current date
                $sql_next_booking = "SELECT t1.startTime, t1.endTime, t2.userName, t2.userID 
                FROM roombooking as t1 
                INNER JOIN user as t2 ON t1.userID = t2.userID
                WHERE t1.roomID = '$roomID' AND t1.bookingDate = '$currentDate' 
                ORDER BY t1.startTime";
                
                $resultNext = mysqli_query($conn, $sql_next_booking);

                // initialize prev end time
                $prevEndTime = "08:00:00";

                while ($bookingRow = mysqli_fetch_assoc($resultNext)) {
                    // set starttime and endtime
                    $startTimestamp = strtotime($bookingRow['startTime']);
                    $endTimestamp = strtotime($bookingRow['endTime']);

                    // calculate duration empty gap
                    $durationInHours = ($startTimestamp - strtotime($prevEndTime)) / 3600;

                    // create empty gap div
                    $width = $durationInHours * $pixel_per_hour;
                    echo "<div class='empty-unit' style='width: {$width}px;'></div>";

                    // calculate duration booking
                    $durationInHours = ($endTimestamp - $startTimestamp) / 3600;

                    // create booking div
                    $width = ceil($durationInHours) * $pixel_per_hour;
                    echo "<div class='unit' style='width: {$width}px;'>{$bookingRow['userName']}</div>";

                    // update prevEndTime for the next iteration
                    $prevEndTime = $bookingRow['endTime'];
                }

                // generate empty gap after the last booking
                if (strtotime($prevEndTime) < strtotime("20:00:00")) {
                    $durationInHours = (strtotime("20:00:00") - strtotime($prevEndTime)) / 3600;
                    $width = ceil($durationInHours) * $pixel_per_hour;
                    echo "<div class='empty-unit' style='width: {$width}px;'></div>";
                }

                echo "</div>";
            }
        } else {
            echo "No rooms found.";
        }
    } catch (mysqli_sql_exception) {
        echo "Error fetching data.";
    }
    ?>
</div>