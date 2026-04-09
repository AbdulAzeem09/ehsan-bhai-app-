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
if($_POST["spPostListing"] == "Sell" ){

    /*echo"here";*/

    $selldata = array(
     "spPostListing"=>$_POST["spPostListing"],
     "spCategories_idspCategory"=>$_POST["spCategories_idspCategory"],
     "spPostingVisibility"=>$_POST["spPostingVisibility"],
     "spProfiles_idspProfiles"=>$_POST["spProfiles_idspProfiles"],
     "spPostingAlbum_idspPostingAlbum"=>$_POST["spPostingAlbum_idspPostingAlbum"],
     "spPostingTitle"=>$_POST["spPostingTitle"],
     "spPostingsCountry"=>$_POST["spPostingsCountry"],
     "spPostingsState"=>$_POST["spPostingsState"],
     "spPostingsCity"=>$_POST["spPostingsCity"],
     "spPostingPropertyType"=>$_POST["spPostingPropertyType"],
     "spPostingPropStatus"=>$_POST["spPostingPropStatus"],
     "spPostingPostalcode"=>$_POST["spPostingPostalcode"],
     "spPostingYearBuilt"=>$_POST["spPostingYearBuilt"],
     "spPostingBedroom"=>$_POST["spPostingBedroom"],
     "spPostingBathroom"=>$_POST["spPostingBathroom"],
     "spPostBasement"=>$_POST["spPostBasement"],
     "spPostingPrice"=>$_POST["spPostingPrice"],
      "spPostingSqurefoot"=>$_POST["spPostingSqurefoot"],
     "spPostUnitNum"=>$_POST["spPostUnitNum"],
     "spPostTaxAmt"=>$_POST["spPostTaxAmt"],
     "spPostTaxYear"=>$_POST["spPostTaxYear"],
     "spPostListId"=>$_POST["spPostListId"],
     "spPostingHouseStyle"=>$_POST["spPostingHouseStyle"],
     "spPostingAddress"=>$_POST["spPostingAddress"],
     "spPostingNotes"=>$_POST["spPostingNotes"],
     "spPostingOpenHouse"=>$_POST["spPostingOpenHouse"],
     "spPostingSoldBy"=>$_POST["spPostingSoldBy"],
     "spPostingkeyword"=>$_POST["spPostingkeyword"],
     "openHouseDayone"=>$_POST["openHouseDayone"],
     "openHouseDayoneStrtTime"=>$_POST["openHouseDayoneStrtTime"],
     "openHouseDayoneEndTime"=>$_POST["openHouseDayoneEndTime"],
     "openHouseDayTwo"=>$_POST["openHouseDayTwo"],
     "openHouseDayTwoStrtTime"=>$_POST["openHouseDayTwoStrtTime"],
     "openHouseDayTwoEndTime"=>$_POST["openHouseDayTwoEndTime"]


   );



		$postid = $p->post($selldata);
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


    $sellpdata[] = array(
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
     "spPostingPropertyType"=>$_POST["spPostingPropertyType"],
     "spPostingPropStatus"=>$_POST["spPostingPropStatus"],
     "spPostingPostalcode"=>$_POST["spPostingPostalcode"],
     "spPostingYearBuilt"=>$_POST["spPostingYearBuilt"],
     "spPostingBedroom"=>$_POST["spPostingBedroom"],
     "spPostingBathroom"=>$_POST["spPostingBathroom"],
     "spPostBasement"=>$_POST["spPostBasement"],
     "spPostingPrice"=>$_POST["spPostingPrice"],
      "spPostingSqurefoot"=>$_POST["spPostingSqurefoot"],
     "spPostUnitNum"=>$_POST["spPostUnitNum"],
     "spPostTaxAmt"=>$_POST["spPostTaxAmt"],
     "spPostTaxYear"=>$_POST["spPostTaxYear"],
     "spPostListId"=>$_POST["spPostListId"],
     "spPostingHouseStyle"=>$_POST["spPostingHouseStyle"],
     "spPostingAddress"=>$_POST["spPostingAddress"],
     "spPostingNotes"=>$_POST["spPostingNotes"],
     "spPostingOpenHouse"=>$_POST["spPostingOpenHouse"],
     "spPostingSoldBy"=>$_POST["spPostingSoldBy"],
     "spPostingkeyword"=>$_POST["spPostingkeyword"],
     "openHouseDayone"=>$_POST["openHouseDayone"],
     "openHouseDayoneStrtTime"=>$_POST["openHouseDayoneStrtTime"],
     "openHouseDayoneEndTime"=>$_POST["openHouseDayoneEndTime"],
     "openHouseDayTwo"=>$_POST["openHouseDayTwo"],
     "openHouseDayTwoStrtTime"=>$_POST["openHouseDayTwoStrtTime"],
     "openHouseDayTwoEndTime"=>$_POST["openHouseDayTwoEndTime"]
   );

      $data = array("status" => 200, "message" => "success","data"=>$sellpdata);
		
	}else{

		$data = array("status" => 1, "message" => "Sell Type Not Found");
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