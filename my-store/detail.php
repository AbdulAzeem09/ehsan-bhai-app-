<?php
    $_GET["mystore"]="6";
    $folderName = "my-store";
    if(isset($_GET["postid"]) && $_GET["postid"] >0 && isset($_GET['catid']) && $_GET['catid'] >0){
        include "../store/detail.php";
    }else{
        header('location:'.$BaseUrl);
    }
?>