<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include('../univ/baseurl.php');

function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");

session_start();
$i = 0;
$u = new _spuser;
$uc = new _city;
$re = new _redirect;
//    $_POST['spUserEmail'] ="ashish7730@gmail.com";
// 	   $_POST['spUserPassword'] ="123456";

if ($_POST['spUserEmail'] != '') {
$r = $u->login($_POST['spUserEmail'], hash("sha256", $_POST['spUserPassword']));

//echo json_encode($r); exit;

if ($r != false) {
//$verify = $u->isEmailVerify($);
// chek user is locked or unlock
$result2 = $u->chekLock($_POST['spUserEmail']);

if ($result2) {

// IF NOT LOCKED THEN WORKING PROPER
if ($r->num_rows == 1) {
if ($rows = mysqli_fetch_array($r)) {
//echo "<pre>";
//print_r($rows);
// echo "</pre>";exit;
$spUserEmail = $rows['spUserEmail'];
$spUserPassword = $rows['spUserPassword'];

$userid=$rows['idspUser'];
$fname=$rows['spUserFirstName'];
//  echo $redirctUrl;

//  print_r($spUserEmail);
/*  print_r($spUserPassword);
print_r($userid);
exit();
*/
//   print_r($_POST['spUserEmail']);

/*if ($_POST['spUserEmail'] == $spUserEmail && hash("sha256", $_POST['spUserPassword']) == $spUserPassword ) {*/

$userId = $rows['idspUser'];

$u->update_login_status($userId);
$result = $u->read($userId);

$ip = $_SERVER['REMOTE_ADDR'];
function ip_details($ip) 
{
    $json       = file_get_contents("http://ipinfo.io/{$ip}");

    $details    = json_decode($json);
    return $details;
}

$details = ip_details("$ip");
$country = $details?->country ?? ''; 
$check_country=$uc->readCityName_country($country);
$row_country = '';
if ($check_country) {
    $row_c = mysqli_fetch_assoc($check_country);

    $row_country = $row_c['countryname'];
}
$country = $row_country;



//$date=$details->timezone;					


$date_time = date("Y-m-d H:i:s") ;


$check = $u->read_ip($userId,$ip);
//var_dump($check);die;
if($check==false){


//$spUserEmail ="anoopmauryaam02@gmail.com";

/*$headers = "From: THE SHAREPAGE <admin@thesharepage.com> \r\n";
$msg = "Dear User  \r\n";
$msg .= "We've detected something unusual about a recent sign-in to your Sharepage Account Therefore, to help keep you safe, we wiill require an extra security challenge confirmation .\r\n";

$msg .= "<div style='background-color:#D3D3D3' >
<b style='font-size:20px;margin-left:20px;'>Sign-in details:</b><br>
<b style='margin-left:20px;'>Country/Region</b>: $country <br>
<b style='margin-left:20px;'>IP Address</b>: $ip <br>
<b style='margin-left:20px;'>Date</b> : $date_time



</div>\r\n\r\n";
$msg .= "If this was you , you can ignore this email.\r\n\r\n";
$msg .= "If you are sure this was not you , please click the link to change your\r\n password.\r\n\r\n";
$msg .= "<a href = 'https://dev.thesharepage.com/forgot-password.php'>Change Your\r\n Password</a>.\r\n";

$msg .= "Thank you.\r\n";
$msg .= "The SharePage";  */

$msg = '
<!DOCTYPE html>
<html>
<head>
<title>The SharePage</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<style type="text/css">
.mmaintab{
background: #FFF;
margin: 0 auto;
padding: 15px;
width: 640px;
}
.logo h1{
color: #000;
margin: 20px 0px 25px;;

}
.letstart{
background: #2F6230;
padding: 15px;
font-size: 20px;
color: #FFF;
margin: 15px 0px;
text-align: center;
}
.letstart h1{
font-size: 20px;
margin: 0px;
}
.btn{
background: #2F6230;
color: #FFF!important;
padding: 8px 15px;
display: inline-block;
margin-bottom: 15px;
text-decoration: none;
margin-top: 15px;
}
.foot{
border-top: 1px solid;
text-align: center;

}
.foot p{
margin: 0px;
color: #808080;
padding: 10px
}
.no-margin{
margin: 0px;
}                   
</style>
</head>
<body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
<table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td align="center" class="logo" >
<a href="'.$BaseUrl.'/"><img src="'.$BaseUrl.'/assets/images/logo/tsp_trans.png" alt="The SharePage" style="width: 100px;"></a>
<h1>The SharePage</h1>
</td>
</tr>

<tr>
<td>
<p>Hi '.ucfirst(strtolower($fname)).',</p>

</td>
</tr>



<tr>
<td>
<p> We have detected something unusual about a recent sign-in to your Sharepage account. Therefore, to help keep you safe, we will require an extra security challenge confirmation .</p>

</td>
</tr>

<div style="background-color:#D3D3D3" ><br>
<b style="font-size:20px;margin-left:20px;">Sign-in details:</b><br><br>
<b style="margin-left:20px;">Country/Region</b>:&nbsp;&nbsp;'.$country.' <br><br>
<b style="margin-left:20px;">IP Address</b>:&nbsp;&nbsp;'. $ip.' <br>
<p><b style="margin-left:20px;">Date</b>: &nbsp;&nbsp;'.$date_time.'</p>
<br>
</div>

<p>If this was you, you can ignore ...If you are sure this was not you.<br><a style="clear: both;display: inline-block; overflow: hidden; white-space: nowrap;" href ="'.$BaseUrl.'/forgot-password.php">Click Here To Change Password</a>.</p>	

</tbody>

</table>
<div style="width: 640px;text-align: center;margin: 0 auto">
<p style="margin-bottom: 10px;">© Copyright '.date('Y').' The SharePage. All rights reserved.</p>

</div>

</body>
</html>

';


$uemail = new _email;

$uemail->send_all_email($spUserEmail , "The SharePage", $msg);

//mail($spUserEmail , "New - The SharePage", $msg, $headers);
// $re = new _redirect;

$create_ip=array("users_ip"=>$ip,"spuser_idspuser"=>$userid,"country"=>$country,"date"=>date('Y-m-d H:i:s'));
$ipp=$u->create_ip($create_ip);
}



if ($result) {
$row = mysqli_fetch_assoc($result);

$genratecode = $row['phone_verify_code'];

$mobile = $row["spUserCountryCode"].$row['spUserPhone'];



if ($row["twostep"]  == 0) {

if ($rows['is_email_verify'] == 1) {

/*session_start();*/
// UPDATE USER IP IN DATABASE
$ip = $_SERVER['REMOTE_ADDR'];

if ($ip != '') {

$result11 = $u->updateIp($ip, $rows['idspUser']);
}

$_SESSION['login_user'] = $rows['spUserName'];
$_SESSION['uid'] = $rows['idspUser'];
$_SESSION['spUserEmail'] = $rows['spUserEmail'];
$_SESSION['deactivateStatus'] = $rows['deactivate_status'];
$p = new _spprofiles;
//$rp = $p->readProfiles($_SESSION['uid']);
//login with default profile
$rp = $p->readDefaultProfile($_SESSION['uid']);

if ($rp != false) {


$row = mysqli_fetch_array($rp);

$updateid = $p->update(array('is_active' => 1), "WHERE t.idspProfiles =" . $row['idspProfiles']);

$_SESSION['pid'] 			= $row['idspProfiles'];
$_SESSION['myprofile'] 		= $row["spProfileName"];
$_SESSION['MyProfileName'] 	= $row["spProfileName"];
$_SESSION['ptname'] 		= $row["spProfileTypeName"];
$_SESSION['ptpeicon'] 		= $row["spprofiletypeicon"];
$_SESSION['ptid'] 			= $row["spProfileType_idspProfileType"];
$_SESSION['isActive'] 		= 1;
$c = new _order;
$res = $c->read($_SESSION['pid']);

if ($res != false) {

$_SESSION['cartcount'] = $res->num_rows;
//echo $_SESSION['cartcount'];
} else {

$_SESSION['cartcount'] = 0;
}
}

if (isset($_SESSION['login_user'])) {

if (isset($_SESSION['afterlogin'])) {
$redirctUrl = $BaseUrl . "/" . $_SESSION['afterlogin'];

} else {

$redirctUrl = $BaseUrl . "/timeline/";

}

echo $redirctUrl;
//die();
/*header("Location: $redirctUrl");*/


//$re->redirect($redirctUrl);
}
}
} else {

if ($genratecode == "" || $genratecode == 0) {
//GENERATE ALPHA NUMARIC RANDOM NUMBERS UNIQUE START
$size = 6;
$alpha_key = '';
$keys = range('A', 'Z');
for ($i = 0; $i < 2; $i++) {
$alpha_key .= $keys[array_rand($keys)];
}
$length = $size - 2;
$key = '';
$keys = range(0, 9);
for ($i = 0; $i < $length; $i++) {
$key .= $keys[array_rand($keys)];
}

$randCode = $alpha_key . $key;

// echo"here"; print_r($randCode);
//GENERATE ALPHA NUMARIC RANDOM NUMBERS UNIQUE END
// UPDATE CODE ON USER PROFILE START
//$u->updateCode($userId, $randCode);
$u->updateEmailCode($userId, $randCode, 1);
//echo $u->ta->sql;
// UPDATE CODE ON USER PROFILE END
/*$message = "Verification code for online account registration is:" .urlencode($randCode)." Okease verify at www.thesharepage.com";*/

$message = urlencode($randCode)." is your code to login to TheSharePage.com . Do not share it with anyone.";
} else {
/*$message = "Verification code for online account registration is:" .$row['phone_verify_code']." Okease verify at www.thesharepage.com";*/

$message = $row['phone_verify_code']." is your code to login to TheSharePage.com . Do not share it with anyone.";
// is your code to login to TheSharePage.com . Do not share it with anyone.

//$message = $row['phone_verify_code'];
}
//SEND SMS TO SPECIFIC USER WHO REGISTER START
$sms = new _sms;
$sms->send_any_sms($mobile, $message);
//SEND SMS TO SPECIFIC USER WHO REGISTER END
// echo 1;

$redirctUrl = $BaseUrl ."/loginverfication.php?uid=".($userId);

echo $redirctUrl;
}
} else {
echo 2;
}


/*echo "true";
}
else{
echo "false";
}
*/
}
}
} else {
$rows = mysqli_fetch_array($r);


$_SESSION['new_email'] =$rows['spUserEmail'];
$_SESSION['new_username'] = $rows['spUserName'];
$_SESSION['last_user'] = $rows['idspUser'];
$_SESSION['email_otp'] = $rows['email_verify_code'];

 echo 1;
}
} else {
echo 0;
}
} else {
echo 0;
}
