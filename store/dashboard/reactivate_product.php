<?php

/*print_r($_GET);*/

/* include("../../univ/baseurl.php" );*/
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$p = new _productposting;
$re = new _redirect;

if (isset($_GET['postid']) && $_GET['postid'] > 0) {
$postid = $_GET['postid'];

$result = $p->activate_product($postid);

/*echo $p->ta->sql;
*/
}


$location = $BaseUrl."/store/dashboard/deactive.php";
$re->redirect($location);
?>