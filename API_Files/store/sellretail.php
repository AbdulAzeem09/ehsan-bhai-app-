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
	$p = new _productposting;
 
 $s = new _spproductsize;
  //_spproductsize
/*print_r($_POST);*/
if($_POST["sellType"] == "Retail" ){

    /*echo"here";*/

    $retaildata = array(
     "sellType"=>$_POST["sellType"],
     "spCategories_idspCategory"=>$_POST["spCategories_idspCategory"],
     "spPostingVisibility"=>$_POST["spPostingVisibility"],
     "spProfiles_idspProfiles"=>$_POST["spProfiles_idspProfiles"],
     "spPostingTitle"=>$_POST["spPostingTitle"],
     "spPostingExpDt"=>$_POST["spPostingExpDt"],
     "spPostingsFlag"=>$_POST["spPostingsFlag"],
     "subcategory"=>$_POST["subcategory"],
     "quantitytype"=>$_POST["quantitytype"],
     "retailDiscount"=>$_POST["retailDiscount"],
     "retailSpecDiscount"=>$_POST["retailSpecDiscount"],
     "retailQuantity"=>$_POST["retailQuantity"],
     "retailStatus"=>$_POST["retailStatus"],
     "spPostingPrice"=>$_POST["spPostingPrice"],
     "spPostingNotes"=>$_POST["spPostingNotes"],
     "specification"=>$_POST["specification"],
     "spPostingEmail"=>$_POST["spPostingEmail"]
   );


		$postid = $p->create($retaildata);
    // echo $p->ta->sql;
    /*echo $mysqli->info;
    echo $postid;*/
/*
echo trim($postid);*/
$pi = new _productpic;

	
	/*$img = $_POST["spPostingPic"];*/

	/*print_r($_POST);*/
	
	

//$pi->createPic($_POST["spPostings_idspPostings"], $data, $FeatureImg);
if(isset($_FILES['spfeaturePic']['name'])){
	/*print_r($_FILES['spfeaturePic']['name']);*/
	/*foreach ($_FILES['spPostingPic']['name'] as $key => $postpic) {*/
$file_tmp_name =$_FILES['spfeaturePic']['tmp_name'];
    $str = file_get_contents($file_tmp_name);
    $b64img=($str);
/*print_r($b64img);*/
		$ext = pathinfo($_FILES['spfeaturePic']['name'], PATHINFO_EXTENSION);

		$img = str_replace("data:image/".$ext.";base64,", "", $b64img);
	    $img = str_replace(" ", "+", $img);
	    $profimgdata = base64_decode($img);
/*print_r($profimgdata);*/
        $FeatureImg = 1;
       $pi->createPic($postid, $profimgdata, $FeatureImg);
		/*print_r($ext);*/
		# code...
	/*}*/

}

if(isset($_FILES['spPostingPic']['name'])){

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
		/*print_r($ext);*/
		# code...
	}

}

if($_POST["subcategory"] == "Shoes"){


 $sizedata = array(
         "productid"=>$postid,
         "shoesize1"=>$_POST["shoesize1"],
         "shoesize2"=>$_POST["shoesize2"],
         "shoesize3"=>$_POST["shoesize3"],
         "shoesize4"=>$_POST["shoesize4"],
         "shoesize5"=>$_POST["shoesize5"],
         "shoesize6"=>$_POST["shoesize6"],
         "shoesize7"=>$_POST["shoesize7"],
         "shoesize8"=>$_POST["shoesize8"],
         "shoesize9"=>$_POST["shoesize9"],
         "shoesize10"=>$_POST["shoesize10"],
         "shoesize11"=>$_POST["shoesize11"],
         "shoesize12"=>$_POST["shoesize12"],
         "shoesize13"=>$_POST["shoesize13"],
         "shoesize14"=>$_POST["shoesize14"]

     );

}


if($_POST["subcategory"] == "Clothing"){


 $sizedata = array(

         "productid"=>$postid,
         "sizeXS"=>$_POST["sizeXS"],
         "sizeS"=>$_POST["sizeS"],
         "sizeM"=>$_POST["sizeM"],
         "sizeL"=>$_POST["sizeL"],
         "sizeXL"=>$_POST["sizeXL"],
         "sizeXXL"=>$_POST["sizeXXL"],
         "sizeXXXL"=>$_POST["sizeXXXL"]       
    
     );

}

      $s->create($sizedata);


    $proretaildata[] = array(
    	"idspPostings"=>$postid,
     "sellType"=>$_POST["sellType"],
     "spCategories_idspCategory"=>$_POST["spCategories_idspCategory"],
     "spPostingVisibility"=>$_POST["spPostingVisibility"],
     "spProfiles_idspProfiles"=>$_POST["spProfiles_idspProfiles"],
     "spPostingTitle"=>$_POST["spPostingTitle"],
     "spPostingExpDt"=>$_POST["spPostingExpDt"],
     "spPostingsFlag"=>$_POST["spPostingsFlag"],
     "subcategory"=>$_POST["subcategory"],
     "quantitytype"=>$_POST["quantitytype"],
     "retailDiscount"=>$_POST["retailDiscount"],
     "retailSpecDiscount"=>$_POST["retailSpecDiscount"],
     "retailQuantity"=>$_POST["retailQuantity"],
     "retailStatus"=>$_POST["retailStatus"],
     "spPostingPrice"=>$_POST["spPostingPrice"],
     "spPostingNotes"=>$_POST["spPostingNotes"],
     "specification"=>$_POST["specification"],
     "spPostingEmail"=>$_POST["spPostingEmail"]
   );

      $data = array("status" => 200, "message" => "success","data"=>$proretaildata);
		
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