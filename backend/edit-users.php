
<?php
// DATABASE CONNECTION
include("database.php");
// RETRIEVE POST VALUE
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_SPECIAL_CHARS);

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    $userID = filter_input(INPUT_POST, 'userID', FILTER_SANITIZE_SPECIAL_CHARS);
    // GET USER DETAIL
    $sql_prevStatus  = " SELECT * FROM `user` WHERE userID = '$userID' ";
    try {
        $result = mysqli_query($conn, $sql_prevStatus);
        if (mysqli_num_rows($result) > 0) {
            $count = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $prevuserStatus = $row['userStatus'];
               
            }
        } else {
            echo "Could not find user";
        }
    } catch (mysqli_sql_exception) {
        echo "Could not find user";
    }


    // COMPARE PASSWORD & CPASSWORD IF INPUT PASSWORD
    if (isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
        $new_password =  filter_input(INPUT_POST, 'new_password', FILTER_SANITIZE_SPECIAL_CHARS);

        $confirm_password = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_SPECIAL_CHARS);

        // UPDATE USER
        if ($confirm_password === $new_password) {
            $hash = password_hash($new_password, PASSWORD_DEFAULT);
            $sql = "UPDATE `user` SET `userName`='$fullname',`email`='$email',`password`='$hash',`userStatus`= '$userStatus' WHERE userID = '$userID' ";

            try {
                mysqli_query($conn, $sql);
                $status = "1";
                header("Location:/meetbook/users-edit.php?id=$userID&status=$status");
            } catch (mysqli_sql_exception) {
                $status = "2";
                header("Location:/meetbook/users-edit.php?id=$userID&status=$status");
            }
        } else {
            $status = "3";
            header("Location:/meetbook/users-edit.php?id=$userID&status=$status");
        }
    } else {
        // UPDATE USER
        $sql = "UPDATE `user` SET `userName`='$fullname',`email`='$email',`userStatus`= $userStatus WHERE userID = '$userID' ";

        try {
            mysqli_query($conn, $sql);
            $status = "1";
            header("Location:/meetbook/users-edit.php?id=$userID&status=$status");
        } catch (mysqli_sql_exception) {
            $status = "2";
            header("Location:/meetbook/users-edit.php?id=$userID&status=$status");
        }
    }

    // echo $status;

}


?>