<?php
	$_GET["spPostingsFlag"] = "2";
	$_GET["categoryName"] = "Buy&Sell";
    $folderName = "retail";

    
    if(isset($_GET['catName'])){
        include "../store/category.php";
    }else{
        header('location:'.$BaseUrl);
    }
?>
