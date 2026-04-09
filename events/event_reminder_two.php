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
<?php //include_once("../header.php");?>

<section class="UpcomingSec">
<div class="container">
<div class="row">
<!-- <div class="col-md-12">
<div class="titleEvent text-center">
<h2><span>Events</span></h2>
<p>Your local upcoming events</p>
</div>
</div> -->
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




$Date =  date('Y-m-d');

$date_e  =  date('Y-m-d', strtotime($Date. ' + 2 days'));

$res    = $p->homepage_events_top_pag_reminder($date_e); 

$em = new _email;
$u = new _spuser;


$numrowsw = $res->num_rows;  
if($account_status!=1){
if($res != false){
while ($row = mysqli_fetch_assoc($res)) { 

$data_store = $row['idspPostings'];
$res11 = $p->reminder_transaction_data($data_store); 

if($res11){
while($row_data = mysqli_fetch_assoc($res11)){

$buyer_id = $row_data['buyer_uid'];
$res33 = $p->reminder_spuser_data($buyer_id); 
if($res33){

while($row_spuser_data = mysqli_fetch_assoc($res33)){



//$email_data = 'ajaygupta493@gmail.com';
$email_data = $row_spuser_data['spUserEmail'];

$event_id = $row['idspPostings'];
$event_name = $row['spPostingTitle'];
$eventstartdate = $row['spPostingStartDate'];
$res = $u->regen($email_data);

if ($res != false) {
$row = mysqli_fetch_assoc($res);
$username = $row["spUserName"];
}else{
$username='';
}

$em->event_reminder($email_data,$event_id,$event_name,$username,$eventstartdate);





}
}




//select * from spuser where id idspUser=buyer_uid ;

}
}


}
}}


?>


</div>
</div>

<?php 
$p      = new _spevent; 

$Date =  date('Y-m-d');

$date_e  =  date('Y-m-d', strtotime($Date. ' + 2 days'));
$res    = $p->homepage_events_top_pag_reminder($date_e);   
$numrowsw = $res->num_rows;  

?>

<!-- <div class="row">
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

</div> -->
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
//include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>
</body>
</html>
<?php
}
?>
