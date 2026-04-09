<?php
if (!defined('WEB_ROOT')) {
exit;
}


$sql =  "SELECT * FROM subcategory WHERE subCategoryStatus != '-7' ";
$result  = dbQuery($dbConn, $sql);


?>

<!-- Content Header (Page header) -->
<section class="content-header">
<h1>All Categories<small>[List]</small></h1>
</section>
<!-- Main content -->
<section class="content">
<?php
include "add.php";
?>
<div class="box box-success">

<div class="box-body">
<?php 
if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
if($_SESSION['count'] <= 1){
$_SESSION['count'] +=1; ?>
<div class="row" id="alertmsg" style="margin: 5px 0px 0px 5px;" >
<div style="min-height:10px;"></div>
<div class="alert alert-<?php echo $_SESSION['data'];?>">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<?php echo $_SESSION['errorMessage'];  ?>
</div> 
</div><?php
unset($_SESSION['errorMessage']);
}
} ?>


<div class="table-responsive tbl-respon">
<table id="example122" class="table table-bordered table-striped tbl-respon2">
<thead>
<tr>
<th style="width: 80px;">ID</th>
<th>Category</th>
<th>Sub Category</th>
<th>Action</th>
</tr>
</thead>
<tbody id="cat_list">
<!-- <?php
if ($result) {
$i = 1;
while ($row = dbFetchAssoc($result)) {
extract($row);
?>
<tr>
<td class="text-center"><?php echo $i; ?></td>
<td><?php showCategoryName($dbConn, $spCategories_idspCategory); ?></td>
<td><?php echo ucfirst(strtolower($subCategoryTitle)); ?></td>
<td class="menu-action text-center">
<a href="javascript:modifySubCategory(<?php echo $idsubCategory; ?>)" data-original-title="Edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-pencil"></i> </a>
<a href="javascript:deleteSubCategory(<?php echo $idsubCategory; ?>)" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>
</td>
</tr>
<?php
$i++;
}
}
?> -->
</tbody>
</table>
</div>
</div>
<!--- End Table ---------------->
</div>


</section><!-- /.content -->

<script type="text/javascript">

$(document).ready( function () {

//$("select#txtCategory").change();
$('select#txtCategory').trigger('change');
// var table = $('#example1').DataTable( {
// 		"order": [[ 0, "desc" ]],
// 		pageLength : 10,
// 		lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100,]]
// } );
//var category_name=$("#txtCategory").find('option:selected').attr("data-name");
//$("#txtCategory").append(category_name); 
// $('#txtCategory').change(function(){
//dataTable.draw(); 

//  	$('#txtCategory').on('change', function() {
// 			alert( $("#txtCategory").find('option:selected').attr("data-name") );
// });

$("#txtCategory").on("change",function(){
var category_id=$("#txtCategory").find('option:selected').val();
$("#cat_list").empty();
$.ajax({
url: "get_cats.php",
data: { category_id:category_id },
datatype:"json",
type: "post",
success: function(data){
console.log(data);
$("#cat_list").append(data);
}
});
}).trigger('change');
});

</script>