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
    $activePage = 21;

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
                              <li><a href="<?php echo $BaseUrl;?>/freelancer/dashboard">Dashboard</a></li>
                              <li>Requested Project</li>
                            
                              <!-- <li><?php echo $title;?></li> -->
                             
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
                        
                        <div class="col-xs-12 dashboardtable">
                            <div class="table-responsive">

                                <table class="table table-striped tbl_store_setting">
                                    <thead style="background-color: #3e3e3e;color: #fff;">
                                        <tr>
                                            <th style="color:#fff;">ID</th>
                                            <th style="color:#fff;">Project Title</th>
                                            <th style="color:#fff;">Chat</th>

                                            <th style="color:#fff;">Price</th>
                                             <th style="color:#fff;">Price type</th>
                                            <th style="color:#fff;">created</th>

                                            <th class="action" style="color:#fff;">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                      //  $p = new _postingview;
                                        $i = 1;
                                          $sf  = new _freelance_chat_project;
                                        //$res = $p->myExpireProduct(5, $_SESSION['pid']);
                                          $res = $sf->getfreelancerConversation($_SESSION['pid']);

                                      /* echo $sf->ta->sql;*/

                                        if($res){
                                            while($row = mysqli_fetch_assoc($res)){


                                               // print_r($row);
                                                $f = new _spprofiles;

                                                $pro = $f->read($row['sender_idspProfiles']);

                                                $pro_data = mysqli_fetch_assoc($pro);

                                                /*print_r($pro_data['spProfileName']);*/
                                                $dt = new DateTime($row['chat_date']);
                                                ?>
                                                <tr>
                                                    
                                                    <td><?php echo $row['id']; ?></td>
                                                                                                   <td ><!-- <a href="<?php echo $BaseUrl.'/freelancer/dashboard/detail.php?postid='.$row['idspPostings'];?>" class="red freelancer_capitalize"  > -->

                                                                                                    <a href="<?php echo $BaseUrl.'/freelancer/dashboard/freelance_project_detail.php?postid='.$row['id'];?>" class="red freelancer_capitalize"  ><?php echo "Requested By " .ucfirst($pro_data['spProfileName']);?></a></td>
                                                    <td> <a href="javascript:void(0)"  onclick="javascript:chatWith(<?php echo $row['sender_idspProfiles'];?>)"  class="red"><i class='fas fa-comment-dots' style="color: #ff7208;"></i></a> </td>
                                                    
                                                    <td>$<?php echo $row['bidPrice'];?></td>
                                                         <td><?php echo $row['PriceFixed']; ?></td>

                                                    <td><?php echo $dt->format('d-M-Y'); ?></td>
                                                    <td class="text-center">
                                                       <?php if($row['status'] == 0){
                                                        ?>

                                                           <a href="<?php echo $BaseUrl.'/freelancer/dashboard/requested_project.php?status=1&postid='.$row['id'];?>" class="btn btn-info" style="color:#fff;">Accept</a>

                                                           <a href="<?php echo $BaseUrl.'/freelancer/dashboard/requested_project.php?status=2&postid='.$row['id'];?>" class="btn btn-primary rejpro" style="color:#fff;">Reject</a>

                                                           <!--     <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Status
                                                                                <span class="caret"></span></button>
                                                                                <ul class="dropdown-menu setting_left">
                                                                                    <li><a href="<?php echo $BaseUrl.'/freelancer/dashboard/requested_project.php?status=1&postid='.$row['id'];?>">Accept</a></li>
                                                                                    <li><a href="<?php echo $BaseUrl.'/freelancer/dashboard/requested_project.php?status=2&postid='.$row['id'];?>">Reject</a></li>
                                                                                    
                                                                                </ul>
                                                                           -->

                                                         

                                                        <?php

                                                       }elseif ($row['status'] == 1) {
                                                           
                                                           echo "Accepted";

                                                  /*         ?>

                                                           <?php
                                                        $m = new _milestone;

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
                        </div>
                    </div>
                </div>
            </div>
        </section>

<script type="text/javascript">
    
 $(".rejpro").click(function(e){
   // alert();
   e.preventDefault();
    /*var postid = $(this).attr("data-postid");*/
     var link = $(this).attr('href');

    // alert(link);
   // alert(postid);

      swal({
            title: "Are you sure you want to Reject?",
            type: "warning",
            confirmButtonClass: "sweet_ok",
            confirmButtonText: "Yes",
            cancelButtonClass: "sweet_cancel",
            cancelButtonText: "No",
            showCancelButton: true,
          },
        function(isConfirm) {
            if (isConfirm) {
             window.location.href = link;
            }
        });

  });


</script>


    	<?php 
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        ?>
    </body>
</html>
<?php 
} ?>