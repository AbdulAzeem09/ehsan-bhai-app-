<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');
include('../../univ/baseurl.php');
function sp_autoloader($class){
  include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
require_once('../../common.php');
if(isset($_GET['postid'])) {
  insertQ("delete from rfq where idspRfq = ?", "i",[$_GET['postid']]);
}
$re = new _redirect;
$re->redirect($BaseUrl.'/store/dashboard/my_rfq.php');
?>
