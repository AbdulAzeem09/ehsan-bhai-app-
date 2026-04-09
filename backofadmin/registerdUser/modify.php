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
		<h1>Modify User / Admin</h1>
	</section>
	<!-- Main content -->
	<section class="content" >
		<!-- start any work here. -->
		<form action="processAdmin.php?action=modify" method="post" enctype="multipart/form-data" name="frmAddAdmin" id="frmAddAdmin" onsubmit="return validate(this)">
			<input type="hidden" name="hidId" id="hidId"  value="<?php echo $userId;?>"/>
			<div class="container-fluid container_block">
				<div class="row inner_heading">
					<h1>User Details</h1><hr>
				</div>
				<div class="row">
					<div class="col-md-4 col-sm-4 mg_btm_30" >
						<label>User Level</label></br>
						<select name="txtUserLevel" id="txtUserLevel" class="formField">
							<option value="0">--Select--</option>
							<option value="1" <?php echo (isset($user_level) && $user_level == 1)? 'selected': '';?> >Admin</option>
							<option value="0" <?php echo (isset($user_level) && $user_level == 0)? 'selected': '';?> >User</option>
						</select>
					</div> 
					<div class="col-md-4 col-sm-4 mg_btm_30">
						<label>User Name:</label></br>
						<input type="text" name="txtUserName" id="txtUserName" class="formField" required="required" value="<?php echo $user_name;?>" />
					</div>
					<div class="col-md-4 col-sm-4 mg_btm_30">
						<label>User Password:</label></br>
						<input type="text" name="txtPassword" id="txtPassword" class="formField" value="" />
					</div>
					<div class="col-md-4 col-sm-4 mg_btm_30">
						<label>Mobile No:</label></br>
						<input type="text" name="txtMob" id="txtMob" class="formField" required="required" value="<?php echo $user_mob;?>" />
					</div> 
					
					<div class="col-md-4 col-sm-4 mg_btm_30">
						<label>Email</label></br>
						<input type="email" name="txtEmail" id="txtEmail" class="formField" value="<?php echo $user_email;?>" />
					</div> 
					
					<div class="col-md-4 col-sm-4 mg_btm_30">
						<label>Image </label></br>
						<input type="file" name="txtImage" id="txtImage" /><?php echo $user_img;?>
					</div>	
					
					
					<div class="col-md-12 col-sm-4 m_btm_30">
						<label>Status :</label></br>
						<input type="radio" name="radStatus" id="radStatus" value="1" <?php if($user_status == 1){echo "Checked";}?> />
						<span class="txtDarkGray14">Active</span> &nbsp;
						<input type="radio" name="radStatus" id="radStatus" value="0" <?php if($user_status == 0){echo "Checked";}?> />
						<span class="txtDarkGray14">In Active</span>
					</div>			
				</div>
			</div>
			<div class="row">
				<div class="col-md-offset-5 col-xs-offset-3 col-sm-offset-5">
					<input type="submit" name="btnButton" value="Update" class="butn" /> &nbsp;
					<input type="button" name="btnCanlce" value="Cancel" class="butn" onclick="window.location.href='index.php'"/>
				</div>
			</div>
		</form>
	</section><!-- /.content -->
		