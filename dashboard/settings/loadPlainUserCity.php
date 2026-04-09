<?php

error_reporting(0);
//include('../../unive/baseurl.php');
//$BaseUrl
session_start();
function sp_autoloader($class){
    $home_path = $_SERVER["DOCUMENT_ROOT"];
    
if($_SERVER['HTTP_HOST']=='localhost'){
$_SERVER['DOCUMENT_ROOT']='E:/wamp64/www/SHAREPAGE_CODES';
$BaseUrl='http://localhost/SHAREPAGE_CODES/';
}
    include $home_path.'/mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$stateId = $_POST['state'];
$co = new _city;
$result3 = $co->readCity($stateId);
echo "<option value=''>Select City</option>";
//echo $co->ta->sql;
if($result3 != false){
    while ($row3 = mysqli_fetch_assoc($result3)) {
        echo "<option value='".$row3['city_id']."'>".$row3['city_title']."</option>";
    }
}
?>
        


