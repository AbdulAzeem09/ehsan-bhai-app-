<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
require_once("../../common.php");
require_once("../../univ/baseurl.php" );

function sp_autoloader($class) {
    include '../../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");

$amount = !empty($_POST['amount']) ? $_POST['amount'] : "";
if(!$amount){
    response(0,"Amount invalid");
}
$userId = !empty($_POST['userId']) ? $_POST['userId'] : "";
if(!$userId){
    response(0,"User invalid");
}
$module = !empty($_POST['module']) ? $_POST['module'] : "";
if(!$module){
    response(0, "Module invalid");
}
$amount1 = 0;
$amount2 = 0;
$oi= new _spcustomers_basket;
$oid= $oi->readfromwallet($userId);

if($oid!=false){
    while($r=mysqli_fetch_assoc($oid)){
        $amount1+=$r['amount'];
    }
}

$w = new _orderSuccess;
$res = $w->readid($userId, $module);
if ($res != false) {
   while ($ra = mysqli_fetch_assoc($res)) {
        $amount2 += $ra['amount'];
    }
}
$amount3 = ($amount1 - $amount2);
if($amount3 < $amount){
    response(0, "You don't have enough balance in the wallet");
}

$commission = $amount * 0.07;
response(1, "withdrawal success", ["commission" => $commission, "approved_amount" => $amount - $commission]);

?>
