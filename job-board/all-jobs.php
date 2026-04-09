<?php

// error_reporting(E_ALL);
// ini_set('display_errors', '1');

include('../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){
$_SESSION['afterlogin']="store/";
include_once ("../authentication/check.php");

}else{
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


$_GET["categoryid"] = "2";
$_GET["categoryName"] = "Job Board";
$activePage = 2;


if ($_SESSION['spPostCountry'] == '') {
$u = new _spuser;
$res = $u->read($_SESSION["uid"]);
if ($res != false) {

$ruser = mysqli_fetch_assoc($res);

$_SESSION['Countryfilter'] = $ruser["spUserCountry"];
$_SESSION['Statefilter'] = $ruser["spUserState"];
$_SESSION['Cityfilter'] = $ruser["spUserCity"];
}
}



if (isset($_POST['Change_Current_Location'])) {
session_start();

$_SESSION["Countryfilter"] = $_POST['spUserCountry'];
$_SESSION["Statefilter"] = $_POST['spUserState'];
$_SESSION["Cityfilter"] = $_POST['spUserCity'];


//unset($_SESSION['Products']);
}

if (isset($_POST['Closeresetlocation'])) {
session_start();

unset($_SESSION['Countryfilter']);
unset($_SESSION['Statefilter']);
unset($_SESSION['Cityfilter']);
}  







$pr     = new _spprofiles;
$prof   = new _profilefield;

$result_pr = $pr->mySpeceficAccount(5, $_SESSION['uid']);
//echo $pr->ta->sql;
$skillMatch = '';
if($result_pr){
while ($row_pr = mysqli_fetch_assoc($result_pr)) {
$result_prof = $prof->getSkill($row_pr['idspProfiles']);
//echo $prof->ta->sql;
if($result_prof){
$row_prof = mysqli_fetch_assoc($result_prof);
$skill = $row_prof['spProfileFieldValue'];
if($skill != ''){
$skillMatch = $skillMatch .','. $skill;
}
}
}
}
//echo $skillMatch;
$header_jobBoard = "header_jobBoard";
?>
<!DOCTYPE html>
<html lang="en-US">

<head>


<style>
    body {
	font-family: 'Roboto', sans-serif;
	font-size: 14px;
	line-height: 18px;
	background: #f4f4f4;
}

.list-wrapper {
	padding: 0px;
	overflow: hidden;
}

.list-item {
	border: 1px solid #EEE;
	background: #FFF;
	margin-bottom: 10px;
	padding: 10px;
	box-shadow: 0px 0px 10px 0px #EEE;
}

.list-item h4 {
	color: #FF7182;
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
	border: 1px solid #EEE;
	background-color: #FFF;
	box-shadow: 0px 0px 10px 0px #EEE;
}

.simple-pagination .current {
	color: #FFF;
	background-color: #163692;
	border-color: #163692;
}

.simple-pagination .prev.current,
.simple-pagination .next.current {
	background: #1f3060;
}
</style>


<?php include('../component/f_links.php');?>
</head>

<body class="bg_gray">
<?php
include_once("../header.php");
?>
<section class="landing_page">
<div class="container">
<div class="row">



<!-- <div class="col-md-12  dashboard-section " style="background-color: #fff; border: 1px solid #ccc;margin-bottom: 10px;border-radius: 5px;width: 100%;">

<h3 style="margin-top: 10px!important;">This is JobBoard</h3>

</div>-->


<div class="col-sm-12 nopadding dashboard-section whiteboardmain" style="margin-top: 7px;padding: 16px 0px 0px 0px;">
<div class="col-xs-12 dashboardbreadcrum">
<ul class="breadcrumb">
<li><a href="<?php echo $BaseUrl;?>/job-board">Home</a></li>
<li>Browse All jobs</li>
<!-- <li><?php echo $title;?></li> -->
<!--                                <a href="<?php echo $BaseUrl.'/post-ad/job-board/?post';?>" class="btn " style="float: right;background-color: #31abe3;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;">Post a job</a> -->
<!-- <a href="https://thesharepage.com/post-ad/freelancer/?post" class="btn post-project postproject" style="float: right;background-color: orange;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;" >Post a project</a> -->
</ul>
</div>
</div>



<div class="" style="margin-top: 100px;margin-bottom: 6px;">
<form class="job_search" method="post" action="" id="job_search" style="background-color: #fff;padding-top: 19px;padding-bottom: 19px;padding-left: 16px;">
<div class="row">
<div class="col-md-8">


<div class="form-group no-margin">
<input type="text"style="width: 100%;" name="txtJobTitle" id="txtJobTitle" class="form-control" value="<?php echo $_POST['txtJobTitle']; ?>"  placeholder="Job Title" />
<span id="title_err" style="color: red;"></span>
</div>

<!--    <div class="col-md-6">
<div class="form-group no-margin">
<input type="text" id="txtJobLoc" name="txtJobLoc" class="form-control" list="suggested_address" onkeyup="getaddress();" value="<?php //echo $_POST['txtJobLoc']; ?>"  placeholder="Location" />
<datalist id="suggested_address"> 
</datalist>

<span id="loc_err" style="color: red;"></span>
</div>
</div> -->

<script type="text/javascript">


function getaddress(){

var address = $("#txtJobLoc").val();

$.ajax({
type: "POST",
url: "../address.php",
cache:false,
data: {'address':address},
success: function(data) {

var obj = JSON.parse(data);

$("#suggested_address").html('<option value="' + obj.address + '" class="op_address">' + obj.address + '</option>');


$("#latitude").val(obj.latitude);
$("#longitude").val(obj.longitude);

}
});
}


</script>
<!--  <div class="col-md-3">
<div class="form-group no-margin">
<select class="form-control" name="txtJobLevel" >
<option value="">Select Job Level</option>
<?php
$m = new _masterdetails;
$masterid = 2;
$result = $m->read($masterid);
if($result != false){
while($rows = mysqli_fetch_assoc($result)){
echo "<option value='".$rows["masterDetails"]."'>".$rows["masterDetails"]."</option>";
}
}
?>
</select>
</div>
</div> -->


</div>
<div class="col-md-2">
<button type="submit" id="btnJobSearch" name="btnJobSearch" class="btn btnPosting db_btn ">Search</button>
</div>


<!---LOCATION---->
 <div class="col-md-2">
<div style="margin-right: -15px;">

<?php

$usercountry = $_SESSION["Countryfilter"];
$userstate = $_SESSION["Statefilter"];
$usercity = $_SESSION["Cityfilter"];

$co = new _country;
$result3 = $co->readCountry();
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) {
if (isset($usercountry) && $usercountry == $row3['country_id']) {
$currentcountry = $row3['country_title'];
$currentcountry_id = $row3['country_id'];
}
}
}

if (isset($userstate) && $userstate > 0) {
$countryId = $currentcountry_id;
$pr = new _state;
$result2 = $pr->readState($countryId);
if ($result2 != false) {
while ($row2 = mysqli_fetch_assoc($result2)) { //print_r($row2);
//die('===');
if (isset($userstate) && $userstate == $row2["state_id"]) {
$currentstate_id = $row2["state_id"];
$currentstate = $row2["state_title"];
}
}
}
}
if (isset($usercity) && $usercity > 0) {
$stateId = $currentstate_id;
$co = new _city;
$result3 = $co->readCity($stateId);
//echo $co->ta->sql;
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) { //print_r($row3);
if (isset($usercity) && $usercity == $row3['city_id']) {
$currentcity = $row3['city_title'];
$currentcity_id = $row3['city_id'];
}
}
}
};
?>



<p>



<small style="font-size: x-small;">
<!--Current Location: -->
<?php
$words = explode(' ', $currentstate);
$result = $words[0][0] . $words[1][1];
//$result=$words;
?>
<?php
if ($currentcity) {
echo $currentcity . ', ';
}
if ($currentstate) {
echo $currentstate . ', ';
}
if ($currentcountry) {
echo $currentcountry;
}
//echo $currentcity.','.$currentstate.','.$currentcountry; 
//echo $result;
?>
<br>

<a style="cursor:pointer; color: #337ab7;" data-toggle="modal" data-target="#myModal">Change Location</a>
</small>
</p>

</div>
</div>

<!----end location--->

</div>
</form>
</div>



<div class="col-sm-12 no-padding">

<script>
function getjobs(sortby) {
$.ajax({
type: "POST",
url: "sortjob.php",
data:'sortby='+ sortby,
success: function(html){
$("#sortjob").html(html);
}
});
}
</script>




<div class="row" style="margin-top: 10px;">
<div class="list-wrapper col-sm-12 jobseakrhead" id="sortjob">
<?php
$limit = 4;
$p   = new _jobpostings;
$pf  = new _postfield;

$txtJobTitle = $_POST['txtJobTitle'];
$txtJobLoc = $_POST['txtJobLoc'];

if(!empty($txtJobTitle) ){ 



$res = $p->readJobSearch($txtJobTitle,$Countryfilter, $Statefilter, $Cityfilter);

}else{

$limit = 6;
//$res = $p->jobBoard_post(2, $_SESSION['pid']);   
$res = $p->publicpost_jobBoard_session( $limit,$_SESSION['Countryfilter'],$_SESSION['Statefilter'],$_SESSION['Cityfilter']);
}

//$res = $p->publicpost_jobBoard($limit, 2);
//echo $p->ta->sql;
if($res){
while ($row = mysqli_fetch_assoc($res)) {

//print_r($row);
/* $result_pf = $pf->read($row['idspPostings']);*/
//echo $pf->ta->sql."<br>";
$closingdate = new DateTime($row['spPostingExpDt']);
/*if($result_pf){*/

$skill = "";
$cmpnyName = "";
$strtSalry = "";
$endSalry = "";
$jobLevel = "";

$cmpnyName = $row['spPostingCompany'];
$strtSalry = $row['spPostingSlryRngTo'];
$endSalry = $row['spPostingSlryRngFrm'];
$skill = explode(',', $row['spPostingSkill']);
$jobLevel = $row['spPostingJoblevel'];

/* while ($row2 = mysqli_fetch_assoc($result_pf)) {
// if($closingdate == ''){
//     if($row2['spPostFieldName'] == 'spPostingClosing_'){
//         $closingdate = new DateTime($row2['spPostFieldValue']);
//     }
// }
if($cmpnyName == ''){
if($row2['spPostFieldName'] == 'spPostingCompany_'){
$cmpnyName = $row2['spPostFieldValue'];
}
}
if($strtSalry == ''){
if($row2['spPostFieldName'] == 'spPostingSlryRngTo_'){
$strtSalry = $row2['spPostFieldValue'];
}
}
if($endSalry == ''){
if($row2['spPostFieldName'] == 'spPostingSlryRngFrm_'){
$endSalry = $row2['spPostFieldValue'];
}
}
if($skill == ''){
if($row2['spPostFieldName'] == 'spPostingSkill_'){
$skill = explode(',', $row2['spPostFieldValue']);
}
}
if($jobLevel == ''){
if($row2['spPostFieldName'] == 'spPostingJoblevel_'){
$jobLevel = $row2['spPostFieldValue'];
}
}

}*/
$postingDate = $p-> spPostingDate($row["spPostingDate"]);
/* }*/
?>
<a href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row['idspPostings'];?>">
<!-- repeat able box -->
<div class="list-item whiteboardmain m_btm_15">

<div class="row top_job_head">

<div class="col-sm-12 jobboradlist">
<h2><span href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row['idspPostings'];?>"><?php echo ucfirst($row['spPostingTitle']);?> </span></h2>
<!--  <h1><?php echo $cmpnyName.' ,'. $row['spPostingsCity']. ','.$row['spPostingsCountry'];?></h1> -->
<p>
<?php
if(strlen($row['spPostingNotes']) < 400){
echo $row['spPostingNotes'];
}else{
echo substr($row['spPostingNotes'], 0,400);

} ?>
<span href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row['idspPostings'];?>" class="readmore">...Read More</span>
</p>
<?php
if(count($skill) >0){
foreach($skill as $key => $value){
if($value != ''){
echo "<span class='skills-tags'>".$value."</span>";
}

}
}
?>
</div>


</div>

</div>
</a>

<!--   <div class="row">
<div class="col-md-12">
<div class="footer_job">
<div class="row">
<div class="col-md-3">
<a href="<?php echo $BaseUrl ?>/job-board/job-detail.php?postid='.$row['idspPostings'];?>" data-toggle='tooltip' data-placement='bottom' title='Last Date To Apply'><i class="fa fa-calendar"></i> <?php echo $closingdate->format('d-M-Y');?></a>
</div>
<div class="col-md-3">
<a href="<?php echo $BaseUrl ?>/job-board/job-detail.php?postid='.$row['idspPostings'];?>" data-toggle='tooltip' data-placement='bottom' title='Experience'><i class="fa fa-floppy-o"></i> 2 Years</a>
</div>
<div class="col-md-3 text-center">
<a href="<?php echo $BaseUrl ?>/job-board/job-detail.php?postid='.$row['idspPostings'];?>" data-toggle='tooltip' data-placement='bottom' title='Salary'><i class="fa fa-money"></i> <?php echo $endSalry.' - '.$strtSalry;?></a>
</div>
<div class="col-md-3 text-right">
<a href="<?php echo $BaseUrl ?>/job-board/job-detail.php?postid='.$row['idspPostings'];?>" data-toggle='tooltip' data-placement='bottom' title='Job Level'><i class="fa fa-briefcase"></i> <?php echo $jobLevel;?></a>
</div>
</div>
</div>
</div>
</div> -->
<!-- repeat able box end -->
<?php
}
}else{
?>

<div class="whiteboardmain" style="min-height: 300px;">
<h3 style="text-align: center;" >No Jobs Found!</h3>
</div>
<?php
}
?>
</div>
<?php

$job_count= $res->num_rows;

if($job_count > 10)
{
?>
<div id="pagination-container"></div>

<?php
}
?>



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
<h4 class="modal-title">Change Current Location</h4>
</div>
<!----action="<?php echo $BaseUrl ?>/post-ad/dopost.php"--->
<form method="post">
<input type="hidden" name="spPostingVisibility" value="0">
<div class="modal-body">
<div class="row">

<div class="col-md-4">
<div class="form-group">
<label for="spPostingCountry" class="lbl_2">Country</label>
<select class="form-control " name="spUserCountry" id="spUserCountry">
<option value="">Select Country</option>
<?php
$co = new _country;
$result3 = $co->readCountry();
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) {
?>
<option value='<?php echo $row3['country_id']; ?>' <?php echo (isset($_SESSION["Countryfilter"]) && $_SESSION["Countryfilter"]  == $row3['country_id']) ? 'selected' : ''; ?>><?php echo $row3['country_title']; ?></option>
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
<select class="form-control" name="spUserState" id="spUserState">
<option>Select State</option>
<?php
if (isset($_SESSION["Statefilter"]) && $_SESSION["Statefilter"] > 0) {
$countryId = $_SESSION["Countryfilter"];
$pr = new _state;
$result2 = $pr->readState($countryId);
if ($result2 != false) {
while ($row2 = mysqli_fetch_assoc($result2)) { ?>
<option value='<?php echo $row2["state_id"]; ?>' <?php echo (isset($_SESSION["Statefilter"]) && $_SESSION["Statefilter"] == $row2["state_id"]) ? 'selected' : ''; ?>><?php echo $row2["state_title"]; ?> </option>
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
<select id="spUserCity" class="form-control" name="spUserCity">
<option>Select City</option>
<?php
if (isset($_SESSION["Cityfilter"]) && $_SESSION["Cityfilter"] > 0) {
$stateId = $_SESSION["Statefilter"];
$co = new _city;
$result3 = $co->readCity($stateId);
//echo $co->ta->sql;
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) { ?>
<option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($_SESSION["Cityfilter"]) && $_SESSION["Cityfilter"]) ? 'selected' : ''; ?>><?php echo $row3['city_title']; ?></option> <?php
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
<input type="submit" value="Change" class="btn btn-primary" name="Change_Current_Location">
<input type="submit" class="btn btn-danger" name="Closeresetlocation" value="Reset">
</div>
</form>
</div>

</div>
</div>

<script type="text/javascript">


$(document).ready(function(){

/*alert();*/

$("#btnJobSearch").click(function(){

/*alert("heree");
*/

var txtJobTitle = $("#txtJobTitle").val();
var txtJobLoc = $("#txtJobLoc").val();


//alert(desc);

if (txtJobTitle == "" && txtJobLoc == "" ) {

$("#title_err").text("Please Enter Title.");
$("#loc_err").text("Please Enter Location.");

return false;

}else{
$("#job_search").submit(); 
}



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
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>

<script>
    
    var items = $(".list-wrapper .list-item");
    var numItems = items.length;
    var perPage = 10;

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
</script>