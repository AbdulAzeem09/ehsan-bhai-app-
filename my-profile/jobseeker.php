
<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/

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
if(isset($_POST['pid'])){
$result  = $p->read($_POST["pid"]);
if($result != false)
{

$row = mysqli_fetch_assoc($result);
//echo "<pre>";
//print_r($row); die("____________________");
$phone_statuss = $row["phone_status"];

$profile_statuss = $row["profile_status"];

}}


$p = new _spprofiles;


if(isset($_SESSION['uid'])){
$result  = $p->read($_POST["pid"]);
if($result != false)
{
$row = mysqli_fetch_assoc($result);
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




$em = new _spemployment_profile;
//print_r($_SESSION['uid']);

if(isset($_SESSION['uid'])){
$res = $em->read($_POST["pid"]);
//echo $pf->ta->sql;
if($res != false){

$spprofileid  = "";

$College  = "";
$University = "";
$Experience 	= "";
$Degree 	= "";
$Percentage 		= "";
$Graduate 	= "";
$ProfilePublicaly 	= "";
$Skills      ="";
$References 	= "";
$Achievements 		= "";
$Hobbies 	= "";
$Certification 	= "";
$profile_status = "";
$profile_tagline = "";
$education_level = "";




while($result = mysqli_fetch_assoc($res)){


if ($spprofileid == '') {
$spprofileid = $result['spprofiles_idspProfiles'];
}
if ($College == '') {
$College = $result['college']; 
}
if ($University == '') {
$University = $result['university']; 
}
if ($Experience == '') {
$Experience = $result['experience']; 
}
if ($Degree == '') {
$Degree = $result['degree']; 
}
if ($Percentage == '') {
$Percentage = $result['percentage']; 
}
if ($Graduate == '') {
$Graduate = $result['graduate']; 
}
if ($ProfilePublicaly == '') {
$ProfilePublicaly = $result['profilePublicaly']; 
}
if ($Skills == '') {
$Skills = $result['skill']; 
}
if ($References == '') {
$References = $result['reference']; 
}
if ($Achievements == '') {
$Achievements = $result['achievements']; 
}
if ($Hobbies == '') {
$Hobbies = $result['hobbies']; 
}
if ($Certification == '') {
$Certification = $result['certification']; 
}
if ($profile_status == '') {
$profile_status = $result['profile_status']; 
}
if ($profile_tagline == '') {
$profile_tagline = $result['profile_tagline']; 
}
if ($education_level == '') {
$education_level = $result['education_level']; 
}
}
}
}

?>


<style type="text/css">
.tagLine-max-char {
padding: 7px;
font-size: smaller;
font-weight: 600;
}
.label-info {
background-color:  #032350;
}
.bootstrap-tagsinput {
background-color :  #edeef0;
padding:  0px 0px 0px 4px;
border-radius:  0px;
line-height:  32px;
width: 66%;
}

</style>


<div class="row">
<input type="hidden" class="control-label" id="spprofiles_idspProfiles" name="spprofiles_idspProfiles" value="<?php echo (isset($spprofileid))?$spprofileid: ''; ?>">

<p style="padding-left: 15px;
font-size: 17px;
font-weight: bold;">
Tag Line <span style="font-weight:lighter;">(<em><i>Write a catchy phrase to attract employer's attention</i></em>)</span>
</p>

<div class="col-md-12" style="display:inline-flex;padding-bottom:15px;">
<input type="text" class="form-control" name="jobSeekProfileTagline" id="jobSeekProfileTagline" maxlength="60" style="width:70%" value="<?php echo (isset($profile_tagline))?$profile_tagline: ''; ?>">
<span class="tagLine-max-char">Max 60 characters</span>
</div>

<!-- <p style="padding-left: 15px;
font-size: 17px;
padding-top: 45px;
font-weight: bold;
padding-bottom: 0px;">EDUCATION</p> -->

</div>

<!-- <div class="row" style="margin-left: 1px; margin-bottom: 8px;">


<button class="btn" id="showemployedata" style="font-weight: bold;  background-color: #edeef0;   color: #000; min-width: 123px;">Add More</button>



</div> -->



<!-- <div class="row" style="display:none" id="displayempdegree"> -->

<div  class="row" >

<div class="col-md-4">
<div class="form-group">
<label for="spPostingEducationLevel_" class="lbl_11">Education Level</label>
<select class="form-control" id="spPostingEducationLevel_" data-filter="1" name="spPostingEducationLevel">
<option value="highschool" <?php //echo ($education_level == 'highschool') ? selected : '';  ?>>High School</option>
<option value="undergraduate" <?php //echo($education_level == 'undergraduate') ? selected : ''; ?>>Under-Graduate</option>
<option value="graduate" <?php //echo($education_level == 'graduate') ? selected : ''; ?>>Graduate</option>
</select>
</div>
</div>
<div class="col-md-4 degree-section <?php echo($education_level == 'highschool' || $education_level == '') ? 'hide' : '' ?>">
<div class="form-group">
<label for="degree_" class="control-label">Degree<span class="red">* <span class="error lbl_11"></span></span></label>
<input type="text" class="form-control profilefield" id="degree_" name="degree" value="<?php echo (isset($Degree))?$Degree: ''; ?>"> 
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="graduate_" class="control-label">Completed On<span class="red">* <span class="error lbl_13"></span></span></label>
<input type="date" class="form-control profilefield" id="graduate_" onchange="myFunction()" name="graduate" value="<?php echo (isset($Graduate))?$Graduate: ''; ?>"> 
<span id="error_com" style="color:red;"></span>
</div>
</div>

<div class="col-md-4 degree-section <?php echo($education_level == 'highschool' || $education_level == '') ? 'hide' : '' ?>">
<div class="form-group">
<label for="college_" class="control-label">College/University<span class="red">* <span class="error lbl_8"></span></span></label>
<input type="text" class="form-control profilefield" id="college_" name="college" value="<?php echo (isset($College))?$College: ''; ?>"> 
</div>
</div>

<div class="col-md-4 degree-section <?php echo($education_level == 'highschool' || $education_level == '') ? 'hide' : '' ?>">
<div class="form-group">
<label for="university_" class="control-label">Accreditation<span class="red">* <span class="error lbl_9"></span></span></label>
<input type="text" class="form-control profilefield" id="university_" name="university" value="<?php echo (isset($University))?$University: ''; ?>"> 
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label for="spPostingJobType_" class="lbl_11">Career Sector</label>
<select class="form-control spPostField" id="spPostingJobType_" data-filter="1" name="spPostingJobType" value="<?php echo (empty($row["Job Type"]) ? "" : $row["Job Type"]);?>">
<?php
$m = new _subcategory;
$catid = 2;
$result = $m->read($catid);

/*echo $m->ta->sql;*/
if($result){
while($rows = mysqli_fetch_assoc($result)){ ?>
<option value='<?php echo $rows["subCategoryTitle"]; ?>' <?php if(isset($jobType)){if($jobType == $rows['subCategoryTitle']){echo "selected";}}?>><?php echo ucwords(strtolower($rows["subCategoryTitle"])); ?></option>
<?php
}
}
?>


</select>
</div>
</div>
<!-- <div class="col-md-4">
<div class="form-group">
<label for="percentage_" class="control-label">Percentage<span class="red">* <span class="error lbl_12"></span></span></label>
<input type="text" class="form-control profilefield" id="percentage_" name="percentage" value="<?php //echo (isset($Percentage))?$Percentage: ''; ?>"> 
</div>
</div> -->
</div> 




<!-- <div class="col-md-4">
<div class="form-group">
<label for="profilePublicaly_" class="control-label">Make My Profile Publicly</label>
<select class="form-control profilefield"  id="profilePublicaly_" name="profilePublicaly">
<option value="Yes" <?php if ( $ProfilePublicaly == "Yes" ) { echo "selected"; } ?>>Yes</option>
<option  value="No" <?php if ( $ProfilePublicaly == "No" ) { echo "selected"; } ?>>No</option>
</select>



</div>
</div> -->
<!-- <div class="col-md-12"> -->
<div class="form-group" >
<!-- <label for="skill_" class="control-label">Skills (Each skill separated with comma)<span class="red">* <span class="error lbl_14"></span></span></label> -->
<label for="skill_" class="control-label">
Highlight <span class="red"><span class="error lbl_14"></span>
</span>
<span style="font-weight:lighter;">(<em><i>Enter max 10 skills by pressing enter for multiple</i></em>)</span>
</label>
<!-- <script type="text/javascript"> -->

<!-- jQuery(document).ready( function () {
$("#submitButton").click( function(e) {
e.preventDefault();
$("#guests").append('<div class="col-md-4" style="display:flex;">\
<input class="form-control" type="text" name="textbox" placeholder="textbox">\
<button class="remove_this btn btn-danger" style="margin-left: 10px;height: 32px;">remove</button><br><br></div>');
return false;
});

jQuery(document).on('click', '.remove_this', function() {
jQuery(this).parent().remove();
return false;
});
$("#addallskill").click(function(e) {
e.preventDefault();
$('.Additem')
.val(
$.map($("#guests :text"), function(el) {
return el.value
}).filter(Boolean).join(",\n")
)
})
});
-->

<!-- /*     	var maxAppend = 0;
$(document).ready(function() {
$("#submitButton").on("click", function(e) {
e.preventDefault();
var input = $("#skill").val()
//$("#guests").html(input)
if (maxAppend >= 6) return;
//$("#guests").append("<li><h5>"+input+"</h5></li>")


$("#guests").append($("<li style='list-style: decimal!important;'>").text(input));

$('.Additem').val(function(i,val) { 
return val + (!val ? '' : ', ') + input;
});
// $(".Additem").text(($(".Additem").text() + ', ' + input).replace(/^, /, ''));
maxAppend ++;
// alert(input);
})
}); */ -->
<!-- </script> -->
<!-- <input type="hidden" name="skill" class="Additem" > -->

<div class="form-group">
<!-- <input type="text" value="" data-role="tagsinput" /> -->
<input type="text" class="form-control profilefield" name="skill" id="skill" value="<?php echo (isset($Skills))?$Skills: ''; ?>" data-role="tagsinput">
<!-- <button id="submitButton" type="button" style="margin-left: 25px;" class="btn btn-primary">Add</button> -->
<!-- <button id="addallskill" type="button" style="margin-left: 25px;" class="btn btn-primary">Add All Skills</button> -->
</div>

<h4>Education</h4>
<?php

$idspProfiles = $_POST["pid"];
$spProfileType_idspProfileType = 5; 
$empread = new _spemployment_profile; 
$data33 = $empread->readEmpEdu($idspProfiles, $spProfileType_idspProfileType); 
//	print_r($data33); die("-----------------");

if($data33){
while($row44 = mysqli_fetch_array($data33) ){  

$school = $row44['school'];
$empdegree = $row44['empdegree'];
$study = $row44['study'];
$year = $row44['year'];

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
<!--<div class="after-add-more row">


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
<input type="text" min="1900" max="2100"  class="form-control" value="<?php  echo $year; ?>" name="year[]" />
</div>
</div>
<div class="col-md-1">
<div class="form-group change">
<label for="">&nbsp;</label><br/>
<a class="btn btn-danger remove">-</a>
</div>
</div>
</div>-->


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

<!--<div class="after-add-more row">

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
<input type="text" maxlength="4" class="form-control" onkeypress="return onlyNumberKey(event)"  name="year[]" />

</div>
</div>
<div class="col-md-1">
<div class="form-group change">
<label for="">&nbsp;</label><br/>
<a class="btn btn-success add-more">+</a>
</div>
</div>-->







<script>

function onlyNumberKey(evt) { 

// Only ASCII character in that range allowed
var ASCIICode = (evt.which) ? evt.which : evt.keyCode
if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
return false;
return true;
}

function myFunction(){
$(document).ready(function(){
$("#graduate_").change(function(){
//alert('mkj');
$("#error_com").hide();
});
});


}




</script>




<?php

$idspProfile = $_SESSION['uid'];
$spProfileType_idspProfileType1 = 5; 
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
<button type="button" class="btn btn-info btn-lg edit_data btn-border-radius" data-toggle="modal"  data-title="<?php echo $jobtitle ?>"  data-company="<?php echo $company ?>"  data-country="<?php echo $country ?>"  data-state="<?php echo $state ?>"  data-city="<?php echo $city ?>"   data-frommonth="<?php echo $frommonth ?>"   data-fromyear="<?php echo $fromyear ?>"   data-tomonth="<?php echo $tomonth ?>"  data-toyear="<?php echo $toyear ?>" data-current_work="<?php echo $current_work ?>"  data-description="<?php echo $description ?>"   data-postid="<?php echo $postid ?>" data-emptype="<?php echo $emptype ?>"      data-target="#myModal1">Experience Details</button>	 <a class="btn btn-danger btn-border-radius" href="addprofiles.php?action=delexp&postid=<?php echo $postid; ?>" onclick="return confirm('Are you sure you want to delete this ?');">Remove</a><br><br>

<?php }
}
?>



<!-- Modal -->
<div class="modal fade" id="myModal1" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Experience Details 111</h4>
</div>
<form action="addprofiles.php?action=experienceupdate" method="post">



<div class="col-md-12">                                
<div class="form-group">
<br>

<label class="control-label">Job Title </label>
<input type="text" class="form-control" id="jobtitle" name="jobtitle" required>
<input type="hidden" class="form-control" id=" " name="spProfileType" value= "5">
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

<select class="form-control" name="tomonth"  id="tomonth" >
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

<select class="form-control" name="toyear" id="toyear">													
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



<br>

<button type="button" class="btn btn-info btn-border-radius btn-lg edit_data" data-toggle="modal"   data-target="#myModal">Add Experience</button>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Experience Details 333</h4>
</div>

<form action="addprofiles.php?action=experience" method="post">

<div class="col-md-12">                                
<div class="form-group">
<br>

<label class="control-label">Job Title </label>
<input type="text" class="form-control" id="" name="jobtitle" required>
<input type="hidden" class="form-control" id=" " name="spProfileType" value= "5">
</div>
</div>


<div class="col-md-12">
<div class="form-group">
<label class="control-label">Employment Type (eg Full time , Part time)</label>
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
<div class="">

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
<label class="control-label">Month</label>
<!-- <input type="text" class="form-control" name="frommonth" id="" >  -->
<select id='' class="form-control"  name="frommonth">
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
<!--		<input type="number" class="form-control" name="fromyear" id=""   min="1900" max="2099" > -->



<select class="form-control" name="fromyear" >
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


<div class="col-md-4 hide_this">
<div class="form-group">
<label class="control-label">End Date</label>
</div>
</div>

<div class="col-md-4 hide_this">
<div class="form-group">
<label class="control-label">Month</label>
<!--<input type="text" class="form-control" name="tomonth" id="" > -->
<select id='' class="form-control"  name="tomonth">
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


<div class="col-md-4 hide_this">
<div class="form-group">
<label class="control-label">hyuYear</label>
<!--	<input type="number" class="form-control" name="toyear" id=""  min="1900" max="2099" >-->



<select class="form-control" name="toyear" >
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




</div>




<!-- </div>
-->		

<div class="form-group">

<label for="certification_" class="control-label">Certification</label>
<textarea class="form-control profilefield" id="certification_" name="certification"><?php echo (isset($Certification))?$Certification: ''; ?></textarea> 
</div>

<div class="form-group">
<label for="achievements_" class="control-label">Achievements</label>
<textarea class="form-control profilefield" id="achievements_" name="achievements"><?php echo (isset($Achievements))?$Achievements: ''; ?></textarea> 
</div>


<div class="form-group">
<label for="experience_" class="control-label">Experience<span class="red"><span class="error lbl_10"></span></span></label>
<input type="text" class="form-control profilefield" id="experience_" name="experience" value="<?php echo (isset($Experience))?$Experience: ''; ?>"> 
</div>

<div class="form-group">
<label for="hobbies_" class="control-label">Hobbies</label>
<textarea class="form-control profilefield" id="hobbies_" name="hobbies"><?php echo (isset($Hobbies))?$Hobbies: ''; ?></textarea> 
</div>

<div class="form-group">
<label for="references_" class="control-label">References</label>
<textarea class="form-control profilefield" id="references_" name="reference"><?php echo (isset($References))?$References: ''; ?></textarea>    
</div>


<div class="row">
<!-- <div class="col-md-4">
<div class="form-group">
<label for="spProfilePhone" class="control-label">Personal Phone</label>
<input type="text" class="form-control" id="spProfilePhone" name="spProfilePhone" value="<?php echo (isset($userpnone)?$userpnone:''); ?>" readonly />
</div>
</div> -->

<div class="col-md-4">
<div class="form-group">
<label for="spProfilePostalCode" class="control-label pb_10">Phone Status</label>
<br>

<input type="radio"  name="phone_status" value="private" <?php if(isset($phone_statuss) && $phone_statuss == "private"){ echo 'checked'; }elseif(!isset($phone_statuss)){ echo 'checked'; }else{ echo " ";} ?>>Private &nbsp;&nbsp;
<input type="radio"  name="phone_status" value="public" <?php echo (isset($phone_statuss) && $phone_statuss == "public" )?'checked':''; ?>>Public &nbsp;&nbsp;

</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label for="spProfilePostalCode" class="control-label pb_10">Profile Status</label>
<br>

<input type="radio"  name="profile_status" value="private" <?php if(isset($profile_statuss) && $profile_statuss == "private"){ echo 'checked'; }elseif(!isset($profile_statuss)){ echo 'checked'; }else{ echo " ";} ?>>Private &nbsp;&nbsp;
<input type="radio"  name="profile_status" value="public" <?php echo (isset($profile_statuss) && $profile_statuss == "public" )?'checked':''; ?>>Public &nbsp;&nbsp;

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
alert("hello");
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

<!-- <script type="text/javascript">
$(document).ready(function () {
//alert();
$("#showemployedata").click(function () {
$("#displaydegree").toggle();

});
});


</script> -->
<!-- <div class="form-group">
<label for="spProfileAbout" class="control-label" id="lblAbout">About</label>
<textarea class="form-control" rows="3" id="spProfileAbout" name="spProfileAbout"><?php echo (isset($about))?$about:''; ?></textarea>
</div>	 -->

<script type="text/javascript">
$(document).ready(function () {
// $("input").tagsinput('items');
$('#skill').tagsinput({
trimValue: true,
maxTags: 10
});
});
$("#spPostingEducationLevel_").on('change', function() {    
var slctedValue = this.value;
if (slctedValue == 'undergraduate' || slctedValue == 'graduate') {
$(".degree-section").removeClass('hide');
} else {
var hasClass = $( ".degree-section" ).hasClass('hide');
if (!hasClass) {
$(".degree-section").addClass('hide');
}
}
});






</script>


