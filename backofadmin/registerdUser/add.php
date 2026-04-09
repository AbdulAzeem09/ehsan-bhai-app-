<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';
?>

	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Add New User / User</h1>
	</section>
	<!-- Main content -->
	<section class="content" >
		<!-- start any work here. -->
		<form action="processAdmin.php?action=add" method="post" enctype="multipart/form-data" name="frmAddAdmin" id="frmAddAdmin" onsubmit="return validate(this)">
			<div class="box box-success">
			<div class="box-body">
			<div class="container-fluid container_block">
				<!--<div class="row inner_heading">
					<h1>User Details</h1><hr>
				</div>-->
				<div class="row">
					<!--<div class="col-md-4 col-sm-4 mg_btm_30" >
						<label>User Level</label></br>
						<select name="txtUserLevel" id="txtUserLevel" class="formField">
							<option value="0">--Select--</option>
							<option value="1">Admin</option>
							<option value="0">User</option>
						</select>
					</div> -->
					<div class="col-md-4 col-sm-4 mg_btm_30">
						<label>First Name:</label></br>
						<input type="text" name="fname" id="fname" class="formField" required="required" value="" />
					</div>
					<div class="col-md-4 col-sm-4 mg_btm_30">
						<label>Last Name:</label></br>
						<input type="text" name="lname" id="lname" class="formField" required="required" value="" />
					</div>
					<div class="col-md-4 col-sm-4 mg_btm_30">
						<label>User Password:</label></br>
						<input type="password" name="password" id="password" class="formField" required="required" value="" />
					</div>
					<div class="col-md-4 col-sm-4 mg_btm_30">
						<label>Mobile No:</label></br>
						<input type="text" name="mobile" id="respUserEphone" class="formField" required="required" value="" />
						<input type="hidden" id="countrycode" name="countrycode" value="">
					</div> 
					
					<div class="col-md-4 col-sm-4 mg_btm_30">
						<label>Email:</label></br>
						<input type="email" name="email" id="email" class="formField" value="" required="required"/>
					</div>
					<div class="col-md-12 col-sm-4 m_btm_30">
						<label>Status:</label></br>
						<input type="radio" name="radStatus" id="radStatus" value="1" checked="checked" />
						<span class="txtDarkGray14">Active</span> &nbsp;
						<input type="radio" name="radStatus" id="radStatus" value="0" />
						<span class="txtDarkGray14">In Active</span>
					</div>			
				</div>
				
			</div>
			<div class="row">
				<div class="col-md-offset-5 col-xs-offset-3 col-sm-offset-5">
					<input type="submit" name="btnButton" value="Save" class="btn vd_btn vd_bg-green finish" /> &nbsp;
				</div>
			</div>
			</div>
			</div>
		</form>
	</section><!-- /.content -->
		