<?php

include("backend/database.php");
$num_per_page = 5; //set per page how many row


//to get curret page id
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
// set start point to fetch data 
$start_from = ($page - 1) * 5;

// //find total room
$sqlCountRoom = "SELECT * FROM `room`";
try {
    $resulRoom = mysqli_query($conn, $sqlCountRoom);
} catch (mysqli_sql_exception) {
    echo "Could not find user";
}

$totalRoom = mysqli_num_rows($resulRoom); //to calc row

$totalPage = ceil($totalRoom / $num_per_page); //formula to get how many page

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
    <link rel="stylesheet" href="css/components/badge.css" />
    <link rel="stylesheet" href="css/components/input.css" />
    <link rel="stylesheet" href="css/components/header.css" />
    <link rel="stylesheet" href="css/components/button.css" />
    <link rel="stylesheet" href="css/components/heading.css" />
    <link rel="stylesheet" href="css/components/table.css" />
    <link rel="stylesheet" href="css/components/hamburgers.css" />
    <link rel="stylesheet" href="css/layouts/listing.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/header.css" />

    <!-- bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/048645d981.js" crossorigin="anonymous"></script>

    <title>All Rooms | Meetbook – Easy Meeting Room Booking</title>
</head>

<body>
    <div class="header overlap">
        <?php
        // header
        include("include/header.php");

        // alert message
        if (isset($_REQUEST['status'])) {
            if ($_REQUEST['status'] == '1') {
                echo '<div class="container mt-4">';
                echo '<div class="alert alert-success" role="alert">';
                echo "Room successfully added.</div></div>";
            } elseif ($_REQUEST['status'] == '2') {
                echo '<div class="container mt-4">';
                echo '<div class="alert alert-success" role="alert">';
                echo "Room successfully deleted.</div></div>";
            } elseif ($_REQUEST['status'] == '3') {
                echo '<div class="container mt-4">';
                echo '<div class="alert alert-danger" role="alert">';
                echo "Room failed to delete.</div></div>";
            } else {
                echo '';
            }
        }
        ?>
        <div class="content">
            <h1>All Rooms</h1>
        </div>
    </div>

    <!-- content -->
    <div class="body overlap">
        <div class="content">
            <div class="listing card">
                <div class="table-header collapses">
                    <div>
                        <a href="rooms-create.php" class="white small button" role="button">
                            Create Room
                        </a>
                    </div>
                    <!-- pagination button -->
                    <div>
                        <div class="white pagination buttons">
                            <a class="small button"><i class="fas fa-chevron-left"></i></a>
                            <?php
                            for ($i = 1; $i <= $totalPage; $i++) {
                                echo "<a class= 'small button' href = 'rooms.php?page=" . $i . "'>" . $i . "</a> ";
                            } ?>
                            <a class="small button"><i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- table for rooms -->
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 5%">ID</th>
                                <th style="width: 23%">Room Name</th>
                                <th style="width: 25%">Location</th>
                                <th style="width: 15%">Max. Capacity</th>
                                <th colspan="2">Availability</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // display room detail
                            //set limit for each fetch, NUM PER PAGE
                            // get all room, join room with city
                            $sql_fetch_room = "SELECT  room.*, city.stateID
                            FROM room
                            JOIN city ON room.cityID = city.cityID
                            LIMIT $start_from, $num_per_page";
                            try {
                                $resultRoom = mysqli_query($conn, $sql_fetch_room);
                                if (mysqli_num_rows($resultRoom) > 0) {
                                    $count = 0;
                                    while ($row = mysqli_fetch_assoc($resultRoom)) {
                                        $count++;
                            ?>

                                        <?php
                                        if ($row['roomAvailability'] == 1) {
                                        ?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td><?php echo $row['roomName']; ?></td>
                                                <td><?php echo $row['address1']; ?></td>
                                                <td><?php echo $row['maxCapacity']; ?> pax</td>
                                                <td> <span class='small green badge'> AVAILABLE</span></td>
                                                <td class="action">
                                                    <a href="rooms-edit.php?id=<?php echo $row['roomID']; ?>&state=<?php echo $row['stateID']; ?>&city=<?php echo $row['cityID']; ?>">Edit</a>
                                                    <a href="<?php echo $row['roomID']; ?>" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo $row['roomID']; ?>" id="deletelink" class="deleteLink" id="deleteLink">Delete</a>
                                                </td>
                                            </tr>
                                        <?php } else { ?>
                                            <tr class=" red">
                                                <td><?php echo $count; ?></td>
                                                <td><?php echo $row['roomName']; ?></td>
                                                <td><?php echo $row['address1']; ?></td>
                                                <td><?php echo $row['maxCapacity']; ?> pax</td>
                                                <td><span class="red small badge">Unavailable</span></td>
                                                <td class="action">
                                                    <a href="rooms-edit.php?id=<?php echo $row['roomID']; ?>&state=<?php echo $row['stateID']; ?>&city=<?php echo $row['cityID']; ?>">Edit</a>
                                                    <a href="<?php echo $row['roomID']; ?>" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo $row['roomID']; ?>" id="deletelink" class="deleteLink" id="deleteLink">Delete</a>
                                                </td>
                                            </tr>

                            <?php }
                                    }
                                } else {
                                    echo "Could not find room";
                                }
                            } catch (mysqli_sql_exception) {
                                echo "Could not find room";
                            }

                            ?>

                        </tbody>
                    </table>
                </div>
                <div class="table-footer">
                    <div>Showing <b> 5 </b> of <b><?php echo $totalRoom ?> rooms</b></div>
                    <!-- PAGINATION BUTTON -->
                    <div>
                        <div class="white pagination buttons">
                            <a class="small button"><i class="fas fa-chevron-left"></i></a>
                            <?php
                            for ($i = 1; $i <= $totalPage; $i++) {
                                echo "<a class= 'small button' href = 'rooms.php?page=" . $i . "'>" . $i . "</a> ";
                            } ?>
                            <a class="small button"><i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- pop up notifcation for delete -->
    <?php include("include/pop-up-room.php"); ?>

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