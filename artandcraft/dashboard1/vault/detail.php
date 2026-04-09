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
    $re = new _redirect;
    $p = new _spAllStoreForm;

   
    if (isset($_GET['id']) && $_GET['id'] > 0) {

        $result = $p->readSinglSticky($_GET['id']);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $title = $row['spStickyTitle'];
            $desc = $row['spStickyDes'];

        }else{
            $redirctUrl = $BaseUrl . "/dashboard/sticky/index.php/";
            $re->redirect($redirctUrl);
        }
    }else{
        $redirctUrl = $BaseUrl . "/dashboard/sticky/index.php/";
        $re->redirect($redirctUrl);
    }
    $pageactive = 16;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('../../component/f_links.php');?>
        <!-- ===========DSHBOARD LINKS================= -->
        <?php include('../../component/dashboard-link.php');?>
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="<?php echo $BaseUrl;?>/assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

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
                        <?php
                        include('../../component/left-dashboard.php');
                        ?>
                    </div>
                    <!-- main content -->
                    <div class="col-md-10 no_pad_left">
                        <div class="rightContent">
                            
                            <!-- breadcrumb -->
                            <section class="content-header">
                                <h1>My Vault</h1>
                                <ol class="breadcrumb">
                                    <li><a href="<?php echo $BaseUrl.'/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
                                    <li><a href="<?php echo $BaseUrl.'/dashboard/sticky';?>"> My Vault</a></li>
                                    <li class="active">Detail</li>
                                </ol>
                            </section>

                            <div class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box box-success">
                                            <div class="box-header with-border">
                                                <h3 class="box-title"><?php echo $title; ?></h3>
                                              
                                            </div><!-- /.box-header -->
                                            <div class="box-body">
                                                <p><?php echo $desc; ?></p>
                                                
                                            </div><!-- /.box-body -->
                                            
                                        </div>
                                        <div class="form-group">
                                            <a href="<?php echo $BaseUrl.'/dashboard/vault/index.php';?>" class="btn btn-success"><i class="fa fa-home"></i> Home</a>
                                        </div>
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
        <!-- CK Editor -->
        <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?php echo $BaseUrl;?>/assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <script type="text/javascript">
          $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            //CKEDITOR.replace('editor1');
            //bootstrap WYSIHTML5 - text editor
            $(".textarea").wysihtml5();
          });
        </script>
    </body>	
</html>
<?php
} ?>