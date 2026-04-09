<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	
?>
	<!-- Content Header (Page header) -->

	<!-- Main content -->
	<section class="content" >
		<!-- start any work here. -->
		<form name="frmAddMainNav" id="frmAddMainNav" method="post" action="process.php?action=add"  enctype="multipart/form-data">
			
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
						<div class="col-md-4 col-sm-4" >
							<div class="form-group">
								<label>Type:</label><span class="red">*</span>
								<select class="form-control" name="txtType" id="txtType">
									<option value="">Select</option>
									<option value="1" data-name="Services">Services</option>
									<option value="0" data-name="Community">Community</option>
									
								</select>
								<span id=cat_error  class="red"></span>
							</div>
						</div>
						<div class="col-md-4 col-sm-4" >
							<div class="form-group">
								<label>Title:</label><span class="red">*</span>
								<input type="text" name="txtTitle" id="txtTitle" class="form-control" required="required"/>
								<span id=subcat_error  class="red"></span>
							</div>
						</div>
						
						                    
					</div>
				</div>
				<div class="box-footer"> 
                    <input type="button" id="add" name="btnButton" value="Add" class="btn vd_btn vd_bg-green finish" /> &nbsp;
                    <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> &nbsp;
                </div>
			</div>
			
			
		</form>
	</section><!-- /.content -->
  <script type="text/javascript">
        	
           $( document ).ready(function() {
                $("#add").on("click", function(){


                	var txtCategory = $("#txtType").val();
                	var txtSubCategory = $("#txtTitle").val();
                	
                if(txtCategory == "" && txtSubCategory == ""){
                     		
                     	$("#cat_error").text("Please Select Type.");
                     	$("#subcat_error").text("Please Enter Title.");
                     	return false;

                     }else if(txtCategory != "" && txtSubCategory == ""){
                     		
                     	$("#cat_error").text("");
                     	$("#subcat_error").text("Please Enter Title.");
                     	return false;

                     }else if(txtCategory == "" && txtSubCategory != ""){
                     		
                     	$("#cat_error").text("Please Select Type.");
                     	$("#subcat_error").text("");
                     	return false;

                     }else if(txtSubCategory == ""){
                     		

                     	$("#subcat_error").text("Please Enter Title.");
                     	return false;

                     }else{
                        
                         $("#frmAddMainNav").submit();
                     }

                 });

				 

           });

        </script>			