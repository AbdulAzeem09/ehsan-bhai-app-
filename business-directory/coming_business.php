<?php
    include('../univ/baseurl.php');
    session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "business-directory/";
    include_once ("../authentication/check.php");
    
}else{
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $header_directy = "header_directy";
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/f_links.php');?>
    </head>

    <body class="bg_gray">
        <?php
        include_once("../header.php");
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