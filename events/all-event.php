<?php 
include('../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="events/";
include_once ("../authentication/check.php");

}else{
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$_GET["categoryID"] = "9";
$_GET["categoryName"] = "Events";
$header_event = "events";

if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6){ 

}else{
$re = new _redirect;
$re->redirect($BaseUrl."/events");
}

if($_SESSION['spPostCountry'] ==''){   
$u = new _spuser; 
$res = $u->read($_SESSION["uid"]);
if($res != false){ 

$ruser = mysqli_fetch_assoc($res);
//print_r($ruser);
//die('==');
$_SESSION['spPostCountry'] = $ruser["spUserCountry"]; 
$_SESSION['spPostState'] = $ruser["spUserState"]; 
$_SESSION['spPostCity'] = $ruser["spUserCity"];

}


}


if(isset($_POST['changelc'])){



$userCountry =$_POST['spPostCountry'];


$userState = $_POST['spUserState'];

$userCity = $_POST['spUserCity'];

$_SESSION['spPostState'] = $userState; 
$_SESSION['spPostCity'] =  $userCity;

$_SESSION['spPostCountry'] =   $userCountry ;      

$usercountry =  $_SESSION['spPostCountry'] ; 
$userstate = $_SESSION['spPostState']; 
$usercity = $_SESSION['spPostCity'];




// print_r($_SESSION); die;



}

else {


$usercountry = $_SESSION['spPostCountry'];                                       
$userstate = $_SESSION['spPostState'];                                           
$usercity = $_SESSION['spPostCity'];  





}  

?>

<!DOCTYPE html>
<html lang="en-US">

<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
<?php include('../component/f_links.php');?>
<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/magnific-popup.css">
<!-- Magnific Popup core JS file -->
<script src="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/jquery.magnific-popup.js"></script>
<!-- this script for slider art -->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">
</head>

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
}                                                                       }                                                                                             }
} 


?>



<style>
/*------------------Edit-button-css---------------*/
.upEventBox .bodyEventBox p { 

min-height: 0px !important;
}
.upEventBox.upcomingbox {
position: relative;
}
.upEventBox.upcomingbox .eidt-con {
position: absolute;
left: auto;
right: 9px;
margin-top: 14px;
}
.upEventBox.upcomingbox .eidt-con a {
color: #fff;
}
.upEventBox.upcomingbox .eidt-con i.fa {
border: 1px solid #da1919;
background: -webkit-linear-gradient(90deg,#9c0202 0,#da1919 100%);
text-align: center;
border-radius: 6px;
padding: 4px 4px;
}
</style>
<style>
.dropdown-menu {
border: none;
}
#profileDropDown li.active {
background-color: #c11f50;
}
#profileDropDown li.active a {
color: #fff;
}
</style>
<body class="bg_gray">
<?php include_once("../header.php");?>
<section class="topDetailEvent innerEvent">
<div class="container">
<div class="row">
<div class="col-sm-12 text-center">
<h3>Events</h3>
</div>
</div>
</div>
</section>
<section class="main_box no-padding">

<div class="container eventExplrthefun explorecontainer">
<div class="row">
<div class="col-sm-12">
<div class="topBoxEvent text-right">
<a href="<?php echo $BaseUrl.'/events';?>" class="btn  eventdashboard">
<i class="fa fa-home"></i> Home</a>
<a href="<?php echo $BaseUrl.'/post-ad/events/?post'?>" style="color:white" class="btn  submitevent">Submit an event</a>
<a href="<?php echo $BaseUrl.'/events/dashboard/';?>" class="btn  eventdashboard"><i class="fa fa-dashboard"></i> Dashboard</a>

</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="">
<h1>Explore the <span>fun</span></h1>
</div>
</div>
<div class="col-sm-12">
<?php include('search-form.php');?>

<div class="location-details" style="float:right;margin-top: -50px;">  
<p>
<small style="font-size: 100%;"> <?php 
if(!empty($currentcountry)){
echo $currentcountry;   
}
if(!empty($currentstate)){
echo ', '.$currentstate;   
}
if(!empty($currentcity)){
echo ', '.$currentcity; 
}

//echo $currentcountry.', '.$currentstate.', '.$currentcity ; ?><br>
<!-- <a style="cursor:pointer; color: #337ab7;" data-toggle="modal" data-target="#myModal">Change Location</a>-->
<?php //if($_SESSION['guet_yes'] != 'yes'){ ?>
<a style="cursor:pointer; color: #337ab7;" data-toggle="modal" data-target="#myModal">Change Location</a> <?php // } ?>

</small>

</p>
</div>

</div>
</div>
</div>

</section>
<section class="UpcomingSec">
<div class="container">
<div class="row">
<div class="col-sm-12">
<div class="titleEvent text-center">
<h2><span>Events</span></h2>
<p>Your local upcoming events</p>
</div>
</div>
</div>
<div class="row">
<?php
$st= new _spuser;
$st1=$st->readdatabybuyerid($_SESSION['uid']);
if($st1!=false){
$stt=mysqli_fetch_assoc($st1);
$account_status=$stt['deactivate_status']; 
}

$start = 0;
$p      = new _spevent;


$page_no = $_GET['page'];

if($_GET['page']==1){
$start = 0;
}


else{
$sss = $_GET['page']-1;
$start = 9*$sss; 
}


$limit = 9;




$res    = $p->homepage_events_top_pag($_SESSION['spPostCountry'],$_SESSION['spPostState'],$_SESSION['spPostCity'],$start,$limit);    
$numrowsw = $res->num_rows;  
if($account_status!=1){
if($res != false){
while ($row = mysqli_fetch_assoc($res)) { 

if($row['spuser_idspuser']!=NULL){
$st= new _spuser;
$st1=$st->readdatabybuyerid($row['spuser_idspuser']);
if($st1!=false){
$stt=mysqli_fetch_assoc($st1);
$account_status=$stt['deactivate_status'];
}
}

$pn = new _productposting;
$idposting=$row['idspPostings'];

$flagcmd=$pn->flagcount(9,$idposting);
$flagnums=$flagcmd->num_rows;
if($flagnums=='9')
{
$updatestatus=$pn->eventstatus($idposting); 

}

$venu = "";
$startDate = "";
$startTime    = "";
$endTime = "";
$OrganizerName = "";

$gid=$row['groupid'];
$venu = $row['spPostingEventVenue'];
$startDate = $row['spPostingStartDate'];
$startTime = $row['spPostingStartTime'];
$endTime = $row['spPostingEndTime'];

$dtstrtTime = strtotime($startTime);
$dtendTime = strtotime($endTime);

if($account_status!=1){
?>
<div class="col-md-4 d-flex align-items-stretch">
<div class="card upEventBox upcomingbox" style="width:100%;">
<div class=" car-header mainOverlay">
<?php if($gid > 0){?>
<a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'].'&groupid='.$gid;?>" class="">
<?php } else{?>
<a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'];?>" class="">
<?php } ?>
<?php
$pic = new _eventpic;

$res2 = $pic->readFeature($row['idspPostings']);
if($res2 != false){
if($res2->num_rows > 0){
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' 
class='img-responsive upcomingimg eventimg' src=' " . ($pic2) . "' >"; 
} else{
echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive upcomingimg eventimg'>"; 
}
}else{
$res2 = $pic->read($row['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive upcomingimg eventimg' src=' " . ($pic2) . "' >"; 
} else{
echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive upcomingimg eventimg'>"; 
}
}
}else{
$res2 = $pic->read($row['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive eventimg' src=' " . ($pic2) . "' >"; 
} else{
echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive eventimg'>"; 
}
}
?>
</div>
</a>
<div class="card-body bodyEventBox">
<?php
if(!empty($startDate)){
$dy = new DateTime($startDate);
$day = $dy->format('d');
$month = $dy->format('M');
$weak = $dy->format('D');
}else{
$day = 0;
$month = "&nbsp;";
$weak = "&nbsp;";
}
?>
<span class="datetop pull-right">
<?php echo $month.' '.$day;?>&nbsp;&nbsp;<?php echo $weak;?></span>

<?php if($gid > 0){?>
<a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'].'&groupid='.$gid;?>" class=""><?php echo $row['spPostingTitle'];?></a>
<?php } else{ ?>

<a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'];?>" class=""><?php echo $row['spPostingTitle'];?></a>
<?php } ?>
<span  class=""><i class="fa fa-map-marker"></i> <?php echo $venu;?></span>
<p class="text-justify" >
<?php
if(strlen($row['spPostingNotes']) < 170){

echo $row['spPostingNotes'];
}else{
echo substr($row['spPostingNotes'], 0,170)."...";

} ?>
</p>
<?php
$area2 = "";
$area1 = "";
$area0 = "";
$ei = new _eventIntrest;
$result = $ei->chekAlready($row['idspPostings'], $_SESSION['pid']);
if($result != false && $result->num_rows > 0){
$row3 = mysqli_fetch_assoc($result);
$area = $row3['intrestArea'];
if($area == 2){
$area2 = "<i class='fa fa-check'></i>";
$title = "Going";
}else if($area == 1){
$area1 = "<i class='fa fa-check'></i>";
$title = "Interested";                                
}else if($area == 0){
$area0 = "<i class='fa fa-check'></i>";
$title = "May Be";
}
}else{
$title = "Going";
}
?>
<div class="ie_<?php echo $row['idspPostings'];?>">
<div class="dropdown intrestEvent" style="display: inline">
<button class="btn btn_group_join dropdown-toggle eventiconbtn" type="button" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-star" aria-hidden="true" style="margin: 0px; color:#ff8400;"></i> <?php echo $title;?></button>
<ul class="dropdown-menu ">
<li><a href="javascript:void(0)" class="intestDetail" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $row['idspPostings'];?>" data-area="2"><?php echo $area2;?> Going</a></li>
<li><a href="javascript:void(0)" class="intestDetail" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $row['idspPostings'];?>" data-area="1"><?php echo $area1;?> Interested</a></li>
<li><a href="javascript:void(0)" class="intestDetail" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $row['idspPostings'];?>" data-area="0"><?php echo $area0;?> May Be</a></li>
</ul>
</div>
</div>
</div>
<div class="card-footer footEventBox footupcoming">
<p><span class="date" style="margin-left: 10px;"><i class="fa fa-calendar" style="font-size: 15px;"></i> <?php echo $startDate;?>  | <?php echo date("h:i A", $dtstrtTime); ?> - <?php echo date("h:i A", $dtendTime);?></span></p>
</div>
</div>
</div> <?php  }
}
}}
?>


</div>
</div>

<?php 
$p      = new _spevent; 
$res    = $p->homepage_events_top_pag($_SESSION['spPostCountry'],$_SESSION['spPostState'],$_SESSION['spPostCity'],$start,$limit);   
$numrowsw = $res->num_rows;  

?>

<div class="row">
<div class="col-md-4 d-flex align-items-stretch">  

<?php if($_GET['page']!=1){ ?>
<button class="btn btn-primary">
<a style="color:white;" href="/events/all-event.php?page=<?php echo $_GET['page']-1 ;?>">Previous</a>
</button>
<?php }  ?>

<?php if($_GET['page']!=1 && $numrowsw==9){ ?> 

<span> || </span>

<?php } ?>		
<?php if($numrowsw==9){ ?>	    
<button class="btn btn-primary">
<a style="color: white;" href="/events/all-event.php?page=<?php echo $_GET['page']+1 ;?>">Next</a>
</button>

<?php } ?>
</div>

</div>
</section>


<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">
<form action="" method="post">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Change Current Location <?php //echo $usercountrypost.'=='; ?></h4>
</div>
<!----action="<?php echo $BaseUrl?>/post-ad/dopost.php"--->
<div class="modal-body">
<div class="row" >

<div class="col-md-4">
<div class="form-group">
<label for="spPostCountry_" class="lbl_2">Country</label>
<select class="form-control " name="spPostCountry" id="spUserCountry">
<option value="">Select Country </option>
<?php
$co = new _country;
$result3 = $co->readCountry();
if($result3 != false){
while ($row3 = mysqli_fetch_assoc($result3)) {
?>
<option value='<?php echo $row3['country_id'];?>' <?php echo (isset($_SESSION['spPostCountry']) && $_SESSION['spPostCountry'] == $row3['country_id'])?'selected':''; ?>><?php echo $row3['country_title'];?></option>
<?php
}
}
?>
</select>														
</div>
</div>

<div class="col-md-4">
<div class="loadUserState">
<label for="spPostingCity" style="float:left; color: white;" class="lbl_3">State</label>
<select class="form-control spPostingsState" name="spUserState">
<option>Select State</option>
<?php 
if (isset($_SESSION['spPostCountry']) && $_SESSION['spPostCountry'] > 0) {
$countryId = $usercountry;
$pr = new _state;
$result2 = $pr->readState($_SESSION['spPostCountry']);
if($result2 != false){
while ($row2 = mysqli_fetch_assoc($result2)) { ?>
<option value='<?php echo $row2["state_id"];?>' <?php echo (isset($_SESSION['spPostState']) && $_SESSION['spPostState'] == $row2["state_id"] )?'selected':'';?>><?php echo $row2["state_title"];?> </option>
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
<label for="spPostingCity" style="float: left;color: white;" class="">City</label>
<select class="form-control" name="spUserCity">
<option>Select City</option>
<?php 

$co = new _city;
$result3 = $co->readCity($_SESSION['spPostState']);
if($result3 != false){
while ($row3 = mysqli_fetch_assoc($result3)) { ?>
<option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($_SESSION['spPostCity']) && $_SESSION['spPostCity'] == $row3['city_id'])?'selected':''; ?>><?php echo $row3['city_title'];?></option> <?php
}

} ?>
</select>
</div>
</div>
</div>

</div>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-primary btn-border-radius" name="changelc">Change</button>
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
</div>
</div>
</form>
</div>
</div>

<?php 
include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>
</body>
</html>
<?php
}
?>
