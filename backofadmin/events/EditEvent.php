<?php
	//  error_reporting(E_ALL);
	//  ini_set('display_errors', '1');

	if (!defined('WEB_ROOT')) {
		exit;
	}
	

	if(isset($_POST["sumevent"])){
		$id= $_GET['id'];
		$price=$_POST["price"];
		$duration=$_POST["duration"];
		$status=$_POST["status"];

		
		$sql=" UPDATE `event_feature_plan` SET `price`= '$price',`duration`= '$duration' ,`status`= '$status' WHERE id = $id ";

		$result = dbQuery($dbConn,$sql);	
		redirect('index.php?view=FeatureEventPrice');
	}
		

	if(isset($_GET['id'])){
		$id= $_GET['id'];
		$sql1 = "SELECT * FROM event_feature_plan WHERE id = $id ";
		$result2 = dbQuery($dbConn, $sql1);
		$row = dbFetchAssoc($result2);
		extract($row);
		
	
	}
?>

	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Feature Event Price<small>[Add]</small></h1>
	</section>
	<!-- Main content -->
	<section class="content" >
		<div class="row">
			<div class="col-md-12">
				<!-- start any work here. -->
				<form action="" method="post" name="frmAddAdmin" id="frmAddAdmin">
					<div class="box box-primary">
						<div class="box-body">
							<div class="row">
							<div class="col-md-11 col-sm-12">
							<div class="form-group">
						<label for="price">Price:</label>
						<input type="number" class="form-control" id="price" name="price" style="width: 30% !important" value="<?php echo $price ; ?>">
					</div>
					<div class="form-group">
						<label for="duration">Duration:</label>
						<input type="number" class="form-control" id="duration" name="duration" style="width: 30% !important" value="<?php echo $duration ; ?>">
					</div>
					<div class="form-group">
						<label for="status">Status:</label><br>
						<div class="radio">
						<label>
							<input type="radio" name="status" id="status_active" value="1" <?php if($status==1){ echo 'checked';} ?> > Active
						</label>
						</div>
						<div class="radio">
						<label>
							<input type="radio" name="status" id="status_inactive" value="0" <?php if($status ==0){ echo 'checked';} ?>> Inactive
						</label>
						</div>
								</div>
							</div>
							
						</div>		
						<div class="box-footer"> 
	                        <input type="submit" name="sumevent" value="Add" class="btn vd_btn vd_bg-green finish" /> &nbsp;
	                        <input type="button" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php?view=FeatureEventPrice'" /> &nbsp;
	                    </div>
						
					</div>
				</form>
			</div>
		</div>
	</section><!-- /.content -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>

 $("#checkAll").click(function() {
   $('input:checkbox').not(this).prop('checked', this.checked);
 });
</script>