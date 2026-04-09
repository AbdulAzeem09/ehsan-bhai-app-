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
$_GET['categoryID'] = 1;
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php');?>
<!-- ===== INPAGE SCRIPTS====== -->
<?php include('../../component/dashboard-link.php'); ?>

</head>

<body class="bg_gray">
<?php


//this is for store header
$header_store = "header_store";

include_once("../../header.php");
?>
<section class="main_box">
<div class="container">
<div class="row">
<!--   <div class="sidebar col-md-2 no-padding left_store_menu" id="sidebar" >
<?php 
$activePage = 3;
//include('left-menu.php'); 
?> 
</div> -->
<div id="sidebar" class="col-md-2 hidden-xs no-padding">
<div class="left_grid store_left_cat">
<?php
include('left-sellermenu.php'); 
?>
</div>
</div>
<div class="col-md-10">                        

<?php 
$storeTitle = " Dashboard / De-activate Products";
// include('../top-dashboard.php');
// include('../searchform.php');                       
?>

<div class="row ">  


<!--      <div class="col-md-12">
<ul class="breadcrumb" style="background-color: #fff;">
<li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php';?>">Seller Dashboard</a></li>
<li><a href="#">De-activate Products</a></li>

</ul>
<div class="text-right">
<ul class="dualDash"   style="float:left!important;">
<li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?>" class="<?php echo ($activePage == 21 || $activePage == 2 || $activePage == 3 || $activePage == 4 || $activePage == 5 || $activePage == 6 || $activePage == 14 || $activePage == 16 || $activePage == 18 || $activePage == 20 || $activePage == 22 || $activePage == 8 || $activePage == 9 || $activePage == 10 || $activePage == 11 || $activePage == 12 || $activePage == 13)?'active':''?>">Seller Dashboard</a></li>
<li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>" class="<?php echo ($activePage == 1 || $activePage == 15 || $activePage == 7 || $activePage == 23 || $activePage == 24)?'active':''?>">Buyer Dashboard</a></li>
</ul>
</div>
</div>


-->
<div class="col-md-12">
<ul class="breadcrumb" style="background: white !important;">
<li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php';?>">Seller Dashboard</a></li>
<li><a href="#">De-activated Products</a></li>

</ul>
</div>



<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">

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


.paginate_button {
border-radius: 0 !important;
}
</style>


<div class="col-md-12 ">
<div class="">
<?php 
$p = new _productposting;
$visilty = -2;
//$result = $p->myStoreProduct($_SESSION['pid']);
$result = $p->myProductVis($_SESSION['pid'], $visilty, $_GET['categoryID']);
if ($result!=false) {
$tableid="example";
}
else{
$tableid='';
}

?>

<div class="container-fluid">
<!-- <div class="header_wrap"> -->
<div class="num_rows">

<!-- <div class="form-group"> 		Show Numbers Of Rows
<select class  ="form-control" name="state" id="maxRows">


<option value="10">10</option>
<option value="20">15</option>
<option value="30">20</option>
<option value="50">50</option>
<option value="70">70</option>
<option value="100">100</option>
<option value="5000">Show ALL Rows</option>
</select>

</div>
</div>
<div class="tb_search">
<input type="text" id="search_input_all" onkeyup="FilterkeyWord_all_table()" placeholder="Search.." class="form-control">
</div>  -->
</div>

<div class="table-responsive1">
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<table class="table table-striped table-class tbl_store_setting display" id= "example">

<!-- <table class="table tbl_store_setting display" id="<?php echo $tableid;?>" cellspacing="0" width="100%" > -->
<thead>
<tr>

<!--<th class="text-center" style="width: 50px;">No</th>--->
<th></th>
<th>Title</th>
<th>Price</th>
<th>Posting Date</th>
<th>Expiry Date</th>
<th class="text-center">Action</th>
</tr>
</thead>

<?php
$userid=$_SESSION['uid'];


$c= new _orderSuccess;


$currency= $c->readcurrency($userid);
$res1= mysqli_fetch_assoc($currency);
$curr=$res1['currency'];
$st= new _spuser;
$st1=$st->readdatabybuyerid($_SESSION['uid']);
if($st1!=false){
$stt=mysqli_fetch_assoc($st1);
$account_status=$stt['deactivate_status'];
}
$p = new _productposting;
$visilty = -2;
//$result = $p->myStoreProduct($_SESSION['pid']);
$result = $p->myProductVis($_SESSION['pid'], $visilty, $_GET['categoryID']);
if($account_status!=1){	
if ($result!=false) {?>
<tbody>
<?php $i = 1;
while ($row = mysqli_fetch_assoc($result)) {
//print_r($row);
$dt = new DateTime($row['spPostingDate']);
$edt = new DateTime($row['spPostingExpDt']);
?>
<tr>

<!--<td><?php echo $i; ?></td>--->
<td></td>
<td><a href="<?php echo $BaseUrl;?>/store/detail.php?catid=1&postid=<?php echo $row['idspPostings']; ?>"><?php echo $row['spPostingTitle'];?></a></td>
<td><?php echo $curr.' '.$row['spPostingPrice']; ?></td>
<td><?php echo $dt->format('d M Y'); ?></td>
<td><?php echo $edt->format('d M Y'); ?></td>

<td class="text-center">
<a href="<?php echo $BaseUrl.'/post-ad/sell/?postid='.$row['idspPostings']; ?>"><i style="color: #428bca" title="Edit" class="fa fa-pencil" ></i></a>
<a href="javascript:void(0)" data-postid="<?php echo $row['idspPostings']; ?>" class="delpost" ><i title="Delete" class="fa fa-trash" ></i></a>

<a onclick="activate('<?php echo $BaseUrl.'/store/dashboard/reactivate_product.php?postid='.$row['idspPostings']; ?>')"  class="btn btn-submit" style="border-radius: 20px!important;min-width: 85px;color:#fff;">Activate</a>

<!-- <button id="spPostactiveproduct" type="button" class="btn btn-submit" style="border-radius: 20px!important;;">Activate Product</button> -->
</td>
</tr>
<?php
$i++;
}?>
</tbody>
<?php  }}
else{
?>
<tr>
<td colspan="6">
<p class="text-center">No Record Found</p>
</td>
</tr>
<?php
}
?>


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
</section>

<!-- partial 
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>


<script src="https:<?php echo $baseurl?>/assets/js/sweetalert.js.0.19/dist/sweetalert2.all.min.js"></script>
<script>
function activate() {
    Swal.fire({
title: 'Are you you want to Activate this product ?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
confirmButtonText: 'Yes',
cancelButtonColor: '#FF0000',
cancelButtonText: 'No',


}).then((result) => {
if (result.isConfirmed) {
window.location.href = 'reactivate_product.php';
}
});
}
</script>



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

});
//End of create main table


$('#example tbody').on( 'click', 'tr', function () {

// alert(table.row( this ).data()[0]);

} );
table.destroy(); 
} );

</script>


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

}?>

<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
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
