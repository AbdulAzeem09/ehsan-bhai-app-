<?php
    
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");


      



print_r($_POST);
echo "here";




/*
	$name = $_POST['cname'];
	$email = $_POST['cemail'];
	$message = $_POST['cmessage'];*/
	//$useremail =  $_POST['useremail'];


	/*
	$to = $_POST['useremail'];
	$headers = "From : " . $email;
	
	if( mail($to, $message, $headers)){
		echo "E-Mail Sent successfully, we will get back to you soon.";
	}*/

	
 
$sl = new _storecontact_info;

$sl->create($_POST);

echo $sl->ta->sql;



?>