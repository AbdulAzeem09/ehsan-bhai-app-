<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

	if(isset($_GET['id']) && ($_GET['id']) > 0){
		$id  = $_GET['id'];
	}else {
		redirect('index.php');
	}

	$sql = "SELECT * FROM tbl_posting_content WHERE pc_id ='$id'";
	$result = dbQuery($dbConn, $sql);
	$row    = dbFetchAssoc($result);
	extract($row);
?>
	<script type="text/javascript" src="<?php echo WEB_ROOT_ADMIN; ?>fckeditor/fckeditor.js"></script>

	<script type="text/javascript">		
		window.onload = function(){
			// Automatically calculates the editor base path based on the _samples directory.
			// This is usefull only for these samples. A real application should use something like this:
			// oFCKeditor.BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
			var sBasePath = '../../fckeditor/' ;
			var oFCKeditor = new FCKeditor( 'txtDesc' ) ;
			oFCKeditor.BasePath	= sBasePath ;
			oFCKeditor.ReplaceTextarea() ;
		}
	</script>

	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Modify Posting Content</h1>
	</section>
	<!-- Main content -->
	<section class="content" >
		<!-- start any work here. -->
		<form name="frmAddMainNav" id="frmAddMainNav" method="post" action="process.php?action=modify"  enctype="multipart/form-data" onsubmit="return validate(this)">
			<input type="hidden" name="hidId" id="hidId"  value="<?php echo $id;?>"/>
            
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
						<div class="col-md-4">
							<div class="form-group">
								<label>Module</label>
								<select class="form-control" name="txtModule">
									<option>==Select Module==</option>
									<?php
									$sql = "SELECT * FROM spcategories WHERE spCategoryStatus = 1";
									$result = dbQuery($dbConn, $sql);
									if ($result) {
										while ($row = dbFetchAssoc($result)) {
											?>
											<option value="<?php echo $row['idspCategory']?>" <?php echo ($row['idspCategory'] == $module_id)?'selected':'';?> ><?php echo $row['spCategoryName'];?></option>
											<?php
										}
									}
									?>
									
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Heading</label>
								<input type="text" name="txtHeading" class="form-control" value="<?php echo $pc_title; ?>" >
							</div>
						</div>
						<div class="col-md-12 col-sm-12" style="margin-bottom:20px;">
							<label>Description:</label></br>
							<textarea class="formField" rows="6" name="txtDesc"><?php echo $pc_content; ?></textarea>
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
		