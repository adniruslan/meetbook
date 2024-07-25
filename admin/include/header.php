<?php
// GET CURRENT PAGE
$currentPage = basename($_SERVER['PHP_SELF']);

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


// SET ID VAR BASED ON PAGE
switch ($currentPage) {
    case 'index.php':
        $id = 'dashboard';
        break;

    case 'rooms-create.php':
        $id = 'room';
        break;
    case 'rooms.php':
        $id = 'room';
        break;
    case 'rooms-edit.php':
        $id = 'room';
        break;

    case 'users-create.php':
        $id = 'user';
        break;
    case 'users.php':
        $id = 'user';
        break;
    case 'users-edit.php':
        $id = 'user';
        break;

    case 'settings.php':
        $id = 'setting';
        break;

    default:
        $id = '';
        break;
}
?>

<!-- HEADER SECTION -->
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
                            <li>
                                <a href="rooms-create.php">Create Room</a>
                            </li>
                            <li><a href="rooms.php">All Rooms</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#" class="" id="user">Users<i class="fas fa-caret-down"></i></a>
                    <div class="submenu">
                        <ul>
                            <li>
                                <a href="users-create.php">Create User</a>
                            </li>
                            <li><a href="users.php">All Users</a></li>
                        </ul>
                    </div>
                </li>
                <li><a href="settings.php" class="" id="setting">Settings</a></li>
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
                <!-- Move the dropdown-content inside the dropdown container -->
                <div class="dropdown-content">
                    
                    <a href="/meetbook/admin/profile-edit.php?id=<?php echo $currentUserID ?>" style="font-size: small;"><i class="fas fa-user"></i> <?php echo $userName ?></a>
                    
                    <a href="/meetbook/admin/backend/logout.php"><i class="fa fa-sign-out"></i> Log out</a>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- FUNCTION TO SET CLASS FOR ID OF ATTRIBUTE BASED ON PAGE -->
<?php echo "<script>document.getElementById('" . $id . "').classList.add('active');</script>"; ?>