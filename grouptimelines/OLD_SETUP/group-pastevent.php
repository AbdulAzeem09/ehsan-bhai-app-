<?php
include('../univ/baseurl.php');
session_start();

function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");

$_GET["categoryid"] = "16";
$_GET["profiletype"] = "1";
$_GET["categoryname"] = "GroupEvents";
// $header_event = "events";
$group_id = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;
if (!isset($_SESSION['pid'])) {
include_once ("../authentication/check.php");
$_SESSION['afterlogin'] = "../grouptimelines/?groupid=" . $group_id . "&groupname=" . $_GET['groupname'] . "&timeline";
}

$pid=$_SESSION['pid'];
$getid=$group_id;
//echo $pid;
//die("============");
$obj2=new _spAllStoreForm;	
$ress2=$obj2->readdatabymulid($getid,$pid);

//print_r($ress2);
//die("+++++++++++++++++");

if($ress2 ==false){
//die("=======");
header("location:$BaseUrl/my-groups/?msg=notaccess");

}



?>
<!DOCTYPE html>
<html lang="en-US">

<head>

<?php include('../component/links.php');?>
<script src="<?php echo $BaseUrl;?>/assets/js/home.js"></script>

<!--This script for posting timeline data Start-->
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
<!--This script for posting timeline data End-->


<!-- ===== INPAGE SCRIPTS====== -->
<!-- High Charts script -->
<script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
<!-- <script src="<?php echo $BaseUrl;?>/assets/js/home.js"></script> -->

<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<style type="text/css">
.sponsorPic{
display: block!important;
}

</style>
</head>
<body class="bg_gray" onload="pageOnload('groupdd')">
<?php

include_once ("../header.php");

$g = new _spgroup;
$result = $g->groupdetails($group_id);
//echo $g->ta->sql;
if ($result != false) {
$row = mysqli_fetch_assoc($result);
$gimage = $row["spgroupimage"];
$spGroupflag = $row['spgroupflag'];
}
?>

<section class="landing_page">
<div class="container">
<div class="row">
<div class="col-md-2 no-padding">
<?php include('../component/left-group.php');?>
</div>
<div class="col-md-10">
<div class="row">
<div class="col-md-12">
<div class="about_banner" id="ip6">
<div class="top_heading_group " id="ip6">
<div class="row">
<div class="col-md-6">
<span id="size1">Group  <small>[Past Events]</small></span>
<!--                                                 <h3><span >Events</span></h3>
-->                                            </div>

<?php if ($row["spProfiles_idspProfiles"] == $_SESSION['pid']) { ?>

<div class="col-md-6">
<!-- <a href="<?php echo $BaseUrl;?>/grouptimelines/group-sponsor.php" class="btn btnPosting db_btn db_primarybtn pull-right"><i class="fa fa-eye"></i><span > View Sponsor</span></a> -->

<!--  <a href="<?php echo $BaseUrl;?>/grouptimelines/dashboard/" class="btn btnPosting db_btn db_primarybtn pull-right"><i class="fa fa-dashboard"></i><span > Dashboard</span></a> -->

<a  href="<?php echo $BaseUrl?>/grouptimelines/group-event.php?groupid=<?php echo $group_id?>&groupname=<?php echo $_GET['groupname'];?>&event" class="btn btnPosting db_btn db_primarybtn pull-right btn-border-radius"><i class="fa fa-arrow-left"></i><span >Back</span></a>
</div>
<?php } ?>
</div>
</div>
<div class="row" style="margin-top: 25px;">
<div class="col-md-12">
<div class="box groupbox-danger">
<div class="box-body">
<div class="table-responsive bg_white">
<table id="" class="table table-striped groupeventTable">
<thead>
<tr>
<th>ID</th>
<th>Event Title</th>
<th>Price</th>
<th>Category</th>
<!-- <th class="text-center">Remaining Tickets</th>
<th class="text-center">Purchase Tickets</th> -->
<!-- <th class="text-center">Intrested</th> -->
<!--  <th class="text-center">Going</th> -->
<th>Action</th>


</tr>
</thead>
<tbody>
<?php
//$p      = new _postingview;
// $pf     = new _postfield;

$p = new _spgroup_event;
$res = $p->getExpiredEventsOfGroup($group_id, -1, $_GET["categoryid"]);
//$res    = $p->publicpost_event($_GET["categoryID"]);
//echo $p->ta->sql;
$i = 1; 
if($res != false){
while ($row = mysqli_fetch_assoc($res)) {
//posting fields
//  $totTkt = $row2['spPostFieldValue'];
//  $catName = $row2['spPostFieldValue'];

$pf = new _spgroupevent_transection;
$result_pf = $pf->postread($row['idspPostings']);
///echo $pf->ta->sql."<br>";

//print_r($row);

if($row){
$totTkt = "";
$catName = "";


$totTkt = $row['ticketcapacity'];
$catName = $row['eventcategory'];

while ($row2 = mysqli_fetch_assoc($result_pf)) {


$soldticket += $row2['quantity'];

}



?>
<tr>
<td><?php echo $i; ?></td>
<td class="eventcapitalize"><a href="<?php echo $BaseUrl.'/grouptimelines/group-eventdetail.php?postid='.$row['idspPostings'];?>"><?php echo $row['spPostingTitle'];?></a></td>
<td><?php echo ($row['spPostingPrice'] > 0)? '$'.$row['spPostingPrice']:'Free';?></td>
<td><?php echo $catName;?></td>
<!-- <td class="text-center"><?php echo ($totTkt > 0)?$totTkt:'0';?></td> -->
<!--  <td class="text-center"><?php echo ($soldticket > 0)?$soldticket:'0';?></td> -->
<!--    <td class="text-center">
<a href="javascript:void(0)" data-toggle='modal' data-target='#loaddetail' class="eventDetail" data-postid="<?php echo $row['idspPostings'];?>" data-pid="<?php echo $row['idspProfiles'];?>" data-intrest="1" >
<?php
$ie = new _eventIntrest;
$result = $ie->chekGoing($row['idspPostings'], 1);
// echo $ie->ta->sql;
if($result != false && $result->num_rows >0){

echo $result->num_rows;

}else{

echo 0;
}
?>
</a>  
</td>
<td class="text-center">
<a href="javascript:void(0)" data-toggle='modal' data-target='#loaddetail' class="eventDetail" data-postid="<?php echo $row['idspPostings'];?>" data-pid="<?php echo $row['idspProfiles'];?>" data-intrest="2" >
<?php
$ie = new _eventIntrest;
$result = $ie->chekGoing($row['idspPostings'], 2);
if($result != false && $result->num_rows >0){
echo $result->num_rows;
}else{
echo 0;
}
?>
</a>
</td> -->
<td>
<a href="<?php echo $BaseUrl.'/grouptimelines/group-eventdetail.php?postid='.$row['idspPostings']; ?>" class=""><i class="fa fa-eye"></i></a>
<!--
<a href="<?php echo $BaseUrl.'/grouptimelines/groupeventhistorypage.pdf' ?>" class="" id="btnPDF"><i class="fa fa-file-pdf-o "></i></a> -->

</td>
</tr> <?php
$i++;

/*

$Date = new DateTime($row['spPostingDate']);
$startTime = $row['spPostingStartTime'];
$dtstrtTime = strtotime($startTime);
$firstname = $row2['first_name'];
$lastname = $row2['last_name'];
//echo date("h:i A", $dtstrtTime);

// $Starttime = new strtotime($eventdetail['spPostingStartTime']);

$html ='
<html lang="en-US">

<head>

<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">

<style>

.showeventrating{
margin-left: 45px;
margin-right: 45px;
margin-bottom: 10px;
}

.pdftablehead{
font-weight: bold;
font-size: 16px;
}
tr td{
padding: 15px;
line-height: 1.42857143;
vertical-align: top;
border-top: 1px solid #ddd;
}
.tddata{
padding-left : 14px;
text-transform: capitalize;
}
.textboxcenter{

border:1px solid black;
width:50%;
height:100px;
margin-left: 180px;

}
.trdata .newtddata{
padding: 7px!important;
border:none!important;
vertical-align: top!important;
padding-left : 40px;

}
.bordernone{
border:none!important;
}


</style> 

</head>    

<body class="bg_gray">

<section class="main_box">            
<div class="container">


<div class="row">


<div class="col-md-12">
<div class="bg_white detailEvent m_top_10">



<div class="row">
<div class="showeventrating">


<p style="text-align:center; padding-top:20px;"> <img src="'.$BaseUrl.'/assets/images/logo/tsp_trans.png" class="img-responsive" style="height: 100px;"></p>
<p style="font-size: 30px; text-align:center;">The SharePage</p>
<div class="textboxcenter">
<div class="col-md-6">                                 
<table class="table">


<tbody>
<tr class="trdata">
<td class="pdftablehead newtddata">Event Title :</td>
<td class="tddata newtddata">'.$row['spPostingTitle'].'</td>

</tr>
<tr class="trdata">
<td class="pdftablehead newtddata">Date :</td>
<td class="tddata newtddata">'.$Date->format('d M Y').'</td>

</tr>
<tr class="trdata">
<td class="pdftablehead newtddata">Start Time :</td>
<td class="tddata newtddata" style="text-transform: uppercase;">'.date("h:i A", $dtstrtTime).'</td>

</tr>
</tbody>
</table>

</div>

</div>



<br>



<div class="row">
<div class="col-md-6" style="width:50%; float:left;">                                 
<table class="table">

<tbody>
<tr style="border:none!important;">
<td class="pdftablehead" style="border:none!important;" >Name : </td>
<td class="tddata" style="font-weight:bold; border:none!important;">'.$firstname.'    '.$lastname.'</td>

</tr>
<tr>
<td class="pdftablehead">Organized By :</td>
<td class="tddata">'.ucwords($sellerName).'</td>

</tr>

<tr>
<td class="pdftablehead">Venue :</td>
<td class="tddata">'.$row['spPostingEventVenue'].'</td>

</tr>
</tbody>
</table>

</div>
<div class="col-md-6"  style="width:50%;float:right;">
<table class="table">

<tbody>
<tr style="border:none!important;">
<td class="pdftablehead" style="padding-left:130px; border:none!important;">Ticket Quantity : </td>
<td class="tddata" style="padding-left:20px; border:none!important;">'.$row2['quantity'].'</td>

</tr>
<tr>
<td class="pdftablehead"></td>
<td class="tddata" style="padding-bottom:35px;"></td>

</tr>
<tr>
<td class="pdftablehead"></td>
<td class="tddata"  style="padding-left:30px;"></td> 

</tr>
</tbody>
</table>

</div>
</div>

<hr>                          

<div class="row">
<div class="col-md-4" style="width:30%; float:left;">                                 
<table class="table">

<tbody>
<tr style="border:none!important;">
<td class="pdftablehead" style="border:none!important;">Price P. P.<br><br>$'.$row['spPostingPrice'].'</td>



</tr>

</tbody>
</table>

</div>
<div class="col-md-4"  style="width:30%;">
<table class="table">

<tbody>
<tr style="border:none!important;">
<td class="pdftablehead" style="border:none!important; padding-left:100px;">Remaining Tickets<br><br> '.($totTkt > 0)?$totTkt:'0'.'</td>


</tr>

</tbody>
</table>

</div>

<div class="col-md-4"  style="width:50%; float:right; padding-left:150px;">
<table class="table">

<tbody>
<tr class="" style="border:none!important;">
<td class="pdftablehead " style="border:none!important; padding-left:240px; padding-top:-80px;">Purchase Tickets<br><br>'.($soldticket > 0)?$soldticket:'0'.'</td>


</tr>

</tbody>
</table>

</div>
</div>


<hr>
<p style="font-size: 18px; padding-left: 12px; float:left; padding-top:-15px;"> Booked on : '.date("Y-m-d H:i:A",strtotime($row2['payment_date'])).'</p>


<div style="float:left; padding-left: 12px;" >
<p font-size: 12px;>Full Payment Received successfully. <br> Transaction ID : '.$row2['txn_id'].'</p>
</div>

<p style="text-align:center; padding-top:230px;">Paid Online From- www.TheSharePage.com</p>
</div>
</div>
</div>
</div>
</div>
</div>

</section>
</body>
</html>'; 
*/
}
}

}else{?>
<td colspan="9"><center>No Record Found</center></td> 
<?php }?>


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
</div>
</section>
<?php include('../component/footer.php');?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../component/btm_script.php'); ?>

<?php   
include '../assets/mpdf/mpdf.php';

$mpdf = new mPDF();


$mpdf->WriteHTML($html);

//save the file put which location you need folder/filname
$mpdf->Output("groupeventhistorypage.pdf", 'F');

//out put in browser below output function
//$mpdf->Output(); ?>



<script type="text/javascript">

function keyupsponsorfun() {

//alert();

var company= $("#sponsorTitle").val()

var Website = $("#sponsorWebsite").val()
var Price = $("#spsponsorPrice").val()
var category = $("#sponsorCategory").val()
var Description = $("#spsponsorDesc").val()
var sponsorImage = $("#sponsorImg").val()

//alert(category);
//alert(category.length);

if(company != "")
{
$('#sponsorTitle_error').text(" ");

}
if(Website != "")
{
$('#sponsorWebsite_error').text(" ");
}
if(Price != "" )
{
$('#spsponsorPrice_error').text(" ");

}
if(category.length != 0)
{
$('#sponsorCategory_error').text(" ");

}
if(Description != "")
{
$('#spsponsorDesc_error').text(" ");
}
if(sponsorImage != "")
{
$('#sponsorImg_error').text(" ");

}


}

</script>


<script type="text/javascript">

function keyupsponsorfun1() {

//alert();

var company= $("#sponsorTitle1").val()

var Website = $("#sponsorWebsite1").val()
var Price = $("#spsponsorPrice1").val()
var category = $("#sponsorCategory1").val()
var Description = $("#spsponsorDesc1").val()
//var sponsorImage = $("#sponsorImg1").val()

//alert(category);
//alert(category.length);

if(company != "")
{
$('#sponsorTitle_error1').text(" ");

}
if(Website != "")
{
$('#sponsorWebsite_error1').text(" ");
}
if(Price != "" )
{
$('#spsponsorPrice_error1').text(" ");

}
if(category.length != 0)
{
$('#sponsorCategory_error1').text(" ");

}
if(Description != "")
{
$('#spsponsorDesc_error1').text(" ");
}
/* if(sponsorImage != "")
{
$('#sponsorImg_error').text(" ");

}*/


}

</script>
</body>
</html>
