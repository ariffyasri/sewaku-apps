<?php 
	$title = 'creditors';
	include 'header.php'; 
	$success=null;
	if (isset($_GET['status'])) {
		$status = $_GET['status'];
		$id = $_GET['id'];
		
		$stmt = $db->prepare("UPDATE rumah_expense SET status = :status WHERE id =:id ");
        $stmt->bindparam(":status",$status);
        $stmt->bindparam(":id",$id);
        $stmt->execute();
		$success = 1;
	}
	
	
?>

<div class="container-fluid-md">
	<?php
        if ($success == 1) {
            ?>
            <div class="alert alert-success">
                <strong>Well done!</strong> We've been alerted and waiting for confirmation.
            </div>
            <?php
        } 
    ?>
	<div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Basic Table</h4>

            <div class="panel-options">
                <a href="#" data-rel="collapse"><i class="fa fa-fw fa-minus"></i></a>
                <a href="#" data-rel="reload"><i class="fa fa-fw fa-refresh"></i></a>
                <a href="#" data-rel="close"><i class="fa fa-fw fa-times"></i></a>
            </div>
        </div>
        <div class="panel-body">
            <table id="table-basic" class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Credit to</th>
                        <th>Title</th>
                        <th>Cost</th>
                        <th>Date</th>
                        <th>Action</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
	                <?php
		            	$index = 0;
						$findDebtors = $db->prepare("SELECT * FROM rumah_expense WHERE charge_to = :charge_to AND status != 'Paid' ORDER BY id DESC ");
                        $findDebtors->bindparam("charge_to",$_SESSION['uname']);
                        $findDebtors->execute();
						while ($r = $findDebtors->fetch(PDO::FETCH_ASSOC)) {
							$status = $r['status'];
							?>
								<tr class="odd gradeX">
			                        <td><?php echo ++$index; ?></td>
			                        <td><?php echo $r['post_from']; ?></td>
			                        <td><?php echo $r['title']; ?></td>
			                        <td class="center">RM<?php echo $r['cost']; ?></td>
			                        <td class="center"><?php echo $r['date_added']; ?></td>
			                        <td class="center">
				                        <?php 
					                      	if ($status == 'Pending') {
						                      	?>
<!-- 						                      		<a class="btn btn-danger btn-xs"><i class="fa fa-times"></i></a> -->
											  	<?php
					                      	} else if ($status == 'Unpaid') {
						                      	?>
						                      		<a class="btn btn-success btn-xs" href='creditors.php?id=<?php echo $r['id']; ?>&status=Pending'>I've Paid</a>
						                      	<?php
					                      	}
					                        
					                    ?>
					                    
					                    
			                        </td>
			                        <td class="center"><?php echo $status; ?></td>
			                    </tr>
							<?php
						}  
		         	?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Credit to</th>
                        <th>Title</th>
                        <th>Cost</th>
                        <th>Date</th>
                        <th>Action</th>
                        <th>Status</th>
                    </tr>
                </tfoot>
            </table>
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

        <script src="dist/assets/plugins/jquery-datatables/js/jquery.dataTables.js"></script>
        <script src="dist/assets/plugins/jquery-datatables/js/dataTables.tableTools.js"></script>
        <script src="dist/assets/plugins/jquery-datatables/js/dataTables.bootstrap.js"></script>
        <script src="dist/assets/plugins/jquery-select2/select2.min.js"></script>
        <script src="demo/js/tables-data-tables.js"></script>



    </body>
</html>
