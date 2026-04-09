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

	$sql = "SELECT * FROM event_groups WHERE idspeventgr ='$id'";
	$result = dbQuery($dbConn, $sql);
	$row    = dbFetchAssoc($result);
	extract($row);
	$catids = explode(",",$event_category_ids);
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1> Event Category Groups<small>[Modify]</small></h1>
	</section>
	<!-- Main content -->
	<section class="content" >
		<!-- start any work here. -->
		<form name="frmAddMainNav" id="frmAddMainNav" method="post" action="processEventGroup.php?action=modify"  enctype="multipart/form-data" onsubmit="return validate(this)">
			<input type="hidden" name="id" id="id"  value="<?php echo $id;?>"/>
            
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
						
						<div class="col-md-4 col-sm-4" style="margin-bottom:20px;">
							<label>Group Title:</label><span class="red">*</span></br>
							<input type="text" name="grptxtTitle" id="txtTitle" class="form-control" value="<?php echo $speventGropupTitle;?>" maxlength="40">
							<span id=cat_error  class="red"></span>

						</div>

						<div class="col-md-6 col-sm-6" style="margin-bottom:20px;overflow-y: scroll;height:200px;">
							<label>Event Category:</label><span class="red">*</span></br>
							
							<?php

							$ecsql =  "SELECT * FROM event_category";
							$ecresult  = dbQuery($dbConn, $ecsql);

							if ($ecresult) {
								
								while ($ecrow = dbFetchAssoc($ecresult)) {
									$selectd = "";
									if(in_array($ecrow['idspevent'],$catids))
									{
										$selectd = "checked";
									}

								
									?>
									<input type="checkbox" name="catids[]" value="<?php echo $ecrow['idspevent'];?>"  <?php echo $selectd;?> >&nbsp;&nbsp;<?php echo $ecrow['speventTitle'];?><br>
									
							<?php
								}
							}

							?>
							
								<span id=cat_error  class="red"></span>

						</div>

						
						
					</div>
				</div>
				<div class="box-footer"> 
                    <input type="submit" name="btnButton" value="Update" id="add" class="btn vd_btn vd_bg-green finish" /> &nbsp;
                    <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> &nbsp;
                </div>
			</div>
			
		</form>
	</section><!-- /.content -->
	<script type="text/javascript">
            
           $( document ).ready(function() {
                $("#add").on("click", function(){

                //var selectPoint = $("#txtCategory").val();
                    var module_name = $("#module_name").val();
                         //var txtPercent = $("#txtPercent").val(); 


                      var flag=0;
      
       if (module_name!="")
       {
       var strArr = new Array();
       strArr = module_name.split("");

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

                     }*/ if(module_name == "" ){
                            

                        $("#cat_error").text("Please Enter Module Name.");
                        

                            //$("#subcat_error").text("Please Enter Sub Category.");
                             // $("#percent_error").text("Please Enter Percentage.");
                        
                        return false;

                     }
                    
                     else if(flag == 1){
                        $("#cat_error").text("Space not allowed.");
                        return false;

                     }
                     else{
                        
                         $("#frmAddMainNav").submit();
                         return true;
                     }

                 });
           });

        </script>   
		
		
		