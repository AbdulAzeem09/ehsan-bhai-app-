<?php

session_start();
	function sp_autoloader($class) {
		include '../mlayer/' . $class . '.class.php';
	}
 $profile=$_SESSION['pid'];
	spl_autoload_register("sp_autoloader");
	$p = new _postings;

/*print_r($_POST);*/

$data= array('idspPostings' => $_POST['idspPostings'],'spPostingNotes' => $_POST['spPostingNotes']);

	if (isset($_POST["idspPostings"]) && $_POST["idspPostings"]!= '') {
		$postid = $p->update($data, "WHERE t.idspPostings =" . $_POST["idspPostings"]);
	
	}else{

		$postid = $p->post($data, $_FILES);

	}
	
header("Location:$BaseUrl/friends/?profileid=$profile"); 
	
?>