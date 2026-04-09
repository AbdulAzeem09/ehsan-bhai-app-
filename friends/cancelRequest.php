<?php

function sp_autoloader($class)
{
	include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$profilename = $_POST["profilename"];
$flag = $_POST['flag'];
// print_r($_POST);
// exit;
$s = new _spprofilehasprofile;



$s->cancel_Request_d($_POST["sender"], $_POST["reciever"]);
?>


<script>

</script>