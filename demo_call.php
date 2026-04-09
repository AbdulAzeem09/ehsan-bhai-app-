
<?php
// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md
require_once 'twilio-php-main/src/Twilio/autoload.php';

// use Twilio\Rest\Client;

// Find your Account SID and Auth Token at twilio.com/console
// and set the environment variables. See http://twil.io/secure
$sid = "AC133edde2cd4eb04a187b23785b9acf65";
$token = "c34c43a63c60436330b906ebf35a75c7";
$twilio = new Twilio\Rest\Client($sid, $token);

$call = $twilio->calls
               ->create("+919638927381", // to
                        "+16042002975", // from
                        [
                            "twiml" => "<Response><Say>Verification code for The Sharepage Registration is:OO1234</Say></Response>"
                        ]
               );
               
// print($call->sid);

?>