<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");

		$profile_id = $_POST['profile_id'];
    $postid = $_POST['postid'];


  $pl = new _postlike;


$userliked = $pl->likeread($postid,$profile_id);

  // echo $pl->ta->sql;

/*print_r($userliked);*/

$userdata= array("profile_id"=>$profile_id,"postid"=>$postid);

if(!empty($userliked)){

$unlike =  $pl->unlike($postid,$profile_id);

$data = array("status" => 200, "message" => "Unlike Successfully","data"=>$userdata);
}else{

  $pl->addlike(array("spProfiles_idspProfiles" => $profile_id, "spPostings_idspPostings" => $postid));
$data = array("status" => 200, "message" => "Like Successfully","data"=>$userdata);
}

 //$id = $pl->addlike(array("spProfiles_idspProfiles" => $_POST["profile_id"], "spPostings_idspPostings" => $_POST["postid"]));


    //$profile_id = $_GET['profile_id'];

   // print_r($profile_id);
		//$device_id = $_POST['device_id'];
         //$device_type = $_POST['device_type'];

   echo json_encode($data);
	
?>  