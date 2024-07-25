<?php 
// DATABASE CONNECTION
include("database.php");
    if($_SERVER['REQUEST_METHOD']=='POST'){
        // GET ROOMID
        $roomID = filter_input(INPUT_POST, 'roomID', FILTER_SANITIZE_SPECIAL_CHARS);
        // DELETE ROOM
        $sql = "DELETE FROM `ROOM` WHERE roomID = '$roomID' ";
        try {
            mysqli_query($conn, $sql);
            $status = 2;
            
        } catch (mysqli_sql_exception) {
            echo "Could not find find";
            $status = 3;
        }
        header("Location:/meetbook/admin/rooms.php?id=$roomID&status=$status");
        

    }
    
?>