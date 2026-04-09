<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/common.php';
include('../helpers/image.php');
function sp_autoloader($class){
  if(file_exists('../mlayer/' . $class . '.class.php')){
    include_once '../mlayer/' . $class . '.class.php';
  }
}
//print_r($_FILES);die;
//echo '-------------------------------------------------------------';

session_start();
spl_autoload_register("sp_autoloader");  

$basic = isset($_POST['basic']) ? $_POST['basic'] : "";
if(!$basic){
  errorOut("Mandatory fields are not filled");
}
  
  
$basicArray = [];
foreach($basic as $k => $v){
  if(!preg_match("/spPostHighLit/ims", $k)){
    $basicArray[$k] = $v;
  }
}
if(empty($basicArray['spPostingPropStatus'])){
  $basicArray['spPostingPropStatus'] = 'Active';
}

if(empty($basicArray)){
  errorOut("Mandatory fields are not filled");
}
$image = new Image();
$images = $image->validateFileImageExtensions($_FILES['spPostingPic']);
if ($images !== null) {
  errorOut("Please upload only image files.");
  exit;
}

$isDraft = (isset($_POST['isDraft']) &&  $_POST['isDraft'] == 1) ? 1 : 0;
$spPostingsCountry = !empty($basicArray['spPostingsCountry']) ? trim($basicArray['spPostingsCountry']) : "";
$spPostingsState = !empty($basicArray['spPostingsState']) ? trim($basicArray['spPostingsState']) : "";
$spPostingsCity = !empty($basicArray['spPostingsCity']) ? trim($basicArray['spPostingsCity']) : "";

if($isDraft == 0){
  if(!isset($basicArray['spPostingTitle']) || $basicArray['spPostingTitle'] == ""){
    errorOut("Please enter a title");  
  }
  if(!isset($basicArray['spPostingAddress']) || $basicArray['spPostingAddress'] == ""){
    errorOut("Please enter a address");  
  }
  if(!isset($basicArray['spPostDurstion']) || $basicArray['spPostDurstion'] == "" || $basicArray['spPostDurstion'] == "Select rent duration"){
    errorOut("Please select a rent duration");  
  }
  if(!isset($basicArray['spPostingPropertyType']) || $basicArray['spPostingPropertyType'] == "" || $basicArray['spPostingPropertyType'] == "Select property type"){
    errorOut("Please select a property type");  
  }
  if(!isset($basicArray['spPostingSqurefoot']) || $basicArray['spPostingSqurefoot'] == ""){
    errorOut("Please enter square foot");  
  }
  if(!isset($basicArray['spPostingBedroom']) || $basicArray['spPostingBedroom'] == ""){
    errorOut("Please enter bed room number");  
  }
  if(!isset($basicArray['spPostingBathroom']) || $basicArray['spPostingBathroom'] == ""){
    errorOut("Please enter bath room number");  
  }
  if(!isset($basicArray['spPostAvailFrom']) || $basicArray['spPostAvailFrom'] == "" || !isset($basicArray['spPostAvailTo']) || $basicArray['spPostAvailTo'] == ""){
    errorOut("Please select available dates");  
  }
  if(!isset($basicArray['defaltcurrency']) || $basicArray['defaltcurrency'] == ""){
    errorOut("Please select a currency");  
  }
  if(!isset($basicArray['spPostDepositAmt']) || $basicArray['spPostDepositAmt'] == ""){
    errorOut("Please enter deposit");  
  }
  if(!isset($basicArray['spPostRentalMonth']) || $basicArray['spPostRentalMonth'] == ""){
    errorOut("Please enter rent per month");  
  }
  if(!isset($basicArray['spPostRentalWeek']) || $basicArray['spPostRentalWeek'] == ""){
    errorOut("Please enter rent per week");  
  }
  if(!isset($basicArray['spPostRentalNight']) || $basicArray['spPostRentalNight'] == ""){
    errorOut("Please enter rent per day");  
  }
  if(!isset($basicArray['spPostingServicChrg']) || $basicArray['spPostingServicChrg'] == ""){
    errorOut("Please enter service charge");  
  }
  if(!isset($basicArray['spPostingCleaningChrg']) || $basicArray['spPostingCleaningChrg'] == ""){
    errorOut("Please enter cleaning charge");  
  }
  if(!isset($basicArray['spPostingNotes']) || $basicArray['spPostingNotes'] == ""){
    errorOut("Please enter description");  
  }
  if(!isset($_FILES['spPostingPic']) && empty($_FILES['spPostingPic'])){
    errorOut("Please select an image");  
  }
}

if($isDraft == 0 || ($isDraft == 1 && !empty($spPostingsCountry) && !empty($spPostingsState) && !empty($spPostingsCity) )) {
  if(empty($spPostingsCountry)){
    errorOut("Please select proper Address - Country is missing");
  }
  else{
    $countryObj = selectQ("select country_id from tbl_country where country_title=?", "s", [$spPostingsCountry], "one");
    if(!$countryObj){
      errorOut("This country is not in our list");  
    }
    $basicArray['spPostingsCountry'] = $countryObj['country_id'];
  }

  if(empty($spPostingsState)){
    errorOut("Please select proper Address - State is missing");
  }
  else{  
    $stateObj = selectQ("select state_id from tbl_state where country_id=? and state_title=?", "is", [$basicArray['spPostingsCountry'], $spPostingsState], "one");
    if(!$stateObj){
      errorOut("This state is not in our list");  
    }
    $basicArray['spPostingsState'] = $stateObj['state_id'];
  }
  if(empty($spPostingsCity)){
    errorOut("Please select proper Address - City is missing");
  }
  else{  
    $cityObj = selectQ("select city_id from tbl_city where country_id=? and state_id=? and city_title=?", "iis", [$basicArray['spPostingsCountry'], $basicArray['spPostingsState'], $spPostingsCity], "one");
    if(!$cityObj){
      errorOut("This city is not in our list");  
    }
    $basicArray['spPostingsCity'] = $cityObj['city_id'];
  }
}
$basicArray['spPostingVisibility'] = -1; //for saving
if($isDraft == 1){
  $basicArray['spPostingVisibility'] = 0;
}


$s3 = new s3Class(3);
$allS3SellerPic = $s3->storeAllInS3('seller_picture');
$allS3SpPostingPic = $s3->storeAllInS3('spPostingPic');


$p = new _realstateposting;

$_POST['spPostHighLit'] =  '';
if(isset($basicArray['spProfileName']) && $basicArray['spProfileName'] != "") {
  
  insertQ("update spprofiles set spProfilesDefault = ? where spUser_idspUser = ?", "ii", [0, $_SESSION['uid']]);
  $arr = [];
  $arr[] = $basicArray['spProfileName'];
  $arr[] = 3;
  $arr[] = $_SESSION['uid'];
  $arr[] = isset($_SESSION['email']) ? $_SESSION['email'] : "";
  $arr[] = 1;

  $pid = insertQ("insert into spprofiles (spProfileName, spProfileType_idspProfileType, spUser_idspUser, spProfileEmail, spProfilesDefault) values (?, ?, ?, ?, ?)", "siisi", $arr);
  $basicArray['spProfiles_idspProfiles'] = $pid;
  $proArr = [];
  $proArr[] = $pid;
  if(!empty($basicArray['carrerhighlight'])){
    $proArr[] = $basicArray['carrerhighlight'];
  } else {
    errorOut("Carrer highlights cannot be empty");
  }
  if(!empty($basicArray['category'])){
    $proArr[] = $basicArray['category'];
  } else {
    errorOut("Carrer Category cannot be empty");
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
unset($basicArray['spProfileName']);
unset($basicArray['carrerhighlight']);
unset($basicArray['category']);

$idspPostings = !empty($basicArray["idspPostings"]) ? (int)$basicArray["idspPostings"] : "";
$edit = false;
if ($idspPostings) {
  $p->update($basicArray, "WHERE t.idspPostings =" . $idspPostings);
  $postid = $idspPostings;
  $edit = true;
} else {

  $postid = $p->post($basicArray);
  
  $fr = new _spuser;
  $readsp = $fr->readdataSp($_SESSION['pid']);
  if($readsp != false){
    $rowsp = mysqli_fetch_assoc($readsp);
    if($rowsp){
      if($rowsp['post_pay'] > 0 ){
        $fr->readdataAdd($rowsp['post_pay']-1, $rowsp['idspProfiles']);
      }
    }
  }

}

addHighlights($postid, $edit);

spPostingPicStorage($postid, $allS3SpPostingPic, $edit);

spSellerProfilePic($postid, $allS3SellerPic, $edit);

//storeCustomFields($postid);

successOut(['postid' => $postid]);


/**
 * To add Highlights
 *
 * @param Int - $postid - The postId
 * @param Bool - $edit - to check if edit
 */
function addHighlights($postid, $edit){

  $Highlights = !empty($_POST['Highlights']) ? $_POST['Highlights'] : "";
  $postedit = !empty($_POST['postedit']) ? $_POST['postedit'] : "";
  
  if(!$Highlights){
    return false;
  }

	$pf = new _postfield;
	
	$spPostFieldLabel = "high lights";
	$spPostFieldName = "spPostHighLit_";
	$spCategories_idspCategory = 3;


	$allHighlight = array();
	$allHighlight = explode(',', $Highlights);

	if($postedit == "true"){		
		$pf->removeSponsor($postid, $spPostFieldLabel);
	}
  
  if(count($allHighlight) > 0){
		foreach ($allHighlight as $key => $value) {
			$pf->createSize($spPostFieldLabel, $spPostFieldName, $postid, $spCategories_idspCategory, $value);
		}
	}

}


/**
 * To upload images in S3
 *
 * @param Int - $postid - The postId
 * @param Array - $allS3SpPostingPic - List of URLs
 * @param Bool - $edit - to check if edit
 */
function spPostingPicStorage($postId, $allS3SpPostingPic, $edit){
  
  if(!empty($allS3SpPostingPic)){
    $p = new _realstatepic;

    foreach($allS3SpPostingPic as $k => $one){
      if(isset($_POST['spFeatureimg'][$k])){
	      $FeatureImg = $_POST['spFeatureimg'][$k];
      }else{
	      $FeatureImg = 0;
      }
      $p->createPic($postId, $one['url'], $FeatureImg);
    }
  }
}

/**
 * To upload seller images in S3
 *
 * @param Int - $postid - The postId
 * @param Array - $allS3SellerPic - List of URLs
 * @param Bool - $edit - to check if edit
 */
function spSellerProfilePic($postId, $allS3SellerPic, $edit){
  if(!empty($allS3SellerPic) && !empty($allS3SellerPic[0]['url'])){
    $data1 = array(
      'saller_picture'=>$allS3SellerPic[0]['url']
    );

    $p = new _realstatepic;
    $p->update_img($data1, $postId);
  }
}


function storeCustomFields($postId){
  $c = new _postfield;
  
  print_r($_POST);die;
	
	$postedit = !empty($_POST['postedit']) ? $_POST['postedit'] : "";
	  
  if($postedit){
	  $r = $c->readpostfield($postId);
	  if($r != false){
		  while($row = mysqli_fetch_assoc($r)){
			  $c->update(array("spPostFieldValue" => $_POST["spPostFieldValue"]), "WHERE spPostFieldLabel = '" . $_POST["spPostFieldLabel"] . "' AND spPostings_idspPostings =". $postId);
			  
		  }
	  }
  }
  else{
    $data = [
      
    ];
    $c->create($data);
  }

}


?>
