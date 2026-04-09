<?php
include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['uid'])) {
    exit('Unauthorized');
}

function sp_autoloader($class)
{
    include '../mlayer/'. $class .'.class.php';
}
spl_autoload_register("sp_autoloader");

$uid = $_SESSION['uid'];
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;
$query = isset($_POST['query']) ? $_POST['query'] : '';

$jobPosting = new _jobpostings();
$jobs = $jobPosting->searchExpiredJobs($uid, $query, $offset, $limit);
$totalJobs = $jobPosting->countExpiredJobs($uid, $query);

if ($jobs && $jobs->num_rows > 0) {
    echo "<div class='table-wrapper'>
            <table>
                <thead>
                    <tr>
                        <th style='width: 27%;'>Title</th>
                        <th class='text-center' style='width: 18%;'>Date Posted</th>
                        <th class='text-center' style='width: 18%;'>Short Listed</th>
                        <th class='text-center' style='width: 18%;'>Applicants</th>
                        <th class='text-center' style='width: 15%;'>Status</th>
                        <th style='width: 10%;'></th>
                    </tr>
                </thead>
                <tbody>";
    
    while ($row = $jobs->fetch_assoc()) {
        echo "<tr>
                <td style='padding-left: 20px; text-align: left;'>" . htmlspecialchars($row['spPostingTitle']) . "</td>
                <td>May 15, 2024, 10:10PM</td>
                <td>12</td>
                <td>20</td>
                <td><span class='status bg-red'>Expired</span></td>
                <td class='action' style='padding-right: 20px;'>
                    <img src='./images/dot-2.svg' alt='' class='dot' onclick='threeDot()'>
                    <div class='more-links' id='three-dot' style='display: none;'>
                        <div class='link'><span class='img'><img src='./images/view.svg' alt=''></span><span>View Applicants</span></div>
                        <div class='link'><span class='img'><img src='./images/edit.svg' alt=''></span><span>Repost</span></div>
                        <div class='link'><span class='img' style='padding-left: 4px;'><img src='./images/delete.svg' alt=''></span><span>Delete</span></div>
                    </div>
                </td>
              </tr>";
    }
    
    echo "</tbody>
          </table>
        </div>";
} else {
    echo "<tr><td colspan='6' style='text-align: center;'>No expired jobs found</td></tr>";
}
?>
