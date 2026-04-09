<?php

/*print_r($_POST);*/
/*print_r($_GET);*/
	include('../univ/baseurl.php');
    include( "../univ/main.php");
	/*require_once '../library/config.php';
	require_once '../library/functions.php';*/
        //$conn = _data::getConnection();
    $con = mysqli_connect(DOMAIN, UNAME, PASS);

     if(!$con) {
        die('Not Connected To Server');
    }
 
    //Connection to database
    if(!mysqli_select_db($con, DBNAME)) {
        echo 'Database Not Selected';
    }


/*print_r($_POST);exit;*/


$id = $_POST['id'];



/*print_r($userid);*/

	$sql = "DELETE FROM userfamily WHERE id=$id";

		/*$result = dbQuery($con, $sql);*/

	if(!mysqli_query($con, $sql)) {
        echo 'Could not insert';
    }else {
        echo "Thank you";
    }

?>
