<?php 
    include('../univ/baseurl.php');
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $activePage = 7;

    $fps = new _freelance_project_status;
    
    $_GET['categoryId'] = 5;
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
        
        <!--This script for posting timeline data Start-->
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
        <!--This script for posting timeline data End-->
        
    </head>

    <body class="bg_gray">
    	<?php
        //session_start();
        
        $header_select = "freelancers";
        include_once("../header.php");
        ?>
        <section class="main_box" id="freelancers-page">
            <div class="container nopadding projectslist dashboardpage">
                <div class="col-xs-12 col-sm-3 leftsidebar">
                    <?php include('../component/left-freelancer.php');?>
                </div>
                <div class="col-xs-12 col-sm-9 nopadding">
                    <?php include('top-banner-freelancer.php');?>
                    <div class="col-xs-12 nopadding dashboard-section">
                        <div class="col-xs-12 dashboardbreadcrum">
                            <ul class="breadcrumb">
                                <li><a href="<?php echo $BaseUrl;?>/freelancer">Dashboard</a></li>
                                <li>Flagged Post</li>
                              
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs-12 nopadding dashboard-section">
                        
                        <div class="col-xs-12 dashboardtable">
                            <div class="table-responsive">

                                <table class="table text-center tbl_activebid">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Project Name</th>
                                            <th>Price</th>
                                            
                                            <th class="action">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $p = new _postings;
                                        $pq = new _postingview;
                                        $i = 1;
                                        $res = $pq->myflagPost($_GET['categoryId'], $_SESSION['pid']);
                                        //$res = $p->myAllProject(5, $_SESSION['pid']);
                                        //echo $p->ta->sql;
                                        if($res){
                                            while($row = mysqli_fetch_assoc($res)){
                                                $dt = new DateTime($row['spPostingExpDt']);
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td ><a href="<?php echo $BaseUrl.'/freelancer/project-bid.php?postid='.$row['idspPostings'];?>" class="red"  ><?php echo $row['spPostingtitle'];?></a></td>
                                                    
                                                    <td>$<?php echo $row['spPostingPrice'];?></td>
                                                    <td>
                                                        <a href="javascript:void(0)" class="red" >Waiting For Admin Review </a>
                                                    </td>
                                                </tr> <?php
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
        </section>



    	<?php 
        include('../component/footer.php');
        include('../component/btm_script.php'); 
        ?>
    </body>
</html>
