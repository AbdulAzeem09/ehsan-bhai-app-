<div class="panel panel-primary">
<?php
session_start();
function sp_autoloader($class){
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
?>

<?php
$p = new _spprofiles;
$rpvt = $p->read($_POST["pid"]);
if ($rpvt != false){
$row = mysqli_fetch_assoc($rpvt);
$default = $row['spProfilesDefault'];
$status = $row['spAccountStatus'];
$publish = $row['spprofilesPublished'];

}
?>	
<div class="panel-heading profile_head">
<input type="hidden" id="idspProfiles_" name="spProfileName" value=<?php echo $_POST["pid"]; ?>>
<input type="hidden" id="idspProfilesType_" name="idspProfilesType_" value=<?php echo $_POST["ptid"]; ?>>
<div class="input-group">
<input class="form-control" type="text" required id="spProfileName_" name="spProfileName_" value="<?php echo $_POST["pname"]; ?>"readonly >

<span class="input-group-btn">
<a href="#addProfile" role="button" class="btn btn-default  btn-border-radius editprofile"data-toggle="modal" id="sp-profile-id" data-ptid="<?php echo $_POST["ptid"]; ?>" data-pid="<?php echo $_POST["pid"];?>" data-profiletype="<?php echo $row['spProfileTypeName'];?>"> Edit!</a>
</span>
</div>
</div>

<div class="panel-body">
<div class="row">
<p class=" title <?php echo ($default == 1? "":"hidden");?>" style="font-size:20px;color:#1a936f;margin-bottom:10px;" align="center">Default Profile</p>
<div class="col-md-9">
<div class="form-group">
<label class="col-sm-3 control-label">Email</label>
<div class="col-sm-9">
<p class="form-control-static" ><?php echo $row['spProfileEmail'];?></p>
</div>
</div>

<div class="form-group">
<label class="col-sm-3 control-label">Phone</label>
<div class="col-sm-9">
<p class="form-control-static"><?php echo $row['spProfilePhone'];?></p>
</div>
</div>

<!--Hidden data of profile-->
<input type="hidden" id="idspProfileEmail_" value=<?php echo $row['spProfileEmail']; ?>></input>

<input type="hidden" id="idspProfilePhone_" value=<?php echo $row['spProfilePhone']; ?>></input>

<input type="hidden" id="idspProfileAbout_" value=<?php echo $row['spProfileAbout']; ?>></input>

<input type="hidden" id="idspProfileCountry_" value=<?php echo $row['spProfilesCountry']; ?>></input>

<input type="hidden" id="idspProfileCity_" value=<?php echo $row['spProfilesCity']; ?>></input>


<?php
$pt = new _profiletypes;
$rpt = $pt->readProfileType($_POST["ptid"]);
if ($rpt != false){
$rows = mysqli_fetch_assoc($rpt);
}
?>		

<div class="form-group">
<label class="col-sm-3 control-label">Profile type</label>
<div class="col-sm-9">
<p class="form-control-static" >
<?php
echo $rows['spProfileTypeName'];
?>
</p>
</div>
</div>


<div class="form-group">
<label class="col-sm-3 control-label">About</label>
<div class="col-sm-9">
<p class="form-control-static" ><?php echo $row['spProfileAbout'];?></p>
</div>
</div>




<div class="form-group">
<?php
if($_POST["ptid"] == 1){
echo "<div class='row'>";
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


<!--Testing-->
<?php
$c = new _profilefield;
$r = $c->read($_POST["pid"]);
if($r != false)
{
while($rw = mysqli_fetch_assoc($r))
{
echo "<div class='form-group'>";
echo "<div class='row'>";
echo "<div class='col-sm-3 '><label class='control-label'>".$rw["spProfileFieldLabel"]."</label></div>";
echo "<div class='col-sm-9'>";
echo "<p class='form-control-static' >".$rw["spProfileFieldValue"]."</p>";
echo "</div>";
echo "</div>";
echo "</div>";
}

}
?>
<!--Testing Complete--> 

<!--<div class="form-group">-->
<?php
$s = new _spshipping;
$result = $s->read($_POST["pid"]);
if($result != false)
{
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

</div>

<div class="col-md-3">
<?php
if($row['spProfilePic'])
{
echo "<img  alt='profile-Pic' class='img-rounded' style='width:150px; height: 150px;' src=' ".($row['spProfilePic'])."' >" ;
}
else
{
echo "<img  alt='profile-Pic' class='img-rounded' style='width:150px; height: 150px;' src='../img/noman.png' >" ;
}
?>
</div>	
</div><br>

<div class="alert alert-success <?php echo (($_POST["ptid"] == 5 || $_POST["ptid"] == 6)?"":"hidden" );?>">
<strong style="font-size:18px;">Note!</strong> <span style="font-size:18px;">These profiles are Private profiles,. Only the profiles you are communicate with through these profiles will see these profiles but no one else.</span>
</div>

<div class="pull-right">

<a href="#" class="btn btn-success btn-border-radius <?php echo (($_POST["ptid"] == 5)?"":"hidden" );?> <?php echo ($publish == 1 ?"conceal":"publish")?>" id="publishprofile" data-profileid="<?php echo $_POST["pid"]; ?>"> <?php echo ($publish == 1 ?"Unpublish":"Publish")?></a>

<a href="#" class="btn btn-warning btn-border-radius <?php echo ($status == 0 ?"activate":"deactivate");?>  " id="activedeact" data-profileid="<?php echo $_POST["pid"]; ?>"><?php echo ($status == 0 ?"Activate":"Deactivate");?></a>

<?php
if($row['spProfilesDefault'] == 1)
{}
else
echo "<button type='button' id='makedefaultprofile' data-profileid='".$_POST["pid"]."' data-profiletype='".$rows['spProfileTypeName']."' class='btn btn-primary btn-border-radius'>Make default</button>";

?>

<a href="deleteProfile.php/?profileid=<?php echo $_POST["pid"]; ?>" class="btn btn-danger btn-border-radius" id="deleteprofile"> Remove </a>
</div>


<div class="row">
<div class="col-md-9">
<?php
if($_POST["ptid"] == 1)
{
echo "<ul class='nav nav-tabs'>
<li class='active' role='presentation'><a href='#aboutstore'  aria-controls='sp-activePost' role='tab' data-toggle='tab'>About Store</a></li>

<li  role='presentation'><a href='#aboutshipping'  aria-controls='sp-activePost' role='tab' data-toggle='tab'>Shipping Destination </a></li>

<li  role='presentation'><a href='#aboutreturn'  aria-controls='sp-activePost' role='tab' data-toggle='tab'>Returns and Refunds</a></li>
</ul>";
}
?>
</div>
<div class="col-md-3"></div>
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
<form action="aboutstore.php" method="post">
<input type="hidden" name="spProfileid_" value=<?php echo $_POST["pid"];?>></input>
<div class="form-group">
<label for="aboutstore">About Store</label>
<textarea class="form-control" id="aboutstore" name="spProfilesAboutStore" rows="4" placeholder="Type about store.."><?php echo $aboutstore ; ?></textarea>
</div>
<button type="submit" class="btn btn-success btn-border-radius pull-right">Submit</button>
</form>
</div>

<div role="tabpanel"  class= "tab-pane store"  id="aboutshipping" >
<form action="addshipping.php" method="post">
<input type="hidden" name="spProfiles_idspProfiles" value=<?php echo $_POST["pid"];?>></input>
<div class="row">
<div class="col-md-3">
<label for="basic-url">North America</label>
<div class="input-group">
<input type="text" class="form-control" aria-describedby="basic-addon3" name="spShippingNorthAmerica" value="<?php echo $North;?>">
<span class="input-group-addon" id="basic-addon3">%</span>
</div>
</div>
<div class="col-md-3">
<label for="basic-url">South America</label>
<div class="input-group">
<input type="text" class="form-control" aria-describedby="basic-addon3" name="spShippingSouthAmerica" value="<?php echo $South;?>">
<span class="input-group-addon" id="basic-addon3">%</span>
</div>
</div>
<div class="col-md-3">
<label for="basic-url">East Europe</label>
<div class="input-group">
<input type="text" class="form-control"  aria-describedby="basic-addon3" name="spShippingEastEurope" value="<?php echo $East;?>">
<span class="input-group-addon" id="basic-addon3">%</span>
</div>
</div>
<div class="col-md-3">
<label for="basic-url">West Europe</label>
<div class="input-group">
<input type="text" class="form-control"  aria-describedby="basic-addon3" name="spShippingWestEurope" value="<?php echo $West ;?>">
<span class="input-group-addon" id="basic-addon3">%</span>
</div>
</div>
</div><br>
<div class="row">
<div class="col-md-4">
<label for="basic-url">Middle East</label>
<div class="input-group">
<input type="text" class="form-control" aria-describedby="basic-addon3" name="spShippingMiddleEast" value="<?php echo $Middle;?>">
<span class="input-group-addon" id="basic-addon3">%</span>
</div>
</div>
<div class="col-md-4">
<label for="basic-url">Southeast Asia</label>
<div class="input-group">
<input type="text" class="form-control" aria-describedby="basic-addon3" name="spShippingSoutheastAsia" value="<?php echo$Southeast;?>">
<span class="input-group-addon" id="basic-addon3">%</span>
</div>
</div>
<div class="col-md-4">
<label for="basic-url">Australia</label>
<div class="input-group">
<input type="text" class="form-control" aria-describedby="basic-addon3" name="spShippingAustralia" value="<?php echo $Australia;?>">
<span class="input-group-addon" id="basic-addon3">%</span>
</div>
</div>
</div>
<button type="submit" class="btn btn-success btn-border-radius  pull-right" id="shippingratesbutton" style="margin-top:3px;">Submit</button>
</form>
</div>

<div role="tabpanel"  class= "tab-pane returnrefund"  id="aboutreturn" >
<div class="row">
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
<form action="addreturnrefund.php" method="post">
<input type="hidden" name="spProfiles_idspProfiles" value=<?php echo $_POST["pid"];?>></input>
<div class="col-md-6">
<label for="basic-url">Return</label>
<div class="input-group">
<input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="spRetRefundDays" value="<?php echo $day ;?>">
<span class="input-group-addon" id="basic-addon3">Days</span>
</div>
</div>
<div class="col-md-6">
<label for="basic-url">Refunds</label>
<div class="input-group">
<input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="spRetRefundMoney" value="<?php echo $money ;?>">
<span class="input-group-addon" id="basic-addon3">$</span>
</div>
</div>
<button type="submit" class="btn btn-success btn-border-radius pull-right" style="margin-top:10px;">Submit</button>
</form>
</div>
</div>
</div>
<!--Testing Complete-->

</div>
</div>




