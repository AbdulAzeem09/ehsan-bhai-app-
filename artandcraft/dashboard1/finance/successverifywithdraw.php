<?php
    require_once("../../univ/baseurl.php" );
     session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "dashboard/";
    include_once ("../authentication/check.php");
    
}else{
     function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $u = new _spuser;

        $myuserid=$_GET['uid'];

        $uid=base64_decode($myuserid);

        //print_r($uid);

           $res1 = $u->loginverifycode($myuserid);

              $newrow = mysqli_fetch_assoc($res1);

              $phone_verify_code = $newrow['phone_verify_code'];


?>

 <!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('../../component/f_links.php');?>

        <!--  <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">

 -->
        <!--This script for posting timeline data End-->
        <!-- custom page script -->
        <?php include('../../component/dashboard-link.php'); ?>

        <script src="<?php echo $BaseUrl; ?>/assets/admin/js/mainchart.js"></script>
        <link href="http://api.highcharts.com/highcharts">
            
        <script src="<?php echo $BaseUrl; ?>/assets/js/register_script.js"></script>
        
        <!-- Morris chart -->
        <link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    </head>
    <body class="bg_gray" onload="pageOnload('details')">
        <?php
       
        include_once("../../header.php");
        ?>
        <section class="">
            <div class="container-fluid no-padding">
                <div class="row">
                    <!-- left side bar -->
                    <div class="col-md-2 no_pad_right">
                        <?php include('../../component/left-dashboard.php'); ?>

                    </div>
                      <div class="col-md-10 no_pad_left">
                        
                       <div class="text-justify innertextProfile">

                         
                      <div class="row" style="margin-top: 100px;">

                     <div class="col-md-3"></div>
                    <div class="col-md-6">
                    <div class="bg_white detailEvent m_top_10" style="border-radius: 25px;">

                    <div class="row">
                        <div class="col-md-12">

                            <div class="verifyEvent" style="margin-bottom: 20px;">
                              <div class="row">
                                <div class="col-md-12">
                                   <div style="text-align: -webkit-center; margin-top: -15px;">


                            <img src="<?php echo $BaseUrl ?>/assets/images/logo/tsp_trans.png" class="img-responsive" style="height: 75px;"><h3 class="eventcapitalize" style="font-weight: bolder;text-align: center;color: #202548;">Authentication Required </h3></div>
                              <p style="margin-bottom: 10px;   margin-top: 6px;  font-size: 13px;
    padding-left: 24px;"> Enter the code you received on your cell phone so we know that this is your account.</p>
                                </div>
                            </div>
 
                          
                               <div class="loginForm" style="padding: 20px 140px;">

                                              <?php if(isset($_SESSION['err'])){ ?>
                                                    <div class="alert alert-danger error_show" style="padding: 13px;">
                                                    <?php echo $_SESSION['err'];?></div><?php
                                                  
                                                    unset($_SESSION['err']);
                                                }else{
                                                    ?><div class="verifyerrormsg"></div><?php
                                                }?>
                                                
                                               
                                                <div id="invalid"></div>
                     <form id="blogin" method="post" action="eventwithdraw.php">

                                                
                        <input type="hidden" name="uid" value="<?php echo $uid;?>" id="logintxtuid">

                         

                    <!-- <input type="hidden" name="phoneverifycode" value="<?php echo $phone_verify_code;?>" id="logintxtuid"> -->

                            
                                 <div class="form-group">
                                                        
                             <label class="text-left">Enter the SMS code</label>

                                            <input type="text" class="form-control"
                                                 name="verifycode"> 

                                                    </div>
                                                     <a href="#" onclick="get_withdrawresendcode(<?php print_r($uid);?>);"><p style="text-decoration: underline;"><b>Re-Send OTP</b></p></a>


                                                    <div class="text-center">

                                                     <button type="submit" id="" autocomplete="off" class="btn" style="border-radius: 30px; background-color: #202548; color: #fff;  margin-top: 10px; padding: 7px 28px;">Submit Code</button>
                                                       
                                                    </div>


                                                    
                                                </form>
                                               
                                            </div>

                        </div>
                        </div>


                    </div>

           

                       </div>
                       </div>
                        <div class="col-md-3"></div>
                   </div>


    

                       </div>

                      </div>

                </div>
            </div> 
       
 <?php 
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        ?>
  </body>

  <script type="text/javascript">
        
            // ===RESEND CODE SEND TO THE USER
        //$("#loginresendcode").on("click", function(){

    function get_withdrawresendcode(u_id){
   
           var uid = u_id;
     //   alert(uid);

            if(uid > 0){
                $.ajax({
                    type: "POST",
                    url: BASE_URL+"dashboard/finance/resend_code.php",
                    cache:false,
                    data: 'uid='+uid,
                    success: function(data) {
                        //console.log(data.trim());
                        //window.location.reload();
                        if(data.trim() == 1){
                            $(".verifyerrormsg").html("<div class='alert alert-success' style='padding: 14px!important;'>Code Sent To Your Mobile Number.</div>");
                            
                        }else{
                            $(".verifyerrormsg").html("<div class='alert alert-danger' style='padding: 14pximportant;'>Some error is occoured kindly refresh you page and try to login.</div>");
                        }
                    }
                });
            }
        }
        // ===end
    </script>

</html>
<?php

}
?>