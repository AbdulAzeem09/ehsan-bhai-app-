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



?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php');?>
</head>

<body class="bg_gray" onload="pageOnload('groupdd')">
<?php


$g = new _spgroup;
$result = $g->groupdetails($_GET["groupid"]);
//echo $g->ta->sql;
if ($result != false) {
$row = mysqli_fetch_assoc($result);
$gimage = $row["spgroupimage"];
$spGroupflag = $row['spgroupflag'];
}
if(isset($_GET['groupid']) && isset($_GET['groupname'])){
$txtgroupid = $_GET['groupid'];
$txtgroupname = $_GET['groupname'];
}
?>

<?php include('../header.php');?>
<section class="landing_page">
<div class="container">
<div class="row">
<div  id="sidebar" class="col-md-2 no-padding" style="width: 195px; top: auto; bottom: auto; left: 0px; right: auto;">
<?php include('../component/left-group.php');?>
</div>
<div class="col-md-10">
<?php include('top_banner_group.php');?>
<div class="row">
<div class="col-md-12">
<div class="about_banner" id="ip6">
<div class="top_heading_group " id="ip6">
<div class="row">
<!--    <div class="col-md-6"> -->

<ol class="breadcrumb">
<li><a href="<?php echo $BaseUrl;?>/grouptimelines/addSms.php?groupid=<?php echo $_GET['groupid']?>&groupname=<?php echo $_GET['groupname']?>&smsCampaigns" style="font-size: 20px;">SMS Campaign</a></li>
<li><a href="<?php echo $BaseUrl;?>/grouptimelines/smsReport.php?groupid=<?php echo $_GET['groupid']?>&groupname=<?php echo $_GET['groupname']?>&smsCampaigns" style="font-size: 20px;color: #202548;" >Reports</a></li>        
</ol>
<!-- </div> -->

</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="table-responsive">
<table class="table table_light_green_head text-center">
<thead>
<tr>
<th>Campaign Name</th>
<th>Date/Time</th>
<th>Status</th>
<!--   <th>Report</th> -->

</tr>
</thead>
<tbody>
<?php
$g = new SmsEmailCampaign;
$result2 = $g->getsmmEmailCampaign($_SESSION['uid'] , 'sms');
if ($result2 != false){
while($row2 = mysqli_fetch_assoc($result2)) { ?>
<tr>
<td class="text-left"><?php echo $row2['name'];?></td>
<td class="text-center"><?php echo $row2['date'];?><br><?php date('H:i',strtotime($row2['time']));?></td>

<?php
if($row2['status'] == 'pending'){ ?>
<td class="pend_status">
<i class="fa fa-clock-o"></i> <?php echo $row2['status'];?>
</td>
<?php
}
if($row2['status'] == 'Ok'){ ?>
<td class="ok_stautus">
<i class="fa fa-thumbs-up"></i> <?php echo $row2['status'];?>
</td>
<?php
}
if($row2['status'] == 'progress'){ ?>
<td class="ok_stautus">
<i class="fa fa-thumbs-up"></i> <?php echo $row2['status'];?>
</td>
<?php
}
?>
<?php
if($row2['status'] == 'Ok'){ ?>
<!--   <td class="text-center">
<a href="<?php echo $BaseUrl;?>/grouptimelines/singleSmsReport.php?groupid=<?php echo $txtgroupid;?>&groupname=<?php echo $txtgroupname?>&Smsreport&jopid=<?php echo $row2['job_id']?>" data-id="<?php echo $row2['id']; ?>">View Reports</a> -->
<!-- <span class="btn btn-primary report" id="report" data-datac="<?php /// echo $campaign->job_id; ?>" ><a data-id="<?php //echo $campaign->job_id; ?>"> Report </a></span> -->

<!-- </td> --> <?php
}
?>


</tr> <?php
}
}else{ ?>
<tr>
<td colspan="4"><p class="text-center">Report Not Available</p></td>
</tr>

<?php }
?>
</tbody>
</table>
</div>
</div>
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