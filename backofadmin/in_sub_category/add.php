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
					<div class="" id="alertmsg" style="margin: 10px 0px 0px 5px;">
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
						<div class="col-md-4 col-sm-6" >
							<div class="form-group">
								<label>Sub Category:</label><span class="red">*</span>
								<select class="form-control" name="txtCategory" id="txtCategory">
									<!-- <option value="0">Select</option> -->
									<?php allcategoryform($dbConn, 5);?>
								</select>
                               <span id=cat_error  class="red"></span>
							</div>
						</div>
						<div class="col-md-4 col-sm-6" >
							<div class="form-group">
								<label>In-Sub Category:</label><span class="red">*</span>
								<input type="text" name="txtSubCategory" id="txtSubCategory" class="form-control" required="required"/>
								<span id=subcat_error  class="red"></span>
							</div>
						</div>
						
						
						                    
					</div>
				</div>
				<div class="box-footer"> 
                    <input type="submit" id="add" name="btnButton" value="Save" class="btn vd_btn vd_bg-green finish" /> &nbsp;
                    <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> &nbsp;
                </div>
			</div>
			
			
		</form>
	</section><!-- /.content -->
  <script type="text/javascript">
        	
           $( document ).ready(function() {
                $("#add").on("click", function(){


                	var txtCategory = $("#txtCategory").val();
                	var txtSubCategory = $("#txtSubCategory").val();
                	
                if(txtCategory == "0" && txtSubCategory == ""){
                     		
                     	$("#cat_error").text("Please Select Category.");
                     	$("#subcat_error").text("Please Enter Sub Category.");
                     	return false;

                     }else if(txtCategory != "0" && txtSubCategory == ""){
                     		
                     	$("#cat_error").text("");
                     	$("#subcat_error").text("Please Enter Sub Category.");
                     	return false;

                     }else if(txtCategory == "0" && txtSubCategory != ""){
                     		
                     	$("#cat_error").text("Please Select Category.");
                     	$("#subcat_error").text("");
                     	return false;

                     }else if(txtSubCategory == ""){
                     		

                     	$("#subcat_error").text("Please Enter Sub Category.");
                     	return false;

                     }else{
                        
                         $("#frmAddMainNav").submit();
                     }

                 });
           });

        </script>	
						