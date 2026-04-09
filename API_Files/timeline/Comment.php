<?php
	
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");

		$profile_id = $_POST['profile_id'];
    $postid = $_POST['postid'];
     $userid = $_POST['userid'];
     $comment = $_POST['comment'];
//print_r($_POST);


$commentdata = array(
	           
	           "spPostings_idspPostings"=>$postid,
	           "spProfiles_idspProfiles"=>$profile_id,
	           "userid"=>$userid,
	           "comment"=>$comment

	         );
//print_r($commentdata);
   
$p = new _comment;
$comment_id =	$p->commentapi($commentdata);


/*$com_id = array_filter($comment_id); */ 
if($comment_id > 0){


$userdata= array(
	           "comment_id"=>$comment_id,
	           "spPostings_idspPostings"=>$postid,
	           "spProfiles_idspProfiles"=>$profile_id,
	           "userid"=>$userid,
	           "comment"=>$comment,

	         );

$data = array("status" => 200, "message" => "Comment Added Successfully","data"=>$userdata);
}else{

$data = array("status" => 1, "message" => "Failed to Add Comment");
}

   echo json_encode($data);
	
?>  