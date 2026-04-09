
<?php
require_once '../library/config.php';
require_once '../library/functions.php';

$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];

checkUser();
//checkUserPermission();

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

// $id = (isset($_GET['id']) && $_GET['id'] != '') ? $_GET['id'] : '';

        $content 	= 'list.php';
        $pageTitle 	= 'List';
        $icon		=  '<img src="../images/icon-list.jpg">';

$script    = array('custom.js');

require_once THEME_PATH . '/template.php';;
?>