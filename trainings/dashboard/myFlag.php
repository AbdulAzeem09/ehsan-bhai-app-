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

$_GET["categoryid"] = $_GET["categoryID"] = 8;
$_GET["categoryName"] = "Trainings";
$header_train = "header_train";

$activePage = 4;
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
<h1>Flagged Training</h1>
</div>
<div class="row">
<?php
$p = new _flagpost;
$result = $p->readflag($_SESSION['pid'],$_GET['categoryID'] );
//$result = $p->myAllSongs($_SESSION['pid'], $_GET['categoryID']);
//echo $p->ta->sql;
if($result != false){
$table="example";
}else{
$table="";
}

?>
<div class="col-md-12">
	<?php if($table=="example"){?>
<div class="table-responsive bg_white">
<table class="table tbl_training_setting display" id="<?php echo $table;?>" cellspacing="0" width="100%" >
<thead>
<tr>
<th class="text-center">Id</th>
<th class="text-center">Id</th>
<th class="text-center">Post</th>
<th class="text-center">Flag Title</th>
<th class="text-center">Flag Description</th>

<th class="text-center">Flagged On</th>

</tr>
</thead>
<tbody id="showMysong">
<?php
$p = new _flagpost;
$result = $p->readflag($_SESSION['pid'],$_GET['categoryID'] );
//$result = $p->myAllSongs($_SESSION['pid'], $_GET['categoryID']);
//echo $p->ta->sql;
if($result != false){   
$i=1;
while ($row = mysqli_fetch_assoc($result)) {
	//print_r($row);
	$po= new _postings; 
	$res = $po->read_training($row['spPosting_idspPosting']);
	if($res!=false){
	$rrr=mysqli_fetch_assoc($res);
	$title=$rrr['spPostingTitle'];
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
<a href="<?php echo $BaseUrl?>/trainings/detail.php?postid=<?php echo $row['spPosting_idspPosting'];?>"><?php
echo $title;
?></a>
</td>
<td class="text-center">

<?php echo $row['why_flag'];?>
</td>

<td class="text-center">
<?php
echo ($row['flag_desc']=="")?"No Description":$row['flag_desc'];
?>
</td>


<td class="text-center">
<?php
echo $row['flag_date'];
?>
</td>
</tr> <?php
$i++;  }
}
?>

</tbody>
</table>
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



