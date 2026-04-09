<?php
include('../../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "photos/";
include_once("../../authentication/islogin.php");
} else {


function sp_autoloader($class)
{
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$_GET["categoryid"] = 13;
$activePage = 18;

//print_r($_SESSION);
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php'); ?>


<!-- ===== INPAGE SCRIPTS====== -->
<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<?php include('../../component/dashboard-link.php'); ?>

<!--NOTIFICATION-->
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>
<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/magnific-popup.css">
<!-- Magnific Popup core JS file -->
<script src="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/jquery.magnific-popup.js"></script>

</head>

<body class="bg_gray">
<?php
//this is for store header
$header_photo = "header_photo";

include_once("../../header.php");
?>


<section class="">
<div class="container-fluid">
<div class="row">
<div class="sidebar col-md-2 no-padding left_photo_menu" id="sidebar">
<?php
include('left-menu.php');
?>
</div>

<div class="col-md-10">
<div class="panel panel-default" style="margin-top:10px;">
<div class="panel-heading"> Dashboard / Cancelled </div>
</div>
<div class="row pro_detail_box">



<!---<div class="col-md-4">

</div>--->


<div class="col-md-12" style="margin-top:10px;">


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



.tbl_store_setting thead {
background-color: #99068a;
color: #fff;
}

.paginate_button {
border-radius: 0 !important;
}
</style>

<?php


if (isset($_POST['submit'])) {
//die('==========');
$comment = array("seller_comment" => $_POST['sellercomments']);

$s = new _spcustomers_basket;
$st = $s->updatecomment($comment, $_POST['idspOrder']);
}



$p = new _spcustomers_basket;

$result = $p->readcancel_artcraft($_SESSION['pid']);
if ($result != false) {
$table = 'example';
} else {
$table = '';
}


?>

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


<!-- <table class="table tbl_store_setting display" id="<?php echo $table; ?>" cellspacing="0" width="100%"> -->
<?php
    $p = new _spcustomers_basket;

$result = $p->readcancel_artcraft($_SESSION['pid']);
//  echo $p->ta->sql;

//print_r($result);
if ($result) {
    $pagination = "example2";
 
}
else{
$pagination = '';

}
    ?>

    
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>



<table class="table table-striped table-class" id="<?php echo $pagination; ?>">
<thead>
<tr>
<th></th>

<th class="text-center" style="width: 50px;">No.</th>
<th>Buyer Name</th>
<th>Product Name</th>
<th>Buyer Reason</th>

<th>Seller Comment</th>

<th>Comment</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
$p = new _spcustomers_basket;

$result = $p->readcancel_artcraft($_SESSION['pid']);
//  echo $p->ta->sql;

//print_r($result);
if ($result != false) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
//extract($row);


//echo "<pre>";
// print_r($row);

$basketid = $row['idspOrder'];

$order_id  = $row['idspPostings'];

//echo $order_id;die('=====');
$comment = $row['seller_comment'];
$buyerprofilid  = $row['spByuerProfileId'];
$sellerprofilid  = $row['spSellerProfileId'];


$Response  = $row['reason'];
$buyerComment  = $row['comments'];
$sellerComment  = $row['seller_comment'];

$sp = new _spprofiles;

$spbuyresult  = $sp->read($buyerprofilid);
if ($spbuyresult != false) {
$buyrow = mysqli_fetch_assoc($spbuyresult);
$buyername = $buyrow["spProfileName"];
}



$pv = new _artcraftOrder;
$rdf = $pv->read_artproduct($order_id);

if ($rdf != false) {

$rowf = mysqli_fetch_assoc($rdf);
$prname = $rowf['spPostingTitle'];
}




$sl = new _sellercomment;
$commresult  = $sl->getsellercomment($row['id']);
//  echo $sl->ta->sql;            

if ($commresult != false) {
while ($commrow = mysqli_fetch_assoc($commresult)) {

$Sellercomment = $commrow["sellercomments"];
$Scommentid = $commrow["id"];
$commid = $commrow["comment_id"];
}
}


?>


<!-- Modal -->
<div class="modal fade" id="<?php echo $basketid; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="vertical-alignment-helper">
<div class="modal-dialog vertical-align-center">
<div class="modal-content no-radius bradius-15 ">
<div class="modal-header sellbuyhead">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

</button>
<h4 class="modal-title" id="myModalLabel" style="color: #fff; font-size: 22px;">Buyer Comment</h4>

</div>
<div class="modal-body">
<p style="padding: 8px;"><?php echo $buyerComment; ?></p>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default headclosebtn" data-dismiss="modal">Close</button>
<!--   <button type="button" class="btn btn-primary">Save changes</button> -->
</div>
</div>
</div>
</div>
</div>

<tr>
<td></td>
<td><?php echo $i; ?></td>
<td class="eventcapitalize"><a href="<?= $BaseUrl; ?>/friends/?profileid=<?= $_SESSION['pid']; ?>"><?php echo $buyername; ?></a></td>
<td class="eventcapitalize"><?php
$productid =  $row['idspPostings'];
$pv = new _artcraftOrder;
$rdf = $pv->read_artproduct($productid);

if ($rdf != false) {

$rowf = mysqli_fetch_assoc($rdf);
$title = $rowf['spPostingTitle'];
$curr = $rowf['defaltcurrency'];
}
?>
<a href="<?= $BaseUrl; ?>/artandcraft/detail.php?postid=<?= $row['idspPostings']; ?>"><?php echo $title; ?></a>

</td>
<td><?php echo $Response; ?></td>





<td class="buyer">

<?php if (isset($sellerComment)) {
// echo $sellerComment; 
?>

<a href="" data-toggle="modal" data-target="#p<?php echo $$order_id; ?>"><?php echo $sellerComment; ?></a>


<?php  } else { ?>
<p>No Comment</p>
<?php } ?>


</td>



<!-- <td>


<select  id="sendstatus" name="status" onchange="get_approvedata(<?php echo $basketid; ?>);" style="background-color: #008d4c; border-color: #008d4c;height: 33px; border-radius: 8px; " class="btn btn-info btn-sm">
<!--   <option value="" style="display:none">Status</option>  
<option  value="Accepted"<?php if ($row['status'] == 'Accepted') {
echo "disabled";
} ?> <?php if ($row['status'] == 'Accepted') {
echo "selected";
} ?>>Accepted</option>



<option  value="Review In Request" <?php if ($row['status'] == 'Review In Request') echo "selected"; ?>>Review In Request</option>

<option  value="Decline Request"<?php if ($row['status'] == 'Decline Request') {
echo "disabled";
} ?> <?php if ($row['status'] == 'Decline Request') {
echo "selected";
} ?>>Decline Request</option>



</select>

</td>-->

<td><a href="" class="btn" data-toggle="modal" data-target="#mycomment<?php echo $basketid; ?>" style="color: #fff!important;  background-color: #7CB8E0; border-radius: 8px;">Comment</a></td>

<td><a href="<?= $BaseUrl; ?>/artandcraft/dashboard/sellerstatusnew.php?postid=<?= $row['idspOrder']; ?>"><i title="view" class="fa fa-eye" style="font-size:16px"></i></a></td>



</tr>


<!-- Modal -->
<div class="modal fade" id="p<?php echo $Scommentid; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="vertical-alignment-helper">
<div class="modal-dialog vertical-align-center">
<div class="modal-content no-radius bradius-15 ">
<div class="modal-header sellbuyhead">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

</button>
<h4 class="modal-title" id="myModalLabel" style="color: #fff; font-size: 22px;">Seller Comment</h4>

</div>
<div class="modal-body">
<p style="padding: 8px;"><?php echo $sellerComment; ?>

</p>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default headclosebtn" data-dismiss="modal">Close</button>
<!--   <button type="button" class="btn btn-primary">Save changes</button> -->
</div>
</div>
</div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="mycomment<?php echo $basketid; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

<div class="vertical-alignment-helper">
<div class="modal-dialog vertical-align-center">

<form action="" method="post" enctype="multipart/form-data">
<div class="modal-content no-radius bradius-15">
<div class="modal-header sellbuyhead">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

</button>
<h3 class="modal-title" id="myModalLabel" style="color: #fff; font-size: 22px;">Comment</h3>

</div>
<div class="modal-body">
<!--   <input type="hidden" name="cid" value="<?php echo $row['id']; ?>"> -->
<!--   <input type="hidden" name="spByuerProfileId" value="<?php echo $buyerprofilid; ?>">
<input type="hidden" name="spSellerProfileId" value="<?php echo $sellerprofilid; ?>">

<input type="hidden" name="order_id" value="<?php echo $order_id; ?>">

-->

<input type="hidden" name="idspOrder" id="comment_id<?php echo $basketid; ?>" value="<?php echo $basketid; ?>">
<div class="form-group">
<label for="sell1">Enter Comment <span class="red">*</span></label>
<textarea class="form-control" name="sellercomments" id="sellercommentid<?php echo $basketid; ?>" rows="4"></textarea>
<span id="sellercommentid_error" style="color:red;"></span>

</div>


</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal" style="background-color: #A60000; color: #fff;border-radius: 20px; min-width: 100px;">Close</button>


<button type="submit" class="btn btn-primary" name="submit" style="background-color: green; color: #fff;border-radius: 20px; border: none; min-width: 100px;">Submit</button>
</div>
</div>
</form>
</div>
</div>

</div>

<?php
$i++;
}
} else {
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




<!-- partial 
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<!-- <script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

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
</script> -->


</div>



</div>

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
var table = $('#example2').DataTable({
paging: true, // Enable pagination
select: false,
columnDefs: [{
className: "Name",
targets: [0],
visible: false,
searchable: false
}]
});

$('#example2 tbody').on('click', 'tr', function() {
//table.row( this ).data()[0];
// Handle row click event here
});
});
</script>

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
