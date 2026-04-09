
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

?>






<?php 
$u = new _spuser;
$p = new _spAllStoreForm;
$pro = new _spprofiles;
$em = new _email;

	 
	$userId = $_SESSION['uid'];
		$result = $u->read($userId);
		if ($result) {
			
			$row = mysqli_fetch_assoc($result);
			$userEmail = $row['spUserEmail'];
	
			$pid1 = $_SESSION['pid'];
			$result1 = $u->read_pro($pid1);
			if($result1){
			$row1 = mysqli_fetch_assoc($result1);
			}
			$userName = $row1['spProfileName'];
			//echo $userName;
			//die('======');
	
			//$userName = $row['spUserName'];
			$pid = $_SESSION['pid'];
	
			// chek already create or not
			$result = $p->chekOtp($pid);
			if ($result) {
				
				// already created ha then ????
				$row = mysqli_fetch_assoc($result);
				if($row['spstickyOtp']){
				$codeSend = $row['spstickyOtp'];
				$_SESSION['spstickyOtp'] = 	$codeSend;
			}else{
				$codeSend =rand(99999,10000);
				$_SESSION['spstickyOtp'] = $codeSend;

			}

			} else {
				
				// if not created first time created
	
				
				$codeSend =rand(99999,10000);
				$_SESSION['spstickyOtp'] = $codeSend;
	
			}
			//echo $codeSend;die('+++');
			
			// write code here of email
			// ===========SEND EMAIL==============
			$headers = "From: TheSharePage <no-reply@thesharepage.com> \r\n";
			$msg = "Dear " . $userName . ",\r\n\r\n" . "Your code for Vault note is " . $codeSend . "\r\n\r\n";
			$em->send_all_email('krsure1234@gmail.com', $headers, $msg);
	      echo 1;
	
		}
	
