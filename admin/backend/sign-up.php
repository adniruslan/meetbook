
<?php
// DATABASE CONNECTION
include("database.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // RETRIEVE POST VALUE
    $userName = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_SPECIAL_CHARS);
    $emailUser = $_POST['email'];
    $password = $_POST['password'];
    // CONVERT TO HASH
    $hash = password_hash($password, PASSWORD_DEFAULT);
    // INSERT USER
    $sql = "INSERT INTO `user`(`userID`, `userName`, `email`, `password`, `userStatus`, `registrationDate`, `role`) VALUES ('','$userName', '$emailUser', '$hash', DEFAULT , DEFAULT,DEFAULT)";

    try {
        mysqli_query($conn,$sql);
        $status = "4";
        header("Location:/meetbook/admin/signin.php?status=$status");
        
    } catch (mysqli_sql_exception) {
        $status = "1";
        header("Location:../signup.php?status=$status");
    }
}


?>