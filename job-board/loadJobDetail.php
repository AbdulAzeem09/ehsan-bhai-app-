
<?php
    include('../univ/baseurl.php');
    session_start();
    function sp_autoloader($class){
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $postId = isset($_REQUEST['postid']) ? (int)$_REQUEST['postid'] : 0;
	$p = new _jobpostings;
	$res = $p->singletimelines($postId); 
    if ($res) {
        $row = mysqli_fetch_assoc($res);
        $spPostingCustomQuestion = $row['spPostingCustomQuestion'];
        $title      = $row['spPostingTitle'];
        $overview   = $row['spPostingNotes'];
        $country    = $row['spPostingsCountry'];
        $city       = $row['spPostingsCity'];
        $dt         = new DateTime($row['spPostingDate']);
        $postingDate = $p->spPostingDate($row["spPostingDate"]);
        $clientId   = $row['spProfiles_idspProfiles'];
        $postedPerson = $row['spUser_idspUser'] ?? null;
        $CloseDate  = $row['spPostingExpDt'];
        $skill      = explode(',', $row['spPostingSkill']);
        $jobType    = $row['spPostingJobType'];
        $jobCategory   = $row['subCategoryTitle'];
        $jobTypennnn    = $row['spPostingJobType'];
        $jobLevel   = $row['spPostingJoblevel'];
        $location   = $row['spPostingsCity'];
        $salaryStrt = $row['spPostingSlryRngTo'];
        $salaryEnd  = $row['spPostingSlryRngFrm'];
        $job_type  = $row['spPostingJobType'];
        $stateuser  = $row['spPostingsState'];
        $stateskill  = $row['spPostingSkill'];
        if ($row['spPostingSlryRngFrm'] > 0) {
            $salaryyy = '$' . $row['spPostingSlryRngFrm'] . ' - $'. $row['spPostingSlryRngTo'] . ' ' .$row['job_currency'];
        }

        $Experience = $row['spPostingExperience'];
        $howAply    = $row['spPostingApply'] ?? null;
        $noOfPos    = $row['spPostingNoofposition'];
        // company profile information
        $u = new  _spbusiness_profile;
        $result3 = $u->read($clientId);
        // echo "<pre>"; print_r($row);die();
        //echo $u->ta->sql;
        if ($result3) {
            $CmpnyName = "";
            $CmpnyDesc  = "";
            $CmpSize    = "";
            $row3 = mysqli_fetch_assoc($result3);
            //print_r($row3);

            $CmpSize = $row3['CompanySize'];
            //$CmpnyDesc = $row3['skill'];
            $CmpnyName = ucfirst($row3['companyname']);
        
        }
        // ========================END======================
        $pf = new _postfield;
        $result_pf = $pf->read($row['idspPostings']);
        //echo $pf->ta->sql."<br>";
        if ($result_pf) {
            date_default_timezone_set("Asia/Karachi");
            $postingDate = $p->get_timeago(strtotime($row["spPostingDate"]));
        }

        $res88 = $p->readtblCity($location);
        if ($res88 != false) {
            $tbl_city3 = mysqli_fetch_assoc($res88);
            $tbl_city4 =	$tbl_city3['city_title'];
        }
        $pr = new _state;
        $resState = $pr->readStateName($stateuser);
        if ($resState != false) {
            $getState = mysqli_fetch_assoc($resState);
            $statename =	$getState['state_title'];
        }

        $pr = new _country;
        $resCountry = $pr->readCountryName($country);
        if ($resCountry != false) {
            $getCountry = mysqli_fetch_assoc($resCountry);
            $countryname =	$getCountry['country_title'];
        }
        
	}  
    //position-relative
	$uid = $_SESSION['uid'];
	$pid = $_SESSION['pid'];
    if(!isset($_SESSION['guet_yes'])){
        $_SESSION['guet_yes'] = "";
    } 

    if(!isset($users)){
        $users['spUser_idspUser'] = '';
    }
?>
 
    <div class="detail" id="printArea">
        <?php include 'job-alert-modal.php';  ?>

        <!-- Modal -->
        <div class="modal fade" id="jobAlertModal" tabindex="-1" aria-labelledby="jobAlertModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="jobAlertModalLabel">
                            I want to receive the latest job alert for <?= $title ?> in <?= (isset($tbl_city4) ? $tbl_city4 . ', ' : '') ?><?= (isset($statename) ? $statename . ', ' : '') ?>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form and other content -->
                    </div>
                </div>
            </div>
        </div>

        <div class="main-title"><?php echo ucfirst($title); ?></div>
        <div class="salary">Salary <?php echo $salaryyy;?></div>

        <?php 
        if ($_SESSION['uid'] != $users['spUser_idspUser']) {
            if ($_SESSION['ptid'] == 5) {
                if ($_SESSION['uid'] != $postedPerson) {
                    $ac = new _sppost_has_spprofile; 
                    $chkAplyPost = $ac->myapplyJobs( $postId , $_SESSION['pid'] );
                    $jb = new _jobapply;
                    $check_if_apply = $jb->alradyapply($postId, $_SESSION['pid']);
                    if ($_SESSION['guet_yes'] != 'yes') {
                        if ($check_if_apply > 0) { ?>
                            <a href="javascript:void(0);" class="apply-btn" disabled>
                                <button class="apply-btn">Already Applied</button>
                            </a>
                        <?php } else { ?>
                            <!-- <a href="javascript:openModel('coverletter', <?php echo $postId;?>);" class="apply-btn" id='applybtn'><button class="apply-btn">APPLY NOW</button></a> -->
                        <?php   
                            $cl = new _jobapply;
                            $apply = $cl->alradyapply($_SESSION['pid']);
                            if(date('Y-m-d') > $row['spPostingClosing']){ ?>
                                <p style="color:red;">Job expired. Not accepting any more applications.</p>
                            <?php } 
                            else{
                                if ($apply && $apply > 0) { ?>                                
                                    <a href="<?php echo $BaseUrl . "/job-board/job-apply.php?postid=".$postId;?>" class="apply-btn" id='applybtn'><button class="apply-btn">APPLY NOW</button></a>
                                <?php } else { ?>
                                    <a href="<?php echo $BaseUrl . "/job-board/job-apply.php?postid=".$postId;?>" class="apply-btn" id='applybtn'><button class="apply-btn">APPLY NOW</button></a>
                                <?php
                                    }
                                }
                            ?>
                        <?php
                        }
                    }
                }
            } else { 
                if(date('Y-m-d') > $row['spPostingClosing']){ ?>
                    <p style="color:red;">Job expired. Not accepting any more applications.</p>
                <?php } 
                else{ ?> 
                
                <a href="javascript:openModel('Notabussiness', 444);" class="apply-btn">
                    <button class="apply-btn">APPLY NOW</button>
                </a>  
                
                <?php } ?>
                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                        <p> Only EMPLOYMENT profile can apply to a job, Please create or switch to your Employment Profile to
                        apply to this job.</p>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer text-center">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>

                        </div>
                    </div>
                </div>
            <?php 
            }
        } 
        ?>

    
        
        <?php
        if ($skill != '') {
            if (count($skill) > 0) {?>
                <div class="title">
                    Skills Required
                </div>
                <div class="skills"> 
                <?php
                foreach ($skill as $key => $value) {
                    if ($value != '') {
                        echo "<div class='skill'>" . $value . "</div>";
                    }
                }?>
                </div>
                <?php
            }
        }
        ?>   
        <div class="title">Job Description</div>
        <div class="text" style="word-break: break-word;">
            <?php echo $overview; ?>
        </div>
        <?php if(isset($spPostingCustomQuestion) && !empty($spPostingCustomQuestion)){ ?>
            <div class="title">Question asked</div>
            <div class="text" style="word-break: break-word;">
                <?php  
                    $spPostingCustomQuestion = json_decode($spPostingCustomQuestion, true);
                ?>
                <ul>
                <?php 
                foreach($spPostingCustomQuestion['custom_question_title'] as $key => $value){
                    echo "<li><div class='skill'>" . $value . "</div></li>";
                }
                ?>
                </ul>
            </div>
        <?php } ?>
    </div>

    <div class="imp-links">
        <div class="top-detail">
            <div class="link">
                <span>
                    <img src="<?php echo $BaseUrl; ?>/job-board/assets/images/category.svg" alt="">
                </span>
                Category : <?php echo ($jobCategory == '') ? 'Not Define' : $jobCategory; ?>
            </div>
            <?php if($jobLevel) { ?>
                <div class="link">
                    <span>
                        <img src="<?php echo $BaseUrl; ?>/job-board/assets/images/level.svg" alt="">
                    </span>
                    Level : <span class="skill"><?php echo $jobLevel; ?></span>
                </div>
            <?php } ?>
        
            <div class="link">
                <span>
                    <img src="<?php echo $BaseUrl; ?>/job-board/assets/images/type.svg" alt="">
                </span>
                Type : <?= $row['spPostingJobType'] ?>
            </div>
            <div class="link">
                <span>
                <img src="<?php echo $BaseUrl; ?>/job-board/assets/svgs/postjob/map.svg" alt="">
                </span>
                Company Name : <a href="<?php echo $BaseUrl . '/job-board/company.php?cmpyid=' . $clientId; ?>"><?php echo $CmpnyName; ?></a>
            </div>
            <!--div class="link">
                <span>
                <img src="<?php echo $BaseUrl; ?>/job-board/assets/svgs/postjob/map.svg" alt="">
                </span>
                Company Size : <?php echo $CmpSize; ?>
            </div-->
            <!-- <div class="link">
                <span>
                    <img src="<?php echo $BaseUrl; ?>/job-board/assets/images/salary-type.svg" alt="">
                </span>
                Salary Type : Monthly
            </div> -->
            <div class="link">
                <span>
                    <img src="<?php echo $BaseUrl; ?>/job-board/assets/images/no-of-position.svg" alt="">
                </span>
                No of Position : <?php echo ($noOfPos > 0) ? $noOfPos : 'Not Define'; ?>
            </div>
            <div class="link">
                <span>
                    <img src="<?php echo $BaseUrl; ?>/job-board/assets/images/no-of-position.svg" alt="">
                </span>
                Closing Date : <?php echo $row['spPostingClosing']; ?>
            </div>
            <div class="link">
                <span>
                    <img src="<?php echo $BaseUrl; ?>/job-board/assets/images/no-of-position.svg" alt="">
                </span>
                Min Experience : <?php echo ($Experience == '') ? 'Not Define' : $Experience . ' Years'; ?>
            </div>
            <div class="link">
                <span>
                    <img src="<?php echo $BaseUrl; ?>/job-board/assets/images/location.svg" alt="">
                </span>
                Location : <?= $row['spPostingLocation'] ?>
            </div>
            <div class="link">
                <span>
                    <img src="<?php echo $BaseUrl; ?>/job-board/assets/images/state.svg" alt="">
                </span>
                State: <?php echo $statename;?>
            </div>
            <div class="link">
                <span>
                    <img src="<?php echo $BaseUrl; ?>/job-board/assets/images/state.svg" alt="">
                </span>
                Country : <?php echo $countryname;?>
            </div>
        </div>
        <div class="more-links">
            <div class="title">
                Actions
            </div>
            <?php
            if (!isset($_SESSION['guet_yes']) || $_SESSION['guet_yes'] != 'yes') {
                $sj = new _save_job;
                $result2 = $sj->chekJobSave($postId, $_SESSION['pid']);
                if ($result2) {
                    if ($result2->num_rows > 0) {
                    $row2 = mysqli_fetch_assoc($result2);
                    ?>
                    <div id="savefun<?php echo $row2['save_id'];  ?>"><a href="javascript:void(0);" onclick="myUnsave('<?php echo $row2['save_id']; ?>')">Unsave</a></div>
                    <?php
                    } else { ?>
                        <div><a href="<?php echo $BaseUrl . '/job-board/savejob.php?postid=' . $postId; ?>">Save</a></div>
                    </a> 
                    <?php
                    }
                } else { ?>
                    <div id="savefun<?php echo $postId;  ?>"><a href="javascript:void(0);" onclick="myFun('<?php echo $postId; ?>')">Save</a></div>
                <?php
                }
            }else{
            
            }
            ?>
            <?php
            if ($_SESSION['ptid'] != 5 || 0==0) { ?>
            <div><a href="javascript:openModel('fwdjob', <?php echo $postId;?>);">Forward</a></div>
            <?php
            }
            ?>
            <div><a href="javascript:void(0);" onclick="printContent('printArea')">Print</a></div>
            <div><a href="<?php echo $BaseUrl . '/job-board/company.php?cmpyid=' . $clientId; ?>">View Company Detail</a></div>
            <div><a href="<?php echo $BaseUrl . '/job-board/company.php?cmpyid=' . $clientId . '&job=posted'; ?>">View all jobs</a></div> 
            <?php
            if ($_SESSION['pid'] != $clientId) {
                $sppids = $_SESSION['pid'];
                $sp = new _flagpost;
                $spflag = $sp->readflag2($sppids, $postId);
                if ($spflag != false) { 
                    if (isset($_SESSION['guet_yes']) && $_SESSION['guet_yes'] != 'yes') { ?>
                        <div class="sel_chat" ><a><i class="fa fa-flag" style="color: #035049; font-size: 15px;"></i> &nbsp; Flag this post</a></div>
                    <?php } ?>
                    <div id="flags" style="color:red;"></div>
                <?php
                } else { ?>
                    <div><a href="javascript:openModel('flagPost', <?php echo $postId;?>);">Flag This Job</a></div>
                <?php
                }
            }
            ?>       
            <?php
            $share_text = urlencode("Check this out!"); // Your share text
            $share_url = urlencode($BaseUrl . '/job-board/job-detail.php?postid=' . $postId); // Your share URL
            ?>
            <!-- <a href="#">Add To Favorite</a> -->
            <div class="icons-wrapper">            
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_url; ?>" target="_blank"><img src="<?php echo $BaseUrl; ?>/job-board/assets/images/facebook.svg" alt=""></a>            
                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $share_url; ?>" target="_blank"><img src="<?php echo $BaseUrl; ?>/job-board/assets/images/insta.svg" alt=""></a>           
                <a href="https://twitter.com/intent/tweet?text=<?php echo $share_text . '&url=' . $share_url; ?>" target="_blank"><img src="<?php echo $BaseUrl; ?>/job-board/assets/images/tweet.svg" alt=""></a>            
                <a href="https://api.whatsapp.com/send?text=<?php echo $share_text . '%20' . $share_url; ?>" target="_blank"><img src="<?php echo $BaseUrl; ?>/job-board/assets/images/whatsapp.svg" alt=""></a>            
            </div>
        </div>
    </div>
<?php 
 // Job Details code
 include("coverletter.php");
?>
<script>
 function submitAlertRequest(){
    $('#alert_submit_form').hide();
    $('.alert-success').show();
    return false;
 }
</script>