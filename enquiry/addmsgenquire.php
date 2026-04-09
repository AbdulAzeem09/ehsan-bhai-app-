<?php
	
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
include('../univ/baseurl.php');
	function sp_autoloader($class){
	 include '../mlayer/' . $class . '.class.php';

	}
	spl_autoload_register("sp_autoloader");


//print_r($_POST);
//$iddd=$_POST['spPostings_idspPostings'];

$iddd = isset($_POST['spPostings_idspPostings']) ? (int)$_POST['spPostings_idspPostings'] : 0;
$modulename = isset($_POST['modulename']) ? $_POST['modulename'] : '';
$sellerProfileid = isset($_POST['sellerProfileid']) ? (int) $_POST['sellerProfileid'] : 0;
	
//$currentDateTime = date('Y-m-d H:i:s');

$pe = new _sppostenquiry;
$pe->create($_POST);
//header("Location: $BaseUrl/store/detail.php?catid=1&postid=$iddd&msg=conf");
header("Location: $BaseUrl/wholesale/index.php?page=1&folder=wholesale&msg=conf");
/*

	print_r($_POST);
	
	


$data= array(         "buyerProfileid"=>$_POST["buyerProfileid"],
	                  "sellerProfileid"=>$_POST["sellerProfileid"],
	                  "spPostings_idspPostings"=>$_POST["spPostings_idspPostings"],
	                  "message"=>$_POST["message"]
	                 

    
	                  
	                  
                  );



$pl = new _postenquiry;
	$pl->addenquiry($data);*/

//print_r($data);

//echo $b->ta->sql;

//$modulename=$_POST['modulename'];
	$p = new _spprofiles;

	$rpvt = $p->read($sellerProfileid);

	if ($rpvt != false)
	{
		$row = mysqli_fetch_assoc($rpvt);
		//print_r($row);
		//$email = $row["spProfileEmail"];
		$name=$row['spProfileName'];
		$words = explode(" ", $name);

$firstname = $words[0];
$fname=ucfirst($firstname);
$lastname = $words[1];

	}
		//$email="anoopmauryaam02@gmail.com";
		
	$headers = "From: THE SHAREPAGE <admin@thesharepage.com> \r\n";
	$msg = "Hello $fname \r\n";
	$msg .= "You have a new enquiry on your post from the 'Store Module' .\r\n";

	$msg .= "Please login and visit your dashboard of the module to read the message.\r\n\r\n";
	$msg .= "<a href = '$BaseUrl/login.php'>Login to your account</a>.\r\n";
	
	$msg .= "Thank you.\r\n";
	$msg .= "The SharePage"; 
	
	mail($email, "New Enquiry ($modulename) - The SharePage", $msg, $headers);
         // 


	//die('===========');
     //header("location:http://localhost/sharepagego/Sharepage/wholesale/");
 ?>

<script type="text/javascript">
	/*$(document).ready(function(){
	$("#email").click(function(){
	
	alert('11111');
	
	
	});
	});*/
	</script>
