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
    $fileUrl = $BaseUrl . '/job-seeker/'.$uploadFile;

    // Create uploads directory if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    $flag = file_exists($uploadFile) ? true : false;
    // Move the uploaded file to the desired directory
    if (move_uploaded_file($_FILES['document']['tmp_name'], $uploadFile)) {
        $_SESSION['documentUrl'] = $uploadFile; // Store file path in session
        $response['status'] = 'success';
        $response['message'] = 'File uploaded successfully.';
        $response['fileName'] = $fileName;
        $response['url'] = $fileUrl; // Path to the uploaded file relative to the script
        $_SESSION['fileName'] = $fileName; // Add file name to the response
        $_SESSION['tmp_resume'] = $fileUrl;
         
        if(isset($_REQUEST['save_resume']) && !empty($_REQUEST['save_resume'])){
            $data['uid'] = $_SESSION['uid'];
            $data['pid'] = $_SESSION['pid'];
            $data['resume_url'] = $fileUrl;
            $data['documentUrl'] = $uploadFile;
            $data['status'] = 'active';
            $data['fileName'] = $fileName;
            if($flag == false){
                $cl = new _resumeget;
                $resume = $cl->create_sp_resume($data); 
            }
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'File upload failed!';
    }
    
    echo json_encode($response);
    exit;

?>

   