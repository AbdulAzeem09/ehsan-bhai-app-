<?php
session_start();
include('../univ/baseurl.php');

if (!isset($_SESSION['uid'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['resumeFile'])) {
    $file = $_FILES['resumeFile'];
    $uploadDir = '../job-board/';
    $uploadFile = $uploadDir . basename($file['name']);

    // Check for file errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(['status' => 'error', 'message' => 'File upload error.']);
        exit;
    }

    // Move the uploaded file to the desired location
    if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
        // Save resume details to the database
        $fileName = basename($file['name']);
        $userId = $_SESSION['uid'];
        // Assuming you have a method to save the resume info
        $resumeClass = new _resumeget();
        $resumeClass->saveResume($userId, $fileName);

        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to move uploaded file.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No file uploaded.']);
}
?>
