<?php
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

$activePage = 5;
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
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<?php include('../../component/dashboard-link.php'); ?>
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
<h1>My Purchase</h1>
</div>
<div class="row">
	<?php
$p = new _postings;
$result = $p->read_my_purchase_training($_SESSION['pid']);
//echo $p->ta->sql;
if($result != false){
	$table="example";
}
else{
	$table="";
}
?>
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
<div class="col-md-12">
	<?php if($table=="example"){?>
<div class="table-responsive bg_white">
<div style="margin-top:10px">
<table class="table tbl_training_setting display" id="<?php echo $table;?>" cellspacing="0" width="100%" >
<thead>
<tr>

<th class="text-center">Id</th><th class="text-center">Id</th>
<th class="text-center">Title</th>
<th class="text-center">Category</th>
<th class="text-center">Price</th>

<th class="text-center">Company</th>
<th class="text-center">Action</th>
</tr>
</thead>
<tbody id="showMysong">
<?php
$p = new _postings;
$result = $p->read_my_purchase_training($_SESSION['pid']);
//echo $p->ta->sql;
if($result != false){
	$i=1;
while ($row = mysqli_fetch_assoc($result)) {
	//echo $row['postid'];
	$p1=$p->read_training($row['postid']);
	if($p1!=false){
	
	while($rrr=mysqli_fetch_assoc($p1)){
?>
<tr class="searchable">
	<td class="text-center"><?php echo $i;?></td>
	<td class="text-center"><?php echo $i;?></td>
<td class="text-center">


<a href="<?php echo $BaseUrl.'/trainings/detail.php?postid='.$rrr['id'];?>" class="titleBox"><?php echo $rrr['spPostingTitle'];?></a>
</td>

<td class="text-center">
<?php
echo $rrr['trainingcategory'];
?>
</td>
<td class="text-center">
<?php 
echo $rrr['default_currency'].' '.$rrr['spPostingPrice'];
?>

</td>

<td class="text-center">
<?php
echo $rrr['spPostingCompany'];
?>
</td>
<td class="text-center">
<a href="<?php echo $BaseUrl.'/trainings/dashboard/training_detail.php?postid='.$rrr['id']; ?>" class="" data-postid="<?php echo $row['id'];?>"><i title="View" class="fa fa-eye"></i></a>


</td>
</tr> <?php
	$i++;}}}
}
?>

</tbody>
</table>
</div>
</div>
	<?php }else{
		echo "<p class='text-center' style='font-size:25px;margin-top:40px;'>No Records Found</p>";
		}?>
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
<script type="text/javascript">
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


$(document).on("click",".disable-btn",function() {
var dataId = $(this).attr("data-id");
swal({
title: "Delete Training",
/*text: "You Want to Logout!",*/
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes, Delete!",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "Cancel",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
window.location.href = '/trainings/deletePost.php?postid=' + dataId;
} 
});
// alert(dataId);
});
});
</script>
</body>
</html>
<?php
}
?>
