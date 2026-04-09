<?php
//require_once('../common.php');
$access_without_login = true;
include('../univ/baseurl.php');
//session_start(); 
$page = 'job-detail';
$access_without_login = true;


function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$postId = isset($_REQUEST['postid']) ? (int)$_REQUEST['postid'] : 0;
//$postId = 585;

$p = new _jobpostings;
$res = $p->singletimelines($postId); 
if ($res) {
    $row = mysqli_fetch_assoc($res);

    $title      = $row['spPostingTitle'];
    $overview   = $row['spPostingNotes'];
    $country    = $row['spPostingsCountry'];
    $city       = $row['spPostingsCity'];
    $dt         = new DateTime($row['spPostingDate']);
    $postingDate = $p->spPostingDate($row["spPostingDate"]);
    $clientId   = $row['spProfiles_idspProfiles'];
    $postedPerson = $row['spUser_idspUser'];
    $CloseDate  = $row['spPostingClosing'];
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
    $howAply    = $row['spPostingApply'];
    $noOfPos    = $row['spPostingNoofposition'];
    // company profile information
    $u = new  _spbusiness_profile;
    $result3 = $u->read($clientId);
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

$uid = $_SESSION['uid'];
$pid = $_SESSION['pid']; 
include_once("../views/common/header.php");
?>
<script>

    function getaddress() {
        var address = $("#txtJobLoc").val();
        $.ajax({
            type: "POST",
            url: "../address.php",
            cache: false,
            data: {
                'address': address
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $("#suggested_address").html('<option value="' + obj.address + '" class="op_address">' + obj
                    .address + '</option>');
                $("#latitude").val(obj.latitude);
                $("#longitude").val(obj.longitude);

            }
        });
    }
    // Job Details code
    function printContent(el) {
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
// Job Details code End
</script>
</div>
</div>
<div class="body-wrapper">
    <div class="job-wrapper">
        <div class="job-body-wrapper">
            <div class="top-name">
                Job
            </div>
            
            <div class="main-wrapper">
                <div class="job-detail w-100" >
                    <!------------------------------------------------------------------------------------------------------------------->
                    <div class="detail" id="printArea">
                
                        <div class="main-title"><?php echo ucfirst($title); ?></div>
                        <div class="salary">Salary <?php echo $salaryyy;?></div>

                        <?php 
                        if ( isset($_SESSION['uid']) && $_SESSION['uid'] != $users['spUser_idspUser']) {
                            if ($_SESSION['ptid'] == 5) {
                                if ($_SESSION['uid'] != $postedPerson) {
                                    $ac = new _sppost_has_spprofile; 
                                    $chkAplyPost = $ac->myapplyJobs( $postId , $_SESSION['pid'] );
                                    $jb = new _jobapply;
                                    $check_if_apply = $jb->alradyapply($postId, $_SESSION['pid']);
                                    if ($_SESSION['guet_yes'] != 'yes') {
                                        if ($check_if_apply > 0) { ?>
                                            <a href="javascript:void(0);" class="apply-btn" disabled><button class="apply-btn">
                                            Already Applied
                                                </button></a><?php
                                        } else {?>
                                            <!-- <a href="javascript:openModel('coverletter', <?php echo $postId;?>);" class="apply-btn" id='applybtn'><button class="apply-btn">APPLY NOW</button></a> -->
                                            <?php   
                                            $cl = new _jobapply;
                                            $apply = $cl->alradyapply($_SESSION['pid']);
                                                if ($apply && $apply > 0) { ?>
                                                    <a href="<?php echo $BaseUrl . "/job-board/job-apply.php?postid=".$postId;?>" class="apply-btn" id='applybtn'><button class="apply-btn">APPLY NOW</button></a>
                                                <?php
                                                } else {  ?>
                                                        <a href="<?php echo $BaseUrl . "/job-board/job-apply.php?postid=".$postId;?>" class="apply-btn" id='applybtn'><button class="apply-btn">APPLY NOW</button></a>
                                        <?php  }  ?>
                                    <?php
                                        }
                                    }
                                }
                            } else { ?>       
                                <a href="javascript:openModel('Notabussiness', 444);" class="apply-btn">
                                <button class="apply-btn">APPLY NOW</button>
                                </a>
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
                        }else{ ?>
                            <a href="" class="apply-btn"><button class="apply-btn">APPLY NOW</button></a>
                        <?php } ?>

                    
                        
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
                            <p><?php echo $overview; ?></p>
                        </div>
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
                                Type : <?= $row['spPostingLocation'] ?>
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
                                Location : <?php echo $tbl_city4;?>
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
                                $result2 = $sj->chekJobSave($postId, ( isset($_SESSION['pid']) ? $_SESSION['pid'] : '' ) );
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
                            if ( isset($_SESSION['ptid']) && ($_SESSION['ptid'] != 5 || 0==0) ) { ?>
                            <div><a href="javascript:openModel('fwdjob', <?php echo $postId;?>);">Forward</a></div>
                            <?php
                            }
                            ?>
                            <div><a href="javascript:void(0);" onclick="printContent('printArea')">Print</a></div>
                            <div><a href="<?php echo $BaseUrl . '/job-board/company.php?cmpyid=' . $clientId; ?>">View Company Detail</a></div>
                            <div><a href="<?php echo $BaseUrl . '/job-board/company.php?cmpyid=' . $clientId . '&job=posted'; ?>">View all jobs</a></div> 
                            <?php
                            if ( isset($_SESSION['pid']) && $_SESSION['pid'] != $clientId) {
                                $sppids = $_SESSION['pid'];
                                $sp = new _flagpost;
                                $spflag = $sp->readflag2($sppids, $postId);
                                if ($spflag != false) { 
                                    if ($_SESSION['guet_yes'] != 'yes') { ?>
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
                            $share_text = urlencode("Check this out! Job Title: " . ucfirst($title) . ". Description: " . strip_tags($overview)); // Your share text with job title and description
                            $share_url = urlencode($BaseUrl.'/job-board/job-detail.php?postid='.$postId); // Your share URL
                            ?>
                            <!-- <a href="#">Add To Favorite</a> -->
                            <div class="icons-wrapper">            
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urldecode($share_url); ?>&quote=<?php echo $share_text; ?>" target="_blank"><img src="<?php echo $BaseUrl; ?>/job-board/assets/images/facebook.svg" alt=""></a>            
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urldecode($share_url); ?>" target="_blank"><img src="<?php echo $BaseUrl; ?>/job-board/assets/images/insta.svg" alt=""></a>           
                                <a href="https://twitter.com/intent/tweet?text=<?php echo $share_text; ?>&url=<?php echo urldecode($share_url); ?>" target="_blank"><img src="<?php echo $BaseUrl; ?>/job-board/assets/images/tweet.svg" alt=""></a>            
                                <a href="https://api.whatsapp.com/send?text=<?php echo $share_text . '%20' . urldecode($share_url); ?>" target="_blank"><img src="<?php echo $BaseUrl; ?>/job-board/assets/images/whatsapp.svg" alt=""></a>            
                            </div>
                        </div>
                    </div>
                    <!------------------------------------------------------------------------------------------------------------------->
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Current Location Modal End -->
<!-- Model End Change Location -->

<!-- Job details model -->
 
<!-- Modal -->
<div id="fwdjob" class="modal fade" style="z-index:9999;position:fixed;" role="dialog">
    <div class="modal-dialog sharestorepos">
        <!-- Modal content-->
        <div class="modal-content no-radius">
            <form method="post" action="sendEmail.php" id="frd_frm">
                <input class="tresdas" type="hidden" value="<?php echo $_SERVER['REQUEST_URI'] ?>" id="txtlink" name="txtlink" />
                <input type="hidden" value="<?php echo $postId; ?>" id="postid" name="postid" />
                <input type="hidden" value="<?php echo $_SESSION['pid']; ?>" id="sender_id" name="sender_id" />
                <div class="modal-header">
                    <h4 class="modal-title">Job Forward</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Enter Email</label>
                        <input type="email" name="txtemail" class="form-control" />
                        <p style="text-align: center;">Or</p>
                        <label for="">Select Friend</label>
                        <select class="mySelect form-control" name="txtFriend[]" multiple style="width:100%;">
                            <option value="" disabled>Select Friends</option>
                            <?php
                                $f = new _spprofilehasprofile;
                                $p = new _spprofiles;
                                $myFrndList = $f->readallfriend($_SESSION['pid']);

                                if ($myFrndList) {
                                while ($rows = mysqli_fetch_assoc($myFrndList)) {
                                    $profile = $p->read($rows['spProfiles_idspProfilesReceiver']);
                                    $profile = mysqli_fetch_assoc($profile);
                            ?>
                                <option value="<?php echo $profile['idspProfiles']; ?>">
                                <?php echo $profile['spProfileName']; ?></option>

                            <?php } } ?>
                        </select>

                        <span id="email_err" style="color: red;"></span>
                    </div>
                    <div class="form-group">
                        <label>Enter Message</label>
                        <textarea name="txtmsg" rows="4" cols="40" class="form-control">I am sharing a job from TheSharePage.com that I thought may be of interest to you.
                        </textarea>
                        <!-- <input type="email" name="txtemail"  id="txtemail" class="form-control" list="friendname" /> -->

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModel('fwdjob');">Cancel</button>
                    <button type="submit" style="color: white ; background-color: #7649B3;" class="btn btn-primary"
                        id="sub_email">Forward</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="flagPost" class="modal fade" style="z-index:9999;position:fixed;" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <form method="post" action="addtoflag.php" id="flagpost_frm" class="sharestorepos">
            <div class="modal-content no-radius">
                <input type="hidden" name="spPosting_idspPosting" id="spPosting_idspPosting"
                    value="<?php echo $postId; ?>">
                <input type="hidden" name="spProfile_idspProfile" id="spProfile_idspProfile"
                    value="<?php echo $_SESSION['pid']; ?>">
                <input type="hidden" name="spCategory_idspCategory" value="2"> <?php //echo $_GET['categoryID'] ?>
                <div class="modal-header">
                    <h4 class="modal-title">Flag Post</h4>
                </div>
                <div class="modal-body">
                    <div class="radio">
                        <label><input type="radio" name="why_flag" value="Duplicate post" checked=""> Duplicate
                            post</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="why_flag" value="Posting Violation"> Posting Violation</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="why_flag" value="Suspicious Post"> Suspicious Post</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="why_flag" value="Copied My Post"> Copied My Post</label>
                    </div>
                    <br>
                    <!-- <label>Why flag this post?</label> -->
                    <textarea class="form-control" name="flag_desc" id="flag_desc"
                        placeholder="Add Comments"></textarea>

                    <span id="fdesc_err" style="color: red;"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" style='height:auto;' onclick="closeModel('flagPost');">Cancel</button>
                    <button type="button" id="flag_sub1" onclick="flag_sub()"
                        style="color: white ; background-color: #7649B3;height:auto;" class="btn btn-primary" value="Flag Now">Flag
                        Now</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Apply Now -->
<div class="space-lg"></div>
<div id="Notabussiness" class="modal fade" style="z-index:9999;position:fixed;" role="dialog">
    <div class="modal-dialog" style="text-align: center;">
        <!-- Modal content-->
        <div class="modal-content no-radius sharestorepos bradius-10">
            <div class="modal-header br_radius_top bg-white">

            </div>
            <div class="modal-body nobusinessProfile">
                <h1><i class="fa fa-info" style="color:red;" aria-hidden="true"></i></h1>
                <h2> Only EMPLOYMENT profile can apply to a job, Please create or switch to your Employment Profile to
                    apply to this job.</h2>
                <!-- <a href="<?php echo $BaseUrl . '/my-profile'; ?>" class="btn" style = "background: #31abe3!important;">Switch/Create Profile</a> -->
                <a href="<?php echo $BaseUrl . '/my-profile'; ?>">
                    <div class="switchprofile">
                        <a href="" style="color: white ; background-color: #7649B3;" class="btn btn-primary">SWITCH
                            PROFILE</a>
                </a>
            </div>
        </div>
        <div class="modal-footer br_radius_bottom bg-white">
            <!--<button type="button" style="background: #31abe3!important;" class="btn btn-primary db_btn db_primarybtn" data-dismiss="modal">Close</button>-->
        </div>
    </div>
</div>
</div>

<!-- Job Details model end -->

</div>
<?php // include_once("../views/common/footer.php"); ?>
</div>

<?php
    include_once("../views/common/share-modal.php");
    ?>
<div class="ajax-load text-center" style="display:none">
    <p><img src="<?php echo $BaseUrl; ?>/job-board/assets/images/loader.gif">Loading More Jobs</p>
</div>

<script src="<?php echo $BaseUrl; ?>/assets/js/posting/timeline.js?v=<?php echo $versions;?>"></script>
<script src="<?php echo $BaseUrl; ?>/job-board/assets/js/script.js?v=<?php echo $versions;?>"></script>
<script type="text/javascript">

    //==========ON CHANGE LOAD COUNTRY IN ACCOUNT SETTING=======
    $("#spUserCountry").on("change", function () {
        //alert('===1');
        var countryId = this.value;
        $.post("loadUserState.php", {
        countryId: countryId
        }, function (r) {
        //alert(r);
            $(".loadUserState").html(r);
        });
        $("#spUserCity").html('');
    
    });
    //==========ON CHANGE LOAD COUNTRY IN ACCOUNT SETTING=======


    //==========ON CHANGE LOAD CITY==========

    $("#spUserState").on("change", function() {
        var state = this.value;
        $.post("loadUserCity.php", {
            state: state
        }, function(r) {
            //alert(r);
            $(".loadCity").html(r);
        });
    });
    //==========ON CHANGE LOAD CITY==========

    // Job Details code
    function flags() {
        document.getElementById('flags').innerText = 'you have already flagged this post from another profile';
    } 

    $(document).ready(function() {
        <?php
            if (isset($_SESSION['email_status'])) : ?>
                <?php if($_SESSION['email_status'] == "success"){ ?>
                    toastr.success("<?= $_SESSION['email_msg_forword'] ?>");
                <?php }elseif($_SESSION['email_status'] == "error") { ?>
                    toastr.error("<?= $_SESSION['email_msg_forword'] ?>");
                <?php } ?>
            <?php unset($_SESSION['email_status']); unset($_SESSION['email_msg_forword']); ?> 
        <?php endif; ?>
        /*flag validate*/

        $("#flag_sub").click(function() {
            return 0;
            var desc = $("#flag_desc").val();
            //alert(desc);
            if (desc == "") {
                $("#fdesc_err").text("Please Enter Description.");
                return false;
            } else {
                $("#flagpost_frm").submit();
            }
        });
        /*Forward validate*/

        $("#sub_email").click(function() {
            var txtemail = $("#txtemail").val();
            //alert(desc);

            if (txtemail == "") {
                $("#email_err").text("Please Enter Email.");
                return false;
            } else {
                $("#frd_frm").submit();
            }
        });
    });

    function flag_sub() {
        var desc = $("#flag_desc").val();
        //alert(desc);
        if (desc == "") {
            $("#fdesc_err").text("Please Enter Description.");
            return false;
        } else {
            $("#flagpost_frm").submit();
        }
    }

    function myFun(id) {

        $.ajax({
            url: "/job-board/savejob.php",
            type: "GET",
            data: {
                save: id
                //profileid: ide
            },
            success: function(response) {
                $("#savefun" + id).html('<a onclick="myUnsave(' + id + ')">Unsave</a>');
            }

        });
    }

    function myUnsave(id) {
        $.ajax({
            url: "/job-board/savejob.php",
            type: "GET",
            data: {
                unsave: id
                //profileid: ide
            },
            success: function(response) {
                $("#savefun" + id).html('<a onclick="myFun(' + id + ')">Save</a>');
            }
        });
    }

    function openModel(action, id) { 
        if (action == 'fwdjob') {
            jQuery('#postid').val(id);
            // jQuery('#txtlink').val('<?php //echo $_SERVER['REQUEST_URI'] ?>?>');
        } else if (action == 'flagPost') {
            jQuery('#spPosting_idspPosting').val(id);
        }
        $('#' + action).addClass('change-location-modal');
        jQuery('#' + action).modal('show');
    }

    function closeModel(action) {
        $('#' + action).removeClass('change-location-modal');
        jQuery('#' + action).modal('hide');
    }
</script>
<?php include "../views/common/footer.php"; ?>
</body>

</html>
<?php

?>
