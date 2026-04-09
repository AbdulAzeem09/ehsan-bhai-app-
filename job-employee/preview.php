<?php
//require_once('../common.php');
include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['uid'])) {
$_SESSION['afterlogin'] = "job-employee/";
include_once("../authentication/check.php");
} else {

function sp_autoloader($class)
{
include '../mlayer/'. $class .'.class.php';
}
spl_autoload_register("sp_autoloader");

$uid = $_SESSION['uid'];
$pid = $_SESSION['pid'];
$page = "job-emp-preview";

$page = "job-emp-preview";
if (!isset($_SESSION['jobData'])) {
    // Redirect back to the form page if job data is not available
    header("Location: post-a-job.php");
    exit();
	header('Content-Type: application/json');

    // Simulate a successful operation
    $response = array('success' => true);
    echo json_encode($response);
}

$jobData = $_SESSION['jobData']; 
// echo "<pre>";print_r($jobData);exit;
// Retrieve form data
$title = isset($_POST['title']) ? $_POST['title'] : '';
$description = isset($_POST['description']) ? $_POST['description'] : '';
$skills = isset($_POST['skill']) ? $_POST['skill'] : '';
$category = isset($_POST['category']) ? $_POST['category'] : '';
$location = isset($_POST['location']) ? $_POST['location'] : '';
$jobtype = isset($_POST['jobtype']) ? $_POST['jobtype'] : '';
$salary = isset($_POST['salary']) ? $_POST['salary'] : '';
$currency = isset($_POST['currency']) ? $_POST['currency'] : '';
$noposition = isset($_POST['noposition']) ? $_POST['noposition'] : '';
$country = isset($_POST['spUserCountry']) ? $_POST['spUserCountry'] : '';
$state = isset($_POST['spUserState']) ? $_POST['spUserState'] : '';
$cityName = isset($_POST['cityName']) ? $_POST['cityName'] : '';
$stateName = isset($_POST['stateName']) ? $_POST['stateName'] : '';
$spCountryName = isset($_POST['spCountryName']) ? $_POST['spCountryName'] : '';
$salary_from = isset($_POST['salary_from']) ? $_POST['salary_from'] : '';
$salary_to = isset($_POST['salary_to']) ? $_POST['salary_to'] : '';
$experience = isset($_POST['experience']) ? $_POST['experience'] : '';
$closingdate = isset($_POST['closingdate']) ? $_POST['closingdate'] : '';
$eligible = isset($_POST['eligible']) ? $_POST['eligible'] : ''; 
$relocate = isset($_POST['relocate']) ? $_POST['relocate'] : '';
$desiresalary = isset($_POST['desiresalary']) ? $_POST['desiresalary'] : '';
$startwork = isset($_POST['startwork']) ? $_POST['startwork'] : '';

$state_obj = new _state;
$st_res = $state_obj->readStateName($jobData['spProfilesState']);
$st_res = mysqli_fetch_assoc($st_res);

$pr = new _country;
$resCountry = $pr->readCountryName($jobData['spPostingsCountry']);
$countryname = '';
if ($resCountry != false) {
    $getCountry = mysqli_fetch_assoc($resCountry);
    $countryname =	$getCountry['country_title'];
}

?>

<?php $job_seeker_nav = 'post-a-job'; ?>
<?php include_once("../views/common/header.php"); ?>
<link rel="stylesheet" href="./job-employee.css">
<div class="body-wrapper">
    <div class="job-wrapper">
        <div class="job-body-wrapper">
            <?php include "employee-nav.php"; ?>
              <div class="main-body">
              <button style='background: #3e1f48;padding: 6px 10px;border-radius: 4px;' class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                   <img src='../assets/images/menu-icon-2.svg'>
                </button>
                    <div class="main-heading">
                        Preview Job
                    </div>
					 <form class="post-a-job" method="post" id="job-apply-form">
			            <input type="hidden" name="save_type" value="" id='save_type'>
                        <div class="preview-job">
                                <div class="detail">
                                    <div class="title">
                                    <div style="word-wrap: break-word;">
                                        <?php echo htmlspecialchars($jobData['title']); ?>
                                    </div>
                                    </div>
                                    <div class="salary">
                                    <?php echo htmlspecialchars($jobData['salary']); ?>
                                    </div>
                                    <div class="skills-heading">
                                        Skills Required
                                    </div>
                                    <div class="skills-wrapper">
                                    <?php 
                                        // Assuming $jobData['skill'] contains skills separated by commas
                                    $skills = explode(',', $jobData['skill']); // Split the skills by commas
                                        foreach($skills as $skill) {
                                        // Trim whitespace and print each skill inside a div
                                    echo '<div class="skill">' . htmlspecialchars(trim($skill)) . '</div>';
                                }
                                ?>
                                        
                                    </div>
                                    <div class="desc-heading">
                                        Job Description
                                    </div>
                                    <div class="description">
                                        <div style="word-wrap: break-word;">
                                        <?php echo $jobData['description']; ?>
                                        </div>
                                    </div>
                                    <div class="desc-heading">
                                        Custom Screener Questions
                                    </div>
                                    <?php if(array_key_exists('custom_question_title',$jobData)){?>
                                    <?php foreach($jobData['custom_question_title'] as $key=>$row){ ?>
                                        <div class="mb-3 mt-3">
                                            <label for="email" class="form-label"><strong><?= $row ?></strong></label>
                                            <?php if($jobData['custom_question_type'][$key]=='Yes/No') { ?>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" value="Yes">
                                                    <label class="form-check-label" for="inlineRadio1">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" value="No">
                                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                                </div>
                                            <?php }elseif($jobData['custom_question_type'][$key]=='Long Answer') { ?>  
                                                <textarea class="form-control" placeholder="Please type your answer here"></textarea>
                                            <?php }elseif($jobData['custom_question_type'][$key]=='Short Answer') { ?> 
                                                <input type="text" class="form-control" placeholder="Please type your answer here">
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                    <?php }else{ echo 'NA'; } ?>
                                </div>
                                <div class="imp-links">
                                    <div class="link">
                                        <span class="link-img">
                                            <img src="./images/category.svg" alt="">
                                        </span>
                                        <span class="text">
                                            <span class="title">
                                                Category :
                                            </span>
                                            <span class="data">
                                                <?php echo htmlspecialchars($jobData['spCategoryName']); ?>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="link">
                                        <span class="link-img">
                                            <img src="./images/type.svg" alt="">
                                        </span>
                                        <span class="text">
                                            <span class="title">
                                                Type :
                                            </span>
                                            <span class="data">
                                            <?php echo htmlspecialchars($jobData['jobtype']); ?>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="link">
                                        <span class="link-img">
                                            <img src="./images/salary-type.svg" alt="">
                                        </span>
                                        <span class="text">
                                            <span class="title">
                                                Salary Type :
                                            </span>
                                            <span class="data">
                                            <?php echo htmlspecialchars($jobData['salary']); ?>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="link">
                                        <span class="link-img">
                                            <img src="./images/no-of-position.svg" alt="">
                                        </span>
                                        <span class="text">
                                            <span class="title">
                                                No of Position :
                                            </span>
                                            <span class="data">
                                                <?php echo htmlspecialchars($jobData['noposition']); ?>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="link">
                                        <span class="link-img">
                                            <img src="./images/location.svg" alt="">
                                        </span>
                                        <span class="text">
                                            <span class="title">
                                                Location :
                                            </span>
                                            <span class="data">
                                                <?php echo htmlspecialchars($jobData['location']); ?>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="link">
                                        <span class="link-img">
                                            <img src="./images/location.svg" alt="">
                                        </span>
                                        <span class="text">
                                            <span class="title">
                                                City :
                                            </span>
                                            <span class="data">
                                                <?php echo htmlspecialchars($jobData['cityName']); ?>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="link">
                                        <span class="link-img">
                                            <img src="./images/state.svg" alt="">
                                        </span>
                                        <span class="text">
                                            <span class="title">
                                                State :
                                            </span>
                                        
                                            <span class="data">
                                            
                                            <?php echo $st_res['state_title']; ?>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="link">
                                        <span class="link-img">
                                            <img src="./images/state.svg" alt="">
                                        </span>
                                        <span class="text">
                                            <span class="title">
                                                Country :
                                            </span>
                                            <span class="data">
                                                <?php echo htmlspecialchars($countryname); ?>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-job-main-btn">
                                <button type="button" onclick="window.location='post-a-job.php'">BACK</button>
                                <button class="apply-btn save_as_draft_btn" type='submit' name='save_as_draft' value='Save as Draft' onclick="$('#save_type').val('Save as Draf');">Save as Draft</button>
                                <button class="apply-btn add_post" type='submit' name='post_button' value='Post' onclick="$('#save_type').val('POST');">POST</button>
                            </div>
					</form>
                </div>
        </div>
    </div>
</div>

<!-- Bootstrap Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="successModalLabel">Success</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id='success_message_job'>
       <strong><?= $_SESSION['jobData']['title'] ?></strong> Job <?php echo  ( array_key_exists("idspPostings",$_SESSION['jobData']) ? 'updated' : 'posted' ) ?>  successfully!
      </div>
      <div class="modal-footer">
        <a href="<?php echo $BaseUrl; ?>/job-employee/active-jobs.php" class="btn btn-secondary" >Close</button>
     
      </div>
    </div>
  </div>
</div>



<script src="<?php echo $BaseUrl; ?>/assets/css/preview/script.js"></script>
	
    <script src="script.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
		
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
			
<!--  job apply script    -->
<script>
$(document).ready(function() {
    //$('#successModal').modal('show');
    $('#job-apply-form').on('submit', function(event) {
        event.preventDefault(); 

        // Disable the button and change text to indicate submission
       
        if($('#save_type').val()=='Save as Draf'){
            $('.save_as_draft_btn').prop('disabled', true).text('Submitting...');
        }else{
            $('.add_post').prop('disabled', true).text('Submitting...');
        }
        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: 'job-post-form.php',  // Ensure this is the correct URL to your PHP script
            data: formData,
            processData: false,
            contentType: false,
             success: function(response) {
                $('#success_message_job').html(response);
                // Show the Bootstrap modal
                $('#successModal').modal('show');
                
                // Optional: Reload the page if the "Reload" button is clicked
                $('#modalReloadButton').on('click', function() {
                  //  location.reload();
                });
                
                if($('#save_type').val()=='Save as Draf'){
                    $('.save_as_draft_btn').prop('disabled', true).text('Submitted...');
                }else{
                    $('.add_post').prop('disabled', true).text('Submitted...');
                }
            },
            error: function(xhr, status, error) {
                // Handle any errors that occur
                alert('An error occurred: ' + error);
            }
        });
    });
});

</script>

<?php } ?>
