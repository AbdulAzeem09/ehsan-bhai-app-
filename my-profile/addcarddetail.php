<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
function sp_autoloader($class){
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
require_once( "../common.php");

//print_r($_POST["spProfileType_idspProfileType"]);


$customerName = !empty($_POST['customerName']) ? $_POST['customerName'] : "";
if(!$customerName){
    die("Customer Name invalid");
}
$cardNumber = !empty($_POST['cardNumber']) ? $_POST['cardNumber'] : "";
if(!$cardNumber){
    die("Card Number invalid");
}
$cardCVC = !empty($_POST['cardCVC']) ? $_POST['cardCVC'] : "";
if(!$cardCVC){
    die("Card CVC invalid");
}
$cardExpMonth = !empty($_POST['cardExpMonth']) ? $_POST['cardExpMonth'] : "";
if(!$cardExpMonth){
    die("Card Expiry Month invalid");
}
$cardExpYear = !empty($_POST['cardExpYear']) ? $_POST['cardExpYear'] : "";
if(!$cardExpYear){
    die("Card Expiry Year invalid");
}
$uid = !empty($_POST["uid"]) ? $_POST["uid"] : "";
if(!$uid){
    die("uid is invalid");
}
$data= array(
    "customerName"=>$customerName,
    "cardExpMonth"=>$cardExpMonth,
    "cardExpYear"=>$cardExpYear,
    "cardCVC"=>$cardCVC,
);
if(strpos($cardNumber, '*') === false){
    $data['cardNumber'] = encryptMessage($cardNumber);
}
$b = new _spuser;
$id = $b->updatecarddetails($data, $uid);
//echo $b->ta->sql;
?>