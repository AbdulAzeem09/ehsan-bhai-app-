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
	$p = new _classified;
 
  //_spproductsize
/*print_r($_POST);*/
if($_POST["spPostingTitle"] ){


    $rentdata = array(
    
     "spCategories_idspCategory"=>7,
     "spPostingVisibility"=>$_POST["spPostingVisibility"],
     "spProfiles_idspProfiles"=>$_POST["spProfiles_idspProfiles"],

     "spPostingTitle"=>$_POST["spPostingTitle"],
     "spPostingsCountry"=>$_POST["spPostingsCountry"],
     "spPostingsState"=>$_POST["spPostingsState"],
     "spPostingsCity"=>$_POST["spPostingsCity"],
     "spPostingExpDt"=> date('Y-m-d', strtotime("+30 days")),
     "spPostCountry"=>$_POST["spPostCountry"],
     "spPostState"=>$_POST["spPostState"],
     "spPostCity"=>$_POST["spPostCity"],
     "spPostPostalCode"=>$_POST["spPostPostalCode"],
     "spPostSelection"=>$_POST["spPostSelection"],
     "spPostSerComty"=>$_POST["spPostSerComty"],
      "spPostingNotes"=>$_POST["spPostingNotes"],
     "spPostingAgree"=>$_POST["spPostingAgree"],
     "spPostShowPhone"=>$_POST["spPostShowPhone"],
     "spPostShowEmail"=>$_POST["spPostShowEmail"]
    
   );



		$postid = $p->post($rentdata);
     /*echo $p->ta->sql;*/
    /*echo $mysqli->info;
    echo $postid;*/
/*
echo trim($postid);*/
$pi = new _classifiedpic;


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
           "spCategories_idspCategory"=>7,
     "spPostingVisibility"=>$_POST["spPostingVisibility"],
     "spProfiles_idspProfiles"=>$_POST["spProfiles_idspProfiles"],
   
     "spPostingTitle"=>$_POST["spPostingTitle"],
     "spPostingsCountry"=>$_POST["spPostingsCountry"],
     "spPostingsState"=>$_POST["spPostingsState"],
     "spPostingsCity"=>$_POST["spPostingsCity"],
     "spPostingExpDt"=> date('Y-m-d', strtotime("+30 days")),
     "spPostCountry"=>$_POST["spPostCountry"],
     "spPostState"=>$_POST["spPostState"],
     "spPostCity"=>$_POST["spPostCity"],
     "spPostPostalCode"=>$_POST["spPostPostalCode"],
     "spPostSelection"=>$_POST["spPostSelection"],
     "spPostSerComty"=>$_POST["spPostSerComty"],
      "spPostingNotes"=>$_POST["spPostingNotes"],
     "spPostingAgree"=>$_POST["spPostingAgree"],
     "spPostShowPhone"=>$_POST["spPostShowPhone"],
     "spPostShowEmail"=>$_POST["spPostShowEmail"]   
 );

      $data = array("status" => 200, "message" => "success","data"=>$rentpdata);
		
	}else{

		$data = array("status" => 1, "message" => "Title Not Found");
	}
	
	




echo json_encode($data);

?>