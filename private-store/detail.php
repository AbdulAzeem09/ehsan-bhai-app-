<?php
    $_GET["mystore"]="5";
    $folderName = "group-store";
    if(isset($_GET["postid"]) && $_GET["postid"] >0 && isset($_GET['catid']) && $_GET['catid'] == 1){
        include "../store/detail.php";
    }else{
        header('location:'.$BaseUrl);
    }
?>