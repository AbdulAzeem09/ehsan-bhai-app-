<?php

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

$cmpyid = isset($_GET["cmpyid"]) ? (int) $_GET["cmpyid"] : 0;

if($cmpyid >0){
$profileId = $cmpyid;
}else{
$re = new _redirect;
$location = $BaseUrl."/job-board";
$re->redirect($location);
//header('location:'.$BaseUrl.'/job-board');
}

$p =  new _spprofiles;
$result = $p->read($profileId);
//echo $p->ta->sql;
if($result){
$row = mysqli_fetch_assoc($result);
$Title = $row['spProfileName'];
$country = $row['spProfilesCountry'];
$city = $row['spProfilesCity'];
$picture = $row['spProfilePic'];
$overview = $row['spProfileAbout'];

$fi = new _spbusiness_profile;
$result_fi = $fi->read($row['idspProfiles']);
//echo $fi->ta->sql;
if($result_fi){
$ProjectName    = '';
$perhour        = '';
$skill          = '';
$CmpnyName      = "";
$CmpnyDesc      = "";
$CmpSize        = "";
$YearFounded    = "";


while($row_fi = mysqli_fetch_assoc($result_fi)){

//print_r($row_fi);

$CmpnyName = $row_fi['companyname'];
$CmpnyDesc = $row_fi['spProfilesAboutStore'];
$CmpSize = $row_fi['CompanySize'];
$YearFounded = $row_fi['yearFounded'];
$skill = explode(',', $row_fi['skill']);
/*       if($CmpnyName == ''){
if($row_fi['spProfileFieldName'] == 'companyname_'){
$CmpnyName = $row_fi['spProfileFieldValue'];
}
}
if($CmpnyDesc == ''){
if($row_fi['spProfileFieldName'] == 'CompanyOverview_'){
$CmpnyDesc = $row_fi['spProfileFieldValue'];
}
}
if($CmpSize == ''){
if($row_fi['spProfileFieldName'] == 'CompanySize_'){
$CmpSize = $row_fi['spProfileFieldValue'];
}
}
if($YearFounded == ''){
if($row_fi['spProfileFieldName'] == 'yearFounded_'){
$YearFounded = $row_fi['spProfileFieldValue'];
}
}
if($skill == ''){
if($row_fi['spProfileFieldName'] == 'skill_'){
$skill = explode(',', $row_fi['spProfileFieldValue']);

}
}*/
}
}
}

$header_jobBoard = "header_jobBoard";

?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php');?>
<!--This script for posting timeline data End-->
<style>body {
	font-family: 'Roboto', sans-serif;
	font-size: 14px;
	line-height: 18px;
	background: #f4f4f4;
}

.list-wrapper {
	padding: 15px;
	overflow: hidden;
}

.simple-pagination .current {
 
    color: white;
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

	background-color: #1f3060;
	border-color: #1f3060;
}

.simple-pagination .prev.current,
.simple-pagination .next.current {
	background: #1f3060;
}
.list-wrapper1 {
	padding: 15px;
	overflow: hidden;
}

.list-item1 {
	border: 1px solid #EEE;
	background: #FFF;
	margin-bottom: 10px;
	padding: 10px;
	box-shadow: 0px 0px 10px 0px #EEE;
}

.list-item1 h4 {
	color: #FF7182;
	font-size: 18px;
	margin: 0 0 5px;	
}

.list-item1 p {
	margin: 0;
}
</style>
</head>

<body class="bg_gray">
<?php
include_once("../header.php");
?>
<section class="landing_page">
<div class="container userprofile" id="jobUserDetail">
<div class="row">

<div class="col-sm-12 no-padding ">

<ul class="breadcrumb">
<li style="font-weight: 600;font-size: 15px;"><a href="<?php echo $BaseUrl;?>/job-board/">Home</a></li>
<li style="font-weight: 600;font-size: 15px;"><?php echo ucfirst($CmpnyName);?></li>

</ul>

<?php 
//include('top-job-search.php');

?>
<div class="row no-margin profile-detail" style="padding: 15px;">
<div class="col-sm-12 no-padding">
<div class="row">
<div class="col-md-2">
<?php
if(isset($picture)){
echo "<img  alt='Posting Pic' class='img-responsive freelancerImg' src=' ".($picture)."' >" ;
}else{
echo "<img  alt='Posting Pic' class='img-responsive freelancerImg' src='../img/default-profile.png' >" ;
}
?>
</div>
<div class="col-md-9 freelancer-details no-padding">
<p class="name"><?php echo ucfirst($CmpnyName);?></p>
<?php
// COUNTRY
$co = new _country;
$result3 = $co->readCountryName($country);
if ($result3) {
$row3 = mysqli_fetch_assoc($result3);
$country_Name = $row3['country_title'];
}
// CITY
$co = new _city;
$result5 = $co->readCityName($city);
if ($result5) {
$row5 = mysqli_fetch_assoc($result5);
$city_Name = $row5['city_title'];
}
?>
<!-- <p class="country"><i class="fa fa-map-marker"></i>&nbsp;<?php echo $city_Name. ', '.$country_Name; ?></p> -->
<p><?php echo $CmpnyDesc;?></p>
<div class="professional-skills">

<?php
if(isset($skill) && $skill != ''){
foreach($skill as $key => $value){
echo "<span>".$value."</span>";
}
}else{
echo "No Sills Define";
}
?>
</div>
</div>
</div>

<div class="panel panel-primary m_top_15 no-radius">
<div>
<div class="row">
<div class="col-sm-12">
<ul class='nav nav-tabs' style="margin-top: 10px;
    margin-left: -10px;margin-right: 6px;}" id='navtabprofile'>
<li class="<?php echo (isset($_GET['job']))?'':'active';?>" role='presentation'><a href='#aboutstore'  aria-controls='sp-activePost' role='tab' data-toggle='tab'>Company Overview </a></li>

<li class="<?php if(isset($_GET['job'])){echo "active";}?>" role='presentation'><a href='#BusinessOverview'  aria-controls='sp-activePost' role='tab' data-toggle='tab'>Business Overview</a></li>

<li class="<?php if(isset($_GET['job'])){echo "active";}?>" role='presentation'><a href='#aboutshipping'  aria-controls='sp-activePost' role='tab' data-toggle='tab'>Job Posted</a></li>

<li  role='presentation'><a href='#aboutreturn'  aria-controls='sp-activePost' role='tab' data-toggle='tab'>News</a></li>
</ul>
</div>
</div>

<!--Company Overview-->
<div class="tab-content" style="margin-left:10px; margin-right:20px;">

<div role="tabpanel" class="tab-pane <?php echo (isset($_GET['job']))?'':'active';?>  store"  id="aboutstore" >
<h4>Company Overview</h4>
<div class="table-responsive">
<table class="table table-striped tbl_profile">
<tbody>


<!--Testing XTRA FIELDS-->
<?php
//$profileId = $_GET['cmpyid'];
$c1 = new _profilefield;
$r1 = $c1->read_to($cmpyid);
if($r1){
while($rw1 = mysqli_fetch_assoc($r1)){

?>
<tr>
<th><?php echo $rw1["spProfilesAboutStore"];?></th>

</tr>
<?php

}
}else{

echo "<h3 style='text-align: center;padding-top: 16px;'>No Record Found!</h3>";
}
?>
</tbody>
</table>
</div>
</div>

<!--Business Overview-->


<div role="tabpanel" class="tab-pane <?php if(isset($_GET['job'])){echo "active";}?>  store"  id="BusinessOverview" >
<h4>Business Overview</h4>
<div class="table-responsive">
<table class="table table-striped tbl_jobboard text-center">
<tbody>


<!--Testing XTRA FIELDS-->
<?php
//$profileId = $_GET['cmpyid'];
$c1 = new _profilefield;
$r1 = $c1->read_to($cmpyid);
if($r1){
while($rw1 = mysqli_fetch_assoc($r1)){

?>
<tr>
<th><?php echo $rw1["BussinessOverview"];?></th>

</tr>
<?php

}
}else{

echo "<h3 style='text-align: center;padding-top: 16px;'>No Record Found!</h3>";
}
?>
</tbody>
</table>
</div>
</div>


<!--Job Posted-->
<div role="tabpanel"  class= "tab-pane <?php if(isset($_GET['job'])){echo "active";}?> store"  id="aboutshipping" >
<h4>Job Posted</h4>
<div class="table-responsive">
<table class="table table-striped tbl_jobboard text-center">
<thead class="">
<tr>
<th>Job Title</th>
<th>Date Posted</th>
<th>Close Date</th>
<th>Applicants</th>

<th>Action</th>
</tr>
</thead>
<tbody class="list-wrapper1">
<?php
$m = new  _jobpostings;
$result = $m->myProfilejobpost($cmpyid);
//echo $m->ta->sql;
if($result){
while ($row = mysqli_fetch_assoc($result)) { 
$postDate = new DateTime($row['spPostingDate']);
$expirePostDate = new DateTime($row['spPostingExpDt']);
?>
<tr class="list-item1">
<td><a href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row['idspPostings'];?>" ><?php echo ucfirst($row['spPostingTitle']);?></a></td>
<td><?php echo $postDate->format('d-M-Y');?></td>
<td><?php echo $expirePostDate->format('d-M-Y');?></td>
<td>
<a>
<?php
$ac = new _sppost_has_spprofile;
$countAplicant = $ac->job($row["idspPostings"]);
if($countAplicant){
echo $countAplicant->num_rows;
}else{
echo 0;
}
?>
</a>
</td>

<td>
<a href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row['idspPostings'];?>" class="btn btn-success">Detail</a>

</td>
</tr> <?php
}
}else{

echo "<h3 style='text-align: center;padding-top: 16px;'>No Jobs Found!</h3>";
}
?>
</tbody>
</table>
<div id="pagination-container1"></div>
</div>
</div>

<div role="tabpanel"  class= "tab-pane returnrefund list-wrapper"  id="aboutreturn" >
<h4>All News</h4>
<?php
$cn = new _company_news;
$result1 = $cn->readMyNews($cmpyid);
//echo $cn->ta->sql;
if($result1){
while ($row = mysqli_fetch_assoc($result1)) { ?>
<div class="list-item">
<h3><?php echo $row['cmpanynewsTitle']?></h3>
<p><?php echo $row['cmpanynewsDesc']?></p>
<hr>
</div>
<?php
}
}else{

echo "<h3 style='text-align: center;padding-top: 16px;'>No News Found!</h3>";
}
?>
<div id="pagination-container"></div>
</div>

</div>
<!--Testing Complete-->

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
</body>
</html>
<?php
} ?>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js'></script>
<script src=' http://flaviusmatis.github.io/simplePagination.js'></script>
<script>// jQuery Plugin: http://flaviusmatis.github.io/simplePagination.js/


var items1 = $(".list-wrapper1 .list-item1");
    var numItems1 = items1.length;
    var perPage1 = 4;

    items1.slice(perPage1).hide();

    $('#pagination-container1').pagination({
        items1: numItems1,
        itemsOnPage: perPage1,
        prevText: "&laquo;",
        nextText: "&raquo;",
        onPageClick: function (pageNumber1) {
            var showFrom1 = perPage1 * (pageNumber1 - 1);
            var showTo1 = showFrom1 + perPage1;
            items1.hide().slice(showFrom1, showTo1).show();
        }
    });





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
