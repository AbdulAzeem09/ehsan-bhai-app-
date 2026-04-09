<?php
    include('../univ/baseurl.php');
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $fc = new _freelance_chat;
    $conn = _data::getConnection();
    $re = new _redirect;

    /*$location ="../job-board/job-detail.php?postid=".$_POST["postid"];
    $re->redirect($location);*/
    $userid = isset($_GET['user']) ? (int)$_GET['user'] : 0;
    $postid = isset($_GET['postid']) ? (int)$_GET['postid'] : 0;
    if($userid >0 && $postid >0){
        if(isset($_GET['accept'])){
            $sql = "INSERT INTO freelance_shortlist(spProfiles_idspProfiles, spPosting_idspPostings, shortlist_status) VALUES('$userid', '$postid','1' )";
            $result1 = mysqli_query($conn, $sql);

            $location = "dashboard/applicant.php?postid=".$postid;

            //header('location:applicant.php?postid='.$postid);
        }else if(isset($_GET['reject'])){
            $sql = "DELETE FROM freelance_shortlist WHERE spProfiles_idspProfiles = '$userid' AND spPosting_idspPostings = '$postid'";
            //$sql = "UPDATE freelance_shortlist SET shortlist_status = 0  WHERE ";
            $result1 = mysqli_query($conn, $sql);

            $location = "dashboard/applicant.php?postid=".$postid;
           // header('location:applicant.php?postid='.$postid);
        }
       
    }else{
        $location = $BaseUrl.'/job-board';
        //header('location:'.$BaseUrl.'/job-board');
    }
  $link = '<a href="'.$BaseUrl.'/job-board/dashboard/applied-job.php">Here</a>';

//echo $link;
//echo $fc->ta->sql;
                      $pl = new _postenquiry;
                         $addmssage =  array('buyerProfileid' => $_SESSION["pid"],'sellerProfileid' => $userid,'module'=>'job board','message'=>'You are Shortlisted for job Interview Click '.$link.' to check!' );
                         $pl->addenquiry($addmssage);

    $re->redirect($location);


    
?>


