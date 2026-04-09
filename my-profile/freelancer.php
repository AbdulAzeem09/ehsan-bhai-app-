<style>
.row {
margin-right: -8px;
margin-left: -8px;
margin-top: 10px;
} 
fieldset, label {
margin: 0px!important;
padding: 0;
}

#pub{margin-left:10px}
#forfreel{
margin-top:-8px!important;
}

button#profiletypes {
margin-top: 0px!important;
margin-left: 0px!important;
}
.statuscheck{
    margin-right: 5px !important;
}
</style>

<?php

/*error_reporting(E_ALL);
ini_set('display_errors', 'On');*/
/*function sp_autoloader($class){
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");*/
error_reporting(0);
session_start();
if(!isset($_SESSION['pid']))
{	
include_once ("../authentication/check.php");
$_SESSION['afterlogin']="my-profile/";
}

function sp_autoloader($class){
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


$p = new _spprofiles;


if(isset($_POST['pid'])){
$result  = $p->read($_POST["pid"]);
if($result != false)
{

$row = mysqli_fetch_assoc($result);
//echo "<pre>";
//print_r($row); die("____________________");
$name = $row["spProfileName"];

$email = $row["spProfileEmail"];
$phone = $row["spProfileCntryCode"].$row["spProfilePhone"];
$country = $row["spProfilesCountry"];
$state = $row['spProfilesState'];
$city = $row["spProfilesCity"];
$dob = $row['spProfilesDob'];
$about = $row["spProfileAbout"];
$picture = $row["spProfilePic"];
$location = $row["spprofilesLocation"];
$language = $row["spprofilesLanguage"];
$address = $row["spprofilesAddress"];
$postalCode = $row['spProfilePostalCode'];
$relationship_status = $row['relationship_status'];
$phone_status = $row['phone_status'];
$email_status = $row['email_status'];
$address_city = $row["address"];
$spProfile_storename = $row["store_name"];
}
}

$u = new _spuser;
$spuserres = $u->read($_SESSION["uid"]);

//echo $u->ta->sql;

//$ruser = mysqli_fetch_assoc($res);

//echo "<pre>";

//print_r($ruser);

if($spuserres != false)

{
$ruser = mysqli_fetch_assoc($spuserres);
$username = $ruser["spUserName"]; 
$userpnone = $ruser["spUserCountryCode"].$ruser["spUserPhone"]; 
$useremail = $ruser["spUserEmail"]; 
$useraddress = $ruser["spUserAddress"];
$usercountry = $ruser["spUserCountry"]; 
$usercity = $ruser["spUserCity"]; 
$phone_status = $row['phone_status'];
$email_status = $row['email_status'];
$address_city = $row["address"];
$profile_status = $row["profile_status"];
}
//echo $userpnone;



$pf = new _spfreelancer_profile;

//print_r($_POST['pid']);

if(isset($_POST['pid'])){
$res = $pf->read($_POST["pid"]);

//echo $pf->ta->sql;
if($res != false){

$spprofileid  = "";

$Category  = "";
$HourlyRate = "";
$Skills 	= "";
$Certification 	= "";
$Projectworked 		= "";
$WorkingInterests 	= "";
$AvailableFrom      ="";
$References 	= "";
$PersonalWebsite 		= "";
$LanguageFluency 	= "";
$storename      = "";

$tags = "";
$Overview = "";
$Experience = "";
$Education = "";
$experiencedeatil = "";


while($result = mysqli_fetch_assoc($res)){
//echo $result['spprofiles_idspProfiles'];
if ($spprofileid == '') {
$spprofileid = $result['spprofiles_idspProfiles'];
}
if ($tags == '') {
$tags = $result['tags'];

$_SESSION['tagg']= $tags;
}
if ($Education == '') {
$Education = $result['education']; 
}
if ($Experience == '') {
$Experience = $result['experience']; 
}
if ($Overview == '') {
$Overview = $result['overview']; 
}
if ($Category == '') {
$Category = $result['profiletype']; 
}
if ($HourlyRate == '') {
$HourlyRate = $result['hourlyrate']; 
}
if ($experiencedeatil == '') {
$experiencedeatil = $result['Experience_detail']; 
}
if ($Skills == '') {
$Skills = $result['skill']; 
}
if ($Certification == '') {
$Certification = $result['certification']; 
}
if ($Projectworked == '') {
$Projectworked = $result['projectworked']; 
}
if ($WorkingInterests == '') {
$WorkingInterests = $result['workinginterests']; 
}
if ($AvailableFrom == '') {
$AvailableFrom = $result['availablefrom']; 
}
if ($References == '') {
$References = $result['reference']; 
}
if ($PersonalWebsite == '') {
$PersonalWebsite = $result['personalwebsite']; 
}
if ($LanguageFluency == '') {
$LanguageFluency = $result['languagefluency']; 
}
if (isset($spProfile_storename) && !is_null($spProfile_storename) && !empty($spProfile_storename)) {
$storename = $spProfile_storename; 
}		
}
}
}
?>

<script type="text/javascript">
// ===PUT ONLY number
$(".chekspnum").keyup(function(){
//this code executes when the keyup event occurs
//var regExpr = /[^a-zA-Z0-9-. ]/g;
//var regExpr = /[^a-zA-Z0-9 ]/g;
var regExpr = /[^0-9-.]/g;
var userText = $(this).val();

$(this).val(userText.replace(regExpr, ""));
});
// ONLY FOR DATE AND TIME
$('.form_datetime').datetimepicker({
//language:  'fr',
weekStart: 1,
todayBtn:  1,
autoclose: 1,
todayHighlight: 1,
startView: 2,
forceParse: 0,
minView: 2,
});
</script>


<div class="row" >
<input type="hidden" class="control-label" id="spprofiles_idspProfiles" name="spprofiles_idspProfiles" value="<?php echo (isset($spprofileid))?$spprofileid: ''; ?>"> 

<div class="col-md-6">
<input type="hidden" class="form-control profilefield" id="spprofiles_idspProfiles" name="spprofiles_idspProfiles" value="<?php echo (isset($spprofileid))?$spprofileid: ''; ?>"> 


<div class="form-group">
<label for="profiletype_" class="control-label">Career Category<span class="red">* </span></label>
<select class="form-control profilefield" id="profiletype_" name="profiletype"  required >
<option value="0">Select Category</option>
<?php
$m = new _subcategory;
$catid = 5;
$result = $m->read($catid);
if($result){
while($row2 = mysqli_fetch_assoc($result)){
?>
<option value='<?php echo $row2['idsubCategory'];?>'<?php echo ($Category == $row2["idsubCategory"] )?'selected':'';?>><?php echo ucfirst(strtolower($row2['subCategoryTitle']));?></option> 
<?php
}
}


?>
</select>
<span class="error_category " style="color:red"></span>
</div>
</div>
<div class="col-md-6 pull right">
<div class="form-group">
<label for="hourlyrate_" class="control-label">Hourly Rate (USD)<span class="red">* </span></label>
<input type="text" class="chekspnum form-control profilefield" id="hourlyrate_" name="hourlyrate" value="<?php echo (isset($HourlyRate))?$HourlyRate: ''; ?>" placeholder="$"    required >
<span class="error lbl_9" id="span4" style="color:red"></span>

</div>
</div>
</div>
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label for="skill_" class="control-label">Skills (Each skill separated with comma)<span class="red">* </span></label>


<textarea class="form-control profilefield" id="skill_" name="skill" value="<?php echo (isset($Skills))?$Skills: ''; ?>" required ><?php echo (isset($Skills))?$Skills: ''; ?></textarea>
<span class="error_skills" id="span44" style="color:red"></span>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label for="certification_" class="control-label">Certification(s)</label>
<!--<input type="text" class="form-control profilefield" id="certification_" name="certification_" value="<?php echo (empty($row["Certification"]) ? "" : $row["Certification"]);?>">-->
<textarea class="form-control profilefield" id="certification_" name="certification" value="<?php echo (isset($Certification))?$Certification: ''; ?>"><?php echo (isset($Certification))?$Certification: ''; ?></textarea>
<span class="error_certification" style="color:red"></span>
</div>
</div>
</div>

<div class="row">
<div class="col-md-6">
<div class="form-group">
<label for="projectworked_" class="control-label">Project worked</label>
<!--<input type="text" class="form-control profilefield" id="projectworked_" name="projectworked_" value="<?php echo (empty($row["Project worked"]) ? "" : $row["Project worked"]);?>">--> 
<textarea class="form-control profilefield" id="projectworked_" name="projectworked" value="<?php echo (isset($Projectworked))?$Projectworked: ''; ?>"><?php echo (isset($Projectworked))?$Projectworked: ''; ?></textarea>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="workinginterests_" class="control-label">Working Interests</label>
<!--<input type="text" class="form-control profilefield" id="workinginterests_" name="workinginterests_" value="<?php echo (empty($row["Working Interests"]) ? "" : $row["Working Interests"]);?>">-->

<textarea class="form-control profilefield" id="workinginterests_" name="workinginterests" value="<?php echo (isset($WorkingInterests))?$WorkingInterests: ''; ?>"><?php echo (isset($WorkingInterests))?$WorkingInterests: ''; ?></textarea>
</div>
</div>
<!-- <div class="col-md-12" >
<div class="form-group">
<label for="spProfileAbout" class="control-label" id="lblAbout">About Profile<span class="red">* <span class="lbl_11"></span></span></label>
<textarea class="form-control" rows="3" id="spProfileAbout" name="spProfileAbout"><?php echo (isset($about))?$about:''; ?></textarea>
</div>	
</div> -->
</div>
<div class="row">
<div class="col-md-6">

<div class="form-group">
<label for="availablefrom_" class="control-label">Available From</label>
<div class="input-group date form_datetime" data-date="" data-date-format="yyyy-mm-dd "  data-link-field="dtp_input1">
<span class="input-group-addon"><span class="fa fa-calendar"></span></span>                   
<input type="text" class="form-control profilefield" id="availablefrom_" name="availablefrom"  value="<?php echo (isset($AvailableFrom))?$AvailableFrom: ''; ?>" readonly >
</div>

</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="references_" class="control-label">References</label>
<!-- <input type="text" class="form-control profilefield" id="references_" name="reference" value="<?php echo (isset($References))?$References: ''; ?>">  -->

<textarea class="form-control profilefield" id="references_" name="reference" value="<?php echo (isset($References))?$References: ''; ?>"><?php echo (isset($References))?$References: ''; ?></textarea>
</div>
</div>
</div>

<div class="row">
<div class="col-md-6">
<div class="form-group">
<label for="personalwebsite_" class="control-label">Personal Website</label>
<input type="text" class="form-control profilefield" id="personalwebsite_" name="personalwebsite" value="<?php echo (isset($PersonalWebsite))?$PersonalWebsite: ''; ?>"> 
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="languagefluency_" class="control-label">Language Fluency</label>
<input type="text" class="form-control profilefield" id="languagefluency_" name="languagefluency" value="<?php echo (isset($LanguageFluency))?$LanguageFluency: ''; ?>"> 
</div>
</div>

</div>

<div class="row">
<div class="col-md-6">
<div class="form-group">
<label for="personalwebsite_" class="control-label">Overview</label>
<input type="text" class="form-control profilefield" id="Overview" name="Overview" value="<?php echo (isset($Overview))?$Overview: ''; ?>"> 
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="languagefluency_" class="control-label">Experience</label>
<input type="text" class="form-control profilefield" id="Experience" name="Experience" value="<?php echo (isset($Experience))?$Experience: ''; ?>"> 
</div>
</div>

</div>
<div>  <h4>Education</h4>
<?php
//echo $_POST["pid"];
$idspProfiles = $_POST["pid"];
$spProfileType_idspProfileType = 2; 
$empread = new _spemployment_profile; 
$data33 = $empread->readEmpEdu($idspProfiles, $spProfileType_idspProfileType); 
//	print_r($data33); die("-----------------");

if($data33){
while($row44 = mysqli_fetch_array($data33) ){  

$school = $row44['school'];
$empdegree = $row44['empdegree'];
$study = $row44['study'];
$year = $row44['year'];
$spProfileTypeNew = $row44["spProfileType_idspProfileType"];

?>

<div class="after-add-more row">

<div class="col-md-3">                                
<div class="form-group">
<label class="control-label">School/College</label>
<input type="text" class="form-control" value="" name="school[]" />
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label class="control-label">Degree</label>
<input type="text" class="form-control" value="" name="empdegree[]" />
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label class="control-label">Field of Study </label>
<input type="text" class="form-control" value="" name="study[]" />
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<label class="control-label">Year </label>
<input type="text" min="1900" max="2100" class="form-control" value="" name="year[]" />
</div>
</div>
<div class="col-md-1">
<div class="form-group change">
<label for="">&nbsp;</label><br/>
<a class="btn btn-danger remove">-</a>
</div>
</div>
</div>

<?php  }

} ?>



<div class="after-add-more row">

<div class="col-md-3">                                
<div class="form-group">
<label class="control-label">School/College</label>
<input type="text" class="form-control"  name="school[]" />
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label class="control-label">Degree</label>
<input type="text" class="form-control"  name="empdegree[]" />
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label class="control-label">Field of Study</label>
<input type="text" class="form-control"   name="study[]" />
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<label class="control-label">Year</label>
<input type="text" maxlength="4" class="form-control" onkeypress="return onlyNumberKey(event)"  name="year[]" />
</div>
</div>
<div class="col-md-1">
<div class="form-group change">
<label for="">&nbsp;</label><br/>
<a class="btn btn-success add-more">+</a>
</div>
</div>

</div>




</div>

<div> 
<?php

if(isset($_SESSION['exp_id'])) {
   $exp_id = $_SESSION['exp_id'];
   foreach($exp_id as $value ){    
        $idspProfile = $_POST['pid'];
        $spProfileType_idspProfileType1 = 2; 
        $empreadexp = new _spemployment_profile;
        $data66 = $empreadexp->readEmpExp($value, $spProfileType_idspProfileType1);
        $row55 = $data66->fetch_assoc();
        $jobtitle = $row55['jobtitle'];
        $company = $row55['company'];
        $country = $row55['country'];
        $state = $row55['state'];
        $city = $row55['city'];
        $frommonth = $row55['frommonth'];
        $fromyear = $row55['fromyear'];
        $frommonth = $row55['frommonth'];
        $tomonth = $row55['tomonth'];
        $toyear = $row55['toyear'];
        $description = $row55['description'];
        $current_work = $row55['current_work'];
        $emptype = $row55['emptype'];
        $postid= $row55['id'];
    } 
}
?>

<?php
 if(isset($experienceid)) {
    $array = explode(',', $experienceid);
    foreach($array as $value ){    
        $idspProfile = $_POST['pid'];
        $spProfileType_idspProfileType1 = 2; 
        $empreadexp = new _spemployment_profile;
        $data66 = $empreadexp->readEmpExp($value, $spProfileType_idspProfileType1);
        $row55 = $data66->fetch_assoc();
        $jobtitle = $row55['jobtitle'];
        $company = $row55['company'];
        $country = $row55['country'];
        $state = $row55['state'];
        $city = $row55['city'];
        $frommonth = $row55['frommonth'];
        $fromyear = $row55['fromyear'];
        $frommonth = $row55['frommonth'];
        $tomonth = $row55['tomonth'];
        $toyear = $row55['toyear'];
        $description = $row55['description'];
        $current_work = $row55['current_work'];
        $emptype = $row55['emptype'];
        $postid= $row55['id'];
    } 
}
?>


<!-- Modal -->
<div class="modal fade" id="myModal1" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Experience Details</h4>
</div>
<form action="expupadte.php?action=experienceupdate" method="post">



<div class="col-md-12">                                
<div class="form-group">
<br>

<label class="control-label">Job Title </label>
<input type="text" class="form-control" id="jobtitle" name="jobtitle" required>
<input type="hidden" class="form-control" id="spProfileType" name="spProfileType" value = " 2 ">
</div>
</div>

<input type="hidden" class="form-control" id="postid" name="postid">



<div class="col-md-12">
<div class="form-group">
<label class="control-label">Employment Type  (eg Full time , Part time)</label>
<!--	<input type="text" class="form-control" id="emptype" name="emptype" required> -->

<select class="form-control" id="emptype" name="emptype" required>
<option value=''>-- Select Type --</option>
<option value="Permanent">Permanent</option>
<option value="Part-Time">Part-Time</option>
<option value="Contract">Contract</option>
<option value="Voluntary">Voluntary</option>
</select>


</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label class="control-label">Company Name</label>
<input type="text" class="form-control" name="company" id="company" required>
</div>
</div>

<!----<div class="col-md-12">
<div class="form-group">
<label class="control-label">City/Provience</label> 
<input type="text" class="form-control" name="city" id="city" required>
</div>
</div>----->

<div class="col-md-4">
<div class="">

<label for="spPostingCountry" class="lbl_2">Country</label>
<select class="form-control " name="spPostingsCountry" id="spPostingsCount" onchange="spUserCountry(this.value,'edit')">
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
<div class="col-md-4">
<div class="">
<label for="spPostingCity" class="lbl_3">State</label>
<select class="form-control" id="appstateedit" name="spPostingsState"  onchange="spUserStates(this.value,'edit')">
<option>Select State</option>
</select>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<div class="">
<label for="spPostingCity" class="">City</label>
<select class="form-control" id="appcityedit" name="spUserCity" >
<option>Select City</option>
</select>
</div>
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label class="control-label">Start Date</label>
<!--<input type="date" name ="date1"id="start1">-->

</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label class="control-label">Month</label>
<!--	<input type="text" class="form-control" name="frommonth" id="frommonth" required> -->

<select class="form-control" name="frommonth" id="frommonth" required>
<option value=''>--Select Month--</option>
<option  value='1'>Janaury</option>
<option value='2'>February</option>
<option value='3'>March</option>  
<option value='4'>April</option>
<option value='5'>May</option>
<option value='6'>June</option>
<option value='7'>July</option> 
<option value='8'>August</option>
<option value='9'>September</option>
<option value='10'>October</option>
<option value='11'>November</option>
<option value='12'>December</option>
</select>
</div> 
</div>


<div class="col-md-4">
<div class="form-group">
<label class="control-label">Year</label>
<!--		<input type="number" class="form-control" name="fromyear" id="fromyear" required  min="1900" max="2099"> -->

<select class="form-control" name="fromyear" id="fromyear">
<option value=''>-- Select Year --</option>
<option value="2022">2022</option>
<option value="2021">2021</option>
<option value="2020">2020</option>
<option value="2019">2019</option>
<option value="2018">2018</option>
<option value="2017">2017</option>
<option value="2016">2016</option> 
<option value="2015">2015</option>
<option value="2014">2014</option>
<option value="2013">2013</option>
<option value="2012">2012</option>
<option value="2011">2011</option>
<option value="2010">2010</option>
<option value="2009">2009</option>
<option value="2008">2008</option>
<option value="2007">2007</option>
<option value="2006">2006</option>
<option value="2005">2005</option>
<option value="2004">2004</option>
<option value="2003">2003</option>
<option value="2002">2002</option>
<option value="2001">2001</option>
<option value="2000">2000</option>
<option value="1999">1999</option>
<option value="1998">1998</option>
<option value="1997">1997</option>
<option value="1996">1996</option>
<option value="1995">1995</option>
<option value="1994">1994</option>
<option value="1993">1993</option>
<option value="1992">1992</option>

</select>	

</div>
</div>



<div class="col-md-4">
<div class="form-group">
<label class="control-label">This is my current job</label>
</div>
</div>

<div class="col-md-8">
<div class="form-group">
<label class="control-label"><input type="checkbox" id="edit_current" name="current_work" value="1"></label>
</div>
</div>


<div class="col-md-4">
<div class="form-group">
<label class="control-label">End Date</label>
</div> 
</div>

<div class="col-md-4">
<div class="form-group">
<label class="control-label">Month</label>
<!--	<input type="text" class="form-control" name="tomonth" id="tomonth" >  -->

<select class="form-control" name="tomonth"  id="tomonth"  required >
<option value=''>--Select Month--</option>
<option  value='1'>Janaury</option>
<option value='2'>February</option>
<option value='3'>March</option>
<option value='4'>April</option>
<option value='5'>May</option>
<option value='6'>June</option>
<option value='7'>July</option>
<option value='8'>August</option>
<option value='9'>September</option>
<option value='10'>October</option>
<option value='11'>November</option>
<option value='12'>December</option>
</select>
</div>
</div>


<div class="col-md-4">
<div class="form-group">
<label class="control-label">Year</label>
<!--	<input type="number" class="form-control" name="toyear" id="toyear"   min="1900" max="2099">  -->

<select class="form-control" name="toyear" id="toyear" required>													
<option value=''>-- Select Year -- </option>
<option value="2022">2022</option>
<option value="2021">2021</option>
<option value="2020">2020</option>
<option value="2019">2019</option>
<option value="2018">2018</option>
<option value="2017">2017</option>
<option value="2016">2016</option> 
<option value="2015">2015</option>
<option value="2014">2014</option>
<option value="2013">2013</option>
<option value="2012">2012</option>
<option value="2011">2011</option>
<option value="2010">2010</option>
<option value="2009">2009</option>
<option value="2008">2008</option>
<option value="2007">2007</option>
<option value="2006">2006</option>
<option value="2005">2005</option>
<option value="2004">2004</option>
<option value="2003">2003</option>
<option value="2002">2002</option>
<option value="2001">2001</option>
<option value="2000">2000</option>
<option value="1999">1999</option>
<option value="1998">1998</option>
<option value="1997">1997</option>
<option value="1996">1996</option>
<option value="1995">1995</option>
<option value="1994">1994</option>
<option value="1993">1993</option>
<option value="1992">1992</option>

</select>	
</div>
</div>



<div class="col-md-12">
<div class="form-group">
<label class="control-label">Job Description</label> 
<textarea class="form-control" row="10" name="description" id="description" required></textarea>
</div>
</div>



<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>

<button type="submit" class="btn btn-primary btn-border-radius" >Save</button>
</div>
</div>

</form>

</div> 






</div>

<!-- <textarea class="form-control"  id="content"  style="display:none;" name="add_exp" maxlength="5000"></textarea> -->
<?php if($experiencedeatil !=''){ ?> 
        <h4 for="add_exp">Update Experience </h4>
<?php } else{ ?> 
        <h4 for="add_exp"> Add Experience </h4>
<?php } ?>
<link rel='stylesheet' href='../css/quill.css'> 
<div class="col-md-12 pro_detail_box" style=" width:90%; margin:8px;">
<textarea  name="content" class="form-control c-with-editor" id="content" rows="30" style="display:none;" required><?php echo $experiencedeatil; ?></textarea>
<div id="editor-container" style="height:200px;" value="<?php echo $experiencedeatil; ?>"><?php echo $experiencedeatil; ?></div>
</div>					
<script>	

    var quill = new Quill('#editor-container', {
        modules: {
            toolbar: [
                [{ header: [1, 2, false] }],
                ['bold', 'italic', 'underline']
            ]
        },
        theme: 'snow'  // or 'bubble'
    });
    quill.on("text-change", function() {
        var editor_content = quill.container.firstChild.innerHTML ;
        document.getElementById("content").value = editor_content;
    });

</script>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Experience Details</h4>
</div>

<form action="javascript:void(0)" method="post">

<div class="col-md-12">                                
<div class="form-group">
<br>

<label class="control-label">Job Title </label>
<input type="text" class="form-control" id="jobtitles" name="jobtitle" required>
<input type="hidden" class="form-control" id="spProfileTypes" name="spProfileType" value= "2">
<input type="hidden" class="form-control" id="spProfile_pids" name="spProfile_pid" value= "<?php echo $_POST["pid"] ; ?>">
</div>
</div>


<div class="col-md-12">
<div class="form-group">
<label class="control-label">Employment Type (eg Full time , Part time)</label>
<!--	<input type="text" class="form-control" id="" name="emptype" required > -->

<select class="form-control" id="emptypes" name="emptype" required>
<option value=''>-- Select Type --</option>
<option value="Permanent">Permanent</option>
<option value="Part-Time">Part-Time</option>
<option value="Contract">Contract</option>
<option value="Voluntary">Voluntary</option>
</select>

</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label class="control-label">Company Name</label>
<input type="text" class="form-control" name="company" id="company_name" required>
</div>
</div>

<!----<div class="col-md-12">
<div class="form-group">
<label class="control-label">City/Provienceaaaa</label> 
<input type="text" class="form-control" name="city" id="" required>
</div>
</div>--->
<div class="col-md-4">
<div class="">

<label for="spPostingCountry" class="lbl_2">Country</label>
<select class="form-control " id="countrys" name="spPostingsCountry" onchange="spUserCountry(this.value,'new')">
<option value="">Select Country</option>
<?php
$co = new _country;
$result3 = $co->readCountry();
if($result3 != false){
while ($row3 = mysqli_fetch_assoc($result3)) {
?>
<option value='<?php echo $row3['country_id'];?>'><?php echo $row3['country_title'];?></option>
<?php
}
}
?>
</select>

</div>
</div>
<div class="col-md-4">
<div class="">
<label for="spPostingCity" class="lbl_3">State</label>
<select class="form-control" id="appstatenew" name="spPostingsState" onchange="spUserStates(this.value,'new')">
<option>Select State</option>
</select>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<div class="">
<label for="spPostingCity" class="">City</label>
<select class="form-control" id="appcitynew" name="spUserCity" >
<option>Select City</option>
</select>
</div>
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label class="control-label">Start Date</label>
<input type="date" name="start_date" id="start1">

</div>
</div>
<script type="text/javascript">
function spUserCountry(countryId,news){
$.post("../loadnewstate.php", {countryId: countryId}, function (r) {
$("#appstate"+news).html(r);
});
}		
function spUserStates(state,news){
$.post("../loadnewcity.php", {state: state}, function (r) {
$("#appcity"+news).html(r);
});
}	
</script>	



<div class="col-md-4">
<div class="form-group">
<label class="control-label">This is my current job</label>
</div>
</div>

<div class="col-md-8">
<div class="form-group">
<label class="control-label"><input type="checkbox" id="add_hide" name="current_work" value="1">
</label>
</div>
</div>


<div class="col-md-4 hide_this">
<div class="form-group">
<label class="control-label">End Date</label>
<input type="date" name="end_date" id="end1" required >

</div>
</div>




<div class="col-md-12">
<div class="form-group">
<label class="control-label">Job Description</label> 
<textarea class="form-control" row="10" name="description" id="descriptions" required></textarea>
</div>
</div>



<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" style="margin-top:28px;" data-dismiss="modal">Close</button>

<button type="submit" class="btn btn-primary btn-border-radius" id="modelsave" style="margin-top: 28px;" >Save</button>

</div>
</div>

</form>
</div>
</div>
<br>
<div class="row">

<div class="col-md-4" >
<div class="form-group">
<label for="spProfilePostalCode" class="control-label " >Phone Status</label>
<br>

<input type="radio"  name="phone_status" class="statuscheck"  value="private" <?php if(isset($phone_status) && $phone_status == "private"){ echo 'checked'; }elseif(!isset($phone_status)){ echo ''; }else{ echo " ";} ?>>Private &nbsp;&nbsp;
<input type="radio"  name="phone_status" class="statuscheck" value="public" <?php echo (isset($phone_status) && $phone_status == "public" )?'checked':''; ?>>Public &nbsp;&nbsp;

</div>
</div>
<?php echo $profile_status;?>
<div class="col-md-4" >
<div class="form-group">
<label for="spProfilePostalCode" class="control-label ">Profile Status</label>
<br>

<input type="radio"  name="profile_status" class="statuscheck" value="private" <?php if(isset($profile_status) && $profile_status == "private"){ echo 'checked'; }elseif(!isset($profile_status)){ echo ''; }else{ echo " ";} ?>>Private &nbsp;&nbsp;
<input type="radio"  name="profile_status" class="statuscheck" value="public" <?php echo (isset($profile_status) && $profile_status == "public" )?'checked':''; ?>>Public &nbsp;&nbsp;

</div>
</div>

<div class="col-md-4 pull-right" >
<div class="form-group ">
<label for="spProfilePostalCode" class="control-label ">Email Status</label><br>



<input type="radio"  name="email_status" class="statuscheck" value="private" <?php if(isset($email_status) && $email_status == "private" ){ echo 'checked'; }elseif(!isset($email_status)){ echo ''; }else{ echo " ";} ?>>Private 
<input type="radio" id="pub" name="email_status" class="statuscheck" value="public" <?php echo (isset($email_status) && $email_status == "public" )?'checked':''; ?>>Public

</div>
</div>

</div>

</div>

<script>
$(document).ready(function() {
$('#add_hide').change(function(){
var value_current = $('#add_hide').val();

if(this.checked) {
$('.hide_this').hide();
$('.hide_this').hide();
$('.hide_this').hide();
}
else {
$('.hide_this').show();
$('.hide_this').show();
$('.hide_this').show();
}
});

$(".edit_data").click(function () {
var title = $(this).attr('data-title');
var company = $(this).attr('data-company');
var country = $(this).attr('data-country');
var state = $(this).attr('data-state');
var city = $(this).attr('data-city');
var frommonth = $(this).attr('data-frommonth');
var fromyear = $(this).attr('data-fromyear');
var tomonth = $(this).attr('data-tomonth');
var toyear = $(this).attr('data-toyear');
var description = $(this).attr('data-description');
var emptype = $(this).attr('data-emptype');
var postid = $(this).attr('data-postid');
var current_work = $(this).attr('data-current_work');

$("#spPostingsCount").val(country).change();

const myTimeout = setTimeout(myGreeting, 1000);

function myGreeting() {
$("#appstateedit").val(state).change();
}
const myTimeout2 = setTimeout(myGreeting2, 2000);

function myGreeting2() {
$("#appcityedit").val(city).change();
}



if(current_work=="1"){
$('#edit_current').prop('checked', true);
}
else {
$('#edit_current').prop('checked', false);
}
$("#jobtitle").val( title );
$("#postid").val( postid );

$("#emptype").val( emptype );
$("#company").val( company );
$("#frommonth").val( frommonth );
$("#fromyear").val( fromyear );
$("#toyear").val( toyear );
$("#tomonth").val( tomonth );
$("#description").append( description );

});  



$(".add-more").click(function(){ 
var html = $(".after-add-more").last().clone();

//  $(html).find(".change").prepend("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");

$(html).find(".change").html("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>-</a>");


//$(".after-add-more").last().before(html);
$(".after-add-more").last().after('<div class="after-add-more row"> <div class="col-md-3"> <div class="form-group"> <input type="text" class="form-control" name="school[]"> </div> </div> <div class="col-md-3"> <div class="form-group"> <input type="text" class="form-control" name="empdegree[]"> </div> </div> <div class="col-md-3"> <div class="form-group"> <input type="text" class="form-control" name="study[]"> </div> </div> <div class="col-md-2"> <div class="form-group"> <input type="text" min="1900" max="2100" class="form-control" name="year[]"> </div> </div> <div class="col-md-1"> <a class="btn btn-danger remove">-</a> </div> </div>');



});

$("body").on("click",".remove",function(){ 
$(this).parents(".after-add-more").remove();
});
});
</script>

<!-- <script>
$('#addExperience').click(function() {
   $('#myModal').modal('show');
});

$('#modelsave').click(function() {
    var jobtitle = $('#jobtitles').val();
    var spProfileTypes = $('#spProfileTypes').val();
    var spProfile_pids = $('#spProfile_pids').val();
    var emptypes = $('#emptypes').val();
    var company_name = $('#company_name').val();
    var countrys = $('#countrys').val();
    var appstatenew = $('#appstatenew').val();
    var appcitynew = $('#appcitynew').val();
    var start1 = $('#start1').val();
    var add_hide = $('#add_hide').val();
    var end1 = $('#end1').val();
    var descriptions = $('#descriptions').val();
   $.ajax({
        type: 'POST',
        url: 'expinsert.php',
        data: { 
                jobtitle: jobtitle, 
                spProfileType: spProfileTypes, 
                spProfile_pid: spProfile_pids,
                emptype: emptypes,
                company: company_name, 
                spPostingsCountry: countrys,
                spPostingsState: appstatenew,
                spUserCity:appcitynew,
                start_date: start1, 
                end_date:end1,
                description: descriptions,
                current_work: add_hide,
                action:'experience_add_ajax',

              },
        success: function(response) {
        if(response){
            $('#myModal').modal('hide');
        }else{
            alert('data not saved')
        }
        }
    })
});
</script> -->




