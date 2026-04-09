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
<a href="<?php echo $BaseUrl.'/store/pos_dashboard1/add_cust_membership.php'; ?>" class="btn btn-primary pull-right">Add Membership</a>
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
<th class="text-center">Membership Duration</th>
<th class="text-center">Membership Status</th>
<th class="text-center">Action</th>
</tr>
</thead>
<tbody>


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