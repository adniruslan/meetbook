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

    <title>Sign In | Meetbook – Easy Meeting Room Booking</title>
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
                        echo "Account not found</div></div>";
                    } elseif ($_REQUEST['status'] == '2') {
                        echo '<div class="container mt-4">';
                        echo '<div class="alert alert-warning" role="alert">';
                        echo "Account not found</div></div>";
                    } elseif ($_REQUEST['status'] == '3'){
                        echo '<div class="container mt-4">';
                        echo '<div class="alert alert-warning" role="alert">';
                        echo "Password is incorrect</div></div>";
                    }
                    elseif ($_REQUEST['status'] == '4'){
                        echo '<div class="container mt-4">';
                        echo '<div class="alert alert-success" role="alert">';
                        echo "Account created. </div></div>";
                    }
                    elseif ($_REQUEST['status'] == '5'){
                        echo '<div class="container mt-4">';
                        echo '<div class="alert alert-success" role="alert">';
                        echo "Account delete successfully. </div></div>";
                    }
                } ?>

                <!-- sign in form -->
                <form method="post" action="backend/sign-in.php" name="signForm">
                    <div class="field">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" placeholder="you@email.com" required/>
                    </div>
                    <div class="field">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" placeholder="••••••••" required/>
                    </div>

                    <div class="field">
                        <button class="fluid button">Sign In</button>
                    </div>
                </form>

                <div class="footer">
                    <!-- link to sign up page -->
                    <div class="primary">
                        <a href="signup.php">Don't have an account? Sign up.</a>
                    </div>
                    <!-- <div class="secondary">
                        <a href="forgot.php">Forgot Password</a>
                    </div> -->
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
</body>

</html>