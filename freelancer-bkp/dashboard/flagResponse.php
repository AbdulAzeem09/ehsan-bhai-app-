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
    $activePage = 17;

    $fps = new _freelance_project_status;
    $_GET['categoryId'] = 5;
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../../component/f_links.php');?>
           
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
                                <li>Flagged Projects Response</li>
                              
                            </ul>
                        </div>
                    </div> -->
                    <div class="col-xs-12 nopadding dashboard-section">
                        
                        <div class="col-xs-12 dashboardtable">
                            <div class="table-responsive">

                                <table class="table tbl_activebid">
                                    <thead style="background-color: #3e3e3e;color: #fff;">
                                        <tr>
                                            <th style="color:#fff;">ID</th>
                                            <th style="color:#fff;">Project Name</th>
                                            <th style="text-align: left!important;color:#fff;">Admin Response</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                      //  $p = new _postings;
                                      //  $pq = new _postingview;

                                        /* $sf  = new _freelancerposting;*/
                                         $sf  = new _freelancerposting;
                                        $i = 1;
                                        
                                       // $res = $pq->myflagresponse($_GET['categoryId'], $_SESSION['pid']);
                                        $res = $sf->myflagresponse1(5, $_SESSION['pid']);

                                        //echo $pq->ta->sql;

                                       // echo $sf->ta->sql;

                                        if($res){
                                            while($row = mysqli_fetch_assoc($res)){

                                                //print_r($row);

                                                $f  = new _flagpost;

                                              $res1=  $f->myflagresponsenew(5, $row['idspPostings']);
//echo $f->ta->sql;
                                                while($row1 = mysqli_fetch_assoc($res1)){

                                              /*  echo "<pre>"; 
                                                print_r($row1);*/
                                                $dt = new DateTime($row['spPostingExpDt']);
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td ><a href="<?php echo $BaseUrl.'/freelancer/project-bid.php?postid='.$row['idspPostings'];?>" class="red freelancer_capitalize"  ><?php echo $row['spPostingTitle'];?></a></td>
                                                    
                                                    <td><?php echo $row1['admin_comment'];?></td>
                                                    
                                                </tr> <?php
                                                $i++;
                                           
                                                }
                                            }
                                        }else{
                                            echo "<td colspan='3'><center>No Record Found</center></td>";
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
