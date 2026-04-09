<?php
    $_GET["mystore"]="4";
    $folderName = "friend-store";
    if(isset($_GET['catName'])){
        include "../store/category.php";
    }else{
        header('location:'.$BaseUrl);
    }
?>
