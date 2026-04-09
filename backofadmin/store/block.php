<?php

	if (!defined('WEB_ROOT')) {
		exit;
	}
	$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

	if (isset($_GET['postid']) && $_GET['postid'] > 0) {
		$postid = $_GET['postid'];
	}else {
		// redirect to index.php if user id is not present
		redirect('index.php');
	}
?>
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Block <small>[Store] </small></h1>
	</section>
	<!-- Main content -->
	<section class="content" >
		<!-- start any work here. -->
		<form name="frmAddMainNav" id="frmAddMainNav" method="post" action="processPosting.php?action=block"  enctype="multipart/form-data" >
			<input type="hidden" name="idBlockPost" value="<?php echo $postid; ?>">
			<div class="container-fluid container_block">
				<div class="row inner_heading">
					<!--<h1>Block Notes</h1><hr>---->
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
					
					<div class="col-md-12 col-sm-12" style="margin-bottom:20px;">
						<label>Why block this post?</label> <span class="red">*</span></br>
						<textarea class="formField" name="txtDesc" rows="6" id="txtDesc" style="width: 308px;"></textarea>
						<br>
					   <span id=subcat_error  class="red"></span>  
					</div>
					                  
				</div>
				<div style="min-height: 20px;"></div>
			</div>
			<div class="row">
				<div class="col-md-offset-5 col-xs-offset-3 col-sm-offset-5" style="margin-left: 21%!important;">
					<input type="submit" name="btnButton" value="Block" id="add" class="butn" /> &nbsp;
					<input type="button" name="btnCanlce" value="Back" class="butn" onclick="window.location.href='index.php'"/>
				</div>
			</div>
		</form>
	</section><!-- /.content -->
	<script type="text/javascript">
            
           $( document ).ready(function() {
                $("#add").on("click", function(){

                
                    var txtIndusrtyType = $("#txtDesc").val();
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

                     }*/ if(txtIndusrtyType == "" ){
                            

                      
                        

                            $("#subcat_error").text("Please Enter Why block this post.");
                             // $("#percent_error").text("Please Enter Percentage.");
                        
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
		