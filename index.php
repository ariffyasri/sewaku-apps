<?php
	$title = 'index';
	include 'header.php'; 
	$status = null;
	if (isset($_POST['submit'])) {
		$title = trim($_POST['title']);
		$type = trim($_POST['type']);
		$cost = filter_var($_POST['cost'],FILTER_VALIDATE_FLOAT);
		$date_added = $_POST['date'].' '.$_POST['time'].':00';
		$stat = 'Unpaid';
		$post_from = $_SESSION['uname'];
		
		$fileError = $_FILES['imageFile']['error'];
		if($fileError > 0) {
			$status = 2;
		}
		$maxSize = 100000;
		$fileType = $_FILES['imageFile']['type'];
		$fileSize = $_FILES['imageFile']['size'];
		$fileName = $_FILES['imageFile']['tmp_name'];
		$trueFiletype = exif_imagetype($_FILES['imageFile']['tmp_name']);
		$allowedImage = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
		$fileExt = '';
		if(in_array($trueFiletype, $allowedImage)) {
			if($fileSize > $maxSize) {
				$status = 2;
			}
			else {
				switch($trueFiletype){
					case 1: $fileExt = ".gif";
					break;
					case 2: $fileExt = ".jpg";
					break;
					case 3: $fileExt = ".png";
					break;
				}
			}
		}
		else {
			$status = 2;
		}

		$imageDir = 'image/';
		
		
		$total = 1;
		if(!empty($_POST['check'])) {
		    foreach($_POST['check'] as $check) {
	           	$total++;                 
		    }
		}
		
		$cost = $cost / $total;
		if(!empty($_POST['check'])) {
		    foreach($_POST['check'] as $check) {
		    	try {
			        $getPhone = $db->prepare("SELECT phone FROM rumah_user WHERE uname=:uname");
			        $getPhone->bindparam(":uname",$check);
			        $getPhone->execute();
			        $row = $getPhone->fetch(PDO::FETCH_ASSOC);
		        	$phone = $row['phone'];
	        	   	//sendSMS($phone, $cost, $type, $post_from); 			        
	            	$insert = $db->prepare("INSERT INTO rumah_expense (title, type, cost, post_from, charge_to, date_added, status) VALUES (:title,:type,:cost,:postfrom,:checked,:date_added,:status)");
	            	$insert->bindparam(":title",$title);
	            	$insert->bindparam(":type",$type);
	            	$insert->bindparam(":cost",$cost);
	            	$insert->bindparam(":postfrom",$post_from);
	            	$insert->bindparam(":checked",$check);
	            	$insert->bindparam(":date_added",$date_added);
	            	$insert->bindparam(":status",$stat);
	            	$insert->execute();	
	            	$newIDImage = $db->lastInsertId();
	            	$newNameImage = $newIDImage . $fileExt;

	            	$insert = $db->prepare("UPDATE rumah_expense SET image=:image WHERE id=:id ");
	            	$insert->bindparam(":image",$newNameImage);
	            	$insert->bindparam(":id",$newIDImage);
	            	$insert->execute();

	            	$newImageLocation = $imageDir . $newNameImage;
	            	if(move_uploaded_file($fileName, $newImageLocation)) {
	            		$status = 1;
	            	}
	            	else {
	            		$status = 2;
	            	}

		    	}
		    	catch(PDOException $e) {
		    		$e->getMessage();
		    	}      
		    }
		}
	}
?>

<div class="container-fluid-md">
	<div class="row">
        <div class="col-sm-12 col-lg-6">
            <div class="panel panel-metric panel-metric-sm">
                <div class="panel-body panel-body-primary">
                    <div class="metric-content metric-icon">
                        <div class="value">
	                        <?php
		                        $findTotal = $db->prepare("SELECT sum(cost) as total FROM rumah_expense WHERE post_from=:session AND status !='Paid'");
		                        $findTotal->bindparam(":session",$_SESSION['uname']);
		                        //$findTotal->bindParam(":status",'Paid');
		                        $findTotal->execute();

		                        $r = $findTotal->fetch(PDO::FETCH_ASSOC);
		                        if ($r['total'] == NULL) {
			                        echo 'RM0.00';
		                        } else {
			                        echo 'RM'.$r['total'];
		                        }
		                        
		                        
		                    ?>
                            
                        </div>
                        <div class="icon">
                            <i class="fa fa-trophy"></i>
                        </div>
                        <header>
                            <h3 class="thin">Unpaid Advanced</h3>
                        </header>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-6">
            <div class="panel panel-metric panel-metric-sm">
                <div class="panel-body panel-body-danger">
                    <div class="metric-content metric-icon">
                        <div class="value">
                        	<?php
		                        $findTotal = $db->prepare("SELECT sum(cost) as total FROM rumah_expense WHERE charge_to =:session AND status !='Paid'");
		                        $findTotal->bindparam(":session",$_SESSION['uname']);
		                        //$findTotal->bindParam(":status","Paid");
		                        $findTotal->execute();

		                        $r = $findTotal->fetch(PDO::FETCH_ASSOC);
		                        if ($r['total'] == NULL) {
			                        echo 'RM0.00';
		                        } else {
			                        echo 'RM'.$r['total'];
		                        }
		                        
		                        
		                    ?>                            
                        </div>
                        <div class="icon">
                            <i class="fa fa-money"></i>
                        </div>
                        <header>
                            <h3 class="thin">Unpaid Debt</h3>
                        </header>
                    </div>
                </div>
            </div>
        </div>
	</div>
	
	<?php
        if ($status == 1) {
            ?>
            <div class="alert alert-success">
                <strong>Well done!</strong> Data has been added.
            </div>
            <?php
        } 
    ?>
    <?php
        if ($status == 2) {
            ?>
            <div class="alert alert-success">
                <strong>Well something wrong!</strong>.
            </div>
            <?php
        } 
    ?>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4 class="panel-title">Fill in the form</h4>
            
           
        </div>
        <div class="table-responsive">
	        <form name="form" action="" method="post" class="form" enctype="multipart/form-data">
	            <table class="table">
	                <tbody>
		                <tr>
			                <th>
				                <div class="row">
					                <div class="col-md-4">
						                Title
					                </div>
					                <div class="col-md-8">
						                <div class="controls col-sm-8 col-md-8 col-lg-8">
						                	<input type="text" name="title" class="form-control"> 
						                </div>
					                </div>
				                </div>
			                </th>
		                </tr>
		                <tr>
			                <th>
				                <div class="row">
					                <div class="col-md-4">
						                Type
					                </div>
					                <div class="col-md-8">
						                <div class="controls col-sm-8 col-md-8 col-lg-8">
	                                    	<select class="form-control form-chosen" name="type" data-placeholder="Choose a type...">
		                                    	<option value="Bill">Bill</option>
		                                        <option value="Sewa Rumah">Sewa Rumah</option>
		                                        <option value="Makanan">Makanan</option>
		                                    </select>
						                </div>
					                </div>
				                </div>
			                </th>
		                </tr>
		                <tr>
			                <th>
				                <div class="row">
					                <div class="col-md-4">
						                Image
					                </div>
					                <div class="col-md-8">
						                <div class="controls col-sm-8 col-md-8 col-lg-8">
						                	<input type="file" name="imageFile" id="imageFile"> 
						                </div>
					                </div>
				                </div>
			                </th>
		                </tr>
		                <tr>
			                <th>
				                <div class="row">
					                <div class="col-md-4">
						                Cost
					                </div>
					                <div class="col-md-8">
						                <div class="controls col-sm-8 col-md-8 col-lg-8">
						                	<input type="text" name="cost" class="form-control"> 
						                </div>
					                </div>
				                </div>
			                </th>
		                </tr>
		                <tr>
			                <th>
				                <div class="row">
					                <div class="col-md-4">
						                Team Involved
					                </div>
					                <div class="col-md-8 form-group">
						               <div class="controls col-sm-8 col-md-8 col-lg-8">
						               		<?php
		                        				$findTotal = $db->prepare("SELECT * FROM rumah_user WHERE uname != :uname");
		                        				$findTotal->bindparam(":uname",$_SESSION['uname']);
		                        				$findTotal->execute();
		                        				
		                        				if($findTotal->rowCount()==0) {
		                        					?>
		                        					<label>
		                        					No team :(
		                        					</label><br>
		                        					<?php
		                        				}
		                        				else {
		                        					while($r = $findTotal->fetch(PDO::FETCH_ASSOC)){
		                        					?>
									           		<label>
						                                <input type="checkbox" class="icheck line-blue" name="check[]" value="<?php echo $r['uname']; ?>" checked>
						                                <?php echo $r['name']; ?>
						                            </label><br>
									           		
									           		<?php
		                        					} 
		                        				}
		                        				
								                
											?>
				                           
				                        </div>
					                </div>
				                </div>
			                </th>
		                </tr>
		                <tr>
			                <th>
				                <div class="row">
					                <div class="col-md-4">
						                Date/Time
					                </div>
					                <div class="col-md-8 form-group">
			                            <div class="controls col-sm-8 col-md-8 col-lg-8">
			                                <input type="text" name="date" class="form-control" data-rel="datepicker" value="<?php echo date('Y-m-d'); ?>"><br>
			                                <input type="text" name="time" class="form-control" data-rel="timepicker" id="inputTimepicker24" data-show-meridian="false" data-show-seconds="false" >
			                            </div>
			                           
				                        
					                </div>
				                </div>
			                </th>
		                </tr>
		                <tr>
			                <th>
				                <div class="row">
					                
					                <div class="col-md-12">
						                <center><button type="submit" name="submit" value="submit" class="btn btn-lg btn-flat btn-primary">Submit</button></center>
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
        
        <script src="dist/assets/plugins/jquery-autogrow-textarea/jquery.autogrow-textarea.js"></script>
        <script src="dist/assets/plugins/jquery-icheck/icheck.min.js"></script>
        <script src="dist/js/icheck.js"></script>
        <script src="demo/js/forms-basic-elements.js"></script>



    </body>
</html>

<?php
	function sendSMS($phone, $cost, $type, $from) {
		//using bulk sms
	}	
	
	
	
?>