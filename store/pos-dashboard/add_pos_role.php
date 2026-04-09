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
	
	$us->delete_role($id);
	
	}else{
	
	$data=array("spuser_idspuser"=>$_SESSION['uid'],
	"spprofiles_idspprofiles"=>$_SESSION['pid'],
	
	"role_name"=>$_POST['role'],
	"check1"=>$_POST['check1'],
	"check2"=>$_POST['check2'],
	"check3"=>$_POST['check3'],
	"check4"=>$_POST['check4'],
	"check5"=>$_POST['check5'],
	"check6"=>$_POST['check6'],
	"check7"=>$_POST['check7'],
	"check8"=>$_POST['check8'],
	"check9"=>$_POST['check9']
	);
	
	$us->add_roles($data);
	}
	header("Location:$BaseUrl/store/pos-dashboard/settings.php?record=roles_type"); 