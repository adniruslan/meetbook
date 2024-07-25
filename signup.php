<?php

// db connection
include("backend/database.php");

// get setting for site, disable signup according to setting
$sql_status = "SELECT * FROM `sitesetting` ";
try {
    $result = mysqli_query($conn, $sql_status);
    if (mysqli_num_rows($result) > 0) { //return how many row
        while ($row = mysqli_fetch_assoc($result)) {
            $signupStatus = $row['signupStatus'];
        }
    }
} catch (mysqli_sql_exception) {

    echo "no status found";
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

    <link rel="stylesheet" href="css/global.css" />
    <link rel="stylesheet" href="css/components/input.css" />
    <link rel="stylesheet" href="css/components/button.css" />
    <link rel="stylesheet" href="css/layouts/login.css" />
    <!-- bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Sign Up | Meetbook – Easy Meeting Room Booking</title>
</head>

<body>
    <div class="global">
        <div class="login-form">
            <div class="content">
                <div class="logo"></div>

                <!-- alert message -->
                <?php if (isset($_REQUEST['status'])) {
                    if ($_REQUEST['status'] == '1') {
                        echo '<div class="container mt-4">';
                        echo '<div class="alert alert-warning" role="alert">';
                        echo "Account already existed</div></div>";
                    }
                } 
                if ($signupStatus == '2') {
                    echo '<div class="container mt-4">';
                    echo '<div class="alert alert-danger" role="alert">';
                    echo "Sign-up is closed for the moment.</div></div>";
                

                } else{
                    echo"";
                }
                ?>

                <!-- sign up form -->
                <form method="post" action="backend/sign-up.php">
                    <div class="field">
                        <label for="fullname">Full Name</label>
                        <input id="fullname" type="text" name="fullname" placeholder="John Doe" required />
                    </div>
                    <div class="field">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" placeholder="you@email.com"  required/>
                    </div>
                    <div class="field">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" placeholder="••••••••" required />
                    </div>

                    <div class="field">
                        <button class="fluid button" type="submit" id="signupbtn">Sign Up</button>
                    </div>
                </form>
                <div class="footer">
                    <div class="primary">
                        <a href="signin.php">Already have an account? Sign in.</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="ice-breaker">
            <div class="content">
                <div class="illustration">
                    <img src="/assets/undraw_Co_workers_re_1i6i.svg" alt="Meetbook" />
                </div>
                <h1>Manage meeting rooms. 10x easier.</h1>
                <h2>Meetbook automates meeting room bookings.</h2>
            </div>
        </div>
    </div>
    <!-- disable form is setting disable and vice versa -->
    <?php
    if ($signupStatus == '1') {
    ?>
        <script>
            document.getElementById('signupbtn').disabled = false
        </script>

    <?php

    } elseif ($signupStatus == '2') { ?>
        <script>
            document.getElementById('signupbtn').disabled = true
            document.getElementById('fullname').disabled = true
            document.getElementById('email').disabled = true
            document.getElementById('password').disabled = true
        </script>

    <?php } ?>
</body>

</html>