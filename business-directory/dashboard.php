<?php

//  ini_set('display_errors', 1);
//  ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start();


include('../univ/baseurl.php');



if ($_SESSION['ptid'] != 1  && $_SESSION['ptid'] != 3) {
//die('++++++000');
header('location:' . $BaseUrl . '/business-directory-services/?category=A');
}

if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "business-directory/";
include_once("../authentication/check.php");
} else {
function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$header_directy = "header_directy";
$activePage = 1;
$page = "dashboardPage";



?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php'); ?>
<!-- owl carousel -->
<link href="<?php echo $BaseUrl; ?>/assets/css/owl.carousel.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $BaseUrl; ?>/assets/css/owl.theme.default.min.css" rel="stylesheet" type="text/css" />

<script src="<?php echo $BaseUrl; ?>/assets/js/owl.carousel.min.js"></script>
<!--NOTIFICATION-->
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>
<link rel="stylesheet" href="https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css">
<!-- this script for slider art -->
<script>
$(document).ready(function() {
$('.owl-carousel').owlCarousel({
loop: true,
autoPlay: true,
responsiveClass: true,
responsive: {
0: {
items: 1,
nav: false
},
600: {
items: 3,
nav: false
},
1000: {
items: 4,
nav: false
}
}
});
});
</script>
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
.swal2-popup {
font-size:1.5rem!important;
}
</style>	
</head>

<body class="bg_gray">
<?php
include_once("../header.php");
?>
<!-- Modal -->
<!--Adding new Resume modal-->
<div class="modal fade jobseeker" id="addnews" tabindex="-1" role="dialog" aria-labelledby="resumeModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content no-radius">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h3 class="modal-title" id="resumeheadr">Add News</h3>
</div>
<div class="modal-body">
<form action="<?php echo $BaseUrl . '/business-directory/addnews.php'; ?>" id="addnew_form" method="post" class="">
<input type="hidden" id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" value="<?php echo $_SESSION['pid']; ?>">
<div class="form-group">
<label for="recipient-name" class="control-label">
Title<span class="red">*</span><span class="red" id="error_title"></span>
</label>
<input type="text" class="form-control no-radius" id="cmpanynewsTitle" name="cmpanynewsTitle" />
</div>
<div class="row">
<?php
$prof = new _spprofiles;
$result2 = $prof->chekProfileIsBusiness($_SESSION['uid']);
//echo $prof->ta->sql;
if ($result2) {
while ($row2 = mysqli_fetch_assoc($result2)) { ?>
<div class="col-md-6">
<div class="checkbox">
<label><input type="checkbox" value="<?php echo $row2['idspProfiles']; ?>" name="profileCheck[]" <?php echo ($_SESSION['pid'] == $row2['idspProfiles']) ? 'checked' : ''; ?>><?php echo $row2['spProfileName']; ?></label>
</div>
</div>
<?php
}
}

?>

</div>
<div class="form-group">
<label for="recipient-name" class="control-label">
Description<span class="red">*</span><span class="red" id="error_desc"></span>
</label>
<textarea class="form-control no-radius" id="cmpanynewsDesc" name="cmpanynewsDesc"></textarea>
</div>
<div class="modal-footer" class="uploadupdate">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
<button type="button" id="btnsubmit" class="btn btn-primary btn-border-radius">Add</button>
</div>
</form>
</div>
</div>
</div>
</div>
<!--READALL NEWS-->
<div class="modal fade jobseeker" id="ReadNews" tabindex="-1" role="dialog" aria-labelledby="resumeModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content no-radius">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h3 class="modal-title" id="resumeheadr">Update News</h3>
</div>
<div class="-modalbody">
<form action="<?php echo $BaseUrl . '/business-directory/updatenews.php'; ?>" method="post" class="">
<div id="updateNews" style="padding:25px;"></div>
<div class="modal-footer" class="uploadupdate">

<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary btn-border-radius">Update</button>
</div>
</form>
</div>
</div>
</div>
</div>

<section>
<div class="row no-margin">
<!-- <div class="col-md-3 no-padding">
<?php
//include('../component/left-business.php');
?>
</div>-->
<div class="col-md-12 no-padding">
<div class="head_right_enter">
<div class="row no-margin">
<?php
include('top-head-inner.php');
?>
<div class="col-md-12 no-padding">
<div class="tab-content no-radius otherTimleineBody m_top_20" style="padding: 0px 20px;">
<!--PopularArt-->
<div role="tabpanel" class="tab-pane active serviceDashboard" id="video1">
<?php include('search-form.php'); ?>
<?php include('top-dashboard.php'); ?>
<div class="bg_white" style="padding: 20px;">

<div class="row">
<div class="col-md-12 m_btm_15 ">
<?php
//echo $_SESSION['ptid'];
if (isset($_SESSION['ptid']) && $_SESSION['ptid'] == 1 ||  $_SESSION['ptid'] == 3) {
?>
<a href="#" class="btn btn_bus_dircty pull-right btn-border-radius" data-toggle="modal" data-target="#addnews" id="addnews" style=" background-color:#e39b0f;"><span class="glyphicon glyphicon-plus"></span> Add News</a>
<?php
}
?>


</div>
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<div class="container-fluid">

<div class="col-md-12">

<div class="table-responsive1">
	<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<table class="table table-striped table-class" id= "example">
<!-- <table class="table table-striped table-bordered  tabDirc dashServ" id="example"> -->
<thead class="">
<tr>
	<th></th>
<th style="width: 50px;">ID</th>
<th >Title</th>
<th style="width: 500px;">Description</th>
<th>Posted Date</th>
<th class="text-center" style="width: 150px;">Action</th>
</tr>
</thead>
<tbody>
<?php
$cn = new _company_news;
$result1 = $cn->readMyNews($_SESSION['pid']);
//echo $cn->ta->sql;
if ($result1) {
	$i = 1;
while ($row = mysqli_fetch_assoc($result1)) {
$postTime = strtotime($row['cmpanynewsdate']); ?>
<tr>
	<td></td>
<td><?php echo $i++;?></td>
<td><?php echo $row['cmpanynewsTitle'] ?></td>
<td><div style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 200px;"><span title="<?php echo $row['cmpanynewsDesc']; ?>"><?php echo $row['cmpanynewsDesc'] ?></span></div></td>
<td style="width: 100px;"><?php echo date("d-M-Y", $postTime); ?></td>
<td text-align="center">
<!-- <a href="javascript:void(0)" data-newsid="<?php echo $row['idcmpanynews']; ?>" data-toggle="modal" data-target="#ReadNews" class="editNews"><i title="Edit" class="fa fa-pencil"></i></a> -->

<a href="#" onclick="address_not('<?php echo $row['idcmpanynews']; ?>')" ><i title="Delete" class="fa fa-trash"></i></a>

</td>
</tr>

<?php
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
</div>
</section>
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

<!-- <script type="text/javascript">
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


// $('#example tbody').on('click', 'tr', function() {

// alert(table.row( this ).data()[0]);

});

</script> -->
<div class="space-lg"></div>

<?php
include('../component/f_footer.php');
include('../component/f_btm_script.php');
?>
<!-- notification js -->
<script src='<?php echo $BaseUrl . '/assets/'; ?>js/bootstrap-notify.min.js'></script>
</body>

</html>
<?php
} ?>
<script src='<?php echo $baseurl?>/assets/js/sweetalert.js'></script>
<script>
$("#btnsubmit").click(function() {

var title = $("#cmpanynewsTitle").val();
var desc = $("#cmpanynewsDesc").val();


if ((title == "") || (desc == "")) {
if (title == "") {
$("#error_title").text("This is required field");
} else {
$("#error_title").text("");
}
if (desc == "") {
$("#error_desc").text("This is required field");
} else {
$("#error_desc").text("");
}
return false;
} else {
$("#addnew_form").submit();
}

});

// function address_not(){
// 		swal("Please Select Shipping Address");
// 	}

function address_not(id) {
// alert(id);
Swal.fire({
title: 'Are you sure you want to delete ?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
confirmButtonText: 'Yes',
cancelButtonColor: '#FF0000',
cancelButtonText: 'No'

}).then((result) => {
if (result.isConfirmed) {
$.ajax({
url: "deletenews.php",
type: "post",
data: {
id: id
},
success: function(response) {
window.location.reload();
// You will get response from your PHP page (what you echo or print)
},

});
}
})
}
</script>



<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
<!-- <script>

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
</script> -->
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
