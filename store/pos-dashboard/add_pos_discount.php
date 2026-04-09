<?php
   session_start();
    include('../../univ/baseurl.php');

    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");
	
	
	$us= new _pos;
	if($_GET['action']=="delete"){
	$id=$_GET['id'];
	
	$us->delete_discount($id);
	
	}else{
	
	$data=array("spuser_idspuser"=>$_SESSION['uid'],
	"spprofiles_idspprofiles"=>$_SESSION['pid'],
	
	"discount_type"=>$_POST['discount_type'],
	"discount_value"=>$_POST['discount_value']
	);
	
	$us->add_discount($data);
	}
	header("Location:$BaseUrl/store/pos-dashboard/settings.php?record=discount_type");