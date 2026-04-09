<style>

.left_freelance_top_edit {
    background-color: #fff;
    /* padding-left: 15px; */
    padding-bottom: 15px;
    border-radius: 15px;
    margin-top: 24px;
    /* padding-right: 15px!important; */
}
</style>
 <div class="left_freelance_top_edit">

       <!--  <p>&nbsp;</p> -->     

<?php if($_SESSION["ptname"] == "Freelancer"){ ?> 
 
        <div class="left_freelance_menu">
           
               <!-- <li class="activeInsub">
             <a href="#">
                        <span>Freelancer</span> <i class=" pull-right"></i>
                    </a></li> -->
                
           <li class="Back_to_freelancer"><button style="background-color: #f78d47;border-color: #f78d47; ;" class="btn btn-primary"><a href="<?php echo $BaseUrl.'/freelancer'; ?> " style="color: white!important;font-family:times">

            <i class="fa fa-arrow-left btn-border-radius"></i> Back To Freelance Home </a></li></button>
			
        </div>

         <?php }?>

<?php 
//print_r($_SESSION);
//die('==');
if($_SESSION["ptname"] == "Business"){//die('=='); ?> 

    <div class="left_freelance_menu">
            <ul class="sidebar-menu"> 
                <li class="activeInsub">
             <!--<a href="#">
                        <span>My Posted Project</span> <i class=" pull-right"></i>
                    </a> -->
                    </ul>
           <li class="Back_to_freelancer"><button style="background-color: #f78d47;border-color: #f78d47;margin-left:10px" class="btn btn-primary btn-border-radius"><a href="<?php echo $BaseUrl.'/freelancer'; ?> " style="color: white;font-family:times">

            <i class="fa fa-arrow-left"></i>  Back To Freelance Home </a></li></button>
     </div>
         <?php }?> 

   <?php
        $p = new _spprofiles;
        if($_SESSION['ptid'] == 1 OR $_SESSION['ptid'] == 2){ ?>
		
		
		<style>
		
		.no-margin {
    margin: 0 !important;
    padding-top: 8px !important;
		}
		.freelancer_capitalize{
			 
    padding-left: 5px;
}
		
		.btn .caret {
    margin-left: 5px;
		}
		
		</style>
		
		
    <div class="row no-margin">
                <div class="col-md-4 no-padding">
                    <?php
                    $result = $p->read($_SESSION['pid']);
                    if ($result != false) {
                        $row = mysqli_fetch_assoc($result);
                        if (isset($row["spProfilePic"])){
                            echo "<img alt='profilepic' style='width: 50px; height: 50px;' class='img-circle img-responsive propic center-block' src=' " . ($row["spProfilePic"]) . "'  >";
                        }else{
                            echo "<img alt='profilepic' class='img-circle img-responsive img-circle propic center-block' src='".$BaseUrl."/assets/images/icon/blank-img.png' style='width: 50px; height: 50px;' >";
                        }
                    }

                   // print_r($_SESSION);
                    ?>
                </div>
                <div class="col-md-8">
                    <div class="dropdown" style="margin-left: -16px;">
                        <button style="background-color:#808080;width:85%!important;" class="btn btn-primary dropdown-toggle freelancer_capitalize" type="button" data-toggle="dropdown"><?php

                        $s = $_SESSION['MyProfileName'];
$arr1 = explode(' ',trim($s));
/*echo $arr1[0]."\n";*/

                         echo $arr1[0]; ?>
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu sp-profile-det">
                            <?php
                                
                                $rpvt = $p->readProfiles($_SESSION["uid"]);
                                //echo $p->ta->sql;
                                if ($rpvt != false){
                                    while($row = mysqli_fetch_assoc($rpvt)) {
                                        if($row['spProfileType_idspProfileType'] == 1 || $row['spProfileType_idspProfileType'] == 2){
                                            ?>
                                            <li>
                <a id='makefreelancer_defaultprofile' class='freelancer_capitalize' data-profileid='<?php echo $row['idspProfiles'];?>' data-profiletype='<?php echo $row['spProfileTypeName']; ?>' >

                    <?php if (isset($row["spProfilePic"]) && !empty($row["spProfilePic"]))
                     {
                    // echo "<img alt='Posting Pic' class='img-circle img-responsive' src=' ".($row["spProfilePic"])."'>"; 
                        }else{
                        // echo "<img alt='Posting Pic' class='img-circle img-responsive' src='../../assets/images/blank-img/default-profile.png' >";
                     }
                     ?>

                    <?php echo $row['spProfileName'];?> 
                    <br><span><?php echo $row['spProfileTypeName']. " Profile";?></span>


                 </a>

                
                                            </li>
                                            <?php
                                        }
                                    }
                                }
                            ?>
                            
                        </ul>
                    </div>
                </div>
                  <?php       
                          $rpvt = $p->readprofile_type($_SESSION["pid"]);

                          //print_r($rpvt)
                                if ($rpvt != false){
                                    while($row = mysqli_fetch_assoc($rpvt)) {

    if($row['spProfileType_idspProfileType'] == 2){?>

    <br><span class="freelancer_profile">(<?php echo $row['spProfileTypeName']." Profile";?>)</span>

             <?php } ?>
              <?php  if($row['spProfileType_idspProfileType'] == 1){?>

    <br><span class="freelancer_profile">(<?php echo $row['spProfileTypeName']." Profile";?>)</span>                                
                                        <?php }
                                    }
                                }
                            ?> 

            </div>
             
            <?php            
        }else{ 
            $re = new _redirect;
            $result2 = $p->readBusFreeProfiles($_SESSION['uid']);
            if($result2){
                $row2 = mysqli_fetch_assoc($result2);
                $LeftProName = $row2['spProfileName'];
                $LeftProId = $row2['idspProfiles'];

            }else{

                $redirctUrl = $BaseUrl . "/freelancer/";
                $_SESSION['count'] = 0;
                $_SESSION['msg'] = "Please change your profile to Business Profile or Freelance Profile";
                $re->redirect($redirctUrl);
                
            }
            ?>
            <div class="row no-margin">
                <div class="col-md-4 no-padding">
                    <?php
                    $result3 = $p->read($LeftProId);
                    if ($result3 != false) {
                        $row3 = mysqli_fetch_assoc($result3);
                        if (isset($row3["spProfilePic"])){
                            echo "<img alt='profilepic' class='img-circle img-responsive propic center-block' src=' " . ($row3["spProfilePic"]) . "'  >";
                        }else{
                            echo "<img alt='profilepic' class='img-circle img-responsive propic center-block' src='".$BaseUrl."/assets/images/icon/blank-img.png' style='width: 40px; height: 40px;' >";
                        }
                    } ?>
                </div>
                <div class="col-md-8">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $LeftProName; ?>
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu sp-profile-det">
                            <?php
                               
                                $rpvt = $p->readProfiles($_SESSION["uid"]);
                                //echo $p->ta->sql;
                                if ($rpvt != false){
                                    while($row = mysqli_fetch_assoc($rpvt)) {
                                        if($row['spProfileType_idspProfileType'] == 1 || $row['spProfileType_idspProfileType'] == 2){
                                            ?>
                                            <li>
                                                <a id='makefreelancer_defaultprofile' data-profileid='<?php echo $row['idspProfiles'];?>' data-profiletype='<?php echo $row['spProfileTypeName']; ?>' >
                                                    <img src="<?php echo ($row["spProfilePic"]);?>" class="img-circle img-responsive"> <?php echo $row['spProfileName'];?> <br><span><?php echo $row['spProfileTypeName']. " Profile";?></span>
                                                </a>
                                            </li>
                                            <?php
                                        }
                                    }
                                }
                            ?>
                            
                        </ul>
                    </div>
                </div>
            </div>
            <?php
            
        }
        ?>

        <div class="left_freelance_menu">
            <!-- <h1 class="skill-category">Dashboard Menu</h1> -->
<ul class="sidebar-menu" style="padding-top: 20px;">

          <!-- seller dashboard by default -->

     <?php if($_SESSION["ptname"] == "Freelancer"){ ?> 


                <li class="treeview <?php echo ($activePage == 1 || $activePage == 2 || $activePage == 3 || $activePage == 4 || $activePage == 5 || $activePage == 6 || $activePage == 7 || $activePage == 21 || $activePage == 18 || $activePage == 19 || $activePage == 33)?'active activeMain' : '';?>">

                    <ul class="treeview-menu no-padding subMenu">

        
        <li class="<?php echo ($activePage == 1)?'activeInsub' : '';?>"><a href="<?php echo $BaseUrl.'/freelancer/dashboard/';?>">Dashboard </a></li>

                        <li class="<?php echo ($activePage == 2)?'activeInsub' : '';?>"><a href="<?php echo $BaseUrl.'/freelancer/projects.php?cat=ALL';?>" >Browse all projects</a></li>
                        <li class="<?php echo ($activePage == 3)?'activeInsub' : '';?>"><a href="<?php echo $BaseUrl.'/freelancer/dashboard/mybid-project.php';?>" >Submitted Proposals</a></li>
                       <!--  <li class="<?php echo ($activePage == 4)?'activeInsub' : '';?>"><a href="<?php echo $BaseUrl.'/freelancer/dashboard/active-project.php';?>" >Active Projects</a></li> -->
                        <li class="<?php echo ($activePage == 4 || $activePage == 18)?'activeInsub' : '';?>"><a href="<?php echo $BaseUrl.'/freelancer/dashboard/active-project.php';?>" > Project Awarded</a></li>
						
						<li class="<?php echo ($activePage == 19)?'activeInsub' : '';?>"><a href="<?php echo $BaseUrl.'/freelancer/dashboard/favourite_projects.php';?>" > Favourite Projects</a></li>
						
                        <!-- <li class="<?php echo ($activePage == 5)?'activeInsub' : '';?>"><a href="<?php echo $BaseUrl.'/freelancer/dashboard/favourite.php';?>" >Saved Projects</a></li> -->
                         <li class="<?php echo ($activePage == 21 )?'activeInsub' : '';?>"><a href="<?php echo $BaseUrl.'/freelancer/dashboard/freelancer_requested_project.php'; ?>" >Direct Hired</a></li>
                          <li class="<?php echo ($activePage == 33 )?'activeInsub' : '';?>"><a href="<?php echo $BaseUrl.'/freelancer/dashboard/milestone_payment_list.php'; ?>" >Received Milestone</a></li>
                       <!--  <li class="<?php echo ($activePage == 7)?'activeInsub' : '';?>"><a href="<?php echo $BaseUrl.'/freelancer/dashboard/likes.php';?>" >Likes Projects</a></li> -->
                        <li class="<?php echo ($activePage == 6)?'activeInsub' : '';?>"><a href="<?php echo $BaseUrl.'/freelancer/dashboard/successfull-work.php';?>" >Completed Projects</a></li>
						
						
                        
                    </ul>
                </li>
  

          <?php }?>

           <?php 
		// print_r($_SESSION);die("---------");
		   
		   if($_SESSION["ptid"] == "1"){ 
		   
		  //   echo $_SESSION["ptname"];die("====5555======");
		   ?> 

                <li class="treeview <?php echo ($activePage == 11 || $activePage == 12 || $activePage == 13 || $activePage == 14 || $activePage == 15 || $activePage == 16 || $activePage == 17 || $activePage == 18 || $activePage == 22 || $activePage == 10)?'active activeMain' : '';?> ">
                    <!-- <a href="#">
                        <span>Poster</span> <i class="fa fa-angle-left pull-right"></i>
                    </a> -->
                    <ul class="treeview-menu no-padding subMenu" style="display: block!important;">
                        

<li><a href="<?php echo $BaseUrl ?>/post-ad/freelancer/?post" >Post a Project</a></li>


                    
                        <li class="<?php echo ($activePage == 1)?'activeInsub' : '';?>"><a href="<?php echo $BaseUrl.'/freelancer/dashboard/';?>" >My Dashboard</a></li>

                            

                          <li class="<?php echo ($activePage == 18)?'activeInsub' : '';?>"><a href="<?php echo $BaseUrl.'/freelancer/dashboard/active-bid.php'; ?>" >Active Projects</a></li>
                        
                        <li class="<?php echo ($activePage == 14)?'activeInsub' : '';?>"><a href="<?php echo $BaseUrl.'/freelancer/dashboard/draft.php';?>" >Draft Projects</a></li>
                        
                         <li class="<?php echo ($activePage == 15)?'activeInsub' : '';?>"><a href="<?php echo $BaseUrl.'/freelancer/dashboard/complete.php'; ?>" >Completed Projects</a></li>
                        
                       <!--- <li class="<?php echo ($activePage == 11)?'activeInsub' : '';?>"><a href="<?php echo $BaseUrl.'/freelancer/dashboard/poster_dashboard.php'; ?>" >Open Projects</a></li>-->
						<li class="<?php echo ($activePage == 13)?'activeInsub' : '';?>"><a href="<?php echo $BaseUrl.'/freelancer/dashboard/expire.php'; ?>" >Closed Projects</a></li>
						

                        <li class="<?php echo ($activePage == 19)?'activeInsub' : '';?>"><a href="<?php echo $BaseUrl.'/freelancer/dashboard/freelancer_hire_project.php'; ?>" >Hired Freelancers</a></li>

                        <li class="<?php echo ($activePage == 77)?'activeInsub' : '';?>"><a href="<?php echo $BaseUrl.'/freelancer/dashboard/freelancer_awarded_project.php'; ?>" >Awarded Freelancers</a></li>

                        
                        <li class="<?php echo ($activePage == 12)?'activeInsub' : '';?>"><a href="<?php echo $BaseUrl.'/freelancer/freelancer.php?cat=ALL';?>" >Find Freelancer</a></li> 

<li class="<?php echo ($activePage == 22)?'activeInsub' : '';?>"><a href="<?php echo $BaseUrl.'/freelancer/dashboard/favourite_freelancer.php'; ?>" >Favorite Freelancer</a></li>
<li class="<?php echo ($activePage == 10)?'activeInsub' : '';?>"><a href="<?php echo $BaseUrl.'/freelancer_inbox.php';?>" >Inbox</a></li>
                       
                         <!-- <li class="<?php echo ($activePage == 16)?'activeInsub' : '';?>"><a href="<?php echo $BaseUrl.'/freelancer/dashboard/myFlag.php'; ?>" >Flagged Projects</a></li>
                        <li class="<?php echo ($activePage == 17)?'activeInsub' : '';?>"><a href="<?php echo $BaseUrl.'/freelancer/dashboard/flagResponse.php'; ?>" >Flagged Projects Response</a></li> -->
                        

                    </ul>
                </li>
                
                         <?php }?>

                <!-- <li class="<?php echo ($activePage == 17)?'activepage' : '';?>"><a href="javascript:void(0)" >Other Profile Dashboard</a></li>   -->
                
            
            </ul> 
        </div>
        
        
    </div>