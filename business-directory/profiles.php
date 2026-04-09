<?php
include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "business-directory/";
include_once ("../authentication/check.php");

}else{
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$header_directy = "header_directy";
$page = "profilesPage";
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php');?>
<!-- owl carousel -->
<link href="<?php echo $BaseUrl;?>/assets/css/owl.carousel.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $BaseUrl;?>/assets/css/owl.theme.default.min.css" rel="stylesheet" type="text/css" />

<script src="<?php echo $BaseUrl;?>/assets/js/owl.carousel.min.js"></script>
<!--NOTIFICATION-->
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>
<!-- this script for slider art -->
<script>
$(document).ready(function() {
$('.owl-carousel').owlCarousel({
loop: true,
autoPlay: true,
responsiveClass: true,
responsive: {
0: {
items: 1,
nav: false
},
600: {
items: 3,
nav: false
},
1000: {
items: 4,
nav: false
}
}
});
});    
</script>
<script type="text/javascript">
function geocodeAddress(geocoder, resultsMap, address) {
//alert(address);
geocoder.geocode({'address': address}, function(results, status) {
if (status === 'OK') {
resultsMap.setCenter(results[0].geometry.location);
var marker = new google.maps.Marker({
map: resultsMap,
position: results[0].geometry.location
});
} else {
//alert('Geocode was not successful for the following reason: ' + status);
}
});
}
</script>

</head>

<body class="bg_gray">
<?php
include_once("../header.php");

?>

<section>
<div class="row no-margin">
<div class="col-md-3 no-padding">
<?php 
include('../component/left-business.php');
?>
</div>
<div class="col-md-9 no-padding">
<div class="head_right_enter">
<div class="row no-margin">
<?php
include('top-head-inner.php');
?>
<div class="col-md-12 no-padding">
<div class="tab-content no-radius otherTimleineBody m_top_20" style="padding: 0px 20px;">
<!--PopularArt-->
<div role="tabpanel" class="tab-pane active" id="video1">
<div class="row">
<div class="col-md-12 topVdoBread">
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/business_directory';?>"><i class="fa fa-home"></i></a></li>
<?php
$ac = new _artCategory;
if(isset($_GET['business'])){
?>
<li class="breadcrumb-item active" aria-current="page"><?php echo ucwords(str_replace('_', ' ', $_GET['business']));?></li><?php

}else{ ?>
<li class="breadcrumb-item active" aria-current="page">All Business Profiles</li> <?php
}
?>
</ol>
</nav>
</div>
</div>
<?php //include('search-form.php');?>


<div class="row ">

<?php
$p = new _spprofiles;
$limit = 10;

$res = $p->readBusDirPro($limit);
//echo $p->ta->sql;
$googleMap = [];

if ($res != false) {
$i = 1;

while ($row = mysqli_fetch_assoc($res)) {
$pid     =$row['spprofiles_idspProfiles'];
$name       = $row["spProfileName"];
$picture    = $row['spProfilePic'];
$about      = $row["spProfileAbout"];
$phone      = $row["spProfilePhone"];
$country    = $row["spProfilesCountry"];
$state      = $row["spProfilesState"];
$city       = $row["spProfilesCity"];
$profiletype        = $row["spProfileType_idspProfileType"];
$profileTypeName    = $row['spProfileTypeName'];
$icon       = $row["spprofiletypeicon"];
$ptypeid    = $row["idspProfileType"];
$email      = $row["spProfileEmail"];
$location   = $row["spprofilesLocation"];
$language   = $row["spprofilesLanguage"];

$pf = new _profilefield;
$query = $pf->read($row["idspProfiles"]);
if ($query != false) {
$cmpnyName = "";
$cmpnyAddress = "";

while ($row2 = mysqli_fetch_assoc($query)) {
if($cmpnyName == ''){
if($row2['spProfileFieldName'] == 'companyname_'){
$cmpnyName = $row2['spProfileFieldValue'];
}
}
if($cmpnyAddress == ''){
if($row2['spProfileFieldName'] == 'companyaddress_' || $row2['spProfileFieldName'] == 'companyaddress'){
$cmpnyAddress = $row2['spProfileFieldValue'];
}
}
}
}

// SHOW ALL COUNTRY , STATE, CITY
$st  = new _state;
$c   = new _country;
$ci  = new _city;
// county name
$result3 = $c->readCountryName($country);
if($result3 != false){
$row3 = mysqli_fetch_assoc($result3);
}
// provision name
$result2 = $st->readStateName($state);
if($result2 != false){
$row5 = mysqli_fetch_assoc($result2);
}
// city name
$result4 = $ci->readCityName($city);

if($result4 != false){
$row4 = mysqli_fetch_assoc($result4);

}
$addr = $row4['city_title'].' '.$row3['country_title'];
array_push($googleMap, $addr);


?>
<div class="col-md-12">
<div class="bg_white dirctrylist m_btm_20">
<div class="row">
<div class="col-md-2">
<a href="<?php echo $BaseUrl.'/friends/?profileid='.$row['idspProfiles'];?>">
<img alt="Profile Pic" class="img-responsive" src="<?php echo ((isset($picture))?" ". ($picture)."":"../img/default-profile.png");?>">
</a>
</div>
<div class="col-md-8">
<div class="" style="padding: 10px 0px;">
<a href="<?php echo $BaseUrl.'/friends/?profileid='.$row['idspProfiles'];?>" class="title"><?php echo $name; ?></a>
<span class="addres"><?php if ($cmpnyAddress != '') { ?>
<p> <?php
$pr = new _spprofiles;
$country = 0;
$state = 0;
$city = 0;
$profile_country = '';
$profile_state='';
$profile_city='';
$result  = $pr->read($pid);
$sprows = mysqli_fetch_assoc($result);
$country = $sprows["spProfilesCountry"];
$state = $sprows['spProfilesState'];
$city = $sprows["spProfilesCity"];
$profile_additional_address = $sprows["address"];
$co = new _country;
$result3 = $co->readCountryName($country);
if ($result3) {
$rowcon = mysqli_fetch_assoc($result3);
$profile_country =  $rowcon['country_title'];
}

$stateObj = new _state;
$result4 = $stateObj->readStateName($state);

if ($result4) {
$rowstate = mysqli_fetch_assoc($result4);
$profile_state =  $rowstate['state_title'];
}

$cityObj = new _city;
$result5 = $cityObj->readCityName($city);
if ($result5) {
$rowcity = mysqli_fetch_assoc($result5);
$profile_city =  $rowcity['city_title'];
}
if ($profile_additional_address != '' || $profile_city != '' || $profile_state != '' || $profile_country != '') {
echo '<i class="fa fa-home"></i>&nbsp&nbsp';


if ($profile_additional_address != '') {

echo $profile_additional_address.','; 
}
if ($profile_city != '') {
echo $profile_city.','; 
}
if ($profile_state != '') {
echo $profile_state.','; 
}
if ($profile_country != '') {
echo $profile_country.'.'; 
}
}
?></p>
<?php  } ?></span>
<p class="detail">
<?php 
if(strlen($about) < 200){
echo $about;
}else{
echo substr($about, 0,200)."...";
} 
?>   
</p>
<div class="btn_Fav_res" >
<?php
$fd = new _favouriteBusiness;
$result_fav = $fd->chkFavAlready($row['idspProfiles'], $_SESSION['pid'], 1);  
if($result_fav){
?>
<span id="favourite_heart<?php echo $row['idspProfiles'];?>"> 
    <span onclick="removfav_heart('<?php echo $row['idspProfiles'];?>','<?php echo $_SESSION['pid'];?>')" >
<a href="javascript:void(0)"  class="removeToProfileFav<?php echo $row['idspProfiles'];?>" data-favourite="1" data-company="<?php echo $row['idspProfiles'];?>" data-pid="<?php echo $_SESSION['pid'];?>">
<span id="addtofavouriteeve"><i class="fa fa-heart"></i></span>  

</a>
</span> 
</span>
<span id="removetofavourite_heart_new<?php echo $row['idspProfiles'];?>"> 
    </span>
<?php
}else{
?>
<span id="favourite_heart<?php echo $row['idspProfiles'];?>"> 
    <span onclick="addfav_heart('<?php echo $row['idspProfiles'];?>','<?php echo $_SESSION['pid'];?>')" > 
<a href="javascript:void(0)"  class="addToProfileFav<?php echo $row['idspProfiles'];?>" data-favourite="1" data-company="<?php echo $row['idspProfiles'];?>" data-pid="<?php echo $_SESSION['pid'];?>">
<span id="addtofavouriteeve"><i class="fa fa-heart-o"></i></span>

</a>
</span>
</span>
<span id="addtofavourite_heart_new<?php echo $row['idspProfiles'];?>">
    </span>
<?php
}

$fd = new _favouriteBusiness;
$result_fav = $fd->chkFavAlready($row['idspProfiles'], $_SESSION['pid'], 2);


if($result_fav){
?>


<span id="star_Resorc<?php echo $row['idspProfiles'];?>"> 
    <span onclick="remov_star('<?php echo $row['idspProfiles'];?>','<?php echo $_SESSION['pid'];?>')" >
<a href="javascript:void(0)" class="removeToResorc<?php echo $row['idspProfiles'];?>" data-favourite="2" data-company="<?php echo $row['idspProfiles'];?>" data-pid="<?php echo $_SESSION['pid'];?>">
<span id="addtofavouriteeve"><i class="fa fa-star "></i></span>

</a>
</span>
</span>
<?php
}else{
?>
<span id="star_Resorc<?php echo $row['idspProfiles'];?>"> 
    <span onclick="add_star('<?php echo $row['idspProfiles'];?>','<?php echo $_SESSION['pid'];?>')" >
<a href="javascript:void(0)" class="addtoResorc<?php echo $row['idspProfiles'];?>" data-favourite="2" data-company="<?php echo $row['idspProfiles'];?>" data-pid="<?php echo $_SESSION['pid'];?>">
<span id="addtofavouriteeve"><i class="fa fa-star-o"></i></span>

</a>
</span>
</span>
<?php
}
?>                                                                          
</div>
<!-- <p class="detail">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, </p> -->
<div class="detail_btn">
<a href="<?php echo $BaseUrl.'/business-directory/detail.php?business='.$row['idspProfiles'];?>" class="btn " >View Business Detail</a>
<a href="<?php echo $BaseUrl.'/friends/?profileid='.$row['idspProfiles'];?>" class="btn " >View Profile</a>
</div>
</div>
</div>
<div class="col-md-2">
<script>
function initMap() {
var geocoder = new google.maps.Geocoder();

<?php
$count = 1;
if(count($googleMap) > 0){
foreach ($googleMap as $key => $value) { ?>

var map<?php echo $count;?> = new google.maps.Map(document.getElementById('map<?php echo $count;?>'), {
zoom: 5,
center: {lat: -34.397, lng: 150.644}
});
var add<?php echo $count;?> = "<?php echo $value; ?>"; 
geocodeAddress(geocoder, map<?php echo $count;?>, add<?php echo $count;?>);
<?php
$count++;
}
}
?>
// =======
}
</script>
<div class="mapbox">
<div id="map<?php echo $i;?>" style="width: 100%;height: 100%;"></div>
</div>
</div>
</div>
</div>
</div>
<?php
$i++;
}
}
?>







</div>
</div>
</div>


</div>
</div>

</div>
</div>
</section>
<div class="space-lg"></div>
<?php 
include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>
<!-- notification js -->
<script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPpH4FGQaj_JIJOViHAeHGAjl7RDeW8OQ&callback=initMap"></script>
</body>
</html>
<?php
} ?>

<script type="text/javascript"> 
    function addfav_heart(a,b){  
       // alert('helloadd');
      // alert(a);
      // alert(b);
   
        var idspProfiles_spProfileCompany = a; 
        var spProfiles_idspProfiles = b;
        var isfavourite = "1";
        $.post("../social/addfavdir.php", { 
            idspProfiles_spProfileCompany: idspProfiles_spProfileCompany,
            spProfiles_idspProfiles: spProfiles_idspProfiles,
            isfavourite: isfavourite
        }, function (response) { 
           
            $('#favourite_heart'+idspProfiles_spProfileCompany).html('<span onclick="removfav_heart('+idspProfiles_spProfileCompany+','+spProfiles_idspProfiles+')" ><a href="javascript:void(0)"  class="removeToProfileFav'+idspProfiles_spProfileCompany+'" data-favourite="1" data-company="'+idspProfiles_spProfileCompany+'" data-pid="'+spProfiles_idspProfiles+'"><span id="addtofavouriteeve"><i class="fa fa-heart"></i></span></a></span>');    
        });
   
}

function removfav_heart(a,b){      

//alert('hellorem');
    //alert(a);
    //alert(b);
        
        var idspProfiles_spProfileCompany = a;
        var spProfiles_idspProfiles = b;
        var isfavourite = "1";
        $.post("../social/remfavdir.php", {
            idspProfiles_spProfileCompany: idspProfiles_spProfileCompany,
            spProfiles_idspProfiles: spProfiles_idspProfiles,
            isfavourite: isfavourite
        }, function (response) {  
           
            $('#favourite_heart'+idspProfiles_spProfileCompany).html('<span onclick="addfav_heart('+idspProfiles_spProfileCompany+','+spProfiles_idspProfiles+')" ><a href="javascript:void(0)"  class="addToProfileFav'+idspProfiles_spProfileCompany+'" data-favourite="1" data-company="'+idspProfiles_spProfileCompany+'" data-pid="'+spProfiles_idspProfiles+'"><span id="addtofavouriteeve"><i class="fa fa-heart-o"></i></span></a></span>');
        });
   
}


function add_star(a,b){  
       // alert('helloadd');
      // alert(a);
      // alert(b);
   
        var idspProfiles_spProfileCompany = a; 
        var spProfiles_idspProfiles = b;
        var isfavourite = "2";
        $.post("../social/addfavdir.php", {
            idspProfiles_spProfileCompany: idspProfiles_spProfileCompany,
            spProfiles_idspProfiles: spProfiles_idspProfiles,
            isfavourite: isfavourite
        }, function (response) {
           
            $('#star_Resorc'+idspProfiles_spProfileCompany).html('<span onclick="remov_star('+idspProfiles_spProfileCompany+','+spProfiles_idspProfiles+')" ><a href="javascript:void(0)"  class="removeToResorc'+idspProfiles_spProfileCompany+'" data-favourite="1" data-company="'+idspProfiles_spProfileCompany+'" data-pid="'+spProfiles_idspProfiles+'"><span id="addtofavouriteeve"><i class="fa fa-star "></span></a></span>');    
        });
   
}  

function remov_star(a,b){      

//alert('hellorem');
    //alert(a);
    //alert(b);
        
        var idspProfiles_spProfileCompany = a;
        var spProfiles_idspProfiles = b;
        var isfavourite = "2";
        $.post("../social/remfavdir.php", {
            idspProfiles_spProfileCompany: idspProfiles_spProfileCompany,
            spProfiles_idspProfiles: spProfiles_idspProfiles,
            isfavourite: isfavourite
        }, function (response) {  
           
            $('#star_Resorc'+idspProfiles_spProfileCompany).html('<span onclick="add_star('+idspProfiles_spProfileCompany+','+spProfiles_idspProfiles+')" ><a href="javascript:void(0)"  class="addtoResorc'+idspProfiles_spProfileCompany+'" data-favourite="1" data-company="'+idspProfiles_spProfileCompany+'" data-pid="'+spProfiles_idspProfiles+'"><span id="addtofavouriteeve"><i class="fa fa-star-o"></i></span></a></span>');
        });
   
}

</script>