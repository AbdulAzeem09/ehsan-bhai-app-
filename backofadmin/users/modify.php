<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';
	if (isset($_GET['userId']) && $_GET['userId'] > 0) {
		$userId = $_GET['userId'];
	}else {
		// redirect to index.php if user id is not present
		redirect('index.php');
	}
	$sql = "SELECT * FROM tbl_user WHERE user_id = $userId";
	$result = dbQuery($dbConn, $sql) ;
	$row    = dbFetchAssoc($result);
	extract($row);
?>

	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Users <small>[Modify]</small></h1>
	</section>
	<!-- Main content -->
	<section class="content" >
		<div class="row">
			<div class="col-md-12">
				<!-- start any work here. -->
				<form action="processAdmin.php?action=modify" method="post" enctype="multipart/form-data" name="frmAddAdmin" id="frmAddAdmin" onsubmit="return validate(this)">
					<input type="hidden" name="hidId" id="hidId"  value="<?php echo $userId;?>"/>
					<div class="box box-success">
						<div class="box-body">
							<div class="row">
								<div class="col-md-3 col-sm-4" >
									<div class="form-group"> 
										<label>User Level</label></br>

										<select name="txtUserLevel" id="txtUserLevel" class="form-control">
										<option value="0">--Select--</option>
										<?php
										$sql1= "SELECT * FROM `staff` ORDER BY id ASC";
										$result2 = dbQuery($dbConn,$sql1);
										
										while($row = dbFetchAssoc($result2)) { ?>
											<option value="<?php echo  $row['id']; ?>" <?php echo (isset($user_level) && $user_level == $row['id'])? 'selected': '';?>><?php echo  $row['role_name']; ?></option>

                                           <?php  }
											?>
											
										</select>






										<!--<select name="txtUserLevel" id="txtUserLevel" class="form-control">
											<option value="0">--Select--</option>
											<option value="1" <?php echo (isset($user_level) && $user_level == 1)? 'selected': '';?> >Admin</option>
											<option value="2" <?php echo (isset($user_level) && $user_level == 2)? 'selected': '';?> >Manager</option>
											<option value="3" <?php echo (isset($user_level) && $user_level == 3)? 'selected': '';?> >Auditor</option>
										</select>-->
									</div>
								</div> 
								<div class="col-md-3 col-sm-4">
									<div class="form-group"> 
										<label>User Name:</label></br>
										<input type="text" name="txtUserName" id="txtUserName" class="form-control" required="required" value="<?php echo $user_name;?>" />
									</div>
								</div>
								<div class="col-md-3 col-sm-4 ">
									<div class="form-group"> 
										<label>User Password:</label></br>
										<input type="text" name="txtPassword" id="txtPassword" class="form-control" value="" />
									</div>
								</div>
								<div class="col-md-3 col-sm-4">
									<div class="form-group"> 
										<label>Mobile No:</label></br>
										<input type="text" name="txtMob" id="txtMob" class="form-control" required="required" value="<?php echo $user_mob;?>" />
									</div>
								</div> 
								
								<div class="col-md-3 col-sm-4 ">
									<div class="form-group"> 
										<label>Email</label></br>
										<input type="email" name="txtEmail" id="txtEmail" class="form-control" value="<?php echo $user_email;?>" />
									</div>
								</div> 
								
								<div class="col-md-3 col-sm-4 ">
									<div class="form-group"> 
										<label>Image </label></br>
										<input type="file" name="txtImage" id="txtImage" /><?php echo $user_img;?>
									</div>
								</div>	
								
								
								<div class="col-md-3 col-sm-4 ">
									<div class="form-group"> 
										<label>Status :</label></br>
										<input type="radio" name="radStatus" id="radStatus" value="1" <?php if($user_status == 1){echo "Checked";}?> />
										<span class="txtDarkGray14">Active</span> &nbsp;
										<input type="radio" name="radStatus" id="radStatus" value="0" <?php if($user_status == 0){echo "Checked";}?> />
										<span class="txtDarkGray14">In Active</span>
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
			</div>
		</div>
	</section><!-- /.content -->
		