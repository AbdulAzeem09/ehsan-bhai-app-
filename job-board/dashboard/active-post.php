<?php

error_reporting(0);
include('../../univ/baseurl.php');
session_start();

if($_SESSION['ptid'] != 1){
header('location:'.$BaseUrl.'/job-board/');
}

if(isset($_SESSION['sign-up']) && $_SESSION['sign-up'] == 1){
  $_SESSION['afterMembership']="/job-board/dashboard/active-post.php";
  header('location:'.$BaseUrl.'/membership/dash_index.php');
}

if(!isset($_SESSION['pid'])){
$_SESSION['afterlogin']="job-board/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


$_GET["categoryid"] = "2";
$_GET["categoryName"] = "Job Board";

$activePage = 2;

$header_jobBoard = "header_jobBoard";
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php');?>

<!-- ===== INPAGE SCRIPTS====== -->
<!-- High Charts script -->
<script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<?php include('../../component/dashboard-link.php'); ?>
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


div:where(.swal2-container).swal2-center>.swal2-popup {
 
 height: 303px;
 font-size: 15px;
}

#profileDropDown li.active {
background-color: #1f3060;
margin-top: -1px;
}
#profileDropDown li.active a {
color: white;
}
ul#profileDropDown {
border: none;
}
.tbl-color a
{
color:black !important;
}
</style>
</head>

<body class="bg_gray">
<?php
include_once("../../header.php");
?>


<?php if(isset($_GET['msg1']) && $_GET['msg1']=='post'){ ?>
<div  id="div2" class="alert alert-success pull-right" style="width: 50%;">Post a Job Successfully !</div>
<?php  } ?>


<?php if(isset($_GET['msg1']) && $_GET['msg1']=='uupdate'){ ?>

<div  id="div2" class="alert alert-success pull-right" style="width: 50%;">Update Successfully !</div>
<?php  } ?>
<section class="landing_page">
<div class="container">
<div class="row">
<?php //include('../thisisjobboard.php'); ?>
<div class="sidebar col-md-3 no-padding" id="sidebar" >
<?php include('left-menu.php'); ?>
</div>
<div class="col-md-9">


<div class="col-sm-12 nopadding dashboard-section whiteboardmain" style="margin-top: 7px;padding: 16px 0px 0px 0px;">
<div class="col-xs-12 dashboardbreadcrum">
<ul class="breadcrumb" >
<li><a href="<?php echo $BaseUrl;?>/job-board/dashboard"> Dashboard</a></li>
<li>Active Jobs</li>
<?php echo $title;?>
<!--   <a href="<?php /*echo $BaseUrl.'/post-ad/job-board/?post'; */?>" class="btn " style="float: right;background-color: #31abe3;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;">Post a job</a> -->
<!--  <a href="https://thesharepage.com/post-ad/freelancer/?post" class="btn post-project postproject" style="float: right;background-color: orange;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;" >Post a project</a> -->
</ul>
</div>
</div>


<div class="col-xs-12 col-sm-12 nopadding">
<div>
<?php
if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
if($_SESSION['count'] <= 1){
$_SESSION['count'] +=1; ?>
<div class="space"></div>
<!--<p class="alert alert-info"><?php echo $_SESSION['errorMessage'];  ?></p>---> <?php
unset($_SESSION['errorMessage']);
}
} ?>
</div>
</div>
<?php

?>

<!-- repeat able box -->
<div class="whiteboardmain" style="min-height: 300px; margin-top: 100px;">
<div class="row">
<div class="col-sm-12">


<div class="bg_white">

<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>


<div class="container-fluid">
<!-- partial:index.partial.html -->
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<table class="table table-striped table-class" id ="example">
<!-- <table id="example" class="display" cellspacing="0" width="100%" > -->
<thead>
<tr>
<th></th>
<th>ID</th>
<th>Job Title</th>
<th>Date Posted</th>
<th>Status</th>
<th>Applicants</th>
<th>Shortlisted</th>
<th>Action</th>
</tr>
</thead>




<tbody>
<?php

$st= new _spuser;
$st1=$st->readdatabybuyerid($_SESSION['uid']);
if($st1!=false){
$stt=mysqli_fetch_assoc($st1);
$account_status=$stt['deactivate_status'];
}
/*$m = new  _postingview;*/
$m = new  _jobpostings;
//$result = $m->mycatProduct($_GET['categoryid'], $_SESSION['pid']);
$result = $m->myProfilejobpost($_SESSION['pid']);
//echo $result->num_rows;



// echo $m->ta->sql;
if($account_status!=1){
if($result){
$i=0;
while ($row = mysqli_fetch_assoc($result)) {
$postDate = new DateTime($row['spPostingDate']);
?>
<tr class="">
<td style="padding-left: 21px;"><?php echo $i++; ?></td>
<td style="padding-left: 21px;"><?php echo $i; ?></td>
<td class="tbl-color"><a href="<?php echo $BaseUrl.'/job-board/dashboard/applicant.php?postid='.$row['idspPostings'];?>" ><?php echo ucfirst($row['spPostingTitle']);?></a></td>
<td style="padding-left: 21px;" ><?php echo $postDate->format('d-M-Y');?></td>
<td class="tbl-color" style="padding-left: 21px;" ><?php echo $row['posting_status']; ?></td>
<td  class="tbl-color"style="padding-left: 21px;" >
<a href="<?php echo $BaseUrl.'/job-board/dashboard/applicant.php?postid='.$row['idspPostings'];?>" >
<?php
$ac = new _sppost_has_spprofile;
$countAplicant = $ac->job($row["idspPostings"]);
if($countAplicant){
echo $countAplicant->num_rows;
}else{
echo 0;
}
?>
</a>
</td>
<td class="tbl-color"style="padding-left: 21px;" >  
<a href="<?php echo $BaseUrl.'/job-board/dashboard/applicant.php?postid='.$row['idspPostings'];?>" >
<?php
$sl = new _shortlist;
$countShortList = $sl->getshortlist($row["idspPostings"]);
if($countShortList){
echo $countShortList->num_rows;
}else{
echo 0;
}
?>
</a>            
</td>
<td style=" padding:6px;">
<!-- <a href="<?php echo $BaseUrl.'/post-ad/job-board/?postid='.$row['idspPostings'].'&repost=1';?>" class="btn btn-info">Repost</a> -->
<a href="<?php echo $BaseUrl.'/post-ad/job-board/?postid='.$row['idspPostings'];?>"><i class="fa fa-pencil"></i></a> 

<?php $a= $BaseUrl.'/post-ad/dopostjob.php?postid='.$row['idspPostings'].'&action=delete';?>

<a  onclick="delet('<?php echo $a;?>')"><i class="fa fa-trash"></i></a>

</td>
</tr> <?php
}
}}
?>
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
<script src="<?php echo $BaseUrl?>/assets/js/sweetalert.js"></script>
<!-- partial -->
<script>
function delet(a){
//alert(a);
Swal.fire({
title: 'Are you sure you want to delete ?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
confirmButtonText: 'Yes',
cancelButtonColor: '#FF0000',
cancelButtonText: 'No',
}).then((result) => {
        if (result.isConfirmed) {
            window.location.href = a;
        } else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
      });
}
</script>
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>
<script type="text/javascript">
$(document).ready(function() {
var table = $('#example').DataTable({
    "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
select: false,
"columnDefs": [{
className: "Name",
"targets":[0],
"visible": false,
"searchable":false
}]
    }
});//End of create main table
$('#example tbody').on( 'click', 'tr', function () {
// alert(table.row( this ).data()[0]);

} );
table.destroy();

});

setTimeout(function () {
$("#div2").hide();
}, 2000);

</script>


</div>
</div>
</div>
</div>
<!-- repeat able box end -->


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


<!-- 
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script> -->
<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
var table = $('#example').DataTable({
paging: true, // Enable pagination
select: false,
columnDefs: [{
className: "Name",
targets: [0],
visible: false,
searchable: false
}]
});

$('#example tbody').on('click', 'tr', function() {
// Handle row click event here
});
});
</script>
