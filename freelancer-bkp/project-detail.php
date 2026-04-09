<?php 
    include('../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="freelancer/";
    include_once ("../authentication/check.php");
    
}else{
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $f = new _spprofiles;
    $sl = new _shortlist;
	

    // ==CHEK PROFILE IS BUSINESS OR FREELANCE OR NOT
    $f = new _spprofiles;
    $re = new _redirect;
    //check profile is freelancer or not
    $chekIsFreelancer = $f->readfreelancer($_SESSION['pid']);
    if($chekIsFreelancer == false){
        $redirctUrl = $BaseUrl . "/my-profile/";
        $_SESSION['count'] = 0;
        $_SESSION['msg'] = "Please change your profile to Business Profile or Freelance Profile";
        $re->redirect($redirctUrl);
    }
    // END

    $_GET['categoryID'] = 5;
		//echo $_SESSION["uid"]; exit;
	  $get_profile_id2 = new _spprofiles;
	  $get_profile_data2 = $get_profile_id2->readProfiles2($_SESSION["uid"]);
	  $row2 = mysqli_fetch_assoc($get_profile_data2);
	  $ids2 = array();
	  if ($get_profile_data2 != false){
									while($row2 = mysqli_fetch_assoc($get_profile_data2)) {
										$ids2[] = $row2["idspProfiles"];
									//	echo "<pre>"; print_r($row2); 
									}
									//exit;
	  }
	  
	  //print_r($ids2); exit;

?>


<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/f_links.php');?>
    
        <!-- Design css  -->
    <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">

    </head>

    <script type="text/javascript">
     $(function() {
          $('#bidPrice').keypress(function(e){
                if(isNaN(this.value+""+String.fromCharCode(e.charCode))){
                   e.preventDefault(); //stop character from entering input
                }
           });

    $('#initialPercentage').keypress(function(e){
                if(isNaN(this.value+""+String.fromCharCode(e.charCode))){
                   e.preventDefault(); //stop character from entering input
                }
           });
       

     
          $('#totalDays').keypress(function(e){
                if(isNaN(this.value+""+String.fromCharCode(e.charCode))){
                   e.preventDefault(); //stop character from entering input
                }
           });

     });

     
</script>

    <body class="bg_gray">
    	<?php
        //session_start();
        
        $header_select = "freelancers";
        include_once("../header.php");
        ?>
        <section class="main_box" id="freelancers-page">
            <div class="container nopadding projectdetails">
                <div class="col-xs-12 col-sm-12 nopadding">
                <div class="col-xs-12 col-sm-2 nopadding">
                <p class="back-to-projectlist">
                    <a href="<?php echo $BaseUrl.'/freelancer/projects.php?cat=ALL';?>"><i class="fa fa-chevron-left"></i>Back to Project list</a>
                </p>
            </div>
            <div class="col-xs-12 col-sm-7 nopadding">
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
    </div>
                <div class="col-xs-12 col-sm-9 nopadding">


                    <?php

                    //print_r($_GET['project']);
                  //  $p = new _postingview;
                   

                     $sf  = new _freelancerposting;

                    $res = $sf->singletimelines1($_GET['project']);
					
					//[spProfiles_idspProfiles] => 997
					//$datas = mysqli_fetch_assoc($res);
					//echo "<pre>"; print_r($datas); exit;
                    //echo $sf->ta->sql;
					
					  
					  

                    if($res){

                            $Fixed = "";
                            $Category = "";
                            $hourly = "";

                        $row = mysqli_fetch_assoc($res);
                        
                      /*  echo "<pre>";
                        print_r($_SESSION);*/
                        $title = $row['spPostingTitle'];
                        $overview = $row['spPostingNotes'];
                        $country = $row['spPostingsCountry'];//
                        $city = $row['spPostingsCity'];//
                        $price = $row['spPostingPrice'];
                        $dt = new DateTime($row['spPostingDate']);

                        
                        $clientId = $row['spProfiles_idspProfiles'];
                        $postedPerson = $row['spUser_idspUser'];


                      // $pf = new _postfield;


                        $sf  = new _freelancerposting;
                        
                       //$result_pf = $pf->read($row['idspPostings']);


                        $result_pf = $sf->read1($row['idspPostings']);

                      // echo $pf->ta->sql;
                       // echo $sf->ta->sql;

                      // print_r($result_pf);

                    /*    if($result_pf){*/
                    	if($result_pf == false){
                            $closingdate = "";
                          
                            $skill = "";
                            $projectType = "";

                            while ($row2 = mysqli_fetch_assoc($result_pf)) {


                                //print_r($row2);

                                if($closingdate == ''){
                                    if($row2['spPostFieldName'] == 'spClosingDate_'){
                                        $closingdate = $row2['spPostFieldValue']; 
                                    }
                                }
                               /* if($Fixed == ''){
                                    if($row2['spPostFieldName'] == 'spPostingPriceFixed_'){
                                        if($row2['spPostFieldValue'] == 1){
                                            $Fixed = "Fixed Price";
                                        }
                                    }
                                }*/
                                /*if($Category == ''){
                                    if($row2['spPostFieldName'] == 'spPostingCategory_'){
                                        $Category = $row2['spPostFieldValue']; 
                                    }
                                }*/
                                /*if($hourly == ''){
                                    if($row2['spPostFieldName'] == 'spPostingPriceHourly_'){
                                        if($row2['spPostFieldValue'] == 1){
                                            $hourly = "Rate Per hour";
                                        }
                                    }
                                }*/
                                if($skill == ''){
                                    if($row2['spPostFieldName'] == 'spPostingSkill_'){
                                        $skill = explode(',', $row2['spPostFieldValue']);
                                    }
                                }
                                if($projectType == ''){
                                    if($row2['spPostFieldName'] == 'spPostingProfiletype_'){
                                        $projectid = $row2['spPostFieldValue'];
                                    }
                                }

                            }

                        }
                       
                            
                            $postingDate = $sf->get_timeago1(strtotime($row["spPostingDate"]));
                            //echo $sf->ta->sql;
                          



                        if($Category == ''){
                                    /*if($row2['spPostFieldName'] == 'spPostingCategory_'){
                                        $Category = $row2['spPostFieldValue']; 
                                    }*/

                                     $Category = $row['spPostingCategory']; 
                                }


                                if($Fixed == ''){
                                            /*if($row2['spPostFieldName'] == 'spPostingPriceFixed_'){*/
                                                if($row['spPostingPriceFixed'] == 1){
                                                    $Fixed = "Fixed Rate";
                                                 }else{
                                                    $hourly ="Hourly Rate";                                                 }
                                         
                                     }



                    } 
                    ?>
                    <div class="col-xs-12 freelancer-post-detail about_postbanner">
					
					<div class= "row">
					<div class="col-md-6">
					
                        <h2 class="designation-heading"><?php echo $title;?></h2>
						</div>
						
						<!--<div class="col-md-6">
						<h2><p class="activities-on-job pull-right"><?php echo ($Fixed != '')? $Fixed: $hourly;?> Price: $<?php echo $price;?></p></h2>
						</div>-->
						</div>
                        <p class="timing-week">
                      <!--  <?php echo ($Fixed != '')? $Fixed: $hourly;?> - <?php echo $Category;?> - <?php echo $postingDate;?></p> -->
                       <?php echo ($Fixed != '')? $Fixed: $hourly;?> </p>
                        <div class="col-xs-12 nopadding">
                            <?php
                            if (isset($skill)) {
                                
                                if(count($skill) >0){
                                    foreach($skill as $key => $value){
                                        if($value != ''){
                                            echo "<span class='skills-tags freelancer_uppercase skillborder skillfont'>".$value."</span>";
                                        }
                                       
                                    }
                                }
                            }
                            ?>
                            
                        </div>
                        <div class="col-xs-12 nopadding margin-top-13">
                            <div class="col-xs-12 col-sm-6 nopadding">
                               <!--  <div class="col-xs-2 col-sm-1 nopadding">
                                    <img src="<?php echo $BaseUrl?>/assets/images/freelancer/timer.png">
                                </div> -->
                                <div class="col-xs-10 col-sm-11 nopadding">
                                    <p><span class="time-level"><strong>Category</strong>: <?php echo $Category;?></span></p>
                                    
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 nopadding">
                                <div class="col-xs-2 col-sm-1 nopadding">
                                   
                                </div>
                                <div class="col-xs-10 col-sm-11 nopadding">
                                    <p><span class="time-level"><!-- <strong>Price</strong>: --> <?php //echo $price.'a';?></span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 detail-description text-center">
                            <p class="freelancer_capitalize" style="word-break: break-all;"><?php echo $overview;?></p>
                            <a href="javascript:void(0);" class="btn activity-on-this-job">Activity on this Job</a>
                        </div>
                        <div class="col-xs-12 col-sm-4 padding-5">
                            <?php 
                            //$po = new _postfield;

                             $sf  = new _freelancerposting;
                        $sfbid = new  _freelance_placebid;

                                          // $respos = $pos->totalbids($_GET['project']);

                                          //$respos = $sfbid->totalbids1($_GET['project']);
                           // $bids = $po->totalbids($_GET['project']);

                             $bids = $sfbid->totalbids1($_GET['project']);
                            //echo $sf->ta->sql;
                            if($bids){
                                $totalbids = $bids->num_rows;
                            }else{
                                $totalbids = 0;
                            }
                            ?>
                            <p class="activities-on-job">Proposals: <?php echo $totalbids;?></p>
                        </div>
                        <div class="col-xs-12 col-sm-4 padding-5">
                            <?php 
                            $result2 = $sl->getshortlist($_GET['project']);
                           // echo $sl->ta->sql;
                            
                            if($result2){
                                $interview = $result2->num_rows;
                            }else{
                                $interview = 0;
                            }
                            ?>


                            <!-- <p class="activities-on-job">Interviewing: <?php echo $interview; ?></p> -->
                        </div>
                        <div class="col-xs-12 col-sm-4 padding-5">
                            <!--<p class="activities-on-job"><?php echo ($Fixed != '')? $Fixed: $hourly;?> Price: $<?php echo $price;?></p>-->
                        </div>
                        
                    </div>


                    <!--
                    <div class="col-xs-12 other-open-job">
                        <h2 class="other-open-job-h2">Other open jobs by this client (2)</h2>
                        <p><span>Data Entry Needed -</span> Hourly</p>
                        <p><span>Looking for amazing Graphic Designer -</span> Hourly</p>
                    </div>
                    --> 


                    <?php
                   // $post = new _postings;

                     $sf  = new _freelancerposting;

                   // $result = $post->chkProjectStatus($_GET['project']);

                    $result = $sf->chkProjectStatus1($_GET['project']);

                   //echo $post->ta->sql;

                  //  echo $sf->ta->sql;


                   // print_r($result1);

                   // if($result == false){


                    if($result == true){
                        ?>
                        
                        <div class="col-md-12 similar-job about_postbanner">
                            <h2 class="similar-job-h2">Bids</h2>
                            <div class="col-xs-12 dashboardtable no-padding">
                                <!-- <div class="table-responsive"> -->
                                    <div class="table-responsive">
                                    <table class="table table-stripped">
                                        <thead>
                                            <tr style="font-size: 17px;">
                                                <th>Freelancer Name</th>
                                                <th>Bid</th>
                                                <th>Days Delivered</th>
                                            </tr>
                                        </thead>
                                        <tbody>



                                        <?php
                                          //$pos = new _postfield;

                                        //  $sf  = new _freelance_placebid;

                                       $sf = new  _freelance_placebid;

                                          // $respos = $pos->totalbids($_GET['project']);

                                          $respos = $sf->readallbids($_GET['project']);


                                           //echo $sf->ta->sql;

                                           //echo $sf->ta->sql;


                                            //exit();
                                          
                                          // print_r($respos);

                                            if($respos == true){

                                                while ($row3 = mysqli_fetch_assoc($respos)) {

                                                    //print_r($row3);
                                                    //get bid detail
                                                    
                                                    $d = new _spprofiles;
                                                    $freelancerName = $d->getProfileName($row3['spProfiles_idspProfiles']);

                                                     //echo $d->ta->sql;
                                                    
                                                /*$result_pf = $pos->allbids($row3['spProfiles_idspProfiles'], $_GET['project']);*/
                                                   
                                               /*  $bd = new  _freelance_placebid;

                                                  // print_r( $row3['idspPostings']);

                                         $result_pf = $bd->readallbids($_GET['project']);
*/

                                                  //echo "here";

                                                 // echo $bd->ta->sql;


                                                  //  if($result_pf){
                                                        $bidPrice = "";
                                                        $totalDays = "";

                                                        //$row2 = mysqli_fetch_assoc($result_pf);
                                                     /*   
                                                        echo  "<pre>";
                                                        print_r($row2);*/
                                                        
                                                       /* while($row2 = mysqli_fetch_assoc($result_pf)){*/

                                                            
                                                            if($bidPrice == ""){
                                                                /*if($row2['spPostFieldName'] == 'bidPrice'){*/
                                                                $bidPrice = $row3['bidPrice'];
                                                                /*}*/
                                                            }
                                                            if($totalDays == ""){
                                                                /*if($row2['spPostFieldName'] == 'totalDays'){*/
                                                             $totalDays = $row3['totalDays'];
                                                               /* }*/
                                                            }

                                                        //} 
                                                           /*  print_r($bidPrice);
                                                             print_r($totalDays);*/

                                                             
                                                        ?>
                                                        <tr>
                                                            <td ><a class="red freelancer_capitalize"  
                                                                href="<?php echo $BaseUrl.'/freelancer/user-profile.php?profile='.$row3['spProfiles_idspProfiles'];?> "><?php echo $freelancerName;?></td>
                                                            <td>$<?php echo $bidPrice;?></td>
                                                            <td><?php echo $totalDays;?> Days</td>
                                                        </tr> <?php
                                                   // }
                                                }
                                            }else{ ?> 
                                              <td colspan="3" style="text-align: center;">No Bid Found</td>
 
                                            <?php } 

                                            ?>
                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <?php
                    } ?>


             <!--        <div class="col-xs-12 similar-job about_postbanner">
                        <?php
                        //$p = new _postingview;

                        $sf  = new _freelancerposting;

                        //print_r($clientId);

                     // $res = $p->client_publicpost(5, $clientId);

                        $res = $sf->client_publicpost1(5, $clientId);

                        //echo $sf->ta->sql;

                        if($res){
                            $total = $res->num_rows; ?>
                            <h2 class="similar-job-h2">Other open jobs by this client(<?php echo $total;?> )</h2>
                            <?php
                            while($rows = mysqli_fetch_assoc($res)){ ?>
             <span><a href="<?php echo $BaseUrl.'/freelancer/project-detail.php?project='.$rows['idspPostings'];?>" 
                class="freelancer_capitalize">

                <?php echo $rows['spPostingTitle'];?></a></span>
                                <p class="freelancer_capitalize">
                                    <?php
                                    if(strlen($rows['spPostingNotes']) < 200){
                                        echo $rows['spPostingNotes'].'....';
                                    }else{
                                        echo substr($row['spPostingNotes'], 0,200).'....';
                                        
                                    } ?>
                                </p> <?php
                            }
                        }
                        else{ ?>
                        <h2 class="similar-job-h2">Other open jobs by this client(<?php echo $total;?>)</h2>
                        <?php 
                            echo "<center>No Record Found</center>";
                        }?>

                    </div> -->
                </div>

                <div class="col-xs-12 col-sm-3">
                    <div class="col-xs-12 nopadding ">
     <!-- <a href="<?php echo $BaseUrl.'/post-ad/freelancer/?postid='.$_GET['project'];?>" class="post-job-like-this btn" style="border-radius: 35px;">Post a Job Like this</a>
                         -->
                         <!-- Modal -->
                            <div id="flagPost" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <form method="post" action="addtoflag.php" id="flagform" class="sharestorepos" >
                                        <div class="modal-content proposal_dialogbox">
                                            <input type="hidden" name="spPosting_idspPosting" value="<?php echo $_GET['project'];?>">
                                            <input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
                                            <input type="hidden" name="spCategory_idspCategory" value="<?php echo $_GET['categoryID']; ?>">
                                            <div class="modal-header proposalheader_topborder">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Flag Post</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="radio">
                                                    <label><input type="radio" name="why_flag" value="Duplicate post" checked="">Duplicate post</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="why_flag" value="Posting Violation">Posting Violation</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="why_flag" value="Suspicious Post">Suspicious Post</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="why_flag" value="Copied My Post">Copied My Post</label>
                                                </div> 

                                                <!-- <label>Why flag this post?</label> -->
                                                <textarea class="form-control" name="flag_desc" id="flagcomment" placeholder="Add Comments"></textarea>
                                                <span id="flag_desc_err" style="color:red;"></span>
                                            </div>
                                            <div class="modal-footer proposalheader_bottomborder">
                                                <input type="button" name="Submit" value="Submit" id="flag_project" class="btn butn_mdl_submit projetproperty_btn">
                                                <button type="button" class="btn butn_cancel projetbidclose_btn" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        <?php

                      //print_r($clientId);
                      //print_r($_SESSION['pid']);


                        


                        if($clientId != $_SESSION['pid']){

                          //  $field = new _postfield;

                            //$sf  = new _freelancerposting;

                            //print_r($_SESSION['pid']);
                            //print_r($_GET['project']);



                            //$chkBidPost = $field->allbids($_SESSION['pid'], $_GET['project']);

                            $bd  = new _freelance_placebid;

                            

                            $chkBidPost = $bd->allbids1($_SESSION['pid'], $_GET['project']);
                           
                            //echo $bd->ta->sql;


                            if($chkBidPost){ ?>
                                <a href="javascript:void(0);" class="post-job-like-this btn" style="border-radius: 35px;" >Bid Posted Already</a>
                               

                                <?php
                            }else if (isset($_SESSION['ptid']) && $_SESSION['ptid'] == 2) {
								
								//echo "<pre>"; echo $clientId; print_r($ids2); exit;
                                    ?>
									<?php if(in_array($clientId, $ids2)) {?>
									<a href="javascript:void(0);" class="post-job-like-this btn searchbutton" style="border-radius: 35px;">Own Project</a>
									<?php } else { ?>
                                    <a href="javascript:void(0);" class="post-job-like-this btn searchbutton" style="border-radius: 35px;" data-toggle='modal' data-categoryid='5' data-postid='".$_GET["project"]."' data-target='#bid-system' data-profileid='".$_SESSION["pid"]."' >Submit a proposal</a>
                                    <?php } ?>
									<?php
                                }else{?>
									<?php if(in_array($clientId, $ids2)) {?>
									<a href="javascript:void(0);" class="post-job-like-this btn searchbutton" style="border-radius: 35px;">Own Project</a>
									<?php } else { ?>
                                    <a href="javascript:void(0);" class="post-job-like-this btn" style="border-radius: 35px;" data-toggle='modal' data-categoryid='5'  data-target='#bidbusiness-system'>Submit a proposal</a>
									<?php } ?>
								<?php }

                                
                               
                            }

                        ?>
                        
                        <div class="col-xs-12 about-client about_postbanner ">
                            <p class="about-client- freelancer_capitalize">About the Client</p>
                            <div class="col-xs-12 about-client-content">
                                <div class="imgFeeBox">
                                    <?php
                                    if ($clientId > 0) {
                                        $result3 = $f->read($clientId);
                                        if ($result3) {
                                            $row3 = mysqli_fetch_assoc($result3);
                                           // print_r($row3);
                                            if (isset($row3["spProfilePic"])){
                                                echo "<img alt='profilepic' class='img-responsive' src=' " . ($row3["spProfilePic"]) . "' style='width: 40px; height: 40px;' >";
                                            }else{
                                                echo "<img alt='profilepic' class='img-responsive' src='".$BaseUrl."/assets/images/icon/blank-img.png' style='width: 40px; height: 40px;' >";
                                            }
                                            ?>
                                            <a href="<?php echo $BaseUrl.'/freelancer/user-profile.php?profile='.$clientId; ?>" style = "color: #282828;"><?php echo $row3['spProfileName'];?></a>
                                            <!-- <a href="#" class="freelancername"><?php echo $row3['spProfileName'];?></a> -->
                                            <!-- <p><?php echo $row3['spProfileName'];?></p> -->
                                            <?php
                                        }
                                    }
                                    ?>
                                    
                                    
                                </div>
                                <?php
                                       
                                       $us = new _spuser;
                                       $user = $us->read($_SESSION['uid']);
                                       $user_detail = mysqli_fetch_assoc($user);
                                // print_r($user_detail['spUserRegDate']);
                                 $member = new DateTime($user_detail['spUserRegDate']);//

                                $total_project = $sf->myAllProject1(5,$clientId);
                                /* $total = mysqli_fetch_assoc($total_project);*/

                                // print_r($total_project);

                                 if($total_project){

                                    $totalpost = $total_project->num_rows;


                                 }else{

                                     $totalpost = 0;

                                 }

                                

                                 ?>
                                <!-- <p class="country"><?php echo $country;?></p> -->
                                <p><?php echo $totalpost;?> Job Posted</p>
                                <!-- <p class="hire-rate">0% Hire Rate, <?php echo $total;?> Open Jobs</p> -->
                                <p>Member Since <?php echo $member->format('d-m-Y');?> </p>
                            </div>
							
                        </div>
                        <?php if($clientId != $_SESSION['pid']){ ?>
                        <div class="col-md-12 text-center">
						
						<?php
						
						$profid=$_SESSION['pid'];
                 //print_r($_SESSION);
                        $uid=$_SESSION['uid'];

                        $projid=$_GET['project'];
																		

	 					$f = new _flagpost;
					
                       $id = $f->read_fav($profid,$uid,$projid);
					   	//die('444');
					  //print_r($id);
						//$data=mysqli_fetch_assoc($id);
						//$res=mysqli_num_rows($data);
						if($id->num_rows>0){?>
						
				<a onclick="return confirm('Are you sure you want to delete from favorite?');" href="delfav.php?postid=<?php echo $_GET['project']; ?>" class="icon-favorites fa fa-heart"></a>
				<?php	header("location: project-detail.php");  ?>
				<?php
				}
						else{?>
					<a onclick="return confirm('Are you sure you want to add to favorite?');" href="addfav.php?postid=<?php echo $_GET['project']; ?>" class="icon-favorites fa fa-heart-o sp-favorites faa-pulse animated"></a>
					<?php	header("location:project-detail.php");  ?>
						<?php } ?>
					 <a href="javascript:void(0)" data-toggle="modal" data-target="#flagPost" class="btnFlag_Frelance pull-right" class="pull-right"><i class="fa fa-flag"></i> Flag This Post</a>    
                        
						
						</div>
						
						

                    <?php } ?>
                       
                        <!--<a href="javascript:void(0)" data-toggle="modal" data-target="#flagPost" class="pull-right"><i class="fa fa-flag"></i> Flag This Post</a>-->
                        

                        
                    </div>
                </div>
            </div>
        </section>

<!-- 
                    <div id="Notabussiness" class="modal fade" role="dialog">
                        <div class="modal-dialog"> -->

                         
                <!--         <div class="modal-content no-radius sharestorepos bradius-10">
                                <div class="modal-header br_radius_top bg-white">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                
                                </div>
                                <div class="modal-body nobusinessProfile">
                                    <h1><i class="fa fa-info" aria-hidden="true"></i></h1>
                                    <h2>Please switch to your bussiness profile to <span>post project.</span></h2>
                                    <a href="<?php echo $BaseUrl.'/my-profile';?>" class="btn" style = "background: #eb6c0b!important;">Switch/Create Profile</a>
                                </div>
                                <div class="modal-footer br_radius_bottom bg-white">
                                    <button type="button" style="background: #eb6c0b!important;" class="btn btn-primary db_btn db_primarybtn" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>
 -->


        <!--Bid System on business profile -->
        <div class="modal fade" id="bidbusiness-system" tabindex="-1" role="dialog" aria-labelledby="bidModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content no-radius sharestorepos proposal_dialogbox">
                    <div class="modal-header proposalheader_topborder">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
					  
						
                      <h3 class="modal-title" id="bidModalLabel"><b>Bid on Project (<?php echo $title;?>)</b><span id="projecttitle" style="color:#1a936f;"></span>
					 <!-- <div class="col-md-6">-->
						
						
					  </h3>
                    </div>
                  
                   

                    
                        <div class="modal-body nobusinessProfile">
                            <div style="text-align: center;">
                                <h1><i class="fa fa-info" aria-hidden="true"></i></h1>
                                <h2>Please switch to your freelancer profile to <span>Submit A Proposal.</span></h2>
                                <a href="<?php echo $BaseUrl.'/my-profile';?>" class="btn" style = "background: #eb6c0b!important;">Switch/Create Profile</a>
                            </div>
                        </div>
                      

                        <div class="modal-footer proposalheader_bottomborder">
                          <button type="button" class="btn butn_cancel projetbidclose_btn" data-dismiss="modal">Close</button>


                  <!--   <button type="submit" id="placebid_button" class="placebid btn btn-submit projetplacebid_btn">ok</button> -->


                        </div>
                    </form>   
                </div>
            </div>
        </div>
        <!--Bid System on freelancer Post has completed-->


        <!--Bid System on freelancer Post-->
        <div class="modal fade" id="bid-system" >
            <div class="modal-dialog" role="document">
                <div class="modal-content no-radius sharestorepos proposal_dialogbox">
                    <div class="modal-header proposalheader_topborder">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <h3 class="modal-title" id="bidModalLabel"><b>Bid on Project (<?php echo $title;?>)</b><span id="projecttitle" style="color:#1a936f;"></span>
					  <p class="activities-on-job pull-right" style="margin-right: 10px"><?php echo ($Fixed != '')? $Fixed: $hourly;?> Price: $<?php echo $price;?></p>
					  </h3>
                    </div>
                  
                    <form  class="freelancebidform" id="freelancer_placebidform" action="addtoplacebid.php" method="post" >


                        <div class="modal-body">
                            <!--Hidden attribute-->

                            <!-- <?php echo $_GET["project"];?>

                            <?php echo $_SESSION['pid'];?>

                            <?php  echo $_SESSION['uid'];?>  -->



                            <input type="hidden" id="bidpost" name="spPostings_idspPostings" value="<?php echo $_GET["project"];?>">
                             
                            <input type="hidden" id="spPostFieldBidFlag" value="1">
                             
                            <input type="hidden" class="freelancercat" value="5">
                            
                            <input class="dynamic-pid" name="spProfiles_idspProfiles" type="hidden" value="<?php echo $_SESSION['pid']?>"> 

                             <input class="dynamic-pid" name="idspUserProfiles" type="hidden" value="<?php echo $_SESSION['uid']?>"> 

                            <!--Complete-->

                            <?php

                                $sf  = new _freelancerposting;

                                //$p = new _postfield;

                                $res = $sf->readFields1($_GET["project"]);
                               // echo $sf->ta->sql;

                                //print_r($res);

                                if ($res != false)
                                {
                                    while($rows = mysqli_fetch_assoc($res))
                                    {
                                        //if($rows["spPostFieldLabel"] == "Closing Date")
                                            $bidclosingdate = $rows["spPostingExpDt"];
                                          //  print_r( $bidclosingdate);
                                    }
                                }   
                            ?>

                            <input type="hidden" class="closingdate" value="<?php echo $bidclosingdate;?>" >
                            <div class="row">
                                <div class="col-md-6">

                                    <label for="bidPrice" class="lbl_1">Your bid<span class="red_clr">* <span id="bid_err" style="color: red;"></span></span></label>
                                    <div class="input-group " >
                                        <input type="text" class="form-control activity" id="bidPrice" name="bidPrice" data-filter="0" placeholder="Bid Price...." maxlength="8" aria-describedby="basic-addon1">
                                        <span class="input-group-addon no-radius" id="basic-addon1">$</span>
                                    </div><br>
                                </div>
                                 <div class="col-md-6">
                                    <label for="totalDays" class="lbl_3">Timeline<span class="red_clr">* <span id="days_err" style="color: red;"></span></span></label>
                                    <div class="input-group" >
                                        <input type="text" class="form-control activity" id="totalDays" name="totalDays" placeholder="Total Days...." aria-describedby="basic-addon2" data-filter="0" maxlength="3">
                                        <span class="input-group-addon no-radius" id="basic-addon2" class="contact">Day(s)</span>
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

                <label for="bidPrice" class="lbl_4">SUBMIT PROPOSAL<span class="red_clr">* <span id="cover_err" style="color: red;"></span></span></label>
                                        <textarea class="form-control activity" id="coverLetter" name="coverLetter" placeholder="Write an attracive proposal to win the bid"></textarea>

                                    </div>
                                </div>
                            </div>
                      
                        </div>


                        <div class="modal-footer proposalheader_bottomborder">
                          <button type="button" class="btn butn_cancel projetbidclose_btn" data-dismiss="modal">Cancel</button>


                    <button type="button" id="placebid_button" class="btn btn-submit projetplacebid_btn" data-postid="<?php echo $_GET["project"]; ?>" data-profileid="<?php echo $_SESSION['pid']; ?>" data-catid="<?php echo $_GET['categoryID']; ?>">Place Bid</button>


                        </div>
                    </form>   
                </div>
            </div>
        </div>
        <!--Bid System on freelancer Post has completed-->


    	<?php 
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>
    </body>
</html>


<script type="text/javascript">


    $(document).ready(function(e){
    // Submit form data via Ajax
   /* $("#freelancer_placebidform").on('submit', function(e){*/
     $("#placebid_button").on('click', function(){


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



            $("#freelancer_placebidform").submit();

      }

  
    });



     $("#flag_project").on('click', function(){


       /* alert();*/

      var  flagcomment = $('#flagcomment').val();
    

      //alert(bidprice);

      if(flagcomment == "" ){
  
        $('#flag_desc_err').text("Please Enter Comment");
       
       
       /* return false;
        */

      }else{

            $("#flagform").submit();
      }

  
    });










});


/*$(document).ready(function(e){
    // Submit form data via Ajax
    $("#freelancer_placebidform").on('submit', function(e){

      var  bidprice = $('#bidPrice').val();
      var  totalDays = $('#totalDays').val();
      var  coverLetter = $('#coverLetter').val();



        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'addtoplacebid.php',
            data: new FormData(this),
                processData: false,
              contentType: false,
            
                  
          beforeSend: function(){

                $('#placebid_button').attr("disabled","disabled");
                $('#freelancer_placebid').css("opacity",".5");
            },

            success: function(response){ 
                   
                   window.location.reload();
                         //console.log(data);



  
            }
        });


    });
});*/

</script>

<!-- <script>
    $("#freelancer_placebid").on("click", function () {
        alert();

        

                var bid= $('#bidPrice').val();
                alert(bid);
                var percentage = $('#initialPercentage').val();
                alert(percentage);
                
                var days = $('#totalDays').val();
                alert(days);
                var letter = $('#coverLetter').val();
                alert(letter);
                

                //alert(description.length);


 if (bid == "" && percentage == "" && days == "" && letter == "") {

                $(".lbl_1").addClass("label_error");
                $(".lbl_2").addClass("label_error");
                 $(".lbl_3").addClass("label_error");
                  $(".lbl_4").addClass("label_error");

                return false;
            }
           else if(bid == ""){
                    $(".lbl_1").addClass("label_error");
                    return false;
                }
                  else if(percentage == ""){
                       $(".lbl_2").addClass("label_error");
                       return false;
                            }else if(days == ""){
                                    $(".lbl_3").addClass("label_error");
                                    return false;
                                }else if(letter == ""){
                                    $(".lbl_4").addClass("label_error");
                                    return false;
                                }
            else{
                swal({                     
                                
             title: "<img src='../../assets/images/logo/tsp_trans.png' alt='The SharePage' style='width: 70px;height: 70px;'>",
             text:  "<b>Posted Successfully. </b>",
             html: true,


             showConfirmButton: true

            },

            function() {
                $("#freelancer_bidform").submit();
                alert();

                window.location = "<?php echo $BaseUrl;?>/freelancer/project-detail.php";
            }

        }
    });
            
</script> -->

<?php
} ?>