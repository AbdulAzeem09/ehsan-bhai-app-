<?php

include('../univ/baseurl.php');
session_start();

if(!isset($_SESSION['pid'])){ 
//
  include_once ("../authentication/check.php");
  $_SESSION['afterlogin']="timeline/";
}

function sp_autoloader($class) {
  include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


$postid = isset($_GET["postid"]) ? (int) $_GET["postid"] : 0;

$re = new _redirect;
$p = new _postingview;
$pf  = new _postfield;
$pr = new _realstateposting;
$result = $pr->singletimelines($postid);

$spPostRentalNight = 0; //default set

if($result != false){ 
  $row = mysqli_fetch_assoc($result); 
  $propertyType = $row['spPostingPropertyType'];
  $postDate = $row['spPostingDate'];
//echo $propertyType."gggggggggg";

}
$_GET["categoryID"] = "3";
$_GET["categoryName"] = "Realestate";
if($postid >0){

  $renter = $p->renter_id1($postid);

//print_r($renter);
//die('-------');
  $renter_row = mysqli_fetch_assoc($renter);


  $renter_id1 = $renter_row['spProfiles_idspProfiles'];
// echo $_SESSION['pid'];
// if ($_SESSION['pid'] == $renter_id) {
//     echo "hello";
// }

// print_r($renter_id);
// exit;
  if($result != false){
//die('-----------');

//print_r($row); die("-----------");
// echo $renter_id['spProfiles_idspProfiles'];
// exit;
    $ProTitle   = $row['spPostingTitle'];

    $ProDes     = $row['spPostingNotes'];
    $rentby     = $row['spPostingRentBy'];
    $OwnerName  = $row['spProfileName'];
    $OwnerId    = $row['idspProfiles'];
    $OwnerAbout = $row['spProfileAbout'];
    $OwnerPic   = $row['spProfilePic'];
    $OwnerEmail = $row['spProfileEmail'];
    $OwnerPhone = $row['spProfilePhone'];
    $price      = $row['spPostingPrice'];
    $country    = $row['spPostingsCountry'];
    $city       = $row['spPostingsCity'];
    $postDate   = $row['spPostingDate'];
    $defaltcurrency = $row['defaltcurrency'];
    $meal_yes = rtrim($row['spPostingYes'],",");
    $meal_include = $row['spPostingMeal'];
//$spPostingYes = $row['spPostingYes'];
    $BreakFast = $row['BreakFast'];
    $Lunch = $row['Lunch'];
    $Dinner = $row['Dinner'];

    $spPostAgencyFee = $row["spPostAgencyFee"];
    $spPostingServicChrg = $row["spPostingServicChrg"];
    $spPostingCleaningChrg = $row["spPostingCleaningChrg"];

    $spPostRentalMonth = $row["spPostRentalMonth"];
    $spPostRentalWeek = $row["spPostRentalWeek"];
    $spPostRentalNight = $row["spPostRentalNight"];
    $spPostRoomType = $row["spRoomRent"];
    $address = $row["spPostingAddress"];



    $spPostAvailFrom =	$row['spPostAvailFrom'];
    $spPostAvailTo = $row['spPostAvailTo'];
    $lotSize = $row['lotSize'];

    $result_pf = $pr->read($row['idspPostings']);
//echo $pf->ta->sql."<br>";
    if($result_pf){
      $address        = "";
      $propertyId     = "";
      $propertyType   = "";
      $bedroom        = "";
      $bathroom       = "";
      $proStatus      = "";
      $postalCode     = "";
      $yearBuilt      = "";
      $basement       = "";
      $squarefoot     = "";
      $unitNumber     = "";
      $taxAmt         = "";
      $taxYear        = "";
      $housStylle     = "";
      $keyword        = "";
      $availabitlyFrm = "";
      $availabitlyTo  = "";
      $rentduration   = "";
// new fields add
      $Furnishing     = "";
      $Rent_By        = "";
      $Rental_By      = "";
      $Status         = "";
      $Agency_Fee     = "";
      $Deposit_Amount = "";
      $Dogs           = "";
      $Cats           = "";
      $Smoking        = "";
      $Lease_Term     = "";
      $Stainless_Steel_Appliances     = "";
      $Central_Air_Conditioning       = "";
      $Lots_of_Closet_Space           = "";
      $Open_Floor_Plan                = "";
      $Building_Amenities             = "";
      $Washer_Dryer                   = "";
      $Spacious_Backyard              = "";
      $Garage_Parking                 = "";
      $JETTED_tub_acuzzi              = "";
      $Swimming_Pool    = "";
      $Bed_type = "";
      $Rent_To_Own    = "";
      $Fireplace    = "";
      $Balcony    = "";
      $Fenced_Backyard    = "";
      $Fitness_Area     = "";
      $Storage    = "";
      $Close_to_Public_Transportation   = "";
      $Heat      = "";
      $Water     = "";
      $Electricity   = "";
      $Cable_Tv      = "";
      $Internet      = "";
      $Security_Camera    = "";
      $Controlled_Access_Lobby    = "";
      $Fitness_Fully_Equipped_Gym   = "";
      $Concierge     = "";
      $Elevator      = "";
      $On_Site_Convenience_Store      = "";
      $Parking    = "";
      $Professional_Building_Management_On_Site   = "";
      $roomType = "";
      $RentalWeek = "";
      $RentalMonth = "";
      $RentaNight = "";
      $cleaningFee = 0;
      $serviceFee = 0;
      $roomShared = "";


      while ($row2 = mysqli_fetch_assoc($result_pf)) {
//echo '<pre>';
//print_r($row2);
//echo '<pre>';
//echo $row2['spPostFieldName'];

//var_dump($row2);
        if($roomShared == ''){
          if($row2['spPostFieldName'] == 'spPostRoomType_' || $row2['spPostFieldName'] == 'spPostRoomType'){
            $roomShared = $row2['spPostFieldValue'];
          }
        }

/*if($meal_include == ''){
if($row2['spPostFieldName'] == 'spPostingMeal'){
echo  $meal_include = $row2['spPostFieldValue'];
}
}*/
if($cleaningFee == 0){
  if($row2['spPostFieldName'] == 'spPostingCleaningChrg_' || $row2['spPostFieldName'] == 'spPostingCleaningChrg'){
    $cleaningFee = $row2['spPostFieldValue'];
  }
}
if($serviceFee == 0){
  if($row2['spPostFieldName'] == 'spPostingServicChrg_' || $row2['spPostFieldName'] == 'spPostingServicChrg'){
    $serviceFee = $row2['spPostFieldValue'];
  }
}
if($RentalWeek == ''){
  if($row2['spPostFieldName'] == 'spPostRentalWeek_' || $row2['spPostFieldName'] == 'spPostRentalWeek'){
    $RentalWeek = $row2['spPostFieldValue'];
  }
}
if($RentaNight == ''){
  if($row2['spPostFieldName'] == 'spPostRentalNight_' ||$row2['spPostFieldName'] == 'spPostRentalNight'){
    $RentaNight = $row2['spPostFieldValue'];
  }
}
if($RentalMonth == ''){
  if($row2['spPostFieldName'] == 'spPostRentalMonth_' || $row2['spPostFieldName'] == 'spPostRentalMonth'){
    $RentalMonth = $row2['spPostFieldValue'];
  }
}


if($roomType == ''){
  if($row2['spPostFieldName'] == 'spRoomRent_' || $row2['spPostFieldName'] == 'spRoomRent'){
    $roomType = $row2['spPostFieldValue'];
  }
}
if($Heat == ''){
  $Heat = $row2['spPostHeat'];
}
if($Water == ''){
  $Water = $row2['spPostWater'];
}
if($Electricity == ''){
  $Electricity = $row2['spPostElect'];
}
if($Cable_Tv == ''){
  $Cable_Tv = $row2['spPostCableTv'];
}
if($Internet == ''){
  $Internet = $row2['spPostInternet'];
}

if($Security_Camera == ''){
  $Security_Camera = $row2['spPostSecurtyCam'];
}
if($Controlled_Access_Lobby == ''){
  $Controlled_Access_Lobby = $row2['spPostCntrlAces'];
}

if($Fitness_Fully_Equipped_Gym == ''){
  $Fitness_Fully_Equipped_Gym = $row2['spPostFulyEquipedGym'];
}
if($Concierge == ''){
  $Concierge = $row2['spPostConcierge'];
}

if($Elevator == ''){
  $Elevator = $row2['spPostElevator'];
}

if($On_Site_Convenience_Store == ''){
  $On_Site_Convenience_Store = $row2['spPostOnsiteStore'];
}

if($Parking == ''){
  $Parking = $row2['spPostParking'];
}
if($Professional_Building_Management_On_Site == ''){
  $Professional_Building_Management_On_Site = $row2['spPostProfBuild'];
}
if($Fitness_Area == ''){
  $Fitness_Area = $row2['spPostFitnesArea'];
}
if($Storage == ''){
  $Storage = $row2['spPostStorage'];
}
if($Close_to_Public_Transportation == ''){
  $Close_to_Public_Transportation = $row2['spPostClosePublic'];
}
if($Swimming_Pool == ''){
  $Swimming_Pool = $row2['spPostSwimPool'];
}

if ($Bed_type == '') {
  if($row2['spPostBedType'] != 'Select any option'){
    $Bed_type = $row2['spPostBedType'];
  }
}
if($Rent_To_Own == ''){
  $Rent_To_Own = $row2['spPostRentOwn'];
}
if($Fireplace == ''){
  if($row2['spPostFirePlace'] == 'Yes' || $row2['spPostFirePlace'] == 'No'){
    $Fireplace = $row2['spPostFirePlace'];
  }
}
if($Balcony == ''){
  $Balcony = $row2['spPostBalcony'];
}
if($Fenced_Backyard == ''){
  $Fenced_Backyard = $row2['spPostFenced'];
}
if($Washer_Dryer == ''){
  if($row2['spPostWasher'] == 'Yes' || $row2['spPostWasher'] == 'No'){
    $Washer_Dryer = $row2['spPostWasher'];
  }
}
if($Spacious_Backyard == ''){
  if($row2['spPostSpacious'] == 'Yes' || $row2['spPostSpacious'] == 'No'){
    $Spacious_Backyard = $row2['spPostSpacious'];
  }
}
if($Garage_Parking == ''){
  if($row2['spPostGargParking'] == 'Yes' || $row2['spPostGargParking'] == 'No'){
    $Garage_Parking = $row2['spPostGargParking'];
  }
}
if($JETTED_tub_acuzzi == ''){
  if($row2['spPostJettedTub'] == 'Yes' || $row2['spPostJettedTub'] == 'No'){
    $JETTED_tub_acuzzi = $row2['spPostJettedTub'];
  }
}  
if($Stainless_Steel_Appliances == ''){
  if($row2['spPostStainless'] == 'Yes' || $row2['spPostStainless'] == 'No'){
    $Stainless_Steel_Appliances = $row2['spPostStainless'];
  }
}
if($Central_Air_Conditioning == ''){
  if($row2['spPostCentralAir'] == 'Yes' || $row2['spPostCentralAir'] == 'No'){
    $Central_Air_Conditioning = $row2['spPostCentralAir'];
  }
}

if($Lots_of_Closet_Space == ''){
  if($row2['spPostLotsCloset'] == 'Yes' || $row2['spPostLotsCloset'] == 'No'){
    $Lots_of_Closet_Space = $row2['spPostLotsCloset'];
  }
}
if($Open_Floor_Plan == ''){
  if($row2['spPostOpenFloor'] == 'Yes' || $row2['spPostOpenFloor'] == 'No'){
    $Open_Floor_Plan = $row2['spPostOpenFloor'];
  }
}
if($Building_Amenities == ''){
  if($row2['spPostBuildAment'] == 'Yes' || $row2['spPostBuildAment'] == 'No'){
    $Building_Amenities = $row2['spPostBuildAment'];
  }
}
// if($Deposit_Amount == ''){
//     if($row2['spPostFieldName'] == 'spPostAvailFrom_'){
//         $Deposit_Amount = $row2['spPostFieldValue'];
//     }
// }
if($Dogs == ''){
  if($row2['spPostDog'] == 'Yes' || $row2['spPostDog'] == 'No'){
    $Dogs = $row2['spPostDog'];
  }
}
if($Cats == ''){
  if($row2['spPostCat'] == 'Yes' || $row2['spPostCat'] == 'No'){
    $Cats = $row2['spPostCat'];
  }
}
if($Smoking == ''){
  if($row2['spPostSmoke'] == 'Yes' || $row2['spPostSmoke'] == 'No'){
    $Smoking = $row2['spPostSmoke'];
  }
}
if($Lease_Term == ''){
  if($row2['spPostFieldName'] == 'spPostLeaseTerm_' || $row2['spPostFieldName'] == 'spPostLeaseTerm'){
    $Lease_Term = $row2['spPostFieldValue'];
  }
}
if($Furnishing == ''){
  if($row2['spPostFurnish'] == 'Furnished' || $row2['spPostFurnish'] == 'Unfurnished'){
    $Furnishing = $row2['spPostFurnish'];
  }
}
// if($Rent_By == ''){
//     if($row2['spPostFieldName'] == 'spPostAvailFrom_'){
//         $Rent_By = $row2['spPostFieldValue'];
//     }
// }
if($Rental_By == ''){
  if($row2['spPostFieldName'] == 'spPostRentalBy_' || $row2['spPostFieldName'] == 'spPostRentalBy'){
    $Rental_By = $row2['spPostFieldValue'];
  }
}
if($Status == ''){
  $Status = $row2['spPostingPropStatus'];
}
if($Agency_Fee == ''){
  if($row2['spPostFieldName'] == 'spPostAgencyFee_' || $row2['spPostFieldName'] == 'spPostAgencyFee'){
    $Agency_Fee = $row2['spPostFieldValue'];
  }
}



if($availabitlyFrm == ''){
  $availabitlyFrm = $row2['spPostAvailFrom'];
}
if($availabitlyTo == ''){
  $availabitlyTo = $row2['spPostAvailTo'];
}
if($proStatus == ''){
  if($row2['spPostFieldName'] == 'spPostingPropStatus_' || $row2['spPostFieldName'] == 'spPostingPropStatus'){
    $proStatus = $row2['spPostFieldValue'];
  }
}
if($keyword == ''){
  if($row2['spPostFieldName'] == 'spPostingkeyword_' || $row2['spPostFieldName'] == 'spPostingkeyword'){
    $keyword = $row2['spPostFieldValue'];
  }
}
if($housStylle == ''){
  if($row2['spPostFieldName'] == 'spPostingHouseStyle_' || $row2['spPostFieldName'] == 'spPostingHouseStyle'){
    $housStylle = $row2['spPostFieldValue'];
  }
}
if($taxYear == ''){
  if( $row2['spPostFieldName'] == 'spPostTaxYear_' || $row2['spPostFieldName'] == 'spPostTaxYear'){
    $taxYear = $row2['spPostFieldValue'];
  }
}
if($taxAmt == ''){
  if($row2['spPostFieldName'] == 'spPostTaxAmt_' || $row2['spPostFieldName'] == 'spPostTaxAmt'){
    $taxAmt = $row2['spPostFieldValue'];
  }
}
if($unitNumber == ''){
  if($row2['spPostFieldName'] == 'spPostUnitNum_' || $row2['spPostFieldName'] == 'spPostUnitNum'){
    $unitNumber = $row2['spPostFieldValue'];
  }
}
if($squarefoot == ''){
  $squarefoot = $row2['spPostingSqurefoot'];
}
if($basement == ''){
  if($row2['spPostFieldName'] == 'spPostBasement_' || $row2['spPostFieldName'] == 'spPostBasement'){
    $basement = $row2['spPostFieldValue'];
  }
}
if($yearBuilt == ''){
  if($row2['spPostFieldName'] == 'spPostingYearBuilt_' || $row2['spPostFieldName'] == 'spPostingYearBuilt'){
    $yearBuilt = $row2['spPostFieldValue'];
  }
}
if($postalCode == ''){
  if($row2['spPostFieldName'] == 'spPostingPostalcode_' || $row2['spPostFieldName'] == 'spPostingPostalcode'){
    $postalCode = $row2['spPostFieldValue'];
  }
}
if($bathroom == ''){
  $bathroom = $row2['spPostingBathroom'];
}
if($bedroom == ''){
  $bedroom = $row2['spPostingBedroom'];
}
if($address == ''){
  if($row2['spPostFieldName'] == 'spPostingAddress_' || $row2['spPostFieldName'] == 'spPostingAddress'){
    $address = $row2['spPostFieldValue'];
  }
}
if($propertyId == ''){
  if($row2['spPostFieldName'] == 'spPostListId_' || $row2['spPostFieldName'] == 'spPostListId'){
    $propertyId = $row2['spPostFieldValue'];
  }
}
if($propertyType == ''){
  $propertyType = $row2['spPostingPropertyType'];
}
if($rentduration == ''){
  if($row2['spPostDurstion'] != 'Select rent duration'){
    $rentduration = $row2['spPostDurstion'];
  }
}

}
$availFrom = strtotime($availabitlyFrm);
$availTo = strtotime($availabitlyTo);
}

if ($meal_include == 'Select any option') {
  $meal_include = "";
} 
else {
  if ($meal_include == 'yes') {
    
    // Check the values of breakfast, lunch, and dinner   
    if ($BreakFast == 1) {
      $meal_include .= " - Breakfast";
    }
    if ($Lunch == 1) {
      $meal_include .= " - Lunch";
    }
    if ($Dinner == 1) {
      $meal_include .= " - Dinner";
    }
  }
}

if($rentby == 'Select any option'){
  $rentby = "";
}
else{
  $rentby = $row['spPostingRentBy'];
}

	
}

}else{
  $redirctUrl = $BaseUrl."/real-estate";
  $re->redirect($redirctUrl);
}
$header_realEstate = "realEstate";
$rc = new _country; 
$result_cntry = $rc->readCountryName($country);
if ($result_cntry) {
  $row4 = mysqli_fetch_assoc($result_cntry);
  $countryName = $row4['country_title'];
}else{
  $countryName = "";
}

$rcty = new _city;
$result_cty = $rcty->readCityName($city);
if ($result_cty) {
  $row5 = mysqli_fetch_assoc($result_cty);
  $cityName = $row5['city_title'];
}else{
  $cityName = "";
}
?>
<!DOCTYPE html>
<html lang="en-US">




<head>
  <?php include('../component/links.php');?>
  <?php include('../component/f_links.php');?>
  <!--This script for posting timeline data Start-->
  <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
  <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>

  <!--This script for posting timeline data End-->
  <!-- this is for google map show -->

  <!-- this is for google map show -->
  <!-- this script for carousel -->
  <script type="text/javascript">
/*
jQuery(document).ready(function($) {
$('#myCarousel').carousel({
interval: 5000
});         
$('#carousel-text').html($('#slide-content-0').html());
//Handles the carousel thumbnails
$('[id^=carousel-selector-]').click( function(){
var id = this.id.substr(this.id.lastIndexOf("-") + 1);
var id = parseInt(id);
$('#myCarousel').carousel(id);
});
// When the carousel slides, auto update the text
$('#myCarousel').on('slid.bs.carousel', function (e) {
var id = $('.item.active').data('slide-number');
$('#carousel-text').html($('#slide-content-'+id).html());
});
});
*/
  </script>
  <!-- this script for carousel -->
  <!-- date-range start -->
  <link rel="stylesheet" type="text/css" media="all" href="<?php echo $BaseUrl;?>/assets/css/date-time/daterangepicker.css" />
  <script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/css/date-time/moment.min.js"></script>
  <script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/css/date-time/daterangepicker.js"></script>
  <script src="<?php echo $BaseUrl;?>/assets/js/home.js"></script>

  <!-- date-range end   -->
  <?php
  $pc = new _realstatepic;
  $res = $pc->readFeature($postid);
//echo $pc->ta->sql;
  if ($res != false) {
    while($postr = mysqli_fetch_assoc($res)){
      $picture = $postr['spPostingPic']; 
      if(isset($picture)){
      }else{ 
        $picture = "../img/no.png";
      }
    }
  }else{
    $picture = "../img/no.png";
  }
  ?>	
  <?php	$p = new _postingview;
  $r = $p->read($postid);

  if ($r != false) {
    while ($row = mysqli_fetch_assoc($r)) {
// print_r($row);
// exit;
      $prop_data = array();
      echo "<input type='hidden' id='postprofile' value='" . $row["idspProfiles"] . "'>";
      $spPostAvailTo=$row["spPostAvailTo"];
// echo  $spPostAvailTo;
      $spPostAvailFrom=$row["spPostAvailFrom"];
    }
  }
  ?>













  <style>




    .avialable{
      background-color: #95f395;
    }

    html {
      font-family: sans-serif;
      font-size: 15px;
      line-height: 1.4;
      color: #444;
    }

    body {
      overflow-x:hidden;
      margin: 0;
      background: #504f4f;
      font-size: 1em;
    }

    .wrapper {
      margin: 15px auto;
      max-width: 1100px;
    }

    .container-calendar {
      background: #ffffff;
      padding: 15px;
      max-width: 475px;
      margin: 0 auto;
      overflow: auto;
    }

    .button-container-calendar button {
      cursor: pointer;
      display: inline-block;
      zoom: 1;
      background: #00a2b7;
      color: #fff;
      border: 1px solid #0aa2b5;
      border-radius: 4px;
      padding: 5px 10px;
    }

    .table-calendar {
      border-collapse: collapse;
      width: 100%;
    }

    .table-calendar td, .table-calendar th {
      padding: 5px;
      border: 1px solid #e2e2e2;
      text-align: center;
      vertical-align: top;
    }

    .date-picker.selected {
      font-weight: bold;
      outline: 1px dashed #00BCD4;
    }

    .date-picker.selected span {
      border-bottom: 2px solid currentColor;
    }

/* sunday */
.date-picker:nth-child(1) {
  color: black;
}

/* friday */
.date-picker:nth-child(6) {
  color: black;
}

#monthAndYear {
  text-align: center;
  margin-top: 0;
}

.button-container-calendar {
  position: relative;
  margin-bottom: 1em;
  overflow: hidden;
  clear: both;
}

#previous {
  float: left;
}

#next {
  float: right;
}

.footer-container-calendar {
  margin-top: 1em;
  border-top: 1px solid #dadada;
  padding: 10px 0;
}

.footer-container-calendar select {
  cursor: pointer;
  display: inline-block;
  zoom: 1;
  background: #ffffff;
  color: #585858;
  border: 1px solid #bfc5c5;
  border-radius: 3px;
  padding: 5px 1em;
}

.realTopBread {
  padding: 20px;

  <!--background-image:url //echo $picture; ?>);-->

/*background-color: red;*/
background-size: cover;
background-repeat: no-repeat;
/*background-size: auto;*/
background-size: 100% 100%;

}


.form-control:focus {
  border-color: #66afe9;
  outline: 0;
  -webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%), 0 0 8px rgb(102 175 233 / 60%);
  box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%), 0 0 8px rgb(102 175 233 / 60%);
}
</style>

</head>

<body class="bg_gray">
  <?php include_once("../header.php");?>
  <section class="realTopBread " >



    <div class="container">
      <div class="row">
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPpH4FGQaj_JIJOViHAeHGAjl7RDeW8OQ&libraries=places"></script>
        <div class="col-md-8">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">

                <label for="spPostingAddress_" class="lbl_16">Location</label>

                <input type="text" class="form-control spPostField iconss" data-filter="0" id="spPostingAddress_" name="txtAddress" value="<?php  echo (isset($_SESSION['txtAddress']) && $_SESSION['txtAddress'] != '')?$_SESSION['txtAddress']:'';?>" autocomplete="off" maxlength="40"  required />

              </div>
            </div>

            <script>
              var input = document.getElementById('spPostingAddress_');
              var autocomplete = new google.maps.places.Autocomplete(input);
            </script>

            <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
            <?php if($_SESSION['rent_session__realestate'] == '1'){?>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="dt1" class="lbl_3">Check IN</label>
                  <input type="text" name="fromdate" class="form-control" id="dt1" value="<?php echo $_SESSION['checkin_realestate']; ?>" autocomplete="off"  required />
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="dt2" class="lbl_3">Check OUT</label>
                  <input type="text" name="todate" class="form-control" id="dt2" value="<?php echo $_SESSION['checkout_realestate']; ?>" autocomplete="off"  required />
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label class="">Guests</label>
                  <select class="form-control" name="guests">
                    <option value="1" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '1')?'selected':'';?> >1</option>
                    <option value="2" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '2')?'selected':'';?> >2</option>
                    <option value="3" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '3')?'selected':'';?>>3</option>
                    <option value="4" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '4')?'selected':'';?>>4</option>
                    <option value="5" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '5')?'selected':'';?>>5</option>
                    <option value="6" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '6')?'selected':'';?>>6</option>
                    <option value="7" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '7')?'selected':'';?>>7</option>
                    <option value="8" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '8')?'selected':'';?>>8</option>
                    <option value="9" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '9')?'selected':'';?>>9</option>
                    <option value="10" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '10')?'selected':'';?>>10</option>
                    <option value="11" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '11')?'selected':'';?>>11</option>
                    <option value="12" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '12')?'selected':'';?>>12</option>
                    <option value="13"  <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '13')?'selected':'';?>>13</option>
                    <option value="14" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '14')?'selected':'';?>>14</option>
                    <option value="15" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '15')?'selected':'';?>>15</option>
                    <option value="16" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '16')?'selected':'';?>>16</option>
                  </select>
                </div>
              </div>
            <?php }?>




            <?php if($_SESSION['rent_session__realestate'] == '2'){?>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="dt1" class="lbl_3">Starting Date</label>
                  <input type="text" name="fromdate" class="form-control" id="dt1" value="<?php echo $_SESSION['checkin_realestate']; ?>" autocomplete="off"  required />
                </div>
              </div>
<!--<div class="col-md-3">
<div class="form-group">
<label for="dt2" class="lbl_3">Check OUT</label>
<input type="text" name="todate" class="form-control" id="dt2" value="<?php //echo $_SESSION['checkout_realestate']; ?>" autocomplete="off"  required />
</div>
</div>-->
<div class="col-md-2">
  <div class="form-group">
    <label class="">No.of People</label>
    <select class="form-control" name="guests">
      <option value="1" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '1')?'selected':'';?> >1</option>
      <option value="2" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '2')?'selected':'';?> >2</option>
      <option value="3" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '3')?'selected':'';?>>3</option>
      <option value="4" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '4')?'selected':'';?>>4</option>
      <option value="5" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '5')?'selected':'';?>>5</option>
      <option value="6" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '6')?'selected':'';?>>6</option>
      <option value="7" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '7')?'selected':'';?>>7</option>
      <option value="8" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '8')?'selected':'';?>>8</option>
      <option value="9" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '9')?'selected':'';?>>9</option>
      <option value="10" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '10')?'selected':'';?>>10</option>
      <option value="11" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '11')?'selected':'';?>>11</option>
      <option value="12" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '12')?'selected':'';?>>12</option>
      <option value="13"  <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '13')?'selected':'';?>>13</option>
      <option value="14" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '14')?'selected':'';?>>14</option>
      <option value="15" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '15')?'selected':'';?>>15</option>
      <option value="16" <?php echo (!empty($_SESSION['No_of_People']) && $_SESSION['No_of_People'] == '16')?'selected':'';?>>16</option>
    </select>
  </div>
</div>
<?php }?>


<div class="col-md-1">
  <div class="form-group text-center">
    <input style="margin-top: 26px;border-radius: 3px;" type="submit" class="btn" name="btnAdresSearch" value="Search"> 
  </div> </div>
</div> </div> 
<div class="col-md-4">
  <div class="row">
    <div class="col-md-7">
    </div>
    <div class="col-md-2"style="margin-top:31px;">

      <a href="<?php echo $BaseUrl.'/real-estate/';?>"style="color:white">Home</a>
    </div>
    <?php if($_SESSION['guet_yes'] != 'yes'){ ?>

      <div class="col-md-3"style="margin-top:26px;">
        <a href="<?php echo $BaseUrl.'/real-estate/dashboard/';?>" class="btn butn_dash_real"><i class="fa fa-dashboard"></i> Dashboard</a>
        </div>  <?php } ?>
      </div> </div>  
    </div>
  </div>
  <div class="layerPrprtyTop">
    <ul>
      <li>Room <span><?php echo $roomType;?></span></li>
      <li>Property Id <span>Room<?php echo $postid ;?></span></li>
      <li>PROPERTY TYPE <span><?php echo $propertyType;?></span></li>
      <li>Updated ON <span><?php echo $postDate;?></span></li>
    </ul>
  </div>
</div>
</section>
<div class="container">
  <div class="row top_pro_detail">
    <div class="col-md-8 m_top_15">
      <h2><?php echo ucwords(strtolower($ProTitle));?></h2>
      <p><?php echo $address;?></p>

    </div>
    <div class="col-md-4 text-right flagListing">
      <div class="text-right bokmarktabsssss">
        <div id="sssssssssssssss<?php echo $postid ; ?>">
          <?php
          $fv = new _favorites;
          $res_fv = $fv->chekFavourite($postid , $_SESSION['pid'], $_SESSION['uid']);
//echo $fv->ta->sql;
          if($res_fv != false){ ?>
            <button class="btn btn-outline-primary btn-sm" id="remtofavoritesevent" data-postid="<?php echo $postid;?>" data-pid="<?php echo $_SESSION['pid'];?>"  >
              <span id="removetofavouriteeve"><i class="fa fa-heart"></i></span>
            </button>
          <?php }else{ ?>
            <button class="btn btn-outline-primary btn-sm" id="addtofavouriteevent" data-postid="<?php echo $postid ;?>" data-pid="<?php echo $_SESSION['pid'];?>"  >
              <span id="addtofavouriteeve"><i class="fa fa-heart-o"></i></span>
            </button>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>


<div id="flagPost" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <form method="post" action="addtoflag.php" class="sharestorepos">
      <div class="modal-content no-radius">
        <input type="hidden" name="spPosting_idspPosting" value="<?php echo $postid;?>">
        <input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
        <input type="hidden" name="spCategory_idspCategory" value="<?php echo $_GET['categoryID']?>">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Flag Post</h4>
        </div>
        <div class="modal-body">
          <div class="radio">
            <label><input type="radio" name="why_flag" value="Duplicate post" checked="">Duplicate post</label>
          </div>
          <div class="radio">
            <label><input type="radio" name="why_flag" value="Posting Violation">Posting Violation</label>
          </div>
          <div class="radio">
            <label><input type="radio" name="why_flag" value="Suspicious Post">Suspicious Post</label>
          </div>
          <div class="radio">
            <label><input type="radio" name="why_flag" value="Copied My Post">Copied My Post</label>
          </div> 

          <!-- <label>Why flag this post?</label> -->
          <textarea required class="form-control" name="flag_desc" placeholder="Add Comments"></textarea>
        </div>
        <div class="modal-footer">
          <input type="submit" name="" class="btn butn_mdl_submit ">
          <button type="button" class="btn butn_cancel" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

<section class="" style="padding: 0px 30px 30px;">
  <div class="container">
    <style>
      .carousel-control.left {
        background-image: none;
      }

      .carousel-control.right  {
        background-image: none;
      }
      #myCarousel .item {
        height: 435px !important;
        overflow: hidden;
      }
    </style>    




    <div class="bg_white setupProperty">
      <div class="row">
        <div class="col-md-8">
          <div class="product_slider_box social" style="height: 435px;" >


            <div id="myCarousel" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <?php
                $pc = new _realstatepic;
                $res = $pc->read($postid);
//echo $pc->ta->sql;
                $active1 = 0;
                if ($res != false) {
                  $active2 = 0;
                  while($postr = mysqli_fetch_assoc($res)){
                    $picture = $postr['spPostingPic']; 
                    if($active2 == 0){
                      $pic = 'active';
                    }else{
                      $pic = '';
                    }
                    if(isset($picture)){

                    }else{ 
                      $picture = "../img/no.png";
                    }
                    echo  '<div class="item '.$pic.'">
                    <img src="'.$picture.'" alt="Los Angeles" style="width:100%;">
                    </div>';

                    $active2++;
                  }
                }else{?>
                  <img src="../img/no.png" alt="Posting Pic" class="img-responsive" style="margin: 0 auto;" ><?php
                }
                ?>

              </div>

              <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>

          </div>
        </div>
        <div class="col-md-4">
          <div class="rightProperty">
            <div class="row">
              <div class="col-md-6 hidden">
<!-- <h2 class="leftH">Contact Agent for this property</h2>
<form method="post" action="sendEnquiry.php" class="enqRealForm editPostTimeline">
<input type="hidden" name="spPosting_idspPosting" value="<?php echo $_GET['postid'];?>">
<input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid'];?>">
<input type="hidden" name="sprealType" value="1">
<input type="text" name="sprealName" class="form-control" placeholder="Full Name" required="">
<input type="email" name="sprealEmail" class="form-control" placeholder="Email" required="">
<input type="text" name="sprealPhone" class="form-control" placeholder="Phone" required="">
<textarea class="form-control" name="sprealMessage" placeholder="I'm Intrested in this...."></textarea>
<input type="submit" value="Send Enquiry" class="btn <?php echo ($_SESSION['pid'] == $OwnerId )?'disabled':'';?> " <?php echo ($_SESSION['pid'] == $OwnerId )?'disabled':'';?>>
</form> -->

<div class="space-md"></div>


</div>

<?php  	
//if ($_SESSION['pid'] != $renter_id1 ) { ?> 
  <div class="col-md-12">
    <div class="rightBoxpro">
      <h2 class="rightH"   style="background-color: #83a532;"><i class="fa fa-calculator"></i> Calculate Price</h2>
      <?php
      if($roomType == 'Rent A Room'){
        ?>
        <form method="post" action="bookNow.php">
          <input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
          <input type="hidden" name="spPosting_idspPosting" value="<?php echo $postid;?>">
          <input type="hidden" name="rs_roomType" value="<?php echo $roomType;?>">
          <input type="hidden" name="spMonth" id="bookMonth" value="Night">
          <input type="hidden" name="spCheckInDate" id="spCheckInDate" value="<?php echo $spPostAvailFrom ?>">
          <input type="hidden" name="spCheckOutDate" id="spCheckOutDate" value="<?php echo $spPostAvailTo ?>" >

          <div class="row">
            <div class="col-md-6">
              <label>Check In Date </label>
              <!-- <input type="text" class="form-control" id="config-demo" value="" >-->
              <!-- <input type="date" class="form-control" name="spCheckInDate" id="demo-9" value="<?php echo date('Y-m-d');?>" >-->
              <input type="text" name="spCheckInDate" id="date" class="indate form-control" readonly="readonly"  value="<?php echo date('m/d/Y');?>" size="12" />
            </div>
            <?php
            $p = new _postingview;
            $result = $p->single_product_detail($postid);
            $row = mysqli_fetch_assoc($result);


            $period = new DatePeriod(
              new DateTime($row['spPostAvailFrom']),
              new DateInterval('P1D'),
              new DateTime($row['spPostAvailTo'])


            );



            ?>
            <script>
              jQuery(document).ready(function($) {
                var availableDates = [ <?php foreach ($period as $key => $value) { echo '"'.$value->format("j-n-Y").'",'  ; } ?>"30-3-2022"];

                function available(date) {
                  dmy = date.getDate() + "-" + (date.getMonth()+1) + "-" + date.getFullYear();
                  if ($.inArray(dmy, availableDates) != -1) {
                    return [true, "","Available"];
                  } else {
                    return [false,"","unAvailable"];
                  }
                }

                $('#date').datepicker({ beforeShowDay: available });
                $('#date1').datepicker({ beforeShowDay: available });
              });
            </script>
            <div class="col-md-6">
              <label>Check Out Date</label>
              <!-- <input type="date" class="form-control" name="spCheckOutDate" id="date" value="<?php echo date('m/d/Y');?>" >-->
              <input type="text" name="spCheckOutDate" id="date1" readonly="readonly" class="outdate form-control" value="<?php echo date('m/d/Y');?>" size="12" />
            </div>
            <?php
            $p = new _postingview;
            $result = $p->single_product_detail($postid);
            $row = mysqli_fetch_assoc($result);


            $period = new DatePeriod(
              new DateTime($row['spPostAvailFrom']),
              new DateInterval('P1D'),
              new DateTime($row['spPostAvailTo'])


            );



            ?>

            <script>


              $(document).ready( function(){
                $('.indate').change(function(){
                  var inDate = $('.indate').val();
                  var outDate = $('.outdate').val();


                  var dt1 = new Date(inDate);
                  var dt2 = new Date(outDate);

                  var time_difference = dt2.getTime() - dt1.getTime();
                  var days = time_difference / (1000 * 3600 * 24);  


                  $('#spDays1').val(days);
                  pricecalculate();

//var  diff = outDate - inDate;

//alert(inDate +" "+ outDate );
                });
                $('.outdate').change(function(){
                  var inDate = $('.indate').val();
                  var outDate = $('.outdate').val();



                  var dt1 = new Date(inDate);
                  var dt2 = new Date(outDate);

                  var time_difference = dt2.getTime() - dt1.getTime();
                  var days = time_difference / (1000 * 3600 * 24);  


                  $('#spDays1').val(days);
                  pricecalculate();
//var  diff = outDate - inDate;
//alert(inDate +" "+ outDate );
                });

              });


            </script>		


            <div class="col-md-4"> 
              <label>Total Days  :</label>
            </div>
            <div class="col-md-8"> 

              <input type="number" class="form-control" onkeyup="pricecalculate()" name="spDays" id="spDays1" style="border-style: none;   background-color: #d8ffdb; margin-left: 61px;" readyonly> 
            </div>

            <div class="col-md-6" style="padding-right: 0px;"> 
              <label>Adults</label>
              <input type="number" class="form-control" name="spAdult" id="spAdult">
            </div>
            <div class="col-md-6"> 
              <label>Children</label>
              <input type="number" class="form-control" name="spChildren" id="spChildren">
            </div>
            <div class="col-md-6" >
              <label>Cleaning Charges  :</label>
            </div>
            <div class="col-md-6" >

              <input type="text" name="spCleaningChrg" id="txtCleaningChrg" class="form-control" placeholder="Cleaning Charges" readonly="" value="<?php echo $spPostingCleaningChrg; ?>" style="border-style: none;   background-color: #d8ffdb;">

            </div>
            <div class="col-md-6">
              <label>Service Charges  :</label>
            </div>
            <div class="col-md-6">

              <input type="text" name="spServiceChrg" id="txtServiceChrg" class="form-control" placeholder="Service Charges" readonly="" value="<?php echo $spPostingServicChrg; ?>" style="border-style: none;   background-color: #d8ffdb;">

            </div>
            <div class="col-md-6">
              <label>Price * <span id="daysCount2">Per</span> Day</label>
            </div>
            <div class="col-md-6">

              <input type="text" name="spPrice" id="spPrice1" data-price="<?php echo $spPostRentalNight;?>" class="form-control" readonly="" placeholder="Price" value="<?php echo $spPostRentalNight;?>" style="border-style: none;   background-color: #d8ffdb;" required>

            </div>
          </div>

          <span class="romCalPrice">Total: <?php  echo $defaltcurrency;  ?>  <span id="updatePrice1"> </span></span>

          <?php
          $br = new _bookRoom;
          $chkBook = $br->chekBook($_SESSION['pid'], $postid);
          if ($_SESSION['pid'] != $renter_id1 ) {

            if($chkBook == true){

              $book = mysqli_fetch_assoc($chkBook);
              if($chkBook != false){
                if ($book['spStatus'] ==0) {
                  echo '<input type="submit" name="" style="background-color: #83a532;" value="Requested" disabled>';
                }elseif ($book['spStatus'] ==2) {
                  echo '<input type="button" name="" style="background-color: #83a532;"  value="Rejected" disabled>';
                }
              }
            } else{
              echo '<input type="submit" name=""  style="background-color: #83a532;"  value="RESERVE NOW " >';
              echo " <h5 style='margin-left:55px;'>DO YOU NOT HAVE TO PAYNOW</h5>";
            }
          }
          ?>
        </form>
        <?php 
// ===PAYPAL ACCOUNT LIVE SETTING
// RETURN CANCEL LINK
        $cancel_return = $BaseUrl."/paymentstatus/payment_cancel.php";
// RETURN SUCCESS LINK
        $success_return = $BaseUrl."/paymentstatus/payment_success.php?uid=".$_SESSION['uid'];
// ===END
// ===LOCAL ACCOUNT SETTING
// RETURN CANCEL LINK
//$cancel_return = "http://localhost/share-page/paymentstatus/payment_cancel.php";
// RETURN SUCCESS LINK
//$success_return = "http://localhost/share-page/paymentstatus/payment_success.php";
// ===END



//Here we can use paypal url or sanbox url.
// sandbox$BaseUrl/
        $paypal_url     = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
// live payment
//$paypal_url       = 'https://www.paypal.com/cgi-bin/webscr';
//Here we can used seller email id. 
        $merchant_email = 'developer-facilitator@thesharepage.com';
// live email
//$merchant_email = 'sharepagerevenue@gmail.com';

//paypal call this file for ipn
//$notify_url   = "http://shoptodoor.pk/demo/paypal-ipn-php/ipn.php";
        $br = new _bookRoom;
        $chkBook = $br->chekBook($_SESSION['pid'], $postid);
        if($chkBook == true){
          $book = mysqli_fetch_assoc($chkBook);
          if ($chkBook != false) {
            if ($book['spStatus'] ==1) { ?>
              <form action="<?php echo $paypal_url; ?>" method="post">
                <input type="hidden" name="business" value="<?php echo $merchant_email; ?>">
                <input type="hidden" name="cancel_return" value="<?php echo $cancel_return; ?>"/>
                <input type="hidden" name="return" value="<?php echo $success_return; ?>">
                <input type="hidden" name="rm" value="2" />
                <input type="hidden" name="lc" value="" />
                <input type="hidden" name="no_shipping" value="1" />
                <input type="hidden" name="no_note" value="1" />
                <input type="hidden" name="currency_code" value="USD">
                <input type="hidden" name="page_style" value="paypal" />
                <input type="hidden" name="charset" value="utf-8" />
                <input type="hidden" name="cbt" value="Back to FormGet" />

                <!-- Redirect direct to card detail Page -->

                <input type="hidden" name="landing_page" value="billing">

                <!-- Redirect direct to card detail Page End -->


                <!-- Specify a Buy Now button. -->
                <input type="hidden" name="cmd" value="_cart">
                <input type="hidden" name="upload" value="1">

                <?php
                $p = new _bookRoom;
                $rpvt = $p->chekBook($_SESSION['pid'],$postid);
                if ($rpvt != false)
                {
                  $i = 0;
                  while($row2 = mysqli_fetch_assoc($rpvt))
                  {   

                    $price = 0;
                    $price = $RentaNight + $cleaningFee + $serviceFee;
                    $quantity = 1;


//print_r($price);


                    $i = $i+1;
                    $string = str_replace(' ', '', $ProTitle);
                    echo "<input type='hidden' name='item_name_".$i."' value='".$ProTitle."'>";
                    echo "<input type='hidden' name='item_number' value='143' >";
                    echo "<input type='hidden' class='".$ProTitle."' name='amount_".$i."' value='".$price."'>";

                    echo "<input type='hidden' id='".$ProTitle."' name='quantity_".$i."' value='".$quantity."'>";
                  }
                }

                ?>

                <input type="hidden" name="shopping_url" value="http://www.a2zwebhelp.com">
                <button type="submit" id="checkout_property" name="submit" data-postid="<?php echo $postid; ?>" data-profileid="<?php echo $_SESSION['pid']; ?>" class="btn btn_st_post text-right" style="margin-top: -18px!important; margin-left: 89px;">Proceed to Checkout</button>
                <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

              </form>
            <?php  }
          }
        } 
        ?>

        <?php
}else{ //echo $RentaNight; die("-----------------------");  
?>

<form method="post" action="bookNow.php">
  <input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
  <input type="hidden" name="spPosting_idspPosting" value="<?php echo $postid;?>">
  <input type="hidden" name="rs_roomType" value="<?php echo $spPostRoomType;?>">
  <input type="hidden" name="spMonth" id="bookMonth" value="Night">
  <input type="hidden" name="spCheckInDate" id="spCheckInDate" value="">
  <input type="hidden" name="spCheckOutDate" id="spCheckOutDate" value="" >

  <div class="row">
    <div class="col-md-6">
      <label>Check In Date </label>
      <!-- <input type="text" class="form-control" id="config-demo" readonly="readonly" value="" >-->
      <!-- <input type="date" class="form-control" name="spCheckInDate" id="demo-9" value="<?php echo date('Y-m-d');?>" >-->
      <input type="text" name="spCheckInDate" id="date" class="indate form-control" value="<?php echo $spPostAvailFrom;?>" size="12" />
    </div>
    <?php
    $p = new _postingview;
    $result = $p->single_product_detail($postid);
    if($result){
      $row = mysqli_fetch_assoc($result);


      $period = new DatePeriod(
        new DateTime($spPostAvailFrom),
        new DateInterval('P1D'),
        new DateTime($spPostAvailTo)


      );

    }

    ?>
    <div class="col-md-6">
      <label>Check Out Date</label>
      <!-- <input type="date" class="form-control" name="spCheckOutDate" id="date"  readonly="readonly" value="<?php echo date('m/d/Y');?>" >-->
      <input type="text" name="spCheckOutDate" id="date1" class="outdate form-control" value="<?php //echo $spPostAvailTo;?>" size="12" />
    </div>
    <?php
    $p = new _postingview;
    $result = $p->single_product_detail($postid);
    if($result){
      $row = mysqli_fetch_assoc($result);


      $period = new DatePeriod(
        new DateTime($spPostAvailFrom),
        new DateInterval('P1D'),
        new DateTime($spPostAvailTo)


      );

    }

    ?>

    <script>


      $(document).ready( function(){
        $('.indate').change(function(){
          var inDate = $('.indate').val();
          var outDate = $('.outdate').val();

        });
        $('.outdate').change(function(){
          var inDate = $('.indate').val();
          var outDate = $('.outdate').val();



          var dt1 = new Date(inDate);
          var dt2 = new Date(outDate);

          var time_difference = dt2.getTime() - dt1.getTime();
          var day1 = time_difference / (1000 * 3600 * 24);  
          var days=parseInt(day1);
//alert(days);

          $('#spDays1').val(days);
          pricecalculate();
//var  diff = outDate - inDate;
//alert(inDate +" "+ outDate );
        });

      });


    </script>		


    <div class="col-md-6"> 
      <label>Total Days  :</label>
    </div>
    <div class="col-md-6"> 

      <input type="number" class="form-control" onkeyup="pricecalculate()" name="spDays" id="spDays1" style="border-style: none;   background-color: #d8ffdb;" readyonly>   
    </div>

    <div class="col-md-6" style="padding-right: 0px;">
      <label>Adults</label>
      <input type="number" class="form-control" name="spAdult" id="spAdult"  >
    </div>
    <div class="col-md-6"> 
      <label>Children</label>
      <input type="number" class="form-control" name="spChildren" id="spChildren"  ><br> 
    </div>
    <div class="col-md-7 " style="width: 52.333333% !important">
      <label>Cleaning Charges  :</label>
    </div>
    <div class="col-md-5" >

      <input type="text" name="spCleaningChrg" id="txtCleaningChrg" class="form-control" placeholder="Cleaning Charges" readonly="" value="<?php echo $spPostingCleaningChrg; ?>" style="border-style: none;   background-color: #d8ffdb; margin-left: -9px; width: 135px">

    </div>
    <div class="col-md-6">
      <label>Service Charges  :</label>
    </div>
    <div class="col-md-6">

      <input type="text" name="spServiceChrg" id="txtServiceChrg" class="form-control" placeholder="Service Charges" readonly="" value="<?php echo $spPostingServicChrg; ?>" style="border-style: none;   background-color: #d8ffdb;">

    </div>
    <div class="col-md-6">
      <label>Charge * <span id="daysCount2">Per</span> Day :</label>
    </div>
    <div class="col-md-6">

      <input type="text" name="spPrice" id="spPrice1" data-price="<?php echo $spPostRentalNight;?>" class="form-control" readonly="" placeholder="Price" value="<?php echo $spPostRentalNight;?>" style="border-style: none;   background-color: #d8ffdb;" required>

    </div>
  </div>

  <span class="romCalPrice">Total: <?php  echo $defaltcurrency;  ?>  <span id="updatePrice1"> </span></span>

  <?php
  $br = new _bookRoom;
  $chkBook = $br->chekBook($_SESSION['pid'], $postid);
  if ($_SESSION['pid'] != $renter_id1 ) {
    if($_SESSION['guet_yes'] != 'yes'){ 

      if($chkBook == true){

        $book = mysqli_fetch_assoc($chkBook);
        if($chkBook != false){
          if ($book['spStatus'] ==0) {
            echo '<input type="submit" name="" style="background-color: #83a532;" value="Requested" disabled>';
          }elseif ($book['spStatus'] ==2) {
            echo '<input type="button" name="" style="background-color: #83a532;"  value="Rejected" disabled>';
          }
        }
      } else{
        echo '<input type="submit" name=""  style="background-color: #83a532;"  value="RESERVE NOW " >';
        echo " <h5 style='margin-left:55px;'>DO YOU NOT HAVE TO PAYNOW</h5>";
      }
    }
  }
  ?>
</form>    

<!--<form method="post" action="bookNow.php">
<input type="hidden" name="spProfile_idspProfile" value="<?php // echo $_SESSION['pid']; ?>">
<input type="hidden" name="spPosting_idspPosting" value="<?php // echo $_GET['postid'];?>">
<input type="hidden" name="rs_roomType" value="<?php // echo $roomType;?>">
<input type="hidden" name="spMonth" id="bookMonth" value="Month">
<input type="hidden" name="spMonth" id="bookMonth" value="Night">
<input type="hidden" name="spCheckInDate" id="spCheckInDate" value="">
<input type="hidden" name="spCheckOutDate" id="spCheckOutDate" value="" >

<label for="dt1" class="lbl_3">Enter Date</label>
<input type="date" name="fromdate" class="form-control" id="dt1" value="<?php // echo $_POST['fromdate'] ?>" autocomplete="off"  required />

<select class="form-control" name="" id="txtPriceChk">
<option value="<?php  // echo $RentalMonth; ?>" data-month="Month">Month</option>
<option value="<?php // echo $RentalWeek;?>" data-month="Week">Week</option>
<option value="<?php // echo $spPostRentalNight;?>" data-month="Day">Day</option>
<?php
//	if($roomType == "Rent A Room"){ ?>
<option value="<?php // echo $RentaNight; ?>" data-month="Night">Night</option> <?php
//	}
?>
</select>
<label>Price</label>
<input type="text" name="spPrice" id="txtPrice" class="form-control" readonly="" placeholder="Price" value="<?php // echo $RentalMonth;?>">
<label>Cleaning Charges</label>
<input type="text" name="spCleaningChrg" id="txtCleaningChrg" class="form-control" placeholder="Cleaning Charges" readonly="" value="<?php // echo $cleaningFee; ?>">
<label>Service Charges</label>
<input type="text" name="spServiceChrg" id="txtServiceChrg" class="form-control" placeholder="Service Charges" readonly="" value="<?php // echo $serviceFee; ?>">
<label>Total Days</label>
<input type="number" class="form-control" onkeyup="pricecalculate()" name="spDays" id="spDays1">
<label class="romCalPrice" >Total: <?php // echo $defaltcurrency; ?>  <span id="updatePrice"><?php // echo $RentalMonth + $cleaningFee + $serviceFee ;?></span></label>

<!-- <input type="text" name="" class="form-control" placeholder="Interest Rate">
<?php
if ($_SESSION['pid'] != $renter_id1 ) { 
$br = new _bookRoom;
$chkBook = $br->chekBook($_SESSION['pid'], $_GET['postid']);
if($chkBook != false){
if($chkBook->num_rows > 0){
echo '<input type="button" class="disabled"  name="" value="Book Now">';
}else{
echo '<input type="submit" name="" value="Book Now">';
}
}else{  
echo '<input type="submit" name="" style="background-color: #83a532;    background-image: none; border-color: #83a532"  value="Book Now">';
}
}
?>

</form>-->





<?php
} 
?>



</div>
</div>
<?php // }
?>
</div>
</div>
</div>
</div>
</div>
<!-- Modal -->
<div id="contactHost" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content no-radius sharestorepos">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Contact Host</h4>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div id="EmailFrnd" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content no-radius sharestorepos">
      <form method="post" action="sendEmail.php">
        <input type="hidden" value="<?php echo $BaseUrl.'/real-estate/room-detail.php?postid='.$postid;?>" name="txtlink" />
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Property Forward</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Enter Email</label>
            <input type="text" name="txtemail" class="form-control" required="" />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info" >Forward</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="row m_top_15 rightProperty">
  <div class="col-md-12">
    <h2 class="leftPostHead">At A Glance</h2>
  </div>
  <div class="col-md-8">
    <div class="bg_white" style="padding: 15px;">
      <div class="row">



        <div class="col-md-3">
          <p style="font-weight: 700;">Price Per Month</p>
        </div>
        <div class="col-md-3">
          <p><?php echo $defaltcurrency; ?>  <?php echo $spPostRentalMonth; ?></p>
        </div> 


        <div class="col-md-3">
          <p style="font-weight: 700;">Price Per Week</p>
        </div>
        <div class="col-md-3">
          <p><?php echo $defaltcurrency; ?>  <?php echo $spPostRentalWeek; ?></p>
        </div> 


        <div class="col-md-3">
          <p style="font-weight: 700;">Price Per Days</p>
        </div>
        <div class="col-md-3">
          <p><?php echo $defaltcurrency; ?>  <?php echo $spPostRentalNight; ?></p>
        </div>

        <div class="col-md-3">
          <p style="font-weight: 700;">Availability Date</p>
        </div>
        <div class="col-md-3">
          <p><?php echo date("Y-m-d", $availFrom);?></p>
        </div>

        <div class="col-md-3">
          <p style="font-weight: 700;">Room Type</p>
        </div>
        <div class="col-md-3">
          <p><?php echo $spPostRoomType;?></p>
        </div>


      </div>
    </div>
  </div>
  <div class="col-md-4 text-right">
    <a href="javascript:void(0)" data-toggle="modal" data-target="#flagPost" ><i class="fa fa-flag"></i> Flag This Post</a>&nbsp;&nbsp;&nbsp;&nbsp;
    <!--   <a href="javascript:void(0)" class="btn butn_draf" data-toggle="modal" data-target="#contactHost" ><i class="fa fa-envelope"></i> Contact Host</a>  -->
    <a href="javascript:void(0)" class="btn butn_draf" data-toggle="modal" data-target="#EmailFrnd"  style="background-color: #83a532;"><i class="fa fa-user"></i> Forward To Friend</a>

  </div>

</div>
</div>

</section>

<div class="container">
  <div class="propertyTab">
    <ul class="nav nav-tabs" id="proNavTab">
      <li><a data-toggle="tab" href="#home">About Host</a></li>
      <li><a data-toggle="tab" href="#home2">Description</a></li>
      <li><a data-toggle="tab" href="#home3">Address MAp</a></li>
      <li class="active"><a data-toggle="tab" href="#home4">Details</a></li>
      <li><a data-toggle="tab" href="#home6">Availability</a></li>

      <li><a data-toggle="tab" href="#home8">Gallery</a></li> 
    </ul>

    <div class="tab-content bg_white ">
      <div id="home" class="tab-pane fade in">
        <div class="RoomAgent">
          <div class="row">
            <div class="col-md-2">
              <?php

              if ($OwnerPic != '') { 
                echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($OwnerPic) . "' >";
              } else{ 
                echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
              } 
//echo $OwnerId; die("-------------")
              ?>
              <h3><a href="<?php  echo $BaseUrl.'/real-estate/agent-detail.php?agentId='.$OwnerId; ?>"><?php echo $OwnerName; ?></a></h3>

            </div>
            <?php if($spPostRoomType!='Rent Entire Place'){?>
              <div class="col-md-5">
                <!--    <p class="detail"><span><i class="fa fa-phone"></i> <?php // echo $OwnerPhone; ?></span><span><i class="fa fa-envelope"></i> <?php // echo $OwnerEmail; ?></span> </p> -->
                <!-- <p class="text-justify"><?php // echo $OwnerAbout; ?></p> -->

                <?php
//echo $OwnerId; 
                $pqqaa = new _realstateposting; 
                $datahost = $pqqaa->hostdetailsget($OwnerId);
                if($datahost){
$reshost = mysqli_fetch_array($datahost); //die("---------");
//print_r($reshost);
}
?>

<h4>Hosting Details</h4>
<div class="table-responsive">
  <table class="table table-striped ">
    <tbody>
      <tr>
        <td>What I do on a typical day</td>
        <td><?php echo $reshost['typical_day']; ?></td>
      </tr>
      <tr>
        <td>My hobbies</td>
        <td><?php echo $reshost['hobbies']; ?></td>
      </tr>
      <tr>
        <td>What my favorite activities are</td>
        <td><?php echo $reshost['favorite_activities']; ?></td>
      </tr>
      <tr>
        <td>what kind of food we eat</td>
        <td><?php echo $reshost['food']; ?></td>
      </tr>
      <tr>
        <td>what kind of music we like</td>
        <td><?php echo $reshost['music']; ?></td>
      </tr>
    </tbody>
  </table>
</div>




</div>
<?php } ?>
<div class="col-md-5">
  <a href="#" style="color: #428bca; text-decoration:none; font-size: 20px; font-family: Proxima Nova;">Contact Host</a>
  <form method="post" action="sendEnquiry.php" class="enqRealForm editPostTimeline">
    <input type="hidden" name="spPosting_idspPosting" value="<?php echo $postid;?>">
    <input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid'];?>">
    <input type="hidden" name="sprealType" value="1">
    <input type="text" name="sprealName" class="form-control" placeholder="Full Name" required="" style="margin-top:32px;">
    <input type="email" name="sprealEmail" class="form-control" placeholder="Email" required="" style="margin-top:10px;">
    <input type="number" name="sprealPhone" class="form-control" placeholder="Phone" required="" style="margin-top:10px;">
    <textarea class="form-control" name="sprealMessage" placeholder="I'm Intrested in this...." style="margin-top:10px;"></textarea>
    <input style="background-color:#202548;color:white;" type="submit" value="Submit" class="pull-right btn <?php echo ($_SESSION['pid'] == $OwnerId )?'disabled':'';?> " <?php echo ($_SESSION['pid'] == $OwnerId )?'disabled':'';?>>
  </form>

</div>

</div>
</div>
</div>
<div id="home2" class="tab-pane fade in">
  <div class="roomBoxMain">
    <h3>Room Description</h3>
    <p class="text-justify"><?php echo $ProDes;?></p>
  </div>
</div>
<div id="home3" class="tab-pane fade in">
  <div class="roomBoxMain">
    <h3>Adress Map</h3>
    <div class="btmMappro">
      <div class="map_canvas"><div class="hidden">
        <input id="geocomplete" type="text" placeholder="Type in an address" size="90" />
      </div></div>
    </div>
  </div>
</div>

<script src="<?php echo $BaseUrl.'/assets/js/jquery.geocomplete.js';?>"></script>

<script>
  $(function(){
    var options = {
      map: ".map_canvas",
      location: "<?php echo $address; ?>",
      zoom: 13
    };
    $("#geocomplete").geocomplete(options);
  });
</script>

<div id="home4" class="tab-pane fade in active">
  <div class="roomBoxMain">

    <div class="row">
      <div class="col-md-6">
        <h4>Detail</h4>
        <div class="table-responsive">
          <table class="table table-striped ">
            <tbody>
              <tr>
                <td>Property Type</td>
                <td><?php echo $propertyType; ?></td>
              </tr>
              <tr>
                <td>Rent Duration</td>
                <td>
                  <?php
                  if ($rentduration == 1) {
                    echo "Short Term";
                  } 
                  elseif ($rentduration == 2) {
                   echo "Long Term";
                 } 
                 else {
                   echo "";
                 }
                 ?>
               </td>
             </tr>

             <tr>
              <td>Square Foot</td>
              <td><?php echo $squarefoot; ?></td>
            </tr>
            <tr>
              <td>Bed Rooms</td>
              <td><?php echo $bedroom; ?></td>
            </tr>
            <tr>
              <td>Bath Rooms</td>
              <td><?php echo $bathroom; ?></td>
            </tr>
            <tr>
              <td>Furnishing</td>
              <td><?php echo $Furnishing; ?></td>
            </tr>
            <tr>
              <td>Rent By</td>
              <td><?php echo $rentby; ?></td>
            </tr>
            <tr>
              <td>Status</td>
              <td><?php echo $Status; ?></td>
            </tr>
            <tr>
              <td>Agency Fee</td>
              <td><?php echo $defaltcurrency; ?>   <?php echo $spPostAgencyFee; ?></td>
            </tr>

            <tr>
              <td>Meal Include</td>
              <td><?php echo $meal_include; ?></td>
            </tr>
            <?php if($propertyType == 'Detached House' || $propertyType == 'Townhouse' || $propertyType == 'Land/Lot' ) {?>
            <tr>
              <td>Lot Size</td>
              <td><?php if(isset($lotSize)) {echo $lotSize; } ?></td>
            </tr>
            <?php }?>
          </tbody>
        </table>
      </div>
      <div class="space-"></div>
      <h4>UTILITIES INCLUDED</h4>
      <div class="table-responsive">
        <table class="table table-striped ">
          <tbody>
            <tr>
              <td>Heat</td>
              <td><?php echo $Heat; ?></td>
            </tr>
            <tr>
              <td>Water</td>
              <td><?php echo $Water; ?></td>
            </tr>
            <tr>
              <td>Electricity</td>
              <td><?php echo $Electricity; ?></td>
            </tr>
            <tr>
              <td>Cable Tv</td>
              <td><?php echo $Cable_Tv; ?></td>
            </tr>
            <tr>
              <td>Internet</td>
              <td><?php echo $Internet; ?></td>
            </tr>
            <tr>
              <td>Parking</td>
              <td><?php echo $Parking; ?></td>
            </tr>
            <tr>
              <td>Security Camera</td>
              <td><?php echo $Security_Camera; ?></td>
            </tr>
            <tr>
              <td>Controlled-Access Lobby</td>
              <td><?php echo $Controlled_Access_Lobby; ?></td>
            </tr>
            <tr>
              <td>Fitness: Fully Equipped Gym</td>
              <td><?php echo $Fitness_Fully_Equipped_Gym; ?></td>
            </tr>
            <tr>
              <td>Concierge</td>
              <td><?php echo $Concierge; ?></td>
            </tr>
            <tr>
              <td>Elevator</td>
              <td><?php echo $Elevator; ?></td>
            </tr>
            <tr>
              <td>On-Site Convenience Store</td>
              <td><?php echo $On_Site_Convenience_Store; ?></td>
            </tr>

          </tbody>
        </table>
      </div>



    </div>
    <div class="col-md-6">
      <h4>Conditions</h4>
      <div class="table-responsive">
        <table class="table table-striped ">
          <tbody>
            <tr>
              <td>Dogs</td>
              <td><?php echo $Dogs; ?></td>
            </tr>
            <tr>
              <td>Cats</td>
              <td><?php echo $Cats; ?></td>
            </tr>
            <tr>
              <td>Smoking</td>
              <td><?php echo $Smoking; ?></td>
            </tr>
<!-- <tr>
<td>Lease Term</td>
<td><?php echo $Lease_Term; ?></td>
</tr> -->
</tbody>
</table>
</div>
<h4>CHARGES</h4>
<div class="table-responsive">
  <table class="table table-striped ">
    <tbody>
      <tr>
        <td>Agency Fee</td>
        <td><?php echo $defaltcurrency; ?>  <?php echo $spPostAgencyFee; ?></td>
      </tr>
      <tr>
        <td>Service Charges</td>
        <td><?php echo $defaltcurrency; ?>  <?php echo $spPostingServicChrg; ?></td>
      </tr>
      <tr>
        <td>Cleaning Charges</td>
        <td><?php echo $defaltcurrency; ?>  <?php echo $spPostingCleaningChrg; ?></td>
      </tr>
    </tbody>
  </table>
</div>
<h4>FEATURES</h4>
<div class="table-responsive">
  <table class="table table-striped ">
    <tbody>
      <tr>
        <td>Stainless Steel Appliances</td>
        <td><?php echo $Stainless_Steel_Appliances; ?></td>
      </tr>
      <tr>
        <td>Central Air Conditioning</td>
        <td><?php echo $Central_Air_Conditioning; ?></td>
      </tr>
      <tr>
        <td>Lots of Closet Space</td>
        <td><?php echo $Lots_of_Closet_Space; ?></td>
      </tr>
      <tr>
        <td>Open Floor Plan</td>
        <td><?php echo $Open_Floor_Plan; ?></td>
      </tr>
      <tr>
        <td>Building Amenities</td>
        <td><?php echo $Building_Amenities; ?></td>
      </tr>
      <tr>
        <td>Washer/Dryer</td>
        <td><?php echo $Washer_Dryer; ?></td>
      </tr>
      <tr>
        <td>Spacious Backyard</td>
        <td><?php echo $Spacious_Backyard; ?></td>
      </tr>
      <tr>
        <td>Garage Parking</td>
        <td><?php echo $Garage_Parking; ?></td>
      </tr>
      <tr>
        <td>JETTED tub/acuzzi</td>
        <td><?php echo $JETTED_tub_acuzzi; ?></td>
      </tr>
      <tr>
        <td>Swimming Pool</td>
        <td><?php echo $Swimming_Pool; ?></td>
      </tr>

      <tr>
        <td>Bed type</td>
        <td><?php echo $Bed_type; ?></td>
      </tr>

      <tr>
        <td>Fireplace</td>
        <td><?php echo $Fireplace; ?></td>
      </tr>
      <tr>
        <td>Balcony</td>
        <td><?php echo $Balcony; ?></td>
      </tr>
      <tr>
        <td>Fenced Backyard</td>
        <td><?php echo $Fenced_Backyard; ?></td>
      </tr>
      <tr>
        <td>Fitness Area</td>
        <td><?php echo $Fitness_Area; ?></td>
      </tr>
      <tr>
        <td>Storage</td>
        <td><?php echo $Storage; ?></td>
      </tr>
      <tr>
        <td>Close to Public Transportation</td>
        <td><?php echo $Close_to_Public_Transportation; ?></td>
      </tr>
    </tbody>
  </table>
</div>




</div>
</div>








</div>
</div>
<div id="home5" class="tab-pane fade in">
  <div class="roomBoxMain">
    <h3>Room Style</h3>
    <p class="text-justify"><?php echo $housStylle;?></p>
  </div>
</div>
<div id="home6" class="tab-pane fade in">
  <div class="row roomBoxMain">
    <div class="col-md-7">

      <script type="text/javascript">                                
        var date1 = new Date(<?php echo date("Y, m, d", $availFrom); ?>);
        var date2 = new Date(<?php echo date("Y, m, d", $availTo); ?>);
        $(document).ready(function () {
          $('#available').datepicker({
            beforeShowDay: function (date) {
              if (date >= date1 && date <= date2) {
                return [true, 'ui-state-error', 'tooltipText'];
              }
              return [true, '', ''];
            }
          });
        });
      </script>


      <div class="wrapper">

        <div class="container-calendar">
          <h3 id="monthAndYear"></h3>

          <div class="button-container-calendar">
            <button id="previous" onclick="previous()">&#8249;</button>
            <button id="next" onclick="next()">&#8250;</button>
          </div>

          <table class="table-calendar" id="calendar" data-lang="en">
            <thead id="thead-month"></thead>
            <tbody id="calendar-body"></tbody>
          </table>

          <div class="footer-container-calendar">
            <label for="month">Jump To: </label>
            <select id="month" onchange="jump()">
              <option value=0>Jan</option>
              <option value=1>Feb</option>
              <option value=2>Mar</option>
              <option value=3>Apr</option>
              <option value=4>May</option>
              <option value=5>Jun</option>
              <option value=6>Jul</option>
              <option value=7>Aug</option>
              <option value=8>Sep</option>
              <option value=9>Oct</option>
              <option value=10>Nov</option>
              <option value=11>Dec</option>
            </select>
            <select id="year" onchange="jump()"></select>       
          </div>

        </div>

      </div>


      <script>
        function generate_year_range(start, end) {
          var years = "";
          for (var year = start; year <= end; year++) {
            years += "<option value='" + year + "'>" + year + "</option>";
          }
          return years;
        }

        today = new Date();
        currentMonth = today.getMonth();
        currentYear = today.getFullYear();
        selectYear = document.getElementById("year");
        selectMonth = document.getElementById("month");


        createYear = generate_year_range(1970, 2050);
/** or
* createYear = generate_year_range( 1970, currentYear );
*/

        document.getElementById("year").innerHTML = createYear;

        var calendar = document.getElementById("calendar");
        var lang = calendar.getAttribute('data-lang');

        var months = "";
        var days = "";

        var monthDefault = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

        var dayDefault = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

        if (lang == "en") {
          months = monthDefault;
          days = dayDefault;
        } else if (lang == "id") {
          months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
          days = ["Ming", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"];
        } else if (lang == "fr") {
          months = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
          days = ["dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi"];
        } else {
          months = monthDefault;
          days = dayDefault;
        }


        var $dataHead = "<tr>";
        for (dhead in days) {
          $dataHead += "<th data-days='" + days[dhead] + "'>" + days[dhead] + "</th>";
        }
        $dataHead += "</tr>";

//alert($dataHead);
        document.getElementById("thead-month").innerHTML = $dataHead;


        monthAndYear = document.getElementById("monthAndYear");
        showCalendar(currentMonth, currentYear);



        function next() {
          currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
          currentMonth = (currentMonth + 1) % 12;
          showCalendar(currentMonth, currentYear);
        }

        function previous() {
          currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
          currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
          showCalendar(currentMonth, currentYear);
        }

        function jump() {
          currentYear = parseInt(selectYear.value);
          currentMonth = parseInt(selectMonth.value);
          showCalendar(currentMonth, currentYear);
        }

        function showCalendar(month, year) {

          var firstDay = ( new Date( year, month ) ).getDay();

          tbl = document.getElementById("calendar-body");


          tbl.innerHTML = "";


          monthAndYear.innerHTML = months[month] + " " + year;
          selectYear.value = year;
          selectMonth.value = month;

// creating all cells
          var date = 1;
          var from_year =  <?php  echo date("Y", $availFrom); ?>;
          var from_month = <?php  echo  date("m", $availFrom); ?>;
          var from_date = <?php echo  date("d", $availFrom); ?>;




          var to_year =  <?php  echo  date("Y", $availTo); ?>;
          var to_month = <?php  echo date("m", $availTo); ?>;
          var to_date = <?php echo   date("d", $availTo); ?>;






          for ( var i = 0; i < 6; i++ ) {

            var row = document.createElement("tr");


            for ( var j = 0; j < 7; j++ ) {
              if ( i === 0 && j < firstDay ) {
                cell = document.createElement( "td" );
                cellText = document.createTextNode("");
                cell.appendChild(cellText);
                row.appendChild(cell);
              } else if (date > daysInMonth(month, year)) {
                break;
              } else {


//05 01 2022  	//13 01 2022
//15 01 2022  //13 01 2022

//var current_date = date+'-'+month+'-'+year;

                var current_date = new Date(date, month, year);

                var start_date = new Date(from_date, from_month, from_year);

                var end_date = new Date(to_date , to_month, to_year);


                if ( (current_date >= start_date) && (end_date >= current_date) )	{
//	cell.className = "avialable"; 
                }					



                cell = document.createElement("td");
                cell.setAttribute("data-date", date);
                cell.setAttribute("data-month", month + 1);
                cell.setAttribute("data-year", year);
                cell.setAttribute("data-month_name", months[month]);
//cell.className = "date-picker";
                cell.innerHTML = "<span>" + date + "</span>";

                if ( date === today.getDate() && year === today.getFullYear() && month === today.getMonth() ) {
                  cell.className = "date-picker selected";
                }
                row.appendChild(cell);
                date++;
              }


            }

            tbl.appendChild(row);
          }

        }

        function daysInMonth(iMonth, iYear) {
          return 32 - new Date(iYear, iMonth, 32).getDate();
        }

      </script>
    </div>
    <div class="col-md-5">
      <h3>Availability</h3>
      <br>
      <p class="no-margin"><strong>Available From:</strong> <?php echo date("Y, m, d", $availFrom); ?></p>
      <p><strong>Available To:</strong> <?php echo date("Y, m, d", $availTo); ?></p>

      <?php

      $availFromyear = date("Y", $availFrom);
      $availFrommonth = date("m", $availFrom);
      $availFromday = date("d", $availFrom);


      $availToyear = date("Y", $availTo);
      $availTomonth = date("m", $availTo);
      $availToday = date("d", $availTo);

//	$year = date('Y',strtotime($availFrom));
//		$month = date('F',strtotime($availFrom));
//		$day = date('J',strtotime($availFrom));
//	echo $availFrom;


      ?>
    </div>
  </div>
</div>

<div id="home8" class="tab-pane fade in">
  <div class="row">

    <?php
    $pc = new _realstatepic;
    $res = $pc->read($postid);
//echo $pc->ta->sql;
    $active1 = 0;
    if ($res != false) {
      $active2 = 0;
      while($postr = mysqli_fetch_assoc($res)){
        $picture = $postr['spPostingPic']; 
        if($active2 == 0){
          $pic = 'active';
        }else{
          $pic = '';
        }
        if(isset($picture)){

        }else{ 
          $picture = "../img/no.png";
        }
        echo  '<div class="item '.$pic.'"><div class="col-md-3">
        <img src="'.$picture.'" alt="Los Angeles" style="width:100%;height:150px;"></div>
        </div>';

        $active2++;
      }
    }else{?>
      <img src="../img/no.png" alt="Posting Pic" class="img-responsive" style="margin: 0 auto;" ><?php
    }
    ?>


  </div>
</div>
</div>
</div>
<div class="space-md"></div>
<div class="hidden">
  <input id="geocomplete" type="text" placeholder="Type in an address" size="90" />
</div>
</div>

<?php
//$paass = new _spevent_transection;
//echo $_GET['postid'];die;
//$checkout = $paass->readroom_booking($_GET['postid']);
//print_r($checkout);
//die('11111');
//echo "<pre>";
/*while($roomdata = mysqli_fetch_assoc($checkout)){
//print_r($roomdata);
}*/
//echo "</pre>";
//echo $paass->taspnrsup->sql."<br>";
//die('ppppppppppp');
?>

<script type="text/javascript">
/*	$("#checkout_property").on("click", function () {
var btn = this;
var postid = $(btn).attr("data-postid");
var profileid = $(btn).attr("data-profileid");
debugger;
$.post("/cart/checkout.php", {postid: postid, profileid: profileid}, function (r) {
alert("Transaction Successfully done !");
});


});*/
</script>
<?php 

include('../component/footer.php');
include('../component/btm_script.php');
?>

<!-- data range script -->
<script type="text/javascript">
  $(document).ready(function() {
//console.log(<?php echo date('m', $availFrom); ?>);
// startdate
    var strtYear = <?php echo date('Y', $availFrom); ?>;
    var strtMonth = <?php echo date('m', $availFrom); ?>-1;
    var strtDay = <?php echo date('d', $availFrom); ?>;
    var startDate1 = new Date(strtYear, strtMonth, strtDay);
    var startDate2 = new Date();
    if(startDate1 >= startDate2){
      var startDate = new Date(strtYear, strtMonth, strtDay);
    }
    if(startDate2 >= startDate1){
      var startDate = new Date();
    }
// END DATE
    var endYear = <?php echo date('Y', $availTo); ?>;
    var endMonth = <?php echo date('m', $availTo); ?>-1;
    var endDay = <?php echo date('d', $availTo); ?>;
    var endDate = new Date(endYear, endMonth, endDay);

    $('#config-demo').daterangepicker({

      "minDate" : startDate,
      "maxDate" : endDate,

      "linkedCalendars"   : false,
      "autoUpdateInput"   : true,
      "startDate"         : startDate,
      "endDate"           : endDate
    }, function(start, end, label) {

      $("#spCheckInDate").val(start.format('YYYY-MM-DD'));
      $("#spCheckOutDate").val(end.format('YYYY-MM-DD'));

//CALCULATE THE TOTAL NUMBER OF DAYS
      var days = end.diff(start, 'days');
      console.log(days);
      $("#spDays").val(days);
// CALCULATE THE PRICE IN CALCULATOR
      if(days < 1){
        day = 1;
      }else{
        day = days;
      }
//15  //2

      $("#daysCount").html(days);
      var spPrice = $('#spPrice').attr("data-price");
//var spPrice = document.getElementById("spPrice").value;
      var txtCleaningChrg     = document.getElementById("txtCleaningChrg").value;
      var txtServiceChrg      = document.getElementById("txtServiceChrg").value;
      var total               = parseInt(spPrice) * parseInt(day) + parseInt(txtCleaningChrg) + parseInt(txtServiceChrg);
      $("#updatePrice").html(total);
      var totalPrice = parseInt(spPrice) * parseInt(day);
      $("#spPrice").val(totalPrice);


    });
  });

  function pricecalculate(){
    var days=document.getElementById('spDays1').value;
    document.getElementById('daysCount2').innerHTML=days;
    if(days>0){
      var countmonth=days/30;
      days=days%30;
      var countweek=days/7;
      days=days%7;
      var countday=days;
      var totalcount=parseInt(countmonth)*<?php echo $spPostRentalMonth; ?>+parseInt(countweek)*<?php echo $spPostRentalWeek; ?>+parseInt(countday)* <?php echo $spPostRentalNight; ?>;
    }
    document.getElementById('spPrice1').value=totalcount;

    var totalprices=parseInt(totalcount)+<?php echo $spPostingCleaningChrg + $spPostingServicChrg ; ?>;
    document.getElementById('updatePrice1').innerHTML=totalprices;

  }	
</script>


<script>
  $(".bokmarktabsssss").on("click","#addtofavouriteevent", function () {


    var postid = $(this).data('postid');

//alert(postid);


    var pid = $(this).data('pid');

// alert(pid);

    $.post(MAINURL+"/social/addfavoritesRealstate.php", {postid: postid, pid: pid}, function (response) {
//$("#addtofavouriteeve").html("<i class='fa fa-heart' aria-hidden='true'></span>");
      $("#sssssssssssssss"+postid).html('<button class="btn btn-outline-primary btn-sm" id="remtofavoritesevent" data-postid="'+postid+'" data-pid="'+pid+'"  ><span id="removetofavouriteeve"><i class="fa fa-heart"></i></span></button>');
//window.location.reload();
    });
  });

  $(".bokmarktabsssss").on("click","#remtofavoritesevent", function () {
    var postid = $(this).data('postid');
    var pid = $(this).data('pid');
    var btnremovefavorites = this;

    $.post(MAINURL+"/social/deletefavoritesRealstate.php", {postid: postid}, function (response) {
//$("#removetofavouriteeve").html("<i class='fa fa-heart-o' aria-hidden='true'></span>");
//window.location.reload();
      $("#sssssssssssssss"+postid).html('<button class="btn btn-outline-primary btn-sm" id="addtofavouriteevent" data-postid="'+postid+'" data-pid="'+pid+'"  ><span id="addtofavouriteeve"><i class="fa fa-heart-o"></i></span></button>');
    });
  });


</script>
</body>
</html>
<?php
if(isset($_POST['fromdate'])){
  if(!empty($_POST['fromdate'])){
    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];
    $sqlquerydate = "and spPostAvailFrom <= '".$fromdate."' and spPostAvailTo >= '".$todate."'";
  }
}
?>
<script>
  $(document).ready(function () {
    $("#dt1").datepicker({
      dateFormat: "yy-mm-dd",
      minDate: 0,
      onSelect: function () {
        var dt2 = $('#dt2');
        var startDate = $(this).datepicker('getDate');
//add 30 days to selected date
        startDate.setDate(startDate.getDate() + 30);
        var minDate = $(this).datepicker('getDate');
        var dt2Date = dt2.datepicker('getDate');
//difference in days. 86400 seconds in day, 1000 ms in second
        var dateDiff = (dt2Date - minDate)/(86400 * 1000);

//dt2 not set or dt1 date is greater than dt2 date
        if (dt2Date == null || dateDiff < 0) {  
          dt2.datepicker('setDate', minDate);
        }
//dt1 date is 30 days under dt2 date
        else if (dateDiff > 30){
          dt2.datepicker('setDate', startDate);
        }
//sets dt2 maxDate to the last day of 30 days window
        dt2.datepicker('option', 'maxDate', startDate);
//first day which can be selected in dt2 is selected date in dt1
        dt2.datepicker('option', 'minDate', minDate);
      }
    });
    $('#dt2').datepicker({
      dateFormat: "yy-mm-dd",
      minDate: 0
    });
  });
</script>
