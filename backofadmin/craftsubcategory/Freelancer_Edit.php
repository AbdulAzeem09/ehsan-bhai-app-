<?php
if (!defined('WEB_ROOT')) {
exit;
}

$id=$_GET['id'];
$sql = "SELECT * FROM in_sub_category WHERE idinsubcategory ='$id'";
$result = dbQuery($dbConn, $sql);
$row    = dbFetchAssoc($result);
extract($row);





if(isset($_POST["EditButton"])){

$idsubCategory=$_POST["artcateidsp"];
$subCategoryTitle=$_POST["txtTitle"];
$sql33="UPDATE `in_sub_category` SET `idsubCategory`='$idsubCategory',`insubcatTitle`='$subCategoryTitle' WHERE idinsubcategory ='$id'";

$result33 = dbQuery($dbConn,$sql33);
redirect('index.php?view=Freelancer_SubCategory');
}
?>

<!-- Content Header (Page header) -->
<section class="content-header top_heading">
<h1>Freelancer SubCategory Edit</h1>
</section>
<!-- Main content -->
<section class="content" >
<!-- start any work here. -->
<form name="frmAddMainNav" id="frmAddMainNav" method="post" action=""  enctype="multipart/form-data" onsubmit="return validate(this)">
<input type="hidden" name="hidId" id="hidId"  value="<?php echo $ArtCat;?>"/>

<div class="box box-success">
<div class="box-body">
<div class="row" id="alertmsg" style="margin: 10px 0px 0px 5px;">
<?php 
if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
if($_SESSION['count'] <= 1){
$_SESSION['count'] +=1; ?>
<div style="min-height:10px;"></div>
<div class="alert alert-<?php echo $_SESSION['data'];?>">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<?php echo $_SESSION['errorMessage'];  ?>
</div> <?php
unset($_SESSION['errorMessage']);
}
} ?>
</div>
<div class="row">
<div class="col-md-6 col-sm-6" style="margin-bottom:20px;">
<label>Category:</label></br>
<select  class="form-control" required="required" name="artcateidsp">
<option value="0">Select</option>
<?php 
$idsubCategory = $row['idsubCategory'];
	$sql1 ="SELECT * FROM `subcategory` WHERE subCategoryStatus != '-7' AND `spCategories_idspCategory` = 5 ORDER BY subCategoryTitle ASC";
$result1  = dbQuery($dbConn, $sql1);
if ($result1) {
$i = 1;
while ($row1 = dbFetchAssoc($result1)) {
//extract($row1);
?>
<option <?php if($row1['idsubCategory']==$idsubCategory){ echo 'selected'; } ?> value="<?php echo $row1['idsubCategory'];?>"><?php echo $row1['subCategoryTitle']; ?></option>
<?php }
}
?>
</select>

</div>

<div class="col-md-6 col-sm-6" style="margin-bottom:20px;">
<label>Name</label></br>
<input type="text" name="txtTitle" id="txtTitle" value="<?php echo $row['insubcatTitle'];?>" class="form-control" required="required"/>
</div>


</div>
</div>
<div class="box-footer"> 
<input type="submit" name="EditButton" value="Update" class="btn vd_btn vd_bg-green finish" /> &nbsp;
<input type="button" name="EditButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php?view=Freelancer_SubCategory'" /> &nbsp;
</div>
</div>

</form>
</section><!-- /.content -->
