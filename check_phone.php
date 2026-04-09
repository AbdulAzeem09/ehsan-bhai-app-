<?php

function sp_autoloader($class){
  include 'mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader"); 

$u = new _spuser;


$phone = !empty($_POST["postphone"]) ? $_POST["postphone"] : "";
if(!$phone){
  echo "<b>Phone No. invalid!</b>";
}
else{
   
  $resPhone = $u->phoneavailablecheck($phone);
  if($resPhone){
    echo "<b>Phone No. is already registered!</b>";
  }else{
    echo 1;
  }
}
?>
