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
                  <!--   <div class="sidebar col-md-2 no-padding left_store_menu" id="sidebar" >
                        <?php 
                        $activePage = 25;
                      //  include('left-menu.php'); 
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
                        $storeTitle = " Dashboard / Active Products";
                       // include('../top-dashboard.php');
                        //include('../searchform.php');                       
                        ?>
                        
                        <div class="row">

                                   <!--  <div class="col-md-12">
                                          <ul class="breadcrumb" style="background-color: #fff;">
                                      <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php';?>">Seller Dashboard</a></li>
                                       <li><a href="#">Auction List</a></li>
                                    
                                    </ul>
                                

                                <div class="text-right">
                                    <ul class="dualDash"   style="float:left!important;">
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?>" class="<?php echo ($activePage == 21 || $activePage == 2 || $activePage == 3 || $activePage == 4 || $activePage == 5 || $activePage == 6 || $activePage == 14 || $activePage == 16 || $activePage == 18 || $activePage == 20 || $activePage == 22 || $activePage == 8 || $activePage == 9 || $activePage == 10 || $activePage == 11 || $activePage == 12 || $activePage == 13 ||$activePage == 25)?'active':''?>">Seller Dashboard</a></li>
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>" class="<?php echo ($activePage == 1 || $activePage == 15 || $activePage == 7 || $activePage == 23 || $activePage == 24)?'active':''?>">Buyer Dashboard</a></li>
                                       </ul>
                                </div>
                                 </div> -->


                                <div class="col-md-12">
                        <ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 8px;">
                         <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php';?>">Seller Dashboard</a></li>
                                       <li><a href="#">Auction List</a></li>
                                     
                          </ul>
                                     
                         
                                     
                                <div class="text-right">
                                    <ul class="dualDash"   style="float:left!important;">
                                         <li><a href="<?php echo $BaseUrl.'/store/dashboard/auctionactive_product.php'; ?>" class="<?php echo ($activePage == 22)?'active':''?>">Open</a></li>
                                       
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/auctionclose_product.php';?>" class="<?php echo ($activePage == 25)?'active':''?>">Closed</a></li>
                                        
                                       </ul>
                                </div>
                            </div>




                            <div class="col-md-12 ">
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table tbl_store_setting" >
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 50px;">ID</th>
                                                    <th>Title</th>
                                                    <th>Price</th>
                                                    <th>Posting Date</th>
                                                    <th>Expiry Date</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                //$p = new _postingview;
                                               $p = new _productposting;

                                                $result = $p->auctionexpiredProduct($_SESSION['pid']);

                                                if ($result) {
                                                    $i = 1;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $dt = new DateTime($row['spPostingDate']);
                                                        $edt = new DateTime($row['spPostingExpDt']);
                                                       ?>
                                                       <tr>
                                                            <td class="text-center"><?php echo $i; ?></td>
                                                            <td><a href="<?php echo $BaseUrl.'/my-store/detail.php?catid=1&postid='.$row['idspPostings']; ?>"><?php echo $row['spPostingTitle']; ?></a></td>
                                                            <td>$<?php echo $row['spPostingPrice']; ?></td>
                                                            <td><?php echo $dt->format('d M Y'); ?></td>
                                                            <td><?php echo $edt->format('d M Y'); ?></td>

                                                            <td class="text-center">
                                                               <!--  <a href="<?php echo $BaseUrl.'/store/dashboard/detail.php?postid='.$row['idspPostings']; ?>"><i class="fa fa-eye"></i></a> -->
                                                                <a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$row['idspPostings']; ?>" target="_blank"><i title="View" class="fa fa-eye"></i></a>
                                                            
                                                              
                                                                <a href="javascript:void(0)" data-postid="<?php echo $row['idspPostings']; ?>" class="delpost" ><i title="Delete"  class="fa fa-trash"></i></a>
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