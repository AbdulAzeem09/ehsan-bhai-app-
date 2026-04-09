<?php
session_start();
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');

include('../univ/baseurl.php');

function sp_autoloader($class)
{
	include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$u = new _spuser;
$p = new _spprofiles;

if($_POST['spotp'] == $_SESSION['loginotp'])
{
    
    $res = $u->checkuseiotp($_SESSION['loginotpuser']);
    $rows = mysqli_fetch_assoc($res);

$_SESSION['login_user'] = $rows['spUserName'];
$_SESSION['uid'] = $rows['idspUser'];
$_SESSION['spUserEmail'] = $rows['spUserEmail'];





//$rp = $p->readProfiles($_SESSION['uid']);
//login with default profile
$rp = $p->readDefaultProfile($_SESSION['loginotpuser']);


if ($rp == false) {
$rp = $p->readDefaultProfile_causal($_SESSION['loginotpuser']);
}

if ($rp != false) {


$row = mysqli_fetch_array($rp);

$updateid = $p->update(array('is_active' => 1), "WHERE t.idspProfiles =" . $row['idspProfiles']);

$_SESSION['pid']             = $row['idspProfiles'];
$_SESSION['myprofile']         = $row["spProfileName"];
$_SESSION['MyProfileName']     = $row["spProfileName"];
$_SESSION['ptname']         = $row["spProfileTypeName"];
$_SESSION['ptpeicon']         = $row["spprofiletypeicon"];
$_SESSION['ptid']             = $row["spProfileType_idspProfileType"];
$_SESSION['isActive']         = 1;
$c = new _order;
$res = $c->read($_SESSION['pid']);
if ($res != false) {
$_SESSION['cartcount'] = $res->num_rows;
//echo $_SESSION['cartcount'];
} else {
$_SESSION['cartcount'] = 0;
}
}





///data unset session 
unset($_SESSION['loginotp']);
unset($_SESSION['solidotp']);
unset($_SESSION['emailsend']);
unset($_SESSION['loginotpuser']);
unset($_SESSION['mail_notverify']);
unset($_SESSION['emaillogin']);
unset($_SESSION['resend']);








if (isset($_SESSION['login_user'])) {
if (isset($_SESSION['afterlogin'])) {
$redirctUrl = $BaseUrl . "/" . $_SESSION['afterlogin'];
} else {

$redirctUrl = $BaseUrl . "/timeline/";
}



header('location:' . $redirctUrl);









 
}
}else{
    $_SESSION['validOTP'] = 'yes';
    header("Location: $BaseUrl/enter-OTP.php"); 
}



?>