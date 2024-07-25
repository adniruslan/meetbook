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
            $status = 2;
            
        } catch (mysqli_sql_exception) {
            echo "Could not find user";
            $status = 3;
        }
        header("Location:/meetbook/admin/users.php?id=$userID&status=$status");
        

    }
    
?>