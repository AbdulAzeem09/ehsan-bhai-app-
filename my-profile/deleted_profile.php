<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
include('../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="store/";
include_once ("../authentication/islogin.php");

}else{
function sp_autoloader($class){
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php');?>

<!-- ===== INPAGE SCRIPTS====== -->
<?php include('../component/dashboard-link.php'); ?>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
</head>

<body class="bg_gray">
<?php


//this is for store header
//$header_store = "header_store";

include_once("../header.php");
?>
<section class="main_box">
<div class="container">
<div class="row">
<div id="sidebar" class="col-md-2 hidden-xs no-padding">
<div class="left_grid store_left_cat">
<p style="font-size:17px;margin-left: 50px;padding: 7px;
background-color: white;
text-align: center;
margin-right: 30px;"><a href="<?php echo $BaseUrl;?>/my-profile/" type="button">Back</a></p>
</div>
</div>
<div class="col-md-10">                        
<?php	if($_GET['msg'] == "notacess"){ ?>

<div class="alert alert-danger" role="alert">
<h1>You can not access this Page or this Page not might exist.</h1>
</div>
<?php   } ?>

<?php 
// $storeTitle = " Dashboard / Active Products";
// include('../top-dashboard.php');
//include('../searchform.php');                       
?>

<div class="row">

<div class="col-md-12">
<ul class="breadcrumb" style="background-color: #fff;">

<li><a href="">Deleted Profiles</a></li>
<!--<li><a href="#">Summer 15</a></li>
<li>Italy</li> -->
</ul>
<!--    <div class="text-right">
<ul class="dualDash"   style="float:left!important;">
<li><a href="<?php //echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?>" class="<?php //echo ($activePage == 21 || $activePage == 2 || $activePage == 3 || $activePage == 4 || $activePage == 5 || $activePage == 6 || $activePage == 14 || $activePage == 16 || $activePage == 18 || $activePage == 20 || $activePage == 22 || $activePage == 8 || $activePage == 9 || $activePage == 10 || $activePage == 11 || $activePage == 12 || $activePage == 13)?'active':''?>">Seller Dashboard</a></li>
<li><a href="<?php //echo $BaseUrl.'/store/dashboard/';?>" class="<?php //echo ($activePage == 1 || $activePage == 15 || $activePage == 7 || $activePage == 23 || $activePage == 24)?'active':''?>">Buyer Dashboard</a></li>
</ul>
</div> -->
</div>



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
.tooltip:hover .tooltiptext {
visibility: visible;
}
#example_filter{
margin-bottom: 5px;
margin-right: 5px;

}
.tbl_store_setting tbody td a {
color: #eee;
}


</style>
<?php 
$p = new _spprofiles;
$result = $p->read_deleted_profile($_SESSION['uid']);
if($result!=false){
$table="example";
}
else{
$table="";
}


?>
<?php
if($_GET['msg']=='insert'){  ?>
<div class="alert alert-success" id="reactive" role="alert">
Profile reactived successfully !
</div>

<?php  }


?>


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

<div class="col-md-12 ">
<div class="">
<div class="table-responsive">
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<table class="table table-striped table-class" id="example">

<!-- <table class="table tbl_store_setting display" id="<?php echo $table;?>" cellspacing="0" width="100%" > -->
<thead>
<tr>


<th class="text-center" style="width: 50px;"></th>
<th class="text-center" style="width: 50px;">ID</th>  

<th class="text-center">Name </th>
<th class="text-center">Email</th>
<th class="text-center">Profile Type11</th>
<th class="text-center">Deleted On</th>
<th class="text-center">Action</th>
</tr>
</thead>
<tbody>
<?php


/*$userid=$_SESSION['uid'];


$c= new _orderSuccess;


$currency= $c->readcurrency($userid);
$res1= mysqli_fetch_assoc($currency);
$curr=$res1['currency'];*/
//$p = new _postingview;
$p = new _spprofiles;

$result = $p->read_deleted_profile($_SESSION['uid']);
//echo $result->num_rows;

//$ty=$p->read_profile_type();
if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
$type_id=$row['spProfileType_idspProfileType'];
$dt = new DateTime($row['deleted_date']);

$ty=$p->read_profile_type($type_id);
if($ty!=false){
$rrr=mysqli_fetch_assoc($ty);
$type=$rrr['spProfileTypeName'];
}
//$edt = new DateTime($row['spPostingExpDt']);
?>
<tr>

<td class="text-center"></td>
<td class="text-center"><?php echo $i; ?></td>
<td class="text-center"> <!--<a href="<?php //echo $BaseUrl.'/friends/?profileid='.$row['deleted_profileid']; ?>" style="color: deepskyblue;"></a>--><?php echo $row['spProfileName']; ?></td>
<td class="text-center">&nbsp;<?php echo $row['spProfileEmail']; ?></td> 
<td class="text-center"><?php 
echo $type;
?></td>
<td class="text-center"><?php echo $dt->format('d M Y'); ?></td>

<td class="text-center"><a  class="btn btn-danger btn-border-radius" onclick="myfun('<?php echo $BaseUrl;?>/my-profile/del_permanent.php?id=<?php echo $row['idspProfiles']?>')">Delete</a>

<a class="btn btn-primary btn-border-radius" onclick="myreactive('<?php echo $BaseUrl;?>/my-profile/reactive1.php?id=<?php echo $row['idspProfiles']?>')">Reactive</a>
</td>
</tr>
<?php
$i++;
}
}
else{
?>
<tr>
<td colspan="8">
<p class="text-center">No Record Found</p>
</td>
</tr>
<?php
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












<script>
function myfun(url){
// alert('jjjjjj');
Swal.fire({
title: 'Are you sure?',
text: "it will be deleted permanently",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'OK'
}).then((result) => {
if (result.isConfirmed) {
window.location.href = url;
}
})  

}   


function myreactive(url){
// alert(url);
Swal.fire({
title: 'Are you sure?',
text: "it will be reactive permanently",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'OK'
}).then((result) => {
if (result.isConfirmed) {
window.location.href = url;
}
})  

} 
</script>




<!--<script 
src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<!-- <script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>
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
}); -->


<script>

setTimeout(function () {
$("#reactive").hide();
}, 1000);

</script>


</script>


</div>
</div>
</div>
</section>

<br>
<br>
<br>
<br>

<?php 
include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>

</body>
</html>
<?php
} ?>

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
});


</script>

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

