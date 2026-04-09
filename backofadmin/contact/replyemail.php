<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';
	if (isset($_GET['ConId']) && $_GET['ConId'] > 0) {
		$ConId = $_GET['ConId'];
	}else {
		// redirect to index.php if user id is not present
		redirect('index.php');
	}
	$sql = "SELECT * FROM tbl_contact WHERE spConId = '$ConId'";
	$result = dbQuery($dbConn, $sql);
	$row    = dbFetchAssoc($result);
	extract($row);
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Email Reply</h1>
	</section>
	<!-- Main content -->
	<section class="content" >
		<!-- start any work here. -->
		<form name="frmAddMainNav" id="frmAddMainNav" method="post" action="processfeedback.php?action=replyemail"  enctype="multipart/form-data" onsubmit="return validate(this)">
			<div class="box box-success">
				<div class="box-body">
					<div class="row">
						<div>
							<?php 
							if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
								if($_SESSION['count'] <= 1){
									$_SESSION['count'] +=1; ?>
									<div style="min-height:10px;"></div>
									<p class="errorText"><?php echo $_SESSION['errorMessage'];  ?></p> <?php
									unset($_SESSION['errorMessage']);
								}
							} ?>
						</div>
						<div class="col-md-4 col-sm-4">
							<div class="form-group">
								<label>To : Email</label></br>
								<input type="text" name="txtEmailid" id="txtEmailid"  value="<?php echo $spConEmail;?>" class="form-control"  readonly />
							</div>
							
						</div>
						
						<div class="col-md-12 col-sm-12">
							<label>Message :</label></br>
							<textarea class="form-control" name="txtmessage" placeholder="Write Text Here" required></textarea>
						</div>
					</div>
				</div>
				<div class="box-footer"> 
                    <input type="submit" name="btnButton" value="Send Email" class="btn vd_btn vd_bg-green finish" /> &nbsp;
                    <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> &nbsp;
                </div>
			</div>
			
		</form>
	</section><!-- /.content -->
		