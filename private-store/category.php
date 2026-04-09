<?php
    $_GET["mystore"] = "5";
    $folderName = "group-store";
    if(isset($_GET['catName'])){
        include "../store/category.php";
    }else if(isset($_GET['gid']) && $_GET['gid'] > 0 && $_GET['gname'] != ''){
    	$gid = $_GET['gid'];
    	$gname = $_GET['gname'];
       	include "../store/category.php";
    }
?>
