<?php
include('../univ/baseurl.php');
session_start();

if (!isset($_SESSION['uid'])) {
    echo 'Not logged in';
    exit;
}

include '../mlayer/_spdraft.class.php';

$spuid = $_SESSION['uid'];
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

$p = new _spdraft();

// Add the condition for keyword search
$condition = "WHERE recieverid = '$spuid' AND draft_message LIKE '%" . $keyword . "%'";

$recordsPerPage = isset($_GET['perPage']) ? (int)$_GET['perPage'] : 10; // Default to 10
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $recordsPerPage;

$totalRecords = $p->get_draft_count($spuid);
$totalPages = ceil($totalRecords / $recordsPerPage);

$dsf = $p->spmessagedraft->read($condition . " LIMIT $offset, $recordsPerPage");

if ($dsf && $dsf->num_rows > 0) {
    while ($row = $dsf->fetch_assoc()) {
        echo '<tr>
            <td style="padding-left: 20px; text-align: left;">' . htmlspecialchars($row['draft_message']) . '</td>
            <td>' . htmlspecialchars($row['date']) . '</td>
            <td>Accounting</td>
            <td><span class="status">Active</span></td>
            <td class="action" style="padding-right: 20px;">
                <img src="./images/dot-2.svg" alt="" class="dot" onclick="toggleMoreLinks(this)">
                <div class="more-links" style="display: none;">
                    <div class="link">
                        <span class="img"><img src="./images/view.svg" alt=""></span>
                        <span>View Job</span>
                    </div>
                    <div class="link" data-toggle="modal" data-target="#editModal" data-id="' . htmlspecialchars($row['id']) . '" data-content="' . htmlspecialchars($row['draft_message']) . '">
                        <span class="img"><img src="./images/edit.svg" alt=""></span>
                        <span>Edit Application</span>
                    </div>
                    <div class="link">
                        <a href="#" class="delete-link" data-draftid="' . htmlspecialchars($row['id']) . '">
                            <span class="img" style="padding-left: 4px;"><img src="./images/delete.svg" alt=""></span>
                            <span>Delete</span>
                        </a>
                    </div>
                </div>
            </td>
        </tr>';
    }
} else {
    echo '<tr><td colspan="5" style="text-align: center;">No Draft available</td></tr>';
}
?>
