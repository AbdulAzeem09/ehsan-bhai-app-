<?php 
include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "photos/";
include_once ("../authentication/check.php");

}else{

function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$_GET["categoryID"] = 13;
if(isset($_GET['event']) && $_GET['event'] > 0){

$p = new _postingviewartcraft;
$pf  = new _postfield;

$result = $p->singletimelines($_GET['event']);
//echo $p->ta->sql;
if($result != false){
$row = mysqli_fetch_assoc($result);
//print_r($row); die;
$ProTitle   = $row['spPostingTitle'];
$ProDes     = $row['spPostingNotes'];
$ArtistName = $row['spProfileName'];
$ArtistId   = $row['idspProfiles'];
$ArtistAbout= $row['spProfileAbout'];
$ArtistPic  = $row['spProfilePic'];
$price      = $row['spPostingPrice'];
$country    = $row['spPostingsCountry'];
$city       = $row['spPostingsCity'];
$visibility = $row['spPostingVisibility'];

$pr = new _spprofilehasprofile;
$result3 = $pr->frndLeevel($_SESSION['pid'], $row['idspProfiles']);
if($result3 == 0){
$level = '1st Connection';
}else if($result3 == 1){
$level = '1st Connection';
}else if($result3 == 2){
$level = '2nd Connection';
}else if($result3 == 3){
$level = '3rd Connection';
}else{
$level = 'Not Define';
}

//posting fields
$result_pf = $pf->read($row['idspPostings']);
//echo $pf->ta->sql."<br>";
if($result_pf){
$catName = "";
$imageSize = "";
$printedYear    = "";
$postCatEvent   = "";
while ($row2 = mysqli_fetch_assoc($result_pf)) {

if($catName == ''){
if($row2['spPostFieldName'] == 'photos_'){
$catName = $row2['spPostFieldValue'];

}
}
if($imageSize == ''){
if($row2['spPostFieldName'] == 'imagesize_'){
$imageSize = $row2['spPostFieldValue'];

}
}
if($printedYear == ''){
if($row2['spPostFieldName'] == 'mediaprinted_'){
$printedYear = $row2['spPostFieldValue'];

}
}
if($postCatEvent == ''){
if($row2['spPostFieldName'] == 'eventName_'){
$postCatEvent = $row2['spPostFieldValue'];

}
}
}
}


//read login user detail
$pro = new _spprofiles;
$result4 = $pro->readUserId($_SESSION['pid']);
//echo $pro->ta->sql;
if($result4 != false){
$row4 = mysqli_fetch_assoc($result4);
//$cityEnquery = $row4['spProfilesCity'];
//$countryEnquery = $row4['spProfilesCountry'];
$phoneEnquery = $row4['spProfilePhone'];
}


$u = new _spuser;
$res = $u->read($_SESSION["uid"]);
if($res != false){
$ruser = mysqli_fetch_assoc($res);
$usercountry = $ruser["spUserCountry"]; 
$userstate = $ruser["spUserState"]; 
$usercity = $ruser["spUserCity"]; 
}

}
}else{
header('location:../artandcraft/');
}


$header_photo = "header_photo";
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php');?>
</head>

<body class="bg_gray">
<?php include_once("../header.php");?>
<section class="innerArtBanner">
<?php include('top-search.php');?>
</section>
<!----  <section class="bg_white" style="border-bottom: 2px solid #CCC">
<div class="container">
<div class="row">
<div class="col-md-12">
<ul class="art_scnd_levl">
<li><a href="<?php echo $BaseUrl.'/photos/artist.php?cat=1';?>">Visual Artist</a></li>
<li><a href="<?php echo $BaseUrl.'/photos/artist.php?cat=2';?>">Graphics Designer</a></li>
<li><a href="<?php echo $BaseUrl.'/photos/artist.php?cat=3';?>">Contemporary</a></li>
<li><a href="<?php echo $BaseUrl.'/photos/artist.php?cat=4';?>">Animation</a></li>
<li><a href="<?php echo $BaseUrl.'/photos/artist.php?cat=5';?>">Musician</a></li>
</ul>
</div>
</div>
</div>
</section> ---->
<div class="space"></div> 
<section class="">
<div class="container">
<div class="row">
<div class="col-md-12 topbread">
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/artandcraft';?>"><i class="fa fa-home"></i></a></li>
<?php
if($visibility == -2){ ?>
<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo $BaseUrl.'/artandcraft/all-exhibition.php?cat=up';?>">Exhibition</a></li>
<?php
}else{ ?>
<!---<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo $BaseUrl.'/artandcraft/events.php';?>"></a></li>--->
<?php
}
?>

</ol>
</nav>
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="righEngquiryProduct">
<a href="/artandcraft/detail.php?postid=<?php echo $_GET['event']; ?>">
<?php
$pic = new _postingpicartcraft;
$res2 = $pic->read($_GET['event']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >";
} else{
echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
}
?>
<h3><?php echo $ArtistName; ?> <br>
<?php echo $imageSize; ?> Code: EX00<?php echo $_GET['event']; ?><br>
<?php echo $ProTitle;?>
</h3>

</a>
</div>

</div>
<div class="col-md-8">
<h3><?php echo strtoupper($ProTitle); ?></h3>
<h3 class="">Enquiry Form</h3>
<?php
$p = new _postingviewartcraft;
$pf  = new _postfield;

$result5 = $p->singletimelines($postCatEvent);
if($result5 != false){
$row5 = mysqli_fetch_assoc($result5);
$EvetDesc = $row5['spPostingNotes'];
}
//posting fields
$result_pf2 = $pf->read($postCatEvent);
//echo $pf->ta->sql."<br>";
if($result_pf2){
$startDate = "";
$endDate   = "";
$strtTime  = "";
$endTime   = "";
$location   = "";
while ($row3 = mysqli_fetch_assoc($result_pf2)) {

if($startDate == ''){
if($row3['spPostFieldName'] == 'spPostingStartDate_'){
$startDate = $row3['spPostFieldValue'];

}
}
if($endDate == ''){
if($row3['spPostFieldName'] == 'spPostingEndDate_'){
$endDate = $row3['spPostFieldValue'];

}
}
if($strtTime == ''){
if($row3['spPostFieldName'] == 'spPostingStartTime_'){
$strtTime = $row3['spPostFieldValue'];

}
}
if($endTime == ''){
if($row3['spPostFieldName'] == 'spPostingEndTime_'){
$endTime = $row3['spPostFieldValue'];

}
}
if($location == ''){
if($row3['spPostFieldName'] == 'spPostingEventVenue_'){
$location = $row3['spPostFieldValue'];

}
}
}
$dtstrtTime = strtotime($strtTime);
$dtendTime = strtotime($endTime);
}
?>
<div class="table-responsive bg_white m_btm_20 <?php echo ($postCatEvent == '')?'hidden':'';?>">
<table class="table table-striped">
<tbody>
<tr>
<td>Start Date</td>
<td><?php echo $startDate;?></td>
</tr>
<tr>
<td>End Date</td>
<td><?php echo $endDate;?></td>
</tr>
<tr>
<td>Start Time</td>
<td><?php echo date("h:i A", $dtstrtTime); ?></td>
</tr>
<tr>
<td>End Time</td>
<td><?php echo date("h:i A", $dtendTime); ?></td>
</tr>
<tr>
<td>Location</td>
<td><?php echo $location;?></td>
</tr>
<tr>
<td>Description</td>
<td><?php echo $EvetDesc;?></td>
</tr>
</tbody>
</table>
</div>
<div class="row">
<form class="orderEnqryArt" method="post" action="sendEnquiry.php?ArtistId=<?php echo $ArtistId; ?>" >
<input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid'];?>">
<input type="hidden" name="spPosting_idspPosting" value="<?php echo $_GET['event'];?>">
<input type="hidden" name="enquiryType" value="<?php echo $visibility;?>">
<input type="hidden" name="enquiryEmail" value="<?php echo (isset($_SESSION['spUserEmail']))?$_SESSION['spUserEmail']:'';?>">

<div class="col-md-6">
<div class="form-group">
<label>Name</label>
<input type="text" class="form-control" name="enquiryName" value="<?php echo (isset($_SESSION['myprofile']))?$_SESSION['myprofile']:'';?>" required="">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Telephone </label>
<input type="text" class="form-control" name="enquiryPhone" value="<?php echo (isset($phoneEnquery))?$phoneEnquery:'';?>" required="">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Country</label>
<select id="spUserCountry" class="form-control " name="enquiryCountry">
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
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<div class="loadUserState">
<label for="spPostingCity">State</label>
<select class="form-control" name="enquiryState">
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
</div>
<div class="col-md-6">
<div class="form-group">
<div class="loadCity">
<div class="form-group">
<label for="spPostingCity">City</label>
<select class="form-control" name="enquiryCity" >
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
</div>
</div>
</div>
</div>


<div class="col-md-12">
<div class="form-group">
<label>Description</label>
<textarea class="form-control" name="enquiryDesc"></textarea>
</div>
<div class="<?php echo ($ArtistId == $_SESSION['pid'])?'hidden':'';?>">
<input type="submit" class="btn btn_art_orng btn-border-radius" value="Send" >
<input type="Reset" class="btn btn-reset btn-border-radius" value="Reset" >
</div>
</div>
</form>
</div>
</div>

</div>
</div>
</section>

<div class="space"></div>
<?php 
include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>
<!-- notification js -->
</body>
</html>
<?php
}
?>