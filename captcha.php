<?php
	session_start();

	$ranStr = $_SESSION['cap_code'];
	$newImage = imagecreatefromjpeg("assets/images/cap_bg.jpg");
	$txtColor = imagecolorallocate($newImage, 255, 255, 255);
	imagestring($newImage, 9, 5, 8, $ranStr, $txtColor);
	header("Content-type: image/jpeg");
	imagejpeg($newImage);
?>


