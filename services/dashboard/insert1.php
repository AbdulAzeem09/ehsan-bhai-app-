<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

?>


<?php
    include('../../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="services/";
    include_once ("../../authentication/islogin.php");
  
}else{
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
}



$b=$_POST['idsprealEnquiry'];
$c=$_POST['sprealName'];
$d=$_POST['sprealEmail'];
$e=$_POST['sprealPhone'];
$f=$_POST['sprealMessage'];
$g=$_POST['spPosting_idspPosting'];
$h=$_POST['spProfile_idspProfile'];
$i=$_POST['sprealType'];
$j=$_POST['sellerid'];
$k=$_POST['enquiryDate'];
$m=$_POST['country'];

$data = array(
'idsprealEnquiry'=>$b,
'sprealName'=>$c,
'sprealEmail'=>$d,
'sprealPhone'=>$e,
'sprealMessage'=>$f,
'spPosting_idspPosting'=>$g,
'spProfile_idspProfile'=>$h,
'sprealType'=>$i,
'sellerid'=>$j,
'enquiryDate'=>$k,
'country'=>$m,

);
   $p=new _state;
	   $res1 = $p->form_create($data);
   
	

?>

