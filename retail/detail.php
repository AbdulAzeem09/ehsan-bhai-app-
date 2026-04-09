<?php
   $_GET["spPostingsFlag"] = "2";
   $_GET["categoryName"] = "Buy&Sell";
      $folderName = "retail";     
      if(isset($_GET["postid"]) && $_GET["postid"] >0 && isset($_GET['catid']) && $_GET['catid'] >0){
          include "../store/detail.php";
      }else{
          header('location:'.$BaseUrl);
      }
?>