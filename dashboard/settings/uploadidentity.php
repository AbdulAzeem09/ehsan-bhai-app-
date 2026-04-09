<?php
//die('===============');
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
include('../../univ/baseurl.php');
include("../../univ/main.php");
include('../../helpers/image.php');
session_start();

$BaseUrl1 = $_SERVER["DOCUMENT_ROOT"];

// Check user authentication
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "my-profile/";
    include_once ("../authentication/check.php");
} else {
    // Database connection
    $con = mysqli_connect(DOMAIN, UNAME, PASS);
    if (!$con) {
        die('Not Connected To Server');
    }
    if (!mysqli_select_db($con, DBNAME)) {
        echo 'Database Not Selected';
    }

    // Form submission handling
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate form inputs
        $spProfile_idspProfile = $_POST['spProfile_idspProfile'];
        $uid = $_POST['uid'];

        $filename = "";
        $filename1 = "";
        $image = new Image();
        // Validate and process file uploads
        if ($_FILES['uploadidentity']['error'] == UPLOAD_ERR_OK) {
            $filename = $_FILES["uploadidentity"]['name'];
            $image->validateFileImageExtensions($_FILES['uploadidentity']);
            
                move_uploaded_file($_FILES['uploadidentity']['tmp_name'], $BaseUrl1 . '/upload/user/user_id/' . $filename);
            
        }

        if ($_FILES['uploadidentity1']['error'] == UPLOAD_ERR_OK) {
            $filename1 = $_FILES["uploadidentity1"]['name'];
            $image->validateFileImageExtensions($_FILES['uploadidentity1']);
            
                move_uploaded_file($_FILES['uploadidentity1']['tmp_name'], $BaseUrl1 . '/upload/user/user_id/' . $filename1);
            
        }

        // Update database with file names
        $id = !empty($_POST["up_id"]) ? (int) $_POST["up_id"] : "";
        $updatecmd = "";
        if (!empty($filename) && !empty($filename1)) {
            $updatecmd = "update useridentity set idimage='$filename', upload_spfile='$filename1'  where id =" . $id;
        } elseif (!empty($filename) && empty($filename1)) {
            $updatecmd = "update useridentity set idimage='$filename' where id =" . $id;
        } elseif (empty($filename) && !empty($filename1)) {
            $updatecmd = "update useridentity set upload_spfile='$filename1' where id =" . $id;
        }

        if (!empty($updatecmd)) {
            $spudates = mysqli_query($con, $updatecmd);
            header('location:' . $BaseUrl . '/dashboard/settings/');        
        }
    }
}
?>

