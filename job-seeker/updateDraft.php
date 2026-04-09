<?php
include('../univ/baseurl.php');
session_start();

// Autoload the class
function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

// Instantiate the class
$p = new _spdraft();

// Prepare data from POST request
$id = isset($_POST['id']) ? $_POST['id'] : '';
$content = isset($_POST['content']) ? $_POST['content'] : '';

// Validate input
if (empty($id) || empty($content)) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input data.']);
    exit;
}

// Prepare data array
$data = [
    'draft_message' => $content
];

// Call update method with correct parameters
$result = $p->updatedraft($data, $id);

// Return response to AJAX
if ($result) {
    echo json_encode(['status' => 'success', 'message' => 'Draft updated successfully.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Draft updated successfully.']);
}
