<?php
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
	
	
	
    ?>
    <link rel="stylesheet" href="./job-seeker.css">
    <div class="body-wrapper">
        <div class="job-wrapper">
            <div class="job-body-wrapper">
                <?php include "job-seeker-nav.php"; ?>
                <div class="main-body">
                    <div class="main-heading">Applied Jobs</div>
                    <div class="active-job">
                        <form method="GET" action="">
                            <div class="filters">
                                <div class="search-box">
                                    <input type="text" name="search" placeholder="Search Job by keyword" value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
                                    <div class="search-icon">
                                        <img src="./images/search-3.svg" alt="">
                                    </div>
                                </div>
                               <!-- <div class="date-range">
                                    <div class="input-group date-range-input">
                                        <input type="date" name="start_date" value=""> 
                                        <span>-</span> 
                                        <input type="date" name="end_date" value="">
                                    </div>
                                </div>-->
                            </div>
                        </form>
                        <div class="table-wrapper">
                            <table>
                                <thead>
                                    <tr>
                                        <th style="width: 27%;">Title</th>
                                        <th class="text-center" style="width: 18%;">Saved On</th>
                                        <th class="text-center" style="width: 18%;">Category</th>
                                        <th class="text-center" style="width: 18%;">Applied Status</th>
                                        <th class="text-center" style="width: 15%;">Status</th>
                                        <th style="width: 10%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $cl = new _coverletter; 
                                  $coverletter = $cl->read_apply($_SESSION['uid']);
                                   if ($coverletter && $coverletter->num_rows > 0) {
                                   while ($row = $coverletter->fetch_assoc()) {
                                   ?>
                                    <tr>
                                    <td style='padding-left: 20px; text-align: left;'><?php echo htmlspecialchars($row['jobtitle']); ?></td>
                                    <td><?php echo htmlspecialchars($row['start_date']); ?></td>
                                    <td>Accounting</td>
                                    <td>Hired</td>
                                    <td><span class='status'>Active</span></td>
                                    <td class='action' style='padding-right: 20px;'>
                                    <img src='./images/dot-2.svg' alt='' class='dot' onclick='toggleMoreLinks(this)'>
                                    <div class='more-links' style='display: none;'>
                                    <div class='link'>
                                    <a href="<?php echo htmlspecialchars($BaseUrl . '/job-board/job-detail.php?pid=' . $row['pid']); ?>">
                                       <img src='./images/view.svg' alt=''>
                                       <span>View Job</span>
                                   </a>
                               </div>
                              <div class='link'>
                            <span class='img'>
                                <img src='./images/view.svg' alt=''>
                            </span>
                            <span>View Application</span>
                        </div>
                        <div class='link'>
                            <a href='#' class='delete-link' data-postid='<?php echo htmlspecialchars($row['id']); ?>'>
                                <span class='img' style='padding-left: 4px;'>
                                    <img src='./images/delete.svg' alt=''>
                                </span>
                                <span>Delete </span>
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
            <?php 
        }
    } else {
        ?>
        <tr><td colspan='6'>No jobs found</td></tr>
        <?php
    }
    ?>
</tbody>



                            </table>
                        </div>
                        
                        <!-- Pagination Controls -->
                        <div class="pagination">
                            <div class="items">
                                <div class="title">Show</div>
                                <select class="form-select" aria-label="Default select example" onchange="window.location.href='?page=1&limit='+this.value;">
                                    <option <?php echo ($limit == 10) ? 'selected' : ''; ?> value="10">10</option>
                                    <option <?php echo ($limit == 20) ? 'selected' : ''; ?> value="20">20</option>
                                    <option <?php echo ($limit == 30) ? 'selected' : ''; ?> value="30">30</option>
                                    <option <?php echo ($limit == 40) ? 'selected' : ''; ?> value="40">40</option>
                                </select>
                                <div class="title">Items</div>
                            </div>
                            <div class="list">
                                <!-- Previous Button -->
                                <?php if ($page > 1): ?>
                                    <div class="box">
                                        <a href="?page=<?php echo $page - 1; ?>&limit=<?php echo $limit; ?>">Previous</a>
                                    </div>
                                <?php endif; ?>
                                
                                <!-- Page Numbers -->
                                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                    <div class="box exect <?php echo ($i == $page) ? 'active' : ''; ?>">
                                        <a href="?page=<?php echo $i; ?>&limit=<?php echo $limit; ?>"><?php echo $i; ?></a>
                                    </div>
                                <?php endfor; ?>
                                
                                <!-- Next Button -->
                                <?php if ($page < $total_pages): ?>
                                    <div class="box">
                                        <a href="?page=<?php echo $page + 1; ?>&limit=<?php echo $limit; ?>">Next</a>
                                    </div>
                                <?php endif; ?>
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

    <script src="<?php echo $BaseUrl; ?>/assets/quill/quill.js"></script>
    <script src="<?php echo $BaseUrl; ?>/assets/js/posting/timeline.js?v=<?php echo $versions;?>"></script>
    <script src="<?php echo $BaseUrl; ?>/job-board/assets/js/script.js?v=<?php echo $versions;?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Custom delete function and event listener -->
	<script>
	function toggleMoreLinks(element) {
    var moreLinks = $(element).next('.more-links');
    $('.more-links').not(moreLinks).hide(); // Hide other more-links
    moreLinks.toggle(); // Toggle the visibility of the clicked one
}

	</script>
    <script type="text/javascript">
       $(document).ready(function() {
    var deletePostId;

    // Handle the delete link click event
    $(document).on('click', '.delete-link', function(e) {
        e.preventDefault(); // Prevent default action (link click)
        
        // Get the post ID from the data attribute
        deletePostId = $(this).data('postid');

        // Show the modal
        $('#deleteModal').modal('show');
    });

    // Handle the confirm delete button click
    $('#confirmDelete').on('click', function() {
        // Make an AJAX request to delete the application
        $.ajax({
            url: 'deleteapply.php', // Adjust the path if needed
            type: 'POST',
            data: { postid: deletePostId },
            success: function(response) {
                // Check the response (you may want to handle errors from deleteapply.php)
                if (response.success) {
                    alert('Application deleted successfully.');
                    // Remove the row from the table
                    $('a[data-postid="' + deletePostId + '"]').closest('tr').remove();
                } else {
                    alert('Failed to delete the application.');
                }
                // Hide the modal
                $('#deleteModal').modal('hide');
            },
            error: function() {
                alert('An error occurred while deleting the application.');
                // Hide the modal
                $('#deleteModal').modal('hide');
            }
        });
    });
});


    </script>
    <?php
}
?>
