<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

	if(isset($_GET['id']) && ($_GET['id']) > 0){
		$hidId  = $_GET['id'];
	}else {
		redirect('index.php');
	}
	$sql = "SELECT * FROM tbl_social WHERE spSocId ='$hidId'";
	$result = dbQuery($dbConn, $sql);
	$row    = dbFetchAssoc($result);
	extract($row);
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Modify</h1>
	</section>
	<!-- Main content -->
	<section class="content" >
		<!-- start any work here. -->
		<form name="frmAddMainNav" id="frmAddMainNav" method="post" action="processSocial.php?action=modify"  enctype="multipart/form-data" onsubmit="return validate(this)">
			<input type="hidden" name="hidId" id="hidId"  value="<?php echo $hidId;?>"/>
            
			<div class="box box-success">
				<div class="box-body">
					<div class="row" id="alertmsg" style="margin: 10px 0px 0px 5px;">
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
						
						<div class="col-md-4 col-sm-4" >
							<div class="form-group">
								<label>Name</label></br>
								<input type="text" name="txtTitle" id="txtTitle" value="<?php echo $spSocTitle;?>" class="form-control" required="required"/>
							</div>
							
						</div>
						<div class="col-md-4 col-sm-4">
							<div class="form-group">
								<label>Icon:</label>
								<input type="text" name="txtIcon" id="txtIcon" class="form-control" value="<?php echo $spSocIcon?>" required="required"/>
							</div>
						</div>
						<div class="col-md-4 col-sm-4">
							<div class="form-group">
								<label>Status :</label></br>
								<input type="radio" name="radStatus" id="radStatus" value="1" <?php if($status == 1){echo "Checked";}?> />
								<span class="txtDarkGray14">Active</span> &nbsp;
								<input type="radio" name="radStatus" id="radStatus" value="0" <?php if($status == 0){echo "Checked";}?> />
								<span class="txtDarkGray14">In Active</span>
							</div>
						</div>		
						<div class="col-md-12 col-sm-12">
							<div class="form-group">
								<label>Link:</label>
								<input type="text" name="txtLink" id="txtLink" class="form-control" value="<?php echo $spSocLink?>" required="required"/>
							</div>
						</div>

					</div>
				</div>
				<div class="box-footer"> 
                    <input type="submit" name="btnButton" value="Update" class="btn vd_btn vd_bg-green finish" /> &nbsp;
                    <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> &nbsp;
                </div>
			</div>
			
		</form>
	</section><!-- /.content -->
		