<?php 
$userID = $_SESSION['userID'];

$sql = "SELECT *FROM user WHERE userID = '$userID' ";

try {
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $count = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $currentUserID = $row['userID'];
            $userName = $row['userName'];
          
        }
    } else {
        echo "Could not find user";
    }
} catch (mysqli_sql_exception) {
    echo "Could not find user";
}

$currentPage = basename($_SERVER['PHP_SELF']);
switch($currentPage){
    case 'index.php':
        $id = 'dashboard';
        break;

    
    case 'rooms.php':
        $id = 'room';            
        break;

    default:
        $id = '';            
        break;    
}

?>

<div class="menu">
    <div class="left">
        <a href="index.php" class="square logo"></a>
        <div id="hamburger" class="hamburger hamburger--spin" onclick="openMenu()">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
        <nav id="menu">
            <ul>
                <li><a href="index.php" class="" id="dashboard">Dashboard</a></li>
                <li>
                    <a href="#" class="" id="room">Rooms<i class="fas fa-caret-down"></i></a>
                    <div class="submenu">
                        <ul>
                            <li><a href="rooms.php" >All Rooms</a></li>
                        </ul>
                    </div>
                </li>
                
            </ul>
        </nav>
    </div>
    <div class="middle">
        <a href="/" class="square logo"></a>
    </div>
    <div class="right">
        <div class="identity">
            <div class="dropdown">
                <a href="#"><i class="fas fa-user"></i></a>
                <div class="dropdown-content">
                    
                <a href="/meetbook/users-edit.php?id=<?php echo $currentUserID ?>" style="font-size: small;"><i class="fas fa-user"></i> <?php echo $userName ?></a>
                    
                    <a href="/meetbook/backend/logout.php"><i class="fa fa-sign-out"></i> Log out</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- get id based on current, then set class to active -->
<?php echo "<script>document.getElementById('".$id."').classList.add('active');</script>";?>
       
       
