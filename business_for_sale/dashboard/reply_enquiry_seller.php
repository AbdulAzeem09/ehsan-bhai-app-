<?php
include('../../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="store/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class){
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php');?>
<!-- ===== INPAGE SCRIPTS====== -->
<?php include('../../component/dashboard-link.php'); ?>

<style type="text/css">
.buyer{
max-width: 100px;
overflow: hidden;
text-overflow: ellipsis;
white-space: nowrap;
}
.modal {
}
.vertical-alignment-helper {
display:table;
height: 100%;
width: 100%;
}
.vertical-align-center {

display: table-cell;
vertical-align: middle;
}
.modal-content {

width:inherit;
height:inherit;

margin: 0 auto;
}
</style>        
</head>

<body class="bg_gray">
<?php


//this is for store header
//$header_store = "header_store";

include_once("../../header.php");
?>
<section class="main_box">
<div class="container">
<div class="row">

<div id="sidebar" class="col-md-2 hidden-xs no-padding">
<div class="left_grid store_left_cat">

<?php
include('left-menu.php'); 

?>

</div>

<?php 


$data=array("buyer_id"=>$_POST['sender_id'],
"seller_id"=>$_POST['receiver_id'],
"postid"=>$_POST['postid'],
"enquiry_id"=>$id,
"message"=>$_POST['enquiry_msg'],
"enquiry_date"=> date('Y-m-d H:i:s'),
"msg_pid"=>$_SESSION['pid']
);

if(isset($_POST['savesubmit'])){

$en=new _businessrating;
$enq= $en->create_enquiry($data);
$enqid= $_POST['enquiry_id'];
$buyer=$_POST['buyer_id'];

///store/dashboard/reply_enquiry_seller.php?id=19

$msg =" <b>New Enquiry Received</b> :,<a   href='$BaseUrl/store/dashboard/reply_enquiry.php?id=$enqid'>Click to View </a> "; 
//$msg =" <b>New Enquiry Received</b> :,<a   href='$BaseUrl/store/dashboard/reply_enquiry_seller.php?postid=$enqid'>Click to View </a> ";								



$data=array('from_id'=>$_SESSION['pid'],
'to_id'=>$buyer,
'message'=>$msg,
'module'=>"store",
'by_seller_or_buyer'=> 1 
); 

$noti = new _notification;
$postnoti = $noti->noti_create($data);				 



}

$ag = new _businessrating;
$result = $ag->read_enquiry($id);
//  $result2 = $ag->msg($_GET['id']);

$row1 = mysqli_fetch_assoc($result);
//print_r($row1);
$postid=$row1['postid'];


$co = new _country;
$co1=$co->readCountryName($row1['country']);
if($co1!=false){
$co2=mysqli_fetch_assoc($co1);
$country=$co2['country_title'];
}
$ci = new _city;
$co2=$ci->readCityName($row1['city']);
if($co2!=false){
$co3=mysqli_fetch_assoc($co2);
$city=$co3['country_title'];
}
$st = new _state;
$st2=$st->readStateName($row1['state']);
if($st2!=false){
$st3=mysqli_fetch_assoc($st2);
$state=$st3['country_title'];
}

$res2 = $ag->read_id_business($postid);

//print_r($res2);

if($res2!=false){
while($r=mysqli_fetch_assoc($res2)){
//print_r($r);
$prtitle=$r['listing_headline'];
$price=$r['inventory_amount'];

}}
?>

<div class="col-md-10">
<div class="panel panel-default">
<div class="panel-heading"> Dashboard / Enquiries</div>
</div>
<div class="row">

<div class="col-md-12 pro_detail_box" style=" margin: 20px; ">
<div class="row ticket-reply markdown-content staff">
<div class="col-md-6">
<div class="user">
<span class="name">
Product Details
</span>
</div>
<div class="message1">
<?php echo 'Product Id : '.$postid; ?><br>
<a href="/business_for_sale/business_detail.php?postid=<?php echo $postid; ?>"><?php echo 'Product Tittle : '.$prtitle; ?></a><br>


<?php echo 'Name : '.$row1['name']; ?><br>
<?php echo 'Email : '.$row1['email']; ?><br>
<?php echo 'Phone : '.$row1['phone']; ?><br>
<?php echo 'Address : '.$row1['address']; ?><br>
<?php echo 'Comment: '.$row1['comment']; ?><br>
<?php echo 'Company Name: '.$row1['company_name']; ?><br>
<?php echo 'Country: '.$country; ?><br>
<?php echo 'State: '.$state; ?><br>
<?php echo 'City: '.$city; ?><br>
<?php echo 'Zipcode: '.$row1['zipcode']; ?><br>
</div>
</div>
<div class="col-md-6">


<a href="/real-estate/property-detail.php?postid=<?php echo $row1['spPostings_idspPostings']; ?>"><img width="100px" src="<?php //echo $pic2; ?>" class="img-responsive"></a>

</div>
</div>
</div>
<div class="col-md-12 pro_detail_box" style=" margin: 20px; ">


<style>
.ticket-reply{
margin:10px 0;
padding:0;
border:1px solid #efefef;
background-color:#fff
}

.ticket-reply.staff{
border:1px solid #cce4fc
}

.ticket-reply .date{
float:right;
padding:8px 10px;
font-size:.8em
}
.ticket-reply .user{
padding:5px 0;
background-color:#f8f8f8
}												
.ticket-reply .message1{
padding:12px 15px
}	
div#editor-container {
height: 250px;
}
.ticket-reply .user {
padding: 5px 5px;
background-color: #f8f8f8;
}

.user.for_seller {
background-color: brown;
color: white;
}
.user.for_buyer {
background-color: #337ab7;
color: white;
}
.date {
color: white;
}
</style>					

<?php $result2= $ag->read_enquiry_id($id);
if($result2!=false){
while($row11=mysqli_fetch_assoc($result2)){
// print_r($row2);

?>	


<div class="ticket-reply markdown-content staff">
<div class="date">
<?php 
$dt = new DateTime($row['enquiryDate']);
echo $dt->format('d-M-y');
?>
</div>
<div class="user for_buyer">
<i class="fa fa-user"></i>
<span class="name">
<?php 


$buyer_id=$_SESSION['pid'];

$n= new _spprofiles;
$na= $n->readname($row11['msg_pid']);

if($na!=false){
//echo "hello2";
$name= mysqli_fetch_assoc($na);
echo $name['spProfileName'];
}
else{
echo "hello";
}




//echo $row['sprealName']; ?>  
</span>
</div>
<div class="message1">
<?php 



echo $row11['message']; ?>
</div>
</div>
<?php }} ?>

<?php
if($result2=="")
{
$row2="";
}
else{

?>

<?php 
while($row2 = mysqli_fetch_assoc($result2)){    ?>

<div class="ticket-reply markdown-content">
<div class="date">
<?php
$dt1 = new DateTime($row2['msg_time_date']);
echo $dt1->format('d-M-y');
?>
</div>
<div class="user <?php if($row2['senderid']==$_SESSION['pid']){ echo 'for_seller'; }else{ echo 'for_buyer'; } ?>">
<i class="fa fa-user"></i>
<span class="name">
<?php
//
$sender_id=$row1['pid'];

$n= new _spprofiles;
$na= $n->readname($row11['msg_pid']);

if($na!=false){
//echo "hello2";
$name= mysqli_fetch_assoc($na);
echo $name['spProfileName'];
}
else{
echo "hello";
}
?>
</span>
</div>
<div class="message1">

<?php echo $row11['message']; ?>

</div>
</div>          


<?php }
} ?>

<!---- <div class="ticket-reply markdown-content">
<div class="date">
13-Jan-22           
</div>
<div class="user for_seller">
<i class="fa fa-user"></i>
<span class="name">
Marina Hossain               
</span>
</div>
<div class="message1">
<p>dfgdgdfg</p>
</div>
</div>        --->




</div>	
<form action="" method="post">
<div class="col-md-12 pro_detail_box" style=" margin: 20px; ">
<link rel='stylesheet' href='https://cdn.quilljs.com/1.1.5/quill.snow.css'>
<!--<input type="hidden" value="<?php ?>" name="receiver_id">-->
<input type="hidden" value="<?php echo $row1['pid']; ?>" name="receiver_id">
<input type="hidden" value="<?php echo $id ; ?>" name="enquiry_id">
<input type="hidden" value="<?php echo $_SESSION['pid']; ?>" name="sender_id">
<input type="hidden" value="<?php echo $postid; ?>" name="postid">
<textarea name="enquiry_msg" id="content" style="display:none;" required></textarea>

<div id="editor-container"></div>
<input type="submit" value="Submit" class="btn btn-primary float-right" name="savesubmit">
</div>
</form>



</div>
</div>

</div>
</div>
</section>



<?php 
include('../../component/f_footer.php');
include('../../component/f_btm_script.php'); 
?>

</body>
</html>
<?php
}?>

<script src='https://cdn.quilljs.com/1.3.6/quill.js'></script>						
<script>					  
var quill = new Quill('#editor-container', {
modules: {
toolbar: [
[{ header: [1, 2, false] }],
['bold', 'italic', 'underline']
]
},
theme: 'snow'  // or 'bubble'
});
quill.on("text-change", function() {
var editor_content = quill.container.firstChild.innerHTML ;
document.getElementById("content").value = editor_content;
});
</script>	
