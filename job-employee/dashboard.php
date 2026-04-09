<?php

//require_once('../common.php');
include('../univ/baseurl.php');

session_start();
include "check_job_employee.php";
if (!isset($_SESSION['uid'])) {
    $_SESSION['afterlogin'] = "job-board/";
    include_once("../authentication/check.php");
} else {

    function sp_autoloader($class)
    {
        include '../mlayer/'. $class .'.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryid"] = "2";
    $_GET["categoryName"] = "Job Board";

    //position-relative
    $page = "jobBoard";

    $uid = $_SESSION['uid'];
    $pid = $_SESSION['pid'];
 //   if (isset($_SESSION['ptname'])) {
       // if ($_SESSION['ptname'] == 'Business') {
            //  header("Location: ../job-employee/dashboard.php");
      ////      echo "Business";
      //  } else if (trim($_SESSION['ptname']) == 'Employment') {
      //      echo "Employment";
            //  header("Location: ../job-seeker/dashboard.php");
       // }
 //   }
    ?>
    <?php include_once("../views/common/header.php"); ?>
    <?php $job_employee_nav = 'dashboard'; ?>
    <link rel="stylesheet" href="./job-employee.css">
    <div class="body-wrapper">
        <div class="job-wrapper">
            <div class="job-body-wrapper">
                <?php include "employee-nav.php"; ?>
                <div class="main-body">
                <button style='background: #3e1f48;
    padding: 6px 10px;
    border-radius: 4px;' class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                   <img src='../assets/images/menu-icon-2.svg'>
                </button>
                    <div class="main-heading">
                        Dashboard
                    </div>
                    <div class="dashboard">
                        <div class="date-range">
                            <label>Select Date Range</label>
                            <div class="input-group date-range-input">
                                <input type="date"> <span>-</span> <input type="date">
                            </div>
                        </div>
                        <div class="job-board-wrapper">
                            <div class="heading">Job Board</div>
                            <div class="job-board">
                                <?php
                                    // Create instances of _spdraft and _save_job once
                                    $spDraftInstance = new _spdraft;
                                    $saveJobInstance = new _save_job;
                                    $resumeshow = new _resumeget;
                                    $jobpost = new _jobpostings;
                                    // Fetch required counts
                                    $draftCount = $spDraftInstance->get_draft_count($uid);
                                    $savedJobCount = $saveJobInstance->countSavedJobs($uid);
                                    $resumeCount = $resumeshow->get_apply_count($uid);
                                    $favoriteCount = $saveJobInstance->countFavorites($uid);
                                    $jobpostCount = $jobpost->readActivecount($pid);
                                ?>
                                <div class="board-item-wrapper">
                                    <div class="board-item">
                                        <div class="count"><?php echo $jobpostCount; ?></div>
                                        <div class="title">Active Jobs</div>
                                    </div>
                                </div>
                                <div class="board-item-wrapper">
                                    <div class="board-item">
                                        <div class="count"><?php echo $draftCount; ?></div>
                                        <div class="title">Draft Jobs</div>
                                    </div>
                                </div>
                                <div class="board-item-wrapper">
                                    <div class="board-item">
                                        <div class="count"><?php echo $savedJobCount; ?></div>
                                        <div class="title">Saved Jobs</div>
                                    </div>
                                </div>
                                <div class="board-item-wrapper">
                                    <div class="board-item">
                                        <div class="count"><?php echo $resumeCount; ?></div>
                                        <div class="title">Resumes</div>
                                    </div>
                                </div>
                                <!--div class="board-item-wrapper">
                                    <div class="board-item">
                                        <div class="count"><?php echo $favoriteCount; ?></div>
                                        <div class="title">Favourite</div>
                                    </div>
                                </div-->
                            </div>
                        </div>
                        <div class="job-graph">
                            <div class="heading">Job Board Graph</div>
                            <div class="graph-wrapper">
                                <img src="./images/employee-graph.svg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <?php include "../views/common/footer.php"; ?>
    <script src="<?php echo $BaseUrl; ?>/assets/quill/quill.js"></script>
    <script src="<?php echo $BaseUrl; ?>/assets/js/posting/timeline.js?v=<?php echo $versions;?>"></script>
    <script src="<?php echo $BaseUrl; ?>/job-board/assets/js/script.js?v=<?php echo $versions;?>"></script>
</body>

</html>
<?php
}
?>
