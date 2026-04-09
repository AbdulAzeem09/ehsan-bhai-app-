<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	if (!isset($_SESSION['username']) || $_SESSION['username'] == ''){
		redirect( WEB_ROOT_ADMIN . 'login.php');
	 }
	
?>
	
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Add Video Testimonial</h1>
	</section>
	<!-- Main content -->
	<section class="content" >
		<!-- start any work here. -->
		<form name="frmAddMainNav" id="frmAddMainNav" method="post" action="processContent.php?action=add"  enctype="multipart/form-data" onsubmit="return validate(this)">
			<input type="hidden" name="pageId" value="2">
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

                        <div class="col-md-12 col-sm-12" style="margin-bottom:20px;">
                                <label>Name:</label></br>
                                <input type="text" class="form-control detaild" value="" name="name" maxlength="160" required>
                        </div>
                        <div class="col-md-12 col-sm-12" style="margin-bottom:20px;">
							<label>Designation:</label></br>
							<input type="text" class="form-control detaild" value="" name="designation" maxlength="160" required>
							
						</div>
                        <div class="col-md-12 col-sm-12" style="margin-bottom:20px;">
							<label>Image:</label></br>
							<input type="file" name="choosefile" value="" required/>
							
						</div>
						<div class="col-md-12 col-sm-12" style="margin-bottom:20px;">
							<label>Youtube url:</label></br>
							<input type="text" class="form-control detaild" value="" name="youtubeUrl" maxlength="160" required>
							
						</div>
						                    
					</div>
				</div>
				<div class="box-footer"> 
                    <input type="submit" name="btnButton" value="Save" class="btn vd_btn vd_bg-green finish" /> &nbsp;
                    <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> &nbsp;
                </div>
			</div>
			
		</form>
	</section><!-- /.content -->
		
	<script type="text/javascript">
		var maxLength = 160;
		$('.detaild').keyup(function() {
		  	var length = $(this).val().length;
		  	var length = maxLength-length;
		  	$('#chars').text(length);
		});
	</script>	