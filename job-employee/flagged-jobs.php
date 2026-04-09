<?php
//require_once('../common.php');
$datatable_use = true;
include('../univ/baseurl.php');
session_start(); 
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
    $_GET["categoryid"] = "2";
    $_GET["categoryName"] = "Job Board";        
    ?>
    <?php include_once("../views/common/header.php"); ?>
    <?php 
        $page = "Flagged Jobs";
        $job_seeker_nav = 'flagged-jobs'; 
    ?>
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
                            Flagged Jobs
                        </div>
                        <div class="draft-jobs">					
                            <div class="list-wrapper">
                                <table id="example" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                        </tr>
                                    </thead>
                                </table>                            
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
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "../ssp/flagged-jobs.php",  // Ensure this points to your PHP file
                    "type": "POST"
                },
                "columns": [
                    { "data": "0" }
                ],
                "createdRow": function(row, data, dataIndex) {
                    // Find the last 'td' and add a class to it
                    $('td:last', row).addClass('action');
                },
        "language": {
            "infoFiltered": "" // Remove the "(filtered from X total entries)" part
        }
            });
        
        });
    </script>
</body>

</html>
<?php } ?>