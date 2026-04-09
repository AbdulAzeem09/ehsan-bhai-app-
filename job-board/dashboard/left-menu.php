    <?php
    $pageLink = 'job-board';
    ?>
    <div class="left_jobboard" style="padding-top: 15px;">
        <?php
        $p = new _spprofiles;
        if($_SESSION['ptid'] == 1 OR $_SESSION['ptid'] == 5){ ?>
            <div class="row no-margin">
                <div class="col-md-4 no-padding">
                    <?php
                   /* $result = $p->read($_SESSION['pid']);
                    if ($result != false) {
                        $row = mysqli_fetch_assoc($result);
                        if (isset($row["spProfilePic"])){
                            echo "<img alt='profilepic' class='img-responsive propic center-block' src=' " . ($row["spProfilePic"]) . "'  >";
                        }else{
                            echo "<img alt='profilepic' class='img-responsive img-circle propic center-block' src='".$BaseUrl."/assets/images/icon/blank-img.png' style='width: 40px; height: 40px;' >";
                        }
                    }*/
                    ?>
                </div>
                <div class="col-md-12">
                    <!--<div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" style="background-color: #0090ca;border-color: #0090ca;" type="button" data-toggle="dropdown"><?php //echo ucfirst($_SESSION['MyProfileName']); ?>
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu sp-profile-det" id="profileDropDown">
                            <?php
                           /* $rpvt = $p->readProfiles($_SESSION["uid"]);
                            //echo $p->ta->sql;
                            if ($rpvt != false){
                                while($row = mysqli_fetch_assoc($rpvt)) {
                                    if($row['spProfileType_idspProfileType'] == 1 || $row['spProfileType_idspProfileType'] == 5){
                                        ?>
                                        <li>
                                            <a id='makedefaultprofile' class="sp-user-profile-label headProfile" data-profileid='<?php echo $row['idspProfiles'];?>' data-profiletype='<?php echo $row['spProfileTypeName']; ?>' >
                                                <?php if (isset($row["spProfilePic"])) {?>

                                                    <img src="<?php echo ($row["spProfilePic"]);?>" class="img-responsive"> <?php echo ucfirst($row['spProfileName']);?> <br><span><?php echo $row['spProfileTypeName']. " Profile";?></span>

                                              <?php  }else{?>

                                                <img src="../../img/default-profile.png" class="img-responsive"> <?php echo ucfirst($row['spProfileName']);?> <br><span><?php echo $row['spProfileTypeName']. " Profile";?></span>



                                              <?php  } ?>

                                            </a>
                                        </li>
                                        <?php
                                    }
                                }
                            }*/
                            ?>

                        </ul>
                    </div><br>-->
					<style>
					.test
                    {
                        color: white !important;
                       background-color: gray;
                    }
	
					
					</style>

                    <?php
                    if(isset($_SESSION['ptid']) && $_SESSION['ptid'] == 5){ ?>
                         <!--<a href="<?php echo $BaseUrl.'/'.$pageLink.'/dashboard/emp_dashboard.php'; ?>" style="font-size:16px;">Employee Dashboard / </a>-->
                    <?php }else{ ?>
                       
                    <?php } ?>
 <a href="<?php echo $BaseUrl.'/job-board'; ?>" style="font-size:16px;background-color: #337ab7;color:white;padding: 10px;border-radius: 2px;font-family:times"><i class="fa fa-arrow-left"></i> Back To Job Home </a>
                </div>
            </div>
            <?php
/*print_r($_SESSION['ptid']);*/
        }?>


    </div><br>
    
    <div class="left_real_menu m_btm_15 m_top_15">
        <ul class="sidebar-menu">
		
            <!-- <li></li> -->
		      

            <!-- <li><a href="<?php /* echo $BaseUrl.'/job-board'; */?>">Back To Job Board</a></li>
 -->
         
    <div id="alertNotEmpProfile" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog">
      <div class="modal-content no-radius">

       <div class="modal-body nobusinessProfile text-center" id="jobseakrAlert">
         <h1><i class="fa fa-info" aria-hidden="true"></i></h1>
           <h2>Your current profile does not have <br>access to this page. Please create or switch<br> <span>"Business, Professional"</span> modules can sell property.</h2>
            <div class="space-md"></div>
             <a href="<?php echo $BaseUrl . '/my-profile'; ?>" class="btn">Create or Switch Profile</a>
              <a href="<?php echo $BaseUrl . '/job-board/dashboard/'; ?>" class="btn">Back to Home</a>
             </div>
           </div>
        </div>
    </div>
            <!-- seller dashboard by default -->
            <?php


			if($_SESSION['ptid'] == 1){ ?>

   <li ><a class="test <?php echo ($activePage == 1) ? 'activepage' : ''; ?>" href="<?php echo $BaseUrl.'/job-board/dashboard/';?>"> Dashboard </a></li>
   <?php if ($_SESSION['ptid'] == 1) { ?>
    <li><a class="test <?php echo ($activePage == 12) ? 'active' : ''; ?>" href="<?php echo $BaseUrl.'/post-ad/job-board/?post'; ?>"> Post a Job</a></li> 
    <?php } else { ?>
        <li><a class="test <?php echo ($activePage == 12) ? 'active' : ''; ?>" href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile'> Post a Job</a></li> 
     <?php } ?>

   
   
            <li><a class="test <?php echo ($activePage == 12)?'active' : '';?>" href="<?php echo $BaseUrl.'/job-board/all-jobseeker.php?cat=ALL&offset=0';?>">Browse Resume</a></li>
            <li <?php echo ($activePage == 2)?'activepage' : '';?>><a class="test <?php echo ($activePage == 2) ? 'activepage' : ''; ?>"  href="<?php echo $BaseUrl.'/'.$pageLink.'/dashboard/active-post.php'; ?>">Active Jobs</a></li>
            <!-- <li ><a class="test <?php echo ($activePage == 3) ? 'activepage' : ''; ?>" href="<?php echo $BaseUrl.'/'.$pageLink.'/dashboard/expired-post.php'; ?>" >Expired Jobs</a></li> -->
			
         <!--  <li class="<?php /*echo ($activePage == 1)?'activepage' : ''; */?>"><a href="<?php /*echo $BaseUrl.'/'.$pageLink.'/dashboard'; */?>">Employer Dashboard</a></li>
 -->
 		            <!--<li style="background: #3f48cc"><a class="<?php echo ($activePage == 12)?'active' : '';?>" href="<?php echo $BaseUrl.'/post-ad/job-board/?post';?>">Post a Job</a></li>-->
                    


            
            
            <li ><a class="test <?php echo ($activePage == 4) ? 'activepage' : ''; ?>" href="<?php echo $BaseUrl.'/'.$pageLink.'/dashboard/draft-post.php'; ?>" >Draft Jobs</a></li>
			<li ><a class="test <?php echo ($activePage == 5) ? 'activepage' : ''; ?>" href="<?php echo $BaseUrl.'/'.$pageLink.'/dashboard/saved-post.php' ?>" >Saved Jobs</a></li>
			<li><a  class="test <?php echo ($activePage == 101) ? 'activepage' : ''; ?>" href="<?php echo $BaseUrl.'/'.$pageLink.'/dashboard/flagged_profile.php' ?>" >Flagged Profiles</a></li>
			


            <li  <?php echo ($activePage == 22)?'activepage' : '';?>><a class="test <?php echo ($activePage == 22) ? 'activepage' : ''; ?>" href="<?php echo $BaseUrl.'/'.$pageLink.'/news.php'; ?>" >Company News</a></li>

            <li><a class="test <?php echo ($activePage == 44) ? 'activepage' : ''; ?>"
        href="<?php echo $BaseUrl.'/'.$pageLink.'/dashboard/favourite_jobseeker.php'; ?>" >Favourite Resume</a></li>

			

            <li ><a class="test <?php echo ($activePage == 117) ? 'activepage' : ''; ?>" href="<?php echo $BaseUrl.'/'.$pageLink.'/forwarded-Jobsbyme.php'; ?>" >Forwarded Jobs By Me</a></li>
			
        <?php } ?>

         <!--    <li class="<?php echo ($activePage == 5)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'/dashboard/saved-post.php'; ?>" >Saved Post</a></li>
            <li class="<?php echo ($activePage == 6)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'/dashboard/myFlag.php'; ?>" >Flagged Post</a></li> 

         <?php if($_SESSION['ptid'] == 5){ ?>
            <li class="<?php echo ($activePage == 1)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'/dashboard/emp_dashboard.php'; ?>">Employee Dashboard1111</a></li>

         <!--  <li><a class="<?php // echo ($activePage == 12)?'active' : '';?>" href="<?php // echo $BaseUrl.'/job-board/all-jobs.php';?>">Find Jobs</a></li> -->
<li ><a class="test <?php echo ($activePage == 1) ? 'activepage' : ''; ?>" href="<?php echo $BaseUrl.'/job-board/dashboard/emp_dashboard.php'; ?>">Dashboard</a></li>

            <li><a class="test <?php echo ($activePage == 7) ? 'activepage' : ''; ?>" href="<?php echo $BaseUrl.'/'.$pageLink.'/dashboard/applied-job.php'; ?>" >My Applied Jobs</a></li>
       

            <li><a class="test <?php echo ($activePage == 5) ? 'activepage' : ''; ?>" href="<?php echo $BaseUrl.'/'.$pageLink.'/dashboard/saved-post.php'; ?>" >Saved Jobs</a></li>

            <li ><a class="test <?php echo ($activePage == 17) ? 'activepage' : ''; ?>" href="<?php echo $BaseUrl.'/'.$pageLink.'/forwarded-Jobs.php?frw=1'; ?>" >Forwarded Jobs To Me</a></li>

        <?php } ?>
        <!-- <li><a class="test <?php echo ($activePage == 17) ? 'activepage' : ''; ?>" href="<?php echo $BaseUrl.'/job-board/forwarded-Jobs.php'; ?>" >Forwarded Jobs</a></li> -->
        <li><a class="test <?php echo ($activePage == 50) ? 'activepage' : ''; ?>" href="<?php echo $BaseUrl.'/'.$pageLink.'/forward-jobs.php?recmd=1'; ?>" >Recommended Jobs</a></li>
		 <!--<li  class="<?php echo ($activePage == 50)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'/forward-jobs.php?recmd=1'; ?>" >Company News</a></li>-->
		
       <!--  <li  class="<?php echo ($activePage == 50)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'/forward-jobs.php?recmd=1'; ?>" >Saved Job</a></li> -->
		




       <!--      <li class="<?php echo ($activePage == 8)?'activepage' : '';?>"><a href="<?php echo $BaseUrl.'/'.$pageLink.'/dashboard/trash-post.php'; ?>" >Trash Post</a></li> -->

        </ul>
    </div>
    <div>
        <div class="whitejobbox text-center">
            <?php
            if($_SESSION['ptid'] == 1){ ?>
                <a href="<?php echo $BaseUrl.'/job-board/news.php';?>"></a>
                <?php
            }
            ?>
            <a href="<?php echo $BaseUrl.'/job-board/showsavejobs.php';?>"></a>
        </div>
        <div class="m_btm_15">
            <?php
            $limit = 3;
            $p   = new _postingview;

            $sql = $p->publicpost_left_company($limit, 2);
            //echo $p->ta->sql;

            if($sql){
                while ($sql_res = mysqli_fetch_assoc($sql)) {
                    //my active jobs
                    $result2 = $p->myProfilejobpost($sql_res['idspProfiles']);
                    if($result2){
                        $Myactivejob = $result2->num_rows;
                    }else{
                        $Myactivejob = 0;
                    } ?>
                    <div class="leftPostCmpny text-center">
                        <a href="<?php echo $BaseUrl.'/job-board/company.php?cmpyid='.$sql_res['idspProfiles'];?>">
                            <div class="boxGraph">
                                <h2><?php echo $sql_res['spProfileFieldValue'];?></h2>
                                <p><?php echo $Myactivejob;?> posting jobs</p>
                            </div>
                        </a>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
