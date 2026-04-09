<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	
?>
	
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Add Email Marketing Content</h1>
	</section>
	<!-- Main content -->
	<section class="content" >
		<!-- start any work here. -->
		<form name="frmAddMainNav" id="frmAddMainNav" method="post" action="processContent.php?action=add"  enctype="multipart/form-data" onsubmit="return validate(this)">
			<input type="hidden" name="pageId" value="4">
			<div class="container-fluid container_block">
				<div class="row inner_heading">
					<h1>Add Details</h1><hr>
				</div>
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
					<div class="col-md-4">
						<div class="form-group">
							<label>Title</label>
							<input type="text" class="form-control" name="txtTitle" value="" required="" >
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Icon</label>
							<input type="file" name="txtImage" id="txtImage" />
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
						<div class="form-group">
							<label>Status :</label></br>
							<input type="radio" name="radStatus" id="radStatus" value="1" checked="checked" />
							<span class="txtDarkGray14">Active</span> &nbsp;
							<input type="radio" name="radStatus" id="radStatus" value="0" />
							<span class="txtDarkGray14">In Active</span>
						</div>
						
					</div>
					<div class="col-md-12 col-sm-12" style="margin-bottom:20px;">
						<label>Description:</label></br>
						<textarea class="form-control detaild" rows="4" name="txtDesc" maxlength="200" ></textarea>
						<span id="chars">200</span> characters remaining
					</div>
					                    
				</div>
				<div style="min-height: 20px;"></div>
			</div>
			<div class="row">
				<div class="col-md-offset-5 col-xs-offset-3 col-sm-offset-5">
					<input type="submit" name="btnButton" value="Save" class="butn" /> &nbsp;
					<input type="button" name="btnCanlce" value="Back" class="butn" onclick="window.location.href='index.php'"/>
				</div>
			</div>
		</form>
	</section><!-- /.content -->
		
	<script type="text/javascript">
		var maxLength = 200;
		$('.detaild').keyup(function() {
		  	var length = $(this).val().length;
		  	var length = maxLength-length;
		  	$('#chars').text(length);
		});
	</script>	