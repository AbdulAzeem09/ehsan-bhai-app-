<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';
?>

	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Users <small>[Add]</small></h1>
	</section>
	<!-- Main content -->
	<section class="content" >
		<div class="row">
			<div class="col-md-12">
				<!-- start any work here. -->
				<form action="processAdmin.php?action=add" method="post" enctype="multipart/form-data" name="frmAddAdmin" id="frmAddAdmin" onsubmit="return validate(this)">
					<div class="box box-primary">
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
											<option value="<?php echo  $row['id']; ?>"><?php echo  $row['role_name']; ?></option>

                                           <?php  }
											?>
											
										</select>
									</div>
								</div> 
								<div class="col-md-3 col-sm-4">
									<div class="form-group">
										<label>User Name:</label></br>
										<input type="text" name="txtUserName" id="txtUserName" class="form-control" required="required" value="" />
									</div>
								</div>
								<div class="col-md-3 col-sm-4">
									<div class="form-group">
										<label>User Password:</label></br>
										<input type="text" name="txtPassword" id="txtPassword" class="form-control" required="required" value="" />
									</div>
								</div>
								<div class="col-md-3 col-sm-4 ">
									<div class="form-group">
										<label>Mobile No:</label></br>
										<input type="text" name="txtMob" id="txtMob" class="form-control" required="required" value="" />
									</div>
								</div> 
								
								<div class="col-md-3 col-sm-4">
									<div class="form-group">
										<label>Email</label></br>
										<input type="email" name="txtEmail" id="txtEmail" class="form-control" value="" />
									</div>
								</div> 
								 
								<div class="col-md-3 col-sm-4">
									<div class="form-group">
										<label>Image </label></br>
										<input type="file" name="txtImage" id="txtImage" />
									</div>
								</div>	
								
								
								<div class="col-md-3 col-sm-4 ">
									<div class="form-group">
										<label>Status :</label></br>
										<input type="radio" name="radStatus" id="radStatus" value="1" checked="checked" />
										<span class="txtDarkGray14">Active</span> &nbsp;
										<input type="radio" name="radStatus" id="radStatus" value="0" />
										<span class="txtDarkGray14">In Active</span>
									</div>
								</div>			
							</div>
							
						</div>
						
						<div class="box-footer"> 
	                        <input type="submit" name="btnButton" value="Save" class="btn vd_btn vd_bg-green finish" /> &nbsp;
	                        <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> &nbsp;
	                    </div>
						
					</div>
				</form>
			</div>
		</div>
	</section><!-- /.content -->
		