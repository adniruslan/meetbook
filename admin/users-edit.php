<?php

// DATABASE CONNECTION
include("backend/database.php");

// GET USER ID
$currentuserID = " ";
if (isset($_REQUEST['id'])) {
    $currentuserID = $_REQUEST['id'];
}

// GET USER DETAIL
$sql  = " SELECT * FROM `user` WHERE userID = '$currentuserID' ";
try {
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $count = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $currentuserID = $row['userID'];
            $currentuserName = $row['userName'];
            $email = $row['email'];
            $userStatus = $row['userStatus'];
            $userID = $row['userID'];
        }
    } else {
        echo "Could not find user";
    }
} catch (mysqli_sql_exception) {
    echo "Could not find user";
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

    <script src="https://kit.fontawesome.com/048645d981.js" crossorigin="anonymous"></script>


    <!-- bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Create User | Meetbook – Easy Meeting Room Booking</title>
</head>

<body>
    <!-- HEADER -->
    <div class="header">
        <?php include("include/header.php"); ?>
        <div class="content">
            <h1>Edit User</h1>
        </div>
    </div>
    <!-- ALERT MESSAGE -->
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
        } else {
            echo '<div class="container mt-4">';
            echo '<div class="alert alert-warning" role="alert">';
            echo "Password is not match</div></div>";
        }
    }

    ?>
    <!-- CONTENT -->
    <div class="body">
        <div class="content">
            <!-- FORM START -->
            <form action="backend/edit-users.php" method="post">
                <div class="group">
                    <div>
                        <h5 class="heading">
                            Basic Information
                            <div class="subheading">Personal information about the user.</div>
                        </h5>
                    </div>
                    <!-- 1ST LAYER FORM -->
                    <div>
                        <div class="card">
                            <div class="content">
                                <div class="fields-split">
                                    <div class="field">
                                        <label for="fullname">Full Name</label>
                                        <input type="text" name="userID" value="<?php echo $currentuserID; ?>" hidden>
                                        <input name="fullname" id="fullname" type="text" placeholder="John Doe" value="<?php echo $currentuserName; ?>" required />
                                        <label for="fullname" class="guide">
                                            Provide a correct full name.
                                        </label>
                                    </div>
                                    <div class="field">
                                        <label for="email">Email Address</label>
                                        <input name="email" id="email" type="email" placeholder="you@email.com" value="<?php echo $email; ?>" required />
                                        <label for="email" class="guide">
                                            Provide a valid email address.
                                        </label>
                                    </div>
                                </div>
                                <div class="fields-split">
                                    <div class="field">
                                        <label for="new-password">New Password</label>
                                        <input name="new_password" id="new-password" type="password" placeholder="••••••••" />
                                        <label for="new-password" class="guide">
                                            Leave this blank if you're not changing password.
                                        </label>
                                    </div>
                                    <div class="field">
                                        <label for="confirm-password">Confirm Password</label>
                                        <input name="confirm_password" id="confirm-password" type="password" placeholder="••••••••" />
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
                <!-- 2ND LAYER FORM -->
                <div class="group">
                    <div>
                        <h5 class="heading">
                            Danger Zone
                            <div class="subheading">Note: deleting a user is irreversible.</div>
                        </h5>
                    </div>
                    <div>
                        <div class="card">
                            <!-- DISPLAY CHECK/UNCHECKED BASED ON USERSTATUS -->
                            <div class="content">
                                <?php
                                if (isset($userStatus)) {
                                    if ($userStatus == 3) {
                                ?>
                                        <div class="fields-row">
                                            <div class="field">
                                                <label for="suspend" class="cursor-pointer">
                                                    Suspend this user
                                                    <div class="guide">
                                                        Turn this on to prevent user from logging in.
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="field">
                                                <div class="switch">
                                                    <div>
                                                        <input type="checkbox" name="enableSuspend" id="suspend" checked />
                                                        <label for="suspend"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else { ?>
                                        <div class="fields-row">
                                            <div class="field">
                                                <label for="suspend" class="cursor-pointer">
                                                    Suspend this user
                                                    <div class="guide">
                                                        Turn this on to prevent user from logging in.
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="field">
                                                <div class="switch">
                                                    <div>
                                                        <input type="checkbox" name="enableSuspend" id="suspend" />
                                                        <label for="suspend"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }
                                } else { ?>
                                    <div class="fields-row">
                                        <div class="field">
                                            <label for="suspend" class="cursor-pointer">
                                                Suspend this user
                                                <div class="guide">
                                                    Turn this on to prevent user from logging in.
                                                </div>
                                            </label>
                                        </div>
                                        <div class="field">
                                            <div class="switch">
                                                <div>
                                                    <input type="checkbox" name="enableSuspend" id="suspend" />
                                                    <label for="suspend"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                ?>
                                <!-- DEACTIVATE LINK -->
                                <?php
                                if ($userStatus != 2) { ?>
                                    <div class="fields-row">
                                        <div class="field">
                                            <a href="backend/deactivate.php?id=<?php echo $currentuserID; ?>" class="red" style="font-weight: 500" id="deactivateLink">
                                                Deactivate this account
                                            </a>
                                        </div>
                                    </div>
                                <?php }
                                else{ ?>
                                    <div class="fields-row">
                                        <div class="field">
                                            <a href="backend/activate.php?id=<?php echo $currentuserID; ?>" class="red" style="font-weight: 500" id="activateLink">
                                                Activate this account
                                            </a>
                                        </div>
                                    </div>
                                <?php }?>
                                <!-- DELETE BUTTON -->
                                <div class="fields-row">
                                    <div class="field">
                                        <a href="backend/delete-user.php?" data-toggle="modal" class="red" data-target="#deleteModal" style="font-weight: 500">
                                            Delete this user permanently
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer right">
                                <button class="green button" name="submitSetting" type="submit">Save User</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form><!--END FORM-->
        </div>
    </div>
    <!-- delete popup division -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                    <form action="backend/delete-user.php" method="post" id="deleteForm">
                        <input type="hidden" value="<?php echo $userID ?>" name="userID" id="userID">
                        <button type="submit" class="btn btn-danger" id="deleteButton">Delete</a>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- delete popup division -->

    <!-- js for popup -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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