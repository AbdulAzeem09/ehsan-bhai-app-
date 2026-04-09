<?php
    session_start();
     include '../univ/baseurl.php';

    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");

    $fv = new _store_favorites;
 
 
    $postid = isset($_POST['postid']) ? $_POST['postid'] : 0;
    $pid = $_SESSION['pid'];
    $uid = $_SESSION['uid'];

    $res_fv = $fv->removestorefavorites($postid,$uid,$pid);


    
    
?>