<?php
	include('../univ/baseurl.php');
	session_start();
	if(!isset($_SESSION['pid'])){ 
		include_once ("../authentication/check.php");
		$_SESSION['afterlogin']="timeline/";
	}
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

    
   
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>  
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
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

    <body class="bg_gray">
      <?php
        //this is for store header
        $header_store = "header_store";
        include_once("../header.php");
      ?>
    	
        <section class="main_box">
            <div class="container">
                <div class="row">
                    <div id="sidebar" class="col-md-2 no-padding">
                        <div class="left_grid store_left_cat">
                            <?php
                              include('../component/left-store.php');
                            ?>
                        </div>
                    </div>
                    <div class="col-md-10 rfqpage">
                        <?php 
                        
                        $activePage = 8;
                        include('top-dashboard.php');
                        include('search-form.php');

                        $p = new _rfq;

                        if (isset($_POST['btn_rfq'])) {

                            if (isset($_POST['rfqCategory']) && $_POST['rfqCategory'] != 0 && isset($_POST['rfqTitle']) && $_POST['rfqTitle'] != '') {
                                
                                $rfqCategory = $_POST['rfqCategory'];
                                $rfqTitle = $_POST['rfqTitle'];
                                $result = $p->search($rfqCategory, $rfqTitle);
                                //echo $p->ta->sql;
                            }else if(isset($_POST['rfqCategory']) && $_POST['rfqCategory'] != 0){
                                //echo "hi0";
                                $rfqCategory = $_POST['rfqCategory'];
                                $result = $p->searchCat($rfqCategory);
                            }else{
                                $rfqTitle = $_POST['rfqTitle'];
                                $result = $p->searchTitle($rfqTitle);
                            }
                        }else{
                            $re = new _redirect;
                            $re->redirect("index.php");
                        }
                        
                        //$result = $p->readAllRfq(1);
                        if ($result) {
                          while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <div class="row no-margin m_top_15">
                              <div class="col-md-12 no-padding">
                                <div class="dash_bg_white">
                                  <h2><a href="<?php echo $BaseUrl.'/public_rfq/rfq-detail.php?rfq='.$row['idspRfq'];?>"><?php echo ucwords(strtolower($row['rfqTitle']));?></a></h2>
                                  <p><?php echo $row['rfqDesc']; ?></p>
                                  <a href="<?php echo $BaseUrl.'/public_rfq/rfq-detail.php?rfq='.$row['idspRfq'];?>" class="btn btn-primary">Read More</a>
                                </div>
                              </div>
                            </div>
                            <?php
                          }
                        }
                        ?>

                        
                        

                    </div>
                </div>
            </div>
        </section>
        <?php 
        include('../component/footer.php');
        include('../component/btm_script.php'); 
        ?>
    </body>
</html>
