<?php

/*print_r($_POST);*/
/*print_r($_GET);*/
	include('../univ/baseurl.php');
    include( "../univ/main.php");
	/*require_once '../library/config.php';
	require_once '../library/functions.php';*/
        //$conn = _data::getConnection();
    $con = mysqli_connect(DBHOST, UNAME, PASS);

     if(!$con) {
        die('Not Connected To Server');
    }
 
    //Connection to database
    if(!mysqli_select_db($con, DBNAME)) {
        echo 'Database Not Selected';
    }


/*print_r($_POST);exit;*/


$spuserId = $_POST['spuserId'];
$spProfileId = $_POST['spProfileId'];
$membername = $_POST['membername'];
$memberrelation = $_POST['memberrelation'];
$editid = $_POST['editid'];
$memberprofileid = $_POST['memberprofileid'];

/*print_r($userid);*/
$sql = "UPDATE userfamily SET membername='$membername',memberrelation='$memberrelation',memberprofileid='$memberprofileid' WHERE id=$editid";

//echo $sql;

	//$sql   = "INSERT INTO userfamily (spuserId, spProfileId, membername,memberrelation) VALUES ('$spuserId','$spProfileId','$membername' ,'$memberrelation')";

		/*$result = dbQuery($con, $sql);*/

	if(!mysqli_query($con, $sql)){
        echo 'Could not insert';
    }else{
        echo "Thank you";
    }

?>
