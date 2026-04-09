<?php
include('../univ/baseurl.php');
    include('../univ/main.php');
    session_start();
    $dbConn = mysqli_connect(DBHOST, UNAME, PASS,DBNAME);
    
    
    
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "my-groups/";
    include_once ("../authentication/check.php");
    
}else{

    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");


$g = new _spgroup;
$result = $g->create($_REQUEST['gid'],$_REQUEST['pid']);
// echo $g->tad->sql;
// exit;
if($result)
{ 
  echo '1';
 
}
else
{
  echo '0';
}
}
?>