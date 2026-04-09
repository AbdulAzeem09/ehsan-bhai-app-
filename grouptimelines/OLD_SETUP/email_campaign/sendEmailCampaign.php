<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/

session_start();
require_once("../../univ/main.php");
include('../../univ/baseurl.php');  
include('../../mlayer/SmsEmailCampaign.php');
include('../../mlayer/_data.class.php');

function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");
//print_r($_POST);
if(isset($_POST['name'])){
$conn = _data::getConnection();

function getLastCampgainId($conn){
$sql2 = "SELECT * FROM sms_email_campaigns ORDER BY id DESC LIMIT 1";
$result2 = mysqli_query($conn, $sql2);
if(mysqli_num_rows($result2) >0){
$row2 = mysqli_fetch_assoc($result2);
return $row2['id'];
}
}
$em = new _email;
/*        if ($_POST['name'] == "") {
return "Name required";
}
if ($_POST['date'] == "") {
return "Date required";
}
if ($_POST['time'] == "") {
return "Time required";
}
if ($_POST['text'] == "") {
return "Message required";
}
*/

/*          if ($_POST['name'] == "") {
return "Name required";
}

if ($_POST['time'] == "") {
return "Time required";
}
if ($_POST['text'] == "") {
return "Message required";
}
*/

/*
* Creating new campaign.
*
* */
if(!empty($_POST['name'])){
$name = $_POST['name'];
$type = $_POST['type'];
$text = $_POST['text'];
/*$date = $_POST['date'];*/
/*$time = $_POST['time'];*/
$user_id = $_SESSION['uid'];
$user_or_group = $_POST['user_or_group'];
$status = 'Ok';
$created_at_date = date('Y-m-d');
$time =  date("h:i:s");

$sql = "INSERT INTO sms_email_campaigns (type, name, text, date, time, user_id, status, user_or_group, created_at, updated_at) VALUES('$type', '$name', '$text', '$created_at_date', '$time', '$user_id', '$status', '$user_or_group', '$created_at_date', '$created_at_date')";
//echo $sql;
$result = mysqli_query($conn, $sql);
}
if( $user_or_group == 'user' ){ 
$userIds = $_POST['Ids'];
$ids = rtrim($userIds, ',');
$users = explode(',', $ids);


/*print_r($users);*/


foreach ($users as $value) { 
$user_id = $value;


$prosql ="SELECT * FROM `spprofiles` WHERE idspProfiles ='$user_id'";
 
 //echo $prosql; die('========'); 

$resultpro = mysqli_query($conn, $prosql);
$rowpro = mysqli_fetch_assoc($resultpro);


$proemail = $rowpro['spProfileEmail'];  



$proname = $rowpro['spProfileName']; 
//echo $BaseUrl;die('====2');

$msg = '
<!DOCTYPE html>
<html>
<head>
<title>The SharePage</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<style type="text/css">
.mmaintab{
background: #FFF;
margin: 0 auto;
padding: 15px;
width: 640px;
}
.logo h1{
color: #000;
margin: 20px 0px 25px;

}
.logo a{
width: 80px;
}
.letstart{
background: #2F6230;
padding: 15px;
font-size: 20px;
color: #FFF;
margin: 15px 0px;
text-align: center;
}
.letstart h1{
font-size: 20px;
margin: 0px;
}
.btn{
background: #2F6230;
color: #FFF;
padding: 8px 15px;
display: inline-block;
margin-bottom: 15px;
text-decoration: none;
margin-top: 15px;
}
.foot{
border-top: 1px solid;
text-align: center;

}
.foot p{
margin: 0px;
color: #808080;
padding: 10px
}
.no-margin{
margin: 0px;
}
h3{
margin: 0px;
font-size: 18px;
}                   
</style>
</head>
<body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
<table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td align="center" class="logo" >
<a href="'.$BaseUrl.'"><img src="'.$BaseUrl.'/upload/banner/02c21a6824d8aad82b8019248292be9f.png" alt="The SharePage" style="width: 190px;margin-left: 100px;"></a> 
<h1>The SharePage</h1> 
</td>
</tr>

<tr>
<td class="letstart" >
<h1>Email Campaign</h1>
</td>
</tr>
<tr>
<td>
<p>Dear '.$proname.',</p>

<p>'.$text.'</p>



</td>
</tr>
<tr>
<td  align="center" class="foot">
<p style="margin-bottom: 0px;">This is an automated message to confirm the receipt of your query, we will get back to you as soon as possible.</p>
</td>
</tr>
</tbody>

</table>
<div style="width: 640px;text-align: center;margin: 0 auto">
<p style="margin-bottom: 10px;">© Copyright 2023 The SharePage. All rights reserved.</p>

<div >
<a href="'.$BaseUrl.'/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="'.$BaseUrl.'/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
</div>
</div>

</body>
</html>

';
// SEND THIS COPY OF MESSAGE TO USER
$em = new _email;
$res = $em->send_all_email($proemail, $name, $msg);


/* $adminemail = "contact-us@thesharepage.com, thesharepage1@gmail.com";*/  
//$adminemail = "info@adnanjaved.com, adnanghouri97@gmail.com";
/*$em->send_all_email($adminemail, $subject, $msg);*/









$campaign_id = getLastCampgainId($conn);
$created_by = $_SESSION['uid'];
$created_at = date('Y-m-d');
$sql3 = "INSERT INTO email_campaign_user_groups( campaign_id, group_id, user_id, file_user_id, created_by, created_at, updated_at) VALUES('$campaign_id', '0', '$user_id','0', '$created_by', '$created_at', '$created_at')";

//echo  $sql3;
$result3 = mysqli_query($conn, $sql3);
}
}

/*            if( $user_or_group == 'group' ){ 
$groupIds = $_POST['Ids'];
$ids = rtrim($groupIds, ',');
$groups = explode(',', $ids);
foreach ($groups as $value) {

$campaign_id = getLastCampgainId($conn);
$group_id = $value;
$created_by = $_SESSION['uid'];
$created_at = date('Y-m-d');
$sql3 = "INSERT INTO email_campaign_user_groups( campaign_id, group_id, user_id, file_user_id, created_by, created_at, updated_at) VALUES
('$campaign_id', '$group_id', '0','0', '$created_by', '$created_at', '$created_at')";
$result3 = mysqli_query($conn, $sql3);
}
}

if( $user_or_group == 'importuser' ){
$fileuserIds = $_POST['Ids'];
$ids = rtrim($fileuserIds, ',');
$fileusers = explode(',', $ids);
foreach ($fileusers as $value) {

$campaign_id = getLastCampgainId($conn);
$file_user_id = $value;
$created_by = $_SESSION['uid'];
$created_at = date('Y-m-d');
$sql3 = "INSERT INTO email_campaign_user_groups( campaign_id, group_id, user_id, file_user_id, created_by, created_at, updated_at) VALUES
('$campaign_id', '0', '0','$file_user_id', '$created_by', '$created_at', '$created_at')";
$result3 = mysqli_query($conn, $sql3);
}
}
*/



echo "success";

}else{
$re = new _redirect;
$location = "../";
$re->redirect($location);

}



?>