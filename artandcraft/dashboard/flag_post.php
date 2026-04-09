<?php 
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
include('../../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="artandcraft/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$_GET["categoryID"] = 13;

$activePage = 50;


?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php');?>


<!-- ===== INPAGE SCRIPTS====== -->
<!-- High Charts script -->
<script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<?php include('../../component/dashboard-link.php'); ?>
</head>

<body class="bg_gray">
<?php 
$header_photo = "header_photo";
include_once("../../header.php");
?>


<section class="">
<div class="container-fluid">                
<div class="row">
<div class="sidebar col-md-2 no-padding left_photo_menu" id="sidebar" >
<?php include('left-menu.php'); ?> 
</div>

<div class="col-md-10">
<div class="panel panel-default" style="margin-top:10px;">
<div class="panel-heading"> Dashboard / Flag Post </div>
</div>
<div class="row pro_detail_box">



<!---<div class="col-md-4">

</div>--->


<div class="col-md-12" style="margin-top:10px;">

<div class="col-md-12" style="margin-top:10px;">



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

#example_filter label{margin-bottom: 3px;}
#example_length label{margin-top: 5px;}
</style>


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



<!-- partial:index.partial.html -->
<!-- <table id="example" class="display" cellspacing="0" width="100%" > -->
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<table class="table table-striped table-class" id= "example">
<thead>
<tr style="background-color: #99068a;color:white;">
<th></th>
            <th>Id</th>
            <th>Product Name</th>
            <th>Name</th>
            <th>Flagged Date</th>
            <th>Reason</th>
            <th>Flag Name</th>
            <th>Action</th>
        </tr>
</thead>
<tbody>

<?php
$objflag = new _flagpost;
$resultflaf= $objflag->readflag($_SESSION['pid'],13);
//var_dump($resultflaf);
$i=0;
if($resultflaf!=false){
while($row222=mysqli_fetch_assoc($resultflaf)){
  $i++;
//print_r($row222);
//die('kkkkk');

?>
<tr>
<td></td>
<td> <?php echo $i; ?></td>

<td>

<?php
$postid= $row222['spPosting_idspPosting'];

$result2= $objflag->readsppos($postid);

//print_r($result2);die("========");
if($result2 != false){
$rows=mysqli_fetch_assoc($result2);
$ptitle=$rows['spPostingTitle'];
}else {
    $ptitle="";
}
?>

<a href="<?= $BaseUrl; ?>/artandcraft/detail.php?postid=<?php echo $postid; ?>"><?php echo $ptitle; ?>






</td>


<td><?php 
$result = $row222['spProfile_idspProfile'];


$objpro = new _spprofiles;
$resultp88=$objpro->readname($result);
$row88=mysqli_fetch_assoc($resultp88);
?>
<a href="<?php echo $BaseUrl.'/friends/?profileid='.$result;?>"><?php echo $row88['spProfileName']; ?></a>
</td>	
<td><?php echo $row222['flag_date'] ?></td>
<td><?php echo $row222['why_flag'] ?></td>
<td><?php echo $row222['flag_desc'] ?></td>


<!--<td><a href="<?php echo 'deleteflagpost.php?postid=' . $row222['flag_id']; ?>" data-original-title="View Detail" data-toggle="tooltip" data-placement="top" class="btn btn-xs menu-icon vd_bg-blue"> <i class="fa fa-trash-o" style="font-size:16px"></i></a></td>--->
<td><a onclick="deletedata('<?php echo 'deleteflagpost.php?postid=' . $row222['flag_id']; ?>')"><i title="Delete" class="fa fa-trash"></i></a></td>
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
<!-- partial -->
<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
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
});//End of create main table


$('#example tbody').on( 'click', 'tr', function () {

// alert(table.row( this ).data()[0]);

} );
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
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script> 
<script>
function deletedata(a){
//alert(a);
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
window.location.href = a;
}
});

}
</script>

