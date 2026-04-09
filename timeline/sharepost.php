<?php
/*error_reporting(E_ALL);
ini_set('display_errors', 'On');  */

session_start();
function sp_autoloader($class){
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$conn = _data::getConnection();


?>

<?php

$postid=$_POST['postid'];
$p = new _favorites;
$sp74 = new _spprofilehasprofile;
$res = $p->share_post($postid); 
 



if($res!= false){

while($rows=mysqli_fetch_assoc($res)) {   


 $profile_id =  $rows['buyerProfileid'];
  
 $result = $p->read_profile($profile_id); 
$row2 = mysqli_fetch_assoc($result);
  $profileid =  $row2['spProfileType_idspProfileType'];


$sp74 = new _spprofilehasprofile;

$resh74 = $sp74->shani44($profileid);
$rows55 = mysqli_fetch_assoc($resh74);

$profile_name=$rows55['spProfileTypeName'];

 echo "<div class='row' style='margin-top:10px;'>";

if($row2['spProfilePic']){ 
echo "<div class='col-md-3' style='margin-right:10px'>";   
  echo '<img src="' . $row2['spProfilePic'] . '" height="50px" width="50px" class="img img-circle" style="margin-right:29px">' . '</div>
<div class="col-md-9" style="text-align:left; margin-left:55px; margin-top:-54px;font-size: 18px;">
  <a style="font-size:16px" href="' . $baseurl . '/friends?profileid=' . $rows['buyerProfileid'] . '">' . $row2['spProfileName'] . '<br> ('.$profile_name.')</a><br><br></div>';

} else {
	echo "<div class='col-md-3' style='margin-right:10px'>";
  echo "<img src='" . $BaseUrl . "/img/default-profile.png' height='50px' width='50px' style='border-radius:50px; margin-right:33px'>" . "</div>
  <div class='col-md-9' style='text-align:left; margin-left:55px; margin-top:-54px;font-size: 18px;'>
  <a style='font-size:16px' href='" . $baseurl . "/friends?profileid=" . $rows['buyerProfileid'] . "'>" . $row2['spProfileName'] . "<br> (".$profile_name.")</a></div>";

  }


echo "</div>";
}


}
else{
  echo "No Data";
}
?> 



