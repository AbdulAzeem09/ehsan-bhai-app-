<?php
    include('../../univ/baseurl.php');
    session_start();
    if(!isset($_SESSION['pid'])){   
        include_once ("../../authentication/check.php");
        $_SESSION['afterlogin']="post-ad/sell/";
    }
    function sp_autoloader($class){
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $postId = isset($_GET["postid"]) ? (int)$_GET["postid"] : 0;
    $_GET["module"] = "1";
    $_GET["categoryid"]="1";
    $_GET["profiletype"]="1";
    $_GET["categoryname"]="Sell";

    $u = new _spuser;
    $res = $u->read($_SESSION["uid"]);
    if($res != false){
        $ruser = mysqli_fetch_assoc($res);
        $usercountry = $ruser["spUserCountry"]; 
        $userstate = $ruser["spUserState"]; 
        $usercity = $ruser["spUserCity"]; 
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="The SharePage">
        <meta name="author" content="Adnan Ghouri(skype:adnanghouri3)">
        <title>The SharePage.</title>
        <!--Bootstrap core css-->
        <link href="<?php echo $BaseUrl; ?>/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $BaseUrl; ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $BaseUrl; ?>/assets/css/custom.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $BaseUrl; ?>/assets/css/responsive.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

        <!-- <link rel="icon" href="<?php echo $BaseUrl.'/assets/images/logo/logo-black.png'?>" sizes="16x16" type="image/png"> -->
        <link rel="icon" href="<?php echo $BaseUrl.'/assets/images/logo/tsp_trans.png'?>" sizes="16x16" type="image/png">
        
        <!--Font awesome core css-->
        <link href="<?php echo $BaseUrl; ?>/assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $BaseUrl; ?>/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" /> 
        <!--custom css jis ki wja say issue ho rha tha form submit main-->
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>

        <script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script>
        
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.core.min.css">
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.default.min.css">
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.lite.min.css">
        <script src="<?php echo $BaseUrl; ?>/assets/js/alert.min.js"></script>
        
        <!-- DATE AND TIME PICKER -->
        <link href="<?php echo $BaseUrl; ?>/assets/css/date-time/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
        
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/sweetalert.css">
        <script src="<?php echo $BaseUrl; ?>/assets/js/sweetalert-dev.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/sweetalert.min.js"></script>
        <!--post group button on btm of the form-->
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/jquery-ui.min.css">
        <!--NOTIFICATION-->
        <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>

        <!-- skills added typehead -->
        <link href="<?php echo $BaseUrl;?>/assets/css/token_field/tokenfield-typeahead.css" type="text/css" rel="stylesheet">
        <link href="<?php echo $BaseUrl;?>/assets/css/token_field/bootstrap-tokenfield.css" type="text/css" rel="stylesheet">
        
        <?php 
        $urlCustomCss = $BaseUrl.'/share-page/component/custom.css.php';
        include $urlCustomCss;
        ?>
<link href="<?php echo $BaseUrl; ?>/assets/css/design.css" rel="stylesheet" type="text/css">

         <link href="<?php echo $BaseUrl; ?>/assets/css/style.css" rel="stylesheet" type="text/css">

<style>
.header_store {
    background-color: #035049!important;
    padding: 0px 10px 5px!important;
}
.header_front {
    background-color: #035049!important;
    padding: 0px 10px 5px!important;
}
</style>

    </head>
<body onload="pageOnload('post')" class="bg_gray">
<?php 
    
    $header_store = "header_store";
    include_once("../../header.php");
    $p = new _spprofiles;
    $rp = $p->readProfiles($_SESSION['uid']);
    $res = $p->readprofilepic(1,$_SESSION['uid']);
    if ($res != false){
        $r = mysqli_fetch_assoc($res);
        $name = $r['spProfileName'];
        $icon = $r['spprofiletypeicon'];
    }
        
    ?>
	
	<div class="loadbox" >
            <div class="loader"></div>
        </div>
        <section class="landing_page postingPage" >
            <div class="container">
                 <div class="row">
                    <div class="col-md-9">
                      <h4 style="color:#a92b2b;">Your ad is posted successfully!</h4>
                    </div>
                 </div>

                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="about_banner m_top_10 bradius-15">
                                    <div class="top_heading_group storesell br_radius_top">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h3>What would like to do now?</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="event_form">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$postId;?>">
                                                    <div class="storeBoxThree bradius-15 br_radius_bottom">
                                                        <!-- <i class="fa fa-info-circle"></i> -->
                                                       <!--  <i class="fa fa-gift"></i> -->
                                                       <i class="fa fa-archive" style="color: orange;" aria-hidden="true"></i>
                                                       <!--  <p class="br_radius_bottom">View the product</p> -->
                                                        <p class="br_radius_bottom">View Your Posting</p>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-md-4">
                                                <a href="<?php echo $BaseUrl.'/post-ad/sell/?post';?>">
                                                    <div class="storeBoxThree bradius-15 br_radius_bottom">
                                                        <i class="fa fa-plus-square" style="color: orange;"></i>
                                                        <p class="br_radius_bottom">Post Another Product</p>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-md-4">
                                                <a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php';?>">
                                                    <div class="storeBoxThree bradius-15 br_radius_bottom">
                                                        <!-- <i class="fa fa-dashboard"></i> -->
                                                        <i class="fa fa-th-large" style="color: orange;"></i>
                                                        <p class="br_radius_bottom">Go To Dashboard</p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="poststore m_top_10" id="">
                            <?php
                            $po = new _spAllStoreForm;
                            $result2 = $po->getformcontent(1);
                            if ($result2) {
                                $row2 = mysqli_fetch_assoc($result2);
                                ?>
                                <div class="col-md-12 nopadding its-free-post-job bradius-15 br_radius_top">
                                    <h2 class="heading br_radius_top"><?php echo $row2['pc_title']; ?></h2>
                                    <div class="col-xs-12 content">
                                        <div class='nopadding'><?php echo $row2['pc_content']; ?></div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>   
                        </div>
                    </div>
                </div>
              </div>
        </section>
        <?php include('../../component/f_footer.php');?>
        <!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
        <?php include('../../component/f_btm_script.php'); ?>
        <script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>
        <script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/date-time/bootstrap-datetimepicker.js" charset="UTF-8"></script>
        <script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/date-time/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
        
        <script type="text/javascript">
            $(".form_datetime2").datetimepicker({
                format: "dd MM yyyy - hh:ii P",
                autoclose: true,
                todayBtn: true,
                pickerPosition: "bottom-left"
            });
            
            $('.form_datetime').datetimepicker({
                //language:  'fr',
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0,
                minView: 2,
            });

            $('.form_time_3').datetimepicker({
                //language:  'fr',
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 1,
                forceParse: 0,
                showMeridian: 1
            });
        </script>
        <script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/token_field/bootstrap-tokenfield.js" charset="UTF-8"></script>
        <script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/token_field/affix.js" charset="UTF-8"></script>
        <script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/token_field/typeahead.bundle.min.js" charset="UTF-8"></script>
        <script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/token_field/docs.min.js" charset="UTF-8"></script>
    </body>
</html>
