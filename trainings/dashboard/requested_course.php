<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/

include('../../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="store/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$_GET["categoryid"] = $_GET["categoryID"] = "8";
$_GET["categoryName"] = "Trainings";
$header_train = "header_train";

$activePage = 6;
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
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
.tooltip:hover .tooltiptext {
visibility: visible;
}
#example_filter{
margin-bottom: 5px;
margin-right: 5px;

}


div:where(.swal2-container).swal2-center>.swal2-popup {

height: 297px;
font-size: 15px;
}
.dropdown-menu {
border: none!important;
}
#profileDropDown li.active {
background-color: #417281!important;
}
#profileDropDown li.active a {
color: #fff!important; 
}
</style>
</head>

<body class="bg_gray">
<?php
include_once("../../header.php");
?>
<section class="main_box">
<div class="container">
<div class="row">
<div class="sidebar col-md-2 no-padding left_train_menu" id="sidebar" >
<?php include('left-menu.php'); ?> 
</div>
<div class="col-md-10">
<div class="col-xs-12 trainDashTop text-center">
<h1>Requested Course</h1>
</div>
<?php
$p = new _postings;
$result = $p->read_requested_course();
//$result = $p->myAllSongs($_SESSION['pid'], $_GET['categoryID']);
//echo $p->ta->sql;
if($result != false){
$table="example";
}else{
$table="";
}

?>
<div class="row">
<div class="col-md-12">
<div class="table-responsive bg_white">
<div style="margin-top:10px">
<table class="table tbl_training_setting display" id="<?php echo $table;?>" cellspacing="0" width="100%" >
<thead>
<tr>
<th class="text-center">Id</th> 
<th class="text-center">Id</th>

<th class="text-center">Category</th>
<th class="text-center">About</th>
<th class="text-center">Email</th>
<th class="text-center">Quantity</th>
<th class="text-center">Action</th>
</tr>
</thead>
<tbody id="showMysong">
<?php
$p = new _postings;
$result = $p->read_requested_course($_SESSION['uid'], $_SESSION['pid']);
//$result = $p->myAllSongs($_SESSION['pid'], $_GET['categoryID']);
//echo $p->ta->sql;
if($result != false){
$i=1;
while ($row = mysqli_fetch_assoc($result)) {
//print_r($row);

/*$po= new _postings;
$p1=$po->read_training($row['sppostings_idsppostings']);
if($p1!=false){
$rrr=mysqli_fetch_assoc($p1);
//print_r($rrr);
$title=$rrr['spPostingTitle'];
$category=$rrr['trainingcategory'];

}*/
?>

<tr class="searchable">

<td class="text-center">
<?php

echo $i;
?>
</td>
<td class="text-center">
<?php

echo $i;
?>
</td>
<td class="text-center">
<?php echo $row['category'];?>
</td>
<td class="text-center">
<?php echo $row['about_course'];?>
</td>

<td class="text-center">
<?php

echo $row['email'];
?>
</td>

<td class="text-center">
<?php

echo $row['quantity'];
?>
</td>

<td><a onclick="hello('<?Php echo $row['id'];?>')"><i title="Delete" class="fa fa-trash" ></i>
</a></td>



</tr> <?php
$i++; }
}
?>

</tbody>
</table>
</div>
</div>
</div>

</div>
</div>
</div>
</div>
</section>


<div class="space-lg"></div>

<?php 
include('../../component/f_footer.php');
include('../../component/f_btm_script.php'); 
?>
<!-- notification js -->
<script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

</body>
</html>
<?php
}
?>

<script src='<?php echo $baseurl?>/assets/js/sweetalert.js'></script>


<script>
function hello(id){

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

window.location.href ="<?php echo $BaseUrl; ?>/trainings/dashboard/delete_requested.php?postid="+id+"";
} 
});

}

</script>










<script>
$(document).ready(function(){
var table = $('#example').DataTable({ 
select: false,
"columnDefs": [{
className: "Name", 
"targets":[0],
"visible": false,
"searchable":false
}]
});
//End of create main table


$('#example tbody').on( 'click', 'tr', function () {

// alert(table.row( this ).data()[0]);

} );
} );

</script>