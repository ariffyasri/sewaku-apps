<?php 
	$title = 'profile';
	include 'header.php'; 
	$success = null;
	if (isset($_POST['submit'])) {
		
		$name = trim($_POST['name']);
		$phone = trim($_POST['phone']);
		$email = trim($_POST['email']);
		if ($phone[0] == '+') {
			$phone = substr($phone, 1);
		} else if ($phone[0] == '0') {
			$phone = '6'.$phone;
		}
		
		$stmt = $db->prepare("UPDATE rumah_user SET name =:name, phone = :phone, email =:email WHERE uname =:uname");
		$stmt->bindparam(":name",$name);
		$stmt->bindparam(":phone",$phone);
		$stmt->bindparam(":email",$email);
		$stmt->bindparam(":uname",$_SESSION['uname']);
		$stmt->execute();
		$success = 1;
		
	} else if (isset($_POST['submit2'])) {
		
		$oldpwd = trim($_POST['oldpwd']);
		$pwd1 = trim($_POST['pwd1']);
		$pwd2 = trim($_POST['pwd2']);
		
		$matchPwd = $db->prepare("SELECT * FROM rumah_user WHERE uname =:session");
		$matchPwd->bindparam("session",$_SESSION['uname']);
		$matchPwd->execute();
		$r = $matchPwd->fetch(PDO::FETCH_ASSOC);
		if ($matchPwd->rowCount() > 0) {

			if(password_verify($oldpwd, $r['pwd'])) {
				if ($pwd1 == $pwd2) {
					$pwd1 = password_hash($pwd1,PASSWORD_DEFAULT);
					$newpass = $db->prepare("UPDATE rumah_user SET pwd = :pwd WHERE uname =:session ");
					$newpass->bindparam(":pwd",$pwd1);
					$newpass->bindparam(":session",$_SESSION['uname']);
					$newpass->execute();
					$success = 2;
				} else {
					$success = 3;
				}
			} else {
				$success = 4;
			}	
		} else {
			$success = 4;
		}
	}
?>

<div class="container-fluid-md">
	<?php
        if ($success == 1) {
            ?>
            <div class="alert alert-success">
                <strong>Well done!</strong> Personal information has been updated.
            </div>
            <?php
        } else if ($success == 2) {
            ?>
            <div class="alert alert-success">
                <strong>Well done!</strong> New password has been updated.
            </div>
            <?php
        } else if ($success == 3) {
            ?>
            <div class="alert alert-danger">
                <strong>Sorry!</strong> New password mismatched.
            </div>
            <?php
        } else if ($success == 4) {
            ?>
            <div class="alert alert-danger">
                <strong>Sorry!</strong> Current password mismatched.
            </div>
            <?php
        } 
    ?>
    
    
    <div class="row">
	    <div class="col-md-7">
		    <div class="panel panel-default">
		        <div class="panel-heading">
		            <h4 class="panel-title">Personal Information</h4>
		        </div>
		        <div class="table-responsive">
			        <form name="form" action="" method="post" class="form">
			            <table class="table">
			                <tbody>
				                <?php
					            	$getInfo = $db->prepare("SELECT * FROM rumah_user WHERE uname =:uname ");
					            	$getInfo->bindparam(":uname",$_SESSION['uname']);
					            	$getInfo->execute();
					            	$r = $getInfo->fetch(PDO::FETCH_ASSOC);         
					           	?>
				                <tr>
					                <th>
						                <div class="row">
							                <div class="col-md-4">
								                Username
							                </div>
							                <div class="col-md-8">
								                <div class="controls col-sm-8 col-md-8 col-lg-8">
								                	<?php echo $_SESSION['uname']; ?> 
								                </div>
							                </div>
						                </div>
					                </th>
				                </tr>
				                <tr>
					                <th>
						                <div class="row">
							                <div class="col-md-4">
								                Fullname
							                </div>
							                <div class="col-md-8">
								                <div class="controls col-sm-8 col-md-8 col-lg-8">
								                	<input type="text" name="name" class="form-control" value="<?php echo $r['name']; ?>"> 
								                </div>
							                </div>
						                </div>
					                </th>
				                </tr>
				                <tr>
					                <th>
						                <div class="row">
							                <div class="col-md-4">
								                Phone No.
							                </div>
							                <div class="col-md-8">
								                <div class="controls col-sm-8 col-md-8 col-lg-8">
								                	<input type="text" name="phone" class="form-control" value="<?php echo $r['phone']; ?>"> 
								                </div>
							                </div>
						                </div>
					                </th>
				                </tr>
				                <tr>
					                <th>
						                <div class="row">
							                <div class="col-md-4">
								                Email Address
							                </div>
							                <div class="col-md-8">
								                <div class="controls col-sm-8 col-md-8 col-lg-8">
								                	<input type="email" name="email" class="form-control" value="<?php echo $r['email']; ?>"> 
								                </div>
							                </div>
						                </div>
					                </th>
				                </tr>
				                <tr>
					                <th>
						                <div class="row">
							                
							                <div class="col-md-12">
								                <center><button type="submit" name="submit" class="btn btn-lg btn-flat btn-primary">Submit</button></center>
							                </div>
						                </div>
					                </th>
				                </tr>
			                </tbody>
			            </table>
			        </form>
		        </div>
		    </div>
	    </div>
	    <div class="col-md-5">
		    <div class="panel panel-default">
		        <div class="panel-heading">
		            <h4 class="panel-title">Change Password</h4>
		        </div>
		        <div class="table-responsive">
			        <form name="form" action="" method="post" class="form">
			            <table class="table">
			                <tbody>
				                <tr>
					                <th>
						                <div class="row">
							                <div class="col-md-4">
								                Old Password
							                </div>
							                <div class="col-md-8">
								                <div class="controls col-sm-8 col-md-8 col-lg-8">
								                	<input type="password" name="oldpwd" class="form-control"> 
								                </div>
							                </div>
						                </div>
					                </th>
				                </tr>
				                <tr>
					                <th>
						                <div class="row">
							                <div class="col-md-4">
								                New Password
							                </div>
							                <div class="col-md-8">
								                <div class="controls col-sm-8 col-md-8 col-lg-8">
								                	<input type="password" name="pwd1" class="form-control"> 
								                </div>
							                </div>
						                </div>
					                </th>
				                </tr>
				                <tr>
					                <th>
						                <div class="row">
							                <div class="col-md-4">
								               	Reenter Password
							                </div>
							                <div class="col-md-8">
								                <div class="controls col-sm-8 col-md-8 col-lg-8">
								                	<input type="password" name="pwd2" class="form-control"> 
								                </div>
							                </div>
						                </div>
					                </th>
				                </tr>
				                <tr>
					                <th>
						                <div class="row">
							                
							                <div class="col-md-12">
								                <center><button type="submit" name="submit2" class="btn btn-lg btn-flat btn-primary">Submit</button></center>
							                </div>
						                </div>
					                </th>
				                </tr>
			                </tbody>
			            </table>
			        </form>
		        </div>
		    </div>
	    </div>
    </div>
</div>

            </div>
        </div>
        <script src="dist/assets/libs/jquery/jquery.min.js"></script>
        <script src="dist/assets/bs3/js/bootstrap.min.js"></script>
        <script src="dist/assets/plugins/jquery-navgoco/jquery.navgoco.js"></script>
        <script src="dist/js/main.js"></script>

        <!--[if lt IE 9]>
        <script src="dist/assets/plugins/flot/excanvas.min.js"></script>
        <![endif]-->
        <script src="dist/assets/plugins/jquery-sparkline/jquery.sparkline.js"></script>
        <script src="demo/js/demo.js"></script>

        <script src="dist/assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="dist/assets/plugins/jquery-jvectormap/maps/world_mill_en.js"></script>

        <!--[if gte IE 9]>-->
        <script src="dist/assets/plugins/rickshaw/js/vendor/d3.v3.js"></script>
        <script src="dist/assets/plugins/rickshaw/rickshaw.min.js"></script>
        <!--<![endif]-->

        <script src="dist/assets/libs/jquery-ui/minified/jquery-ui.min.js"></script>
        <script src="dist/assets/plugins/jquery-select2/select2.min.js"></script>
        <script src="dist/assets/plugins/jquery-selectboxit/javascripts/jquery.selectBoxIt.min.js"></script>
        <script src="dist/assets/plugins/jquery-chosen/chosen.jquery.min.js"></script>
        <script src="dist/assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
        <script src="dist/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
        <script src="dist/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="dist/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
        <script src="dist/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
        <script src="demo/js/forms-advanced-components.js"></script>



    </body>
</html>
