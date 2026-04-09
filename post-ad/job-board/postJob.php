
<?php

include('../../univ/baseurl.php');
session_start();
include '../../common.php';
unset($_SESSION['post_ad_url']);
// print_r($_SESSION);die;
if($_SESSION['ptid'] == 1){
   
if(!isset($_SESSION['pid'])){
    
    $_SESSION['afterlogin']="job-board/";
    include_once ("../../authentication/islogin.php");

}else{
    
    function sp_autoloader($class){
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");


    $_GET["categoryid"] = "2";
    $_GET["categoryname"] = "Job Board";


    $u = new _spuser;
    $res = $u->read($_SESSION["uid"]);
    if($res != false){
        $ruser = mysqli_fetch_assoc($res);
        $usercountry = $ruser["spUserCountry"];
        $userstate = $ruser["spUserState"];
        $usercity = $ruser["spUserCity"];
        $usercountry1 = $ruser["spUserCountry"];
        $userstate1 = $ruser["spUserState"];
        $usercity1 = $ruser["spUserCity"];
    }

    // if($_SESSION['ptid'] == 1){
    //    $f= new _spuser;
       
    //     $fil = $f->read1($_SESSION['pid']);
    //     //print_r($fil);die("================");
    //     if($fil){
    //         $r=mysqli_fetch_assoc($fil);
    //         //print_r($r); die("-----------------"); 
    //         $pid=$r['sp_pid'];
    //         //echo $pid;die('====');
    //         if($r['status']!=2){
    //             header("Location: $BaseUrl/job-board/dashboard/?msg=notverified");
    //         }
    //     }else{
                                                                            
    //         header("Location: $BaseUrl/job-board/dashboard/?msg=notverified");
    //     }
    // }


    $postid = isset($_GET["postid"]) ? (int) $_GET["postid"] : "";


    if ($postid !== "") {
        $p = new _jobpostings;
        $pf  = new _postfield;
        $r = $p->read($postid);
        $cp = $r->num_rows;
        if($cp == false){

            header("Location: $BaseUrl/job-board/dashboard/index.php?msg=notacess");
        }


        if ($r != false) {
            while ($row = mysqli_fetch_assoc($r)) {
            $spProfiles_idspProfiles = $row["spProfiles_idspProfiles"];

            if($_SESSION['pid'] != $spProfiles_idspProfiles){

                header("Location: $BaseUrl/job-board/dashboard/index.php?msg=notacess");
            }


            }
        }
    }

    if(isset($_POST["Change_Current_Location"])){
        session_start();	


        $_SESSION["Countryfilter"] = $_POST['spPostingsCountry'];
        $_SESSION["Statefilter"] = $_POST['spPostingsState'];
        $_SESSION["Cityfilter"] = $_POST['spPostingsCity'];
        //echo $_SESSION["Countryfilter"];
        //echo $_SESSION["Statefilter"];
        //echo $_POST['spUserState'];
        //echo $_SESSION["Cityfilter"];
        //die('============');

        //unset($_SESSION['Products']);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="The SharePage">
<meta name="author" content="">
<title>The SharePage</title>
<!--Bootstrap core css-->
<link href="<?php echo $BaseUrl; ?>/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="<?php echo $BaseUrl; ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo $BaseUrl; ?>/assets/css/custom.css" rel="stylesheet" type="text/css">
<link href="<?php echo $BaseUrl; ?>/assets/css/responsive.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

<link rel="icon" href="<?php echo $BaseUrl.'/assets/images/logo/tsp_trans.png'?>" sizes="16x16" type="image/png">



<!--Font awesome core css-->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/css/style.css">
<link href="<?php echo $BaseUrl; ?>/assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $BaseUrl; ?>/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!--custom css jis ki wja say issue ho rha tha form submit main-->
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>

<!-- <script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script> -->
<?php
$abc=2;
?>
<script src="<?php echo $BaseUrl; ?>/assets/js/posting/job-board.js?v=<?php echo $abc; ?>"></script>

<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.core.min.css">
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.default.min.css">
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.lite.min.css">
<script src="<?php echo $BaseUrl; ?>/assets/js/alert.min.js"></script>

<!-- DATE AND TIME PICKER -->
<link href="<?php echo $BaseUrl; ?>/assets/css/date-time/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/sweetalert.css">
<script src="<?php echo $BaseUrl; ?>/assets/js/sweetalert-dev.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/sweetalert.min.js"></script>
<!--post group button on btm of the form-->
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/jquery-ui.min.css">
<!--NOTIFICATION-->
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>

<!-- skills added typehead -->
<link href="<?php echo $BaseUrl;?>/assets/css/token_field/tokenfield-typeahead.css" type="text/css" rel="stylesheet">
<link href="<?php echo $BaseUrl;?>/assets/css/token_field/bootstrap-tokenfield.css" type="text/css" rel="stylesheet">
<!-- SALARY ONLY NUMBER VALUE RECEIVED -->
<style>
input#spPostingExperience_ {
width: 150px;
}
.header_jobBoard {
background-color: #1f3060;
padding: 0px 10px 5px;
}

.swal2-popup {

font-size: 13px!important;
}
.caret1{
display: inline-block;
width: 0;
height: 0;
margin-left: 2px;
vertical-align: middle;
border-top: 4px dashed;
border-top: 4px solid\9;
border-right: 4px solid transparent;
border-left: 4px solid transparent;
margin-left: 6px!important;
}
#caret1{color: #0c0b0b!important;}
#profiles .caret {color: #0c0b0b!important;}
#profileDropDown li.active {
background-color: #1f3060;
margin-top: -1px;
}
#profileDropDown li.active a {
color: #fff;
}

.butn_draf {
    color: #fff;
    border-radius: 5px;
    background-color: #337ab7 !important;
    font-size: 14px;
    min-width: 127px;
}
.modal-title {
    font-family: Marksimon;
    font-size: 22px !important;
}
.modal-header{
    text-align:left !important; 
}
.modal-dialog .cntry_clm_2{
    text-align:left;
display: grid;
    column-gap: 17px;
    row-gap: 10px;
    grid-template-columns: repeat(2, 1fr);
}
.modal-dialog .cntry_clm_4{
    text-align:left;
display: grid;
    column-gap: 17px;
    row-gap: 10px;
    grid-template-columns: repeat(3, 1fr);
}
</style>
<script type="text/javascript">
$(function() {
// salary start
$('#spPostingSlryRngFrm_').keypress(function(event){
    
if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
event.preventDefault(); //stop character from entering input
}
});
// salary end
$('#spPostingSlryRngTo_').keypress(function(event){
if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
event.preventDefault(); //stop character from entering input
}
});
});

$(document).ready(function(){

    $("#spPostingSlryRngTo_").keyup(function(){
   var aa1 = parseInt($("#spPostingSlryRngFrm_").val()); 
   var bb1 = parseInt($("#spPostingSlryRngTo_").val()); 
   
   if(bb1 < aa1){
    //    alert("hello");
       $("#great11").html('  Enter Greater Value');
   }else{
    $("#great11").html('');
   }
});

});
</script>
<!-- =======END====== -->
<?php
$urlCustomCss = $BaseUrl.'/component/custom.css.php';
include $urlCustomCss;
?>
</head>
<body onload="pageOnload('post')" class="bg_gray">
<?php

$header_jobBoard = "header_jobBoard";
include_once("../../header.php");
$p = new _spprofiles;
$rp = $p->readProfiles($_SESSION['uid']);
$res = $p->readprofilepic(1,$_SESSION['uid']);
if ($res != false){
$r = mysqli_fetch_assoc($res);
//print_r($res);
$name = $r['spProfileName'];
$icon = $r['spprofiletypeicon'];


}
/////////////////////
$p = new _spprofiles;

$res = $p->read($_SESSION['pid']);
if ($res != false){

$r = mysqli_fetch_assoc($res);
//echo "<pre>";
//print_r($r);
$name = ucwords(strtolower($r['spProfileName']));
$icon = $r['spprofiletypeicon'];
$spdate_created = $r['spdate_created'];
$Date =  $spdate_created;
$date1=  strtotime($Date);

$date2 =  date('Y-m-d H:i:s');
$date3= strtotime($date2);
//echo $date1."<br>".$date3; 



$datediff = $date3  -  $date1;  
//echo "<br>";
$final_date = round($datediff / (60 * 60 * 24));
if(empty($postid)){
if($_SESSION['ptid'] == 1 ){
//	if(($final_date >= 90) ){ 



$pr= new _jobpostings;
$prf=$pr->businesspost($_SESSION['pid']);
$da=$prf->num_rows;
//echo $da;
if($da >= 5){

$mb = new _spmembership;
$result = $mb->readpid($_SESSION['pid']);



if($result != false){



while($rows = mysqli_fetch_assoc($result)){
//print_r($rows);
$payment_date = $rows["createdon"];
$duration=$rows['duration'];

/*$res = $mb->readmember($rows["membership_id"]);
if($res != false)
{ 
$row = mysqli_fetch_assoc($res);
//echo $row["spMembershipName"]."<br>";
//$count=$row["spMembershipPostlimit"]; 
$duration=$row["duration"];*/

//print_r($row);
$date7 =  date('Y-m-d H:i:s');
$date8=date('Y-m-d', strtotime($date7));
$date5= date('Y-m-d', strtotime($payment_date));	
$date6= date('Y-m-d', strtotime($payment_date. ' +'. $duration.' days'));
//echo  $date5."<br>".$date6."<br>".$date8; die;
if(!(($date5 <= $date8)  && ($date6 >=  $date8))){ ?>
<script>
//window.location.replace("/membership?msg=notaccess"); 
</script>

<?php   
}
//}
}
}
else {


$mb = new _spmembership;
$result_1 = $mb->read_job($_SESSION['pid']);
$num=0;
if($result_1){
$num= mysqli_num_rows($result_1);
}

if($num>=2){
    $fr= new _spuser;
    $readsp= $fr->readdataSp($_SESSION['pid']);
    if($readsp!=false){
    $rowsp=mysqli_fetch_assoc($readsp);
      $post_pay =$rowsp['post_pay'];
      $pidAdd =$rowsp['idspProfiles'];
      
    }
    if ($post_pay <= 0) {
      $_SESSION['post_ad_ulr']= $BaseUrl . '/post-ad/job-board/?post';


    ?>

?> 
<script>
window.location.replace("/membership/postmember_buy.php");
</script>
<?php
}
}
}
}
} 


}}

?>




<!--Modal-->
<div class="modal fade" id="addGroup" tabindex="-1" role="dialog" aria-labelledby="addGroupLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<form action="addgroup.php" method="post" id="sp-add-group">
<div class="modal-body">
<label for="existing-group" class="control-label">Existing Group</label>

<table class="table table-hover table-condensed">
<?php
$p = new _spgroup;
$rpvt = $p->read($_SESSION['pid']);
if ($rpvt != false){
while($row = mysqli_fetch_assoc($rpvt)) {
echo "<tr>";
echo "<td class='hidden'>" . $row['idspGroup'] . "</td>";
echo "<td>" . $row['spGroupName'] . "</td>";
echo "<td><a href='deleteGroup.php/?groupid=" . $row['idspGroup'] . "'> <span class='glyphicon glyphicon-trash pull-right' aria-hidden='true'> </a></td>";
echo "</tr>";
}
}
?>
</table>


<div class="form-group">
<label for="group-name" class="control-label">Create New Group</label>
<input class="dynamic-pid" type="hidden" name="pid_" value="<?php echo $_SESSION['pid']; ?>">
<input type="text" class="form-control" id="spGroupName" name="spGroupName" required>
</div>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-success btn-border-radius" id="spgroupSubmit">Add</button>
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
</div>
</form>
</div>
</div>
</div>
<!--Modal Complete-->
<div class="loadbox" >
<div class="loader"></div>
</div>
<section class="landing_page">
<div class="container">
<div class="row">

<div class="col-md-12  dashboard-section " style="background-color: #fff; border: 1px solid #ccc;margin-bottom: 10px;border-radius: 5px;width: 98%;margin-left: 14px;">
<?php
$title = 'Add Job';
$maintitle = 'JobBoard: POST A JOB';
if($_GET['exp']==1) {
$title = 'RE-POST';
$maintitle = 'JOB BOARD: EXPIRED JOB';
} else if($postid) {
$title = 'Edit Job';
$maintitle = 'JOB BOARD: ACTIVE JOB';
}
?>
<!-- <h3 style="margin-top: 10px!important;">JobBoard Module</h3> -->
<!--<h3 style="margin-top: 10px!important;"><?php echo $maintitle; ?></h3>-->

</div>



<div class="col-md-9">

<div class="row">
<div class="col-md-12">
<div class="about_banner">
<div class="top_heading_group jobHead">
<div class="row">
<div class="col-md-12">

<h3>
<i class="fa fa-pencil"></i> <?php echo $title; ?>
<a  href="<?php echo $BaseUrl.'/job-board/';?>"  style="color: #000;float:right ; color:white">&nbsp; | &nbsp;BACK TO HOME </a>
<a  href="<?php echo $BaseUrl.'/job-board/dashboard';?>" style="color: #000;float:right;color:white "> DASHBOARD  </a>
</h3>
</div>
</div>
</div>
<div class="event_form">
<!--  <div class="modTitle">
<h2>Module Name: <span>Job Board</span></h2>
</div> -->
<div class="">
<div class="">
<div >
<div class="row">
<!--<div class="col-md-6">
<div class="dropdown">
<div class="btn-group" role="group" aria-label="Basic example">
<button type="button" class="btn btn-primary" style="cursor:default;">Select Profile</button>
<button class="btn btn-default dropdown-toggle" type="button" id="profiles" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="<?php echo $icon; ?>"></span> <?php echo $name; ?><span id="caret1" class="caret1"></span></button>
<ul class="dropdown-menu"  id="profilesdd" aria-labelledby="profiles">
 <ul class="dropdown-menu" id="profileDropDown"  aria-labelledby="profiles">
<?php
$profile = new _spprofiles;
$res = $profile->categoryprofiles($_GET["categoryid"], $_SESSION['uid']);
//echo $profile->ta->sql;
if ($res != false) {
while ($row = mysqli_fetch_assoc($res)) {
//echo "<li><a href='#' class='profiledd' data-pid='".$row['idspProfiles']."' data-profileicon='".$row["spprofiletypeicon"]."'><span class='".$row["spprofiletypeicon"]."'></span> " .$row["spProfileName"]."</a></li>";

if (isset($picture)) {
echo "<li><a href='#' class='profiledd' data-pid='" . $row['idspProfiles'] . "' data-profileicon='" . $row["spprofiletypeicon"] . "'>

<img  alt='Profile Pic' class='img-rounded' style='width:40px; height:40px;' src=' " . ($row["spProfilePic"]) . "' ><span class='" . $row["spprofiletypeicon"] . "'></span> " . ucfirst($row["spProfileName"]) . "</a></li><hr>";
}else{

echo "<li><a href='#' class='profiledd' data-pid='" . $row['idspProfiles'] . "' data-profileicon='" . $row["spprofiletypeicon"] . "'>

<img  alt='Profile Pic' class='img-rounded' style='width:40px; height:40px;' src='../../img/default-profile.png' ><span class='" . $row["spprofiletypeicon"] . "'></span> " . ucfirst($row["spProfileName"]) . "</a></li><hr>";


}


$profilename = $row["spProfileName"];
$profilesid = $row["idspProfiles"];
$profilepicture = $row["spProfilePic"];
$country = $row["spProfilesCountry"];
$city = $row["spProfilesCity"];
$icon = $row["spprofiletypeicon"];
}
} else {
echo "<li role='separator' class='divider'></li>
<li id='myprofile'><a href='/my-profile/' id='sp-profile-register'>Add New Profile</a></li>";
}
?>
</ul>
</div>

<?php
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
} ?>
</div>

</div> -->
<div style="float:right">
<?php

$usercountry = $_SESSION["Countryfilter"];
$userstate = $_SESSION["Statefilter"];
$usercity = $_SESSION["Cityfilter"];

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
while ($row2 = mysqli_fetch_assoc($result2)) { //print_r($row2);
//die('===');
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
while ($row3 = mysqli_fetch_assoc($result3)) { //print_r($row3);
if(isset($usercity) && $usercity == $row3['city_id']){
$currentcity = $row3['city_title'];
$currentcity_id = $row3['city_id'];
}                                                                                                }                                                                                             }
}                                                      
;
?>
<!-- <p >
<small> <?php if($currentcity){
echo $currentcity.", ";
}
if($currentstate){
echo $currentstate.", ";
}
if($currentcountry){
echo $currentcountry;
}
?><br>
<a style="cursor:pointer;" data-toggle="modal" data-target="#myModal">Change Location</a>
</small>
</p> -->
</div>
<!-- <div class="col-md-6 profilepicture"> -->
<!--  <?php
$p = new _spprofiles;
$res = $p->readprofilepic(isset($_GET["profiletype"]), $_SESSION['uid']);

if ($res != false) {
$r = mysqli_fetch_assoc($res);
$picture = $r['spProfilePic'];
if (isset($picture)) {
echo "<img  alt='Profile Pic' class='img-responsive pull-right' style='width:60px; height:60px;' src=' " . ($picture) . "' ><br>";
} else
echo "<img  alt='Profile Pic' class='img-responsive pull-right' style='width:60px; height:60px;' src='../../img/default-profile.png' ><br>";

echo "<div class='pull-right' style='font-weight:700; padding-right:15px;color:#114B5F;'><span class='" . $r['spprofiletypeicon'] . "'></span> " . $r['spProfileName'] . "</div>";
$profileid = $r['idspProfiles'];
$country = $r["spProfilesCountry"];
$city = $r["spProfilesCity"];
}

elseif (isset($profilesid)) {
echo "<img  alt='Profile Pic' class='img-responsive pull-right' style='width:60px; height:60px;' src='" . (isset($profilepicture) ? " " . ($profilepicture) . "" : "../../img/default-profile.png") . "' ><br>";
echo "<div class='pull-right' style='font-weight:700;padding-right:15px;color:#114B5F;'><span class='" . $icon . "'></span> " . $profilename . "</div>";
}
?> -->
<!-- </div> -->

</div>
</div>
<div class="space"></div>
<div >
<?php
$profileid = "";
$eCountry = "";
$eCity = "";
$eCityID = "";
$eCategory = "";
$eSubCategoryID = "";
$eSubCategory = "";
$ePostTitle = "";
$ePostNotes = "";
$eExDt = "";
$ePrice = "";
$shipping = "";

if ($postid) {
$p = new _jobpostings;
$pf  = new _postfield;
$r = $p->read($postid);
if ($r != false) {
while ($row = mysqli_fetch_assoc($r)) {

/*print_r($row);*/
echo "<input type='hidden' id='postprofile' value='" . $row["idspProfiles"] . "'>";
$ePostTitle     = $row["spPostingTitle"];
$spPostingtext     = $row["spPostingtext"];
$ePostNotes     = $row["spPostingNotes"];

$eExDt          = $row["spPostingExpDt"];
$ePrice         = $row["spPostingPrice"];
$profileid      = $row['idspProfiles'];
$postingflag    = $row['spPostingsFlag'];
$taa           = $row['spPostingVisibility'];
//$phone          = $row['spPostingPhone'];
$shipping       = $row['sppostingShippingCharge'];
$eCountry       = $row['spUserCountry'];
$eCity          = $row['spPostingsCity'];

$closingdate    = $row2['spPostingClosing'];
$skill          = $row['spPostingSkill'];
$cmpnyName      = $row['spPostingCompany'];
$cmpnyDesc      = $row['spPostingCompanyDesc'];
$cmpnySize      = $row['spPostingCompanySize'];
$strtSalry      = $row['spPostingSlryRngTo'];
$endSalry       = $row['spPostingSlryRngFrm'];
$jobLevel       = $row['spPostingJoblevel'];
$noOfPosition   = $row['spPostingNoofposition'];
$jobType        = $row['spPostingJobType'];
$jobLoc         = $row['spPostingLocation'];
$jobAs          = $row['spPostingJobAs'];
$jobExp         = $row['spPostingExperience'];
$job_currency         = $row['job_currency'];
$posting_status         = $row['posting_status'];

$country11      = $row['spPostingsCountry'];
$state11      = $row['spPostingsState'];
$city11      = $row['spPostingsCity'];

$spPostingClosing      = $row['spPostingClosing'];


$usercountry = $row["spUserCountry"];
$userstate = $row["spUserState"];
$usercity = $row["spUserCity"];

$result_pf = $pf->read($row['idspPostings']);
//echo $pf->ta->sql."<br>";
if($result_pf){
/* $closingdate    = "";
$skill          = "";
$cmpnyName      = "";
$cmpnyDesc      = "";
$cmpnySize      = "";
$strtSalry      = "";
$endSalry       = "";
$jobLevel       = "";
$noOfPosition   = "";
$jobType        = "";
$jobLoc         = "";
$jobExp         = "";*/

while ($row2 = mysqli_fetch_assoc($result_pf)) {



/*      if($noOfPosition == ''){
if($row2['spPostFieldName'] == 'spPostingNoofposition_'){
$noOfPosition = $row2['spPostFieldValue'];
}
}
if($jobLoc == ''){
if($row2['spPostFieldName'] == 'spPostingLocation_'){
$jobLoc = $row2['spPostFieldValue'];
}
}
if($jobExp == ''){
if($row2['spPostFieldName'] == 'spPostingExperience_'){
$jobExp = $row2['spPostFieldValue'];
}
}
if($cmpnySize == ''){
if($row2['spPostFieldName'] == 'spPostingCompanySize_'){
$cmpnySize = $row2['spPostFieldValue'];
}
}
if($jobType == ''){
if($row2['spPostFieldName'] == 'spPostingJobType_'){
$jobType = $row2['spPostFieldValue'];
}
}
if($cmpnyDesc == ''){
if($row2['spPostFieldName'] == 'spPostingCompanyDesc_'){
$cmpnyDesc = $row2['spPostFieldValue'];
}
}
if($closingdate == ''){
if($row2['spPostFieldName'] == 'spPostingClosing_'){
$closingdate = new DateTime($row2['spPostFieldValue']);
}
}
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
$skill = $row2['spPostFieldValue'];
}
}
if($jobLevel == ''){
if($row2['spPostFieldName'] == 'spPostingJoblevel_'){
$jobLevel = $row2['spPostFieldValue'];
}
}*/

}
$postingDate = $p-> spPostingDate($row["spPostingDate"]);
}




}
}
}else{
//get compny Name
$c = new _profilefield;
$r = $c->read($_SESSION['pid']);
if($r){
$cmpnyName = '';
while ($row3 = mysqli_fetch_assoc($r)) {
if($cmpnyName == ''){
if($row3['spProfileFieldName'] == 'companyname_'){
$cmpnyName = $row3['spProfileFieldValue'];
}
}
}
}
}
?>
<div class="row">
<div class="col-md-12">
<!--<div class="page-header" style="margin-top: 10px;">-->
<?php   

$active= "-1";
?>








<input type="hidden" class="form-control" id="spPostingExpDtjob" name="spPostingExpDt" value="<?php echo $eExDt ?>">

<input type="hidden" class="form-control" id="sppostingvisibility" name="sppostingvisibility" value="<?php echo $taa ?>">

<form enctype="multipart/form-data" action="<?php echo $BaseUrl?>/post-ad/dopostjob.php" method="post" id="sp-form-post" name="postform">
<input type="hidden" id="postid" value="<?php echo $postid; ?>">
<input type="hidden" class="spCategories_idspCategory" name="spCategories_idspCategory"  value="<?php echo $_GET["categoryid"]; ?>">
<input type="hidden" id="catname"  value="<?php echo $_GET["categoryname"]; ?>">
<!--  <input type="hidden" id="buyid" name="buyid" type="hidden"> -->
<?php	if($postid == ""){ ?>

<input type="hidden" id="spPostingVisibility" name="spPostingVisibility"  value="<?php echo (isset($taa) ? $taa :$active); ?>">
<?php   }

else { ?>
<input type="hidden" id="spPostingVisibility" name="spPostingVisibility"  value="<?php echo $taa ?>">
<?php }?>



<input type="hidden" name="spuser_idspuser" value="<?php echo $_SESSION['uid'];?>">


<!--<input type="hidden" id="spPostingClosing" name="spPostingClosing"  value="0000-00-00">-->
<input type="hidden" id="spPostingEmail" name="spPostingEmail"  value="">
<input type="hidden" id="groupid" name="groupid"  value="0">



<!--      abhishek   -->


<input type="hidden" id="spUserCountry1" name="spUserCountry"  value="<?php echo $_SESSION["Countryfilter"]; ?>">
<input type="hidden" id="spUserState1" name="spUserState"  value="<?php echo $_SESSION["Statefilter"]; ?>">
<input type="hidden" id="spUserCity1" name="spUserCity"  value="<?php echo $_SESSION["Cityfilter"];?>">
<!-- <input type="hidden" id="spPostingClosing" name="spPostingClosing"  value="0000-00-00">
<input type="hidden" id="spPostingClosing" name="spPostingClosing"  value="0000-00-00"> -->
<input type="hidden" id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" class="business" value="<?php echo($_SESSION['pid']) ?>">





<?php
if(isset($_GET["repost"]) && $_GET['repost'] == 1){

}else if ($postid) {
echo "<input id='idspPostings' name='idspPostings' value=" . $postid . " type='hidden' >";
}

//print_r($ePostTitle);
?>
<!--Buy and Sell-->
<!--Buy and Sell--complete-->
<div class="row">
<div class="col-md-12">
<div class="row">
<div class="col-md-12">
<div class="form-group">
<label for="spPostingTitle" class="lbl_1">Job Title <span id="errorTitle" style="color:red">*</span></label>
<input type="text" class="form-control" id="spPostingTitle" name="spPostingTitle"  value="<?php echo $ePostTitle ;?>" placeholder="Your Posting Title" required>
</div>
</div>
<!---<div class="col-md-4">
<div class="form-group">
<label for="spPostingCountry" class="lbl_2">Country</label>
<select id="spUserCountry" class="form-control " name="spPostingsCountry">
<option value="">Select Country</option>
<?php
$co = new _country;
$result3 = $co->readCountry();
if($result3 != false){
while ($row3 = mysqli_fetch_assoc($result3)) {
?>
<option value='<?php echo $row3['country_id'];?>' <?php echo (isset($usercountry) && $usercountry == $row3['country_id'])?'selected':''; ?>   ><?php echo $row3['country_title'];?></option>
<?php
}
}
?>
</select>
<!-- <input type="text" class="form-control" id="spPostingCountry" name="spPostingsCountry" value="<?php echo (isset($eCountry) ? $eCountry : $country); ?>"> -->
<!--</div>
</div>
<div class="col-md-4">
<div class="loadUserState">
<label for="spPostingCity" class="lbl_3">State</label>
<select class="form-control" name="spPostingsState" id="spUserState" >
<option>Select State</option>
<?php
if (isset($userstate) && $userstate > 0) {
$countryId = $usercountry;
$pr = new _state;
$result2 = $pr->readState($countryId);
if($result2 != false){
while ($row2 = mysqli_fetch_assoc($result2)) { ?>
<option value='<?php echo $row2["state_id"];?>' <?php echo (isset($userstate) && $userstate == $row2["state_id"] )?'selected':'';?> ><?php echo $row2["state_title"];?> </option>
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
<select class="form-control" name="spPostingsCity" >
<option>Select City</option>
<?php
if (isset($usercity) && $usercity > 0) {
$stateId = $userstate;
$co = new _city;
$result3 = $co->readCity($stateId);
//echo $co->ta->sql;
if($result3 != false){
while ($row3 = mysqli_fetch_assoc($result3)) { ?>
<option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($usercity) && $usercity == $row3['city_id'])?'selected':''; ?> ><?php echo $row3['city_title'];?></option> <?php
}
}
} ?>
</select>
<!-- <input type="text" class="form-control" id="spPostingCity" name="spPostingsCity" value="<?php echo (isset($eCity) ? $eCity : $city); ?>"> -->
<!--</div>
</div>
</div>--->

<div class="col-md-12">
<div class="form-group">
<label for="spPostingNotes" class="lbl_4">Job Description<span id="errorDesc" style="color:red">*</span></label>

<link rel='stylesheet' href='https://cdn.quilljs.com/1.1.5/quill.snow.css'>
<textarea name="spPostingNotes" id="spPostingNotes" style="display:none;" required><?php echo $ePostNotes ?></textarea>

<div id="editor-container" style=" height: 300px; "><?php echo $ePostNotes ?></div>


<script src='https://cdn.quilljs.com/1.3.6/quill.js'></script>
<script>
var quill = new Quill('#editor-container', {
modules: {
toolbar: [
[{ header: [1, 2, false] }],
['bold', 'italic', 'underline']
]
},
theme: 'snow'  // or 'bubble'
});


quill.on("text-change", function() {
var editor_content = quill.container.firstChild.innerHTML ;
//alert(editor_content);
document.getElementById("spPostingNotes").value = editor_content;
});
</script>
</div>
</div>
<!--
<div class="col-md-6">
<div class="form-group">
<label for="spPostingCity">City</label>
<input type="text" class="form-control" id="spPostingCity" name="spPostingsCity" value="<?php echo (isset($eCity) ? $eCity : $city); ?>">
</div>
</div>
-->
</div>

<?php
if($postid){ ?>
<input type="hidden" class="form-control" id="spPostingExpDt" name="spPostingExpDt"  value=" <?php

if ($_GET['exp']==1) {

echo date('Y-m-d', strtotime("+365 days"));
//eExDt
//  echo date('Y-m-d', strtotime($eExDt));
} else {

echo $eExDt;
}
?>">
<?php  }else{

?>
<input type="hidden" class="form-control" id="spPostingExpDt" name="spPostingExpDt"  value="

<?php echo date('Y-m-d', strtotime("+365 days"));
?>">
<?php
}
?>


<div class="addcustomfields">
<!--add custom fields-->
<?php
if(isset($postid)){
$f = new _postfield;
$res = $f->field($postid);
if ($res != false)
while ($result = mysqli_fetch_assoc($res)) {
$row[$result["spPostFieldLabel"]] = $result["spPostFieldValue"];
//$idspPostField = $result["idspPostField"];
}
}


$_GET["module"] = $_GET["categoryid"];
include("../jobboard.php");


?>
<!--Getcustomfield-->
</div>

</div>
</div>
<!--Testing-->
<?php
if ($_GET["categoryid"] == 1 || $_GET["categoryid"] == 4) {
echo "<div class='col-md-6'>
<div class='form-group'>
<label for='sppostingShippingCharge'>Shipping Charge</label>
<input type='text' class='form-control' id='sppostingShippingCharge' name='sppostingShippingCharge' value='" . $shipping . "'>
</div>
</div>";
echo "<div class='col-md-6'>
<div class='form-group'>
<label for='retailShipping_'>Shipping Destination</label>
<select class='form-control spPostField' data-filter='0' id='retailShipping_' name='retailShipping' value=''>
<option value='North America'>North America</option>

<option value='South America'>South America</option>

<option value='East Europe'>East Europe</option>

<option value='West Europe'>West Europe</option>

<option value='Middle East'>Middle East</option>

<option value='Southeast Asia'>Southeast Asia</option>
<option value='Australia'>Australia</option>
</select>
</div>
</div>";
}
?>
<!--Testing Complete-->
<div class="row <?php echo ($_GET["categoryid"] == 13 || $_GET["categoryid"] == 2 || $_GET["categoryid"] == 5 ? "hidden" : ""); ?>">
<div class="col-md-3">
<div class="form-group">
<label for="postingpic">Add Sample images</label>
<input type="file" class="postingpic" name="spPostingPic[]" multiple="multiple">
<p class="help-block"><small>Browse files from your device</small></p>
</div>
</div>
<div class="col-md-9">
<div class="form-group">
<label for="postingPicPreview">Picture Preview</label>
<div id="imagePreview"></div>
<div id="postingPicPreview">
<div class="row">
<div id="">
<?php
$pic = new _postingpic;
$res = $pic->read($postid);
echo "<div class='row' id='dvPreview'>";
if ($res != false) {

while ($rows = mysqli_fetch_assoc($res)) {
$picture = $rows['spPostingPic'];
echo "<div class='col-md-2 imagepost'><span class='fa fa-remove closed' data-pic='" . $rows['idspPostingPic'] . "'></span><img style='width:100%; height: 80px;' src=' " . ($picture) . "' class='overlayImage'></div>";
}
}
echo "</div>";
?>
</div>
</div>
</div>
</div>
</div>
</div>


<!--          <div class="row <?php echo ($_GET["categoryid"] == 13 || $_GET["categoryid"] == 2 || $_GET["categoryid"] == 5 ? "hidden" : ""); ?>">
<div class="col-md-3">
<div class="form-group">
<label for="postingvideo">Add video</label>
<input type="file" class="spmedia" name="spPostingMedia[]" accept="video/*">
<p class="help-block"><small>Browse files from your device</small></p>
</div>
</div>
<div id="media-container"></div>
</div> -->


<!--  <div class="row no-margin">
<div class="col-md-6">
<label for="contatcby">This will override the privacy setting you have in your main dashboard</label>
<div class="form-group" id="contatcby">
<label class="checkbox-inline">
<input type="checkbox" id="spPostingEmail" name="spPostingEmail" value="1" checked > Email
</label>
<label class="checkbox-inline">
<input type="checkbox" id="spPostingPhone" name="spPostingPhone" value="0"> Phone
</label>
</div>
</div>


</div> -->
<div class="row">
<div class="col-md-2">

<!--    <div class="btn-group">

<button id="postingtype" type="button" class="btn btn-success <?php echo (isset($_GET["groupflag"]) ? "hidden" : "") ?>">Public</button>
<button type="button" class="btn  btn-success dropdown-toggle <?php echo (isset($_GET["groupflag"]) ? "hidden" : "") ?>" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false"><span class="caret"></span></button>
<ul class="dropdown-menu posttype">
<li><a id="postpublic" style="cursor:pointer;">Public</a></li>
<li><a id="postgroup" style="cursor:pointer;">Group</a></li>
</ul>
</div> -->
</div>
<div class="col-md-3">
<!--      <div id="sp-group-container" class="input-group hidden">
<input class="form-control" id='group_' name="groupid" type="text"  placeholder="Type to Select Group..." >

<span class="input-group-btn">

<a href="../../my-groups/" class="btn btn-default" type="button">Add New</a>
</span>
</div> -->


</div>
<div class="col-md-12 text-right">
<?php
if(isset($_GET["repost"]) && $_GET['repost'] == 0){
?>
<button id="spPostrepost" type="button"  class="btn butn_save btn-border-radius"><?php echo (($postid != "") ? "Publish" : "Update")?></button>

<button id="spPostSubmit" style="border-radius:25px" type="button" class="btn btn-primary btn-border-radius">Save Draft</button>
<?php
}else{ ?>


<!-- <button  class="btn butn_cancel" onclick="cancel1('<?php echo $BaseUrl.'/job-board/';?>')">Cancel</button> -->

<a href="<?php echo $BaseUrl.'/registration-steps.php?pageid=7';?>" style="" class="btn btn-danger  btn-border-radius" >Cancel</a>

<?php
if($postid){
$post_id = $postid;
?>
<button  class="btn butn_save btn-border-radius" onclick="delete1('<?php echo $BaseUrl.'/job-board/dashboard/deletePost.php?postid='.$post_id ?>')" style="border-radius:25px;" class=" btn butn_save" style="background-color: red!important;">Delete</button>
<?php
}
}
?>
<div id="myModals" style="display:none;" class="modal">
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title text-center">Create Business Profile</h5>
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-left bpname">Business Profile Name</label>
                <input type="text" class="form-control" id="businessprofilename" name="companyname" aria-describedby="emailHelp" placeholder="Enter name" required>
            </div>
            <div class="form-group text-start py-lg-1 py-0 cntry_clm_2">
                <div class="">
                    <label for="" class=" my-2 text-capitalize bname">Business Name<span class="req_star">*</span></label>
                    <input type="text" class="form-control" name="companytagline" id="businessname" required>
                </div>
                <div class="form-group">
                    <div class="">
                        <label for="" class="my-2 text-capitalize catname">Category<span class="req_star">*</span></label>
                        <select class="form-control" id = "businesscategory" name = "businesscategory"  aria-label="Default select example" required>
                        <option value="">Select Category</option>
				<?php
				//print_r($explodedArray); die(' kkkkkkkkkkkkkk');
					//echo "<option value='' disabled selected>".$row["Business Category"]."</option>";
					$m = new _masterdetails;
					$masterid = 8;
					$result = $m->read($masterid);
					if($result != false){
						while($rows = mysqli_fetch_assoc($result)){ ?>
							<option value='<?php echo $rows["idmasterDetails"]; ?>' 
							<?php
						if(isset($explodedArray) && in_array($rows["idmasterDetails"], $explodedArray) ) {echo "selected";}
				
					?> >
					<?php echo ucfirst(strtolower($rows["masterDetails"]));?>
					
					</option><?php
						}
					}
				?>
                        </select>
                        <span class="spUserState erormsg"id="state"></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-left">Products/Services</label>
                <input type="text" class="form-control" name = "companyProductService" id="product" aria-describedby="emailHelp" placeholder="Enter product/services">
            </div>
            <div class="d-flex mb-2" >
                <h4>Location</h3>
                <i></i>
            </div>
            <div class=" text-start py-lg-1 py-0 cntry_clm_4">
                <div class="form-group">
                    <label for="exampleInputEmail1" class="text-left bcountry">Country<span class="req_star">*</span></label>
                    <select class="form-control" id="spCountry_default_address" name="spUserCountry"  aria-label="Default select example" >
                    <option value="0">Select Country</option>
                        <?php
                       
                        $co = new _country;
                        $result3 = $co->readCountry();
                        if($result3 != false){
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                ?>
                                <option value='<?php echo $row3['country_id'];?>' <?php echo (isset($usercountry1) && $usercountry1 == $row3['country_id'])?'selected':''; ?>>
                                    <?php echo $row3['country_title'];?>
                                </option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    
              
                      <!-- <label class="spUserCountry erormsg "  id="countryerror" style="margin-top:-15px;"></label> -->
                </div>
                <div class="loadUserStateModal">
                    <label for="spUserState" class="bstate">State</label>
                    <select class="form-control spUserStateModal" name="spUserState" id="spUserState11" >
                        <option value="0">Select State</option>
                        <?php 
                            if (isset($usercountry1) && $usercountry1 > 0) {
                                $pr = new _state;
                                $result2 = $pr->readState($usercountry1);
                                if($result2 != false){
                                    while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                                        <option value='<?php echo $row2["state_id"];?>' <?php echo (isset($userstate1) && $userstate1 == $row2["state_id"] )?'selected':'';?> ><?php echo $row2["state_title"];?> </option>
                                        <?php
                                    }
                                }
                            }
                            ?>
                    </select>
                    <span id="shippstate_error" style="color:red;"></span>
                </div>
                <div class="loadCityModal">
                        <label  for="spUserCity">City</label>
                        <select class="form-control" name="spUserCity" id="spUserCity1" >
                           <option value="0">Select City</option>
                            <?php 
                               if (isset($userstate1) && $userstate1 > 0) {
                                $co = new _city;
                                $result3 = $co->readCity($userstate1);
                                if($result3 != false) {
                                    while ($row3 = mysqli_fetch_assoc($result3)) { ?>
                                        <option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($usercity1) && $usercity1 == $row3['city_id'])?'selected':''; ?> ><?php echo $row3['city_title'];?></option> <?php
                                    }
                                }
                            } 
                            ?>
                        </select>
                        <span id="shippcity_error" style="color:red;"></span>
                     </div>
            </div>
            </div>
      <div class="modal-footer">
        <button  id="spPostSubmitjob" type="button" class="btn butn_save btn-border-radius"><?php echo (($postid) ? ($_GET['exp'] == 1 ? 'Publish' : 'Update') : 'Submit'); ?>
        <button id="spPostSubmitjobclosse"  type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> 
<?php
  $bprofile = selectQ("select * from spbusiness_profile where spprofiles_idspProfiles = ?", "i", [$_SESSION['pid']], "one");
?>
<input type="hidden" id="businessValidation" value="<?php if(isset($bprofile) && !empty($bprofile)) { echo 0; } else { echo 1; } ?>">
<button  id="<?php if(isset($bprofile) && !empty($bprofile)) { echo "spPostSubmitjobs1"; } else { echo "spPostSubmitjobs"; } ?>" type="button" class="btn butn_save btn-border-radius"><?php echo (($postid) ? ($_GET['exp'] == 1 ? 'Publish' : 'Update') : 'Submit'); ?>
</button>

</div>
</div>
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
<div class="col-md-3">
<div class="postJob" id="postJobBoard">
<div class="col-xs-12 nopadding its-free-post-job">
<?php
$po = new _spAllStoreForm;
$result2 = $po->getformcontent(2);
if ($result2) {
$row2 = mysqli_fetch_assoc($result2);
?>
<h2 class="heading"><?php echo $row2['pc_title']; ?></h2>
<div class="col-xs-12 content">
<div class='nopadding'><?php echo $row2['pc_content']; ?></div>
</div>
<?php
}
?>

</div>
</div>
</div>

</div>

<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<!--<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Change Current Location</h4>
</div>
<!----action="<?php echo $BaseUrl?>/post-ad/dopost.php"--->
<form method="POST">
<div class="modal-body">
<!--<div class="row">

<div class="col-md-4">
<div class="form-group">
<label for="spPostingCountry" class="lbl_2">Country</label>
<select class="form-control " name="spPostingsCountry" id="spUserCountry" >
<option value="">Select Country</option>
<?php
$co = new _country;
$result3 = $co->readCountry();
if($result3 != false){
while ($row3 = mysqli_fetch_assoc($result3)) {
?>
<option value='<?php echo $row3['country_id'];?>' <?php echo (isset($usercountry) && $usercountry == $row3['country_id'])?'selected':''; ?>   ><?php echo $row3['country_title'];?></option>
<?php
}
}
?>
</select>
<!-- <input type="text" class="form-control" id="spPostingCountry" name="spPostingsCountry" value="<?php echo (isset($eCountry) ? $eCountry : $country); ?>"> -->
</div>
</div>

<!--<div class="col-md-4">
<div class="loadUserState">
<label for="spPostingCity" class="lbl_3">State</label>
<select class="form-control" id="spUserState" name="spPostingsState">
<option>Select State</option>
<?php
if (isset($userstate) && $userstate > 0) {
$countryId = $usercountry;
$pr = new _state;
$result2 = $pr->readState($countryId);
if($result2 != false){
while ($row2 = mysqli_fetch_assoc($result2)) { ?>
<option value='<?php echo $row2["state_id"];?>' <?php echo (isset($userstate) && $userstate == $row2["state_id"] )?'selected':'';?> ><?php echo $row2["state_title"];?> </option>
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
<label for="spPostingCity" class="lbl_4">City</label>
<select class="form-control" id="spUserCity" name="spPostingsCity" >
<option>Select City</option>
<?php
if (isset($usercity) && $usercity > 0) {
$stateId = $userstate;
$co = new _city;
$result3 = $co->readCity($stateId);
//echo $co->ta->sql;
if($result3 != false){
while ($row3 = mysqli_fetch_assoc($result3)) { ?>
<option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($usercity) && $usercity == $row3['city_id'])?'selected':'';  ?> ><?php echo $row3['city_title'];?></option> <?php
}
}
} 
?>
</select>

</div>
</div> -->
</div>


</div>
</div>
<!-- <div class="modal-footer">
<button type="submit" name="Change_Current_Location" class="btn btn-primary" >Change</button>
<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
</div>
</form>
</div>

</div>
</div>






</section>
<?php include('../../component/f_footer.php');?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../../component/f_btm_script.php'); ?>

<script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>
<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/date-time/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/date-time/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>

<script type="text/javascript">

$("#spPostSubmitjobs1").on("click", function () {
  document.getElementById("spPostSubmitjob").click();
});

        var modal = document.getElementById("myModals");

// Get the button that opens the modal
var btn = document.getElementById("spPostSubmitjobs");

// Get the <span> element that closes the modal
var span = document.getElementById("spPostSubmitjobclosse");

// When the user clicks the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

$(".form_datetime2").datetimepicker({
format: "dd MM yyyy - hh:ii P",
autoclose: true,
todayBtn: true,
pickerPosition: "bottom-left"
});

$('.form_datetime').datetimepicker({
//language:  'fr',
weekStart: 1,
todayBtn:  1,
autoclose: 1,
todayHighlight: 1,
startView: 2,
forceParse: 0,
minView: 2,
});

$('.form_time_3').datetimepicker({
//language:  'fr',
weekStart: 1,
todayBtn:  1,
autoclose: 1,
todayHighlight: 1,
startView: 1,
forceParse: 0,
showMeridian: 1
});
</script>

<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>


<script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/token_field/bootstrap-tokenfield.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/token_field/affix.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/token_field/typeahead.bundle.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/token_field/docs.min.js" charset="UTF-8"></script>

</body>
</html>
<?php
}
}else{
    header('location:'.$BaseUrl.'/job-board/');

} ?>
<script>










$('#spPostSubmit_').on('click',function(){

swal({
title: 'Are you sure?',
text: "It will permanently deleted !",
type: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, delete it!'
}).then(function() {
swal(
'Deleted!', 
'Your file has been deleted.',
'success' 
);
})

})

function cancel1(url){
//alert(url);

Swal.fire({
title: 'Are you sure?',
text: "You won't be able to revert this!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, Cancel it!'
}).then((result) => {
if (result.isConfirmed) {
window.location = url;

}
})
}   


function delete1(url){
//alert(url);
Swal.fire({
title: 'Are you sure?',
text: "You won't be able to revert this!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, delete it!'
}).then((result) => {
if (result.isConfirmed) {
window.location = url;

}
})
}   
</script>
