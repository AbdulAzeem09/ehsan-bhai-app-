<?php
//require_once('../common.php');
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

    if( isset($_GET['pre_post_id'])){
        include '../ssp/custom-mysql.php';
        $query = selectQuery('job_apply'," id = ".$_GET['pre_post_id']);
        $pre_post_data = $query->fetch_assoc();
        $_SESSION['cover_title'] = $pre_post_data['coverletter_title'];
        $_SESSION['coverletter_dec'] = $pre_post_data['coverletter_dec'];
    }
    // Existing code to fetch job posting details...

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
        $jobTypennnn = $row['spPostingJobType'];
        $jobLevel   = $row['spPostingJoblevel'];
        $location   = $row['spPostingsCity'];
        $salaryStrt = $row['spPostingSlryRngTo'];
        $salaryEnd  = $row['spPostingSlryRngFrm'];
        $job_type  = $row['spPostingJobType'];
        $stateuser  = $row['spPostingsState'];
        $stateskill  = $row['spPostingSkill'];
        $jobCategory   = $row['subCategoryTitle'];
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
    //position-relative
    $page = "jobBoard";
    include_once("../views/common/header.php");
?>
<div class="body-wrapper">

    <div class="job-wrapper">
        <div class="job-body-wrapper">
            <div class="filters-3">
                <div class="top-name">
                    Job
                </div>
                <a href="<?php echo $BaseUrl; ?>/job-board/index.php"><button class="add-btn" style="width: 158px;">Back</button></a>
            </div>
            <div class="main-wrapper">
                <!-- Left section start -->
                <div class="resume-detail">
                    <form action="job-coverletter.php" method="get" id="sub_resume" enctype="multipart/form-data">
                        <!--   <form action="process_form.php" method="post" id="sub_resume" enctype="multipart/form-data">                           
						   <div class="filetype" style="font-size: 14px; margin: 0px 0px 5px 10px;">Allowed file types : doc, docx and pdf</div>-->
                        <div class="upload-resume">
                            <input type="file" id="upload" name="resume" accept=".doc, .docx, .pdf" hidden />
                            <label class="upload-resume" for="upload"><img src="<?php echo $BaseUrl; ?>/job-board/assets/images/upload.svg" alt=""> Upload Resume</label>
                        </div>

                        <span id="res_err" style="color: red;"></span>
                        <?php 
                            // $pc = new _postingalbum;
                            // $result = $pc->getProfileResume($_SESSION['pid']);
                            $cl = new _resumeget;
                            $result = $cl->get_sp_resume($_SESSION['pid']); 
                            if ($result->num_rows > 0){
                                $resumeArr = array();
                        ?>
                            <img src="<?php echo $BaseUrl; ?>/job-board/assets/images/or.svg" alt="" class="or">
                            <div class="input-group in-1-col">
                                <select class="form-select" id="idspPostingMedia" name="idspPostingMedia"
                                    aria-label="Default select example">
                                    <option value="">Select Resume</option>
                                    <?php 
                                        if ($result && $result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                // Construct the file name and URL
                                                $fileName = htmlspecialchars($row['fileName']);
                                                $documentUrl = htmlspecialchars($row['documentUrl']);
                                                $resumeUrl = htmlspecialchars($row['resume_url']);
                                                $resumeType = htmlspecialchars(pathinfo($row['fileName'], PATHINFO_EXTENSION));

                                                $resumeArr[$row["id"]]['type'] = $resumeType;
                                                $resumeArr[$row["id"]]['name'] = $fileName;
                                                $resumeArr[$row["id"]]['tmp_resume'] = $resumeUrl;
                                                $resumeArr[$row["id"]]['documentUrl'] = $documentUrl;
                                                
                                                // Generate the <option> tag
                                                echo '<option value="'.htmlspecialchars($row['idResume']).'" data-resume-url="'.$resumeUrl.'" data-resume-type="'.$resumeType.'">'.htmlspecialchars($row['fileName']).'</option>';
                                            }
                                            $_SESSION['resume_data'] = json_encode($resumeArr);
                                        }
                                        ?>
                                </select>
                                <!-- <input type="hidden" name="resume_data" id="resume_data" value='<?php //echo json_encode($resumeArr);?>'> -->
                            </div>
                        <?php } ?>

                        <div class="resume-wrapper" id="resume_view_seciton" style="display: <?= ( isset($pre_post_data) ? "block" : "none" ) ?>;">
                            <div class="top-detail">
                                <img src="<?php echo $BaseUrl; ?>/job-board/assets/images/doc.svg" alt=""
                                    class="doc-wrapper">
                                <div class="name"><?php echo $_SESSION['MyProfileName'];?></div>
                                <div class="name" id="resume_download" style="color:#212529; font-size: 14px;"><a href="<?= ( isset($pre_post_data) ? "src='".$pre_post_data['resume_url']."'" : '' ) ?>" target="_blank">Download</a></div>
                            </div>
                            <div class="main-img-wrapper" id="resume_view">
                                <iframe id="pdf-view"  width='604px' height='739px' frameborder='0' <?= ( isset($pre_post_data) ? "src='".$pre_post_data['resume_url']."'" : '' ) ?>></iframe>
                            </div>
                        </div>

                        <input type="hidden" name="postid" id="upload_postid" value="<?php echo  $_REQUEST["postid"]; ?>">
                        <input type="hidden" name="categoryid" value="2">
                        <input type="hidden" name="clientid" value="<?php echo $clientId; ?>">
                        <input type="hidden" name="activitydate" value="<?php echo date("Y-m-d") ?>">
                        <?php if(isset($_GET['pre_post_id'])){ ?>
                          <input type="hidden" name="pre_post_id" value="<?php echo $_GET['pre_post_id']; ?>">
                          <input type="hidden" id="uploaded_resume" name="uploaded_resume" value="<?php echo $_GET['pre_post_id']; ?>">
                        <?php } ?>
                        <button type="submit" class="upload-resume" style="margin-top: 20px;" onclick="jopapp(event)">
                            Continue
                        </button>
                    </form>
                </div>
                <!-- Left section end -->
                <div class="job-detail">
                    <!-- This Notification  class="notify" for open popop box i want to recived job  -->
                    <div class="detail" id="printArea">
                        <!-- Notification Image -->
                        <?php     include 'job-alert-modal.php';  ?>

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

                    <?php include("job-details.php"); ?>
                    <?php 
                    // Job Details code
                    include("coverletter.php");?>
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
                <h2> Only EMPLOYMENT profile can apply .<br> Please create or switch to your Employment Profile to apply
                    to this job.</h2>
                <!-- <a href="<?php //echo $BaseUrl . '/my-profile'; ?>" class="btn" style = "background: #31abe3!important;">Switch/Create Profile</a> -->
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

<!-- Job Details code -->
<?php
if($jobID != 0)
{
    ?>
<script type="text/javascript">
    $(document).ready(function() {
        $.ajax({
            url: "/job-board/loadJobDetail.php",
            type: "POST",
            data: {
                postid: <?php echo $jobID;?>
                //profileid: ide
            },
            success: function(response) {
                $(".job-detail").html(response);
            }
        });

        $(".job").click(function() {
            jobid = $(this).attr('id');
            $('#post-data div').removeClass('job-active');
            $('#' + jobid).addClass('job-active');
            $.ajax({
                url: "/job-board/loadJobDetail.php",
                type: "POST",
                data: {
                    postid: jobid
                    //profileid: ide
                },
                success: function(response) {
                    $(".job-detail").html(response);
                }
            });
        });
    });
</script>
<?php 
}?>
<script type="text/javascript">
    $(window).scroll(function() {
        /* console.log('start');
        console.log($(window).scrollTop() + $(window).height())
        console.log( $(document).height()-1);
        console.log('start'); */
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 1) {
            var currentPage = $("#currentPage").val();
            if (currentPage != -1) {
                var nextpage = parseInt(currentPage) + 1;
                $("#currentPage").val(nextpage);
            // loadMoreData(nextpage);
            }
        }
    });

    function loadMoreData(currentPage) {
        $.ajax({
                url: 'loadMoreData.php?currentPage=' + currentPage,
                type: "get",
                beforeSend: function() {
                    $('.ajax-load').show();
                }
            })
            .done(function(data) {
                $('.ajax-load').hide();
                if (data == 'NO') {
                    $("#currentPage").val(-1);
                    $("#post-data").append(
                        "<h3 style='text-align: center;padding-top: 16px;min-height: 300px;'>No Job Found!</h3>");

                } else {
                    $("#post-data").append(data);
                }

            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('server not responding...');
            });
    }
</script>
<script src="<?php echo $BaseUrl; ?>/assets/emoji/vanillaEmojiPicker.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/quill/quill.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/posting/timeline.js?v=<?php echo $versions;?>"></script>

<script src="<?php echo $BaseUrl; ?>/job-board/assets/js/script.js?v=<?php echo $versions;?>"></script>

<script type="text/javascript">
    //==========ON CHANGE LOAD CITY==========
    $("#spUserState").on("change", function() {
        var state = this.value;
        $.post("loadUserCityNew.php", {
            state: state
        }, function(r) {
            //alert(r);
            $("#spUserCity").html(r);
        });
    });
    //==========ON CHANGE LOAD CITY==========
</script>

<!-- Job Details code -->
<script type="text/javascript">
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
    // swal({
    // title: "Do you want to Save ?",
    // type: "warning",
    // confirmButtonClass: "sweet_ok",
    // confirmButtonText: "Yes",
    // cancelButtonClass: "sweet_cancel",
    // cancelButtonText: "Cancel",
    // showCancelButton: true,
    // },
    // function(isConfirm) {
    // if (isConfirm) {

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
    // swal({
    // title: "Do you want to Unsave ?",
    // type: "warning",
    // confirmButtonClass: "sweet_ok",
    // confirmButtonText: "Yes",
    // cancelButtonClass: "sweet_cancel",
    // cancelButtonText: "Cancel",
    // showCancelButton: true,
    // },
    // function(isConfirm) {
    // if (isConfirm) {
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js" charset="utf-8"></script>

<!--Job Details code End -->

<!-- leftside -->
<script type="text/javascript">
$(document).on("change", "#upload", function() {
    var file_data = $("#upload").prop("files")[0]; // Getting the properties of file from file field
    value = file_data.name;
    if($("#uploaded_resume")){
        $("#uploaded_resume").val(0);
    }
    if (value == '') {
        $('#resume_view_seciton').hide();
    } else {
        var extension = value.substr((value.lastIndexOf('.') + 1));
        extension = extension.toLowerCase();
        const disp = ['doc', 'docx', 'pdf'];
        if ($.inArray(extension, disp) == -1) {
            $("#res_err").text("Please Upload file type with Document format.");
            return false;
        }

        var form_data = new FormData(); // Creating object of FormData class
        form_data.append("document", file_data) // Appending parameter named file with properties of file_field to form_data
        form_data.append("postid", $('#upload_postid').val()) // Adding extra parameters to form_data
        $.ajax({
            url: "ajaxupload.php", // Upload Script
            dataType: 'script',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data, // Setting the data attribute of ajax with file_data
            type: 'post',
            success: function(data) {
                response = $.parseJSON(data);
                if (response.status === 'success') {
                    // $('#res_err').html('<p>' + response.message + ' File name: ' + response.fileName + '. Access it at: <a href="' + response.url + '" target="_blank">' + response.url + '</a></p>');
                    // Update the iframe source dynamically
                    if (extension == 'pdf') {
                        $('#pdf-view').attr('src', response.url);
                    } else {
                        $('#pdf-view').attr('src', 'https://docs.google.com/viewer?url=' +encodeURIComponent(response.url) + '&embedded=true');
                    }

                    $('#resume_view').show();
                    $("#resume_download").html($('#upload')[0].files[0]['name']);
                    $('#resume_download').show();
                    $('#resume_view_seciton').show();
                } else {
                    $('#res_err').html(response.message);
                }
            }
        });
    }
});

function displayFile() {
    var thefile = document.getElementById('upload');
    var value = thefile.value;

    if (value == '') {
        $('#resume_view_seciton').hide();
    } else {
        var extension = value.substr((value.lastIndexOf('.') + 1));
        extension = extension.toLowerCase();
        const disp = ['doc', 'docx', 'pdf'];
        if ($.inArray(extension, disp) == -1) {
            $("#res_err").text("Please Upload file type with Document format.");
            return false;
        }

        readURL($('#upload')[0], $("#pdf-view"));
        $('#resume_view').show();
        $("#resume_download").html($('#upload')[0].files[0]['name']);
        $('#resume_download').show();
        $('#resume_view_seciton').show();
        //$('#resume_view').html("<iframe src='"+value+"' width='604px' height='739px' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>.</iframe>")

    }
}

function readURL(input, target) {
    input = $(input).get(0);
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            console.log(e.target.result);
            $(target).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
        //$(".details").html("Preview: '" + input.files[0].name + "' Type: " + input.files[0].type);
    }
}

function jopapp(event) {
    event.preventDefault();
    var post_id = "<?= $_REQUEST['postid'] ?? ''?>";
    var uploaded_resume = $("#uploaded_resume").length;
    if(post_id != '' && uploaded_resume != 0){
        //do nothing
    }else if (($("#idspPostingMedia").val() == undefined || $("#idspPostingMedia").val() == '') && $('#upload').get(0).files.length === 0) {
        if ($("#idspPostingMedia").val() == undefined) {
            $("#res_err").text("Please Upload resume.");
        } else {
            $("#res_err").text("Please Upload resume OR Select Resume.");
        }
        return false;
    } else if ($('#upload').get(0).files.length !== 0) {
        var thefile = document.getElementById('upload');
        var value = thefile.value;
        var extension = value.substr((value.lastIndexOf('.') + 1));
        extension = extension.toLowerCase();
        const disp = ['doc', 'docx', 'pdf'];
        if ($.inArray(extension, disp) == -1) {
            $("#res_err").text("Please Upload file type with Document format.");
            return false;
        }
    }
    $("#sub_resume").submit();
}


$('#idspPostingMedia').on('change', function() {
    var value = this.value;
    var url = $(this).find(':selected').data('resume-url');
    var type = $(this).data('resume-type');
    if($("#uploaded_resume")){
        $("#uploaded_resume").val(0);
    }
    if (value == '') {
        $('#resume_view_seciton').hide();
    } else {
        const disp = ['doc', 'docx', 'pdf'];
        if ($.inArray(type, disp)) {
            $('#resume_view').hide();
            $('#resume_download').show();
            $("#resume_download a").attr("href", url);
        } else {
            $('#resume_view').show();
            $('#resume_download').hide();
            $("#resume_view img").attr("src", url);
        }
        $('#resume_view_seciton').show();
    }
});
</script>

<script>
    // function submitResumeForm() {
    //     var formData = new FormData(document.getElementById('sub_resume'));
    //     $.ajax({
    //         url: 'applyform.php',
    //         type: 'POST',
    //         data: formData,
    //         processData: false,
    //         contentType: false,
    //         success: function(response) {
    //             var result = JSON.parse(response);
    //             if (result.status === 'success') {

    //             } else {

    //                 alert(result.message);
    //             }
    //         },
    //         error: function() {
    //             alert('An error occurred while processing the form.');
    //         }
    //     });
    // }
</script>
<script>

</script>
<!-- left side end -->
</body>

</html>
<?php
}
?>