<?php
	include('../univ/baseurl.php');
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$r = new _spgroup;
	$group_id = $_POST["gid"];
	$res = $r->readMember($_POST["pid"],$group_id);
	if($res != false)
	{
		// echo "Your request has been successfully send to group admin for approval";
		echo json_encode(array('status'=>'pending','message'=>"Your request is pending for admin approval"));
	}
	else
	{
		$res = $r->creterequest($group_id , $_POST["pid"]);
		if($res > 0){
			$personal_profile = $r->getGroupPersonalProfileWithGroup($group_id);
			if($personal_profile && !empty($personal_profile['spProfileEmail'])){
				$email = new _email;
				$message = "<p>You have received new Group Join Reqeust</p> <p>Click to view pending request.</p>
					<a href='".$BaseUrl."/grouptimelines/?groupid=".$group_id."&groupname=".$personal_profile['group_name']."&timeline&page=pending-members'>View Pending Request</a>
					";
				$email->sendCommonMail($personal_profile['spProfileName'], $personal_profile['spProfileEmail'], 'New Group Join Request',$message);
			}
			echo json_encode(array('status'=>'success','message'=>"Your request has been successfully sent to group admin for approval"));
		} else {
			echo json_encode(array('status'=>'failed','message'=>"Please contact admin or try later"));
		}
	}
	
?>