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
                   <div class="sidebar col-md-2 no-padding left_store_menu" id="sidebar" >
                        <?php
                            $activePage = 13;
                            include('left-menu.php'); 
                        ?>
                    </div>
                    <div class="col-md-10">                        
                        
                        <?php 
                      
                        $storeTitle = " (<small>My Responded RFQ's</small>)";
                        //include('../top-dashboard.php');
                        //include('../searchform.php');
                        
                        ?>
                        
                        <div class="row no-margin">

                             <div class="col-md-12 no-padding">
                                 <ul class="breadcrumb" style="background-color: #fff;">
                                      <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php';?>">Seller Dashboard</a></li>
                                       <li><a href="#">Public RFQ</a></li>
                                      <li><a href="#">My Responded RFQ</a></li>
                                      <!--<li>Italy</li> -->
                                    </ul>
                                <div class="text-right" style="">
                                     <ul class="dualDash"   style="float:left!important;">
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?>" class="<?php echo ($activePage == 21 || $activePage == 2 || $activePage == 3 || $activePage == 4 || $activePage == 5 || $activePage == 6 || $activePage == 14 || $activePage == 16 || $activePage == 18 || $activePage == 20 || $activePage == 22 || $activePage == 8 || $activePage == 9 || $activePage == 10 || $activePage == 11 || $activePage == 12 || $activePage == 13)?'active':''?>">Seller Dashboard</a></li>
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>" class="<?php echo ($activePage == 1 || $activePage == 15 || $activePage == 7 || $activePage == 23 || $activePage == 24)?'active':''?>">Buyer Dashboard</a></li>
                                       </ul>

                                </div>
                               </div>



                            <div class="col-md-12 no-padding">
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table text-center tbl_store_setting" >
                                            <thead>
                                                <tr>
                                                    <th style="width: 50px;">Sr.No</th>
                                                    <th class="text-left" style="text-align: left;">Title</th>  
                                                    <th>My Quoted Price</th>                                                  
                                                    <th class="text-center">Delivered (Days)</th>
                                                    <th class="text-center">Date</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $r      = new _rfq;
                                                $p      = new _spprofiles;
                                                $result = $r->myRespondedrfq($_SESSION['pid']);
                                                //echo $r->ta->sql;
                                                if ($result) {
                                                    $i = 1;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $dt = new DateTime($row['rfqDate']);
                                                       ?>
                                                       <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td class="text-left" style="text-align: left;">
                                                                <a href="<?php echo $BaseUrl.'/store/dashboard/my-rfqrec-detail.php?rfq='.$row['idspRfq']; ?>"><?php echo $row['rfqTitle']; ?></a>
                                                            </td>
                                                            <td>
                                                                $<?php echo $row['rfqPrice']; ?>
                                                            </td>
                                                            <td><?php echo $row['rfqDelivered']?> Days</td>
                                                            <td><?php echo $dt->format('d M Y'); ?></td>
                                                            <td class="text-center">
                                                                <a href="<?php echo $BaseUrl.'/store/dashboard/my-rfqrec-detail.php?rfq='.$row['idspRfq']; ?>"><i class="fa fa-eye"></i></a>
                                                                
                                                            </td>
                                                        </tr>
                                                       <?php
                                                       $i++;
                                                    }
                                                }
                                                 else{
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
}
?>