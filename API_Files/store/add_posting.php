<?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");

/*$postid = $_POST['spPostings_idspPostings'];
*/
$spCategories_idspCategory = $_POST['spCategories_idspCategory'];
$spPostingVisibility = $_POST['spPostingVisibility'];

$spPostingDate = $_POST['spPostingDate'];
$spPostingNotes =  $_POST['spPostingNotes'];

$spProfiles_idspProfiles =  $_POST['spProfiles_idspProfiles'];



 //print_r($_POST);
 $p = new _postings;

	$pc = new _postingpic;

	$pa = new _postingalbum;

						
$postdata= array( 
	          "spCategories_idspCategory" => $spCategories_idspCategory,
	          "spPostingVisibility" => $spPostingVisibility,
	          "spProfiles_idspProfiles" => $spProfiles_idspProfiles,
	          "spPostingDate" => $spPostingDate,
	           "spPostingNotes" => $spPostingNotes,

              );



	if(!empty($spCategories_idspCategory)){
		//echo "here";

		//print_r($_POST);
		$id = $p->post($postdata);


       
if(isset($_FILES['spPostingPic']['name'])){
	/*print_r($_FILES['spfeaturePic']['name']);*/
	/*foreach ($_FILES['spPostingPic']['name'] as $key => $postpic) {*/
$file_tmp_name =$_FILES['spPostingPic']['tmp_name'];
    $str = file_get_contents($file_tmp_name);
    $b64img=($str);
/*print_r($b64img);*/
		$ext = pathinfo($_FILES['spPostingPic']['name'], PATHINFO_EXTENSION);

		$img = str_replace("data:image/".$ext.";base64,", "", $b64img);
	    $img = str_replace(" ", "+", $img);
	    $profimgdata = base64_decode($img);
/*print_r($profimgdata);*/
        $FeatureImg = 1;
       $pc->createPic($id, $profimgdata, $FeatureImg);
		/*print_r($ext);*/
		# code...
	/*}*/
}


if(isset($_FILES['spPostingMedia']['name']) || isset($_FILES['spPostingDocument']['name'])){

	$UploadDirectory	= '../../upload/';

	if($_FILES['spPostingDocument']['size'] != 0){
		$File_Name = strtolower($_FILES['spPostingDocument']['name']);
	}
	
	if($_FILES['spPostingMedia']['size'] != 0){
		$File_Name   = strtolower($_FILES['spPostingMedia']['name']);
	}
	//echo $File_Name;
	//$File_Name          = strtolower($_FILES['spPostingMedia']['name']);
	$File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention
	$Random_Number      = rand(0, 9999999999); //Random number to be added to name.

	//echo $File_Name;


	$FileExt = str_replace('.', '', $File_Ext);
	if($FileExt == 'mp3'){
		$spFileName = "audio";
	}else if($FileExt == 'mp4'){
		$spFileName = "video";
	}else if($FileExt == "pdf"){
		$spFileName = "pdf";
	}else{
		$spFileName = "document";
	}

	//$NewFileName 		= $spFileName."-".$Random_Number.$File_Ext; //new file name
	$NewFileName 		= $File_Name; //new file name

	if(move_uploaded_file($_FILES['spPostingMedia']['tmp_name'], $UploadDirectory.$NewFileName )){
		//die('Success! File Uploaded.');
		
	}
	if(move_uploaded_file($_FILES['spPostingDocument']['tmp_name'], $UploadDirectory.$NewFileName )){
		//die('Success! File Uploaded.');
	}

	
	$albumid = $_POST["spPostingAlbum_idspPostingAlbum"];
	//$img = str_replace("data:".$_POST["ext"]."base64,", "", $img);
	//$img = str_replace(" ", "+", $img);
	//$data = base64_decode($img);
	
	$pa->create($id, $albumid, $NewFileName, $FileExt, $spProfiles_idspProfiles);

}
		//print_r($id);
	    // echo $pa->ta->sql;

	$data = array("status" => 200, "message" => "success","data"=>$postdata);


	}else{

		$data = array("status" => 1, "message" => "Enter post id");
	}	


echo json_encode($data);

?>


