<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include('../../univ/baseurl.php');
session_start();
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
$activePage = 5;
$header_jobBoard = "header_jobBoard";
?>
<style>
#example_filter{
margin-bottom: 6px;

}
table.dataTable thead .sorting:after {
opacity: 0.2;
content: ""!important;
}
.dataTables_empty{
text-align: center!important;

}
th.sorting {
font-size: 14px;
}	
span#car1 {
margin-top: 10px;
}
ul#profileDropDown {
border: none;
}

.form-group {
margin-top: 20px;
}
</style>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php');?>
<!--This script for sticky left and right sidebar STart-->


<!-- ===== INPAGE SCRIPTS====== -->
<!-- High Charts script -->
<script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
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
margin-top: 20px;
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


#profileDropDown li.active {
background-color: #1f3060;
margin-top: -1px;
}
#profileDropDown li.active a {
color: white;
}

</style>


</head>

<body class="bg_gray">
<?php
include_once("../../header.php");
?>
<style>
.inner_top_form button {
padding:9px 12px!important;
}

</style>
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
<ul class="breadcrumb">
<li><a href="<?php echo $BaseUrl;?>/job-board/dashboard/emp_dashboard.php">Dashboard</a></li>
<li>Saved Jobs</li>

</ul>
</div>
</div>

<div class="container-fluid">


<!-- repeat able box -->
<div class="whiteboardmain" style="min-height: 300px;margin-top: 100px;">
<div class="row">
<div class="col-sm-12">
<div class="table-responsive1" style="overflow-x:hidden;">
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<table class="table table-striped table-class" id= "example">

<!-- <table class="table table-striped tbl_jobboard text-center display" id="example"> -->
<thead class="">
<tr>
<th>Id</th>
<th>Id</th>
<th>Job Title</th>
<th>City</th>
<th>Status</th>
<th>Date Posted</th>
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
$m = new  _jobpostings;
//$result = $m->myDeactiveProfilejob($_SESSION['pid']);
$result = $m->mySaveJob_new($_GET['categoryid'], $_SESSION['pid']);
//echo $m->ta->sql;
if($account_status!=1){
if($result){
$ii=0;
while ($row = mysqli_fetch_assoc($result)) { 



$postDate = new DateTime($row['spPostingDate'])
?>
<tr>
<td><?php echo $ii++; ?></td>
<td><?php echo $ii; ?></td>
<td>

<?php 	
$res_id = $row['spPostings_idspPostings'];
$readdata = $m->readalldata($res_id);
if($readdata){
$row22 = mysqli_fetch_assoc($readdata);
?>
<a href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row['spPostings_idspPostings'];?>"><?php echo ucfirst($row22['spPostingTitle']) ?></a>
<?php } else {

echo 'job removed';

} ?>



</td>



<td>
<?php

$res_id = $row['spPostings_idspPostings'];
$readdata = $m->readalldata($res_id);
if($row22){
$row22 = mysqli_fetch_assoc($readdata);
}
$usercountry = $row22['spPostingsCountry'];
$userstate = $row22['spPostingsState'];
$usercity = $row22['spPostingsCity'];

$co = new _country;
$result3 = $co->readCountry();
if($result3 != false){
while ($row3 = mysqli_fetch_assoc($result3)) {
if(isset($usercountry) && $usercountry == $row3['country_id']){
$currentcountry = $row3['country_title']; 
$currentcountry_id = $row3['country_id']; 

}
}
}

if (isset($userstate) && $userstate > 0) {
$countryId = $currentcountry_id;
$pr = new _state;
$result2 = $pr->readState($countryId);
if($result2 != false){
while ($row2 = mysqli_fetch_assoc($result2)) { 
if(isset($userstate) && $userstate == $row2["state_id"] ){
$currentstate_id = $row2["state_id"];
$currentstate = $row2["state_title"];
}
}
}
}if (isset($usercity) && $usercity > 0) {
$stateId = $currentstate_id;
$co = new _city;
$result3 = $co->readCity($stateId);
// echo $co->ta->sql;
// die("======================+");
if($result3 != false){
while ($row3 = mysqli_fetch_assoc($result3)) { 
if(isset($usercity) && $usercity == $row3['city_id']){
$currentcity = $row3['city_title'];
$currentcity_id = $row3['city_id']; 
}                                                                                               }                                                                                             }
}  
if($currentcity == ""){
echo "job removed";
} else{                                                   
echo $currentcity;
}
?>
</td>

<td>
<?php echo $row22['posting_status']; ?>
<span >
<?php
$ac = new _sppost_has_spprofile;
$countAplicant = $ac->job($row['spPostings_idspPostings']);
if($countAplicant){
echo $countAplicant->num_rows;
}else{

}

?>
</span>
</td>

<td><?php echo $postDate->format('d-M-Y');?></td>
<td> <?php //$row['save_id']   ?>
<?php if($_SESSION['guet_yes'] != 'yes'){ 

?>

<a href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row['spPostings_idspPostings'];?>"  ><i class="fa fa-eye" ></i></a> 
<a href="javascript:void(0);" onclick="deleteexpire('<?php echo ($row['spPostings_idspPostings']); ?>');" data-postid="<?php echo $row['spPostings_idspPostings']; ?>" data-saveId="<?php echo ($row['save_id']); ?>"><i title="Delete" class="fa fa-trash" style="color:black;"></i></a>

<?php } ?>
</td>
</tr> <?php
}
}
}

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

<!-- partial -->

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

<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script> -->
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
function deleteexpire(postid) {
    Swal.fire({
title: 'Are You Sure You Want to Delete?',
text: "",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
cancelButtonText: 'No',
confirmButtonText: 'Yes'
}).then((result) => {
if (result.isConfirmed) {
$.ajax({
type: "GET",
url: "deletePost.php",
cache: false,
data: {
'postid': postid
},
success: function(data) {
//alert(data);
window.location.reload();
}
});
}
});

}
</script>
