<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	
?>
	<!-- Content Header (Page header) -->

	<!-- Main content -->
	<section class="content" >
		<!-- start any work here. -->
		<form name="frmAddMainNav" id="frmAddMainNav" method="post" action="processSubCategory.php?action=add"  enctype="multipart/form-data" >
			
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
								<label>Category:</label><span class="red">*</span>
								<select class="form-control" name="txtCategory" id="txtCategory">
									<?php allcategory($dbConn);?>
								</select>
								<span id=cat_error  class="red"></span>
							</div>
						</div>
						<div class="col-md-3 col-sm-6" >
							<div class="form-group">
								<label>Sub Category:</label><span class="red">*</span>
								<input type="text" name="txtSubCategory" id="txtSubCategory" class="form-control" maxlength="40">
								<span id=subcat_error  class="red"></span>
							</div>
						</div>						                    
					</div>
					<div class="box-footer"> 
                        <input type="button" id="add" name="btnButton" value="Save" class="btn vd_btn vd_bg-green finish" /> &nbsp;
                        <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> 
                    </div>
                </div>
			</div>
			
		</form>
	</section><!-- /.content -->
  <script type="text/javascript">
            
    $( document ).ready(function() {
        $("#add").on("click", function(){
                var selectPoint = $("#txtCategory").val();
                var txtIndusrtyType = $("#txtSubCategory").val();
                         //var txtPercent = $("#txtPercent").val(); 
                      var flag=0;
			       if (txtIndusrtyType!="")
			       {
				       var strArr = new Array();
				       strArr = txtIndusrtyType.split("");

				       if(strArr[0]==" ") // this is the the key part. you can do whatever you want here!
				       {
				       flag=1;
				       }
			       }       
        			 /*         if(selectPoint == "0"){
                        $("#select_error").text("Please Select Point type.");
                        return false;
                     }else if(txtIndusrtyType == ""){
                        $("#text_error").text("Please Enter Title.");
                        return false;
                     }*/ 
                     if(selectPoint == "0" && txtIndusrtyType == "" ){
                        $("#cat_error").text("Please Select Category.");
                            $("#subcat_error").text("Please Enter Sub Category.");
                             // $("#percent_error").text("Please Enter Percentage.");
                        return false;
                     }else if(selectPoint != "0" && txtIndusrtyType == ""  ){
                        $("#cat_error").text("");
                        $("#subcat_error").text("Please Enter Sub Category.");
                              //$("#percent_error").text("Please Enter Percentage.");
                        return false;
                     }
                     else if(flag == 1){
                        $("#subcat_error").text("Space not allowed.");
                        return false;
                     }
                     else{
                        
                         $("#frmAddMainNav").submit();
                         return true;
                     }
        });

   	});

</script>   