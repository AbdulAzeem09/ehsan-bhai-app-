<?php
    $_GET["mystore"]="6";
    $folderName = "my-store";
    if(isset($_GET['catName'])){
        include "../store/category.php";
    }else{
        header('location:'.$BaseUrl);
    }
?>
