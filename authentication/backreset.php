
<?php

function sp_autoloader($class){
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$u = new _spuser;
$re = new _redirect;

$res = $u->back_read($_POST["userid_"]);
if($res != false){
    $row = mysqli_fetch_assoc($res);
    $u->changepassword_ba($_POST['userid_'],md5($_POST['newpassword_']));

    $re->redirect('../backofadmin/login.php');
    //header("Location:../my-profile/");
}

?>
