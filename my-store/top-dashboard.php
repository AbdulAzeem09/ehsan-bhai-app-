   <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">



   <div class="storenavigation" style="margin-bottom: 11px;">
       <nav class="navbar">
           <div class="">
               <div class="navbar-header">
                   <button type="button" class="navbar-toggle navbartog" data-toggle="collapse" data-target="#storenavbar_">
                       <span class="icon-bar"></span>
                       <span class="icon-bar"></span>
                       <span class="icon-bar"></span>
                   </button>

               </div>

               <div class="collapse navbar-collapse " id="storenavbar_">
                   <ul class="nav navbar-nav top_margin" style="padding-left: 2px;">

                       <li style="margin-left: 10px;margin-right: 1px;">

                           <a style="padding: 13px 10px 13px 10px!important;" class="<?php if ($_SERVER['REQUEST_URI'] == "/store/") {
                                                                                            echo "store_active";
                                                                                        } ?>" href="<?php echo $BaseUrl . '/store/storeindex.php'; ?>">Home</a>
                       </li>

                       <li style="margin-left: 1px;margin-right: 1px;">
                           <a style="padding: 13px 10px 13px 10px!important;" class="<?php if ($_SERVER['REQUEST_URI'] == "/my-store/" || $_SERVER['PHP_SELF'] == "/my-store/index.php") {
                                                                                            echo "store_active";
                                                                                        } ?>" href="<?php echo $BaseUrl . '/my-store/?condition=All&folder=retail&page=1'; ?>">My Store</a>
                       </li>
                       <!-- <li><a href="<?php echo $BaseUrl . '/store/'; ?>">Public Store</a></li> -->
                       <li style="margin-left: 1px;margin-right: 1px;"><a style="padding: 13px 10px 13px 10px!important;" class="<?php if ($_SERVER['REQUEST_URI'] == "/retail/") {
                                                                                                                                        echo "store_active";
                                                                                                                                    } ?>" href="<?php echo $BaseUrl . '/store/personal.php'; ?>">Personal</a></li>
                       <li style="margin-left: 1px;margin-right: 1px;"><a style="padding: 13px 10px 13px 10px!important;" class="<?php if ($_SERVER['REQUEST_URI'] == "/retail/") {
                                                                                                                                        echo "store_active";
                                                                                                                                    } ?>" href="<?php echo $BaseUrl . '/retail/view-all.php?condition=All&folder=retail&page=1'; ?>">Retail Store</a></li>
                       <li style="margin-left: 1px;margin-right: 1px;"><a style="padding: 13px 10px 13px 10px!important;" class="<?php if ($_SERVER['REQUEST_URI'] == "/wholesale/") {
                                                                                                                                        echo "store_active";
                                                                                                                                    } ?>" href="<?php echo $BaseUrl . '/wholesale/?condition=All&folder=wholesale&page=1'; ?>">Wholesale</a></li>
                       <li style="margin-left: 1px;margin-right: 1px;"><a style="padding: 13px 10px 13px 10px!important;" class="<?php if ($_SERVER['QUERY_STRING'] == "type=auction") {
                                                                                                                                        echo "store_active";
                                                                                                                                    } ?>" href="<?php echo $BaseUrl . '/store/view-all-auction.php?type=auction'; ?>">Auction</a></li>
                       <li style="margin-left: 1px;margin-right: 1px;"><a style="padding: 13px 10px 13px 10px!important;" class="<?php if ($_SERVER['REQUEST_URI'] == "/private-store/") {
                                                                                                                                        echo "store_active";
                                                                                                                                    } ?>" href="<?php echo $BaseUrl . '/store/group-store.php?condition=All&folder=grpstore&page=1'; ?>">Group Store</a></li>
                       <li style="margin-left: 1px;margin-right: 1px;"><a style="padding: 13px 10px 13px 10px!important;" class="<?php if ($_SERVER['REQUEST_URI'] == "/friend-store/") {
                                                                                                                                        echo "store_active";
                                                                                                                                    } ?>" href="<?php echo $BaseUrl . '/store/friend-store.php?condition=All&folder=frdstore&page=1'; ?>">Friends Store</a></li>
                       <li style="margin-left: 1px;margin-right: 1px;"><a style="padding: 13px 10px 13px 10px!important;" class="<?php if ($_SERVER['REQUEST_URI'] == "/public_rfq/") {
                                                                                                                                        echo "store_active";
                                                                                                                                    } ?>" href="<?php echo $BaseUrl . '/public_rfq/?condition=All&folder=rfq&page=1'; ?>">RFQ</a></li>
                       <li style="margin-left: 1px;margin-right: 1px;"><a style="padding: 13px 10px 13px 10px!important;" class="<?php if ($_SERVER['REQUEST_URI'] == "/store/category_search.php") {
                                                                                                                                        echo "store_active";
                                                                                                                                    } ?>" href="<?php echo $BaseUrl . '/store/category_search.php?condition=All&folder=cat&page=1'; ?>">Categories</a></li>
                       <?php if ($_SESSION['guet_yes'] != 'yes') { ?>
                           <li style="margin-left: 1px;margin-right: 1px;" class="text-left"><a style="padding: 13px 10px 13px 10px!important;" class="<?php if ($_SERVER['REQUEST_URI'] == "/store/dashboard/") {
                                                                                                                                                            echo "store_active";
                                                                                                                                                        } ?>" href="<?php echo $BaseUrl . '/store/dashboard/?condition=All&folder=retail&page=1'; ?>">My Dashboard</a></li><?php } ?>
                   </ul>
               </div>
           </div>
       </nav>
   </div>

   <!--  <?php if ($_SERVER['REQUEST_URI'] == "/my-store/") { ?>
                <div class="row no-margin">
                  
                            <div class="col-md-12 no-padding">
                                <div class="top_banner">
                                    <img src="<?php echo $BaseUrl; ?>/assets/images/bg/top_banner.jpg" class="img-responsive" alt="" />
                                </div>
                            </div>
                        </div>


     <?php } ?> -->

   <!-- <div id="ip11" style="<?php if ($_SERVER['QUERY_STRING'] == "type=auction" || $_SERVER['QUERY_STRING'] == "condition=Old") {
                                    echo "display: none";
                                } ?>">      
    <div  id="top_page_heading">
        <div class="row">
            <div class="col-md-12">
               
                
               
                  <form method="POST" action="<?php echo $BaseUrl . '/store/search.php'; ?>">
                     <div class="" style="padding-top: 3px;padding-left: 3px;">
                        <input type="hidden" name="txtSearchCategory" value="<?php echo (isset($_GET['mystore'])) ? $_GET['mystore'] : '1' ?>">
                        <input style="border-radius: 19px;background-color: #e6eeff;width:80%!important;display:inline-block; " type="text" class="form-control" name="txtStoreSearch" placeholder="Search For Products" />
                        <button type="submit" class="btn btnd_store" name="btnSearchStore">Search</button>          
                     </div>                                
                  </form>
           
            </div>


           
        </div>
    </div>
</div> -->


   <!-- comment code middle -->
   <!-- <h3>
                  

                    <?php

                    if ($_SERVER['QUERY_STRING'] == "type=auction") {


                        echo "Auction";
                    } else {

                        echo $storeTitle;
                    }

                    ?>
                  
                </h3> -->

   <!--  <div class="col-md-3"> -->




   <!-- <?php
        $u = new _spuser;
        // IS EMAIL IS VERIFIED
        $p_result = $u->isverify($_SESSION['uid']);
        if ($p_result == 1) {
            if ($_SESSION['ptid'] != 2 && $_SESSION['ptid'] != 5) {
                $p = new _postingview;
                $reuslt_vld = $p->chekposting(1, $_SESSION['pid']);
                if ($reuslt_vld == false) {
        ?> -->
   <!-- <a href="<?php echo $BaseUrl ?>/post-ad/sell/?post" class="btn store_search_btn db_btn db_orangebtn sell" style="margin-right: 5px;padding: 6px;width: 30%;">Sell Product</a> -->
   <!-- <?php
                }
            }
        }
        ?> -->
   <!--  <a href="<?php echo $BaseUrl ?>/post-ad/sell/?post" class="btn store_search_btn db_btn db_orangebtn sell" style="margin-right: 5px;padding: 6px;width: 30%;background-color:#2ba805!important;">Sell Product</a> -->
   <!--  </div> -->