<?php
/*ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);*/

include('../../univ/baseurl.php');
session_start();
if(isset($_SESSION['sign-up']) && $_SESSION['sign-up'] == 1){
  unset($_SESSION['sign-up']);
}
if (!isset($_SESSION['pid'])) {

$_SESSION['afterlogin'] = "freelancer/";
include_once("../../authentication/islogin.php");
} else {

function sp_autoloader($class)
{
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$activePage = 18;

$fps = new _freelance_project_status;


?>
<!DOCTYPE html>
<html lang="en-US">

<head>


<style>







</style>
<?php include('../../component/f_links.php'); ?>
<!--This script for posting timeline data End-->

<!-- ===== INPAGE SCRIPTS====== -->
<?php include('../../component/dashboard-link.php'); ?>
<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />


<!-- Design css  -->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">
</head>

<body class="bg_gray">
<?php
//session_start();

$header_select = "freelancers";
include_once("../../header.php");
?>
<?php if (isset($_SESSION['postfreelancer']) == 'yes') { ?>

<div class="alert alert-success pull-right" style="width: 500px;" id="div4">Project Posted Successfully!</div>

<?php 
unset($_SESSION['postfreelancer']);

}  if (isset($_SESSION['updatefreelancer']) == 'yes')  {?>

<div class="alert alert-success pull-right" style="width: 500px;" id="div4">Updated Successfully !</div>
<?php
unset($_SESSION['updatefreelancer']);
}
?>



<section class="main_box" id="freelancers-page">
<div class="container nopadding projectslist dashboardpage">
<div class="sidebar col-xs-3 col-sm-3" id="sidebar">
<?php include('left-menu.php'); ?>
</div>
<div class="col-xs-12 col-sm-9 nopadding">

<div class="col-sm-12 nopadding dashboard-section" style="margin-top: 24px;">
<div class="col-xs-12 dashboardbreadcrum">
<ul class="breadcrumb">
<li><a href="<?php echo $BaseUrl; ?>/freelancer/dashboard/poster_dashboard.php">Dashboard</a></li>
<li>ACTIVE PROJECTS</li>

</ul>
</div>
</div>

<!--  <div class="col-xs-12 nopadding dashboard-section freelancer_dashboard">
<div class="col-xs-12 dashboardbreadcrum freelancer_dashboard">
<ul class="breadcrumb freelancer_dashboard">
<li><a href="<?php // echo $BaseUrl;
?>/freelancer">Dashboard</a></li>
<li>Active Projects</li>

</ul>
</div> 
</div> -->
<style>
body {

background-color: #eee;
}

table th,
table td {
text-align: center;
}

table tr:nth-child(even) {
background-color: #e4e3e3
}

th {
background: #333;
color: #fff;
}

.pagination {
margin: 0;
}


div:where(.swal2-container).swal2-center>.swal2-popup {
   
   height: 297px;
     font-size: 15px;
 }

.pagination li:hover {
cursor: pointer;
}

.header_wrap {
padding: 30px 0;
}

.num_rows {
width: 20%;
float: left;
}

.tb_search {
width: 20%;
float: right;
}

.pagination-container {
width: 70%;
float: left;
}

.rows_count {
width: 20%;
float: right;
text-align: right;
color: #999;
}






.dashboardpage .dashboard-section .dashboardtable .table tbody tr td {
color: #282828;
font-size: 18px;
font-family: MarksimonRegular;
padding: 21px 8px 24px 11px;
}

#example1_wrapper {
padding-top: 10px;
}

.dataTables_length {
margin-left: 6px;
}

.example1 {
margin-right: 6px;
}

.dataTables_info {
margin-left: 6px;
}

.current {
margin-bottom: 6px;
}

#example1_filter input {
padding: 0 5px;
margin-right: 6px;
}

.disabled {
cursor: not-allowed;
color: #0e2d3c;
cursor: pointer;
}

button.btn.btn-primary.dropdown-toggle {
width: 110%;
}

.btn-xs,
.btn-group-xs>.btn {
padding: 1px 4px;
}

#profileDropDown li.active {
background-color: #c45508;
margin-top: -1px;
}

#profileDropDown li.active a {
color: #fff;
}

ul#profileDropDown {
border: none;
}
</style>
<style>
table.dataTable thead .sorting_desc:after {
content: "\e156" !important;
}
</style>

<?php $sf  = new _freelancerposting;

// print_r($_SESSION['pid']);

// $res = $p->client_publicpost(5, $_SESSION['pid']);

//    $res = $sf->clientbid_publicpost_posting(5, $_SESSION['pid']);
$res = $sf->client_publicpost1(5, $_SESSION['pid']);
//var_dump($res);


if ($res != false) {
$example = "example1";
} else {
$example = "example";
}

?>
<div class="col-xs-12 nopadding dashboard-section" style="margin-top: 10px;">

<div class="col-xs-12 dashboardtable">
<div class="table-responsive" style="overflow:hidden;">

<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<div class="container-fluid">
<!-- <div class="header_wrap"> -->
<div class="num_rows">

<!-- <div class="form-group">
Show Numbers Of Rows 		
<select class="form-control" name="state" id="maxRows">


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
</div> -->
</div>


<div class="table-responsive1" style="margin-top:10px;">
<!-- <table style="padding-top:5px;" class="table tbl_activebid" id="</?php echo $example;?>"> -->
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<table class="table table-striped table-class" id="example">
<thead style="background-color: #3e3e3e;color: #fff;">
<tr>
<!-- <th></th> -->
<th></th>
<th style="color:#fff;">ID</th>

<th style="color:#fff;">Project Name</th>
<th style="color:#fff;">Total Bids</th>
<th style="color:#fff;">Bid Price</th>
<th style="color:#fff;">Expire Date</th>
<!--<th style="color:#fff;">Created Date</th>-->
<th class="action" style="text-align: left;color:#fff;">Action</th>
</tr>
</thead>
<tbody>

<?php
$st = new _spuser;
$st1 = $st->readdatabybuyerid($_SESSION['uid']);
if ($st1 != false) {
$stt = mysqli_fetch_assoc($st1);
$account_status = $stt['deactivate_status'];
}
$sf  = new _freelancerposting;
$res = $sf->client_publicpost1(5, $_SESSION['pid']);

?>
<?php
if ($account_status != 1) {
$i = 1;
if ($res != false) {
while ($row = mysqli_fetch_assoc($res)) {
$dt = new DateTime($row['spPostingExpDt']);
$cr = new DateTime($row['spPostingDate']);
$sfbid = new  _freelance_placebid;
$bids = $sfbid->totalbids1($row['idspPostings']);
if ($bids) {
$totalbids = $bids->num_rows;
} else {
$totalbids = 0;
}
?>
<?php if ($row['spPostingExpDt'] > date('Y-m-d')) {
?>
<tr>
<td></td>
<td>
<?php echo $i; ?></td>
<!-- </?php if($row['spPostingVisibility'] == -1){  ?>  -->
<td title="<?php echo $row['spPostingTitle']; ?>"> <a href="<?php echo $BaseUrl . '/freelancer/project-detail.php?project=' . $row['idspPostings']; ?>" target="_blank" class="red freelancer_capitalize"><?php $record = $row['spPostingTitle'];
echo substr($record, 0, 15) . '...'; ?>
</a>

<!-- <a href="javascript:void(0)" class="red freelancer_capitalize"  ><?php echo $row['spPostingTitle']; ?></a> -->


</td>
<td><?php echo $totalbids; ?></td>
<td><?php echo  $row['Default_Currency'] . ' ' . $row['spPostingPrice']; ?></td>
<td><?php echo $dt->format('M d, Y'); ?></td>
<!--<td></?php echo $cr->format('M d, Y'); ?></td>-->

<td>
<a href="<?php echo $BaseUrl . '/post-ad/freelancer/?postid=' . $row['idspPostings']; ?>" data-original-title="Edit" data-toggle="tooltip" data-placement="top"> <i class="fa fa-pencil" ></i> </a>

<a href="<?php echo $BaseUrl . '/freelancer/dashboard/project-bid.php?postid=' . $row['idspPostings']; ?>" data-original-title="View Detail" data-toggle="tooltip" data-placement="top" > <i class="fa fa-eye"></i> </a>

<a onclick="delet('<?php echo $BaseUrl.'/freelancer/dashboard/deleteactive.php?postid='.$row['idspPostings']; ?>')"><i title="Delete" class="fa fa-trash" ></i></a>


<a onclick="deactivate(<?php echo $row['idspPostings']; ?>)" data-original-title="De-active" data-toggle="tooltip" data-placement="top" id="deact<?php echo $row['idspPostings']; ?>"><i class="fa fa-ban" aria-hidden="true" style="color: red;" <?php
if ($row['spPostingVisibility'] == -2) {
echo 'disabled';
}
?>></i>
</a>



<!-- <a onclick="activate(<?php echo $row['idspPostings']; ?>)" data-original-title="Activate" data-toggle="tooltip" data-placement="top" class="btn btn-xs menu-icon vd_bg-blue" id="act<?php echo $row['idspPostings']; ?>" ><i class="fa fa-unlock" aria-hidden="true" style="color:white;" 

<?php

if ($row['spPostingVisibility'] == -1) {
echo 'disabled';
}
?>


></i>
</a> -->
</td>

</tr>
<?php

}
$i++;
}
}
} else {
echo "<td colspan='6'><center>No Record Found</center></td>";
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

</div>
</div>
</div>
</div>
</div>
</div>
</section>

<br>
<br>
<br>
<br>
<br>
<br>
<br>

<?php
include('../../component/f_footer.php');
include('../../component/f_btm_script.php');
?>

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
</body>

</html>
<?php
} ?>

<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->

<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

<script>
var table = $('#example1').DataTable({
select: false,
"columnDefs": [{
className: "Name",
"targets": [0],
"visible": false,
"searchable": false,
order: [
[1, "desc"]
]
}]
});

function deactivate(visible) {
//alert(visible);

$.ajax({
type: "POST",
url: "deactive.php",
cache: false,
data: {
'visible': visible
},

success: function(data) {
$("#deact" + visible).addClass("disabled");
$("#act" + visible).removeClass("disabled");

}
});

}

function activate(visible) {
//alert(visible);

$.ajax({
type: "POST",
url: "activate.php",
cache: false,
data: {
'visible': visible
},

success: function(data) {
//$("#dash"+visible).attr("disabled");
$("#act" + visible).addClass("disabled");
$("#deact" + visible).removeClass("disabled");

}
});

}
setTimeout(function() {
$("#div4").hide();
}, 2000);
</script>


<script>
getPagination('#table-id');
$('#maxRows').trigger('change');

function getPagination(table) {

$('#maxRows').on('change', function() {
$('.pagination').html(''); // reset pagination div
var trnum = 0; // reset tr counter 
var maxRows = parseInt($(this).val()); // get Max Rows from select option

var totalRows = $(table + ' tbody tr').length; // numbers of rows 
$(table + ' tr:gt(0)').each(function() { // each TR in  table and not the header
trnum++; // Start Counter 
if (trnum > maxRows) { // if tr number gt maxRows

$(this).hide(); // fade it out 
}
if (trnum <= maxRows) {
$(this).show();
} // else fade in Important in case if it ..
}); //  was fade out to fade it in 
if (totalRows > maxRows) { // if tr total rows gt max rows option
var pagenum = Math.ceil(totalRows / maxRows); // ceil total(rows/maxrows) to get ..  
//	numbers of pages 
for (var i = 1; i <= pagenum;) { // for each page append pagination li 
$('.pagination').append('<li data-page="' + i + '">\
<span>' + i++ + '<span class="sr-only">(current)</span></span>\
</li>').show();
} // end for i 


} // end if row count > max rows
$('.pagination li:first-child').addClass('active'); // add active class to the first li 


//SHOWING ROWS NUMBER OUT OF TOTAL DEFAULT
showig_rows_count(maxRows, 1, totalRows);
//SHOWING ROWS NUMBER OUT OF TOTAL DEFAULT

$('.pagination li').on('click', function(e) { // on click each page
e.preventDefault();
var pageNum = $(this).attr('data-page'); // get it's number
var trIndex = 0; // reset tr counter
$('.pagination li').removeClass('active'); // remove active class from all li 
$(this).addClass('active'); // add active class to the clicked 


//SHOWING ROWS NUMBER OUT OF TOTAL
showig_rows_count(maxRows, pageNum, totalRows);
//SHOWING ROWS NUMBER OUT OF TOTAL



$(table + ' tr:gt(0)').each(function() { // each tr in table not the header
trIndex++; // tr index counter 
// if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
if (trIndex > (maxRows * pageNum) || trIndex <= ((maxRows * pageNum) - maxRows)) {
$(this).hide();
} else {
$(this).show();
} //else fade in 
}); // end of for each tr in table
}); // end of on click pagination list
});
// end of on select change 

// END OF PAGINATION 

}




// SI SETTING
$(function() {
// Just to append id number for each row  
default_index();

});

//ROWS SHOWING FUNCTION
function showig_rows_count(maxRows, pageNum, totalRows) {
//Default rows showing
var end_index = maxRows * pageNum;
var start_index = ((maxRows * pageNum) - maxRows) + parseFloat(1);
var string = 'Showing ' + start_index + ' to ' + end_index + ' of ' + totalRows + ' entries';
$('.rows_count').html(string);
}

// CREATING INDEX
function default_index() {
$('table tr:eq(0)').prepend('')

var id = 0;

$('table tr:gt(0)').each(function() {
id++
$(this).prepend('');
});
}

// All Table search script
function FilterkeyWord_all_table() {

// Count td if you want to search on all table instead of specific column

var count = $('.table').children('tbody').children('tr:first-child').children('td').length;

// Declare variables
var input, filter, table, tr, td, i;
input = document.getElementById("search_input_all");
var input_value = document.getElementById("search_input_all").value;
filter = input.value.toLowerCase();
if (input_value != '') {
table = document.getElementById("table-id");
tr = table.getElementsByTagName("tr");

// Loop through all table rows, and hide those who don't match the search query
for (i = 1; i < tr.length; i++) {

var flag = 0;

for (j = 0; j < count; j++) {
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
if (flag == 1) {
tr[i].style.display = "";
} else {
tr[i].style.display = "none";
}
}
} else {
//RESET TABLE
$('#maxRows').trigger('change');
}
}
</script>


<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script> 
<script>
function delet(a){
//alert(a);
Swal.fire({
title: 'Are you sure you want to delete ?',
text: "",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
cancelButtonText: 'No',
confirmButtonText: 'Yes'
}).then((result) => {
if (result.isConfirmed) {
window.location.href = a;
}
});

}
</script>
