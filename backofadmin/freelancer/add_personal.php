<?php
	//  error_reporting(E_ALL);
	//  ini_set('display_errors', '1');

	if (!defined('WEB_ROOT')) {
		exit;
	}
	
	
	if(isset($_POST["btnButton"])){
		$subCategoryTitle=$_POST["subCategoryTitle"];
		$pid=$_SESSION['pid'];
		$sql="INSERT INTO `masterdetails`(`masterDetails`,`master_idmaster`) VALUES ('$subCategoryTitle','26')";

		
		//SELECT * FROM `subcategory` WHERE spCategories_idspCategory=5 AND subCategoryStatus=1
		$result = dbQuery($dbConn,$sql);



		
		redirect('index.php?view=personal_list');
	}

		

?>

	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Add Category <small>[Add]</small></h1>
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
										<input type="text" name="subCategoryTitle" id="subCategoryTitle" class="form-control" style="width: 30% !important">
									</div>
								</div>
								





							</div>
							
						</div>
						
						<div class="box-footer"> 
	                        <input type="submit" name="btnButton" value="Add" class="btn vd_btn vd_bg-green finish" /> &nbsp;
	                        <input type="button" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php?view=category'" /> &nbsp;
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