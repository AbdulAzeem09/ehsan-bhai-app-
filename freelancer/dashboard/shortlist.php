<?php
    
    include('../../univ/baseurl.php');
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $fc = new _freelance_chat;
    $re = new _redirect;

    $conn = _data::getConnection();


    if(isset($_GET['user']) && $_GET['user'] >0 && isset($_GET['postid']) && $_GET['postid'] >0){
        

        $postid = $_GET['postid'];
        $userid = $_GET['user'];
        if(isset($_GET['accept'])){
            $sql = "INSERT INTO freelance_shortlist(spProfiles_idspProfiles, spPosting_idspPostings, shortlist_status) VALUES('$userid', '$postid','1' )";
            $result1 = mysqli_query($conn, $sql);
            //header('location:project-bid.php?postid='.$postid);
        }else if(isset($_GET['reject'])){
            $sql = "DELETE FROM freelance_shortlist WHERE spProfiles_idspProfiles = '$userid' AND spPosting_idspPostings = '$postid'";
            //$sql = "UPDATE freelance_shortlist SET shortlist_status = 0  WHERE ";
            $result1 = mysqli_query($conn, $sql);
            //header('location:project-bid.php?postid='.$postid);
        }
        $re->redirect($BaseUrl.'/freelancer/dashboard/project-bid.php?postid='.$postid);
    }


    
?>


