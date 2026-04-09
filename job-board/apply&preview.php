<?php
$page = 'apply&preview'; // Set the page variable

include('../univ/baseurl.php');
include_once("../views/common/header.php");
session_start();

if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "job-board/";
    include_once("../authentication/check.php");
} else {
    if(trim($_SESSION['ptname']) != 'Employment'){
        echo "<script>window.location.href  = '/job-board';</script>";
        exit;
    }

    function sp_autoloader($class)
    {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryid"] = "2";
    $_GET["categoryName"] = "Job Board";

    if( isset($_GET['pre_post_id'])){
        include '../ssp/custom-mysql.php';
        $query = selectQuery('job_apply'," id = ".$_GET['pre_post_id']);
        $pre_post_data = $query->fetch_assoc();    
    }

    $postId = isset($_REQUEST['postid']) ? (int)$_REQUEST['postid'] : 0;
	$p = new _jobpostings;
	$res = $p->singletimelines($postId);
    if ($res) {
        $row = mysqli_fetch_assoc($res);
        $row['spPostingCustomQuestion'] = json_decode($row['spPostingCustomQuestion'],true);
        $spPostingCustomQuestion = $row['spPostingCustomQuestion'];
        //print_r($spPostingCustomQuestion );exit;
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
    //position-relative
    // Debugging line to check the value of $page
    
    // Get data from query parameters
    $coverLetterTitle = isset($_GET['title']) ? htmlspecialchars($_GET['title']) : 'No Title';
    $coverLetterContent = isset($_GET['coverletter'])&& trim($_GET['coverletter']) != '' ? htmlspecialchars($_GET['coverletter']) : 'No Cover Letter';
    $_SESSION['cover_title'] = isset($_GET['title']) ? htmlspecialchars($_GET['title']) : '';
    $_SESSION['cover_description'] = isset($_GET['coverletter'])&& trim($_GET['coverletter']) != '' ? htmlspecialchars($_GET['coverletter']) : '';
    // Check if the cover letter should be saved
    $saveCoverLetter = isset($_GET['save']) && $_GET['save'] == 1;
        
    // Check if a resume is stored in the session
    $resume = isset($_SESSION['uploaded_resume']) ? $_SESSION['uploaded_resume'] : null;
    // Default title if no resume is available
    $title = $resume ? $resume['name'] : ((isset($_SESSION['fileName'])) ? $_SESSION['fileName'] : 'No Resume Title');
?>
  <style>
    .char-count{
        color:grey;
        width:100%;
        display:inline-block;
        text-align:right;
    }
  </style>    

    <div class="body-wrapper">
        <div class="job-wrapper">
         <div class="job-body-wrapper">
               <div class="filters-3">
                  <div class="top-name">
                     Preview Application
                  </div>
                  <button class="add-btn" onclick="window.history.back();">
                     Back
                  </button>
               </div>
               <div class="main-wrapper" style="display: block;">
                  <div class="title-filter">
                <form id="job-apply-form" >
                   
                   <div class="detail-wrapper">
                      <div class="resume-wrapper">
                           <div class="title">Selected Resume</div>
                         <div class="resume">
                            <!--div class="delete-icon">
                                <img src="./images/delete.svg" alt="">
                            </div-->
                           
                            <div class="main-img-wrapper">
                                 <iframe src='https://docs.google.com/viewer?url=<?= $_SESSION['tmp_resume'] ?>&embedded=true' style='width:100%;height:739px'></iframe>                        
                            </div>
                         </div>
                      </div>
                        
                      <div class="cover-wrapper">
                          <div class="title">Cover Letter</div>
                          <div class="cover">
                              <div class="top-detail">
                                  <div class="name"><?php echo $coverLetterTitle; ?></div>
                                  <!--div class="delete-icon">
                                      <img src="./images/edit.svg" alt="">
                                  </div-->
                              </div>
                              <div class="text">
                                  <?php echo nl2br($coverLetterContent); // Convert new lines to <br> ?>
                              </div>
                             </div>
                       </div>

                       <div class="question-wrapper">
                            <?php foreach($spPostingCustomQuestion['custom_question_title'] as $key=>$row){ ?>
                                <div class="check-box in-1-col">
                                    <label class="label-text"><?= ucfirst($row) ?></label>
                                    <?php if($spPostingCustomQuestion['custom_question_type'][$key]=='Yes/No') { ?>
                                        <input  type="radio" name='custom_question_radion' id='custom_question_radion1' value="Yes">
                                        <label class="radio-label" for="custom_question_radion1">Yes</label>
                                    
                                        <input type="radio"  name='custom_question_radion' id='custom_question_radion2' value="No">
                                        <label class="radio-label" for="custom_question_radion2">No</label>
                                       
                                    <?php }elseif($spPostingCustomQuestion['custom_question_type'][$key]=='Long Answer') { ?>  
                                        <textarea class="form-control" name='custom_answers[]' placeholder="Please type your answer here"></textarea>
                                    <?php }elseif($spPostingCustomQuestion['custom_question_type'][$key]=='Short Answer') { ?> 
                                        <input type="text" class="form-control" name='custom_answers[]' placeholder="Please type your answer here">
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <!--div class="check-box in-1-col">
                                <label class="label-text" for="">Are you legally eligible to work in &lt;country&gt;?</label>
                                <div style="margin-top: 5px;">
                                    <input type="radio" id="a" name="eligibility" value="yes">
                                    <label for="a" class="radio-label">Yes</label>
                                </div>
                                <div>
                                    <input type="radio" id="b" name="eligibility" value="no">
                                    <label for="b" class="radio-label">No</label>
                                </div>
                            </div>
                            <div class="check-box in-1-col">
                                <label class="label-text" for="">Do you need to relocate for this work?</label>
                                <div style="margin-top: 5px;">
                                    <input type="radio" id="c" name="relocation" value="yes">
                                    <label for="c" class="radio-label">Yes</label>
                                </div>
                                <div>
                                <input type="radio" id="d" name="relocation" value="no">
                                <label for="d" class="radio-label">No</label>
                                </div>
                            </div-->
                        <div class="input-group in-1-col" style="margin-top: 30px;">
                           <label>Desired Salary</label>
                           <input type="text" placeholder="Enter Desired Salary" name="desired_salary" <?= ( isset($pre_post_data) ? "value='".$pre_post_data['desired_salary']."'" : "" ) ?>>
                       </div>
                       <div class="input-group in-1-col">
                           <label>When can you start</label>
                           <input type="date" name="start_date" placeholder="2024-12-23" <?= ( isset($pre_post_data) ? "value='".$pre_post_data['start_date']."'" : "" ) ?>>
                       </div>
                     </div>
                   </div>

                   <div class="main-btns">
                       <input type="hidden" name="uid" value="<?php echo htmlspecialchars($_SESSION['uid']); ?>">
                       <input type="hidden" name="pid" value="<?php echo htmlspecialchars($_SESSION['pid']); ?>">
                       <input type="hidden" name="spUserEmail" value="<?php echo htmlspecialchars($_SESSION['spUserEmail']); ?>">
                       <input type="hidden" name="spPostCountry" value="<?php echo htmlspecialchars($_SESSION['Countryfilter']); ?>">
                       <input type="hidden" name="spPostState" value="<?php echo htmlspecialchars($_SESSION['Statefilter']); ?>">
                       <input type="hidden" name="myprofile" value="<?php echo htmlspecialchars($_SESSION['myprofile']); ?>">
                       <input type="hidden" name="documentUrl" value="<?php echo htmlspecialchars($_SESSION['documentUrl']);?>">
                       <input type="hidden" name="fileName" value="<?php echo htmlspecialchars($_SESSION['fileName']);?>">
                       <input type="hidden" name="job_id" value="<?php echo htmlspecialchars($postId);?>">
                       <input type="hidden" name="cover_title" id="coverTitleInput" value="">
                       <input type="hidden" name="cover_content" id="coverContentInput" value=""> 
					   <input type="hidden" name="job_title" value="<?php echo htmlspecialchars($_SESSION['title']);?>">
                       <input type="hidden" name="job_overview" value="<?php echo htmlspecialchars($_SESSION['overview']);?>">
                       <input type="hidden" name="clicked_btn" id='clicked_btn' value=''>
                       <?php if( isset($pre_post_data) ){ ?>
                            <input type="hidden" name="pre_post_id" value="<?php echo htmlspecialchars($pre_post_data['id']);?>">
                        <?php } ?>
                       <button class="skip save_to_draft_btn" type="submit" onclick='$("#clicked_btn").val("save_to_draft");'>Save To Draft</button>
                       <button type="submit" onclick='$("#clicked_btn").val("submit");' class="apply-btn">Submit</button>
                   </div>
               </form>

                    </div> 
                </div>
            </div>
        </div>
        </div>

    </div>



<!---------->
    <div id="apply-confermation" class="modal fade change-location-modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content no-radius sharestorepos bradius-10">
                <div class="modal-header br_radius_top bg-white">

                </div>
                <div class="modal-body nobusinessProfile">
                    <div class="alert alert-success">Your application was successfully sent!</div>
                        <p><strong>Keep track of your applications</strong>
                        You will receive a status update whenever there is an update in your application by the employer. If you are short-listed, you will be notified as well. In the meantime, you can view and track all your applications from your dashboard - under Applied Jobs.</p>
                    </div>
                    <div class="modal-footer text-center" style='margin:0px'>
                        <a href='<?= $BaseUrl ?>/job-board' class="add-btn">View Jobs</a>
                        <a href='<?= $BaseUrl ?>/job-seeker/dashboard.php' class="add-btn">Dashboard</a>
                    </div>
                </div> 
            </div> 
            
        </div>
    </div>


    <div id="draft-confermation" class="modal fade change-location-modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content no-radius sharestorepos bradius-10">
                <div class="modal-header br_radius_top bg-white">

                </div>
                <div class="modal-body nobusinessProfile">
                    <div class="alert alert-success">Your application was successfully saved in draft!</div>
                        <p>Your application has been saved as a draft. You can continue and submit it later.</p>
                    </div>
                    <div class="modal-footer text-center" style='margin:0px'>
                        
                        <a href='<?= $BaseUrl ?>/job-seeker/draft-application.php' class="add-btn">View Draft Job</a>
                    </div>
                </div> 
            </div> 
            
        </div>
    </div>


    <div id="already-applied-job" class="modal fade change-location-modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content no-radius sharestorepos bradius-10">
                <div class="modal-header br_radius_top bg-white">

                </div>
                <div class="modal-body nobusinessProfile">
                    <div class="alert alert-warning">You have already applied for this job!</div>
                        <p>You cannot apply for the same job more than once. Please check your applied jobs in your dashboard.</p>
                    </div>
                    <div class="modal-footer text-center" style='margin:0px'>
                        <a href='<?= $BaseUrl ?>/job-seeker/dashboard.php' class="add-btn">View Applied Jobs</a>
                    </div>
                </div> 
            </div> 
            
        </div>
    </div>
<!---------->

    <?php include "../views/common/footer.php"; ?>
    <script src="<?php echo $BaseUrl; ?>/assets/css/preview/script.js"></script>
    <script src="<?php echo $BaseUrl; ?>/assets/js/posting/timeline.js"></script>
        
    <script src="script.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
		
		
<!--  job apply script    -->

<script>
    $(document).ready(function() {
        setupCharacterLimit("[name=desired_salary]", '12', 'numeric',false) ;
        setupCharacterLimit('.form-control', 100, 'alphanumeric');
        
        //$('#apply-confermation').modal('show');
        $('#job-apply-form').on('submit', function(event) {
            event.preventDefault(); 

            if( $('#clicked_btn').val()=='save_to_draft' ){
                $('.save_to_draft_btn').prop('disabled', true).text('Saving to Draft...');
                $('.apply-btn').text('Submitting...');
            }else{
                $('.apply-btn').prop('disabled', true).text('Submitting...');
                $('.save_to_draft_btn').text('Saving to Draft...');
            }
    
            var coverTitle = $('.cover .top-detail .name').text(); 
            var coverContent = $('.cover .text').html(); 

            $('#coverTitleInput').val(coverTitle);
            $('#coverContentInput').val(coverContent);
            var formData = new FormData(this);
            
            $.ajax({ 
                type: 'POST',
                url: 'job-apply-form.php', 
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    response = JSON.parse(response);
                    if(response.status){
                        if( $('#clicked_btn').val()=='save_to_draft' ){
                            $('#draft-confermation').modal('show');
                        }else{
                            $('#apply-confermation').modal('show');
                        }
                    }else{
                            $('#already-applied-job').modal('show');
                    }
                    
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + error);
                    // Re-enable the submit button on error
                    $('.apply-btn').prop('disabled', false).text('Submit');
                }
            });
        });
    });
</script>

</body>

</html>
<?php
}
?>