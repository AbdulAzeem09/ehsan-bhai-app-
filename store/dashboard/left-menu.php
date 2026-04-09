             <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">
    



    <script>
    function openNav() {
        document.getElementById("mySidebar").style.width = "250px";
        document.getElementById("main").style.display = "none";
    }
    function closeNav() {
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("main").style.display= "block";
    }
    </script>

    <div id="main">
        <button class="openbtn" onclick="openNav()">☰</button> 
    </div>
    <div id="mySidebar" class="leftsidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <ul class="sidebar-menu ">
            <li><a class="fontwhite" href="<?php echo $BaseUrl.'/store'; ?>">Back To Store</a></li>
            <!-- seller dashboard by default -->

           <?php
             $idsprfq = isset($_GET['idspRfq']) ? (int) $_GET['idspRfq'] : 0; 

           /*if($_SERVER['REQUEST_URI'] != "/store/dashboard/sell_dashboard.php" && $_SERVER['REQUEST_URI'] != '/store/dashboard/active_product.php' && $_SERVER['REQUEST_URI'] != "/store/dashboard/deactive.php" && $_SERVER['REQUEST_URI'] != "/store/dashboard/my-draft.php" && $_SERVER['REQUEST_URI'] != "/store/dashboard/expire.php" && $_SERVER['REQUEST_URI'] != "/store/dashboard/my-enquiry.php" && $_SERVER['REQUEST_URI'] != "/store/dashboard/myflag.php" ){ 
*/

if($_SERVER['REQUEST_URI'] == "/store/dashboard/active_product.php" ||  $_SERVER['REQUEST_URI'] == "/store/dashboard/myallproduct_orderhistory.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/my_orderhistory.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/track.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/my_send_enguiry.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/my-favourite.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/trash.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/help.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/storereturn_item.php?orderid=".$cid || $_SERVER['REQUEST_URI'] == "/store/dashboard/my-returningitem.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/activebid.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/unpaidbid.php"  || $_SERVER['REQUEST_URI'] == "/store/dashboard/paidbid.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/my-problemwithorder.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/my_rfq.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/private_rfq.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/quotation_list.php?idspRfq=".$idsprfq){ 


            ?> 
          
      


          <!--   <li class="treeview <?php echo ($activePage == 1 || $activePage == 15 || $activePage == 7 || $activePage == 23 || $activePage == 24)?'active' : '';?>"  > -->
     
              <li class="treeviewdash <?php echo ($activePage == 1 || $activePage == 15 || $activePage == 7 || $activePage == 23 || $activePage == 24 || $activePage == 25 || $activePage == 26 || $activePage == 50 ||  $activePage = 51 ||  $activePage = 52||  $activePage = 53 ||$activePage = 54 ||$activePage = 55 ||$activePage = 56 )?'active' : '';?>"  >
                  <a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?>">
                    <span class="fontwhite" >Seller Dashboard </span> 
                </a>

           <a class="fontwhite Buyerdashboard" href="#">
                    <span class="fontwhite" >Buyer Dashboard </span> <!-- <i class="fa fa-angle-left pull-right"></i> -->
                </a>
               


                <ul class="treeview-menu no-padding innerMenu">
                   <!--  <li class="<?php echo ($activePage == 1)?'activepage' : '';?>">
                    <a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/';?>">Dashboard </a>
                    </li> -->
                  
                    <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/myallproduct_orderhistory.php")?'activepage' : '';?>"><a class="fontwhite"  href="<?php echo $BaseUrl.'/store/dashboard/myallproduct_orderhistory.php'; ?>" >My Order History</a></li>

              <li class="treeview <?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/activebid.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/unpaidbid.php" 
              || $_SERVER['REQUEST_URI'] == "/store/dashboard/paidbid.php" )?'active' : '';?>">
                <a href="#">
                    <span class="fontwhite">Auction</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu no-padding innerMenu">
                    <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/activebid.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/activebid.php'; ?>">Active Bid</a></li>

                     <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/unpaidbid.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/unpaidbid.php'; ?>">Unpaid Bid</a></li>
                   <!--  <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/my-quote.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/my-quote.php'; ?>">Unpaid Bid</a></li>
                    <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/my-quote.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/my-quote.php'; ?>">Paid Bid</a></li> -->

                   <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/paidbid.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/paidbid.php'; ?>">Paid Bid</a></li>
                </ul>
            </li>
                    <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/track.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/track.php'; ?>">Track Order</a></li>
                    <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/my_send_enguiry.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/my_send_enguiry.php'; ?>">Enquiry</a></li>

               <li class="treeview <?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/my_rfq.php")?'active' : '';?>">
                <a href="#">
                    <span class="fontwhite">Public RFQ</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu no-padding innerMenu">
                    <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/activebid.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/my_rfq.php'; ?>">My RFQ</a></li>

                  
                  
                </ul>
                </li>

               <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/private_rfq.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/private_rfq.php'; ?>">Private RFQ</a></li>
                   
                    <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/my-favourite.php")?'activepage' : '';?>"><a  class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/my-favourite.php'; ?>" class="">Favourite Products</a></li>

                    <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/my-returningitem.php")?'activepage' : '';?>"><a  class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/my-returningitem.php'; ?>" class="">Returning Items</a></li>

                      <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/my-problemwithorder.php")?'activepage' : '';?>"><a  class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/my-problemwithorder.php'; ?>" class="">Problem With Order</a></li>
					  
					 
                    
                </ul>
            </li>
       <?php } ?> 

              


    <?php 
           /* print_r($activePage);*/
          
    if( $_SERVER['REQUEST_URI'] == "/store/dashboard/sell_dashboard.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/retailactive_product.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/wholesaleactive_product.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/auctionactive_product.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/auctionclose_product.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/deactive.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/my-draft.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/expire.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/my-enquiry.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/order_mang.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/prepare_ship.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/shiped_order.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/delivered_order.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/my-send-quote.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/my-quote.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/rfq.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/my-send-rfq.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/my-received-rfq.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/my-responded-rfq.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/trash.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/help.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/trash.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/requestforreturn.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/sell_problemwithorder.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/myprivate_rfq.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/quotesubmitted-rfq.php"  || $_SERVER['REQUEST_URI'] == "/store/dashboard/add_ship.php?oid=".$oid){ ?> 

        

            <li class="treeviewdash <?php echo ($activePage == 21 || $activePage == 2 || $activePage == 3 || $activePage == 4 || $activePage == 5 || $activePage == 6 || $activePage == 14 || $activePage == 16 || $activePage == 18 || $activePage == 20 || $activePage == 22 || $activePage == 8 || $activePage == 9 || $activePage == 10 || $activePage == 11 || $activePage == 12 || $activePage == 13 || $activePage == 19 ||  $activePage == 20 ||  $activePage == 21 ||  $activePage == 22 ||  $activePage == 23  ||  $activePage == 27 )?'active' : '';?> ">
                <a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/';?>">
                    <span class="fontwhite" >Buyer Dashboard </span> <!-- <i class="fa fa-angle-left pull-right"></i> -->
                </a>

                <a href="#" class="fontwhite sellerdashboard" >
                    <span class="fontwhite" >Seller Dashboard</span> <!-- <i class="fa fa-angle-left pull-right"></i> -->
                </a>
                <ul class="treeview-menu no-padding innerMenu">
                   <!--  <li class="<?php echo ($activePage == 21)?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?>">Dashboard</a></li> -->
                   <!-- 
                    <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/active_product.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/active_product.php'; ?>" >Active Products</a></li>

                     -->


              <li class="treeview <?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/retailactive_product.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/wholesaleactive_product.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/auctionactive_product.php")?'active' : '';?>">
                <a href="#">
                    <span class="fontwhite">Active Products</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu no-padding innerMenu">
                    <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/retailactive_product.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/retailactive_product.php'; ?>">Retail List</a></li>

                    <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/wholesaleactive_product.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/wholesaleactive_product.php'; ?>">Wholesale List</a></li>
                      <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/auctionactive_product.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/auctionactive_product.php'; ?>">Auction List</a></li>

                </ul>
            </li>
            
                    <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/deactive.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/deactive.php';?>" >De-Activate Products</a></li>
                    <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/my-draft.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/my-draft.php'; ?>" class="">Draft</a></li>
                    <!-- <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/expire.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/expire.php'; ?>" >Expired Products</a></li> -->
                    <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/my-enquiry.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/my-enquiry.php'; ?>" class="">Enquiry</a></li>


                    <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/order_mang.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/order_mang.php'; ?>">New Orders</a></li>
                    <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/prepare_ship.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/prepare_ship.php'; ?>">Prepare for Shipment</a></li>
                    <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/shiped_order.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/shiped_order.php'; ?>">Shipped Order</a></li>
                    <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/delivered_order.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/delivered_order.php'; ?>">Delivered Order</a></li>

                 
          <!--     <li class="treeview <?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/my-send-quote.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/my-quote.php")?'active' : '';?>">
                <a href="#">
                    <span class="fontwhite">Private RFQ</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu no-padding innerMenu">
                    <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/my-send-quote.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/my-send-quote.php'; ?>">My Send RFQ's</a></li>
                    <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/my-quote.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/my-quote.php'; ?>">My Received Quotes</a></li>

                </ul>
            </li> -->

               <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/myprivate_rfq.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/myprivate_rfq.php'; ?>">Private RFQ</a></li>



            <li class="treeview <?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/rfq.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/my-send-rfq.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/my-received-rfq.php" || $_SERVER['REQUEST_URI'] == "/store/dashboard/my-responded-rfq.php")?'active' : '';?> ">
                <a href="#">
                    <span class="fontwhite">Public RFQ</span> <i class="fa fa-angle-left pull-right"></i>
                </a> 
                <ul class="treeview-menu no-padding innerMenu">
                   <!--  <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/rfq.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/rfq.php';?>">RFQ Form</a></li> -->
                    <!-- <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/my-send-rfq.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/my-send-rfq.php'?>">My Send RFQ's</a></li> -->
                  <!--   <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/my-received-rfq.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/my-received-rfq.php';?>">Quote Submitted</a></li> -->

                    <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/quotesubmiited-rfq.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/quotesubmitted-rfq.php';?>">Quote Submitted</a></li>

                    <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/my-responded-rfq.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/my-responded-rfq.php';?>">My Responded RFQ's</a></li>

                </ul>
            </li>

              <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/requestforreturn.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/requestforreturn.php'; ?>">Get Request For Return Item</a></li>

               <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/sell_problemwithorder.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/sell_problemwithorder.php'; ?>">Problem With Order</a></li>



                </ul>
            </li>
        <?php } ?> 




          <!--   <li class="treeview <?php echo ($activePage == 16 || $activePage == 18 || $activePage == 20 || $activePage == 22)?'active' : '';?>">
                <a href="#">
                    <span class="fontwhite">Order Management</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu no-padding innerMenu">
                    <li class="<?php echo ($activePage == 16)?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/order_mang.php'; ?>">New Orders</a></li>
                    <li class="<?php echo ($activePage == 18)?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/prepare_ship.php'; ?>">Prepare to shipment</a></li>
                    <li class="<?php echo ($activePage == 20)?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/shiped_order.php'; ?>">Shipped Order</a></li>
                    <li class="<?php echo ($activePage == 22)?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/delivered_order.php'; ?>">Delivered Order</a></li>

                </ul>
            </li> -->
<!-- 
            <li class="<?php echo ($activePage == 17)?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/other_dashboar.php'; ?>" >Other Profile Dashboard</a></li>   -->
            
            
          <!--   
            <li class="treeview <?php echo ($activePage == 8 || $activePage == 9)?'active' : '';?>">
                <a href="#">
                    <span class="fontwhite">Private RFQ</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu no-padding innerMenu">
                    <li class="<?php echo ($activePage == 8)?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/my-send-quote.php'; ?>">My Send RFQ's</a></li>
                    <li class="<?php echo ($activePage == 9)?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/my-quote.php'; ?>">My Received Quotes</a></li>

                </ul>
            </li> -->

      <!--       <li class="treeview <?php echo ($activePage == 10 || $activePage == 11 || $activePage == 12 || $activePage == 13)?'active' : '';?> ">
                <a href="#">
                    <span class="fontwhite">Public RFQ</span> <i class="fa fa-angle-left pull-right"></i>
                </a> 
                <ul class="treeview-menu no-padding innerMenu">
                    <li class="<?php echo ($activePage == 10)?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/rfq.php';?>">RFQ Form</a></li>
                    <li class="<?php echo ($activePage == 11)?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/my-send-rfq.php'?>">My Send RFQ's</a></li>
                    <li class="<?php echo ($activePage == 12)?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/my-received-rfq.php';?>">My Received Quotes</a></li>
                    <li class="<?php echo ($activePage == 13)?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/my-responded-rfq.php';?>">My Responded RFQ's</a></li>

                </ul>
            </li> 
        -->
           
            



          <!--   <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/trash.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/trash.php'; ?>" >Trash  </a></li> -->
            <li class="<?php echo ($_SERVER['REQUEST_URI'] == "/store/dashboard/help.php")?'activepage' : '';?>"><a class="fontwhite" href="<?php echo $BaseUrl.'/store/dashboard/help.php'; ?>" >Help  </a></li>
        </ul> 
    </div>

    <script>
        $(".treeview").click(function(){

             $(this).addClass("active"); 

  });
      
    </script>
