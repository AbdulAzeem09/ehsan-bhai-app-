<?php
include('../univ/baseurl.php');
session_start();
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$fc = new _freelance_chat;
$re = new _redirect;

$conn = _data::getConnection();


if(isset($_GET['save']) && $_GET['save'] >0){   
$postid = $_GET['save'];

// echo $postid ; die('fghghghghghghghghghghpostid'); 
$profile = $_SESSION['pid'];


$data = array(
'spPostings_idspPostings' => $postid , 
'spprofiles_idspprofiles'  => $profile , 
'save_status' => 1
);
$fc->insert_savejob($data);

//insert into jobboard_save "spPostings_idspPostings"=$postid , spprofiles_idspprofiles  =  $profile , save_status=1


// $sql3 = "SELECT * FROM jobboard_save WHERE spPostings_idspPostings = $postid AND spProfiles_idspProfiles = $profile AND save_status = 0";

// $result3 = mysqli_query($conn, $sql3);
// if($result3->num_rows > 0){ 
//     $sql4 = "UPDATE jobboard_save SET save_status = 1 WHERE spPostings_idspPostings = $postid AND spProfiles_idspProfiles = $profile";
//     $result4 = mysqli_query($conn, $sql4);

//     $re->redirect($BaseUrl.'/job-board/job-detail.php?postid='.$postid);
//     //header('location:'.$BaseUrl.'/job-board/job-detail.php?postid='.$postid);
// }else{ 
//     $sql = "INSERT INTO jobboard_save(spPostings_idspPostings, spProfiles_idspProfiles, save_status) VALUES('$postid','$profile', '1' )";
//     $result1 = mysqli_query($conn, $sql);

//     $re->redirect($BaseUrl.'/job-board/job-detail.php?postid='.$postid);
//     //header('location:'.$BaseUrl.'/job-board/job-detail.php?postid='.$postid);
// }


}else if(isset($_GET['unsave']) && $_GET['unsave'] > 0){
$unsave = $_GET['unsave'];
$profile = $_SESSION['pid'];


$fc->delete_savejob($unsave);



//delete from jobboard_save where WHERE spPostings_idspPostings = $unsave AND spProfiles_idspProfiles = $profile";


// $sql2 = "UPDATE jobboard_save SET save_status = 0 WHERE save_id = $unsave";
// $result1 = mysqli_query($conn, $sql2);

// $re->redirect($BaseUrl.'/job-board/dashboard/saved-post.php');
//  $re->redirect($BaseUrl.'/job-board/job-detail.php?postid='.$_GET['unsave']);
//header('location:'.$BaseUrl.'/job-board/showsavejobs.php');
}else{
$re->redirect($BaseUrl.'/job-board');
//header('location:'.$BaseUrl.'/job-board');
}



?>
