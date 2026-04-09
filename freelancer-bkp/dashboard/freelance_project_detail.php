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

    $f = new _spprofiles;
    $sl = new _shortlist;

    if (isset($_GET['postid']) && $_GET['postid'] > 0) {
        $postid = $_GET['postid'];
    }


    $_GET['categoryID'] = 5;

    $activePage = 19;
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../../component/f_links.php');?>
        <!--This script for posting timeline data End-->
        
        <!-- ===== INPAGE SCRIPTS====== -->
        <!-- High Charts script -->
     
        <?php include('../../component/dashboard-link.php'); ?>
        <!-- Morris chart -->
        <link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        
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


               
               <!--  <div class="sidebar col-xs-1 col-sm-1" id="sidebar" >
                    
             
                </div> -->
                <div class="col-xs-12 col-sm-12 nopadding">

                   <p class="back-to-projectlist" style="margin-top: 28px;">
                    <a href="<?php echo $BaseUrl.'/freelancer/dashboard/freelancer_hire_project.php';?>" style="color:#ff6b04;"><i class="fa fa-chevron-left"></i>&nbsp; Back to Hire list</a>
                </p>
                      
                    <div class="col-md-12 nopadding dashboard-section" style="margin-top: 12px;"> 
                        <div class="col-xs-12 dashboardbreadcrum">
                            <ul class="breadcrumb">
                              <li><a href="<?php echo $BaseUrl;?>/freelancer/dashboard/poster_dashboard.php">Dashboard</a></li>
                              <li><a href="<?php echo $BaseUrl;?>/freelancer/dashboard/freelancer_hire_project.php">Hire Freelancer Project</a></li>
                              <li>Project detail</li>
                              <!-- <li><?php echo $title;?></li> -->
                              <?php if($_SESSION['ptid'] != 2){?>
                               <a href="<?php echo $BaseUrl ?>/post-ad/freelancer/?post" class="btn post-project postproject" style="float: right;background-color: orange;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;" >Post a project</a>

                             <?php } ?>
                            </ul>
                        </div>
                    </div>
                   <?php

                      //print_r($_SESSION);
                    ?>
                    <!-- <div class="col-xs-12 nopadding dashboard-section freelancer_dashboard">
                        <div class="col-xs-12 dashboardbreadcrum freelancer_dashboard">
                            <ul class="breadcrumb freelancer_dashboard">
                                <li><a href="<?php echo $BaseUrl;?>/freelancer/dashboard/">Dashboard</a></li>
                                <li>Project Detail</li>
                              
                            </ul>
                        </div>
                    </div> -->
                    <div class="col-xs-12 nopadding dashboard-section" style="margin-top: 10px;">
                       
                        <?php
                    //$p = new _postingview;
                          $sf  = new _freelance_chat_project;
                   // $res = $p->singletimelines($_GET['postid']);
                           $res = $sf->read($_GET['postid']);
                    //echo $p->ta->sql;

                          // echo $sf->ta->sql;
                          // print_r($res);


                    if($res->num_rows > 0){
                        $row = mysqli_fetch_assoc($res);
                      
                        $overview = $row['chat_conversation'];
                       

                                            $f = new _spprofiles;
                                            /*$f = new _spfreelancer_profile;*/
                                            /*$result_fi = $fi->read($row['idspProfiles']);*/

                                                $pro = $f->read($row['receiver_idspProfiles']);

                                                $pro_data = mysqli_fetch_assoc($pro);

                                              /*  echo "<pre>";
                                                print_r($row);*/
                                                  
                                                  $fi = new _spfreelancer_profile;
                                            $result_fi = $fi->read($row['receiver_idspProfiles']);

                                            $row_fi = mysqli_fetch_assoc($result_fi);

                                             /*print_r($row);*/

                                                /*print_r($pro_data['spProfileName']);*/
                                               
                        //$pf = new _postfield;
                        
                        //$result_pf = $pf->read($row['idspPostings']);
                        

                                              $skills = $row_fi['skill'];
                                            $perhour = $row_fi['hourlyrate'];

                                            $skill = explode(',', $skills);


                     //  echo $sf->ta->sql."<br>";

                   
                    } ?>
                        <div class="col-xs-12 freelancer-post-detail">
                            <h2 class="designation-haeding freelancer_capitalize"><?php echo "Project for " .ucfirst($pro_data['spProfileName']);?>



                            <?php if($row['complete_status'] == 0){   




                              ?>

                              <?php if($_SESSION['ptid'] != 2){?>
                              
                                                                            <a class="btn btn-warning incomplete" style="float:right;color: #fff;" href="<?php echo $BaseUrl.'/freelancer/dashboard/complete_project.php?status=2&postid='.$row['id'];?>">In Complete</a>&nbsp;&nbsp;
                                                                                <a class="btn btn-info complete" style="float:right;color: #fff;margin-right: 10px;" href="<?php echo $BaseUrl.'/freelancer/dashboard/complete_project.php?status=1&postid='.$row['id'];?>">Complete</a>


                                            <?php   } ?>  


                                            <?php }elseif($row['complete_status'] == 1){
                                                   
                                                   echo "<span style='float:right;'>Project is Completed</span>";
                                            
                                            }else{

                                                 echo "<span  style='float:right;'>In Completed</span>";

                                            } ?>                                  
                                                           
                            </h2>


                           
                            <div class="col-xs-12 nopadding">
                                <?php
                                if(count($skill) >0){
                                    foreach($skill as $key => $value){
                                        if($value != ''){
                                            echo "<span class='skills-tags freelancer_uppercase'>".$value."</span>";
                                        }
                                       
                                    }
                                }
                                ?>
                                
                            </div>
                            <div class="col-xs-12 nopadding margin-top-13">
                                 <?php if(!empty($perhour)){  ?>
                                                                <div class="col-xs-12 nopadding"><span class="black pull-left">Hourly Rate</span>
                    &nbsp;&nbsp;<span class="red ">$<?php echo $perhour;?>/hr</span></div>
                                                                  <?php } ?>

                            </div>
                            <div class="col-xs-12 detail-description text-justify">
                                <p style="word-break: break-word;padding-top: 14px;"><?php echo $overview;?></p>
                            </div>
                        </div>
                    </div>

              <!--    milestone -->




                    <div class="col-md-12 nopadding dashboard-section" style="margin-top: 24px;"> 
                        
                        <?php if($_SESSION['ptid'] != 2){?>

                         <a class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal" style="color: #fff;float: right;margin: 3px 6px 0px 0px;">Create Milestone</a>

                         <?php } ?>

                        <h4 style="padding-left: 10px;">Milestone  </h4>

              <div class="modal fade" id="myModal" role="dialog">
                                                            <div class="modal-dialog">
                                                            
                                                              <!-- Modal content-->
                                                              <div class="modal-content">
                                                                <div class="modal-header">
                                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                  <h4 class="modal-title">Create Milestone</h4>
                                                                </div>
                                                                 <form action="create_milestone.php" id="milestone_frm" method="post">
                                                                <div class="modal-body">
                                                                 
                                                                    <input type="hidden" name="freelancer_projectid" value="<?php echo $row['id'] ?>">
                                                                    <input type="hidden" name="freelancer_profileid"  value="<?php echo $row['receiver_idspProfiles'] ?>">
                                                                    <input type="hidden" name="bussiness_profile_id" value="<?php echo $_SESSION['pid'] ?>">
                                                                    <input type="hidden" name="created" value="<?php echo date('Y-m-d h:i:s'); ?>">
                                                                      <div class="form-group">
                                                                        <label for="amount" style="float:left;">Amount <span id="amt_err" style="color:red"></span></label>
                                                                        <input type="number" class="form-control" name="amount" id="amount">
                                                                      </div>
                                                                      <div class="form-group">
                                                                        <label for="description" style="float:left;">Milestone <span id="desc_err" style="color:red"></span></label>
                                                                        <!-- <input type="password" class="form-control" id="pwd"> -->
                                                                        <textarea class="form-control" name="description" id="description"></textarea>
                                                                      </div>
                                                                     <!--  <div class="checkbox">
                                                                        <label><input type="checkbox"> Remember me</label>
                                                                      </div> -->
                                                                      <!-- <button type="submit" class="btn btn-default">Submit</button> -->
                                                                
                                                                </div>
                                                                <div class="modal-footer">
                                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                  <button type="button" id="m_submit" class="btn btn-info">Submit</button>
                                                                </div>
                                                                  </form>
                                                              </div>  
                                                            </div>
                                                       </div>
                      
               
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
                                          $res = $sf->checkmilestone($_GET['postid']);

                                      // echo $sf->ta->sql;

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
                                                      
                                                    <td class="">
                                                       <?php if($row['request_status'] == 0){


                                                        if($row['bussiness_profile_id'] == $_SESSION['pid']){
                                                         
                                                         ?>

                                                         <a href="<?php echo $BaseUrl.'/freelancer/dashboard/milestone_update.php?status=1&postid='.$row['id'];?>" style="color:#fff;" class="btn btn-info">Release</a>

                                                         <a href="<?php echo $BaseUrl.'/freelancer/dashboard/milestone_update.php?status=2&postid='.$row['id'];?>" style="color:#fff;" class="btn btn-primary rejmile">Cancel</a>

                                                        <!--   <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Status
                                                                                <span class="caret"></span></button>
                                                            <ul class="dropdown-menu setting_left">
                                                                <li><a href="<?php echo $BaseUrl.'/freelancer/dashboard/milestone_update.php?status=1&postid='.$row['id'];?>">Realease</a></li>
                                                                <li><a href="<?php echo $BaseUrl.'/freelancer/dashboard/milestone_update.php?status=2&postid='.$row['id'];?>">Cancel</a></li>
                                                                
                                                            </ul> -->

 
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
 
                                                    </section>


                                                      <!--   <a href="<?php echo $BaseUrl.'/freelancer/dashboard/detail.php?postid='.$row['idspPostings'];?>" class="red" ><i class="fa fa-eye"></i></a>
                                                        <a href="<?php echo $BaseUrl.'/post-ad/freelancer/?postid='.$row['idspPostings'].'&exp=1'; ?>"><img src="<?php echo $BaseUrl.'/assets/images/icon/edit.png'?>" class="img-responsive" alt="Edit" ></a> -->
                                                        
                                                    </td>
                                                    
                                                    
                                                </tr> <?php
                                                $i++;
                                            }
                                        }else{
                                            echo "<td colspan='5'><center>No Milestone </center></td>";
                                        }
                                        ?>
                                        
                                      
                                    </tbody>
                                </table>
                            </div>
                    </div>

                </div>
            </div>


   <script type="text/javascript">



     $(".complete").click(function(e){
   // alert();
   e.preventDefault();
    /*var postid = $(this).attr("data-postid");*/
     var link = $(this).attr('href');

    // alert(link);
   // alert(postid);

      swal({
            title: "Are you sure you want to Complete Project?",
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


          $(".incomplete").click(function(e){
   // alert();
   e.preventDefault();
    /*var postid = $(this).attr("data-postid");*/
     var link = $(this).attr('href');

    // alert(link);
   // alert(postid);

      swal({
            title: "Are you sure you want to In Complete Project?",
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




     $(".rejmile").click(function(e){
   // alert();
   e.preventDefault();
    /*var postid = $(this).attr("data-postid");*/
     var link = $(this).attr('href');

    // alert(link);
   // alert(postid);

      swal({
            title: "Are you sure you want to Cancel Milestone?",
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

     
    $('#m_submit').on('click', function() {
      
      var amount = $("#amount").val();
      var description = $("#description").val();
       
       if(amount == "" && description == ""){

        $("#amt_err").text("Please Enter Amount");
         $("#desc_err").text("Please Enter Milestone Name");
           $("#amount").focus();

       }else if(amount == ""){
             
               $("#amt_err").text("Please Enter Amount");
                $("#amount").focus();
     
       }else if(description == ""){
             
             $("#desc_err").text("Please Enter Milestone Name");
             $("#amt_err").text("");
               $("#description").focus();
       }else{
         
         $("#milestone_frm").submit();

       }


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
