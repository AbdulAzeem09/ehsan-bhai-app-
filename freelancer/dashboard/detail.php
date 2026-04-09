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

    $postid = isset($_GET["postid"]) ? (int) $_GET["postid"] : 0;

    $_GET['categoryID'] = 5;

    $activePage = 12;
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
        
        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl ?>/assets/css/design.css">
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
                   
                   <div class="col-sm-12 nopadding dashboard-section" style="margin-top: 24px;">
                        <div class="col-xs-12 dashboardbreadcrum">
                            <ul class="breadcrumb">
                              <!-- <li><?php echo $title;?></li> -->
                              <a href="<?php echo $BaseUrl ?>/freelancer/dashboard" class="btn post-project postproject" style="float: right;background-color: orange;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;" >Go To Back</a>
                            </ul>
                        </div>
                    </div>
					
                    <div class="col-xs-12 nopadding dashboard-section" style="margin-top: 10px;">
                        <?php
                    //$p = new _postingview;
                          $sf  = new _freelancerposting;
                   // $res = $p->singletimelines($_GET['postid']);
                           $res = $sf->singletimelines1($postid);
                    //echo $p->ta->sql;

                          // echo $sf->ta->sql;

                    if($res){

                        $row = mysqli_fetch_assoc($res);
                       /* echo "<pre>";
                        print_r($row);*/
                        $title = $row['spPostingTitle'];
                        $overview = $row['spPostingNotes'];
                        $country = $row['spPostingsCountry']; //not available
                        $city = $row['spPostingsCity'];  //not available
                        $price = $row['spPostingPrice'];  
                        $dt = new DateTime($row['spPostingDate']);
                        $member = new DateTime($row['spProfileSubscriptionDate']);
                        $clientId = $row['idspProfiles']; // not availabe
                        $postedPerson = $row['spUser_idspUser']; // not available


                        //$pf = new _postfield;
                        
                        //$result_pf = $pf->read($row['idspPostings']);
                        $result_pf = $sf->read1($row['idspPostings']);


                     //  echo $sf->ta->sql."<br>";

                        if($result_pf){
                            $closingdate = "";
                            $Fixed = "";
                            $Category = "";
                            $hourly = "";
                            $skill = "";
                            $projectType = "";

                            while ($row2 = mysqli_fetch_assoc($result_pf)) {
                                if($closingdate == ''){
                                    //if($row2['spPostFieldName'] == 'spClosingDate_'){
                                        //$closingdate = $row2['spPostFieldValue']; 
                                         $closingdate = $row2['spPostingExpDt'];
                                    //}
                                }
                               /* if($Fixed == ''){
                                    if($row2['spPostFieldName'] == 'spPostingPriceFixed_'){
                                        if($row2['spPostFieldValue'] == 1){
                                            $Fixed = "Fixed Price";
                                        }
                                    }
                                }*/

                                 if($Fixed == ''){
                                            
                                                if($row2['spPostingPriceFixed'] == 1){
                                                    $Fixed = "Fixed Rate";
                                                 }else{
                                                    $hourly ="Hourly Rate";                                                 }
                                         
                                     }
                                if($Category == ''){
                                    /*if($row2['spPostFieldName'] == 'spPostingCategory_'){
                                        $Category = $row2['spPostFieldValue']; 
                                    }*/
                                    $Category = $row2['spPostingCategory']; 
                                }

                                  
                               /* if($hourly == ''){
                                    if($row2['spPostFieldName'] == 'spPostingPriceHourly_'){
                                        if($row2['spPostFieldValue'] == 1){
                                            $hourly = "Rate Per hour";
                                        }
                                    }
                                }*/
                                if($skill == ''){
                                   /* if($row2['spPostFieldName'] == 'spPostingSkill_'){
                                        $skill = explode(',', $row2['spPostFieldValue']);
                                    }*/

                                     $skill = explode(',', $row2['spPostingSkill']);
                                    
                                }


                                if($projectType == ''){
                                    if($row2['spPostFieldName'] == 'spPostingProfiletype_'){
                                        $projectid = $row2['spPostFieldValue'];
                                    }
                                }

                            }
                            
                            $postingDate = $sf->get_timeago1(strtotime($row["spPostingDate"]));
                            

                        }
                    } ?>
                        <div class="col-xs-12 freelancer-post-detail">
                            <h2 class="designation-haeding freelancer_capitalize"><?php echo $title;?></h2>
                            <p class="timing-week"><?php echo ($Fixed != '')? $Fixed: $hourly;?> - <?php echo $Category;?> - <?php echo $postingDate;?></p>
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
                                <div class="col-xs-12 col-sm-6 nopadding">
                                    <div class="col-xs-2 col-sm-1 nopadding">
                                        <img src="<?php echo $BaseUrl?>/assets/images/freelancer/timer.png">
                                    </div>
                                    <div class="col-xs-10 col-sm-11 nopadding">
                                        <p><span class="time-level">Category</span>
                                        </p>
                                        <p class="time-level-detail"><?php echo $Category;?></p>
                                        
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 nopadding">
                                    <div class="">
                                        <p>Price <?php echo $row['Default_Currency'].' '.$price;?></p>
                                    </div>
                                    
                                </div>

                            </div>
                            <div class="col-xs-12 detail-description text-justify">
                                <p style="word-break: break-word;"><?php echo $overview;?></p>
                            </div>
                        </div>
						
						
                    </div>
					
					<!-- ashish - here profileid is missing for which user to create milestone.
					<?php if($_SESSION["ptid"] == 1) { ?>
					<?php if(isset($_GET["postid"]) && $_GET["postid"] != "") { ?>
					<div class="col-xs-12 nopadding dashboard-section" style="margin-top: 24px;"> 
					
					
						<h4 style="padding-left: 10px;"> <h4>
						<div style="padding-left: 10px;">
						 <form class="form-inline" id="milestone_frm" action="create_milestone.php" method="post">
						  <input type="hidden" name="freelancer_projectid" value="<?php echo $_GET["postid"]; ?>">
						  <input type="hidden" name="freelancer_profileid"  value="">
						  <input type="hidden" name="bussiness_profile_id" value="<?php echo $_SESSION['pid']; ?>">
						  <input type="hidden" name="hired" value="0">
						  <input type="hidden" name="created" value="<?php echo date('Y-m-d h:i:s'); ?>">
						 <div class="form-group">
							<label for="amount">Amount $:</label>
							<input type="text" class="form-control" id="amount" name="amount">
							<br><span id="amt_err" style="color:red"></span>
						  </div>
						  <div class="form-group">
							<label for="description">Milestone Name:</label>
							<input type="text" class="form-control" id="description" name="description">
							<br><span id="desc_err" style="color:red"></span>
						  </div>
						  <button type="button" id="m_submit" class="btn btn-info btn-md">Create Milestone</button>
						</form> 
						</div>
					</div>
					
					<div class="col-xs-12 nopadding dashboard-section" style="margin-top: 24px;"> 
					 <h4 style="padding-left: 10px;">Milestone  </h4>
					 
					
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
                                          $resm = $sf->checkmilestoneposted($_GET['postid']);

										// echo $sf->ta->sql;

                                        if($resm){
                                            while($rowm = mysqli_fetch_assoc($resm)){


                                                //print_r($row);
                                                $f = new _spprofiles;

                                                $pro = $f->read($rowm['receiver_idspProfiles']);

                                                $pro_data = mysqli_fetch_assoc($pro);

                                               
                                                ?>
                                                <tr>
                                                    
                                                    <td><?php echo $i; ?></td>
                                                     <td ><p><?php echo date('d-m-Y',(strtotime($rowm['created']))); ?></p></td>
                                                    
                                                    <td><?php echo $rowm['description'];?></td>
                                                    <td>$<?php echo $rowm['amount']; ?></td>
                                                      
                                                    <td class="">
                                                       <?php if($rowm['request_status'] == 0){


                                                        if($rowm['bussiness_profile_id'] == $_SESSION['pid']){
                                                         
                                                         ?>
                                                         <a href="<?php echo $BaseUrl.'/freelancer/dashboard/milestone_posted_update.php?status=1&postid='.$rowm['id'];?>" class="btn btn-info" style="color:#fff;">Release</a>

                                                         <a href="<?php echo $BaseUrl.'/freelancer/dashboard/milestone_posted_update.php?status=2&postid='.$rowm['id'];?>" class="btn btn-primary rejmile" style="color:#fff;">Cancel</a>

                                              
                                                        <?php
                                                       }else{

                                                           echo "Pending";
                                                       }

                                                       }elseif ($rowm['request_status'] == 1) {
                                                           
                                                           echo "Released";
                                                           ?>
                                                        
                                                   


                                                       <?php
                                                       
                                                       }elseif ($rowm['request_status'] == 2) {
                                                           
                                                           echo "cancelled";


                                                       }
                                                      ?>
 
                                                    </section>
   
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
					<?php } } ?>
					-->
                </div>
			
			
					
            </div>
        </section>
		
<script type="text/javascript">
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
