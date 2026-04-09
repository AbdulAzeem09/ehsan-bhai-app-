<?php

//require_once('../common.php');
include('../univ/baseurl.php');

session_start();
include "check_job_seeker.php";
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
?>
    <?php include_once("../views/common/header.php"); ?>
    <?php $job_seeker_nav = 'dashboard'; ?>
    <link rel="stylesheet" href="./job-seeker.css">
    <div class="body-wrapper">
        <div class="job-wrapper">
            <div class="job-body-wrapper">
                <?php include "job-seeker-nav.php"; ?>
                <div class="main-body">       
                    <button style='background: #3e1f48;padding: 6px 10px;border-radius: 4px;' class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <img src='../assets/images/menu-icon-2.svg'>
                    </button>
                    <div class="main-heading">
                        Dashboard
                    </div>
                    <div class="dashboard">
                        <div class="date-range">
                            <label>Select Date Rage</label>
                            <div class="input-group date-range-input">
                                <input type="date"> <span>-</span> <input type="date">
                            </div>
                        </div>
                        <div class="job-board-wrapper">
                            <div class="heading">Job Board</div>
                            <div class="job-board">
                                <div class="board-item-wrapper">
                                    <div class="board-item">
                                        <?php
                                    $cl = new _coverletter;
                                  // Get the count of job applications
                                   $applicationCount = $cl->get_application_count($uid);
                                   ?>
                                    <div class="count"><?php echo $applicationCount; ?></div>
                                        <div class="title">Application</div>
                                    </div>
                                </div>
                                <div class="board-item-wrapper">
                                    <div class="board-item">
                                    <?php
                                      $p = new _spdraft;
                                      // Get the count of drafts
                                     $res = $p->get_draft_count($uid);
                                       ?>
                                     <div class="count"><?php echo $res; ?></div>
                                          
                                        <div class="title">Draft</div>
                                    </div>
                                </div>
                                <div class="board-item-wrapper">
                              <div class="board-item">
                               <?php
                                 // Create a single instance of _save_job and reuse it
                                  $saveJobInstance = new _save_job;

                                  // Fetch saved job count
                                  $savedJobCount = $saveJobInstance->countSavedJobs($uid);
                                ?>
                              <div class="count"><?php echo $savedJobCount; ?></div>
                            <div class="title">Saved</div>
                            </div>
                          </div>
                         <div class="board-item-wrapper">
                          <div class="board-item">
                            <?php
                              // Fetch favorite count
                              $favoriteCount = $saveJobInstance->countFavorites($uid);
                             ?>
                           <div class="count"><?php echo $favoriteCount; ?></div>
                            <div class="title">Favourite</div>
                           </div>
                          </div>

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