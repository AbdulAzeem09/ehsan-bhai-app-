<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	
?>
	<!-- Content Header (Page header) -->

	<!-- Main content -->
	<section class="content" >
		
		<!-- start any work here. -->
		<form name="frmAddMainNav" id="frmAddMainNav" method="post" action="processProfileType.php?action=add"  enctype="multipart/form-data" >
			<div class="box box-success">
				<div class="box-body">
					
					<div class="" id="alertmsg">
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
								<label>Name:<span class="red">*</span></label>
								<input type="text" name="txtTitle" id="txtTitle" onkeyup="clearerror();"  maxlength="40" class="form-control" />
							   <span id=name_error  class="red"></span>
							</div>
						</div>
						<div class="col-md-3 col-sm-6" >
							<div class="form-group">
								<label>Icon:<span class="red">*</span></label>
								<input type="file" id="txtIcon" name="txtIcon" onkeyup="clearerror();" rows="2" cols="50"  class="form-control" style="resize:none;" >
								
								<!--<input type="text" name="txtIcon" id="txtIcon" onkeyup="clearerror();" maxlength="40" class="form-control" />-->
								<span id=icon_error  class="red"></span>

							</div>
						</div>
						
						
	                    
					</div>
					
				</div>
				<div class="box-footer"> 
	                <input type="button" name="btnButton" value="Save" id="add" class="btn vd_btn vd_bg-green finish" /> &nbsp;
	                <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> &nbsp;
            	</div>
			</div>

		</form>
	</section><!-- /.content -->
		        <script type="text/javascript">

		     function clearerror(){
		     	var txtIndusrtyType = $("#txtTitle").val();
		     	var selectPoint = $("#txtIcon").val();
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


           var flag2=0;
      
       if (selectPoint!="")
       {
       var strArr = new Array();
       strArr = selectPoint.split("");

       if(strArr[0]==" ") // this is the the key part. you can do whatever you want here!
       {
       flag2=1;
       }


       }

		     	if(txtIndusrtyType != "" && flag != 1 ){

		     	  $("#name_error").text("");
		     	}


		     	if(selectPoint != "" &&  flag2 != 1){
                    $("#icon_error").text("");
		     	}
		     }



            
           $( document ).ready(function() {
                $("#add").on("click", function(){

                var txtIndusrtyType = $("#txtTitle").val();
                    var selectPoint = $("#txtIcon").val();
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

          var flag2=0;
      
       if (selectPoint!="")
       {
       var strArr = new Array();
       strArr = selectPoint.split("");

       if(strArr[0]==" ") // this is the the key part. you can do whatever you want here!
       {
       flag2=1;
       }


       }

       if(txtIndusrtyType == "" && selectPoint  == "" || flag == 1 || flag2 == 1){
                            
                            if(flag == 1){
                        $("#name_error").text("Space not allowed.");
                        return false;

                     }
                     if(flag2 == 1){
                        $("#icon_error").text("Space not allowed.");
                        return false;

                     }

                        $("#name_error").text("Please Enter Name.");
                        

                            $("#icon_error").text("Please Enter Icon.");
                             // $("#percent_error").text("Please Enter Percentage.");
                        
                        return false;

                     }
                    else if(txtIndusrtyType != "" && selectPoint == "" || flag2 == 1 ){
                        if(flag2 == 1){
                        $("#icon_error").text("Space not allowed.");
                        return false;

                     }    

                        $("#name_error").text("");
                        $("#icon_error").text("Please Enter Icon.");
                              //$("#percent_error").text("Please Enter Percentage.");

                        return false;

                     }
                     else if(txtIndusrtyType == "" && selectPoint != ""  ){
                            

                        $("#name_error").text("Please Enter Name.");
                        $("#icon_error").text("");
                              //$("#percent_error").text("Please Enter Percentage.");

                        return false;

                     }
                     
                     else if(flag == 1){
                        $("#name_error").text("Space not allowed.");
                        return false;

                     }
                     else if(flag2 == 1){
                        $("#icon_error").text("Space not allowed.");
                        return false;

                     }
                     else{
                        
                         $("#frmAddMainNav").submit();
                         return true;
                     }

                 });
           });

        </script>   