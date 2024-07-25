<?php 
include("backend/database.php");
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

    <script src="https://kit.fontawesome.com/048645d981.js" crossorigin="anonymous"></script>


    <!-- bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Create User | Meetbook – Easy Meeting Room Booking</title>
</head>

<body>
    <!-- header -->
    <div class="header">
        <?php include("include/header.php"); ?>
        <div class="content">
            <h1>Create User</h1>
        </div>
    </div>
    <!-- alert message -->
    <?php
    if (isset($_REQUEST['status'])) {
        if ($_REQUEST['status'] == '2') {
            echo '<div class="container mt-4">';
            echo '<div class="alert alert-warning" role="alert">';
            echo "Account already existed. Please choose another email</div></div>";
        } else {
            echo '<div class="container mt-4">';
            echo '<div class="alert alert-warning" role="alert">';
            echo "Password is not match</div></div>";
        }
    }

    ?>
    <!-- content -->
    <div class="body">
        <div class="content">
            <!-- FORM START -->
            <form action="backend/create-user.php" method="post">
                <div class="group">
                    <div>
                        <h5 class="heading">
                            Basic Information
                            <div class="subheading">Personal information about the user.</div>
                        </h5>
                    </div>
                    <div>
                        <div class="card">
                            <div class="content">
                                <div class="fields-split">
                                    <div class="field">
                                        <label for="fullname">Full Name</label>
                                        <input name="fullname" id="fullname" type="text" placeholder="John Doe" required />
                                        <label for="fullname" class="guide">
                                            Provide a correct full name.
                                        </label>
                                    </div>
                                    <div class="field">
                                        <label for="email">Email Address</label>
                                        <input name="email" id="email" type="email" placeholder="you@email.com" required />
                                        <label for="email" class="guide">
                                            Provide a valid email address.
                                        </label>
                                    </div>
                                </div>
                                <div class="fields-split">
                                    <div class="field">
                                        <label for="new-password">New Password</label>
                                        <input name="new_password" id="new-password" type="password" placeholder="••••••••" required />
                                        <label for="new-password" class="guide">
                                            Type your password
                                        </label>
                                    </div>
                                    <div class="field">
                                        <label for="confirm-password">Confirm Password</label>
                                        <input name="confirm_password" id="confirm-password" type="password" placeholder="••••••••" required />
                                        <label for="confirm-password" class="guide">
                                            Confirm the new password.
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer right">
                                <button type="submit" class="green button" name="submitDetail">Save User</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- END FORM -->
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