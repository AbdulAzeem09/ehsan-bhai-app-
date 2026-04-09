<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

	if(isset($_GET['subCat']) && ($_GET['subCat']) > 0){
		$subCat  = $_GET['subCat'];
	}else {
		redirect('index.php');
	}
	$sql = "SELECT * FROM masterdetails WHERE idmasterDetails ='$subCat'";
	$result = dbQuery($dbConn, $sql);
	$row    = dbFetchAssoc($result);
	extract($row);
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Business Category <small>[Modify]</small></h1>
	</section>
	<!-- Main content -->
	<section class="content" >
		<!-- start any work here. -->
		<form name="frmAddMainNav" id="frmAddMainNav" method="post" action="processSubCategory.php?action=modify"  enctype="multipart/form-data" >
			<input type="hidden" name="hidId" id="hidId"  value="<?php echo $idmasterDetails;?>"/>
            
			<div class="box box-success">
				<div class="box-body">
					<div class="" id="alertmsg" style="margin: 10px 0px 0px 5px;">
						<?php 
						if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
							if($_SESSION['count'] <= 1){
								$_SESSION['count'] +=1; ?>
								<div style="min-height:10px;"></div>
								<div class="alert alert-<?php echo $_SESSION['data'];?>">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<?php echo $_SESSION['errorMessage'];  ?>
								</div> <?php
								unset($_SESSION['errorMessage']);
							}
						} ?>
					</div>
					<div class="row">
						<div class="col-md-4 col-sm-6" >
							<div class="form-group">
								<label>Category Name:</label><span class="red">*</span>
								<input type="text" name="category_name" id="category_name" class="form-control" maxlength="40" value="<?php echo $masterDetails;?>" required>
								<span id=subcat_error  class="red"></span>
							</div>
						</div>	
					</div>
				</div>
				<div class="box-footer"> 
                    <input type="submit" id="add" name="btnButton" value="Update" class="btn vd_btn vd_bg-green finish" />&nbsp;
                    <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> &nbsp;
                </div>
			</div>
		</form>
	</section>