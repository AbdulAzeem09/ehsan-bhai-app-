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



    ?>
<?php include_once("../views/common/header.php"); ?>
<?php $job_seeker_nav = 'draft-jobs'; ?>

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
                    Draft Jobs
                    </div>
                    <div class="active-job">
                        
                        <div class="table-wrapper">
                        <table id="example" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Title	</th>
                                    <th>Date Posted	</th>
                                   
                                    <th>Status</th>
                                    <th width='150'></th>
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
                "url": "../ssp/data.php?type=draft",  // Ensure this points to your PHP file
                "type": "POST"
            },
            "columns": [
                { "data": "0" }, // ID
                { "data": "1" }, // Name
               
                { "data": "4" } ,
                { "data": "5" } 
            ],
            "order": [[1, 'desc']],
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
                  window.location.href = '<?php echo $BaseUrl; ?>/job-employee/draft-jobs.php?did='+id;
            }
        });
    }
</script>
</body>

</html>
<?php }?>