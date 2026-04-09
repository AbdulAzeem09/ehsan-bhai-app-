<style>

#forfreel{

margin-top: -20px ;
margin-right: 57px!important;
}
.dropdown
{
margin-top:20px!important;
}

.modal-content {
padding-left: 10px;
}
</style>


<?php
/*function sp_autoloader($class){
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");*/
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
//echo $_POST["pid"];

if(isset($_POST['pid'])){
$result  = $p->read($_POST["pid"]);
if($result != false)
{
$row = mysqli_fetch_assoc($result);
//print_r($row);
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
$profile_status = $row['profile_status'];
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
}
//echo $userpnone;


$ps = new _spprofessional_profile;

//print_r($_POST['pid']);

if(isset($_POST['pid'])){
$res = $ps->read($_POST["pid"]);
//echo $pf->ta->sql;
if($res != false){

$spprofileid  = "";
$Category  = "";
$Highlights = "";
$Details 	= "";
$spProfileWebsite ="";
$storename = "";
$sphobbies = "";
$Certification = "";
$LanguageFluency = "";
$Experience = "";
$tags = "";
$spProfileAbout = "";

while($result = mysqli_fetch_assoc($res)){
//print_r($result);
if ($spprofileid == '') {
$spprofileid = $result['spprofiles_idspProfiles'];
}
if ($tags == '') {
$tags = $result['sptags'];  
}
if ($spProfileAbout == '') {
$spProfileAbout = $result['spProfileAbout']; 
}
if ($Category == '') {
$Category = $result['category']; 
}

if ($Highlights == '') {
$Highlights = $result['highlights']; 
}
if ($Details == '') {
$Details = $result['details']; 
}
if ($spProfileWebsite == '') {
$spProfileWebsite = $result['spProfileWebsite']; 
}		
if ($sphobbies == '') {
$sphobbies = $result['sphobbies']; 
}		
if ($Certification == '') {
$Certification = $result['spCertification']; 
}	
if ($LanguageFluency == '') {
$LanguageFluency = $result['splanguagefluency']; 
}												
if ($Experience == '') {
$Experience = $result['spExperience']; 
}																
}

}
}
if (isset($spProfile_storename) && !is_null($spProfile_storename) && !empty($spProfile_storename
)){
$storename = $spProfile_storename; 
}
?>
<style>

.row{
margin-right: -2px !important;
margin-left: -2px !important;
margin-left: -13px;
}
.form-group{
margin-left: -13px !important;
}
.db_orangebtn {
background: #7649b3!important;
}


</style>

<div class="col-md-8" style="margin-top: -120px;" > 
<div class="form-group" style="margin-top: -45px;">
<label for="tag" class="control-label">Tag:</label>
<textarea class="form-control profilefield" id="tag" name="tag" value="<?php echo (isset($tags))? $tags: ''; ?>"><?php echo (isset($tags))?$tags: ''; ?></textarea>
</div>


</div>  
<div class="row">
<input type="hidden" class="control-label" id="spprofiles_idspProfiles" name="spprofiles_idspProfiles" value="<?php echo (isset($spprofileid))?$spprofileid: ''; ?>"> 

<div class="col-md-4">
<div class="form-group">
<label for="category_" class="control-label"> Career Category <span class="red">* <span class="error lbl_8"></span></span></label>
<select class="form-control profilefield" id="category_" name="category" required  >


<option value=" 0">Select Category</option>
<?php
//echo "<option value='' disabled selected>".$row["Business Category"]."</option>";
$m = new _masterdetails;
$masterid = 25;
$result = $m->read($masterid);
if($result != false){
while($rows = mysqli_fetch_assoc($result)){ ?>

<option value='<?php echo $rows["idmasterDetails"]; ?>' <?php if(isset($Category)){if($Category == $rows["idmasterDetails"]){echo "selected";}}?> ><?php echo ucfirst(strtolower($rows["masterDetails"]));?></option><?php
}
}
?>



</select>
<span id="error_c" style="color:red;"></span>
<!-- <textarea class="form-control profilefield" id="interestin_" name="interestin_" ><?php echo (empty($row["Interests in"]) ? "" : $row["Interests in"]);?></textarea>  -->
</div>
</div>
<div class="col-md-8">
<div class="form-group"><?php  //echo $Highlights."hello" ;?>
<label for="highlights_" class="control-label">Career Highlights<span class="red">* <span class="error lbl_9"></span></span></label>
<input type="text" class="form-control profilefield" id="highlights_" maxlength="150" name="highlights" value="<?php echo (isset($Highlights))?$Highlights: ''; ?>" required > 
<span id="error_h" style="color:red;"></span>
</div>
</div>

<!-- <div class="col-md-4">
<div class="form-group">
<label for="availablefor_" class="control-label">Available for<span class="red">* <span class="lbl_10"></span></span></label>
<input type="text" class="form-control profilefield" id="availablefor_" name="availablefor_" value="<?php echo (empty($row["Available for"]) ? "" : $row["Available for"]);?>">
</div>
</div> -->
</div>

<div class="row"> 
<div class="col-md-12">
<div class="form-group">
<label for="details_" class="control-label">Accomplishments<span class="red">* <span class="error lbl_11"></span></span></label>
<textarea class="form-control profilefield" id="details_" name="details"  value="<?php echo (isset($Details))?$Details: ''; ?>" required><?php echo (isset($Details))?$Details: ''; ?></textarea> 
<span id="erros" style="color:red;"></span>
</div>
</div>
<!-- <div class="col-md-12" >
<div class="form-group">
<label for="spProfileAbout" class="control-label" id="lblAbout">About<span class="red">* <span class="lbl_12"></span></span></label>
<textarea class="form-control" rows="3" id="spProfileAbout" name="spProfileAbout"><?php echo (isset($about))?$about:''; ?></textarea>
</div>	
</div> -->

</div>

<div class="row">
<div class="col-md-6">
<div class="form-group">
<label for="certification_" class="control-label">Certification(s)</label>
<!--<input type="text" class="form-control profilefield" id="certification_" name="certification_" value="<?php echo (empty($row["spCertification"]) ? "" : $row["spCertification"]);?>">-->
<textarea class="form-control profilefield" id="certification_" name="certification" value="<?php echo (isset($Certification))?$Certification: ''; ?>"><?php echo (isset($Certification))?$Certification: ''; ?></textarea>
</div>
</div>


<div class="col-md-6">
<div class="form-group">
<label for="certification_" class="control-label">Hobbies</label>
<!--<input type="text" class="form-control profilefield" id="certification_" name="certification_" value="<?php echo (empty($row["sphobbies"]) ? "" : $row["sphobbies"]);?>">-->
<textarea class="form-control profilefield" id="sphobbies_" name="sphobbies" value="<?php echo (isset($sphobbies))?$sphobbies: ''; ?>"><?php echo (isset($sphobbies))?$sphobbies: ''; ?></textarea>
</div>
</div>
</div>



<div class="row">

<div class="col-md-6">
<div class="form-group">
<label for="languagefluency_" class="control-label">Language Proficiency</label>
<input type="text" class="form-control profilefield" id="languagefluency_" name="languagefluency" value="<?php echo (isset($LanguageFluency))?$LanguageFluency: ''; ?>"> 
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="languagefluency_" class="control-label">Experience</label>
<input type="text" class="form-control profilefield" id="Experience" name="Experience" value="<?php echo (isset($Experience))?$Experience: ''; ?>"> 
</div>
</div>


</div>


<div class="row">
<div class="col-md-6">
<div class="form-group">
<label for="spProfilePhone" class="control-label">My Website</label>
<input type="text" class="form-control profilefield" id="spProfileWebsite" maxlength="150" name="spProfileWebsite" value="<?php echo (isset($spProfileWebsite))?$spProfileWebsite: ''; ?>"> 
</div>
</div>
<!--	<div class="col-md-6">
<div class="form-group">
<label for="storeName" class="control-label">Store Name</label>
<input type="text" class="form-control profilefield" id="<?php echo (isset($storename)? "":"storeName");?>" name="spDynamicWholesell" value="<?php if(isset($storename)){ echo $storename;}?>"  required> 
<span id="sto" style="color:red;"></span>
</div>

<p class="hidden" id="checkstore">This storename is taken. Try another.</p>
</div>  -->
</div>

<!--div style="border:1px solid black;height:auto" class="Box">--> 
<h4><b>Education</b></h4>
<?php

$idspProfiles = $_POST["pid"];
$spProfileType_idspProfileType = 3; 
$empread = new _spemployment_profile; 
$data33 = $empread->readEmpEdu($idspProfiles, $spProfileType_idspProfileType); 
//	print_r($data33); die("-----------------");

if($data33){
while($row44 = mysqli_fetch_array($data33) ){  
//print_r($row44);
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
<input type="text" class="form-control" value="<?php  echo $school; ?>" name="school[]" />
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label class="control-label">Degree</label>
<input type="text" class="form-control" value="<?php  echo $empdegree; ?>" name="empdegree[]" />
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label class="control-label">Field of Study </label>
<input type="text" class="form-control" value="<?php  echo $study; ?>" name="study[]" />
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<label class="control-label">Year </label>
<input type="text" maxlength="4" class="form-control" onkeypress="return onlyNumberKey(event)" value="<?php  echo $year;  ?>" name="year[]" style="background-color: #edeef0;" />
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




<div class="after-add-more row ">

</div>

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
<label class="control-label">Field of Study </label>
<input type="text" class="form-control"   name="study[]" />
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<label class="control-label">Year </label>
<input type="text" maxlength="4" class="form-control"   name="year[]" onkeypress="return onlyNumberKey(event)" style="background-color: #edeef0;"/> 
</div>
</div>
<div class="col-md-1">
<div class="form-group change">
<label for="">&nbsp;</label><br/>
<a class="btn btn-success add-more">+</a>
</div>
</div>









<?php

$idspProfile = $_POST["pid"];
$spProfileType_idspProfileType1 = 3; 
$empreadexp = new _spemployment_profile;
$data66 = $empreadexp->readEmpExp($idspProfile, $spProfileType_idspProfileType1);

if($data66){
while($row55 = mysqli_fetch_array($data66) ){   
///print_r($postid;); die('xx');
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

?> 
<button type="button" class="btn btn-info btn-lg edit_data btn-border-radius" data-toggle="modal"  data-title="<?php echo $jobtitle ?>"  data-company="<?php echo $company ?>"  data-country="<?php echo $country ?>"  data-state="<?php echo $state ?>"  data-city="<?php echo $city ?>"   data-frommonth="<?php echo $frommonth ?>"   data-fromyear="<?php echo $fromyear ?>"   data-tomonth="<?php echo $tomonth ?>"  data-toyear="<?php echo $toyear ?>" data-current_work="<?php echo $current_work ?>"  data-description="<?php echo $description ?>"   data-postid="<?php echo $postid ?>" data-emptype="<?php echo $emptype ?>"      data-target="#myModal1" id="btn_exp<?php echo $postid;?>">Experience Details</button>	 
<!--
href="expdelete.php?action=delexp&postid=<?php //echo $postid; ?>"-->
<a class="btn btn-danger btn-border-radius" onclick="remove_btn(<?php echo $postid; ?>)" id="remove_btn<?php echo $postid;?>" style="padding: 9px 55px;
border-radius: 5px;">Remove</a><br><br>

<?php }} 
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
<form action="expupadte.php?action=experienceupdate&postid=<?php echo $postid; ?>" method="post">  



<div class="col-md-12">                                
<div class="form-group">
<br>

<label class="control-label">Job Title </label>
<input type="text" class="form-control" id="jobtitle" name="jobtitle" >
<input type="hidden" class="form-control" id="spProfileType" name="spProfileType" value = " 3 ">
</div>
</div>

<input type="hidden" class="form-control" id="postid" name="postid">



<div class="col-md-12">
<div class="form-group">
<label class="control-label">Employment Type</label>
<!--	<input type="text" class="form-control" id="emptype" name="emptype" required> -->

<select class="form-control" id="emptype" name="emptype" >
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
<input type="text" class="form-control" name="company" id="company" >
</div>
</div>

<!----<div class="col-md-12">
<div class="form-group">
<label class="control-label">City/Provience</label> 
<input type="text" class="form-control" name="city" id="city" required>
</div>
</div>----->

<div class="col-md-4">
<div class="" style="margin: 0px 0px 0px -12px;">

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
<div class="" style="margin: 0px 0px 0px -12px;">
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

<!--<div class="col-md-4">
<div class="form-group">
<label class="control-label">Start Date</label>
<input type="date" class="form-control" name="start_date" id="start_date"  >  
</div>
</div-->

<div class="col-md-6">
<div class="form-group">
<label class="control-label">Month Started</label>
<!--	<input type="text" class="form-control" name="frommonth" id="frommonth" required> -->

<select class="form-control" name="frommonth" id="frommonth" >
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


<div class="col-md-6">
<div class="form-group">
<label class="control-label">Year Started</label>
<!--		<input type="number" class="form-control" name="fromyear" id="fromyear" required  min="1900" max="2099"> -->

<select class="form-control" name="fromyear" id="fromyear" >
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


<!--	<div class="col-md-4 hide_this">
<div class="form-group">
<label class="control-label">End Date</label>
<input type="date" class="form-control" name="end_date" id="end_date"  >
</div> 
</div>-->

<div class="col-md-6 hide_this">
<div class="form-group">
<label class="control-label">Month Ended</label>
<!--	<input type="text" class="form-control" name="tomonth" id="tomonth" >  -->

<select class="form-control" name="tomonth"  id="tomonth"  >
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


<div class="col-md-6 hide_this">
<div class="form-group">
<label class="control-label">Year Ended</label>
<!--	<input type="number" class="form-control" name="toyear" id="toyear"   min="1900" max="2099">  -->

<select class="form-control" name="toyear" id="toyear"  >													
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
<textarea class="form-control" row="10" name="description" id="description" ></textarea>
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



<br>
<?php if($_POST["pid"]){?>
<button type="button" class="btn btn-info btn-border-radius btn-lg edit_data" data-toggle="modal"   data-target="#myModal">Add Experience</button>
<?php } ?>     
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content"> 
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Experience Details</h4>
</div>

<form action="expinsert.php?action=experience" method="post">

<div class="col-md-12">                                
<div class="form-group">
<br>

<label class="control-label">Job Title </label>
<input type="text" class="form-control" id="" name="jobtitle" required>
<input type="hidden" class="form-control" id=" " name="spProfileType" value= "3">
<input type="hidden" class="form-control" id=" " name="spProfile_pid" value= "<?php echo $_POST["pid"] ; ?>">

</div>
</div>


<div class="col-md-12">
<div class="form-group">
<label class="control-label">Employment Type</label>
<!--	<input type="text" class="form-control" id="" name="emptype" required > -->

<select class="form-control" id="" name="emptype" required>
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
<input type="text" class="form-control" name="company" id="" required>
</div>
</div>

<!----<div class="col-md-12">
<div class="form-group">
<label class="control-label">City/Provienceaaaa</label> 
<input type="text" class="form-control" name="city" id="" required>
</div>
</div>--->
<div class="col-md-4">
<div class="" style="margin: 0px 0px 0px -12px;">

<label for="spPostingCountry" class="lbl_2">Country</label>
<select class="form-control " name="spPostingsCountry" onchange="spUserCountry(this.value,'new')">
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
<div class="" style="margin: 0px 0px 0px -12px;" >
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

<!--<div class="col-md-4">
<div class="form-group">
<label class="control-label">Start Date</label>
<input type="date" class="form-control" name="start_date" id="start_date" required >  
</div>
</div>-->
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
<div class="col-md-6">
<div class="form-group">
<label class="control-label">Month Started</label>
<!-- <input type="text" class="form-control" name="frommonth" id="" >  -->
<select id='' class="form-control"  name="frommonth" required >
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


<div class="col-md-6">
<div class="form-group">
<label class="control-label">Year Started</label>
<!--		<input type="number" class="form-control" name="fromyear" id=""   min="1900" max="2099" > -->



<select class="form-control" name="fromyear" required >
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
<label class="control-label"><input type="checkbox" id="add_hide" name="current_work" value="1">
</label>
</div>
</div>


<!--<div class="col-md-4 hide_this">
<div class="form-group">
<label class="control-label">End Date</label>
<input type="date" class="form-control" name="end_date" id="end_date" >  
</div>
</div>-->

<div class="col-md-6 hide_this">
<div class="form-group">
<label class="control-label">Month Ended</label>
<!--<input type="text" class="form-control" name="tomonth" id="" > -->
<select id='' class="form-control"  name="tomonth"  >
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


<div class="col-md-6 hide_this">
<div class="form-group">
<label class="control-label">Year Ended</label>
<!--	<input type="number" class="form-control" name="toyear" id=""  min="1900" max="2099" >-->



<select class="form-control" name="toyear"  >
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



<div class="col-md-12">
<div class="form-group">
<label class="control-label">Job Description</label> 
<textarea class="form-control" row="10" name="description" id="" required></textarea>
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


<div class="row">
<!-- <div class="col-md-4">
<div class="form-group">
<label for="spProfilePhone" class="control-label">Personal Phone</label>
<input type="text" class="form-control" id="spProfilePhone" name="spProfilePhone" value="<?php //echo (isset($userpnone)?$userpnone:''); ?>" readonly />
</div>
</div> -->

<div class="col-md-4">
<div class="form-group">
<label for="spProfilePostalCode" class="control-label ">Phone Status</label>
<br>

<input type="radio"  name="phone_status" value="private" <?php if(isset($phone_status) && $phone_status == "private"){ echo 'checked'; }elseif(!isset($phone_status)){ echo ''; }else{ echo " ";} ?>>Private &nbsp;&nbsp;
<input type="radio"  name="phone_status" value="public" <?php echo (isset($phone_status) && $phone_status == "public" )?'checked':''; ?>>Public &nbsp;&nbsp;

</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="spProfilePostalCode" class="control-label ">Profile Status</label>
<br>

<input type="radio"  name="profile_status" value="private" <?php if(isset($profile_status) && $profile_status == "private"){ echo 'checked'; }elseif(!isset($profile_status)){ echo ''; }else{ echo " ";} ?>>Private &nbsp;&nbsp;
<input type="radio"  name="profile_status" value="public" <?php echo (isset($profile_status) && $profile_status == "public" )?'checked':''; ?>>Public &nbsp;&nbsp;

</div>
</div>
<div class="col-md-4 pull-right" >
<div class="form-group ">
<label for="spProfilePostalCode" class="control-label  ">Email Status</label><br>

<input type="radio"  name="email_status" value="private" <?php if(isset($email_status) && $email_status == "private" ){ echo 'checked'; }elseif(!isset($email_status)){ echo ''; }else{ echo " ";} ?>>Private &nbsp;&nbsp;
<input type="radio"  name="email_status" value="public" <?php echo (isset($email_status) && $email_status == "public" )?'checked':''; ?>>Public  &nbsp;&nbsp;

</div>
</div>




</div>

<div class="row">
<div class="col-md-12" id="yourAddresRemove">
<div class="form-group">
<label for="spProfileAbout" class="control-label">About Myself</label>
<textarea class="form-control" rows="3" id="spProfileAbout" name="spProfileAbout" value="<?php echo (isset($spProfileAbout))?$spProfileAbout: ''; ?>"><?php echo (isset($spProfileAbout))?$spProfileAbout: ''; ?></textarea>
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



//$("body").on("click",".add-more",function(){ 
$(".add-more").click(function(){ 
//alert("hello");  
var html = $(".after-add-more").last().clone();

//  $(html).find(".change").prepend("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");

$(html).find(".change").html("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>-</a>");


//$(".after-add-more").last().before(html);
$(".after-add-more").last().after('<div class="after-add-more row"> <div class="col-md-3"> <div class="form-group"> <input type="text" class="form-control" name="school[]"> </div> </div> <div class="col-md-3"> <div class="form-group"> <input type="text" class="form-control" name="empdegree[]"> </div> </div> <div class="col-md-3"> <div class="form-group"> <input type="text" class="form-control "  name="study[]"> </div> </div> <div class="col-md-2"> <div class="form-group"> <input type="text" maxlength="4" class="form-control" name="year[]" onkeypress="return onlyNumberKey(event)" style="background-color: #edeef0;"> </div> </div> <div class="col-md-1"> <a class="btn btn-danger remove">-</a> </div> </div>');

});

$("body").on("click",".remove",function(){ 
$(this).parents(".after-add-more").remove();
});
});
</script>


<script>
$(document).ready(function() {
$("body").on("click",".add-more2",function(){ 
var html = $(".after-add-more2").last().clone();

//  $(html).find(".change").prepend("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");

$(html).find(".change").html("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove2'>REMOVE</a>");


$(".after-add-more2").last().before(html);



});

$("body").on("click",".remove2",function(){ 
$(this).parents(".after-add-more2").remove();
});
});
</script>
<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script-->
<script>
$(document).ready(function(){
$('select#frommonth').attr('required',1);
$('select#fromyear').attr('required',1); 
$('select#tomonth').attr('required',1);
$('select#toyear').attr('required',1);

});
</script>

<script>
function onlyNumberKey(evt) {

// Only ASCII character in that range allowed
var ASCIICode = (evt.which) ? evt.which : evt.keyCode
if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
return false;
return true;
}
</script>
<script>
function remove_btn(id){
$.ajax({
type: "POST",
url: "expdelete.php?action=delexp&postid="+id,
cache:false,
data: {},
success: function(a) {

$("#btn_exp"+id).remove();
$("#remove_btn"+id).remove();

} 
}); 
}


</script>