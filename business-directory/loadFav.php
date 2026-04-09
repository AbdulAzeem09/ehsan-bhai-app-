
<?php
session_start();
include('../univ/baseurl.php');
function sp_autoloader($class){
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


if(isset($_POST['category']) ){
$category = $_POST['category'];
$pid = $_SESSION['pid'];

$fd = new _favouriteBusiness;
$p = new _spprofiles;
$pf = new _profilefield;


$result = $fd->readmyFavourite($_SESSION['pid'], 1);
//echo $fd->ta->sql;
if($result){
while ($row = mysqli_fetch_assoc($result)) {
$res = $p->readUserId($row['idspProfiles_spProfileCompany']);

if ($res) {
while ($row2 = mysqli_fetch_assoc($res)) {

$country    = $row2["spProfilesCountry"];
$state      = $row2["spProfilesState"];
$city       = $row2["spProfilesCity"];

$query = $pf->read($row2["idspProfiles"]);
if ($query != false) {
$cmpnyName = "";
$cmpnyAddress = "";
$cmpnyCategory = "";

while ($row6 = mysqli_fetch_assoc($query)) {
if($cmpnyName == ''){
if($row6['spProfileFieldName'] == 'companyname_'){
$cmpnyName = $row6['spProfileFieldValue'];
}
}
if($cmpnyAddress == ''){
if($row6['spProfileFieldName'] == 'companyaddress_'){
$cmpnyAddress = $row6['spProfileFieldValue'];
}
}
if($cmpnyCategory == ''){
if($row6['spProfileFieldName'] == 'businesscategory_'){
$cmpnyCategory = $row6['spProfileFieldValue'];
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
$result5 = $st->readStateName($state);
if($result5 != false){
$row5 = mysqli_fetch_assoc($result5);
}
// city name
$result4 = $ci->readCityName($city);
if($result4 != false){
$row4 = mysqli_fetch_assoc($result4);
}
if($category == 1){
?>
<tr>
<td><a href="<?php echo $BaseUrl.'/business-directory/detail.php?business='.$row2['idspProfiles'];?>" class="title" ><?php echo $cmpnyName; ?></a></td>
<td class="text-center"><?php echo $cmpnyCategory; ?></td>
<td class="text-center"><?php echo $row3['country_title'];?></td>
<td class="text-center"><?php echo $row4['city_title'];?></td>
<td class="text-center">
<?php

$result_fav = $fd->chkFavAlready($row2['idspProfiles'], $_SESSION['pid'], 2);
//echo $fd->ta->sql;
if($result_fav){

}else{
?>
<a href="javascript:void(0)" class="addtoResorc btn btn-primary btn-border-radius" data-favourite="2" data-company="<?php echo $row2['idspProfiles'];?>" data-pid="<?php echo $_SESSION['pid'];?>" style="color: #FFF;">
<span id="addtofavouriteeve"><i class="fa fa-star-o"></i></span>
Add To My Resources
</a>
<?php
}
?>
<a href="<?php echo $BaseUrl.'/business-directory/detail.php?business='.$row2['idspProfiles'];?>" data-toggle="tooltip" title="View Business Detail" class="btn"><i class="fa fa-briefcase"></i></a>
<?php

$res_fav = $fd->chkFavAlready($row2['idspProfiles'], $_SESSION['pid'], 1);
if($res_fav){
?>
<a href="javascript:void(0)" class="removeToProfileFav btn" data-favourite="1" data-company="<?php echo $row2['idspProfiles'];?>" data-pid="<?php echo $_SESSION['pid'];?>" >
<span id="addtofavouriteeve"><i class="fa fa-trash"></i></span>
</a>
<?php
}
?>
</td>
</tr>
<?php
}else if($category == $cmpnyCategory){
?>
<tr>
<td><a href="<?php echo $BaseUrl.'/business-directory/detail.php?business='.$row2['idspProfiles'];?>" class="title" ><?php echo $cmpnyName; ?></a></td>
<td class="text-center"><?php echo $cmpnyCategory; ?></td>
<td class="text-center"><?php echo $row3['country_title'];?></td>
<td class="text-center"><?php echo $row4['city_title'];?></td>
<td class="text-center">
<?php

$result_fav = $fd->chkFavAlready($row2['idspProfiles'], $_SESSION['pid'], 2);
//echo $fd->ta->sql;
if($result_fav){

}else{
?>
<a href="javascript:void(0)" class="addtoResorc btn btn-primary btn-border-radius" data-favourite="2" data-company="<?php echo $row2['idspProfiles'];?>" data-pid="<?php echo $_SESSION['pid'];?>" style="color: #FFF;">
<span id="addtofavouriteeve"><i class="fa fa-star-o"></i></span>
Add To My Resources
</a>
<?php
}
?>
<a href="<?php echo $BaseUrl.'/business-directory/detail.php?business='.$row2['idspProfiles'];?>" data-toggle="tooltip" title="View Business Detail" class="btn"><i class="fa fa-briefcase"></i></a>
<?php

$res_fav = $fd->chkFavAlready($row2['idspProfiles'], $_SESSION['pid'], 1);
if($res_fav){
?>
<a href="javascript:void(0)" class="removeToProfileFav btn" data-favourite="1" data-company="<?php echo $row2['idspProfiles'];?>" data-pid="<?php echo $_SESSION['pid'];?>" >
<span id="addtofavouriteeve"><i class="fa fa-trash"></i></span>
</a>
<?php
}
?>
</td>
</tr>
<?php
}
}
}
}
}
}
?>


