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

$pageactive = 72;
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

.tagLine-max-char {

font-size: smaller;
font-weight: 600;

}
.dataTables_filter	{
margin-bottom:3px;
}
.dataTables_empty{text-align:center!important;}
.smalldot{
width : 100px;
overflow:hidden;
display:inline-block;
text-overflow: ellipsis;
white-space: nowrap;
}
.tab {
overflow: hidden;
border: 1px solid #ccc;
background-color: #f1f1f1;
}

.tab button {
background-color: inherit;
float: left;
border: none;
outline: none;
cursor: pointer;
padding: 14px 16px;
transition: 0.3s;
}

.tab button:hover {
background-color: #ddd;
}

.tab button.active {
background-color: #ccc;
}

.tabcontent {
display: none;
padding: 6px 12px;
border: 1px solid #ccc;
border-top: none;
}
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


</style>



<div class="content">
<div class="col-md-12" >
<div class="text-center" style="background: #c2c2c2ed;  padding: 17px 0px 16px 0px;">
<h1 style="margin: 0px; font-weight: bolder;">MY COMMISSION</h1>
</div>
</div>
<div class="col-md-12 ">

<div class="row">




<div class="col-md-12 ">
<div class="panel with-nav-tabs panel-warning" style=" border-color: #BACCE8; }">

<div class="panel-body">
<div class="tab-content">
<div class="tab-pane fade in active" id="tab1warning">

<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>

<div class="row">
<div class="col-sm-12">
<form action="" method="post">
<div class="col-md-12 form-group" style="border:1px solid #d2d6de">
<h4 style="padding-left:15px"><b>Filter By Date</b></h4>
<div class="col-md-3 form-group">
<label> Start Date</label>
<input type="date" class=" form-control text-center " name="date1" value="<?php if(isset($_POST['date1'])){ echo $_POST['date1']; }?>"></div>
<div class="col-md-3 form-group">
<label>End Date</label>
<input type="date" class=" form-control text-center " name="date2" value="<?php if(isset($_POST['date2'])){ echo $_POST['date2']; }?>"></div>
<div class="col-md-4 form-group">
<button class="btn btn-primary btn-border-radius" style="margin-top: 20px;" name="filtersubmit">submit</button>
<a href="<?php echo $BaseUrl.'/dashboard/commission/tier3.php?id='.$_GET['id']; ?>" class="btn btn-danger btn-border-radius" style="margin-top:20px; margin-left:4px;">Reset</a>
<!--                                                                            <a href="--><?php //echo $BaseUrl.'/dashboard/commission/'; ?><!--" class="btn btn-danger " style="margin-top:20px; margin-left:4px;">Reset</a>-->

</div>
</form>
</div>
<div class="col-sm-3">
<!-- <h2>My Commission</h2> -->
</div>
<div class="col-md-12 no-padding">
<span style="text-align:center;">
</span>

<div class="container-fluid">
<div class="header_wrap">
<h4 class="text-center"><b>TIER 3 USERS</b></h4>
<div class="num_rows">

<div class="form-group"> 	<!--		Show Numbers Of Rows 		-->
<select class  ="form-control" name="state" id="maxRows">


<option value="10">10</option>
<option value="15">15</option>
<option value="20">20</option>
<option value="30">30</option>
<option value="40">40</option>
<option value="50">50</option>
<option value="100">Show ALL Rows</option>
</select>

</div>
</div>
<div class="tb_search">
<input type="text" id="search_input_all" onkeyup="FilterkeyWord_all_table()" placeholder="Search.." class="form-control">
</div>
</div>
<div class="table-responsive1">
<table class="table table-striped table-class" id= "table-id">
<!-- <table class="table tbl_store_setting display" id="example1" cellspacing="0" width="100%" > -->
<thead>
<tr>

<!-- <th></th>
<th>Id</th> -->

<th>User Name</th>
<!--<th>Currency</th>-->
<th>Sale Amount</th>
<th> My Commission </th>
<th> SPCommission </th>
<th>Module</th>
<th>Sale Type</th>
<th>Date</th>
</tr>
</thead>
<tbody>

<?php


$mb = new _spmembership;
$u = new _spuser;



$mainUser = $u->getreferelcodeused($_GET['id']);
$getMainUser  = mysqli_fetch_assoc($mainUser);

$getTier1UsersQuery = $u->getUserRefferalsFromMainUser($getMainUser['userrefferalcode']);

$tierIds = [];
if(mysqli_num_rows($getTier1UsersQuery) > 0){
while($row = mysqli_fetch_assoc($getTier1UsersQuery)){
$tierIds[] = $row['idspUser'];
}
}


if(isset($_POST['filtersubmit']))
{
$startdate=$_POST['date1'];
$enddate=$_POST['date2'];
$getAllTierCommission = $u->getAllTier3CommissionsFilter(implode(',',$tierIds),$startdate,$enddate);
}
else{
$getAllTierCommission = $u->getAllTier3Commissions(implode(',',$tierIds));
}

$total=0;
$totalSales=0;
if(mysqli_num_rows($getAllTierCommission) > 0){
$i=1;
while($row=mysqli_fetch_assoc($getAllTierCommission)){
$rr=$u->read_name($row['tier1_userid']);
if($rr){
$row1=mysqli_fetch_assoc($rr);
}
$int1=$row['spuser_commission'];
$total=$total+$int1;
$totalSales+= $row['purcahse_amount'];
?>
<tr>
<td><a href="tier3.php?id=<?php echo $row1['idspUser'];?>"><?php echo $row1['spUserName']; ?></a></td>
<td style="text-align: center;"><?php  echo $row['purcahse_amount']; ?></td>
<td style="text-align: center;"><?php echo round($row['spuser_commission'],2); ?></td>
<td style="text-align: center;"><?php echo round($row['spadmin_commission'],2); ?></td>
<td><?php  echo $row['module']; ?></td>
<td><?php  echo $row['sale_type']; ?></td>
<td><?php  echo $row['date']; ?></td>
</tr>

<?php

$i++;
}
}

?>
</tbody>
</table>

<div class="col-md-2 col-md-offset-2">
<h4 class="text-center">Total : <?php echo $totalSales; ?></h4>
</div>

<!--		Start Pagination -->
<div class='pagination-container'>
<nav>
<ul class="pagination">
<!--	Here the JS Function Will Add the Rows -->
</ul>
</nav>
</div>

</div> <!-- 		End of Container -->

<?php
$mb = new _spmembership;

date_default_timezone_set("Asia/Bangkok");
$date = date('m-d-Y');
if(isset($_POST['total_submit'])){
$amount=$_POST['amount'];
$arr=array(
"pid"=>$_SESSION['pid'],
"uid"=>$_SESSION['uid'],
"withdraw_amount"=>$amount,
"status"=>'0',
"requested_date"=>$date

);


$result1=$mb->withraw_com($arr);


}

$result2=$mb->ashish($_SESSION['uid']);
$total_withdrwal = 0;
if($result2){
while($row=mysqli_fetch_assoc($result2)){

$total_withdrwal =$total_withdrwal + $row['withdraw_amount'];
}
}
$total3=$total-$total_withdrwal;

//echo ($total_withdrwal);

//die('-----------------');


/*$i=1;
while($row=mysqli_fetch_assoc($result2)){
//$row['purchaser_user'];
$aa=$mb->read_name($row['withdraw_amount']);
$row1=mysqli_fetch_assoc($rr);
$int1=$row['spuser_commission'];
$total=$total+$int1;}
*/
?>


<!-- <label> My Total Commission: $<?php echo round($total,2); ?> </label><br><br>
<label> Total Amount Withdrawal : $<?php echo $total_withdrwal.".00"; ?> </label><br><br>

<label> Total Amount Left :  $<?php echo round($total3,2); ?> </label> -->


<a class="btn btn-primary btn-border-radius" href="<?php echo $BaseUrl.'/dashboard/finance/commission.php';?>" style="float:right;">Withdraw Amount</a>
<!--<form action="" method="post">
<div class="col-md-8 form-group float-right">
<div class="row">
<div class="col-md-5">

</div>
<div class="col-md-5">
<span style="font-weight: bold; font-size: 13px;"> Enter Ammount To Withdraw ($<?php echo round($total3,2); ?>)</span>
<input type="number" class="form-control  text-center" name="amount" value=""
min="50"  max="<?php //echo round($total3,2); ?>" >
</div>
<div class="col-md-2">
<button class="btn btn-primary " name="total_submit" style="margin-top: 20px;">Withdraw</button></div>
</div></div>
</form>-->

</div>
</div>
</div>
<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

<script type="text/javascript">
$(document).ready(function() {

var table = $('#example1').DataTable({
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





