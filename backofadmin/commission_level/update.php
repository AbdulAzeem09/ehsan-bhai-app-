<?php
// error_reporting(E_ALL);
// 	ini_set('display_errors', '1');
if (!defined('WEB_ROOT')) {
exit;   
}
$id=$_GET['id'];
if(isset($_POST['update_friend'])) {
$friend_Role=$_POST['Role'];
$sql = "UPDATE spuser SET `role`='$friend_Role' WHERE idspUser='$id'";
$result4  = dbQuery($dbConn,$sql);
redirect("index.php?view=close_f");
}
$bb="SELECT * FROM `spuser` where idspUser=$id";
$data  = dbQuery($dbConn,$bb);
$row1 = dbFetchAssoc($data);
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
<label for="fname">Friend:</label><br>
<input type="text" class="form-control" value="<?php echo $row1['spUserName'] . ' (' . $row1['spUserEmail'] . ')'; ?>" readonly>
</div>
</div>
<div class="col-md-5">
<div class="box-body">
<label for="Role">Select Role:</label>
<select name="Role" id="Role" class="form-control" required>
<option hidden disabled selected value="">Select Role</option>
<option <?php echo ($row1['role']=='super vip')?'selected':'' ?> value="super vip">Super Vip</option>
<option <?php echo ($row1['role']=='vip')?'selected':'' ?> value="vip">Vip</option>
</select>
</div>   
</div> 
<div class="col-md-2">
<button class="pull-right btn btn-warning" type="submit" name="update_friend" style="margin-top: 40px;margin-right: 70px;">Update</button> 
</div>
</div>
<br>
</form>
<!--- End Table ---------------->
</div>
</section><!-- /.content -->
