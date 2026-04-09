<?php
include('../univ/baseurl.php');
include_once $_SERVER["DOCUMENT_ROOT"]."/helpers/common.php";

function sp_autoloader($class)
{
	include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$u = new _spuser;
$em = new _email;
$p = new _spprofiles;
$number = $_POST['spfregemail'];
if (str_contains($_POST['spfregemail'], '@')) {

$d = $p->read_description_f(2);
if ($d) {
	$ro = mysqli_fetch_array($d);
	$notification_description = $ro['notification_description'];
	$subject = $ro['subject'];
}
$res = $u->regen($_POST['spfregemail']);
//echo $u->ta->sql;
if ($res != false) {
	$row = mysqli_fetch_assoc($res);
	$recode = "";
	$recode = str_shuffle($row["spUserPassword"]);
	$username = $row["spUserName"];
	$u->resetcode($_POST['spfregemail'], $recode);

	if ($recode != "") {
		//echo "helo";
		$link = $BaseUrl . "/authentication/resetpassword.php?me=" . $row["idspUser"] . "&recode=" . $recode;
//die('======kkk====');
		$em->forgotpass($row['spUserFirstName'], $_POST['spfregemail'], $link, $notification_description, $subject);
	}
	echo 0;
} else {
	echo 1;
}


} else if(is_numeric($number)){
	$res = $u->regennum($number);
	if($res != false){
	
		$row1 = mysqli_fetch_assoc($res);
		$recode1 = "";
		$recode1 = str_shuffle($row1["spUserPassword"]);
		$username = $row1["spUserName"];
		$u->resetcode($_POST['spfregemail'], $recode);
		if($row1['is_phone_verify']==1 && $row1['spUserLock']==0){
		if($recode1 != false){
		  $spUserPhone = $row1['phone_code']. $row1['spUserPhone'];
		  $link = $BaseUrl . "/authentication/resetpassword.php?me=" . $row1["idspUser"] . "&recode=" . $recode1;
	
	    $txt='This is the link to reset you sharepage password  '.$link.'.Do not share this code with anyone.';
      
      callSmsApi($spUserPhone, $txt);
          	
	
    }
		echo 1;
		

	} else {
	  echo 3;
	}
	

	} else{
		echo 2;
	}
	
	










}
