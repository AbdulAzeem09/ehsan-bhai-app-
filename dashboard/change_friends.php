<?php 



// error_reporting(E_ALL);
// ini_set('display_errors', '1');




require_once("../univ/baseurl.php" );
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="dashboard/";
include_once ("../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");

$r = new _spprofilehasprofile;


print_r($_POST); 

date_default_timezone_set('Australia/Melbourne');
$today = date("Y-m-d");   
$my_profile_id=$_POST['my_profile_id'];

$profile_id_1=$_POST['profile_id'];
$send_id=$_POST['send_id'];
$count=count($profile_id_1);
for($i=0;$i<$count;$i++){
    $profile_id=$_POST['profile_id'][$i];

    $res = $r->read_friend($send_id,$profile_id);
    $res_1 = $r->read_friend_2($send_id,$profile_id);
   if($res){
    $rows = mysqli_fetch_assoc($res);
    $id=$rows['id'];

    $arr=array(
        "spProfiles_idspProfileSender"=>$my_profile_id,
        "spProfiles_idspProfilesReceiver"=>$profile_id
    );
    $res = $r->update_switch($arr,$id);

   }elseif($res_1){
    $rows_1 = mysqli_fetch_assoc($res_1);
    $id1=$rows_1['id'];

    $arr=array(
        "spProfiles_idspProfileSender"=>$my_profile_id,
        "spProfiles_idspProfilesReceiver"=>$profile_id
    );
    $res = $r->update_switch($arr,$id1);

   }

  
   

}
header('location:'.$BaseUrl.'/dashboard/friend_list.php?id='.$send_id);


}