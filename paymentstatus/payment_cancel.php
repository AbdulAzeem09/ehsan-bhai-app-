<?php
	include('../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="cart/";
    include_once ("../authentication/check.php");
    
}else{
    function sp_autoloader($class){
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
   		<?php include('../component/f_links.php');?>
	</head>
	<body onload="pageOnload('cart')" class="bg_gray">
		<?php
			
			include_once("../header.php");
		?>
	
		<section class="landing_page">
            <div class="container">
            	<div class="row">
            		<div id="sidebar" class="col-md-2 no-padding">
                        <?php include('../component/left-landing.php');?>
                    </div>	
                    
                    <div class="col-md-10">
                    	<div class="cartbox">
                    		<div class="cart_header">
                    			<h1><i class="fa fa-shopping-cart"></i> Cancel Cart</h1>
                    			
                    		</div>
                    		<div class="cart_body text-center cancelBody">
                    			<i class="fa fa-times"></i>
                    			<h2>Payment has been Cancelled</h2>
                    			<p>Your Payment has not been successfull,Go back to your cart and try again.</p>
                    			<a href="<?php echo $BaseUrl;?>/cart" class="btn butn_cancel">Back to shopping cart</a>
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