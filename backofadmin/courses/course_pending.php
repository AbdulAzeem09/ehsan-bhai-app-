<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

if (!defined('WEB_ROOT')) {
exit;
}
include('../../univ/baseurl.php');

$sql =  "SELECT * FROM sptraining where status = 0 ";
$result  = dbQuery($dbConn, $sql);


?>

<!-- Content Header (Page header) -->
<section class="content-header top_heading">
<h1>Pending Courses<small>[List]</small></h1>
</section>
<!-- Main content -->
<section class="content">
<div class="box box-success">



<div class="box-body" >
<div class="table-responsive tbl-respon">
<table id="example1" class="table table-bordered table-striped tbl-respon2">
<thead>
<tr>
<th class="text-center">ID</th>
<th>Course Title</th>
<th>Category</th>
<th>Status</th>

<th class="text-center">Action</th>
</tr>
</thead>
<tbody>
<?php
if ($result) {
$i = 1;
while ($row = dbFetchAssoc($result)) {
//print_r($row);
//die('==');
extract($row);

?>
<tr>
<td class="text-center"><?php echo $i; ?></td>
<td><?php echo ucfirst(strtolower($spPostingTitle)); ?></td>
<td><?php echo ucfirst(strtolower($trainingcategory)); ?></td>


<td><?php 
//echo $status;
if($status==1){
?>
<button type="button" onclick="active(<?php echo trim($id); ?>)" class="btn btn-info">Active</button>
<?php		
}else{
?>
<button type="button" onclick="pending(<?php echo trim($id); ?>)" class="btn btn-warning">Pending</button>
<?php 
}


?>
<button type="button" onclick="rejected(<?php echo trim($id); ?>)" class="btn btn-danger">Reject</button>
</td>
<td class="menu-action text-center">




<a href="<?php echo $BaseUrl?>/post-ad/trainings/?postid=<?php echo trim($id); ?>" data-original-title="Detail" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-info"></i> </a>


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
</div>
<!--- End Table ---------------->
</div>


</section><!-- /.content --><script type="text/javascript">

$(document).ready( function () {
var table = $('#example1').DataTable( {

"order": [[ 0, "asc" ]],
pageLength : 10,
lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
} );



} );

</script>	
<script>
function active(id){
//alert('1111');


swal({
title: "Are you sure you want to De-Active this Course ?",   
/*text: "You Want to Logout!",*/
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes, Update!",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "Cancel",
showCancelButton: true,
},
function(isConfirm) {
if(isConfirm){
window.location.href= 'update_status.php?action=active&id=' + id;
} 

});	
}

function pending(id){
//alert('00000');
swal({
title: "Are you sure you want to Active this Course ?",
/*text: "You Want to Logout!",*/  
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes, Update!",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "Cancel",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
window.location.href = 'update_status.php?action=pendingActive&id=' + id;
} 
});
}

function rejected(id){
//alert('00000');
swal({
title: "Are you sure you want to Reject this Course ?",
/*text: "You Want to Logout!",*/  
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes, Reject!",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "Cancel",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
window.location.href = 'update_status.php?action=pendingReject&id=' + id;
} 
});
}
</script>	
