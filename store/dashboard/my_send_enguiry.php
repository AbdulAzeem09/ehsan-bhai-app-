

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
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php');?>
<!-- ===== INPAGE SCRIPTS====== -->
<?php include('../../component/dashboard-link.php'); ?>

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


.buyer{
max-width: 100px;
overflow: hidden;
text-overflow: ellipsis;
white-space: nowrap;
}
.modal {
}
.vertical-alignment-helper {
display:table;
height: 100%;
width: 100%;
}
.vertical-align-center {

display: table-cell;
vertical-align: middle;
}
.modal-content {

width:inherit;
height:inherit;

margin: 0 auto;
}
#profileDropDown li.active {
background-color: #0f8f46;
}
#profileDropDown li.active a {
color: white;
}
</style>        
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
<!-- <div class="sidebar col-md-2 no-padding left_store_menu" id="sidebar" >
<?php
$activePage = 24;
//include('left-menu.php'); 
?>
</div> -->
<div id="sidebar" class="col-md-2 hidden-xs no-padding">
<div class="left_grid store_left_cat">
<?php
include('left-buyermenu.php'); 
?>
</div>
</div>
<div class="col-md-10">



<?php 

$storeTitle = " Dashboard / My Send Enquires";
// include('../top-dashboard.php');
// include('../searchform.php');

?>

<div class="row">
<!-- 
<div class="col-md-12">

<ul class="breadcrumb" style="background-color: #fff;">
<li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>">Buyer Dashboard</a></li>
<li><a href="#">My Send Enquiries</a></li>

</ul>


<div class="text-right" style="margin-top: -10px;">
<ul class="dualDash"   style="float:left!important;">
<li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?>" class="<?php echo ($activePage == 21)?'active':''?>">Seller Dashboard</a></li>
<li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>" class="<?php echo ($activePage == 1 || $activePage == 15 || $activePage == 7 || $activePage == 23 || $activePage == 24)?'active':''?>">Buyer Dashboard</a></li>
</ul>

</div>
</div> -->
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>
<div class="col-sm-12">
<ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 8px;">
<li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>">Buyer Dashboard</a></li>

<li><a href="#">My Send Enquiries</a></li>

</ul>
</div>

<?php 
$en = new _sppostenquiry;
$result = $en->getbuyerEnquery($_SESSION['pid']);
if($result!=false){
$table="example";
}else{
$table="";

}


?>


<div class="container-fluid">
<!-- <div class="header_wrap"> -->
<div class="num_rows">

<!-- <div class="form-group"> 		Show Numbers Of Rows 	
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
</div> -->
<!-- <div class="tb_search">
<input type="text" id="search_input_all" onkeyup="FilterkeyWord_all_table()" placeholder="Search.." class="form-control">
</div> -->
</div>

<div class="col-sm-12 ">
<div class="">
<div class="table-responsive1">
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<table class="table table-striped table-class" id= "example" style="width: 890px;">
<!-- <table class="table tbl_store_setting display " id="<?php echo $table; ?>" cellspacing="0" width="100%" > -->
<thead>
<tr>
<!-- <th class="text-center" style="width: 50px;">ID</th> -->

<!--<th style="text-align: left;">Post Title</th>--->
<th></th>
<th>ID</th>
<th>Product Title</th>

<th>Seller Reply</th>
<th> Comment</th>
<th class="text-center">Action</th> 

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
$en = new _sppostenquiry;
$result = $en->getbuyerEnquery($_SESSION['pid']); 
if($account_status!=1){
if ($result!=false) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {


$buyerprofilid  = $row['buyerProfileid'];
$sellerprofilid  = $row['sellerProfileid']; 

$id=  $row['id'];


$sl = new _sellerenqreply;  

$commresult  = $sl->getsellerreply($row['id']);
//  echo $sl->ta->sql;            

if($commresult != false)
{
while ($commrow = mysqli_fetch_assoc($commresult)) {

$Sellercomment = $commrow["sellerreply"];
$Scommentid = $commrow["id"];
$commid = $commrow["reply_id"];


}
}        
?>
<tr>
	<td></td>
<td class="text-center"><?php echo $i; ?></td>

<td class="eventcapitalize" >
<a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$row['spPostings_idspPostings']?>">
<?php 
$pst = new _productposting;
$result3 = $pst->read($row['spPostings_idspPostings']);
if ($result3) {
$row3 = mysqli_fetch_assoc($result3);
echo $row3['spPostingTitle'];
}
?>
</td>
</td>

<!-- Modal -->
<div class="modal fade" id="<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="vertical-alignment-helper">
<div class="modal-dialog vertical-align-center">
<div class="modal-content no-radius bradius-15 ">
<div class="modal-header sellbuyhead">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

</button>
<h4 class="modal-title" id="myModalLabel"  style="color: #fff; font-size: 22px;">Enquiry Message</h4>

</div>
<div class="modal-body"><p style="padding: 8px;"><?php echo substr($row['message'], 0, 50); ?></p></div>
<div class="modal-footer">
<button type="button" class="btn btn-default headclosebtn" data-dismiss="modal">Close</button>
<!--   <button type="button" class="btn btn-primary">Save changes</button> -->
</div>
</div>
</div>
</div>
</div>                                                                                            
<td class="buyer">
<a href="" data-toggle="modal" data-target="#<?php echo $row['id'];?>"><?php echo substr($row['message'], 0, 50); ?></a>
</td>



<td class="buyer">  
<?php if (isset($Sellercomment) && $row['id'] == $commid) { ?>
<a href=""data-toggle="modal" data-target="#r<?php echo $Scommentid;?>"><?php  echo $Sellercomment; ?></a>

<?php  }else{ ?>
<p>No Comment</p>
<?php } ?></td>
<td class="text-center"><a href="<?= $BaseUrl; ?>/store/dashboard/reply_enquiry.php?id=<?= $id; ?>" ><i style="color:#428bca" title="View" class="fa fa-eye" ></i></a></td>                                                                    

<!-- Modal -->
<div class="modal fade" id="r<?php echo $Scommentid;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="vertical-alignment-helper">
<div class="modal-dialog vertical-align-center">
<div class="modal-content no-radius bradius-15 ">
<div class="modal-header sellbuyhead">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

</button>
<h4 class="modal-title" id="myModalLabel" style="color: #fff; font-size: 22px;">Seller Reply</h4>

</div>
<div class="modal-body"><p style="padding: 8px;"> <?php  echo $Sellercomment; ?>  

</p></div>
<div class="modal-footer">
<button type="button" class="btn btn-default headclosebtn" data-dismiss="modal">Close</button>
<!--   <button type="button" class="btn btn-primary">Save changes</button> -->
</div>
</div>
</div>
</div>
</div>                                                                                    
</tr>
<?php
$i++;
}
}}
else{
?>
<tr>
<td colspan="7">
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
<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->

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

});
table.destroy();
});
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
// function default_index() {
// $('table tr:eq(0)').prepend('<th> ID </th>')

// var id = 0;

// $('table tr:gt(0)').each(function(){	
// id++
// $(this).prepend('<td>'+id+'</td>');
// });
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
