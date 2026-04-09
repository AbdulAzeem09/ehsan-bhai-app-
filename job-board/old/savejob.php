<?php
    include('../univ/baseurl.php');
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $fc = new _freelance_chat;
    $conn = _data::getConnection();

    if(isset($_GET['postid']) && $_GET['postid'] >0){
        $postid = $_GET['postid'];
        $profile = $_SESSION['pid'];
        $sql3 = "SELECT * FROM jobboard_save WHERE spPostings_idspPostings = $postid AND spProfiles_idspProfiles = $profile AND save_status = 0";
        $result3 = mysqli_query($conn, $sql3);
        if($result3->num_rows > 0){
            $sql4 = "UPDATE jobboard_save SET save_status = 1 WHERE spPostings_idspPostings = $postid AND spProfiles_idspProfiles = $profile";
            $result4 = mysqli_query($conn, $sql4);
            header('location:'.$BaseUrl.'/job-board/job-detail.php?postid='.$postid);
        }else{
            $sql = "INSERT INTO jobboard_save(spPostings_idspPostings, spProfiles_idspProfiles, save_status) VALUES('$postid','$profile', '1' )";
            $result1 = mysqli_query($conn, $sql);
            header('location:'.$BaseUrl.'/job-board/job-detail.php?postid='.$postid);
        }
        
       
    }else if(isset($_GET['unsave']) && $_GET['unsave'] > 0){
        $unsave = $_GET['unsave'];
        $sql2 = "UPDATE jobboard_save SET save_status = 0 WHERE save_id = $unsave";
        $result1 = mysqli_query($conn, $sql2);
        header('location:'.$BaseUrl.'/job-board/showsavejobs.php');
    }else{
        header('location:'.$BaseUrl.'/job-board');
    }


    
?>


