<?php
    include('../../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="store/";
    include_once ("../../authentication/islogin.php");
 
}else{
    function sp_autoloader($class){
      include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../../component/f_links.php');?>
        <?php include('../../component/dashboard-link.php'); ?>
        
    </head>

    <body class="bg_gray">
    	<?php
        
        
        //this is for store header
        $header_store = "header_store";

        include_once("../../header.php");
        ?>
        <section class="main_box">
            <div class="container">
                <div class="row">
                    <!-- <div class="sidebar col-md-2 no-padding left_store_menu" id="sidebar" >
                        <?php 
                        $activePage = 22;
                        //include('left-menu.php'); 
                        ?> 
                    </div> -->
                    <div id="sidebar" class="col-md-2 hidden-xs no-padding">
                        <div class="left_grid store_left_cat">
                            <?php
                               include('left-sellermenu.php'); 
                            ?>
                        </div>
                    </div>
                    <div class="col-md-10">                        
                        
                        <?php 
                        $storeTitle = "Buyer Dashboard / Delivered Order";
                        //include('../top-dashboard.php');
                       // include('../searchform.php');                       
                        ?>
                        
                        <div class="row no-margin">

                          <!--      
                            <div class="col-md-12 no-padding">

                                  <ul class="breadcrumb" style="background-color: #fff;">
                                      <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php';?>">Seller Dashboard</a></li>
                                       <li><a href="#">Delivered Order</a></li>
                                    
                                    </ul>


                                <div class="text-right" style="margin-top: -10px;">
                                     <ul class="dualDash"   style="float:left!important;">
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?>" class="<?php echo ($activePage == 21 || $activePage == 2 || $activePage == 3 || $activePage == 4 || $activePage == 5 || $activePage == 6 || $activePage == 14 || $activePage == 16 || $activePage == 18 || $activePage == 20 || $activePage == 22 || $activePage == 8 || $activePage == 9 || $activePage == 10 || $activePage == 11 || $activePage == 12 || $activePage == 13)?'active':''?>">Seller Dashboard</a></li>
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>" class="<?php echo ($activePage == 1 || $activePage == 15 || $activePage == 7 || $activePage == 23 || $activePage == 24)?'active':''?>">Buyer Dashboard</a></li>
                                       </ul>


                                </div>
                            </div> -->

                                <div class="col-md-12">
                      <ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 8px;">
                            <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php';?>">Seller Dashboard</a></li>
                                       <li><a href="#">Delivered Order</a></li>
                                     
                          </ul>
                            </div>
                           <div class="col-md-12">
            <div class="panel with-nav-tabs panel-warning" style=" border-color: #BACCE8;">
         <div class="panel-heading" style="padding: 0px!important;background-color: #BACCE8;
    border-color: #BACCE8;">
                        <ul class="nav nav-tabs">
                            <li><a href="#tab1warning" data-toggle="tab">New Order</a></li>
                            <li><a href="#tab2warning" data-toggle="tab">Prepare to Shipment</a></li>
                            <li ><a href="#tab3warning" data-toggle="tab">Shipped Order</a></li>
                          <!--   <li class="dropdown">
                                <a href="#" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#tab4warning" data-toggle="tab">Warning 4</a></li>
                                    <li><a href="#tab5warning" data-toggle="tab">Warning 5</a></li>
                                </ul>
                            </li> -->
                            <li  class="active"><a href="#tab4warning" data-toggle="tab">Delivered Order</a></li>
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade" id="tab1warning">

                     <div class="col-md-12 no-padding">
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table tbl_store_setting" >
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 50px;">Order#</th>
                                                    <th>Reference</th>
                                                    <th>Date</th>
                                                    <th>Title</th>
                                                    <th class="text-center">Qty</th>
                                                    <th class="text-center">Price / Item</th>
                                                    
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $p = new _order;
                                                $result = $p->readSellerOrder($_SESSION['pid']);
                                               // echo $p->ta->sql;
                                                if ($result) {
                                                    $i = 1;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        extract($row);
                                                        
                                                        $dt = new DateTime($sporderdate);
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $idspOrder; ?></td>
                                                            <td><?php echo $txn_id; ?></td>
                                                            <td><?php echo $dt->format('d-M-Y'); ?></td>
                                                            <td class="eventcapitalize"><?php echo $spPostingTitle; ?></td>
                                                            <td class="text-center"><?php echo $spOrderQty; ?></td>
                                                            <td class="text-center"><?php echo "$".$sporderAmount; ?></td>
                                                            
                                                            <td>
                                                                <a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$idspPostings;?>">View</a>
                                                                <span>|</span>
                                                                <?php
                                                                if ($idspShip == 0) {
                                                                    ?>
                                                                    <a href="<?php echo $BaseUrl.'/store/dashboard/add_ship.php?oid='.$idspOrder;?>">Add Shipment</a>
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                    <a href="javascript:void(0)">View Shipment</a>
                                                                    <?php
                                                                }
                                                                ?>
                                                                
                                                                
                                                            
                                                            </td>
                                                            
                                                        </tr>
                                                        <?php
                                                        $i++;
                                                    }
                                                }
                                                else{
                                                  ?>
                                                  <tr>
                                                      <td colspan="7">
                                                          <p class="text-center">No Record Found</p>
                                                      </td>
                                                  </tr>
                                                  <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>










                        </div>
                        <div class="tab-pane fade" id="tab2warning">  <div class="col-md-12 no-padding">
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table tbl_store_setting" >
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 50px;">Order#</th>
                                                    <th>Reference</th>
                                                    <th>Ship Company Name</th>
                                                    <th>Track Id</th>
                                                    <th>Ship Date</th>
                                                    
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $p = new _order;
                                                $result = $p->readSellerOrderStatus($_SESSION['pid'], 1);
                                                //$result = $p->readSellerOrder($_SESSION['pid']);
                                                //echo $p->ta->sql;
                                                if ($result) {
                                                    $i = 1;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        extract($row);
                                                        
                                                        $dt = new DateTime($ship_date);
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $idspOrder; ?></td>
                                                            <td><?php echo $txn_id; ?></td>
                                                            <td class="eventcapitalize"><?php echo $ship_cmpny; ?></td>
                                                            <td><?php echo $ship_track_id; ?></td>
                                                            <td><?php echo $dt->format('d-M-Y'); ?></td>
                                                            
                                                            
                                                            <td>
                                                                <a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$idspPostings;?>">View</a>
                                                                <span>|</span>
                                                                
                                                                <a href="<?php echo $BaseUrl.'/store/dashboard/shipedorder.php?oid='.$idspOrder;?>">Shipped Order</a>
                                                                    
                                                                
                                                                
                                                               <!--  <span>|</span>
                                                                <a href="<?php echo $BaseUrl.'/store/dashboard/buyerinvoice.php?oid='.$txn_id; ?>">Invoice</a> -->
                                                            </td>
                                                            
                                                        </tr>
                                                        <?php
                                                        $i++;
                                                    }
                                                }
                                                else{
                                                  ?>
                                                  <tr>
                                                      <td colspan="6">
                                                          <p class="text-center">No Record Found</p>
                                                      </td>
                                                  </tr>
                                                  <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div></div>
                        <div class="tab-pane fade" id="tab3warning"><div class="col-md-12 no-padding">
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table tbl_store_setting" >
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 50px;">Order#</th>
                                                    <th>Reference</th>
                                                    <th>Ship Company Name</th>
                                                    <th>Track Id</th>
                                                    <th>Ship Date</th>
                                                    
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $p = new _order;
                                                $result = $p->readSellerOrderStatus($_SESSION['pid'], 2);
                                                //$result = $p->readSellerOrder($_SESSION['pid']);
                                                //echo $p->ta->sql;
                                                if ($result) {
                                                    $i = 1;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        extract($row);
                                                        
                                                        $dt = new DateTime($ship_date);
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $idspOrder; ?></td>
                                                            <td><?php echo $txn_id; ?></td>
                                                            <td class="eventcapitalize"><?php echo $ship_cmpny; ?></td>
                                                            <td><?php echo $ship_track_id; ?></td>
                                                            <td><?php echo $dt->format('d-M-Y'); ?></td>
                                                            
                                                            
                                                            <td>
                                                                <a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$idspPostings;?>">View</a>
                                                                <span>|</span>                                                                
                                                                <a href="<?php echo $BaseUrl.'/store/dashboard/shipedorder.php?oid='.$idspOrder.'&do=1';?>">Delivered Order</a>
                                                              <!--   <span>|</span>
                                                                <a href="<?php echo $BaseUrl.'/store/dashboard/buyerinvoice.php?oid='.$txn_id; ?>">Invoice</a> -->
                                                            </td>
                                                            
                                                        </tr>
                                                        <?php
                                                        $i++;
                                                    }
                                                }
                                                else{
                                                  ?>
                                                  <tr>
                                                      <td colspan="6">
                                                          <p class="text-center">No Record Found</p>
                                                      </td>
                                                  </tr>
                                                  <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade in active" id="tab4warning">  <div class="col-md-12 no-padding">
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table tbl_store_setting" >
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 50px;">Order#</th>
                                                    <th>Reference</th>
                                                    <th>Ship Company Name</th>
                                                    <th>Track Id</th>
                                                    <th>Ship Date</th>
                                                    
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $p = new _order;
                                                $result = $p->readSellerOrderStatus($_SESSION['pid'], 3);
                                                //$result = $p->readSellerOrder($_SESSION['pid']);
                                                //echo $p->ta->sql;
                                                if ($result) {
                                                    $i = 1;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        extract($row);
                                                        
                                                        $dt = new DateTime($ship_date);
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $idspOrder; ?></td>
                                                            <td><?php echo $txn_id; ?></td>
                                                            <td class="eventcapitalize"><?php echo $ship_cmpny; ?></td>
                                                            <td><?php echo $ship_track_id; ?></td>
                                                            <td><?php echo $dt->format('d-M-Y'); ?></td>
                                                            
                                                            
                                                            <td>
                                                                <a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$idspPostings;?>">View</a>
                                                                <span>|</span>
                                                                <a href="<?php echo $BaseUrl.'/store/dashboard/buyerinvoice.php?oid='.$txn_id; ?>">Invoice</a>
                                                            </td>
                                                            
                                                        </tr>
                                                        <?php
                                                        $i++;
                                                    }
                                                }
                                                else{
                                                  ?>
                                                  <tr>
                                                      <td colspan="6">
                                                          <p class="text-center">No Record Found</p>
                                                      </td>
                                                  </tr>
                                                  <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div></div>
                       <!--  <div class="tab-pane fade" id="tab5warning">Warning 5</div> -->
                    </div>
                </div>
            </div>
        </div>
                           <!--  <div class="col-md-12 no-padding">
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table tbl_store_setting" >
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 50px;">Order#</th>
                                                    <th>Reference</th>
                                                    <th>Ship Company Name</th>
                                                    <th>Track Id</th>
                                                    <th>Ship Date</th>
                                                    
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $p = new _order;
                                                $result = $p->readSellerOrderStatus($_SESSION['pid'], 3);
                                                //$result = $p->readSellerOrder($_SESSION['pid']);
                                                //echo $p->ta->sql;
                                                if ($result) {
                                                    $i = 1;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        extract($row);
                                                        
                                                        $dt = new DateTime($ship_date);
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $idspOrder; ?></td>
                                                            <td><?php echo $txn_id; ?></td>
                                                            <td class="eventcapitalize"><?php echo $ship_cmpny; ?></td>
                                                            <td><?php echo $ship_track_id; ?></td>
                                                            <td><?php echo $dt->format('d-M-Y'); ?></td>
                                                            
                                                            
                                                            <td>
                                                                <a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$idspPostings;?>">View</a>
                                                                <span>|</span>
                                                                <a href="<?php echo $BaseUrl.'/store/dashboard/buyerinvoice.php?oid='.$txn_id; ?>">Invoice</a>
                                                            </td>
                                                            
                                                        </tr>
                                                        <?php
                                                        $i++;
                                                    }
                                                }
                                                else{
                                                  ?>
                                                  <tr>
                                                      <td colspan="6">
                                                          <p class="text-center">No Record Found</p>
                                                      </td>
                                                  </tr>
                                                  <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> -->
                        </div>

                    </div>
                </div>
            </div>
        </section>



    	<?php 
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        ?>
        
    </body>
</html>
<?php

}?>