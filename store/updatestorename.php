<?php
include('../univ/baseurl.php');
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");
	
$profileid = $_POST['profileId'];

$data = array(
"store_name" => $_POST['store_name'],
);

  $pro = new _spprofiles; 
  $pro->updateStoreName($data, $profileid);
