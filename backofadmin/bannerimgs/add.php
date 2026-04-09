<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	
?>
	<!-- Content Header (Page header) -->
<style>

#img_contain{
  margin-top:10px;
 
}
#file-input{
  margin-left:7px;
  padding:10px;
  background-color:#01A65A;
}
#image-preview{
  height:132px;
  width:auto;
  display:block;
  margin-left: auto;
  margin-right: auto;
  
}
</style>
	<!-- Main content -->
	<section class="content" >
		<!-- start any work here. -->
		<form  method="post" action="uploadImage.php"  enctype="multipart/form-data">
			
			<div class="box box-success">
				<div class="box-body">
					
					<div class="row">
						
						<div class="col-md-12 col-sm-6" style="margin-bottom:20px;">
							<label>Upload banner Images:</label><span class="red">*</span></br>
							<div class="row">					
						<div class="col-md-6 col-sm-6" >
							   <input type='file' id="file-input" name="fileToUpload" />
								</div>
																						
						<div class="col-md-6 col-sm-6" >
							<div id='img_contain'>
      <img id="image-preview" align='middle'src="http://www.clker.com/cliparts/c/W/h/n/P/W/generic-image-file-icon-hi.png" alt="your image" title=''/>
    </div>
								</div>
								
						    </div>
						 
    
						</div>
						
						                    
					</div>
				</div>
				<div class="box-footer"> 
                    <input type="submit" name="btnButton" value="Save" class="btn vd_btn vd_bg-green finish" /> &nbsp;
                    <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> &nbsp;
                </div>
			</div>
			
		</form>
	</section><!-- /.content -->
		 <script type="text/javascript">
            
           $( document ).ready(function() {
                $("#add").on("click", function(){

                //var selectPoint = $("#txtCategory").val();
                    var txtIndusrtyType = $("#txtTitle").val();
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
                            

                        $("#cat_error").text("Please Enter Title.");
                        

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
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#image-preview').attr('src', e.target.result);
      $('#image-preview').hide();
      $('#image-preview').fadeIn(650);
    }
    reader.readAsDataURL(input.files[0]);
  }
}

$("#file-input").change(function() {
  readURL(this);
});

        </script>   
		
		
