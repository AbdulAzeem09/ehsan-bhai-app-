<?php 
 session_start();

    include '../univ/baseurl.php';

    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");

  $prof = new _spprofiles;
   $pid =  $_GET['postid'];
   $type =  $_GET['type'];

if($type == "image"){
 $arr1= array("spfile"=>''); 
 $prof->updatebannerimg($arr1,$pid); 
   }

if($type == "image1"){  
 $arr2= array("spfile1"=>'');   
 $prof->updatebannerimg($arr2,$pid);   
   }


?>