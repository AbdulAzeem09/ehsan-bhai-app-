<?php
include('../univ/baseurl.php');
session_start();
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
	 
	 $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10; // Set limit default to 10
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Set default page to 1
$offset = ($page - 1) * $limit; // Calculate offset

$search = isset($_GET['search']) ? $_GET['search'] : ''; // Get search term from input

$cl = new _company_news;
$dsf = $cl->readMyNews($_SESSION['pid'], $search, $limit, $offset);
$totalNews = $cl->countMyNews($_SESSION['pid'], $search);

$totalPages = ceil($totalNews / $limit); // Calculate total pages for pagination

if ($dsf && $dsf->num_rows > 0) {
    while ($row = $dsf->fetch_assoc()) {
        // Display your news here
    }
}
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
                                <input type="text" placeholder="Search Job by keyword">
                                <div class="search-icon">
                                    <img src="./images/search-3.svg" alt="">
                                </div>
                            </div>
                            <button class="add-btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-news">
                              Add News
                            </button>


                        </div>
                        <div class="table-wrapper">
                            <table>
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
								  $cl = new _company_news;
                                $dsf = $cl->readMyNews($_SESSION['pid']);
								
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
                                            <img src="./images/dot-2.svg" alt="" class="dot" onclick="threeDot()">
                                            <div class="more-links" id="three-dot" style="display: none;">

                                                <div class="link" data-bs-toggle="modal" data-bs-target="#company-news">
                                                    <span class="img">
                                                        <img src="./images/view.svg" alt="">
                                                    </span>
                                                    <span>View</span>
                                                </div>
                                                <div class="link" data-bs-toggle="modal" data-bs-target="#update-news">
                                                    <span class="img">
                                                        <img src="./images/edit.svg" alt="">
                                                    </span>
                                                    <span>Edit News</span>
                                                </div>

                                                <div class="link">
                                                    <span class="img" style="padding-left: 4px;">
                                                        <img src="./images/delete.svg" alt="">
                                                    </span>
                                                    <span>Remove</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>    
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
        <select class="form-select" id="itemsPerPage" aria-label="Items per page">
            <option value="10" <?php if($limit == 10) echo 'selected'; ?>>10</option>
            <option value="20" <?php if($limit == 20) echo 'selected'; ?>>20</option>
            <option value="50" <?php if($limit == 50) echo 'selected'; ?>>50</option>
        </select>
        <div class="title">Items</div>
    </div>
    <div class="list">
        <div class="box prev" data-page="<?php echo max(1, $page - 1); ?>">Previous</div>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <div class="box exect <?php echo ($i == $page) ? 'active' : ''; ?>" data-page="<?php echo $i; ?>">
                <?php echo $i; ?>
            </div>
        <?php endfor; ?>
        <div class="box next" data-page="<?php echo min($totalPages, $page + 1); ?>">Next</div>
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


    <script src="<?php echo $BaseUrl; ?>/assets/quill/quill.js"></script>
    <script src="<?php echo $BaseUrl; ?>/assets/js/posting/timeline.js?v=<?php echo $versions;?>"></script>
    <script src="<?php echo $BaseUrl; ?>/job-board/assets/js/script.js?v=<?php echo $versions;?>"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js"
    integrity="sha512-Z8CqofpIcnJN80feS2uccz+pXWgZzeKxDsDNMD/dJ6997/LSRY+W4NmEt9acwR+Gt9OHN0kkI1CTianCwoqcjQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>
<script>
$(document).ready(function() {
    function loadNews(page = 1, search = '', limit = 10) {
        $.ajax({
            url: "fetch_company_news.php", // Endpoint for fetching paginated results
            method: "GET",
            data: { page: page, search: search, limit: limit },
            success: function(data) {
                $('tbody').html(data.html);
                $('.pagination .list').html(data.pagination);
            }
        });
    }

    // Initial Load
    loadNews();

    // Search functionality
    $('.search-box input').on('keyup', function() {
        var search = $(this).val();
        loadNews(1, search); // Reset to page 1 when searching
    });

    // Pagination functionality
    $(document).on('click', '.pagination .box', function() {
        var page = $(this).attr('data-page');
        var search = $('.search-box input').val();
        var limit = $('#itemsPerPage').val();
        loadNews(page, search, limit); // Load with selected page and limit
    });

    // Items per page change functionality
    $('#itemsPerPage').on('change', function() {
        var search = $('.search-box input').val();
        var limit = $(this).val();
        loadNews(1, search, limit); // Reset to page 1 when changing limit
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
                $('#add-news').modal('hide'); // Hide the modal
                loadNews(); // Refresh the news list after adding news
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error('Error:', error);
            }
        });
    });

</script>

</html>
<?php } ?>