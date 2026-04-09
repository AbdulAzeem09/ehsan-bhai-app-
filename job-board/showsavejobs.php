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
$header_jobBoard = "header_jobBoard";
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php');?>
</head>

<body class="bg_gray">
<?php
include_once("../header.php");
?>
<section class="landing_page">
<div class="container">
<div class="row">
<div class="col-md-3">
<?php include('../component/left-jobboard.php');?>
</div>
<div class="col-md-9 no-padding">
<?php 
include('top-job-search.php');
include('inner-breadcrumb.php');
?>


<!-- repeat able box -->
<div class="whiteboardmain" style="min-height: 300px;">
<h3 class="heading05">Saved Jobs</h3>
<div class="row">
<div class="col-sm-12">
<div class="table-responsive">
<table class="table table-striped tbl_jobboard text-center">
<thead class="">
<tr>
<th>Job Title</th>
<th>Date Posted</th>
<th>Status</th>
</tr>
</thead>
<tbody> 
<?php
/* $m = new  _postingview;*/
$m = new  _jobpostings;
$result = $m->mySaveJob(2 ,$_SESSION['pid']);
//$result = $m->myDeactiveProfilejob($_SESSION['pid']);
//echo $m->ta->sql;
if($result){
while ($row = mysqli_fetch_assoc($result)) { 
$postDate = new DateTime($row['spPostingDate'])
?>
<tr>
<td><a href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row['idspPostings'];?>"><?php echo ucfirst($row['spPostingTitle']);?></a></td>
<td><?php echo $postDate->format('d-M-Y');?></td>

<td>
<a href="<?php echo $BaseUrl.'/job-board/savejob.php?unsave='.$row['save_id'];?>" class="btn btn-success">Unsaved</a>
</td>
</tr> <?php
}
}


?>
</tbody>
</table>
</div>
</div>
</div>
</div>
<!-- repeat able box end -->


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