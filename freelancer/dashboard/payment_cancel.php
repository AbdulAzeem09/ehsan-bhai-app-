<?php
	include('../../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 

    $_SESSION['afterlogin']="freelancer/";
    include_once ("../../authentication/islogin.php");
    
}else{
    
    function sp_autoloader($class){
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $activePage = 17;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
   		<?php include('../../component/f_links.php');?>
        
        <!--This script for posting timeline data End-->
        
        <!-- ===== INPAGE SCRIPTS====== -->
        <?php include('../../component/dashboard-link.php'); ?>
        <!-- Morris chart -->
        <link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />

	</head>
	<body  class="bg_gray">
        <?php
            $header_select = "freelancers";
            include_once("../../header.php");
        ?>
        <section class="main_box" id="freelancers-page">
            <div class="container nopadding projectslist dashboardpage">
                <div class="sidebar col-xs-3 col-sm-3" id="sidebar" >
                    <?php include('left-menu.php');?>
                </div>
                <div class="col-xs-12 col-sm-9 nopadding">
                    <?php include('top-banner-freelancer.php');?>
                    <div class="col-sm-12 nopadding dashboard-section">
                        <div class="col-xs-12 dashboardbreadcrum">
                            <ul class="breadcrumb">
                                <li><a href="<?php echo $BaseUrl;?>/freelancer/dashboard/">Dashboard</a></li>
                                <li>Cancel</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-12 nopadding">
                    	<div class="cartbox">
                    		<div class="cart_header">
                    			<h1><i class="fa fa-shopping-cart"></i> Cancel Amount</h1>
                    			
                    		</div>
                    		<div class="cart_body text-center cancelBody">
                    			<i class="fa fa-times"></i>
                    			<h2>Payment has been Cancelled</h2>
                    			<p>Your Payment has not been successfull,Go back to your account and try again.</p>
                    			<a href="<?php echo $BaseUrl;?>/freelancer/projects.php" class="btn butn_cancel">Back to projects</a>
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