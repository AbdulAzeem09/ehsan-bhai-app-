<?php
    session_start();
     include '../univ/baseurl.php';

    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");

    $fv = new _store_favorites;
     $cattid= $_GET['catid'];

    $postid = $_GET['postid'];
    $pid = $_SESSION['pid'];
    $uid = $_SESSION['uid'];

    $res_fv = $fv->removestorefavorites($postid,$uid,$pid);

   // if($res_fv){
        header("Location: $BaseUrl/store/detail.php?postid=$postid");
    //}

    
    
?>