
<?php
// DATABASE CONNECTION
include("database.php");

// POST VALUE
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_SPECIAL_CHARS);

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

    $new_password =  filter_input(INPUT_POST, 'new_password', FILTER_SANITIZE_SPECIAL_CHARS);

    $confirm_password = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_SPECIAL_CHARS);

    if ($confirm_password === $new_password) {
        if (isset($_POST['enableSuspend'])) {
            $userStatus = '3';
        } else {
            $userStatus = 'DEFAULT';
        }

        // CONVERT TO HASH
        $hash = password_hash($new_password, PASSWORD_DEFAULT);
        // INSERT DATA
        $sql = "INSERT INTO `user`(`userID`, `userName`, `email`, `password`, `userStatus`, `registrationDate`, `role`) VALUES ('','$fullname', '$email', '$hash', $userStatus , DEFAULT,DEFAULT)";

        try {
            mysqli_query($conn, $sql);
            $status = "1";
            header("Location:/meetbook/admin/users.php?status=$status");
        } catch (mysqli_sql_exception) {
            $status = "2";
            header("Location:/meetbook/admin/users-create.php?status=$status");
        }
    } else {
        $status = "3";
        header("Location:/meetbook/admin/users-create.php?status=$status");
    }
}

?>