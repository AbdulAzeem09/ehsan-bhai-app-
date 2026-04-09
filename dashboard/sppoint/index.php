<?php


/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/


require_once("../../univ/baseurl.php" );
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="dashboard/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");

$pageactive = 70;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../../component/f_links.php');?>
<!--This script for posting timeline data End-->
<!-- ===========DSHBOARD LINKS================= -->
<?php include('../../component/dashboard-link.php');?>
<!-- ===========PAGE SCRIPT==================== -->
<script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-checkbox.js" defer></script>
<style>
.tagLine-max-char {

font-size: smaller;
font-weight: 600;

}
.dataTables_filter	{
margin-bottom:3px;
}
.dataTables_empty{text-align:center!important;}


</style>
</head>
<body class="bg_gray" onload="pageOnload('details')">
<?php

include_once("../../header.php");
?>

<section class="">
<div class="container-fluid no-padding">
<div class="row">
<!-- left side bar -->
<div class="col-md-2 no_pad_right">
<?php
;
include('../../component/left-dashboard.php');
?>
</div>
<!-- main content -->
<div class="col-md-10 no_pad_left">
<div class="rightContent">

<!-- breadcrumb -->
<!--   <section class="content-header">
<h1>My Selling Product</h1>
<ol class="breadcrumb">
<li><a href="<?php echo $BaseUrl.'/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">My Selling Product</li>
</ol>
</section>-->



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

.smalldot{
width : 100px;
overflow:hidden;
display:inline-block;
text-overflow: ellipsis;
white-space: nowrap;
}
/* Style the tab */
.tab {
overflow: hidden;
border: 1px solid #ccc;
background-color: #f1f1f1;
}

/* Style the buttons that are used to open the tab content */
.tab button {
background-color: inherit;
float: left;
border: none;
outline: none;
cursor: pointer;
padding: 14px 16px;
transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
display: none;
padding: 6px 12px;
border: 1px solid #ccc;
border-top: none;
}						
.btn {
padding: 6px 12px!important;
margin-bottom: 4px!important;

}
</style>



<div class="content">
<div class="col-sm-12 ">

<div class="row">




<div class="col-sm-12 ">
<div class="panel with-nav-tabs panel-warning" style=" border-color: #BACCE8;">

<div class="panel-body">
<div class="tab-content">
<div class="tab-pane fade in active" id="tab1warning">

<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>

<div class="col-sm-12 no-padding">
<span style="text-align:center;"><h2>SPPOINTS</h2></span>
<div class="container-fluid">
<div class="table-responsive1">
<table class="table table-striped table-class" id= "example" style="width: 100%;">
<!-- <table class="table tbl_store_setting display" id="example1" cellspacing="0" width="100%" > -->
<thead>
<tr>

<th></th>          
<th>ID</th>
<th>SPPOINTS</th>
<th>Amount</th>
<!--  <th>Comments</th>-->
<th>Transaction Date</th>
</tr>
</thead>
<tbody>

<?php


$objpoint = new _spPoints;
$result=$objpoint->readpoint_all($_SESSION['uid']);
//echo $_SESSION['pid'].'====55';
//print_r($result);die('==');
if($result !=false){ 
$i=1;
$total=0;
$total1=0;
while($row222=mysqli_fetch_assoc($result)){
$amount=$row222['pointAmount']/100;


$total=$total+$row222['pointAmount'];
$total1=$total1+$amount;

//print_r($row222);
//die('kkkkk');

?>
<tr>
<td></td>
<td><?php echo $i++;?></td>
<td><?php echo  (int) $row222['pointAmount']; ?></td>
<td><?php echo 'USD '.$amount ?></td>

<!-- <td><?php echo $row222['spPointComment'] ?></td> -->
<td><?php echo $row222['pointDate'] ?></td>

</tr>
<?php
$i++;

}}
//echo $total.'+++++++';


?>

<?php
date_default_timezone_set("Asia/Bangkok");
$date = date('m-d-Y'); 

if($total55 < 100){
//die("+++++++++");
$total55 ='';

}

else{
if(isset($_POST['total_submit'])){
$amount=$_POST['amount2'];
$arr=array(
"withdraw_amount"=>$amount,
"pid"=>$_SESSION['pid'],
"uid"=>$_SESSION['uid'],
"request_date"=>$date
);
}
$am44 = new _spprofiles;
$reash44 = $am44->shan_am44($arr);
}
?>    
<?php 
$amount22=0;
$total55=0;
$am99 = new _spprofiles;
$reash99 = $am99->shan_am99($_SESSION['uid']);
if($reash99){
while($reash00 = mysqli_fetch_assoc($reash99)){
$withdraw_amount = $reash00['withdraw_amount'];
$amount22=$amount22 + $withdraw_amount;
}
$total55=$total1-$amount22;
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


<div class="row" style="margin-right: 7px!important;">
<div class="col-md-5">
<label> My Total Spoints: <?php echo round($total,2); ?> </label><br><br>
<label> My Total Amount: USD <?php echo round($total1,2); ?> </label><br><br>
<label>Total Amount Withdraw: USD <?php echo $amount22; ?> </label><br><br>                              
<label>Total Amount Left: USD <?php echo $total55; ?> </label><br><br>       
<label> You Can Redeem Your SpPoint Once It Reaches $100 </label>
</div>
<div class="col-md-5 pull-right">
<form action="" method="post">
<h2 style="font-weight: bold; font-size: 13px;"> Enter Ammount To Withdraw (USD <?php echo $total55; ?>)</h2>
<input type="number" class="  text-center" name="amount2" value="" min="100"  max="<?php echo $total55; ?>" style="width: 50%; height: 32px;" required>
<span><button class="btn btn-primary btn-border-radius" name="total_submit">Withdraw</button></span>
</form>
</div>
</div>
</div>
</div>
</div>
<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->


</div>
</div>
</div>









</div>
</div>
</div>





</div>
</div>
</div>





</div>
</section>


<?php include('../../component/f_footer.php');?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../../component/f_btm_script.php'); ?>

<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->




















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
