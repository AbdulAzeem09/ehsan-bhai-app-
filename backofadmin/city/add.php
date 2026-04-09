<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	
?>
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Add</h1>
	</section>
	<!-- Main content -->
	<section class="content" >
		<!-- start any work here. -->
		<form name="frmAddMainNav" id="frmAddMainNav" method="post" action="processCity.php?action=add"  enctype="multipart/form-data" >
			
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
						
						<div class="col-md-4">
							<label>Country: <span class="red">*</span></label>
							<select class="form-control country" style="margin-bottom: 20px;" name="txtCountry" id="txtCategory">
								<option value="0">Select Country</option>
								<?php
								showCountry($dbConn);
								?>
							</select>
<!-- 									<span id=cat_error  class="red"></span>
 -->
						</div>
						<div class="col-md-4">
							<label>State: <span class="red">*</span></label>
							<select class="form-control" id="stateShow" style="margin-bottom: 20px;" name="txtState">
								
							</select>
<!-- 								<span id=subcat_error  class="red"></span>
 -->
						</div>
						<div class="col-md-4" style="margin-bottom:20px;">
							<label>City: <span class="red">*</span></label></br>
							<input type="text" name="txtTitle" id="txtTitle" class="form-control" maxlength="40" >
						</div>
<!-- 								<span id=city_error  class="red"></span>
 -->
						                    
					</div>
				</div>
				<div class="box-footer"> 
                    <input type="submit" name="btnButton" id="add" value="Save" class="btn vd_btn vd_bg-green finish" /> &nbsp;
                    <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> &nbsp;
                </div>
			</div>
			
		</form>
	</section><!-- /.content -->

	<!--  <script type="text/javascript">
        	
           $( document ).ready(function() {
                $("#add").on("click", function(){


                	var txtCategory = $("#txtCategory").val();
                	var txtSubCategory = $("#stateShow").val();
                	var txtcity =$("txtTitle").val();
                	
                      var flag=0;
					      
					       if (txtcity!="")
					       {
					       var strArr = new Array();
					       strArr = txtcity.split("");

					       if(strArr[0]==" ") // this is the the key part. you can do whatever you want here!
					       {
					       flag=1;
					       }


					       }
             

                     if(txtCategory == "0" && txtSubCategory == "" && txtcity == ""){
                     		
                     	$("#cat_error").text("Please Select Category.");
                     	$("#subcat_error").text("Please Enter Sub Category.");
                     	   $("#city_error").text("Please Enter City.");

                     	return false;

                     }else if(txtCategory != "0" && txtSubCategory == "" && txtcity == ""){
                     		
                     	$("#cat_error").text("");
                     	$("#subcat_error").text("Please Enter Sub Category.");
                     	                     	   $("#city_error").text("Please Enter City.");

                     	return false;

                     }else if(txtCategory == "0" && txtSubCategory != "" && txtcity == ""){
                     		
                     	$("#cat_error").text("Please Select Category.");
                     	$("#subcat_error").text("");
                     	$("#city_error").text("Please Enter City.");
                     	return false;

                     }else if(txtSubCategory == ""){
                     		

                     	$("#subcat_error").text("Please Enter Sub Category.");
                     	return false;

                     }else if(flag == 1){
                        $("#city_error").text("Space not allowed.");
                        return false;

                     }else{
                        
                         $("#frmAddMainNav").submit();
                     }

                 });
           });

        </script>	 -->
						