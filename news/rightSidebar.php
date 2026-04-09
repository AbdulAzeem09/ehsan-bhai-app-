<div class="viewscontent"> 
<!--h1> Views</h1-->
<div class="post-comments">
<style>
textarea {
resize: none;
}
.swal2-popup.swal2-modal.swal2-show {
font-size: inherit!important; 
}

img{
width:100%; 
}

.post-comments .media {
border-left: 1px solid #000!important;
border-bottom: 1px solid #000!important;
border-right: 1px solid #000!important;
border-top: 1px solid #000!important;

}

.post-comments .comment-meta {
border-bottom: none!important;

} 
.col-md-8 {
width: 66.66666667%;
margin-top: 17px;
}

</style>
<?php






if(isset($_POST['submit5'])){


//die("0000000000000000");  



$sum2=$_POST['sum'];
$sum1=$_POST['sum_org'];


if($sum1 == $sum2){
// die(")))))111222222211111))))))");


$objectu=new _news;


$uid=$_SESSION['uid'];
$pid=$_SESSION['pid'];

$ddatta=array(
'uid'=>$uid,
'pid'=>$pid,
'status'=>1
); 

$objectu->create_user_veryfy($ddatta); 


}
else{
?>
<div class="alert alert-danger" role="alert">
You have entered wrong Captcha!
</div>
<?php 
//die("ppppppppppp");
}
}

$randnum1=rand(0,9);
$randnum2=rand(0,9);
$sum=$randnum1+$randnum2;


$_SESSION['randnum1'] =$randnum1;
$_SESSION['randnum2']=$randnum2;


$objec2=new _news;
$status=1;
$resp=$objec2->read_user_veryfy($_SESSION['uid'],$_SESSION['pid'],$status);


if($resp == ""){


?>
<div class="col-md-12">
<form class="form-inline"  method="POST" action=" ">
<div class="form-group col-md-3">
<?php if($_SESSION['guet_yes'] != 'yes'){ ?>

<input type="text" class="form-control" placeholder="<?php echo $randnum1." + ".$randnum2." = "; ?>" disabled  >
<?php } ?>
</div>
<div class="form-group mx-sm-3 mb-2 col-md-6">
<?php if($_SESSION['guet_yes'] != 'yes'){ ?>

<input type="text" class="form-control" name="sum" id="sum" required> <?php } ?>
<input type="hidden" class="form-control" name="sum_org" id="sum" value="<?php echo $sum;?>">
</div>
<div class="form-group mb-2 col-md-3">
<?php if($_SESSION['guet_yes'] != 'yes'){ ?>

<button type="submit" class="btn btn-primary mb-2" name="submit5">Verify</button>
<?php } ?>
</div>
</form>
</div>
<br>
<?php } ?>
<form method="POST" id="NewsCommentForm" action="news_comment.php" class="postForm" style="border:none;">

<div class="col-md-12">
<?php

if($resp != false){

include('newsform.php'); 

}


?>
</div>
</form>
<div class="comments-nav">
<ul class="nav nav-pills">
<li role="presentation" class="dropdown">
<style>
label.tel_feel {
display: none;
}

.col-md-4.document {
min-height: 130px;
}
</style>
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
<div id="appendStructure"> </div>
<?php
$obj22=new _spprofiles;
//$res44= $obj22->readcommentdata22();

//$allcount=$res44->num_rows;

//echo $allcount;


$obj2=new _spprofiles;
// $res4= $obj2->readcommentdata();



$shareobj=new _spprofilefeature;


$res4all=$shareobj->followedmemberallcount($_SESSION['pid']);  

$allcount=$res4all->num_rows;  



$res4=$shareobj->followedmember($_SESSION['pid']);  




//die("9999999999999999999999999999999999999999999");

if($res4!=false){
?>
<?php
while(  $row4=mysqli_fetch_assoc($res4)){
$id=$row4['id'];
//print_r($row4);


$pids=$row4['pid'];
$uid=$row4['userid'];
$msg1=$row4['comment'];
$shared=$row4['shared'];
$parrent_id=$row4['parrent_id'];

//die("xxxxxxxXXXXXXXXXXXXX  ");

$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
if(preg_match($reg_exUrl, $msg1, $url)) {
$msg= preg_replace($reg_exUrl, '<a target=" " href="'.$url[0].'" rel="nofollow">'.$url[0].'</a>', $msg1);

} else {


$msg= $msg1;

}

//cccccccc
$date=$row4['comment_date'];

$ppid=$row4['pid'];


$res5=$obj2->readcommentbypid($ppid);
if($res5!=false){

$row5=mysqli_fetch_assoc($res5);

$pic=$row5['spProfilePic'];
$name=$row5['spProfileName'];

include('rightSidebarData.php');


}}  ?>
<?php 
}

if($allcount>=10){
?>
<h1 class="load-more22" style="text-align: center; color: #5088ef; font-size: 24px;" >Load More</h1>

<?php } ?>
<input type="hidden" id="row22" value="0">
<input type="hidden" id="all" value="<?php echo $allcount; ?>"> 
</div>
</div>

<?php $randomNumber = rand(11111,99999);?>

</div>
</div>
<?php

if(isset($_POST['submit'])){

$flag_pid =$_POST['flag_pid'];
$user_pid=$_SESSION['pid'];
$user_uid=$_SESSION['uid'];
$why_flag =$_POST['why_flag'];
$flag_desc =$_POST['flag_desc'];

$data1=array(
'flag_pid'=>$flag_pid,
'user_pid'=>$user_pid,
'user_uid'=>$user_uid,
'why_flag'=>$why_flag,
'flag_desc'=>$flag_desc
);
$object=new _spprofilefeature;
$result1=$object->createpostflag($data1);



} 


?>
<div id="flagPost2" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<form method="post" action="" class="sharestorepos">
<div class="modal-content no-radius">
<!--input type="hidden" name="uid_idspPosting" value="<?php echo $_GET['postid'];?>">
<input type="hidden" name="_idspProfile" value="<?php echo $_SESSION['pid']; ?>"-->
<input type="hidden" name="flag_pid" value="<?php  echo $id;?>">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Flag Post</h4>
</div>
<div class="modal-body">
<div class="radio">
<label><input type="radio" name="why_flag" value="Duplicate post" checked="">Duplicate Post</label>
</div>
<div class="radio">
<label><input type="radio" name="why_flag" value="Posting Violation">Posting Violation</label>
</div>
<div class="radio">
<label><input type="radio" name="why_flag" value="Suspicious Post">Suspicious Post</label>
</div>
<div class="radio">
<label><input type="radio" name="why_flag" value="Copied My Post">Copied My Post</label>
</div>
<!-- <label>Why flag this post?</label> -->
<textarea class="form-control" name="flag_desc" placeholder="Add Comments"></textarea>
</div>
<div class="modal-footer">
<input type="submit" name="submit" class="btn butn_mdl_submit btn-primary ">
<button type="button" class="btn butn_cancel" data-dismiss="modal">Cancel</button>
</div>
</div>
</form>
</div>
</div>
<div id="flagPost3" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<form method="post" action="" class="sharestorepos">
<div class="modal-content no-radius">
<!--input type="hidden" name="uid_idspPosting" value="<?php echo $_GET['postid'];?>">
<input type="hidden" name="_idspProfile" value="<?php echo $_SESSION['pid']; ?>"-->
<input type="hidden" name="flag_pid" value="<?php  echo $id;?>">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Upload Image</h4>
</div>
<div class="modal-body">
<div class="form-group">
<img id="blah" src="#" alt="your image" />
<input accept="image/*" type="file" name="img" id="imgInp" class="form-control">
</div>
<!-- <label>Why flag this post?</label> -->
<div class="modal-footer">
<input type="submit" name="submit" class="btn butn_mdl_submit btn-success ">
<button type="button" class="btn butn_cancel" data-dismiss="modal">Cancel</button>
</div>
</div>
</div>
</form>
</div>
</div>
<!--modal End -->
<script src="https:<?php echo $baseurl?>/assets/js/sweetalert.js.0.19/dist/sweetalert2.all.min.js"></script>
<script>
$(document).ready(function(){

$('.delbook').click(function(){
var i2 = $(this).attr('data-reply');


$.ajax({
url: "rep_delete.php",
type: "POST",
cache:false,
data: {'id':i2


},
success: function(data) {
// location.reload();
$('#rpllybox'+i2).html(' ');

}

});
});




/*$('.commentdel').click(function(){
var e = $(this).attr('data-del');


$.ajax({
url: "delete.php",
type: "POST",
cache:false,
data: {'comment_id':e


},
success: function(data) {
// location.reload();
$('#commentbox'+e).html(' ');	

}

});
});*/









});



</script>
<script type="text/javascript">


function DelPriView(id){ 
//alert("success");
$.ajax({
url: "priview_delete.php",
type: "POST",
cache:false,
data: {'id':id
},
success: function(data) {  

$('#previewbox'+id).html('');
}

});

}





function readURL(input) {
if (input.files && input.files[0]) {
var reader = new FileReader();

reader.onload = function (e) {
$('#blah')
.attr('src', e.target.result)
.width(150)
.height(200);
};

reader.readAsDataURL(input.files[0]);
}
}


//$("#blah").hide();
imgInp.onchange = evt => {
//$("#blah").show(); 
const [file] = imgInp.files
if (file) {
blah.src = URL.createObjectURL(file)
}
}    


function ReplySubmit(id) { 

var id3 = $('#com_id'+id).val();
var id4 = $('#reply'+id).val();
//alert(id4);
if(id4){
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


$('#appendreply'+id).prepend(response); 

$('#reply'+id).val(''); 


var cnt = parseInt($('#countrep'+id).val());

//alert(cnt);
var cnt1 = parseInt(cnt) + parseInt(1);
//alert(cnt1);

$('#countrep'+id).val(cnt1);  

//$('#echocnt'+id).html(cnt1); 

$('#echocnt'+id).empty().append(cnt1);
$('#countrep'+id).empty().append(cnt1);
//document.all.('#echocnt'+i3).innerHTML = parseInt(cnt1);


}
});
}
else{
Swal.fire('Please Enter Some Text ')
}
};

















//////////////////

function myFunctionDel(id){
//alert(url);
Swal.fire({
title: 'Are you sure?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, delete it!'
}).then((result) => {


if (result.isConfirmed) {

// window.location.href = url;
$.ajax({
url: "delete.php",
type: "POST",
cache:false,
data: {'comment_id':id


},
success: function (response) 
{
//window.location.href = '<?php echo $BaseUrl; ?>/publicpost/post_comment_details.php?postid=<?php echo $_GET["postid"];?> ';

$('#commentbox'+id).html(' ');	  

}
})
}
})  

}

///////////////




/*  function myFunctionDel(id){  



$.ajax({
url: "delete.php",
type: "POST",
cache:false,
data: {'comment_id':del


},
success: function(data) {
// location.reload();
$('#commentbox'+del).html(' ');	





}

});


}*/









function DelreplyReply(id,id2){ 


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

$('#rpllybox'+i2).html('');

var cnt2 = parseInt($('#countrep'+i3).val());
//alert(cnt2); 
var cnt3=parseInt(cnt2) - parseInt(1);
//alert(cnt3);
//$('#echocnt'+i3).html(cnt3); 
//$('#countrep'+i3).val(cnt3);   \
parseInt($('#countrep'+i3).val(cnt3));
$('#echocnt'+i3).empty().append(cnt3);
// $('#countrep'+i3).empty().append(cnt3);						  

//document.all.('#echocnt'+i3).innerHTML = parseInt(cnt3);						 



}

});
}
})

};














//document.getElementByClassName('commentdel').onclick = function(){    
//	swal("Comment Deleted Successfully !");   
//};  		  




/*$('.bookmarkreply').click(function(){
var bookreply = $(this).attr('data-bookmarkreply');

//alert(bookreply);


});*/






function BookmarkReply(id){  
var r = id;


$.ajax({
url: "bookmarkreply.php",
type: "POST",
cache:false,
data: {'comment_id':r


},
success: function(data) {

$('#appendbookmarkreply'+r).html(data);	    

}

});
}








function BookmarkComment(id){  
var mark = id; 
var Bmark  =$('#bookmark'+id).val(); 
if(Bmark==0){

Swal.fire('Unbookmarked Successfully').then((result) => { 

if (result.isConfirmed) {

$.ajax({
url: "bookmark.php",
type: "POST",
cache:false,
data: {'comment_id':mark


},
success: function(data) {

if(Bmark==0){
$('#bookmark'+id).val(1);

}
else {
$('#bookmark'+id).val(0);
}

// location.reload();
$('#appendbookmark'+mark).html(data);	

}

});
}


})
}
if(Bmark==1){ 
Swal.fire('Bookmarked Successfully').then((result) => { 

if (result.isConfirmed) {

$.ajax({
url: "bookmark.php",
type: "POST",
cache:false,
data: {'comment_id':mark


},
success: function(data) {

if(Bmark==1){
$('#bookmark'+id).val(0);

}
else {
$('#bookmark'+id).val(1);
}


// location.reload();
$('#appendbookmark'+mark).html(data); 	

}

});

}
})

}  

}



function myFunctionshare(id){ 
var share  =$('#share'+id).val(); 

if(share==0){


Swal.fire('UnShared successfully').then((result) => {


if (result.isConfirmed) {


//alert(z);*/

$.ajax({
url: "share.php", 
type: "POST",
cache:false,
dataType: "json",
data: {
'comment_id':id 


},
success: function(data) {


//	alert('111111111');
//alert(data.html);

if(share==0){
$('#share'+id).val(1);

}
else {
$('#share'+id).val(0);
}
//alert(data);
// location.reload();*/
$('#appendshare'+id).html(data.html);  	    




var form_data = new FormData();
form_data.append("lastid",data.lastid);
$.ajax({

url: MAINURL+"/news/news_append_structure.php",
type: "POST", 
cache:false,
data: form_data,
contentType: false,
processData: false,
success: function (r) {


$('#appendStructure').prepend(r);             

}

}); 





}

})

//alert("Shared successfully");
}
})
}
if(share==1){
Swal.fire('Shared successfully').then((result) => {


if (result.isConfirmed) {


//alert(z);

$.ajax({
url: "share.php",
type: "POST",
cache:false,
dataType: "json",
data: {'comment_id':id 


},
success: function(data) {
//alert(data.html); 
if(share==0){
$('#share'+id).val(1);

}
else {
$('#share'+id).val(0);
}
//alert(data);
// location.reload();
$('#appendshare'+id).html(data.html);  	    


var form_data = new FormData();
form_data.append("lastid",data.lastid);
$.ajax({

url: MAINURL+"/news/news_append_structure.php",
type: "POST",
cache:false,
data: form_data,
contentType: false,
processData: false,
success: function (r) {


$('#appendStructure').prepend(r);             

}

}); 
}

})

//alert("Shared successfully");
}
})
}






}





function myFunctionunshare(id){ 


var share  =$('#share'+id).val();  
if(share==0){


Swal.fire('UnShared successfully').then((result) => {


if (result.isConfirmed) {


//alert(z);*/

$.ajax({
url: "share.php",
type: "POST",
cache:false,
dataType: "json",
data: {'comment_id':id 


},
success: function(data) {
// alert(data.sharedid);
// alert('1111111111111');
$('#post_'+data.sharedid).html("");
if(share==0){
$('#share'+id).val(1);

}
else {
$('#share'+id).val(0);
}

$('#appendshare'+id).html(data.html);  	    

var form_data = new FormData();
form_data.append("lastid",data.lastid);
/*
$.ajax({

url: MAINURL+"/news/news_append_structure.php",
type: "POST",
cache:false,
data: form_data,
contentType: false,
processData: false,
success: function (r) {


$('#appendStructure').prepend(r);             

}

});  */
}

})

//alert("Shared successfully");
}
})
}

if(share==1){

Swal.fire('Shared successfully').then((result) => {


if (result.isConfirmed) {


//alert(z);

$.ajax({
url: "share.php",
type: "POST",
cache:false,
dataType: "json",
data: {'comment_id':id 


},
success: function(data) { 
//alert('2222222222222');

//alert(data.sharedid);
$('#post_'+data.sharedid).html("");

if(share==0){
$('#share'+id).val(1);

}
else {
$('#share'+id).val(0);
}
//alert(data);
// location.reload();
$('#appendshare'+id).html(data.html);  	    
var form_data = new FormData();
form_data.append("lastid",data.lastid);
$.ajax({

url: MAINURL+"/news/news_append_structure.php",
type: "POST",
cache:false,
data: form_data,
contentType: false,
processData: false,
success: function (r) {


$('#appendStructure').prepend(r);             

}

}); 
}

})

//alert("Shared successfully");
}
})
}






} 





function myFunction22(id){ 
// alert(id);
var a = id;


$.ajax({
url: "like.php",
type: "POST",
cache:false,
data: {'comment_id':a


},
success: function(data) {
// location.reload();
$('#appendlike'+a).html(data);	

}

});
};






/*//// preview files
$('#blah2').hide()
addimages22.onchange = evt => {
$('#blah2').show()
const [file] = addimages22.files
if (file) {
blah2.src = URL.createObjectURL(file)  
}
}*/


///////////////preview_image

function preview_image() 
{
var total_file=document.getElementById("addimages22").files.length;
for(var i=0;i<total_file;i++)
{
$('#blah2').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'><br>");
}
}

///////////////////////preview_image_end 


$('#previd').hide()
document.getElementById("addvideo2")

.onchange = function(event) {
$('#previd').show()
let file = event.target.files[0];
let blobURL = URL.createObjectURL(file);
document.querySelector("video").src = blobURL;
}

function myFunction(id) {

var x = document.getElementById("commentbox22"+id);
var z = document.getElementById("commentbox44"+id);
//var y = document.getElementById("commentbox33"+id);
var a = document.getElementById("appendbookmark"+id);

var attachment = document.getElementById("attachment"+id);
if (x.style.display === "none") {
x.style.display = "block";
a.style.display = "block";

z.style.display = "block";
attachment.style.display = "block";

document.getElementById("hideshow"+id).innerHTML = "<i class='fa fa-eye' title='Hide' style='color:blue;'></i>";

} else {
x.style.display = "none";
a.style.display = "none";
z.style.display = "none";
attachment.style.display = "none";

//app = document.querySelector('#hideshow'+id);
// app.html('Show');
document.getElementById("hideshow"+id).innerHTML = "<i class='fa fa-eye-slash' title='Show' style='color:black;'></i>";

}

}



$( document ).ready(function() {
$(".reportcomment").on("click", function (event) {

var report = $(this).attr('data-report');
//alert(report);

$("#hiddenid").val(report);



});
//report_comment

$("#report_comment").on("click", function (event) {
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




function charcountupdate(str) {
var lng = str.length;
document.getElementById("charcount").innerHTML = lng + ' out of 300 characters';
}








$(document).ready(function(){

// Load more data
$('.load-more22').click(function(){
//alert("successsss");
var row22 = Number($('#row22').val());   
//alert(row22);

var allcount = Number($('#all').val());

// alert(allcount);

row22 = row22 + 10;

if(row22 <= allcount){
//alert(row22);

$("#row22").val(row22);

$.ajax({
url: 'loadmore.php', 
type: 'post',
data: {row:row22},
beforeSend:function(){
$(".load-more22").text("Loading...");
},
success: function(response){

// Setting little delay while displaying new content
setTimeout(function() {
// appending posts after last post with class="post"
$(".post:last").after(response).show().fadeIn("slow");

var rowno = row22 + 10;

// alert(rowno);

// checking row value is greater than allcount or not
if(rowno > allcount){
//alert("22222");
// Change the text and background
// $('.load-more').text("Hide");
// $('.load-more').css("background","darkorchid");
$('.load-more22').css("display","none");
}else{
$(".load-more22").text("Load more");
}
}, 2000);


}
});
}else{
$('.load-more22').text("Loading...");

// Setting little delay while removing contents
setTimeout(function() {

// When row is greater than allcount then remove all class='post' element after 3 element
$('.post:nth-child(3)').nextAll('.post').remove().fadeIn("slow");

// Reset the value of row
$("#row22").val(0); 

// Change the text and background
$('.load-more22').text("Load more");
$('.load-more22').css("background","red");

}, 2000);


}

});

});


</script>


<script>


//Documents preview and upload 
$("#addnewsDocument").on("change", function (ev) {
var randNum=$("#tempNum").val();
var postid = 1500;
var form_data = new FormData();

var files2 = $('#addnewsDocument')[0].files;
var totalfiles2=files2.length;
//alert(totalfiles); 
for (var index = 0; index < totalfiles2; index++) {

form_data.append('newsDocument', $('#addnewsDocument')[0].files[index]);


form_data.append("lastid",postid);
form_data.append("randnum",randNum);

$.ajax({

url: MAINURL+"/news/news_post_documents.php",
type: "POST",
cache:false,
data: form_data,
contentType: false,
processData: false,
success: function (r) {


$('#addnewsDocument').val(""); 
$('#preview_image').append(r);

}

});
}


});
//Documents preview and upload END




//images preview and upload

$(document).ready(function(){
    function validateFileExtensions(fileInput) {
        var allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'tif', 'tiff', 'bmp', 'svg', 'webp', 'heic', 'heif'];
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {
            var fileName = files[i].name;
            var extension = fileName.split('.').pop().toLowerCase();
            if (!allowedExtensions.includes(extension)) {
                return "Invalid format for file: " + fileName;
            }
        }
        return null;
    }
    $("#addimages22").on("change", function (ev) {
        var validationResult = validateFileExtensions(this);
        if (validationResult) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid File',
                text: validationResult
            });
            // Clear the file input
            $(this).val("");
        } else {
            // Proceed with uploading images
            var randNum = $("#tempNum").val();
            var files = $(this)[0].files;
            var totalfiles = files.length;
            var form_data = new FormData();
            for (var index = 0; index < totalfiles; index++) {
                form_data.append('newsPic', files[index]);  
                form_data.append("randnum", randNum);
                $.ajax({
                    url: MAINURL + "/news/news_post_images.php",
                    type: "POST",
                    cache: false,
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: function (r) {
                        $('#addimages22').val("");
                        $('#preview_image').append(r);
                    }
                });
            }
        }
    });

});
//images preview and upload END



//videos preview and upload  


$("#addvideo2").on("change", function (ev) {

var randNum=$("#tempNum").val();
var postid = 1500;
var form_data = new FormData();

var files3 = $('#addvideo2')[0].files;
var totalfiles3=files3.length;
//alert(totalfiles); 
for (var index = 0; index < totalfiles3; index++) {  


form_data.append('newsMedia', $('#addvideo2')[0].files[0]);

form_data.append("lastid",postid);
form_data.append("randnum",randNum);

$.ajax({

url: MAINURL+"/news/news_post_videos.php",
type: "POST",
cache:false,
data: form_data,
contentType: false,
processData: false,
success: function (r) {



$('#addvideo2').val("");

$('#previd').hide();	

$('#preview_image').append(r);

}

}); 
}



});


//videos preview and upload END





$("#spPostSubmitnews").on("click", function (ev) {

var randNum=$("#tempNum").val();

var views_comment = document.getElementById("views_comment").value;

if(views_comment != ""){

Swal.fire('Posted Successfully').then((result) => {

if (result.isConfirmed) {

$.ajax({

url: MAINURL+"/news/news_post_message.php",
type: "POST",
cache:false,
data: {
'post_message':views_comment, 
'randnum':randNum 

},

success: function(data) {  

$('#views_comment').val(''); 
$('#preview_image').html('');

var postid = data;
var latestid = postid;
var form_data = new FormData();
form_data.append("lastid",postid);

$.ajax({

url: MAINURL+"/news/news_append_structure.php",
type: "POST",
cache:false,
data: form_data,
contentType: false,
processData: false,
success: function (r) {


$('#appendStructure').prepend(r);             

}

}); 





}







}); 

}
})

}
else{

Swal.fire('Please Enter Some Text!')

}




// location.reload(); 



}); 


</script>
