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
        header("Location: /job-employee/expired-jobs.php");
    }

    ?>
<?php include_once("../views/common/header.php"); ?>

<?php $job_seeker_nav = 'expired-jobs'; ?>


    <div class="body-wrapper">
        
        <div class="job-wrapper">
            <div class="job-body-wrapper">
                <?php include "employee-nav.php"; ?>
                <div class="main-body">
                <button style='background: #3e1f48;padding: 6px 10px;border-radius: 4px;' class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                   <img src='../assets/images/menu-icon-2.svg'>
                </button>
                    <div class="main-heading">
                        Expired Jobs
                    </div>
                    <div class="active-job">
                        


                        </div>
                        <div class="table-wrapper">
                        <table id="example" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Date Posted</th>
                                    <th>Short Listed</th>
                                    <th>Applicants</th>
                                    <th>Status</th>                                   
                                </tr>
                            </thead>
                        </table> 
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	
	<div class="modal fade" id="add-news" tabindex="-1" aria-labelledby="addNewsLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewsLabel">Add News</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="newsForm">
                    <div class="mb-3">
                        <label for="newsTitle" class="form-label">News Title</label>
                        <input type="text" class="form-control" name="cmpanynewsTitle" id="newsTitle" placeholder="Enter news title" required>
                    </div>
                    <div class="mb-3">
                        <label for="newsDate" class="form-label">News Date</label>
                        <input type="date" class="form-control" name="cmpanynewsdate" id="newsDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="newsContent" class="form-label">News Content</label>
                        <textarea class="form-control" name="cmpanynewsDesc" id="newsContent" rows="3" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveNewsBtn">Save News</button>
            </div>
        </div>
    </div>
</div>
<!-- Update News Modal -->
<!-- Update News Modal -->
<div class="modal fade" id="update-news" tabindex="-1" aria-labelledby="updateNewsLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateNewsLabel">Edit News</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateNewsForm">
                    <input type="hidden" name="updateNewsId" id="newsLetterId">
                    <div class="mb-3">
                       <label for="updateNewsTitle" class="form-label">News Title</label>
                         <input type="text" class="form-control" name="cmpanynewsTitle" id="updateNewsTitle">
                              </div>

                    <div class="mb-3">
                        <label for="newsLetterContent" class="form-label">News Content</label>
                        <textarea class="form-control" name="cmpanynewsDesc" id="newsLetterContent"></textarea>
                    </div>
                </form>
            </div> 
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updateNewsBtn">Save Changes</button>
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
            $(document).on('click', '.three-dot-button', function(e) {
                e.stopPropagation();
                $('.more-links').hide();
                $(this).closest('td').find('.more-links').toggle();
            });

            $(document).on('click', function() {
                $('.more-links').hide(); 
            });

            
            $(document).on('click', '.more-links', function(e) {
                e.stopPropagation();
            });

            $('#example').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "../ssp/datexpirejob.php",  // Ensure this points to your PHP file
                    "type": "POST"
                },
                "columns": [
                    { "data": "0" }, // ID
                    { "data": "1" }, // Name
                    { "data": "2" }, // Name
                    { "data": "3" }, // Name
                    { "data": "4" } 
                
                ],
                "language": {
                    "infoFiltered": "" // Remove the "(filtered from X total entries)" part
                },
                "createdRow": function(row, data, dataIndex) {
                    // Find the last 'td' and add a class to it
                    $('td:last', row).addClass('action');
                }
            });
        });

        function deleteJob(id) {
            var MAINURL = window.location.origin;
            Swal.fire({
                title: "Are you sure you want to delete?",
                icon: "warning",
                showCancelButton: true, 
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes!",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '<?php echo $BaseUrl; ?>/job-employee/expired-jobs.php?did='+id;
                }
            });
        }
    </script>
</body>

</html>
<?php }?>