<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

	if(isset($_GET['id']) && ($_GET['id']) > 0){
		$id  = $_GET['id'];
	}else {
		redirect('index.php');
	}
	$sql = "SELECT * FROM tbl_point WHERE point_id ='$id'";
	$result = dbQuery($dbConn, $sql);
	$row    = dbFetchAssoc($result);
	extract($row);
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Points <small>[Modify]</small></h1>
	</section>
	<!-- Main content -->
	<section class="content" >
		<!-- start any work here. -->
		<form name="frmAddMainNav" id="frmAddMainNav" method="post" action="process.php?action=modify"  enctype="multipart/form-data" onsubmit="return validate(this)">
			<input type="hidden" name="hidId" id="hidId"  value="<?php echo $point_id;?>"/>
            
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
						<div class="col-md-3 col-sm-6" >
							<div class="form-group">
								<label>Point Type:</label><span class="red">*</span>
								<select class="form-control" name="txtPointType" id="selectPoint">
									<option value="0">Select Point Type</option>
									<?php
									$sql = "SELECT * FROM tbl_point_type WHERE status != '-7' ";
									$result = dbQuery($dbConn, $sql);
									if ($result) {
										while ($row = dbFetchAssoc($result)) {
											?>
											<option value="<?php echo $row['pt_id']; ?>" <?php echo ($row['pt_id'] == $pt_id)?'selected':''; ?> ><?php echo $row['pt_title']; ?></option>
											<?php
										}
									}
									?>
								</select>
								
							</div>
				             <span id=select_error  class="red"></span>

						</div>

						<div class="col-md-3 col-sm-6" >
							<div class="form-group">
								<label>Spend Amount</label><span class="red">*</span><br>
								<input type="text" name="spent_amount" id="spent_amount" maxlength="40" class="form-control" value="<?php echo $spent_amount;?>" />
								
							</div>
							<span id=select_error  class="red"></span>
						</div>

						<div class="col-md-3 col-sm-6" >
							<div class="form-group">
								<label>Point</label><span class="red">*</span>
								<input type="text" name="txtPoint" id="txtPoint" maxlength="40" class="form-control"  value="<?php echo $point_total;?>" />
							</div>
							 <span id=text_error  class="red"></span>

						</div>	
						<div class="col-md-3 col-sm-6" >
							<div class="form-group">
								<label>Percentage (%)</label><span class="red">*</span>
								<input type="number" name="txtPercent" id="txtPercent" class="form-control"  value="<?php echo $percent; ?>" />
							</div>
						    <span id=percent_error  class="red"></span>

						</div>

					</div>
				</div>
				<div class="box-footer"> 
                    <input type="submit" name="btnButton"  id="add" value="Update" class="btn vd_btn vd_bg-green finish" /> &nbsp;
                    <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> &nbsp;
                </div>
			</div>
			
		</form>
	</section><!-- /.content -->
	<script type="text/javascript">
        	
           $( document ).ready(function() {
                $("#add").on("click", function(){

                var selectPoint = $("#selectPoint").val();
                	var txtIndusrtyType = $("#txtPoint").val();
                         var txtPercent = $("#txtPercent").val(); 


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

                	
         /*       	if(selectPoint == "0"){
                     		

                     	$("#select_error").text("Please Select Point type.");
                     	return false;

                     }else if(txtIndusrtyType == ""){
                     		

                     	$("#text_error").text("Please Enter Title.");
                     	return false;

                     }*/ if(selectPoint == "0" && txtIndusrtyType == "" &&  txtPercent == "" ){
                     		

                     	$("#select_error").text("Please Select Point Type.");
                     		$("#text_error").text("Please Enter Point.");
                     		  $("#percent_error").text("Please Enter Percentage.");
                     	
                     	return false;

                     }
                	else if(selectPoint != "0" && txtIndusrtyType == "" && txtPercent == "" ){
                     		

                     	$("#select_error").text("");
                     	$("#text_error").text("Please Enter Point.");
                     		  $("#percent_error").text("Please Enter Percentage.");

                     	return false;

                     }
                     else if(selectPoint != "0" && txtIndusrtyType != "" && txtPercent == "" ){
                     		

                     	$("#select_error").text("");
                     	$("#text_error").text("");
                     	 $("#percent_error").text("Please Enter Percentage.");

                     	return false;

                     }
                     else if(flag == 1){
                     	$("#text_error").text("Space not allowed.");
                     	return false;

                     }
                     else{
                        
                         $("#frmAddMainNav").submit();
                     }

                 });
           });

        </script>	