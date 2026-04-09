<?php
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
   
    $pageactive = 16;
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
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php 
                                        if(isset($_SESSION['msg']) && isset($_SESSION['count'])){
                                            if($_SESSION['count'] <= 1){
                                                $_SESSION['count'] +=1; ?>
                                                <div class="alert alert-danger">
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                    <?php echo $_SESSION['msg'];  ?>
                                                </div> 
                                                <?php
                                                unset($_SESSION['msg']);
                                            }
                                        } ?>
                                        <!-- Automatic element centering -->
                                        <div class="lockscreen-wrapper">
                                            <?php
                                                $p = new _spprofiles;
                                                $result = $p->read($_SESSION['pid']);
                                                if ($result != false) {
                                                    $row = mysqli_fetch_assoc($result);
                                                    
                                                    ?>
                                                    
                                                    <?php
                                                }
                                            ?>
                                            <!-- User name -->
                                            <div class="lockscreen-name"><?php echo $row['spProfileName'];?></div>

                                            <!-- START LOCK SCREEN ITEM -->
                                            <div class="lockscreen-item">
                                                <!-- lockscreen image -->
                                                <div class="lockscreen-image">
                                                    <?php
                                                    if (isset($row["spProfilePic"])){
                                                        echo "<img alt='' class='img-responsive' src=' " . ($row["spProfilePic"]) . "'  >";
                                                    }else{
                                                        echo "<img alt='' class='img-circle' src='".$BaseUrl."/img/noman.png' >";
                                                    }
                                                    ?>
                                                  
                                                </div>
                                                <!-- /.lockscreen-image -->

                                                <!-- lockscreen credentials (contains the form) -->
                                                <form class="lockscreen-credentials" method="POST" action="<?php echo $BaseUrl;?>/dashboard/vault/proSticy.php" >
                                                    
                                                    <input type="hidden" name="pid" value="<?php echo $_SESSION['pid']; ?>">
                                                    <div class="input-group">
                                                        <input type="password" name="txtPin" class="form-control" maxlength="4" placeholder="PIN" />
                                                        <div class="input-group-btn">
                                                            <button class="btn" type="submit" name="btnPin"><i class="fa fa-arrow-right text-muted"></i></button>
                                                        </div>
                                                    </div>
                                                </form><!-- /.lockscreen credentials -->

                                            </div><!-- /.lockscreen-item -->
                                            <div class="help-block text-center">
                                                Enter your pin to retrieve your session <br/>
                                                <?php
                                                $pin = new _spAllStoreForm;
                                                $result2 = $pin->readPinisActive($_SESSION['pid']);
                                                if ($result2) {
                                                    $row2 = mysqli_fetch_assoc($result2);
                                                    if ($row2['spstickyClue'] != '') {
                                                        echo "your pin clue is <strong>".$row2['spstickyClue']."</strong>";
                                                    }
                                                }
                                                ?>
                                               
                                            </div>
                                            <div class='text-center'>
                                                <a href="<?php echo $BaseUrl.'/dashboard/sticky-pin/'; ?>">Create / Change pin</a>
                                            </div>
                                            
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
        </script>
    </body>	
</html>
<?php
} ?>