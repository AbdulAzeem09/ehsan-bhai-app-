<?php
	require_once '../../library/config.php';
	require_once '../../library/functions.php';
	checkUser();
	$action = isset($_GET['action']) ? $_GET['action'] : '';

	switch ($action) {
		
		case 'add' :
			add($dbConn);
			break;
		case 'modify' :
			modify($dbConn);
			break;
		case 'delete' :
			deletee($dbConn);
			break;
		
		
		default :
			redirect('index.php');
	}

	//Add 
	function add($dbConn){
		//$pageId	= mysqli_real_escape_string($dbConn, $_POST['pageId']);
		//$txtDesc =  $_POST['txtDesc'];
		$module =  $_POST['module'];
		$question =  $_POST['faq_question'];
	    $answer =	$_POST['faq_answer'];

		//print_r($question);

		//print_r($answer);

	  $timestamp = time();

     $datetime  = date("F d, Y h:i:s", $timestamp);

		// File upload path
 $sql2 = "INSERT INTO store_faq(module, spfaq_question, spfaq_answer, created
) VALUES ('$module', '$question', '$answer', '$datetime')";



		$result2 = dbQuery($dbConn, $sql2);
		$_SESSION['count'] = 0;
		$_SESSION['data'] = "success";
		$_SESSION['errorMessage'] = "Added Successfully.";
		redirect("index.php?view=list");
	
	}





	//modify 
	function modify($dbConn){
		$hidId	= mysqli_real_escape_string($dbConn, $_POST['hidId']);
		$faq_question = $_POST['faq_question'];
		$faq_answer = $_POST['faq_answer'];


		$sql = "UPDATE store_faq SET spfaq_question = '$faq_question', spfaq_answer = '$faq_answer'  WHERE id = $hidId";


		$result = dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['data'] = "success";
		$_SESSION['errorMessage'] = "Updated Successfully.";
		redirect("index.php?view=list");
	
	}
	
		function deletee($dbConn) {

		if(isset($_GET['faqId']) && ($_GET['faqId'])>0 ){
			$faqId = $_GET['faqId'];
		}else{
			redirect("index.php");
			exit();
		}
		
		$sql    =	"DELETE FROM store_faq WHERE id ='$faqId'";		
		$result = 	 dbQuery($dbConn, $sql);
		$_SESSION['count'] = 0;
		$_SESSION['data'] = "success";
		$_SESSION['errorMessage'] = "Delted Successfully";
		redirect("index.php?view=list");
		
	}
	

	

?>