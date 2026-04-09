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

    if(isset($_REQUEST['short']) && $_REQUEST['short'] == true){
        include '../ssp/custom-mysql.php';
        updateQuery('job_apply', array('sort_listed' => 1), array('id' => $_REQUEST['applicantId'], 'job_id' => $_REQUEST['postId']));
        $_SESSION['short_listed_updated'] = "Short List updated for applicant";
        header('Location: view_applicant.php?postId='.$_REQUEST['postId']);
        exit;
    }


    ?>
<?php include_once("../views/common/header.php"); ?>
<?php $job_seeker_nav = 'active-jobs'; ?>

    <div class="body-wrapper">
        
        <div class="job-wrapper">
            <div class="job-body-wrapper">
                <?php include "employee-nav.php"; ?>
                <div class="main-body">
                <button style='background: #3e1f48;padding: 6px 10px;border-radius: 4px;' class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                   <img src='../assets/images/menu-icon-2.svg'>
                </button>
                    <div class="main-heading">
                        View Applicant
                    </div>
                    <?php if (isset($_SESSION['short_listed_updated'])) { ?>
                        <div class="alert alert-success" role="alert" style='background: #7649b3;color:#fff;'>
                            <?= $_SESSION['short_listed_updated'];?>
                        </div>
                        <?php unset($_SESSION['short_listed_updated']); ?>
                    <?php } ?>
                    <div class="active-job">                        
                        <div class="table-wrapper">
                        <table id="example" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Applicant Name	</th>
                                    <th>Resume	</th>
                                    <th>Desired Salary</th>
                                    <th>Cover Letter</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table> 
                        </div>
                      <!--  <div class="pagination">
                            <div class="items">
                                <div class="title">
                                    Show
                                </div>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected value="1">1</option>
                                    <option value="1">2</option>
                                    <option value="2">3</option>
                                    <option value="3">4</option>
                                </select>
                                <div class="title">Items</div>
                            </div>
                            <div class="list">
                                <div class="box">
                                    Previous
                                </div>
                                <div class="box exect active">
                                    1
                                </div>
                                <div class="box exect">
                                    2
                                </div>
                                <div class="exect">
                                    ...
                                </div>
                                <div class="box exect">
                                    4
                                </div>
                                <div class="box exect">
                                    5
                                </div>
                                <div class="box">
                                    Next
                                </div>
                            </div>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Modal -->
    <div class="modal fade" id="applicantDetailsModal" tabindex="-1" aria-labelledby="applicantDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="applicantDetailsModalLabel">Applicant Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="applicantDetailsContent">
                        <!-- Applicant details will be loaded here via AJAX -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function viewApplicantDetails(applicantId) {
            $.ajax({
                url: '../ssp/job-employee/get_applicant_details.php',
                type: 'POST',
                data: { id: applicantId },
                success: function(response) {
                    $('#applicantDetailsContent').html(response);
                    $('#applicantDetailsModal').modal('show');
                },
                error: function() {
                    alert('Failed to fetch applicant details.');
                }
            });
        }

        $(document).on('click', '.view-details-button', function() {
            var applicantId = $(this).attr('id');
            viewApplicantDetails(applicantId);
        });
    </script>

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
                "url": "../ssp/job-employee/view_applicant.php?postId=<?= $_REQUEST['postId'] ?>",  // Ensure this points to your PHP file
                "type": "POST"
            },
            "columns": [
                { "data": "0" }, // ID
                { "data": "1" }, // Name
                { "data": "2" }, 
                { "data": "3" },
                { "data": "4" },
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
                  window.location.href = '<?php echo $BaseUrl; ?>/job-employee/active-jobs.php?did='+id;
            }
        });
    }
</script>
</body>

</html>
<?php }?>