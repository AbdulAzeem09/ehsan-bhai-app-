<?php
//require_once('../common.php');
$page = 'jobBoard';
include('../univ/baseurl.php');

session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "job-board/";
    include_once("../authentication/check.php");
} else {
    if(trim($_SESSION['ptname']) != 'Employment'){
        header('location:../job-board/');
        exit;
    }
    function sp_autoloader($class)
    {
    include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryid"] = "2";
    $_GET["categoryName"] = "Job Board";

    $postId = isset($_REQUEST['postid']) ? (int)$_REQUEST['postid'] : 0;
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

    $_SESSION['overview'] = $overview;
    $_SESSION['title'] = $title;

    if(isset($_SESSION['resume_data']) && isset($_GET['idspPostingMedia']) && !empty($_GET['idspPostingMedia'])){
        $resumeData = json_decode($_SESSION['resume_data'], true);
        if(array_key_exists($_GET['idspPostingMedia'], $resumeData)){
            $currentResume = $resumeData[$_GET['idspPostingMedia']];
            $_SESSION['documentUrl'] = $currentResume['documentUrl'];
            $_SESSION['fileName'] = $currentResume['name'];
            $_SESSION['tmp_resume'] = $currentResume['tmp_resume'];
        }
    }
                    
    include_once("../views/common/header.php");
?>
<div class="body-wrapper">
    <div class="job-wrapper">
        <div class="job-body-wrapper">
            <div class="filters-3">
                <div class="top-name">
                    Apply
                </div>
                <button class="add-btn" onclick="javascript:history.back()">
                    Back
                </button>
            </div>
            <div class="main-wrapper">
                <div class="resume-detail">
                    <input type="file" id="upload" name="coverletter" accept=".doc, .docx, .pdf" hidden />
                    <label class="upload-resume" for="upload">
                        <img src="<?php echo $BaseUrl; ?>/job-board/assets/images/upload.svg" alt=""> Cover Letter
                    </label>
                    <input type="file" id="upload" style="display: none;">
                    <?php include 'pdf-modal.php'; ?>
                    <!-- Bootstrap Modal for pdf coverletter
                    <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form method="post" action="">
                                    <input type="hidden" name="uid"
                                        value="<?php echo htmlspecialchars($_SESSION['uid']); ?>">
                                    <input type="hidden" name="pid"
                                        value="<?php echo htmlspecialchars($_SESSION['pid']); ?>">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="pdfModalLabel">Upload Cover Letter</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" id="pdf-title-input" class="form-control">

                                     
                                        <div id="editor" style="height: 200px;"></div>

                                        
                                        <textarea id="pdf-content" name="pdfContent" rows="10" class="form-control"
                                            style="display:none;"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="submitPdf" class="btn btn-secondary">Submit</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> -->
                    <img src="./images/or.svg" alt="" class="or">
                    <div class="input-group in-1-col">
                        <select class="form-select" aria-label="Default select example" id="coverletterSelect">
                            <?php  
                             $cl = new _coverletter;
                             $coverletter = $cl->read_coverletter($_SESSION['uid']);
                             if ($coverletter && $coverletter->num_rows > 0) {
                                echo '<option>Choose Cover Letter</option>';
                                $count = 0;
                             while ($row = $coverletter->fetch_assoc()) {
                                $count++;
                                if(isset($_GET['new']) && $_GET['new'] == "yes" && $coverletter->num_rows == $count){
                                    $_SESSION['coverletter_id'] = htmlspecialchars($row['id']);
                                }
                             ?>
                            <option <?php if(isset($_GET['pre_post_id']) && $row['title'] == $_SESSION['cover_title']) { $_SESSION['coverletter_id'] = $row['id']; } ?> value="<?php echo htmlspecialchars($row['id']); ?>"
                                data-title="<?php echo htmlspecialchars($row['title']); ?>"
                                data-coverletter="<?php echo strip_tags($row['coverletter']); ?>">
                                <?php echo htmlspecialchars($row['title']); ?>
                            </option>
                            <?php 
                            }
                             } else {
                                    echo '<option disabled>No covers available</option>';
                             }
                            ?>
                        </select>
                    </div>
                    <div class="cover-wrapper" id="coverLetterId">
                        <div class="top-detail">
                            <div class="name" id="coverTitle"><?php echo ( isset($_SESSION['cover_title']) ? $_SESSION['cover_title'] : 'Title' ) ?></div>
                            <div class="delete-icon">
                                <img src="./images/edit.svg" alt="" id="editIcon">
                            </div>
                        </div>
                        <div class="text" id="coverContent"><?php echo ( isset($_SESSION['cover_title']) ? trim($_SESSION['cover_description']) : 'Cover Letter' ) ?></div>
                    </div>
                    <img src="./images/or.svg" alt="" class="or">
                    <div class="add-title">Type a Cover Letter</div>
                    <form id="coverForm" method="POST">
                        <input type="hidden" name="uid" value="<?php echo htmlspecialchars($_SESSION['uid']); ?>">
                        <input type="hidden" name="pid" value="<?php echo htmlspecialchars($_SESSION['pid']); ?>">
                        <input type="hidden" name="coverletter_id" id="coverletter_id" value="">
                        <div class="input-group in-1-col">
                            <label>Title</label>
                            <input type="text" name="title" id="inputTitle" placeholder="Enter Title" value='<?php echo ( isset($_SESSION['cover_title']) ? $_SESSION['cover_title'] : '' ) ?>' >
                            <small id="titleHelp" class="form-text text-muted">50 characters remaining</small>
                            <script>
                                function updateRemainingCharacters() {
                                    var maxLength = 50;
                                    var currentLength = document.getElementById('inputTitle').value.length;
                                    var remaining = maxLength - currentLength;
                                    document.getElementById('titleHelp').textContent = remaining + ' characters remaining';
                                    if (currentLength > maxLength) {
                                        document.getElementById('inputTitle').value = document.getElementById('inputTitle').value.substring(0, maxLength);
                                    }
                                }

                                document.getElementById('inputTitle').addEventListener('input', updateRemainingCharacters);
                                document.getElementById('inputTitle').addEventListener('paste', function () {
                                    setTimeout(updateRemainingCharacters, 0);
                                });
                            </script>
                        </div>
                        <div class="input-group in-1-col desc">
                            <label>Cover Letter</label>
                            <textarea placeholder="Type Cover Letter" name="coverletter" id="inputContent" rows="10" cols="50"><?php echo ( isset($_SESSION['cover_title']) ? trim($_SESSION['cover_description']) : '' ) ?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="check-box">
                                    <label class="main-container"> Save This Cover Letter
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                           <!-- <div class="col-md-8">
                                <div class="main-btns">
                                    <button id="updateButton" style="display: none;">Update</button>
                                </div>
                            </div>-->
                        </div>
                        <div class="main-btns">
                            <button class="skip" onclick='skipThisPage()' type='button'>Skip</button>
                            <button id="saveButton">Continue</button>
                        </div>

                </div>
                </form>
                <?php
                    // job-coverletter.php
                    // Assuming resume data is being posted
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                          $resumeData = isset($_POST['resume_data']) ? json_decode($_POST['resume_data'], true) : [];
                          $selectedResumeId = isset($_POST['idspPostingMedia']) ? $_POST['idspPostingMedia'] : '';
                          // If a resume was selected
                          if (!empty($selectedResumeId) && isset($resumeData[$selectedResumeId])) {
                              $selectedResume = $resumeData[$selectedResumeId];
                          }
                    }
                ?>
                <div class="job-detail">
                    <div class="detail">
                        <?php include 'job-alert-modal.php'; ?>
                        <!-- Modal -->
                        <div class="modal fade" id="jobAlertModal" tabindex="-1" aria-labelledby="jobAlertModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="jobAlertModalLabel">
                                            I want to receive the latest job alert for <?= $title ?> in
                                            <?= (isset($tbl_city4) ? $tbl_city4 . ', ' : '') ?><?= (isset($statename) ? $statename . ', ' : '') ?>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
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
                                    $chkAplyPost = $ac->myapplyJobs($_SESSION['pid'], $postId);
                                    if ($_SESSION['guet_yes'] != 'yes') {
                                        if ($chkAplyPost != false) { ?>
                        <a href="javascript:void(0);" class="apply-btn" disabled><button class="apply-btn">
                                Already Applied
                            </button></a><?php
                                        }
                                    }
                                }
                            } else { ?>
                        <a href="javascript:openModel('Notabussiness', <?php echo $postId;?>);"
                            class="apply-btn"><button class="apply-btn">
                                APPLY NOW
                            </button></a>
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
                    </div>
                    </form>
                    <?php include("job-details.php"); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End #main -->
<!-- Current Location Modal End -->
<!-- Model End Change Location -->
<!-- Job details model -->
<!-- Modal -->
<div id="fwdjob" class="modal fade change-location-modal" role="dialog">
    <div class="modal-dialog sharestorepos">
        <!-- Modal content-->
        <div class="modal-content no-radius">
            <form method="post" action="sendEmail.php" id="frd_frm">
                <input type="hidden" value="<?php echo $BaseUrl . '/job-board/job-detail.php?postid=' . $postId; ?>"
                    id="txtlink" name="txtlink" />
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
                            <?php
                            }
                            } ?>
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
<div id="flagPost" class="modal fade change-location-modal" role="dialog">
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
                        <label><input type="radio" name="why_flag" value="Duplicate post" checked="">Duplicate
                            post</label>
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
                    <textarea class="form-control" name="flag_desc" id="flag_desc"
                        placeholder="Add Comments"></textarea>

                    <span id="fdesc_err" style="color: red;"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModel('flagPost');">Cancel</button>
                    <button type="button" id="flag_sub1" onclick="flag_sub()"
                        style="color: white ; background-color: #7649B3;" class="btn btn-primary" value="Flag Now">Flag
                        Now</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Apply Now -->
<div class="space-lg"></div>
<div id="Notabussiness" class="modal fade change-location-modal" role="dialog">
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
<?php
    include_once("../views/common/footer.php");
    ?>
</div>
<?php
    include_once("../views/common/share-modal.php");
    ?>
<div class="ajax-load text-center" style="display:none">
    <p><img src="<?php echo $BaseUrl; ?>/job-board/assets/images/loader.gif">Loading More Jobs</p>
</div>
<!-- Edit Cover Letter Modal -->
<!-- Edit Cover Letter Modal -->
<div class="modal fade" id="editCoverLetterModal" tabindex="-1" aria-labelledby="editCoverLetterModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editCoverLetterModalLabel">Edit Cover Letter</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editCoverForm">
          <!-- Hidden input to store cover letter ID -->
          <input type="hidden" id="editCoverletterId" name="coverletter_id">
          <input type="hidden" name="uid" value="<?php echo htmlspecialchars($_SESSION['uid']); ?>">
          <input type="hidden" name="pid" value="<?php echo htmlspecialchars($_SESSION['pid']); ?>">
          <!-- Title input -->
          <div class="mb-3">
            <label for="editModalTitle" class="form-label">Cover Letter Title</label>
            <input type="text" class="form-control" id="editModalTitle" name="title" required>
          </div>
          
          <!-- Content textarea -->
          <div class="mb-3">
            <label for="editModalContent" class="form-label">Cover Letter Content</label>
            <textarea class="form-control" id="editModalContent" rows="6" name="coverletter" required></textarea>
          </div>
          <button id="updateButton" class="btn btn-primary">Update</button>
       
        </form>
      </div>
    </div>
  </div> 
</div>



<!----------------------->
<div id="cover-letter-success" class="modal fade change-location-modal" role="dialog" aria-modal="true" >
    <div class="modal-dialog" style="text-align: center;">
       
        <div class="modal-content no-radius sharestorepos bradius-10">
            <div class="modal-header br_radius_top bg-white">

            </div>
            <div class="modal-body nobusinessProfile">
                <h1><i class="fa fa-check" style="color:green;" aria-hidden="true"></i></h1>
                <h2>Cover letter saved successfully!</h2>
            </div>
        </div>
        <div class="modal-footer br_radius_bottom bg-white">
            
        </div>
    </div>

</div>
<!----------------------->

<script src="<?php echo $BaseUrl; ?>/assets/emoji/vanillaEmojiPicker.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/quill/quill.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/posting/timeline.js?v=<?php echo $versions;?>"></script>
<!-- Job Details code -->
<script type="text/javascript">
// Job Details code
function printContent(el) {
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
}

function flags() {
    document.getElementById('flags').innerText = 'you have already flagged this post from another profile';
}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js" charset="utf-8"></script>
<script type="text/javascript">
$(document).ready(function() {
    $(".mySelect").select2();
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
    // }kk
    // });kkkkk
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
    // }kk
    // });kk
}

function openModel(action, id) {
    if (action == 'fwdjob') {
        $('#postid').val(id);
        $('#txtlink').val('<?php echo $BaseUrl . "/job-board/job-detail.php?postid=";?>' + id);
    } else if (action == 'flagPost') {
        $('#spPosting_idspPosting').val(id);
    }
    $('#' + action).modal('show');
}

function closeModel(action) {
    $('#' + action).modal('hide');
}
</script>
<!--Job Details code End -->

<!-- leftside -->
<script type="text/javascript">
function jopapp() {
    var idspPostingMedia1 = $("#idspPostingMedia").val();
    if (idspPostingMedia1 == undefined)
        idspPostingMedia = '';

    if (idspPostingMedia == "" && $('#upload').get(0).files.length === 0) {

        if (idspPostingMedia1 == undefined) {
            $("#res_err").text("Please Upload resume.");
        } else {
            $("#res_err").text("Please Upload resume OR Select Resume.");
        }

        return false;
    } else {
        $("#sub_resume").submit();
    }
}
$('#idspPostingMedia').on('change', function() {
    var value = this.value;
    if (value == '') {
        $('#resume_view_seciton').hide();
    } else {
        var resume_data = $('#resume_data').val();

        var resume_Data = $.parseJSON(resume_data);
        const disp = ['png', 'gif', 'jpeg', 'jpg', 'bmp'];
        if ($.inArray(resume_Data[value].sppostingmediaExtension, disp)) {
            $('#resume_view').hide();
            $('#resume_download').hide();
            $("#resume_download a").attr("href", resume_Data[value].spPostingMedia);
        } else {

            $('#resume_view').show();
            $('#resume_download').hide();
            $("#resume_view img").attr("src", resume_Data[value].spPostingMedia);
        }
        $('#resume_view_seciton').show();
    }
});
</script>
<!-- thi script for dropdown cover lwtter form insert and update  -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js"
    integrity="sha512-Z8CqofpIcnJN80feS2uccz+pXWgZzeKxDsDNMD/dJ6997/LSRY+W4NmEt9acwR+Gt9OHN0kkI1CTianCwoqcjQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.4.2/mammoth.browser.min.js"></script>
<script>


</script>
<!-- coverletter pdf upload from model box -->
<script>
    
function addUniqueQueryParam(url, newParams) {
    // Parse the existing URL
    const urlObj = new URL(url);
    const searchParams = new URLSearchParams(urlObj.search);

    // Iterate over the new parameters and add them if they don't exist
    for (const [key, value] of Object.entries(newParams)) {
        // Check if the query parameter already exists
        if (!searchParams.has(key)) {
            // If the parameter is not present, add it
            searchParams.append(key, value);
        }
        if (searchParams.has(key)) {
            searchParams.append(key, value);
        }
    }

    // Update the URL with the new query parameters
    urlObj.search = searchParams.toString();

    // Return the updated URL
    return urlObj.toString();
}

$(document).ready(function() {
    setupCharacterLimit("#editModalTitle", '50', 'alphanumeric') ;
    setupCharacterLimit("#inputContent", '2000', 'alphanumeric') ;
    // Initialize Quill Editor
    const quill = new Quill('#editor', {
        theme: 'snow'
    });

    // Handle PDF upload and display in modal
    $('#upload').change(function() {
        var fileInput = $('#upload')[0].files[0];
        if (fileInput) {
            var fileName = fileInput.name.replace(/\.[^/.]+$/, ''); // Extract file name without extension
            var reader = new FileReader();
            reader.onload = function(e) {
                var fileType = fileInput.type;

                if (fileType === 'application/pdf') {
                    var typedArray = new Uint8Array(e.target.result);

                    // Load PDF.js
                    pdfjsLib.getDocument(typedArray).promise.then(function(pdf) {
                        pdf.getPage(1).then(function(page) {
                            page.getTextContent().then(function(textContent) {
                                var text = textContent.items.map(item => item.str).join(' ');

                                // Set file name in the input field and content in the Quill editor
                                $('#pdf-title-input').val(fileName);
                                quill.setText(text); // Set Quill editor content

                                // Show the modal
                                $('#pdfModal').modal('show');
                            });
                        });
                    });
                } else if (fileType === 'application/msword' || fileType === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                    // Handle DOC and DOCX files
                    var docText = '';
                    mammoth.extractRawText({ arrayBuffer: e.target.result })
                        .then(function(result) {
                            docText = result.value;

                            // Set file name in the input field and content in the Quill editor
                            $('#pdf-title-input').val(fileName);
                            quill.setText(docText); // Set Quill editor content

                            // Show the modal
                            $('#pdfModal').modal('show');
                        })
                        .catch(function(err) {
                            console.error('Error extracting text from DOC/DOCX file:', err);
                        });
                }
            };
            reader.readAsArrayBuffer(fileInput);
        }
    });

    // Handle the submit button click
    $('#submitPdf').click(function(e) {
        e.preventDefault(); // Prevent default form submission

        // Sync Quill content to the hidden textarea
        $('#pdf-content').val(quill.root.innerHTML);

        // Prepare the form data
        var formData = {
            uid: $('input[name="uid"]').val(),
            pid: $('input[name="pid"]').val(),
            pdfTitle: $('#pdf-title-input').val(),
            pdfContent: $('#pdf-content').val()
        };
 
        // Send the data via AJAX
        $.ajax({
            type: 'POST',
            url: 'coverlettermodel.php',
            data: formData,
            success: function(response) {
                // Handle the response from the server
                var url = addUniqueQueryParam(window.location.href, {'new' : 'yes'});
                window.location.href = url;
            },
            error: function(xhr, status, error) {
                // Handle any errors that occur
                alert('An error occurred: ' + error);
            }
        });

        return false; // Prevent form from submitting the traditional way
    });
});

</script>
<!-- endcoverletter pdf upload from model box -->

<script>
$(document).ready(function() {
    <?php if( isset($_SESSION['cover_title_save_message']) ){ ?>
        $('#cover-letter-success').modal('show');
        <?php unset($_SESSION['cover_title_save_message']); ?>
    <?php } ?>
    $('#updateButton').on('click', function(e) {
        e.preventDefault(); // Prevent the default form submission
        // Create FormData object from the form
        var formData = new FormData($('#editCoverForm')[0]);

        $.ajax({
            type: 'POST',
            url: 'coverletterform.php',
            data: formData,
            contentType: false, // Important for FormData
            processData: false, // Important for FormData
            success: function(response) {
                // Handle the response from the server
                alert('Cover letter updated successfully!');
                // Optionally reload or redirect
                // location.reload();
                var url = addUniqueQueryParam(window.location.href, {'new' : $("#editCoverletterId").val()});
                window.location.href = url;
            },
            error: function(xhr, status, error) {
                // Handle any errors that occur
                alert('An error occurred: ' + error);
            }
        });
    });
});

</script>
<script>
function skipThisPage(){
    var formData = {
        uid: $('input[name="uid"]').val(),
        pid: $('input[name="pid"]').val(),
        title: $('#inputTitle').val(),
        coverletter: $('#inputContent').val(),
        coverletter_id: $('#coverletter_id').val(),
        postid: '<?= $_REQUEST['postid'] ?>'
    };
    window.location.href = 'apply&preview.php?' + $.param({
        uid: formData.uid,
        pid: formData.pid,
        title: formData.title,
        coverletter: formData.coverletter <?php if(isset($_REQUEST['pre_post_id'])) {  ?>,
        pre_post_id : '<?= $_REQUEST['pre_post_id'] ?>' <?php }  ?>
    });
}
$(document).ready(function() {
    var coverletter_id = "<?= $_SESSION['coverletter_id']; ?>";
    if(coverletter_id > 0){
        $('#coverletterSelect').val(coverletter_id);
        var selectedOption =  $('#coverletterSelect').find('option:selected');
        var title = selectedOption.data('title');
        var coverletter = selectedOption.data('coverletter');
        var id = selectedOption.val(); // Ensure you're getting the value of the selected option

        // Update the cover-wrapper section
        $('#coverTitle').text(title);
        $('#coverContent').text(coverletter);

        // Update the form fields
        $('#inputTitle').val(title); // Populate the title input
        $('#inputContent').val(coverletter); // Populate the cover letter textarea

        // Set the data-id correctly
        $('#editIcon').attr('data-id', id);
        $('#coverletter_id').val(id); // Populate the hidden input field
    }
    // Handle dropdown change to populate form fields
    $('#coverletterSelect').on('change', function() {
        var selectedOption = $(this).find('option:selected');
        var title = selectedOption.data('title');
        var coverletter = selectedOption.data('coverletter');
        var id = selectedOption.val(); // Ensure you're getting the value of the selected option

        // Update the cover-wrapper section
        $('#coverTitle').text(title);
        $('#coverContent').text(coverletter);

        // Update the form fields
        $('#inputTitle').val(title); // Populate the title input
        $('#inputContent').val(coverletter); // Populate the cover letter textarea

        // Set the data-id correctly
        $('#editIcon').attr('data-id', id);
        $('#coverletter_id').val(id); // Populate the hidden input field
    });

    // Handle the edit icon click to open the edit modal
    $('#editIcon').on('click', function() {
        // Assuming the title and content are displayed in #coverTitle and #coverContent
        var title = $('#coverTitle').text(); // Get the current cover letter title
        var coverletter = $('#coverContent').text(); // Get the current cover letter content
        var id = $(this).attr('data-id'); // Get the ID of the cover letter from the edit icon

        // Populate the modal form fields with the existing cover letter data
        $('#editModalTitle').val(title); // Set the modal's title input field
        $('#editModalContent').val(coverletter); // Set the modal's cover letter content textarea
        $('#editCoverletterId').val(id); // Store the ID in a hidden input field

        // Show the modal
        $('#editCoverLetterModal').modal('show');
    });

    // Handle the save button click to submit the form
$(document).ready(function() {
    // Handle the save button click
    $('#saveButton').on('click', function(e) {
        e.preventDefault(); // Prevent the default form submission

        var formData = {
            uid: $('input[name="uid"]').val(),
            pid: $('input[name="pid"]').val(),
            title: $('#inputTitle').val(),
            coverletter: $('#inputContent').val(),
            coverletter_id: $('#coverletter_id').val(),
            postid: '<?= $_REQUEST['postid'] ?>' <?php if(isset($_REQUEST['pre_post_id'])) {  ?>,
                            pre_post_id : '<?= $_REQUEST['pre_post_id'] ?>' 
                        <?php }  ?>
        };

        var checkboxChecked = $('input[type="checkbox"]').is(':checked');
        if (checkboxChecked) {
            // Submit the form data to coverletterform.php via AJAX
            $.ajax({
                type: 'POST',
                url: 'coverletterform.php',
                data: formData,
                success: function(response) {
                    // Handle the response from the server
                    alert('Cover letter saved successfully!');
                    // Redirect to apply&preview.php with form data
                    window.location.href = 'apply&preview.php?' + $.param({
                        uid: formData.uid,
                        pid: formData.pid,
                        title: formData.title,
                        coverletter: formData.coverletter <?php if(isset($_REQUEST['pre_post_id'])) {  ?>,
                            pre_post_id : '<?= $_REQUEST['pre_post_id'] ?>' 
                        <?php }  ?>
                    });
                },
                error: function(xhr, status, error) {
                    // Handle any errors that occur
                    alert('An error occurred: ' + error);
                }
            });
        } else {
            // Redirect to apply&preview.php with form data directly
            var queryString = $.param(formData);
            window.location.href = 'apply&preview.php?' + queryString;
        }
    });
});


});

</script>
<!--  job apply script    -->


<!-- left side end -->
</body>

</html>
<?php
}
?>