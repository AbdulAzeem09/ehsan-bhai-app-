<?php
   session_start();
    include('../../univ/baseurl.php');

    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");
	
	$id=$_POST['id_discount'];
	$data=array("spuser_idspuser"=>$_SESSION['uid'],
	"spprofiles_idspprofiles"=>$_SESSION['pid'],
	"discount_type"=>$_POST['discount_type'],
	"discount_value"=>$_POST['discount_value']
	);
	$us= new _pos;
	$us->update_discount($data,$id);
	header("Location:$BaseUrl/store/pos-dashboard/settings.php?record=discount_type");