<?php
    include "../../univ/baseurl.php";
     session_start();
     function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");
    if (!isset($_SESSION['pid'])) {
        include_once ("../../authentication/check.php");
        $_SESSION['afterlogin'] = $BaseUrl."/my-profile/";
    }
    $pageactive = 4;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('../../component/links.php');?>
        <!--This script for posting timeline data Start-->
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
        <!--This script for posting timeline data End-->
        <!-- ===========DSHBOARD LINKS================= -->
        <?php include('../../component/dashboard-link.php');?>
        <!-- ===========PAGE SCRIPT==================== -->
        <link href="http://api.highcharts.com/highcharts">
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
        
    </head>
    <body class="bg_gray" >
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
                            
                            <!-- breadcrumb -->
                            <section class="content-header">
                                <h1>Create your unique key for your vault</h1>
                                <ol class="breadcrumb">
                                    <li><a href="<?php echo $BaseUrl.'/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
                                    <li class="active">Create unique key</li>
                                </ol>
                            </section>

                            <div class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box box-success">
                                            <div class="box-header">
                                                <?php 
                                                if(isset($_SESSION['msg']) && isset($_SESSION['count'])){
                                                    if($_SESSION['count'] <= 1){
                                                        $_SESSION['count'] +=1; ?>
                                                        <div class="alert alert-success">
                                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                            <?php echo $_SESSION['msg'];  ?>
                                                        </div> 
                                                        <?php
                                                        unset($_SESSION['msg']);
                                                    }
                                                } ?>
                                            </div><!-- /.box-header -->
                                            <div class="box-body">
                                                <form role="form" method="post" action="createpin.php" class="stckyForm">
                                                    <input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Create PIN</label><br>
                                                                <input type="checkbox" id="chngePin" name="txtPinActive" data-toggle="toggle">
                                                            </div>
                                                        </div>
                                                        <div class="hidden" id="enableArea">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="step">Step 1:</label>
                                                                    <hr class="">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Enter your new pin (4 Digit)</label>
                                                                    <input type="password" class="form-control" name="txtPin" maxlength="4"  />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Confirm PIN</label>
                                                                    <input type="password" class="form-control" name="txtConfirmPin" maxlength="4"  />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Add a Clue for your pin</label>
                                                                    <input type="text" name="txtClue" id="txtClue" class="form-control" />
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="step">Step 2:</label>
                                                                    <hr class="">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-5">
                                                                <div class="form-group" name="txtCreatePin">
                                                                    <label>Select where you want to send your code to verify your account</label>
                                                                    <select class="form-control" name="txtCreateBy" id="txtCreateBy">
                                                                        <option value="SMS">SMS</option>
                                                                        <option value="Email">Email</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="step">Step 3:</label>
                                                                    <hr class="">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <a href="javascript:void(0)" class="btn btn-primary getnrateOtp">Generate Code</a>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group hidden" id="code">
                                                                    <p class="red" style="padding: 5px;">Code is sent to your Phone or Email , Please check and enter the code below!</p>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="step">Step 4:</label>
                                                                    <hr class="">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Enter the code sent to your PHONE or EMAIL to verify your account</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" name="txtOtp" />
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-12">
                                                                <input type="submit" name="btnCreatePin" value="Create PIN" class="btn btn-success">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    
                                                </form>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                




            </div>
        </section>

        
        <?php include('../../component/footer.php');?>
        <!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
        <?php include('../../component/btm_script.php'); ?>
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