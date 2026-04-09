<?php
session_start();
include('../univ/baseurl.php');

if (!isset($_SESSION['uid'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit;
}

$resumeClass = new _resumeget();
$resumes = $resumeClass->resume($_SESSION['uid']);
$resumeList = [];

if ($resumes && $resumes->num_rows > 0) {
    while ($row = $resumes->fetch_assoc()) {
        $resumeList[] = [
            'id' => $row['id'],
            'url' => htmlspecialchars($BaseUrl . '/job-board/' . $row['fileName']),
            'type' => htmlspecialchars(pathinfo($row['fileName'], PATHINFO_EXTENSION)),
            'title' => htmlspecialchars($row['jobtitle'])
        ];
    }
}

echo json_encode(['resumes' => $resumeList]);
?>
