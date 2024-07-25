<?php

session_start();
$db_server = "localhost"; //remain
$db_user = "root";
$db_pass = "";
$db_name = "meetbook";
$conn = "";

try {
    //mysqli_connect(servername,user,password,dbname,);
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
} catch (mysqli_sql_exception) {
    echo "connection failed <br>";
}
?>
