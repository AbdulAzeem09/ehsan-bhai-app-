<?php
	include('../univ/baseurl.php');

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$p = new _artgalleryenquiry;
	$idartenquiry = $p->create($_POST);
	//echo $idartenquiry; die;
	
	$n = new _notification;	
	
	$to_id = $_GET['ArtistId'];
	$from_id = $_POST['spProfile_idspProfile'];
	$module = 'artcraft';
	$by_seller_or_buyer = 2;
	
	$message =  '<b>Enquiery Update </b>: You have a New Message from Buyer on Enquery, <a href="/artandcraft/dashboard/enquiry-details.php?idartenquiry='.$idartenquiry.'">Click to View</a>';


   $n->createCreatenotification($from_id,$to_id,$message,$module,$by_seller_or_buyer);	
	
	
	//header('location:../photos/myenquiry.php');
	$re = new _redirect;
    $re->redirect($BaseUrl."/artandcraft/dashboard/my-enquiry.php");
	
?>