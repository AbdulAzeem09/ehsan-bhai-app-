<?php
   
    include('../univ/baseurl.php');
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");


    $_GET["categoryid"] = $_GET['categoryID'] = "2";
    $_GET["categoryName"] = "Job Board";

    $f = new _spprofiles;
    $sl = new _shortlist;

?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
        <!--This script for posting timeline data Start-->
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
        <!--This script for posting timeline data End-->
        <script type="text/javascript">
            function printContent(el){
                var restorepage = document.body.innerHTML;
                var printcontent = document.getElementById(el).innerHTML;
                document.body.innerHTML = printcontent;
                window.print();
                document.body.innerHTML = restorepage;
            }
        </script>
    </head>

    <body class="bg_gray">
        <?php
        $header_jobBoard = "header_jobBoard";
        include_once("../header.php");
        ?>
        <section class="" style="border-bottom: 2px solid #CCC">
            <div class="container">

                <?php
                    $p = new _postingview;
                    $res = $p->singletimelines($_GET['postid']);
                    //echo $p->ta->sql;
                    if($res){
                        $row = mysqli_fetch_assoc($res);
                        $title      = $row['spPostingtitle'];
                        $overview   = $row['spPostingNotes'];
                        $country    = $row['spPostingsCountry'];
                        $city       = $row['spPostingsCity'];
                        $dt         = new DateTime($row['spPostingDate']);
                        $postingDate = $p-> spPostingDate($row["spPostingDate"]);
                        $clientId   = $row['idspProfiles'];
                        $postedPerson = $row['spUser_idspUser'];
                        $CloseDate  = $row['spPostingExpDt'];
                        // company profile information
                        $u = new _profilefield;
                        $result3 = $u->read($clientId);
                        //echo $u->ta->sql;
                        if ($result3) {
                            $CmpnyName = "";
                            $CmpnyDesc  = "";
                            $CmpSize    = "";

                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                if($CmpnyName == ''){
                                    if($row3['spProfileFieldName'] == 'companyname_'){
                                        $CmpnyName = $row3['spProfileFieldValue']; 
                                    }
                                }
                                if($CmpnyDesc == ''){
                                    if($row3['spProfileFieldName'] == 'companytagline_'){
                                        $CmpnyDesc = $row3['spProfileFieldValue']; 
                                    }
                                }
                                if($CmpSize == ''){
                                    if($row3['spProfileFieldName'] == 'CompanySize_'){
                                        $CmpSize = $row3['spProfileFieldValue']; 
                                    }
                                }
                            }
                        }
                        // ========================END======================
                        $pf = new _postfield;
                        $result_pf = $pf->read($row['idspPostings']);
                        //echo $pf->ta->sql."<br>";
                        if($result_pf){
                            
                            
                            $skill      = "";
                            $jobType    = "";
                            $jobLevel   = "";
                            $location   = "";
                            
                            $salaryStrt = "";
                            $salaryEnd  = "";
                            $Experience = "";
                            $howAply    = "";
                            $noOfPos    = "";

                            while ($row2 = mysqli_fetch_assoc($result_pf)) {

                                
                                if($noOfPos == ''){
                                    if($row2['spPostFieldName'] == 'spPostingNoofposition_'){
                                        $noOfPos = $row2['spPostFieldValue']; 
                                    }
                                }
                                
                                if($howAply == ''){
                                    if($row2['spPostFieldName'] == 'spPostingApply_'){
                                        $howAply = $row2['spPostFieldValue']; 
                                    }
                                }
                                if($Experience == ''){
                                    if($row2['spPostFieldName'] == 'spPostingExperience_'){
                                        $Experience = $row2['spPostFieldValue']; 
                                    }
                                }
                                if($salaryEnd == ''){
                                    if($row2['spPostFieldName'] == 'spPostingSlryRngFrm_'){
                                        $salaryEnd = $row2['spPostFieldValue']; 
                                    }
                                }
                                if($salaryStrt == ''){
                                    if($row2['spPostFieldName'] == 'spPostingSlryRngTo_'){
                                        $salaryStrt = $row2['spPostFieldValue']; 
                                    }
                                }
                                
                                
                                if($skill == ''){
                                    if($row2['spPostFieldName'] == 'spPostingSkill_'){
                                        $skill = explode(',', $row2['spPostFieldValue']);
                                    }
                                }
                                if($jobType == ''){
                                    if($row2['spPostFieldName'] == 'spPostingJobType_'){
                                        $jobType = $row2['spPostFieldValue'];
                                    }
                                }
                                if($jobLevel == ''){
                                    if($row2['spPostFieldName'] == 'spPostingJoblevel_'){
                                        $jobLevel = $row2['spPostFieldValue'];
                                    }
                                }
                                if($location == ''){
                                    if($row2['spPostFieldName'] == 'spPostingLocation_'){
                                        $location = $row2['spPostFieldValue'];
                                    }
                                }

                            }
                            $postingDate = $p->get_timeago(strtotime($row["spPostingDate"]));
                            //$postingDate = $p-> spPostingDate($row["spPostingDate"]);
                        }
                    } ?>



                <div class="row top_detail_board m_top_20">
                    <div class="col-md-3">
                        <a href="<?php echo $BaseUrl;?>/job-board/all-jobs.php"><i class="fa fa-angle-left"></i> Back to Jobs</a>
                    </div>
                    <div class="col-md-7">
                        <h1><?php echo $title;?></h1>
                        <p class="btmjobtitle">@ <?php echo $CmpnyName;?></p>
                    </div>
                    <div class="col-md-2">
                        <?php
                        if($_SESSION['ptid'] == 1){
                            $u = new _spuser;
                            $p_result = $u->isverify($_SESSION['uid']);
                            if ($p_result == 1) {
                                ?>
                                <a href="<?php echo $BaseUrl.'/post-ad/job-board/?post';?>" class="btn butn_jobboard">Post a job</a> <?php
                            } 
                        }?> 
                        <p class="lightrightjob">Posted <?php echo $postingDate;?></p>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row no-margin">
                    <div class="col-md-3 no-padding">
                        <div class="left_detail_job">
                            <p><i class="fa fa-briefcase"></i> <?php echo $jobType;?></p>
                            <p><i class="fa fa-clock-o"></i> &nbsp;<?php echo $jobLevel;?></p>
                            <p><i class="fa fa-map-marker"></i> &nbsp;&nbsp;<?php echo $location;?></p>
                            <h3>Skills</h3>
                            <ul>
                                <?php
                                if($skill != ''){
                                    if(count($skill) >0){
                                        foreach($skill as $key => $value){
                                            if($value != ''){
                                                echo "<li><i class='fa fa-tag'></i> ".$value."</li>";
                                            }
                                           
                                        }
                                    }
                                }
                                
                                ?>
                                
                            </ul>
                            <!-- <h3>Share With:</h3>
                            <div class="social_share_job">
                                <a href=""><i class="fa fa-facebook"></i></a>
                                <a href=""><i class="fa fa-twitter"></i></a>
                                <a href=""><i class="fa fa-linkedin"></i></a>
                            </div> -->
                            <div class="space-lg"></div>
                            <?php
                            if($_SESSION['uid'] != $postedPerson){ 
                                $ac = new _sppost_has_spprofile;
                                $chkAplyPost = $ac->myapplyJobs($_SESSION['pid'], $_GET["postid"]);
                                //echo $ac->ta->sql;
                                if($chkAplyPost != false){ ?>
                                    <a href="javascript:void(0);" class="btn create_add no-radius" style="width: 100%;" >Already Applied</a><?php
                                }else{
                                    ?>
                                    <a href="#" class="btn create_add no-radius" style="width: 100%;" data-toggle='modal' data-target='#coverletter' id='applybtn' >APPLY NOW</a> <?php
                                }
                            }
                            ?>
                            
                        </div>
                        <div class="left_btm_detail_job ">
                            <h2><a href="<?php echo $BaseUrl.'/job-board/company.php?cmpyid='.$clientId;?>">About Company</a></h2>
                            <h4><?php echo $CmpnyName;?></h4>
                            <p class="text-justify"><?php echo $CmpnyDesc;?></p>
                            
                        </div>
                    </div>
                    <div class="col-md-7 no-padding" >
                        <div class="right_detail_job" >
                            <div id="printArea">
                                <h2>Job Description</h2>
                                <p><?php echo $overview;?></p>
                                
                                <div class="space"></div>
                                <h2>Job Details</h2>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <tbody>
                                                   <tr>
                                                        <td>Company Name</td>
                                                        <td><?php echo $CmpnyName; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Company Size: </td>
                                                        <td><?php echo $CmpSize; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Positions:  </td>
                                                        <td><?php echo ($noOfPos > 0)?$noOfPos:'Not Define'; ?></td>
                                                    </tr>
                                                    <!-- <tr>
                                                        <td>How to apply: </td>
                                                        <td><?php echo $howAply;?></td>
                                                    </tr> -->
                                                    <tr>
                                                        <td>Job Type: </td>
                                                        <td><?php echo ($jobType == '')?'Not Define': $jobType; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Job Level: </td>
                                                        <td><?php echo $jobLevel; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Salary: </td>
                                                        <td><?php echo $salaryEnd .' - '.$salaryStrt; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Closing Date: </td>
                                                        <td><?php echo $CloseDate; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Experience: </td>
                                                        <td><?php echo ($Experience == '')?'Not Define':$Experience; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Location: </td>
                                                        <td><?php echo ($location == '')?'Not Define':$location;?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <?php
                            if($_SESSION['uid'] != $postedPerson){ 
                                $ac = new _sppost_has_spprofile;
                                $chkAplyPost = $ac->myapplyJobs($_SESSION['pid'], $_GET["postid"]);
                                //echo $ac->ta->sql;
                                if($chkAplyPost != false){ ?>
                                    <a href="javascript:void(0);" class="btn create_add no-radius"  >Already Applied</a><?php
                                }else{
                                    ?>
                                    <a href="#" class="btn create_add no-radius"  data-toggle='modal' data-target='#coverletter' id='applybtn' >APPLY NOW</a> <?php
                                }
                            }
                            ?>
                           
                        </div>
                        <div class="right_detail_job">
                            <div class="title_job">
                                <h2>Similar Jobs on TSP- Job Board</h2>
                                <div class="space"></div>
                                <div class="row">
                                    <?php

                                    $limit = 4;
                                    $p   = new _postingview;
                                    $pf  = new _postfield;
                                    $res = $p->publicpost_jobBoard($limit, 2);
                                    //echo $p->ta->sql;
                                    if($res){
                                        while ($row = mysqli_fetch_assoc($res)) { ?>
                                            <div class="col-sm-12">
                                                <a href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row['idspPostings'];?>"><?php echo $row['spPostingtitle'];?></a>
                                                <p>
                                                    <?php
                                                    if(strlen($row['spPostingNotes']) < 400){
                                                        echo $row['spPostingNotes'];
                                                    }else{
                                                        echo substr($row['spPostingNotes'], 0,400);
                                                        
                                                    } ?>
                                                    <a href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row['idspPostings'];?>" class="readmore">...Read More</a>
                                                </p>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 no-padding">
                        <div class="left_detail_job right_job_detail">
                            <h3>Actions:</h3>
                            <?php
                            $sj = new _save_job;
                            $result2 = $sj->chekJobSave($_GET['postid'], $_SESSION['pid']);
                            if($result2){
                                if($result2->num_rows > 0){ 
                                    $row2 = mysqli_fetch_assoc($result2);
                                    ?>
                                    <a href="<?php echo $BaseUrl.'/job-board/savejob.php?unsave='.$row2['save_id'];?>"><p>Unsave Job</p></a> <?php
                                }else{ ?>
                                    <a href="<?php echo $BaseUrl.'/job-board/savejob.php?postid='.$_GET['postid'];?>"><p>Save Job</p></a> <?php
                                }
                            }else{ ?>
                                <a href="<?php echo $BaseUrl.'/job-board/savejob.php?postid='.$_GET['postid'];?>"><p>Save Job</p></a> <?php
                            }
                            
                            ?>
                            
                            <a href="" data-toggle="modal" data-target="#fwdjob"><p>Forward</p></a>
                            <a href="" onclick="printContent('printArea')"><p>Print</p></a>
                            <a href="<?php echo $BaseUrl.'/job-board/company.php?cmpyid='.$clientId;?>"><p>View Company Detail</p></a>
                            <a href="<?php echo $BaseUrl.'/job-board/company.php?cmpyid='.$clientId.'&job=posted';?>"><p>View all jobs by this company</p></a>
                            <?php
                            if ($_SESSION['pid'] != $clientId ) {
                                ?>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#flagPost" ><p>Flag This Post</p></a>
                                <?php
                            }
                            ?>
                            
                            <!-- Modal -->
                            <div id="flagPost" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <form method="post" action="addtoflag.php" class="sharestorepos">
                                        <div class="modal-content no-radius">
                                            <input type="hidden" name="spPosting_idspPosting" value="<?php echo $_GET['postid'];?>">
                                            <input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
                                            <input type="hidden" name="spCategory_idspCategory" value="<?php echo $_GET['categoryID']?>">
                                            <div class="modal-header">
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
                                                <textarea class="form-control" name="flag_desc" placeholder="Add Comments"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" name="" class="btn butn_mdl_submit ">
                                                <button type="button" class="btn butn_cancel" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>



                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Modal -->
        <div id="fwdjob" class="modal fade" role="dialog">
            <div class="modal-dialog sharestorepos">
                <!-- Modal content-->
                <div class="modal-content no-radius">
                    <form method="post" action="sendEmail.php">
                        <input type="hidden" value="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$_GET['postid'];?>" name="txtlink" />
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Job Forward</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Enter Email</label>
                                <input type="email" name="txtemail" class="form-control" required="" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info" >Forward</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php 
        include("coverletter.php");
        include('../component/footer.php');
        include('../component/btm_script.php'); 
        ?>
	</body>
</html>
