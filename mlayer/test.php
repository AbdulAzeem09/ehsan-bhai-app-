<?php

error_reporting(E_ALL);
	ini_set('display_errors', '1');

	include('../univ/baseurl.php');
	
	
	function sp_autoloader($class){
			include '../../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
	//twilio-php-5.13.0
	$url = __DIR__ .'/src/Twilio/autoload.php';
	
	require $url;


$sid = "AC133edde2cd4eb04a187b23785b9acf65"; // Your Account SID from www.twilio.com/console
$token = "c34c43a63c60436330b906ebf35a75c7"; // Your Auth Token from www.twilio.com/console

$client = new Twilio\Rest\Client($sid, $token);
$message = $client->messages->create(
  '+919737134341', // Text this number
  array(
    'from' => '+16042002975', // From a valid Twilio number
    'body' => 'Hello from Twilio!'
  )
);

print $message->sid;

?