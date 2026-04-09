
<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 'On'); 

include("../univ/baseurl.php"); 
session_start();
unset($_SESSION['sign-up']); 
//echo '<pre>'; 
//print_r($_SESSION);



$_GET["globaltimeline"] = "7";


if (isset($_SESSION['pid'])) { 

include "../publicpost/index.php";
} else {

$_SESSION['afterlogin'] = "timeline/";
include_once("../authentication/check.php");
}

?>
<style>
.emoji-wysiwyg-editor.grptimeline.form-control.post_box {
    border-radius: 25px !important;
    border: 1px solid #c4baba;
}
.btn:hover {
color: #080101!important;

}
@media (max-width: 480px) {
.modal-dialog {
width: 95% !important;
}
.img-circle{
	margin-right: 230px;
}
.tltcmt{
	margin-right: -60px;
}
i.fa.fa-share-alt{
	margin-left: 20px;
}
.inner_top_form input[type=text] {
width: 86% !important;
}
.db_orangebtn{
	background:red; 
}
}
/* 
* {

text-align: center;
} */
.posting{
	text-align:left; 
	margin-left:85px;
	 margin-top:-54px;
	 font-size: 18px;
	}
</style>



<div id="testmodal-share" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Share Profiles Details</h4>

</div>
<div class="modal-body">
<p><b> </b><span id="user_name_share" style="font-size:18px;"></span></p>

</div> 
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>

</div>
</div>
</div>
</div>







<div id="testmodal" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Favourite Profiles Details</h4>

</div>
<div class="modal-body">
<p><b> </b><span id="user_name" style="font-size:18px;"></span></p>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>

</div>
</div>
</div>
</div>


<div id="testmodal-1" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Confirmation</h4>
</div>
<div class="modal-body">
<p>Do you want to save changes you made to document before closing?</p>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div></div>


<script>

$(document).ready(function(){
var show_btn=$('.show-modal-share');
var show_btn=$('.show-modal-share');
//$("#testmodal").modal('show');

show_btn.click(function(){
$("#testmodal-share").modal('show');
})
});

 


$(document).ready(function(){
var show_btn=$('.show-modal');
var show_btn=$('.show-modal');
//$("#testmodal").modal('show');

show_btn.click(function(){
$("#testmodal").modal('show');
})
});

$(function() {
$('#element').on('click', function( e ) {
Custombox.open({
target: '#testmodal-1',
effect: 'fadein'
});
e.preventDefault();
});
});


</script>




<script>


function postfunction_share(postid,username) {
//alert("===========");

$("#testmodal").modal('show');
//alert(postid);

$.ajax({
url: "timepost.php", 
type: "POST",
data: {

postid: postid

},
success: function(response) {

$("#user_name_share").html(response);

console.log(response); 
}

});
}




function openshare(postid,username) {
//alert("===========");

//$("#testmodal").modal('show');
//alert(postid);

$.ajax({
url: "sharepost.php", 
type: "POST",
data: {

postid: postid

},
success: function(response) {

$("#user_name_share").html(response);

console.log(response); 
}

});
}





function postfunction(postid,username) {
//alert("===========");

$("#testmodal").modal('show');
//alert(postid);

$.ajax({
url: "timepost.php", 
type: "POST",
data: {

postid: postid

},
success: function(response) {

$("#user_name").html(response);

console.log(response); 
}

});
}
</script>  


<script>
$(document).ready(function() {
// Load more data
$('.load-more').click(function() {
//alert('tttttttttttttttttttt');
var row = Number($('#row').val());
var allcount = Number($('#all').val());
row = row + 11;

if (row <= allcount) {

$("#row").val(row);
var profileid = $("#profiddd").val();


$.ajax({
url: 'more_timeline.php',
type: 'post',
data: {
row: row,
profile: profileid
},
beforeSend: function() {
$(".load-more").text("Loading...");
},
success: function(response) {

// Setting little delay while displaying new content
setTimeout(function() {
// appending posts after last post with class="post"
$(".post:last").after(response).show().fadeIn("slow");

$(".load-more").text("Load More");
var rowno = row + 11;

// checking row value is greater than allcount or not
if (rowno > allcount) {
$('.load-more').css("display", "none");
} else {
$(".load-more").text("Load more");
}

$(".load-more").text("Load More");
}, 2000);
}
});
} else {
$('.load-more').text("Loading...");

// Setting little delay while removing contents
setTimeout(function() {

// When row is greater than allcount then remove all class='post' element after 3 element
$('.post:nth-child(3)').nextAll('.post').remove().fadeIn("slow");

// Reset the value of row
$("#row").val(0);

// Change the text and background
$('.load-more').text("Load more");
$('.load-more').css("background", "#15a9ce");
}, 2000);
}
});
});
</script>
