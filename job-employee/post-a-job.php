<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
//require_once('../common.php');
include('../univ/baseurl.php');

session_start();
// var_dump($_SESSION['jobData']);
// die();
include "check_job_employee.php";
if (!isset($_SESSION['uid'])) {
$_SESSION['afterlogin'] = "job-employee/";
include_once("../authentication/check.php");
} else {
function sp_autoloader($class)
{
include '../mlayer/'. $class .'.class.php';
}

spl_autoload_register("sp_autoloader");

$user_data = new _spuser;

$user_data = $user_data->getuserphonenumber($_SESSION['uid']);
$user_data = mysqli_fetch_assoc($user_data);
    // var_dump($user_data);
    // die();
$_GET["categoryid"] = "2";
$_GET["categoryName"] = "Job Board";
$postId = isset($_REQUEST['postId']) ? (int)$_REQUEST['postId'] : 0;
$p = new _jobpostings;

$res = $p->singletimelines($postId);
$uid = $_SESSION['uid'];
$pid = $_SESSION['pid'];
$page = "jobBoard";
$jobPostingCity = 0;
$jobPostingState = 0;
// unset($_SESSION['jobData']);
if($res){
    $pre_data = mysqli_fetch_assoc($res);
    if($pre_data['spPostingsCity']){
       $jobPostingCity = $pre_data['spPostingsCity'];
    }
    if($pre_data['spPostingsState']){
       $jobPostingState = $pre_data['spPostingsState'];
    }
    // echo "<pre>";print_r($pre_data);
    // exit;
}else{
    if(isset($_SESSION['jobData']) && $_SERVER["REQUEST_METHOD"] != "POST"){
        $_POST = $_SESSION['jobData'];
        $jobPostingCity = $_POST['spPostingsCity'];
        $jobPostingState = $_POST['spPostingsState'];
        $pre_data = [
            'spPostingTitle' => $_POST['title'],
            'spPostingNotes' => str_replace(["value='","'"], '', $_POST['description']),
            'spPostingSkill' => $_POST['skill'],
            'spCategories_idspCategory' => $_POST['spCategoryId'],
            'spPostingLocation' => $_POST['location'], // Fixed the variable name
            'spPostingJobType' => $_POST['jobtype'], 
            'salary' => $_POST['salary'], //no columan 
            'job_currency' => $_POST['currency'], 
            'spPostingNoofposition' => $_POST['noposition'], 
            'spPostingsCountry' => $_POST['spPostingsCountry'],     
            'spPostingsState' => $_POST['spPostingsState'],
            'spPostingsCity' => $_POST['spPostingsCity'],
            'spPostingSlryRngFrm' => $_POST['salary_from'],
            'spPostingSlryRngTo' => $_POST['salary_to'],    
            'spPostingExperience' => $_POST['experience'],
            'spPostingClosing' => $_POST['closingdate'],
            'eligible' => $_POST['eligible'],
            'relocate' => $_POST['relocate'],
            'desiresalary' => $_POST['desiresalary'],
            'startwork' => $_POST['startwork'],        
            'spPostingDate' =>date('Y-m-d H:i:s'),
            'spPostingExpDt' => date('Y-m-d',strtotime('+1 Month')),
            'spPostingCustomQuestion' => (
                array_key_exists('custom_question_title', $_SESSION['jobData']) 
                ?
                    json_encode(
                        [
                            'custom_question_title' => $_SESSION['jobData']['custom_question_title'] ,
                            'custom_question_type'=> $_SESSION['jobData']['custom_question_type']
                        ]
                    )
                :
                null
                )
        ];
    }
}
    // echo "<pre>";print_r($_SESSION['jobData']); exit;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];
    $jobData = $_POST;
    // Validate each field individually
    $requiredFields = [
        'title' => 'Job Title',
        'description' => 'Description',
        'skill' => 'Skills',
        'salary_from' => 'Salary From',
        'salary_to' => 'Salary To',
        'closingdate' => 'Closing Date',
    ];

    foreach ($requiredFields as $field => $label) {
        if (empty(trim($_POST[$field]))) {
            $errors[$field] = $label . ' is required.';
        }
    }

    // Additional validations
    if (isset($_POST['salary_from']) && isset($_POST['salary_to']) && ($_POST['salary_from'] > $_POST['salary_to'])) {
        $errors['salary_from'] = 'Salary From must be less than or equal to Salary To.';
    }

    // Validate description
    if (empty(trim($_POST['description']))) {
        $errors['description'] = 'Description is required.';
    }
    
    if(!empty(trim($_POST['description'])) && strlen($_POST['description']) < 120){
        $errors['description'] = 'Description should be between 120 - 6500 characters';
    }
    
    // Handle errors or proceed with form processing
    if (empty($errors)) {
        // Save data to session for preview
        // Remove skills with more than 20 characters
        $jobData['skill'] = implode(',', array_filter(explode(',', $jobData['skill']), function($skill) {
            return strlen($skill) <= 20;
        }));
        // Ensure job title does not exceed 100 characters
        if (strlen($jobData['title']) > 100) {
            $jobData['title'] = substr($jobData['title'], 0, 100);
        }
        
         // Get country, state, city names based on IDs
        $jobData['spPostingsCountry'] = $_POST['spUserCountry'];
        $jobData['spPostingsState'] = $_POST['spProfilesState'];
        $jobData['spPostingsCity'] = isset($_POST['spProfilesCity']) ?  $_POST['spProfilesCity'] : $_POST['spUserCity'] ;
        $_SESSION['jobData'] = $jobData;
        // echo "<pre>"; print_r($jobData);die();
        // Redirect to preview.php
        header("Location: preview.php");
        exit();
    }
}else{
    if(isset($_SESSION['jobData'])){
        $jobData = $_SESSION['jobData'];
    }
}
	
?>

<?php include_once("../views/common/header.php"); ?>
<?php $job_seeker_nav = 'post-a-job'; ?>
<style>
    #editor-wrapper {
        position: relative;
        resize: none; /* Will be handled manually */
        min-height: 200px;
        max-height: 1000px;
        height: 300px;
        width: 100%;
        border: 1px solid #ccc;
        overflow: hidden;
    }

    #editor-container {
        height: 100%;
    }

    .resizer {
        position: absolute;
        right: 0;
        bottom: 0;
        width: 15px;
        height: 15px;
        background: #ccc;
        cursor: se-resize;
        z-index: 10;
    }

    .autocomplete-items {
        border: 1px solid #d4d4d4;
        max-height: 150px;
        overflow-y: auto;
    }
    small{
        color:grey !important;
        display: inline-block;
        width: 100%;
        text-align: right;
    }
    .autocomplete-item {
        padding: 10px;
        cursor: pointer;
    }
    #spCategoryId{
        text-transform: uppercase;
    }
    .autocomplete-item:hover {
        background-color: #e9e9e9;
    }

    .skills-selected {
        display: flex;
        flex-wrap: wrap;
    }

    .skill {
        background-color: #f1f1f1;
        padding: 5px 10px;
        margin: 5px;
        border-radius: 5px;
        display: flex;
        align-items: center;
    }

    .remove-skill {
        margin-left: 10px;
        cursor: pointer;
        color: red;
    }

    </style>
    <style>
    .quill-editor {
        border: 1px solid #ccc;
        padding: 10px;
    }
    /* Style adjustments for the Quill editor container */
    /* #editor-container {
        width: 100%; 
        height: 200px; 
        border: 1px solid #ddd;
        padding: 10px;
        box-sizing: border-box;
    } */

    /* Style adjustments for the textarea */
    #pdf-content {
        width: 100%;
        height: 100%;
        border: none; /* Remove default border if you don't need it */
        box-sizing: border-box; /* Ensures padding is included in total width and height */
    }
    button.btn.btn-sm.btn-danger.custom_question_delete {
        width: 15px;
        height: 15px;
        font-size: 8px;
        padding: 0px;
        margin: 0px;
    }
    .theme_button{
        background-color: #7649b3;
        color: white;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 5px;
    } 
</style>
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
                    <?php echo isset($_REQUEST['postId']) ? "Edit" : "Post" ?>  a Job
                </div>
                <?php if(isset($pre_data)){ ?>
                    <form data-parsley-validate class="post-a-job" method="post" action="post-a-job.php<?php echo isset($_REQUEST['postId']) ? "?postId=".$_REQUEST['postId'] : "" ?>" id='post_a_job_form'>
                        <?php if(isset($pre_data)){ ?>
                            <input type="hidden" name="idspPostings" value="<?= $pre_data['idspPostings'] ?>">
                        <?php } ?>
                        <div class="input-group in-1-col">
                            <label>Job Title<span style="color: #EF1D26;">*</span></label>
                            <input required="" type="text" name="title" placeholder="Enter Job Title" <?php echo ( isset($pre_data) ? "value='".$pre_data['spPostingTitle']."'" : '' ) ?>>
                            <small id="titleCharCount">100 characters remaining</small>
                            <?php if (isset($errors['title'])): ?>
                                <div class="error-message" style="color: #EF1D26;">
                                    <?php echo htmlspecialchars($errors['title']); ?>
                                </div>
                            <?php endif; ?>               
                        </div>
                        <div class="input-group in-1-col desc">
                            <label>Description<span style="color: #EF1D26;">*</span></label>
                            <textarea 
                             required
                                data-parsley-trigger="keyup focusin focusout"
                                data-parsley-minlength="120"
                                data-parsley-maxlength="600"
                                data-parsley-minlength-message="Please enter at least 120 characters."
                                data-parsley-maxlength-message="Maximum 600 characters allowed." 
                                id="pdf-content" name="description" style="display: none;"><?php echo isset($pre_data) ? str_replace(["value='value'","value=\"value\""], '', $pre_data['spPostingNotes']) : ''; ?></textarea>
                            <!-- <div id="editor-container">
                                <?php echo ( isset($pre_data) ? $pre_data['spPostingNotes'] : '' ) ?>
                            </div> -->

                            <div id="editor-wrapper">
                                <div id="editor-container"><?php echo isset($pre_data) ? str_replace(["value='","'"], '', $pre_data['spPostingNotes']) : '' ?></div>
                                <div class="resizer"></div>
                            </div>
                            <?php if (isset($errors['description'])): ?>
                                <div class="error-message" style="color: #EF1D26;">
                                    <?php echo htmlspecialchars($errors['description']); ?>
                                </div>
                            <?php endif; ?>     
                        </div>
                        <small id="char-counter">6500 characters remaining</small>
                        <div class="input-group in-1-col skills">
                            <label>Skills <span style="color: #EF1D26;">*(Please add at least 5)</span></label>
                            <input type="text" id="skillInput" placeholder="Enter Search Skills">
                            <small id="charCount" class='w-100'>20 characters remaining</small>
                            <?php if (isset($errors['skill'])): ?>
                            <div class="error-message" style="color: #EF1D26;">
                            <?php echo htmlspecialchars($errors['skill']); ?>
                            </div>
                            <?php endif; ?>   

                            <!-- This hidden input will hold the selected skills for form submission -->
                            <input type="hidden" name="skill" id="skillData" value="<?php if(isset($pre_data)){ echo $pre_data['spPostingSkill']; } ?>">

                            <!-- Display selected skills here -->
                            <div class="skills-selected" id="selectedSkills">
                                <!------------->
                                <?php if(isset($pre_data)){ ?>
                                    <?php foreach(explode(',',$pre_data['spPostingSkill']) as $pre_skill){ ?>
                                        <div class="skill">
                                            <?= $pre_skill ?> 
                                            <span class="remove-skill">
                                                <img src="./images/mini-cross.svg" alt="">
                                            </span>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                                <!------------->
                            </div>
                        </div>
                        <?php
                        // var_dump($jobData);
                        ?>
                        <div class="input-group in-3-col">
                        <label>Job Category<span style="color: #EF1D26;">*</span></label>
                        <select class="form-select" aria-label="Default select example" name="spCategoryId" id="spCategoryId">
                            <option value="" selected>Select Job Category</option>
                            <?php
                            $co = new _subcategory;
                            $result3 = $co->read(2);
                            if ($result3 != false) {
                                while ($row3 = mysqli_fetch_assoc($result3)) {
                                    $selected = '';
                                    if (isset($jobData['spCategoryId']) && $jobData['spCategoryId'] == $row3['idsubCategory']) {
                                        $selected = 'selected';
                                    }
                                    if (isset($pre_data['idsubCategory']) && $pre_data['idsubCategory'] == $row3['idsubCategory']) {
                                        $selected = 'selected'; 
                                    }
                                    ?>
                                    <option value="<?php echo $row3['idsubCategory']; ?>" <?php echo $selected; ?>>
                                        <?php echo $row3['subCategoryTitle']; ?>
                                    </option>
                                    <?php
                                }
                            }
                            ?>
                        </select>

                        <!-- Hidden field to store the selected category name -->
                       <?php
                            $selectedCategoryName = '';
                            if (!empty($jobData['spCategoryId'])) {
                                $co = new _subcategory;
                                $categoryResult = $co->read(2); // Or a method to get just one category by ID
                                if ($categoryResult) {
                                    while ($row = mysqli_fetch_assoc($categoryResult)) {
                                        if ($row['idsubCategory'] == $jobData['spCategoryId']) {
                                            $selectedCategoryName = $row['subCategoryTitle'];
                                            break;
                                        }
                                    }
                                }
                            }
                            ?>
                            <input type="hidden" name="spCategoryName" id="spCategoryName" value="<?= htmlspecialchars($selectedCategoryName) ?>">
                    </div>


                        <div class="input-group in-3-col">
                            <label>Job Location<span style="color: #EF1D26;">*</span></label>
                            <select class="form-select" aria-label="Default select example" name="location" value="<?php echo isset($jobData['location']) ? htmlspecialchars($jobData['location']) : ''; ?>">
                                <option value=''>Select Job Location</option>
                                <option value="REMOTE" <?php echo ( isset($pre_data)&&$pre_data['spPostingLocation']=='REMOTE' ? "selected" : '' ) ?> >REMOTE</option>
                                <option value="ON SITE" <?php echo ( isset($pre_data)&&$pre_data['spPostingLocation']=='ON SITE' ? "selected" : '' ) ?>>ON SITE</option>
                                <option value="HYBRID" <?php echo ( isset($pre_data)&&$pre_data['spPostingLocation']=='HYBRID' ? "selected" : '' ) ?>>HYBRID</option>
                        
                        </select>
                        </div>
                        <div class="input-group in-3-col">
                            <label>Job Type<span style="color: #EF1D26;">*</span></label>
                            <select class="form-select" aria-label="Default select example" name="jobtype" value="<?php echo isset($jobData['jobtype']) ? htmlspecialchars($jobData['jobtype']) : ''; ?>">
                                <option selected>Select Job Type</option>
                                <option value="Full-time" <?php echo ( isset($pre_data)&&$pre_data['spPostingJobType']=='Full-time' ? "selected" : '' ) ?>>Full-time</option>
                                <option value="Part-time" <?php echo ( isset($pre_data)&&$pre_data['spPostingJobType']=='Part-time' ? "selected" : '' ) ?>>Part-time</option>
                                <option value="Contract" <?php echo ( isset($pre_data)&&$pre_data['spPostingJobType']=='Contract' ? "selected" : '' ) ?>>Contract</option>
                                <option value="Temporary" <?php echo ( isset($pre_data)&&$pre_data['spPostingJobType']=='Temporary' ? "selected" : '' ) ?>>Temporary</option>
                                <option value="Internship" <?php echo ( isset($pre_data)&&$pre_data['spPostingJobType']=='Internship' ? "selected" : '' ) ?>>Internship</option>
                            </select>
                        </div>  
                        <div class="input-group in-3-col">
                            <label>Salary Type<span style="color: #EF1D26;">*</span></label>
                            <select class="form-select" aria-label="Default select example" name="salary" value="<?php echo isset($jobData['salary']) ? htmlspecialchars($jobData['salary']) : ''; ?>">
                                <option selected>Select Salary Type</option>   
                                <option value="Hourly" <?php echo ( isset($pre_data)&&$pre_data['salary']=='Hourly' ? "selected" : '' ) ?>>Hourly</option>
                                <option value="Project Based" <?php echo ( isset($pre_data)&&$pre_data['salary']=='Project Based' ? "selected" : '' ) ?>>Project Based</option>
                                <option value="Monthly" <?php echo ( isset($pre_data)&&$pre_data['salary']=='Monthly' ? "selected" : '' ) ?>>Monthly</option>
                                <option value="Yearly" <?php echo ( isset($pre_data)&&$pre_data['salary']=='Yearly' ? "selected" : '' ) ?>>Yearly</option>
                            </select>
                        </div>
                        <div class="input-group in-3-col">
                        
                                <label for="currency">Currency:</label>
                                <select id="currency" name="currency" class="form-control"  name="currency" value="<?php echo ( isset($pre_data) ? $pre_data['job_currency'] : '' ) ?>">
                                    <option value="">Loading currencies...</option>
                                </select>
                        </div>
                        <div class="input-group in-3-col">
                            <label>No. of Position<span style="color: #EF1D26;">*</span></label>
                            <input type='number' name='noposition' class='form-control' <?php echo ( isset($pre_data) ? "value='".$pre_data['spPostingNoofposition']."'" : '' ) ?> >
                        </div>


                    
                        <div class="input-group in-3-col">
                        <label for="spProfilesCountry">Country</label>
                        <select id="spUserCountry_default_address" class="form-control spUserCountry " name="spUserCountry"


                            <?php if(isset($jobData['spUserCountry'])){ ?>
                                value="<?php echo isset($jobData['spUserCountry']) ? htmlspecialchars($jobData['spUserCountry']) : ''; ?>"
                            <?php }else{ ?>
                                value="<?php echo $user_data['spUserCountry']; ?>"
                            <?php } ?>
                            
                            >
                            <option value="0">Select Country</option>
                            <?php
                            $co = new _country;
                            $result3 = $co->readCountry();
                            if($result3 != false){
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                ?>
                                <option value='<?php echo $row3['country_id']; ?>'
                                    <?php echo (isset($_SESSION["Countryfilter"]) && $_SESSION["Countryfilter"]  == $row3['country_id']) ? 'selected' : ''; ?>>
                                    <?php echo $row3['country_title']; ?></option>
                            <?php
                            } 
                        }
                        ?>
                        </select>
                          
                            <span id="shippcounrty_error" style="color:red;"></span>
                          
                        </div>
                        <div class="loadUserState input-group in-3-col">
                            <?php
                            $state = new _state;
                            $stateResult = $state->readStateName($user_data['spUserState']);
                            $st = mysqli_fetch_assoc($stateResult);
                            
                            
                            ?>
                            <label for="spUserState">State3</label>
                            <select class="form-select" name="spUserState" id="spUserState">
                                value="<?php  echo isset($jobData['spUserState']) ? htmlspecialchars($jobData['spUserState']) : $st['state_title'] ?>"
                                <option value="0">Select State</option>
                                <?php 
                                if (isset($userstate) && $userstate > 0) {
                                    $pr = new _state;
                                    $result2 = $pr->readState($usercountry);
                                    if($result2 != false){
                                        while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                                            <option value='<?php echo $row2["state_id"];?>' <?php echo (isset($userstate) && $userstate == $row2["state_id"] ) ? 'selected' : ''; ?>>
                                                <?php echo $row2["state_title"];?>
                                            </option>
                                        <?php
                                        }
                                    }
                                }
                                ?>
                            </select>
                            <span id="shippsstate_error" style="color:red;"></span> 
                        </div>

                        <div class="JobloadCity input-group in-3-col">
                                
                         <?php
                        
                            $city = new _city;
                            $cityResult = $city->readCityName($user_data['spUserCity']);
                            $ct = mysqli_fetch_assoc($cityResult);
                            // print_r($pre_data);
                            ?>

                            <label for="spUserCity">City</label>
                            <select class="form-select" name="spUserCity" id="spUserCity"  value="<?php echo isset($jobData['spUserCity']) ? htmlspecialchars($jobData['spUserCity']) : $ct['city_title']; ?>">
                                <option value="">Select City</option>
                                <?php 
                                    if ((isset($usercity) && $usercity > 0) || (isset($jobPostingCity) && $jobPostingCity > 0)) {
                                        $co = new _city;
                                        $result3 = $co->readCity($jobPostingState);
                                        if($result3 != false) {
                                            while ($row3 = mysqli_fetch_assoc($result3)) { 
                                                $selected = '';
                                                if (isset($usercity) && $usercity == $row3['city_id']) {
                                                    $selected = 'selected';
                                                }
                                                if ((isset($pre_data['spPostingsCity']) && $pre_data['spPostingsCity'] == $row3['city_id'] ) || isset($jobPostingCity) && $jobPostingCity == $row3['city_id']  ) {
                                                    $selected = 'selected'; 
                                                }
                                            ?>
                                            <option value='<?php echo $row3['city_id']; ?>'
                                                <?php echo $selected; ?>>
                                                <?php echo $row3['city_title'];?></option> <?php
                                            }
                                        }
                                    } 
                                ?>
                            </select>
                            <span id="shippcity_error" style="color:red;"></span>
                        </div>

                        <div class="input-group in-3-col">
                            <label>Salary Range($)<span style="color: #EF1D26;">*</span></label>
                            <div class="range" style="display:flex;gap:8px;align-items:center;flex-wrap:nowrap;">
                                <?php if (isset($errors['salary_from'])): ?>
                                    <div class="error-message" style="color: #EF1D26;margin-right:6px;">
                                        <?php echo htmlspecialchars($errors['salary_from']); ?>
                                    </div>
                                <?php endif; ?>
                                <input type="number" name="salary_from" placeholder="From" style="margin:0;padding:8px;width:120px;box-sizing:border-box;" <?php echo ( isset($pre_data) ? "value='".$pre_data['spPostingSlryRngFrm']."'" : '' ) ?>>
                                <span style="margin:0 6px;">-</span>
                                <?php if (isset($errors['salary_to'])): ?>
                                    <div class="error-message" style="color: #EF1D26;margin-left:6px;">
                                        <?php echo htmlspecialchars($errors['salary_to']); ?>
                                    </div>
                                <?php endif; ?>
                                <input type="number" name="salary_to" placeholder="To" style="margin:0;padding:8px;width:120px;box-sizing:border-box;" <?php echo ( isset($pre_data) ? "value='".$pre_data['spPostingSlryRngTo']."'" : '' ) ?>>
                            </div>
                        </div>
                        <div class="input-group in-3-col">
                            <label>Minimum Experience(Years)<span style="color: #EF1D26;">*</span></label>
                            <input type='number' min='0' class="form-control" name="experience" <?php echo ( isset($pre_data) ? "value='".$pre_data['spPostingExperience']."'" : '' ) ?>>
                        </div>
                        <div class="input-group in-3-col">
                            <label>Closing Date</label>
                            <input type="date" placeholder="Enter Job Title" name="closingdate" <?php echo ( isset($pre_data) ? "value='".$pre_data['spPostingClosing']."'" : '' ) ?>>
                        <?php if (isset($errors['closingdate'])): ?>
                                <div class="error-message" style="color: #EF1D26;">
                                    <?php echo htmlspecialchars($errors['closingdate']); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        
                        <div class="check-box-heading">
                            Questions for mandatory Answers
                        </div>
                        <div style='width:100%;margin-bottom:15px;'>
                        <button type='button' class='theme_button' data-bs-toggle="modal" data-bs-target="#myModal">Create Custom Question</button>
                        </div>
                        <!------------->
                        <div class="modal" id="myModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Create Custom Question</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        
                                            <div class="mb-3 mt-3">
                                                <label for="email" class="form-label">Type:</label>
                                                <select class="form-control" id='custom_question_type'>
                                                    <option>Yes/No</option>
                                                    <option>Short Answer</option>
                                                    <option>Long Answer</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="pwd" class="form-label">Question :</label>
                                                <input type="text" class="form-control" id="custom_question_title" placeholder="Type your question here" name="pswd">
                                                <small id="customQuestionCharCount">100 characters remaining</small>
                                                <script>
                                                    document.getElementById('custom_question_title').addEventListener('input', function() {
                                                        const maxChars = 100;
                                                        const remaining = maxChars - this.value.length;
                                                        if (this.value.length > maxChars) {
                                                            this.value = this.value.substring(0, maxChars);
                                                        }
                                                        document.getElementById('customQuestionCharCount').textContent = remaining + " characters remaining";
                                                    });
                                                </script>
                                            </div>
                                    
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="theme_button" onclick='addCustomQuestion()'>Add Question</button>
                                        <button type="button" class="theme_button" data-bs-dismiss="modal">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!------------>
                        <br>
                        
                        <ol class='custom_question_list w-100'>
                            <?php if(isset($pre_data) && $pre_data['spPostingCustomQuestion']!=null){ ?>
                                <?php $pre_spPostingCustomQuestion = json_decode($pre_data['spPostingCustomQuestion'],true); 

                                // echo "<pre>"; print_r($pre_spPostingCustomQuestion);die();
                                foreach($pre_spPostingCustomQuestion['custom_question_title'] as $key=>$value){
                                    if($pre_spPostingCustomQuestion['custom_question_type'][$key] == 'Yes/No'){ 
                                    ?>

                                    <li>
                                        <div class="mb-3 mt-3">
                                            <label class="form-label"><?= $value ?>
                                                <input type="hidden" form="post_a_job_form" value="<?= $value ?>" name="custom_question_title[]">
                                                <input type="hidden" form="post_a_job_form" value="Yes/No" name="custom_question_type[]">
                                            </label>
                                          
                                        </div>
                                        <button class="btn btn-sm btn-danger custom_question_delete" type="button">x</button>
                                    </li>
                                    <?php }elseif($pre_spPostingCustomQuestion['custom_question_type'][$key] == 'Short Answer'){ 
                                    ?>
                                   <li>
                                        <div class="mb-3 mt-3 d-flex align-items-center justify-content-start">
                                            <div class="flex-grow-1">
                                                <label class="form-label mb-0">
                                                    <?= $value ?>
                                                    <input type="hidden" form="post_a_job_form" value="<?= $value ?>" name="custom_question_title[]">
                                                    <input type="hidden" form="post_a_job_form" value="Short Answer" name="custom_question_type[]">
                                                </label>
                                            </div>
                                            <button class="btn btn-sm btn-danger custom_question_delete ms-2" type="button">x</button>
                                        </div>
                                    </li>

                                    <?php }else if($pre_spPostingCustomQuestion['custom_question_type'][$key] == 'Long Answer'){ ?>
                                       <li>
                                        <div class="mb-3 mt-3 d-flex align-items-start justify-content-between">
                                            <div class="flex-grow-1 me-2">
                                                <label class="form-label mb-1"><?= $value ?>
                                                    <input type="hidden" form="post_a_job_form" value="<?= $value ?>" name="custom_question_title[]">
                                                    <input type="hidden" form="post_a_job_form" value="Long Answer" name="custom_question_type[]">
                                                </label>
                                                <textarea class="form-control mt-1" placeholder="Write your answer here" name="email"></textarea>
                                            </div>
                                            <button class="btn btn-sm btn-danger custom_question_delete" type="button">x</button>
                                        </div>
                                    </li>

                                    <?php  } ?>
                                <?php  } ?>
                            <?php } ?>
                        </ol>
                        <input type="hidden" id="spCountryName" name="spCountryName" value="<?php echo isset($jobData['spCountryName']) ? htmlspecialchars($jobData['spCountryName']) : ''; ?>">
                        <input type="hidden" id="stateName" name="stateName" value="<?php echo isset($jobData['stateName']) ? htmlspecialchars($jobData['stateName']) : ''; ?>">
                        <input type="hidden" id="cityName" name="cityName" value="<?php echo isset($jobData['cityName']) ? htmlspecialchars($jobData['cityName']) : ''; ?>">
                        <div class="main-btn">
                            <!--button>SAVE AS DRAFT</button-->
                            <button type="button" class="prim" id="previewBtn">PREVIEW</button>
                           
                        </div>
                    </form>
                <?php }else{ ?>
                    <form class="post-a-job" method="post" action="post-a-job.php" id='post_a_job_form'>
                        <div class="input-group in-1-col">
                            <label>Job Title<span style="color: #EF1D26;">*</span></label>
                            <input type="text" name="title" placeholder="Enter Job Title" value="<?php echo isset($jobData['title']) ? htmlspecialchars($jobData['title']) : ''; ?>" <?php ( isset($pre_data) ? "value='".$pre_data['spPostingTitle']."'" : '' ) ?>>
                            <small id="titleCharCount">100 characters remaining</small>
                        <?php if (isset($errors['title'])): ?>
                                <div class="error-message" style="color: #EF1D26;">
                                    <?php echo htmlspecialchars($errors['title']); ?>
                                </div>
                            <?php endif; ?>               
                        </div>
                        <div class="input-group in-1-col desc">
                            <label>Description<span style="color: #EF1D26;">*</span></label>
                            <!-- <textarea id="pdf-content" name="description" style="display: none;"><?php echo isset($jobData['description']) ? htmlspecialchars($jobData['description']) : ''; ?></textarea>
                            <div id="editor-container">
                        
                            </div> -->
                             <textarea  id="pdf-content" name="description" style="display: none;"><?php echo isset($jobData) ? str_replace(["value='value'","value=\"value\""], '', $jobData['description']) : ''; ?></textarea>
                            <!-- <div id="editor-container">
                                <?php // echo ( isset($jobData) ? $jobData['description'] : '' ) ?>
                            </div> -->

                            <div id="editor-wrapper">
                                <div id="editor-container"><?php echo isset($jobData) ? str_replace(["value='","'"], '', $jobData['description']) : '' ?></div>
                                <div class="resizer"></div>
                            </div>
                            <?php if (isset($errors['description'])): ?>
                            <div class="error-message" style="color: #EF1D26;">
                            <?php echo htmlspecialchars($errors['description']); ?>
                            </div>
                            <?php endif; ?>     
                        </div>
                        <small id="char-counter">6500 characters remaining</small>
                        <div class="input-group in-1-col skills">
                            <label>Skills <span style="color: #EF1D26;">*(Please add at least 5)</span></label>
                            <input type="text" id="skillInput" placeholder="Enter Search Skills">
                            <small id="charCount"  class='w-100'>20 characters remaining</small>
                            <?php if (isset($errors['skill'])): ?>
                            <div class="error-message" style="color: #EF1D26;">
                            <?php echo htmlspecialchars($errors['skill']); ?>
                            </div>
                            <?php endif; ?>   

                            <!-- This hidden input will hold the selected skills for form submission -->
                            <input type="hidden" name="skill" id="skillData" value="<?php echo isset($jobData['skill']) ? htmlspecialchars($jobData['skill']) : ''; ?>">

                            <!-- Display selected skills here -->
                            <div class="skills-selected" id="selectedSkills">
                            <!-- Dynamically populated skills will appear here -->
                            </div>
                            </div>
                            
                                <div class="input-group in-3-col">
                                <label>Job Category<span style="color: #EF1D26;">*</span></label>
                                <select class="form-select" aria-label="Default select example" name="spCategoryId" id="spCategoryId">
                                    <option value="" selected>Select Job Category</option>
                                    <?php
                                        $co = new _subcategory;
                                        $result3 = $co->read(2);
                                        if ($result3 != false) {
                                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                    ?>
                                    <option value='<?php echo $row3['idsubCategory']; ?>'
                                        >
                                        <?php echo $row3['subCategoryTitle']; ?>
                                    </option>
                                    <?php
                                            }
                                        }
                                    ?>
                                </select>
                                
                                <!-- Hidden field to store the selected category name -->
                                <input type="hidden" name="spCategoryName" id="spCategoryName">
                            </div>

                            <div class="input-group in-3-col">
                                <label>Job Location<span style="color: #EF1D26;">*</span></label>
                                <select class="form-select" aria-label="Default select example" name="location" value="<?php echo isset($jobData['location']) ? htmlspecialchars($jobData['location']) : ''; ?>">
                                    <option value=''>Select Job Location</option>
                                    <option value="REMOTE" <?php echo ( isset($pre_data)&&$pre_data['spPostingLocation']=='REMOTE' ? "selected" : '' ) ?> >REMOTE</option>
                                    <option value="ON SITE" <?php echo ( isset($pre_data)&&$pre_data['spPostingLocation']=='ON SITE' ? "selected" : '' ) ?>>ON SITE</option>
                                    <option value="HYBRID" <?php echo ( isset($pre_data)&&$pre_data['spPostingLocation']=='HYBRID' ? "selected" : '' ) ?>>HYBRID</option>                            
                                </select>
                            </div>
                            <div class="input-group in-3-col">
                                <label>Job Type<span style="color: #EF1D26;">*</span></label>
                                <select class="form-select" aria-label="Default select example" name="jobtype" value="<?php echo isset($jobData['jobtype']) ? htmlspecialchars($jobData['jobtype']) : ''; ?>">
                                    <option selected>Select Job Type</option>
                                    <option value="Full-time">Full-time</option>
                                    <option value="Part-time">Part-time</option>
                                    <option value="Contract">Contract</option>
                                    <option value="Temporary">Temporary</option>
                                    <option value="Internship">Internship</option>
                                </select>
                            </div>
                            <div class="input-group in-3-col">
                                <label>Salary Type<span style="color: #EF1D26;">*</span></label>
                                <select class="form-select" aria-label="Default select example" name="salary" value="<?php echo isset($jobData['salary']) ? htmlspecialchars($jobData['salary']) : ''; ?>">
                                    <option selected>Select Salary Type</option>   
                                    <option value="Hourly">Hourly</option>
                                    <option value="Project Based">Project Based</option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Yearly">Yearly</option>
                                </select>
                            </div>
                            <div class="input-group in-3-col">
                            <!--  <label>Currency<span style="color: #EF1D26;">*</span></label>
                                <select class="form-select" aria-label="Default select example" name="currency" value="<?php echo isset($jobData['currency']) ? htmlspecialchars($jobData['currency']) : ''; ?>">
                                    <option selected>Select Currency</option>-->
                                    <label for="currency">Currency:</label>
                                    <select id="currency" name="currency" class="form-control"  name="currency" value="<?php echo isset($jobData['currency']) ? htmlspecialchars($jobData['currency']) : ''; ?>">
                                        <option value="">Loading currencies...</option>
                                    </select>
                            </div>
                            <div class="input-group in-3-col">
                                <label>No. of Position<span style="color: #EF1D26;">*</span></label>
                                <input type='number' name='noposition' class='form-control'>
                            </div>
                                <div class="input-group in-3-col">
                                <label for="spProfilesCountry">Country</label>
                                <select id="spUserCountry_default_address" class="form-control spUserCountry" name="spUserCountry"
                                    name="country"   value="<?php echo isset($jobData['spPostingsCountry']) ? htmlspecialchars($jobData['spPostingsCountry']) : ''; ?>">
                                    <option value="0">Select Country</option>
                                    <?php
                                    $co = new _country;
                                    $result3 = $co->readCountry();
                                    if($result3 != false){
                                    while ($row3 = mysqli_fetch_assoc($result3)) {
                                        ?>
                                    <option value='<?php echo $row3['country_id'];?>'
                                        <?php echo (isset($usercountry) && $usercountry == $row3['country_id'])?'selected':''; ?>>
                                        <?php echo $row3['country_title'];?>
                                    </option>
                                    <?php
                                    } 
                                }
                                ?>
                                </select>
                                <span id="shippcounrty_error" style="color:red;"></span>
                                <!-- <input type="text" list="suggested_address" class="form-control" name="address"  id="address" onkeyup="getaddress();" value="<?php //echo $address_city;?>"  >
                            <datalist id="suggested_address"></datalist> 
                                <input type="hidden" name="latitude" id="latitude">
                                <input type="hidden" name="longitude" id="longitude">-->
                            </div>
                            
                       <div class="loadUserState input-group in-3-col">
                        <label for="spUserState">State</label>
                        <select class="form-select" name="spUserState" id="spUserState">
                            <option value="0">Select State</option>
                            <?php 
                            $selectedState = isset($_SESSION['jobData']['spPostingsState']) ? $_SESSION['jobData']['spPostingsState'] : (isset($userstate) ? $userstate : 0);

                            if (isset($userstate) && $userstate > 0 || $selectedState > 0) {
                                $pr = new _state;
                                $result2 = $pr->readState($usercountry);
                                if($result2 != false){
                                    while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                                        <option value='<?php echo $row2["state_id"];?>' 
                                            <?php echo ($selectedState == $row2["state_id"]) ? 'selected' : ''; ?>>
                                            <?php echo $row2["state_title"];?>
                                        </option>
                                    <?php
                                    }
                                }
                            }
                            ?>
                        </select>
                            <span id="shippsstate_error" style="color:red;"></span> 
                        </div>

                        <div class="loadCity input-group in-3-col">
                            <label for="spUserCity">City</label>
                            <select class="form-select" name="spUserCity" id="spUserCity" name="city" value="<?php echo isset($jobData['city']) ? htmlspecialchars($jobData['city']) : ''; ?>">
                                <option value="0">Select City</option>
                                <?php 
                                    if (isset($usercity) && $usercity > 0) {
                                        $co = new _city;
                                        $result3 = $co->readCity($userstate);
                                        if($result3 != false) {
                                            while ($row3 = mysqli_fetch_assoc($result3)) { ?>
                                <option value='<?php echo $row3['city_title']; ?>'
                                    <?php echo (isset($usercity) && $usercity == $row3['city_id'])?'selected':''; ?>>
                                    <?php echo $row3['city_title'];?></option> <?php
                                            }
                                        }
                                    } 
                                ?>
                            </select>
                            <span id="shippcity_error" style="color:red;"></span>
                        </div>

                        <div class="input-group in-3-col">
                            <label>Salary Range($)<span style="color: #EF1D26;">*</span></label>
                            <div class="range" style="display:flex;gap:0;align-items:center;flex-wrap:nowrap;">
                                <?php if (isset($errors['salary_from'])): ?>
                                    <div class="error-message" style="color: #EF1D26;margin-right:6px;">
                                        <?php echo htmlspecialchars($errors['salary_from']); ?>
                                    </div>
                                <?php endif; ?>
                                <input type="number" name="salary_from" placeholder="From" style="margin:0;padding:8px;width:120px;box-sizing:border-box;" value="<?php echo isset($jobData['salary_from']) ? htmlspecialchars($jobData['salary_from']) : ''; ?>">
                                <span style="margin:0 6px;">-</span>
                                <?php if (isset($errors['salary_to'])): ?>
                                    <div class="error-message" style="color: #EF1D26;margin-left:6px;">
                                        <?php echo htmlspecialchars($errors['salary_to']); ?>
                                    </div>
                                <?php endif; ?>
                                <input type="number" name="salary_to" placeholder="To" style="margin:0;padding:8px;width:120px;box-sizing:border-box;" value="<?php echo isset($jobData['salary_to']) ? htmlspecialchars($jobData['salary_to']) : ''; ?>">
                            </div>
                        </div>
                        <div class="input-group in-3-col">
                            <label>Minimum Experience(Years)<span style="color: #EF1D26;">*</span></label>
                            <input type='number' min='0' class="form-control" name="experience">
                        </div>
                        <div class="input-group in-3-col">
                            <label>Closing Date</label>
                            <input type="date" placeholder="Enter Job Title" name="closingdate" value="<?php echo isset($jobData['closingdate']) ? htmlspecialchars($jobData['closingdate']) : ''; ?>">
                        <?php if (isset($errors['closingdate'])): ?>
                                <div class="error-message" style="color: #EF1D26;">
                                    <?php echo htmlspecialchars($errors['closingdate']); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        
                        <div class="check-box-heading">
                            Questions for mandatory Answers
                        </div>
                        <div style='width:100%;margin-bottom:15px;'>
                        <button type='button' class='theme_button' data-bs-toggle="modal" data-bs-target="#myModal">Create Custom Questions</button>
                        </div>
                        <!------------->
                        <div class="modal" id="myModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Create Custom Questions</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        
                                            <div class="mb-3 mt-3">
                                                <label for="email" class="form-label">Type:</label>
                                                <select class="form-control" id='custom_question_type'>
                                                    <option>Yes/No</option>
                                                    <option>Short Answer</option>
                                                    <option>Long Answer</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="pwd" class="form-label">Question :</label>
                                                <input type="text" class="form-control" id="custom_question_title" placeholder="Type your question here" name="pswd" maxlength="100">
                                                <small id="customQuestionCharCount">100 characters remaining</small>
                                                <script>
                                                    document.getElementById('custom_question_title').addEventListener('input', function() {
                                                        const maxChars = 100;
                                                        if (this.value.length > maxChars) {
                                                            this.value = this.value.substring(0, maxChars);
                                                        }
                                                        const remaining = maxChars - this.value.length;
                                                        
                                                        document.getElementById('customQuestionCharCount').textContent = remaining + " characters remaining";
                                                    });
                                                </script>
                                            </div>
                                    
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="theme_button" onclick='addCustomQuestion()'>Add Question</button>
                                        <button type="button" class="theme_button" data-bs-dismiss="modal">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!------------>
                        <br>
                        
                        <ol class='custom_question_list w-100'>
                            
                        </ol>
                        <input type="hidden" id="spCountryName" name="spCountryName">
                        <input type="hidden" id="stateName" name="stateName">
                        <input type="hidden" id="cityName" name="cityName">
                        <div class="main-btn">
                            <!--button>SAVE AS DRAFT</button-->
                            <button type="submit" class="prim">PREVIEW</button>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</div>

<?php include "../views/common/footer.php"; ?>

<script src="<?php echo $BaseUrl; ?>/assets/quill/quill.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('.post-a-job').parsley();

        $(".spUserCountry").on("change", function (event) {
            // alert('===1');
            var countryId = this.value;
            $.post("loadUserState.php", {
                countryId: countryId,
                stateId: "<?= $user_data['spUserState'] ?>",
            }, function (r) {
                // alert(r);
                $(".loadUserState").html(r);
            });
            if (event && event.originalEvent) {
                $("#spUserCity").html('');
            }
        });
        

        
        //==========ON CHANGE LOAD CITY==========
                // $(document).on("change", "#spProfilesState", function () {
                //     var state = this.value;
                //     $.post("loadUserCity.php", {
                //         state: state,
                //     }, function (r) {
                //         // alert(r);
                //         $(".loadCity").html(r);
                //     });
                // });
        //==========ON CHANGE LOAD CITY==========

        // Job Details code
        function flags() {
            document.getElementById('flags').innerText = 'you have already flagged this post from another profile';
        }


    </script>

<script>

    setupCharacterLimit('[name=salary_from]',7,'numeric',false);
    setupCharacterLimit('[name=salary_to]',7,'numeric',false);
    setupCharacterLimit('[name=experience]',3,'numeric',false);
    setupCharacterLimit('[name=noposition]',3,'numeric',false);
    
    function addCustomQuestion(){
        var type = $('#custom_question_type').val();
        if(type=='Yes/No'){
            $(".custom_question_list").append('<li><label>'+$('#custom_question_title').val()+'<input type="hidden" value="'+$('#custom_question_title').val()+'" form="post_a_job_form" name="custom_question_title[]"><input type="hidden" form="post_a_job_form" value="'+$('#custom_question_type').val()+'" name="custom_question_type[]"></labe><div class="form-check form-check-inline" style="margin-left:5px;"></div><button class="btn btn-sm btn-danger custom_question_delete" type="button">x</button></li>');
        }else if(type=='Short Answer'){
            $(".custom_question_list").append(
                '<li>' +
                    '<div class="mb-3 mt-3 d-flex align-items-center justify-content-start">' +
                        '<label class="form-label mb-0">' + $('#custom_question_title').val() + '</label>' +
                        '<input type="hidden" form="post_a_job_form" value="' + $('#custom_question_title').val() + '" name="custom_question_title[]">' +
                        '<input type="hidden" form="post_a_job_form" value="' + $('#custom_question_type').val() + '" name="custom_question_type[]">' +
                        '<button class="btn btn-sm btn-danger custom_question_delete ms-3" type="button">x</button>' +
                    '</div>' +
                '</li>'
            );
        }else if(type=='Long Answer'){
$(".custom_question_list").append(
    '<li>' +
        '<div class="mb-3 mt-3 d-flex align-items-center justify-content-start">' +
            '<label class="form-label mb-0 me-2">' + $('#custom_question_title').val() + '</label>' +
            '<input type="hidden" form="post_a_job_form" value="' + $('#custom_question_title').val() + '" name="custom_question_title[]">' +
            '<input type="hidden" form="post_a_job_form" value="' + $('#custom_question_type').val() + '" name="custom_question_type[]">' +
            '<button class="btn btn-sm btn-danger custom_question_delete ms-3" type="button">x</button>' +
        '</div>' +
    '</li>'
);
        }
        $('#custom_question_title').val('');
        $('#myModal').modal('hide');
    }
    $(document).ready(function() {
        $(document).on('click', '.custom_question_delete' , function() {
            $(this).closest('li').remove();
        });

        //==========Handle the my address section of profile update module =======
        $("#spUserCountry_default_address").on("change", function() {
            const val = $("#spUserCountry_default_address option:selected").text().trim();
            $("#spCountryName").val(val);
            var countryId = this.value;
            $.post("loadUserState.php", {
                countryId: countryId
            }, function(r) {
                $(".loadUserState").html(r);
            });
            var state = 0;
            $.post("loadUserState.php", {
                countryId: countryId
            }).done(function(r) {
                $(".loadUserState").html(r);
                <?php if(isset($pre_data)){ ?>
                    $("#spProfilesState").val("<?= $pre_data['spPostingsState'] ?>");
                    $("#spProfilesState").trigger("change");
                <?php }else{ ?>
                    $("#spProfilesState").val("<?= $user_data['spUserState'] ?>");
                    $("#spProfilesState").trigger("change");
                <?php } ?>
            }).fail(function(jqXHR, textStatus, errorThrown) {
                console.error("Error: " + textStatus + ", " + errorThrown);
            });
        });
    
        <?php if(isset($pre_data)){ ?>
            $("#spUserCountry_default_address").val("<?= $pre_data['spPostingsCountry'] ?>");
            $("#spUserCountry_default_address").trigger("change");
        <?php }else{ ?>
            $("#spUserCountry_default_address").val("<?= $user_data['spUserCountry'] ?>");
            $("#spUserCountry_default_address").trigger("change");
        <?php } ?>

        //==========ON CHANGE LOAD CITY==========
        $("#spUserState").change(function() {
            var state = this.value;
            $("#stateName").val($("#spUserState option:selected").text());
            $.post("loadUserCity.php", {
                state: state,
            }).done(function(r) {
                $(".loadCity").html(r);
            }).fail(function(jqXHR, textStatus, errorThrown) {
                console.error("Error: " + textStatus + ", " + errorThrown);
            });
        });

         $('body').on('change', '#spProfilesState', function(event) {
           var state = this.value;
           $("#stateName").val($("#spProfilesState option:selected").text());
           if (event && event.originalEvent) {
                    $.post("loadUserCity.php", {
                        state: state,
                    }).done(function(r) {
                        $(".JobloadCity").html(r);
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        console.error("Error: " + textStatus + ", " + errorThrown);
                    });
            }
        });
         $("#spUserCity").change(function() {
             var selectedCityName = $("#spUserCity option:selected").text().trim();
             $("#cityName").val(selectedCityName);
         })

        setTimeout(() => {
            var selectedCityName = $("#spUserCity option:selected").text().trim();
            if(selectedCityName && selectedCityName!="Select City"){
                $("#cityName").val(selectedCityName);
            }
        }, 500);
        
        $(document).on("change", "#spProfilesCity", function(event){
           setTimeout(() => {
                var selectedCityName = $("#spProfilesCity option:selected").text();
                $("#cityName").val(selectedCityName);
           }, 300);
        });
        // Use delegated event binding so events fire for dynamically loaded/replaced elements
        $(document).on("change", "#spUserCity", function(event){
            setTimeout(() => {
                var selectedCityName = $("#spUserCity option:selected").text().trim();
                $("#cityName").val(selectedCityName);
           }, 300);
        });
    });
</script>


<script src="https://dev.thesharepage.com/assets/css/country/js/intlTelInput.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPpH4FGQaj_JIJOViHAeHGAjl7RDeW8OQ&libraries=places"></script>
<script>
    var input = document.querySelector("#companyPhoneNo_");
    if(input){
        window.intlTelInput(input, {
            preferredCountries: ['us', 'ca'],
            separateDialCode: true,
            utilsScript: "https://dev.thesharepage.com/assets/css/country/js/utils.js",
        });
    }
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $("#businesscategory_").select2({
        placeholder: "Select a programming language",
        allowClear: true
    });
</script>
<script src="<?php echo $BaseUrl; ?>/assets/quill/quill.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/posting/timeline.js?v=<?php echo $versions;?>"></script>
<script src="<?php echo $BaseUrl; ?>/job-board/assets/js/script.js?v=<?php echo $versions;?>"></script>


<script>
    $(document).ready(function() {
        $('#skillInput').on('input', function(e) {
            let value = $(this).val();
            let sanitizedValue = value.replace(/[^a-zA-Z0-9, ]/g, ''); // Allow only alphabets, numbers, comma, and space
            if (value !== sanitizedValue) {
                $(this).val(sanitizedValue);
            }
        });
        
        <?php if(isset($pre_data)){ ?>
            let selectedSkills = ["<?php echo implode('","',explode(",",$pre_data['spPostingSkill'])); ?>"];
        <?php }else{ ?>
             selectedSkills = [];
        <?php } ?>

        // Add skill when pressing Enter key or after typing a comma
        $('#skillInput').on('keypress', function(e) {
            if (e.which === 13 || e.which === 44) { // 13 is Enter key, 44 is comma
                e.preventDefault();
                addSkill();
            }
        });

        // Add skill function
        function addSkill() {
            let skill = $('#skillInput').val().trim(); // Get the entered skill
            // Add skill only if it's not empty and not already selected
            if (skill && !selectedSkills.includes(skill)) {
                selectedSkills.push(skill); // Add skill to the array            
                // Update the hidden input field
                $('#skillData').val(selectedSkills.join(','));
                // Append the new skill to the skills-selected div
                $('#selectedSkills').append(
                    `<div class="skill">
                        ${skill} 
                        <span class="remove-skill">
                            <img src="./images/mini-cross.svg" alt="">
                        </span>
                    </div>`
                );
                // Clear the input field
                $('#skillInput').val('');
                $('#charCount').text("20 characters remaining");
            }

            // Handle removal of skills
            $('.remove-skill').off('click').on('click', function() {
                let skillText = $(this).closest('.skill').text().trim();
                selectedSkills = selectedSkills.filter(s => s !== skillText); // Remove from array
                $('#skillData').val(selectedSkills.join(',')); // Update hidden input
                $(this).closest('.skill').remove(); // Remove skill from the display
            });
        }

        // Validation: Ensure at least 5 skills are selected
        $('form').on('submit', function(e) {
            if (selectedSkills.length < 5 || selectedSkills.length > 20) {
                e.preventDefault();
                alert('Please add at least 5 skills and no more than 20 skills.');
            }
        });
    }); 

    $(document).ready(function() {
        // Your API key
        const apiKey = 'YOUR_API_KEY'; 
        // API URL to fetch currencies
        const apiUrl = `https://openexchangerates.org/api/currencies.json?app_id=${apiKey}`;
        // Fetch currencies via AJAX
        $.ajax({
            url: apiUrl,
            method: 'GET',
            success: function(data) {
                // Clear the existing options
                $('#currency').empty();
                
                // Populate dropdown with fetched currencies
                $.each(data, function(code, name) {
                    $('#currency').append($('<option>', {
                        value: code,
                        text: `${name} (${code})`
                    }));
                    
                });
                <?php if(isset($pre_data)){ ?>
                    $('#currency').val('<?= $pre_data['job_currency'] ?>');
                <?php } ?>
            },
            error: function(error) {
                console.log('Error fetching currency data:', error);
                $('#currency').html('<option value="">Failed to load currencies</option>');
            }
        });
    });


    // Make the editor wrapper resizable by dragging the resizer div
        function makeResizable(editorWrapper, resizer) {
            let isResizing = false;

            resizer.addEventListener('mousedown', function(e) {
                isResizing = true;
                document.body.style.userSelect = 'none'; // Prevent text selection
            });

            document.addEventListener('mousemove', function(e) {
                if (!isResizing) return;

                const wrapperRect = editorWrapper.getBoundingClientRect();
                const newHeight = e.clientY - wrapperRect.top;

                // Optional: set limits
                if (newHeight >= 200 && newHeight <= 1000) {
                    editorWrapper.style.height = newHeight + 'px';
                }
            });

            document.addEventListener('mouseup', function() {
                isResizing = false;
                document.body.style.userSelect = ''; // Re-enable text selection
            });
        }
     
    $(document).ready(function() {
        const wrapper = document.getElementById('editor-wrapper');
        const resizer = wrapper.querySelector('.resizer');
        makeResizable(wrapper, resizer);
        // Initialize Quill Editor
        // Maximum character limit
        const maxChars = 6500;
        // Initialize Quill editor
        const quill = new Quill('#editor-container', {
            theme: 'snow',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline'],
                    [{ 'header': 1 }, { 'header': 2 }],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'indent': '-1'}, { 'indent': '+1' }],
                    [{ 'size': ['small', false, 'large', 'huge'] }],
                    
                    [{ 'color': [] }, { 'background': [] }],
                    [{ 'font': [] }]
                ]
            }
        });

        // Function to update the character counter
        function updateCharCounter() {
            // Get text content from Quill editor
            const text = quill.getText().trim();  // Trim to remove any extra spaces

            // Calculate remaining characters
            const remainingChars = maxChars - text.length;

            // Update character counter display
            const counterElement = document.getElementById('char-counter');
            counterElement.textContent = `${remainingChars} characters remaining`;

            // Check if character limit is exceeded
            if (remainingChars < 0) {
                counterElement.style.color = 'red';  // Change color to red if limit exceeded
            } else {
                counterElement.style.color = 'black';  // Reset color if within limit
            }
        }

        // Listen for text-change event in Quill editor
        quill.on('text-change', function () {
            // Update the character counter each time the content changes
            updateCharCounter();

            // Prevent typing beyond the limit
            const text = quill.getText().trim();
            if (text.length > maxChars) {
                // Remove extra characters if limit exceeded
                quill.deleteText(maxChars, text.length - maxChars);
            }
        });

        // Initial update of the character counter
        updateCharCounter();
        
        // Update the hidden textarea with Quill's content when the form is submitted
        $('form').on('submit', function() {
            const quillContent = quill.root.innerHTML; // Get Quill's content
            console.log(quillContent);
            if(quill.getText().trim().length > 0 ){
                $('#pdf-content').val(quillContent); // Update textarea with Quill's content
            }       
        });

        $("#previewBtn").click(function(){
            const quillContent = quill.root.innerHTML; // Get Quill's content
            const quillHtml = quill.root.innerHTML;

            var pdfContent = document.getElementById('pdf-content');
            if (pdfContent) pdfContent.value = quillHtml;

            // prevent double submit
            var btn = document.getElementById('previewBtn');
            if (btn) btn.disabled = true;

            // submit the form
            var form = document.getElementById('post_a_job_form');
            if (form) {
                form.submit();
            }
        })
    });
</script>
<script>
// Listen to changes in the job category dropdown
document.getElementById('spCategoryId').addEventListener('change', function() {
    // Get the selected option's text (category name)
    var selectedCategoryName = this.options[this.selectedIndex].text;
    // Set the hidden input field with the selected category name
    document.getElementById('spCategoryName').value = selectedCategoryName;
});
	
// Listen to changes in the country dropdown
document.getElementById('spUserCountry_default_address').addEventListener('change', function() {
    // Get the selected option's text (country name)
    var selectedCountryName = this.options[this.selectedIndex].text;
    // Set the hidden input field with the selected country name
    document.getElementById('spCountryName').value = selectedCountryName;
});

// Listen for changes in the state dropdown

// Listen for changes in the state dropdown
document.getElementById('spUserState').addEventListener('change', function() {
    var selectedStateName = this.options[this.selectedIndex].text;
    document.getElementById('stateName').value = selectedStateName;
});


// Listen for changes in the city dropdown
// document.getElementById('spUserCity').addEventListener('change', function() {
//     var selectedCityName = this.options[this.selectedIndex].text;
//     document.getElementById('cityName').value = selectedCityName;
// });


$(document).ready(function() {
    const maxChars = 20;
    $('#skillInput').on('input', function() {
        const remaining = maxChars - $(this).val().length;
        if (remaining < 0) {
            $(this).val($(this).val().substring(0, maxChars));
        }
        $('#charCount').text((remaining >= 0 ? remaining : 0) + " characters remaining");
    }); 

    const maxTitleChars = 100;
    $('input[name="title"]').on('input', function() {
        const remaining = maxTitleChars - $(this).val().length;
        if (remaining < 0) {
            $(this).val($(this).val().substring(0, maxTitleChars));
        }
        $('#titleCharCount').text((remaining >= 0 ? remaining : 0) + " characters remaining");
    });
});
// Add this line where you want to display the remaining characters count
// <div id="titleCharCount">1000 characters remaining</div>
</script>

</html>
<?php } ?>
