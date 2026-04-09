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
        
        <!-- ===== INPAGE SCRIPTS====== -->
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
                        $activePage = 52;
                        //include('left-menu.php'); 
                        ?> 
                    </div> -->
                     <div id="sidebar" class="col-md-2 hidden-xs no-padding">
                        <div class="left_grid store_left_cat">
                            <?php
                               include('left-buyermenu.php'); 
                            ?>
                        </div>
                    </div>
                    <div class="col-md-10">                        
                        
                        <?php 
                        $storeTitle = " Dashboard / Active Products";
                       // include('../top-dashboard.php');
                        //include('../searchform.php');     
/*
                              $activePage = 52;    */    
                              $activePage = 52;          
                        ?>
                        
                        <div class="row">

                                   <!--  <div class="col-md-12">
                                          <ul class="breadcrumb" style="background-color: #fff;">
                                      <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>">Buyer Dashboard</a></li>
                                       <li><a href="#">Paid Bid</a></li>
                                     
                                    </ul>
                                

                                <div class="text-right">
                                    <ul class="dualDash"   style="float:left!important;">
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?>" class="<?php echo ($activePage == 21 || $activePage == 2 || $activePage == 3 || $activePage == 4 || $activePage == 5 || $activePage == 6 || $activePage == 14 || $activePage == 16 || $activePage == 18 || $activePage == 20 || $activePage == 22 || $activePage == 8 || $activePage == 9 || $activePage == 10 || $activePage == 11 || $activePage == 12 || $activePage == 13)?'active':''?>">Seller Dashboard</a></li>
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>" class="<?php echo ($activePage == 1 || $activePage == 15 || $activePage == 7 || $activePage == 23 || $activePage == 24 ||  $activePage = 50 ||  $activePage = 51 ||  $activePage = 52)?'active':''?>">Buyer Dashboard</a></li>
                                       </ul>
                                </div>
                           
                            </div> -->

                            <div class="col-md-12">
                      <ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 8px;">
                            <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>">Buyer Dashboard</a></li>

                         <li><a href="#">Paid Bid</a></li>
                                     
                          </ul>
                            </div>




                            <div class="col-md-12 ">
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table tbl_store_setting" >
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 50px;">ID</th>
                                                    <th>Title</th>
                                                    <th>Price Payed</th>
                                                    <th>Transection ID</th>
                                                    <th>Payed on</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                              <?php
                                              $pet = new _spauction_transection;
                                              $p = new _productposting;

                                                /*$result = $p->mydeactiveauctionbid($_SESSION['pid']);*/
                                                $result = $pet->mybooking($_SESSION['pid']);

                                                if ($result) {
                                                    $i = 1;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        /* print_r($_SESSION['pid']);
                                                           echo"<pre>";
                                                           print_r($row);*/

                                                        /*$b = new _spauctionbid;
                                                        $result1 = $b->auctionhighestbid($row['idspPostings']);

                                                        /*echo $p->ta->sql;*/
                                                        /*$row1 = mysqli_fetch_assoc($result1);*/

                                                        /*echo"<pre>";
                                                        print_r($row);*/

                                                        $result2 = $p->read($row['postid']);
                                                        $row2 = mysqli_fetch_assoc($result2);
                                                       /* print_r($row2);*/
                                                        $dt = new DateTime($row['payment_date']);
                                                      /*  $edt = new DateTime($row['spPostingExpDt']);*/



                                                        
                                                       ?>
                                                       <tr>
                                                            <td class="text-center"><?php echo $i; ?></td>
                                                            <td><a href="<?php echo $BaseUrl.'/my-store/detail.php?catid=1&postid='.$row['idspPostings']; ?>"><?php echo ucwords($row2['spPostingTitle']); ?></a></td>
                                                            <td>$<?php echo $row['payment_gross']; ?></td>
                                                            <td><?php echo $row['txn_id']; ?></td>
                                                           <!--  <td>$<?php echo $row['lastBid']; ?></td> -->
                                                            <td><?php echo $dt->format('d M Y'); ?></td>
                                                            <!-- <td><?php echo $edt->format('d M Y'); ?></td> -->
                               


                                                        </tr>
                                                       <?php
                                                       $i++;

                                                      
                                                  ?>
                                                
                                                  <?php
                                              
                                                    }
                                               
                                                }else{
                                                  ?>
                                                  <tr>
                                                      <td colspan="8">
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
} ?>