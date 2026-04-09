<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');  

include '../univ/baseurl.php';
session_start();

if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "videos/";
include_once "../authentication/check.php";

} else {
function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$f = new _spprofiles;
//check profile is freelancer or not
$chekIsEmployment = $f->readEmployment($_SESSION['pid']);
if($chekIsEmployment !== false){
$_SESSION['count'] = 0;
$_SESSION['msg'] = "Employment Profile can not post any video. Please switch to any other profiles.";
}

$_GET["categoryID"]   = "26";
$_GET["categoryName"] = "News";

$f = new _spprofilehasprofile;

$totalFrnd = array();
$result3   = $f->readallfriend($_SESSION['pid']);
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) {
array_push($totalFrnd, $row3['spProfiles_idspProfilesReceiver']);
}
}

$result4 = $f->readall($_SESSION['pid']);
if ($result4 != false) {
while ($roow4 = mysqli_fetch_assoc($result4)) {
array_push($totalFrnd, $roow4['spProfiles_idspProfileSender']);
}
}

$friend_ids = implode("','", $totalFrnd);
$friend_id  = "'" . $friend_ids . "'";
//echo $friend_id; exit;

$pageactive = 4;









?>
<style>
#notification_count{
margin-top: -40px !important;
margin-left: 0px !important;

}
button#indent {
padding: 9px 12px;
}


</style>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php include '../component/f_links.php';?>

<link rel="stylesheet" href="css/bootstrap.min.css" >
<!-- Optional theme -->
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<!-- <link rel="stylesheet" type="text/css" href="css/docs.theme.min.css"> -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/newsviews.css">
<script type="text/javascript">
let h = window.innerHeight;
document.getElementById("wrapper").style.height = h+'px';
alert(h);
</script>
</head>
<?php
//session_start();

$header_select = "header_video";
include_once "../header.php";
?>
<body cz-shortcut-listen="true">
<div class="container-fluid">
<div class="row">
<div class="lsbar">
<a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><i class="fa fa-bars"></i></a>
<div id="wrapper" class="wrapper">

<?php   include_once("newsSidebar.php"); ?>

<!-- Page Content -->
<div id="page-content-wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-md-6 h style-1">
<div>
<h1>Bookmark Views</h1>

<div class="viewscontent">

<div class="post-comments">

<div class="comments-nav">
<ul class="nav nav-pills">
<li role="presentation" class="dropdown">
<!--a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
Views 259 <span class="caret"></span>
</a --> 
<ul class="dropdown-menu">
<li><a href="#">All</a></li>
<li><a href="#">My Views</a></li>
<li><a href="#">Follower Views</a></li>
</ul>
</li>
</ul>
</div>
<?php



if(isset($_POST['submit'])) {
$cid=$_POST['comment_id'];
$userid=$_SESSION['uid'];
$profileid=$_SESSION['pid'];
$comment=$_POST['comment'];

$data=array(
'comment_id'=>$cid,
'user_id'=>$userid,
'profile_id'=>$profileid,
'reply_message'=>$comment 
);
$obj6=new _spprofiles;
$obj6->commentcreatedata($data);
}










$obj2=new _spprofiles;  
$rees4= $obj2->readcommentdata22();
//print_r($rees4);
//die("$$$$$$$$$$");
$allcount2= $rees4->num_rows;

//echo $allcount2;
//die("DDDDDDDDDDDDDDD");

$obj2=new _spprofiles;
$rees4= $obj2->readcommentdata();
// print_r($res4);
//die("*************");
//die("9999999999999999999999999999999999999999999");

if($rees4!=false){

while(  $roow4=mysqli_fetch_assoc($rees4)){
$id=$roow4['id'];
$uid=$roow4['userid'];
$msg=$roow4['comment'];
$date=$roow4['comment_date'];
$pid1=$roow4['pid'];

$ppid=$roow4['pid'];


$res5=$obj2->readcommentbypid($ppid);
if($res5){
$row5=mysqli_fetch_assoc($res5); 
} 
$pic=$row5['spProfilePic'];
$name=$row5['spProfileName'];
// die("9999999999999999999999999999999999999999999");

$ob=new _spprofilefeature;
$pid2=$_SESSION['pid'];
$rr1=$ob->bookmarkeddata($pid2);
if($rr1 !=false){
$bookmark=0;
while($row9=mysqli_fetch_assoc($rr1)) {

if($row9['comment_id']!=$id){
continue;
$bookmark=1;
}
//print_r($rr1);
//die("$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$"); 



include('bookmarkData.php'); 

}}}} 

if($rr1 !=false){
if($rr1->num_rows > 10){
?>


<h1 class="load-more1" style="text-align: center; color: #5088ef; font-size: 24px; cursor:pointer;" >Load More</h1>
<input type="hidden" id="row1" value="0">
<input type="hidden" id="all1" value="<?php echo $allcount2; 


?>"> 	  

<?php } }?>		  
</div>
</div>

<!--modal start --> 



<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal22" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Report Messege</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form id="reportform" method="POST">
<input type="hidden" name="report" class="form-control" id="hiddenid">
<div class="form-group">
<label for="exampleFormControlTextarea1">Write report messege</label>
<textarea class="form-control" id="repmessege" rows="3"></textarea>
</div>

</div>
<div class="modal-footer">

<button data-dismiss="modal" type="button" class="btn btn-primary" name="submit" id="report_comment1">Report</button>
</div>
</form>
</div>
</div>
</div>



<!--modal End -->




















<script>
function ReplySubmit22(id) { 


// alert("pppppppppppppppppp");
//return false;

//var thml = $('#repcount'+id).html();
//alert(thml);



var id3 = $('#com_id2'+id).val();
var id4 = $('#reply2'+id).val();


$.ajax({
type: "POST",
url: 'commentreply.php',
cache:false,
data: {
'comment_id': id3,
'comment':id4
} ,
success: function(response)
{
// alert(response); // show response from the php script.

//alert(response); 


$('#appendreply2'+id).prepend(response); 

$('#reply2'+id).val(''); 

//$('#countrep'+id).val(cnt); 
//$('#repcount'+id).html(thml);

// var cnt = $('#countrep'+id).val();

var cnt = parseInt($('#countrep2'+id).val());

//alert(cnt);
var cnt1 = parseInt(cnt) + parseInt(1);
//alert(cnt1);

$('#countrep2'+id).val(cnt1);  

//$('#echocnt'+id).html(cnt1); 

$('#echocnt2'+id).empty().append(cnt1);
$('#countrep2'+id).empty().append(cnt1);
//document.all.('#echocnt'+i3).innerHTML = parseInt(cnt1); 


}
});


}; 





function DelreplyReply22(id,id2){ 


Swal.fire({
title: 'Are you sure?',
text: "It will be deleted !", 
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, delete it!'
}).then((result) => {

if (result.isConfirmed) {

var i2 = id;
var i3 = id2;



$.ajax({
url: "rep_delete.php",
type: "POST",
cache:false,
data: {'id':i2,
'id2':i3 


},
success: function(data) {  
// location.reload();

$('#rpllybox2'+i2).html('');

var cnt2 = parseInt($('#countrep2'+i3).val());
//alert(cnt2); 
var cnt3=parseInt(cnt2) - parseInt(1);
//alert(cnt3);
//$('#echocnt'+i3).html(cnt3); 
//$('#countrep'+i3).val(cnt3);   \
parseInt($('#countrep2'+i3).val(cnt3));
$('#echocnt2'+i3).empty().append(cnt3);

}

});
}
})

};





$(document).ready(function(){
$('.commentlike1').click(function(){
var a = $(this).attr('data-like');


$.ajax({
url: "like.php",
type: "POST",
cache:false,
data: {'comment_id':a


},
success: function(data) {
// location.reload();
$('#appendlike1'+a).html(data);	

}

});
});







$('.sharepost2').click(function(){
var y = $(this).attr('data-share'); 
//alert(z);

$.ajax({
url: "share.php",
type: "POST",
cache:false,
data: {'comment_id':y 


},
success: function(data) {
// location.reload();
$('#appendshare2'+y).html(data);	

}

});
});









$('.commentbookmark1').click(function(){
var mark = $(this).attr('data-mark');


$.ajax({
url: "bookmark.php",
type: "POST",
cache:false,
data: {'comment_id':mark


},
success: function(data) {
// location.reload();
$('#appendbookmark1'+mark).html(data);	

}

});
});

///////////////////////////////////////////////////

$('.commentbookmark222').click(function(){
var markk = $(this).attr('data-mark');
Swal.fire({
title: 'Are you sure?',
text: "You won't be able to revert this!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, delete it!'
}).then((result) => {
if (result.isConfirmed) {
$.ajax({
url: "deletebookmark.php",
type: "POST",
cache:false,
data: {'comment_id':markk


},
success: function(data) {
Swal.fire(
'Deleted!',
'Your file has been deleted.',
'success'
)


$('#commentbox11'+markk).html(" ");									// location.reload();


}

});

}
});




});






//////////////////////////////////////////////



$('.delreply1').click(function(){
var i2 = $(this).attr('data-reply');


$.ajax({
url: "rep_delete.php",
type: "POST",
cache:false,
data: {'id':i2


},
success: function(data) {
// location.reload();
$('#rpllybox1'+i2).html(' ');	

}

});
});




$('.delbook1').click(function(){
var i2 = $(this).attr('data-reply');


$.ajax({
url: "rep_delete.php",
type: "POST",
cache:false,
data: {'id':i2


},
success: function(data) {
// location.reload();
$('#rpllybox11'+i2).html(' ');	

}

});
});




$('.commentdel').click(function(){
var e = $(this).attr('data-del');


$.ajax({
url: "delete.php",
type: "POST",
cache:false,
data: {'comment_id':e


},
success: function(data) {
// location.reload();
$('#commentbox1'+e).html(' ');	

}

});
});









});
















//////////////////////bookmsark load more							





$(document).ready(function(){

// Load more data
$('.load-more1').click(function(){
var row1 = Number($('#row1').val());
var allcount1 = Number($('#all1').val());
row1 = row1 + 10;

if(row1 <= allcount1){
$("#row1").val(row1);

$.ajax({
url: 'bookmarkloadmore.php', 
type: 'post',
data: {row:row1},
beforeSend:function(){
$(".load-more1").text("Loading...");
},
success: function(response){

// Setting little delay while displaying new content
setTimeout(function() {
// appending posts after last post with class="post"
$(".post1:last").after(response).show().fadeIn("slow");

var rowno1 = row1 + 10;

// checking row value is greater than allcount or not
if(rowno1 > allcount1){

// Change the text and background
// $('.load-more1').text("Hide");
//$('.load-more1').css("background","darkorchid");

$('.load-more1').css("display","none");
}else{
$(".load-more1").text("Load more");
}
}, 2000);


}
});
}else{
$('.load-more1').text("Loading...");

// Setting little delay while removing contents
setTimeout(function() {

// When row is greater than allcount then remove all class='post' element after 3 element
$('.post1:nth-child(3)').nextAll('.post1').remove().fadeIn("slow");

// Reset the value of row
$("#row1").val(0); 

// Change the text and background
$('.load-more1').text("Load more");
//$('.load-more1').css("background","#15a9ce");

}, 2000);


} 

});

});




////////////////////////////////////////////////////////////////////////////bookmark load more end		












</script>



<script type="text/javascript">
function myFunction1(id) {

var x = document.getElementById("commentbox222"+id);
var y = document.getElementById("appendbookmark1"+id);
var z = document.getElementById("commentbox444"+id);
var attachment2 = document.getElementById("attachment2"+id);
//alert(x);
// alert(y);
//alert(z);

if (x.style.display === "none") {

x.style.display = "block";
y.style.display = "block";
z.style.display = "block";
attachment2.style.display = "block";
document.getElementById("hideshow11"+id).innerHTML = "<i class='fa fa-eye-slash' title='Hide'></i>";

} else {
x.style.display = "none";
y.style.display = "none";
z.style.display = "none";
attachment2.style.display = "none";

//app = document.querySelector('#hideshow'+id);
// app.html('Show');
document.getElementById("hideshow11"+id).innerHTML = "<i class='fa fa-eye' title='Show'></i>";

}}


// alert(y);
/* if (y.style.display === "none") {


} else {

}

// alert(z);
if (z.style.display === "none") {


} else {

}


}*/ 
</script>
<script>
$( document ).ready(function() {
$(".reportcomment1").on("click", function (event) {

var report = $(this).attr('data-report');
//alert(report);

$("#hiddenid").val(report);



});
//report_comment

$("#report_comment1").on("click", function (event) {
var text= $('#repmessege').val();
var  id2 = $('#hiddenid').val();
//alert(id2);
//alert(text);

$.ajax({
url: "report.php",
type: "POST",
cache:false,
data: {'comment_id':id2,
'report_msg':text


},
success: function(data) {
// location.reload();
//$('#commentbox'+e).html(' ');	

}

});
});


});




</script>








</div>
</div>
<!-- newscontent col-md-6 end -->
<div class="col-md-6 h style-1">
<?php  include_once("rightSidebar.php"); ?>
</div>
</div>
</div>
</div>
<!-- /#page-content-wrapper -->				
</div>
</div>
</div>
</div>
<!--================================================== -->

</body>
</html>

<?php 
include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>
<?php
}
?>