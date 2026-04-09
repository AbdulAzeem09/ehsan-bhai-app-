<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
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


$name= $_POST['name'];
$relation =$_POST['relation'];
  


/*print_r($userid);*/

	//$sql = "INSERT INTO add_family_relation (pid, uid, family_name,family_relation)
    //VALUES ('$pid', '$uid', '$name' , '$relation')";

		/*$result = dbQuery($con, $sql);*/

	if(!mysqli_query($con, $sql)) {
        echo 'Could not insert';
    }else {
        echo "Thank you";
    }

?>
