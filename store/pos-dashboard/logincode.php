<?php
include('../../univ/baseurl.php');
session_start(); 
function sp_autoloader($class){
    include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader"); 

?>

<?php
$p = new _pos;  

if(isset($_POST['pos_login'])){
	//print_r($_POST);
	$res = $p->login1($_POST['email'],$_POST['password']);

if($res){
    $row = mysqli_fetch_assoc($res);
	
	$_SESSION['uid'] = $row['uid'];
	$_SESSION['pid'] = $row['pid'];
    $_SESSION['pos_emplyee']='yes';
    $_SESSION['pos_emplyee_id']=$row['id'];


}


}

if($res != false){

    header("Location: $baseurl./employee.php");

}else{

    $_SESSION['wrongpassword'] ='yes';

    header("Location: $baseurl./login.php");
}

?>
