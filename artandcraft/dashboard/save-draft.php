<?php 
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

$activePage = 16;


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
<?php 
$header_photo = "header_photo";
include_once("../../header.php");
?>





<div class="container-fluid">
<div class="row">


<div class="sidebar col-md-2 no-padding left_photo_menu" id="sidebar" >
<?php include('left-menu.php'); ?> 
</div>


<div class="col-md-10">
<div class="panel panel-default" style="margin-top:10px;">
<div class="panel-heading"> Dashboard / Draft Listing</div>
</div>

<div class="col-md-12 row pro_detail_box" style="margin-top:10px;">


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


.text-center{
margin-top:0px;
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


<!-- <table id="example" class="display" cellspacing="0" width="100%"> -->
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<table class="table tbl_store_setting  table-striped table-class" id= "example">
<thead>
<tr style="background-color: #99068a;color:white;">
<th>Id</th>
<th>Id</th>

<th>Title</th>
<th>Price</th>
<th>Date</th>
<th>Type</th>
<th>Detail</th>
</tr>

</thead>
<!-- <tfoot>
<tr>
<th>Id</th>
<th>Id</th>

<th>Title</th>
<th>Price</th>
<th>Date</th>
<th>Type</th>
<th>Detail</th>
</tr>
</tfoot> -->


<tbody>
<?php

$p = new _postingviewartcraft;
$result = $p->readMyDraft($_SESSION['pid']);
//echo $p->ta->sql; die;
if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
$dt = new DateTime($row['spPostingDate']);
?>
<tr>
<td><?php echo $i; ?></td>
<td><?php echo $i; ?></td>
<!--<td>
<?php
/*	$pic = new _postingpicartcraft;
$res2 = $pic->read($row['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
}else{
$pic2 = '/../img/no.png';
}*/



$userid=$_SESSION['uid'];
$c= new _orderSuccess;
$currency= $c->readcurrency($userid);
$res1= mysqli_fetch_assoc($currency);
$curr=$res1['currency'];


?>
<!--<a href="<?php //echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings']; ?>">
<img alt="Posting Pic" src="<?php //echo $pic2; ?>" class="img-responsive" style=" height: 100px; width: 100px; ">
</a>
</td>-->
<td><a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings']; ?>"><?php echo $row['spPostingTitle']; ?></a></td>
<td><?php echo $curr.' '.$row['spPostingPrice']; ?></td>
<td><?php echo $dt->format('d M Y'); ?></td>
<td><?php
if($row['ad_type']==1){
echo 'Art';
}	
if($row['ad_type']==2){
echo 'Craft';
}	
?></td>
<td>
<a href="<?php echo $BaseUrl.'/post-ad/photos/?postid='.$row['idspPostings'];?>"><i style="color: #428bca" title="Edit" class="fa fa-pencil"></i></a>
<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings']; ?>">
<i title="View" class="fa fa-eye"></i>
</a>


<!--<a onclick="swal()"  href="<?php echo $BaseUrl.'/artandcraft/dashboard/active-art.php?action=delete&postid='.$row['idspPostings']; ?>">
<i id="button99" class="fa fa-trash" aria-hidden="true"></i>

</a>-->


</td>
</tr>
<?php
$i++;
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

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<!-- <script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<!-- <script type="text/javascript">
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


$('#example tbody').on( 'click','tr', function () {

// alert(table.row( this ).data()[0]);

} );
}); -->




</script>
</div><div class="row"> <?php


//my code
$save=1;

if($_GET['page']==1){

$start = 0;
}else{
$sss = $_GET['page']-1;
$start = 8*$sss;
}
$limita = 8;		
$result = $p->singleFriendProductactiveart($save, $_SESSION['pid'], 13);
//var_dump($result); die;
//if($result==true){
$numrowsw =$result->num_rows;

// die('-----9856--');
if ($result) {
while ($row = mysqli_fetch_assoc($result)) {
?>
<div class="col-md-3 <?php echo $row['idspPostings']; ?>">
<div class="artBox">
<div class="topartBox">
<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" class="btn btn_custom bg_purple">Sale</a>
<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" class="btn btn_custom bg_green_art">New</a>
<div class="mainOverlay">
<?php
$pic = new _postingpicartcraft;
$res2 = $pic->read($row['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >"; ?>
<div class="overlay">
<div class="text">
<a href='<?php echo ($pic2);?>' class='test-popup-link btn' title='<?php echo $row['spPostingTitle']; ?>'><i class="fa fa-search-plus"></i></a>
<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" class="btn viewPage"><i title="View" class="fa fa-eye"></i></a>
</div>
</div> <?php
} else{
echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>"; ?>
<a class="title" href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>">
<div class="overlay">
<div class="text">No Image</div>
</div> 
</a>
<?php
} ?>
</div>

<a class="title" href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>"><?php echo $row['spPostingTitle'];?></a>
<p>
<?php
if(strlen($row['spPostingNotes']) < 80){
echo $row['spPostingNotes'];
}else{
echo substr($row['spPostingNotes'], 0,80)."...";

} ?>
</p>
<hr>
<div class="row">
<div class="col-md-12">
<!-- <strike>#40.00</strike> -->
<?php
if(empty($row['spPostingPrice'])){
echo "<span class='price'>Free</span>";
}else{
echo '<span class="price"> '.$row['defaltcurrency'].' '.$row['spPostingPrice'].'</span>';
}
?>

<?php 
if(empty($row['discountphoto'])){
}else{ 
echo '  <span class="price text-success" style="color:green;">  <del>  $'.$row['discountphoto'].  '  </del></span>  ';
$perto =  $row['discountphoto']/$row['spPostingPrice']*100;
echo '  ('.$perto.'%)  ';
}
if($row['sippingcharge']==1){

echo '  <span class="badge badge-success" style=" background-color: green; ">Free Delivery</span>';
}
?>  
</div>
</div>
</div>
<div class="btmartBox">
<ul>
<li><a class="removetoboardashboard" data-postid="<?php echo $row['idspPostings']; ?>" data-pid="<?php echo $_SESSION['pid'];?>" data-toggle="tooltip" title="Remove from board"><img src="<?php echo $BaseUrl?>/assets/images/art/icon-add.png" alt="" class="img-responsive"></a></li>

<li><a href="javascrpit:void(0)" data-toggle="tooltip" title="Share"><img src="<?php echo $BaseUrl?>/assets/images/art/icon-share.png" alt="" class="img-responsive"></a></li>
<li><a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" data-toggle="tooltip" title="View Product">
<i class="fa fa-info-circle" aria-hidden="true" style=" font-size: 27px; color: white; "></i>
</a></li>
</ul>
</div>
</div>
</div> <?php
}

}

?>


</div>					
<div class="row" style=" margin-bottom: 30px; ">	
<div class="col-md-6" style=" text-align: left; ">
<?php
//die('==uttrujrtj==');
/*	$resallcount = $p->singleFriendProduct($save, $_SESSION['pid'], 13);
$allprocount = mysqli_num_rows($resallcount);

$pre = $_GET['page']-1;
$nex = $_GET['page'];
$c2 = $nex*$numrowsw;

if($pre==0){
$c1 = 1;
}else{
$c1 = $pre*8;			
if($c1*2 != $c2){
$c2 = $allprocount;
}
}



echo 'Showing '.$c1.' to '.$c2.' of '.$allprocount.' entries ';
*/
?>
</div>
<div class="col-md-6" style=" text-align: right; ">
<?php if($_GET['page']!=1){ ?>

<a href="/artandcraft/dashboard/active-art.php?page=<?php echo $_GET['page']-1 ;?>">Previous</a>
<?php }  ?>

<?php if($_GET['page']!=1 && $numrowsw==8){ ?>

<span> || </span>

<?php } ?>		
<?php if($numrowsw==8){ ?>	

<a href="/artandcraft/dashboard/active-art.php?page=<?php echo $_GET['page']+1 ;?>">Next</a>

<?php } ?>
</div>
</div>

</div>

</div>
</div>



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
