<?php
session_start();
	include('../univ/baseurl.php');
	function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    
   // print_r($_POST);



	echo $profid1=$_SESSION['pid'];
   echo $uid1=$_SESSION['uid'];

    echo $flid=$_GET['postid'];
   $f = new _flagpost;
	
//$data1=array('freelancer_id'=> $flid, 'prof_id'=> $profid1, 'user_id'=> $uid1);	
	 $id = $f->del_heart($profid1,$uid1,$flid);
	 header("location: user-profile.php?profile=$flid");
	
	
	
	?>