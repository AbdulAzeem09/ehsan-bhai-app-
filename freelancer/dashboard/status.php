<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
include('../../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 

$_SESSION['afterlogin']="freelancer/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class){
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$fps = new _freelance_project_status;
$re = new _redirect;

if(isset($_GET['postid']) && $_GET['postid'] > 0 && isset($_GET['pid']) && $_GET['pid'] >0){



$spPosting_idspPostings = $_GET['postid'];
$spProfiles_idspProfiles = $_GET['pid'];
$price = $_GET['price'];

$project = $fps->read_project($spPosting_idspPostings);
$rows= mysqli_fetch_array($project);
 $project_name=$rows['spPostingTitle'];

if($_GET['status'] == 'accept'){
$fps_status ="Accepted";
}else{
$fps_status = "Rejected";
}
$conn = _data::getConnection();

$fps_start_date = date('Y m d');
$chkAlready = $fps->checkStatusExist($spPosting_idspPostings, $spProfiles_idspProfiles);
$pid = $_SESSION['pid'];
if($chkAlready == false){
 $sql = "INSERT INTO freelance_project_status(spProfiles_idspProfiles, spPosting_idspPostings, fps_start_date, fps_status, fps_price,employer_pid) VALUES('$spProfiles_idspProfiles', '$spPosting_idspPostings', Now(), '$fps_status', $price, '$pid')";	     

 //echo $sql; die('=====');
}else{

$sql = "UPDATE freelance_project_status SET spProfiles_idspProfiles = '$spProfiles_idspProfiles',spPosting_idspPostings = '$spPosting_idspPostings', fps_start_date = NOW(), fps_status = '$fps_status', status = '0' WHERE spPosting_idspPostings = '$spPosting_idspPostings'"; 
}

$pl = new _postenquiry;
$addmssage =  array('buyerProfileid' => $_SESSION['pid'],'sellerProfileid' => $spProfiles_idspProfiles,'module'=>'freelancer','message'=>'You got Awarded for project Click <a href="'.$BaseUrl.'/freelancer/dashboard/active-project.php">Here</a> to Check.' );

// print_r($addmssage);
$pl->addenquiry($addmssage);



$u = new _spprofiles;

$reciverdata = $u->read($spProfiles_idspProfiles);	

if ($reciverdata != false) {




$reciver = mysqli_fetch_array($reciverdata);

//print_r($reciver);


$reciveruserid = $reciver['spUser_idspUser'];   

/* print_r($bookedbuy);*/

$recivername = $reciver['spProfileName'];

$reciveremail =	 $reciver['spProfileEmail'];

}	
$em = new _email;

//$em->sendaward($recivername,$reciveremail,$project_name);


if($_GET['status'] == 'accept'){
    $_SESSION['awarded'] = "1";

    $em->sendaward($recivername,$reciveremail,$project_name);
    }
    else{
    $_SESSION['awarded'] = "2";
    
    }

// insert or update
$result = mysqli_query($conn, $sql);
$url = $re->redirect($BaseUrl.'/freelancer/dashboard/project-bid.php?postid='.$spPosting_idspPostings);



}
else{
$url = $re->redirect($BaseUrl.'/freelancer/dashboard/active-bid.php');
}
$activePage = 17;

?>

<?php
} ?>