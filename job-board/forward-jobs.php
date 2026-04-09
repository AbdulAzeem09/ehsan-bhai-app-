<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
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
$header_jobBoard = "header_jobBoard";

$activePage = 50;

if(isset($_GET['deleteid'])){
$deleteid=$_GET['deleteid'];

$fwrd = new _forwardjobs;
$result = $fwrd->delforwardjobs($deleteid,$_SESSION['pid']);

}

?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php');?>
<!--This script for posting timeline data End-->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl.'/assets/admin/css/dashboard.css';?>">
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl.'/assets/css/AdminLTE.min.css';?>">
<style media="screen">
.midjob {
padding: 0px !important;
}
.midjob form.job_search {
box-shadow: 0 0 6px 0 rgba(0, 0, 0, 0.12), 0 4px 10px 0 rgba(0, 0, 0, 0.16);
background-color: #fff !important;
padding: 16px;
}
.midjob form.job_search .form-group input {
height: 48px;
border-radius: 50px;
}
.midjob form.job_search button#btnJobSearch {
padding: 12px 23px !important;
border-radius: 40px !important;
width: 100%;
}
section.landing_page.bg_white {
margin-bottom: 16px;
}
/*.whiteboardmain {
padding: 15px 15px 30px 15px;
margin-bottom: 20px;
}*/
.whiteboardmain h4 {
margin-bottom: 20px;
margin-top: 30px;
font-size: 20px;
}
.whiteboardmain p {
margin-bottom: 6px;
}
.right_main_top .row:hover {
background-color: #f1f1f1f1;
cursor: pointer;
}
.right_main_top h4 {
margin-top: 10px;
line-height: 26px;
}
.right_main_top h4 a {
font-size: 18px;
color: #000;
}
.right_main_top button.jobbutton.btn-primary {
margin-top: 20px !important;
}
.right_main_top span {
padding: 0px 4px;
margin-right: 2px;
margin-left: 8px;
}
.right_main_top button.jobbutton.btn-primary {
margin-top: 20px !important;
padding: 5px 10px;
border: 1px solid #fff;
}
.skilllink {
margin-right: 10px !important;
}

/* --------new-job-list-css----------- */

.right-job-listing {
margin-top: 10px;
background-color: #fff;
}
.right-job-listing table#task-list-tbl {
width: 100%;
}
.job-content {
padding: 0 16px;
border-bottom: 1px solid #DEDEDE;
}
.job-content .job-card {
padding: 24px 0;
}
.job-content .job-card .card-primary .pri-head {
margin-bottom: 16px;
}
.job-content .job-card .card-primary .pri-head .head-link {
font-size: 16px;
line-height: 1.5;
color: #0e1724;
font-weight: 700;
margin-right: 4px;
}
.job-content .job-card .card-primary .pri-head .head-days {
margin-right: 12px;
}
.job-content .job-card .card-primary .pri-head .new-head {
background-color: #4fb55d;
color: #fff;
padding: 2px 4px;
font-size: 12px;
margin-right: 3px;
border: 1px solid #4fb55d;
margin-bottom: 3px;
display: inline-block;
}
.job-content .job-card .card-primary .pri-head .new-head {
padding: 0px 4px;
}
.job-content .job-card .card-primary .pri-para {
margin-bottom: 16px;
font-size: 14px;
line-height: 1.4;
color: #0e1724;
}
.job-content .job-card .card-primary .pri-tags a {
margin-bottom: 8px;
margin-right: 8px;
text-decoration: none;
color: #007fed !important;
}
.job-content .job-card .card-secondary .price {
font-size: 16px;
line-height: 1.5;
font-weight: 700;
margin-bottom: 8px;
color: #0e1724;
}
.job-content .job-card .card-secondary .price .avg {
font-size: 13px;
font-weight: 400;
line-height: 1.2;
font-weight: 400;
}
.job-content .job-card .card-secondary .entry {
font-size: 14px;
line-height: 1.43;
color: #0e1724;
}
.job-content .job-card .card-secondary .avg-btn {
display: block;
margin-top: 10px;
}
.job-content .job-card .card-secondary .avg-btn .avg-bid {
background: #337ab7;
border: 1px solid #337ab7;
color: #F7F7F7;
font-weight: 700;
text-shadow: 0 -1px transparent;
padding: 4px 12px;
font-size: 13px;
border-radius: 50px;
}
.job-content:hover {
background-color: #F7F7F7;
cursor: pointer;
}
.job-content:hover .avg-btn {
display: block !important;
margin-top: 12px;
}
.avg-bid {
background: #5dc26a;
border-color: #5dc26a;
color: #F7F7F7;
}
.location-btn {
margin-top: 16px;
margin-left: 2px;
}
.location-btn a.loc-btn {
color: #000;
font-size: 15px;
}

/* ----start-media-query-css----- */

@media only screen and (max-width: 767px) {

.home_top_job {
padding: 0px;
}
.midjob form.job_search button#btnJobSearch {
margin-top: 20px;
}

}




.list-wrapper {
padding: 15px;
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
color: #337ab9;
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
background-color: #337ab9;
border-color: #337ab9;
}

.simple-pagination .prev.current,
.simple-pagination .next.current {
background: #337ab9;
}

</style>
<style>

.heartimg {
position: absolute !important;
right: 15px !important;
bottom: 47px !important; 
width: 30px !important;
}

.head-days{font-size: 12px;}
</style>
</head>

<body class="bg_gray">
<?php



include_once("../header.php");
?>
<!--Adding new Resume modal-->
<div class="modal fade jobseeker" id="addnews" tabindex="-1" role="dialog" aria-labelledby="resumeModalLabel">
<div class="modal-dialog sharestorepos" role="document">
<div class="modal-content no-radius" >
<form action="<?php echo $BaseUrl.'/job-board/addnews.php';?>" id="add_news_frm" method="post">      
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h3 class="modal-title" id="resumeheadr">Add News</h3>
</div>
<div class="modal-body">

<input type="hidden" id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" value="<?php echo $_SESSION['pid'];?>">
<div class="form-group">
<label for="recipient-name" class="control-label"><h4>Title</h4></label>
<input type="text" class="form-control no-radius" id="cmpanynewsTitle" name="cmpanynewsTitle" />
<span id="title_err" style="color: red;"></span>
</div>
<div class="form-group">
<label for="recipient-name" class="control-label"><h4>Description</h4></label>
<textarea class="form-control no-radius" id="cmpanynewsDesc" maxlength="200"  name="cmpanynewsDesc"></textarea>
<span id="cdesc_err" style="color: red;"></span>
</div>


</div>
<div class="modal-footer" class="uploadupdate">
<button type="button" class="btn butn_cancel" data-dismiss="modal">Cancel</button>
<button type="button" id="sub_news" class="btn btn-submit" style='background-color: #31abe3!important;border:0px!important;    color: #fff;background-image: unset;
'>Add</button>
</div>
</form>
</div>
</div>
</div>
<!--Adding new resume modal complete-->
<section class="landing_page">
<div class="container">
<div class="row">

<?php //include('thisisjobboardfront.php'); ?> 

<div class="col-md-3 no-padding sidebar">
<?php include('dashboard/left-menu.php'); ?> 
<?php 

if($_SESSION['ptid'] == 1){

$pageLink = 'job-board';
?>


<!-- <div>
<div class="whitejobbox text-center">
<?php
//include('/job-board/dashboard/left-menu.php');
if($_SESSION['ptid'] == 1){ ?>
<a href="<?php echo $BaseUrl.'/job-board/news.php';?>"><p>Company News</p></a>
<?php
}
?>
<a href="<?php echo $BaseUrl.'/job-board/showsavejobs.php';?>"><p>Saved Jobs</p></a>
</div>
<div class="m_btm_15">
<?php
$limit = 3;
$p   = new _postingview;

$sql = $p->publicpost_left_company($limit, 2);
//echo $p->ta->sql;

if($sql){
while ($sql_res = mysqli_fetch_assoc($sql)) {
//my active jobs
$result2 = $p->myProfilejobpost($sql_res['idspProfiles']);
if($result2){
$Myactivejob = $result2->num_rows;
}else{
$Myactivejob = 0;
} ?>
<div class="leftPostCmpny text-center"> 
<a href="<?php echo $BaseUrl.'/job-board/company.php?cmpyid='.$sql_res['idspProfiles'];?>">
<div class="boxGraph">
<h2><?php echo $sql_res['spProfileFieldValue'];?></h2>
<p><?php echo $Myactivejob;?> posting jobs</p>
</div>
</a>
</div>
<?php
}
}
?>
</div>
</div> -->
<?php
//   include('/job-board/dashboard/left-menu.php');
}
?>

</div>
<div class="col-md-9">

<!-- <div class="whiteboardmain m_btm_10" style="padding: 5px;">
<div class="row"> -->
<div class="col-sm-12 nopadding dashboard-section whiteboardmain" style="margin-top: 7px;padding: 16px 0px 0px 0px;">
<div class="col-xs-12 dashboardbreadcrum">
<ul class="breadcrumb">
<li><a href="<?php echo $BaseUrl;?>/job-board/dashboard"> Dashboard</a></li>
<li>Recommend Jobs</li>
<!-- <li><?php echo $title;?></li> -->

<!-- <a href="<?php echo $BaseUrl.'/post-ad/job-board/?post';?>" class="btn " style="float: right;background-color: #31abe3;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;">Post a job</a> -->



<!-- <a href="https://thesharepage.com/post-ad/freelancer/?post" class="btn post-project postproject" style="float: right;background-color: orange;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;" >Post a project</a> -->
</ul>
</div>
</div>
<!--  <div class="col-md-12 text-right">

</div> -->
<!--  </div>
</div> -->




<div class="list-wrapper">


<table  id="task-list-tbl" style="width:100%;">


<?php
$limit = 10;
/*$p   = new _postingview;*/
//    $p   = new _forwardjobs;
$pf  = new _postfield;
$post  = new _jobpostings;
$pro=new _spprofiles;
$p   = new _jobpostings;
$for_j   = new _forwardjobs;

$profile_id = $_SESSION['pid'] ;

$res_skills = $for_j->emp_skills($profile_id);
//var_dump($res_skills);die;
//print_r($res_skills);die;

if($res_skills!=false){
$res_skills1 = mysqli_fetch_assoc($res_skills);
//print_r($res_skills); die('===-000--');

$emp_skills = $res_skills1['skill'];

}
$res = $p->publicpost_recommend();

//print_r($res); 

if($res){
$count_a=1;
while ($row = mysqli_fetch_assoc($res)) {
//print_r($row);

/*
$skills=explode(',',$row['spPostingSkill']);
$procced = 0;
$emp_skills=explode(',',$emp_skills);
foreach ($skills as $key => $value) {
foreach ($emp_skills as $key => $value1) {
$value =trim($value);
$value1 =trim($value1);
//echo $value1." ----------- ".$value; die;
if($value1 == $value){
$procced = 1;
}																								
}
}
*/
/*																								if($procced == 0){

continue;
}*/





// echo "<pre>";
// print_r($row);
/*$postingDate = $p-> spPostingDate($row["spPostingDate"]);*/
$postingDate = $row["spPostingDate"];

//$cmpnyName = $row["spPostingDate"];

$skill = $row["spPostingSkill"];

?>

<tr  id="task-<?php echo $row['idspPostings']; ?>"   class="task-list-row"
data-task-id="<?php echo $row['idspPostings']; ?>" data-user="<?php echo $row['spPostingJoblevel']; ?>"
data-status="<?php echo $row['spPostingJobType']; ?>"
data-milestone="<?php echo $row['spPostingJobAs']; ?>">
<td class="list-item">

<div class="job-content">
<div class="job-card">
<div class="row">
<div class="col-sm-12 col-sm-12">
<div class="card-primary">
<div class="col-md-9 col-sm-12">
<div class="pri-head">
<a href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row['idspPostings'];?>" class="head-link"><?php echo ucfirst($row['spPostingTitle']);?></a>



<?php  
// Creates DateTime objects
$date = strtotime($row["spPostingDate"]);
$date1 = date('Y-m-d');
$date2 = $row["spPostingExpDt"];

$date1_ts = strtotime($date1);
$date2_ts = strtotime($date2);
$diff = $date2_ts - $date1_ts;


?> 
<span class="head-days"><?php  echo round($diff / 86400); ?> days left</span>

<span class="new-head">New</span>
</div>

<?php
$string = strip_tags($row['spPostingNotes']);
if (strlen($string) > 200) {

// truncate string
$stringCut = substr($string, 0, 200);
$endPoint = strrpos($stringCut, ' ');

//if the string doesn't contain any space then it will cut without word basis.
$string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
$string .= '... <a href='.$BaseUrl.'/job-board/job-detail.php?postid='.$row['idspPostings'].'>Read More</a>';
}

?>
<p class="pri-para"><?php echo ucfirst($string); ?></p>
<div class="pri-tags">
<?php
$skills=explode(',',$row['spPostingSkill']);

foreach ($skills as $key => $value) {
?>

<label>Skills : </label>
<a style="padding: 5px;"><?php echo ucfirst($value); ?></a>

<?php
} ?>

</div>
</div>
<div class="col-md-3 col-sm-12">
<div class="card-secondary">
<div class="price" style="margin-right:10px;margin-bottom:40px;">
<?php if($row['spPostingSlryRngFrm']>0){echo $row['job_currency'].' '.$row['spPostingSlryRngFrm'].' - '. $row['job_currency'].' '.$row['spPostingSlryRngTo'].'';} ?>
</div>
<?php if($_SESSION['guet_yes'] != 'yes'){ ?>
<div class="avg-btn">
<a href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row['idspPostings'];?>" class="avg-bid btn">Apply now </a>
</div>

<?php } ?>
<div class="location-btn">
<a href="#" class="loc-btn"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp <?php echo ucfirst($row["spPostingLocation"]);?> </a>
</div>
</div></div>
</div>
</div>

</div>
</div>
</div>


</td>

<?php

}

}
//die('----ssssssss----');

?>

</tr>
</table>
</div>
<div id="pagination-container"></div>

<!-- repeat able box end -->


</div>
</div>
</div>
</section>
<script type="text/javascript">

$(document).ready(function(){
$("#esub_news").click(function(){


var cmpanynewsTitle = $("#ecmpanynewsTitle").val();
var cmpanynewsDesc = $("#ecmpanynewsDesc").val();


if(cmpanynewsTitle == "" && cmpanynewsDesc == ""){

$("#etitle_err").text("Please Enter Title.");
$("#ecdesc_err").text("Please Enter Description.");

//alert("here1");

}else if(cmpanynewsTitle == "") {

$("#title_err").text("Please Enter Title.");
$("#cdesc_err").text("");

//alert("here2");

}else if(cmpanynewsDesc == ""){

//alert("here3");
$("#etitle_err").text("");
$("#ecdesc_err").text("Please Enter Description");



}else{

//alert("here1");

$("#edit_news_frm").submit();
}

});

$("#sub_news").click(function(){


var cmpanynewsTitle = $("#cmpanynewsTitle").val();
var cmpanynewsDesc = $("#cmpanynewsDesc").val();


if(cmpanynewsTitle == "" && cmpanynewsDesc == ""){

$("#title_err").text("Please Enter Title.");
$("#cdesc_err").text("Please Enter Description.");

//alert("here1");

}else if(cmpanynewsTitle == "") {

$("#title_err").text("Please Enter Title.");
$("#cdesc_err").text("");

//alert("here2");

}else if(cmpanynewsDesc == ""){

//alert("here3");
$("#title_err").text("");
$("#cdesc_err").text("Please Enter Description");



}else{

//alert("here1");

$("#add_news_frm").submit();
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



<script src='https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js'></script>

<script>
// jQuery Plugin: http://flaviusmatis.github.io/simplePagination.js/

var items = $(".list-wrapper .list-item");
var numItems = items.length;
var perPage = 4;

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