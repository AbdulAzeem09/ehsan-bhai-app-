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
	  $cl = new _company_news;
     $dsf = $cl->readMyNews($_SESSION['pid']);
	  // Handle search keyword
    $searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';

    // Get the current page and items per page
   // Get the current page and items per page
$recordsPerPage = isset($_GET['perPage']) ? (int)$_GET['perPage'] : 10; // Default to 10
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $recordsPerPage;

// Fetch news articles with pagination and search
$dsf = $cl->readMyNews($_SESSION['pid'], $offset, $recordsPerPage, $searchKeyword);

// Get total number of records for pagination
$totalRecords = $cl->get_draft_count($_SESSION['pid'], $searchKeyword);
$totalPages = ceil($totalRecords / $recordsPerPage);

    // Fetch job posting details here...
    // Get the current page and items per page
 	//echo "<pre>";
   //var_dump($_SESSION);

  //   echo "</pre>";
  //  exit;
    ?>
<?php include_once("../views/common/header.php"); ?>
<?php $job_seeker_nav = 'company-news'; ?>
<link rel="stylesheet" href="./job-employee.css">
    <div class="body-wrapper">
        
        <div class="job-wrapper">
            <div class="job-body-wrapper">
                <?php include "employee-nav.php"; ?>
                <div class="main-body">
                    <div class="main-heading">
                        Company News
                    </div>
                    <div class="active-job">
                        <div class="filters company-news-filter">
                            <div class="search-box">
                            <input type="text"  placeholder="Search Job by keyword" value="">
                            <div class="search-icon">
                                <img src="./images/search-3.svg" alt="">
                            </div>
                        </div>
                            <button class="add-btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-news">
                              Add News
                            </button>


                        </div>
                        <div class="table-wrapper">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width: 30%;">Title</th>
                                        <th class="text-center" style="width: 25%;">Description</th>
                                        <th class="text-center" style="width: 25%;">Date Posted</th>
                                        <th style="width: 10%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php 
								 
								
							if ($dsf && $dsf->num_rows > 0) {
                                        while ($row = $dsf->fetch_assoc()) {
                                            ?>
                                    <tr>
                                        <td style="padding-left: 20px; text-align: left;">
                                              <?php echo htmlspecialchars($row['cmpanynewsTitle']); ?>
                                        </td>
                                        <td class="des"><?php echo htmlspecialchars($row['cmpanynewsDesc']) ?></td>
                                        <td><?php echo htmlspecialchars($row['cmpanynewsdate'])?></td>
                                     
                                                <td class="action">
                                            <img src="./images/dot-2.svg" alt="" class="dot" onclick='toggleMoreLinks(this)'>
                                            <div class="more-links" id="three-dot" style="display: none;">

                                                <div class="link" data-bs-toggle="modal" data-bs-target="#anc-view">
                                                    <span class="img">
                                                        <img src="./images/view.svg" alt="">
                                                    </span>
                                                    <span>View Appliciants</span>
                                                </div>

                                                  <div class="link edit-link" data-bs-toggle="modal" data-bs-target="#update-news" 
                                             data-id="<?php echo htmlspecialchars($row['idcmpanynews']); ?>"
                                             data-title="<?php echo htmlspecialchars($row['cmpanynewsTitle']); ?>"
                                              
                                             data-content="<?php echo htmlspecialchars($row['cmpanynewsDesc']); ?>">
                                             <span class="img">
                                            <img src="./images/edit.svg" alt="">
                                            </span>
                                           <span>Edit News</span>
                                           </div>
                                                <div class="link">
                                                    <span class="img" style="padding-left: 4px;">
                                                        <img src="./images/delete.svg" alt="">
                                                    </span>
                                                    <span><a href="#" class="delete-link" data-draftid="<?php echo $row['idcmpanynews']; ?>">Delete Job</a></span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>   
									
									
									    <!--<td class="action">
                                            <img src="./images/dot-2.svg" alt="" class="dot" onclick="threeDot()">
                                            <div class="more-links" id="three-dot" style="display: none;">

                                                <div class="link" data-bs-toggle="modal" data-bs-target="#anc-view">
                                                    <span class="img">
                                                        <img src="./images/view.svg" alt="">
                                                    </span>
                                                    <span>View Appliciants</span>
                                                </div>
                                                <div class="link" data-bs-toggle="modal" data-bs-target="#anc-view">
                                                    <span class="img">
                                                        <img src="./images/pause.svg" alt="">
                                                    </span>
                                                    <span>Pause</span>
                                                </div>
                                                <div class="link" data-bs-toggle="modal" data-bs-target="#anc-view">
                                                    <span class="img">
                                                        <img src="./images/edit.svg" alt="">
                                                    </span>
                                                    <span>Edit</span>
                                                </div>
                                                <div class="link">
                                                    <span class="img" style="padding-left: 4px;">
                                                        <img src="./images/delete.svg" alt="">
                                                    </span>
                                                    <span>Delete</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr> -->
                                   <?php
                                        }
                                    } else {
                                        echo '<tr><td colspan="5" style="text-align: center;">No Draft available</td></tr>';
                                    }
                                    ?>									
                                </tbody>
                            </table>
                        </div>
                                     <div class="pagination">
    <div class="items">
        <div class="title">Show</div>
        <select class="form-select" onchange="updateItemsPerPage(this)">
            <option value="10" <?= ($recordsPerPage == 10) ? 'selected' : ''; ?>>10</option>
            <option value="20" <?= ($recordsPerPage == 20) ? 'selected' : ''; ?>>20</option>
            <option value="30" <?= ($recordsPerPage == 30) ? 'selected' : ''; ?>>30</option>
        </select>
        <div class="title">Items</div>
    </div>
    <div class="list">
        <div class="box">
            <?php if ($currentPage > 1): ?>
                <a href="?page=<?= $currentPage - 1 ?>&perPage=<?= $recordsPerPage ?>&search=<?= urlencode($searchKeyword) ?>">Previous</a>
            <?php else: ?>
                <span>Previous</span>
            <?php endif; ?>
        </div>
        
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <div class="box">
                <?php if ($i == $currentPage): ?>
                    <strong><?= $i ?></strong>
                <?php else: ?>
                    <a href="?page=<?= $i ?>&perPage=<?= $recordsPerPage ?>&search=<?= urlencode($searchKeyword) ?>"><?= $i ?></a>
                <?php endif; ?>
            </div>
        <?php endfor; ?>

        <div class="box">
            <?php if ($currentPage < $totalPages): ?>
                <a href="?page=<?= $currentPage + 1 ?>&perPage=<?= $recordsPerPage ?>&search=<?= urlencode($searchKeyword) ?>">Next</a>
            <?php else: ?>
                <span>Next</span>
            <?php endif; ?>
        </div>
    </div>
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





<script src="<?php echo $BaseUrl; ?>/assets/quill/quill.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/posting/timeline.js?v=<?php echo $versions; ?>"></script>
<script src="<?php echo $BaseUrl; ?>/job-board/assets/js/script.js?v=<?php echo $versions; ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>
 
  

<script>
	function toggleMoreLinks(element) {
    var moreLinks = $(element).next('.more-links');
    $('.more-links').not(moreLinks).hide(); // Hide other more-links
    moreLinks.toggle(); // Toggle the visibility of the clicked one
}

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
 $(document).on('click', '.delete-link', function(e) {
        e.preventDefault(); // Prevent default action (link click)
        
        // Get the draft ID from the data attribute
        var deleteDraftId = $(this).data('draftid');

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
                // Proceed with the AJAX request to delete the draft
                $.ajax({
                    url: 'deletecompanynews.php', // Adjust the URL to your delete handler
                    type: 'POST',
                    data: { draftid: deleteDraftId },
                    success: function(response) {
                        if (response.success) {
                            // Reload the table to reflect the changes
                            loadTable($('#searchKeyword').val(), <?php echo $currentPage; ?>, <?php echo $recordsPerPage; ?>);
                        } else {
                            Swal.fire('Success', response.message, 'succes').then(() => {
                                // Reload the page after the success message is displayed
                                window.location.reload();
                            });
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'There was an error deleting the draft.', 'error');
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
$(document).on('click', '.pagination a', function(e) {
    e.preventDefault(); // Prevent default link behavior

    // Get the page number from the link
    var page = $(this).attr('href').split('page=')[1];

    // Load the new page via AJAX
    $.ajax({
        url: 'company-news.php?page=' + page + '&perPage=' + <?= $recordsPerPage ?> + '&search=' + encodeURIComponent('<?= $searchKeyword ?>'),
        method: 'GET',
        success: function(data) {
            $('.table-wrapper').html($(data).find('.table-wrapper').html()); // Update the table
            $('.pagination').html($(data).find('.pagination').html()); // Update pagination links
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
                { "data": "3" },
                { "data": "4" } ,
                { "data": "5" } 
            ]
        });
    });
</script>
</html>
<?php } ?>




expired-jobs.php//////////////////////////////////////////////////////



<?php
//require_once('../common.php');
include('../univ/baseurl.php');
session_start();
include "check_job_employee.php";
if (!isset($_SESSION['uid'])) {
    $_SESSION['afterlogin'] = "job-employee/";
    include_once("../authentication/check.php");
} else {
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    
    $_GET["categoryid"] = "2";
    $_GET["categoryName"] = "Job Board";
    $postId = isset($_REQUEST['postid']) ? (int)$_REQUEST['postid'] : 0;
    $p = new _jobpostings;
    $res = $p->singletimelines($postId);
    $uid = $_SESSION['uid'];
    $pid = $_SESSION['pid'];
    $page = "jobBoard";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $errors = [];
        $jobData = $_POST;
        // Validate each field individually
        $requiredFields = [
            'title' => 'Job Title',
            'description' => 'Description',
            'skill' => 'Skills',
            'salary_from' => 'Salary From',
            'salary_to' => 'Salary To',
            'closingdate' => 'Closing Date',
        ];
        foreach ($requiredFields as $field => $label) {
            if (empty($_POST[$field])) {
                $errors[$field] = $label . ' is required.';
            }
        }
        // Additional validations
        if (isset($_POST['salary_from']) && isset($_POST['salary_to']) && ($_POST['salary_from'] > $_POST['salary_to'])) {
            $errors['salary_from'] = 'Salary From must be less than or equal to Salary To.';
        }
        // Handle errors or proceed with form processing
        if (empty($errors)) {
            // Save data to session for preview
            $_SESSION['jobData'] = $jobData;
            // Redirect to preview.php
            header("Location: preview.php");
            exit();
        }
    }

    ?>
    <?php include_once("../views/common/header.php"); ?>
    <?php $job_seeker_nav = 'expired-jobs'; ?>
    <link rel="stylesheet" href="./job-employee.css">
    <div class="body-wrapper">
        <div class="job-wrapper">
            <div class="job-body-wrapper">
                <?php include "employee-nav.php"; ?>
                <div class="main-body">
                    <div class="main-heading">
                        Expired Jobs
                    </div>
                    <div class="active-job">
                        <div class="filters">
                            <div class="search-box">
                                <input type="text" placeholder="Search Job by keyword" id="search-box">
                                <div class="search-icon">
                                    <img src="./images/search-3.svg" alt="">
                                </div>
                            </div>
                        </div>

                        <!-- Jobs table -->
                        <div id="jobs-list">
                            <div class="table-wrapper" id="main-table-wrapper">
                                <table>
                                    <thead>
                                        <tr>
                                            <th style="width: 27%;">Title</th>
                                            <th class="text-center" style="width: 18%;">Date Posted</th>
                                            <th class="text-center" style="width: 18%;">Short Listed</th>
                                            <th class="text-center" style="width: 18%;">Applicants</th>
                                            <th class="text-center" style="width: 15%;">Status</th>
                                            <th style="width: 10%;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $cl = new _jobpostings;
                                        $expirejob = $cl->expirejob($_SESSION['uid']); 
                                        if ($expirejob && $expirejob->num_rows > 0) {
                                            while ($row = $expirejob->fetch_assoc()) {
                                                $rowId = $row['spPostingID']; // Unique ID for each row
                                                ?>
                                                <tr>
                                                    <td style="padding-left: 20px; text-align: left;">
                                                        <?php echo htmlspecialchars($row['spPostingTitle']); ?>
                                                    </td>
                                                    <td>May 15, 2024, 10:10PM</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>
                                                        <span class="status bg-red">
                                                            Expired
                                                        </span>
                                                    </td>
                                                    <td class="action" style="padding-right: 20px;">
                                                        <img src="./images/dot-2.svg" alt="" class="dot" >
                                                        <div class="more-links"  style="display: none;">
                                                            <div class="link">
                                                                <span class="img">
                                                                    <img src="./images/view.svg" alt="">
                                                                </span>
                                                                <span>View Applicants</span>
                                                            </div>
                                                            <div class="link">
                                                                <span class="img">
                                                                    <img src="./images/edit.svg" alt="">
                                                                </span>
                                                                <span>Repost</span>
                                                            </div>
                                                            <div class="link">
                                                                <span class="img" style="padding-left: 4px;">
                                                                    <img src="./images/delete.svg" alt="">
                                                                </span>
                                                                <span>Delete</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            echo '<tr><td colspan="6" style="text-align: center;">No Draft available</td></tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="pagination">
                            <div class="list">
                                <div class="box" onclick="loadJobs(1)">Previous</div>
                                <div class="box exect active" onclick="loadJobs(1)">1</div>
                                <div class="box exect" onclick="loadJobs(2)">2</div>
                                <div class="box exect" onclick="loadJobs(3)">3</div>
                                <div class="box">Next</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo $BaseUrl; ?>/assets/quill/quill.js"></script>
    <script src="<?php echo $BaseUrl; ?>/assets/js/posting/timeline.js?v=<?php echo $versions; ?>"></script>
    <script src="<?php echo $BaseUrl; ?>/job-board/assets/js/script.js?v=<?php echo $versions; ?>"></script>

    <script>
    document.getElementById('search-box').addEventListener('input', function() {
        loadJobs(1);  // Load the first page whenever the user types
    });

    function loadJobs(page) {
        let query = document.getElementById('search-box').value;

        // Make an AJAX call to load jobs based on search and pagination
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'expired-job-pagination.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (this.status == 200) {
                document.getElementById('jobs-list').innerHTML = this.responseText;
            }
        };
        xhr.send('query=' + query + '&page=' + page);
    }

    function toggleThreeDot(rowId) {
        let element = document.getElementById('three-dot-' + rowId);
        if (element.style.display === 'none') {
            element.style.display = 'block';
        } else {
            element.style.display = 'none';
        }
    }
    </script>

    <script>
    $(document).ready(function () {
        // Example AJAX call to load dynamic content
        $.ajax({
            url: 'expired-job-pagination.php', // URL of the page to load content from
            type: 'POST',
            data: {
                page: 1 // Example data
            },
            success: function (response) {
                // Load the content into the #jobs-list div
                $('#jobs-list').html(response);

                // Once content is loaded, hide the main table
                $('#main-table-wrapper').hide();
            }
        });
    });
    </script>

    </html>
    <?php
}
?>




end //////////////////////////////////////////////






draft-jobs.php////////////////////////////////////////



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

    $postId = isset($_REQUEST['postid']) ? (int)$_REQUEST['postid'] : 0;
    $p = new _jobpostings;
    $res = $p->singletimelines($postId);

    $cl = new _spdraft;

    // Handle search keyword
    $searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';

    // Get the current page and items per page
    $recordsPerPage = isset($_GET['perPage']) ? (int)$_GET['perPage'] : 10; // Default to 10
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($currentPage - 1) * $recordsPerPage;

    // Fetch drafts with search keyword
    $dsf = $cl->read_message($_SESSION['uid'], $offset, $recordsPerPage, $searchKeyword);

    // Get total number of records for pagination
    $totalRecords = $cl->get_draft_count($_SESSION['uid'], $searchKeyword);
    $totalPages = ceil($totalRecords / $recordsPerPage);
?>
<?php include_once("../views/common/header.php"); ?>
<?php $job_seeker_nav = 'draft-jobs'; ?>
<link rel="stylesheet" href="./job-employee.css">
<div class="body-wrapper">
    <div class="job-wrapper">
        <div class="job-body-wrapper">
            <?php include "employee-nav.php"; ?>
            <div class="main-body">
                <div class="main-heading">Draft Jobs</div>
                <div class="draft-jobs">
                    <div class="filters">
                        <div class="search-box">
                            <input type="text" id="searchKeyword" placeholder="Search Job by keyword" value="<?php echo htmlspecialchars($searchKeyword); ?>">
                            <div class="search-icon">
                                <img src="./images/search-3.svg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="list-wrapper">
                        <?php
                        if ($dsf && $dsf->num_rows > 0) {
                            while ($row = $dsf->fetch_assoc()) {
                        ?>
                        <div class="job">
                            <div class="salary">Salary $400 - 500 USD</div>
                            <div class="title">MEAN Full-Stack Developer</div>
                            <div class="description">
                                <?php echo htmlspecialchars($row['draft_message']); ?>
                            </div>
                            <div class="skills">
                                <div class="skill">Web Development</div>
                                <div class="skill">Html</div>
                                <div class="skill">UI/UX</div>
                                <div class="skill">Database</div>
                            </div>
                            <div class="location">
                                <img src="./images/location.svg" alt="">
                                <span>Webinar</span>
                            </div>
                            <div class="	">Date Created: 2024-01-12</div>
                            <div class="actions">
                                <div class="icon-wrapper">
                                    <div class="icon" onclick="threeDot()">
                                        <img src="./images/thre-dot-2.svg" alt="">
                                    </div>
                                    <div class="more-options" id="three-dot">
                                        <div class="li">
                                            <span><img src="./images/view.svg" alt=""></span>View Job
                                        </div>
                                        <div class="li"> 	
                                            <span><img src="./images/edit.svg" alt=""></span>Edit Job
                                        </div>
                                        <div class="li">
                                            <span><img src="./images/delete.svg" alt=""></span>
                                            <a href="#" class="delete-link" data-draftid="<?php echo $row['id']; ?>">Delete Job</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        } else {
                            echo '<div style="text-align: center;">No Draft available</div>';
                        }
                        ?>
                        <!--<div class="pagination">
                            <div class="items">
                                <div class="title">Show</div>
                                <select class="form-select" aria-label="Default select example" onchange="updateItemsPerPage(this)">
                                    <option value="10" <?php echo $recordsPerPage === 10 ? 'selected' : ''; ?>>10</option>
                                    <option value="20" <?php echo $recordsPerPage === 20 ? 'selected' : ''; ?>>20</option>
                                    <option value="30" <?php echo $recordsPerPage === 30 ? 'selected' : ''; ?>>30</option>
                                </select>
                                <div class="title">Items</div>
                            </div>
                            <div class="list">
                                <?php if ($currentPage > 1): ?>
                                <div class="box">
                                    <a href="?page=<?php echo $currentPage - 1; ?>&perPage=<?php echo $recordsPerPage; ?>&search=<?php echo urlencode($searchKeyword); ?>">Previous</a>
                                </div>
                                <?php endif; ?>
                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <div class="box<?php echo $i === $currentPage ? ' exect active' : ' exect'; ?>">
                                    <a href="?page=<?php echo $i; ?>&perPage=<?php echo $recordsPerPage; ?>&search=<?php echo urlencode($searchKeyword); ?>"><?php echo $i; ?></a>
                                </div>
                                <?php endfor; ?>
                                <?php if ($currentPage < $totalPages): ?>
                                <div class="box">
                                    <a href="?page=<?php echo $currentPage + 1; ?>&perPage=<?php echo $recordsPerPage; ?>&search=<?php echo urlencode($searchKeyword); ?>">Next</a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo $BaseUrl; ?>/assets/quill/quill.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/posting/timeline.js?v=<?php echo $versions; ?>"></script>
<script src="<?php echo $BaseUrl; ?>/job-board/assets/js/script.js?v=<?php echo $versions; ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
$(document).ready(function() {
    function loadTable(searchKeyword, page = 1, perPage = 10) {
        $.ajax({
            url: 'draft-jobs.php',
            type: 'GET',
            data: {
                search: searchKeyword,
                page: page,
                perPage: perPage
            },
            success: function(response) {
                // Update draft jobs and pagination sections
                $('.draft-jobs').html($(response).find('.draft-jobs').html());
                $('.pagination').html($(response).find('.pagination').html());
            }
        });
    }

    // Handle search input keyup event
    $('#searchKeyword').on('keyup', function() {
        var searchKeyword = $(this).val();
        loadTable(searchKeyword, 1, $('.form-select').val()); // Reset to first page on new search
    });

    // Update items per page
    $(document).on('change', '.form-select', function() {
        var perPage = $(this).val();
        loadTable($('#searchKeyword').val(), 1, perPage); // Reset to first page on items per page change
    });

    // Pagination click event
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1].split('&')[0];
        var searchKeyword = $('#searchKeyword').val();
        var perPage = $('.form-select').val();
        loadTable(searchKeyword, page, perPage);
    });

    // Handle the delete link click event
    $(document).on('click', '.delete-link', function(e) {
        e.preventDefault(); // Prevent default action (link click)
        
        // Get the draft ID from the data attribute
        var deleteDraftId = $(this).data('draftid');

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
                // Proceed with the AJAX request to delete the draft
                $.ajax({
                    url: 'delete-draft.php', // Adjust the URL to your delete handler
                    type: 'POST',
                    data: { draftid: deleteDraftId },
                    success: function(response) {
                        if (response.success) {
                            // Reload the table to reflect the changes
                            loadTable($('#searchKeyword').val(), <?php echo $currentPage; ?>, <?php echo $recordsPerPage; ?>);
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'There was an error deleting the draft.', 'error');
                    }
                });
            }
        });
    });
});
</script>

<?php } ?>



END////////////////////////////////////////////////////////////////////////