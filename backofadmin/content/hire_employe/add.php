<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	
?>
	
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Add Profile Content</h1>
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
							<label>Description:</label></br>
							<textarea class="form-control detaild" rows="4" name="txtDesc" maxlength="160" ></textarea>
							<span id="chars">160</span> characters remaining
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