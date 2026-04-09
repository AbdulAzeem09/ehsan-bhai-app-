<?php
if (!defined('WEB_ROOT')) {
exit;   
}

if(isset($_POST['submit_module'])) {
$friend_id=$_POST['close_friend'];
$friend_Role=$_POST['Role'];
$sql = "UPDATE spuser SET `role`='$friend_Role' WHERE idspUser='$friend_id'";
//      $sql= "INSERT INTO spuser (friend_id,friend_value) VALUES ($friend_id,$friend_value)";
$result4  = dbQuery($dbConn,$sql);


}




?>
<style>
.content {
min-height: 150px!important;
}
.select2 {
width: 400px!important;
}

</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>Close Friend<small>[List]</small></h1>
</section>
<!-- Main content -->
<section class="content">
<div class="box box-success">
<form action ="" method="post">
<div class="row">
<div class="col-md-5">
<div class="box-body"> 
<label for="fname">Select Friend:</label><br>
<select name="close_friend" id="warehouse" class="form-control">
<option value="0">Select Friend</option>
<?php 
$sql =  "SELECT * FROM spuser ORDER BY `idspUser` DESC";
//echo $sql;die('=====');
$result  = dbQuery($dbConn, $sql);
while ($row = dbFetchAssoc($result)) {
//print_r($row );

?>
<option value="<?php echo $row['idspUser'];?>" ><?php echo $row['spUserName'];?>(<?php echo $row['spUserEmail']; ?>)</option>
<?php }

?>
</select> 
</div>
</div>
<div class="col-md-5">
<div class="box-body">
<label for="Role">Select Friend:</label>
<select name="Role" id="Role" class="form-control" required>
<option value="">Select Role</option>
<option value="super vip">Super Vip</option>
<option value="vip">Vip</option>
</select>
<!--        <label for="friend_value">Commission:</label></br>-->
<!--            <input type="number" class="form-control" id="friend_value" name="friend_value" min="0" max="100" value="" require>-->
</div>   
</div> 

</div><br>
<button class="pull-right btn btn-warning" type="submit" name="submit_module" style="margin-top: 15px;">Add</button> 
</form>
<!--- End Table ---------------->
</div>


</section><!-- /.content -->

<section class="content">
<div class="box box-success">
<div class="box-body">



<div class="table-responsive tbl-respon">
<table id="example1" class="table table-bordered table-striped tbl-respon2">

<thead>
<tr>

<th>id</th>
<th >User Name</th>
<th >Role</th>
<th >Action</th>

</tr>
</thead>
<tbody>
<?php
if ($result) {
$i = 1;
$sql =  "SELECT * FROM spuser";
$result2  = dbQuery($dbConn, $sql);
//$row2 = dbFetchAssoc($result2);
//print_r($aa);die('===');
$i=1;
while ($user_name = dbFetchAssoc($result2)) {
$ids=$user_name['idspUser'];
//									$rr =  "SELECT * FROM spuser WHERE ORDER BY `idspUser` asc";
//                                     $get_row  = dbQuery($dbConn, $rr);
//									 $user_name = dbFetchAssoc($get_row)

?>
<tr>
<td><?php echo $i; ?></td>
<td><?php echo $user_name['spUserName']; ?></td>
<td><?php echo $user_name['role']; ?></td>
<td>


<a  class="btn btn-primary" href="index.php?view=update&id=<?php echo $ids; ?>">Update</a>




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


</section>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$("#warehouse").select2({
selectOnClose: true

});</script>

<script type="text/javascript">

$(document).ready( function () {
var table = $('#example1').DataTable( {

"order": [[ 0, "desc" ]],
pageLength : 10,
lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
} );



} );


