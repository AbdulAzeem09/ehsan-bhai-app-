<?php

//require($_SERVER["DOCUMENT_ROOT"]
//. '/smtp17aug/smtp/PHPMailerAutoload.php');

/*error_reporting(E_ALL);
ini_set('display_errors', '1');  
*/
//include '../univ/baseurl.php';

require_once $_SERVER["DOCUMENT_ROOT"].'/mlayer/_email.class.php';


function checkUser(){
// if the session id is not set, redirect to login page
if (!isset($_SESSION['userId'])) {
redirect( WEB_ROOT_ADMIN . 'login.php');
exit;
}
// the user want to logout
if (isset($_GET['logout'])) {
doLogout();
}
}
//User Login Function
function doLogin($dbConn){

// if we found an error save the error message in this variable
$errorMessage = '';
$userName = mysqli_real_escape_string($dbConn, $_POST['txtUserName']);
if(isset($_POST['phone_verify']))
$password = $_POST['txtPassword'];
else
$password = mysqli_real_escape_string($dbConn, md5($_POST['txtPassword']));
// first, make sure the username & password are not empty
if ($userName == '') {
$errorMessage = 'You must enter your username';
} else if ($password == '') {
$errorMessage = 'You must enter the password';
} else {
// check the database and see if the username and password combo do match
$sql = "SELECT * FROM tbl_user WHERE  user_name = '$userName' AND user_password = '$password' AND user_status = 1 ";
$result = dbQuery($dbConn, $sql);
if (dbNumRows($result) == 1) {
$row = dbFetchAssoc($result);
if(!isset($_POST['phone_verify']))
{
$uid = ($row['user_id']);
////////////////////////////////////////
$size = 6;
$alpha_key = '';
$keys = range('A', 'Z');
for ($i = 0; $i < 2; $i++) {
$alpha_key .= $keys[array_rand($keys)];
}
$length = $size - 2;
$key = '';
$keys = range(0, 9);
for ($i = 0; $i < $length; $i++) {
$key .= $keys[array_rand($keys)];
}
//die('aaaaaaaaaa');
$randCode = $alpha_key . $key;
$sql_up="update tbl_user set phone_code = '$randCode' where user_id = ".$row['user_id'];
dbQuery($dbConn, $sql_up);
$message = urlencode($randCode)." Here is your code to login to Back Admin. Do not share it with anyone.";
$mobile = $row['user_mob'];
$user_email = $row['user_email'];    
$user_name = $row['user_name'];
//echo $message;die("=====");
function sp_autoloader($class){
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$pc = new _email;
//$user_email="shubham18822@gmail.com";
$res = $pc->send_backofadmin_mail($user_email,$message,$user_name);






//print_r($row); die('-----------');

// $user_email = 'shubham18822@gmail.com';
/*
$email_to = $user_email;
$subj = "OTP Verification";
$message = $message;


$email_test = array();

$emails = $email_to;
if (isset($subj) && $subj != '') {
$subject = $subj;
}else{
$subject = "The SharePage";
} 

$txt = $message;        

$api_key = "ae6e0fc1f1fcf9db61dfc51f1d4831a8-9c988ee3-65f27b72";  
$domain = "dev.thesharepage.com";
$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, 'api:' . $api_key);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v2/' . $domain . '/messages');
curl_setopt($ch, CURLOPT_POSTFIELDS, array(
//'X-Mailgun-Recipient-Variables' => $myJSON,
'from'      => 'The SharePage <info@thesharepage.com>',
'to'        => $emails, 
'subject'   => $subject,
'html'      => $txt,
'o:tracking-clicks' => FALSE
));
$result = curl_exec($ch);
curl_close($ch);
*/



// send_any_sms($mobile, $message);
////////////////////////////////////////////////////////////////////
redirect('../../backendloginverification.php?uid='.$uid);

die();

}

// print_r($row);die('<========');

if($row['phone_code'] == $_POST['verifycode'])
{
$_SESSION['userId'] 	= 	$row['user_id'];
$_SESSION['username'] 	= 	$row['user_name']; 

if($row['account_name'] != ''){
$_SESSION['accountName'] =  $row['account_name'];
}else{
$_SESSION['accountName'] =  $row['user_name'];
}
$_SESSION['phoneNo'] 	= 	$row['user_mob'];
$_SESSION['userlevel'] 	= 	$row['user_level'];
$_SESSION['userImg']	=	$row['user_img'];
$ses = $row['user_id']; //tell freichat the userid of the current user
setcookie("freichat_user", "LOGGED_IN", time()+3600, "/"); // *do not change -> freichat code


// log the time when the user last login
if(isset($_SESSION['userId'])>0){
$sql2 = "UPDATE tbl_user SET user_last_login = NOW() WHERE user_id = ". $row['user_id'];
dbQuery($dbConn, $sql2);

redirect("http://" . $_SERVER['HTTP_HOST'].'/backofadmin/index.php');



}
//  echo $_POST['verifycode'];
// exit;
}else{
$uid = ($row['user_id']);
redirect('../../backendloginverification.php?uid='.$uid);
}
}else {
$errorMessage = 'Invalid username or password.';
$ses = null; //tell freichat that the current user is a guest
setcookie("freichat_user", null, time()+3600, "/"); // *do not change -> freichat code
}
}
return $errorMessage;
}
/* Set User Permissions*/
function checkUserPermission() {
/* for Super Admin. He can only  view the record*/
if ($_SESSION['branchId'] == 0) {
$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
if ($view == 'add' || $view == 'modify' || $view == 'modifyParent' || $view == 'addParent'  || $view == 'modify') {
redirect('index.php?error=forbidden');	
exit();
}  //end permission if
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
if ($action == 'delete') {	
redirect('index.php?error=forbidden');
exit();
}
}
}


/* My Own Function */

//SHOW ALL USERS
function showAllUsers($dbConn, $userId){
$sql = "SELECT * FROM tbl_user WHERE user_id != $userId ";
$result = dbQuery($dbConn, $sql);
if(dbNumRows($result) >0 ){
while($row = dbFetchAssoc($result)) {
// build combo box options
echo $list = "<option value='" . $row['user_id'] ."'" .">" . ucfirst(strtolower($row['user_name'])) ."</option>\r\n";

} //end while
}
}
// SHOW USER IMAGE
function printUserImage($dbConn, $userId){
$sql = "SELECT * FROM tbl_user WHERE user_id = $userId ";
$result = dbQuery($dbConn, $sql);
if(dbNumRows($result) >0 ){
$row = dbFetchAssoc($result);
// build combo box options
if ($row['user_img'] != '') {
echo "<img src='" .  WEB_ROOT . "/upload/user/".$row['user_img']."' alt='Active' width='40' height='40' />";	
} else {
echo "<img src='" .  WEB_ROOT . "/upload/blank.png' alt='Inactive'  width='40' height='40' />";	
}
}
}
//SHOW USER NAME ADMIN
function showUserName($dbConn, $userid){
$sql = "SELECT user_name FROM tbl_user WHERE user_id = '$userid'";
$result = dbQuery($dbConn, $sql);
$row = dbFetchAssoc($result);
echo ucwords($row['user_name']);
}
// SHOW USER IMAGE ADMIN
function getUserComentImg($dbConn, $userid){
$sql = "SELECT user_img FROM tbl_user WHERE user_id = '$userid'";
$result = dbQuery($dbConn, $sql);
$row = dbFetchAssoc($result);
return $row['user_img'];
}
// SHOW PROFILE NAME
function showProfileName($dbConn, $pid){
$sql = "SELECT spProfileName FROM spprofiles WHERE idspProfiles = '$pid'";
//echo $sql;
$result = dbQuery($dbConn, $sql);
//print_r($result->num_rows);
//	die('----------');
if($result->num_rows == 1){
$row = dbFetchAssoc($result);
echo ucwords(@$row['spProfileName']);
}
else {
echo "Profile Deleted";
}
}
// SHOW ACCOUNT NAME(USER NAME) THROUGH PROFILE ID
function showAcountNameProfile($dbConn, $pid){
$sql = "SELECT spUserName FROM spuser AS t INNER JOIN spprofiles as P ON t.idspUser = P.spUser_idspUser WHERE  P.idspProfiles = $pid";
$result = dbQuery($dbConn, $sql);
if ($result) {
$row = dbFetchAssoc($result);
echo ucwords(@$row['spUserName']);
}
}
//SHOW REGISTERD USER NAME 
function showspUserName($dbConn, $spUserId){
$sql = "SELECT spUserName FROM spuser WHERE idspUser = '$spUserId'";
$result = dbQuery($dbConn, $sql);
$row = dbFetchAssoc($result);
echo ucwords($row['spUserName']);
}
// SHOW CATEGORY NAME
function showCategoryName($dbConn, $catId){
$sql = "SELECT * FROM spcategories WHERE idspCategory = $catId";
$result = dbQuery($dbConn, $sql);
if ($result) {
$row = dbFetchAssoc($result);
echo $row['spCategoryName'];
}
}
function showCategoryForm($dbConn, $catId){
$sql = "SELECT * FROM subcategory WHERE idsubCategory = $catId";
$result = dbQuery($dbConn, $sql);
if ($result) {
$row = dbFetchAssoc($result);
echo $row['subCategoryTitle'];
}
}


function check_permission($roleid,$permissionid,$dbConn){
$sql = "SELECT * FROM role_permission WHERE role_id = $roleid and permission_id = $permissionid";
//echo $sql;

$result = dbQuery($dbConn, $sql);
$row = dbFetchAssoc($result);
if ($row) {

return 1;
}
else {

return 0;
}
}



// CHEK WHICH MODULE IS NOW ACTIVE
function chekActiveModule($actual_link){
if ($actual_link == 'mytask') {
return 2;
}else if($actual_link == 'notes'){
return 2;
}else if($actual_link == 'waitingTask'){
return 2;
}else if($actual_link == 'crossTask'){
return 2;
}else if($actual_link == 'cmpTask'){
return 2;
}else if($actual_link == 'profileType'){
return 3;
}else if($actual_link == ''){
return 1;
}else if($actual_link == 'mainCategory'){
return 4;
}else if($actual_link == 'allcategory'){
return 4;
}else if($actual_link == 'in_sub_category'){
return 4;
}else if($actual_link == 'classificat'){
return 4;
}else if($actual_link == 'registerdUser'){
return 5;
}else if($actual_link == 'allprofiles'){
return 6;
}else if($actual_link == 'webmodule'){
return 7;
}else if($actual_link == 'postdash'){
return 8;
}else if($actual_link == 'store'){
return 8;
}else if($actual_link == 'freelance'){
return 8;
}else if($actual_link == 'jobboard'){
return 8;
}else if($actual_link == 'realestate'){
return 8;
}else if($actual_link == 'events'){
return 8;
}else if($actual_link == 'artgallery'){
return 8;
}else if($actual_link == 'music'){
return 8;
}else if($actual_link == 'video'){
return 8;
}else if($actual_link == 'trainings'){
return 8;
}else if($actual_link == 'clasifiedadds'){
return 8;
}else if($actual_link == 'industry_type'){
return 9;
}else if($actual_link == 'product_status'){
return 9;
}else if($actual_link == 'shipping_destination'){
return 9;
}else if($actual_link == 'free_pro_type'){
return 9;
}else if($actual_link == 'job_level'){
return 9;
}else if($actual_link == 'property_type'){
return 9;
}else if($actual_link == 'pro_status'){
return 9;
}else if($actual_link == 'art_sold_by'){
return 9;
}else if($actual_link == 'frame_type'){
return 9;
}else if($actual_link == 'music_language'){
return 9;
}else if($actual_link == 'users'){
return 10;
}else if($actual_link == 'topseller'){
return 11;
}else if($actual_link == 'totalPost'){
return 12;
}else if($actual_link == 'artsizes'){
return 13;
}else if($actual_link == 'artcategory'){
return 14;
}else if($actual_link == 'evencategory'){
return 15;
}else if($actual_link == 'eventgroups'){
return 12;
}else if($actual_link == 'musiccategory'){
return 16;
}else if($actual_link == 'projecttype'){
return 17;
}else if($actual_link == 'sponsor'){
return 18;
}else if($actual_link == 'country' || $actual_link == 'state' || $actual_link == 'city'){
return 19;
}else if($actual_link == 'cmpnynews'){
return 20;
}else if($actual_link == 'groups'){
return 21;
}else if($actual_link == 'flag'){
return 22;
}else if($actual_link == 'membership'){
return 23;
}else if($actual_link == 'membership_enquiry'){
return 24;
}else if($actual_link == 'content'){
$actual_link = $_SERVER['REQUEST_URI'];
$parts = explode('/',$actual_link);
$in_link = $parts[2];
if ($in_link == "footleft") {
return 25;
}else if($in_link == "email_market" || $in_link == "sms_market" || $in_link == "feature"){
return 31;
}else if($in_link == "posting"){
return 32;
}else if($in_link == "profile"){
return 33;
}else if($in_link == "hire_employe" || $in_link == "loking_job"){
return 34;
}else if($in_link == "page"){
return 35;
}
}else if($actual_link == 'foothead'){
return 26;
}else if($actual_link == 'page'){
$actual_link = $_SERVER['REQUEST_URI'];
$parts = explode('/',$actual_link);
$in_link = $parts[2];
if ($in_link == "footer") {
return 27;
}
}else if($actual_link == 'contacttopic'){
return 28;
}else if($actual_link == 'contact'){
return 29;
}else if($actual_link == 'social'){
return 30;
}else if($actual_link == 'emailuser'){
return 36;
}else if($actual_link == 'setting'){
return 37;
}else if($actual_link == 'point'){
return 38;
}else if($actual_link == 'dollar'){
return 38;
}else if($actual_link == 'pointtype'){
return 38;
}else if($actual_link == 'admcommission'){
return 39;
}else{
return 0;
}


}
// TOTAL PROFILE OF EACH USERS
function totalUserProfile($dbConn, $idspUser){
$sql = "SELECT * FROM spprofiles WHERE spUser_idspUser = $idspUser";
$result = dbQuery($dbConn, $sql);
if(dbNumRows($result) > 0){
echo dbNumRows($result);
}else{
echo 0;
}
}
// TOTAL COUNT OF PRODUCT
function totalMyStoreProduct($dbConn,$catId, $pid){
$sql = "SELECT * FROM sppostings WHERE spCategories_idspCategory = $catId AND spProfiles_idspProfiles = $pid ORDER BY idspPostings DESC";
$result = dbQuery($dbConn, $sql);
if(dbNumRows($result) > 0){
echo dbNumRows($result);
}else{
echo 0;
}
}

// TOTAL COUNT OF PRODUCT (Shani Yadav)
function totalMyProduct($dbConn, $table, $pid){
$sql = "SELECT * FROM $table WHERE spProfiles_idspProfiles = $pid";
$result = dbQuery($dbConn, $sql);
if(dbNumRows($result) > 0){
echo dbNumRows($result);
}else{
echo 0;
}
}
// TOTAL COUNT OF PRODUCT
function totalPostProduct($dbConn,$catId){
$sql = "SELECT * FROM sppostings WHERE spCategories_idspCategory = $catId";
$result = dbQuery($dbConn, $sql);
if(dbNumRows($result) > 0){
echo dbNumRows($result);
}else{
echo 0;
}
}
// total friends show on the profile wisse
function totalProfileFriends($dbConn, $pid){
$totalFrnd = array();
// AS A SENDER CHEK PROFILES
$sql = "SELECT * FROM spprofiles_has_spprofiles AS t where spprofiles_idspprofilesender = $pid AND spprofiles_has_spprofileflag = 1";
$result = dbQuery($dbConn, $sql);
if ($result) {
while ($row = dbFetchAssoc($result)) {
array_push($totalFrnd, $row['spProfiles_idspProfilesReceiver']);
}
}
// AS A RECEIVER CHEK PROFILES
$sql2 = "SELECT * FROM spprofiles_has_spprofiles AS t where spprofiles_idspprofilesreceiver = '$pid' AND spprofiles_has_spprofileflag = 1";
$result2 = dbQuery($dbConn, $sql2);
if ($result2) {
while ($row2 = dbFetchAssoc($result2)) {
array_push($totalFrnd, $row2['spProfiles_idspProfileSender']);
}
}

//print_r($totalFrnd);
if(!empty($totalFrnd)){
echo count($totalFrnd);
}else{
echo 0;
}
}
// TOTAL GROUPS SHOW ON THE SINGLE PROFILE
function totalProfileGroups($dbConn, $pid){
$sql = "SELECT DISTINCT idspGroup, spGroupName,spgroupflag FROM spgroup AS t inner join spprofiles_has_spgroup as d on t.idspgroup = d.spgroup_idspgroup inner join spprofiles as p on d.spprofiles_idspprofiles = p.idspprofiles where t.idspgroup in (select spgroup_idspgroup from spprofiles_has_spgroup where spprofiles_idspprofiles in (select idspprofiles from spprofiles where idspProfiles = $pid ))";
$result = dbQuery($dbConn, $sql);

$private_count = 0;
$public_count = 0;
if(dbNumRows($result) > 0){
while ($row = mysqli_fetch_assoc($result)) {
if($row['spgroupflag'] == 1){
$private_count++;
}else{
$public_count++;
}
}

}else{
$private_count = 0;
$public_count = 0;
}

echo '<span class="info-box-number">'.$private_count.' <small>Private Groups</small></span>';
echo '<span class="info-box-number">'.$public_count.' <small>Public Groups</small></span>';
}
// SHOW ALL CATEGORY ON THE ALL CATEGORY MODULE
function allcategory($dbConn) {
$sql = "SELECT * FROM spcategories WHERE spCategoryStatus = 1";
$result = dbQuery($dbConn, $sql);
while($row = dbFetchAssoc($result)) {
// build combo box options
echo  "<option value='".$row['idspCategory']."' >" . ucwords($row['spCategoryName']) . "</option>\r\n";
} //end while	

}
// SHOW ALL CATEGORY FROM THE FORM
function allcategoryform($dbConn, $catid){
$sql = "SELECT * FROM subcategory WHERE spCategories_idspCategory = $catid";
$result = dbQuery($dbConn, $sql);
if ($result) {
while ($row = dbFetchAssoc($result)) {
echo  "<option value='".$row['idsubCategory']."' >" . ucwords(strtolower($row['subCategoryTitle'])) . "</option>\r\n";
}
}
}
// show the post title name
function showPostTitle($dbConn, $postid){
$sql = "SELECT * FROM sppostings WHERE idspPostings = $postid";
$result = dbQuery($dbConn, $sql);
if ($result) {
$row = dbFetchAssoc($result);
echo $row['spPostingTitle'];
}
}
// total flaged user
function totalFlagPost($dbConn, $pid){
$sql = "SELECT * FROM flagpost AS f INNER JOIN sppostings AS p ON f.spPosting_idspPosting = p.idspPostings  WHERE p.spProfiles_idspProfiles = $pid GROUP BY p.idspPostings";
$result = dbQuery($dbConn, $sql);
if ($result) {
echo dbNumRows($result);
}
}
// REETURN THE TOTAL MEMBERS OF GROUP
function showgroupmember($dbConn, $idspGroup){
$sql = "select COUNT(*) AS count FROM spgroup AS t inner join spprofiles_has_spgroup as d on t.idspgroup = d.spgroup_idspgroup inner join spprofiles as p on d.spprofiles_idspprofiles = p.idspprofiles where t.idspgroup = $idspGroup and (d.spapproveregect is null or d.spapproveregect = 1) order by d.spprofileisadmin";
$result = dbQuery($dbConn, $sql);
if ($result) {
$row = mysqli_fetch_assoc($result);
return $row['count'];
}else{
return 0;
}
}








//===================================
//SHOW DASHBOARD TOTAL DETAIL START==
//===================================
function showonlyrow($dbConn, $sql){
$result = dbQuery($dbConn, $sql);
if(dbNumRows($result) > 0){
echo dbNumRows($result);
}else{
echo 0;
}
}
//COUNT THE TOTAL NUMBER OF REGISTERED USERS
function totalRegUser($dbConn) {
$sql = "SELECT * FROM spuser spuser WHERE spUserLock != 1";	
showonlyrow($dbConn, $sql);	
}	
//COUNT THE TOTAL NUMBER OF REGISTERED USERS	
function totalBlockedUsers($dbConn) {	
$sql = "SELECT * FROM spuser WHERE spUserLock = 1";
showonlyrow($dbConn, $sql);
}
// TOTAL EMAIL VERIFIED USERS
function totalEmailVerified($dbConn){
$sql = "SELECT * FROM spuser WHERE is_email_verify = 1";
showonlyrow($dbConn, $sql);
}
// TOTAL PHONE VERIFIED USERS
function totalPhoneVerified($dbConn){
$sql = "SELECT * FROM spuser WHERE is_phone_verify = 1";
showonlyrow($dbConn, $sql);
}
// TOTAL PROFILE TYPE
function totprofiletype($dbConn){
$sql = "SELECT * FROM spprofiletype";
showonlyrow($dbConn, $sql);
}
//SHOW OFF-SET PRINTING TOTAL COUNT
function totalAdminUser($dbConn){
$sql = "SELECT * FROM tbl_user";
$result = dbQuery($dbConn, $sql);
if(dbNumRows($result) > 0){
echo dbNumRows($result);
}else{
echo 0;
}
}
// TOTAL MODULES
function totalmodule($dbConn) {
$sql = "SELECT * FROM spcategories WHERE spCategoryStatus = 1";
showonlyrow($dbConn, $sql);
}
// TOTAL SPONSORS
function totsponsor($dbConn) {
$sql = "SELECT * FROM sponsor ";
showonlyrow($dbConn, $sql);
}
// PRINT COUNTRY NAME
function CountryName($dbConn, $countryId){
$sql = "SELECT * FROM tbl_country WHERE country_id = $countryId";
$result = dbQuery($dbConn, $sql);
if(dbNumRows($result) >  0){
$row = dbFetchAssoc($result);
echo $row['country_title'];
}else{
echo "Not Define";
}
}
// SHOW ALL COUNTRY NAME
function showCountry($dbConn){
$sql = "SELECT * FROM tbl_country ORDER BY country_title";
$result = dbQuery($dbConn, $sql);
if(dbNumRows($result) >0 ){
while($row = dbFetchAssoc($result)) {
// build combo box options
echo $list = "<option value='" . $row['country_id'] ."'" .">" . strtoupper($row['country_title']) ."</option>\r\n";

} //end while
}
}
// PRINT STATE NAME
function StateName($dbConn, $stateId){
$sql = "SELECT * FROM tbl_state WHERE state_id = $stateId";
$result = dbQuery($dbConn, $sql);
if(dbNumRows($result) > 0){
$row = dbFetchAssoc($result);
echo $row['state_title'];
}
}
// PRINT CITY NAME
function CityName($dbConn, $cityId){
$sql = "SELECT * FROM tbl_city WHERE city_id = $cityId";
$result = dbQuery($dbConn, $sql);
if($result){
$row = dbFetchAssoc($result);
echo $row['city_title'];
}
}
// PRINT PROFILE TYPE NAME
function ProfileType($dbConn, $ptid){
$sql = "SELECT * FROM spprofiletype WHERE idspProfileType = $ptid";
$result = dbQuery($dbConn, $sql);
if($result){
$row = dbFetchAssoc($result);
echo $row['spProfileTypeName'];
}
}
// TOTAL REGISTERED PROFIELS
function totalProfiles($dbConn){
$sql = "select COUNT(*) AS count FROM spprofiles";
$result = dbQuery($dbConn, $sql);
if(dbNumRows($result) > 0){
$row = mysqli_fetch_assoc($result);
echo $row['count'];
}else{
echo 0;
}
}
// TOTAL POSTS
function totalPosts($dbConn){
$sql = "SELECT * FROM sppostings";
showonlyrow($dbConn, $sql);
}
// LATEST UNREAD TASKS
function latestUnreadTask($dbConn , $userId){
$sql = "SELECT * FROM tbl_notes WHERE user_id_to = $userId AND spNotesRead = 0 ";
$result = dbQuery($dbConn, $sql);
if(dbNumRows($result) > 0){
echo 'New (<small>'.dbNumRows($result).'</small>)';
}else{
echo 0;
}
}
// TOTAL PRODUCT POSTS
function totalpost($dbConn){
$sql = "select COUNT(*) AS count sppostings WHERE spPostingVisibility != -3";
$result = dbQuery($dbConn, $sql);
if ($result) {
$row = mysqli_fetch_assoc($result);
return $row['count'];
}else{
return 0;
}
}
// TOTAL ACTIVE POST
function totalActivePost($dbConn, $vis){
$sql = "select COUNT(*) AS count FROM sppostings WHERE spPostingVisibility = $vis AND spPostingExpDt >= CURDATE()";
$result = dbQuery($dbConn, $sql);
if ($result) {
$row = mysqli_fetch_assoc($result);
return $row['count'];
}else{
return 0;
}
}
// TOTAL IN-ACTIVE POST
function  totalinctivePost($dbConn, $vis){
$sql = "select COUNT(*) AS count FROM sppostings WHERE spPostingVisibility = $vis AND spPostingExpDt <= CURDATE()";
$result = dbQuery($dbConn, $sql);
if ($result) {
$row = mysqli_fetch_assoc($result);
return $row['count'];
}else{
return 0;
}
}
// TOTAL DRAFT POST
function totaldraftPost($dbConn, $vis){
$sql = "select COUNT(*) AS count FROM sppostings WHERE spPostingVisibility = $vis";
$result = dbQuery($dbConn, $sql);
if ($result) {
$row = mysqli_fetch_assoc($result);
return $row['count'];
}else{
return 0;
}
}
// ===IMPORTANT FOR MULTIPLE DESIGN
// TOTA WITHOUT STATUS
function totdashcount($dbConn, $tbl){
$sql = "select COUNT(*) AS count FROM ".$tbl."  ";
$result = dbQuery($dbConn, $sql);
if ($result) {
$row = mysqli_fetch_assoc($result);
return $row['count'];
}else{
return 0;
}
}
// TOTAL CALCULATION OF TABLE
function totalalltable($dbConn, $tbl, $status){
$sql = "select COUNT(*) AS count FROM ".$tbl." WHERE $status != '-7' ";
$result = dbQuery($dbConn, $sql);
if ($result) {
$row = mysqli_fetch_assoc($result);
return $row['count'];
}else{
return 0;
}
}
// TOTAL POSTING CALCULATION
function totdashpost($dbConn, $tbl, $catid){
$sql ="select COUNT(*) AS count FROM ".$tbl." WHERE spCategories_idspCategory = $catid";
$result  = dbQuery($dbConn, $sql);
if ($result) {
$row = mysqli_fetch_assoc($result);
return $row['count'];
}else{
return 0;
}
}
// TOTAL FOR MODULE CATEGORY
function totdashcat($dbConn, $tbl, $catid, $status){
$sql = "select COUNT(*) AS count FROM ".$tbl." WHERE spCategories_idspCategory = $catid AND $status != '-7' ";
$result = dbQuery($dbConn, $sql);
if ($result) {
$row = mysqli_fetch_assoc($result);
return $row['count'];
}else{
return 0;
}
}
// TOTAL ACTIVE POST
function active_post($dbConn){
$sql = "select COUNT(*) AS count FROM sppostings AS s INNER JOIN spprofiles AS p ON s.spProfiles_idspProfiles = p.idspProfiles WHERE spPostingVisibility = -1 ORDER BY idspPostings DESC ";
$result = dbQuery($dbConn, $sql);
if ($result) {
$row = mysqli_fetch_assoc($result);
return $row['count'];
}else{
return 0;
}
}

function total_sale_commission($dbConn){
$sql = "SELECT spadmin_commission FROM tbl_usercommisonm WHERE sale_type='sale'";
$result = dbQuery($dbConn, $sql);
$totalRow = 0;
while ($row = mysqli_fetch_assoc($result)) {
$totalRow = $totalRow + intval($row['spadmin_commission']);
}
if ($totalRow > 0) {
return $totalRow;
}else{
return 0;
}
}

function total_sub_commission($dbConn){
$sql = "SELECT spadmin_commission FROM tbl_usercommisonm WHERE sale_type = 'subscription'";
$result = dbQuery($dbConn, $sql);
$totalRow = 0;
while ($row = mysqli_fetch_assoc($result)) {
$totalRow = $totalRow + intval($row['spadmin_commission']);
}
if ($totalRow > 0) {
return $totalRow;
}else{
return 0;
}
}



//===================================
//SHOW DASHBOARD TOTAL DETAIL END====
//===================================
function accountamount($dbConn, $BankId){
$sql ="SELECT bank_current_blance FROM tbl_bank WHERE bank_id = '$BankId'";
$result = dbQuery($dbConn, $sql);
if(dbNumRows($result) > 0){
$row = dbFetchAssoc($result);
echo	$BankCurrentBlance = $row['bank_current_blance'];
}
}
function totalamnt($dbConn, $BankId){
$sql ="SELECT bank_current_blance FROM tbl_bank WHERE bank_id = '$BankId'";
$result = dbQuery($dbConn, $sql);
if(dbNumRows($result) > 0){
$row = dbFetchAssoc($result);
$BankCurrentBlance = $row['bank_current_blance'];
return $BankCurrentBlance;
}
}
function BankName($dbConn, $BankId){
$sql ="SELECT bank_name FROM tbl_bank WHERE bank_id = '$BankId'";
$result = dbQuery($dbConn, $sql);
if(dbNumRows($result) > 0){
$row = dbFetchAssoc($result);
echo	$BankName = $row['bank_name'];
}
}
function orderNo($dbConn){
$sql = "SELECT order_id FROM `order` ORDER BY order_id DESC LIMIT 1";
$result = dbQuery($dbConn, $sql);
$row = dbFetchAssoc($result);
$orderID = $row['order_id'] + 1;
return $orderID;
}
function categorychk($dbConn){
$sql2 = "SELECT pro_id FROM tbl_product ORDER BY pro_id DESC LIMIT 1";
$result2 = dbQuery($dbConn, $sql2);
if(dbNumRows($result2) > 0){
$row2 = dbFetchAssoc($result2);
$lastporductid  =  $row2['pro_id'];
}

$sql = "SELECT * FROM tbl_product WHERE pro_id = '$lastporductid'";
$result = dbQuery($dbConn, $sql);
if(dbNumRows($result) > 0){
$row = dbFetchAssoc($result);
extract($row);
if($cat_id == 4){
return false;
}else{
return true;
}
}
}

function accountRP($dbConn){
$sql = "SELECT * FROM `account`";
$result = dbQuery($dbConn,$sql);
$RP = array();
if(dbNumRows($result)){
while($row = dbFetchAssoc($result)){
if($row['type'] == 'R'){
$RP[] = $row['id'];
}elseif($row['type'] == 'P'){
$RP[] = $row['id'];
}
}
}
return $RP;
}
function accountR($dbConn){
$sql = "SELECT * FROM `account`";
$result = dbQuery($dbConn,$sql);
$R = array();
if(dbNumRows($result)){
while($row = dbFetchAssoc($result)){
if($row['type'] == 'R'){
$R[] = $row['id'];
}
}
}
return $R;
}

function accountP($dbConn){
$sql = "SELECT * FROM `account`";
$result = dbQuery($dbConn,$sql);
$P = array();
if(dbNumRows($result)){
while($row = dbFetchAssoc($result)){
if($row['type'] == 'P'){
$P[] = $row['id'];
}
}
}
return $P;
}

/* My Own Function END*/
/*
Logout a user
*/
function doLogout(){
if (isset($_SESSION['userId'])) {
unset($_SESSION['userId']);
unset($_SESSION['username']);
unset($_SESSION['desig_id']);
unset($_SESSION['login_return_url']);
}	
//header('Location: login.php');
redirect('login.php');
exit;
}
/*
Create the paging links
*/
function getPagingNav($sql, $pageNum, $rowsPerPage, $queryString = ''){
$result  = mysql_query($sql) or die('Error, query failed. ' . mysql_error());
$row     = mysql_fetch_array($result, MYSQL_ASSOC);
$numrows = $row['numrows'];
// how many pages we have when using paging?
$maxPage = ceil($numrows/$rowsPerPage);
$self = $_SERVER['PHP_SELF'];
// creating 'previous' and 'next' link
// plus 'first page' and 'last page' link
// print 'previous' link only if we're not
// on page one
if ($pageNum > 1){
$page = $pageNum - 1;
$prev = " <a href=\"$self?page=$page{$queryString}\">[Prev]</a> ";

$first = " <a href=\"$self?page=1{$queryString}\">[First Page]</a> ";
}else{
$prev  = ' [Prev] ';       // we're on page one, don't enable 'previous' link
$first = ' [First Page] '; // nor 'first page' link
}
// print 'next' link only if we're not
// on the last page
if ($pageNum < $maxPage){
$page = $pageNum + 1;
$next = " <a href=\"$self?page=$page{$queryString}\">[Next]</a> ";

$last = " <a href=\"$self?page=$maxPage{$queryString}{$queryString}\">[Last Page]</a> ";
}else{
$next = ' [Next] ';      // we're on the last page, don't enable 'next' link
$last = ' [Last Page] '; // nor 'last page' link
}
// return the page navigation link
return $first . $prev . " Showing page <strong>$pageNum</strong> of <strong>$maxPage</strong> pages " . $next . $last; 
}
/*
Create a thumbnail of $srcFile and save it to $destFile.
The thumbnail will be $width pixels.
*/
function createThumbnail($srcFile, $destFile, $width, $height, $quality = 75){
$thumbnail = '';
if (file_exists($srcFile)  && isset($destFile)){
$size        = getimagesize($srcFile);
$old_width  = $size[0];
$old_height = $size[1];
// next we will calculate the new dimensions for the thumbnail image
// the next steps will be taken:
// 1. calculate the ratio by dividing the old dimensions with the new ones
// 2. if the ratio for the width is higher, the width will remain the one define in WIDTH variable and the height will be calculated so the image ratio will not change
// 3. otherwise we will use the height ratio for the image as a result, only one of the dimensions will be from the fixed ones
$ratio1=$old_width/$width;
$ratio2=$old_height/$height;
if($ratio1> $ratio2) {
$w = $width;
$h = $old_height/$ratio1;
}else {
$h=$height;
$w=$old_width/$ratio2;
}
$thumbnail =  copyImage($srcFile, $destFile, $w, $h, $quality);
}
// return the thumbnail file name on sucess or blank on fail
return basename($thumbnail);
}

/*
Copy an image to a destination file. The destination
image size will be $w X $h pixels
*/
function copyImage($srcFile, $destFile, $w, $h, $quality = 75){
$tmpSrc     = pathinfo(strtolower($srcFile));
$tmpDest    = pathinfo(strtolower($destFile));
$size       = getimagesize($srcFile);
if ($tmpDest['extension'] == "gif" || $tmpDest['extension'] == "jpg"){
$destFile  = substr_replace($destFile, 'jpg', -3);
$dest      = imagecreatetruecolor($w, $h);
imageantialias($dest, TRUE);
} elseif ($tmpDest['extension'] == "png") {
$dest = imagecreatetruecolor($w, $h);
imageantialias($dest, TRUE);
} else {
return false;
}

switch($size[2]){
case 1:       //GIF
$src = imagecreatefromgif($srcFile);
break;
case 2:       //JPEG
$src = imagecreatefromjpeg($srcFile);
break;
case 3:       //PNG
$src = imagecreatefrompng($srcFile);
break;
default:
return false;
break;
}

imagecopyresampled($dest, $src, 0, 0, 0, 0, $w, $h, $size[0], $size[1]);

switch($size[2]){
case 1:
case 2:
imagejpeg($dest,$destFile, $quality);
break;
case 3:
imagepng($dest,$destFile);
}
return $destFile;
}
/**************************** For File Size (Irfan) ***************************************/
function format_size($size, $round = 0) {
//Size must be bytes!
$sizes = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
for ($i=0; $size > 1024 && isset($sizes[$i+1]); $i++) $size /= 1024;
return round($size,$round).$sizes[$i];
}

///******************** Function for date formatting  ********************/
function formatMySQLDate($mySQLDateTime, $dateFormat) { 
$year = substr($mySQLDateTime,0,4);
$mon  = substr($mySQLDateTime,5,2);
$day  = substr($mySQLDateTime,8,2);
$hour = substr($mySQLDateTime,11,2);
$min  = substr($mySQLDateTime,14,2);
$sec  = substr($mySQLDateTime,17,2);

//	echo $day; die('===========');


return $mySQLDateTime;
//	return date($dateFormat, mktime($hour,$min,$sec,$mon,$day,$year));
}

/* Conver dd-mm-yyyy format to MySQL DATE fromat */
function conMySQLDate($date) { 

//$date = date('Y-m-d', strtotime(str_replace('-', '/', $date)));
$date = date('Y-m-d', strtotime($date));
return $date;
}

/* Conver 02/07/2009 00:07:00 format to MySQL DATE fromat */
function conMySQLDateTime($date) { 

$date = $date = preg_replace('#(\d{2})/(\d{2})/(\d{4})\s(.*)#', '$3-$2-$1 $4', $date);
return $date;
}

///******************** Function for Redirection ********************/
function redirect($url) { 
echo "<html><head><meta http-equiv=refresh content=0;URL=" . $url . "></head><body></body></html>";
}


/******************************** Function for Filter Words (Irfan) **********************************/

function filterWords($str){
$words = array("<script", "</script>", "<html", "</html>","<head", "</head>", "<meta>", "'");
for($i=0; $i < count($words); $i++){
//$strNew = eregi_replace($words[$i], htmlspecialchars($words[$i], ENT_QUOTES), $str);
$strNew = str_replace("'", "&rsquo;", $str);	
}
return $strNew;
}

function filterWordsSpecial($str)
{
$words   = array("'", "-");
$replace = array("&rsquo", "&ndash;");

for($i=0; $i < count($words); $i++)
{
$strNew = str_replace($words[$i], $replace[$i], $str);
}

return $strNew;
}  


/******************** Count Records *************************/

function countRecords($table, $where=1) {
$sqlCount = "SELECT count(*) AS numRecords FROM " . $table . " WHERE " . $where;
if($rsCount = mysql_query($sqlCount)) {
if($recCount = mysql_fetch_array($rsCount)) {
return $recCount["numRecords"];
}
}
return FALSE;
}
/**************** Week Days for Time Table ***********************/
function dbClassDays($classId) {

$sql = "SELECT DISTINCT (day_id)
FROM time_table
WHERE class_id=$classId
ORDER BY day_id";
$result = dbQuery($sql);

while($row = dbFetchAssoc($result)) {
$dbDays[]	= $row['day_id'];	
}

return $dbDays;
}



/********************************/
/**************** Date for Time Table ***********************/
function dbClassDate($examId) {

$sql = "SELECT DISTINCT (date_paper)
FROM date_sheet
WHERE exam_id=$examId
ORDER BY date_paper";
$result = dbQuery($sql);

while($row = dbFetchAssoc($result)) {
$dbDate[]	= $row['date_paper'];	
}

return $dbDate;
}



/********************************/
// Generate activation key

function activationKey(){

mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
$charid = strtoupper(md5(uniqid(rand(), true)));
$hyphen = chr(45);// "-"
$uuid = substr($charid, 0, 8)
.substr($charid, 8, 4)
.substr($charid,12, 4)
.substr($charid,16, 4)
.substr($charid,20,12);
return $uuid;

}


//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function summarize($string, $characters) {

if (strlen($string) > $characters){
return substr($string, 0, $characters) . "...";

} else {
return $string;
}

}

/************************************** Show Errors Function ***************************/

function showError($errorNo) {


$errorList = '';
require_once 'errors.php';

if (isset($errorNo)) {

$errorList .=  '<p class="showError">';

$errorList .= $error[$errorNo];

$errorList .= '</p>';

}	//end if

return $errorList;
}
//++++++++++++++++++++++++== Auto Increment +++++++++++++++++++++++++
//This function is used where we do not want mysql auto increment we want our own unique id (Irfan) 

function mysql_autoid($id,$table){
$query = 'SELECT MAX('.$id.') AS last_id FROM '.$table;
$result = mysql_query($query);
$result = mysql_fetch_array($result);

return $result['last_id']+1; 
}

function autoChallNo($id,$table){
$query = 'SELECT MAX('.$id.') AS last_id FROM '.$table;
$result = mysql_query($query);
$result = mysql_fetch_array($result);

return $result['last_id']; 
}
// Last Value

function last_id($table, $id_column) {
if ($table && $id_column) {
$result = mysql_query("SELECT MAX(".$id_column.") AS maxid FROM ".$table);
$stuff = mysql_fetch_assoc($result);
return $stuff['maxid'];
} else {
return false;
}
}


/*
Generate combo box options containing the categories we have.
if $catId is set then that category is selected
*/
function buildClassOptions($semester = false)
{

if (isset($_GET['classId']) && (int)$_GET['classId'] > 0) {
$classId = (int)$_GET['classId'];
}


$sql = "SELECT *
FROM classinfo i, programs p
WHERE i.classname  = p.programid AND i.classstatus = 1
ORDER BY i.classname ";
$result = dbQuery($sql) or die('Cannot get Data. ' . mysql_error());

$list = '';
while($row = dbFetchAssoc($result)) {

if ($semester == true) {
$resultSemester	=	convertToOrdinal($row['classsemester']);
}


// build combo box options
$list .= "<option value='" . $row['classinfoid'] ."'";
if (@$row['classinfoid'] == @$classId) {
$list.= " selected";
}

$list .= ">" . strtoupper($row['programname']) . " " . $resultSemester . " "   .  " (" . ucwords($row['classshift']) . ") " . 
$row['classsession'] ."</option>\r\n";
} //end while

return $list;

}


/* 
Course
*/ 

function buildCourseOptions($courseId = '') {

if (isset($_GET['courseId']) && (int)$_GET['courseId'] > 0) {
$courseId = (int)$_GET['courseId'];
}

$sql = "SELECT *
FROM course
WHERE coursedeptid = " . $_SESSION['deptId'] . "
ORDER BY coursename ASC";
$result = dbQuery($sql) or die('Cannot get Product. ' . mysql_error());

$list = '';
while($row = dbFetchAssoc($result)) {

// build combo box options
$list .= "<option value='" . $row['courseid'] ."'";
if (@$row['courseid'] == @$courseId) {
$list.= " selected";
}

$list .= ">" . ucwords($row['coursename']) . " (" . $row['coursecode'] . ")" . "</option>\r\n";
} //end while

return $list;
}

/* 
Course according to semester
*/ 

function buildSemCourseOptions($programmId = '', $semesterId = '', $classId = '') {

if (isset($_GET['programId']) && (int)$_GET['programId'] > 0) {
$programmId = (int)$_GET['programId'];
$semesterId = (int)$_GET['sem'];
}

if (isset($_GET['courseId']) && (int)$_GET['courseId'] > 0) {
$courseId = (int)$_GET['courseId'];
}

if (isset($_GET['classId']) && (int)$_GET['classId'] > 0) {
$classId = (int)$_GET['classId'];
}

$sql = "SELECT *
FROM semestercourses sc, course c
WHERE sc.sccourseid = c.courseid AND sc.scprogramid = $programmId AND sc.scsemester = $semesterId
ORDER BY coursename";

$result = dbQuery($sql) or die('Cannot get data. ' . mysql_error());



$list = '';
while($row = dbFetchAssoc($result)) {

// build combo box options
$list .= "<option value='" . $row['courseid'] ."'";
if (@$row['courseid'] == @$courseId) {
$list.= " selected";
}

echo 	$sqlCourse = "SELECT *
FROM resultinfo
WHERE resultclassid = $classId AND resultsemester = $semesterId";

$resultCourse = dbQuery($sqlCourse) or die('Cannot get data. ' . mysql_error());
while ($rowCourse = dbFetchAssoc($resultCourse)) {

if (@$row['courseid'] == @$rowCourse['resultcourseid']) {
$list.= " disabled='disabled'";
}

} //end course while

$list .= ">" . $row['coursecode'] . ": " . ucwords($row['coursename']) .  @$resultcourseid . "</option>\r\n";
} //end while

return $list;
}


/*
Roll No.
*/

function buildRollNoOptions($classId)
{

if (isset($_GET['studentId']) && (int)$_GET['studentId'] > 0) {
$stuCode = (int)$_GET['cboStudentCode'];
}

$sql = "SELECT *
FROM students
WHERE studentclassid = $classId
ORDER BY studentrollno";
$result = dbQuery($sql) or die('Cannot get Roll No. ' . mysql_error());

$list = '';
while($row = dbFetchAssoc($result)) {

// build combo box options
$list .= "<option value='" . $row['studentid'] ."'";
if (@$row['studentid'] == @$stuCode) {
$list.= " selected";
}

$list .= ">" . $row['studentrollno'] . "</option>\r\n";
} //end while

return $list;
}

///******************** Insert Deshes in CniC ********************/ 
function madeCnicDash($number) {

$number = substr($number, 0, 5) . '-' . substr($number, 5); 
// now $number = '36203-73068913'; 
$number = substr($number, 0, 13) . '-' . substr($number, 13); 
// now $number = '36203-7306891-3'; 
return $number; 
} 


/****************** Get Teacher Name from Time Table ******************/
function getTeacher($classId, $courseId) {

$sql = "SELECT *
FROM classinfo i, timetableinfo t,  timetable tt, teachers ts
WHERE i.classinfoid = t.ttinfoclassid AND i.classinfoid = $classId AND tt.ttinfo = t.ttinfoid AND tt.ttcourseid = $courseId AND tt.ttteacherid = ts.teacherid";
$result = dbQuery($sql) or die('Cannot get Programm ' . mysql_error());
$row = dbFetchAssoc($result);
$teacherName	=	$row['teachername'];
$teacherId		=	$row['teacherid'];

return array('teacherId' => $teacherId, 'teacherName' => $teacherName);
}

/******************** Get Program From Class ID ******************/


function getProgram($classId) {

if (isset($_GET['classId']) && (int)$_GET['classId'] > 0) {
$classId = (int)$_GET['classId'];

$sql = "SELECT *
FROM classinfo
WHERE classinfoid = $classId
ORDER BY classname";
$result = dbQuery($sql) or die('Cannot get Programm ' . mysql_error());
$row = dbFetchAssoc($result);

$programmId	=	$row['classname'];

return $programmId;
}
}

////////////////////////////// fine /////////////////////
function buildFineOptions($fineId = '')
{

$sql = "SELECT *
FROM fee_fine WHERE branch_id=".$_SESSION['branchId'];

$result = dbQuery($sql) or die('Cannot get Program ' . mysql_error());

$list = '';
while($row = dbFetchAssoc($result)) {

// build combo box options
$list .= "<option value='" . $row['ff_id'] ."'";
if (@$row['ff_id'] == @$fineId) {
$list.= " selected";
}

$list .= ">" . ucwords($row['ff_title']) . "</option>\r\n";
} //end while

return $list;
}


////////////////////////////// Class /////////////////////
function buildClass1Options($classId = '')
{

$sql = "SELECT *
FROM class 
WHERE class_status=1";


$result = dbQuery($sql) or die('Cannot get Program ' . mysql_error());

$list = '';
while($row = dbFetchAssoc($result)) {

// build combo box options
$list .= "<option value='" . $row['class_id'] ."'";
if (@$row['class_id'] == @$classId) {
$list.= " selected";
}

$list .= ">" . ucwords($row['class_title']) . "</option>\r\n";
} //end while

return $list;
}


////////////////////////////// Class For Admin /////////////////////
function buildClassAdminOptions($classId = '')
{

$sql = "SELECT *
FROM class 
WHERE class_status=1 AND branch_id=".$_SESSION['branchId'];


$result = dbQuery($sql) or die('Cannot get Program ' . mysql_error());

$list = '';
while($row = dbFetchAssoc($result)) {

// build combo box options
$list .= "<option value='" . $row['class_id'] ."'";
if (@$row['class_id'] == @$classId) {
$list.= " selected";
}

$list .= ">" . ucwords($row['class_title']) . "</option>\r\n";
} //end while

return $list;
}


////////////////////////////// Class Option with brach admin /////////////////////
function buildClasses($classId = '')
{

$sql = "SELECT *
FROM class c, branches b 
WHERE c.class_status=1 AND c.branch_id=b.branch_id AND c.branch_id=".$_GET['branchId'];


$result = dbQuery($sql) or die('Cannot get Program ' . mysql_error());

$list = '';
while($row = dbFetchAssoc($result)) {

// build combo box options
$list .= "<option value='" . $row['class_id'] ."'";
if (@$row['class_id'] == @$classId) {
$list.= " selected";
}

$list .= ">" . ucwords($row['class_title']) . "</option>\r\n";
} //end while

return $list;
}

////////////////////////////// Class Option with brach admin /////////////////////
function buildClassesGetbrachId($classId = '') {

if (isset($_GET['branchId']) && $_GET['branchId'] > 0) {
$branchSql	=	"AND c.branch_id = ". $_GET['branchId'];	
} else {
$branchSql	=	'';	
}

$sql = "SELECT *
FROM class c, branches b 
WHERE c.class_status=1 AND c.branch_id=b.branch_id $branchSql";


$result = dbQuery($sql) or die('Cannot get Program ' . mysql_error());

$list = '';
while($row = dbFetchAssoc($result)) {

// build combo box options
$list .= "<option value='" . $row['class_id'] ."'";
if (@$row['class_id'] == @$classId) {
$list.= " selected";
}

$list .= ">" . ucwords($row['class_title']) . "</option>\r\n";
} //end while

return $list;
}

////////////////////////////// Section /////////////////////
function buildSectionOptions($sectionId = '')
{
if(isset ($_SESSION['branchId']) && $_SESSION['branchId']==0 && isset($_GET['branchId']) &&  $_GET['branchId']>0){
$branchId= $_GET['branchId'];
$sql = "SELECT *
FROM section WHERE branch_id=$branchId";
}else
{
if(isset ($_SESSION['branchId']) && $_SESSION['branchId']>0){
$branchId= $_SESSION['branchId'];
$sql = "SELECT *
FROM section WHERE branch_id=$branchId";
}
}

$result = dbQuery($sql) or die('Cannot get Program ' . mysql_error());

$list = '';
while($row = dbFetchAssoc($result)) {

// build combo box options
$list .= "<option value='" . $row['section_id'] ."'";
if (@$row['section_id'] == @$sectionId) {
$list.= " selected";
}

$list .= ">" . ucwords($row['section_title']) . "</option>\r\n";
} //end while

return $list;
}


////////////////////////////// Branch /////////////////////
function buildBranchOption($branchId = '')
{

$sql = "SELECT *
FROM  branches WHERE branch_status=1";

$result = dbQuery($sql) or die('Cannot get Program ' . mysql_error());

$list = '';
while($row = dbFetchAssoc($result)) {

// build combo box options
$list .= "<option value='" . $row['branch_id'] ."'";
if (@$row['branch_id'] == @$branchId) {
$list.= " selected";
}

$list .= ">" . ucwords($row['branch_name']) . "</option>\r\n";
} //end while

return $list;
}




////////////////////////////// Exam Type /////////////////////
function buildExamType($examId = '')
{

$sql = "SELECT *
FROM examination_info WHERE exam_status=1 AND branch_id=".$_SESSION['branchId'];


$result = dbQuery($sql) or die('Cannot get Program ' . mysql_error());

$list = '';
while($row = dbFetchAssoc($result)) {

// build combo box options
$list .= "<option value='" . $row['exam_id'] ."'";
if (@$row['exam_id'] == @$examId) {
$list.= " selected";
}

$list .= ">" . ucwords($row['exam_title']) ." ". " ("  .formatMySQLDate(($row['exam_start_date']), 'd-m-Y').  ")"."</option>\r\n";
} //end while

return $list;
}

////////////////////////////////////Teacher List/////////////////////

function teachersOptions($teacherId = '')
{

$sql = "SELECT *
FROM teachers
WHERE teacher_status=1 AND branch_id=".$_SESSION['branchId'];


$result = dbQuery($sql) or die('Cannot get Program ' . mysql_error());

$list = '';
while($row = dbFetchAssoc($result)) {

// build combo box options
$list .= "<option value='" . $row['teacher_id'] ."'";
if (@$row['teacher_id'] == @$teacherId) {
$list.= " selected";
}

$list .= ">" . ucwords($row['teacher_first_name']) ." ". ucwords($row['teacher_last_name']) . "</option>\r\n";
} //end while

return $list;
}

////////////////////////////////////Subject List/////////////////////

function subjectsOptions($subjectId = '')
{

$sql = "SELECT *
FROM  subjects";
$result = dbQuery($sql) or die('Cannot get Program ' . mysql_error());

$list = '';
while($row = dbFetchAssoc($result)) {

// build combo box options
$list .= "<option value='" . $row['subject_id'] ."'";
if (@$row['subject_id'] == @$subjectId) {
$list.= " selected";
}

$list .= ">" . ucwords($row['subject_title']). "-" .ucwords($row['subject_code'])."</option>\r\n";
} //end while

return $list;
}


////////////////////////////// Department Menu List /////////////////////
function buildDepartmentOptions($eduFacultyId, $campusId)
{

if (isset($_GET['eduFacultyId']) && (int)$_GET['eduFacultyId'] > 0) {
$eduFacultyId = (int)$_GET['eduFacultyId'];
$campusId 	  = (int)$_GET['campusId'];
}

if (isset($_GET['deptId']) && (int)$_GET['deptId'] > 0) {
$deptId	=	(int)$_GET['deptId'];
}

$sql = "SELECT *
FROM department
WHERE deptcampusid = $campusId AND deptfacultyid = $eduFacultyId
ORDER BY deptname ASC";

$result = dbQuery($sql) or die('Cannot get Department ' . mysql_error());

$list = '';
while($row = dbFetchAssoc($result)) {

// build combo box options
$list .= "<option value='" . $row['deptid'] ."'";
if (@$row['deptid'] == @$deptId) {
$list.= " selected";
}

$list .= ">" . ucwords($row['deptname']) . "</option>\r\n";
} //end while

return $list;
}

////////////////////////////// Student Menu /////////////////////
function buildStudentsOpt($studentId = '') {

if (isset($_GET['classId']) && (int)$_GET['classId'] > 0 && isset($_GET['sectionId']) && (int)$_GET['sectionId'] > 0 ) {
$classId 		= 		(int)$_GET['classId'];
$sectionId		=		$_GET['sectionId'];
}

$sql = "SELECT *
FROM students
WHERE class_id = $classId AND section_id=$sectionId";
$result = dbQuery($sql) or die('Cannot get Semester ' . mysql_error());

$list = '';
$list .= "<option value=''>Choose Student</option>";
if (dbNumRows($result) > 0) {

while($row = dbFetchAssoc($result)) {

// build combo box options

$list .= "<option value='" . $row['student_id'] ."'";
if (@$row['student_id'] == $studentId) {
$list.= " selected";
}

$list .= ">" . ucwords($row['student_first_name']) . " " . ucwords($row['student_last_name']);
$list .=  "</option>\r\n";
}  // end while

} else {
$list .= "<option value='' style='color:#FF0000'>No Record Found</option>\r\n";	
} //end if dbNumRows

return $list;	
}

////////////////////////////// Student Menu /////////////////////
function buildStudentsOptions($studentId = '') {

if (isset($_GET['classId']) && (int)$_GET['classId'] > 0  ) {
$classId 		= 		(int)$_GET['classId'];

}

$sql = "SELECT *
FROM students
WHERE class_id = $classId AND student_status=1";
$result = dbQuery($sql) or die('Cannot get Semester ' . mysql_error());

$list = '';
if (dbNumRows($result) > 0) {

while($row = dbFetchAssoc($result)) {

// build combo box options

$list .= "<option value='" . $row['student_id'] ."'";
if (@$row['student_id'] == $studentId) {
$list.= " selected";
}

$list .= ">" . ucwords($row['student_first_name']) . " " . ucwords($row['student_last_name']);
$list .=  "</option>\r\n";
}  // end while

} else {
$list .= "<option value='' style='color:#FF0000'>No Record Found</option>\r\n";	
} //end if dbNumRows

return $list;	
}





////////////////////////////// Student Menu /////////////////////
function buildStudentOption($studentId = '') {

if (isset($_GET['classId']) && (int)$_GET['classId'] > 0  && isset($_GET['sectionId']) && (@$_GET['sectionId'] > 0) ){
$classId 		= 		(int)$_GET['classId'];
$sectionId		=		$_GET['sectionId'];

}

$sql = "SELECT *
FROM students
WHERE class_id = $classId AND section_id=$sectionId AND student_status=1";
$result = dbQuery($sql) or die('Cannot get Semester ' . mysql_error());

$list = '';
if (dbNumRows($result) > 0) {

while($row = dbFetchAssoc($result)) {

// build combo box options

$list .= "<option value='" . $row['student_id'] ."'";
if (@$row['student_id'] == $studentId) {
$list.= " selected";
}

$list .= ">" . ucwords($row['student_first_name']) . " " . ucwords($row['student_last_name']);
$list .=  "</option>\r\n";
}  // end while

} else {
$list .= "<option value='' style='color:#FF0000'>No Record Found</option>\r\n";	
} //end if dbNumRows

return $list;	
}
///////////////////////////////////////////////////////////////////////////////////////
function StudentOption($studentId = '',$classId = null, $sectionId = null) {


$sql = "SELECT *
FROM students
WHERE class_id = $classId AND section_id=$sectionId AND student_status=1";
$result = dbQuery($sql) or die('Cannot get Semester ' . mysql_error());

$list = '';
if (dbNumRows($result) > 0) {

while($row = dbFetchAssoc($result)) {

// build combo box options

$list .= "<option value='" . $row['student_id'] ."'";
if (@$row['student_id'] == $studentId) {
$list.= " selected";
}

$list .= ">" . ucwords($row['student_first_name']) . " " . ucwords($row['student_last_name']);
$list .=  "</option>\r\n";
}  // end while

} else {
$list .= "<option value='' style='color:#FF0000'>No Record Found</option>\r\n";	
} //end if dbNumRows

return $list;	
}



////////////////////////////// Student Menu for Result /////////////////////
function studentsOptions($studentId = '') {

if (isset($_GET['classId']) && (int)$_GET['classId'] > 0) {
$classId = (int)$_GET['classId'];


$sql = "SELECT *
FROM students
WHERE class_id = $classId";
$result = dbQuery($sql) or die('Cannot get Semester ' . mysql_error());

$list = '';
$list .= "<option value=''>Choose Student</option>";
if (dbNumRows($result) > 0) {

while($row = dbFetchAssoc($result)) {

// build combo box options

$list .= "<option value='" . $row['student_id'] ."'";
if (@$row['student_id'] == $studentId) {
$list.= " selected";
}

$list .= ">" . ucwords($row['student_first_name']) . " " . ucwords($row['student_last_name']);
$list .=  "</option>\r\n";
}  
}
}

elseif (isset($_GET['classId2']) && (int)$_GET['classId2'] > 0) {
$classId2 = (int)$_GET['classId2'];

$sql = "SELECT *
FROM students
WHERE class_id = $classId2";
$result = dbQuery($sql) or die('Cannot get Semester ' . mysql_error());

$list = '';
$list .= "<option value=''>Choose Student</option>";
if (dbNumRows($result) > 0) {

while($row = dbFetchAssoc($result)) {

// build combo box options

$list .= "<option value='" . $row['student_id'] ."'";
if (@$row['student_id'] == $studentId) {
$list.= " selected";
}

$list .= ">" . ucwords($row['student_first_name']) . " " . ucwords($row['student_last_name']);
$list .=  "</option>\r\n";
}  // end while
}
}

else {
$list .= "<option value='' style='color:#FF0000'>No Record Found</option>\r\n";	
} //end if dbNumRows

return $list;	
}


////////////////////////////// Subject Menu /////////////////////
function buildSubjects($subjectId = '') {

if (isset($_GET['classId']) && (int)$_GET['classId'] > 0) {
$classId = (int)$_GET['classId'];
}

echo $sql = "SELECT *
FROM subjects
WHERE class_id = $classId";
$result = dbQuery($sql) or die('Cannot get Subject ' . mysql_error());

$list = '';
$list .= "<option value=''>--Subject--</option>";
if (dbNumRows($result) > 0) {

while($row = dbFetchAssoc($result)) {

// build combo box options

$list .= "<option value='" . $row['subject_id'] ."'";
if (@$row['subject_id'] == $subjectId) {
$list.= " selected";
}

$list .= ">" . ucwords($row['subject_title']) . " - " . ucwords($row['subject_code']);
$list .=  "</option>\r\n";
}  // end while

} else {
$list .= "<option value='' style='color:#FF0000'>No Record Found</option>\r\n";	
} //end if dbNumRows

return $list;	
}




/* Build Semester Option with Class */
function buildClassSemesterOptions($classId) {

$sql = "SELECT *
FROM classinfo
WHERE classinfoid  = $classId";
$result = dbQuery($sql) or die('Cannot get Semester ' . mysql_error());

//$list = '';
$row = dbFetchAssoc($result);
$currentSemester	=	$row['classsemester'];

// build combo box options
$list = '';
for ($sem = 1; $sem <= $currentSemester; $sem++) {			
$list .= "<option value='" . $sem ."'";
if (@$sem == @$_GET['sem']) {
$list.= " selected";
}

$list .= ">" . convertToOrdinal($sem) . "</option>\r\n";
} //end for

return $list;	
}



/********************** Faculty List Menu *********************/
function buildFacultyOptions($deptId) {

if (isset($_GET['facultyId']) && (int)$_GET['facultyId'] > 0) {
$facultyId = (int)$_GET['facultyId'];
}

$sql = "SELECT *
FROM teachers 
WHERE teacherdeptid = $deptId
ORDER BY teachername ASC";
$result = dbQuery($sql) or die('Cannot get data. ' . mysql_error());

$list = '';
while($row = dbFetchAssoc($result)) {

// build combo box options
if ($row['teacherid'] != 0) {
$list .= "<option value='" . $row['teacherid'] ."'";
if (@$row['teacherid'] == @$facultyId) {
$list.= " selected";
}

$list .= ">" . ucwords($row['teachername']);
if ($row['teacherdesignation'] == "nts") {
$list .=  " (Non Teaching Staff)";
} 
$list .=  "</option>\r\n";
} // end of
} //end while

return $list;
}

/********************* Week Days List Menu *********************/
function buildDaysOptions($day_id='') {

if (isset($_GET['day_id'])) {
$day_id = $_GET['day_id'];
}

$weekDays = array( 1 => 'Monday', 2 =>'Tuesday',  3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday');

$daysOfWeek = '';
foreach($weekDays as $key => $daysName){
$daysOfWeek .= "<option value=\"$key\"";
if ($key == @$day_id) {
$daysOfWeek .= " selected";
}

$daysOfWeek .= ">" . ucwords($daysName) . "</option>\r\n";
}	

return $daysOfWeek;
}

/* Convert int value into english gregorian day */
function covertDay($dayInt) {

$weekDays = array(1 => 'Monday', 2 =>'Tuesday',  3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday');

return $weekDays[$dayInt];

}

////////////// Convert Geogorian Day into int day//////////////////
function covertDayToInt($day) {

$weekDays = array('Monday' => 1, 'Tuesday' => 2,  'Wednesday' => 3, 'Thursday' => 4, 'Friday' => 5, 'Saturday' => 6);

return $weekDays[$day];

}

////////////// Convert Geogorian Month into int Month//////////////////
function covertMonthToInt($month) {

$yearMonths = array('January' => 1, 'February' => 2,  'March' => 3, 'April' => 4, 'May' => 5, 'June' => 6, 'July' => 7, 'August' => 8, 'September' => 9, 'October' => 10, 'November' => 11, 'December' => 12);

return $yearMonths[$month];

}
/* Convert int value into english gregorian day */
function covertMonth($monthInt) {

$yearMonths = array(1 => 'January', 2 =>'February',  3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 =>'July' ,  8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 =>'December');

return $yearMonths[$monthInt];

}

function covertTerm($number) {
$examType =  array(1=>'Monthly Test', 2=>'Term', 3=>'Final');
return $examType[$number];
}

function UserLevelOption($number) {
$adminType =  array( 1=>'Branch Admin', 2=>'Teacher');
return $adminType[$number];
}

/******************** Percent Function *****************/

function marksPercentage($marksObtained, $totalMarks) {

$percentMakrs = ($marksObtained/$totalMarks) * 100;

return $percentMakrs;
}

/******************** Grade Calculation Function *****************/

function gradeCalculation($marks) {

if ($marks >= 95 &&  $marks <= 100) {
$grade = "A+";
} 

if ($marks >= 85 &&  $marks <= 94.99) {
$grade = "A";
} 

if ($marks >= 70 &&  $marks <= 84.99) {
$grade = "B";
}

if ($marks >= 60 &&  $marks <= 69.99) {
$grade = "C";
} 

if ($marks < 60) {
$grade = "F";
}

return $grade;
}


/******************** Grade From Database *****************/

function gradeMarks($marks) {

$sql="SELECT * FROM grade_info";
$result=dbQuery($sql);

while ($row=dbFetchAssoc($result))

if($row['grade_percentage_to']<=$marks && $row['grade_percentage_from']>= $marks){
$grade=$row['grade_title']  ."  ". " <br>" . $row['grade_remarks'] ;
}

return $grade;
}


function gradeSystem($marks) {

$sql="SELECT * FROM grade_info";
$result=dbQuery($sql);

while ($row=dbFetchAssoc($result))

if($row['grade_percentage_to']<=$marks && $row['grade_percentage_from']>= $marks){
$grade=$row['grade_title']  ;
return $grade;
}
}

/******************** Grade Point/ Quality Point Function *****************/

function gradePoint($grade) {

if ($grade == "A+") {
$gradePoint = 4.0;
}

if ($grade == "A") {
$gradePoint = 4.0;
} 

if ($grade == "B") {
$gradePoint = 3.0;
}  

if ($grade == "C") {
$gradePoint = 2.0;
} 

if ($grade == "D") {
$gradePoint = 0;
}

if ($grade == "F") {
$gradePoint = 1;
} 

return $gradePoint;
}


/******************** Prdinal Conversion *****************/

function convertToOrdinal($num){
$pf = array(0=>'th', 1=>'st', 2=>'nd', 3=>'rd', 4=>'th', 5=>'th', 6=>'th',7=>'th',8=>'th',9=>'th');
$num = (string) ((int) $num);
$strNum = $num;
return $num . $pf[substr($strNum, strlen($strNum)-1, 1)];
}
/////////////////////////////////////////////////////////// Get marks ////////////////////

function getMarks($resultId, $studentId) {
$sqlMarks = "SELECT *
FROM result 
WHERE resultinfoid = $resultId AND resultstudentid = $studentId";	

$resultMarks = dbQuery($sqlMarks);
$rowMarks	 = dbFetchAssoc($resultMarks);

return  array('mid'=>$rowMarks['resultmidmarks'],'final'=>$rowMarks['resultfinalmarks'], 'sessional'=>$rowMarks['resultsessionalmarks']);
}

///////////////// Get Session From DATABASE  And Creat List menu /////////////////////////////

function getSessionOptions()
{

if (isset($_GET['session']) && (int)$_GET['session'] > 0) {
$session = (int)$_GET['session'];
}

$sql = "SELECT DISTINCT (classsession)
FROM classinfo
ORDER BY classsession DESC";
$result = dbQuery($sql) or die('Cannot get Session ' . mysql_error());

$list = '';
while($row = dbFetchAssoc($result)) {

// build combo box options
$list .= "<option value='" . $row['classsession'] ."'";
if (@$row['classsession'] == @$session) {
$list.= " selected";
}

$list .= ">" . $row['classsession'] . "</option>\r\n";
} //end while

return $list;
}

/* Get Time Difference */
function getTimeDiff($t1,$t2) {
$a1 = explode(":",$t1);
$a2 = explode(":",$t2);

$time1 = (($a1[0]*60*60)+($a1[1]*60));
$time2 = (($a2[0]*60*60)+($a2[1]*60));

$diff = abs($time1-$time2);
$hours = floor($diff/(60*60));
$mins = floor(($diff-($hours*60*60))/(60));

$diff = $hours.":".$mins;

return $diff;
}

function addHours($t, $h) {
$a1 = explode(":", $t);
$a2 = explode(":", $h);

$time1 = (($a1[0]*60*60)+($a1[1]*60));
$time2 = (($a2[0]*60*60)+($a2[1]*60));

$diff = abs($time1+$time2);
$hours = floor($diff/(60*60));
$mins = floor(($diff-($hours*60*60))/(60));

if ($mins == 0) {
$mins = "00";
}

$newTime = $hours.":". $mins;

return $newTime;
}

/*********************** Time List Menu *******************/
function time24Format($time) {

$convertTime24	=	strftime("%H%M", strtotime($time));
return $convertTime24;
}

function makeTime($time) {

$newTime1	=	substr($time,0,2);
$newTime2	=	substr($time,2,2);

$newTime	=	$newTime1 . ":" . $newTime2;

return $newTime;
}

function time24To12($time) {

$convertTime24	=	strftime("%I:%M %p", strtotime($time));
return $convertTime24;
}



/* For Teacher Workload */
function dbClassDaysTeacher($facultyId) {

$sql = "SELECT DISTINCT (ttday)
FROM timetable t, timetableinfo ti
WHERE t.ttinfo = ti.ttinfoid AND ti.ttinfostatus = 1 AND t.ttteacherid = $facultyId
ORDER BY t.ttday ASC";
$result = dbQuery($sql);

while($row = dbFetchAssoc($result)) {
$dbDays[]	= $row['ttday'];	
}

return $dbDays;
}

/* Count Teacher Leacture Per day */
function facultyLecturePerDay($facultyId, $day = 0) {

if (isset($day) && $day > 0) {	
$sql 	= "SELECT COUNT(ttteacherid) as perdaylec
FROM timetable t, timetableinfo ti
WHERE t.ttinfo = ti.ttinfoid AND ti.ttinfostatus = 1 AND t.ttteacherid = $facultyId AND t.ttday = $day";
} else {
$sql 	= "SELECT COUNT(ttteacherid) as perdaylec
FROM timetable t, timetableinfo ti
WHERE t.ttinfo = ti.ttinfoid AND ti.ttinfostatus = 1 AND t.ttteacherid = $facultyId";

}
$result = dbQuery($sql);
$row 	= dbFetchAssoc($result);

return $row['perdaylec'];
}

/* Update Time table status  */
function chackTimetableStatus($ttEndDate, $ttInfoId) {

$currentDate	=	date("Y-m-d");

if ($currentDate > $ttEndDate) {

$sqlStatus = "UPDATE timetableinfo
SET ttinfostatus = 0 
WHERE ttinfoid = $ttInfoId";
$resultStatus = dbQuery($sqlStatus);

}	
}

//////////////////////////// Educational Faculty ///////////////////////////////////

function buildEduFacultyOptions() {

if (isset($_GET['eduFacultyId']) && (int)$_GET['eduFacultyId'] > 0) {
$eduFacultyId = (int)$_GET['eduFacultyId'];
}

$sql = "SELECT *
FROM faculty 
ORDER BY facultyname ASC";
$result = dbQuery($sql) or die('Cannot get data. ' . mysql_error());

$list = '';
while($row = dbFetchAssoc($result)) {

// build combo box options
$list .= "<option value='" . $row['facultyid'] ."'";
if (@$row['facultyid'] == @$eduFacultyId) {
$list.= " selected";
}

$list .= ">" . ucwords($row['facultyname']) . "</option>\r\n";
} //end while

return $list;
}

/* Campus */

function buildCampusOptions() {

if (isset($_GET['campusId']) && (int)$_GET['campusId'] > 0) {
echo $campusId = (int)$_GET['campusId'];
}

$sql = "SELECT *
FROM campuses 
ORDER BY campusname ASC";
$result = dbQuery($sql) or die('Cannot get data. ' . mysql_error());

$list = '';
while($row = dbFetchAssoc($result)) {

// build combo box options
$list .= "<option value='" . $row['campusid'] ."'";
if (@$row['campusid'] == @$campusId) {
$list.= " selected";
}

$list .= ">" . ucwords($row['campusname']) . "</option>\r\n";
} //end while

return $list;
}


/******************** Occupation Menu ******************/

function listbox_array ($list, $default=0, $associative=0) {
// $result="<select name='$name'>n";
$result = '';
while (list($key, $val) = each($list)) {
if ($associative) {
if ($default  == $key) {$selected="selected";} else {$selected="";}
$result.="<option value='$key' $selected>$val</option>n";
} else {
if ($default == $val) {$selected="selected";} else {$selected="";}
$result.="<option value='$val' $selected>$val</option>n";
}
}
//$result.="</select>n";
return $result;
}

/////////////////////////////////////////////////////// FOR MONTH ////////////////////////////////

function getMonth ($month='') {

$sql = "SELECT DISTINCT(fine_month) as month
FROM montly_fee 
ORDER BY month DESC";
$result = dbQuery($sql) or die('Cannot get data. ' . mysql_error());

$list = '';
while($row = dbFetchAssoc($result)) {

// build combo box options
$list .= "<option value='" . $row['month'] ."'";
if (@$row['month'] == @$month) {
$list.= " selected";
}

$list .= ">" . ucwords($row['month']) . "</option>\r\n";
} //end while

return $list;

}


/////////////////////////////////////////////////////// FOR YEAR ////////////////////////////////

function getYear($year='') {

$sql = "SELECT DISTINCT(fine_year) as year
FROM montly_fee 
ORDER BY year DESC";
$result = dbQuery($sql) or die('Cannot get data. ' . mysql_error());

$list = '';
while($row = dbFetchAssoc($result)) {

// build combo box options
$list .= "<option value='" . $row['year'] ."'";
if (@$row['year'] == @$year) {
$list.= " selected";
}

$list .= ">" . ucwords($row['year']) . "</option>\r\n";
} //end while

return $list;

}



/////////////////////////////////////////////////////// FOR Page Association ////////////////////////////////



function getPage2($pageId='') {



$sql = "SELECT *
FROM tbl_pages WHERE page_relation=0 AND page_id=pageId
ORDER BY page_id ASC";
$result = dbQuery($sql) or die('Cannot get data. ' . mysql_error());

$list = '';
while($row = dbFetchAssoc($result)) {

// build combo box options
$list .= "<option value='" . $row['page_id'] ."'";
if (@$row['page_id'] == @$year) {
$list.= " selected";
}

$list .= ">" . ucwords($row['page_name']) . "</option>\r\n";
} //end while

return $list;

}

///////////////////////////////////////////////////////////
/////////////////////////////////////////////////////// FOR NAV Association ////////////////////////////////

function assMainNav($navId='') {

$sql = "SELECT *
FROM tbl_footer_nav WHERE nav_association=0 
ORDER BY nav_id ASC";
$result = dbQuery($sql) or die('Cannot get data. ' . mysql_error());

$list = '';
while($row = dbFetchAssoc($result)) {

// build combo box options
$list .= "<option value='" . $row['nav_id'] ."'";
if (@$row['nav_id'] == @$navId) {
$list.= " selected";
}

$list .= ">" . ucwords($row['nav_title']) . "</option>\r\n";
} //end while

return $list;

}


function getAssMainNav($navId='') {

$sql = "SELECT *
FROM tbl_footer_nav WHERE nav_association=0 
ORDER BY nav_id ASC";
$result = dbQuery($sql) or die('Cannot get data. ' . mysql_error());

$list = '';
while($row = dbFetchAssoc($result)) {

// build combo box options
$list .= "<option value='" . $row['nav_id'] ."'";
if (@$row['nav_id'] == @$navId) {
$list.= " selected";
}

$list .= ">" . ucwords($row['nav_title']) . "</option>\r\n";
} //end while

return $list;

}



//////////////////////// Status  //////////////////////////


function getStatus ($dbConn){
$sql = "SELECT * FROM tbl_status";
$result = dbQuery($dbConn, $sql);
if(dbNumRows($result) >0 ){
while($row = dbFetchAssoc($result)) {
// build combo box options
echo $list = "<option value='" . $row['status_id'] ."'" .">" . strtoupper($row['status']) ."</option>\r\n"; ;

} //end while
}
}

function getStatusByID ($dbConn,$statusId){
$sql = "SELECT * FROM tbl_status WHERE status_id = '$statusId'";
$result = dbQuery($dbConn, $sql);
if(dbNumRows($result) >0 ){
$row = dbFetchAssoc($result);
echo "<option value='" . $row['status_id'] ."'" .">" . strtoupper($row['status']) ."</option>\r\n";
}
}


////////////////////////// Department ///////////////////////////////


function getDepartment ($dbConn){
$sql = "SELECT * FROM department";
$result = dbQuery($dbConn, $sql);
if(dbNumRows($result) >0 ){
while($row = dbFetchAssoc($result)) {
// build combo box options
echo $list = "<option value='" . $row['dep_id'] ."'" .">" . strtoupper($row['dep_name']) ."</option>\r\n";

} //end while
}
}

function getDepartmentAr ($dbConn){
$sql = "SELECT * FROM department";
$result = dbQuery($dbConn, $sql);
if(dbNumRows($result) >0 ){
$db = array();
while($row = dbFetchAssoc($result)) {
$id = $row['dep_id'];
$db[$id] = $row['dep_name'];
} //end while
return $db;
}
}


function getDepartmentByID ($dbConn,$depId){
$sql = "SELECT * FROM department WHERE dep_id = '$depId'";
$result = dbQuery($dbConn, $sql);
if(dbNumRows($result) >0 ){
$row = dbFetchAssoc($result);
echo strtoupper($row['dep_name']);
}
}



///////////////// PRINT R FUNCTION ///////////////////////

function printR($array) {
echo "<pre>";
print_r($array);
echo "</pre>";
}

function gmdate_to_mydate($gmdate){
/* $gmdate must be in YYYY-mm-dd H:i:s format*/
$timezone=date_default_timezone_get();
$userTimezone = new DateTimeZone($timezone);
$gmtTimezone = new DateTimeZone('GMT');
$myDateTime = new DateTime($gmdate, $gmtTimezone);
$offset = $userTimezone->getOffset($myDateTime);
return $offset;
//return date("Y-m-d H:i:s", strtotime($gmdate)+$offset);
}

function send_any_sms($mobilenumbers, $message){


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the bundled autoload from the Twilio PHP Helper Library

require __DIR__ . '/twilio-php-main/src/Twilio/autoload.php';

//use Twilio\Rest\Client;


// Your Account SID and Auth Token from twilio.com/console
$account_sid = 'AC133edde2cd4eb04a187b23785b9acf65';
$auth_token = 'c34c43a63c60436330b906ebf35a75c7';
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]
// A Twilio number you own with SMS capabilities
$twilio_number = "+16042002975";
$client = new Twilio\Rest\Client($account_sid, $auth_token);
$client->messages->create(
// Where to send a text message (your cell phone?) +917769899889
$mobilenumbers,
array(
'from' => $twilio_number,
'body' => $message
)
);

//$mobilenumbers, // Text this number


}

if(isset($_POST['sendsms']))
{
require_once 'config.php';
$uid = $_POST['uid'];
$sql = "SELECT * FROM tbl_user WHERE  user_id = $uid AND user_status = 1 ";
$result = dbQuery($dbConn, $sql);
if (dbNumRows($result) == 1) {
$row = dbFetchAssoc($result);
//$row['user_email'] = 'tigertopdev714@gmail.com';
$size = 6;
$alpha_key = '';
$keys = range('A', 'Z');
for ($i = 0; $i < 2; $i++) {
$alpha_key .= $keys[array_rand($keys)];
}
$length = $size - 2;
$key = '';
$keys = range(0, 9);
for ($i = 0; $i < $length; $i++) {
$key .= $keys[array_rand($keys)];
}

$randCode = $alpha_key . $key;
$sql_up="UPdate tbl_user set phone_code = '$randCode' where user_id = ".$row['user_id'];
dbQuery($dbConn, $sql_up);
$message = urlencode($randCode)." is your code to login to TheSharePage.com . BackofAdmin Do not share it with anyone.";
$mobile = $row['user_mob'];

$user_email = $row['user_email'];
$user_name = $row['user_name'];

/*function sp_autoloader($class){
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

*/
//$pc = new _email;

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
$BaseUrl = $actual_link;


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
margin: 20px 0px 25px;;

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
color: #FFF!important;
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
</style>
</head>
<body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
<table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td align="center" class="logo" >
<a href="' . $BaseUrl . '/"><img src="' . $BaseUrl . '/assets/images/logo/tsp_trans.png" alt="The SharePage" style="width: 100px;"></a>
<h1 style="background-color:#0d3e0d;color:white;padding-bottom: 10px;"><span style="font-size:20px">Email Verification for Back Admin</span></h1>
</td>
</tr>
<tr>
<td>
<p>Hi'." " . ucfirst(strtolower($user_name)) . ', </p>
</td>
</tr>
<tr>
<td>
<p>' . $message . '</p>
</td>
</tr>
<tr>
<td>
</td>
</tr>
<tr>
<td>
<p class="left-margin" >Regards,<br>
The SharePage<br>
A solution for an ad-free site where you can actually get value for your time.<br>
</p>
</td>
</tr>
</tbody>
</table>
<div style="width: 640px;text-align: center;margin: 0 auto">
<p style="margin-bottom: 10px;">© Copyright ' . date('Y') . ' The SharePage. All rights reserved.</p>
</div>

</body>
</html>

';



//echo $msg;die;

//$user_email="shubham18822@gmail.com";

//$res = $pc->send_backofadmin_mail($user_email,$message,$user_name);






$subject = " OTP to Login Backofadmin.";


$smtp_host = 'send.smtp.com';
$smtp_port = 2525;
$smtp_password = "Info2023$!";
$smtp_email = 'info-email@thesharepage.com';
$smtp_username = 'infoemail';


$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = $smtp_host;
$mail->SMTPAuth = true;
$mail->Username = $smtp_username;
$mail->Password = $smtp_password;
$mail->Port = $smtp_port;
$mail->From = $smtp_email;
$mail->FromName = 'The SharePage';
$mail->addAddress($user_email);
$mail->isHTML(true);
$mail->Subject = $subject;
$mail->Body    = $msg;
if (!$mail->send()) {

echo 0;
} else {
$_SESSION['backlogin']=$randCode;
//echo $randCode; exit;
echo 1;

} 


/*
$email_to = $user_email;
$subj = "OTP Verification";
$message = $message;*/


/*$email_test = array();

$emails = $email_to;
if (isset($subj) && $subj != '') {
$subject = $subj;
}else{
$subject = "The SharePage";
} 

$txt = $message;        

$api_key = "ae6e0fc1f1fcf9db61dfc51f1d4831a8-9c988ee3-65f27b72"; /* Api Key got from https://mailgun.com/cp/my_account */
/*$domain = "dev.thesharepage.com";
$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, 'api:' . $api_key);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v2/' . $domain . '/messages');
curl_setopt($ch, CURLOPT_POSTFIELDS, array(
//'X-Mailgun-Recipient-Variables' => $myJSON,
'from'      => 'The SharePage <info@thesharepage.com>',
'to'        => $emails, 
'subject'   => $subject,
'html'      => $txt,
'o:tracking-clicks' => FALSE
));
$result = curl_exec($ch);
curl_close($ch);
*/



//  send_any_sms($mobile, $message);
// send_any_sms($mobile, $message);


}
}
if(isset($_POST['txtUserName']) && $_POST['txtPassword']) {
require_once 'config.php';
doLogin($dbConn);
}

?>
