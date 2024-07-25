<?php
// DATABASE CONNECTION
include("backend/database.php");
//set per page how many row
$num_per_page = 5;


//to get curret page id
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

// SET START POINT OF EACH PAGE
$start_from = ($page - 1) * 5;

//find total user
$sqlCountUser = "SELECT * FROM `user`";
try {
    $resulCount = mysqli_query($conn, $sqlCountUser);
} catch (mysqli_sql_exception) {
    echo "Could not find user";
}

$totalUser = mysqli_num_rows($resulCount); //to calc row

$totalPage = ceil($totalUser / $num_per_page); //formula to get how many page

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

    <script src="https://kit.fontawesome.com/048645d981.js" crossorigin="anonymous"></script>

    <!-- bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>All Users | Meetbook – Easy Meeting Room Booking</title>
</head>

<body>
    <!-- HEADER -->
    <div class="header overlap">
        <!-- ALERT MESSAGE -->
        <?php
        include("include/header.php");
        if (isset($_REQUEST['status'])) {
            if ($_REQUEST['status'] == '1') {
                echo '<div class="container mt-4">';
                echo '<div class="alert alert-success" role="alert">';
                echo "User successfully added.</div></div>";
            } elseif ($_REQUEST['status'] == '2') {
                echo '<div class="container mt-4">';
                echo '<div class="alert alert-success" role="alert">';
                echo "User successfully deleted.</div></div>";
            } elseif ($_REQUEST['status'] == '3') {
                echo '<div class="container mt-4">';
                echo '<div class="alert alert-danger" role="alert">';
                echo "Changes fail be saved.</div></div>";
            } elseif ($_REQUEST['status'] == '4') {
                echo '<div class="container mt-4">';
                echo '<div class="alert alert-danger" role="alert">';
                echo "User deactivated.</div></div>";
            } elseif ($_REQUEST['status'] == '5') {
                echo '<div class="container mt-4">';
                echo '<div class="alert alert-success" role="alert">';
                echo "User activated successfully.</div></div>";
            }
        }
        ?>
        <div class="content">
            <h1>All Users</h1>
        </div>
    </div>
    <!-- CONTENT -->
    <div class="body overlap">
        <div class="content">
            <div class="listing card">
                <div class="table-header collapses">
                    <div>
                        <a href="users-create.php" class="white small button" role="button">
                            Create User
                        </a>

                    </div>
                    <!-- PAGINATION BUTTON -->
                    <div>
                        <div class="white pagination buttons">
                            <a class="small button"><i class="fas fa-chevron-left"></i></a>
                            <?php
                            for ($i = 1; $i <= $totalPage; $i++) {
                                echo "<a class= 'small button' href = 'users.php?page=" . $i . "'>" . $i . "</a> ";
                            } ?>
                            <a class="small button"><i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div> <!-- PAGINATION BUTTON -->

                <!-- START OF TABLE -->
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 3%">ID</th>
                                <th style="width: 23%">Name</th>
                                <th style="width: 20%">Email</th>
                                <th style="width: 15%">Created Date</th>
                                <th style="width: 15%">Role</th>
                                <th colspan="2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- DISPLAY USER DETAIL -->
                            <?php
                            //set limit for each fetch
                            $sql_fetch_user = "SELECT * FROM `user` limit $start_from,$num_per_page";
                            try {
                                $resultUser = mysqli_query($conn, $sql_fetch_user);
                                if (mysqli_num_rows($resultUser) > 0) {
                                    $count = 0;
                                    while ($row = mysqli_fetch_assoc($resultUser)) {
                                        $dateRaw = $row['registrationDate'];
                                        $date = strtotime($dateRaw);
                                        $count++;
                            ?>
                                        <tr>
                                            <td><?php echo $row['userID']; ?></td>
                                            <td><?php echo $row['userName']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo date('F d , Y ', $date);  ?></td>
                                            <td>

                                                <?php
                                                if ($row['role'] == 1) {
                                                    echo "<span class= 'small badge'>NORMAL USER</span>";
                                                } else {
                                                    echo "<span class= 'small green badge'> SUPERADMIN</span>";
                                                }

                                                ?>

                                            </td>
                                            <td>
                                                <?php
                                                if ($row['userStatus'] == 1) {
                                                    echo "<span class= 'small green badge'> ACTIVE ACCOUNT</span>";
                                                } elseif ($row['userStatus'] == 2) {
                                                    echo "<span class= 'small red badge'> INACTIVE ACCOUNT</span>";
                                                } elseif ($row['userStatus'] == 3) {
                                                    echo "<span class= 'small  badge'> SUSPENDED ACCOUNT</span>";
                                                }

                                                ?>

                                            </td>
                                            <td class="action">
                                                <?php
                                                echo "<a href='users-edit.php?id={$row['userID']}'>Edit</a>";
                                                if ($row['role'] == 1) { ?>
                                                    <a href="<?php echo $row['userID']; ?>" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo $row['userID']; ?>" id="deletelink" class="deleteLink">Delete</a>

                                                <?php } ?>
                                            </td>
                                        </tr>
                            <?php

                                    }
                                } else {
                                    echo "Could not find user";
                                }
                            } catch (mysqli_sql_exception) {
                                echo "Could not find user";
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- PAGINATION BUTTON -->
                <div class="table-footer">
                    <div>Showing <b><?php echo $count; ?></b> of <b><?php echo $totalUser; ?> users</b></div>
                    <div>
                        <div class="white pagination buttons">
                            <a class="small button"><i class="fas fa-chevron-left"></i></a>
                            <?php
                            for ($i = 1; $i <= $totalPage; $i++) {
                                echo "<a class= 'small button' href = 'users.php?page=" . $i . "'>" . $i . "</a> ";
                            } ?>
                            <a class="small button"><i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div> <!-- PAGINATION BUTTON -->
            </div>
        </div>
    </div>
    <!-- pop up notifcation for delete -->
    <?php include("include/pop-up-users.php"); ?>
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