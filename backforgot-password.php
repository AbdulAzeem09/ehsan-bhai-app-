<?php
include("univ/baseurl.php" );
session_start();

function sp_autoloader($class) {
    include 'mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <?php include('component/f_links.php');?>
</head>

<body class="bg_forgot">

<section class="homepage">
    <div class="container">

        <div class="">
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <div class="forgot_widget">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="pad_top_55">
                                    <div class="row logo_forgot">
                                        <div class="col-sm-12 text-center">
                                            <a href="<?php echo $BaseUrl;?>" class=""><img src="assets/images/logo/tsp_trans.png" alt="The SharePage" class="img-responsive" style="height: 108px;width: 108px;" /></a>
                                            <h5>We can Help you</h5>
                                            <h3>The SharePage!</h3>
                                        </div>
                                    </div>

                                    <?php
                                    if(isset($_SESSION['err']) && $_SESSION['count'] == 0){ ?>
                                        <p class="alert alert-danger error_show"><strong>Error!</strong> <?php echo $_SESSION['err'];?></p><?php
                                        $_SESSION['count']++;
                                        unset($_SESSION['err']);
                                    }else{
                                        ?><div class="space"></div><?php
                                    }
                                    ?>
                                    <div class="forgotForm">
                                        <form id="formgot" class="container-fluid" autocomplete="on" method="post" action="authentication/backforgot.php">
                                            <div class="form-group has-feedback">
                                                <label for="email" class="lbl_1">Email<span class="red">* <span class="spfregemail"></span></span></label>
                                                <div class="">
                                                    <input type="email" class="form-control" id="spfregemail" name="spfregemail"  >
                                                </div>
                                                <span class="help-block" style="color: #00a3c0;font-weight: bold;"></span>
                                                <span class="emailNotValid" style="color: #F00;font-weight: bold;" ></span>

                                            </div>

                                            <div class="text-center">
                                                <button id="forreset" type="submit" data-loading-text="Emailing..." class="btn btn_forgotPass">SEND</button>
                                                <a href="<?php echo $BaseUrl;?>/backofadmin/login.php" class="forgot_password">Already a Member? Sign in here!</a>
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

<?php include('component/f_btm_script.php'); ?>
</body>
</html>
