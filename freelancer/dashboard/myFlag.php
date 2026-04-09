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
    $activePage = 16;

    $fps = new _freelance_project_status;
    
    $_GET['categoryId'] = 5;
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../../component/f_links.php');?>
        <!--This script for posting timeline data End-->
        
        <!-- ===== INPAGE SCRIPTS====== -->
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
            <div class="container nopadding projectslist dashboardpage" style="margin-top: 10px;">
                <div class="sidebar col-xs-3 col-sm-3" id="sidebar" >
                    <?php include('left-menu.php');?>
                </div>
                <div class="col-xs-12 col-sm-9 nopadding">
                 
                   <!--  <div class="col-xs-12 nopadding dashboard-section freelancer_dashboard">
                        <div class="col-xs-12 dashboardbreadcrum freelancer_dashboard">
                            <ul class="breadcrumb freelancer_dashboard">
                                <li><a href="<?php echo $BaseUrl;?>/freelancer/dashboard">Dashboard</a></li>
                                <li>Flagged Projects</li>
                              
                            </ul>
                        </div>
                    </div> -->
                    <div class="col-xs-12 nopadding dashboard-section">
                        
                        <div class="col-xs-12 dashboardtable">
                            <div class="table-responsive">

                                <table class="table text-center tbl_activebid">
                                    <thead style="background-color: #3e3e3e;color: #fff;">
                                        <tr>
                                            <th style="color:#fff;">ID</th>
                                            <th style="color:#fff;">Project Name</th>
                                            <th style="color:#fff;">Price ($)</th>
                                            
                                            <th class="action" style="color:#fff;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                       // $p = new _postings;
                                       // $pq = new _postingview;
                                         $sf  = new _freelancerposting;
                                        $i = 1;
                                        $res = $sf->flag_post1(5, $_SESSION['pid']);


                                        //$res = $p->myAllProject(5, $_SESSION['pid']);

                                      // echo $sf->ta->sql;

                                        if($res){
                                            while($row = mysqli_fetch_assoc($res)){
                                                $dt = new DateTime($row['spPostingExpDt']);
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td ><a href="<?php echo $BaseUrl.'/freelancer/project-bid.php?postid='.$row['idspPostings'];?>" class="red freelancer_capitalize"  ><?php echo $row['spPostingTitle'];?></a></td>
                                                    
                                                    <td>$<?php echo $row['spPostingPrice'];?></td>
                                                    <td>
                                                        <a href="javascript:void(0)" class="red" >Waiting For Admin Review </a>
                                                    </td>
                                                </tr> <?php
                                                $i++;
                                            }
                                        }else{
                                            echo "<td colspan='4'><center>No Record Found</center></td>";
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