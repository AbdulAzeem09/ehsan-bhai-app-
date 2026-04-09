<?php
include('../univ/baseurl.php');
session_start();

function sp_autoloader($class) {
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$p = new _company_news();

// Dump the $_POST array to check values


$id = isset($_POST['updateNewsId']) ? $_POST['updateNewsId'] : '';
$cmpanynewsTitle = isset($_POST['cmpanynewsTitle']) ? $_POST['cmpanynewsTitle'] : '';
$cmpanynewsDesc = isset($_POST['cmpanynewsDesc']) ? $_POST['cmpanynewsDesc'] : '';

// Validate input
if (empty($id) || empty($cmpanynewsTitle) ||  empty($cmpanynewsDesc)) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input data.']);
    exit;
}


$newsnsert = [
    
    'cmpanynewsTitle' => $cmpanynewsTitle,
    'cmpanynewsDesc' => $cmpanynewsDesc,
];

 
$r = $p->update($newsnsert,$id);
	
if ($r) {
    echo json_encode(['status' => 'success', 'message' => 'News updated successfully!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'An error occurred while updating the news.']);
}
?>
