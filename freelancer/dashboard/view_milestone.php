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
    if($_SESSION["ptname"] == "Freelancer"){ 
    $activePage = 21;

  }elseif($_SESSION["ptname"] == "Bussiness"){

        $activePage = 19;

  }

    $fps = new _freelance_project_status;
    

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
            <div class="container nopadding projectslist dashboardpage">
               
                <div class="sidebar col-xs-3 col-sm-3" id="sidebar" >
                    
                    <?php include('left-menu.php');?>
                </div>
                <div class="col-xs-12 col-sm-9 nopadding">
                  
                    <!-- <div class="col-xs-12 nopadding dashboard-section freelancer_dashboard">
                        <div class="col-xs-12 dashboardbreadcrum freelancer_dashboard">
                            <ul class="breadcrumb freelancer_dashboard">
                                <li><a href="<?php echo $BaseUrl;?>/freelancer">Dashboard</a></li>
                                <li>Expired Projects</li>
                              
                            </ul>
                        </div>
                    </div> -->
                    <div class="col-xs-12 nopadding dashboard-section" style="margin-top: 10px;">
                        
                        <div class="col-xs-12 dashboardtable">
                            <div class="table-responsive">

                                <table class="table table-striped tbl_store_setting">
                                    <thead style="background-color: #3e3e3e;color: #fff;">
                                        <tr>
                                            <th style="color:#fff;">ID</th>
                                            <th style="color:#fff;">Date </th>
                                            <th style="color:#fff;">Description </th>
                                             
                                            <th style="color:#fff;">Amount</th>
                                            <th style="color:#fff;">Status</th>

                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                      //  $p = new _postingview;
                                        $i = 1;
                                          $sf  = new _milestone;
                                        //$res = $p->myExpireProduct(5, $_SESSION['pid']);
                                          $res = $sf->checkmilestone($_GET['project_id']);

                                       //echo $sf->ta->sql;

                                        if($res){
                                            while($row = mysqli_fetch_assoc($res)){


                                                //print_r($row);
                                                $f = new _spprofiles;

                                                $pro = $f->read($row['receiver_idspProfiles']);

                                                $pro_data = mysqli_fetch_assoc($pro);

                                                /*print_r($pro_data['spProfileName']);*/
                                                /*$dt = new DateTime($row['chat_date']);*/
                                                ?>
                                                <tr>
                                                    
                                                    <td><?php echo $i; ?></td>
                                                     <td ><p><?php echo date('d-m-Y',(strtotime($row['created']))); ?></p></td>
                                                    
                                                    <td><?php echo $row['description'];?></td>
                                                    <td>$<?php echo $row['amount']; ?></td>
                                                      
                                                    <td class="text-center">
                                                       <?php if($row['request_status'] == 0){


                                                        //print_r($row['request_status']);

                                                        if($row['bussiness_profile_id'] == $_SESSION['pid']){
                                                         
                                                         ?>

                                                          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Status
                                                                                <span class="caret"></span></button>
                                                            <ul class="dropdown-menu setting_left">
                                                                <li><a href="<?php echo $BaseUrl.'/freelancer/dashboard/milestone_update.php?status=1&postid='.$row['id'];?>">Realease</a></li>
                                                                <li><a href="<?php echo $BaseUrl.'/freelancer/dashboard/milestone_update.php?status=2&postid='.$row['id'];?>">Cancel</a></li>
                                                                
                                                            </ul>

 
                                                        <?php
                                                       }else{

                                                           echo "Pending";
                                                       }

                                                       }elseif ($row['request_status'] == 1) {
                                                           
                                                           echo "Released";
                                                           ?>
                                                        
                                                   


                                                       <?php
                                                       
                                                       }elseif ($row['request_status'] == 2) {
                                                           
                                                           echo "cancelled";


                                                       }
                                                      ?>

                                                      


                                                      <!--   <a href="<?php echo $BaseUrl.'/freelancer/dashboard/detail.php?postid='.$row['idspPostings'];?>" class="red" ><i class="fa fa-eye"></i></a>
                                                        <a href="<?php echo $BaseUrl.'/post-ad/freelancer/?postid='.$row['idspPostings'].'&exp=1'; ?>"><img src="<?php echo $BaseUrl.'/assets/images/icon/edit.png'?>" class="img-responsive" alt="Edit" ></a> -->
                                                        
                                                    </td>
                                                    
                                                    
                                                </tr> <?php
                                                $i++;
                                            }
                                        }else{
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