<?php

/*error_reporting(E_ALL);
ini_set('display_errors', 'On');*/
require_once("../../univ/baseurl.php");
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "dashboard/";
include_once("../../authentication/islogin.php");
} else {
function sp_autoloader($class)
{
include '../../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");

$pageactive = 35;
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php include('../../component/f_links.php'); ?>
<!-- ===========DSHBOARD LINKS================= -->
<?php include('../../component/dashboard-link.php'); ?>
<!-- ===========PAGE SCRIPT==================== -->

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

</head>
<style>
.leftDashboard {
background-color: #dda0dd;
height: 1000px;
}
.mouduleshow tr td:nth-child(2) {
text-align: inherit!important;
}
</style>

<body class="bg_gray">
<?php

include_once("../../header.php");
?>

<section class="">
<div class="container-fluid no-padding">
<div class="row">
<!-- left side bar -->
<div class="col-md-2 no_pad_right">
<?php
include('../../component/left-dashboard.php');
?>
</div>
<!-- main content -->
<div class="col-md-10 no_pad_left">
<div class="rightContent">

<!-- breadcrumb -->
<section class="content-header">
<h1>Module Menu Show</h1>
<ol class="breadcrumb">
<li><a href="<?php echo $BaseUrl . '/dashboard'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Module Menu Show</li>
</ol>
</section>

<div class="content">
<div class="row">
<div class="col-sm-12">
<div class="box box-success">
<div class="box-header">

</div><!-- /.box-header -->
<div class="box-body">
<input type="hidden" name="spProfile_idspProfile" id="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
<input type="hidden" name="spUser_idspUser" id="spUser_idspUser" value="<?php echo $_SESSION['uid']; ?>">
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<table  id="example1" class="table borderless mouduleshow">
<thead>
<tr>
<th></th>
<th>Module</th>
<th >Active / In-Active</th>
</tr>
</thead>
<?php if ($_SESSION['guet_yes'] != 'yes') { ?>

<tbody>
<?php
$p = new _spAllStoreForm;
$result = $p->readAllModuleShow(
$_SESSION['pid'],

$_SESSION['uid']

);

if ($result) {
//print_r($result);  
// die("ss");
$row = mysqli_fetch_assoc($result);

$stores = $row['stores'];
$freelance = $row['freelance'];
$jobboard = $row['jobboard'];
$rental= $row['rental'];
$realestate= $row['realestate'];
$event = $row['event'];
$artandcraft = $row['artandcraft'];
$videos = $row['videos'];
$trainings = $row['trainings'];
$classified_ads = $row['classified_ads'];
$my_business_space = $row['my_business_space'];
$news_views = $row['news_views'];
$business_for_sale = $row['business_for_sale'];
$nft = $row['nft'];
$dating = $row['dating'];
$timeline = $row['timeline'];
$fund_raising = $row['fund_raising'];
$directory = $row['directory'];
$business = $row['business'];
$consultation = $row['consultation'];
$invoicing = $row['invoicing'];

} else {
    
$stores = "";
$freelance = "";
$jobboard = "";
$rental= "";
$realestate= "";
$event = "";
$artandcraft = "";
$videos = "";
$trainings = "";
$classified_ads = "";
$my_business_space = "";
$news_views = "";
$business_for_sale = "";
$nft = "";
$dating = "";
$timeline = "";
$fund_raising = "";
$directory = "";
$business = "";
$consultation = "";
$invoicing = "";
}
?>

<tr>
<td></td> 
<!--<td>Group</td>-->
<!--<td><input style="transform: scale(1.3);" type="checkbox" id="" class="moduleshow" data-mod="17" name="group" --><?php //echo ($groups == 0) ? 'checked' : ''; ?><!-- data-toggle="toggle"></td>-->
</tr>

<tr>
<td></td>
<td>Freelancer</td>
<td><input style="transform: scale(1.3);" type="checkbox" id="" class="moduleshow" data-mod="1" name="freelance" <?php echo ($freelance == 0) ? 'checked' : ''; ?> data-toggle="toggle"></td>
</tr>
<tr>
<td></td>
<td>Networking</td>
<td><input style="transform: scale(1.3);" type="checkbox" id="" class="moduleshow" data-mod="2" name="networking" <?php echo ($networking == 0) ? 'checked' : ''; ?> data-toggle="toggle"></td>
</tr>
<tr>
<td></td>
<td>Wholesale</td>
<td><input style="transform: scale(1.3);" type="checkbox" id="" class="moduleshow" data-mod="3" name="wholesale" <?php echo ($wholesale == 0) ? 'checked' : ''; ?> data-toggle="toggle"></td>
</tr>
<tr>
<td></td>
<td>Real Estate</td>
<td><input style="transform: scale(1.3);" type="checkbox" id="" class="moduleshow" data-mod="4" name="realestate" <?php echo ($realestate == 0) ? 'checked' : ''; ?> data-toggle="toggle"></td>
</tr>
<tr>
<td></td>
<td>Videos</td>
<td><input style="transform: scale(1.3);" type="checkbox" id="" class="moduleshow" data-mod="5" name="videos" <?php echo ($videos == 0) ? 'checked' : ''; ?> data-toggle="toggle"></td>
</tr>
<tr>
<td></td>
<td>Jobs</td>
<td><input style="transform: scale(1.3);" type="checkbox" id="" class="moduleshow" data-mod="6" name="jobboard" <?php echo ($jobboard == 0) ? 'checked' : ''; ?> data-toggle="toggle"></td>
</tr>
<tr>
<td></td>
<td>NFT Marketplace</td>
<td><input style="transform: scale(1.3);" type="checkbox" id="" class="moduleshow" data-mod="7" name="nftmarketplace" <?php echo ($jobboard == 0) ? 'checked' : ''; ?> data-toggle="toggle"></td>
</tr>
<tr>
<td></td>
<td>Traning</td>
<td><input style="transform: scale(1.3);" type="checkbox" id="" class="moduleshow" data-mod="8" name="traning" <?php echo ($jobboard == 0) ? 'checked' : ''; ?> data-toggle="toggle"></td>
</tr>
<tr>
<td></td>
<td>Portfolio</td>
<td><input style="transform: scale(1.3);" type="checkbox" id="" class="moduleshow" data-mod="9" name="portfolio" <?php echo ($jobboard == 0) ? 'checked' : ''; ?> data-toggle="toggle"></td>
</tr>
<tr>
<td></td>
<td>Dating</td>
<td><input style="transform: scale(1.3);" type="checkbox" id="" class="moduleshow" data-mod="10" name="dating" <?php echo ($jobboard == 0) ? 'checked' : ''; ?> data-toggle="toggle"></td>
</tr>
<tr>
<td></td>
<td>Event</td>
<td><input style="transform: scale(1.3);" type="checkbox" id="" class="moduleshow" data-mod="11" name="event" <?php echo ($jobboard == 0) ? 'checked' : ''; ?> data-toggle="toggle"></td>
</tr>
<tr>
<td></td>
<td>Fund Rsing</td>
<td><input style="transform: scale(1.3);" type="checkbox" id="" class="moduleshow" data-mod="12" name="fundraising" <?php echo ($jobboard == 0) ? 'checked' : ''; ?> data-toggle="toggle"></td>
</tr>
<tr>
<td></td>
<td>Jobs</td>
<td><input style="transform: scale(1.3);" type="checkbox" id="" class="moduleshow" data-mod="13" name="jobboard" <?php echo ($jobboard == 0) ? 'checked' : ''; ?> data-toggle="toggle"></td>
</tr>

<tr>
<td></td>
<td>Directory</td>
<td><input style="transform: scale(1.3);" type="checkbox" id="" class="moduleshow" data-mod="14" name="directory" <?php echo ($event == 0) ? 'checked' : ''; ?> data-toggle="toggle"></td>
</tr>
<tr>
<td></td>
<td>Business Space</td>
<td><input style="transform: scale(1.3);" type="checkbox" id="" class="moduleshow" data-mod="15" name="business" <?php echo ($fund == 0) ? 'checked' : ''; ?> data-toggle="toggle"></td>
</tr>

<tr>
<td></td>
<td> Consultation</td>
<td><input style="transform: scale(1.3);" type="checkbox" id="" class="moduleshow" data-mod="16" name="consultation" <?php echo ($classified_ads == 0) ? 'checked' : ''; ?> data-toggle="toggle"></td>
</tr>
<tr>
<td></td>
<td> Stores</td>
<td><input style="transform: scale(1.3);" type="checkbox" id="" class="moduleshow" data-mod="17" name="stores" <?php echo ($consultation == 0) ? 'checked' : ''; ?> data-toggle="toggle"></td>
</tr>
<tr>
<td></td>
<td>News Views</td>  
<td><input style="transform: scale(1.3);" type="checkbox" id="" class="moduleshow" data-mod="18" name="news" <?php echo ($directory == 0) ? 'checked' : ''; ?> data-toggle="toggle"></td>
</tr>

</tbody> <?php }


?>
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




<?php include('../../component/f_footer.php'); ?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../../component/f_btm_script.php'); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
var table = $('#example').DataTable({
paging: true, // Enable pagination
select: false,
columnDefs: [{
className: "Name",
targets: [0],
visible: false,
searchable: false
}]
});

$('#example tbody').on('click', 'tr', function() {
// Handle row click event here
});
});
</script> 
<script>
$('.moduleshow').change(function() {
var pid = $("#spProfile_idspProfile").val();
var uid = $("#spUser_idspUser").val();
var mod = $(this).attr("data-mod");
//console.log(mod);
if ($(this).is(":checked")) {
//alert('=====if===');
$.post("loadmodule.php", {
pid: pid,
uid: uid,
mod: mod,
show: '0'
}, function (data) {
//console.log(data);
});
} else {
$.post("loadmodule.php", {
pid: pid,
uid: uid,
mod: mod,
show: '1'
}, function (data) {
//console.log(data);
});
} 
});
</script>
</body>

</html>
<?php
} ?>