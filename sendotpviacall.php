<?php
$mno = $_REQUEST['mno'];

$size = 6;
$alpha_key = '';
$keys = range('A', 'Z');
for ($i = 0; $i < 2; $i++) {
    $alpha_key .= $keys[array_rand($keys)];
}
$length = $size - 2;
$key    = '';
$keys   = range(0, 9);
for ($i = 0; $i < $length; $i++) {
    $key .= $keys[array_rand($keys)];
}
$randCode = $alpha_key . $key;

require_once 'twilio-php-main/src/Twilio/autoload.php';

$sid = "AC133edde2cd4eb04a187b23785b9acf65";
$token = "c34c43a63c60436330b906ebf35a75c7";
$twilio = new Twilio\Rest\Client($sid, $token);

$call = $twilio->calls
               ->create($mno, // to
                        "+16042002975", // from
                        [
                            "twiml" => "<Response><Say>Verification code for The Sharepage Registration is:".$randCode."</Say></Response>"
                        ]
               );
if($call)
{
  echo '1';
}
else
{
  echo '0';
}
               
// print($call->sid);

?>