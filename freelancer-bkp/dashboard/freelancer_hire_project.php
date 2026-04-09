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
    $activePage = 19;

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
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
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
                              <li><a href="<?php echo $BaseUrl;?>/freelancer/dashboard/poster_dashboard.php">Dashboard</a></li>
                              <li>Favourite Freelancers </li>
                              <!-- <li><?php echo $title;?></li> -->
                               <a href="<?php echo $BaseUrl ?>/post-ad/freelancer/?post" class="btn post-project postproject" style="float: right;background-color: orange;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;" >Post a project</a>
                            </ul>
                        </div>

                       
                    </div>
                  
                    <!-- <div class="col-xs-12 nopadding dashboard-section freelancer_dashboard">
                        <div class="col-xs-12 dashboardbreadcrum freelancer_dashboard">
                            <ul class="breadcrumb freelancer_dashboard">
                                <li><a href="<?php echo $BaseUrl;?>/freelancer">Dashboard</a></li>
                                <li>Expired Projects</li>
                              
                            </ul>
                        </div>
                    </div> -->
                    <div class="col-xs-12 nopadding dashboard-section" style="margin-top: 10px;">


                        <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home">Hired Freelancer</a></li>
                        <li><a data-toggle="tab" href="#menu1">Awarded Freelancer</a></li>
                       <!--  <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
                        <li><a data-toggle="tab" href="#menu3">Menu 3</a></li> -->
                      </ul>
                        
                        
                        <div class="col-xs-12 dashboardtable">
                            <div class="table-responsive">

                                <div class="tab-content">
                                <div id="home" class="tab-pane fade in active">

                                <table class="table table-striped tbl_store_setting">
                                    <thead style="background-color: #3e3e3e;color: #fff;">
                                        <tr>
                                            <th style="color:#fff;">ID</th>
                                            <th style="color:#fff;">Project Title</th>
                                             <th style="color:#fff;">Hired</th>
                                             <th style="color:#fff;">Chat</th>
                                            <th style="color:#fff;">Price</th>
                                             <th style="color:#fff;">Price type</th>
                                          <!--   <th style="color:#fff;">created</th> -->

                                            <th class="action text-center" style="color:#fff;text-align: center;">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                      //  $p = new _postingview;
                                        $i = 1;
                                          $sf  = new _freelance_chat_project;
                                        //$res = $p->myExpireProduct(5, $_SESSION['pid']);
                                          $res = $sf->getbussinesConversation($_SESSION['pid']);

                                       //echo $sf->ta->sql;

                                        if($res){
                                            while($row = mysqli_fetch_assoc($res)){


                                               /* print_r($row);*/
                                                $f = new _spprofiles;

                                                $pro = $f->read($row['receiver_idspProfiles']);

                                                $pro_data = mysqli_fetch_assoc($pro);

                                                /*print_r($pro_data['spProfileName']);*/
                                                $dt = new DateTime($row['chat_date']);
                                                ?>
                                                <tr>
                                                    
                                                    <td><?php echo $row['id']; ?></td>
                                            
                                               <td ><!-- <a href="<?php echo $BaseUrl.'/freelancer/dashboard/detail.php?postid='.$row['idspPostings'];?>" class="red freelancer_capitalize"  > -->

                                                <a href="<?php echo $BaseUrl.'/freelancer/dashboard/freelance_project_detail.php?postid='.$row['id'];?>" class="red freelancer_capitalize"  ><?php echo "Project for " .ucfirst($pro_data['spProfileName']);?></a></td>

                                                   <td><?php echo  ucfirst($pro_data['spProfileName']);?></td>

                                                   <td> <a href="javascript:void(0)"  onclick="javascript:chatWith(<?php echo $row['receiver_idspProfiles'];?>)"  class="red"><i class='fas fa-comment-dots' style="color: #ff7208;"></i></a> </td>
                                                    
                                                    <td>$<?php echo $row['bidPrice'];?></td>
                                                         <td><?php echo $row['PriceFixed']; ?></td>

                                                  <!--   <td><?php echo $dt->format('d-M-Y'); ?></td> -->
                                                    <td class="text-center">
                                                       <?php if($row['status'] == 0){

                                                        echo "Pending";

                                                       }elseif ($row['status'] == 1) {
                                                           
                                                           echo "Accepted";
                                                           ?>
                                                   <!--      
                                                    <a class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal<?php echo $row['id']; ?>" style="color: #fff;">Create Milestone</a>
                                                     


                                                       <div class="modal fade" id="myModal<?php echo $row['id']; ?>" role="dialog">
                                                            <div class="modal-dialog">
                                                            
                                                            
                                                              <div class="modal-content">
                                                                <div class="modal-header">
                                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                  <h4 class="modal-title">Create Milestone</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                  <form action="create_milestone.php" method="post">
                                                                    <input type="hidden" name="freelancer_projectid" value="<?php echo $row['id'] ?>">
                                                                    <input type="hidden" name="freelancer_profileid"  value="<?php echo $row['receiver_idspProfiles'] ?>">
                                                                    <input type="hidden" name="bussiness_profile_id" value="<?php echo $_SESSION['pid'] ?>">
                                                                    <input type="hidden" name="created" value="<?php echo date('Y-m-d h:i:s'); ?>">
                                                                      <div class="form-group">
                                                                        <label for="amount" style="float:left;">Amount:</label>
                                                                        <input type="text" class="form-control" name="amount" id="amount">
                                                                      </div>
                                                                      <div class="form-group">
                                                                        <label for="description" style="float:left;">Description:</label>
                                                                       
                                                                        <textarea class="form-control" name="description" id="description"></textarea>
                                                                      </div>
                                                                   
                                                                
                                                                </div>
                                                                <div class="modal-footer">
                                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                  <button type="submit" class="btn btn-info">Submit</button>
                                                                </div>
                                                                  </form>
                                                              </div>  
                                                            </div>
                                                       </div> -->


                                                       <?php
                                                /*        $m = new _milestone;

                                                       $checkm = $m->checkmilestone($row['id']);

                                                       //print_r($checkm);
                                                       if($checkm->num_rows>0){
                                                        ?>
                                                        <br>

                                                             <a href="view_milestone.php?project_id=<?php echo $row['id']; ?>" class="btn btn-primary btn-md"  style="color: #fff;margin-top: 10px;">View Milestone</a>

                                                          <?php   
                                                       }*/

                                                       }else{
                                                            
                                                            echo "Rejected";
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



                     

                         <div id="menu1" class="tab-pane fade">
                            
                              <table class="table table-striped tbl_store_setting">
                                    <thead style="background-color: #3e3e3e;color: #fff;">
                                        <tr>
                                            <th style="color:#fff;">ID</th>
                                            <th style="color:#fff;">Project Title</th>
                                            <th style="color:#fff;">Hired </th>
                                             <th style="color:#fff;">Chat</th>
                                            <th style="color:#fff;">Price ($)</th>
                                             <th style="color:#fff;">Price type</th>
                                           <!--  <th style="color:#fff;">created</th>
 -->
                                            <th class="action text-center" style="color:#fff;text-align: center;">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                      //  $p = new _postingview;
                                        $i = 1;
                                          $sf  = new _freelancerposting;
                                        //$res = $p->myExpireProduct(5, $_SESSION['pid']);
                                          $res = $sf->awardedproject($_SESSION['pid']);

                                      // echo $sf->ta->sql;

                                        if($res){
                                            while($row = mysqli_fetch_assoc($res)){


                                              /*  print_r($row);*/
                                                $f = new _spprofiles;

                                                $pro = $f->read($row['spProfiles_idspProfiles']);

                                                $pro_data = mysqli_fetch_assoc($pro);

                                                /*print_r($pro_data['spProfileName']);*/
                                                $dt = new DateTime($row['spPostingDate']);
                                                ?>
                                                <tr>
                                                    
                                                    <td><?php echo $row['idspPostings']; ?></td>
                                            
                                               <td ><!-- <a href="<?php echo $BaseUrl.'/freelancer/dashboard/detail.php?postid='.$row['idspPostings'];?>" class="red freelancer_capitalize" > -->

                                               <!--  <a href="<?php echo $BaseUrl.'/freelancer/dashboard/freelance_project_detail.php?postid='.$row['id'];?>" class="red freelancer_capitalize"  ><?php echo  ucfirst($pro_data['spPostingTitle']);?></a> -->
                                                 
                                                  <a href="<?php echo $BaseUrl.'/freelancer/dashboard/project-bid.php?postid='.$row['idspPostings'];?>" class="red freelancer_capitalize"  ><?php echo  ucfirst($row['spPostingTitle']);?></a>
                                               </td>
                                               <td><?php echo  ucfirst($pro_data['spProfileName']);?></td>

                                                <td> <a href="javascript:void(0)"  onclick="javascript:chatWith(<?php echo $row['spProfiles_idspProfiles'];?>)"  class="red"><i class='fas fa-comment-dots' style="color: #ff7208;"></i></a> </td>
                                                    
                                                    <td>$<?php echo $row['fps_price'];?></td>
                                                         <td><?php
                                                               if(!empty($row['spPostingPriceFixed'])){

                                                                 echo "Fixed";

                                                               }else{
                                                                   
                                                                 echo "Hourly";

                                                               }
                                                         ?></td>

                                                   <!--  <td><?php echo $dt->format('d-M-Y'); ?></td> -->
                                                    <td class="text-center">
                                                       <?php if($row['status'] == 0){

                                                        echo "Pending";

                                                       }elseif ($row['status'] == 1) {
                                                           
                                                           echo "Accepted";
                                                           ?>
                                               

                                                       <?php
                                              

                                                       }else{
                                                            
                                                            echo "Rejected";
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