<?php
// error_reporting(E_ALL);
// 	ini_set('display_errors', '1');



include('../univ/baseurl.php');
session_start();

if($_SESSION['ptid'] != 1){
header('location:'.$BaseUrl.'/job-board/');
}

if(!isset($_SESSION['pid'])){
$_SESSION['afterlogin']="store/";
include_once ("../authentication/check.php");

}else{
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$f = new _spprofiles;

$_GET["categoryid"] = "2";
$_GET["categoryName"] = "Job Board";
$activePage = 7;
$header_jobBoard = "header_jobBoard";

$cat = isset($_GET['cat']) ?  $_GET['cat'] : '';
//die('==');


if(isset($_POST['Change_Current_Location'])){
session_start();

$_SESSION["Countryfilter"] = $_POST['spUserCountry'];
$_SESSION["Statefilter"] = $_POST['spUserState'];
$_SESSION["Cityfilter"] = $_POST['spUserCity'];


//unset($_SESSION['Products']);
}

if(isset($_POST['Closeresetlocation'])){
session_start();

unset($_SESSION['Countryfilter']);
unset($_SESSION['Statefilter']);
unset($_SESSION['Cityfilter']);

}

?>
<!DOCTYPE html>
<html lang="en-US">

<head>

<?php include('../component/f_links.php');?>
<?php include('component/links.php'); ?>

<!-- owl carousel -->
<script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
<!-- Morris chart -->

<?php include('../../component/dashboard-link.php'); ?>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>


<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
<style type="text/css">

.dropdown {

	width: 172px !important;
}

.category_tabs .resp-tabs-container .category-engineer .category-engineer-content .engineer-details .specialities {
margin-bottom: 0px;
margin-top: 0px;
padding: 0;
height: 30px;
overflow: hidden;
}
.skill-category-list li a{
color:#817878;
}

.nav > li > a:hover, .nav > li > a:focus {
text-decoration: none;
background-color: #e0dede;
color:black;
}

li .active{
color: #817878!important;
border: solid 1px black;
border-left: 4px solid #ff6802;
}

.leftsidebar.left_freelance_top1 {
background-color: white;
padding: 0px 10px;
}

.list-wrapper {
padding: 15px;
overflow: hidden;
display: contents;

}



.list-item h4 {
color: ##31abe3;
font-size: 18px;
margin: 0 0 5px;
}

.list-item p {
margin: 0;
}

.simple-pagination ul {
margin: 0 0 20px;
padding: 0;
list-style: none;
text-align: center;
}

.simple-pagination li {
display: inline-block;
margin-right: 5px;
}

.simple-pagination li a,
.simple-pagination li span {
color: #666;
padding: 5px 10px;
text-decoration: none;
border: 1px solid #31abe3;
background-color: #31abe3;
box-shadow: 0px 0px 10px 0px #EEE;
}

.simple-pagination .current {
color: #FFF;
background-color: ##31abe3;
border-color: ##31abe3;
}

.simple-pagination .prev.current,
.simple-pagination .next.current {
background: ##31abe3;
}

.cls 
{
margin-top:-19px!important;
}
.bread_d{
font-size: 18px;
font-family: Marksimon;
text-transform: uppercase;
}
.btn-group {
margin-top: 18px;
}
#profileDropDown li.active {
background-color: #1f3060;
margin-top: -1px;
}
#profileDropDown li.active a {
color: #fff;
}
ul#profileDropDown {
border: none;
}	
.dropdown-menu li {

border-bottom: 1px solid #ccc;
}
</style>

</head>

<body class="bg_gray">
<?php
include_once("../header.php");
//die;
?>
<section class="landing_page">
<div class="container">
<div class="row">
<?php // include('thisisjobboardfront.php'); ?>
<!-- <div class="col-md-3"> -->
<div class="col-xs-12 col-sm-3 ">
<div class="leftsidebar left_freelance_top1">
<?php include('../component/left-jobseeker.php');?>
</div>
</div>
<!-- </div> -->
<div class="col-md-9 no-padding">
<div class="col-sm-12 nopadding dashboard-section whiteboardmain" style="margin-top: 7px;padding: 16px 0px 0px 0px;">
<div class="col-xs-12 dashboardbreadcrum">
<ul class="breadcrumb">
<!--		<li><a href="<?php //echo $BaseUrl;?>/job-board">Bussiness Home</a></li>   
<li>Browse All Jobseekers</li> -->
<li class="bread_d"><a href="<?php echo $BaseUrl?>/job-board/dashboard/" > DASHBOARD </a></li>
<li class="bread_d"><?php echo ucfirst($cat); ?></li>

<!-- <li><?php echo $title;?></li> -->
<!--
<a href="<?php //echo $BaseUrl.'/post-ad/job-board/?post';?>" class="btn " style="float: right;background-color: #31abe3;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;">Post a job</a>
-->


<div style="float:right; margin-top: -10px;">
<p >
<?php

$usercountry = $_SESSION["Countryfilter"];
$userstate = $_SESSION["Statefilter"];
$usercity = $_SESSION["Cityfilter"];

$co = new _country;
$result3 = $co->readCountry();
if($result3 != false){
while ($row3 = mysqli_fetch_assoc($result3)) {
if(isset($usercountry) && $usercountry == $row3['country_id']){
$currentcountry = $row3['country_title'];
$currentcountry_id = $row3['country_id'];

}
}
}
//die('==');
if (isset($userstate) && $userstate > 0) {
$countryId = $currentcountry_id;
$pr = new _state;
$result2 = $pr->readState($countryId);
if($result2 != false){
while ($row2 = mysqli_fetch_assoc($result2)) {
if(isset($userstate) && $userstate == $row2["state_id"] ){
$currentstate_id = $row2["state_id"];
$currentstate = $row2["state_title"];
}
}
}
}if (isset($usercity) && $usercity > 0) {
$stateId = $currentstate_id;
$co = new _city;
$result3 = $co->readCity($stateId);
//echo $co->ta->sql;
if($result3 != false){
while ($row3 = mysqli_fetch_assoc($result3)) {
if(isset($usercity) && $usercity == $row3['city_id']){
$currentcity = $row3['city_title'];
$currentcity_id = $row3['city_id'];
}                                                                                               }                                                                                             }
}  
;
?>
<?php

if(!empty($currentcountry)){
echo $currentcountry;
}

if(!empty($currentstate)){
echo ', '.$currentstate;
}
if(!empty($currentcity)){
echo ', '.$currentcity;  
}





if(isset($_SESSION['Countryfilter'])){
if(!empty($_SESSION['Countryfilter'])){
$ccff = $_SESSION['Countryfilter'];
$Countryfilter = "AND spPostingsCountry = $ccff" ;
}
}

if(isset($_SESSION['Statefilter'])){
if(!empty($_SESSION['Statefilter'])){
$ssf = $_SESSION['Statefilter'];
$Statefilter = "AND spPostingsState = $ssf" ;
}
}

if(isset($_SESSION['Cityfilter'])){
if(!empty($_SESSION['Cityfilter'])){
$ciicff = $_SESSION['Cityfilter'];
$Cityfilter = "AND spPostingsCity = $ciicff" ;
}
}




?>
</p>
<a href="#" style="cursor:pointer;" data-toggle="modal" data-target="#myModal">Change Location</a>     

</div>

<!-- <a href="https://thesharepage.com/post-ad/freelancer/?post" class="btn post-project postproject" style="float: right;background-color: orange;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;" >Post a project</a> -->
</ul>
</div>
</div>

<div class="row category_tabs " id="jobseekrtab" style="margin-top: 108px;">
<div class="resp-tabs-container" style="border-top: 0px;" >
<div class="col-sm-12 nopadding">
<?php
$limit = 50000;
$offset = $_GET['offset'];
if($offset > 0 ){
//$offset = $offset
$offset = $limit * $offset;
}
$usercountry = $_SESSION["Countryfilter"];
$userstate = $_SESSION["Statefilter"];
$usercity = $_SESSION["Cityfilter"];
/*if(($_SESSION["Countryfilter"])&&($_SESSION["Statefilter"])&&($_SESSION["Cityfilter"])){ 
//$result = $f->profileTypePerson_location(5, $_SESSION['uid'],$_SESSION["Countryfilter"], $_SESSION["Statefilter"], $_SESSION["Cityfilter"]);
$result = $f->profileTypePerson_data(5, $_SESSION['uid']);  */ 
//print_r($result);
//die('=========');
//}else{ echo 1111;
if($cat == 'ALL'){    //echo 1111;

$result = $f->profileTypePerson_data_1(5, $_SESSION['uid'],$limit,$offset,$usercountry, $userstate, $usercity);   
	//$result = $f->profileTypePerson_data(5, $_SESSION['uid']);   
//print_r($result);
//die('=========');

}else{   //echo 2222; 

$result = $f->profileTypePersonbycat_1(5, $_SESSION['uid'],$cat,$limit,$offset,$usercountry, $userstate, $usercity);   

}
//}

//$result = $f->freelancers($_SESSION['uid']);
//echo $f->ta->sql;
if($result){
while ($row = mysqli_fetch_assoc($result)) {
//print_r($row);
$skill = explode(',', $row['skill']);
$count = $f->flageCountByProfileId($row['idspProfiles']);

?>
<div class="list-wrapper">
<div class="list-item">
<?php if($count->num_rows < 10) { ?>
<div class="category-engineer">
<div class="category-engineer-content">
<div class="engineer-avatar">
<?php
if(isset($row['spProfilePic'])){
echo "<img  alt='Posting Pic' class='img-responsive center-block' src=' ".($row['spProfilePic'])."' >" ;
}else{
echo "<img  alt='Posting Pic' class='img-responsive center-block' src='../img/default-profile.png' >" ;
}
?>
<h3 class="engineer-name"><?php echo ucfirst($row['spProfileName']);?></h3>
</div>
<div class="col-xs-12 engineer-details">
<label class="jobseek" style="float: right;margin-right: 3px;">
<?php
/*print_r($_SESSION['uid']);
print_r($_SESSION['pid']);*/
$st = new _job_favorites;
$res_ev = $st->chekFavourite($row['idspProfiles'], $_SESSION['pid'], $_SESSION['uid']);
//$res_ev = $ev->read($_GET["postid"]);
// echo $ev->ta->sql;
if($res_ev != false){
?>
<a href="javascript:void(0)" id="remtofavoritesjobseek" data-postid="<?php echo $row['idspProfiles'];?>" data-pid="<?php echo $_SESSION['pid'];?>">

<i class="fa fa-heart " style="padding-top: 11px;padding-bottom: 5px;"></i></a>  
<?php
}else{
?>

<a href="javascript:void(0)" id="addtofavouritejobseek" data-postid="<?php echo $row['idspProfiles'];?>" data-pid="<?php echo $_SESSION['pid'];?>">
<p style="color:black;font-size:21px;padding: 0px 2px; ">	
&#9825;</p>

</a>
<?php
}
?>
</label>
<div class="col-xs-12 specialities">
<?php
$i = 1;

if($skill != ''){
foreach($skill as $key => $value){
if($i <= 3){
	if($value){
echo "<span>".$value."</span>";
}
}
$i++;
}
}else{
echo "<span>No Skills Define</span>";
}


?>

</div>
<a href="<?php echo $BaseUrl.'/job-board/user-profile.php?pid='.$row['idspProfiles'];?>" class="btn jobboard-view-profile">View Profile</a>
</div>
</div>
</div>
<?php } ?>
</div>
</div>



<?php

}
}else{

echo "<h4 style='text-align:center;'>No Jobseeker found!</h4>";
}
?>
</div>

<?php

$noffset = $_GET['offset'] + 1;
$pageno = $_GET['offset'] + 1;

if($noffset > 0 ){
//$offset = $offset

$noffset = $limit * $noffset;
}

if($cat == 'ALL'){

$resultnew = $f->profileTypePerson(5, $_SESSION['uid'],$limit,$noffset);

}else{

$resultnew = $f->profileTypePersonbycat(5, $_SESSION['uid'],$cat,$limit,$noffset);

}

//print_r($resultnew);



if($resultnew){



?>

<?php //class="btn btn-info jobboard-view-profile" style="float:right;">Next</a>*/?>

<?php }

/*$poffset = $_GET['offset'] - 1;

if($poffset >=0){ ?>


<a href="<?php echo $BaseUrl.'/job-board/all-jobseeker.php?cat='.$_GET['cat'].'&offset='.$poffset;?>" class="btn btn-info jobboard-view-profile" style="float:right;">Prev Page</a>




<?php  } */?>


</div>

</div>
<div id="pagination-container"></div>



</div>
</div>
</div>
</section>
<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" style="margin: -1px !important;">Change Current Location</h4>
</div>
<!----action="<?php echo $BaseUrl?>/post-ad/dopost.php"--->
<form method="post">
<div class="modal-body">
<div class="row">

<div class="col-md-4">
<div class="form-group">
<label for="spPostingCountry" class="lbl_2">Country</label>
<select class="form-control " name="spUserCountry" id="spUserCountry" >
<option value="">Select Country</option>
<?php
$co = new _country;
$result3 = $co->readCountry();
if($result3 != false){
while ($row3 = mysqli_fetch_assoc($result3)) {
?>
<option value='<?php echo $row3['country_id'];?>' <?php echo (isset($_SESSION["Countryfilter"] ) && $_SESSION["Countryfilter"]  == $row3['country_id'])?'selected':''; ?>   ><?php echo $row3['country_title'];?></option>
<?php
}
}
?>
</select>
<!-- <input type="text" class="form-control" id="spPostingCountry" name="spPostingsCountry" value="<?php echo (isset($eCountry) ? $eCountry : $country); ?>"> -->
</div>
</div>
<div class="col-md-4">
<div class="loadUserState">
<label for="spPostingCity" class="lbl_3">State</label>
<select class="form-control" name="spUserState">
<option>Select State</option>
<?php
if (isset($_SESSION["Statefilter"] ) && $_SESSION["Statefilter"] > 0) {
$countryId = $_SESSION["Countryfilter"];
$pr = new _state;
$result2 = $pr->readState($countryId);
if($result2 != false){
while ($row2 = mysqli_fetch_assoc($result2)) { ?>
<option value='<?php echo $row2["state_id"];?>' <?php echo (isset($_SESSION["Statefilter"] ) && $_SESSION["Statefilter"] == $row2["state_id"] )?'selected':'';?> ><?php echo $row2["state_title"];?> </option>
<?php
}
}
}
?>
</select>
</div>
</div>
<div class="col-md-4">
<div class="loadCity">
<div class="form-group">
<label for="spPostingCity">City</label>
<select class="form-control" name="spUserCity" >
<option>Select City</option>
<?php
if (isset($_SESSION["Cityfilter"] ) && $_SESSION["Cityfilter"] > 0) {
$stateId = $_SESSION["Statefilter"];
$co = new _city;
$result3 = $co->readCity($stateId);
//echo $co->ta->sql;
if($result3 != false){
while ($row3 = mysqli_fetch_assoc($result3)) { ?>
<option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($_SESSION["Cityfilter"] ) && $_SESSION["Cityfilter"]== $row3['city_id'])?'selected':''; ?> ><?php echo $row3['city_title'];?></option> <?php
}
}
} ?>
</select>
<!-- <input type="text" class="form-control" id="spPostingCity" name="spPostingsCity" value="<?php echo (isset($eCity) ? $eCity : $city); ?>"> -->
</div>
</div>
</div>
<!--  <div class="col-md-6">
<div class="form-group">
<label for="spPostingCountry">Country</label>
<input type="text" class="form-control" id="spPostingCountry" name="spPostingsCountry" value="<?php echo (isset($eCountry) ? $eCountry : $country); ?>">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="spPostingCity">Location/City</label>
<input type="text" class="form-control" id="spPostingCity" name="spPostingsCity" value="<?php echo (isset($eCity) ? $eCity : $city); ?>">
</div>
</div> -->

</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger  btn-border-radius" data-dismiss="modal">Close</button>
<input type="submit" value="Change" class="btn btn-primary  btn-border-radius" name="Change_Current_Location">
<!-- <input type="submit" class="btn btn-danger" name="Closeresetlocation" value="Reset"> -->

</div>
</form>
</div>

</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
<script>

// SHOW MY ALL FAVOURITE SONGE WITH SPECIFIC CATEGORY
//==========ON CHANGE LOAD COUNTRY IN ACCOUNT SETTING=======
$("#spUserCountry").on("change", function () {
//alert(this.value);
var countryId = this.value;
$.post("../loadUserState.php", {countryId: countryId}, function (r) {
//alert(r);
$(".loadUserState").html(r);

});
var state = 0;
$.post("../loadUserCity.php", {state: state}, function (r) {
//alert(r);

$(".loadCity").html(r);
});
});




// jQuery Plugin: http://flaviusmatis.github.io/simplePagination.js/

var items = $(".list-wrapper .list-item");
var numItems = items.length;
var perPage = 8;

items.slice(perPage).hide();

$('#pagination-container').pagination({
items: numItems,
itemsOnPage: perPage,
prevText: "&laquo;",
nextText: "&raquo;",
onPageClick: function (pageNumber) {
var showFrom = perPage * (pageNumber - 1);
var showTo = showFrom + perPage;
items.hide().slice(showFrom, showTo).show();
}
});
$(document).ready(function() {
  if (numItems >= perPage) {
    $('#pagination-container').show();
  } else {
    $('#pagination-container').hide();
  }
});

</script>
<script type="text/javascript">
var MAINURL = "https://dev.thesharepage.com";
$(".jobseek").on("click", "#addtofavouritejobseek",function () {


var postid = $(this).data('postid');

//alert(postid);


var pid = $(this).data('pid');

var btnfavorites = this;

//alert(pid);

$.post(MAINURL+"/social/addfavorites.php", {postid: postid, pid: pid}, function (response) {
//$("#addtofavouriteeve").html("<i class='fa fa-heart' aria-hidden='true'></span>");
$(btnfavorites).replaceWith('<a href="javascript:void(0)" id="remtofavoritesjobseek" data-postid="'+postid+'" data-pid="'+pid+'"><i class="fa fa-heart" style="padding-top: 11px;padding-bottom: 5px;"></i></a>');
//window.location.reload();
});
});


$(".jobseek").on("click","#remtofavoritesjobseek", function () {
var postid = $(this).data('postid');
var pid = $(this).data('pid');

// alert(pid);
var btnremovefavorites = this;

$.post(MAINURL+"/social/deletefavorites.php", {postid: postid}, function (response) {

$(btnremovefavorites).replaceWith('<a href="javascript:void(0)" id="addtofavouritejobseek" data-postid="'+postid+'" data-pid="'+pid+'"><p style="color:black;font-size:21px;padding: 0px 2px;">&#9825;</p></a>');
});
});

</script>


<?php
include('../component/f_footer.php');
include('../component/f_btm_script.php');
?>
</body>
</html>
<?php
} ?>
