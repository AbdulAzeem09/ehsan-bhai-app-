<?php
session_start();

include('../univ/baseurl.php');




function sp_autoloader($class)
{
	include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");



$al = new _spAllStoreForm;
///$result = $al->createInvite($_POST);

// SEND EMAILS
//$email = array();

$p = new _spprofiles;

$d = $p->inviteFrd_description(4);
if ($d) {
	$ro = mysqli_fetch_array($d);
	//$notification_description = $ro['notification_description'];
	$subject = $ro['subject'];
}

$_SESSION['invite_friend'] = 'yes';




$email = $_POST['if_email'];
$business_services = $_POST['business_services'];
$business = $_POST['business'];

//echo $_POST['if_message']; die('========');           

if ($business_services == 'business_services') {
	


	$emails = explode(';', $email);
	//print_r($emails);

	$totalCount = count($emails);
	$i = 0;
	while ($i < $totalCount) {
		//echo $emails[$i];

		$e = new _email;

		$e->share_weblink_email($emails[$i], $_POST['if_message'], $subject);
		$i++;
	}



	

	
	


	$re = new _redirect;
	$redirctUrl = $BaseUrl . "/business-directory-services/details.php?business=" . $business;
	$re->redirect($redirctUrl);
} else {

	

	$emails = explode(';', $email);
	//print_r($emails);

	$totalCount = count($emails);
	$i = 0;
	while ($i < $totalCount) {
		//echo $emails[$i];
		$e = new _email;

		$e->send_invite_email($emails[$i], $_POST['if_message'], $subject);
		$i++;
	}
	///die('======');


	//$api_key = "key-2664c40f3b1c2991fb51e72fa4ecd13a"; /* Api Key got from https://mailgun.com/cp/my_account */
	/*$domain = "dev.thesharepage.com";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($ch, CURLOPT_USERPWD, 'api:' . $api_key);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v2/' . $domain . '/messages');
	curl_setopt($ch, CURLOPT_POSTFIELDS, array(
		//'X-Mailgun-Recipient-Variables' => $myJSON,
		'from' => 'TheSharePage <info@thesharepage.com>',
		'to' =>  $emails, //'adnan@jouple.com'
		'subject' => "Invite To Join TheSharePage",
		'html' => $_POST['if_message'],
		'o:tracking-clicks' => TRUE
	));
	$result = curl_exec($ch);
	curl_close($ch);*/





	$re = new _redirect;
	$redirctUrl = $BaseUrl . "/dashboard/settings/";
	$re->redirect($redirctUrl);
}
