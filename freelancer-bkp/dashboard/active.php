<?php 
    include('../../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 

    $_SESSION['afterlogin']="freelancer/";
    include_once ("../../authentication/islogin.php");
    
}else{
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $activePage = 12;

    $fps = new _freelance_project_status;
    

?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../../component/f_links.php');?>
        <!--This script for posting timeline data End-->
        
        <!-- ===== INPAGE SCRIPTS====== -->
        <!-- High Charts script -->
        <script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
        <?php include('../../component/dashboard-link.php'); ?>
        <!-- Morris chart -->
        <link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
          <!-- Design css  -->
    <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">
    </head>

    <body class="bg_gray">
    	<?php
        //session_start();
        
        $header_select = "freelancers";
        include_once("../../header.php");
        ?>
        <section class="main_box" id="freelancers-page">
            <div class="container nopadding projectslist dashboardpage">
               
                <div class="sidebar col-xs-3 col-sm-3" id="sidebar" >
                    
                    <?php include('left-menu.php');?>
                </div>
                <div class="col-xs-12 col-sm-9 nopadding">

                      <div class="col-md-12 nopadding dashboard-section" style="margin-top: 24px;">
                        <div class="col-xs-12 dashboardbreadcrum">
                            <ul class="breadcrumb">
                              <li><a href="<?php echo $BaseUrl;?>/freelancer">Dashboard</a></li>
                              <li><a href="<?php echo $BaseUrl;?>/freelancer/active.php">Active Project</a></li>
                              <!-- <li><?php echo $title;?></li> -->
                              <a href="<?php echo $BaseUrl ?>/post-ad/freelancer/?post" class="btn post-project postproject" style="float: right;background-color: orange;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;" >Post a project</a>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- <div class="col-xs-12 nopadding dashboard-section freelancer_dashboard">
                        <div class="col-xs-12 dashboardbreadcrum freelancer_dashboard">
                            <ul class="breadcrumb freelancer_dashboard ">
                                <li><a href="<?php echo $BaseUrl;?>/freelancer">Dashboard</a></li>
                                <li>Active Projects</li>
                              
                            </ul>
                        </div>
                    </div> -->
                    <div class="col-xs-12 nopadding dashboard-section" style="margin-top: 10px;">
                        
                        <div class="col-xs-12 dashboardtable" >
                            <div class="table-responsive">

                                <table class="table text-center tbl_free_seting">
                                    <thead style="background-color: #3e3e3e;color: #fff;">
                                        <tr>
                                            <th style="color:#fff;">ID</th>
                                            <th style="color:#fff;">Title</th>
                                            <th style="text-align: center;color:#fff;">Price ($)</th>
                                            <th style="text-align: center;color:#fff;">Closing Date</th>
                                            <th class="action" style="text-align: center;color:#fff;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                       // $p = new _postings;
                                        $sf  = new _freelancerposting;
                        
                                        $i = 1;
                                        //$res = $p->myAllProject(5, $_SESSION['pid']);
                                        $res = $sf->myAllProject1(5, $_SESSION['pid']);
                                        //echo $p->ta->sql;
                                        //echo $sf->ta->sql;



                                        if($res){
                                            while($row = mysqli_fetch_assoc($res)){
                                                $dt = new DateTime($row['spPostingExpDt']);
                                                ?>
                                                <tr>
                                                    
                                                    <td><?php echo $i; ?></td>
                                                    <td ><a href="<?php echo $BaseUrl.'/freelancer/dashboard/detail.php?postid='.$row['idspPostings'];?>" class="red freelancer_capitalize"  ><?php echo $row['spPostingTitle'];?></a></td>
                                                    
                                                    <td>$<?php echo $row['spPostingPrice'];?></td>
                                                    <td><?php echo $dt->format('d-M-Y'); ?></td>
                                                    <td class="text-center">
                                                        
                                                        <a href="<?php echo $BaseUrl.'/freelancer/dashboard/detail.php?postid='.$row['idspPostings'];?>"  class="" ><i class="fa fa-eye"></i></a>
                                                    </td>
                                                    
                                                </tr> <?php
                                                $i++;
                                            }
                                        }
                                        else{
                                            echo "<td colspan='5'><center>No Record Found</center></td>";
                                        }
                                        ?>
                                        
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
} ?>