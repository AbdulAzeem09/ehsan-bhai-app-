<?php
	//  error_reporting(E_ALL);
	//  ini_set('display_errors', '1');

	if (!defined('WEB_ROOT')) {
		exit;
	}
	
	
	if(isset($_POST["btnButton"])){
		//print_r($_POST);die('+++');
		$id= $_GET['id'];

		$subCategoryTitle=$_POST["subCategoryTitle"];

		$sql="UPDATE `subcategory` SET `subCategoryTitle`='$subCategoryTitle' WHERE idsubCategory= $id ";
		$result = dbQuery($dbConn,$sql);



		
		redirect('index.php?view=StoreCategory');
	}

		



		
	
	if(isset($_GET['id'])){
		$id= $_GET['id'];

	$sql1= "SELECT * FROM `subcategory` WHERE idsubCategory= $id ";
	$result2 = dbQuery($dbConn,$sql1);
	$row = dbFetchAssoc($result2);
	// print_r ($row);die('====');
	}
?>

	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Store Category<small>[Edit]</small></h1>
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
										<label>Category</label></br>
										<input type="text" name="subCategoryTitle" id="subCategoryTitle" class="form-control" value="<?php echo $row['subCategoryTitle']; ?>" style="width: 30% !important">
									</div>
								</div>
								





							</div>
							
						</div>
						
						<div class="box-footer"> 
	                        <input type="submit" name="btnButton" value="Update" class="btn vd_btn vd_bg-green finish" /> &nbsp;
	                        <input type="button" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php?view=StoreCategory'" /> &nbsp;
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