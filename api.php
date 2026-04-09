<?php
error_reporting(E_ALL);
ini_set("display_errors", "On");


require_once "common.php";
require_once "helpers/common.php";

if(session_id() === ""){
 session_start();
}

$class = !empty($_REQUEST['class']) ? $_REQUEST['class'] : "";
$action = !empty($_REQUEST['action']) ? $_REQUEST['action'] : "";



if(empty($class) || empty($action)){
  errorOut("Class/Action missing");
}
else{
  if(!file_exists("classes/$class.php")){
    errorOut("Class file not found");
  }
  else{
    require_once "classes/Base.php";
    require_once "classes/$class.php";
    
    if(!class_exists($class)){
      errorOut("Class not found");
    }
    else{
      $obj = new $class;

      if(!method_exists($obj, $action)){
        errorOut("Action not found");
      }
      else{       
        $out = $obj->$action();
        //echo json_encode($out); exit();

        if(!isset($out['data'])){
          errorOut("Data not found");
        }
        $addSuccess = true;
        if(!empty($out['format'])){
          if($out['format'] == "skipSuccess"){
            $addSuccess = false;
          }
        }
        
        successOut($out['data'], $addSuccess);

      }
      
    }
    
  }
  
}

