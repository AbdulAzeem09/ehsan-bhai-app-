<?php
    require_once("../../univ/baseurl.php" );
     session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="dashboard/";
    include_once ("../../authentication/islogin.php");
  
}else{
     function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");
    
    $pageactive = 3;
    
    $re = new _redirect;

    // if (!isset($_SESSION['pin']) && $_SESSION['pin'] != 1) {
    //     $redirctUrl = $BaseUrl . "/dashboard/sticky/pin.php/";
    //     $re->redirect($redirctUrl);
    // }
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('../../component/f_links.php');?>
        <!-- ===========DSHBOARD LINKS================= -->
        <?php include('../../component/dashboard-link.php');?>
        <!-- ===========PAGE SCRIPT==================== -->
    </head>
    <body class="bg_gray" onload="pageOnload('details')">
        <?php
       
        include_once("../../header.php");
        ?>
        
        <section class="">
            <div class="container-fluid no-padding">
                <div class="row">
                    <!-- left side bar -->
                    <div class="col-md-2 no_pad_right">
                        <?php
                        include('../../component/left-dashboard.php');
                        ?>
                    </div>
                    <!-- main content -->
                    <div class="col-md-10 no_pad_left">
                        <div class="rightContent">
                            
                            <!-- breadcrumb -->
                            <section class="content-header">
                                <h1>Sticky</h1>
                                <ol class="breadcrumb">
                                    <li><a href="<?php echo $BaseUrl.'/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
                                    <li class="active">Sticky</li>
                                </ol>
                            </section>

                            <div class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="">
                                            <div class="text-right">
                                                <a href="<?php echo $BaseUrl.'/dashboard/sticky/listing.php';?>" class="btn butn"><i class="fa fa-eye"></i> View Listing</a>
                                                <a href="<?php echo $BaseUrl.'/dashboard/sticky/add.php';?>" class="btn butn"><i class="fa fa-plus"></i> Add New Sticky</a>
                                            </div><!-- /.box-header -->
                                            
                                        </div><!-- /.box -->



                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul class="stickyNotest">
                                            <?php
                                            $p = new _spAllStoreForm;
                                            $type = 0;
                                            $result = $p->readSticky($_SESSION['pid'], $type);
                                            if ($result) {
                                                while ($row = mysqli_Fetch_assoc($result)) {
                                                    ?>
                                                    <li>
                                                        <a href="javascript:void(0)">
                                                            <h2><?php echo ucwords(strtolower($row['spStickyTitle']));?></h2>
                                                            <p><?php echo $row['spStickyDes']?></p>
                                                        </a>
                                                    </li>
                                                    <?php
                                                }
                                            }  ?>
                                            
                                          </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                




            </div>
        </section>

        <?php include('../../component/f_footer.php');?>
        <!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
        <?php include('../../component/f_btm_script.php'); ?>
        
    </body>	
</html>
<?php
} ?>