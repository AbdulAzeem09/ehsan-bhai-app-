<?php
    $_GET["mystore"]="99";
    $folderName = "WholeSale-store";
    if(isset($_GET['catName'])){
        include "../store/category.php";
    }else{
        header('location:'.$BaseUrl);
    }
?>
