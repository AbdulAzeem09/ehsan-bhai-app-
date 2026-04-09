<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1'); 

include_once $_SERVER["DOCUMENT_ROOT"]."/univ/main.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/univ/baseurl.php";
include_once $_SERVER["DOCUMENT_ROOT"].'/aws/aws-autoloader.php';
require_once $_SERVER["DOCUMENT_ROOT"].'/common.php';

use Aws\Sns\SnsClient;
use Aws\Exception\AwsException;


#$out = callSmsApi("+8801639894304", "test sms");
#var_dump($out);

/**
 * To send SMS using Amazon SNS services
 *
 * @param String - $phone - Phone number of the user
 * @param String - $text - Message to be sent  
 *
 * @return Json -  Status, Response
 */
function callSmsApiOld1($phone, $text){
    global $sns_key, $sns_secret;
  
    /** Create SNS Client By Passing Credentials */
    $SnSclient = new SnsClient([
        'region' => 'us-west-1',
        'version' => 'latest',
        'credentials' => [
            'key'    => $sns_key,
            'secret' => $sns_secret,
        ],
    ]);

    try {
        /** Few setting that you should not forget */
        $result = $SnSclient->publish([
            'MessageAttributes' => array(
                /** Pass the SENDERID here */
                'AWS.SNS.SMS.SenderID' => array(
                    'DataType' => 'String',
                    'StringValue' => 'StackCoder'
                ),
                /** What kind of SMS you would like to deliver */
                'AWS.SNS.SMS.SMSType' => array(
                    'DataType' => 'String',
                    'StringValue' => 'Transactional'
                )
            ),
            /** Message and phone number you would like to deliver */
            'Message' => $text,
            'PhoneNumber' => $phone,
        ]);
        
        /** Dump the output for debugging */
       // header("Location: $BaseUrl/registration-steps.php?pageid=4");
    } catch (AwsException $e) {
        // output error message if fails
        return $e->getMessage();
    }

  return "";

}

/**
 * To send SMS using ClickSend services
 *
 * @param String - $phone - Phone number of the user
 * @param String - $text - Message to be sent  
 *
 * @return Json -  Status, Response
 */
function callSmsApi($phone, $text){
  $message = [
    'messages' => [
      [
        'source' => 'php',
        'body' => $text,
        'to' => $phone
      ]
    ]
  ];
  $jsonMessage = json_encode($message);
  $url = 'https://rest.clicksend.com/v3/sms/send';
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonMessage);
  curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Basic ' . base64_encode(click_send_username.":".click_send_api_key)
  ]);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($ch);
  $error = 0;
  $apiResponse = "";
  if ($response === false) {
    $apiResponse = curl_error($ch);
    $error = 1;
  } else {
    $responseData = json_decode($response, true);
    if($responseData['http_code'] != 200){
      $error = 1;
      $apiResponse = $responseData['response_msg'];
    }
  }
  curl_close($ch);
  insertQ("insert into sms_api_log (user_id, phone, response, error, created_date) values (?, ?, ?, ?, ?)", "issis", [$_SESSION['uid'], $phone, $apiResponse, $error, date('Y-m-d H:i:s')]);
  return $apiResponse;
}
  
/**
 * To send SMS
 *
 * @param String - $phone - Phone number of the user
 * @param String - $text - Message to be sent  
 *
 * @return Json -  Status, Response
 */
function callSmsApiOld($phone, $text){
  
  $client = new Twilio\Rest\Client(Twilio_SID, Twilio_TOKEN);
  try{
    $client->messages->create($phone, [
        'from' => Twilio_NUMBER, // From a valid Twilio number
        'body' => $text
      ]
    );
  }
  catch(Exception $e){
    return $e->getMessage();
  }

  return "";
  
}
