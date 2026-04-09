<?php
include('../univ/baseurl.php');
session_start();

//		$_SESSION['spPostCountry'] = '43';

//	$_SESSION['spPostState'] = '43';
//echo $_SESSION['spPostState'];
//$_SESSION['spPostCity'] =  '11818';




if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "services/";
include_once ("../authentication/check.php");





}else{
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$_GET["categoryID"] = "7";
$_GET["categoryName"] = "Services";

$header_servic = "header_servic";
$u = new _spuser;
$res = $u->read($_SESSION["uid"]);


//print_r($_SESSION); die;

if(isset($_POST['changelc'])){
//print_r($_POST); die;						
$usercountry =$_POST['spPostCountry'];
$userstate =	$_POST['spUserState'];
$usercity = $_POST['spUserCity'];


$_SESSION['spPostCountry'] =   $usercountry ;																	
$_SESSION['spPostState'] = $userstate;	
$_SESSION['spPostCity'] =  $usercity;

//	print_r($_SESSION); die;
}
else {

if($_SESSION['spPostCountry'] !=""){

$usercountry = $_SESSION['spPostCountry'];													
$userstate = $_SESSION['spPostState'];															
$usercity = $_SESSION['spPostCity'];  

}



else {
$ruser = mysqli_fetch_assoc($res);
$usercountry = $ruser["spUserCountry"];
$userstate = $ruser["spUserState"]; 
$usercity = $ruser["spUserCity"];

$_SESSION['spPostCountry'] =   $usercountry ;																	
$_SESSION['spPostState'] = $userstate;	
$_SESSION['spPostCity'] =  $usercity;


}

}


//	echo $usercountry.'----'.$userstate.'------'.$usercity; die;


/*				


*/


?>









<?php

$p = new _classified;
$r = $p->read($_GET["postid"]);
//echo $p->ta->sql;
if ($r != false) {
while ($row = mysqli_fetch_assoc($r)) {
$usercountry = $row['spPostCountry'];
$userstate = $row['spUserState'];
$usercity = $row['spUserCity'];

}
}



?>
<!DOCTYPE html>
<html lang="en-US">

<head>

<?php include('../component/f_links.php');?>
<?php 
$conn = _data::getConnection();
$sql1 = "SELECT banner_img FROM service_banner  WHERE id = 2"; 
$rows1 = mysqli_query($conn, $sql1);
$b_img = mysqli_fetch_assoc($rows1);
$banner_image = $b_img['banner_img'];
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
<style>
#service-page{
background-image:url(<?php echo $BaseUrl.'/backofadmin/content/upload/'.$banner_image; ?>);
background-size:100%;
background-repeat:no-repeat;
padding:50px 0;
min-height:400px;



}



.list-wrapper {
padding: 15px;
overflow: hidden;
}

.list-wrapper2 {
padding: 15px;
overflow: hidden;
}

.list-item {
border: 1px solid #EEE;
background: #FFF;
margin-bottom: 10px;
padding: 10px;
box-shadow: 0px 0px 10px 0px #EEE;
display: contents;
}

.list-item h4 {
color: #FF7182;
font-size: 18px;
margin: 0 0 5px;	
}

.list-item p {
margin: 0;
}

.list-item2 {
border: 1px solid #EEE;
background: #FFF;
margin-bottom: 10px;
padding: 10px;
box-shadow: 0px 0px 10px 0px #EEE;
display: contents;
}

.list-item2 h4 {
color: #FF7182;
font-size: 18px;
margin: 0 0 5px;	
}

.list-item2 p {
margin: 0;
}

.simple-pagination ul {
margin: 0 0 20px;
padding: 0;
list-style: none;
text-align: center;
}

.simple-pagination li {
display: inline-block;
margin-right: 5px;
}

.simple-pagination li a,
.simple-pagination li span {
color: #666;
padding: 5px 10px;
text-decoration: none;
border: 1px solid #17a3af;
background-color: #17a3af;
box-shadow: 0px 0px 10px 0px #EEE;
}

.simple-pagination .current {
color: #FFF;

}
.heading07 h2 span, .heading08 h2 span {
color: #6a7e3b;
}

.butn_service {

font-size: 20px;
font-family: MarksimonRegular;
color: #fff;
text-transform: uppercase;
line-height: 1.2;
border: 0.5px solid #09a4ae;
background-color: #09a4ae;
border-radius: 0;
padding: 16px 55px;
transition: .3s all ease-in-out;
margin-bottom: 30px;
}
.service-sec {
margin-top: -20px;
padding: 0px 0;
}


.smalldot{
white-space: nowrap;
width: 90px;
overflow: hidden;
text-overflow: ellipsis;
}

.postsearch{
margin-left:300px;
margin-right:300px;
}
</style>

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
}																								}                                                                                             }
} ?>                       



<?php
//$p   = new _classified;

// $local= $p->locall($_SESSION['spPostCountry'],$_SESSION['spPostState'],$_SESSION['spPostCity']);
//if($local){
//while ($rowlocal = mysqli_fetch_assoc($local)){
// echo $rowlocal['spPostCountry']."<br>";
// echo $rowlocal['spPostState']."<br>";
//  echo $rowlocal['spPostCity']."<br>";
//}

// }
//die("-----------");

?>


<body class="bg_gray">
<!-- Modal -->
<div id="Notabussiness" class="modal fade" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content no-radius sharestorepos ">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>

</div>
<div class="modal-body adsbuspro text-center">
<h1><i class="fa fa-info" aria-hidden="true"></i></h1>
<h2>Please switch to your bussiness profile to <span>post ads</span></h2>
<a href="<?php echo $BaseUrl.'/my-profile';?>" class="btn butn_service" style="margin-bottom: 45px;">Switch/Create Profile</a>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Cancel</button>
</div>
</div>

</div>
</div>
<?php
include_once("../header.php");
?>
<div class="loadbox">
<div class="loader"></div>
</div>
<section class="main_box no-padding" id="service-page">
<div id="btnn" class="container">
<div class="row">
<div class="col-md-12">
<div class="text-center">
<h2>Service Connects us</h2>
<!-- <p>Discover and share a constantly expanding mix of music and videos from emerging and major artists around the world.</p> -->
<div class="row"><div class="col-md-3"></div><div class="col-md-6"> <div  class="mainServiceSearch">
<ul class="nav nav-pills" id="ser_ser_tab">
<li class="active"><a data-toggle="pill" href="#home">Search A post</a></li>
<!-- <li><a data-toggle="pill" href="#menu1">Person</a></li> -->
</ul>
<div class="tab-content">
<div id="home" class="tab-pane fade in active">
<div class="in_ser_serch">
<form class="" action="search.php" method="post">
<div class="row">
<div class="form-group col-md-8">
<input type="text" class="form-control" name="txtSearchBox" placeholder="Search A Post">
</div>
<!-- <div class="col-md-3">
<div class="loadUserState">
<label for="spPostingCity" style="float:left; color: white;" class="lbl_3">State</label>
<select class="form-control spPostingsState" name="spPostingsState">
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
</div>-->
<!--  <div class="col-md-3">
<div class="loadCity">
<div class="form-group">
<label for="spPostingCity" style="float: left;color: white;" class="">City</label>
<select class="form-control" name="spUserCity" >
<option>Select City</option>
<?php 
$stateId = $userstate;

$co = new _city;
$result3 = $co->readCity($stateId);
//echo $co->ta->sql;
if($result3 != false){
while ($row3 = mysqli_fetch_assoc($result3)) { ?>
<option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($usercity) && $usercity == $row3['city_id'])?'selected':''; ?> ><?php echo $row3['city_title'];?></option> <?php
}

} ?>
</select>
<input type="text" class="form-control" id="spPostingCity" name="spPostingsCity" value="<?php echo (isset($eCity) ? $eCity : $city); ?>"> 
</div>
</div>
</div>-->
<div class="pull-right" style="margin-right:20px;" class="col-md-3">
<button  type="submit" name="btnSearch" class="btn btn-default">Search</button>
</div>

</div>

</form>
</div>

</div>
<!-- <div id="menu1" class="tab-pane fade">
<div class="in_ser_serch">
<form class="" action="/action_page.php">
<div class="form-group no-margin">
<input type="text" class="form-control" placeholder="Search Person Services">
</div>
<button type="submit" class="btn btn-default">Search</button>
</form>
</div>
</div>
-->
</div>  
</div></div><div class="col-md-3"></div></div>
<script type="text/javascript">
//==========ON CHANGE LOAD CITY==========
$(".spPostingsState").on("change", function () {


var state = this.value;
$.post("loadUserCity.php", {state: state}, function (r) {
//alert(r);
$(".loadCity").html(r);
});

});
//==========ON CHANGE LOAD CITY==========
</script>
<?php

if($_SESSION['ptid'] != 2 && $_SESSION['ptid'] != 5){ 
$u = new _spuser;
// IS EMAIL IS VERIFIED
$p_result = $u->isverify($_SESSION['uid']);
if ($p_result == 1) {
$pv = new _postingview;
$reuslt_vld = $pv->chekposting(7,$_SESSION['pid']);
if ($reuslt_vld == false) {
?>
<a href="<?php echo $BaseUrl.'/post-ad/services/?post';?>" class="btn butn_service m_top_20">Post An Ad For Free</a>
<!-- <a href="<?php echo $BaseUrl.'/services/dashboard/';?>" style="margin-bottom:10px;" class="btn butn_service m_top_20">dashboard</a>-->
<?php
}

}
}else{ ?>

<a href="javascript:void(0)" class="btn butn_service m_top_20"  data-toggle="modal" data-target="#Notabussiness" >Post An Ad For Free</a>
<!--<a href="<?php echo $BaseUrl.'/services/dashboard/';?>"  style="margin-bottom:10px;" class="btn butn_service m_top_20">dashboard</a>--><?php
}

?>


<a href="<?php echo $BaseUrl.'/services/dashboard/';?>" style=" margin-bottom: 10px;" class="btn butn_service ">dashboard</a>


</div>

</div>
</div>
</div>
</section>


<?php
$p   = new _classified;


echo "<br><br>";

$commservice = $p->commser(0);

if($commservice){
while ($roww = mysqli_fetch_assoc($commservice)){
//print_r($roww['clasifiedTitle']);
// echo "<br>";
}
}
//$conn = _data::getConnection();

// $sqlq = "SELECT * FROM clasified_category WHERE clasifiedType = 1";
// $result = mysqli_query( $conn , $sqlq);
//if(mysqli_num_rows($result) > 0){

// while($row = mysqli_fetch_array($result)){
// print_r($row);
// }
// }
// die("----------");
?>
<section class="service-sec">

<div style="float:right">
<p >
<small>Current Location: <?php echo $currentcountry.', '.$currentstate.', '.$currentcity ; ?><br>
<!-- <a style="cursor:pointer; color: #337ab7;" data-toggle="modal" data-target="#myModal">Change Location</a>-->
<a style="cursor:pointer; color: #337ab7;" data-toggle="modal"  data-target="#myModal">Change Location</a>

</small>
</p>
</div>


<div class="container">

<div  class="row">
<!--<a style="float:left;margin-left: 15px;"	href="<?php echo $BaseUrl.'/services/dashboard/';?>" style=" margin-bottom: 30px;" class="btn butn_service ">dashboard</a>-->
</div> 
<!-- div class="row">
<div class="col-md-5ths">
<div class="music_box bg_pink_serv">
<a href="<?php echo $BaseUrl.'/store/';?>">
<p>Sale Items <span class="pull-right"><i class="fa fa-arrow-right"></i></span></p>
<img src="<?php echo $BaseUrl?>/assets/images/service/service-1.jpg" class="img-responsive">
</a>
</div>
</div>
<!--    <div class="col-md-5ths">
<div class="music_box bg_dark_red_serv">
<a href="<?php echo $BaseUrl.'/events/';?>">
<p>Local Events<span class="pull-right"><i class="fa fa-arrow-right"></i></span></p>
<img src="<?php echo $BaseUrl?>/assets/images/service/service-2.jpg" class="img-responsive">
</a>
</div>
</div> >

<div class="col-md-5ths">
<div class="music_box bg_yelow_serv ">
<a href="<?php echo $BaseUrl.'/job-board/';?>">
<p>Find Jobs <span class="pull-right"><i class="fa fa-arrow-right"></i></span></p>
<img src="<?php echo $BaseUrl?>/assets/images/service/service-3.jpg" class="img-responsive">
</a>
</div>
</div>

<div class="col-md-5ths">
<div class="music_box bg_purple_mus_dark">
<a href="<?php echo $BaseUrl.'/services/dashboard/favourite.php';?>">
<p>My Favourites <span class="pull-right"><i class="fa fa-arrow-right"></i></span></p>
<img src="<?php echo $BaseUrl?>/assets/images/videos/video-5.jpg" class="img-responsive">
</a>
</div>
</div>
<div class="col-md-5ths">
<div class="music_box bg_blue_serv">
<?php if($_SESSION['ptid'] != 2 && $_SESSION['ptid'] != 5){  ?>
<a href="<?php echo $BaseUrl.'/services/dashboard/';?>">
<?php }else{?>

<a href="<?php echo $BaseUrl.'/services/dashboard/dashboard.php';?>">

<?php }?>
<p>My Dashboard <span class="pull-right"><i class="fa fa-arrow-right"></i></span></p>
<img src="<?php echo $BaseUrl?>/assets/images/service/service-5.jpg" class="img-responsive">
</a>
</div>
</div>
<div class="col-md-5ths">
<div class="music_box bg_dark_red_serv">
<a href="<?php echo $BaseUrl.'/services/allads.php';?>">
<p>Browse All ads<span class="pull-right"><i class="fa fa-arrow-right"></i></span></p>
<img src="<?php echo $BaseUrl?>/assets/images/icon/home/classified-ads.png" class="img-responsive">
</a>
</div>
</div>
</div -->

<div class="row">
<div class="col-md-6">
<div class="row ">
<div class="col-md-12">
<a href="<?php echo $BaseUrl.'/services/allads.php';?>"><h3  style="color:white;" ><b>Community</b></h3></a>
</div>
</div>
<div class="bg_white servicBox m_btm_20" style="min-height: 206px;">
<div class="row">

<?php

$commservice = $p->commser(0);

if($commservice){
while ($roww = mysqli_fetch_assoc($commservice)){ ?>
<div class="col-md-4">

<div class="box_service ">

<a class="smalldot" href="<?php echo $BaseUrl.'/services/allads.php?catName='.$roww['clasifiedTitle'];?>"><?php echo $roww['clasifiedTitle']?></a>
</div>
</div>
<?php  }
}		?>




</div>
</div>
</div>
<div class="col-md-6">
<div class="row ">
<div class="col-md-12">
<a href="<?php echo $BaseUrl.'/services/allads.php';?>"><h3 style="color:white;"><b>Services</b></h3></a>
</div>
</div>
<div class="bg_white servicBox">
<div class="row">
<?php

$commservice = $p->commser(1);

if($commservice){
while ($roww = mysqli_fetch_assoc($commservice)){ ?>
<div class="col-md-4">

<div class="box_service ">

<a  class="smalldot" href="<?php echo $BaseUrl.'/services/allads.php?catName='.$roww['clasifiedTitle'];?>"><?php echo $roww['clasifiedTitle']?></a>
</div>
</div>
<?php  }
}		?>



</div>
</div>
</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="title">
<h2>Latest Products</h2>
</div>
</div>
<div class="list-wrapper"> 
<?php



$orderBy = "DESC"; 
$p   = new _classified;
$pf  = new _postfield;
$res = $p->publicpost_music($_GET["categoryID"],$_SESSION['spPostCountry'],$_SESSION['spPostState'],$_SESSION['spPostCity'], $orderBy);
//echo $p->ta->sql;
if($res){
while ($row = mysqli_fetch_assoc($res)){
$result_pf = $pf->read($row['idspPostings']);
//echo $pf->ta->sql."<br>";

$sercom =  $row['spPostSelection'];
/*       if($result_pf){
$sercom = "";

while ($row2 = mysqli_fetch_assoc($result_pf)) {
if($sercom == ''){
if($row2['spPostFieldName'] == 'spPostSelection_'){
$sercom = $row2['spPostFieldValue'];
}
}
}
}*/
?>
<div class="list-item"> 
<div class="col-md-3">
<div class="ser_box_1">
<a href="<?php echo $BaseUrl.'/services/detail.php?postid='.$row['idspPostings'];?>">
<?php
$pic = new _classifiedpic;
$res2 = $pic->readFeature($row['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >"; ?>
<?php
} else{
echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>"; ?>
<?php
} ?>
</a>

<a href="<?php echo $BaseUrl.'/services/detail.php?postid='.$row['idspPostings'];?>" class="title">
<?php 
if(strlen($row['spPostingTitle']) < 15){
echo ucwords(strtolower($row['spPostingTitle']));
}else{
echo substr(ucwords(strtolower($row['spPostingTitle'])), 0,15)."...";
} 
?>   

</a>


<span class="views"><?php echo (isset($sercom) && $sercom != '')?$sercom:'&nbsp;'; ?></span>
<span class="expiry">Expires on <?php echo $row['spPostingExpDt'];?></span>
<a href="<?php echo $BaseUrl.'/services/detail.php?postid='.$row['idspPostings'];?>" class="btn ">View Detail</a>
</div>
</div>
</div>
<?php
}

?>
<!-- 
<a href="<?php echo $BaseUrl.'/services/category.php';?>" class="btn btn-info">View All</a>    --> 

<?php

}
else {
echo "<h3>No Product Found , Please Select Other Location</h3>";
} ?>


</div>
<div id="pagination-container"></div>
</div>


</div>
</section>





<?php
/*if(isset($_POST['changelc'])){

$usercountry =$_POST['spPostCountry'];
$userstate =	$_POST['spPostState'];
$usercity = $_POST['spPostCity'];


}
*/
//	$_SESSION['spPostCountry'] = $usercountry;

//$_SESSION['spPostState'] = $userstate;
//echo $_SESSION['spPostState'];
//$_SESSION['spPostCity'] =  $usercity;



//echo $_SESSION['spPostState']; die('-------------');






?>

<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">
<form action= "" method="post">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Change Current Location <?php //echo $usercountrypost.'=='; ?></h4>
</div>
<!----action="<?php echo $BaseUrl?>/post-ad/dopost.php"--->
<div class="modal-body"> 
<div class="row">

<div class="col-md-4">
<div class="form-group">
<label for="spPostCountry_" class="lbl_2">Country</label>
<select class="form-control " name="spPostCountry" id="spUserCountry">
<option value="">Select Country </option> 
<?php

//spPostCountry 
//                                                    if (isset($_GET["postid"])) {






/*$_SESSION['spPostCountry'] = $usercountry;

$_SESSION['spPostState'] = $userstate;
//echo $_SESSION['spPostState'];
$_SESSION['spPostCity'] =  $usercity; */

/*

$usercountry =$_SESSION['spPostCountry']

$userstate = $_SESSION['spPostState'];
//echo $_SESSION['spPostState'];
$usercity; = $_SESSION['spPostCity'];  

*/





$co = new _country;
$result3 = $co->readCountry();
if($result3 != false){
while ($row3 = mysqli_fetch_assoc($result3)) {

//	echo $usercountry; die; 
?>

<option value='<?php echo $row3['country_id'];?>' <?php echo (isset($_SESSION['spPostCountry']) && $_SESSION['spPostCountry'] == $row3['country_id'])?'selected':''; ?>   ><?php echo $row3['country_title'];?></option>
<?php
}
}
?>
</select>
<!-- <input type="text" class="form-control" id="spPostingCountry" name="spPostingsCountry" value="<?php echo (isset($eCountry) ? $eCountry : $country); ?>"> -->
</div>
</div>
<div class="col-md-4">
<div class="loadUserState">
<label for="spPostState_" class="lbl_3">State</label>
<select class="form-control" name="spPostState" id="spUserState">
<option>Select State</option>
<?php 
if (isset($_SESSION['spPostState']) && $_SESSION['spPostState'] > 0) {
//die('xxxxxxxxxxx');
$countryId = $_SESSION['spPostCountry'];
$pr = new _state;
$result2 = $pr->readState($countryId);
if($result2 != false){
while ($row2 = mysqli_fetch_assoc($result2)) { ?>
<option value='<?php echo $row2["state_id"];?>' <?php echo (isset($_SESSION['spPostState']) && $_SESSION['spPostState'] == $row2["state_id"] )?'selected':'';?> ><?php echo $row2["state_title"];?> </option>
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
<label for="spPostCity_">City</label>
<select class="form-control" name="spPostCity" id="spPostCity_" >
<option>Select City</option>
<?php 
if (isset($_SESSION['spPostCity']) && $_SESSION['spPostCity'] > 0) {
$stateId = $_SESSION['spPostState'];
$co = new _city;
$result3 = $co->readCity($stateId);
//echo $co->ta->sql;
if($result3 != false){
while ($row3 = mysqli_fetch_assoc($result3)) { ?>
<option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($_SESSION['spPostCity']) && $_SESSION['spPostCity'] == $row3['city_id'])?'selected':''; ?> ><?php echo $row3['city_title'];?></option> <?php
}
}
} ?>
</select>
<!-- <input type="text" class="form-control" id="spPostingCity" name="spPostingsCity" value="<?php echo (isset($eCity) ? $eCity : $city); ?>"> -->
</div>
</div>
</div>
<!--  <div class="col-md-6">
<div class="form-group">
<label for="spPostingCountry">Country</label>
<input type="text" class="form-control" id="spPostingCountry" name="spPostingsCountry" value="<?php echo (isset($eCountry) ? $eCountry : $country); ?>">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="spPostingCity">Location/City</label>
<input type="text" class="form-control" id="spPostingCity" name="spPostingsCity" value="<?php echo (isset($eCity) ? $eCity : $city); ?>">
</div>
</div> -->

</div>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-primary btn-border-radius"  name ="changelc"  >Change</button>
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
}?>

<script>

// jQuery Plugin: http://flaviusmatis.github.io/simplePagination.js/

var items = $(".list-wrapper .list-item");
var numItems = items.length;
var perPage = 8;

items.slice(perPage).hide();

$('#pagination-container').pagination({
items: numItems,
itemsOnPage: perPage,
prevText: "&laquo;",
nextText: "&raquo;",
onPageClick: function (pageNumber) {
var showFrom = perPage * (pageNumber - 1);
var showTo = showFrom + perPage;
items.hide().slice(showFrom, showTo).show();
}
});



</script>