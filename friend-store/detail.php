<?php
    $_GET["mystore"]="4";
    $folderName = "friend-store";
    if(isset($_GET["postid"]) && $_GET["postid"] >0 && isset($_GET['catid']) && $_GET['catid'] >0){
        include "../store/detail.php";
    }else{
        header('location:'.$BaseUrl);
    }
?>