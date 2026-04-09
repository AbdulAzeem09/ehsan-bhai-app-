<!-- Main content -->
<section class="section">
   <!-- start any work here. -->
   <form name="frmAddMainNav" id="frmAddMainNav" method="post" action="processProfileType.php?action=add"  enctype="multipart/form-data" >
      <div class="box box-success">
         <div class="box-body">
            <a href="<?php echo WEB_ROOT_ADMIN . "news_letter/index.php?view=addnewsletter"; ?>"><input type="button" name="add" class="btn btn-primary pull-right" value="ADD NEWSLETTER"></a>
         </div>
      </div>
   </form>
</section>
<!-- /.content -->
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