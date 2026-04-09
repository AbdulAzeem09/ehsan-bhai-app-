<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
function sp_autoloader($class){
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
require_once( "../common.php");

$messsage = !empty($_POST['messsage']) ? $_POST['messsage'] : "";
if(!$messsage){
    response(0,"Message invalid");
}
$requestId = !empty($_POST['requestId']) ? $_POST['requestId'] : "";
if(!$requestId){
    response(0,"Withdrawal Request Id invalid");
}
$profileId = !empty($_POST['profileId']) ? $_POST['profileId'] : "";
if(!$profileId){
    response(0, "Profile Id invalid");
}

$data= array(
    "withdrawalreq_id"=>$requestId,
    "message"=>$messsage,
    "assigned_user_id" => 0,
    "date"=> date('Y-m-d H:i:s'),
    "profileid"=> $profileId,
);
$b = new _orderSuccess;
$id = $b->addmessage($data);
response(1, "Message sent successfully");
?>
