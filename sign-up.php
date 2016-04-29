<?php
	include('connection.php');
	$status = '';
	if(isset($_POST['submit'])) {
		$username = strtolower(trim($_POST['username']));
		$name = trim($_POST['name']);
		$name = ucwords(trim($name));
		$phone = trim($_POST['phone']);
		
		if ($phone[0] == '+') {
			$phone = substr($phone, 1);
		} else if ($phone[0] == '0') {
			$phone = '6'.$phone;
		}
		
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);
		
		//echo($username);
		
        try {
            $findUsername = $db->prepare("SELECT * FROM rumah_user WHERE uname =:uname");
            $findUsername->bindparam(":uname",$username);
            $findUsername->execute();
            $row = $findUsername->fetch(PDO::FETCH_ASSOC);

            if($username == $row['uname']) {

            }
            else if($email == $row['email']) {

            }
            else {
                if($user->register($username, $name, $phone, $email, $password)) {
                    $user->redirect('login.php?signup=success');   
                }
                else {
                    $status = 'Failed';
                }
            }
        }
        catch(PDOException $e) {
            $e->getMessage();
        }
	}
	
	
?>

<!doctype html>
<html class="no-js">
<head>
        <!-- Meta, title, CSS, favicons, etc. -->
                <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Veneto Admin &middot; Sign Up </title>
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
    <body class="body-sign-up">
    <div class="container">
        <div class="panel panel-default form-container">
            <div class="panel-body">
	            <?php
                    if ($status == 'Status') {
                        ?>
                        <div class="alert alert-success">
                            <strong>Well done!</strong> Your account has been created.
                        </div>
                        <?php

                    } else if ($status == 'Failed') {
                        ?>
                        <div class="alert alert-warning">
                            <strong>Sorry!</strong> Username has been used. Please choose other.
                        </div>
                        <?php
                    } else if ($status == 'Password') {
                        ?>
                        <div class="alert alert-warning">
                            <strong>Sorry!</strong> Password mismatched.
                        </div>
                        <?php
                    }
                ?>
                <form role="form" name="form" method="post" action="">
                    <h3 class="text-center margin-xl-bottom">Sign up <span class="semi-bold">now</span></h3>

					<div class="form-group text-center">
                        <label class="sr-only" for="password">Username</label>
                        <input type="text" class="form-control input-lg" name="username" placeholder="Username">
                    </div>
                    <div class="form-group text-center">
                        <label class="sr-only" for="password">Fullname</label>
                        <input type="text" class="form-control input-lg" name="name" placeholder="Fullname">
                    </div>
                    <div class="form-group text-center">
                        <label class="sr-only" for="password">Phone No.</label>
                        <input type="text" class="form-control input-lg" name="phone" placeholder="Phone No.">
                    </div>
                    <div class="form-group text-center">
                        <label class="sr-only" for="email">Email Address</label>
                        <input type="email" class="form-control input-lg" name="email" placeholder="Email Address">
                    </div>
                    <div class="form-group text-center">
                        <label class="sr-only" for="password">Password</label>
                        <input type="password" class="form-control input-lg" name="password" placeholder="Password">
                    </div>

                    <button style="display: block; width: 100%;" type="submit" name="submit" class="btn btn-lg btn-flat btn-primary" >SIGN UP</button>
                </form>
            </div>
            <div class="panel-body text-center">
                <div class="margin-bottom text-muted">
                    By signing up, you agree to the <a class="text-muted text-underline" href="javascript:;">Terms of Service</a>
                </div>
                <div>
                    Already have an account? <a class="text-primary-dark" href="login.php">Sign in here</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
