<?php
	/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/

    require_once("../../univ/baseurl.php" );
     session_start();
     
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="dashboard/";
    include_once ("../../authentication/islogin.php");
  
}else{
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php'; 
    }
    spl_autoload_register("sp_autoloader");
   
    $pageactive = 27;
?>



<?php 

if(isset($_POST['send_pass_link'])){
	//echo "hello";
	$sp = new _spuser;
	$rand = rand(1111,9999);
	//print_r($_SESSION);
	$uid = $_SESSION['uid'];
	$spUserEmail = $_SESSION['spUserEmail'];
	
	$data = array("sprand_no"=>$rand);
	
	$sp->update_random($data,$uid,$spUserEmail);
	
	$e = new _email; 
	
	$re = $e->pos_forgot_pass_email($spUserEmail, $rand); 
    $_SESSION['mail_send']=1;	
}


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('../../component/f_links.php');?>
        
        <!-- ===========DSHBOARD LINKS================= -->
        <?php include('../../component/dashboard-link.php');?>
        <!-- ===========PAGE SCRIPT==================== -->
        <link href="http://api.highcharts.com/highcharts">
        
        
    </head>
    <body class="lockscreen" onload="pageOnload('details')">
        <?php
       
        include_once("../../header.php");
        ?>
        
        <section class="">
            <div class="container-fluid no-padding">
                <div class="row">
                    <!-- left side bar -->
                    <div class="col-md-2 no_pad_right">
                        <?php
                        include('../../component/left-dashboard.php');
                        ?>
                    </div>
                    <!-- main content -->
                    <div class="col-md-10 no_pad_left">
                        <div class="rightContent">
                            
                            

                            <div class="content">
							<?php if( $_SESSION['mail_send'] == 1){ 
								
								unset($_SESSION['mail_send']);
								
					echo "<div class='alert alert-success hidewrong'>
								Email has been sent !
							</div>";
							
							}
							?>
							
							<script>
							setTimeout(function(){
								$(".hidewrong").hide();
							},2000);
								
							</script>
							
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php /*
                                        if(isset($_SESSION['msg']) && isset($_SESSION['count'])){  $_SESSION['hasVault']
                                            if($_SESSION['count'] <= 1){
                                                $_SESSION['count'] +=1; ?>
                                                <div class="alert alert-danger">
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                    <?php echo $_SESSION['msg'];  ?>
                                                </div> 
                                                <?php
                                                unset($_SESSION['msg']);
                                            }
                                        } 
										*/?>
                                        <!-- Automatic element centering -->
                                        <div class="lockscreen-wrapper">
                                            

                                            <!-- START LOCK SCREEN ITEM -->
                                            <div class="lockscreen-item">
                                                <!-- lockscreen image -->

                                                <!-- /.lockscreen-image -->

                                                <!-- lockscreen credentials (contains the form) -->
                                                <form class="" method="POST" action="" >
                                                    <button type="submit" name="send_pass_link" class="btn btn-primary">Click Here To Send Mail For Forgot Pos Password</button>
                                                    
                                                </form><!-- /.lockscreen credentials -->

                                            </div><!-- /.lockscreen-item -->
                                           
											
                                            
                                        </div><!-- /.center -->

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                




            </div>
        </section>

        <!-- ChartJS 1.0.1 -->
        <script src="<?php echo $BaseUrl; ?>/backofadmin/template/xpert/plugins/chartjs/Chart.min.js" type="text/javascript"></script>

        <script src="http://code.highcharts.com/highcharts.js"></script>
        <?php include('../../component/f_footer.php');?>
        <!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
        <?php include('../../component/f_btm_script.php'); ?>
        <!-- DATA TABES SCRIPT -->
        <script src="<?php echo $BaseUrl; ?>/assets/admin/css/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/admin/css/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <!-- page script -->
        <script type="text/javascript">
          $(function () {
            $("#example1").dataTable();
            $('#example2').dataTable({
                "bPaginate": true,
                "bLengthChange": false,
                "bFilter": false,
                "bSort": true,
                "bInfo": true,
                "bAutoWidth": false
            });
          });
		  function validation(e) {

  var fname = document.getElementById("txtPin").value; // Typo here ID should be Id.
  if (fname == "") {
    e.preventDefault();
    alert("Please Enter Pin");
  }

}
        </script>
    </body>	
</html>
<?php
} ?>