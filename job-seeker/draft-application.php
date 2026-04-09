<?php
$datatable_use = true;
include('../univ/baseurl.php');
include_once("../views/common/header.php");
$job_seeker_nav = 'applied-jobs'; 
session_start();
include "check_job_seeker.php";
if (!isset($_SESSION['uid'])) {
    $_SESSION['afterlogin'] = "job-board/";
    include_once("../authentication/check.php");
} else {
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    if(isset($_GET['did'])) {	
        $db = new _coverletter();
        $db->updateJobApply(array('status' => 'active'), $_GET['did']);
    }
	
    ?>
    <?php $job_seeker_nav = 'draft-application'; ?>
    <link rel="stylesheet" href="./job-seeker.css">
    <div class="body-wrapper">
        <div class="job-wrapper">
            <div class="job-body-wrapper">
                <?php include "job-seeker-nav.php"; ?>
                <div class="main-body">
                    <button style='background: #3e1f48;padding: 6px 10px;border-radius: 4px;' class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <img src='../assets/images/menu-icon-2.svg'>
                    </button>
                    <div class="main-heading">Draft Application</div>
                        <div class="active-job">
                            <div class="table-wrapper">
                                <table id='example' style='width:100%'>
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Saved On</th>
                                            <th>Status</th>
                                            <th>Action</th>
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
    
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete this application?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="confirmDelete">Delete</button>
          </div>
        </div>
      </div>
    </div>
    <?php include "../views/common/footer.php"; ?>
    <script src="<?php echo $BaseUrl; ?>/assets/quill/quill.js"></script>
    <script src="<?php echo $BaseUrl; ?>/assets/js/posting/timeline.js?v=<?php echo $versions;?>"></script>
    <script src="<?php echo $BaseUrl; ?>/job-board/assets/js/script.js?v=<?php echo $versions;?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script> 
        $(document).ready(function() {
            $('#example').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "../ssp/job-seeker/applied-jobs.php?type=draft", 
                    "type": "POST"
                },
                "columns": [
                    { "data": "0" },
                    { "data": "1" },
                    { "data": "2" },
                    { "data": "3" },
                    { "data": "4" }
                ],
                "order": [[2, 'desc']],
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
    <?php
}
?>
