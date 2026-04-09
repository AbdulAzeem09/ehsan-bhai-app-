<?php 
 session_start();

    include '../univ/baseurl.php';

    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");

   $company =  $_GET['company'];
   $pid =  $_GET['pid'];

   $data= array("idspProfiles_spProfileCompany"=>$company,"spProfiles_idspProfiles"=>$pid,"isfavourite"=>1);

$fd = new _favouriteBusiness;
    $result_fav = $fd->addfavbus($data);



?>