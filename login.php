<?php
    include 'connection.php';
    
    if($user->isLoggedIn()!=''){
        $user->redirect('index.php');
    }

    $loginin = false;
    $success = 0;
    if(isset($_POST['submit'])) {
        if (isset($_POST['username']) &&  isset($_POST['password'])) {
            $loginin = true;
            $username = $_POST['username'];
            $password = $_POST['password'];

            if($user->login($username,$password)) {
                $user->redirect('index.php');
            }
            else {
                $success = 2;

                //echo "<script>alert('Wrong details!')</script>";
            }
        }  
    }
?>
<!doctype html>
<html class="no-js">
<head>
        <!-- Meta, title, CSS, favicons, etc. -->
                <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Sewaku &middot; Log In </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <!--<link rel="shortcut icon" href="/favicon.ico">-->
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="stylesheet" href="dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="dist/css/veneto-admin.min.css">
        <link rel="stylesheet" href="demo/css/demo.css">
        <link rel="stylesheet" href="dist/assets/font-awesome/css/font-awesome.css">


        <!--[if lt IE 9]>
        <script src="dist/assets/libs/html5shiv/html5shiv.min.js"></script>
        <script src="dist/assets/libs/respond/respond.min.js"></script>
        <![endif]-->

    </head>
    <body class="body-sign-in">
    <div class="container">
        <div class="panel panel-default form-container">
            <div class="panel-body">

                <form role="form" name="login" method="post" action="">
                    <h3 class="text-center margin-xl-bottom">Welcome Back!</h3>
                        <?php
                        if (!$loginin && isset($_GET['signup'])) {
                            ?>
                            <div class="alert alert-success">
                                <strong>Well done!</strong> You've been registered.
                            </div>
                            <?php
                        }
                        if (!$loginin && isset($_GET['logout'])) {
                            ?>
                            <div class="alert alert-info">
                                Successfully <strong>logged out</strong>
                            </div>
                            <?php
                        }
                        if ($success == 2) {
                            ?>
                            <div class="alert alert-danger">
                                <strong>Sorry!</strong> Your username and password mismatch.
                            </div>
                            <?php
                        }
                        if (!$loginin && isset($_GET['connection'])) {
                            ?>
                            <div class="alert alert-danger">
                                You have been <strong>idle </strong>for too long. Please re-log in.
                            </div>
                            <?php
                        }
                        ?>

                    <div class="form-group text-center">
                        <label class="sr-only" for="email">Username</label>
                        <input type="text" class="form-control input-lg" id="username" placeholder="Username" name="username">
                    </div>
                    <div class="form-group text-center">
                        <label class="sr-only" for="password">Password</label>
                        <input type="password" class="form-control input-lg" id="password" placeholder="Password" name="password" onkeydown="if (event.keyCode == 13) { this.form.submit(); return false; }">
                    </div>

                    <button style="display: block; width: 100%;" type="submit" class="btn btn-lg btn-flat btn-primary" name="submit" value="submit">Sign in</button>
                </form>
            </div>
            <div class="panel-body text-center">
                <div class="margin-bottom">
                    <a class="text-muted text-underline" href="forget-pwd.php">Forgot Password?</a>
                </div>
                <div>
                    Don't have an account? <a class="text-primary-dark" href="sign-up.php">Sign up here</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
