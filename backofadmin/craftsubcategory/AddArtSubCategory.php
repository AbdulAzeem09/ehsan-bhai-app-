<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	
	if(isset($_POST["btnButtonSub"])){
		$idsubCategory=$_POST["artcateidsp"];
		$subCategoryTitle=$_POST["txtTitle"];
		$sql33="INSERT INTO `art_subcategory`(`spArtgalleryTitle`, `idspArtcategory`) VALUES ('$subCategoryTitle','$idsubCategory')";
		$result33 = dbQuery($dbConn,$sql33);
		redirect('index.php?view=ArtSubCategory');
	}
?>
	<!-- Content Header (Page header) -->
	
	<!-- Main content -->
	<section class="content" >
		<!-- start any work here. -->
		<form name="frmAddMainNav" id="frmAddMainNav" method="post" action=""  enctype="multipart/form-data" onsubmit="return validate(this)">
			
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
						
						<div class="col-md-6 col-sm-6" style="margin-bottom:20px;">
							<label>Category:</label></br>
							<select  class="form-control" required="required" name="artcateidsp">
								<option value="0">Select</option>
							<?php 
							if ($result) {
								$i = 1;
								while ($row = dbFetchAssoc($result)) {
									extract($row);
							?>
								<option value="<?php echo $row['idspArtgallery'];?>"><?php echo $row['spArtgalleryTitle']; ?></option>
							<?php }
									}
							?>
							</select>
							
						</div>
						
						<div class="col-md-6 col-sm-6" style="margin-bottom:20px;">
							<label>Sub Category:</label></br>
							<input type="text" name="txtTitle" id="txtTitle" class="form-control" required="required"/>
						</div>
						
						                    
					</div>
				</div>
				<div class="box-footer"> 
                    <input type="submit" name="btnButtonSub" value="Save" class="btn vd_btn vd_bg-green finish" /> &nbsp;
                    <input type="button" name="btnButtonSub" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php?view=ArtSubCategory'" /> &nbsp;
                </div>
			</div>
			
		</form>
	</section><!-- /.content -->
		