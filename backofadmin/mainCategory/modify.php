<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

	if(isset($_GET['catId']) && ($_GET['catId']) > 0){
		$catId  = $_GET['catId'];
	}else {
		redirect('index.php');
	}
	$sql = "SELECT * FROM spcategories WHERE idspCategory ='$catId'";
	$result = dbQuery($dbConn, $sql);
	$row    = dbFetchAssoc($result);
	extract($row);
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Category<small>[Modify]</small></h1>
	</section>
	<!-- Main content -->
	<section class="content" >
		<!-- start any work here. -->
		<form name="frmcategory" id="frmcategory" method="post" action="processCategory.php?action=modify"  enctype="multipart/form-data">
			<input type="hidden" name="hidId" id="hidId"  value="<?php echo $catId;?>"/>
            
			<div class="box box-success">
				<div class="box-body">
					<div class="" id="alertmsg" >
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
						
						<div class="col-md-3 col-sm-6" >
							<div class="form-group">
								<label>Name:</label><span class="red">*</span>
								<input type="text" name="txtTitle" id="txtTitle" value="<?php echo $spCategoryName;?>" class="form-control" />
								<span id="title_error"  class="red"></span>
							</div>
						</div>
						<div class="col-md-3 col-sm-6" >
								<div class="form-group">
								<label>Folder Name:</label><span class="red">*</span>
								<input type="text" name="txtFoldName" id="txtFoldName" class="form-control" value="<?php echo $spCategoryFolder;?>" />
								 <span id="foldname_error"  class="red"></span>
							</div>
						</div>
						<div class="col-md-3 col-sm-6" >
								<div class="form-group">
								<label>Icon:</label><span class="red">*</span>
								<input type="file" name="txtImage" id="txtImage" accept='image/*' /> <?php echo $spCategoryImage;?> 
								<span id="icon_error"  class="red"></span>
							    </div>

						</div>
						<div class="col-md-3 col-sm-6">
							<div class="form-group"> 
								<label>Status:</label></br>
								<label><input type="radio" name="radStatus" id="radStatus" value="1" <?php if($spCategoryStatus == 1){echo "Checked";}?> />
								<span class="txtDarkGray14">Active</span></label> &nbsp;
								<label><input type="radio" name="radStatus" id="radStatus" value="0" <?php if($spCategoryStatus == 0){echo "Checked";}?> />
								<span class="txtDarkGray14">In Active</span></label>
							</div>
						</div>		
						
					</div>
				<div class="box-footer"> 
	                <input type="button" id="add" name="btnButton" value="Update" class="btn vd_btn vd_bg-green finish" /> &nbsp;
	                <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> &nbsp;
	            </div>
			</div>
			
			

		</form>
	</section><!-- /.content -->
  <script type="text/javascript">
        	
           $( document ).ready(function() {
                $("#add").on("click", function(){


                	var txtTitle = $("#txtTitle").val();
                	var txtFoldName = $("#txtFoldName").val();
                	var txtImage = $("#txtImage").val();

                	/*alert(txtImage);*/

                if(txtTitle == "" && txtFoldName == "" && txtImage == ""){
                     	$("#title_error").text("Please Enter Title.");
                     	$("#foldname_error").text("Please Enter Icon.");
                     	$("#icon_error").text("Please Upload Icon.");
                     	return false;

                     }else if(txtTitle != "" && txtFoldName == "" && txtImage == ""){
                     		
                     	$("#title_error").text("");
                     	$("#foldname_error").text("Please Enter Icon.");
                     	$("#icon_error").text("Please Upload Icon.");
                     	return false;

                     }else if(txtTitle == "" && txtFoldName != "" && txtImage == ""){
                     		
                     	$("#title_error").text("Please Enter Name.");
                     	$("#foldname_error").text("");
                     	return false;
                     	$("#icon_error").text("Please Upload Icon.");

                     }else if(txtTitle == "" && txtFoldName == "" && txtImage != ""){
                     		
                     	$("#title_error").text("Please Enter Name.");
                     	$("#foldname_error").text("Please Enter Icon.");
                     	$("#icon_error").text("");

                     }else if(txtTitle == ""){
                     		
                     	$("#title_error").text("Please Enter Name.");
                     	return false;

                     }else if(txtFoldName == ""){
                     		

                     	$("#foldname_error").text("Please Enter Icon.");
                     	return false;

                     }else{
                        
                         $("#frmcategory").submit();
                     }

                 });
           });

        </script>	


        <script type="text/javascript">
			$("#txtImage").change(function() {

    var val = $(this).val();

    switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
        case 'gif': case 'jpg': case 'png':
           $("#icon_error").text("")
            break;
        default:
            $(this).val('');
            // error message here
            /*alert("not an image");*/
             $("#icon_error").text("Please select Image only.")
            break;
    }
});


	</script>			