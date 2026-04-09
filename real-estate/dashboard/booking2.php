<?php
include('../../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="real-estate/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader"); 

$_GET["categoryID"] = "3";
$_GET["categoryName"] = "Realestate";
$header_realEstate = "realEstate";
$activePage = 7;
?>
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
<?php include('../../component/dashboard-link.php'); ?>
</head>

<body class="bg_gray">
<?php include_once("../../header.php");?>

<section class="realTopBread" style="padding:0px;">
<div class="container">
<div class="row">
<div class="col-md-6">

<div class="text-left agentbreadCrumb" style="margin-top: 10px;margin-bottom: -15px;">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a style="font-size: 14px;color:white!important;" href="<?php echo $BaseUrl.'/real-estate/dashboard/';?>">Dashboard</a></li>
<li style="font-size: 14px;" class="breadcrumb-item active">Received Booking For Place </li>
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
<?php //include('top-dashboard.php');?>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content no-radius sharestorepos">
<form method="POST" action="../addDiscount.php" >
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel" style="display: inline-block;">Discount</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">

<input type="hidden" name="txtBokId" id="txtBokId" value="">
<input type="hidden" id="txtOrgPrice" value="">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Discount On</label>
<input type="text" value="" id="txtBokTitle" class="form-control" readonly="">

</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Discount (%)</label>
<input type="number" name="txtDiscount" id="txtDiscount" value="" class="form-control" >
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Discounted Price ($)</label>
<input type="text" name="txtDiscountPrice" id="txtDiscountPrice" readonly="" value="" class="form-control" >
</div>
</div>
</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Discount And Approve</button>
</div>
</form>
</div>
</div>
</div>
<div class="space"></div>
<div class="row">
<div class="sidebar col-md-3 no-padding left_real_menu" id="sidebar" >
<?php include('left-menu.php'); ?> 
</div>




<div class="col-md-9 bg_white">

<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

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
ul#profileDropDown {
border: none;
}
#profileDropDown li.active {
background-color: #95ba3d!important;
}
#profileDropDown li.active a {
color: #fff!important;
}	
</style>

<div style="margin-top:10px" class="container-fluid">


<!--<h4>Booking Recieved Related to Rent Entire Place</h4>
partial:index.partial.html -->
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<table class="table table-striped table-class" id= "example">
<!-- <table id="example" class="display" cellspacing="0" width="100%" > -->
<thead>
<tr>
 <th>Id</th>
<th>ID</th> 
<th>Property Title</th>
<th>Profile</th>
<th>Price</th>
<th>Booking Date</th>
<th>Days</th>
<th>Check In Date</th>
<th>Check Out Date</th>
<!-- <th>Date</th> -->
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
$p = new _postingview;
$profile = new _spprofiles;
$type="Rent Entire Place";

//$result2 = $p->readBooking($_GET['categoryID'], $_SESSION['pid']);
$result2 = $p->myReceivedBooking($_SESSION['pid'],$type);
// print_r($recived_booking_row);
// exit;

if($account_status!=1){
if($result2 != false){
$i=1;
while ($row2 = mysqli_fetch_assoc($result2)) {

$pageLink = $BaseUrl."/real-estate/room-detail.php?postid=".$row2['idspPostings'];   
$spProfile = $row2['spProfile_idspProfile'];




$result3 = $profile->read($spProfile);
if($result3 != false){
$row3 = mysqli_fetch_assoc($result3);
$userProfileName = $row3['spProfileName'];
}
//print_r($row2); die;
?>
<tr>
<td><?php echo $i; ?></td>
<td><?php echo $i; ?></td> 
<td>
<a href="<?php echo $pageLink;?>"><?php echo $row2['spPostingTitle'];?></a>
</td>
<td><a href="<?php echo $BaseUrl.'/friends/?profileid='.$spProfile;?>"><?php echo $userProfileName;?></a></td>
<td>
<?php
if ($row2['spDiscountPrice'] > 0) {
echo $row2['defaltcurrency'].' '.$row2['spDiscountPrice'].' (-'.$row2['spDiscountPer'].'%)';
}else{
echo $row2['defaltcurrency'].' '.$row2['spPrice'] + $row2['spCleaningChrg'] +$row2['spServiceChrg'];
}
?>
</td>
<!---<td><?php echo $row2['fromdate'];?></td>
<td><?php echo $row2['spServiceChrg'];?></td>--->
<?php	
$dt = new DateTime($row2['spBookDate']);
$dt1 = new DateTime($row2['spCheckInDate']); 
$dt2 = new DateTime($row2['spCheckOutDate']); 

?>
<td><?php echo $dt->format('d-M-Y'); ?></td>
<td><?php echo $row2['spDays']; ?></td>

<td><?php echo $dt1->format('d-M-Y'); ?></td>
<td><?php echo $dt2->format('d-M-Y'); ?></td>
<!-- <td><?php echo $row2['fromdate']; ?></td> -->

<td class="book">
<?php
if ($row2['spStatus'] == 0) {
?>
<!-- <a href="javascript:void(0)" class="btn butn_draf sp-book-room" style="padding: 6px 9px !important; min-width: 0; color: white;" data-price="<?php echo $row2['spPrice']; ?>" data-bokid="<?php echo $row2['idspRoomBook']; ?>" data-title="<?php echo $row2['spPostingtitle'];?>" style="color: #FFF;" data-toggle="modal" data-target="#exampleModal" >
Discount
</a> -->
<a href="<?php echo $BaseUrl.'/real-estate/status.php?action=app&boking='.$row2['idspRoomBook'].'&roomid='.$row2['spPosting_idspPosting'];?>" class="btn btn-success" style="color: #FFF;" title="Approve"><i class="fa fa-check" aria-hidden="true"></i></a>
<a href="<?php echo $BaseUrl.'/real-estate/status.php?action=rej&boking='.$row2['idspRoomBook'];?>" class="btn btn-danger" style="color: #FFF;" title="Reject"><i class="fa fa-ban" aria-hidden="true"></i></a>
<?php
}else if($row2['spStatus'] == 1){
?>
<a href="javascript:void(0)" class="btn btn-success" style="color: #FFF;">Waiting For Amount</a>
<?php
}else if ($row2['spStatus'] == 2) {
echo "<p>You Reject This Person</p>";
}
else if ($row2['spStatus'] == 3) {
echo "<p>Payment Successful</p>";
}

?>

</td>



</tr>



<?php
$i++;    }
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
<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
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

} );
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
}
?>

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
