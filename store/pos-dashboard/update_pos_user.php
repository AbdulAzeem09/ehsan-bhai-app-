<?php
   session_start();
    include('../../univ/baseurl.php');

    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");
	
	$id=$_POST['id'];
	$data=array("spuser_idspuser"=>$_SESSION['uid'],
	"spprofiles_idspprofiles"=>$_SESSION['pid'],
	"user_name"=>$_POST['user_name'],
	"email"=>$_POST['email'],
	"phone"=>$_POST['contact'],
	"role"=>$_POST['role']
	);
	$us= new _pos;
	$us->update_user($data,$id);
	header("Location:$BaseUrl/store/pos-dashboard/settings.php?record=users_type");