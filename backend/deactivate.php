<?php 
// DATABASE CONNECTION
include("database.php");
// GET USERID
    if(isset($_REQUEST['id'])){
        $userID = $_REQUEST['id'];
        
        // UPADATE TO DEACTIVATE
        $sql = "UPDATE `user` SET userStatus = '2' WHERE userID = '$userID' ";
        try {
            mysqli_query($conn, $sql);
            $status = 1;
            
        } catch (mysqli_sql_exception) {
            echo "Could not find user";
            $status = 3;
        }
        echo $status;
        header("Location:/meetbook/users-edit.php?id=$userID&status=$status");
    }
    
?>