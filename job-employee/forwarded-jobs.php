<?php
include('../univ/baseurl.php');
session_start();
include "check_job_employee.php";
if (!isset($_SESSION['uid'])) {
    $_SESSION['afterlogin'] = "job-board/";
    include_once("../authentication/check.php");
} else {
    function sp_autoloader($class)
    {
        include '../mlayer/' . $class . '.class.php';
    } 
    spl_autoload_register("sp_autoloader");
    $_GET["categoryid"] = "2";
    $_GET["categoryName"] = "Job Board";
    $uid= $_SESSION['uid'];
    $pid= $_SESSION['pid'];
    $page  = 'active_jobs';
   
    if(isset($_REQUEST['did'])){
         $del_class = new _jobpostings;
         $del_class->remove($_REQUEST['did']);
    }

    $style = "padding: 5px 10px;border-radius: 75px;background-color: #FB8308;color: white;font-size: 14px;font-weight: 400;text-decoration:none;";
    if(isset($_REQUEST['type']) && $_REQUEST['type'] == "sent"){
        $style2 = $style."background-color: #3e2048; !important;";
        $style1 = $style;
    }
    
    if(isset($_REQUEST['type']) && $_REQUEST['type'] == "received"  || !isset($_REQUEST['type'])){
        $style1 = $style."background-color: #3e2048; !important;";
        $style2 = $style;
    }
?>
<?php include_once("../views/common/header.php"); ?>
<?php $job_seeker_nav = 'forwarded-jobs'; ?>
    <div class="body-wrapper">
        <div class="job-wrapper">
            <div class="job-body-wrapper">
                <?php include "employee-nav.php"; ?>
                <div class="main-body">
                    <button style='background: #3e1f48;padding: 6px 10px;border-radius: 4px;' class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <img src='../assets/images/menu-icon-2.svg'>
                    </button>
                    <div class="main-heading"> 
                        Forwarded Jobs 
                        <a style="<?= $style2; ?>" href="?type=received">Received</a>
                        <a style="<?= $style1; ?>" href="?type=sent">Sent</a> 
                    </div>
                    <div class="active-job">
                        <div class="table-wrapper">
                        <table id="example" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Date Forwarded</th>
                                    <th>Forwarded By</th>
                                    <th>Forward Email</th>
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
                "url": "../ssp/job-employee/forwarded-jobs.php",  // Ensure this points to your PHP file
                "type": "POST",
                "data" : {
                    type: "<?= isset($_GET['type']) ? $_GET['type'] : 'received';?>"
                }
            },
            'order': [[1, 'desc']],
            "columns": [
                { "data": "0" },
                { "data": "1" }, 
                { "data": "2" },
                { "data": "3" }
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
<?php }?>