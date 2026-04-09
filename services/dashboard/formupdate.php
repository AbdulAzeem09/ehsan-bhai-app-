<?php  
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
?>


<?php
    include('../../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="store/";
    include_once ("../../authentication/islogin.php");
  
}else{
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
}
    spl_autoload_register("sp_autoloader");
?>
<?php
$a= $_POST['id'];
$b=$_POST['idsprealEnquiry'];
$c=$_POST['sprealName'];
$d=$_POST['sprealEmail'];
$e=$_POST['sprealPhone'];

$data = array(
'idsprealEnquiry'=>$b,
'sprealName'=>$c,
'sprealEmail'=>$d,
'sprealPhone'=>$e,
);





$p=new _state;
	   $res1 = $p->update_form($data,$a);

      header("location:text.php");


?>