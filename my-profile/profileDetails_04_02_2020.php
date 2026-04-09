<?php
//session_start();
function sp_autoloader($class){
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$p = new _spprofiles;
$rpvt = $p->read($_POST["pid"]);
//echo $p->ta->sql;
if ($rpvt != false){
$row = mysqli_fetch_assoc($rpvt);
$default = $row['spProfilesDefault'];
$status = $row['spAccountStatus'];
$publish = $row['spprofilesPublished'];

}


$pt = new _profiletypes;
$rpt = $pt->readProfileType($_POST["ptid"]);
if ($rpt != false){
$rows = mysqli_fetch_assoc($rpt);
}

?>
<div class="right_profile">
<div class="right_profile_top">
<div class="row">
<input type="hidden" id="idspProfiles_" name="spProfileName" value=<?php echo $_POST["pid"]; ?>>
<input type="hidden" id="idspProfilesType_" name="idspProfilesType_" value=<?php echo $_POST["ptid"]; ?>>

<!--Hidden data of profile-->
<input type="hidden" id="idspProfileEmail_" value=<?php echo $row['spProfileEmail']; ?>>
<input type="hidden" id="idspProfilePhone_" value=<?php echo $row['spProfilePhone']; ?>>				
<input type="hidden" id="idspProfileAbout_" value=<?php echo $row['spProfileAbout']; ?>>
<input type="hidden" id="idspProfileCountry_" value=<?php echo $row['spProfilesCountry']; ?>>
<input type="hidden" id="idspProfileCity_" value=<?php echo $row['spProfilesCity']; ?>>


<div class="col-md-2 col-xs-12 no-padding">
<?php
if($row['spProfilePic']){
echo "<img  alt='profile-Pic' class='img-responsive' src=' ".($row['spProfilePic'])."' >" ;
}else{
echo "<img  alt='profile-Pic' class='img-responsive' src='../assets/images/icon/blank-img.png' >" ;
}
?>
</div>
<div class="col-md-10 col-xs-12">

<div class="text-right pull-right">
<a href="#addProfile" role="button" class="btn btn-tsp btn-border-radius no-radius editprofile" data-toggle="modal" id="sp-profile-id" data-ptid="<?php echo $_POST["ptid"]; ?>" data-pid="<?php echo $_POST["pid"];?>" data-profiletype="<?php echo $row['spProfileTypeName'];?>"> Edit!</a>

<?php
if($row['spProfilesDefault'] == 1){

}else{
echo "<button type='button' id='makedefaultprofile' data-profileid='".$_POST["pid"]."' data-profiletype='".$rows['spProfileTypeName']."' class='btn butn_save'>Make default</button>";
}
?>						
</div>
<h2><?php echo $_POST["pname"]; ?></h2>
<h5><?php echo $row['spProfileTypeName'];?> Profile</h5>
<p><i class="fa fa-map-marker"></i> 
<?php
$co = new _city;
$result5 = $co->readCityName($row['spProfilesCity']);
if ($result5) {
$row5 = mysqli_fetch_assoc($result5);
echo $row5['city_title']. ", ";
}

$co = new _country;
$result3 = $co->readCountryName($row['spProfilesCountry']);
if ($result3) {
$row3 = mysqli_fetch_assoc($result3);
echo $row3['country_title'];
}
?>
</p>
<p class="text-justify"><?php echo $row['spProfileAbout'];?></p>
</div>
</div>
<div class="row profilebody ">
<div class="col-md-12 no-padding">
<div class="table-responsive">
<table class="table tbl_profile table-striped table-hover">
<tbody>
<tr>
<td colspan="2"><h4 class="heading12">Personal Information</h4></td>
</tr>
<tr>
<td>Profile Name</td>
<td><?php echo $_POST["pname"]; ?></td>
</tr>
<tr>
<td>Personal Phone</td>
<td><?php echo $row["spProfileCntryCode"].$row['spProfilePhone'];?></td>
</tr>
<tr>
<td>Email</td>
<td><?php echo $row['spProfileEmail'];?></td>
</tr>
<tr>
<td>Country</td>
<td>
<?php
$co = new _country;
$result3 = $co->readCountryName($row['spProfilesCountry']);
if ($result3) {
$row3 = mysqli_fetch_assoc($result3);
echo $row3['country_title'];
}
?>
</td>
</tr>
<tr>
<td>State</td>
<td>
<?php
$co = new _state;
$result4 = $co->readStateName($row['spProfilesState']);
if ($result4) {
$row4 = mysqli_fetch_assoc($result4);
echo $row4['state_title'];
}
?>
</td>
</tr>
<tr>
<td>City</td>
<td>
<?php
$co = new _city;
$result5 = $co->readCityName($row['spProfilesCity']);
if ($result5) {
$row5 = mysqli_fetch_assoc($result5);
echo $row5['city_title'];
}
?>
</td>
</tr>
<tr>
<td>Profile Type</td>
<td><?php echo $row['spProfileTypeName'];?> Profile</td>
</tr>
<!--Testing XTRA FIELDS-->
<?php
$c = new _profilefield;
$r = $c->read($_POST["pid"]);
if($r != false){
while($rw = mysqli_fetch_assoc($r)){
if ($rw["spProfileFieldLabel"] != '') {
?>
<tr>
<td><?php echo $rw["spProfileFieldLabel"];?></td>
<td><?php echo $rw["spProfileFieldValue"];?></td>
</tr>
<?php
}

}
}
?>
<!--Testing Complete--> 

<!--<div class="form-group">-->
<?php
$s = new _spshipping;
$result = $s->read($_POST["pid"]);
if($result != false){
$rset = mysqli_fetch_assoc($result);	
$North  = $rset["spShippingNorthAmerica"];
$South	= $rset["spShippingSouthAmerica"];
$East	= $rset["spShippingEastEurope"];
$West 	= $rset["spShippingWestEurope"];
$Middle = $rset["spShippingMiddleEast"];
$Southeast  = $rset["spShippingSoutheastAsia"];
$Australia 	= $rset["spShippingAustralia"];
}								

?>
<!--</div>-->

</tbody>
</table>
</div>
<!--THIS IS FOR MEMBERSHIP AREA-->
<div class="form-group">
<?php
if($_POST["ptid"] == 1){
echo "<div class='row no-margin'>";
echo "<div class='col-md-3'><label class='control-label'>Membership</label></div>";
$m = new _spmembership;
$r = $m->readmembershiptype($_POST["pid"]);
echo "<div class='col-md-9'>";
if($r != false)
{
$rw = mysqli_fetch_assoc($r);
echo "<p class='form-control-static'>".$rw["spMembershipName"]."</p>";
}
echo "</div>";
echo "</div>";
}
?>
</div>
<div class="alert alert-success <?php echo (($_POST["ptid"] == 5 || $_POST["ptid"] == 6)?"":"hidden" );?>">
<strong style="font-size:18px;">Note!</strong> <span style="font-size:18px;">These profiles are Private profiles,. Only the profiles you are communicate with through these profiles will see these profiles but no one else.</span>
</div>
<div class="dePro <?php echo ($_POST["ptid"] == 4)?'hidden':''; ?>">
<a href="#" class="btn butn_draf <?php echo ($status == 0 ?"activate":"deactivate");?>  " id="activedeact" data-profileid="<?php echo $_POST["pid"]; ?>"><?php echo ($status == 0 ?"Activate":"Deactivate");?></a>
</div>
</div>
</div>
</div>



</div>
<!--user data start-->
<div class="panel panel-primary <?php echo ($_POST["ptid"] == 1)?'':'hidden';?>">
<div>
<div class="row">
<div class="col-md-12">
<?php
if($_POST["ptid"] == 1){
echo "<ul class='nav nav-tabs' id='navtabprofile'>
<li class='active' role='presentation'><a href='#aboutstore'  aria-controls='sp-activePost' role='tab' data-toggle='tab'>About Store</a></li>



<li  role='presentation'><a href='#aboutreturn'  aria-controls='sp-activePost' role='tab' data-toggle='tab'>Returns and Refunds</a></li>
</ul>";
}
?>
</div>
</div>

<!--Testing-->
<div class="tab-content <?php echo ($_POST["ptid"] == 1 ? '""' : "hidden"); ?>" style="margin-left:10px; margin-right:20px;">
<div role="tabpanel" class="tab-pane active  store"  id="aboutstore" >
<?php
$s = new _spprofiles;
$res = $s->read($_POST["pid"]);
if($res != false)
{
$store = mysqli_fetch_assoc($res);
$aboutstore = $store["spProfilesAboutStore"];
}
?>
<form action="aboutstore.php" method="post" class="profileform" >
<input type="hidden" name="spProfileid_" value=<?php echo $_POST["pid"];?>>
<div class="form-group">
<label for="aboutstore">About Store</label>
<textarea class="form-control" id="aboutstore" name="spProfilesAboutStore" rows="4" placeholder="Type about store.."><?php echo $aboutstore ; ?></textarea>
</div>
<button type="submit" class="btn btn-success btn-border-radius">Submit</button>
</form>
</div>

<div role="tabpanel"  class= "tab-pane store hidden"  id="aboutshipping" >
<form action="addshipping.php" method="post" class="profileform" >
<input type="hidden" name="spProfiles_idspProfiles" value=<?php echo $_POST["pid"];?>>
<div class="row">
<div class="col-md-4">
<label for="basic-url">North America</label>
<div class="input-group">
<input type="text" class="form-control" aria-describedby="basic-addon3" name="spShippingNorthAmerica" value="<?php if(isset($North)){ echo $North; }?>">
<span class="input-group-addon" id="basic-addon3">%</span>
</div>
</div>
<div class="col-md-4">
<label for="basic-url">South America</label>
<div class="input-group">
<input type="text" class="form-control" aria-describedby="basic-addon3" name="spShippingSouthAmerica" value="<?php if(isset($South)){ echo $South;}?>">
<span class="input-group-addon" id="basic-addon3">%</span>
</div>
</div>
<div class="col-md-4">
<label for="basic-url">East Europe</label>
<div class="input-group">
<input type="text" class="form-control"  aria-describedby="basic-addon3" name="spShippingEastEurope" value="<?php if(isset($East)){ echo $East;}?>">
<span class="input-group-addon" id="basic-addon3">%</span>
</div>
</div>
<div class="col-md-4">
<label for="basic-url">West Europe</label>
<div class="input-group">
<input type="text" class="form-control"  aria-describedby="basic-addon3" name="spShippingWestEurope" value="<?php if(isset($West)){ echo $West ;}?>">
<span class="input-group-addon" id="basic-addon3">%</span>
</div>
</div>

<div class="col-md-4">
<label for="basic-url">Middle East</label>
<div class="input-group">
<input type="text" class="form-control" aria-describedby="basic-addon3" name="spShippingMiddleEast" value="<?php if(isset($Middle)){ echo $Middle;}?>">
<span class="input-group-addon" id="basic-addon3">%</span>
</div>
</div>
<div class="col-md-4">
<label for="basic-url">Southeast Asia</label>
<div class="input-group">
<input type="text" class="form-control" aria-describedby="basic-addon3" name="spShippingSoutheastAsia" value="<?php if(isset($Southeast)){ echo $Southeast;}?>">
<span class="input-group-addon" id="basic-addon3">%</span>
</div>
</div>
<div class="col-md-4">
<label for="basic-url">Australia</label>
<div class="input-group">
<input type="text" class="form-control" aria-describedby="basic-addon3" name="spShippingAustralia" value="<?php if(isset($Australia)){ echo $Australia;}?>">
<span class="input-group-addon" id="basic-addon3">%</span>
</div>
</div>
</div>
<button type="submit" class="btn btn-success btn-border-radius" id="shippingratesbutton" style="margin-top:10px;">Submit</button>
</form>
</div>

<div role="tabpanel"  class= "tab-pane returnrefund"  id="aboutreturn" >

<?php
$s = new _returnrefund;
$result = $s->read($_POST["pid"]);
if($result != false)
{
$rset = mysqli_fetch_assoc($result);	
$day  = 	   $rset["spRetRefundDays"];
$money	= 	   $rset["spRetRefundMoney"];
}								

?>
<form action="addreturnrefund.php" method="post" class="profileform" >
<div class="row">
<input type="hidden" name="spProfiles_idspProfiles" value=<?php echo $_POST["pid"];?>>
<div class="col-md-6">
<label for="basic-url">Return</label>
<div class="input-group">
<input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="spRetRefundDays" value="<?php if(isset($day)){ echo $day ;}?>">
<span class="input-group-addon" id="basic-addon3">Days</span>
</div>
</div>
<div class="col-md-6">
<label for="basic-url">Refunds</label>
<div class="input-group">
<input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="spRetRefundMoney" value="<?php if(isset($money)){ echo $money ;}?>">
<span class="input-group-addon" id="basic-addon3">$</span>
</div>
</div>

</div>
<button type="submit" class="btn btn-success btn-border-radius" style="margin-top:10px;">Submit</button>
</form>

</div>
</div>
<!--Testing Complete-->

</div>
</div>




