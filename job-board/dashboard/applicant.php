
<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 'On');

include('../../univ/baseurl.php');
session_start();
if($_SESSION['ptid'] != 1){
header('location:'.$BaseUrl.'/job-board/');
}
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="job-board/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$post_id = isset($_GET['postid']) ? (int) $_GET['postid'] : 0;
$_GET["categoryid"] = "2";
$_GET["categoryName"] = "Job Board";

$f = new _spprofiles;
$sl = new _shortlist;


if (isset($post_id)) {
$p = new _jobpostings;

$res = $p->read($post_id);
$cp = $res->num_rows;
//var_dump($cp);die;
//echo $cp;die;
if($cp == false){

header("Location: $BaseUrl/job-board/dashboard/index.php?msg=notacess");
}

if ($res != false) {
while ($row = mysqli_fetch_assoc($res)) {
$spProfiles_idspProfiles = $row["spProfiles_idspProfiles"];

if($_SESSION['pid'] != $spProfiles_idspProfiles){ 

header("Location: $BaseUrl/job-board/dashboard/index.php?msg=notacess");
}


}	
}
}


?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php');?>
<!--This script for sticky left and right sidebar STart-->


<!-- ===== INPAGE SCRIPTS====== -->
<!-- High Charts script -->
<script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<?php include('../../component/dashboard-link.php'); ?>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>

<style type="text/css">


table.dataTable thead th, table.dataTable thead td {
padding: 10px 18px;
border-bottom: 0px solid #111!important;
}


table.dataTable.no-footer {
border-bottom: 0px solid #111;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
color: #fff !important;
border: 1px solid #979797;
background-color: white;
/* background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, white), color-stop(100%, #dcdcdc)); */
/* background: -webkit-linear-gradient(top, white 0%, #dcdcdc 100%); */
background: -moz-linear-gradient(top, white 0%, #dcdcdc 100%);
background: -ms-linear-gradient(top, white 0%, #dcdcdc 100%);
background: -o-linear-gradient(top, white 0%, #dcdcdc 100%);
background: linear-gradient(to bottom, #31ace3 0%, #31ace3 100%);
}

#tbl_jobboard_filter{
display: none;
}

#tbl_jobboard_length{
display: none;
}

.left_detail_job ul.skills-list li {
margin-top: 10px;
display: inline-block;
margin-right: 12px;
font-size: 13px;
font-weight: 400;
border: 1px solid #ccc;
border-radius: 14px;
padding: 4px 12px;
margin-bottom: 6px;
text-align: center;
position: relative;
background: #31abe3;
color: #fff;
}
.left_detail_job ul.skills-list li i.fa {
margin-right: 6px;
}

p {
line-break: anywhere;
}

.swal2-popup { 
font-size: small !important;
}
/*prcss*/
table#tbl_jobboard a img {
    width: 22px !important;
    height: 22px !important;
}
table#tbl_jobboard button {
    width: 34px;
    height: 28px;
}
table#tbl_jobboard button img {
    width: 18px;
}
</style>




</head>

<body class="bg_gray">
<?php
include_once("../../header.php");
?>
<section class="" style="border-bottom: 2px solid #CCC">
<div class="container">

<?php
$p = new _jobpostings;

$res = $p->singletimelines($post_id);
//echo $p->ta->sql;

if($res){
$row = mysqli_fetch_assoc($res);

$title      = $row['spPostingTitle'];
$overview   = $row['spPostingNotes'];
$country    = $row['spPostingsCountry'];
$city       = $row['spPostingsCity'];
$dt         = new DateTime($row['spPostingDate']);
$postingDate    = $p-> spPostingDate($row["spPostingDate"]);
$clientId       = $row['spProfiles_idspProfiles'];
$postedPerson   = $row['spUser_idspUser'];


$skill2      = explode(',', $row['spPostingSkill']);
$jobType    = $row['spPostingJobType'];
$jobLevel1   = $row['spPostingJoblevel'];
$Experience1 = $row['spPostingExperience'];
//	print_r($row);
//die("--------------------");
$location1   = $row['spPostingLocation'];
$salaryyy = $row['job_currency'].' '.$row['spPostingSlryRngFrm'].' - '. $row['job_currency'].' '.$row['spPostingSlryRngTo'].'';
$Experience = $row['spPostingExperience'];
$howAply    = $row['spPostingApply'];
$noOfPos    = $row['spPostingNoofposition'];

$c = new _spbusiness_profile;
$r = $c->read($clientId);
if($r != false){
$CmpnyName  = "";
$CmpnyDesc  = "";
$CmpSize    = "";
$YearFounded    = "";
while($rw = mysqli_fetch_assoc($r)){

$CmpSize = $rw['CompanySize'];
//$CmpnyDesc = $row3['skill']; 
$CmpnyName = ucfirst($rw['companyname']); 
/*          if($CmpnyName == ''){
if($rw['spProfileFieldName'] == 'companyname_'){
$CmpnyName = $rw['spProfileFieldValue'];
}
}
if($CmpnyDesc == ''){
if($rw['spProfileFieldName'] == 'CompanyOverview_'){
$CmpnyDesc = $rw['spProfileFieldValue'];
}
}
if($CmpSize == ''){
if($rw['spProfileFieldName'] == 'CompanySize_'){
$CmpSize = $rw['spProfileFieldValue'];
}
}
if($YearFounded == ''){
if($rw['spProfileFieldName'] == 'yearFounded_'){
$YearFounded = $rw['spProfileFieldValue'];
}
}*/
}
}








$pf = new _postfield;
$result_pf = $pf->read($row['idspPostings']);
//echo $pf->ta->sql."<br>";
if(!$result_pf){
//die("--------------");

$skill      = "";
$jobType    = "";
$jobLevel   = "";
$location   = "";
$CloseDate  = "";
$salaryStrt = "";
$salaryEnd  = "";
$Experience = "";                            
$noOfPos    = "";

/*    while ($row2 = mysqli_fetch_assoc($result_pf)) {

if($noOfPos == ''){
if($row2['spPostFieldName'] == 'spPostingNoofposition_'){
$noOfPos = $row2['spPostFieldValue']; 
}
}
if($Experience == ''){
if($row2['spPostFieldName'] == 'spPostingExperience_'){
$Experience = $row2['spPostFieldValue']; 
}
}
if($salaryEnd == ''){
if($row2['spPostFieldName'] == 'spPostingSlryRngFrm_'){
$salaryEnd = $row2['spPostFieldValue']; 
}
}
if($salaryStrt == ''){
if($row2['spPostFieldName'] == 'spPostingSlryRngTo_'){
$salaryStrt = $row2['spPostFieldValue']; 
}
}
if($CloseDate == ''){
if($row2['spPostFieldName'] == 'spPostingClosing_'){
$CloseDate = $row2['spPostFieldValue']; 
}
}
if($CmpnyName == ''){
if($row2['spPostFieldName'] == 'spPostingCompany_'){
$CmpnyName = $row2['spPostFieldValue']; 
}
}
if($skill == ''){
if($row2['spPostFieldName'] == 'spPostingSkill_'){
$skill = explode(',', $row2['spPostFieldValue']);
}
}
if($jobType == ''){
if($row2['spPostFieldName'] == 'spPostingJobType_'){
$jobType = $row2['spPostFieldValue'];
}
}
if($jobLevel == ''){
if($row2['spPostFieldName'] == 'spPostingJoblevel_'){
$jobLevel = $row2['spPostFieldValue'];
}
}
if($location == ''){
if($row2['spPostFieldName'] == 'spPostingLocation_'){
$location = $row2['spPostFieldValue'];
}
}

}*/
date_default_timezone_set("Asia/Karachi");
$postingDate = $p-> spPostingDate($row["spPostingDate"]);





}
} 
//total aplicant
$ac = new _sppost_has_spprofile;
$countAplicant = $ac->job($post_id);
//echo $ac->ta->sql;

if($countAplicant){
$aplicant = $countAplicant->num_rows;
}else{
$aplicant = 0;
}
//total shortlisted
$sl = new _shortlist;
$countShortList = $sl->getshortlist($post_id);
if($countShortList){
$shrtList = $countShortList->num_rows;
}else{
$shrtList = 0;
}
?>




<!--    <div class="row top_detail_board m_top_20">
<div class="col-md-3">
<a href="<?php echo $BaseUrl;?>/job-board/all-jobs.php"><i class="fa fa-angle-left"></i> Back to Jobs</a>
</div>
<div class="col-md-6">
<h1><?php echo ucfirst($title);?></h1>

</div>
<div class="col-md-3 text-right">
<div style="padding-right: 20px;">
<?php
if($_SESSION['ptid'] == 1){?>
<a href="<?php echo $BaseUrl.'/post-ad/job-board/?post';?>" class="btn butn_jobboard">Post a job</a> <?php
} ?> 

</div>

</div>
</div> -->
</div>
</section>
<section style="margin-top: 10px;">
<div class="container">
<div class="row no-margin">


<div class="col-md-9">
<div class="col-sm-12 nopadding dashboard-section whiteboardmain" style="margin-top: 7px;padding: 16px 0px 0px 0px;">
<div class="col-xs-12 dashboardbreadcrum">
<ul class="breadcrumb">
<li><a href="<?php echo $BaseUrl;?>/job-board/dashboard">Dashboard</a></li>
<li><a href="<?php echo $BaseUrl;?>/job-board/dashboard/active-post.php">Active Post</a></li>
<li><?php echo ucfirst($title);?></li>
<!-- <li><?php echo $title;?></li> -->
<a href="<?php echo $BaseUrl.'/post-ad/job-board/?post';?>" class="btn " style="float: right;background-color: #31abe3;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;">Post a job</a>
<!-- <a href="https://thesharepage.com/post-ad/freelancer/?post" class="btn post-project postproject" style="float: right;background-color: orange;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;" >Post a project</a> -->
</ul>
</div>
</div>

<div class="right_detail_job" style="margin-top: 93px;">
<!--   <h2><a href="<?php echo $BaseUrl;?>/job-board/dashboard"><i class="fa fa-angle-left"></i> Back to Dashboard</a></h2> -->
<h1 style="color: #31ace3;"><?php echo ucfirst($title);?></h1>
<h2>Job Description</h2>
<p><?php echo $overview;?></p>
</div>
<!-- repeat able box -->
<div class="whiteboardmain m_top_10">
<div class="row top_job_head text-center">
<!-- 
<div class="col-sm-12">
<h1>Offered salary: <?php echo $salaryEnd .' - '.$salaryStrt; ?>  Posted by: <?php echo $CmpnyName; ?></h1>
</div>
-->
<div class="col-sm-12">
<div class="center-block">
<ul style="width: 90%; margin: 0 auto;height: 50px;border-bottom: 1px solid #CCC;">
<li><?php echo $location1;?> <br>Location</li>
<li>|</li>
<li><?php echo $salaryyy; ?> <br>Average salary</li>
<li>|</li>
<li><?php echo $jobLevel1; ?> <br>Job Level</li>
<li>|</li>
<li><?php echo $Experience1 .' Years'; ?> <br>Min Experience</li>
<!-- <li>|</li>
<li><?php echo $CloseDate; ?> <br>Closing Date</li>-->
</ul>

</div>
</div>

<div class="col-sm-12">
<div class="wizard">
<div class="wizard-inner">
<div class="connecting-line"></div>
<ul class="nav nav-tabs" role="tablist">
<li role="presentation">
<a href="" >
<span class="round-tab tab_blue">
<?php echo $aplicant;?>
</span>
</a>
<p>Applied</p>
</li>
<li role="presentation" >
<a href="#" >
<span class="round-tab tab_dark_green">
<?php echo $shrtList;?>
</span>
</a>
<p>Short listed</p>
</li>
<!-- <li role="presentation" >
<a href="#" >
<span class="round-tab tab_green">
<?php echo $noOfPos; ?>
</span>
</a>
<p>Company Positions</p>
</li>

<li role="presentation" >
<a href="#">
<span class="round-tab tab_orange">
<?php echo $YearFounded;?>
</span>
</a>
<p>Year Founded</p>
</li> -->
</ul>
</div>
</div>
</div>                                
</div>
</div>

<!-- repeat able box end -->
<div class="right_detail_job m_top_10">
<div class="title_job">
<h2>Applicants Received</h2>
<div class="space"></div>
<div class="row">
<div class="col-sm-12">
<div class="table-responsive">
<table class="table table-striped tbl_jobboard text-center" id="tbl_jobboard">
<thead class="">
<tr style="font-size: 17px;">
<th>Name</th>
<th>Download CV</th>
<th>Chat</th>
<th>Short list</th>
<th>Date</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php

$ac = new _sppost_has_spprofile;
$pc = new _postingalbum;
$result3 = $ac->job($post_id);

if($result3){
while ($row3 = mysqli_fetch_assoc($result3)) { 
//   echo "<pre>";
// print_r($row3);
$result4 = $pc->resume($row3['sppostingResume']);
//echo $pc->ta->sql;
?>
<tr>
<td><a href="<?php echo $BaseUrl.'/job-board/user-profile.php?pid='.$row3['spProfiles_idspProfiles']?>"><?php echo ucfirst($row3['spProfileName']); ?></a></td>
<td>
<?php
$result4 = $pc->resume($row3['sppostingResume']);
//echo $pc->ta->sql;
if ($result4 != false) {
$rw = mysqli_fetch_assoc($result4);
//create destination and then show it
$resume = $rw["spPostingMedia"];
$ext = $rw['sppostingmediaExtension'];
$previewfile =$rw['sppostingmediaTitle'].$rw['idspPostingMedia'].".".$rw['sppostingmediaExt']."";                                                           
file_put_contents("../../resume/".$previewfile, $resume);
?>

<a href="<?php echo $row3['sppostingResume']; ?>" target="_blank" download>Download</a>
<?php } else { ?>
    <a href="<?php echo $row3['sppostingResume']; ?>" target="_blank" download>Download</a>

<?php } ?>
</td>
<td><a href="javascript:void(0)"  onclick="javascript:chatWith(<?php echo $row3['spProfiles_idspProfiles'];?>)"  class="red"><i class='fas fa-comment-dots' style="color: #ff7208;"></i></a></td>
<td>
<?php
$sl = new _shortlist;
$result4 = $sl->chekShortlist($post_id, $row3['spProfiles_idspProfiles']);
//echo $sl->ta->sql;
if($result4){ 
	$href= $BaseUrl.'/job-board/shortlist.php?user='.$row3['spProfiles_idspProfiles'].'&postid='.$row3['spPostings_idspPostings'].'&reject';
	?>

<a style="color: #fff!important;padding-bottom: 0px;padding-top: 0px;" class="btn btn-info"  onclick="ShortlistReject('<?php echo $href; ?>')">Short listed</a> 


<?php
}else{ 
	
	$href = $BaseUrl.'/job-board/shortlist.php?user='.$row3['spProfiles_idspProfiles'].'&postid='.$row3['spPostings_idspPostings'].'&accept';
	?>
<a style="color: #fff!important;padding-bottom: 0px;padding-top: 0px;" class="btn btn-info"  onclick="ShortlistAccept('<?php echo $href; ?>')">Short list</a> <?php
}?>

</td>
<td>
<?php $date = $row3['spActivityDate']; 
$postDate = new DateTime($row3['spActivityDate']);
?>
 <?php  echo $postDate->format('d-M-Y'); ?>
</td>

<td>



<a  href="#" class=" " data-toggle="modal" data-target="#showdesc<?php echo $row3['sp_id'];?>" id="addnews" style="background-color: #31abe3;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;"> <img src="images (1).png" style="height:30px;width:25px" /></a>

<a  href="<?php echo $row3['sppostingResume']; ?>" target="_blank" class=" "  id="addnews" style="background-color: #31abe3;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;"> <img src="download1.png" style="height:30px;width:25px" /></a>


<?php

$userid = $row3['spProfiles_idspProfiles'];

$postid = $row3['spPostings_idspPostings'];

$cr = new _comment;

$match = $cr->read_comments($postid, $userid);
//print_r($match);die('1111');
//$count = mysqli_num_rows($match);


if(!empty($match)){
$row44 = mysqli_fetch_assoc($match);
$comt = $row44['comment'];

?>
<button  onclick="showcomment('<?php echo $comt; ?>');" type="button" data-toggle="modal" data-target="#myModal7" name="commentshow"><img src="../../img/icon/comment-icon.png" width="20px"></button>

<?php

}
else {
?>
<button  onclick="abhi(<?php echo $row3['spProfiles_idspProfiles']; ?>,<?php echo $row3['spPostings_idspPostings']; ?>);" type="button" data-toggle="modal" data-target="#myModal6" name="comment"><img src="../../img/icon/comment.png" width="20px"></button>

<?php
}

if($result4){ ?>
<!--<a href="javascript:void(0);" style="color: #000!important;"><img src="heart.png" style="height:30px;width:25px" /></a> -->

<a style="color: #fff!important;padding-bottom: 0px;padding-top: 0px;" class="" href="<?php echo $BaseUrl.'/job-board/shortlist.php?user='.$row3['spProfiles_idspProfiles'].'&postid='.$row3['spPostings_idspPostings'].'&reject';?>" onclick="return confirm('Are you sure you want to Reject ?');"><img src="heart.png" style="height:30px;width:25px" /></a>

<?php
}else{ ?>
<a style="color: #fff!important;" class="" href="<?php echo $BaseUrl.'/job-board/shortlist.php?user='.$row3['spProfiles_idspProfiles'].'&postid='.$row3['spPostings_idspPostings'].'&accept';?>" onclick="return confirm('Are you sure you want to Accept?');"><img src="heart2.png" style="height:30px;width:25px;padding-bottom: 0px;padding-top: 0px;" /></a> <?php
}?>



<div class="modal fade jobseeker" id="showdesc<?php echo $row3['sp_id'];?>" tabindex="-1" role="dialog" aria-labelledby="resumeModalLabel">
<div class="modal-dialog sharestorepos" role="document">
<div class="modal-content no-radius" >
<form action="<?php echo $BaseUrl.'/job-board/addnews.php';?>" id="add_news_frm" method="post">      
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h3 class="modal-title" style="float: left;" id="resumeheadr">Description</h3>
</div>
<div class="modal-body" style="padding-bottom: 35px;">

<p style="float: left;"><?php echo $row3['sppostingscoverletter']; ?></p>

</div>
<div class="modal-footer" class="uploadupdate">
<button type="button" class="btn butn_cancel" data-dismiss="modal">Close</button>
<!--  <button type="button" id="sub_news" class="btn btn-submit">Add</button> -->
</div>
</form>
</div>
</div>
</div>




</td> 




</tr>
<?php
}
}else{

echo "<tr><td colspan='5' style='text-align: center;'>No Applicants Found!</td></tr>";
}
?>
</tbody>
</table>
</div>
</div>
</div>
</div>

</div>



</div>
<div class="col-md-3">

<div class="left_detail_job">
<p style="font-size: 14px;    border-bottom: 1px dashed #333; margin-right: -8px;"><i class="fa fa-list-alt"></i> Category: <?php echo ucwords(strtolower($row['spPostingJobType']));?></p>
<p style="font-size: 14px;    border-bottom: 1px dashed #333;"><i class="fa fa-clock-o"></i> Level : &nbsp;<?php echo $jobLevel1;?></p>

<?php

/*$res99 = $p->readtblCity($location);
print_r($res99);die;
$tbl_city2 = mysqli_fetch_assoc($res99);
// 

$tbl_city3 =$tbl_city2['city_title'];*/ 
?>

<p style="font-size: 14px;    border-bottom: 1px dashed #333;"><i class="fa fa-map-marker"></i> Location : &nbsp;<?php echo $location1;?></p>
<h3 style="margin-bottom: -5px;">Skills :</h3>
<ul class="skills-list">
<?php
if($skill2 != ''){
if(count($skill2) >0){
foreach($skill2 as $key => $value){
if($value != ''){
echo "<li><i class='fa fa-tag'></i> ".$value."</li>";
}

}
}
}

?>


</ul>
<!-- <h3>Share With:</h3>
<div class="social_share_job">
<a href=""><i class="fa fa-facebook"></i></a>
<a href=""><i class="fa fa-twitter"></i></a>
<a href=""><i class="fa fa-linkedin"></i></a>
</div> -->

<?php


?>

</div>

<br><br>

<div class="left_detail_job">
	<h4><b><u>Job Description : </u></b></h4>  	   
<?php echo $overview;?>
	</div>
</div>
</div>
</div>
</section>



<form method="post">

<div id="myModal6" class="modal fade" role="dialog">
<div class="modal-dialog">	

<!-- Modal content -->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">User Data</h4>
</div>
<div class="modal-body">
<input type="hidden" id="userid" name="userid">   <!-- postid -->
<input type="hidden" id="postid" name="postid">   <!-- userid -->
<textarea rows="3" class="form-control" name="comments"></textarea>
</div>
<div class="modal-footer">
<a href=""><button type="submit" name="submit" class="btn btn-primary">Save</button></a>
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>

<?php

if(isset($_POST['submit'])){
$data = array(
'user_id' => $_POST['userid'],
'_post_id' => $_POST['postid'],
'comment' => $_POST['comments']
);

$mj = new _comment;
$mj->job_comments($data);
}

?>

</div>

</div>
</div>



</form>	


<div id="myModal7" class="modal fade" role="dialog">
<div class="modal-dialog">	

<!-- Modal content -->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">User Comment</h4>
</div>
<div class="modal-body">
<p id="comt"></p>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>


<script type="text/javascript">
function abhi(id,id1){
//alert(id);
document.getElementById("postid").value = id1;
document.getElementById("userid").value = id;
}



$(document).ready( function () {
$('#tbl_jobboard').DataTable({
"paging":   true,
"ordering": false,
"info":     false
});
} );
</script>

<script type="text/javascript">

function showcomment(comt){
document.getElementById("comt").innerHTML = comt;

}
</script>

<?php 
include('../../component/f_footer.php');
include('../../component/f_btm_script.php'); 
?>
</body>
</html>
<?php
}?>																																	

<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script> 
    <script>
        function ShortlistAccept(userId) {
			//alert("hhhhhhhhhhh");
        Swal.fire({
        title: 'Are you sure you want to Accept?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Accept!'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = userId;
        }
        });
        }

		function ShortlistReject(userId) {
			//alert("hhhhhhhhhhh");
        Swal.fire({
        title: 'Are you sure you want to Reject?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Reject!'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = userId;
        }
        });
        }
    </script>
