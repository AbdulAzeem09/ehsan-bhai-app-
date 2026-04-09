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
    $activePage = 4;
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
                              <li>Awarded Project</li>
                            
                              <!-- <li><?php echo $title;?></li> -->
                             
                            </ul>
                        </div>
                    </div>
                   <!--  <div class="col-xs-12 nopadding dashboard-section freelancer_dashboard" style="margin-top: 10px;">
                        <div class="col-xs-12 dashboardbreadcrum freelancer_dashboard">
                            <ul class="breadcrumb freelancer_dashboard" >
                                <li><a href="<?php echo $BaseUrl;?>/freelancer">Dashboard</a></li>
                                <li>Active Projects</li>
                              
                            </ul>
                        </div>
                    </div> -->
                    <div class="col-xs-12 nopadding dashboard-section" style="margin-top: 10px;">
                        
                        <div class="col-xs-12 dashboardtable">
                            <div class="table-responsive" style="height: auto;">
                                
                                <table class="table text-center tbl_activebid">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Project Name</th>
                                            <th>Price</th>
                                            <th>Chat</th>
                                            <th>Assign Date</th>
                                            <th class="action">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $fps = new _freelance_project_status;
                                        $res = $fps->myAssignProject($_SESSION['pid']);


                                       //echo $fps->ta->sql;


                                        if(!empty($res)){

                                            while($row = mysqli_fetch_assoc($res)){
												
												//echo "<pre>"; print_r($row);
                                                $dt = new DateTime($row['fps_start_date']);

                                               // $p = new _postings;
                                                
                                                 

                                                $sf = new _freelancerposting;

                               /*$result = $p->singletimelines($row['spPosting_idspPostings']);*/

                                      $result = $sf->singletimelines1($row['spPosting_idspPostings']);


                                               // echo $sf->ta->sql;

                                                if($result){
                                                    $row2 = mysqli_fetch_assoc($result);

                                                  /*  print_r($row2);*/
                                                    ?>
                                                    <tr>
                                                        <!-- Modal -->
                                                        <div id="myproject-<?php echo $row['spPosting_idspPostings'];?>" class="modal fade" role="dialog">
                                                            <div class="modal-dialog sharestorepos">
                                                                <!-- Modal content-->
                                                                <form method="post" action="addmilestone.php">
                                                                    <div class="modal-content no-radius">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                            <h4 class="modal-title"><?php echo $row2['spPostingTitle'];?></h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <input type="hidden" name="spPosting_idspPostings" value="<?php echo $row['spPosting_idspPostings']; ?>">
                                                                            <input type="hidden" name="spProfiles_idspProfiles" value="<?php echo $row['spProfiles_idspProfiles']; ?>">
                                                                            <input type="hidden" name="milestoneStatus" value="0" >
                                                                            <input type="hidden" name="milestoneSubmitDate" value="<?php echo date('Y-m-d'); ?>">
                                                                            <div class="row add_form_body">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="Amount">Amount</label>
                                                                                        <input type="text" class="form-control" name="milestonePrice" >
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="Deliver Day">Deliver Day</label>
                                                                                        <input type="date" class="form-control" name="milestoneDeliverDay" >
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="Description">Description</label>
                                                                                        <textarea name="milestoneDescription" class="form-control"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary" >Save</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <td><?php echo $row['spPosting_idspPostings'];?></td>
                                                        <td ><a href="<?php echo $BaseUrl.'/freelancer/dashboard/project-bid.php?postid='.$row['spPosting_idspPostings'];?>" class="red freelancer_capitalize"  ><?php echo $row2['spPostingTitle'];?></a></td>
                                                        
                                                        <td>$<?php echo $row['fps_price'];?></td>
                                                        <td> <a href="javascript:void(0)"  onclick="javascript:chatWith(<?php echo $row2['spProfiles_idspProfiles'];?>)" class="red"><i class='fas fa-comment-dots'></i></a></td>
                                                        <td><?php echo $dt->format('M d, Y'); ?></td>
                                                        
                                                        <td>
                                                             <?php
                                                                   

                                                               $status  =  $fps->readFreelanceProject($row['spPosting_idspPostings']);
                                                               $srow = mysqli_fetch_assoc($status);
                                                               
                                                         /*      print_r($srow);*/


                                                                 if($row['status'] == 0){  ?>


                                                                    <a href="<?php echo $BaseUrl.'/freelancer/dashboard/update_project_status.php?status=1&postid='.$row['spPosting_idspPostings'];?>" class="btn btn-info">Accept</a>

                                                                    <a href="<?php echo $BaseUrl.'/freelancer/dashboard/update_project_status.php?status=2&postid='.$row['spPosting_idspPostings'];?>" class="btn btn-primary rejpro" >Reject</a>
                                                      

                                                            <!--    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Status
                                                                                <span class="caret"></span></button>
                                                                                <ul class="dropdown-menu setting_left">
                                                                                    <li><a href="<?php echo $BaseUrl.'/freelancer/dashboard/update_project_status.php?status=1&postid='.$row['spPosting_idspPostings'];?>">Accept</a></li>
                                                                                    <li><a href="<?php echo $BaseUrl.'/freelancer/dashboard/update_project_status.php?status=2&postid='.$row['spPosting_idspPostings'];?>">Reject</a></li>
                                                                                    
                                                                                </ul>
                                                                           -->

                                                         

                                                        <?php

                                                       }else if ($row['status'] == 1) {
                                                           
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

                                                       }else if ($row['status'] == 3) {
														   echo "Canceled By Client";
													   }else if ($row['status'] == 2) {
                                                            
                                                            echo "Rejected";
                                                       } 



                                                      ?>
                                                             

                                                           <!--  <a href="javascript(0)" class="red" data-toggle="modal" data-target="#myproject-<?php echo $row['spPosting_idspPostings'];?>">Request Milestone</a> -->
                                                        </td>
                                                    </tr> <?php
                                                }
                                                
                                            }
                                        }
                                        else{

                                            echo "
                                           <td colspan='4'>No Record Found</td>";
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
}
?>