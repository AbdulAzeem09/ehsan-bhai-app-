<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	
?>
	
	<script type="text/javascript" src="<?php echo WEB_ROOT_ADMIN; ?>fckeditor/fckeditor.js"></script>

	<script type="text/javascript">		
		window.onload = function(){
			// Automatically calculates the editor base path based on the _samples directory.
			// This is usefull only for these samples. A real application should use something like this:
			// oFCKeditor.BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
			var sBasePath = '../../fckeditor/' ;
			var oFCKeditor = new FCKeditor( 'txtDesc' ) ;
			oFCKeditor.BasePath	= sBasePath ;
			oFCKeditor.ReplaceTextarea() ;
		}
	</script>
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Add Profile Content</h1>
	</section>
	<!-- Main content -->
	<section class="content" >
		<!-- start any work here. -->
		<form name="frmAddMainNav" id="frmAddMainNav" method="post" action="processContent.php?action=add"  enctype="multipart/form-data" onsubmit="return validate(this)">
			<input type="hidden" name="pageId" value="1">
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

					<!-- <input type="hidden" name="profilecategory" value="personal"> -->
					<!-- <input type="hidden" name="profilecatId" value="family"> -->
					<!-- <input type="hidden" name="profilecatId" value="bussiness">
					<input type="hidden" name="profilecatId" value="freelancer">
					<input type="hidden" name="profilecatId" value="professional">
					<input type="hidden" name="profilecatId" value="employment"> -->

                 

					<!-- <div class="row">
						
						<div class="col-md-12 col-sm-12" style="margin-bottom:20px;">
							<label>Description:</label></br>
							<textarea class="formField" rows="10" name="txtDesc"></textarea>
						</div>
						                    
					</div> -->
					<input type="hidden" name="modulename" value="store">

					<div class="row">
                     <div class="col-md-12" style="margin-bottom:20px;">
							<label>Choose Picture: <span class="red">*</span></label></br>
					  <input type="file" name="image[]" id="fileimage"  multiple>

					  <span id="fileimage_error" style="color:red;"></span>
					</div>
                    </div>

				</div>
				<div class="box-footer"> 
                    <input type="submit" name="btnButton" value="Save" class="btn vd_btn vd_bg-green finish" id="uploadbtn" /> &nbsp;
                    <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> &nbsp;
                </div>
			</div>
			
		</form>


		<script type="text/javascript">
			
$(document).ready(function() {
  //alert();
  $('#uploadbtn').click(function() {
  

  //  alert();

var fileimage = $('#fileimage').val();


if (fileimage == 0) {
$('#fileimage_error').text(" Please Choose Picture!"); 

  return false;
  } 
else {
$("#frmAddMainNav").submit();
//alert("Form Submitted Successfuly!");
return true;
}

});
});



</script>
	</section><!-- /.content -->
		