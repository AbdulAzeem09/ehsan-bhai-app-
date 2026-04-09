<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	
	$userId = $_SESSION['userId'];
	$sql = "SELECT * FROM tbl_user WHERE user_id = $userId";
	$result = dbQuery($dbConn, $sql) ;
	if($result){
		$row    = dbFetchAssoc($result);
		extract($row);
	}
	
 	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1><?php echo $pageTitle;?></h1>
	</section>
	<section class="content" >
		<!-- start any work here. -->
		<form action="processAdmin.php?action=modify" method="post" enctype="multipart/form-data" name="frmAddAdmin" id="frmAddAdmin" onsubmit="return validate(this)">
			<input type="hidden" name="hidId" id="hidId"  value="<?php echo $userId;?>"/>
			<div class="box box-success">
				<div class="box-body">
					<div class="row">
						<div class="col-md-3 col-sm-4 ">
							<div class="form-group">
								<label>Account Title:<span class="red">*</span></label>
								<input type="text" name="txtAccountName" id="txtAccountName" class="form-control" required="required" value="<?php echo $account_name;?>" />
							</div>
						</div>

						<div class="col-md-3 col-sm-4 ">
							<div class="form-group">
								<label>User Name:<span class="red">*</span></label>
								<input type="text" name="txtUserName" id="txtUserName" class="form-control" readonly="" required="required" value="<?php echo $user_name;?>" />
							</div>
						</div>
						
						<div class="col-md-3 col-sm-4 ">
							<div class="form-group">
								<label>Mobile No:<span class="red">*</span></label>
								<input type="text" name="txtMob" id="txtMob" class="form-control" readonly="" required="required" value="<?php echo $user_mob;?>" />
							</div>
						</div> 
						
						<div class="col-md-3 col-sm-4 ">
							<div class="form-group">
								<label>Email:<span class="red">*</span></label>
								<input type="email" name="txtEmail" id="txtEmail" class="form-control" readonly="" value="<?php echo $user_email;?>" />
							</div>
						</div> 
						
						<div class="col-md-3 col-sm-4">
							<div class="form-group">
								<label>Image </label>
								<img src="<?php echo WEB_ROOT.'/upload/user/'.$user_img; ?>" style="width: 100px;margin-bottom: 15px;">
						
								<input type="file" name="txtImage" id="txtImage" accept='image/*' />
								 <span id=file_error class="danger" style="padding-top: 10px;color:red;"></span>

								<!-- <?php echo $user_img;?> -->
							</div>
						</div>	
						
						
								
					</div>
				</div>
				<div class="box-footer"> 
                    <input type="submit" name="btnButton" value="Update my information" class="btn vd_btn vd_bg-green finish" /> &nbsp;
                </div>
			</div>
			
		</form>
	</section><!-- /.content -->


	<script type="text/javascript">
			$("#txtImage").change(function() {

    var val = $(this).val();

    switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
        case 'gif': case 'jpg': case 'png':
           $("#file_error").text("")
            break;
        default:
            $(this).val('');
            // error message here
            /*alert("not an image");*/
             $("#file_error").text("Please select Image only.")
            break;
    }
});


	</script>
		