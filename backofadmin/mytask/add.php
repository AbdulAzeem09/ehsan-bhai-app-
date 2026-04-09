<?php
if (!defined('WEB_ROOT')) {
exit;
}
?>
<!-- Content Header (Page header) -->
<section class="content-header top_heading">
<h1>Task<small>[Add]</small></h1>
</section>
<!-- Main content -->
<section class="content" >
<!-- start any work here. -->
<form name="frmAddMainNav" id="Addto" method="post" action="insartTask.php?action=add">

<div class="box box-success">
<div class="box-body" >
<div class="row">
<div class="col-md-7">
<label>Title<span class="red">*</span></label>
<input type="text" name="txtTitle" id="txtTitle" class="form-control"><br>
<span id="cat_error"  class="red"></span>
</div>

<div class="col-md-7">
<label>Description<span class="red">*</span></label><br>
<textarea name="description" id="description" class="form-control" rows="10" cols="50"></textarea><br>
<span id="subcat_error"  class="red"></span>
</div>

<div class="col-md-7">
<div class="form-group">
<label>User Level</label></br>
<select name="txtUserLevel" id="txtUserLevel" class="form-control">
<option value="0">--Select--</option>
<?php
$sql ="SELECT * FROM tbl_user WHERE user_status != -7";
$result = dbQuery($dbConn,$sql);
while($row = dbFetchAssoc($result)) {
?>
<option value="<?php echo  $row['user_id']; ?>"><?php echo  $row['user_name']; ?></option>

<?php  }
?>
</select>
</div>
</div>
<div class="col-md-7">
<div class="box-footer"> 
<input type="submit" name="btnButton" id="add" value="Save" class="btn vd_btn vd_bg-green" /> &nbsp;
<input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> &nbsp;
</div>
</div>
</div>

</form>
</section>