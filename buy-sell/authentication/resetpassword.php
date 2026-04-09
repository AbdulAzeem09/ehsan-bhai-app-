<?php
    include("../univ/baseurl.php" );
    session_start();

    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");
?>
<html lang="en">
<head>
	<?php include('../component/header_link.php');?>
 </head>
 	<body class="bg_forgot" >
        
        <section class="homepage">
            <div class="container">

                <div class="">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                            <div class="forgot_widget">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pad_top_55">

                                            <div class="row logo_signup">
                                                <div class="col-md-12 text-center">
                                                    <a href="<?php echo $BaseUrl;?>" style="left: 39%;"><img src="<?php echo $BaseUrl;?>/assets/images/logo/108x108xtsp_trans.png.pagespeed.ic.EOi4HloUnT.webp" alt="The SharePage" class="img-responsive" style="width: 108px;height: 108px;" /></a>
                                                </div>
                                            </div>
                                            <div class="forgotForm">
                                            	<div class="space-lg"></div>
                                                <form action="reset.php" method="post">
													<input type="hidden" name="userid_" value="<?php echo $_GET["me"];?>">
													<input type="hidden" name="resetcode_" value="<?php echo $_GET["recode"]?>">
												  	<div class="form-group">
														<label for="newpassword">New Password</label>
														<input type="password" class="form-control" id="newpassword" name="newpassword_">
												  	</div>

												  	<div class="form-group">
														<label for="repassword">Retype Password</label>
														<input type="password" class="form-control" id="repassword" name="repassword_">
												  	</div>
												  	<div class="text-center">
												  		<button type="submit" class="btn btn-tsp">Reset</button>
												  	</div>
												</form>


                                            </div>                               
                                            <div class="space-lg"></div>
                                        </div>
                                    </div>
                                    
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <?php include('../component/f_btm_script.php'); ?>
        <!-- telephone -->
       

        
	</body>
 

</html>