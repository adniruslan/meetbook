<?php 
// DATABASE CONNECTION
include("database.php");
    if($_SERVER['REQUEST_METHOD']=='POST'){
        // RETRIEVE USERID
        $userID = filter_input(INPUT_POST, 'userID', FILTER_SANITIZE_SPECIAL_CHARS);
        // DELETE USER
        $sql = "DELETE FROM `user` WHERE userID = '$userID' ";
        try {
            mysqli_query($conn, $sql);
            $status = 5;
            header("Location:/meetbook/signin.php?status=$status");
        } catch (mysqli_sql_exception) {
            echo "Could not find user";
            $status = 4;
            header("Location:/meetbook/users-edit.php?id=$userID&status=$status");
        }
      
        

    }
    
?>