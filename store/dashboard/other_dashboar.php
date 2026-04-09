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

    $_GET["categoryid"] = "1";
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../../component/f_links.php');?>
        

        <!-- ===== INPAGE SCRIPTS====== -->
        <!-- High Charts script -->
        <script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
        <!-- Morris chart -->
        <link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <?php include('../../component/dashboard-link.php'); ?>
        

    </head>

    <body class="bg_gray">
    	<?php
        
        $activePage = 17;
        //this is for store header
        $header_store = "header_store";

        include_once("../../header.php");
        ?>
        <section class="main_box">
            <div class="container">
                <div class="row">
                    <div class="sidebar col-md-2 no-padding left_store_menu" id="sidebar" >
                        
                        <?php include('left-menu.php'); ?> 

                    </div>
                    <div class="col-md-10">
                        
                        <?php 
                        
                        $storeTitle = " (Other Profile Dashboard)";
                       // include('../top-dashboard.php');
                       // include('../searchform.php');
                        
                        ?>
                         <div class="row">
                            <div class="col-md-12">
                                <div class="text-right">
                                    <ul class="dualDash">
                                        <li>See The Complete Dashboard Then Swith Your Profile</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- get all profiles insted of freelance or job-board -->
                                <?php
                                $p = new _spprofiles;
                                $result = $p->readMyAllProfile($_SESSION['uid'], $_SESSION['pid']);
                                //echo $p->ta->sql;
                                if ($result) {
                                    while($row = mysqli_fetch_assoc($result)){
                                        ?>
                                        <div class="panel panel-default">
                                            <div class="panel-heading"><?php echo $row['spProfileName'].' ('.$row['spProfileTypeName'].')'?></div>
                                                <div class="panel-body">
                                                        
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <!-- TABLE: LATEST ORDERS -->
                                                                <div class="">
                                                                    <div class="box-header with-border">
                                                                        <h3 class="box-title">My Orders</h3>
                                                                    </div><!-- /.box-header -->
                                                                    <div class="box-body">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-striped no-margin table-bordered">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td><a href="javascript:void(0)">New Orders (New Purchased)</a></td>
                                                                                        <td class="text-center"><span class="label label-success"><?php echo 0; ?></span></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td><a href="javascript:void(0)">Cancel Order</a></td>
                                                                                        <td class="text-center"><span class="label label-info"><?php echo 0; ?></span></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td><a href="javascript:void(0)">Return Request</a></td>
                                                                                        <td class="text-center"><span class="label label-danger"><?php echo 0; ?></span></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td><a href="javascript:void(0)">Inquiries</a></td>
                                                                                        <td class="text-center"><span class="label label-info"><?php echo 0; ?></span></td>
                                                                                    </tr>
                                                                                                                               
                                                                                </tbody>
                                                                            </table>
                                                                        </div><!-- /.table-responsive -->
                                                                    </div><!-- /.box-body -->
                                                                    
                                                                </div><!-- /.box -->
                                                               
                                                            </div>


                                                            <div class="col-md-6">
                                                                <!-- TABLE: LATEST ORDERS -->
                                                                <div class="">
                                                                    <div class="box-header with-border">
                                                                        <h3 class="box-title">Store</h3>
                                                                        
                                                                    </div><!-- /.box-header -->
                                                                    <div class="box-body">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-striped no-margin table-bordered tbl_dashboard">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td><a href="<?php echo $BaseUrl.'/store/dashboard/active_product.php';?>">Active Products</a></td>
                                                                                        <td><span class="label label-success"><?php echo 0; ?></span></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td><a href="<?php echo $BaseUrl.'/store/dashboard/deactive.php';?>">De-activate Products</a></td>
                                                                                        <td><span class="label label-info"><?php echo 0; ?></span></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td><a href="<?php echo $BaseUrl.'/store/dashboard/my-draft.php';?>">Draft Product</a></td>
                                                                                        <td><span class="label label-danger"><?php echo 0; ?></span></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td><a href="<?php echo $BaseUrl.'/store/dashboard/expire.php';?>">Expired Products</a></td>
                                                                                        <td><span class="label label-info"><?php echo 0; ?></span></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td><a href="<?php echo $BaseUrl.'/store/dashboard/my-enquiry.php';?>">Enquiries</a></td>
                                                                                        <td><span class="label label-warning"><?php  echo 0; ?></span></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td><a href="<?php echo $BaseUrl.'/store/dashboard/my-favourite.php'; ?>">Favourite Product</a></td>
                                                                                        <td><span class="label label-warning"><?php echo 0; ?></span></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td><a href="<?php echo $BaseUrl.'/store/dashboard/myFlag.php'; ?>">Flagged Posting</a></td>
                                                                                        <td><span class="label label-warning"><?php echo  0; ?></span></td>
                                                                                    </tr>
                                                                                                                                               
                                                                                </tbody>
                                                                            </table>
                                                                        </div><!-- /.table-responsive -->
                                                                    </div><!-- /.box-body -->
                                                                    
                                                                </div><!-- /.box -->
                                                            
                                                            </div>
                                                        </div>
                                                    
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>





                                
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

        <!-- ========DASHBOARD FOOTER CHARTS====== -->

        <!-- Morris.js charts -->
        <script src="<?php echo $BaseUrl?>/assets/js/raphael-min.js"></script>
        <script src="<?php echo $BaseUrl?>/assets/admin/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="<?php echo $BaseUrl?>/assets/admin/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="<?php echo $BaseUrl?>/assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="<?php echo $BaseUrl?>/assets/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?php echo $BaseUrl?>/assets/admin/plugins/knob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
        <script src="<?php echo $BaseUrl?>/assets/admin/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="<?php echo $BaseUrl?>/assets/admin/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?php echo $BaseUrl?>/assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- Slimscroll -->
        <script src="<?php echo $BaseUrl?>/assets/admin/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        
        

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="<?php echo $BaseUrl?>/assets/admin/dist/js/pages/dashboard.js" type="text/javascript"></script> 
    </body>
</html>
<?php
} ?>
