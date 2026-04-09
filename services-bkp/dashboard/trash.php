<?php
    include('../../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="services/";
    include_once ("../../authentication/islogin.php");
  
}else{
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryID"] = "7";
    $_GET["categoryName"] = "Services";
    $header_servic = "header_servic";
    $activePage = 8;
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
                            <h1>Trash Ads</h1>
                        </div>
                        <div class="row">


                            <div class="col-md-12">
                                <div class="table-responsive bg_white">
                                    <table class="table table-striped table-bordered dashServ">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Service Name</th>
                                                <th class="text-center">Posted Date</th>
                                                <th class="text-center">Expiry Date</th>
                                                <th class="text-center">Location</th>
                                            
                                                <th class="text-center">Total Views</th>
                                                <th class="text-center">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $p      = new _postingview;
                                            $pf     = new _postfield;
                                            $res    = $p->myposted_service($_GET['categoryID'], $_SESSION['pid']);
                                            //echo $p->ta->sql;
                                            $i = 1;
                                            if($res != false){
                                                while ($row = mysqli_fetch_assoc($res)) { 
                                                    //posting fields
                                                    $result_pf = $pf->read($row['idspPostings']);
                                                    //echo $pf->ta->sql."<br>";
                                                    if($result_pf){
                                                       
                                                        $location = "";
                                                        while ($row2 = mysqli_fetch_assoc($result_pf)) {
                                                            
                                                            
                                                            if($location == ''){
                                                                if($row2['spPostFieldName'] == 'spPostCity_'){
                                                                    $location = $row2['spPostFieldValue'];
                                                                }
                                                            }
                                                            
                                                        }
                                                        $ci  = new _city;
                                                        // city name
                                                        $result4 = $ci->readCityName($location);
                                                        if($result4 != false){
                                                            $row4 = mysqli_fetch_assoc($result4);
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td>
                                                                <?php
                                                                $pic = new _postingpic;
                                                                $res2 = $pic->read($row['idspPostings']);
                                                                if ($res2 != false) {
                                                                    $rp = mysqli_fetch_assoc($res2);
                                                                    $pic2 = $rp['spPostingPic'];
                                                                    echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >"; ?>
                                                                    <?php
                                                                } else{
                                                                    echo "<img alt='Posting Pic' src='../../img/no.png' class='img-responsive'>"; ?>
                                                                    <?php
                                                                } ?>
                                                                <a href="<?php echo $BaseUrl.'/services/detail.php?postid='.$row['idspPostings'];?>"><?php echo $row['spPostingtitle']; ?></a>
                                                            </td>
                                                            <td class="text-center"><?php echo $row['spPostingDate']; ?></td>
                                                            <td class="text-center"><?php echo $row['spPostingExpDt']?></td>
                                                            <td class="text-center"><?php echo ucwords($row4['city_title']); ?></td>
                                                            
                                                            <td class="text-center">0 Person</td>
                                                            <td class="text-center">
                                                                <a href="javascript:void(0)" data-postid="<?php echo $row['idspPostings']; ?>" class="reStorepost" >Re-Store</a>
                                                            </td>
                                                        </tr>
                                            
                                                        <?php
                                                        $i++;
                                                    }
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
