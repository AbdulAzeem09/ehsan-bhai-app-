<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	
?>
	<!-- Content Header (Page header) -->

	<!-- Main content -->
	<section class="content" >
		<!-- start any work here. -->
		<form name="frmAddMainNav" id="frmAddMainNav" method="post" action="processCategory.php?action=add"  enctype="multipart/form-data" onsubmit="return validate(this)">
			
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
								<label>Title:</label><span class="red">*</span>
								<input type="text" name="txtTitle" id="txtTitle" onkeyup="clearerror();" class="form-control" />
								<span id=title_error  class="red"></span>
							</div>
						</div>
						<div class="col-md-4 col-sm-6" >
							<div class="form-group"> 
								<label>Folder Name:</label><span class="red">*</span>
								<input type="text" name="txtFoldName" id="txtFoldName" onkeyup="clearerror();" class="form-control" />
								 <span id=foldname_error  class="red"></span>
							</div>
						</div>
						<div class="col-md-4 col-sm-6">
							<div class="form-group">
								<label>Icon:</label><span class="red">*</span>
								<input type="file" name="txtImage" id="txtImage" accept='image/*'/>
								<span id=icon_error  class="red"></span>
							</div>
						</div>	
						
						                    
					</div>
				</div>
				<div class="box-footer"> 
	                <input type="submit" id="add" name="btnButton" value="Add" class="btn vd_btn vd_bg-green finish" /> &nbsp;
	                <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> &nbsp;
	            </div>
			</div>
			
			
		</form>
	</section><!-- /.content -->

  <script type="text/javascript">
  	function clearerror(){
		     	var txtTitle = $("#txtTitle").val();
		     	var txtFoldName = $("#txtFoldName").val();
		     	   
       var flag=0;
       if (txtTitle!="")
       {
       var strArr = new Array();
       strArr = txtTitle.split("");

       if(strArr[0]==" ") // this is the the key part. you can do whatever you want here!
       {
       flag=1;
       }


       }

       var flag2=0;
      
       if (txtFoldName!="")
       {
       var strArr = new Array();
       strArr = txtFoldName.split("");

       if(strArr[0]==" ") // this is the the key part. you can do whatever you want here!
       {
       flag2=1;
       }


       }

		     	if(txtTitle != "" && flag != 1 ){

		     	  $("#title_error").text("");
		     	}


		     	if(txtFoldName!= "" &&  flag2 != 1){
                    $("#foldname_error").text("");
		     	}
		     }

        	
           $( document ).ready(function() {
                $("#add").on("click", function(){


                	var txtTitle = $("#txtTitle").val();
                	var txtFoldName = $("#txtFoldName").val();
                	var txtImage = $("#txtImage").val();




                      var flag=0;
      
       if (txtTitle!="")
       {
       var strArr = new Array();
       strArr = txtTitle.split("");

       if(strArr[0]==" ") // this is the the key part. you can do whatever you want here!
       {
       flag=1;
       }


       }

          var flag2=0;
      
       if (txtFoldName!="")
       {
       var strArr = new Array();
       strArr = txtFoldName.split("");

       if(strArr[0]==" ") // this is the the key part. you can do whatever you want here!
       {
       flag2=1;
       }


       }


                	/*alert(txtImage);*/

                if(txtTitle == "" && txtFoldName == "" && txtImage == "" || flag == 1 || flag2 == 1){
                	 if(flag == 1){
                        $("#title_error").text("Space not allowed.");
                        return false;

                     }
                     if(flag2 == 1){
                        $("#foldname_error").text("Space not allowed.");
                        return false;

                     }

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

                     }

                       else if(flag == 1){
                        $("#title_error").text("Space not allowed.");
                        return false;

                     }
                     else if(flag2 == 1){
                        $("#foldname_error").text("Space not allowed.");
                        return false;

                     }
                     else{
                        
                         $("#frmAddMainNav").submit();
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