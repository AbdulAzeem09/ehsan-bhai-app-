<?php 
include('../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="my-groups/";
include_once ("../authentication/check.php");

}else{
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");
if (!isset($_SESSION['pid'])) {
include_once ("../authentication/check.php");
$_SESSION['afterlogin'] = "../grouptimelines/?groupid=" . $_GET["groupid"] . "&groupname=" . $_GET['groupname'] . "&timeline";
}
$pid=$_SESSION['pid'];
$getid=$_GET['groupid'];
$obj2=new _spAllStoreForm;	
$ress2=$obj2->readdatabymulid($getid,$pid);
if($ress2 ==false){
//die("=======");
header("location:$BaseUrl/my-groups/?msg=notaccess");

}
?>


<!DOCTYPE html>
<html lang="en-US">

<head>
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">
<Style>
.dropdown-menu li label {
background-color: #eaeaea !important;
border: 1px solid #bdbdbd !important;
display: block !important;
margin: 0 !important;
padding: 9px 25px !important;
color: #7e7e7e !important;
}
.multiselect-selected-text{ 
color : black!important;

}
.dropdown-menu{

margin-bottom: -511px !important;
}
.dropdown-menu {
overflow-y: scroll !important;
height:400px !important;
width: 100% !important;
background-color: #fff !important;
margin: 0 0 10px 0 !important;
min-width: 254px !important;
}
.dropdown-menu::-webkit-scrollbar {
width:5px !important;
}
.dropdown-menu::-webkit-scrollbar-track {
-webkit-box-shadow:inset 0 0 6px rgba(0,0,0,0.3) !important; 
border-radius:5px !important;
}
button .caret
{
color: #080707 !important;
}
.sweet-alert p {

display: none!important;
}



</style>

<?php include('../component/f_links.php');?>
<link href="<?php echo $BaseUrl?>/assets/css/date-time/bootstrap-datetimepicker.css" rel="stylesheet" media="screen">
<link href="<?php echo $BaseUrl?>/assets/css/date-time/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">



<script type="text/javascript">
//USER ONE
$(function () {
$('#users').multiselect({
includeSelectAllOption: true
});
$('#groups').multiselect({
includeSelectAllOption: true
});
$('#importusers').multiselect({
includeSelectAllOption: true
});
});
//USER TWO
$(function () {
$('#userstoo').multiselect({
includeSelectAllOption: true
});
$('#groupstoo').multiselect({
includeSelectAllOption: true
});
$('#importuserstoo').multiselect({
includeSelectAllOption: true
});
});

function showGroup(group){
if(group == 'user'){
alert("1");
$("#user").css('display', '');
$("#group").css('display', 'none');
$("#importuser").css('display', 'none');

}else if(group == 'group'){
alert("2");
$("#user").css('display', 'none');
$("#group").css('display', '');
$("#importuser").css('display', 'none');

}else if(group == 'importuser'){
alert("3");
$("#user").css('display', 'none');
$("#group").css('display', 'none');
$("#importuser").css('display', '');

}
}
</script>
</head>

<body class="bg_gray" onload="pageOnload('groupdd')" >
<?php

$g = new _spgroup;
$result = $g->groupdetails($_GET["groupid"]);
//echo $g->ta->sql;
if ($result != false) {
$row = mysqli_fetch_assoc($result);
$gimage = $row["spgroupimage"];
$spGroupflag = $row['spgroupflag'];
}
?>
<?php include('../header.php');?>
<section class="landing_page">
<div class="container">
<div class="row">
<div id="sidebar" class="col-md-2 no-padding" style="width: 195px; top: auto; bottom: auto; left: 0px; right: auto;">
<?php include('../component/left-group.php');?>
</div>
<div class="col-md-10">



<div class="row">
<div class="col-md-12">
<div class="about_banner" id="ip6">
<div class="top_heading_group " id="ip6">
<div class="row" id="id">


<!--    <div class="col-md-6"> -->

<ol class="breadcrumb">
<li><a href="<?php echo $BaseUrl;?>/grouptimelines/addSms.php?groupid=<?php echo $_GET['groupid']?>&groupname=<?php echo $_GET['groupname']?>&smsCampaigns" style="font-size: 20px;color: #202548;">SMS Campaign</a></li>
<li><a href="<?php echo $BaseUrl;?>/grouptimelines/smsReport.php?groupid=<?php echo $_GET['groupid']?>&groupname=<?php echo $_GET['groupname']?>&smsCampaigns" style="font-size: 20px; color: #202548;" >Reports</a></li>        
</ol>
<!-- </div> -->


<!--   <div class="col-md-6">


<li ><a href="<?php echo $BaseUrl;?>/grouptimelines/addSms.php?groupid=<?php echo $_GET['groupid']?>&groupname=<?php echo $_GET['groupname']?>&smsCampaigns"><p class="btn56 active" >SMS Campaign</p></a></li>



</div>

<div class="col-md-6">
<li class="hv"><a href="<?php echo $BaseUrl;?>/grouptimelines/smsReport.php?groupid=<?php echo $_GET['groupid']?>&groupname=<?php echo $_GET['groupname']?>&smsCampaigns"><p class="btn56" >Reports</p></a></li>  
</div> -->
<script>
// Add active class to the current button (highlight it)
var header = document.getElementById("myDIV");
var btns = header.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
btns[i].addEventListener("click", function() {
var current = document.getElementsByClassName("active");
current[0].className = current[0].className.replace(" active", "");
this.className += " active";
});
}
</script>
</div>
</div>

<div class="sms_campaign">
<div class="form-group">
<label for="name">Campaign Name</label> <span class="red">*</span>
<input class="form-control" id="name" placeholder="Write Name For Campaign" type="text" required>
</div>
<div class="form-group">
<label for="text">Text Message</label> <span class="red">*</span>
<textarea id="text" placeholder="Message..." class="form-control" rows="8" cols="30" maxlength="140" ></textarea>
<div id="textarea_feedback">140 characters remaining</div>
</div>
<div class="row">
<div class="col-md-8">
<div class="row">   
<!-- <div class="form-group col-md-6 " style="margin-bottom: 0px;">
<div class="">
<label for="date">Date</label> <span class="red">*</span>
<div class="controls input-append date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
<input size="16" type="text" class="form-control " id="datetoo" value="" readonly>
<span class="add-on"><i class="icon-remove"></i></span>
<span class="add-on"><i class="icon-th"></i></span>
</div>
<input type="hidden" id="dtp_input2" value="" /><br/>
</div>
</div> -->
<!--         <div class="form-group col-md-6 m_btm_20">
<label for="time">Time</label> <span class="red">*</span>
<select class="form-control" id="time">
<?php
$start = "00:00";
$end = "23:59";

$tStart     = strtotime($start);
$tEnd       = strtotime($end);
$tNow       = $tStart;

while($tNow <= $tEnd){
echo '<option value="'.date("H:i",$tNow).'">'.date("H:i",$tNow).'</option>';
$tNow = strtotime('+15 minutes',$tNow);
}
?>
</select>
</div> -->
<div class="form-group col-md-6 " >
<label for="pass">Select Group</label> <span class="red">*</span>
<?php    

//print_r($json);die;




?>
<select name="user_group" class="form-control" id="group" onchange="showGroup(this.value)">
<option>Select Group</option>
<?php  
$ps = new _spgroup;
$json=$ps->SearchGrouplist($_GET["searchTerm"],$_SESSION["uid"],$_SESSION["pid"]);
foreach($json as $ds){
//print_r($ds);die;
?>

<option value="<?php echo $ds['id'];?>"><?php echo $ds['text'];?></option>

<?php } ?>

<!--   <option value="group">Group</option>
<option value="importuser">Uploaded User</option> -->
</select>

</div>
<div class="col-md-6" id="user">
<div class="form-group dropup" style="width: 100%;">
<label>Select Members </label> <span class="red">*</span><br>

<select id="users" name="users" multiple="multiple" class="form-control" style="width: 100%;">  

<?php

$r = new _spprofilehasprofile; 
$unread = new _friendchatting;
$a = array();
$res = $r->friends($_SESSION["uid"]);//As a receiver
//echo $r->ta->sql;
if($res != false){
while($rows = mysqli_fetch_assoc($res)){
$rslt = $g->friendprofile($_SESSION["uid"],$rows["spProfiles_idspProfileSender"]);
$groupname = "";
$groupid = 0;
$g = new _spgroup;
if($rslt != false)
{
$rws = mysqli_fetch_assoc($rslt);
$groupid = $rws["idspGroup"];
$groupname = $rws["spGroupName"];
$groupname = str_replace(' ', '', $groupname);
}

array_push($a,$rows["spProfiles_idspProfileSender"]);
$p = new _spprofiles;

$sender = $rows["spProfiles_idspProfileSender"];//Friend
$receiver = $rows["spProfiles_idspProfilesReceiver"];//My
$total = 0;
$unres = $unread->unreadmessage($sender,$_SESSION["uid"]);//$receiver
if($unres != false)
{
$total = $unres->num_rows;
}

$result = $p->read($rows["spProfiles_idspProfileSender"]);
if($result != false)
{   
$row = mysqli_fetch_assoc($result);
echo "<option value='".$row['idspProfiles']."' id='".$row['idspProfiles']."' >".$row['spProfileName']."</option>";
}
}
}
//RECEIVER PROFILE NAME
$b = array();
$r = new _spprofilehasprofile;
$res = $r->friend($_SESSION["uid"]);//As a sender
//echo $r->ta->sql;
if($res != false)
{               
while($rows = mysqli_fetch_assoc($res))
{

array_push($b,$rows["spProfiles_idspProfilesReceiver"]);


$r = in_array($rows["spProfiles_idspProfilesReceiver"],$a,true);

$receiver = $rows["spProfiles_idspProfilesReceiver"];//Friend
$sender = $rows["spProfiles_idspProfileSender"];//My
$total = 0;
$unres = $unread->unreadmessage($receiver,$_SESSION["uid"]);
//echo $unread->ta->sql;
if($unres != false)
{
$total = $unres->num_rows;
}

if($r == "")
{
$p = new _spprofiles;
$groupid = 0;
$groupname = "";
$g = new _spgroup;
$rslt = $g->friendprofile($_SESSION["uid"],$rows["spProfiles_idspProfilesReceiver"]);

if($rslt != false)
{
$rws = mysqli_fetch_assoc($rslt);
$groupid = $rws["idspGroup"];
$groupname = $rws["spGroupName"];
$groupname = str_replace(' ', '', $groupname);
}

$result = $p->read($rows["spProfiles_idspProfilesReceiver"]);
if($result != false)//All friend details
{   
$row = mysqli_fetch_assoc($result);

echo "<option value='".$row['idspProfiles']."' id='".$row['idspProfiles']."' >".$row['spProfileName']."</option>";
}
}
}
}
?>
</select>
</div>
</div>
<!--   <div class="col-md-6" id="group" style="display:none">
<div class="form-group dropup">
<label>Select Group</label>
<select id="groups" name="groups" multiple="multiple" class="form-control" >  
<?php 
$g = new _spgroup;
$result = $g->groupmember($_SESSION['uid']);
//echo $p->ta->sql;
//echo $g->ta->sql;
if ($result != false){
while($row = mysqli_fetch_assoc($result)) {
echo "<option value='".$row['idspGroup']."' id='".$row['idspGroup']."' >".$row['spGroupName']."</option>";
}
}

?>
</select>
</div>
</div> -->
<!--   <div class="col-md-6" id="importuser" style="display:none">
<div class="form-group dropup">
<label>Select Uploaded Users</label>
<select id="importusers" name="importusers" multiple="multiple" class="form-control"   >  
<?php 
$g = new emailCampaignUser;
$result2 = $g->getImportEmail($_SESSION['uid']);
if ($result2 != false){
while($row2 = mysqli_fetch_assoc($result2)) {
echo "<option value='".$row2['id']."' id='".$row2['id']."' >".$row2['name']."</option>";
}
}
?>
</select>
</div>
</div> -->

<div class="col-md-6">
<div class="box-footer">
<button id="save" class="btn btn_gray btn-border-radius">Start Campaign</button>
<input type="hidden" name="emails" id="emails" value="" />
</div>
</div>

</div>
</div>


<!--   <div class="col-md-4">
<div class="right_import_user">
<form action="<?php echo $BaseUrl;?>/grouptimelines/?groupid=<?php echo $txtgroupid;?>&groupname=<?php echo $txtgroupname?>&importFile" class="form-horizontal" method="post" enctype="multipart/form-data">
<label for="pass">Choose File</label>
<input type="file" name="import_file"  id="import_file" required="" />


</form>
<a href="<?php echo $BaseUrl?>/documents/users.xls"><i class="fa fa-file"></i> Download Sample Format</a> 
</div>
</div> -->
</div>

<input type="hidden" name="optionValue" id="optionValue" value="user" />
<input type="hidden" name="Ids" id="Ids" value="" />

</div>



</div>
</div>
</div>

</div>

</div>
</div>
</section>

<?php 
include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>

<!--MY SCRIPTS FOR FINAL TESTING START-->
<script type="text/javascript">
//SEND SMS API LINK
$('#save').on('click', function () {
$("#Ids").val();
var optionValue = $("#optionValue").val();
if( optionValue == 'user'){
//alert('option1');
var option = 'user';
var selected = $("#user option:selected");
var subject = $("#name").val();
// alert(subject);
var sms = $("#text").val();
// alert(sms);
var group = $("#group").val();
//alert(group);
var member = $("#users").val();
//alert(member);

if(subject==''){
$('.red').text('This Field is required');
var fal=1;
}

if(sms==''){
$('.red').text('This Field is required');
var fal=1;
}
if(group=='Select Group'){
$('.red').text('This Field is required');
var fal=1;
}
if(member==null){
$('.red').text('This Field is required');
var fal=1;
}
if(fal==1){
return false;
}

var ids = "";
selected.each(function () {
ids += + $(this).val() + ",";
});
$("#Ids").val(ids);
} /*else if(optionValue == 'group'){
var option = 'group';
var selected = $("#group option:selected");
var ids = "";
selected.each(function () {
ids += + $(this).val() + ",";
});
$("#Ids").val(ids);
}else{
var option = 'importuser';
var selected = $("#importuser option:selected");
var ids = "";
selected.each(function () {
ids += + $(this).val() + ",";
});
$("#Ids").val(ids);
}*/
$.ajax({

type:'POST',
url:'/grouptimelines/sms_campaign/sendSmsCampaign.php',
data:{
'name':$('#name').val(),
'type':'Sms',
'text':$('#text').val(),
'date':$('#datetoo').val(),
'time':$('#time').val(),
'user_id':$('#user_id').val(),
'user_or_group':option,
'group_id':$('#groupOption').val(),
'status':'pending',
'Ids': $("#Ids").val(),

},
success:function (data) {
let result=data.trim();
if(result=='success'){
//alert('1111');
swal('Success','Campaign added','success');
$('#name').val(''),
$('#text').val(''),
$('#datetoo').val(''),
$('#time').val('');
location.reload();
}
else{
//alert('else1');
swal('Error',data,'error');
}
},
error:function (data) {   
//alert('else2');					

swal('Error',data,'error');
}
});

})


$(document).ready(function() {
var text_max = 140;
$('#textarea_feedback').html(text_max + ' characters remaining');
$('#text').keyup(function() {
var text_length = $('#text').val().length;
var text_remaining = text_max - text_length;
$('#textarea_feedback').html(text_remaining + ' characters remaining');
});
});




</script>
<!--MY SCRIPTS FOR FINAL TESTING END-->


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<link href="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
<script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js" type="text/javascript"></script> 

<script type="text/javascript" src="<?php echo $BaseUrl?>/assets/js/date-time/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo $BaseUrl?>/assets/js/date-time/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<script type="text/javascript">
$('.form_datetime').datetimepicker({
//language:  'fr',
weekStart: 1,
todayBtn:  1,
autoclose: 1,
todayHighlight: 1,
startView: 2,
forceParse: 0,
showMeridian: 1
});
$('.form_date').datetimepicker({
language:  'fr',
weekStart: 1,
todayBtn:  1,
autoclose: 1,
todayHighlight: 1,
startView: 2,
minView: 2,
forceParse: 0
});
$('.form_time').datetimepicker({
language:  'fr',
weekStart: 1,
todayBtn:  1,
autoclose: 1,
todayHighlight: 1,
startView: 1,
minView: 0,
maxView: 1,
forceParse: 0
});
</script>
</body>
</html>
<?php
} ?>