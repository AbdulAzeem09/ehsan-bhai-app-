<style>
   .inner_top_form button {
   margin-top: 5px !important;
   border-radius: 0px !important;
   }
   .navbar-nav .nav-link {
   font-size: 15px!important;
   }
   .navbar-nav li a {
   padding: 12.5px 6px !important;
   }
   <?php 
      if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
          $url = "https://";   
      else  
          $url = "http://";   
      // Append the host(domain name, ip) to the URL.   
      $url.= $_SERVER['HTTP_HOST'];   
      // Append the requested resource location to the URL   
      $url.= $_SERVER['REQUEST_URI'];    
      
      echo $url;  
      
      if ($_SERVER['REQUEST_URI'] == "/store/category_search.php" || $_SERVER['QUERY_STRING'] == "alpha=A" || $_SERVER['QUERY_STRING'] == "alpha=B" || $_SERVER['QUERY_STRING'] == "alpha=C" || $_SERVER['QUERY_STRING'] == "alpha=D" || $_SERVER['QUERY_STRING'] == "alpha=E" || $_SERVER['QUERY_STRING'] == "alpha=F" || $_SERVER['QUERY_STRING'] == "alpha=G" || $_SERVER['QUERY_STRING'] == "alpha=H" || $_SERVER['QUERY_STRING'] == "alpha=I" || $_SERVER['QUERY_STRING'] == "alpha=J" || $_SERVER['QUERY_STRING'] == "alpha=K" || $_SERVER['QUERY_STRING'] == "alpha=L" || $_SERVER['QUERY_STRING'] == "alpha=M" || $_SERVER['QUERY_STRING'] == "alpha=N" || $_SERVER['QUERY_STRING'] == "alpha=O" || $_SERVER['QUERY_STRING'] == "alpha=Q" || $_SERVER['QUERY_STRING'] == "alpha=R" || $_SERVER['QUERY_STRING'] == "alpha=S" || $_SERVER['QUERY_STRING'] == "alpha=T" || $_SERVER['QUERY_STRING'] == "alpha=U" || $_SERVER['QUERY_STRING'] == "alpha=V" || $_SERVER['QUERY_STRING'] == "alpha=W" || $_SERVER['QUERY_STRING'] == "alpha=X" || $_SERVER['QUERY_STRING'] == "alpha=Y" || $_SERVER['QUERY_STRING'] == "alpha=Z") { ?>
   }
   <?php } else { ?>
   }
   <?php } ?>
</style>
<style type="text/css">
   <?php
      if (isset($pageTitle) && $pageTitle == 'categorystore') { ?>
   }
   <?php 
      }
      ?>
</style>
<nav class="navbar navbar-expand-lg bg-body-tertiary rounded-4 shadow">
   <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
         <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
               <a id="home1" class="classpadding nav-link <?php if ($_GET['folder'] == "home") {
                  echo "store_active";
                  }  else if (str_contains($url, 'storeindex.php')) { 
                  echo ' store_active';
                  }?>" href="<?php echo $BaseUrl . '/store/storeindex.php?condition=All&folder=home&page=1'; ?>">Home</a>
            </li>
            <li class="nav-item">
               <a id="store1" class="classpadding nav-link <?php if ($_SERVER['REQUEST_URI'] == "/my-store/" || $_SERVER['PHP_SELF'] == "/my-store/index.php") {
                  echo "store_active";
                  } ?>" href="<?php echo $BaseUrl . '/my-store/?condition=All&page=1'; ?>">My Store</a>
            </li>
            <!-- <li><a href="<?php echo $BaseUrl . '/store/'; ?>">Public Store</a></li> -->
            <li class="nav-item">
               <?php //sharepagedevelopersecho $_SERVER['PHP_SELF']; die; ?>
               <a id="personal" class="classpadding nav-link <?php if ($_SERVER['PHP_SELF'] == "/store/personal.php") {
                  echo "store_active";
                  } ?>" href="<?php echo $BaseUrl . '/store/personal.php?page=1'; ?>">Personal</a>
            </li>
            <li class="nav-item">
               <a id="retail1" class="classpadding nav-link <?php if ($_GET['folder'] == "retail") {
                  echo "store_active";
                  }  ?>" href="<?php echo $BaseUrl . '/retail/view-all.php?condition=All&folder=retail&page=1'; ?>">Retail Store</a>
            </li>
            <li class="nav-item">
               <a id="wholesale1" class="classpadding nav-link <?php if ($_GET['folder'] == "wholesale") {
                  echo "store_active";
                  } ?>" href="<?php echo $BaseUrl . '/wholesale/?condition=All&folder=wholesale&page=1'; ?>">Wholesale</a>
            </li>
            <li class="nav-item">
               <a  class="classpadding nav-link <?php if ($_GET['type'] == "auction") {
                  echo "store_active";
                  } ?>" href="<?php echo $BaseUrl . '/store/view-all-auction.php?type=auction&folder=store&page=1'; ?>">Auction</a>
            </li>
            <!-- <li class="nav-item">
               <a id="group1" class="classpadding nav-link <?php if ($_GET['folder'] == "grpstore") {
                  echo "store_active";
                  } ?>" href="<?php echo $BaseUrl . '/store/group-store.php?condition=All&folder=grpstore&page=1'; ?>">Group Store</a>
               </li> -->
            <li class="nav-item">
               <a id="friend1" class="classpadding nav-link <?php if ($_GET['folder'] == "frdstore") {
                  echo "store_active";
                  } ?>" href="<?php echo $BaseUrl . '/store/friend-store.php?condition=All&folder=frdstore&page=1'; ?>">Friends Store</a>
            </li>
            <li class="nav-item">
               <a id="rfq1" class="classpadding nav-link <?php if ($_GET['folder'] == "rfq") {
                  echo "store_active";
                  } ?>" href="<?php echo $BaseUrl . '/public_rfq/?condition=All&folder=rfq&page=1'; ?>">RFQ</a>
            </li>
            <li>
               <a id="categories1" class="classpadding nav-link <?php if ($_GET['folder'] == "cat") {
                  echo "store_active";
                  } ?>" href="<?php echo $BaseUrl . '/store/category_search.php?condition=All&folder=cat&page=1'; ?>">Categories</a>
            </li>
            <?php if ($_SESSION['guet_yes'] != 'yes') { ?>
            <li class="nav-item text-left">
               <a id="dashboard1" class="classpadding nav-link <?php if ($_SERVER['REQUEST_URI'] == "/store/dashboard/") {
                  echo "store_active";
                  } ?>" href="<?php echo $BaseUrl . '/store/dashboard/?condition=All&folder=retail&page=1'; ?>">Dashboard</a>
            </li>
            <?php } ?>
         </ul>
         <div class="d-flex float-end">
            <?php if ($profileType != '2' && $profileType != '5') { ?>
            <!-- <a href="<?php echo $BaseUrl ?>/post-ad/sell/?post" class="btn btn-warning btn-lg sell"> 
               Sell Product
               </a> -->
            <?php } ?>
            <a href="<?php echo $BaseUrl ?>/post-ad/sell/?post" class="btn btn-warning btn-lg sell btn-border-radius"> 
            Sell Product
            </a>
         </div>
      </div>
   </div>
</nav>