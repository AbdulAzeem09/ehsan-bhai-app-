<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);


include "../../univ/baseurl.php";
session_start();
function sp_autoloader($class)
{
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
if (!isset($_SESSION['pid'])) {
include_once("../../authentication/check.php");
$_SESSION['afterlogin'] = $BaseUrl . "/my-profile/";
}
$pageactive = 116;
?>
 
<?php 
$u = new _spuser;
$p = new _spAllStoreForm;
//$sms = new _sms;
$pro = new _spprofiles;
$em = new _email;
$pin = new _spAllStoreForm;
$pn = $pin->readpindata($_SESSION['pid']);
//print_r($pn);

        $code=$_POST['code'];
       $_SESSION['spstickyOtp'];
      if($code==$_SESSION['spstickyOtp']){
        if($pn != false){
            //die('+++');
            $BaseUrl1=$BaseUrl."/dashboard/sticky-pin/?action=update"; 
          echo $BaseUrl1;
           header("Location: $BaseUrl1");
           $_SESSION['otpconfirm']='otpchecksuccess';
           unset($_SESSION['spstickyOtp']);

        }else{
            //die('=====');
            $BaseUrl1=$BaseUrl."/dashboard/sticky-pin/"; 
            echo $BaseUrl1;
             header("Location: $BaseUrl1");
             $_SESSION['otpconfirm']='otpchecksuccess';

        }
          
      
     }else{
      //   echo 'noooo';
     $BaseUrl2=$BaseUrl."/dashboard/sticky-pin/email_send.php?msg=not"; 
     header("Location:  $BaseUrl2");
      }

