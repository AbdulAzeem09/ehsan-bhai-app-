 <?php   
//print_r($_POST);die("jhj");
 /*	error_reporting(E_ALL);
ini_set('display_errors', '1');*/

session_start();
include('../../univ/baseurl.php');
function sp_autoloader($class)
{
    include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$p = new _spprofiles;


$rec = $p->readdata($_POST['postid']); 
if($rec){
$row = mysqli_fetch_assoc($rec);
}

$profile_id=$row['spProfiles_idspProfiles'];
//echo $profile_id; die('====');
//print_r($_POST);
$result = $p->spprofilename($profile_id);
if($result){
$row1 = mysqli_fetch_assoc($result);
}
$profilename = $row1['spProfileName'];
 //echo $profilename;die('====');

$data = array(
    
    "cancellation_reason"=>$_POST ['text'],
    "cancellation_category"=> $_POST ['option'],
    "event_id"=> $_POST['postid'],
    "txn_id"=> $_POST['txn_id'],
    "buyer_id"=> $_SESSION['pid'],
    "buyer_userid"=> $_SESSION['uid'],
    "event_owner_id"=> $profile_id,
    "status"=> '0',
    "cancellation_date"=> date('Y-m-d H:i:s'),
 );
 
 $event_d = $p->insertdata($data);
$txn_id=$_POST['txn_id'];
$u= new _spprofiles;

 $res = $u->read_description(10);
  $rows = mysqli_fetch_assoc($res);
  //https://dev.thesharepage.com/events/dashboard/modal.php?postid=1&txn_id=6
$link = $BaseUrl."/events/dashboard/modal.php?postid=".$event_d.'&txn_id='.$txn_id;
$em = new _email;
 $res = $em->refund_mail_send($subject,$message,'shubham18822@gmail.com',$profilename,$link);

 header("location:$BaseUrl/events/dashboard/booking.php?submited=yes");

?>