<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include('../../univ/baseurl.php');
function sp_autoloader($class)
{
    include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$em = new _email;
$p = new _spevent;
//print_r($_POST); die;
$update = array(
    "owner_comment" => $_POST['comment'],
    "status" => $_POST['status'],
    "refund_amount" => $_POST['refund'],
    "owner_comment_date" => date('Y-m-d H:i:s'),
);
$updata = $p->updatemodal($update,$_POST['txn_id']);

$balanceTransaction='Refund Amount on Event ID :'.$_POST['event_id'];

//buyer refund

$insertdata = array(
    "seller_userid" => $_POST['buyer_userid'],
    "buyer_userid" => $_SESSION['uid'],
    "balanceTransaction" =>$balanceTransaction,
    "amount" => $_POST['refund'],
    "orderid" => $_POST['txn_id'], 
    "status" => '1',
    "date_txn" => date('Y-m-d H:i:s'),
);

$updata = $p->insertmodal($insertdata);

//seler deducton
$balanceTransaction='Deduction Amount on Event ID :'.$_POST['event_id'];

$insertdata = array(
    "seller_userid" => $_SESSION['uid'],
    "buyer_userid" => $_POST['buyer_userid'],
    "balanceTransaction" =>$balanceTransaction,
    "amount" => '-'.$_POST['refund'],
    "orderid" => $_POST['txn_id'], 
    "status" => '1',
    "date_txn" => date('Y-m-d H:i:s'),
);

$updata = $p->insertmodal($insertdata);

$user_id=$_POST['buyer_userid'];
$rest = $p->spuser_read($user_id);

$row=mysqli_fetch_assoc($rest);
$name=$row['spUserName'];
$email=$row['spUserEmail'];

$refund_amt = $_POST['refund'];
$comment=$_POST['comment'];
$txnid= $_POST['txn_id'];

$event_id= $_POST['event_id'];

// echo $event_id; die;
$p = new _spprofiles;

$rec = $p->readdata($event_id); 

// print_r($rec); die;
if($rec != false){
$row = mysqli_fetch_assoc($rec);
$currency = $row['default_currency'];
}else {
  $currency = '';  
}



//https://dev.thesharepage.com/events/dashboard/plus.php?postid=717&txn_id=4
if($_POST['status']==1){

    $message= "This email is to inform you that your refund request has been accepted by the Event Owner , you can check your Event Wallet for Refund .<br><br>
    
    Refunded Amount is : $currency  $refund_amt <br><br>
    Event Owner Comment : $comment;<br><br>
    
    <a href='$BaseUrl/events/dashboard/plus.php?postid=$event_id&txn_id=$txnid'>Click Here to Get know more infomation </a>";

   // echo $baseurl;dei("==11=");

    }else{

        $message = "This email is to inform you that your refund request has be accepted by the Event Owner , you can check you Event Wallet for Refund .<br><br>
        Refund Amount is : $refund_amt <br><br>
        Reason for Rejection is : $comment;<br><br>
        
        <a href='$BaseUrl/events/dashboard/plus.php?postid=$event_id&txn_id=$txnid'>Click Here to Get know more infomation</a> ";
    }

//idspUser
$res = $em->mail_sender('shubham18822@gmail.com', $name ,$message );

header("location:Request_Cancellation.php?update=yes");
?>