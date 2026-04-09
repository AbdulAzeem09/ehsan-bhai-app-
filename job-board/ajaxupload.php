<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');

    include('../univ/baseurl.php');
    session_start();
    function sp_autoloader($class){
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $response = array();
    $uploadDir = 'temp_docs/';
    $uploadFile = $uploadDir .$_REQUEST['postid'].'_'.basename($_FILES['document']['name']);
    $fileName = basename($_FILES['document']['name']);
    
    // Create uploads directory if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    
    // Move the uploaded file to the desired directory
    if (move_uploaded_file($_FILES['document']['tmp_name'], $uploadFile)) {
        $response['status'] = 'success';
        $response['message'] = 'File uploaded successfully.';
        $response['url'] = $BaseUrl . '/job-board/'.$uploadFile; // Path to the uploaded file relative to the script

        $_SESSION['documentUrl'] = $uploadFile; // Store file path in session
        $_SESSION['fileName'] = $fileName; // Add file name to the response
        $_SESSION['tmp_resume'] = $BaseUrl . '/job-board/'.$uploadFile; 
    } else {
        $response['status'] = 'error';
        $response['message'] = 'File upload failed!';
    }
    
    echo json_encode($response);
    exit;

    ?>

   