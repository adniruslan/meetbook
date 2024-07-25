<?php 
// DATABASE CONNECTION
include("database.php");
// GET USERID
    if(isset($_REQUEST['id'])){
        $userID = $_REQUEST['id'];
        
        // UPADATE TO ACTIVATE
        $sql = "UPDATE `user` SET userStatus = '1' WHERE userID = '$userID' ";
        try {
            mysqli_query($conn, $sql);
            $status = 5;
            
        } catch (mysqli_sql_exception) {
            echo "Could not find user";
            $status = 3;
        }
        echo $status;
        header("Location:/meetbook/admin/users.php?id=$userID&status=$status");
    }
    
?>