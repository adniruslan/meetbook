<?php
// DATABASE CONNECTION
include("database.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // RETRIEVE POST VALUE
    $userName = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_SPECIAL_CHARS);
    $emailUser = $_POST['email'];
    $password = $_POST['password'];

    // FIND USER WITH THE DETAIL AND NOT IN STATUS=2,
    $sql = "SELECT * FROM `user` WHERE email = '$emailUser' AND role = '2' AND userStatus != '2' ";
    try {
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $hash = $row['password'];
                $userID = $row['userID'];
                if (password_verify($password, $hash)) {
                    $_SESSION['userID'] =  $userID;
                    header("Location:/meetbook/admin/index.php");
                } else {
                    $status = "3";
                    header("Location:../signin.php?status=$status");
                }
            }
        } else {
            $status = "1";
            header("Location:../signin.php?status=$status");
        }
    } catch (mysqli_sql_exception) {
        $status = "2";

        header("Location:../signin.php?status=$status");
    }
}
