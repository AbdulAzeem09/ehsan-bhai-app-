<?php
/*	error_reporting(E_ALL);
ini_set('display_errors', '1');*/

include('../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="store/";
include_once ("../authentication/check.php");

}else{
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


$_GET["categoryid"] = "2";
$_GET["categoryName"] = "Job Board";
$header_jobBoard = "header_jobBoard";

$activePage = 17;

if(isset($_GET['deleteid'])){
$deleteid=$_GET['deleteid'];

$fwrd = new _forwardjobs;
$result = $fwrd->delforwardjobs($deleteid,$_SESSION['pid']);

}

?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php');?>
<!--This script for posting timeline data End-->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl.'/assets/admin/css/dashboard.css';?>">
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl.'/assets/css/AdminLTE.min.css';?>">

<style>
body{

background-color: #eee; 
}

table th , table td{
text-align: center;
}

table tr:nth-child(even){
background-color: #e4e3e3
}

th {
background: #333;
color: #fff;
}

.pagination {
margin: 0;
}

.pagination li:hover{
cursor: pointer;
}

.header_wrap {
padding:30px 0;
}
.num_rows {
width: 20%;
float:left;
}
.tb_search{
width: 20%;
float:right;
}
.pagination-container {
width: 70%;
float:left;
}

.rows_count {
width: 20%;
float:right;
text-align:right;
color: #999;
}


.heartimg {
position: absolute !important;
right: 15px !important;
bottom: 47px !important; 
width: 30px !important;
}
#profileDropDown li.active {
background-color: #1f3060;
}
#profileDropDown li.active a {
color: white;
}
ul#profileDropDown {
border: none;
}				</style>
</head>

<body class="bg_gray">
<?php
include_once("../header.php");
?>
<!--Adding new Resume modal-->
<div class="modal fade jobseeker" id="addnews" tabindex="-1" role="dialog" aria-labelledby="resumeModalLabel">
<div class="modal-dialog sharestorepos" role="document">
<div class="modal-content no-radius" >
<form action="<?php echo $BaseUrl.'/job-board/addnews.php';?>" id="add_news_frm" method="post">      
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h3 class="modal-title" id="resumeheadr">Add News</h3>
</div>
<div class="modal-body">

<input type="hidden" id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" value="<?php echo $_SESSION['pid'];?>">
<div class="form-group">
<label for="recipient-name" class="control-label"><h4>Title</h4></label>
<input type="text" class="form-control no-radius" id="cmpanynewsTitle" name="cmpanynewsTitle" />
<span id="title_err" style="color: red;"></span>
</div>
<div class="form-group">
<label for="recipient-name" class="control-label"><h4>Description</h4></label>
<textarea class="form-control no-radius" id="cmpanynewsDesc" maxlength="200"  name="cmpanynewsDesc"></textarea>
<span id="cdesc_err" style="color: red;"></span>
</div>


</div>
<div class="modal-footer" class="uploadupdate">
<button type="button" class="btn butn_cancel" data-dismiss="modal">Cancel</button>
<button type="button" id="sub_news" class="btn btn-submit" style='background-color: #31abe3!important;border:0px!important;    color: #fff;background-image: unset;
'>Add</button>
</div>
</form>
</div>
</div>
</div>
<!--Adding new resume modal complete-->
<section class="landing_page">
<div class="container">
<div class="row">

<?php ///include('thisisjobboardfront.php'); ?> 

<div class="col-md-3 no-padding sidebar">
<?php include('dashboard/left-menu.php'); ?> 
<?php 

if($_SESSION['ptid'] == 1){

$pageLink = 'job-board';
?>


<!-- <div>
<div class="whitejobbox text-center">
<?php
//include('/job-board/dashboard/left-menu.php');
if($_SESSION['ptid'] == 1){ ?>
<a href="<?php echo $BaseUrl.'/job-board/news.php';?>"><p>Company News</p></a>
<?php
}
?>
<a href="<?php echo $BaseUrl.'/job-board/showsavejobs.php';?>"><p>Saved Jobs</p></a>
</div>
<div class="m_btm_15">
<?php
$limit = 3;
$p   = new _postingview;

$sql = $p->publicpost_left_company($limit, 2);
//echo $p->ta->sql;

if($sql){
while ($sql_res = mysqli_fetch_assoc($sql)) {
//my active jobs
$result2 = $p->myProfilejobpost($sql_res['idspProfiles']);
if($result2){
$Myactivejob = $result2->num_rows;
}else{
$Myactivejob = 0;
} ?>
<div class="leftPostCmpny text-center"> 
<a href="<?php echo $BaseUrl.'/job-board/company.php?cmpyid='.$sql_res['idspProfiles'];?>">
<div class="boxGraph">
<h2><?php echo $sql_res['spProfileFieldValue'];?></h2>
<p><?php echo $Myactivejob;?> posting jobs</p>
</div>
</a>
</div>
<?php
}
}
?>
</div>
</div> -->
<?php
//   include('/job-board/dashboard/left-menu.php');
}
?>

</div>
<div class="col-md-9">

<!-- <div class="whiteboardmain m_btm_10" style="padding: 5px;">
<div class="row"> -->
<div class="col-sm-12 nopadding dashboard-section whiteboardmain" style="margin-top: 7px;padding: 16px 0px 0px 0px;">
<div class="col-xs-12 dashboardbreadcrum">
<ul class="breadcrumb">
<li><a href="<?php echo $BaseUrl;?>/job-board/dashboard"> Dashboard</a></li>
<li>Forwarded Jobs</li>
<!-- <li><?php echo $title;?></li> -->

<!-- <a href="<?php echo $BaseUrl.'/post-ad/job-board/?post';?>" class="btn " style="float: right;background-color: #31abe3;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;">Post a job</a> -->



<!-- <a href="https://thesharepage.com/post-ad/freelancer/?post" class="btn post-project postproject" style="float: right;background-color: orange;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;" >Post a project</a> -->
</ul>
</div>
</div>
<!--  <div class="col-md-12 text-right">

</div> -->
<!--  </div>
</div> -->

<!-- repeat able box -->
<div class="whiteboardmain" style="min-height: 300px;margin-top: 108px;">

<div class="row">
<div class="col-sm-12">
<div class="table-responsive">

<div class="bg_white">

<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>
<div class="container-fluid">
<div class="header_wrap">
<div class="num_rows">

<div class="form-group"> 	<!--		Show Numbers Of Rows 		-->
<select class  ="form-control" name="state" id="maxRows">


<option value="10">10</option>
<option value="15">15</option>
<option value="20">20</option>
<option value="50">50</option>
<option value="70">70</option>
<option value="100">100</option>
<option value="5000">Show ALL Rows</option>
</select>

</div>
</div>
<div class="tb_search">
<input type="text" id="search_input_all" onkeyup="FilterkeyWord_all_table()" placeholder="Search.." class="form-control">
</div>
</div>
<!-- partial:index.partial.html -->
<table class="table table-striped table-class" id= "table-id">

<!-- <table id="example" class="display" cellspacing="0" width="100%" > -->
<thead>
<tr>
<!-- <th>ID</th>
<th>ID</th> -->
<th>Job Title</th>
<th>Date Posted</th>
<th>Status</th>
<th>Forwarded By</th>
<th>Action</th>
</tr>
</thead>

<!-- <tfoot>
<tr>
<th>ID</th>
<th>ID</th>
<th>Job Title</th>
<th>Date Posted</th>
<th>Status</th>
<th>Forwarded By</th>
<th>Action</th>
</tr>
</tfoot>
-->

<tbody>
<?php
//print_r($_SESSION);
$fwrd = new _forwardjobs;
$result = $fwrd->readFwrdJob($_SESSION['pid']);

if($result){

while($row = mysqli_fetch_array($result)){	

//die('====66==');									
$p = new _jobpostings;
$res = $p->singletimelines($row['frwJobId']);
$rowjob = mysqli_fetch_array($res);
?>
<tr>
<!-- <td>1</td>
<td>1</td> -->
<td><a href="/job-board/job-detail.php?postid=<?php echo $rowjob['idspPostings']; ?>"><?php echo $rowjob['spPostingTitle']; ?></a></td>
<td><?php $postDate = new DateTime($rowjob['spPostingDate']); echo $postDate->format('d-M-Y'); ?></td>
<td><?php echo $rowjob['posting_status']; ?></td>
<td><a href="/job-board/user-profile.php?pid=<?php echo $row['frwSenderId']; ?>"><?php 
$prs = new _spprofiles;
$result12 = $prs->read($row['frwSenderId']);
if($result12!=false){			
$resprofile = mysqli_fetch_array($result12);
echo $resprofile['spProfileName'];
}?></a></td>
<td>



<!-- <?php
$sj = new _save_job;

$result2 = $sj->chekJobSave($rowjob['idspPostings'], $_SESSION['pid']);
if($result2){
if($result2->num_rows > 0){
$row2 = mysqli_fetch_assoc($result2);
?>
<a href="<?php echo $BaseUrl.'/job-board/savejob.php?unsave='?><?= $row2['save_id'];?>"><img src="assets/img/icons/heart.png" class="heartimg"></a> <?php
}else{ ?>
<a href="<?php echo $BaseUrl.'/job-board/savejob.php?postid='?><?= $rowjob['idspPostings'];?>"><img src="assets/img/icons/hollow.png" class="heartimg"></a> <?php
}
}else{ ?>  
<a href="<?php echo $BaseUrl.'/job-board/savejob.php?postid='?><?= $rowjob['idspPostings'];?>"><img src="assets/img/icons/hollow.png" class="heartimg"></a> <?php
}

?> -->
<!--	<a href="javascript:void(0);" class="disable-btn"><i style="color: red;font-size: 29px;" class="fa fa-heart disable-btn" data-disableid=""></i></a>  -->


<?php  $href='/job-board/forwarded-Jobs.php?deleteid=' . $row['frwId']; ?>

<a onclick="permanentDelete('<?php echo $href ?>')" ><i style="color: red;" class="fa fa-trash"></i></a>
</td>
</tr>
<?php } }?>	
</tbody>

</table>
<!--		Start Pagination -->
<div class='pagination-container'>
<nav>
<ul class="pagination">
<!--	Here the JS Function Will Add the Rows -->
</ul>
</nav>
</div>

</div> <!-- 		End of Container -->
<!-- partial -->

<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

<script type="text/javascript">
$(document).ready(function() {

var table = $('#example').DataTable({ 
select: false,
"columnDefs": [{
className: "Name", 
"targets":[0],
"visible": false,
"searchable":false
}]
});//End of create main table


$('#example tbody').on( 'click', 'tr', function () {

// alert(table.row( this ).data()[0]);

} );
});
</script>


</div>







</div>
</div>
</div>
</div>
<!-- repeat able box end -->


</div>
</div>
</div>
</section>
<script type="text/javascript">

$(document).ready(function(){
$("#esub_news").click(function(){


var cmpanynewsTitle = $("#ecmpanynewsTitle").val();
var cmpanynewsDesc = $("#ecmpanynewsDesc").val();


if(cmpanynewsTitle == "" && cmpanynewsDesc == ""){

$("#etitle_err").text("Please Enter Title.");
$("#ecdesc_err").text("Please Enter Description.");

//alert("here1");

}else if(cmpanynewsTitle == "") {

$("#title_err").text("Please Enter Title.");
$("#cdesc_err").text("");

//alert("here2");

}else if(cmpanynewsDesc == ""){

//alert("here3");
$("#etitle_err").text("");
$("#ecdesc_err").text("Please Enter Description");



}else{

//alert("here1");

$("#edit_news_frm").submit();
}

});

$("#sub_news").click(function(){


var cmpanynewsTitle = $("#cmpanynewsTitle").val();
var cmpanynewsDesc = $("#cmpanynewsDesc").val();


if(cmpanynewsTitle == "" && cmpanynewsDesc == ""){

$("#title_err").text("Please Enter Title.");
$("#cdesc_err").text("Please Enter Description.");

//alert("here1");

}else if(cmpanynewsTitle == "") {

$("#title_err").text("Please Enter Title.");
$("#cdesc_err").text("");

//alert("here2");

}else if(cmpanynewsDesc == ""){

//alert("here3");
$("#title_err").text("");
$("#cdesc_err").text("Please Enter Description");



}else{

//alert("here1");

$("#add_news_frm").submit();
}

});



}); 


</script>
<?php 
include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>
</body>
</html>
<?php
} ?>

<!-- 
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
<script>

getPagination('#table-id');
$('#maxRows').trigger('change');
function getPagination (table){

$('#maxRows').on('change',function(){
$('.pagination').html('');						// reset pagination div
var trnum = 0 ;									// reset tr counter 
var maxRows = parseInt($(this).val());			// get Max Rows from select option

var totalRows = $(table+' tbody tr').length;		// numbers of rows 
$(table+' tr:gt(0)').each(function(){			// each TR in  table and not the header
trnum++;									// Start Counter 
if (trnum > maxRows ){						// if tr number gt maxRows

$(this).hide();							// fade it out 
}if (trnum <= maxRows ){$(this).show();}// else fade in Important in case if it ..
});											//  was fade out to fade it in 
if (totalRows > maxRows){						// if tr total rows gt max rows option
var pagenum = Math.ceil(totalRows/maxRows);	// ceil total(rows/maxrows) to get ..  
//	numbers of pages 
for (var i = 1; i <= pagenum ;){			// for each page append pagination li 
$('.pagination').append('<li data-page="'+i+'">\
<span>'+ i++ +'<span class="sr-only">(current)</span></span>\
</li>').show();
}											// end for i 


} 												// end if row count > max rows
$('.pagination li:first-child').addClass('active'); // add active class to the first li 


//SHOWING ROWS NUMBER OUT OF TOTAL DEFAULT
showig_rows_count(maxRows, 1, totalRows);
//SHOWING ROWS NUMBER OUT OF TOTAL DEFAULT

$('.pagination li').on('click',function(e){		// on click each page
e.preventDefault();
var pageNum = $(this).attr('data-page');	// get it's number
var trIndex = 0 ;							// reset tr counter
$('.pagination li').removeClass('active');	// remove active class from all li 
$(this).addClass('active');					// add active class to the clicked 


//SHOWING ROWS NUMBER OUT OF TOTAL
showig_rows_count(maxRows, pageNum, totalRows);
//SHOWING ROWS NUMBER OUT OF TOTAL



$(table+' tr:gt(0)').each(function(){		// each tr in table not the header
trIndex++;								// tr index counter 
// if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
if (trIndex > (maxRows*pageNum) || trIndex <= ((maxRows*pageNum)-maxRows)){
$(this).hide();		
}else {$(this).show();} 				//else fade in 
}); 										// end of for each tr in table
});										// end of on click pagination list
});
// end of on select change 

// END OF PAGINATION 

}	




// SI SETTING
$(function(){
// Just to append id number for each row  
default_index();

});

//ROWS SHOWING FUNCTION
function showig_rows_count(maxRows, pageNum, totalRows) {
//Default rows showing
var end_index = maxRows*pageNum;
var start_index = ((maxRows*pageNum)- maxRows) + parseFloat(1);
var string = 'Showing '+ start_index + ' to ' + end_index +' of ' + totalRows + ' entries';               
$('.rows_count').html(string);
}

// CREATING INDEX
function default_index() {
$('table tr:eq(0)').prepend('<th> ID </th>')

var id = 0;

$('table tr:gt(0)').each(function(){	
id++
$(this).prepend('<td>'+id+'</td>');
});
}

// All Table search script
function FilterkeyWord_all_table() {

// Count td if you want to search on all table instead of specific column

var count = $('.table').children('tbody').children('tr:first-child').children('td').length; 

// Declare variables
var input, filter, table, tr, td, i;
input = document.getElementById("search_input_all");
var input_value =     document.getElementById("search_input_all").value;
filter = input.value.toLowerCase();
if(input_value !=''){
table = document.getElementById("table-id");
tr = table.getElementsByTagName("tr");

// Loop through all table rows, and hide those who don't match the search query
for (i = 1; i < tr.length; i++) {

var flag = 0;

for(j = 0; j < count; j++){
td = tr[i].getElementsByTagName("td")[j];
if (td) {

var td_text = td.innerHTML;  
if (td.innerHTML.toLowerCase().indexOf(filter) > -1) {
//var td_text = td.innerHTML;  
//td.innerHTML = 'shaban';
flag = 1;
} else {
//DO NOTHING
}
}
}
if(flag==1){
tr[i].style.display = "";
}else {
tr[i].style.display = "none";
}
}
}else {
//RESET TABLE
$('#maxRows').trigger('change');
}
}
</script>

<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script> 
    <script>
        function permanentDelete(userId) {
        Swal.fire({
        title: 'Are You Sure You Want to Delete?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete!'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = userId;
        }
        });
        }
    </script>  
