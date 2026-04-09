<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");

   $fc = new _freelance_chat;
    $re = new _redirect;

    $conn = _data::getConnection();

    if(isset($_POST['postid']) && $_POST['postid'] >0){
        $postid = $_POST['postid'];
        $profile = $_POST['profile_id'];
        $sql3 = "SELECT * FROM jobboard_save WHERE spPostings_idspPostings = $postid AND spProfiles_idspProfiles = $profile AND save_status = 0";
        //echo $sql3;
        $result3 = mysqli_query($conn, $sql3);
        if($result3->num_rows > 0){
            $sql4 = "UPDATE jobboard_save SET save_status = 1 WHERE spPostings_idspPostings = $postid AND spProfiles_idspProfiles = $profile";
            $result4 = mysqli_query($conn, $sql4);

            $data = array("status" => 200, "message" => "Saved");
            //header('location:'.$BaseUrl.'/job-board/job-detail.php?postid='.$postid);
        }else{
            $sql = "INSERT INTO jobboard_save(spPostings_idspPostings, spProfiles_idspProfiles, save_status) VALUES('$postid','$profile', '1' )";
             $result1 = mysqli_query($conn, $sql);

         /*   $re->redirect($BaseUrl.'/job-board/job-detail.php?postid='.$postid);*/
             $data = array("status" => 200, "message" => "Saved");
            //header('location:'.$BaseUrl.'/job-board/job-detail.php?postid='.$postid);
        }
        
       
    }else if(isset($_POST['unsave']) && $_POST['unsave'] > 0){
        $unsave = $_POST['unsave'];
        $sql2 = "UPDATE jobboard_save SET save_status = 0 WHERE spPostings_idspPostings = $postid AND spProfiles_idspProfiles = $profile";
        //echo $sql2;
        $result1 = mysqli_query($conn, $sql2);

         $data = array("status" => 200, "message" => "Unsaved");
        //header('location:'.$BaseUrl.'/job-board/showsavejobs.php');
    }else{
        $data = array("status" => 1, "message" => "No Record Found.");
        //header('location:'.$BaseUrl.'/job-board');
    }


   echo json_encode($data);
	
?>  