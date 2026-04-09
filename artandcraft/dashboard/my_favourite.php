<?php

include('../../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "artandcraft/";
include_once("../../authentication/islogin.php");
} else {
function sp_autoloader($class)
{
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$_GET["categoryID"] = 13;

$activePage = 6;


?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php'); ?>


<!-- ===== INPAGE SCRIPTS====== -->
<!-- High Charts script -->
<script src="<?php echo $BaseUrl; ?>/assets/js/highcharts.js"></script>
<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<?php include('../../component/dashboard-link.php'); ?>

<style>
.dataTables_empty {
text-align: center !important;
}

.pro_detail_box{
margin: 5px !important; 
}
</style>
</head>

<body class="bg_gray">
<?php
$header_photo = "header_photo";
include_once("../../header.php");
?>

<section class="">
<div class="container-fluid">
<div class="row">
<div class="sidebar col-md-2 no-padding left_photo_menu" id="sidebar">
<?php include('left-menu.php'); ?>
</div>



<div class="col-md-10">
<div class="panel panel-default" style="margin-top:10px;">
<div class="panel-heading"> Dashboard / Favourites </div>
</div>
<div class="row  pro_detail_box">



<!---<div class="col-md-4">

</div>--->


<div class="col-md-12">



<style type="text/css">


body{

background-color: #eee; 
}

table th , table td{
text-align: center;
}

table tr:nth-child(even){
background-color: #e4e3e3
}

div:where(.swal2-container).swal2-center>.swal2-popup {

height: 297px;
font-size: 15px;
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




.paginate_button {
border-radius: 0 !important;
}

.fphoto {
float: left;
}

< !--pagination css -->body {
font-family: 'Roboto', sans-serif;
font-size: 14px;
line-height: 18px;
background: #f4f4f4;
}

.list-wrapper {
padding: 15px;
overflow: hidden;
}

.list-item {
display: contents;
border: 1px solid #EEE;
background: #FFF;
margin-bottom: 10px;
padding: 10px;
box-shadow: 0px 0px 10px 0px #EEE;
}

.list-item h4 {
color: #FF7182;
font-size: 18px;
margin: 0 0 5px;
}

.list-item p {
margin: 0;
}

.simple-pagination ul {
margin: 0 0 20px;
padding: 0;
list-style: none;
text-align: center;
}

.simple-pagination li {
display: inline-block;
margin-right: 5px;
}

.simple-pagination li a,
.simple-pagination li span {
color: #666;
padding: 5px 10px;
text-decoration: none;
border: 1px solid #EEE;
background-color: #FFF;
box-shadow: 0px 0px 10px 0px #EEE;
}

.simple-pagination .     {
color: #FFF;
background-color: #FF7182;
border-color: #FF7182;
}

.simple-pagination .prev.current,
.simple-pagination .next.current {
background: #e04e60;
}

#example1_filter label {
margin-bottom: 3px;
}

#example1_length label {
padding-top: 4px;
}

.dataTables_wrapper {
margin-left: -15px;
margin-right: -15px;
}
</style>



<?php


$p = new _postingviewartcraft;



$result = $p->event_favorite($_GET["categoryID"], $_SESSION['pid']);
?>


<div class="col-md-12 table-responsive" style="margin-top:10px;">



<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>

<div class="container-fluid">

<div class="num_rows">

<!--<div class="form-group"> 			Show Numbers Of Rows 		-->
<!-- <select class  ="form-control" name="state" id="maxRows">


<option value="10">10</option>
<option value="15">15</option>
<option value="20">20</option>
<option value="50">50</option>
<option value="70">70</option>
<option value="100">100</option>
<option value="5000">Show ALL Rows</option>
</select> -->

<!-- <div class="tb_search">
<input type="text" id="search_input_all" onkeyup="FilterkeyWord_all_table()" placeholder="Search.." class="form-control">
</div> -->
</div>


<!-- partial:index.partial.html -->
<!-- <table class="table tbl_store_setting display" id="example1" cellspacing="0" width="100%"> -->
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<table class="table table-striped table-class" id= "example">
<thead>
<tr style="background-color: #99068a;">
<th class="text-center"></th>
<th class="text-center">No.</th>

<th class="text-center">Title</th>
<th class="text-center">Price</th>
<th class="text-center">Action</th>


</tr>
</thead>
<tbody>
<?php
$p = new _postingviewartcraft;
$pl = new _favorites;
$st1 = new _orderSuccess;
$result = $pl->favorite_data($_SESSION['pid'], $_SESSION['uid']);
if ($result) {
$i = 1;
while ($r = mysqli_fetch_assoc($result)) {

// print_r($r);
$postid = $r['spPostings_idspPostings'];
$n = $st1->readname($postid);
//print_r($n);
//die('===========');
if ($n != false) {
$na = mysqli_fetch_assoc($n);
// print_r($na);
$title = $na['spPostingTitle'];
$curr = $na['defaltcurrency'];
//die('===========');
}

?>
<tr>
<td class="text-center"></td>
<td class="text-center"><?php echo $i; ?></td>
<td class="text-center"><a href="<?= $BaseUrl; ?>/artandcraft/detail.php?postid=<?php echo $na['idspPostings']; ?>"><?php echo $title; ?></a>
</td>
<?php if ($r1['discountphoto'] != false) { ?>
<td class="text-center"><?php echo $curr . ' ' . $na['discountphoto']; ?></td>
<?php } else { ?>
<td class="text-center"><?php echo $curr . ' ' . $na['spPostingPrice']; ?></td>
<?php } ?>

<td class="text-center" style="text-align: center;">

<a href="<?php echo $BaseUrl . '/artandcraft/detail.php?postid=' . $na['idspPostings']; ?>" data-original-title="View Detail" data-toggle="tooltip" data-placement="top" > <i class="fa fa-eye"></i> </a>
<!--<a href="<?php echo 'deletemyfevourite.php?postid=' . $r['id']; ?>" data-original-title="View Detail" data-toggle="tooltip" data-placement="top" class="btn btn-xs menu-icon vd_bg-blue"> <i class="fa fa-trash-o" style="font-size:16px"></i></a>--->
<a onclick="deletedata('<?php echo 'deletemyfevourite.php?postid=' . $r['id']; ?>')"><i title="Delete" class="fa fa-trash"></i></a>

<!--<a href="<?php //echo $BaseUrl.'/artandcraft/dashboard/delete_pro.php?postid='.$r1['idspOrder'];
?>" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn btn-xs menu-icon vd_bg-red"> <i class="fa fa-trash" aria-hidden="true"></i> </a>-->
</td>




<?php
$i++;
}
} ?>

</tr>


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
</div>
<!-- <div id="pagination-container"></div> -->
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
} ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
<script>
// jQuery Plugin: http://flaviusmatis.github.io/simplePagination.js/

var items = $(".list-wrapper .list-item");
var numItems = items.length;
var perPage = 4;

items.slice(perPage).hide();

$('#pagination-container').pagination({
items: numItems,
itemsOnPage: perPage,
prevText: "&laquo;",
nextText: "&raquo;",
onPageClick: function(pageNumber) {
var showFrom = perPage * (pageNumber - 1);
var showTo = showFrom + perPage;
items.hide().slice(showFrom, showTo).show();
}
});
</script>


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
$('table tr:eq(0)').prepend('')

var id = 0;

$('table tr:gt(0)').each(function(){	
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
function deletedata(a){
//alert(a);
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
window.location.href = a;
}
});

}
</script>

