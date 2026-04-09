<?php




session_start();

if (isset($_POST['changelc'])) {


$country = $_POST['spPostCountry'];
$state = $_POST['spUserState'];
$city = $_POST['spUserCity'];

$_SESSION['spPostCountry_search'] = $country;
$_SESSION['spUserState_search'] = $state;
$_SESSION['spUserCity_search'] = $city;
}
//echo $state;


//print_r($_SESSION);









?>

<style type="text/css">
   #bbar{ margin-left: 500px;}         
</style>

<div class="col-md-12 no-padding">
<div class="fulmainarttab">
<ul class='nav nav-tabs' id='navtabVdo'>

<li class="pull-right" id="right_infom">
<div class="location-details" style="float:right;margin-right: 20px;">
<p>




<?php



$usercountry = $_SESSION['spPostCountry_search'];
$userstate = $_SESSION['spUserState_search'];
$usercity = $_SESSION['spUserCity_search'];


$co = new _country;

$result3 = $co->readCountry();

if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) {


if (isset($usercountry) && $usercountry == $row3['country_id']) {
$currentcountry = $row3['country_title'];
$currentcountry_id = $row3['country_id'];
}
}
}

if (isset($userstate) && $userstate > 0) {
$countryId = $currentcountry_id;
$pr = new _state;
$result2 = $pr->readState($countryId);
if ($result2 != false) {
while ($row2 = mysqli_fetch_assoc($result2)) {




if (isset($userstate) && $userstate == $row2["state_id"]) {
$currentstate_id = $row2["state_id"];
$currentstate = $row2["state_title"];
}
}
}
}
if (isset($usercity) && $usercity > 0) {
$stateId = $currentstate_id;
$co = new _city;
$result3 = $co->readCity($stateId);
//echo $co->ta->sql;
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) {
if (isset($usercity) && $usercity == $row3['city_id']) {
$currentcity = $row3['city_title'];
$currentcity_id = $row3['city_id'];
}
}
}
}


?>


<?php
if ($currentcountry != "") {

echo $currentcountry . ', ' . $currentstate . ', ' . $currentcity;
} else {
echo "All";
}
?>





<small> <?php //echo $currentcountry.', '.$currentstate.', '.$currentcity ; 
?><br>
<!-- <a style="cursor:pointer; color: #337ab7;" data-toggle="modal" data-target="#myModal">Change Location</a>-->
<?php //if($_SESSION['guet_yes'] != 'yes'){ 
?>
<a style="cursor:pointer; color: #337ab7;" data-toggle="modal" data-target="#myModal">Change Location</a> <?php // } 
?>

</small>
</p>
</div>
</li>

<!--     <li class="pull-right"><a href="<?php //echo $BaseUrl.'/business-directory/';
?>"  class="">Home</a></li>   -->
<!-- <li class=""><a href="<?php echo $BaseUrl . '/business-directory/business.php' ?>"  class="">All Business Companies</a></li>
<li class=""><a href="<?php echo $BaseUrl . '/business-directory/profiles.php' ?>"  class="">All Business Profiles</a></li> -->
<?php if ($_SESSION['guet_yes'] != 'yes') { ?>
<li class=""><a href="<?php echo $BaseUrl . '/business-directory-services/?category=A' ?>"><i class="fa fa-home"></i></a></li>
<li class="hidden-xs"><a style="margin-top: 10px;" href="#" class="seprator">/</a></li>
<li class="<?php echo ($activePage == 1) ? 'active' : ''; ?>"><a href="<?php echo $BaseUrl .'/business-directory/dashboard.php'?>" class="">DashBoard</a>
</li>
<li  style="text-align:center;"><a  id="bbar" class="">MY BUSINESS SPACE</a>   
</li>


<?php } ?>

</ul>
<div class="linebtm"></div>
</div>
</div>




<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">
<form action="" method="post">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Change Current Location <?php //echo $usercountrypost.'=='; 
?></h4>
</div>
<!----action="<?php echo $BaseUrl ?>/post-ad/dopost.php"--->
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


$usercountry = $_SESSION['spPostCountry_search'];
$userstate = $_SESSION['spUserState_search'] ;
$usercity = $_SESSION['spUserCity_search'] ;					

*/





$co = new _country;
$result3 = $co->readCountry();
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) {

//	echo $usercountry; die; 
?>

<option value='<?php echo $row3['country_id']; ?>' <?php echo (isset($_SESSION['spPostCountry_search']) && $_SESSION['spPostCountry_search'] == $row3['country_id']) ? 'selected' : ''; ?>><?php echo $row3['country_title']; ?></option>
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

<label for="spPostingCity" style="float:left;" class="lbl_3">State</label>
<select class="form-control spPostingsState" name="spUserState">
<option>Select State</option>
<?php

if (isset($_SESSION['spUserState_search']) && $_SESSION['spUserState_search'] > 0) {
$countryId = $usercountry;
$pr = new _state;
$result2 = $pr->readState($_SESSION['spPostCountry_search']);
if ($result2 != false) {
while ($row2 = mysqli_fetch_assoc($result2)) { ?>
<option value='<?php echo $row2["state_id"]; ?>' <?php echo (isset($_SESSION['spUserState_search']) && $_SESSION['spUserState_search'] == $row2["state_id"]) ? 'selected' : ''; ?>><?php echo $row2["state_title"]; ?> </option>
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
<label for="spPostingCity" style="float: left;" class="">City</label>
<select class="form-control" name="spUserCity">
<option>Select City</option>
<?php
// $stateId = $userstate;

$co = new _city;
$result3 = $co->readCity($_SESSION['spUserState_search']);
//echo $co->ta->sql;
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) { ?>
<option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($_SESSION['spUserCity_search']) && $_SESSION['spUserCity_search'] == $row3['city_id']) ? 'selected' : ''; ?>><?php echo $row3['city_title']; ?></option> <?php
}
} ?>
</select>

<!--													  <input type="text" class="form-control" id="spPostingCity" name="spPostingsCity" value="<?php // echo (isset($eCity) ? $eCity : $city); 
?>">   -->
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
