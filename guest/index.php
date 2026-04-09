<?php 
	include("../univ/baseurl.php");
	session_start();  
	
 $_SESSION['login_user'] = 'Guest User';
    $_SESSION['uid'] = 2324;
    $_SESSION['spUserEmail'] = 'guestuser@gmail.com';
    $_SESSION['pid'] = 2626;
    $_SESSION['myprofile'] = 'Guest User';
    $_SESSION['MyProfileName'] = 'Guest User';
    $_SESSION['ptname'] = 'Employment' ;
    $_SESSION['ptpeicon'] = 'fa fa-graduation-cap';
    $_SESSION['ptid'] = 5 ;
    $_SESSION['isActive'] = 1;
    $_SESSION['cartcount'] = 0 ;
    $_SESSION['monthtext'] = 'June' ;
    $_SESSION['monthvalue'] = 06 ;
    $_SESSION['mystore'] = 0;
	$_SESSION['guet_yes'] = 'yes';
	
	header("location: ".$BaseUrl."/timeline/");
	
	?>
	
	 