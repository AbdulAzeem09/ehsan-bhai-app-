<?php
	include('../univ/baseurl.php');
	session_start();
	function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
  
  $timestamp = time();

     $datetime  = date("F d, Y h:i:s", $timestamp);
	// print_r($_POST);

$data = array( 
               "spPosting_idspPosting" =>$_POST["spPosting_idspPosting"], 
               //"spProfile_idspProfile"=>$_POST["spProfile_idspProfile"],
               "spProfile_idspProfile"=>$_SESSION['pid'],
               "spCategory_idspCategory"=>$_POST["spCategory_idspCategory"],
               "why_flag"=>$_POST["why_flag"],
               "flag_desc"=>$_POST["flag_desc"],
               "flag_date"=>$datetime

               );

//print_r($data);


$sl = new _rfqflag;

$sl->create($data);

//echo $sl->ta->sql;






    
?>
		