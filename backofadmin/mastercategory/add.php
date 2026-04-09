<?php

ini_set('display_errors', 0);
	if (!defined('WEB_ROOT')) {
		exit;
	}	
?>
	<!-- Main content -->
	<section class="content" >
		<!-- start any work here. -->
		<form name="frmAddMainNav" id="frmAddMainNav" method="post" action="processSubCategory.php?action=add"  enctype="multipart/form-data" >
			
			<div class="box box-success">
				<div class="box-body">
					<div class="" id="alertmsg" >
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
						<!--<div class="col-md-3 col-sm-6" >
							<div class="form-group">
								<label>Category:</label><span class="red">*</span>
								<select class="form-control" name="txtCategory" id="txtCategory" >
									<?php allcategory($dbConn);?>
								</select>
								<span id=cat_error  class="red"></span>
							</div>
						</div> -->
						<div class="col-md-4 col-sm-6" >
							<div class="form-group">
								<label>Category Name:</label><span class="red">*</span>
								<input type="text" name="category_name" id="category_name" class="form-control" maxlength="40" required>
								<span id=subcat_error  class="red"></span>
							</div>
						</div>						                    
					</div>
					<div class="box-footer"> 
                        <input type="submit" id="add" name="btnButton" value="Save" class="btn vd_btn vd_bg-green finish" /> &nbsp;
                        <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> 
                    </div>
                </div>
			</div>
			
		</form>
	</section>