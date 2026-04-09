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
	
	$us->delete_user($id);
	//header("Location:$BaseUrl/store/pos-dashboard/settings.php");
	}else{
	
	$data=array("spuser_idspuser"=>$_SESSION['uid'],
	"spprofiles_idspprofiles"=>$_SESSION['pid'],
	"user_name"=>$_POST['user_name'],
	"email"=>$_POST['email'],
	"phone"=>$_POST['contact'],
	"role"=>$_POST['role']
	);
	
	$us->add_users($data);
	}
	header("Location:$BaseUrl/store/pos-dashboard/settings.php?record=users_type");