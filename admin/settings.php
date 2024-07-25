<?php

// database connection
include("backend/database.php");

// get current site setting 
$sql_status = "SELECT * FROM `sitesetting` ";
try {
    $result = mysqli_query($conn, $sql_status);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $signupStatus = $row['signupStatus'];
            $bookingStatus = $row['bookingStatus'];
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
    <link rel="stylesheet" href="css/components/badge.css" />
    <link rel="stylesheet" href="css/components/input.css" />
    <link rel="stylesheet" href="css/components/header.css" />
    <link rel="stylesheet" href="css/components/button.css" />
    <link rel="stylesheet" href="css/components/heading.css" />
    <link rel="stylesheet" href="css/components/table.css" />
    <link rel="stylesheet" href="css/components/switch.css" />
    <link rel="stylesheet" href="css/components/hamburgers.css" />
    <link rel="stylesheet" href="css/components/form.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/header.css" />
    <!-- bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <script src="https://kit.fontawesome.com/048645d981.js" crossorigin="anonymous"></script>

    <title>Settings | Meetbook – Easy Meeting Room Booking</title>
</head>

<body>
    <!-- header -->
    <div class="header">
        <?php include("include/header.php"); ?>
        <div class="content">
            <h1>Settings</h1>
        </div>
    </div>

    <!-- alert message -->
    <?php
    if (isset($_REQUEST['status'])) {
        if ($_REQUEST['status'] == '1') {
            echo '<div class="container mt-4">';
            echo '<div class="alert alert-success" role="alert">';
            echo "Changes save successfully</div></div>";
        } elseif ($_REQUEST['status'] == '2') {
            echo '<div class="container mt-4">';
            echo '<div class="alert alert-warning" role="alert">';
            echo "Changes fail to save. Check the form again.</div></div>";
        }
    } ?>
    <div class="body">
        <div class="content">

            <!-- start form -->
            <form action="backend/setting.php" method="post" name="settingForm">
                <div class="group">
                    <div>
                        <h5 class="heading">
                            General Settings
                            <div class="subheading">System's general settings.</div>
                        </h5>
                    </div>
                    <div>
                        <div class="card">
                            <div class="content">
                                <div class="fields-row">
                                    <div class="field">
                                        <label for="enable_booking" class="cursor-pointer">
                                            Enable Booking
                                            <div class="guide">
                                                Disabling this prevents any user from booking a
                                                room.
                                            </div>
                                        </label>
                                    </div>
                                    <!-- display checked/uncheck based on status at database -->
                                    <div class="field">
                                        <div class="switch">
                                            <?php
                                            if ($bookingStatus == 1) { ?>

                                                <div>
                                                    <input id="enable_booking" name="enable_booking" type="checkbox" checked />
                                                    <label for="enable_booking"></label>
                                                </div>

                                            <?php } else { ?>

                                                <div>
                                                    <input id="enable_booking" name="enable_booking" type="checkbox" />
                                                    <label for="enable_booking"></label>
                                                </div>

                                            <?php }
                                            ?>


                                        </div>
                                    </div>
                                </div>

                                <!-- display checked/uncheck based on status at database -->
                                <div class="fields-row">
                                    <div class="field">
                                        <label for="enable_signup" class="cursor-pointer">
                                            Enable Sign Ups
                                            <div class="guide">
                                                Disabling this prevents anyone from signing up.
                                            </div>
                                        </label>
                                    </div>
                                    <div class="field">
                                        <div class="switch">
                                            <?php
                                            if ($signupStatus == 1) { ?>

                                                <div>
                                                    <input id="enable_signup" name="enable_signup" type="checkbox" checked />
                                                    <label for="enable_signup"></label>
                                                </div>

                                            <?php } else { ?>

                                                <div>
                                                    <input id="enable_signup" name="enable_signup" type="checkbox" />
                                                    <label for="enable_signup"></label>
                                                </div>

                                            <?php }
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer right">
                                <button class="green button" type="submit">Save Settings</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>  <!--end of form-->
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