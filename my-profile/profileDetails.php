<?php

//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
//error_reporting(E_ALL);

session_start();
include('../univ/baseurl.php');
include( "../univ/main.php");
function sp_autoloader($class){
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

//$p = new _spprofiles;
//$rpvt = $p->read($_POST["pid"]);

//echo "here"; exit;
$pr = new _spprofiles;

$result  = $pr->read($_POST["pid"]);

//echo $p->ta->sql;
if ($result != false){
$sprows = mysqli_fetch_assoc($result);
//print_r($sprows);
$name = $sprows["spProfileName"];
$email = $sprows["spProfileEmail"];
$phone = $sprows["spProfileCntryCode"].$sprows["spProfilePhone"];
$country = $sprows["spProfilesCountry"];
$state = $sprows['spProfilesState'];
$city = $sprows["spProfilesCity"];
$dob = $sprows['spProfilesDob'];
$about = $sprows["spProfileAbout"];
$picture = $sprows["spProfilePic"];
$location = $sprows["spprofilesLocation"];
$language = $sprows["spprofilesLanguage"];
$address = $sprows["spprofilesAddress"];
$postalCode = $sprows['spProfilePostalCode'];
$relationship_status = $sprows['relationship_status'];
$phone_status = $sprows['phone_status'];
$email_status = $sprows['email_status'];
$profile_status=$sprows['profile_status'];
//echo $profile_status;
$address_city = $sprows["address"];
}



$p = new _spbusiness_profile;

$rpvt = $p->read($_POST["pid"]);



//echo $p->ta->sql;
if ($rpvt != false){
$row = mysqli_fetch_assoc($rpvt);
$default = $row['spProfilesDefault'];
$status = $row['spAccountStatus'];
$publish = $row['spprofilesPublished'];

// echo "<pre>";
//print_r($row);

}


//print_r($_POST["pid"]);

$f = new _spfreelancer_profile;

$resfree = $f->read($_POST["pid"]);


//echo $p->ta->sql;
if ($resfree != false){
$row1 = mysqli_fetch_assoc($resfree);


/*echo "<pre>";
print_r($row1);*/

}

$ps = new _spprofessional_profile;

$respro = $ps->read($_POST["pid"]);


//echo $p->ta->sql;
if ($respro != false){
$row2 = mysqli_fetch_assoc($respro);


/*echo "<pre>";
print_r($row1);*/

}

$em = new _spemployment_profile;

$resemp = $em->read($_POST["pid"]);


//echo $p->ta->sql;
if ($resemp != false){
$row4 = mysqli_fetch_assoc($resemp);


/*echo "<pre>";
print_r($row1);*/

}

$fm = new _spfamily_profile;

$resfam = $fm->read($_POST["pid"]);


//echo $p->ta->sql;
if ($resfam != false){
$row5 = mysqli_fetch_assoc($resfam);


/*echo "<pre>";
print_r($row1);*/

}

$pt = new _profiletypes;
$rpt = $pt->readProfileType($_POST["ptid"]);
if ($rpt != false){
$rows = mysqli_fetch_assoc($rpt);
/*echo "<pre>";
print_r($rows);*/
}

?>
<style>
.heading13{
font-size: 18px;
font-weight: 700;
color: #000;
font-family: MarksimonRegular;
}
.row{
margin-right: -2px !important;
margin-left: -2px !important;
margin-left: -13px;
}
.form-group{
margin-left: -13px !important;
}
.aaa{
margin-left:10px;
}

</style>
<div class="right_profile">
<div class="right_profile_top">
<div class="row">
<input type="hidden" id="idspProfiles_" name="spProfileName" value=<?php echo $_POST["pid"]; ?>>
<input type="hidden" id="idspProfilesType_" name="idspProfilesType_" value=<?php echo $_POST["ptid"]; ?>>

<!--Hidden data of profile-->
<input type="hidden" id="idspProfileEmail_" value=<?php echo $sprows['spProfileEmail']; ?>>
<input type="hidden" id="idspProfilePhone_" value=<?php echo $sprows['spProfilePhone']; ?>>				
<input type="hidden" id="idspProfileAbout_" value=<?php echo $sprows['spProfileAbout']; ?>>
<input type="hidden" id="idspProfileCountry_" value=<?php echo $sprows['spProfilesCountry']; ?>>
<input type="hidden" id="idspProfileCity_" value=<?php echo $sprows['spProfilesCity']; ?>>


<div class="col-md-2 col-xs-12 no-padding">
<?php
if($sprows["spProfilePic"]){
echo "<img  alt='profile-Pic' class='img-responsive' src='$picture'  style='border-radius: 100%;'>" ;
}
else{
echo "<img  alt='profile-Pic' class='img-responsive' src='../assets/images/icon/blank-img.png' >" ;
}
?>
</div>
<div class="col-md-10 col-xs-12">
<?php if(!isset($_SESSION['guet_yes']) || $_SESSION['guet_yes'] != 'yes'){ ?>
<div class="text-center pull-right">

<a href="#addProfile" role="button" class="btn btn-tsp btn-border-radius no-radius editprofile db_btn db_primarybtn" data-toggle="modal" id="sp-profile-id" data-ptid="<?php echo $_POST["ptid"]; ?>" data-pid="<?php echo $_POST["pid"];?>" data-profiletype="<?php echo $rows['spProfileTypeName'];?>"> Edit</a>
<?php   if($_POST['ptid']==1){?>
<a href="/dashboard/settings/" role="button" class="btn btn-tsp btn-border-radius btn-border-radius no-radius editprofile db_btn db_primarybtn pull-right" data-toggle="modal" id="sp-profile-id" > Verify Profile</a>

<?php }?>
<?php //echo $_POST['ptid']; die('=======');?>


<?php

if ($_SESSION['pid'] != $sprows['idspProfiles']) {
if($sprows['spProfilesDefault'] == 1){

}else{
echo "<button type='button' id='makedefaultprofile' data-profileid='".$_POST["pid"]."' data-profiletype='".$rows['spProfileTypeName']."' class='btn butn_save btn-border-radius db_btn db_primarybtn'>Make default</button>";
}
}else{?>
<p style="font-size: 16px; padding-top: 10px;color: #202548;">Default Profile</p>
<?php }?>

</div> <?php } ?>
<h2><?php echo htmlspecialchars($_POST["pname"]); ?></h2>
<h5><?php if($sprows['spProfileName']=="Guest User"){
echo "Guest";

}else{ echo $sprows['spProfileTypeName'];}?> Profile</h5>

<div class="d-flex flex-row align-items-center"> <i class="fa fa-map-marker"></i> 
<span class="ml-1"><?php      echo "<a href='https://www.google.com/maps/place/". $address_city."' target='_blank' style='padding-left: 10px;'>". $address_city."</a>"; ?></span> 
</div>
<!--<p class="eventcapitalize"><i class="fa fa-map-marker"></i> <?php echo $address_city?></p>-->
<!-- <?php
$co = new _city;
$result5 = $co->readCityName($city);


print_r($result5);


if ($result5) {
$rowcity = mysqli_fetch_assoc($result5);

print_r($rowcity);
echo $rowcity['city_title']. ", ";
}

$co = new _country;
$result3 = $co->readCountryName($country);
if ($result3) {
$rowcon = mysqli_fetch_assoc($result3);
echo $rowcon['country_title'];
}
?> -->

<p class="text-justify"><?php echo $sprows['spProfileAbout'];?></p>
</div>
</div>




<?php if($rows['idspProfileType'] == 5) { ?>	

<style>
.panel-body {
padding: 7px !important;
}
h4.heading12 {
margin-left: 20px;
}
</style>	




<div class="row" style=" margin-top: 12px; ">
<div class="col-md-12 mb-3">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="heading12">Personal Information</h4>
</div>
<div class="panel panel-default" style=" margin-bottom: 0px; ">
<div class="panel-heading">
<div class="row">
<div class="col-md-3">
<b>Profile Name</b>
</div>
<div class="col-md-9">
<?php echo $_POST["pname"]; ?>
</div>
</div>
</div>
</div>
<div class="panel-body">
<h4 class="heading12">CAREER HIGHLIGHTS</h4>

<ul class="careearhighs">
<?php $skillss = explode(",", $row4["skill"]);
foreach($skillss as $skillssval){
?>
<li><?php echo $skillssval; ?></li>
<?php } ?>
</ul>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<h4 class="heading12">About</h4>
<ul>
<li><?php echo $row4["spProfileAbout"]; ?></li>
</ul>
</div>
</div>  
<!--<div class="panel panel-default">
<div class="panel-body">
<h4 class="heading12">CERTIFICATION</h4>
<ul class="careearhighs">
<li><?php echo $row4["certification"]; ?></li>
</ul>
</div>
</div>  --> 
<div class="panel panel-default">
<div class="panel-body">
<h4 class="heading12">EXPERIENCE</h4>  <br>


<?php
$idspProfile = $_POST['pid'];
$spProfileType_idspProfileType1 = 5; 
$empreadexp = new _spemployment_profile;
$data66 = $empreadexp->readEmpExp($idspProfile, $spProfileType_idspProfileType1);

if($data66!=false){	
echo "<h4 class='heading12'></h4><br>";
}else
{
echo "<h4 class='heading12'>NO EXPERIENCE ADDED</h4><br>";
}

if($data66){
while($row55 = mysqli_fetch_array($data66)){   
///print_r($postid;); die('xx');
$jobtitle = $row55['jobtitle'];
$company = $row55['company'];

$frommonth = $row55['frommonth'];
$fromyear = $row55['fromyear'];
$frommonth = $row55['frommonth'];
$tomonth = $row55['tomonth'];
$toyear = $row55['toyear'];
$description = $row55['description'];
$current_work = $row55['current_work'];
$emptype = $row55['emptype'];
$postid= $row55['id'];

$country= $row55['country'];
$state= $row55['state'];
$city = $row55['city'];

$cos = new _country;
$result33 = $cos->readCountry();
if($result33 != false){
while ($row33 = mysqli_fetch_assoc($result33)) {
if(isset($country) && $country == $row33['country_id']){
$currentcountry = $row33['country_title']; 
$currentcountry_id = $row33['country_id']; 

}
}
}

if (isset($state) && $state > 0) {
$countryId = $currentcountry_id;
$prs = new _state;
$result23 = $prs->readState($countryId);
if($result23 != false){
while ($row23 = mysqli_fetch_assoc($result23)) { 
if(isset($state) && $state == $row23["state_id"] ){
$currentstate_id = $row23["state_id"];
$currentstate = $row23["state_title"];
}
}
}
}
if (isset($city) && $city > 0) {
$stateId = $currentstate_id;
$cos = new _city;
$result33 = $cos->readCity($stateId);
if($result33 != false){
while ($row33 = mysqli_fetch_assoc($result33)) { 
if(isset($city) && $city == $row33['city_id']){
$currentcity = $row33['city_title'];
$currentcity_id = $row33['city_id'];
}																								}                                                                                             }
} 



$address=$currentcountry.', '.$currentstate.', '.$currentcity ;


if($frommonth==1){
$frommonth="Jan";
}

if($frommonth==2){
$frommonth="Feb";
}	
if($frommonth==3){
$frommonth="March";
}	
if($frommonth==4){
$frommonth="April";
}	
if($frommonth==5){
$frommonth="May";
}	
if($frommonth==6){
$frommonth="June";
}	
if($frommonth==7){
$frommonth="July";
}	
if($frommonth==8){
$frommonth="Aug";
}	
if($frommonth==9){
$frommonth="Sep";
}	
if($frommonth==10){
$frommonth="Oct";
}	
if($frommonth==11){
$frommonth="Nov";
}	
if($frommonth==12){
$frommonth="Dec";
}



if($tomonth==1){
$tomonth="Jan";
}

if($tomonth==2){
$tomonth="Feb";
}	
if($tomonth==3){
$tomonth="March";
}	
if($tomonth==4){  
$tomonth="April";
}	
if($tomonth==5){
$tomonth="May";
}	
if($tomonth==6){
$tomonth="June";
}	
if($tomonth==7){
$tomonth="July";
}	
if($tomonth==8){
$tomonth="Aug";
}	
if($tomonth==9){
$tomonth="Sep";
}	
if($tomonth==10){
$tomonth="Oct";
}	
if($tomonth==11){
$tomonth="Nov";
}	
if($tomonth==12){
$tomonth="Dec";
}







?>	
<div class="row">
<div class="col-md-1">
<img src="<?php echo $BaseUrl ?>/assets/images/icon/sphome/house.png" style="width: 50px;height: 50px;margin-left: 10px;" />
</div>
<div class="col-md-11">		
<b><?php echo $jobtitle;?></b>  <br>
<span><?php echo $company;?></span>  <br>
<span><?php echo $emptype;?></span>  <br>
<span><?php echo $address;?></span>  <br>
<span><?php echo $frommonth.':'.$fromyear.'--'.$tomonth.':'.$toyear ;?></span>  <br>
<span><?php echo $description;?></span>  <br> <br>
</div>
</div>
<hr>	



<?php	}}	?>














<!---<div class="row">
<div class="col-md-2">
<img src="https://dev.thesharepage.com/assets/images/icon/sphome/house.png" style="width: 50px;height: 50px;margin-left: 40px;" />
</div>
<div class="col-md-10">		
<b>Data Analyist/is Application Specialist</b>  <br>
<span>Lederal Government of Canada</span>  <br>
<span>Apr 2021 - Present - 10 yrs 10 mos</span>  <br>
<span>Surrey, BC</span>  <br> <br>
</div>
</div>
</ul>
<hr>--->
</div>
</div>  
<div class="panel panel-default">
<div class="panel-body">
<h4 class="heading12">EDUCATION</h4>  <br>





<?php

$idspProfiles = $_POST['pid'];
$spProfileType_idspProfileType = 5; 
$empread = new _spemployment_profile;
$data33 = $empread->readEmpEdu($idspProfiles, $spProfileType_idspProfileType);

if($data33!=false){	
echo "<h4 class='heading12'></h4><br>";
}else
{
echo "<h4 class='heading12'>NO EDUCATION ADDED</h4><br>";
}

if($data33){
while($row44 = mysqli_fetch_array($data33) ){   

$school = $row44['school'];
$empdegree = $row44['empdegree'];
$study = $row44['study'];
$year = $row44['year'];
?>



<div class="row">
<div class="col-md-1">
<img src="<?php echo $BaseUrl ?>/assets/images/icon/sphome/house.png" style="width: 50px;height: 50px;margin-left: 10px;" />
</div>
<div class="col-md-11">		
<b><?php echo $school;?></b>  <br>
<span><?php echo $empdegree;?></span>  <br>
<span><?php echo $study;?></span>  <br>
<span><?php echo $year;?></span>  <br> <br>
</div>
</div>
<hr>
<?php	} } 	?>
</div>
</div>  

<div class="panel panel-default">
<div class="panel-body">
<h4 class="heading12">Accomplishments</h4>
<ul class="careearhighs">
<li style=" color: deepskyblue; "><?php echo $row4["achievements"]; ?></li>
<li>Certified</li>
</ul>
</div>
</div>   
<!--<div class="panel panel-default">
<div class="panel-body">
<h4 class="heading12">Hobbies</h4>
<ul class="careearhighs">
<li><?php echo $row4["hobbies"]; ?></li>
<li></li>
</ul>
</div>
</div> -->  

</div>
</div>



<?php } ?>











<?php	if($rows['idspProfileType'] != 5) { ?>		
<div class="row profilebody ">
<div class="col-md-12 no-padding">
<div class="">
<table class="table tbl_profile table-striped table-hover">
<tbody>
<tr>
<td colspan="2"><h4 class="heading12">Personal Information</h4></td>
</tr>
<tr>
<td>Profile Name</td>
<td><?php echo htmlspecialchars($_POST["pname"]); ?></td>

</tr>
<?php if($rows['idspProfileType'] == 6) {?>
<tr>
<td>Email</td>
<td><?php echo $email; ?></td>
</tr>

<?php }?>


<?php if($rows['idspProfileType'] == 4) {?>

<tr>

<td>Phone Status</td>
<td><?php echo $sprows['spProfilePhone'];?> (<?php echo ucfirst($sprows['phone_status']);?>)

</td> 
</tr>

<tr>     			
<td>Postal Code/Zip</td>
<td><?php echo $sprows['spProfilePostalCode'] ;?>
</tr>

<td>Date Of Birth</td>
<td><?php echo $sprows['date_of_birth'] ;?>
</tr>

<?php if(!empty($sprows['relationship_status']) ){ ?>
<tr>
<td>Relationship Status</td>
<td><?php echo $sprows['relationship_status'];?></td>
</tr>
<?php } 

$u = new _spuser;
$res = $u->read($_SESSION["uid"]); 



if($res != false)

{
$ruser = mysqli_fetch_assoc($res);

$tags = isset($ruser['tag']) ? $ruser['tag'] : "";
$cmpyPhoneNo = isset($ruser['personal_PhoneNo']) ? $ruser['personal_PhoneNo'] : "";
$relationship_status = isset($ruser['relationship_status']) ? $ruser['relationship_status'] : "";
$storename = isset($ruser['spDynamicWholesell']) ? $ruser['spDynamicWholesell'] : "";
$Category = isset($ruser['category']) ? $ruser['category'] : "";
$Highlights = isset($ruser['highlights']) ? $ruser['highlights'] : "";
$LanguageFluency = isset($ruser['languagefluency']) ? $ruser['languagefluency'] : "";
$sphobbies = isset($ruser['sphobbies']) ? $ruser['sphobbies'] : "";
$spProfileeducation = isset($ruser['Education']) ? $ruser['Education'] : "";
$spProfileAbout = isset($ruser['spProfileAbout']) ? $ruser['spProfileAbout'] : "";
$useremail = isset($ruser['spUserEmail']) ? $ruser['spUserEmail'] : "";
$postalCode = isset($ruser['spProfilePostalCode']) ? $ruser['spProfilePostalCode'] : "";

}

?>
<?php
//echo $sphobbies;die; 


?>
<td>Email</td>
<td><?php echo $useremail; ?></td>
</tr>
<tr>     			
<td>Email Status</td>
<td><?php echo $sprows['phone_status'];?>
</tr>

<tr>     			
<td>Personal Phone*</td>
<td><?php echo $cmpyPhoneNo ;?>
</tr>


<tr>     			
<td>Tag</td>
<td><?php echo $tags;?>
</tr>
<tr>     			
<td>Store Name</td>
<td><?php echo $storename;?>
</tr>
<!-- <tr>     			
<td>Career Category *</td>
<td><?php echo $Category;?>
</tr>
<tr>     			
<td> Career Highlights*</td>
<td><?php echo $Highlights;?>
</tr>
<tr> -->  			
<td>Language Fluency</td>
<td><?php echo $LanguageFluency;?>
</tr>
<tr>     			
<td>Hobbies</td>
<td><?php echo $sphobbies;?>
</tr>
<tr>     	
<td>Education</td>
<td><?php echo $spProfileeducation;?>
</tr>
<tr>     			
<td> About Myself</td>
<td><?php echo $spProfileAbout;?>
</tr>
<?php




$con = mysqli_connect(DOMAIN, UNAME, PASS);

if(!$con) {
die('Not Connected To Server');
}

//Connection to database
if(!mysqli_select_db($con, DBNAME)) {
echo 'Database Not Selected';
}
// print_r($_SESSION);
/*echo "SELECT * FROM userfamily WHERE spProfileId='".$_POST["pid"]."' ORDER BY id DESC";*/

//$querym = mysqli_query($con,"SELECT * FROM userfamily WHERE  spProfileId='".$_POST['pid']."' ORDER BY id DESC");

$querym = mysqli_query($con,"SELECT * FROM userfamily WHERE spuserId='".$_SESSION['uid']."' ORDER BY id DESC");
if(mysqli_num_rows($querym) > 0) {

?>

<tr>
<td>Family</td>
<td>

<ol>
<?php
while($member = mysqli_fetch_array($querym  )) {
?>

<li><?php echo ucwords($member['membername']);?> (<?php  $rel=$member['memberrelation'] ;
if($rel==0){
echo "No Relation";
}
else{
echo ($rel); 
}

?>)
</li>




<?php } ?>

</ol>

</td>



</tr>




<?php } ?>                      

<!--<tr>
<td>Email</td>
<td><?php echo $sprows['spProfileEmail'];?> (<?php echo ucfirst($sprows['email_status']);?>)</td>
</tr>-->

<?php if(!empty($sprows['address'])){ ?>
<tr>
<td>Address</td>
<td><?php echo $sprows['address'];?></td>
</tr>
<?php } ?>



<?php } ?>
<!-- personal condition end -->



<!-- 		<tr>
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
</tr> -->
<!-- <tr>
<td>Profile Type</td>
<td><?php echo $row['spProfileTypeName'];?> Profile</td>
</tr>-->



<?php if($rows['idspProfileType'] == 1) { ?>

<tr>
<td>Business Name*</td>
<td><?php echo $row["companyname"]; ?></td>
</tr>   


<tr>
<td>Company Specialties*</td>
<td><?php echo $row["skill"]; ?></td>
</tr> 

<tr>
<td>Company Email</td>
<td><?php echo $row["companyEmail"]; ?></td>
</tr>

<tr>
<td>Company Phone*</td>
<td><?php echo $row["companyPhoneNo"]; ?></td>
</tr>



<!-- <tr>
<td>Ext</td>
<td><?php echo $row["companyExtNo"]; ?></td>
</tr> -->

<!-- <tr>
<td>Company Category*</td>
<td><?php echo $row["businesscategory"]; ?></td>
</tr> -->

<tr>
<td>Company Tagline*</td>
<td><?php echo $row["companytagline"]; ?></td>
</tr>

<tr>
<?php 
$m = new _masterdetails;
$masterid = 8;
$result74 = $m->read($masterid);
$rows47 = mysqli_fetch_assoc($result74);
// print_r($rows47);		
?>
<td>Business Category*</td>
<td><?php echo $rows47["masterDetails"]; ?></td>
</tr>

<tr>
<td>Product and Services*</td>
<td><?php echo $row["companyProductService"]; ?></td>
</tr>


<tr>
<td>Business Overview*</td>
<td><?php echo $row["BussinessOverview"]; ?></td>
</tr>

<!-- <tr>
<td>Language Spoken</td>
<td><?php echo $row["languageSpoken"]; ?></td>
</tr> -->

<tr>
<td>Company Size</td>
<td><?php echo $row["CompanySize"]; ?></td>
</tr>

<tr>
<td>Company Revenue</td>
<td><?php echo $row["cmpyRevenue"]; ?></td>
</tr>

<tr>
<td>Year Founded</td>
<td><?php echo $row["yearFounded"]; ?></td>
</tr>

<!-- <tr>
<td>Ownership</td>
<td><?php echo $row["CompanyOwnership"]; ?></td>
</tr> -->


<tr>
<td>Company Website</td>
<td><?php echo $row["CompanyWebsite"]; ?></td>
</tr>

<!-- <tr>
<td>Operating Days/Hours</td>
<td><?php echo $row["operatinghours"]; ?></td>
</tr> -->

<tr>
<td>Stock Symbol</td>
<td><?php echo $row["stockSymbol"]; ?></td>
</tr>

<tr>
<td>Stock Weblink</td>
<td><?php echo $row["cmpnyStockLink"]; ?></td>
</tr>

<tr>
<td>Store Name</td>
<td><?php echo $row["spDynamicWholesell"]; ?></td>
</tr>


<?php if(!empty($row['spProfilesAboutStore'])){ ?>
<tr>
<td>About Store</td>
<td><?php echo $row['spProfilesAboutStore'];?></td>
</tr>
<?php } ?>

<?php if(!empty($row['spshippingtext'])){ ?>
<tr>
<td>Shipping Destination</td>
<td><?php echo $row['spshippingtext'];?></td>
</tr>
<?php } ?>


<?php if(!empty($row['spProfilerefund'])){ ?>
<tr>
<td>Returns and Refunds</td>
<td><?php echo $row['spProfilerefund'];?></td>
</tr>
<?php } ?>


<?php if(!empty($row['spProfilepolicy'])){ ?>
<tr>
<td>Policy</td>
<td><?php echo $row['spProfilepolicy'];?></td>
</tr>
<?php } ?>

<tr>
<td>Address</td>
<td><?php echo $address_city; ?></td>
</tr>

<tr>
<td>Postal Code/Zip</td>
<td><?php echo $postalCode; ?></td>
</tr>

<tr>
<td>Phone Status</td>
<td><?php echo $phone_status; ?></td>
</tr>
<tr>
<td>Email Status</td>
<td><?php echo $email_status; ?></td>
</tr>




<?php } ?>




<?php if($rows['idspProfileType'] == 2) { ?>

<tr><?php
$u = new _spuser;
$res = $u->read($_SESSION["uid"]);

//echo $u->ta->sql;

if($res != false)

{
$ruser = mysqli_fetch_assoc($res);


$useremail = $ruser["spUserEmail"]; 

}
?>

<td>Email</td>
<td><?php echo $useremail; ?></td>
</tr>									 


<tr>

<td>Category*</td>

<?php  $m = new _subcategory;
$catid = 5;

$res = $m->readcat($row1["profiletype"],$catid);

//print_r($res);
if( $res=="")
{
$catrow="";  
}
else{
$catrow = mysqli_fetch_assoc($res);

?>
<td><?php  echo $catrow["subCategoryTitle"];}?></td>

</tr>   


<tr>
<td>Hourly Rate*</td>
<td><?php echo $row1["hourlyrate"]; ?></td>
</tr> 

<tr>
<td>Skills*</td>
<td><?php echo $row1["skill"]; ?></td>
</tr>

<tr>
<td>Certification*</td>
<td><?php echo $row1["certification"]; ?></td>
</tr>

<tr>
<td>Project worked</td>
<td><?php echo $row1["projectworked"]; ?></td>
</tr>

<tr>
<td>Working Interests</td>
<td><?php echo $row1["workinginterests"]; ?></td>
</tr>

<tr>
<td>Available From</td>
<td><?php echo $row1["availablefrom"]; ?></td>
</tr>

<tr>
<td>References</td>
<td><?php echo $row1["reference"]; ?></td>
</tr>

<tr>
<td>Personal Website</td>
<td><?php echo $row1["personalwebsite"]; ?></td>
</tr>

<tr>
<td>Language Fluency</td>
<td><?php echo $row1["languagefluency"]; ?></td>
</tr>
<tr>
<td>Experience</td>
<td><?php echo $row1["experience"]; ?></td>
</tr>

<tr>
<td>Profile Status</td>
<td><?php echo $profile_status; ?></td>
</tr>

<tr>
<td>Phone Status</td>
<td><?php echo $phone_status; ?></td>
</tr>
<tr>
<td>Email Status</td>
<td><?php echo $email_status; ?></td>
</tr>

<tr>
<td>Overview</td>
<td><?php echo $row1["overview"]; ?></td>
</tr>

<tr>
<td>Education</td>
<td><?php echo $row1["spProfileeducation"]; ?></td>
</tr>

<tr>
<td>About Myself</td>
<td><?php echo $row1["spProfileAbout"]; ?></td>
</tr>
<tr>
<div class="panel panel-default">
<div class="panel-body">
<h4 class="heading12">EDUCATION</h4>  <br> 

<?php

$idspProfiles = $_POST['pid'];
$spProfileType_idspProfileType = 2; 
$empread = new _spemployment_profile;
$data33 = $empread->readEmpEdu($idspProfiles, $spProfileType_idspProfileType);

if($data33!=false){	
echo "<h4 class='heading12'></h4><br>";
}else
{
echo "<h4 class='heading12'>NO EDUCATION ADDED</h4><br>";
}

if($data33!=false){	
//print_r($data33);die('+++++2222');
while($row44 = mysqli_fetch_array($data33) ){   

$school = $row44['school'];
$empdegree = $row44['empdegree'];
$study = $row44['study'];
$year = $row44['year'];
?>



<div class="row">
<div class="col-md-1">
<img src="<?php echo $BaseUrl ?>/assets/images/icon/sphome/house.png" style="width: 50px;height: 50px;margin-left: 10px;" />
</div>
<div class="col-md-11">		
<b><?php echo $school;?></b>  <br>
<span><?php echo $empdegree;?></span>  <br>
<span><?php echo $study;?></span>  <br>
<span><?php echo $year;?></span>  <br> <br>
</div>
</div>
<hr>
<?php	} }	?> 
</div>
</div>  

</tr>

<tr>
<div class="panel panel-default">
<div class="panel-body">
<h4 class="heading12">EXPERIENCE</h4>  <br>

<?php
$idspProfile = $_POST['pid'];
$spProfileType_idspProfileType1 = 2; 
$empreadexp = new _spemployment_profile;
$data66 = $empreadexp->readEmpExp($idspProfile, $spProfileType_idspProfileType1);



if($data66!=false){	
echo "<h4 class='heading12'></h4><br>";




while($row55 = mysqli_fetch_array($data66) ){   
///print_r($postid;); die('xx');
$jobtitle = $row55['jobtitle'];
$company = $row55['company'];

$frommonth = $row55['frommonth'];
$fromyear = $row55['fromyear'];
$frommonth = $row55['frommonth'];
$tomonth = $row55['tomonth'];
$toyear = $row55['toyear'];
$description = $row55['description'];
$current_work = $row55['current_work'];
$emptype = $row55['emptype'];
$postid= $row55['id'];

$country= $row55['country'];
$state= $row55['state'];
$city = $row55['city'];

$cos = new _country;
$result33 = $cos->readCountry();
if($result33 != false){
while ($row33 = mysqli_fetch_assoc($result33)) {
if(isset($country) && $country == $row33['country_id']){
$currentcountry = $row33['country_title']; 
$currentcountry_id = $row33['country_id']; 

}
}
}

if (isset($state) && $state > 0) {
$countryId = $currentcountry_id;
$prs = new _state;
$result23 = $prs->readState($countryId);
if($result23 != false){
while ($row23 = mysqli_fetch_assoc($result23)) { 
if(isset($state) && $state == $row23["state_id"] ){
$currentstate_id = $row23["state_id"];
$currentstate = $row23["state_title"];
}
}
}
}
if (isset($city) && $city > 0) {
$stateId = $currentstate_id;
$cos = new _city;
$result33 = $cos->readCity($stateId);
if($result33 != false){
while ($row33 = mysqli_fetch_assoc($result33)) { 
if(isset($city) && $city == $row33['city_id']){
$currentcity = $row33['city_title'];
$currentcity_id = $row33['city_id'];
}																								}                                                                                             }
} 



$address=$currentcountry.', '.$currentstate.', '.$currentcity ;


if($frommonth==1){
$frommonth="Jan";
}

if($frommonth==2){
$frommonth="Feb";
}	
if($frommonth==3){
$frommonth="March";
}	
if($frommonth==4){
$frommonth="April";
}	
if($frommonth==5){
$frommonth="May";
}	
if($frommonth==6){
$frommonth="June";
}	
if($frommonth==7){
$frommonth="July";
}	
if($frommonth==8){
$frommonth="Aug";
}	
if($frommonth==9){
$frommonth="Sep";
}	
if($frommonth==10){
$frommonth="Oct";
}	
if($frommonth==11){
$frommonth="Nov";
}	
if($frommonth==12){
$frommonth="Dec";
}



if($tomonth==1){
$tomonth="Jan";
}

if($tomonth==2){
$tomonth="Feb";
}	
if($tomonth==3){
$tomonth="March";
}	
if($tomonth==4){  
$tomonth="April";
}	
if($tomonth==5){
$tomonth="May";
}	
if($tomonth==6){
$tomonth="June";
}	
if($tomonth==7){
$tomonth="July";
}	
if($tomonth==8){
$tomonth="Aug";
}	
if($tomonth==9){
$tomonth="Sep";
}	
if($tomonth==10){
$tomonth="Oct";
}	
if($tomonth==11){
$tomonth="Nov";
}	
if($tomonth==12){
$tomonth="Dec";
}

?>	
<div class="row">
<div class="col-md-1">
<img src="<?php echo $BaseUrl ?>/assets/images/icon/sphome/house.png" style="width: 50px;height: 50px;margin-left: 10px;" />
</div>
<div class="col-md-11">		
<b><?php echo $jobtitle;?></b>  <br> 
<span><?php echo $company;?></span>  <br>
<span><?php echo $emptype;?></span>  <br>
<span><?php echo $address;?></span>  <br>
<span><?php echo $frommonth.':'.$fromyear.'--'.$tomonth.':'.$toyear ;?></span>  <br>
<span><?php echo $description;?></span>  <br> <br>
</div>
</div>
<hr>	



<?php	}	?>

<!---<div class="row">
<div class="col-md-2">
<img src="https://dev.thesharepage.com/assets/images/icon/sphome/house.png" style="width: 50px;height: 50px;margin-left: 40px;" />
</div>
<div class="col-md-10">		
<b>Data Analyist/is Application Specialist</b>  <br>
<span>Lederal Government of Canada</span>  <br>
<span>Apr 2021 - Present - 10 yrs 10 mos</span>  <br>
<span>Surrey, BC</span>  <br> <br>
</div>
</div>
</ul>
<hr>--->
</div>
</div>  

</tr>

<?php }}else
{
echo "<h4 class='heading12'>NO EXPERIENCE ADDED</h4><br>";
} ?>



<?php if($rows['idspProfileType'] == 3) { ?>


<tr><?php
$u = new _spuser;
$res = $u->read($_SESSION["uid"]);

//echo $u->ta->sql;

if($res != false)

{
$ruser = mysqli_fetch_assoc($res);


$useremail = $ruser["spUserEmail"]; 

}
?>

<td>Email</td>
<td><?php echo $useremail; ?></td>
</tr>									 

<tr>

<td>Career Category333*</td>
<td><?php  echo $row2["category"];?></td>

</tr>   


<!-- <tr>
<td>Hourly Rate*</td>
<td><?php echo $row2["highlights"]; ?></td>
</tr> -->

<tr>
<td>Accomplishments*</td>
<td><?php echo $row2["details"]; ?></td>
</tr>
<tr>
<td>Tag</td>
<td><?php echo $row2["sptags"]; ?></td>
</tr>

<tr>
<td>Career Highlights*</td>
<td><?php echo $row2["highlights"]; ?></td>
</tr>
<tr>
<td>Certification(s)</td>
<td><?php echo $row2["spCertification"]; ?></td>
</tr>
<tr>
<td>Hobbies</td>
<td><?php echo $row2["sphobbies"]; ?></td>
</tr>
<tr>
<td>My Website</td>
<td><?php echo $row2["spProfileWebsite"]; ?></td>
</tr>
<tr>
<td>Language Proficiency</td>
<td><?php echo $row2["splanguagefluency"]; ?></td>
</tr>
<tr>
<td>Experience*</td>
<td><?php echo $row2["spExperience"]; ?></td>
</tr>
<!--<tr><?php

$p = new _spprofiles;


if(isset($_POST['pid'])){
$result  = $p->read($_POST["pid"]);
if($result != false)
{
$row = mysqli_fetch_assoc($result);
$spProfile_storename = $row["store_name"];
}
}
if (isset($spProfile_storename) && !is_null($spProfile_storename) && !empty($spProfile_storename
)){
$storename = $spProfile_storename; 
}						


?>
<td>Store Name*</td>
<td><?php echo  $storename ; ?></td>
</tr>-->
<!--<tr>
<td>Education*</td>
<td><?php //echo $row2["spProfileeducation"]; ?></td>
</tr>-->
<tr>
<td>Email Status</td>
<td><?php echo $email_status; ?></td>
</tr>
<tr>
<td>Phone Status</td>
<td><?php echo $phone_status; ?></td>
</tr>

<tr>
<td>About Myself</td>
<td><?php echo $row2["spProfileAbout"]; ?></td>


</tr>

<tr>
<div class="panel panel-default">
<div class="panel-body">
<h4 class="heading12">EDUCATION</h4>  <br>

<?php

$idspProfiles = $_POST['pid'];
$spProfileType_idspProfileType = 3; 
$empread = new _spemployment_profile;
$data33 = $empread->readEmpEdu($idspProfiles, $spProfileType_idspProfileType);



if($data33!=false){	
echo "<h4 class='heading12'></h4><br>";
}else
{
echo "<h4 class='heading12'>NO EDUCATION ADDED</h4><br>";
}


if($data33!=false)
{

while($row44 = mysqli_fetch_assoc($data33) ){   

$school = $row44['school'];
$empdegree = $row44['empdegree'];
$study = $row44['study'];
$year = $row44['year'];
?>



<div class="row">
<div class="col-md-1">
<img src="<?php echo $BaseUrl ?>/assets/images/icon/sphome/house.png" style="width: 50px;height: 50px;margin-left: 10px;" />
</div>
<div class="col-md-11">		
<b><?php echo $school;?></b>  <br>
<span><?php echo $empdegree;?></span>  <br>
<span><?php echo $study;?></span>  <br>
<span><?php echo $year;?></span>  <br> <br>
</div>
</div>
<hr>
<?php	} }	?>
</div>
</div>  

</tr>


<tr>

<div class="panel panel-default">
<div class="panel-body">
<h4 class="heading12">EXPERIENCE</h4>  <br>

<?php
$idspProfile = $_POST['pid'];
$spProfileType_idspProfileType1 = 3; 
$empreadexp = new _spemployment_profile;
$data66 = $empreadexp->readEmpExp($idspProfile, $spProfileType_idspProfileType1);



if($data66!=false){	
echo "<h4 class='heading12'></h4><br>";
}else
{
echo "<h4 class='heading12'>NO EXPERIENCE ADDED</h4><br>";
}


if($data66){
while($row55 = mysqli_fetch_array($data66) ){ 		
///print_r($postid;); die('xx');
$jobtitle = $row55['jobtitle'];
$company = $row55['company'];

$frommonth = $row55['frommonth'];
$fromyear = $row55['fromyear'];
$frommonth = $row55['frommonth'];
$tomonth = $row55['tomonth'];
$toyear = $row55['toyear'];
$description = $row55['description'];
$current_work = $row55['current_work'];
$emptype = $row55['emptype'];
$postid= $row55['id'];

$country= $row55['country'];
$state= $row55['state'];
$city = $row55['city'];

$cos = new _country;
$result33 = $cos->readCountry();
if($result33 != false){
while ($row33 = mysqli_fetch_assoc($result33)) {
if(isset($country) && $country == $row33['country_id']){
$currentcountry = $row33['country_title']; 
$currentcountry_id = $row33['country_id']; 

}
}
}

if (isset($state) && $state > 0) {
$countryId = $currentcountry_id;
$prs = new _state;
$result23 = $prs->readState($countryId);
if($result23 != false){
while ($row23 = mysqli_fetch_assoc($result23)) { 
if(isset($state) && $state == $row23["state_id"] ){
$currentstate_id = $row23["state_id"];
$currentstate = $row23["state_title"];
}
}
}
}
if (isset($city) && $city > 0) {
$stateId = $currentstate_id;
$cos = new _city;
$result33 = $cos->readCity($stateId);
if($result33 != false){
while ($row33 = mysqli_fetch_assoc($result33)) { 
if(isset($city) && $city == $row33['city_id']){
$currentcity = $row33['city_title'];
$currentcity_id = $row33['city_id'];
}																								}                                                                                             }
} 



$address=$currentcountry.', '.$currentstate.', '.$currentcity ;


if($frommonth==1){
$frommonth="Jan";
}

if($frommonth==2){
$frommonth="Feb";
}	
if($frommonth==3){
$frommonth="March";
}	
if($frommonth==4){
$frommonth="April";
}	
if($frommonth==5){
$frommonth="May";
}	
if($frommonth==6){
$frommonth="June";
}	
if($frommonth==7){
$frommonth="July";
}	
if($frommonth==8){
$frommonth="Aug";
}	
if($frommonth==9){
$frommonth="Sep";
}	
if($frommonth==10){
$frommonth="Oct";
}	
if($frommonth==11){
$frommonth="Nov";
}	
if($frommonth==12){
$frommonth="Dec";
}



if($tomonth==1){
$tomonth="Jan";
}

if($tomonth==2){
$tomonth="Feb";
}	
if($tomonth==3){
$tomonth="March";
}	
if($tomonth==4){  
$tomonth="April";
}	
if($tomonth==5){
$tomonth="May";
}	
if($tomonth==6){
$tomonth="June";
}	
if($tomonth==7){
$tomonth="July";
}	
if($tomonth==8){
$tomonth="Aug";
}	
if($tomonth==9){
$tomonth="Sep";
}	
if($tomonth==10){
$tomonth="Oct";
}	
if($tomonth==11){
$tomonth="Nov";
}	
if($tomonth==12){
$tomonth="Dec";
}

?>	
<div class="row">
<div class="col-md-1">
<img src="<?php echo $BaseUrl ?>/assets/images/icon/sphome/house.png" style="width: 50px;height: 50px;margin-left: 10px;" />
</div>
<div class="col-md-11">		
<b><?php echo $jobtitle;?></b>  <br>
<span><?php echo $company;?></span>  <br>
<span><?php echo $emptype;?></span>  <br>
<span><?php echo $address;?></span>  <br>
<?php if($current_work==1){
echo 'Since'.' '.$frommonth.':'.$fromyear;    	

}else { ?>

<span><?php echo $frommonth.':'.$fromyear.'--'.$tomonth.':'.$toyear ;?></span> 
<?php } ?>



<br>
<span><?php echo $description;?></span>  <br> <br>
</div>
</div>
<hr>	



<?php	
  }	
}
?>

<!---<div class="row">
<div class="col-md-2">
<img src="https://dev.thesharepage.com/assets/images/icon/sphome/house.png" style="width: 50px;height: 50px;margin-left: 40px;" />
</div>
<div class="col-md-10">		
<b>Data Analyist/is Application Specialist</b>  <br>
<span>Lederal Government of Canada</span>  <br>
<span>Apr 2021 - Present - 10 yrs 10 mos</span>  <br>
<span>Surrey, BC</span>  <br> <br>
</div>
</div>
</ul>
<hr>--->
</div>
</div>  

</tr>



<?php } ?>

<?php if($rows['idspProfileType'] == 5) { ?>

<tr>

<td>College/University*</td>
<td><?php  echo $row4["college"]; ?></td>

</tr>   


<tr>
<td>Accreditation*</td>
<td><?php echo $row4["university"]; ?></td>
</tr> 

<tr>
<td>Experience*</td>
<td><?php echo $row4["experience"]; ?></td>
</tr>

<tr>

<td>Degree*</td>
<td><?php  echo $row4["degree"]; ?></td>

</tr>   


<tr>
<td>Percentage*</td>
<td><?php echo $row4["percentage"]; ?></td>
</tr> 
table
<tr>
<td>Graduate in*</td>
<td><?php echo $row4["graduate"]; ?></td>
</tr>

<!-- <tr>
<td>Make My Profile Publicly</td>
<td><?php echo $row4["profilePublicaly"]; ?></td>
</tr>  -->

<tr>
<td>Skills*</td>
<td><?php echo $row4["skill"]; ?></td>
</tr>

<tr>
<td>References</td>
<td><?php echo $row4["reference"]; ?></td>
</tr> 

<tr>
<td>Achievements</td>
<td><?php echo $row4["achievements"]; ?></td>
</tr>

<tr>
<td>Hobbies</td>
<td><?php echo $row4["hobbies"]; ?></td>
</tr> 

<tr>
<td>Certification</td>
<td><?php echo $row4["certification"]; ?></td>
</tr>

<tr>
<td>Phone Status</td>
<td><?php echo $phone_status; ?></td>
</tr>

<tr>
<td>Profile Status</td>
<td><?php echo $row4["profile_status"]; ?></td>
</tr>



<tr>
<td>About Myself</td>
<td><?php echo $row4["spProfileAbout"]; ?></td>
</tr>






<?php } ?>

<?php if($rows['idspProfileType'] == 6) {  //print_r($rows);?>


<!--<tr>

<td>Interested In*</td>
<td><?php  echo $row5["interested"];?></td>

</tr>   


<tr>
<td>Ideal Relationship*</td>
<td><?php echo $row5["idealrelationship"]; ?></td>
</tr> -->

<tr>
<td>Career In*</td>
<td><?php echo $row5["carrer"]; ?></td>
</tr>

<tr>
<td>Store Name</td>
<td><?php echo $sprows['store_name']; ?></td> 
</tr>

<tr>
<td>My Interest</td>
<td><?php echo $row5["choice"]; ?></td>
</tr>

</table>
<div class="row">
<div class="col-sm-3" style="font-weight: bold;"> 

My Family Members
</div>

<div class="col-sm-3" style="font-weight: bold;"> 
Name

</div>


<div class="col-sm-4" style="font-weight: bold;"> 

Relations
</div>
</div>

<?php
$fm = new _spfamily_profile;

$family1 = $fm->read_famly($_POST["pid"]);






if ($family1 != false) { 
while ($result_1 = mysqli_fetch_assoc($family1)) {  

$str2 = substr($result_1['family_name'], 0); 


?>

<div class="row">
<div class="col-sm-3 mt-2"> 


</div>

<div class="col-sm-3 mt-2"> 
<?php echo $str2; ?>

</div>


<div class="col-sm-3 mt-2"> 

<?php echo $result_1['family_relation']; ?>
</div>
</div>

<?php }  }?>



<!-- <tr>
<th>My Family Members</th>

<th >Name</th>




<th > Relations</th> 										



</tr>

<tr>
<td></td>
<td>ashu</td>

<td>bro</td>



</tr> -->



<?php } ?>



<!--Testing XTRA FIELDS-->
<!--  <?php
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
?>  -->
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
$spshippingtext = $rset["spshippingtext"];
}								

?>


<!--</div>-->

</tbody>
</table>






<?php if($rows['idspProfileType'] == 5) { ?>

<h4 style="margin-left: 7px;" class="heading12">Education Details :</h4>

<table class="table tbl_profile table-striped table-hover">
<thead>
<tr>
<td><h4 class="heading13">School/College</h4></td>
<td><h4 class="heading13">Degree</h4></td>
<td><h4 class="heading13">Field of Study</h4></td>
<td><h4 class="heading13">Year</h4></td>
</tr>
</thead>



<tbody>

<?php

$idspProfiles = $_POST['pid'];
$spProfileType_idspProfileType = 5; 
$empread = new _spemployment_profile;
$data33 = $empread->readEmpEdu($idspProfiles, $spProfileType_idspProfileType);


while($row44 = mysqli_fetch_array($data33) ){   

$school = $row44['school'];
$empdegree = $row44['empdegree'];
$study = $row44['study'];
$year = $row44['year'];
?>

<tr>
<td><?php echo $school;?></td>
<td><?php echo $empdegree;?></td>
<td><?php echo $study;?></td>
<td><?php echo $year;?></td>
</tr>
<?php
}
?>


</tbody>

</table>
<?php			}
?>


<style>
.tbl_profileexp tr td:nth-child(1) {
width: 85px;
font-weight: 700;
color: #000;
font-family: MarksimonRegular;
font-size: 16px; 
}
</style>

<?php if($rows['idspProfileType'] == 5) { ?>

<h4 style="margin-left: 7px;" class="heading12">Experience Details :</h4>

<table class="table tbl_profileexp table-striped table-hover">
<thead>
<tr>
<td class="first-head">
<h4 class="heading13">Job Title</h4></td>
<td><h4 class="heading13">Emp.Type</h4></td>
<td><h4 class="heading13">Company</h4></td>
<td><h4 class="heading13">Location</h4></td>
<td><h4 class="heading13">Duration</h4></td>
<td><h4 class="heading13">Job Desc.</h4></td> 
</tr>
</thead>



<tbody>

<?php
$idspProfile = $_SESSION['uid'];
$spProfileType_idspProfileType1 = 5; 
$empreadexp = new _spemployment_profile;
$data66 = $empreadexp->readEmpExp($idspProfile, $spProfileType_idspProfileType1);


while($row55 = mysqli_fetch_array($data66) ){   
///print_r($postid;); die('xx');
$jobtitle = $row55['jobtitle'];
$company = $row55['company'];

$frommonth = $row55['frommonth'];
$fromyear = $row55['fromyear'];
$frommonth = $row55['frommonth'];
$tomonth = $row55['tomonth'];
$toyear = $row55['toyear'];
$description = $row55['description'];
$current_work = $row55['current_work'];
$emptype = $row55['emptype'];
$postid= $row55['id'];

$country= $row55['country'];
$state= $row55['state'];
$city = $row55['city'];

$cos = new _country;
$result33 = $cos->readCountry();
if($result33 != false){
while ($row33 = mysqli_fetch_assoc($result33)) {
if(isset($country) && $country == $row33['country_id']){
$currentcountry = $row33['country_title']; 
$currentcountry_id = $row33['country_id']; 

}
}
}

if (isset($state) && $state > 0) {
$countryId = $currentcountry_id;
$prs = new _state;
$result23 = $prs->readState($countryId);
if($result23 != false){
while ($row23 = mysqli_fetch_assoc($result23)) { 
if(isset($state) && $state == $row23["state_id"] ){
$currentstate_id = $row23["state_id"];
$currentstate = $row23["state_title"];
}
}
}
}
if (isset($city) && $city > 0) {
$stateId = $currentstate_id;
$cos = new _city;
$result33 = $cos->readCity($stateId);
if($result33 != false){
while ($row33 = mysqli_fetch_assoc($result33)) { 
if(isset($city) && $city == $row33['city_id']){
$currentcity = $row33['city_title'];
$currentcity_id = $row33['city_id'];
}																								}                                                                                             }
} 



$address=$currentcountry.', '.$currentstate.', '.$currentcity ;


if($frommonth==1){
$frommonth="Jan";
}

if($frommonth==2){
$frommonth="Feb";
}	
if($frommonth==3){
$frommonth="March";
}	
if($frommonth==4){
$frommonth="April";
}	
if($frommonth==5){
$frommonth="May";
}	
if($frommonth==6){
$frommonth="June";
}	
if($frommonth==7){
$frommonth="July";
}	
if($frommonth==8){
$frommonth="Aug";
}	
if($frommonth==9){
$frommonth="Sep";
}	
if($frommonth==10){
$frommonth="Oct";
}	
if($frommonth==11){
$frommonth="Nov";
}	
if($frommonth==12){
$frommonth="Dec";
}



if($tomonth==1){
$tomonth="Jan";
}

if($tomonth==2){
$tomonth="Feb";
}	
if($tomonth==3){
$tomonth="March";
}	
if($tomonth==4){  
$tomonth="April";
}	
if($tomonth==5){
$tomonth="May";
}	
if($tomonth==6){
$tomonth="June";
}	
if($tomonth==7){
$tomonth="July";
}	
if($tomonth==8){
$tomonth="Aug";
}	
if($tomonth==9){
$tomonth="Sep";
}	
if($tomonth==10){
$tomonth="Oct";
}	
if($tomonth==11){
$tomonth="Nov";
}	
if($tomonth==12){
$tomonth="Dec";
}







?>

<tr>
<td><?php echo $jobtitle;?></td>
<td><?php echo $emptype;?></td>
<td><?php echo $company;?></td>
<td><?php echo $address;?></td>
<td><?php echo $frommonth.':'.$fromyear.'--'.$tomonth.':'.$toyear
;?></td>
<td><?php echo $description;?></td>
</tr>
<?php
}
?>


</tbody>

</table>
<?php			}
?>






</div>
<!--THIS IS FOR MEMBERSHIP AREA-->
<!-- <div class="form-group">
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
</div> -->
<!-- <div class="alert alert-success <?php echo (($_POST["ptid"] == 5 || $_POST["ptid"] == 6)?"":"hidden" );?>">
<strong style="font-size:18px;">Note!</strong> <span style="font-size:18px;">These profiles are Private profiles,. Only the profiles you are communicate with through these profiles will see these profiles but no one else.</span>
</div> -->
</div>
</div>

<?php } ?>	
</div>



</div>
<!--user data start-->
<!-- 	<div class="panel panel-primary <?php echo ($_POST["ptid"] == 1)?'':'hidden';?>">
<div> -->
<!-- <div class="row">
<div class="col-md-12">
<?php
if($_POST["ptid"] == 1){
echo "<ul class='nav nav-tabs' id='navtabprofile'>
<li class='active' role='presentation'><a href='#aboutstore'  aria-controls='sp-activePost' role='tab' data-toggle='tab'>About Store</a></li>

<li  role='presentation'><a href='#aboutshipping'  aria-controls='sp-activePost' role='tab' data-toggle='tab'>Shipping Destination </a></li>

<li  role='presentation'><a href='#aboutreturn'  aria-controls='sp-activePost' role='tab' data-toggle='tab'>Returns and Refunds</a></li>

<li  role='presentation'><a href='#Policy'  aria-controls='sp-activePost' role='tab' data-toggle='tab'>Policy</a></li>
</ul>";
}
?>
</div>
</div> -->


<!--Testing-->
<!--<div class="tab-content <?php echo ($_POST["ptid"] == 1 ? '""' : "hidden"); ?>" style="margin-left:10px; margin-right:20px;">
<div role="tabpanel" class="tab-pane active  store"  id="aboutstore" >
<?php
$s = new _spprofiles;
$res = $s->read($_POST["pid"]);

if($res != false)
{
$store = mysqli_fetch_assoc($res);
//echo "here"; print_r($store);
$aboutstore = $store["spProfilesAboutStore"];
}
?>
<form action="aboutstore.php" method="post" class="profileform" >
<input type="hidden" name="spProfileid_" value=<?php echo $_POST["pid"];?>>
<div class="form-group">
<label for="aboutstore">About Store</label>
<textarea class="form-control" id="aboutstore" name="spProfilesAboutStore" rows="4" placeholder="Type about store.."><?php echo $aboutstore ; ?></textarea>
</div>
<button type="submit" class="btn btn-success">Submit</button>
</form>
</div>

<div role="tabpanel"  class= "tab-pane store"  id="aboutshipping" >


<form action="addshipping.php" method="post" class="profileform" >
<input type="hidden" name="spProfiles_idspProfiles" value=<?php echo $_POST["pid"];?>>

<div class="form-group">

<label for="aboutstore">Shipping Destination</label>
<textarea class="form-control" id="aboutstore" name="spshippingtext" rows="4" > <?php echo $spshippingtext ; ?></textarea>


</div>


<button type="submit" class="btn btn-success" id="shippingratesbutton" style="margin-top:10px;">Submit</button>
</form>
</div>

<div role="tabpanel"  class= "tab-pane returnrefund"  id="aboutreturn" >

<?php
//print_r($_POST["pid"]);
$s = new _returnrefund;
$result = $s->read($_POST["pid"]);
//echo $s->ta->sql;
// print_r($result);

if($result != false)
{
$rset = mysqli_fetch_assoc($result);
//echo "here"; print_r($rset);	
$day  = 	   $rset["spRetRefundDays"];
$money	= 	   $rset["spRetRefundMoney"];
$spProfilerefund= $rset["spProfilerefund"];
}								

?>

<label for="aboutstore">Returns and Refunds</label>
<form action="addreturnrefund.php" method="post" class="profileform" >
<input type="hidden" name="spProfiles_idspProfiles" value=<?php echo $_POST["pid"];?>>
<textarea class="form-control" id="store" name="spProfilerefund" rows="4" ><?php //echo $spProfilerefund; ?></textarea>

<button type="submit" class="btn btn-success" style="margin-top:10px;">Submit</button>
</form>

</div>

<div role="tabpanel" class="tab-pane store"  id="Policy" >
<?php
$po = new _sppolicy;
$res1 = $po->read($_POST["pid"]);

if($res1 != false)
{
$policy = mysqli_fetch_assoc($res1);
$aboutpolicy = $policy["spProfilepolicy"];
}
?>
<form action="addpolicy.php" method="post" class="profileform" >
<input type="hidden" name="spProfiles_idspProfiles" value=<?php //echo $_POST["pid"];?>>
<div class="form-group">
<label for="aboutstore">Policy</label>
<textarea class="form-control" id="aboutstore" name="spProfilepolicy" rows="4" ><?php //echo $aboutpolicy; ?></textarea>
</div>
<button type="submit" class="btn btn-success">Submit</button>
</form>
</div>
</div> -->
<!--Testing Complete-->
<!-- 
</div>
</div> -->
<script type="text/javascript">


function phoneprivacy(){

var address = $(".address").val();

$.ajax({
type: "POST",
url: "address.php",
cache:false,
data: {'address':address},
success: function(data) {

var obj = JSON.parse(data);

$("#suggested_address").html('<option value="' + obj.address + '" class="op_address">' + obj.address + '</option>');


$("#latitude").val(obj.latitude);
$("#longitude").val(obj.longitude);

} 
}); 
}



</script>



