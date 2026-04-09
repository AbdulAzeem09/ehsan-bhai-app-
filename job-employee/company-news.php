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
    // Fetch job posting details here...
    // Get the current page and items per page
 	//echo "<pre>";
   //var_dump($_SESSION);

  //   echo "</pre>";
  // exit;
    ?>
<?php include_once("../views/common/header.php"); ?>
<?php $job_seeker_nav = 'active-jobs'; ?>
<style>
.more-links {
    position: absolute;
    background-color: #fff;
    border: 1px solid #ddd;
    z-index: 1000;
    display: none;
}
</style>
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
                        Company News
                    </div>
                    <div class="active-job">
                        <div class="filters company-news-filter">
                           <!-- <div class="search-box">
                            <input type="text"  placeholder="Search Job by keyword" value="">
                            <div class="search-icon">
                                <img src="./images/search-3.svg" alt="">
                            </div>
                        </div>-->
                            <button class="add-btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-news">
                              Add News
                            </button>


                        </div>
                        <div class="table-wrapper">
                        <table id="example" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Title	</th>
                                    <th>Description	</th>
                                    <th>SDate Posted</th>
                                  
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
</div>
<?php include "../views/common/footer.php"; ?>
    <script src="<?php echo $BaseUrl; ?>/assets/quill/quill.js"></script>
    <script src="<?php echo $BaseUrl; ?>/assets/js/posting/timeline.js?v=<?php echo $versions;?>"></script>
    <script src="<?php echo $BaseUrl; ?>/job-board/assets/js/script.js?v=<?php echo $versions;?>"></script>
   



<script>
function toggleMoreLinks(element) {
    // Find the next sibling element (the .more-links div)
    const moreLinks = element.nextElementSibling;
    
    // Toggle the display style between 'none' and 'block'
    if (moreLinks.style.display === "none" || moreLinks.style.display === "") {
        moreLinks.style.display = "block";
    } else {
        moreLinks.style.display = "none";
    }
}





</script>




<script>
 $(document).on('click', '.delete-link', function(e) {
    e.preventDefault(); // Prevent default action (link click)
    
    // Get the draft ID from the data attribute
    var deleteDraftId = $(this).data('draftid');
    alert('Draft ID to delete: ' + deleteDraftId);
    // Show the SweetAlert2 confirmation modal
    Swal.fire({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Proceed with the AJAX request to delete the news
            $.ajax({
                url: 'deletecompanynews.php', // Adjust the URL to your delete handler
                type: 'POST',
                data: { draftid: deleteDraftId }, // Pass the draft ID
                success: function(response) {
                    var res = JSON.parse(response);
                    if (res.success) {
                        // Show success message and reload the table or page
                        Swal.fire('Deleted!', res.message, 'success').then(() => {
                            // Reload the page or table after deletion
                            window.location.reload();
                        });
                    } else {
                        Swal.fire('Error!', res.message, 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'There was an error deleting the news.', 'error');
                }
            });
        }
    });
});

</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Attach event listeners to all edit buttons
    const editLinks = document.querySelectorAll('.edit-link');

    editLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            // Get data attributes from the clicked button
            const newsId = this.getAttribute('data-id');
            const newsTitle = this.getAttribute('data-title');
            const newsContent = this.getAttribute('data-content');

            // Populate the modal input fields with the data
            document.getElementById('newsLetterId').value = newsId;
            document.getElementById('updateNewsTitle').value = newsTitle;  // Updated line
            document.getElementById('newsLetterContent').value = newsContent;
        });
    });
});


</script>

<script>
$('#updateNewsBtn').on('click', function() {
    // Prevent form submission and collect form data
    var form = $('#updateNewsForm');
    var formData = form.serialize(); // Collects form data, including news ID

    $.ajax({
        type: 'POST',
        url: 'company-news-update.php', // Ensure this URL is correct
        data: formData,
        success: function(response) {
            // Handle success
            console.log('Success:', response);

            // Hide the modal
            $('#update-news').modal('hide'); 

            // Show success message using SweetAlert2
            Swal.fire({
                title: 'Success!',
                text: 'News has been updated successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                // Refresh the news list after the success message is confirmed
                window.location.reload();
            });
        },
        error: function(xhr, status, error) {
            // Handle error
            console.error('Error:', error);

            // Optionally, you can show an error message if the request fails
            Swal.fire({
                title: 'Error',
                text: 'There was an error updating the news. Please try again.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });
});

</script>



<script>
$('#saveNewsBtn').on('click', function() {
    // Prevent form submission and collect form data
    var form = $('#newsForm');
    var formData = form.serialize();

    $.ajax({
        type: 'POST',
        url: 'company-news-form.php', // Ensure this URL is correct
        data: formData,
        success: function(response) {
            // Handle success
            console.log('Success:', response);

            // Hide the modal
            $('#add-news').modal('hide'); 

            // Show success message using SweetAlert2
            Swal.fire({
                title: 'Success!',
                text: 'News has been added successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                // Refresh the news list after the success message is confirmed
                 window.location.reload();
            });
        },
        error: function(xhr, status, error) {
            // Handle error
            console.error('Error:', error);

            // Optionally, you can show an error message if the request fails
            Swal.fire({
                title: 'Error',
                text: 'There was an error adding the news. Please try again.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });
});

</script>

   <script>
    $(document).ready(function() {
        $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "../ssp/datacompany.php",  // Ensure this points to your PHP file
                "type": "POST"
            },
            "columns": [
                { "data": "0" }, // ID
                { "data": "1" }, // Name
                { "data": "2" }, // Email
             
                { "data": "4" } 
               
            ],
        "language": {
            "infoFiltered": "" // Remove the "(filtered from X total entries)" part
        }
        });
    });
</script>






</body>

</html>
<?php }?>