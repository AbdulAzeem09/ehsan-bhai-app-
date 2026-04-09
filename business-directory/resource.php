<?php

// error_reporting(E_ALL);
// ini_set('display_errors', '1');    
// include('../univ/baseurl.php');
session_start();

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
$activePage = 3;
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
</style>
</head>

<body class="bg_gray">
<?php
include_once("../header.php");
?>
<section>
<div class="row no-margin">
<!--<div class="col-md-3 no-padding">
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
<div class="col-md-offset-6 col-md-2 text-right">
<a href="<?php echo $BaseUrl . '/business-directory/resource.php'; ?>" class="btn btn_bus_dircty btn-border-radius" style="margin-top: 0px;background-color:#e39b0f;">Clear Filter</a>
</div>
<div class="col-md-4 m_btm_15">
<select class="form-control" id="busCatResouce">
<option>Select Category</option>

<?php
//echo "<option value='' disabled selected>".$row["Business Category"]."</option>";
$m = new _masterdetails;
$masterid = 8;
$result = $m->read($masterid);
if ($result != false) {
while ($rows = mysqli_fetch_assoc($result)) { ?>
<option value='<?php echo $rows["idmasterDetails"]; ?>'><?php echo $rows["masterDetails"]; ?></option><?php
}
}
?>
</select>
</div>
</div>
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<div class="row">
<div class="container-fluid">

<div class="col-md-12">
<div class="table-responsive1">
    <link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<table class="table table-striped table-class" id= "example">
<!-- <table class="table table-striped table-bordered dashServ" id="example"> -->
<thead>
<tr>
    <th></th>
<th>ID</th>
<th>My Resources</th>
<th class="text-center">Category</th>
<th class="text-center">Country</th>
<th class="text-center">City</th>
<th class="text-center">Action</th>
</tr>
</thead>
<tbody id="showMyRes">
<?php
$fd = new _favouriteBusiness;
$pp = new _spprofiles;
$pf = new _profilefield;

$result = $fd->readmyFavourite($_SESSION['pid'], 2);
//echo $fd->ta->sql;
if ($result) {
    $i = 1;
while ($row = mysqli_fetch_assoc($result)) {
$res = $pp->readUserId($row['idspProfiles_spProfileCompany']);


//echo $p->ta->sql;
if ($res) {
while ($row2 = mysqli_fetch_assoc($res)) {
// print_r($row2); 
$name       = $row2["spProfileName"];
$country    = $row2["spProfilesCountry"];
$state      = $row2["spProfilesState"];
$city       = $row2["spProfilesCity"];

$query = $pf->read($row2["idspProfiles"]);
if ($query != false) {
$cmpnyName = "";
$cmpnyAddress = "";
$cmpnyCategory = "";

while ($row6 = mysqli_fetch_assoc($query)) {
//print_r($row6);  
if ($cmpnyName == '') {
if ($row6['spProfileFieldName'] == 'companyname_' || $row6['spProfileFieldName'] == 'companyname') {
$cmpnyName = $row6['spProfileFieldValue'];
}
}
if ($cmpnyAddress == '') {
if ($row6['spProfileFieldName'] == 'companyaddress_' || $row6['spProfileFieldName'] == 'companyaddress') {
$cmpnyAddress = $row6['spProfileFieldValue'];
}
}
if ($cmpnyCategory == '') {
if ($row6['spProfileFieldName'] == 'businesscategory_' || $row6['spProfileFieldName'] == 'businesscategory') {
$cmpnyCategory = $row6['spProfileFieldValue'];
}
}
}
}

// SHOW ALL COUNTRY , STATE, CITY
$st  = new _state;
$c   = new _country;
$ci  = new _city;
// county name
$result3 = $c->readCountryName($country);
if ($result3 != false) {
$row3 = mysqli_fetch_assoc($result3);
}
// provision name
$result5 = $st->readStateName($state);
if ($result5 != false) {
$row5 = mysqli_fetch_assoc($result5);
}
// city name
$result4 = $ci->readCityName($city);
if ($result4 != false) {
$row4 = mysqli_fetch_assoc($result4);
}
?>
<?php
$p = new _spbusiness_profile;

$rpvt = $p->read($row2["idspProfiles"]);

if ($rpvt != false) {
$row_p = mysqli_fetch_assoc($rpvt);

//echo "<pre>";
//print_r($row_p);
$cmpnyName = $row_p['companyname'];
$cmpnnyCategory = $row_p['businesscategory'];
}



// //$mm = new _spprofiles;
// $mstore = $mm->readUserId01($cmpnnyCategory);
// $bcate_11 = mysqli_fetch_assoc($mstore);
// //print_r($bcate_11);
// $mk = new _spprofiles;
// $mkstore = $mk->readcat($cmpnnyCategory);
// $bbcate_1 = mysqli_fetch_assoc($mkstore);
// //print_r($bbcate_1);

$mch = new _spprofiles;
$cats = $mch->readcat11($cmpnnyCategory);
if ($cats != false) {
$catgory_1 = mysqli_fetch_assoc($cats);
}

//print_r($catgory_1);



?>

<tr>
    <td></td>
<td><?php echo $i++;?></td>
<td><a href="<?php echo $BaseUrl . '/business-directory/detail.php?business=' . $row2['idspProfiles']; ?>"><?php echo $cmpnyName; ?></a></td>
<td class="text-center"><?php echo $catgory_1['masterDetails']; ?></td>
<td class="text-center"><?php echo $row3['country_title']; ?></td>
<td class="text-center"><?php echo $row4['city_title']; ?></td>
<td class="text-center">
<a href="<?php echo $BaseUrl . '/business-directory-services/details.php?business=' . $row2['idspProfiles']; ?>" class="btn" data-toggle="tooltip" title="View Business Detail"><i class="fa fa-briefcase"></i></a>
<a href="<?php echo $BaseUrl . '/friends/?profileid=' . $row2['idspProfiles']; ?>" class="btn" data-toggle="tooltip" title="View Profile"><i class="fa fa-user"></i></a>

<a href="javascript:void(0)" class="removeToResorc1 btn" data-favourite="2" data-company="<?php echo $row2['idspProfiles']; ?>" data-pid="<?php echo $_SESSION['pid']; ?>" onclick="address_not(<?php echo $row['idspFavbus']; ?>)">
<span id="addtofavouriteeve"><i class="fa fa-trash"></i></span>
</a>
<?php
$pl = new _favouriteBusiness;

$res = $pl->readResource($row['idspFavbus']);

if ($res != false) {
$row_n = mysqli_fetch_assoc($res);

//echo "<pre>";
//print_r($row_p);
$notes = $row_n['notes'];
}
?>

<a href="javascript:void(0)" class="btn addnotesresource" data-toggle="tooltip" title="Add Notes" data-resourceid="<?php echo $row['idspFavbus']; ?>" data-notes="<?php echo $notes; ?>">
<i class="fa fa-sticky-note" aria-hidden="true" data-toggle="modal" data-target="#myModal_1"></i>
</a>
</td>
</tr>
<?php
}
}
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
<div class="space-lg"></div>
<!-- Modal -->
<div id="myModal_1" class="modal fade" role="dialog">
<div class="modal-dialog" style="width: 790px;">
<!-- Modal content-->
<form method="post" action="updateNotes.php" class="sharestorepos">
<div class="modal-content no-radius">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Add Notes</h4>
</div>
<div class="modal-body">
<label>Notes</label>
<input type="hidden" name="idspFavbus" id="idspFavbus" value="">
<textarea class="form-control" style="height: 100px;" name="notes" id="txtResourceNotes" required=""></textarea>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
<button type="submit" id="share" class="btn btn-primary btn-border-radius">Add Notes</button>
</div>
</div>
</form>
</div>
</div>
<?php
include('../component/f_footer.php');
include('../component/f_btm_script.php');
?>
<!-- notification js -->
<script src='<?php echo $BaseUrl . '/assets/'; ?>js/bootstrap-notify.min.js'></script>
<script>
function address_not(id) {

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

//alert(isfavourite);
$.post("../social/remfavdes11.php", {

id: id
}, function(response) {
//alert(response);
window.location.reload();
});

}
});
}
</script>
</body>

</html>
<?php
} ?>
<script src='<?php echo $baseurl?>/assets/js/sweetalert.js'></script>
<script type="text/javascript">
/* $(document).ready(function(){
$(".addnotesresource").click(function(){
//alert('hello');
var resourceid = $(this).attr("data-resourceid");


var notes = $(this).attr("data-notes"); 
notess = notes.trim();

$('#idspFavbus').val(resourceid);
$('#txtResourceNotes').text(notess);  

});
});*/
</script>

<!-- 
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
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
https://www.thesharepage.com/events/event-detail.php?postid=error:%20Unknown%20column%20%27registration_req%27%20in%20%27field%20list%27
