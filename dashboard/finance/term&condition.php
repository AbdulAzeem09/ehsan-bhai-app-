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



  
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('../../component/f_links.php');?>

         <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">


        <!--This script for posting timeline data End-->
        <!-- custom page script -->
        <?php include('../../component/dashboard-link.php'); ?>

        <script src="<?php echo $BaseUrl; ?>/assets/admin/js/mainchart.js"></script>
        <link href="http://api.highcharts.com/highcharts">
          
        
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
                      <div class="col-md-10 bg_white no_pad_left">
                      	
                       <div class="text-justify innertextProfile" style="height: 634px;">
                       	
                       <img src="<?php echo $BaseUrl ?>/assets/images/logo/tsplogo.PNG" alt="logo" style="height: 100px;" class="img-responsive">
                       	<h1 class="text-center">The Sharepage Terms & Conditions</h1>

                       	<div class="row" style="padding-top: 10px;">
                       	<div class="col-md-12">

                       		<div class="termcondtion"> 
                       		<p>
                       		1. “Lorem ipsum” refers to the most common type of placeholder or dummy text, which is based on a form of scrambled Latin. Its use is widespread in the publishing and design industries.
                       		<br>
                       		2.A key reason graphic designers use dummy text is to present draft designs which focus the eye on layout and visual design, not on the text itself. By using unrecognizable text (in this case a garbled form of Latin) someone viewing a design mockup will not be distracted into reading the words. The text is muted so to speak, in order to highlight the design.
                       		<br>
                       		3.Lorem ipsum dolor sit amet,. Donec laoreet tincidunt sollicitudin risus. Proin sagittis turpis semper purus. Phasellus ut consectetur mauris erat. Donec vel ligula eu erat.
                       		<br>
                       		4.Donec mattis erat ac lorem. Vestibulum auctor augue ut enim. Curabitur ornare eleifend lectus, eget. Maecenas sodales, dui nec condimentum. Nam purus sapien, elementum nec.	
                       		</p>
                           </div>

                       	</div>
                       	</div>

                        <a href="<?php echo $BaseUrl; ?>/dashboard/finance/eventwithdraw.php" class="btn backterms" style="margin-right: 20px;">Back</a>

                       </div>

                      </div>

                </div>
            </div> 
        










 <?php 
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        ?>
  </body>	
</html>
<?php
}
?>