<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	if (isset($_GET['view']) && $_GET['view'] == 'headings') {
		$catId = 21;
		$catTitle = "Headings";
	}else if (isset($_GET['view']) && $_GET['view'] == 'store') {
		$catId = 1;
		$catTitle = "Store";
	}
   else if (isset($_GET['view']) && $_GET['view'] == 'emailcontent') {
		$catId = 22;
		$catTitle = "Email Content";
	}

	else if(isset($_GET['view']) && $_GET['view'] == 'jobBoard'){
		$catId = 2;
		$catTitle = "Job Board";
	}else if(isset($_GET['view']) && $_GET['view'] == 'reaalEstate'){
		$catId = 3;
		$catTitle = "Real Estate";
	}else if(isset($_GET['view']) && $_GET['view'] == 'freelance'){
		$catId = 5;
		$catTitle = "Freelance";
	}else if(isset($_GET['view']) && $_GET['view'] == 'clasified'){
		$catId = 7;
		$catTitle = "Classified Ads";
	}else if(isset($_GET['view']) && $_GET['view'] == 'trainings'){
		$catId = 8;
		$catTitle = "Trainings";
	}else if(isset($_GET['view']) && $_GET['view'] == 'events'){
		$catId = 9;
		$catTitle = "Events";
	}else if(isset($_GET['view']) && $_GET['view'] == 'videos'){
		$catId = 10;
		$catTitle = "Videos";
	}else if(isset($_GET['view']) && $_GET['view'] == 'artgallery'){
		$catId = 13;
		$catTitle = "Art Gallery";
	}else if(isset($_GET['view']) && $_GET['view'] == 'music'){
		$catId = 14;
		$catTitle = "Music";
	}else if(isset($_GET['view']) && $_GET['view'] == 'directory'){
		$catId = 19;
		$catTitle = "Business Directory";
	}else{
		if (isset($_GET['view']) && $_GET['view'] == 'home') {
			// this is custom id which is not define in database
			$catId = 20;
			$catTitle = "Home";
		}else{
			$catId = 0;
			$catTitle = "";
		}
		
	}


	$_GET['module'] = 'store';
	if (isset($catId)) {
		$sql = "SELECT * FROM tbl_setting WHERE spCategory_idspCategory = $catId ";
		$result = dbQuery($dbConn, $sql);
		if ($result && dbNumRows($result) > 0) {
			$row = dbFetchAssoc($result);
			extract($row);
		}
	}
	

?>
	<?php include(THEME_PATH . '/tb_link.php');?>
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Setting</h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-3">
				<div class="box box-primary">
	                <div class="box-header with-border">
	                    <h3 class="box-title">Modules</h3>
	                    <div class='box-tools'>
	                        <button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
	                    </div>
	                </div>
	                <div class="box-body no-padding">
	                    <?php

	                    ?>
	                    <ul class="nav nav-pills nav-stacked">
	                    	<li class="<?php echo (isset($catId) && $catId == '20')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'setting/index.php?view=home'; ?>"><i class="fa fa-circle-o"></i> Home</a></li>
	                    	<li class="<?php echo (isset($catId) && $catId == '22')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'setting/index.php?view=emailcontent'; ?>"><i class="fa fa-circle-o"></i> Invite Email Content</a></li>
	                    	<li class="<?php echo (isset($catId) && $catId == '21')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'setting/index.php?view=headings'; ?>"><i class="fa fa-circle-o"></i> Headings</a></li>
	                       	<li class="<?php echo (isset($catId) && $catId == '1')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'setting/index.php?view=store'; ?>"><i class="fa fa-circle-o"></i> Stores</a></li>
	                       	<li class="<?php echo (isset($catId) && $catId == '2')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'setting/index.php?view=jobBoard'; ?>"><i class="fa fa-circle-o"></i> Job Board</a></li>
	                       	<li class="<?php echo (isset($catId) && $catId == '3')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'setting/index.php?view=reaalEstate'; ?>"><i class="fa fa-circle-o"></i> Real Estate</a></li>
	                       	<li class="<?php echo (isset($catId) && $catId == '5')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'setting/index.php?view=freelance'; ?>"><i class="fa fa-circle-o"></i> Freelance</a></li>
	                        <li class="<?php echo (isset($catId) && $catId == '7')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'setting/index.php?view=clasified'; ?>"><i class="fa fa-circle-o"></i> Classified ads</a></li>
	                        <li class="<?php echo (isset($catId) && $catId == '8')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'setting/index.php?view=trainings'; ?>"><i class="fa fa-circle-o"></i> Trainings</a></li>
	                        <li class="<?php echo (isset($catId) && $catId == '9')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'setting/index.php?view=events'; ?>"><i class="fa fa-circle-o"></i> Events</a></li>
	                       	<li class="<?php echo (isset($catId) && $catId == '10')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'setting/index.php?view=videos'; ?>"><i class="fa fa-circle-o"></i> Videos</a></li>
	                        <li class="<?php echo (isset($catId) && $catId == '13')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'setting/index.php?view=artgallery'; ?>"><i class="fa fa-circle-o"></i> Art Gallery</a></li>
	                        <li class="<?php echo (isset($catId) && $catId == '14')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'setting/index.php?view=music'; ?>"><i class="fa fa-circle-o"></i> Music</a></li>
	                        <li class="<?php echo (isset($catId) && $catId == '19')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'setting/index.php?view=directory'; ?>"><i class="fa fa-circle-o"></i> Directory Services</a></li>

	                    </ul>
	                </div><!-- /.box-body -->
	            </div><!-- /. box -->
			</div>
			<div class="col-md-9">
                <div class="box box-primary" >
                	<?php
                	if (isset($_GET['view']) && $_GET['view'] == 'home') {
                		?>
                		<div class="inner_heading">
							<h1><?php echo $catTitle; ?></h1><hr>
						</div>
						<?php 
						if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
							if($_SESSION['count'] <= 1){
								$_SESSION['count'] +=1; ?>
								<div class="row" id="alertmsg" style="margin: 5px 0px 0px 5px;" >
									<div style="min-height:10px;"></div>
							<div class="alert alert-<?php echo $_SESSION['errorMessage']; ?> " >
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										<?php echo $_SESSION['errorMessage'];  ?>
									</div> 
								</div><?php
								unset($_SESSION['errorMessage']);
							}
						} ?>
						<div class="box-body">
		                	<form  method="POST" action="processSetting.php?action=homeBnr"  enctype="multipart/form-data" >
		                		<input type="hidden" name="txtCategoryId" value="<?php echo $catId; ?>">
		                		<div class="row">
			                  		<div class="col-md-offset-1 col-md-10">
			                  			<!-- Color Picker -->
					                  	<div class="form-group">
						                    <label>Banner Upload (1400px X 416px):</label>
						                    <?php
						                    if (isset($spSettingBanner) && $spSettingBanner != '') {
						                    	?>
						                    	<img src="<?php echo WEB_ROOT.'/upload/banner/'.$spSettingBanner; ?>" style="display: block;height: 100px;margin-bottom: 25px;">
						                    	<?php
						                    }
						                    ?>
						                    
						                    <input type="file" id="exampleInputFile" name="txtImage" ><br>
						                    <!-- <label>Home Page Heading:</label><br>
						                    <textarea style="margin: 0px; width: 398px;height: 112px;" name="hometxt"><?php echo isset($heading)? $heading: ''; ?></textarea>  -->	
					                  	</div><!-- /.form group -->
					                  	<input type="submit" class="pull-right btn btn-success btn-flat" name="" value="Upload">
			                  		</div>
			                  	</div>

		                	</form>
		                </div>
						
						
						<div class="box-body">
		                	<form  method="POST" action="processSetting.php?action=homeLogo"  enctype="multipart/form-data" >
		                		<input type="hidden" name="txtCategoryId1" value="<?php echo $catId; ?>">
		                		<div class="row">
			                  		<div class="col-md-offset-1 col-md-10">
			                  			<!-- Color Picker -->
					                  	<div class="form-group">
						                    <label>Logo Upload (1400px X 416px):</label>
						                    <?php
						                    if (isset($spSettingLogo) && $spSettingLogo != '') {
						                    	?>
						                    	<img src="<?php echo WEB_ROOT.'/upload/banner/'.$spSettingLogo; ?>" style="display: block;height: 100px;margin-bottom: 25px;">
						                    	<?php
						                    }
						                    ?>
						                    
						                    <input type="file" id="exampleInputFile1" name="logoImage" ><br>
						                    <!-- <label>Home Page Heading:</label><br>
						                    <textarea style="margin: 0px; width: 398px;height: 112px;" name="hometxt"><?php echo isset($heading)? $heading: ''; ?></textarea>  -->	
					                  	</div><!-- /.form group -->
					                  	<input type="submit" class="pull-right btn btn-success btn-flat" name="" value="Upload">
			                  		</div>
			                  	</div>

		                	</form>
		                </div>
						
						
						
						
						
                		<?php
                	}else if (isset($_GET['view']) && $_GET['view'] == 'headings') {
                		?>
                		<div class="inner_heading">
							<h1><?php echo $catTitle; ?></h1><hr>
						</div>
						<?php 
			if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
				if($_SESSION['count'] <= 1){
					$_SESSION['count'] +=1; ?>
					<div class="row" id="alertmsg" style="margin: 5px 0px 0px 5px;" >
						<div style="min-height:10px;"></div>
						<div class="alert alert-<?php echo $_SESSION['data'];?>">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<?php echo $_SESSION['errorMessage'];  ?>
						</div> 
					</div><?php
					unset($_SESSION['errorMessage']);
				}
			} ?>
						<div class="box-body">
		                	<form  method="POST" action="processSetting.php?action=headings"  enctype="multipart/form-data" >
		                		<input type="hidden" name="txtCategoryId" value="<?php echo $catId; ?>">
		                		<div class="row">
			                  		<div class="col-md-offset-1 col-md-10">
			                  			<!-- Color Picker -->
					                  	<div class="form-group">

						                    <!-- <label>Banner Upload (1400px X 416px):</label>
						                    <?php
						                    if (isset($spSettingBanner) && $spSettingBanner != '') {
						                    	?>
						                    	<img src="<?php echo WEB_ROOT.'/upload/banner/'.$spSettingBanner; ?>" style="display: block;height: 100px;margin-bottom: 25px;">
						                    	<?php
						                    }
						                    ?> -->
						                    <?php 
						                    	$txtCategoryId=1;
												$sql2 = "SELECT heading FROM homepage_heading WHERE spCategory_idspCategory = '$txtCategoryId' ";
												$result2= dbQuery($dbConn, $sql2);
												$row3 = dbFetchAssoc($result2);
						                    ?>
						                   <!--  <input type="file" id="exampleInputFile" name="txtImage" ><br> -->
						                    <label>Home Page Heading:</label><br>
						                    <textarea style="margin: 0px; width: 398px;height: 112px;" name="hometxt"><?php echo $row3["heading"]; ?></textarea> 	
					                  	</div><!-- /.form group -->
					                  	<input type="submit" class="pull-right btn btn-success btn-flat" name="" value="Upload">
			                  		</div>
			                  	</div>

		                	</form>
		                </div>
                		<?php
                	}else if (isset($_GET['view']) && $_GET['view'] == 'emailcontent') {
                		?>
                		<div class="inner_heading">
							<h1><?php echo $catTitle; ?></h1><hr>
						</div>
						<?php 
			if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
				if($_SESSION['count'] <= 1){
					$_SESSION['count'] +=1; ?>
					<div class="row" id="alertmsg" style="margin: 5px 0px 0px 5px;" >
						<div style="min-height:10px;"></div>
					

						<div class="">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<?php echo $_SESSION['errorMessage'];  ?>
						</div> 
					</div><?php
					unset($_SESSION['errorMessage']);
				}
			} ?>
						<div class="box-body">
		                	<form  method="POST" action="processSetting.php?action=emailcontent"  enctype="multipart/form-data" >
		                		<input type="hidden" name="txtCategoryId" value="<?php echo $catId; ?>">
		                		<div class="row">
			                  		<div class="col-md-offset-1 col-md-10">
			                  			<!-- Color Picker -->
					                  	<div class="form-group">

						                    <!-- <label>Banner Upload (1400px X 416px):</label>
						                    <?php
						                    if (isset($spSettingBanner) && $spSettingBanner != '') {
						                    	?>
						                    	<img src="<?php echo WEB_ROOT.'/upload/banner/'.$spSettingBanner; ?>" style="display: block;height: 100px;margin-bottom: 25px;">
						                    	<?php
						                    }
						                    ?> -->
						                    <?php 
												$sql2 = "SELECT content FROM spemailcontent WHERE id = 1 ";
												$result2= dbQuery($dbConn, $sql2);
												$row_email = dbFetchAssoc($result2);
						                    ?>
						                   <!--  <input type="file" id="exampleInputFile" name="txtImage" ><br> -->
						                    <label>Invite Email Content:</label><br>
						                    <textarea style="margin: 0px; width: 398px;height: 112px;" name="emailcontent"><?php echo $row_email['content']; ?></textarea> 

					                  	</div><!-- /.form group -->
					                  	<input type="submit" class="pull-right btn btn-success btn-flat" name="" value="Upload">
			                  		</div>
			                  	</div>

		                	</form>
		                </div>
                		<?php
                	}else if (isset($_GET['view']) ) {
                		?>
                		<div class="inner_heading">
							<h1><?php echo $catTitle; ?></h1><hr>
						</div>
						<?php 
						if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
							if($_SESSION['count'] <= 1){
								$_SESSION['count'] +=1; ?>
								<div class="row" id="alertmsg" style="margin: 5px 0px 0px 5px;" >
									<div style="min-height:10px;"></div>
									<div class="alert alert-<?php echo $_SESSION['data'];?>">
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										<?php echo $_SESSION['errorMessage'];  ?>
									</div> 
								</div><?php
								unset($_SESSION['errorMessage']);
							}
						} ?>
		                <div class="box-body">
		                	<form  method="POST" action="processSetting.php?action=mainclr"  enctype="multipart/form-data" >
		                		<input type="hidden" name="txtCategoryId" value="<?php echo $catId; ?>">
			                  	<div class="row">
			                  		<div class="col-md-offset-1 col-md-10">
			                  			<!-- Color Picker -->
					                  	<div class="form-group">
						                    <label>Main Color:</label>
						                    <div class="input-group my-colorpicker2">
						                      	<input type="text" class="form-control" value="<?php echo isset($spSettingMainClr)? $spSettingMainClr: ''; ?>" name="txtMainClr" />
						                      	<div class="input-group-addon">
						                        	<i></i>
						                      	</div>
						                    </div><!-- /.input group -->
					                  	</div><!-- /.form group -->
					                  	
			                  		</div>
			                  	</div>
		                  	
			                  	<div class="row">
			                  		<div class="col-md-offset-1 col-md-10">
			                  			<!-- Color Picker -->
					                  	<div class="form-group">
						                    <label>Button Color:</label>
						                    <div class="input-group my-colorpicker2">
						                      	<input type="text" class="form-control" value="<?php echo isset($spSettingBtnClr)? $spSettingBtnClr: ''; ?>" name="txtBtnClr" />
						                      	<div class="input-group-addon">
						                        	<i></i>
						                      	</div>
						                    </div><!-- /.input group -->
					                  	</div><!-- /.form group -->
					                  	
			                  		</div>
			                  	</div>
		                  
			                  	<div class="row">
			                  		<div class="col-md-offset-1 col-md-10">
			                  			<!-- Color Picker -->
					                  	<div class="form-group">
						                    <label>Banner Upload:</label>
						                    <?php
						                    if (isset($spSettingBanner) && $spSettingBanner != '') {
						                    	?>
						                    	<img src="<?php echo WEB_ROOT.'/upload/banner/'.$spSettingBanner; ?>" style="display: block;height: 100px;margin-bottom: 25px;">
						                    	<?php
						                    }
						                    ?>
						                    
						                    <input type="file" id="exampleInputFile" name="txtImage" >
					                  	</div><!-- /.form group -->
					                  	<input type="submit" class="pull-right btn btn-success btn-flat" name="" value="Update">
			                  		</div>
			                  	</div>
		                  	</form>
		                 
		                </div><!-- /.box-body -->
		              
                		<?php
                	}else{
                		?>
                		<div class="inner_heading">
							<h1>Settings</h1><hr>
						</div>
                		<?php
                	}
                	?>
                	<div class="space"></div>
                </div>
            </div>
		</div>
	</section><!-- /.content -->
		