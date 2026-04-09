<?php
    include("univ/baseurl.php" );
    session_start();

    function sp_autoloader($class) {
        include 'mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");

if(isset($_SESSION['pid'])){ 
    $re = new _redirect;
    $location = $BaseUrl."/timeline/";
    $re->redirect($location);
}else{
	
	    $re = new _redirect;
    $location = $BaseUrl."/timeline/";
    $re->redirect($location);
	
?>


/*

<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('component/header_link.php');?>
        
    </head>

    <body class="bg_signup" >
        
        <section class="signupPage">
            <div class="container">
                <div class="">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-8">
                            <div class="signup_widget" id="" style="margin-top: 150px;">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="pad_top_55">

                                            <div class="row logo_signup">
                                                <div class="col-sm-12 text-center">
                                                 <a href="<?php echo $BaseUrl;?>" class="">
                                                       <!--  <img src="<?php echo $BaseUrl.'/assets/images/logo/tsplogo.PNG'?>" alt="logo" style="height: 100px; width: 180px;" class="sc-product-image" />
 -->
                                                        <img src="<?php echo $BaseUrl.'/assets/images/logo/tsp_trans.png'?>" alt="The SharePage" class="img-responsive" style="width: 114px;height: 114px;" /></a>
                                                    
                                                </div>
                                            </div>
                                            
                                            <div class="thank_sign_up ">
                                                <!-- <div class="text-center" id="reg_sucess_rm">
                                                    <h1>
                                                        --
                                                        You have been successfully registered with The SharePage.
                                                        --
                                                    Just one little step towards your registration.Please enter the code sent to your cell phone.
                                                    </h1>

                                                </div> -->
                                                
                                                <?php
                            if (isset($_SESSION['chkuid']) && $_SESSION['chkuid'] != '') {
                                                    ?>

                                                    <div class="errormsg">
                                                        <div class='alert alert-success'>Please check your email. You will receive an email with a link to verify your email. Once your email is verified, you will be able to login and start using The SharePage.</div>
                                                    </div>
                                                    <div class="showlogin text-center"></div>
                                                    <!-- <form method="post" class="thnkform">
                                                        <input type="hidden" value="<?php echo $_SESSION['chkuid']; ?>" id="txtuid">
                                                     <div class="row">
                                                            
                                                     <div class="col-md-offset-2 col-md-5">
                                                                <div class="form-group">
                                                                    <label class="text-left">SMS code to be entered here</label>
                                                                    <input type="text" id="txtCode" class="form-control" >
                                                     </div>

                                                    <a href="javascript:void(0)" id="resendcod" style="color: #021444">Send SMS again</a>
                                                            </div>
                                                            
                                                            <div class="col-md-5">
                                                                <div class="form-group">
                                                                    <label>&nbsp;</label><br>
                                                                    <input type="button" id="btnChksms" class="btn btn-tsp" value="Continue" >
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </form> -->
                                                    <?php
                                                }
                                                ?>
                                                

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
        
        <?php include('component/f_btm_script.php'); ?>
        <!-- telephone -->
       

        
	</body>
</html>
<?php
} ?>