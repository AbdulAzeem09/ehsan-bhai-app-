<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
require_once '../library/config.php';
require_once '../library/functions.php';
require_once '../../common.php';

$status = !empty($_POST['status']) ? $_POST['status'] : "";
if(!$status){
    response(0,"Status Option invalid");
}
$message = !empty($_POST['message']) ? $_POST['message'] : "";
if(!$message){
    response(0,"Message invalid");
}
$requestId = !empty($_POST['requestId']) ? $_POST['requestId'] : "";
if(!$requestId){
    response(0,"Withdrawal Request Id invalid");
}
$assignedUSerId = !empty($_POST['assignedUSerId']) ? $_POST['assignedUSerId'] : "";
if(!$assignedUSerId){
    response(0, "Assigned User Id invalid");
}
$module = !empty($_POST['module']) ? $_POST['module'] : "";
if(!$module){
    response(0, "Module invalid");
}
$profileId = !empty($_POST['profileId']) ? $_POST['profileId'] : "";
if(!$profileId){
    response(0, "Profile Id invalid");
}

$sql =  "INSERT INTO tbl_withdrawalreq_status (withdrawalreq_id, message, assigned_user_id, date, profileid) VALUES ('$requestId', '$message', '$assignedUSerId', NOW(), 1)";

$result  = dbQuery($dbConn, $sql);

if(!$result){
    response(0, "Something went wrong");
}

$sql =  "UPDATE spwithdrawalreq_store SET actionStatus = '$status' WHERE id = ".$requestId;

$result  = dbQuery($dbConn, $sql);

if(!$result){
    response(0, "Something went wrong");
}

$sql =  "INSERT INTO spmessaging (spmessagingstatus, buyerProfileid, sellerProfileid, message, module, created, spPostings_idspPostings) VALUES (0, 1, '$profileId', '$message', '$module', NOW(), 1)";

$result  = dbQuery($dbConn, $sql);

if(!$result){
    response(0, "Something went wrong");
} else {
    response(1, "Success");
}

?>