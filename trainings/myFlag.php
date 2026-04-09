<?php
    include('../univ/baseurl.php');
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryID"] = "8";
    $_GET["categoryName"] = "Trainings";
    $header_train = "header_train";

    $topPage = 5;
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
                <div class="col-md-3 no-padding">
                    <?php 
                    include('../component/left-training.php');
                    ?>
                </div>
                <div class="col-md-9 no-padding">
                    <div class="head_right_enter">
                        <div class="row no-margin">
                            <?php
                            include('top-head-inner.php');
                            ?>
                            <div class="col-md-12 no-padding">
                                <div class="tab-content no-radius otherTimleineBody m_top_20" style="padding: 0px 20px;">
                                    <!--PopularArt-->
                                    <div role="tabpanel" class="tab-pane active" id="video1">

                                        
                                        <div class="bg_white" style="padding: 20px;">
                                            
                                            <div class="row" >
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered dashVdo">
                                                            <thead>
                                                                <tr>
                                                                    <th>Title</th>
                                                                    <th class="text-center">Category</th>
                                                                    <th class="text-center">Earned This Month</th>
                                                                    <th class="text-center">Enrolled This Month</th>
                                                                    <th class="text-center">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="showMysong">
                                                                <?php
                                                                $p = new _postingview;
                                                                $result = $p->myflagPost($_GET['categoryID'], $_SESSION['pid']);
                                                                //$result = $p->myAllSongs($_SESSION['pid'], $_GET['categoryID']);
                                                                //echo $p->ta->sql;
                                                                if($result != false){
                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                        ?>
                                                                        <tr class="searchable">
                                                                            <td>
                                                                                <div class="dashImgbox">
                                                                                    <?php
                                                                                        $pic = new _postingpic;
                                                                                        $res2 = $pic->readFeature($row['idspPostings']);
                                                                                        //echo $pic->ta->sql;
                                                                                        if($res2 != false){                                                
                                                                                            $rp = mysqli_fetch_assoc($res2);
                                                                                            $pic2 = $rp['spPostingPic'];
                                                                                            echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >"; 
                                                                                            
                                                                                        }else{
                                                                                            echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive blank'>";
                                                                                        }
                                                                                    ?>
                                                                                </div>
                                                                            
                                                                                <a href="<?php echo $BaseUrl.'/trainings/detail.php?postid='.$row['idspPostings'];?>" class="titleBox"><?php echo $row['spPostingtitle'];?></a>
                                                                            </td>
                                                                            
                                                                            <td class="text-center">
                                                                                <?php
                                                                                $pf  = new _postfield;
                                                                                $result_pf = $pf->read($row['idspPostings']);
                                                                                if($result_pf != false){
                                                                                    $category = "";
                                                                                   
                                                                                    while ($row2 = mysqli_fetch_assoc($result_pf)) {
                                                                                        if($category == ''){
                                                                                            if($row2['spPostFieldName'] == 'trainingcategory_'){
                                                                                                echo $category = $row2['spPostFieldValue'];
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                }
                                                                                
                                                                                ?>
                                                                            </td>
                                                                            <td class="text-center">
                                                                               <p>$0.00 Total Earned</p>
                                                                            </td>
                                                                            <td class="text-center">
                                                                               <p>0 Total students</p>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                Waiting For Admin Review
                                                                            </td>
                                                                        </tr> <?php
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
