<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/*print_r($_POST);*/
/*print_r($_GET);*/
include('../univ/baseurl.php');
include("../univ/main.php");
/*require_once '../library/config.php';
	require_once '../library/functions.php';*/
//$conn = _data::getConnection();
$con = mysqli_connect(DBHOST, UNAME, PASS);

if (!$con) {
	die('Not Connected To Server');
}

//Connection to database
if (!mysqli_select_db($con, DBNAME)) {
	echo 'Database Not Selected';
}


/*print_r($_POST);exit;*/


$spuserId = $_POST['spuserId'];
$id = $_POST['id'];
$spProfileId = $_POST['spProfileId'];
$membername = $_POST['membername'];
$memberrelation = $_POST['memberrelation'];
$memberprofileid = $_POST['memberprofileid'];
//print_r($membername);

$membernam = explode(",", $membername);
$memberrelatio =   explode(",", $memberrelation);
//print_r($membernam);
//die('=====');  
if ($membernam) {
	$countname = count($membernam);
}
if ($memberrelatio) {
	$countrel = count($memberrelatio);
}
$idd = intval($id);
for ($i = 0; $i < $countname; $i++) {
	$idd++;
	$member = $membernam[$i];
	$relation = $memberrelatio[$i];

	$sql   = "INSERT INTO userfamily (spuserId, spProfileId, membername,memberrelation,memberprofileid) VALUES ('$spuserId','$spProfileId','$member' ,'$relation','$memberprofileid')";

	if (!mysqli_query($con, $sql)) {
	} else {
		$sqll = "SELECT * FROM `userfamily`    ORDER BY `id` DESC LIMIT 1;";
		if ($id = mysqli_query($con, $sqll)) {
			while ($row = mysqli_fetch_assoc($id)) {


				echo "<tr class='deleterecord" . $row['id'] . "'><td>" . $idd . "</td><td>" . $row['membername'] . "</td><td>" . $row['memberrelation'] . "</td><td><a href='#' id='del_fam' onclick='delfam(" . $row['id'] . ");'><i class='fa fa-trash' aria-hidden='true' ></i></a>&nbsp;<a href='#'  data-toggle='modal' data-target='#editfamilymember" . $row['id'] . "'><i class='fa fa-pencil' aria-hidden='true'></i></a></td></tr>";
			}
		}
	}
}



/*print_r($userid);*/

	

		/*$result = dbQuery($con, $sql);*/
