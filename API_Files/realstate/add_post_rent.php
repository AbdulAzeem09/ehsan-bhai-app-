<?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");




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

/*	function sp_autoloader($class) {
		include '../mlayer/' . $class . '.class.php';
	}
  */
/*print_r($_POST);exit;*/



/*	spl_autoload_register("sp_autoloader");*/
   //echo"here";
	$p = new _realstateposting;
 
 $s = new _spproductsize;
  //_spproductsize
/*print_r($_POST);*/
if($_POST["spPostListing"] == "Rent" ){

    /*echo"here";*/

    $rentdata = array(
     "spPostListing"=>$_POST["spPostListing"],
     "spCategories_idspCategory"=>$_POST["spCategories_idspCategory"],
     "spPostingVisibility"=>$_POST["spPostingVisibility"],
     "spProfiles_idspProfiles"=>$_POST["spProfiles_idspProfiles"],
     "spPostingAlbum_idspPostingAlbum"=>$_POST["spPostingAlbum_idspPostingAlbum"],
     "spPostingTitle"=>$_POST["spPostingTitle"],
     "spPostingsCountry"=>$_POST["spPostingsCountry"],
     "spPostingsState"=>$_POST["spPostingsState"],
     "spPostingsCity"=>$_POST["spPostingsCity"],
     "spRoomRent"=>$_POST["spRoomRent"],
     "spPostingPropertyType"=>$_POST["spPostingPropertyType"],
     "spPostingSqurefoot"=>$_POST["spPostingSqurefoot"],
     "spPostingBedroom"=>$_POST["spPostingBedroom"],
     "spPostingBathroom"=>$_POST["spPostingBathroom"],
     "spPostFurnish"=>$_POST["spPostFurnish"],
     "spPostAvailFrom"=>$_POST["spPostAvailFrom"],
      "spPostAvailTo"=>$_POST["spPostAvailTo"],
     "spPostDepositAmt"=>$_POST["spPostDepositAmt"],
     "spPostRentalMonth"=>$_POST["spPostRentalMonth"],
     "spPostRentalWeek"=>$_POST["spPostRentalWeek"],
     "spPostingServicChrg"=>$_POST["spPostingServicChrg"],
     "spPostingCleaningChrg"=>$_POST["spPostingCleaningChrg"],
     "spPostingHouseStyle"=>$_POST["spPostingHouseStyle"],
     "spPostingAddress"=>$_POST["spPostingAddress"],
     "spPostingNotes"=>$_POST["spPostingNotes"],
     "spPostDog"=>$_POST["spPostDog"],
     "spPostCat"=>$_POST["spPostCat"],
     "spPostSmoke"=>$_POST["spPostSmoke"],
     "spPostStainless"=>$_POST["spPostStainless"],
     "spPostCentralAir"=>$_POST["spPostCentralAir"],
     "spPostLotsCloset"=>$_POST["spPostLotsCloset"],
     "spPostOpenFloor"=>$_POST["spPostOpenFloor"],
     "spPostBuildAment"=>$_POST["spPostBuildAment"],
     "spPostWasher"=>$_POST["spPostWasher"],
     "spPostSpacious"=>$_POST["spPostSpacious"],
     "spPostGargParking"=>$_POST["spPostGargParking"],
     "spPostJettedTub"=>$_POST["spPostJettedTub"],
     "spPostSwimPool"=>$_POST["spPostSwimPool"],
     "spPostBedType"=>$_POST["spPostBedType"],
     "spPostFirePlace"=>$_POST["spPostFirePlace"],
     "spPostBalcony"=>$_POST["spPostBalcony"],
     "spPostFenced"=>$_POST["spPostFenced"],
     "spPostFitnesArea"=>$_POST["spPostFitnesArea"],
     "spPostStorage"=>$_POST["spPostStorage"],
     "spPostClosePublic"=>$_POST["spPostClosePublic"],
     "spPostHeat"=>$_POST["spPostHeat"],
     "spPostWater"=>$_POST["spPostWater"],
    "spPostElect"=>$_POST["spPostElect"],
    "spPostCableTv"=>$_POST["spPostCableTv"],
    "spPostInternet"=>$_POST["spPostInternet"],
    "spPostSecurtyCam"=>$_POST["spPostSecurtyCam"],
    "spPostCntrlAces"=>$_POST["spPostCntrlAces"],
    "spPostFulyEquipedGym"=>$_POST["spPostFulyEquipedGym"],
    "spPostConcierge"=>$_POST["spPostConcierge"],
    "spPostElevator"=>$_POST["spPostElevator"],
    "spPostOnsiteStore"=>$_POST["spPostOnsiteStore"],
    "spPostParking"=>$_POST["spPostParking"]
   );



		$postid = $p->post($rentdata);
     /*echo $p->ta->sql;*/
    /*echo $mysqli->info;
    echo $postid;*/
/*
echo trim($postid);*/
$pi = new _realstatepic;


if(isset($_FILES['spPostingPic']['name'])){

//print_r($_FILES);
	foreach ($_FILES['spPostingPic']['tmp_name'] as $key => $postpic) {

		/*print_r($postpic);
		echo $key;*/
$file_tmp_name1 =$postpic;
    $str1 = file_get_contents($file_tmp_name1);
    $b64img1=($str1);
		$ext = pathinfo($postpic, PATHINFO_EXTENSION);

		$img = str_replace("data:image/".$ext.";base64,", "", $b64img1);
	$img = str_replace(" ", "+", $img);
	$proimgdata = base64_decode($img);

        $FeatureImg = 0;
        $pi->createPic($postid, $proimgdata, $FeatureImg);
       // echo $pi->ta->sql;
		/*print_r($ext);*/
		# code...
	}

}

//echo $pi->ta->sql;


    $rentpdata[] = array(
    	"idspPostings"=>$postid,
        "spPostListing"=>$_POST["spPostListing"],
     "spCategories_idspCategory"=>$_POST["spCategories_idspCategory"],
     "spPostingVisibility"=>$_POST["spPostingVisibility"],
     "spProfiles_idspProfiles"=>$_POST["spProfiles_idspProfiles"],
     "spPostingAlbum_idspPostingAlbum"=>$_POST["spPostingAlbum_idspPostingAlbum"],
     "spPostingTitle"=>$_POST["spPostingTitle"],
     "spPostingsCountry"=>$_POST["spPostingsCountry"],
     "spPostingsState"=>$_POST["spPostingsState"],
     "spPostingsCity"=>$_POST["spPostingsCity"],
     "spRoomRent"=>$_POST["spRoomRent"],
     "spPostingPropertyType"=>$_POST["spPostingPropertyType"],
     "spPostingSqurefoot"=>$_POST["spPostingSqurefoot"],
     "spPostingBedroom"=>$_POST["spPostingBedroom"],
     "spPostingBathroom"=>$_POST["spPostingBathroom"],
     "spPostFurnish"=>$_POST["spPostFurnish"],
     "spPostAvailFrom"=>$_POST["spPostAvailFrom"],
      "spPostAvailTo"=>$_POST["spPostAvailTo"],
     "spPostDepositAmt"=>$_POST["spPostDepositAmt"],
     "spPostRentalMonth"=>$_POST["spPostRentalMonth"],
     "spPostRentalWeek"=>$_POST["spPostRentalWeek"],
     "spPostingServicChrg"=>$_POST["spPostingServicChrg"],
     "spPostingCleaningChrg"=>$_POST["spPostingCleaningChrg"],
     "spPostingHouseStyle"=>$_POST["spPostingHouseStyle"],
     "spPostingAddress"=>$_POST["spPostingAddress"],
     "spPostingNotes"=>$_POST["spPostingNotes"],
     "spPostDog"=>$_POST["spPostDog"],
     "spPostCat"=>$_POST["spPostCat"],
     "spPostSmoke"=>$_POST["spPostSmoke"],
     "spPostStainless"=>$_POST["spPostStainless"],
     "spPostCentralAir"=>$_POST["spPostCentralAir"],
     "spPostLotsCloset"=>$_POST["spPostLotsCloset"],
     "spPostOpenFloor"=>$_POST["spPostOpenFloor"],
     "spPostBuildAment"=>$_POST["spPostBuildAment"],
     "spPostWasher"=>$_POST["spPostWasher"],
     "spPostSpacious"=>$_POST["spPostSpacious"],
     "spPostGargParking"=>$_POST["spPostGargParking"],
     "spPostJettedTub"=>$_POST["spPostJettedTub"],
     "spPostSwimPool"=>$_POST["spPostSwimPool"],
     "spPostBedType"=>$_POST["spPostBedType"],
     "spPostFirePlace"=>$_POST["spPostFirePlace"],
     "spPostBalcony"=>$_POST["spPostBalcony"],
     "spPostFenced"=>$_POST["spPostFenced"],
     "spPostFitnesArea"=>$_POST["spPostFitnesArea"],
     "spPostStorage"=>$_POST["spPostStorage"],
     "spPostClosePublic"=>$_POST["spPostClosePublic"],
     "spPostHeat"=>$_POST["spPostHeat"],
     "spPostWater"=>$_POST["spPostWater"],
    "spPostElect"=>$_POST["spPostElect"],
    "spPostCableTv"=>$_POST["spPostCableTv"],
    "spPostInternet"=>$_POST["spPostInternet"],
    "spPostSecurtyCam"=>$_POST["spPostSecurtyCam"],
    "spPostCntrlAces"=>$_POST["spPostCntrlAces"],
    "spPostFulyEquipedGym"=>$_POST["spPostFulyEquipedGym"],
    "spPostConcierge"=>$_POST["spPostConcierge"],
    "spPostElevator"=>$_POST["spPostElevator"],
    "spPostOnsiteStore"=>$_POST["spPostOnsiteStore"],
    "spPostParking"=>$_POST["spPostParking"]   );

      $data = array("status" => 200, "message" => "success","data"=>$rentpdata);
		
	}else{

		$data = array("status" => 1, "message" => "Sell Type Not Found for rent");
	}
	
	
	

/* [spOrderAdid_] => 40
    [spByuerProfileId] => 521
    [spBuyeruserId] => 384
    [size] => 
    [sporderAmount] => 123
    [spSellerProfileId] => 510
    [spOrderQty] => 1
	print_r($_POST);*/
	//$result = $p-> priviousorder($_POST["spOrderAdid_"],$_POST["spByuerProfileId"]);



echo json_encode($data);

?>