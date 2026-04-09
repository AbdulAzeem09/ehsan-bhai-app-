<?php
    include('../univ/baseurl.php');
    session_start();
    if(!isset($_SESSION['pid'])){ 
      include_once ("../authentication/check.php");
      $_SESSION['afterlogin']="my-posts/";
    }
    function sp_autoloader($class){
      include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>  
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script> 
    </head>

    <body class="bg_gray">
    	<?php
        
        //this is for store header
        $header_store = "header_store";
        include_once("../header.php");
        ?>
        <section class="main_box">
            <div class="container">
                <div class="row">
                    <div id="sidebar" class="col-md-2 no-padding">
                        <?php
                            include('../component/left-store.php');
                        ?>
                    </div>
                    <div class="col-md-10">                        
                        
                        <?php 
                        $activePage = 8;
                        $storeTitle = " (<small>My Responded RFQ's</small>)";
                        include('top-dashboard.php');
                        include('searchform.php');
                        include('top-dash-menu.php');
                        ?>
                        
                        <div class="row no-margin">
                            <div class="col-md-12 no-padding">
                                <div class="dash_bg_white">
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center tbl_store_setting" >
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
                                                                <a href="<?php echo $BaseUrl.'/store/my-rfqrec-detail.php?rfq='.$row['idspRfq']; ?>"><?php echo $row['rfqTitle']; ?></a>
                                                            </td>
                                                            <td>
                                                                $<?php echo $row['rfqPrice']; ?>
                                                            </td>
                                                            <td><?php echo $row['rfqDelivered']?> Days</td>
                                                            <td><?php echo $dt->format('d M Y'); ?></td>
                                                            <td class="text-center">
                                                                <a href="<?php echo $BaseUrl.'/store/my-rfqrec-detail.php?rfq='.$row['idspRfq']; ?>"><i class="fa fa-eye"></i></a>
                                                                
                                                            </td>
                                                        </tr>
                                                       <?php
                                                       $i++;
                                                    }
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
        include('../component/footer.php');
        include('../component/btm_script.php'); 
        ?>
        
    </body>
</html>
