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

    $_GET['categoryId'] = 1;
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
                            $activePage = 14;
                            include('left-menu.php'); 
                        ?>
                    </div>
                    <div class="col-md-10">
                        
                        
                        
                        <?php 
                       
                        $storeTitle = " Dashboard / Flagged Post";
                      //  include('../top-dashboard.php');
                       // include('../searchform.php');
                        
                        ?>
                        
                        <div class="row ">

                              
                            <div class="col-md-12">
                                <div class="text-right">
                                    <ul class="dualDash">
                                        
                                        <li><a href="#" class="<?php echo ($activePage == 1)?'active':''?>">Flagged Posting</a></li>
                                        <li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?>" class="<?php echo ($activePage == 21)?'active':''?>">Seller</a></li>
                                    </ul>
                                </div>
                            </div>





                            <div class="col-md-12 ">
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table tbl_store_setting" >
                                            <thead>
                                                <tr>
                                                    <th style="width: 50px;">No</th>
                                                    <th>Title</th>
                                                    <th>Price</th>
                                                    <th>Posting Date</th>
                                                    <th>Expiry Date</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $p = new _postingview;
                                                $result =  $p->myflagPost($_GET['categoryId'], $_SESSION['pid']);
                                                //$result = $p->myStoreProduct($_SESSION['pid']);

                                                if ($result) {
                                                    $i = 1;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $dt = new DateTime($row['spPostingDate']);
                                                        $edt = new DateTime($row['spPostingExpDt']);
                                                       ?>
                                                       <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $row['spPostingtitle']; ?></td>
                                                            <td>$<?php echo $row['spPostingPrice']; ?></td>
                                                            <td><?php echo $dt->format('d M Y'); ?></td>
                                                            <td><?php echo $edt->format('d M Y'); ?></td>

                                                            <td class="text-center" style="color: #F00;">
                                                                Waiting For Admin Review
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