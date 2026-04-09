<?php
	$headers = "From: THE the-share-page <admin@thethe-share-page.com> \r\n";
	$msg = "Hi \r\n\r\n";
	
	$msg .= "Profile ".$_POST["profilename"]." has shared a post with you, click on the link below to access the post on The the-share-page\r\n\r\n\r\n";
	
	$msg .= "http://dev.thethe-share-page.com//post-details/?postid=".$_POST["postid"]."\r\n\r\n\r\n";
	mail($_POST["recipientemail"], "The SharePage, Shared post.", $msg, $headers);
?>