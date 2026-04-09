<?php
include("../univ/baseurl.php" );
function sp_autoloader($class){
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$u = new _spuser;
$em = new _email;

$res = $u->regen_back($_POST['spfregemail']);
//echo $u->ta->sql;

if($res != false){
    $row = mysqli_fetch_assoc($res);

    $recode = "";
    $recode = str_shuffle($row["user_password"]);
    $username = $row["user_name"];
    $u->resetcode_ba($_POST['spfregemail'],$recode);

    if($recode != ""){
        
         $link = $BaseUrl."/authentication/backresetpassword.php?me=".$row["user_id"]."&recode=".$recode;

         $em->forgotpass($row['account_name'], $_POST['spfregemail'], $link);
         echo 0;
    }
    
}else{
    echo 1;
}
?>