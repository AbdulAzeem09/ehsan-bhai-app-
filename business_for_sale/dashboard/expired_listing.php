<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');
*/
include('../../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {

$_SESSION['afterlogin'] = "store/";
include_once("../../authentication/islogin.php");
} else {

function sp_autoloader($class)
{
include '../../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");

$_GET['categoryID'] = 1;
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<style>
body{

background-color: #eee; 
}

table th , table td{
text-align: center;
}

table tr:nth-child(even){
background-color: #BEF2F5
}

.pagination li:hover{
cursor: pointer;
}



</style>

<?php include('../../component/f_links.php'); ?>

<!-- ===== INPAGE SCRIPTS====== -->
<?php include('../../component/dashboard-link.php'); ?>
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<link href="https://dev.thesharepage.com/assets/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
</head>

<body class="bg_gray">
<?php


//this is for store header
//$header_store = "header_store";

include_once("../../header.php");
?>
<section class="main_box">
<div class="container">
<div class="row">
<!--  <div class="sidebar col-md-2 no-padding left_store_menu" id="sidebar" >
<?php
$activePage = 5;
//include('left-menu.php'); 
?>
</div> -->
<div id="sidebar" class="col-md-2 hidden-xs no-padding">
<div class="left_grid store_left_cat">
<?php
include('left-menu.php');
?>
</div>

<div class="col-md-10">




<?php

$storeTitle = " Dashboard / Expire Products";
// include('../top-dashboard.php');
//include('../searchform.php');

?>

<div class="row ">



<div class="col-sm-12">
<ul class="breadcrumb" style="background: white !important;  ">
<li><a href="<?php echo $BaseUrl . '/business_for_sale/dashboard/index.php'; ?>">Dashboard</a></li>
<li><a href="#">Expired Business</a></li>

</ul>
</div>


<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}

div#example_filter {
margin-bottom: 5px;
}
</style>
<?php $p = new _businessrating;
$result = $p->read_business_expired($_SESSION['uid'], $_SESSION['pid']);
if ($result != false) {
$table = "example";
} else {
$table = "";
}



?>

<div class="col-sm-12 ">

<div class="">
<div class="table-responsive">
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<table  class="table table-striped table-class" id= "<?php echo $table;?>"  cellspacing="0" width="100%">
<thead>
<tr>


<th></th>
<th>ID</th>
<th class="text-center">Title</th>

<th class="text-center">Posting Date</th>
<th class="text-center">Expiry Date</th>
<th class="text-center">Duration (Days)</th>
<th class="text-center">Price</th>
<th class="text-center">Action</th>
</tr>
</thead>
<tbody>
<?php

$p = new _businessrating;

//$result = $p->myStoreProduct($_SESSION['pid']);
$result = $p->read_business_expired($_SESSION['uid'], $_SESSION['pid']);
// echo $p->ta->sql;
if ($result != false) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
$dt = new DateTime($row['created_date']);
$edt = new DateTime($row['exp_date']);
?>
<tr>

<td></td>
<td class="text-center"><?php echo $i; ?></td>
<td class="text-center"><a href="<?php echo $BaseUrl . '/business_for_sale/business_detail.php?postid=' . $row['idspbusiness']; ?>"><?php echo $row['listing_headline']; ?></a></td>

<td class="text-center"><?php echo $dt->format('d M Y'); ?></td>
<td class="text-center"><?php echo $edt->format('d M Y'); ?></td>
<td class="text-center">

<?php echo $row['duration']; ?></td>

<td class="text-center"><?php echo 'USD ' . $row['price']; ?></td>

<td class="text-center">


<a href="<?php echo $BaseUrl . '/business_for_sale/edit_business.php?postid=' . $row['idspbusiness']; ?>"><i style="color: #428bca" title="Edit" class="fa fa-pencil" ></i></a>

</td>
</tr>
<?php
$i++;
}
} else {
?>
<tr>
<td colspan="8" style="height:50px;">
<p class="text-center">No Record Found</p>
</td>
</tr>
<?php
}
?>

</tbody>
</table>
<!--		Start Pagination -->
<!-- <div class='pagination-container' >
<nav>
<ul class="pagination">

<li data-page="prev" >
<span> < <span class="sr-only">(current)</span></span>
</li>
	Here the JS Function Will Add the Rows 
<li data-page="next" id="prev">
<span> > <span class="sr-only">(current)</span></span>
</li>
</ul>
</nav>
</div> -->
</div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>
</section><br><br><br>

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


$('#example1 tbody').on('click', 'tr', function() {

// alert(table.row( this ).data()[0]);

});
});
</script>

<?php
include('../../component/f_footer.php');
include('../../component/f_btm_script.php');
?>

</body> 

<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"> </script> -->
<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
<script>
getPagination('#table-id');
function getPagination(table) {
var lastPage = 1;

$('#maxRows')
.on('change', function(evt) {
lastPage = 1;
$('.pagination')
.find('li')
.slice(1, -1)
.remove();
var trnum = 0; // reset tr counter
var maxRows = parseInt($(this).val()); // get Max Rows from select option
if (maxRows == 5000) {
$('.pagination').hide();
} else {
$('.pagination').show();
}
var totalRows = $(table + ' tbody tr').length; // numbers of rows
$(table + ' tr:gt(0)').each(function() {
// each TR in  table and not the header
trnum++; // Start Counter
if (trnum > maxRows) {
// if tr number gt maxRows

$(this).hide(); // fade it out
}
if (trnum <= maxRows) {
$(this).show();
} // else fade in Important in case if it ..
}); //  was fade out to fade it in
if (totalRows > maxRows) {
// if tr total rows gt max rows option
var pagenum = Math.ceil(totalRows / maxRows); // ceil total(rows/maxrows) to get ..
//	numbers of pages
for (var i = 1; i <= pagenum; ) {
// for each page append pagination li
$('.pagination #prev')
.before(
'<li data-page="' +
i +
'">\
<span>' +
i++ +
'<span class="sr-only">(current)</span></span>\
</li>'
)
.show();
} // end for i
} // end if row count > max rows
$('.pagination [data-page="1"]').addClass('active'); // add active class to the first li
$('.pagination li').on('click', function(evt) {
// on click each page
evt.stopImmediatePropagation();
evt.preventDefault();
var pageNum = $(this).attr('data-page'); // get it's number

var maxRows = parseInt($('#maxRows').val()); // get Max Rows from select option

if (pageNum == 'prev') {
if (lastPage == 1) {
return;
}
pageNum = --lastPage;
}
if (pageNum == 'next') {
if (lastPage == $('.pagination li').length - 2) {
return;
}
pageNum = ++lastPage;
}

lastPage = pageNum;
var trIndex = 0; // reset tr counter
$('.pagination li').removeClass('active'); // remove active class from all li
$('.pagination [data-page="' + lastPage + '"]').addClass('active'); // add active class to the clicked
limitPagging();
$(table + ' tr:gt(0)').each(function() {
trIndex++; // tr index counter
if (
trIndex > maxRows * pageNum ||
trIndex <= maxRows * pageNum - maxRows
) {
$(this).hide();
} else {
$(this).show();
} //else fade in
}); // end of for each tr in table
}); // end of on click pagination list
limitPagging();
})
.val(10)
.change();

// end of on select change

// END OF PAGINATION
}

function limitPagging(){
// alert($('.pagination li').length)

if($('.pagination li').length > 7 ){
if( $('.pagination li.active').attr('data-page') <= 3 ){
$('.pagination li:gt(5)').hide();
$('.pagination li:lt(5)').show();
$('.pagination [data-page="next"]').show();
}if ($('.pagination li.active').attr('data-page') > 3){
$('.pagination li:gt(0)').hide();
$('.pagination [data-page="next"]').show();
for( let i = ( parseInt($('.pagination li.active').attr('data-page'))  -2 )  ; i <= ( parseInt($('.pagination li.active').attr('data-page'))  + 2 ) ; i++ ){
$('.pagination [data-page="'+i+'"]').show();

}

}
}
}

$(function() {
// Just to append id number for each row
$('table tr:eq(0)').prepend('<th> ID </th>');

var id = 0;

$('table tr:gt(0)').each(function() {
id++;
$(this).prepend('<td>' + id + '</td>');
});
});



</script>
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

</html>
<?php
}
?>