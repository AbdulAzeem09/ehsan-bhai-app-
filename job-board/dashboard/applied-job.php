<?php



include('../../univ/baseurl.php');
session_start();

if($_SESSION['ptid'] != 5){
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


$_GET["categoryid"] = "2";
$_GET["categoryName"] = "Job Board";
$activePage = 7;
$header_jobBoard = "header_jobBoard";
?>
<!DOCTYPE html>
<html lang="en-US">

<style>

.tbl_jobboard a {
color: #ffffff !important;
}
#example_filter{


margin-bottom: 9px;
}
table.dataTable thead .sorting:after {
opacity: 00!important;
content: "\e150";
}
.dataTables_empty{text-align:center!important;}
</style>

<head>
<?php include('../../component/f_links.php');?>
<!--This script for sticky left and right sidebar STart-->


<!-- ===== INPAGE SCRIPTS====== -->
<!-- High Charts script -->
<script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>

<script src="<?php echo $BaseUrl;?>/assets/js/home.js"></script>


<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<link rel="stylesheet" href="https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css">
<?php include('../../component/dashboard-link.php'); ?>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
</head>

<body class="bg_gray">
<?php
include_once("../../header.php");
?>
<section class="landing_page">
<div class="container">
<div class="row">
<?php //include('../thisisjobboard.php'); ?> 
<div class="sidebar col-md-3 no-padding" id="sidebar" >
<?php 
include('left-menu.php');
if($_SESSION['ptid'] == 5){
include('left-btm-jobseakr.php');
} ?> 
</div>

<div class="col-md-9">

<div class="col-sm-12 nopadding dashboard-section whiteboardmain" style="margin-top: 7px;padding: 16px 0px 0px 0px;">
<div class="col-xs-12 dashboardbreadcrum">
<ul class="breadcrumb">
<li><a href="<?php echo $BaseUrl;?>/job-board/dashboard/emp_dashboard.php">Dashboard</a></li>
<li>My Applied Jobs</li>
<!-- <li><?php echo $title;?></li> -->
<!--  <a href="<?php echo $BaseUrl.'/post-ad/job-board/?post';?>" class="btn " style="float: right;background-color: #31abe3;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;">Post a job</a> -->
<!-- <a href="https://thesharepage.com/post-ad/freelancer/?post" class="btn post-project postproject" style="float: right;background-color: orange;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;" >Post a project</a> -->
</ul>
</div>
</div>


<!-- repeat able box -->
<div class="whiteboardmain" style="min-height: 300px;margin-top: 100px;">
<div class="row">
<div class="col-sm-12">
<div class="table-responsive">
<table class="table table-striped tbl_jobboard text-center" id="example">
<thead class="">
<tr>
<th>Id</th>
<th style="width: 80px;">Job Title</th>
<th>Applied On</th>
<th>City</th>
<th>State</th>
<th>Date Posted</th>
<th>Status</th>
<th>Action</th>

</tr>
</thead>
<tbody>
<?php
$m = new  _jobpostings;


if($_GET['delete'] !=""){
//	die('');
$postid=$_GET['delete'];
$result = $m->remove_applied($postid);

}


$result = $m->myAppliedJob($_SESSION['pid']);
//$result = $m->myProfilejobpost($_SESSION['pid']); 
//spActivityDate
//echo $m->ta->sql;
if($result){
$ii=1;
while ($row = mysqli_fetch_assoc($result)) { 


$rwse =  $m->read($row["idspPostings"]);

$rows = mysqli_fetch_assoc($rwse);

/*  echo "<pre>";
print_r($rows);*/
$postDate = new DateTime($row['spPostingDate'])
?>
<tr>
<td><?php echo $ii++; ?></td>
<td><a style="color: #000000 !important;" href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row["idspPostings"]?>"><?php echo ucfirst($row['spPostingTitle']);?></a></td>

<td><?php 
$postDate1 = new DateTime($row['spActivityDate']);
echo $postDate1->format('d-M-Y');

//echo $newDate = date("Y-m-d", strtotime($row['spActivityDate']));
?></td>

<td>
<?php

$usercountry = $row['spPostingsCountry'];
$userstate = $row['spPostingsState'];
$usercity = $row['spPostingsCity'];

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


echo $currentcity;
?>
</td>

<td>
<?php echo $row['posting_status']; ?> 
<!----<span >
<?php
$ac = new _sppost_has_spprofile;
$countAplicant = $ac->job($row["idspPostings"]);
if($countAplicant){
echo $countAplicant->num_rows;
}else{
echo 0;
}
?>
</span>--->
</td>
<td>
<?php
$postDate = new DateTime($row['spPostingDate']);
 echo $postDate->format('d-M-Y');?>
<!---<?php

$sl = new _shortlist;
$chkShortList = $sl->chekShortlist($row["idspPostings"], $_SESSION['pid']);
if($chkShortList){
?>
<a href="javascript:void(0)"  onclick="javascript:chatWith(<?php echo $rows['spProfiles_idspProfiles'];?>)"  class="red"><i class='fas fa-comment-dots' style="color: #ff7208;"></i></a>

<?php  } ?>--->




</td>
<td>
<?php
$sl = new _shortlist;
$chkShortList = $sl->chekShortlist($row["idspPostings"], $_SESSION['pid']);
if($chkShortList){
echo '<a href="'.$BaseUrl.'/job-board/job-detail.php?postid='.$row["idspPostings"].'" class="btn btn-success">Short Listed</a>';
}else{
echo '<span class="btn btn-primary">Not Shortlisted</span>';

}?>

</td>


<td>
<a   onclick="remove_applied1('<?php echo $BaseUrl.'/job-board/dashboard/applied-job.php?delete='.$row['sp_id'];?>;')" href="#" class="btn"><i  style="font-size: 18px;" class="fa fa-trash" aria-hidden="true"></i></a>
</td>
</tr> <?php
}
}
?>
</tbody>
</table>

<!-- partial -->

<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

<script type="text/javascript">
$(document).ready(function() {

var table = $('#example').DataTable({ 
select: false,
"columnDefs": [{
className: "Name", 
"targets":[0],
"visible": false,
"searchable":false
}]
});//End of create main table


$('#example tbody').on( 'click', 'tr', function () {

// alert(table.row( this ).data()[0]);

} );
});
</script>
<script> 
function remove_applied1(url){
		swal({
		title: "Are you sure?",
		
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#DD6B55',
		confirmButtonText: 'Yes, delete it!',
		closeOnConfirm: false,
		//closeOnCancel: false
	},
	function(){
		window.location.href = url;
		swal("Deleted!", "Your imaginary file has been deleted!", "success");
	});
	};
</script>
<script src='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js'></script>
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
include('../../component/f_footer.php');
include('../../component/f_btm_script.php'); 
?>
</body>
</html>
<?php
}?>	