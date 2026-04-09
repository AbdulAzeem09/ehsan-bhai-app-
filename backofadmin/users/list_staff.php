<?php
if (!defined('WEB_ROOT')) {
exit;
}

?>
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>Staff Role <small>[List]</small></h1>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
<div class="col-md-12">
<div class="box box-success">
<div>

</div>
<div class="box-header text-right">
<a class="btn btn-primary" href="<?php echo WEB_ROOT_ADMIN . "users/index.php?view=add_staff" ?>"><i class="fa fa-plus"></i> Add Role </a>
</div><!-- /.box-header -->


<div class="box-body">
<div class="table-responsive">
<table id="example1" class="table table-bordered">
<thead>
<tr>
<th>ID</th>
<th>Role Name</th>
<th >Action </th>
</tr>
</thead>
<tbody>
<?php 
$sql1= "SELECT * FROM `staff`";
$result = dbQuery($dbConn,$sql1);
while($row = dbFetchAssoc($result)) {

?>
<tr>
<td><?php echo $row['id'];  ?></td>
<td><?php echo $row['role_name'];  ?></td>
<td >
<a href="<?php echo WEB_ROOT_ADMIN . "users/index.php?view=staff_edit&id=".$row['id']?>" class="btn btn-primary">Edit</a>
<a href="<?php echo WEB_ROOT_ADMIN . "users/index.php?view=delete_staff&id=".$row['id']?>" class="btn btn-danger">Delete</a>
</td>
</tr>
<?php }?>
</tbody>
</table>
</div>
</div>
<!--- End Table ---------------->
</div>
</div>
</div>




</section><!-- /.content -->
<script type="text/javascript">

$(document).ready( function () {
var table = $('#example1').DataTable( {

"order": [[ 0, "desc" ]],
pageLength : 10,
lengthMenu: [[10,20, 50, 100], [10,20, 50, 100]]
} );



} );
</script>	

<script type="text/javascript">
$(document).ready(function(){

$('#allselect').click(function(){

if($('input[name="allselect"]').is(':checked'))
{
$(".sdelete").prop('checked', true);
}else{

$(".sdelete").prop('checked', false);
}
})

$('#deletemulti').click(function(){
var val = [];
$('.sdelete:checked').each(function(i){
val[i] = $(this).val();
});
swal({
title: "Do You Want Delete this All?",
/*text: "You Want to Logout!",*/
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes, Delete!",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "Cancel",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm){
$.ajax({
type: "POST",
url:"deleteMultiple.php",
data: {deleteuser:val}, // serializes the form's elements.
success: function(data)
{
window.location.href = 'index.php';
}
});
}

});
})
})
</script>