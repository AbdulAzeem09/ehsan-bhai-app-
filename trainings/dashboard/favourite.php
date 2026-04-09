<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/

include('../../univ/baseurl.php');
session_start();
//print_r($_SESSION); 
// die("dfdgfd");
if(!isset($_SESSION['pid'])){ 
//die("==========================");
$_SESSION['afterlogin']="store/";
include_once ("../../authentication/islogin.php");

}else{
// die("===========555555555555===============");
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$_GET["categoryid"] = $_GET["categoryID"] = "8";
$_GET["categoryName"] = "Trainings";
$header_train = "header_train";

$activePage = 3;
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
<h1>Favourite Training</h1>
</div>
<?php
$p = new _favorites;
$result = $p->chekFavourite_training_post($_SESSION['uid'], $_SESSION['pid']);
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
<?php if($table=="example"){?>
<div class="table-responsive bg_white">
<div style="margin-top:10px">
<table class="table tbl_training_setting display" id="<?php echo $table;?>" cellspacing="0" width="100%" >
<thead>
<tr>
<th class="text-center">Id</th>
<th class="text-center">Id</th>
<th class="text-center">Title</th>
<th class="text-center">Category</th>
<th class="text-center">Action</th>


</tr>
</thead>
<tbody id="showMysong"> 
<?php   
$p = new _favorites;
$result = $p->chekFavourite_training_post($_SESSION['uid'], $_SESSION['pid']);

//$result = $p->myAllSongs($_SESSION['pid'], $_GET['categoryID']);
//echo $p->ta->sql;
if($result != false){
$i=1;
while ($row = mysqli_fetch_assoc($result)) {
///print_r($row);
$spid = $row['id'];
$po= new _postings;
$p1 = $po->read_training($row['sppostings_idsppostings']);

if($p1!=false){
$rrr = mysqli_fetch_assoc($p1);
//print_r($rrr);
// die("++++");
$title = $rrr['spPostingTitle'];
$category = $rrr['trainingcategory'];


}
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
<a href="<?php echo $BaseUrl.'/trainings/detail.php?postid='.$rrr['id'];?>" class="titleBox"><?php echo $title;?></a>
</td>

<td class="text-center">
<?php

echo $category;
?>
</td>



<td><a onclick="hello('<?php echo $BaseUrl; ?>/trainings/dashboard/delete_favourite.php?postid=<?php echo $spid; ?>')"><i title="Delete" class="fa fa-trash"></i></a></td>

</a></td>





</tr> <?php
$i++; }
}
?>

</tbody>
</table>
</div>
</div>
<?php }else{echo "<p class='text-center' style='font-size:25px;margin-top:40px;'>No Records Found</p>";}  ?>
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
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>

<script>
function hello(id){
Swal.fire({
title: 'Are you sure you want to delete ?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
confirmButtonText: 'Yes',
cancelButtonColor: '#FF0000',
cancelButtonText: 'No',
}).then((result) => {
if (result.isConfirmed) {
window.location.href =id;
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