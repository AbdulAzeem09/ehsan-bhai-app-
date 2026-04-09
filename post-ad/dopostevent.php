<?php
include('../../univ/baseurl.php');
//include('../univ/baseurl.php');
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

/* function sp_autoloader($class){
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$p = new _postings;
if(isset($_POST["idspPostings"]))
{
$postid = $p->update( $_POST, "WHERE t.idspPostings =" . $_POST["idspPostings"]);
echo trim($_POST["idspPostings"]);
}

else
{
if($_POST["spProfiles_idspProfiles"]!=""){
if(isset($_POST["spPostingAlbum_idspPostingAlbum_"]))
$postid = $p->post($_POST, $_FILES, $_POST["spPostingAlbum_idspPostingAlbum_"]);
else
$postid = $p->post($_POST, $_FILES);
echo trim($postid);
}
} */  
require_once $_SERVER["DOCUMENT_ROOT"].'/common.php';
session_start();
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}


//print_r($_FILES); die('===========');

//echo "<pre>";
//print_r($_POST); 
//print_r($_POST);

if(isset($_POST['sponsorId'])){

if(is_array($_POST['sponsorId']))
{
@$_POST['sponsorId'] = implode(",",$_POST['sponsorId']);
}else
{
@$_POST['sponsorId'] =$_POST['sponsorId'];
}
}



if($_POST['addfeaturning']){
$addfeaturning = implode(",",$_POST['addfeaturning']);
}else{
$addfeaturning = "";
}
//echo $addfeaturning;

if($_POST['spPostingCohost']){
$cohost= implode(",",$_POST['spPostingCohost']);
}else{
$cohost="";
}
$_POST['addfeaturning'] = '';
$_POST['spPostingCohost'] = '';
//$tickettype = $_POST['Ticket_Type'];
// $ticketprice = $_POST['Price'];
$ticketcape = $_POST['Capacity'];

$TicketTypeadd = $_POST['Ticket_Typeadd'];
$Capacityadd = $_POST['Capacity'];
$Priceadd = $_POST['Price'];

unset($_POST['Ticket_Typeadd']);
unset($_POST['Capacityadd']);
unset($_POST['Priceadd']);
/*unset($_POST['Ticket_Type_add']);
unset($_POST['Capacity_add']);
unset($_POST['Price_add']);*/

//print_r($_POST); 
//exit;
/*
$_POST['Ticket_Type'] = implode(",",$_POST['Ticket_Type']);
$_POST['Price'] = implode(",",$_POST['Price']);
$_POST['Capacity'] = implode(",",$_POST['Capacity']);
*/


spl_autoload_register("sp_autoloader");
$p = new _spevent;
$re = new _redirect;
$prictype = new _spevent_type_price;

// send mail contact

if (isset($_POST["organizername"]) && $_POST["organizeremail"] && $_POST["organizerphone"] && $_POST["eventurl"]) {
  $organizeremail = isset($_POST["organizeremail"]) ? $_POST["organizeremail"] : "";
  $BaseUrl = isset($_POST["eventurl"]) ? $_POST["eventurl"] : "";
  $name = isset($_POST["name"]) ? $_POST["name"] : "";
  $phone = isset($_POST["phone"]) ? $_POST["phone"] : "";
  $useremail = isset($_POST["email"]) ? $_POST["email"] : "";
  $message = isset($_POST["message"]) ? $_POST["message"] : "";
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
  <h1>The SharePage</h1>
  </td>
  </tr>

  <tr>
    <td class="letstart" style="color:#3e2048"><b>Event Url: </b></td>
    <td>'.$BaseUrl.'</td>
  </tr>
  <tr>
    <td class="letstart" style="color:#3e2048"><b>Name: </b></td>
    <td>'.$name.'</td>
  <tr>
  <tr>
    <td class="letstart" style="color:#3e2048"><b>Email: </b></td>
    <td>'.$useremail.'</td>
  <tr>
  <tr>
    <td class="letstart" style="color:#3e2048"><b>Phone: </b></td>
    <td>'.$phone.'</td>
  <tr>
  <tr>
  <td class="letstart" style="color:#3e2048"><b>Message: </b></td>
  <td>'.$message.'</td>
  </tr>


  <tr>
  <td>
  <p class="left-margin" >Regards,<br>
  The SharePage Team<br>
  www.TheSharePage.com
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
    $subject = 'Event Enquiry';
    $n = new _email;
    $n1 = $n->send_all_email($useremail, $subject, $msg);
    if($n1 == '1'){
        header("Location: $BaseUrl&status=success#success_message");
        exit;
    }
}
// end

if (isset($_POST["idspPostings"]) && $_POST["idspPostings"]!= '') {
$pst_id = $_POST["idspPostings"];
$_POST["spPostings_idspPostings"] = $_POST["idspPostings"];


//echo "<pre>";
//	print_r($_POST);
/*
$total = count($_FILES['spPostingGallery']['name']);
for($i=0;$i<$total;$i++){
$fileName = $_FILES['spPostingGallery']['name'][$i];
$newFileName = $fileName.rand(100000,999999);
$fileDest = $BaseUrl.'uploadimage1/'.$newFileName;
move_uploaded_file($_FILES['spPostingGallery']['tmp_name'][$i], $fileDest);
$GalleryArray = array(
"post_id"=>$pst_id,
"image_name"=>$newFileName
);
$p->createGallery($GalleryArray);
}
*/


$dataevent_edit = array(	
'spCategories_idspCategory' =>$_POST['spCategories_idspCategory'],
'spPostingVisibility' => $_POST['spPostingVisibility'],
'default_currency' => $_POST['default_currency'],
'spProfiles_idspProfiles' => $_POST['spProfiles_idspProfiles'],
'spPostingAlbum_idspPostingAlbum_' => $_POST['spPostingAlbum_idspPostingAlbum_'],
'eventcategory' => $_POST['eventcategory'],
'spPostingTitle' => $_POST['spPostingTitle'],
'specification' => $_POST['specification'],
'spPostingNotes' =>  $_POST['spPostingNotes'],
'spPostingsCountry' => $_POST['spPostingsCountry'],
'spPostingsState' => $_POST['spPostingsState'],
'spPostingsCity' => $_POST['spPostingsCity'],
'eventaddress' => $_POST['eventaddress'],
'spPostingEventVenue' => $_POST['spPostingEventVenue'],
'event_payment_type' => $_POST['event_payment_type'],
'hallcapacity' => $_POST['hallcapacity'],
'taxrate' =>$_POST['taxrate'],  
'notax' =>$_POST['notax'], 
'spPostingEventOrgId' => $_POST['spPostingEventOrgId'],
'spPostingEventOrgName' => $_POST['spPostingEventOrgName'],
'spPostingStartDate' => $_POST['spPostingStartDate'],
'spPostingExpDt' => $_POST['spPostingExpDt'],
'spPostingStartTime' => $_POST['spPostingStartTime'],
'spPostingEndTime' => $_POST['spPostingEndTime'],
'sponsorId' => $_POST['sponsorId'],
'registration_req' => $_POST['registration_req'],
'group_' => $_POST['group_'],
'addfeaturning' => $addfeaturning,
'spPostingCohost' => $cohost );


$postid = $p->updateEvnt($dataevent_edit, $pst_id);
//echo trim($postid); 
$resultdata = $prictype->read($_POST["idspPostings"]);


echo  $_POST["idspPostings"];
//print_r($resultdata);
//exit;
$totalrow = $resultdata->num_rows;


//if($totalrow == 0)
//{

/*$total5_type = count($TicketTypeadd);
if($total5_type>0)
{

foreach ($TicketTypeadd as $key1 => $value1) {

$postData1 = array("event_id" => $_POST["idspPostings"] ,"event_type" =>$TicketTypeadd[$key1],"event_limit" =>$Capacityadd[$key1],"event_price" =>$Priceadd[$key1]);

$price_type_id = $prictype->create($postData1);
}	
}*/
// }
// else
//	{ 

$tickettype = $_POST['Ticket_Type'];

// print_r($tickettype); die();
if($tickettype){
$total_type = count($tickettype);
//$total_type = $_POST['typeid_new'];
//die('kkkkkkkkk');
if($total_type>0)
{


//for($l=0; $l<$total_type; $l++)
//{
$keyss = array();
$prictype->delete_data($_POST["idspPostings"]); 
foreach ($TicketTypeadd as $key1 => $value1) {
echo $key;
$resultdata2 = $prictype->readtypid($key);
$totalrow2 = $resultdata2->num_rows; 
$keyss[] = $key;

$postData1 = array("event_id" => $_POST["idspPostings"] ,"event_type" =>$TicketTypeadd[$key1],"event_limit" =>$Capacityadd[$key1],"event_price" =>$Priceadd[$key1]);

//print_r($postData1);

$price_type_id = $prictype->create($postData1);  



}



//}
}
}  

/*
foreach ($TicketTypeadd as $key1 => $value1) {

$postData1 = array("event_id" => $_POST["idspPostings"] ,"event_type" =>$TicketTypeadd[$key1],"event_limit" =>$Capacityadd[$key1],"event_price" =>$Priceadd[$key1]);

$price_type_id = $prictype->create($postData1);



}	


*/

if($resultdata != false){
while ($pricedata = mysqli_fetch_assoc($resultdata)) {
if($keyss){
if(!in_array($pricedata['typeid'],$keyss))
{

$price_type_id = $prictype->remove($pricedata['typeid']);
}
}

}
}



// }

//echo trim($_POST["idspPostings"]);

} else {
if(isset($_POST['eventcategory']) && $_POST['eventcategory'] == ""){
  echo json_encode(["error" => 'Category is required']);exit;
}
if(isset($_POST['spPostingTitle']) && $_POST['spPostingTitle'] == ""){
  echo json_encode(["error" => 'Event title is required']);exit;
}
if(isset($_POST['Ethnicity']) && $_POST['Ethnicity'] == ""){
  echo json_encode(["error" => 'Ethnicity is required']);exit;
}
if(isset($_POST['spPostingsCountry']) && $_POST['spPostingsCountry'] == "0"){
  echo json_encode(["error" => 'Country is required']);exit;
}
if(isset($_POST['spPostingsState']) && $_POST['spPostingsState'] == "0"){
  echo json_encode(["error" => 'State is required']);exit;
}
if(isset($_POST['spPostingsCity']) && $_POST['spPostingsCity'] == "0"){
  echo json_encode(["error" => 'City is required']);exit;
}
if(isset($_POST['eventaddress']) && $_POST['eventaddress'] == ""){
  echo json_encode(["error" => 'Event Address is required']);exit;
}
if(isset($_POST['spPostingEventVenue']) && $_POST['spPostingEventVenue'] == ""){
  echo json_encode(["error" => 'Name of Place is required']);exit;
}
if(isset($_POST['event_payment_type']) && $_POST['event_payment_type'] == "0"){
  echo json_encode(["error" => 'Event type is required']);exit;
}
if(isset($_POST['registration_req']) && $_POST['registration_req'] == ""){
  echo json_encode(["error" => 'Registration needed is required']);exit;
}
if(isset($_POST['hallcapacity']) && $_POST['hallcapacity'] == ""){
  echo json_encode(["error" => 'Event capacity is required']);exit;
}
if(isset($_POST['spPostingEventOrgName']) && $_POST['spPostingEventOrgName'] == ""){
  echo json_encode(["error" => 'Organizer name is required']);exit;
}
if(isset($_POST['spPostingEventOrgEmail']) && $_POST['spPostingEventOrgEmail'] == ""){
  echo json_encode(["error" => 'Organizer email is required']);exit;
}
if(isset($_POST['spPostingEventOrgPhone']) && $_POST['spPostingEventOrgPhone'] == ""){
  echo json_encode(["error" => 'Organizer phone is required']);exit;
}
if(isset($_POST['spPostingStartDate']) && $_POST['spPostingStartDate'] == ""){
  echo json_encode(["error" => 'Start date is required']);exit;
}
if(isset($_POST['spPostingExpDt']) && $_POST['spPostingExpDt'] == ""){
  echo json_encode(["error" => 'End date is required']);exit;
}
if(isset($_POST['spPostingStartTime']) && $_POST['spPostingStartTime'] == ""){
  echo json_encode(["error" => 'Start time is required']);exit;
}
if(isset($_POST['spPostingEndTime']) && $_POST['spPostingEndTime'] == ""){
  echo json_encode(["error" => 'End time is required']);exit;
}
$result8 = $p->eventExists();
if ($result8) {
$row8 = mysqli_fetch_assoc($result8);

if($row8['spPostingTitle']==$_POST["spPostingTitle"]&&$row8['eventcategory']==$_POST["eventcategory"]&&$row8['spPostingEventOrgName']==$_POST["spPostingEventOrgName"]&&$row8['spPostingEventVenue']==$_POST["spPostingEventVenue"]&&$row8['eventaddress']==$_POST["eventaddress"]){
}else{

  if(isset($_POST['spProfileName']) && $_POST['spProfileName'] !== "") {
    insertQ("update spprofiles set spProfilesDefault = ? where spUser_idspUser = ?", "ii", [0, $_SESSION['uid']]);
    $arr = [];
    $arr[] = $_POST['spProfileName'];
    $arr[] = 3;
    $arr[] = $_SESSION['uid'];
    $arr[] = isset($_SESSION['email']) ? $_SESSION['email'] : "";
    $arr[] = 1;

    $pid = insertQ("insert into spprofiles (spProfileName, spProfileType_idspProfileType, spUser_idspUser, spProfileEmail, spProfilesDefault) values (?, ?, ?, ?, ?)", "siisi", $arr);
    $_POST['spProfiles_idspProfiles'] = $pid;
    $proArr = [];
    $proArr[] = $pid;
    $_POST['spPostingEventOrgName'] = $_POST['spProfileName'];
    if(!empty($_POST['carrerhighlight'])){
      $proArr[] = $_POST['carrerhighlight'];
    } else {
      echo "Carrer highlights cannot be empty";die;
    }
    if(!empty($_POST['category'])){
      $proArr[] = $_POST['category'];
    } else {
      echo "Carrer Category cannot be empty";die;
    }
    $proArr[] = "";
    $proArr[] = "";
    $proArr[] = "";
    $proArr[] = "";
    $proArr[] = "";
    $proArr[] = "";
    $proArr[] = 0;
    $proArr[] = "";
    insertQ("insert into spprofessional_profile (spprofiles_idspProfiles, highlights, category, spProfileWebsite, spProfileAbout, spProfileeducation, sphobbies, sptags, spCertification, spExperience, splanguagefluency) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", "issssssssis", $proArr);
  }

$spPostingEventOrgEmail = !empty($_POST["spPostingEventOrgEmail"]) ? $_POST["spPostingEventOrgEmail"] : "";
$spPostingEventOrgPhone = !empty($_POST["spPostingEventOrgPhone"]) ? $_POST["spPostingEventOrgPhone"] : "";
$ticketlink = !empty($_POST["ticketlink"]) ? $_POST["ticketlink"] : "";
$Ethnicity = !empty($_POST["Ethnicity"]) ? $_POST["Ethnicity"] : "";
$spPostingReturnPolicy = !empty($_POST["spPostingReturnPolicy"]) ? $_POST["spPostingReturnPolicy"] : "";
$EventLatitude = !empty($_POST["lat"]) ? $_POST["lat"] : "";
$EventLongitude = !empty($_POST["long"]) ? $_POST["long"] : "";

$dataevent = array(	'spCategories_idspCategory' =>$_POST['spCategories_idspCategory'],
'spPostingVisibility' => $_POST['spPostingVisibility'],
'default_currency' => $_POST['default_currency'],
'spProfiles_idspProfiles' => $_POST['spProfiles_idspProfiles'],
'spPostingAlbum_idspPostingAlbum_' => $_POST['spPostingAlbum_idspPostingAlbum_'],
'eventcategory' => $_POST['eventcategory'],
'groupid' => $_POST['groupid'],
'spPostingTitle' => $_POST['spPostingTitle'],
'specification' => $_POST['specification'],
'spPostingNotes' =>  $_POST['spPostingNotes'],
'spPostingsCountry' => $_POST['spPostingsCountry'],
'spPostingsState' => $_POST['spPostingsState'],
'spPostingsCity' => $_POST['spPostingsCity'],
'eventaddress' => $_POST['eventaddress'],
'spPostingEventVenue' => $_POST['spPostingEventVenue'],
'event_payment_type' => $_POST['event_payment_type'],
'hallcapacity' => $_POST['hallcapacity'],
'taxrate' =>$_POST['taxrate'],  
'notax' =>$_POST['notax'], 
'spPostingEventOrgId' => $_POST['spPostingEventOrgId'],
'spPostingEventOrgName' => $_POST['spPostingEventOrgName'],
'spPostingStartDate' => $_POST['spPostingStartDate'],
'spPostingExpDt' => $_POST['spPostingExpDt'],
'spPostingStartTime' => $_POST['spPostingStartTime'],
'spPostingEndTime' => $_POST['spPostingEndTime'],
'sponsorId' => $_POST['sponsorId'],
'registration_req' => $_POST['registration_req'],
'group_' => $_POST['group_'],
'addfeaturning' => $addfeaturning,
'spPostingCohost' => $cohost,
'spPostingEventOrgEmail' => $spPostingEventOrgEmail,
'spPostingEventOrgPhone' => $spPostingEventOrgPhone,
'EventTicketUrl' => $ticketlink,
'Ethnicity' => $Ethnicity,
'spPostingReturnPolicy' => $spPostingReturnPolicy,
'EventLatitude' => $EventLatitude,
'EventLongitude' =>$EventLongitude);

$postid = $p->post($dataevent, $_FILES);
echo trim($postid); 
if($TicketTypeadd == ''){
$total5_type = 0;
}
else{
$total5_type = count($TicketTypeadd);

}
if($total5_type>0) 
{

// print_r($TicketTypeadd);
foreach ($TicketTypeadd as $key1 => $value1) {


$postData1 = array("event_id" => $postid ,"event_type" =>$TicketTypeadd[$key1],"event_limit" =>$Capacityadd[$key1],"event_price" =>$Priceadd[$key1]);

// print_r($postData1);
$price_type_id = $prictype->create($postData1);

}	
}



}

}


}

$_SESSION['count'] = 0;
$_SESSION['errorMessage'] = "<strong>Success!</strong> Event Flagged Successfully!";
$redirctUrl = $BaseUrl . "/events";
//$redirctUrl = $BaseUrl . "/post-ad/events/posting.php?postid=$postid"; 
//	$re->redirect($redirctUrl);
?>
