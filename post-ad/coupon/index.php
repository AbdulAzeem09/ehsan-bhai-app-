<?php 
    include('../../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="events/";
    include_once ("../../authentication/check.php");
    
}else{
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    

   // $_GET["categoryID"] = "9";
   // $_GET["categoryName"] = "Events";
    $header_coupon = "header_coupon";
?>

<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/f_links.php');?>
        
        <!-- Magnific Popup core CSS file -->
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/magnific-popup.css">
        <!-- Magnific Popup core JS file -->
        <script src="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/jquery.magnific-popup.js"></script>
        <!-- this script for slider art -->

        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">
    
    <link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
     <style>
         .header_coupon{
            background-color: #912A86; 
            padding: 0px 10px 5px; 
     }
    </style>

    </head>

    <body class="bg_gray">
          <?php include_once("../../header.php");?>


  <section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 no-padding">
                        <div class="left_artform" id="leftArtFrm" style="min-height: 1320px;">
                            <img src="<?php echo $BaseUrl;?>/assets/images/coupon/fashion3.PNG" class="img-responsive" alt="" />
                        </div>
                    </div>
                    <div class="col-md-9">

                        <div class="row">
                            <div class="col-md-12">

                            </div>
                          </div>
                        </div>

</div>
</div>
</section>








            <?php 
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>
    </body>
</html>
<?php
}
?>