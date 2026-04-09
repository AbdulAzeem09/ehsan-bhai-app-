<?php 
    include('../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="freelancer/";
    include_once ("../authentication/check.php");
    
}else{
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $activePage = 6;

    // ==CHEK PROFILE IS BUSINESS OR FREELANCE OR NOT
    $f = new _spprofiles;
    $re = new _redirect;
    //check profile is freelancer or not
    $chekIsFreelancer = $f->readfreelancer($_SESSION['pid']);
    if($chekIsFreelancer == false){
        $redirctUrl = $BaseUrl . "/my-profile/";
        $_SESSION['count'] = 0;
        $_SESSION['msg'] = "Please change your profile to Business Profile or Freelance Profile";
        $re->redirect($redirctUrl);
    }
    // END
    
?>
<!DOCTYPE html>
<html lang="en-US">
        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl ?>/assets/css/design.css">

    <head>
        <?php include('../component/f_links.php');?>
        
        
    </head>

    <body class="bg_gray">
    	<?php
        //session_start();
        
        $header_select = "freelancers";
        include_once("../header.php");
        ?>
        <section class="main_box" id="freelancers-page">
            <div class="container nopadding projectslist dashboardInbox">
                <div class="col-xs-12 col-sm-3">
                    <div class="leftsidebar projectsidebar">
                        <?php include('../component/left-freelancer.php');?>
                    </div>
                </div>


                <div class="col-xs-12 col-sm-9 nopadding">
                    <?php include('top-banner-freelancer.php');?>
                    <div class="col-md-12 inboxmargintop">
                        <div class="panel panel-default bradius-15">
                            <div class="panel-heading bradius-15"><i class="fa fa-comments"></i> INBOX</div>
                            <div class="panel-body bradius-15">
                                <div class="table-responsive freelanceconversation">
                                    <table class="table table-striped all_inbox table-hover ">
                                        <tbody>
                                            <?php  include('load_chat.php'); ?>
                                        </tbody>                    
                                    </table>
                                </div>
                                <hr>
                                
                            </div>
                        </div>
                        <!-- load Chat -->
                        <div class="chattingsystem m_btm_20 " style="max-height: 650px;height: auto;min-height: 250px; ">
                            <div class="show_loader"></div>
                            <div id="message_box"></div>
                        </div>
                        <!-- END -->
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