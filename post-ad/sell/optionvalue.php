<?php
	include('../../univ/baseurl.php');
session_start();

	 function sp_autoloader($class){
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
	
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

$ponv = new _spproductoptionsvalues;

$result = $ponv->readbyoptionid($_SESSION['uid'],$_SESSION['pid'],$_POST['idsop']);

$output= '<option value="">Select Name</option>';
if ($result) {
 while ($row = mysqli_fetch_assoc($result)) {

		$output .= '<option value="'.$row['idsopv'].'||'.$row['opton_values'].'">'.$row['opton_values'].'</option>';
		

	}
}
else{
        $output= "";
     }		  
 
 echo json_encode(array('output'=> $output));
    


?>