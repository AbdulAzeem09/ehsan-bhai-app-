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
    $activePage = 3;
	
	/*
	 $b = new _freelance_placebid;
	 $result = $b->readprofilebids($_SESSION['pid']);
	 //spfreelancer = idspPostings
	 //freelance_project_status = spPosting_idspPostings
	 //echo $b->ta->sql;
	  while($row1 = mysqli_fetch_assoc($result)){
		  print "<pre>"; print_r($row1); print "</pre>";
	  }*/
	 
	
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

                       <div class="col-md-12 nopadding dashboard-section" style="margin-top: 24px;">
                        <div class="col-xs-12 dashboardbreadcrum">
                            <ul class="breadcrumb">
                              <li><a href="<?php echo $BaseUrl;?>/freelancer/dashboard">Dashboard</a></li>
                              <li>Submitted Proposals</li>
                            
                              <!-- <li><?php echo $title;?></li> -->
                             
                            </ul>
                        </div>
                    </div>
					
					<div class="col-xs-12 col-sm-12 nopadding">
                <div>
                <?php 
                if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
                    if($_SESSION['count'] <= 1){
                        $_SESSION['count'] +=1; ?>
                        <div class="space"></div>
                        <p class="alert alert-success"><?php echo $_SESSION['errorMessage'];  ?></p> <?php
                        unset($_SESSION['errorMessage']);
                    }
                } ?>
            </div>
        </div>
                     
                <!--     <div class="col-xs-12 nopadding dashboard-section freelancer_dashboard" style="margin-top: 10px;">
                        <div class="col-xs-12 dashboardbreadcrum freelancer_dashboard">
                            <ul class="breadcrumb freelancer_dashboard">
                                <li><a href="<?php echo $BaseUrl;?>/freelancer/dashboard/">Dashboard</a></li>
                                <li>My Bid Projects</li>
                              
                            </ul>
                        </div>
                    </div> -->
                    <div class="col-xs-12 nopadding dashboard-section" style="margin-top: 10px;">
                        
                        <div class="col-xs-12 dashboardtable">
                            <div class="table-responsive" style="height: auto;">
                                
                                <table class="table table-stripped">
                                    <thead>
                                        <tr>
                                            <th>Project Name</th>
											<th>My Bid</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        
                                <?php
                                        //$p = new _postings;

                                     $sf = new _freelancerposting;


                                      // print_r($_SESSION['pid']);

                                    //  $res = $p->myBidProject(5, $_SESSION['pid']);


                                       $res = $sf->myBidProject1212(5, $_SESSION['pid']);
										
									   
                                        //echo $sf->ta->sql;


                                        if(!empty($res)){

                                           
                                            while($row = mysqli_fetch_assoc($res)){
                                                $dt = new DateTime($row['spPostingExpDt']);
												//print "<pre>"; print_r($row); print "</pre>";
                                                ?>
                                                <tr>
												
												<!--Bid System on freelancer Post-->
        <div class="modal fade" id="bid-system<?php echo $row["idspPostings"]; ?>" >
            <div class="modal-dialog" role="document">
                <div class="modal-content no-radius sharestorepos proposal_dialogbox">
                    <div class="modal-header proposalheader_topborder">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <h3 class="modal-title" id="bidModalLabel"><b>Bid on Project (<?php echo $row["spPostingTitle"];?>)</b><span id="projecttitle" style="color:#1a936f;"></span></h3>
                    </div>
                  
                    <form  class="freelancebidform" id="freelancer_placebidform" action="update_bid.php" method="post" >


                        <div class="modal-body">
                            <!--Hidden attribute-->
							<input type="hidden" name="placebidid" value="<?php echo $row["id"]; ?>" >

                            <!--Complete-->
                            <input type="hidden" class="closingdate" value="<?php echo $bidclosingdate;?>" >
                            <div class="row">
                                <div class="col-md-6">

                                    <label for="bidPrice" class="lbl_1">Your bid $<span class="red_clr">* <span id="bid_err" style="color: red;"></span></span></label>
                                    <div class="input-group " >
										 
                                        <input type="text" class="form-control " id="bidPrice" name="bidPrice" value="<?php echo $row["bidPrice"]; ?>" data-filter="0" placeholder="Bid Price...." maxlength="8" >
                                        
                                    </div><br>
                                </div>
                                 <div class="col-md-6">
                                    <label for="totalDays" class="lbl_3">Timeline (Days)<span class="red_clr">* <span id="days_err" style="color: red;"></span></span></label>
                                    <div class="input-group" >
                                        <input type="text" class="form-control " id="totalDays" name="totalDays" value="<?php echo $row["totalDays"];?>" placeholder="Total Days...." data-filter="0" maxlength="3">
                                        
                                    </div><br>
                                </div>
                               <!--  <div class="col-md-6">
                                    <label for="initialPercentage" class="lbl_2">Upfront<span class="red_clr">*</span></label>
                                    <div class="input-group" >
                                        <input type="text" class="form-control activity" id="initialPercentage" name="initialPercentage" placeholder="Initial Percentage...." aria-describedby="basic-addon2" data-filter="0" maxlength="3">
                                        <span class="input-group-addon no-radius" id="basic-addon2">20-100%</span>
                                    </div><br>
                                </div> -->
                            <!--     <div class="col-md-12">
                                    <label for="totalDays" class="lbl_3">In how many days can you deliver a completed project?<span class="red_clr">*</span></label>
                                    <div class="input-group" >
                                        <input type="text" class="form-control activity" id="totalDays" name="totalDays" placeholder="Total Days...." aria-describedby="basic-addon2" data-filter="0" maxlength="3">
                                        <span class="input-group-addon no-radius" id="basic-addon2" class="contact">Day(s)</span>
                                    </div><br>
                                </div> -->
                                <div class="col-md-12">
                                    <div class="form-group" >

                <label for="bidPrice" class="lbl_4">Cover Letter<span class="red_clr">* <span id="cover_err" style="color: red;"></span></span></label>
                                        <textarea class="form-control activity" id="coverLetter" name="coverLetter" placeholder="Type Cover Letter..."><?php echo $row["coverLetter"]; ?></textarea>

                                    </div>
                                </div>
                            </div>
                      
                        </div>


                        <div class="modal-footer proposalheader_bottomborder">
                          <button type="button" class="btn butn_cancel projetbidclose_btn" data-dismiss="modal">Cancel</button>


                    <button type="button" id="placebid_button" class="btn btn-submit projetplacebid_btn" data-postid="<?php echo $_GET["project"]; ?>" data-profileid="<?php echo $_SESSION['pid']; ?>" data-catid="<?php echo $_GET['categoryID']; ?>">Update Bid</button>


                        </div>
                    </form>   
                </div>
            </div>
        </div>
        <!--Bid System on freelancer Post has completed-->
		
                                                    <!-- Modal -->
                                                    <div id="myproject-<?php echo $row['idspPostings'];?>" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">
                                                            <!-- Modal content-->
                                                            <form method="post" action="addmilestone.php">
                                                                <div class="modal-content no-radius">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <h4 class="modal-title"><?php echo $row['spPostingTitle'];?></h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="spPosting_idspPostings" value="<?php echo $row['idspPostings']; ?>">
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
                                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <td ><a href="<?php echo $BaseUrl.'/freelancer/project-detail.php?project='.$row['idspPostings'];?>" class="red freelancer_capitalize"  >
                                                    <?php echo $row['spPostingTitle'];?></a></td>
                                                    
													<td>&nbsp;&nbsp;$<?php echo $row['bidPrice'].$bidPrice;?></td>
                                                  <td>&nbsp;$<?php echo $row['spPostingPrice'];?></td>
                                                    <td>&nbsp;<?php if($row['status'] == 1) { echo "CLOSE"; } else { echo "OPEN"; } ?></td>
													<?php if($row['status'] != 1) { ?>
                                                    <td>
                                                        <!--<a href="<?php echo $BaseUrl.'/freelancer/project-detail.php?project='.$row['idspPostings'];?>" class="red" >View Detail</a>
                                                         -->
														 <a href="" data-toggle='modal' data-categoryid='5' data-postid='".$_GET["project"]."' data-target='#bid-system<?php echo $row["idspPostings"]; ?>' data-profileid='".$_SESSION["pid"]."'  class="btn btn-xs menu-icon vd_bg-yellow"> <i class="fa fa-pencil"></i> </a>
														 <a href="<?php echo $BaseUrl.'/freelancer/dashboard/delete_bid.php?bidid='.$row["id"]; ?>" data-original-title="Retract" data-toggle="tooltip" data-placement="top" class="btn btn-xs menu-icon vd_bg-red rejpro"> <i class="fa fa-undo"></i> </a>
													 </td>
													<?php } else { ?>
													<td>&nbsp;&nbsp; N/A </td>
													<?php } ?>
                                                </tr>
                                                 <?php
                                            }
                                        }else{

                                            echo"
                                            <td colspan='3'><center>No Record Found</center></td>";
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
<script type="text/javascript">


    $(document).ready(function(e){
$(".projetplacebid_btn").on('click', function(){

//alert(this.id);
       /* alert();*/

      var  bidprice = $('#bidPrice').val();
      var  totalDays = $('#totalDays').val();
      var  coverLetter = $('#coverLetter').val();


      //alert(bidprice);

      if(bidprice == "" && totalDays == "" && coverLetter == ""){
  
        $('#bid_err').text("Please enter Bid Price");
        $('#days_err').text("Please enter Timeline");
        $('#cover_err').text("Please enter Cover letter");
       
       /* return false;
        */

      }else if(bidprice == "" ){

          $('#bid_err').text("Please enter Bid Price");
          /* return false;*/
      

      }else if(totalDays == ""){

  
          $('#days_err').text("Please enter Timeline");
           $('#bid_err').text("");
           /*return false;*/
             

      }else if(coverLetter == ""){
   

          $('#days_err').text("");
           $('#bid_err').text("");
           $('#cover_err').text("Please enter Cover letter");
     /*   return false;*/
        


      }else{



            this.form.submit();

      }

  
    });
	
 });
 
 $(".rejpro").click(function(e){
   // alert();
   e.preventDefault();
    /*var postid = $(this).attr("data-postid");*/
     var link = $(this).attr('href');

    // alert(link);
   // alert(postid);

      swal({
            title: "Are you sure you want to Retract?",
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
