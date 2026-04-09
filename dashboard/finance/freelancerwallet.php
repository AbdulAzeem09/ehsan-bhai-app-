<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
require_once("../../univ/baseurl.php" );
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "dashboard/";
include_once ("../authentication/check.php");

}else{
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");
//print_r($_SESSION);
// die('=====');
$pageactive = 100;
// background color


$als = new _allSetting;
$query = $als->showBanner(20);
if ($query) {
$row = mysqli_fetch_assoc($query);
$home_banner = $row['spSettingBanner'];
}
// get color code of store
$query2 = $als->showBanner(1);
if ($query2) {
$row2 = mysqli_fetch_assoc($query2);
$store_clr = $row2['spSettingMainClr'];
$store_btn_clr = $row2['spSettingBtnClr'];
}
//FREELANCE COLOR
$query3 = $als->showBanner(5);
if ($query3) {
$row3 = mysqli_fetch_assoc($query3);
$freelance_clr = $row3['spSettingMainClr'];
}
//JOB BOARD COLOR
$query4 = $als->showBanner(2);
if ($query4) {
$row4 = mysqli_fetch_assoc($query4);
$jobboard_clr = $row4['spSettingMainClr'];
}
//REAL ESTATE COLOR
$query5 = $als->showBanner(3);
if ($query5) {
$row5 = mysqli_fetch_assoc($query5);
$realEstate_clr = $row5['spSettingMainClr'];
}
// EVENTS COLOR
$query6 = $als->showBanner(9);
if ($query6) {
$row6 = mysqli_fetch_assoc($query6);
$event_clr = $row6['spSettingMainClr'];
}
// ART GALLERY COLOR
$query7 = $als->showBanner(13);
if ($query7) {
$row7 = mysqli_fetch_assoc($query7);
$photo_clr = $row7['spSettingMainClr'];
}
// MUSIC COLOR
$query8 = $als->showBanner(14);
if ($query8) {
$row8 = mysqli_fetch_assoc($query8);
$music_clr = $row8['spSettingMainClr'];
}
// VIDEOS COLOR
$query9 = $als->showBanner(10);
if ($query9) {
$row9 = mysqli_fetch_assoc($query9);
$videos_clr = $row9['spSettingMainClr'];
}
// TRAININGS COLOR
$query10 = $als->showBanner(8);
if ($query10) {
$row10 = mysqli_fetch_assoc($query10);
$train_clr = $row10['spSettingMainClr'];
}
// CLASIFIED ADD COLOR
$query11 = $als->showBanner(7);
if ($query11) {
$row11 = mysqli_fetch_assoc($query11);
$clasifiedAdd_clr = $row11['spSettingMainClr'];
}
// BUSINESS DIRECTORY ADD COLOR
$query12 = $als->showBanner(19);
if ($query12) {
$row12 = mysqli_fetch_assoc($query12);
$busDirctry_clr = $row12['spSettingMainClr'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../../component/f_links.php');?>
<!--This script for posting timeline data End-->
<!-- custom page script -->
<?php include('../../component/dashboard-link.php'); ?>

<script src="<?php echo $BaseUrl; ?>/assets/admin/js/mainchart.js"></script>
<link href="http://api.highcharts.com/highcharts">

<style type="text/css">
.bg-store {
background: #8cf6ba;
}

.bg-freelance {
background: rgba(255,215,190);
}
.bg_jobboard{
background-color: <?php echo $jobboard_clr; ?>;
}
.bg_realestate{
background-color: <?php echo $realEstate_clr; ?>;
}

.bg_artgallery{
background-color: <?php echo $photo_clr; ?>;
}
.bg_music{
background-color: <?php echo $music_clr; ?>;
}
.bg_video{
background-color: <?php echo $videos_clr; ?>;
}
.bg_training{
background-color: <?php echo $train_clr; ?>;
}
.bg_clasifidedads{
background-color: <?php echo $busDirctry_clr; ?>;
}
.bg_business{
background-color: <?php echo $clasifiedAdd_clr; ?>;
}
.bg_groups{
background-color: <?php echo $busDirctry_clr; ?>;
}
.tagLine-max-char {

font-size: smaller;
font-weight: 600;

}
.panel-footer > a {
color: #000;
text-transform: uppercase;
text-decoration: none;
padding: 10px 10px;
font-size: 20px;
font-weight: bolder;
}
.bg-event {
background: #ff8ab8;
}
.panel-body {
width: 320px;
border-radius: 25px 25px 0 0;
border: 1px solid;
box-shadow: rgb(0 0 0 / 24%) 0 3px 8px;
}
.border-event {
border-color: #ff8ab8;
}
.panel-footer {
width: 320px;
box-shadow: rgb(0 0 0 / 24%) 0 3px 8px;
border-radius: 0 0 25px 25px;
text-align: center;
}
.border-freelance {
border-color: rgba(255,215,190);
}
.border-store {
border-color: rgb(140,246,186); 
}

.bg_events:hover{color:#000}
.rightContent{
background-color:#fff; 
}
.sidebar {
padding-bottom:125px;
}
</style>
<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
</head>
<body class="bg_gray" onload="pageOnload('details')">
<?php

include_once("../../header.php");
?>

<section class="">
<div class="container-fluid no-padding">


<div class="row">
<!-- left side bar -->
<div class="col-md-2 no_pad_right">
<?php include('../../component/left-dashboard.php'); ?>

</div>
<div class="col-md-10 no_pad_left">
<div class="rightContent">

<div class="row text-center">
<h2>My Earnings - Freelancer Module</h2>
</div>
<?php 
$u = new _spuser;

$p_result = $u->isPhoneVerify($_SESSION['uid']);

if ($p_result == False) { ?> 
<span style="font-size:13px;"><a  href="<?php echo $BaseUrl.'/dashboard/finance/finance.php'; ?>"><i class="fa fa-arrow-left"></i> Return to My Finance Homepage</a></span>
<div class="notificatontop">
<p class="no-margin" >
<i class="fa fa-info-circle"></i>Your Mobile Number Is Not Verified. Kindly Verifiy Your Mobile Number.

<a href="#" data-toggle="modal" data-target="#mynumberVerify" >Verify Now.</a>
<!--<span>&nbsp;|&nbsp;</span>
<a href="<?php echo $BaseUrl; ?>/authentication/resend.php?sendby=sms&code=<?php echo $_SESSION['uid']; ?>">Resend Code To Phone</a>-->

<?php
if (isset($_SESSION['msg']) && $_SESSION['count'] == 1) {
?><span class="pull-right"><?php echo $_SESSION['msg']; ?></span> <?php
$_SESSION['count'] = 2;
unset($_SESSION['msg']);
}
?>
</p>
</div>
<?php } ?>


<div class="content">
<div class="row">
<div class="row">

<?php 
$u = new _spuser;

$p_result = $u->isPhoneVerify($_SESSION['uid']);

if ($p_result) { 

$w= new _orderSuccess;
$module = "event";						 
$res1 = $w->readREstatus($_SESSION['uid'],$module);
if($res1!= True){ 
?> 



<button type="button" class="btn btn-primary pull-right btn-border-radius" data-toggle="modal" data-target="#exampleModal" style="margin-right:35px">
Withdraw Amount
</button>
</div>
<?php }} ?>	 

<?php  

//echo $_SESSION['uid'];die;
$oi= new _spcustomers_basket;
$oid= $oi->readfromwallet1($_SESSION['uid']);
//echo $_SESSION['uid'];

if($oid!=false){
//$amount=0;
while($r=mysqli_fetch_assoc($oid)){
//print_r($r);

$amount1+=$r['amount'];

}}?>

<?php  
$module = "freelancer";
$w= new _orderSuccess;
$res= $w->readid($_SESSION['uid'],$module); 
//var_dump($res);
if($res!=false){ 
//$amount=0;
while($ra=mysqli_fetch_assoc($res)){
//print_r($ra);

$amount2+=$ra['amount'];
//$dated = $ra['date'];
//echo $dated;
if($amount2==0)
{
$amount2=0;
}
}
//echo $amount2;
$amount3 = ($amount1 - $amount2);
}

//echo $amount3.'======';

?>

<?php    
//echo $_SESSION['uid'];
$sp= new _spuser;
$result = $sp->readcurrency($_SESSION['uid']);

if($result!=false){ 

while($row_n=mysqli_fetch_assoc($result)){


$currency=$row_n['currency'];


}
}

?>

<br>
<div class="row">
<div class="col-md-4">
<div class="panel" style="margin-left:10px;">
<div class="panel-body border-event">
<div class="small-box bg_events">
<div class="inner">
<h3><?php  if($amount1 > 0 ){ echo $currency.' '.$amount1; }else{ echo $currency.' '.'0' ; } ?></h3>
</div>

<div class="icon">
<i class="fa fa-dollar"></i>
</div>
</div>
</div>
<div class="panel-footer bg-event">
<a>Lifetime Sale </a>
</div>
</div>
</div>




<div class="col-md-4">
<div class="panel">
<div class="panel-body border-freelance">
<div class="small-box bg_events">
<div class="inner">
<h3><?php $amut=0;  if($amount2){  echo $currency.' '.$amount2; } else { echo $currency.' '.$amut;} ?></h3>
</div>

<div class="icon">
<i class="fa fa-dollar"></i>
</div>
</div>
</div>
<div class="panel-footer bg-freelance">
<a>Total Withdrawal </a>
</div>
</div>
</div>

<div class="col-md-4">
<div class="panel">
<div class="panel-body border-store">
<div class="small-box bg_events">
<div class="inner">
<h3><?php  if($amount3) {echo $currency.' '.$amount3; } else {  echo $currency.' '.'0'; }

?></h3>
</div>

<div class="icon">
<i class="fa fa-dollar"></i>
</div>
</div>
</div>
<div class="panel-footer bg-store">
<a>Total Amount left</a>
</div>
</div>
</div>


</div>
<div class="box box-success">
<div class="box-header">

</div><!-- /.box-header -->
<div class="box-body">



<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<div class="table-responsive" style="overflow-x:hidden;">
<table class="table table-striped "  class="table table-striped table-bordered dashServ display" id="example" >
<thead>
<tr>
<th  class="text-center">Buyer name</th>
<th  class="text-center">Buyer name</th>
<th  class="text-center">Amount</th>
<th  class="text-center">Transaction ID</th>
<th  class="text-center">Date</th>



</tr>
</thead>
<tbody>
<?php
$userid=$_SESSION['uid'];


$pw = new _milestone;

$result = $pw->readfreelancer($userid);

if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {

$buyer_userid =$row['buyer_userid'];

$c= new _orderSuccess;
$currency= $c->readcurrency($buyer_userid);
$res1= mysqli_fetch_assoc($currency);
$curr=$res1['currency'];

$pf = new _spprofiles;
$result1 = $pf->profileforresume($buyer_userid);
$row1 = mysqli_fetch_assoc($result1);
//print_r($row1);die('=====');

?><tr>
<td></td>

<td class="text-center "><span class="smalldot"><a href="<?php echo $BaseUrl ?>/friends/?profileid=<?php echo $row1['idspProfiles']?>"><?php echo ucfirst($row1['spProfileName']); ?></a></span></td>
<td class="text-center "><span class="smalldot"><?php echo $curr.' '.$row['amount']; ?></span></td>
<td   class="text-center "><span class="smalldot"><?php echo $row['balanceTransaction']; ?></span></td>
<td class="text-center "><span class="smalldot"><?php echo $row['date_txn']; ?></span></td>
<!-- <td class="tchext-center">
<?php echo "<img src='/dashboard/portfolio/image/".$row['spImg']."' alt='image' width='40' height='40' />";?>

</td>-->
<!--<td   class="text-center "><span class="smalldot"><?php  if($row['status']==0) { echo 'hold'; } else { echo 'done'; } ?></span></td>-->



</tr>
<?php
// $i++
}
}
?>


</tbody>
</table>

</div>                                             
</div>

</div>
</div>

<?php 
if(isset($_POST['submit']))
{

$apikey = '6ad1c2c05c818bb3475c';
//echo $curr;
$amount=$_POST['amount'];
$from_currency = $curr;
$to_currency='USD';
//die('aaaaa');


$from_Currency = urlencode($from_currency);
$to_Currency = urlencode($to_currency);
$query =  "{$from_Currency}_{$to_Currency}";

// change to the free URL if you're using the free version

$json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey=6ad1c2c05c818bb3475c");

//$json = file_get_contents("https://api.currconv.com/api/v7/convert?q=INR_CAD&compact=ultra&apiKey=6ad1c2c05c818bb3475c");
$obj = json_decode($json, true);

$val = floatval($obj["$query"]);


$total = $val * $amount;
number_format($total, 2, '.', '');
// print_r($_POST);
//
$uid=$_SESSION['uid'];
$pid=$_SESSION['pid'];

$arr=array("user_id"=>$uid,
"userprofile_id"=>$pid,
"amount"=>$_POST['amount'],
"module"=>$_POST['freelancer'],
"spBankusername"=>$_POST['spBankusername'],
"spBankname"=>$_POST['spBankname'],
"spBanknumber"=>$_POST['spBanknumber'],
"spBranchnumber"=>$_POST['spBranchnumber'],
"spAccountnumber"=>$_POST['spAccountnumber'],
"spBankcode"=>$_POST['spBankcode'],
"date"=> date('Y-m-d H:i:s'),
"converted_currency"=>$total

);	


$w= new _orderSuccess;
$wa= $w->createwithdrawalstore($arr);

}		 

?>

<?php

$w= new _orderSuccess;
$module='freelancer';
$res1 = $w->readREstatus($_SESSION['uid'],$module);
if($res1!= True){  ?>
<?php } else{ 

while($r2 = mysqli_fetch_assoc($res1)){
//print_r($r2);
$dated = $r2['date'];
//echo $dated;
}
?>

<div class="alert alert-warning" role="alert">
You Already Request Withdraw on (date <?php echo $dated; ?>) Please wait !
</div>



<?php } ?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Withdrawal Request</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form action="" method="post">

<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">

<input type="hidden" name="freelancer" value="freelancer"> 
<label for="spBankusername" class="control-label">Amount<span class="red">*</span></label>
<input class="form-control" type="number" min="50" max="<?php if($amount3) {echo $amount3; } else {  echo $amount1; }?>" placeholder="Minimum 50 - Maximum <?php if($amount3) {echo $amount3; } else {  echo $amount1; }?>" name="amount" required>
</div></div><br>	   
<?php
$uid = $_SESSION['uid'];
$b = new _spbankdetail;
$data = $b->read($uid);
if($data!=false){
$row = mysqli_fetch_array( $data );
}
//print_r($row);	
?>

<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
<div class="form-group">
<input type="hidden" name="spProfile_idspProfile" id="spProfile_idspProfile" value="<?php echo $pid; ?>">
<input type="hidden" id="uid" name="uid" value="<?php echo $uid;?>">
<label for="spBankusername" class="control-label">Name of Account Holder <span class="red">*</span></label>
<input type="text" class="form-control" id="spBankuser" name="spBankusername" value="<?php echo $row['spBankusername'];?>" required>
<span id="spBankuser_error" style="color:red;"></span>
</div>
</div>
</div>
<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
<div class="form-group">
<label for="spBankname" class="control-label">Bank Name<span class="red">*</span></label>
<input type="text" class="form-control" id="spBankname" name="spBankname" value="<?php echo $row['spBankname'];?>" required>
<span id="spBankname_error" style="color:red;"></span>
</div>
</div>
</div>
<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
<div class="form-group">
<label for="spBankusername" class="control-label">Bank Number <span class="red">*</span></label>
<input type="text" class="form-control" id="spBanknumber" name="spBanknumber" value="<?php echo $row['spBanknumber'];?>" required>
<span id="spBanknumber_error" style="color:red;"></span>
</div>
</div>
</div>
<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
<div class="form-group">
<label for="spBankname" class="control-label">Branch Number<span class="red">*</span></label>
<input type="text" class="form-control" id="spBranchnumber" name="spBranchnumber" value="<?php echo $row['spBranchnumber'];?>" required>
<span id="spBranchnumber_error" style="color:red;"></span>
</div>
</div>
</div>


<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
<div class="form-group">
<label for="spAccountname" class="control-label">Account Number <span class="red">*</span></label>
<input type="text" class="form-control" maxlength="18" id="spAccountnumber" name="spAccountnumber" value="<?php echo $row['spAccountnumber'];?>" required>
<span id="spAccountnumber_error" style="color:red;"></span>
</div>
</div>
</div>
<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
<div class="form-group">
<label for="spBankcode" class="control-label">IFSC Code<span class="red">*</span></label>
<input type="text" class="form-control" maxlength="11" id="spBankcode" name="spBankcode" value="<?php echo $row['spBankcode'];?>" required>
<span id="spBankcode_error" style="color:red;"></span>
</div>
</div>


</div>


<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
<button type="submit" name="submit" class="btn btn-primary btn-border-radius">Save changes</button>
</form>
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

<!-- ChartJS 1.0.1 -->


<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php 
include('../../component/f_footer.php');
include('../../component/f_btm_script.php'); 
?>

<!-- <script type="text/javascript">


$(document).ready(function(e){

$(".mynewModalclass").on("click", function () {

//  alert();

var session_id = '<?php echo $_SESSION['uid'];?>';

//  alert(session_id);

//  e.preventDefault();
$.ajax({
type: 'POST',
url: 'verifywithdraw.php',
data: {'userid': session_id},

success: function(data){ 

//console.log(data);
$("#mynewverifyModal").modal("show");

}
});
});
});

</script> -->




<!-- Sky Icons -->



<!-- OTHER DASHBOARD STORE DETAIL -->
<!-- Morris.js charts -->

<!-- ALL DASHBOARD GRAPHS -->


<!-- END -->

</body>	
</html>
<?php
}
?>

<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
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

