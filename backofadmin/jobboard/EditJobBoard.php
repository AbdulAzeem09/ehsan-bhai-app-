<?php
if (!defined('WEB_ROOT')) {
exit;
}

$id=$_GET['id'];
$sql = "SELECT * FROM subcategory WHERE idsubCategory ='$id'";
$result = dbQuery($dbConn, $sql);
$row    = dbFetchAssoc($result);
extract($row);





if(isset($_POST["EditButton"])){


$subCategoryTitle=$_POST["txtTitle"];
$sql33="UPDATE `subcategory` SET `subCategoryTitle`='$subCategoryTitle' WHERE idsubCategory= '$id'";

$result33 = dbQuery($dbConn,$sql33);
redirect('index.php?view=JobCategory');
}
?>

<!-- Content Header (Page header) -->
<section class="content-header top_heading">
<h1>Job-Board Category <small>[Edit]</small></h1>
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
<input type="text" name="txtTitle" id="txtTitle" value="<?php echo $row['subCategoryTitle'];?>" class="form-control" required="required"/>
</div>
</div>

<div class="col-md-6 col-sm-6" style="margin-top:20px;">

<div class="box-footer"> 
<input type="submit" name="EditButton" value="Update" class="btn vd_btn vd_bg-green finish" /> &nbsp;
<input type="button" name="EditButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php?view=JobCategory'" /> &nbsp;
</div>


</div>
</div>

</div>

</form>
</section><!-- /.content -->
