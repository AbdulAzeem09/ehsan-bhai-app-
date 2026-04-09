<?php
include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['uid'])) {
    exit('Unauthorized access');
}

function sp_autoloader($class) {
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$uid = $_SESSION['uid'];
$page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
$itemsPerPage = isset($_GET['itemsPerPage']) ? (int)$_GET['itemsPerPage'] : 10;
$searchKeyword = isset($_GET['searchKeyword']) ? $_GET['searchKeyword'] : '';

// Calculate offset
$offset = $page * $itemsPerPage;

// Fetch jobs
$savePost = new _savepost();
$result = $savePost->buildSearchCondition($uid, $offset, $itemsPerPage, $searchKeyword);

// Generate job list HTML
$jobsHtml = '';
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Fetch job details
        $jobTitle = $row['spPostingTitle'];
        $location = $row['spPostingsCity'];
        $skills = $row['spPostingSkill'];
        $saveDate = (new DateTime($row['spPostingDate']))->format('d-M-Y');
        
        $jobsHtml .= "
        <div class='job'>
            <div class='salary'>{$row['spPostingSlryRngTo']}</div>
            <div class='title'>{$jobTitle}</div>
            <div class='skills'>{$skills}</div>
            <div class='location'>{$location}</div>
            <div class='date-created'>{$saveDate}</div>
        </div>";
    }
} else {
    $jobsHtml = "<div class='no-jobs'><p>No jobs found.</p></div>";
}

// Generate pagination HTML
$totalJobs = $savePost->get_draft_count($uid);  // Assuming this returns total number of saved jobs
$totalPages = ceil($totalJobs / $itemsPerPage);
$paginationHtml = '';

for ($i = 0; $i < $totalPages; $i++) {
    $activeClass = ($i == $page) ? 'active' : '';
    $paginationHtml .= "<div class='box exect $activeClass' onclick='loadJobs($i)'>" . ($i + 1) . "</div>";
}

if ($page > 0) {
    $paginationHtml = "<div class='box' onclick='loadJobs(" . ($page - 1) . ")'>Previous</div>" . $paginationHtml;
}

if ($page < $totalPages - 1) {
    $paginationHtml .= "<div class='box' onclick='loadJobs(" . ($page + 1) . ")'>Next</div>";
}

// Return response as JSON
echo json_encode([
    'jobsHtml' => $jobsHtml,
    'paginationHtml' => $paginationHtml
]);
?>
