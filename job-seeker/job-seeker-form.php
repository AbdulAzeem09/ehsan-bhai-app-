<?php
//require_once('../common.php');

include('../univ/baseurl.php');
session_start();


function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$p = new  _coverletter;

$jobapply =[
            'uid' => $_POST['uid'],
            'pid' => $_POST['pid'],
            'spUserEmail' => $_POST['spUserEmail'],
            'spPostCountry' => $_POST['spPostCountry'],
            'spPostState' => $_POST['spPostState'],
            'myprofile' => $_POST['myprofile'],
            'resume_url' => $_POST['resume_url'],
            'spPostingMedia' => $_POST['resume_url'],
            'documentUrl' => $_POST['documentUrl'],
            'coverletter_title' => $_POST['cover_title'], // Add cover letter title
            'coverletter_dec' => $_POST['cover_content'], // Add cover letter content
            'start_date' => $_POST['start_date'], // Add start date
            'desired_salary' => $_POST['desired_salary'], // Add desired salary
            'eligibility' => $_POST['eligibility'], // Add eligibility to work
            'relocation' => $_POST['relocation'], // Add relocation requirement        
           ];
// Handle the image upload
if (isset($_FILES['jobImage']) && $_FILES['jobImage']['error'] == UPLOAD_ERR_OK) {
    $imageTmpName = $_FILES['jobImage']['tmp_name'];
    $imageName = basename($_FILES['jobImage']['name']);
    $imageSize = $_FILES['jobImage']['size'];
    $imageType = $_FILES['jobImage']['type'];

    // Define the directory where you want to save the image
    $uploadDir = '../uploads/images/';
    $imagePath = $uploadDir . $imageName;

    // Move the uploaded file to the server's directory
    if (move_uploaded_file($imageTmpName, $imagePath)) {
        // Include the image path in the $jobapply array
        $jobapply['image_path'] = $imagePath;
    } else {
        // Handle the error if the file couldn't be moved
        echo "Failed to upload image.";
        exit;
    }
}

$r = $p->insertJob($jobapply);

if ($r) {
    echo "Application successfully submitted!";
} else {
    echo "Failed to submit the application.";
}
?>