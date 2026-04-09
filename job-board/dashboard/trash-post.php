<?php
   
    include('../../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="job-board/";
    include_once ("../../authentication/islogin.php");
 
}else{
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");


    $_GET["categoryid"] = "2";
    $_GET["categoryName"] = "Job Board";
    $activePage = 8;
    $header_jobBoard = "header_jobBoard";
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

    <body class="bg_gray">
        <?php
        include_once("../../header.php");
        ?>
        <section class="landing_page">
            <div class="container">
                <div class="row">
                    <div class="sidebar col-md-3 no-padding" id="sidebar" >
                        <?php include('left-menu.php'); ?> 
                    </div>
                    <div class="col-md-9">
                        <?php 
                        include('top-job-search.php');
                        include('inner-breadcrumb.php');
                        ?>
                        
                        
                        <!-- repeat able box -->
                        <div class="whiteboardmain" style="min-height: 300px;">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped tbl_jobboard text-center">
                                            <thead class="">
                                                <tr>
                                                    <th>Job Title</th>
                                                    <th>Date Posted</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $p = new  _postingview;
                                                
                                                $result = $p->myTrashPost($_SESSION['pid'], -3, $_GET['categoryid']);
                                                //echo $p->ta->sql;
                                                if($result){
                                                    while ($row = mysqli_fetch_assoc($result)) { 
                                                        $postDate = new DateTime($row['spPostingDate'])
                                                        ?>
                                                        <tr>
                                                            <td><a href="<?php echo $BaseUrl.'/job-board/applicant.php?postid='.$row['idspPostings'];?>" ><?php echo $row['spPostingtitle'];?></a></td>
                                                            <td><?php echo $postDate->format('d-M-Y');?></td>
                                                            
                                                            <td class="text-center">
                                                                <a href="javascript:void(0)" data-postid="<?php echo $row['idspPostings']; ?>" class="reStorepost btn btn-success" >Re-Store</a>
                                                            </td>
                                                        </tr> <?php
                                                    }
                                                }


                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- repeat able box end -->
                        

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
}?>