<?php



//die('====================');
if (!defined('WEB_ROOT')) {
exit;
}





?>


<style>
.content {
min-height: 150px!important;
}
.select2 {
width: 400px!important;
}
.content-header {
    padding: 19px 50px 12px 24px!important;
}
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Content Header (Page header) -->
<section class="content-header">
<a class="btn btn-primary pull-right" href="/backofadmin/notification_temp/index.php?view=add" style="margin: -7px;">Add Template</a>
<h1> Notification Template<small>[List]</small></h1>

</section>



<div class="box box-success">
<div class="box-body">



<div class="table-responsive tbl-respon">
<table id="example1" class="table table-bordered table-striped tbl-respon2">

<thead>
<tr>

<th>id</th>
<th >Template Name</th>
<th >Template Body</th>
<th >Subject</th>
<th >Action</th>

</tr>
</thead>
<tbody>
<?php


$sql =  "SELECT * FROM notification_temp";
$result2  = dbQuery($dbConn, $sql);
//$row2 = dbFetchAssoc($result2);
//print_r($aa);die('===');

while ($row = dbFetchAssoc($result2)) {
$id=$row['id'];

?>
<tr>
<td><?php echo $row['id']; ?></td>

<td><?php echo $row['temp_name']; ?></td>
<td><?php echo $row['notification_description']; ?></td>
<td><?php echo $row['subject']; ?></td>
<td>
<a class="btn btn-primary" href="/backofadmin/notification_temp/index.php?view=update&id=<?php echo $id;?>">Edit</a>
<!-- <a class="btn btn-primary" href="/backofadmin/notification_temp/index.php?view=delete&id=<?php echo $id;?>">delete</a> -->

</td>



</tr>
<?php   } ?>

</tbody>



</table>
</div>
</div>
<!--- End Table ---------------->
</div>


</section>




<script type="text/javascript">

$(document).ready( function () {
var table = $('#example1').DataTable( {

"order": [[ 0, "desc" ]],
pageLength : 10,
lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
} );



} );
</script>

