<?php
    include('../../univ/baseurl.php');
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="services/";
    include_once ("../../authentication/islogin.php");
  
}else{
    session_start();
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryID"] = "7";
    $_GET["categoryName"] = "Services";
    $header_servic = "header_servic";
    $activePage = 5;
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
        include_once("../../header.php");
        ?>
        <section class="main_box">
            <div class="container">
                <div class="row">
                    <div class="sidebar col-md-2 no-padding left_service_menu" id="sidebar" >
                        <?php include('left-menu.php'); ?> 
                    </div>
                    <div class="col-md-10">
                        <div class="col-xs-12 serviceDashTop text-center">
                            <h1>Flagged Ads</h1>
                        </div>
                        <div class="row">

                            <div class="col-sm-12">
                                <div class="table-responsive bg_white">
                                    <table class="table table-striped table-bordered dashServ">
                                        <thead>
                                            <tr>
                                                <th>Service Name</th>
                                                <th class="text-center">Date</th>
                                                <th class="">Why this flag?</th>
                                                <th class="text-center">Reason</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $p      = new _postingview;
                                            $pf     = new _postfield;
                                            //$res    = $p->myposted_expire_service($_GET['categoryID'], $_SESSION['pid']);
                                            //$res = $p->event_favorite($_GET["categoryID"], $_SESSION['pid']);
                                            $res = $p->flag_post($_GET['categoryID'], $_SESSION['pid']);
                                            //echo $p->ta->sql;
                                            if($res != false){
                                                while ($row = mysqli_fetch_assoc($res)) { 
                                                    //posting fields
                                                    ?>
                                                    <tr>
                                                        <td style="width: 200px;">
                                                            <?php
                                                            $pic = new _postingpic;
                                                            $res2 = $pic->read($row['idspPostings']);
                                                            if ($res2 != false) {
                                                                $rp = mysqli_fetch_assoc($res2);
                                                                $pic2 = $rp['spPostingPic'];
                                                                echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >"; ?>
                                                                <?php
                                                            } else{
                                                                echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>"; ?>
                                                                <?php
                                                            } ?>
                                                            <a href="<?php echo $BaseUrl.'/services/detail.php?postid='.$row['idspPostings'];?>"><?php echo $row['spPostingtitle']; ?></a>
                                                        </td>
                                                        
                                                        <td style="width: 100px;" class="text-center"><?php echo $row['spPostingExpDt']?></td>
                                                        <td class=""><?php echo $row['flag_desc']; ?></td>
                                                        <td class="text-center"><?php echo $row['why_flag']; ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            } ?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </section>

        
        <div class="space-lg"></div>

        <?php 
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        ?>
        <!-- notification js -->
        <script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>
    </body>
</html>
<?php
} ?>
