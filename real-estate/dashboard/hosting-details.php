<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

    include('../../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="real-estate/";
    include_once ("../../authentication/islogin.php");
    
}else{
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryID"] = "3";
    $_GET["categoryName"] = "Realestate";
    $header_realEstate = "realEstate";
    $activePage = 17;
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../../component/f_links.php');?>
        <!--This script for sticky left and right sidebar STart-->
        

        <!-- ===== INPAGE SCRIPTS====== -->
        <!-- High Charts script -->
        <script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
        <!-- Morris chart -->
        <link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <?php include('../../component/dashboard-link.php'); ?>
    </head>
<style>
ul#profileDropDown {
    border: none;
}
#profileDropDown li.active {
    background-color: #95ba3d!important;
}
#profileDropDown li.active a {
    color: #fff!important;
}	
</style>
    <body class="bg_gray">
        <?php include_once("../../header.php");?>
 
    <section class="realTopBread" >
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
					
                            <h2><span style="color:white;margin-top: -5px;">Host Details</span></h2>
					</div>
                    <div class="col-md-6">
                        <div class="text-right">
             
                        </div>
                    </div>
                </div>

            </div>
        </section>
       
    
        <section class="" style="padding: 40px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 realDashboard no-padding">
                        <?php //include('top-dashboard.php');?>
                    </div>
                </div>
                <div class="space"></div>
                <div class="row">
                    <div class="sidebar col-md-3 no-padding left_real_menu" id="sidebar" >
                        <?php include('left-menu.php'); ?> 
                    </div>
					
					
					    <div class="col-md-9 bg_white">
			<?php
					$p = new _realstateposting;
										
					if(isset($_POST['user_id'])){
									//die;				
							$datahost = $p->hostdetailsget($_SESSION['pid']);
							
							$reshost = mysqli_fetch_array($datahost);
							//print_r($reshost); die;
							if(empty($reshost)){
								$p->hostdetailsinsert($_POST);
							}else{
								$p->hostdetailsupdate($_POST, $_SESSION['pid']);
							}
						
					}
							
							$datahost = $p->hostdetailsget($_SESSION['pid']);
							if($datahost != false){
								$reshost = mysqli_fetch_assoc($datahost); 
									//$aa = $reshost['typical_day'];
									
									
									
								
							 
							}
							
					
			?>
						<div class="row sponsorInfo ">
								
						<h3 style="margin-left: 17px;">Host Details:</h3>
						<form action="" method="post">
						<input type="hidden" value="<?php echo $_SESSION['pid']; ?>" name="user_id">
						<div class="col-md-8  ">
							<div class=" form-group">
								<label class=" control-label" for="openHouseDayone_">What I do on a typical day ?</label>
								<input type="text" class=" form-control" name="typical_day" value="<?php echo $reshost['typical_day']; ?>" placeholder="What I do on a typical day">
							</div>
						</div> 
						<div class="col-md-8">
							<div class=" col-md- form-group">
								<label class="control-label" for="openHouseDayone_">My hobbies ?</label>
								<input type="text" class=" col-md- form-control" name="hobbies" value="<?php echo $reshost['hobbies']; ?>" placeholder="My hobbies">
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<label class="control-label" for="openHouseDayone_">What my favorite activities are ?</label>
								<input type="text" class="form-control" name="favorite_activities" value="<?php echo $reshost['favorite_activities']; ?>" placeholder="What my favorite activities are ">
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<label class="control-label" for="openHouseDayone_">What kind of food we eat ?</label>
								<input type="text" class="form-control" name="food" value="<?php echo $reshost['food']; ?>" placeholder="what kind of food we eat">
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<label class="control-label" for="openHouseDayone_">What kind of music we like ?</label>
								<input type="text" class="form-control" name="music" value="<?php echo $reshost['music']; ?>" placeholder="what kind of music we like">
							</div>
						</div>
						<div class="col-md-12">
						<div class="col-md-6"></div>
						<div class="col-md-2">
							<div class="form-group">
								<input type="submit" class="form-control btn btn-primary btn-border-radius" value="Submit">
							</div>
						</div>
						</div>
						</form>
					</div>

						</div>
            </div>
        </section>

         <?php 
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        ?>
    </body>
</html>
<?php
}
?>