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
   
    $pageactive = 21;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('../../component/f_links.php');?>
        <!-- ===========DSHBOARD LINKS================= -->
        <?php include('../../component/dashboard-link.php');?>
        <!-- ===========PAGE SCRIPT==================== -->
        
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
        
    </head>
    <body class="bg_gray">
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
                                <h1>My Flagged Complaints</h1>
                                <ol class="breadcrumb">
                                    <li><a href="<?php echo $BaseUrl.'/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
                                    <li class="active">My Flagged Complaints</li>
                                </ol>
                            </section>

                            <div class="content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box box-success">
                                            <div class="box-header">
                                                
                                            </div><!-- /.box-header -->
                                            <div class="box-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align: center;">ID</th>
                                                                <th>Module</th>
                                                                <th>Post Title</th>
                                                                <th>Reason</th>
                                                                <th style="text-align: center;">Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $fl = new _flagpost;
                                                            
                                                            $i = 1;
                                                            $result = $fl->readmyflag($_SESSION['pid']);
                                                            //echo $fl->ta->sql;
                                                            if ($result) {
                                                                while ($row = mysqli_fetch_assoc($result)) {

                                                                    $dt = new DateTime($row['flag_date']);
                                                                    ?>
                                                                    <tr>
                                                                        <td style="text-align: center;"><?php echo $i; ?></td>
                                                                        <td><?php echo $row['spCategoryName']; ?></td>
                                                                        <td><?php echo $row['spPostingTitle']; ?></td>
                                                                        <td><?php echo $row['why_flag']; ?></td>
                                                                        <td style="text-align: center;"><?php echo $dt->format('d-M-Y'); ?></td>
                                                                    </tr>
                                                                    <?php
                                                                    $i++;
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
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

        
        <?php include('../../component/f_footer.php');?>
        <!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
        <?php include('../../component/f_btm_script.php'); ?>
        
    </body> 
</html>
<?php
} ?>