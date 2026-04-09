<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

session_start();
require_once "../../common.php";

$uniqueId = isset($_GET['id']) ? $_GET['id'] : "";

if (!$uniqueId) {
    response(0, "id not found");
} else {
    $messages = selectQ("SELECT ws.message, sp.spProfileName FROM tbl_withdrawalreq_status ws INNER JOIN spprofiles sp ON ws.profileid = sp.idspProfiles WHERE ws.withdrawalreq_id = ?", "i", [$uniqueId]);
    
    if ($messages) {
        response(1, "success", $messages);
    } else {
        response(1, "success", []);
    }
}

?>

