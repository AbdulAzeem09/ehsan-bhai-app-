<?php
if (!defined('WEB_ROOT')) {
exit;
}

?>
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>Sticky Notes<small>[Add]aa</small></h1>
</section>
<!-- Main content -->
<section class="content" >
<!-- start any work here. -->
<form name="frmAddMainNav" id="frmAddMainNav" method="post" action="processNotes.php?action=add"  enctype="multipart/form-data" onsubmit="return validate(this)">

<div class="box box-success">

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
<div class="box-body">
<input type="hidden" name="user_id_from" value="<?php echo $_SESSION['userId'];?>" />
<input type="hidden" name="spNotesStatus" value="0" />

<div class="col-md-3">
<div class="form-group">
<label>User Assign</label><span class="red">*</span>
<select class="form-control" name="user_id_to" >
<?php
showAllUsers($dbConn, $_SESSION['userId']);
?>
</select>
</div>

</div>
<div class="col-md-3">
<div class="form-group">
<label>Task Menu:</label><span class="red">*</span>
<select class="form-control"  id="selectPoint" name="txtTaskMenu"  style="margin-bottom: 20px;">
<option value="0">Profile Type</option>
<option>Category</option>
<option>Registered Users</option>
<option>All Profiles</option>
<option>Module Form Setting</option>
<option>All Modules</option>
<option>Admin Module</option>
<option>All Posts</option>
<option>Sizes (Photo Gallery)</option>
<option>Art Gallery Category</option>
<option>Company News</option>
<option>Event Category</option>
<option>Entertainment Category</option>
<option>Project Type(Freelance)</option>
<option>Groups</option>
<option>Sponsor</option>
<option>Location</option>
<option>All Membership</option>
<option>Membership Enquiry</option>
<option>Profile Content</option>
<option>Job Board</option>
</select>
</div>
<span id=select_error  class="red"></span>
</div>

<div class="col-md-3">
<div class="form-group">
<label>Short Description:</label><span class="red">*</span>
<input type="text" name="txtShrtDesc" id="txtPoint" class="form-control" />
</div>
<span id=text_error  class="red"></span>
</div>
<div class="col-md-3">
<div class="form-group">
<label>Title:</label><span class="red">*</span>
<input type="text" name="txtTitle" id="txtTitle" class="form-control" />
</div>
<span id=percent_error  class="red"></span>
</div>
</div>
<div class="col-md-12 col-sm-12" style="margin-bottom:20px; margin-top:20px">
<label>Description:</label><span class="red">*</span></br>
<textarea class="formField1" rows="10" cols="130%" name="txtDesc" id="txtShrtDesc"></textarea>
</div>
<span id="txtShrtDesc_error"  class="red"></span>         
</div>
<div class="box-footer"> 
<input type="submit" name="btnButton" id="add" value="Save" class="btn vd_btn vd_bg-green finish" /> &nbsp;
<input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> &nbsp;
</div>
</div>


</form>
</section><!-- /.content -->
<script type="text/javascript">

$( document ).ready(function() {
$("#add").on("click", function(){
	//alert('ffffffffff');

var selectPoint = $("#selectPoint").val();
var txtIndusrtyType = $("#txtPoint").val();
var txtPercent = $("#txtTitle").val(); 
var txtShrtDesc = $("#txtShrtDesc").val(); 


var flag=0;

if (txtIndusrtyType!="")
{
var strArr = new Array();
strArr = txtIndusrtyType.split("");

if(strArr[0]==" ")
{
flag=1;
}
}
///alert(txtShrtDesc);
if( (selectPoint == "0") || (txtIndusrtyType == "") || (txtPercent == "") || (txtShrtDesc == "") ){
//alert("ddddddddddd");
if(selectPoint == "0"){
	$("#select_error").text("Please Select Profile Type.");
}else{
	$("#select_error").text("");
}

if(txtIndusrtyType == ""){
	$("#text_error").text("Please Enter Description.");
}else{
	$("#text_error").text("");
}

if(txtPercent == ""){
	$("#percent_error").text("Please Enter Title.");
} else {
	$("#percent_error").text("");
}
if(txtShrtDesc == ""){
$("#txtShrtDesc_error").text("Please Enter Desc.");
} else {
$("#txtShrtDesc_error").text("");
}
 return false;
} else if(flag == 1){
	//alert("ccccccccccccc");
$("#text_error").text("Space not allowed.");
return false;

} else {
	//alert("eeeeee");
$("#frmAddMainNav").submit();

}

});
});
</script>	