
<?php
include('../../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="store/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class){
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$_GET["categoryid"] = "1";
?>
<!DOCTYPE html>
<html lang="en-US"> 

<head>
<?php include('../../component/f_links.php');?>
<!-- ===== INPAGE SCRIPTS====== -->
<?php include('../../component/dashboard-link.php'); ?>   


</head>

<body class="bg_gray">
<style>
.swal2-popup {
    
    font-size: 2rem !important;
}
</style>
<?php

$activePage = 1;
//this is for store header
$header_store = "header_store";

include_once("../../header.php");
?>

<section class="main_box">
<div class="container">
<a href="<?php echo $BaseUrl.'/store/pos_dashboard/add_membership.php'; ?>" class="btn btn-primary pull-right">Add Membership</a>
<div class="row">

<div id="sidebar" class="col-md-2 hidden-xs no-padding">
<div class="left_grid store_left_cat">
<?php
include('left-posmenu.php'); 
?>
</div>
</div>


<div class="col-md-10 " style="padding-bottom: 15px; margin-top: 10px;">
<div class="box box-success">
<div class="box-header">



</div><!-- /.box-header -->
<div class="box-body">



<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<?php 
	$p = new _pos;

$result = $p->read_membership($_SESSION['uid']);

if ($result!=false) {
	$table="example";
}else{
	$table="";
}
	if($table=="example"){
	?>
<div class="table-responsive" style="overflow-x:hidden;">
<table class="table table-striped "  class="table table-striped table-bordered dashServ display" id="example" >
<thead>
<tr>
<th  class="text-center">Sr. No</th>
<th  class="text-center">Sr. No</th>
<th  class="text-center">Membership Name</th>
<th  class="text-center">Membership Price</th>
<th class="text-center">Membership Quantity</th>
<th class="text-center">Membership Status</th>
<th class="text-center">Action</th>
</tr>
</thead>
<tbody>
<?php
$p = new _pos;
$curr=$p->currency($_SESSION['uid']);
if($curr!=false){
	$c=mysqli_fetch_assoc($curr);
	$currency=$c['currency'];
	
}
$result = $p->read_membership($_SESSION['uid']);

if ($result!=false) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {


?><tr>
<td class="text-center "><?php echo $i ;?></td>
<td class="text-center "><?php echo $i ;?></td>
<td class="text-center "><?php echo $row['membership_name'] ;?></td>
<td class="text-center "><?php echo  $currency.' '.$row['membership_price'] ;?></td>
<td class="text-center "><span class="smalldot"><?php echo  $row['membership_duration'].' '.'Days'; ?></span></td>
<td class="text-center "><span class="smalldot">
	
	<?php if($row['membership_status']==1){echo "Active";}
		
		else{echo "Inactive";}
		?></span></td>



<td class="text-center">
<a href="<?php echo $BaseUrl.'/store/pos_dashboard1/edit_membership.php?id='.$row['id']; ?>" class="" data-postid="<?php echo $row['id'];?>"><i style="font-size: 18px;" class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
<a onclick="del('<?php echo $BaseUrl.'/store/pos_dashboard1/delete.php?id='.$row['id']?>')"><i style="font-size: 18px;" class="fa fa-trash"></i></a>
</td> 
</tr>
<?php
$i++;
}
}
?>


</tbody>
</table>
</div>  
	<?php }else{echo "<span>No Data Found</span>";}?>
</div>
</div>



</div>

</div>
</div>
</section>










<?php 
include('../../component/f_footer.php');
include('../../component/f_btm_script.php'); 
// <!-- ========DASHBOARD FOOTER CHARTS====== -->
include('../../component/dash_btm_script.php');
?>
</body>
</html>
<?php
}
?>

<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

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
</script>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
	<script>
	function del(url){
        //alert('jjjjjj');
      Swal.fire({
      title: 'Are you sure?',
      text: "It will updated permanently !",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      //confirmButtonText: 'Yes, update it!'
    }).then((result) => {
      if (result.isConfirmed) {
         window.location = url;
      }
    })  
            
 }   
</script>