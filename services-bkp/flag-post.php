<?php
    include('../univ/baseurl.php');
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryID"] = "7";
    $_GET["categoryName"] = "Services";
    $header_servic = "header_servic";
    $topPage = 2;
    $activePage = 5;
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
        <!-- owl carousel -->
        <link href="<?php echo $BaseUrl;?>/assets/css/owl.carousel.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $BaseUrl;?>/assets/css/owl.theme.default.min.css" rel="stylesheet" type="text/css" />
        <!--This script for posting timeline data Start-->
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
        <!--This script for posting timeline data End-->
        <script src="<?php echo $BaseUrl;?>/assets/js/owl.carousel.min.js"></script>
        <!--NOTIFICATION-->
        <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>
        <!-- this script for slider art -->
        <script>
            $(document).ready(function() {
                $('.owl-carousel').owlCarousel({
                    loop: true,
                    autoPlay: true,
                    responsiveClass: true,
                    responsive: {
                      0: {
                        items: 1,
                        nav: false
                      },
                      600: {
                        items: 3,
                        nav: false
                      },
                      1000: {
                        items: 4,
                        nav: false
                      }
                    }
                });
            });    
        </script>
    </head>

    <body class="bg_gray">
         <?php
        include_once("../header.php");
        ?>
        <section>
            <div class="row no-margin">
                <div class="col-md-2 no-padding">
                    <?php 
                    include('../component/left-services.php');
                    ?>
                </div>
                <div class="col-md-10 no-padding">
                    <div class="head_right_enter">
                        <div class="row no-margin">
                            <?php
                            include('top-head-inner.php');
                            ?>
                            <div class="col-md-12 no-padding">
                                <div class="tab-content no-radius otherTimleineBody m_top_20" style="padding: 0px 20px;">
                                    <!--PopularArt-->
                                    <div role="tabpanel" class="tab-pane active serviceDashboard" id="video1">
                                        <?php include('search-form.php');?>
                                        <?php include('top-dashboard.php');?>
                                        <div class="bg_white" style="padding: 20px;">
                                            
                                            <div class="row" >
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered dashServ">
                                                            <thead>
                                                                <tr>
                                                                    <th>Service Name</th>
                                                                    <th class="text-center">Profile</th>
                                                                    <th class="text-center">Why this flag?</th>
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
                                                                            <td class="text-center"><?php echo $row['flag_desc']; ?></td>
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
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </section>
        <div class="space-lg"></div>

        <?php 
        include('../component/footer.php');
        include('../component/btm_script.php'); 
        ?>
        <!-- notification js -->
        <script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>
	</body>
</html>
