<?php
session_start();
function sp_autoloader($class){
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
//spShareByWhom,spPostings_idspPostings,spShareToGroup,spShareToWhom
$pl = new _postshare;
$re = new _redirect;  

$flag = 0;
$result = $pl->read();
//print_r($_POST);die;
// exit;

//if (isset($_POST['btnshare'])) {
//echo $pl->ta->sql;
if($result != false){

if(!isset($_POST["spShareToWhom"])){
$_POST["spShareToWhom"]=0;
}

if(!isset($_POST["spShareToGroup"])){
$_POST["spShareToGroup"]=0;
}	

while($row = mysqli_fetch_assoc($result)){	
if( $row["spPostings_idspPostings"] == $_POST['spPostings_idspPostings'] && $row['spShareByWhom'] == $_POST["spShareByWhom"] &&  $row["spShareToWhom"] == $_POST["spShareToWhom"] && $row["spShareToGroup"] == $_POST["spShareToGroup"]){
$url = "../timeline";
$re->redirect($url);
//header("Location:../timeline");
$flag++;
}
}
}
if (isset($_POST["spShareToWhom"])) {
	if (is_array($_POST["spShareToWhom"])) {
		if($flag == 0){
			// added the timeline Id as it dependents for timeline all post queries.
				$_POST["timelineid"] = $_POST['spPostings_idspPostings'];
				$friends_ids=$_POST["spShareToWhom"];
				foreach($friends_ids as $frnd_ids)
				{
					$_POST["spShareToWhom"] = $frnd_ids;
					$_POST["spShareToGroup"] = 0;
 	//echo "<pre>";
 //print_r($_POST); 
	$arr=array('buyerProfileid'=>$_POST["spShareByWhom"],
				'sellerProfileid'=>$_POST["spShareToWhom"],
				'spPostings_idspPostings'=>$_POST["spPostings_idspPostings"],
				'message'=>"Shared a Post Click Here",
				'module'=>"Timeline"
	);
 
			$pl->Share_To($arr);


			$pl->share($_POST);
				}
///die('xxxxxxxxxxxxx');store/detail.php?catid=1&postid=2418
			$url = "../store/detail.php?catid=1&postid=".$_POST["spPostings_idspPostings"];
			$re->redirect($url);
			//header("Location:../timeline");
		}
	}	
}
if (isset($_POST["spShareToGroup"])) {
	if (is_array($_POST["spShareToGroup"])) {
		if($flag == 0){
			// added the timeline Id as it dependents for timeline all post queries.
				$_POST["timelineid"] = $_POST['spPostings_idspPostings'];
				$groups_ids=$_POST["spShareToGroup"];
				foreach($groups_ids as $grp_ids)
				{
					$_POST["spShareToGroup"] = $grp_ids;
					$_POST["spShareToWhom"] = 0;

					$pl->share($_POST);
				}	
			$url = "../timeline";
			$re->redirect($url);
			//header("Location:../timeline");
		}
	}
}
if($flag == 0) { 
$_POST["timelineid"] = $_POST['spPostings_idspPostings'];
if (isset($_POST["spShareToWhom"]) && is_array($_POST["spShareToWhom"])) {
// added the timeline Id as it dependents for timeline all post queries.
$friends_ids=$_POST["spShareToWhom"];
foreach($friends_ids as $frnd_ids)
{
$_POST["spShareToWhom"] = $frnd_ids;
$_POST["spShareToGroup"] = 0;
date_default_timezone_set("Asia/Karachi");
$_POST["created"] = date("Y-m-d h:i:s");
$pl->share($_POST);     
}
}
else if (isset($_POST["spShareToGroup"]) && is_array($_POST["spShareToGroup"])) {
// added the timeline Id as it dependents for timeline all post queries.
$groups_ids=$_POST["spShareToGroup"];
foreach($groups_ids as $grp_ids)
{
$_POST["spShareToGroup"] = $grp_ids;
$_POST["spShareToWhom"] = 0;
date_default_timezone_set("Asia/Karachi");
$_POST["created"] = date("Y-m-d h:i:s");

$pl->share($_POST);
}	
}
$_SESSION['cnf_msg'] = 1 ;
$url = "../timeline";
//print_r($_SESSION); die("-----");
$re->redirect($url);
}
//}//else{
$url = "../timeline";
$re->redirect($url);
//}



?>