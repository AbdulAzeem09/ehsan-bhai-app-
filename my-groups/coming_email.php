<?php
    include('../univ/baseurl.php');
    session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "my-groups/";
    include_once ("../authentication/check.php");
    
}else{

    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
         <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/style.css">
         <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">

        <?php include('../component/f_links.php');?>
        <!--This script for sticky left and right sidebar STart-->
        <script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/jquery.hc-sticky.min.js"></script>
        <script>
            function execute(settings) {
                $('#sidebar').hcSticky(settings);
            }
            // if page called directly
            jQuery(document).ready(function($){
                if (top === self) {
                    execute({
                        top: 20,
                        bottom: 50
                    });
                }
            });
            function execute_right(settings) {
                $('#sidebar_right').hcSticky(settings);
            }
             // if page called directly
            jQuery(document).ready(function($){
                if (top === self) {
                    execute_right({
                        top: 20,
                        bottom: 50
                    });
                }
            });
            
        </script>
        <!--This script for sticky left and right sidebar END-->
    </head>
    <body onload="pageOnload('admin')" class="bg_gray" >
        <?php
       
        include_once("../header.php");
        $p = new _spprofiles;
        $rp = $p->readProfiles($_SESSION['uid']);
        ?>


        
        <section>



             <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/coming-soon.png" style="width: 100%; background-size: cover!important;">
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