<?php
include('../../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "real-estate/";
include_once("../../authentication/islogin.php");
} else {
function sp_autoloader($class)
{
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$_GET["categoryID"] = "3";
$_GET["categoryName"] = "Realestate";
$header_realEstate = "realEstate";
$activePage = 3;
?>



<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php'); ?>
<!--This script for sticky left and right sidebar STart-->


<!-- ===== INPAGE SCRIPTS====== -->
<!-- High Charts script -->
<script src="<?php echo $BaseUrl; ?>/assets/js/highcharts.js"></script>
<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<?php include('../../component/dashboard-link.php'); ?>
</head>
<style>


body{

background-color: #eee; 
}
div:where(.swal2-container).swal2-center>.swal2-popup {
    height: 297px;
    font-size: 15px;
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

.dataTables_wrapper {
margin-top: 5px;

}

ul#profileDropDown {
border: none;
}

#profileDropDown li.active {
background-color: #95ba3d !important;
}

#profileDropDown li.active a {
color: #fff !important;
}
</style>

<body class="bg_gray">
<?php include_once("../../header.php"); ?>

<section class="realTopBread" style="padding:0px;">
<div class="container">
<div class="row">
<div class="col-md-6">

<div class="text-left agentbreadCrumb" style="margin-top: 10px;margin-bottom: -15px;">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a style="font-size: 14px;color:white!important;" href="<?php echo $BaseUrl . '/real-estate/dashboard/'; ?>">Dashboard</a></li>
<li style="font-size: 14px;" class="breadcrumb-item active">Rent Room</li>
</ol>

</div>
</div>
<div class="col-md-6">
<div class="text-right">

</div>
</div>
</div>

</div>
</section>


<section class="" style="padding: 40px;">
<div class="container">
<div class="row">
<div class="col-md-12 realDashboard no-padding">
<?php //include('top-dashboard.php');
?>
</div>
</div>
<div class="space"></div>
<div class="row" style="min-height: 400px;">
<div class="sidebar col-md-3 no-padding left_real_menu" id="sidebar">
<?php include('left-menu.php'); ?>
</div>

<div class="col-md-9 bg_white">

<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>


<div class="container-fluid">

<!-- partial:index.partial.html -->
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<table class="table table-striped table-class" id= "example">
<!-- <table id="example" class="display" cellspacing="0" width="100%"> -->
<thead>
<tr>

<th>Id</th>
<th>ID</th> 
<th>Property Title</th>
<th>Price</th>
<th>Property Type</th>
<th>Status</th>
<th>Posting Date</th>
<th>Action</th>
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


$p = new _realstateposting;
$pf  = new _postfield;
$type = "Rent";
$defaultType = "Rent A Room"; 
$i = 1;
$result2 = $p->myPropertyWithType($_GET['categoryID'], $_SESSION['pid'], $type, $defaultType);

//$result2 = $p->publicpost_event($_GET['categoryID']);
//$result2 = $p->getAgetsReal($_GET['categoryID']);
//echo $p->ta->sql;
if ($account_status != 1) {
if ($result2 != false) {

while ($row2 = mysqli_fetch_assoc($result2)) {
$propertyType = "";
$proStatus = "";

$propertyType = $row2['spPostingPropertyType'];
$proStatus = $row2['spPostingPropStatus'];
/*if($proStatus==0){
$proStatus="Deactive";
}
if($proStatus==-1){
$proStatus="Active";
}*/

//print_r($row2);

/*$result_pf = $pf->read($row2['idspPostings']);
if($result_pf){
$propertyType = "";
$proStatus = "";

while ($row3 = mysqli_fetch_assoc($result_pf)) {

if($propertyType == ''){
if($row3['spPostFieldName'] == 'spPostingPropertyType_'){
$propertyType = $row3['spPostFieldValue'];
}
}
if($proStatus == ''){
if($row3['spPostFieldName'] == 'spPostingPropStatus_'){
$proStatus = $row3['spPostFieldValue'];
}
}
}
}*/
?>
<tr>
<td><?php echo $i; ?></td>
<td><?php echo $i; ?></td>
<td>
<a href="<?php echo $BaseUrl . '/real-estate/room-detail.php?postid=' . $row2['idspPostings']; ?>"><?php echo $row2['spPostingTitle']; ?></a>
</td>
<td><?php echo $row2['defaltcurrency'] . ' ' . $row2['spPostRentalMonth']; ?></td>
<td><?php echo $propertyType; ?></td>
<td><?php echo $proStatus; ?></td>
<td><?php echo $row2['spPostingDate']; ?></td>
<td>
<a href="<?php echo $BaseUrl . '/post-ad/real-estate/?type=2&postid=' . $row2['idspPostings']; ?>"><i  style="color: #428bca" title="Edit" class="fa fa-pencil"></i></a>
&nbsp;&nbsp;
<a href="javascript:void(0);" onclick="doyouwant('deactivate',<?php echo $row2['idspPostings']; ?>)" class="disable-btn" data-work="deactive" data-Id="<?php echo $row2['idspPostings']; ?>"><i style="color: red;" title="Deactivate" class="fa fa-ban disable-btn" ></i></a>
&nbsp;&nbsp;
<a href="javascript:void(0);" onclick="doyouwant('delete',<?php echo $row2['idspPostings']; ?>)" class="disable-btn" data-work="delete" data-Id="<?php echo $row2['idspPostings']; ?>"><i style="color: red;" title="Delete" class="fa fa-trash disable-btn" ></i></a>
</td>
</tr>
<?php
$i++;
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
select: false,
"columnDefs": [{
className: "Name",
"targets": [0],
"visible": false,
"searchable": false
}]
}); //End of create main table


$('#example tbody').on('click', 'tr', function() {

// alert(table.row( this ).data()[0]);

});
table.destroy();
});
</script>

<script>
function doyouwant(work,dataId){

// alert(work);
if (work == 'deactivate') {
   // alert('=========');  
Swal.fire({
title: "Do you want deactive this listing?", 
/*text: "You Want to Logout!",*/
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes, Deactive!",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "Cancel",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
window.location.href = '/real-estate/dashboard/delete_rent_room.php?postid=' + dataId + '&work=' + work;
}
});

}
if (work == 'delete') {
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
window.location.href = '/real-estate/dashboard/delete_rent_room.php?postid=' + dataId + '&work=' + work;
}
});
}
}

</script>
<script type="text/javascript">
$(document).ready(function() {
$(document).on("click", ".disable-btn", function() {
//     var dataId = $(this).attr("data-Id");
//     alert(dataId);
//     var work = $(this).attr("data-work");
//    alert(work);
// if (work == 'deactive') {
//     swal({
//             title: "Do you want deactive this listing?",
//             /*text: "You Want to Logout!",*/
//             type: "warning",
//             confirmButtonClass: "sweet_ok",
//             confirmButtonText: "Yes, Deactive!",
//             cancelButtonClass: "sweet_cancel",
//             cancelButtonText: "Cancel",
//             showCancelButton: true,
//         },
//         function(isConfirm) {
//             if (isConfirm) {
//                 window.location.href = '/real-estate/dashboard/delete_rent_room.php?postid=' + dataId + '&work=' + work;
//             }
//         });

// }
// if (work == 'delete') {
//     swal({
//             title: "Do you want delete this listing?",
//             /*text: "You Want to Logout!",*/
//             type: "warning",
//             confirmButtonClass: "sweet_ok",
//             confirmButtonText: "Yes, Delete!",
//             cancelButtonClass: "sweet_cancel",
//             cancelButtonText: "Cancel",
//             showCancelButton: true,
//         },
//         function(isConfirm) {
//             if (isConfirm) {
//                 window.location.href = '/real-estate/dashboard/delete_rent_room.php?postid=' + dataId + '&work=' + work;
//             }
//         });
// }

// alert(dataId);
});
});

// function deactiveProp(propId){ 
//     swal({
//           title: "Do You Want Delete this User?",
//           /*text: "You Want to Logout!",*/
//           type: "warning",
//           confirmButtonClass: "sweet_ok",
//           confirmButtonText: "Yes, Delete!",
//           cancelButtonClass: "sweet_cancel",
//           cancelButtonText: "Cancel",
//           showCancelButton: true,
//         },
//     function(isConfirm) {
//       if (isConfirm) {
//        window.location.href = <?php //echo $BaseUrl.'/real-estate/dashboard/deactivate_post.php?postid='
?> + propId;
//       } 
//     });
// }
</script>

</div>
</div>
</div>
</section>

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
}
?>
<script src='<?php echo $baseurl?>/assets/js/sweetalert.js'></script>

<!--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script> -->
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
// function default_index() {
//   $('table tr:eq(0)').prepend('<th> ID </th>')

// 					var id = 0;

// 					$('table tr:gt(0)').each(function(){	
// 						id++
// 						$(this).prepend('<td>'+id+'</td>');
// 					});
// }

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
