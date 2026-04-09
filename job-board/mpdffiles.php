

<?php	
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="store/";
include_once ("../authentication/check.php");

}
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

if(isset($_GET['pid']) && $_GET['pid'] >0)
{
$profileId = (int)$_GET['pid'];
}
else
{
header('location:'.$BaseUrl.'/job-board');
}

$_GET["categoryid"] = "2";
$_GET["categoryName"] = "Job Board";
$activePage = 7;

$f = new _spprofiles;
$sl = new _shortlist;

$pid = isset($_GET['pid']) ? (int)$_GET['pid'] : 0;

$conn = mysqli_connect(DOMAIN, UNAME, PASS, DBNAME);
$sql = "SELECT * FROM spemployment_profile Where spprofiles_idspProfiles='$pid'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
// output data of each row
while($row = mysqli_fetch_assoc($result)) {

$tagline = $row['profile_tagline'];
$education = $row['education_level'];
$experience = $row['experience'];
$degree = $row['degree'];
$hobbies = $row['hobbies'];
$category = $row['category'];
$graduate = $row['graduate'];
$skill = $row['skill'];
$skillssa = explode(",", $skill);			
$achievements = $row['achievements'];
$certification = $row['certification'];
$about = $row['spProfileAbout'];
}
}
$em = new _spemployment_profile;

$resemp = $em->read($pid);

if ($resemp != false)
{
$row4 = mysqli_fetch_assoc($resemp);				
}
$sql = "SELECT * FROM spprofiles WHERE idspProfiles= '$pid'";
$result = mysqli_query($conn, $sql);						
if($result)
{
$row = mysqli_fetch_assoc($result);
$Title = $row['spProfileName'];
$email = $row['spProfileEmail'];
$country = $row['spProfilesCountry'];
$city = $row['spProfilesCity'];
$picture = $row['spProfilePic'];
$phone = $row['spProfilePhone'];
$type = $row['spProfileType_idspProfileType'];
$country = $row['spProfilesCountry'];
$dob = $row['spProfilesDob'];
$fi = new _spprofiles;
$result_fi = $fi->read($row['idspProfiles']);
if($result_fi){
$ProjectName = '';
$perhour = '';
$skill = '';
while($row_fi = mysqli_fetch_assoc($result_fi)){                           
$skill = explode(',', $row_fi['skill']);
$overview = $row_fi['spProfileAbout'];
}
}
}
if(isset($picture)){
$profile = "<img  alt='Posting Pic' class='img-responsive center-block freelancerImg' src=' ".($picture)."' >" ;
}else{
$profile = "<img  alt='Posting Pic' class='img-responsive center-block freelancerImg' src='../img/default-profile.png' >" ;
}
require('vendor/autoload.php');
?>
<?php
$html='<style>
img.img-responsive.center-block.freelancerImg {
width: 100px;
height: 100px;
border: 3px solid blue;
} 
.panel-body {
padding: 7px !important;
}
h4.heading12 {
margin-left: 20px;
}
ul li {
list-style-type: none;
}
.panel-default{
padding:5px;
border:1px solid gray;
border-redius:10px;
border-color: #ddd;
}
.panel {
margin-bottom: 20px;
background-color: #fff;
border: 1px solid transparent;
border-radius: 4px;
-webkit-box-shadow: 0 1px 1px rgb(0 0 0 / 5%);
box-shadow: 0 1px 1px rgb(0 0 0 / 5%);
}
</style>';
$html.='<div class="col-xs-12 profile-detail w-100" style="width:100%; height:150px;">
<div class="col-xs-12 col-sm-2 nopadding w-25" style="width:22%; float: left;">
'.$profile.'
</div>
<div class="col-xs-12 col-sm-10 freelancer-details" style="width:77%; float: left;">
<p class="name">'.ucfirst($Title).'&nbsp;&nbsp;<a href="javascript:void(0)"    class="red"><i class="fas fa-comment-dots" style="color: #ff7208;"></i></a>

</p>
<div class="col-xs-12 col-sm-10 nopadding professional-skills">
<div class="col-xs-12 nopadding">
<p>'.$tagline.'</p>
</div>
</div>
</div>
</div>								
<style>
.panel-body {
padding: 7px !important;
}
h4.heading12 {
margin-left: 20px;
}
</style>	
<div class="row">
<div class="col-sm-12 mb-3">

<br>						
<div class="panel panel-default">									
<div class="panel-body">
<h4 class="heading12">Career Highlights</h4>
<ul class="careearhighs">';

if(isset($skillssa) && $skillssa != ''){
foreach($skillssa as $key => $valuae){
$html.=' <li>'.$valuae.'</li>';
}
}else{
$html.=' No Sills Define';
}
$html.='</ul>
</div>
</div>
<div class="panel panel-default">
<div class="panel-body">
<h4 class="heading12">About</h4>
<ul>
<li>'.$about.'</li>
</ul>
</div>
</div>  
<div class="panel panel-default">
<div class="panel-body">
<h4 class="heading12">Certification</h4>
<ul class="careearhighs">
<li>'.$certification.'</li>
</ul>
</div>
</div>   
<div class="panel panel-default">
<div class="panel-body">
<h4 class="heading12">Experience</h4>  <br>						
<div class="row"  style="width:100%; height:100px;">
<div class="col-md-1" style="width:5%; float: left;">
<img src="https://dev.thesharepage.com/assets/images/icon/sphome/house.png" style="width: 50px;height: 50px;margin-left: 10px;" />
</div>
<div class="col-md-11" style="width:95%; float: left;">		
<b>'.$experience.'</b>  <br>
<span>'.$address.'</span>  <br>
</div>
</div>

</div>
</div>  
<div class="panel panel-default">
<div class="panel-body">
<h4 class="heading12">Education</h4>  <br>
<div class="row"  style="width:100%; height:50px;">
<div class="col-md-1" style="width:5%; float: left;">
<img src="https://dev.thesharepage.com/assets/images/icon/sphome/house.png" style="width: 50px;height: 50px;margin-left: 10px;" />
</div>
<div class="col-md-11" style="width:95%; float: left;">		
<b>'.$education.'</b>  <br>
</div>
</div>

</div>
</div>  
<div class="panel panel-default">
<div class="panel-body">
<h4 class="heading12">Accomplishments</h4>
<ul class="careearhighs">
<li style=" color: deepskyblue; ">'.$achievements.'</li>
<li>Certified</li>
</ul>
</div>
</div>   
<div class="panel panel-default">
<div class="panel-body">
<h4 class="heading12">Hobbies</h4>
<ul class="careearhighs">
<li>'.$hobbies.'</li>
<li></li>
</ul>
</div>
</div>   

</div>
</div>';	


$mpdf=new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file='resume/'.time().'.pdf';
$mpdf->output($file,'D');
//D
//I
//F
//S
?>		
