	
<?php
	session_start();
	include('../univ/baseurl.php');
	function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

$data=array("uid"=>$_SESSION['uid'],
"pid"=>$_SESSION['pid'],
"category"=>$_POST['category'],
"about_course"=>$_POST['about'],
"email"=>$_POST['email'],
"quantity"=>$_POST['qty']);
//print_r($data);die;



$po= new _postings;
$po1=$po->request_course($data);


$modulename=$_POST['modulename'];
//echo $modulename;die;
	$p = new _spprofiles;

	$rpvt = $p->read($_SESSION["pid"]);

	if ($rpvt != false)
	{
		$row = mysqli_fetch_assoc($rpvt);
		//print_r($row);
		$email = $row["spProfileEmail"];
		$name=$row['spProfileName'];
		$words = explode(" ", $name);

$firstname = $words[0];
$fname=ucfirst($firstname);
$lastname = $words[1];

	}




	$em = new _email;
 
	$re = $em->course_req_mail($_POST['email'],$name);

	//echo $re;die("=============");


		//$email="anoopmauryaam02@gmail.com";
		
/*	$headers = "From: THE SHAREPAGE <admin@thesharepage.com> \r\n";
	$msg = "Hello $fname \r\n";
	$msg .= "You have made a new request for a training from the 'Trainings Module' .\r\n";

	$msg .= "Please check regularly about the status of your request about the training.\r\n\r\n";
	$msg .= "<a href = 'https://dev.thesharepage.com/login.php'>Login to your account</a>.\r\n";
	
	$msg .= "Thank you.\r\n";
	$msg .= "The SharePage"; 
	
	mail($email, "New Enquiry ($modulename) - The SharePage", $msg, $headers);*/
    $re = new _redirect;
    $re->redirect($BaseUrl."/trainings/?msg=requested");
?>
		