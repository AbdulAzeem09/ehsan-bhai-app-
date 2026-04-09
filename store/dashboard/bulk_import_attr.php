<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
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
/*
$p = new _productpic;

//print_r($_POST); die('----------');


$result = $p->readawskey(); 

$row = mysqli_fetch_array($result);
$key_name = $row['key_name'];
$secret_name = $row['secret_name'];	


$result1 = $p->readawskeyagain($ids=2);

$row1 = mysqli_fetch_array($result1);
$region_name = $row1['region_name']; 
$bucketName = $row1['bucketName'];	

//		print_r($row); die("----------------");

$BaseUrl1 = $_SERVER["DOCUMENT_ROOT"];


require_once($BaseUrl1.'/aws/aws-autoloader.php'); 

use  Aws\S3\S3Client;
$s3 = new S3Client([
'version' => 'latest',
'region' => $region_name,
'credentials' => [
'key'    => $key_name,
'secret' => $secret_name
]
]);  */


function recursive_dir($dir) {
foreach(scandir($dir) as $file) {
if ('.' === $file || '..' === $file) continue;
if (is_dir("$dir/$file")) recursive_dir("$dir/$file");
else unlink("$dir/$file");
}
rmdir($dir);
}

if($_FILES["zip_file"]["name"]) {
$filename = $_FILES["zip_file"]["name"];
$source = $_FILES["zip_file"]["tmp_name"];
$type = $_FILES["zip_file"]["type"];

$name = explode(".", $filename);
$accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
foreach($accepted_types as $mime_type) {
if($mime_type == $type) {
$okay = true;
break;
}
}

$continue = strtolower($name[1]) == 'zip' ? true : false;
if(!$continue) {
$myMsg = "Please upload a valid .zip file.";
}

/* PHP current path */
//$path = dirname(__FILE__).'/';
$path = "../../upload/store/";
$filenoext = basename ($filename, '.zip'); 
$filenoext = basename ($filenoext, '.ZIP');

$myDir = $path . $_SESSION['uid']; // target directory
$myFile = $path . $filename; // target zip file


if (is_dir($myDir)) recursive_dir ( $myDir);

mkdir($myDir, 0777);

/* here it is really happening */
move_uploaded_file($source, $myFile);

$zip = new ZipArchive;
if ($zip->open($myFile) === true) {
for($i = 0; $i < $zip->numFiles; $i++) {
$filename = $zip->getNameIndex($i);
$fileinfo = pathinfo($filename);
copy("zip://".$myFile."#".$filename, $myDir."/".$fileinfo['basename']);
}                  
$zip->close();                  
}

/*
if(move_uploaded_file($source, $myFile)) {
$zip = new ZipArchive();
$x = $zip->open($myFile); // open the zip file to extract
if ($x === true) {
$zip->extractTo($myDir); // place in the directory with same name
$zip->close();
unlink($myFile);
}
$myMsg = "Your .zip file uploaded and unziped.";
} else {	
$myMsg = "There was a problem with the upload.";
}
*/
}
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php');?>

<!-- ===== INPAGE SCRIPTS====== -->
<?php include('../../component/dashboard-link.php'); ?>

</head>

<body class="bg_gray">
<?php
$header_store = "header_store";

include_once("../../header.php");
?>
<section class="main_box">
<div class="container">
<div class="row">

<div id="sidebar" class="col-md-2 hidden-xs no-padding">
<div class="left_grid store_left_cat">
<?php
include('left-sellermenu.php'); 
?>
</div>
</div>

<style>
#spc{ padding: 1px 1px;

}
div:where(.swal2-container).swal2-center>.swal2-popup {
    height: 297px;
    font-size: 15px;
}

</style>


<div class="col-md-10">          


<ul class="nav nav-tabs">  


<li class="active"><a id="spc" href ="<?php echo $BaseUrl.'/store/dashboard/bulk_import_attr.php?action=category';?>">	 
<input type="submit" style="width: 161px;" class="btn btn-submit  addprofile db_btn db_primarybtn " name="submit" value="Category ">
</a></li>


<li> <a  id="spc" href ="<?php echo $BaseUrl.'/store/dashboard/bulk_import_attr.php?action=quantity';?>">
<input type="submit" style="width: 161px;" class="btn btn-submit  addprofile db_btn db_primarybtn " name="submit" value="Quantity">

</a></li>



<li><a  id="spc" href ="<?php echo $BaseUrl.'/store/dashboard/bulk_import_attr.php?action=product_type ';?>">
<input type="submit" style="width: 161px;" class="btn btn-submit  addprofile db_btn db_primarybtn " name="submit" value="Product Type ">

</a></li>



<li> <a  id="spc" href ="<?php echo $BaseUrl.'/store/dashboard/bulk_import_attr.php?action=status ';?>">
<input type="submit" style="width: 161px;" class="btn btn-submit  addprofile db_btn db_primarybtn " name="submit" value="Status ">

</a></li>


 
<li><a  id="spc" href ="<?php echo $BaseUrl.'/store/dashboard/bulk_import_attr.php?action=can_re';?>">
<input type="submit" style="width: 161px;" class="btn btn-submit  addprofile db_btn db_primarybtn " name="submit" value="Cancel or Refund">

</a></li>


 
<li> <a   id="spc"href ="<?php echo $BaseUrl.'/store/dashboard/bulk_import_attr.php?action=shipping_charge
';?>">
<input type="submit" style="width: 161px;" class="btn btn-submit  addprofile db_btn db_primarybtn " name="submit" value="Shipping Charge
">

</a></li>

 
<li> <a  id="spc" href ="<?php echo $BaseUrl.'/store/dashboard/bulk_import_attr.php?action=contact_by
';?>">
<input type="submit" style="width: 161px;" class="btn btn-submit  addprofile db_btn db_primarybtn " name="submit" value="Contact By
">
</a></li>


<li> <a  id="spc" href ="<?php echo $BaseUrl.'/store/dashboard/bulk_import_attr.php?action=industry_type
';?>">
<input type="submit" style="width: 161px;" class="btn btn-submit  addprofile db_btn db_primarybtn " name="submit" value="Industry Type 
">
</a></li>


<li> <a  id="spc" href ="<?php echo $BaseUrl.'/store/dashboard/bulk_import_attr.php?action=variants_1
';?>">
<input type="submit" style="width: 161px;" class="btn btn-submit  addprofile db_btn db_primarybtn " name="submit" value="Color Option 
">
</a></li>


  
<li> <a  id="spc" href ="<?php echo $BaseUrl.'/store/dashboard/bulk_import_attr.php?action=variants_2
';?>">
<input type="submit" style="width: 161px;margin-top:-55px!important" class="btn btn-submit  addprofile db_btn db_primarybtn " name="submit" value="Size Option 
">;
</a></li>



</ul>











<?php   if($_GET['action'] == "category"){ ?>
<div class="row">
<div class="col-md-12">
<div class="box box-success">
<div class="box-header">
<div class="row">
<div class="col-md-12" style ="text-align:center">
<h4><b>Category</b><h4>
</div>
</div>
</div><!-- /.box-header -->
<div class="box-body">



<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<div class="table-responsive">
	<?php 
	$m = new _subcategory;

$result = $m->read($catid);

if ($result) {
	$pagination = 'example12';
	}
	else{
		$pagination = '';
	}?>

<table class="table"  class="table table-striped table-bordered dashServ display" id="<?php echo $pagination; ?>">
<thead>
<tr>
<th  class="text-center"></th>
<th  class="text-center">ID</th>
<th  class="text-center">Option</th>
<th class="text-center">value</th>
<th class="text-center">Delete</th>
</tr>
</thead>
<tbody>


<?php   
$m = new _subcategory;
$catid = 1;
$result = $m->read($catid);



if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) { 
///print_r($row);
//die('==');
?>

<tr>
<td></td>
<td><?php echo $i++;?></td>
 <td  class="text-center"><?php echo ucwords(strtolower($row["subCategoryTitle"])); ?> </td>

<td class="text-center"><?php echo ucwords(strtolower($row['idsubCategory'])); ?></td>
<td class="text-center" style="padding-left: 80px;"><a class="fa fa-trash" onclick="deleteb('<?php echo $BaseUrl.'/store/dashboard/deletebulk.php?postid='.$row['idsubCategory']; ?>')"> </a>

<a class="fa fa-copy" onclick="copy('<?php echo ucwords(strtolower($row['idsubCategory'])); ?>')"> </a>

</td>

</tr> 


<?php
  }
}
?>
</tbody>
</table>
</div>                                                
</div>
</div>


</div>
</div>
<?php } ?>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script> 
<script>
function deleteb(a){
//alert(a);
Swal.fire({
title: 'Are you sure you want to delete ?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
confirmButtonText: 'Yes',
cancelButtonColor: '#FF0000',
cancelButtonText: 'No',
}).then((result) => {
if (result.isConfirmed) {
window.location.href = a;
}
});

}
</script>

<?php   if($_GET['action'] == "variants_1"){ ?>
<div class="row">
<div class="col-md-12">
<div class="box box-success">
<div class="box-header">
<div class="row">
<div class="col-md-12" style ="text-align:center">
<h4><b>Color Option</b><h4>
</div>
</div>
</div><!-- /.box-header -->
<div class="box-body">



<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<div class="table-responsive">
<table class="table table-striped "  class="table table-striped table-bordered dashServ display" id="example" >
<thead>
<tr>
 <th  class="text-center">Option</th>
 <th  class="text-center">Option</th>

<th class="text-center">value</th>
<th class="text-center">Delete</th>

</tr>
</thead>
<tbody>


<?php   
$ponv = new _spproductoptionsvalues;
$resultopnvaluedef = $ponv->readbyoptionid(0,0,1);
if ($resultopnvaluedef) {
$totalcolor = array();
while ($resultvaluerowdef = mysqli_fetch_assoc($resultopnvaluedef)) {

$totalcolor[$resultvaluerowdef['idsopv']] = $resultvaluerowdef['opton_values'];
}
}

$resultopnvalue = $ponv->readbyoptionid($_SESSION['uid'],$_SESSION['pid'],1);
if ($resultopnvalue) {
while ($resultvaluerow = mysqli_fetch_assoc($resultopnvalue)) {

$totalcolor[$resultvaluerow['idsopv']] = $resultvaluerow['opton_values'];
}
}
asort($totalcolor);	

$resultdata = $ponv->readattribbyid($_GET["postid"],'Store',$_SESSION['uid'],$_SESSION['pid']);
$startid = 1000;
if($resultdata != false){
while ($attribdata = mysqli_fetch_assoc($resultdata)) {
$startid++;
}
}


if(sizeof($totalcolor)>0)
{
// print_r($totalcolor); 
foreach ($totalcolor as $key1 => $value1) {



//print_r($row);
?>

<tr>
<td></td>
 <td  class="text-center"><?php   echo $value1;?></td>

<td class="text-center"><?php echo $key1;?></td>
<td><a class="fa fa-trash" onclick="delet('<?php echo $BaseUrl.'/store/dashboard/deletecolor.php?postid='.$key1 ?>')"> </a>

<a class="fa fa-copy" onclick="copy('<?php echo $key1  ?>')"> </a>

</td>

</tr> 


<?php
  }
}
?>




<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script> 
<script>
function delet(a){
//alert(a);
Swal.fire({
title: 'Are you sure you want to delete ?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
confirmButtonText: 'Yes',
cancelButtonColor: '#FF0000',
cancelButtonText: 'No',


}).then((result) => {
if (result.isConfirmed) {
window.location.href = a;
}
});

}
</script>

</tbody>
</table>
</div>                                                
</div>
</div>


</div>
</div>
<?php } ?>


<?php   if($_GET['action'] == "variants_2"){ ?>
<div class="row">
<div class="col-md-12">
<div class="box box-success">
<div class="box-header">
<div class="row">
<div class="col-md-12" style ="text-align:center">
<h4><b>Size Option</b><h4>
</div>
</div>
</div><!-- /.box-header -->
<div class="box-body">



<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<div class="table-responsive">
<table class="table table-striped "  class="table table-striped table-bordered dashServ display" id="example" >
<thead>
<tr>
 <th  class="text-center">Option</th>
 <th  class="text-center">Option</th>

<th class="text-center">value</th>
<th class="text-center">Delete</th>
</tr>
</thead>
<tbody>


<?php   
$ponv = new _spproductoptionsvalues;
$resultopnvaluedef1 = $ponv->readbyoptionid(0,0,2);
if ($resultopnvaluedef1) {
$totalsize = array();
while ($resultvaluerowdef1 = mysqli_fetch_assoc($resultopnvaluedef1)) {
$totalsize[$resultvaluerowdef1['idsopv']] = $resultvaluerowdef1['opton_values'];
}
}

$resultopnvalue2 = $ponv->readbyoptionid($_SESSION['uid'],$_SESSION['pid'],2);
if ($resultopnvalue2) {
while ($resultvaluerow2 = mysqli_fetch_assoc($resultopnvalue2)) {
$totalsize[$resultvaluerow2['idsopv']]=$resultvaluerow2['opton_values'];
}
}
asort($totalsize);
$resultdata = $ponv->readattribbyid($_GET["postid"],'Store',$_SESSION['uid'],$_SESSION['pid']);
$startid = 1000;
if($resultdata != false){
while ($attribdata = mysqli_fetch_assoc($resultdata)) {
$startid++;
}
}


if(sizeof($totalsize)>0)
{

foreach ($totalsize as $key => $value) {



//print_r($row);
?>

<tr>
<td></td>
 <td  class="text-center"><?php   echo $value;?></td>

<td class="text-center"><?php echo $key;?></td>
<td><a class="fa fa-trash" onclick="deleteop('<?php echo $BaseUrl.'/store/dashboard/deleteoption.php?postid='.$key ?>')"> </a>

<a class="fa fa-copy" onclick="copy('<?php echo $key ?>')"> </a>

</td>

</tr> 


<?php
  }
}
?>




<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script> 
<script>
function deleteop(a){
//alert(a);
Swal.fire({
title: 'Are you sure you want to delete ?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
confirmButtonText: 'Yes',
cancelButtonColor: '#FF0000',
cancelButtonText: 'No',


}).then((result) => {
if (result.isConfirmed) {
window.location.href = a;
}
});

}
</script>

</tbody>
</table>
</div>                                                
</div>
</div>


</div>
</div>
<?php } ?>







<?php   if($_GET['action'] == "quantity"){ ?>
<div class="row">
<div class="col-md-12">
<div class="box box-success">
<div class="box-header">
<div class="row">
<div class="col-md-12" style ="text-align:center">
<h4><b>Quantity</b><h4>
</div>
</div> 
</div><!-- /.box-header -->
<div class="box-body">



<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<div class="table-responsive">
<table class="table table-striped "  class="table table-striped table-bordered dashServ display" id="example" >
<thead>

<tr>

 <th  class="text-center">Option</th>
 <th  class="text-center">Option</th>

<th class="text-center">value</th>
<th class="text-center">Action</th>

</tr>

</thead>
<tbody>

  
<tr>
<td></td>
 <td  class="text-center">Hard Quantity </td>

<td class="text-center">Hard</td>

<td>
<a class="fa fa-copy" onclick="copy('Hard')"> </a> 
</td>

</tr>
 <tr>
<td></td>
 <td  class="text-center">Soft Quantity </td>


<td class="text-center">Soft</td>

 <td>
<a class="fa fa-copy" onclick="copy('Soft')"> </a> 
</td>
</tr>



</tbody>
</table>
</div>                                                
</div>
</div>


</div>
</div>
<?php } ?>









<?php   if($_GET['action'] == "product_type"){ ?>
<div class="row">
<div class="col-md-12">
<div class="box box-success">
<div class="box-header">
<div class="row">
<div class="col-md-12" style ="text-align:center">
<h4><b>Product Type</b><h4>
</div>
</div>
</div><!-- /.box-header -->
<div class="box-body">



<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<div class="table-responsive">
<table class="table table-striped "  class="table table-striped table-bordered dashServ display" id="example" >
<thead>

<tr>
 <th  class="text-center">Option</th>
 <th  class="text-center">Option</th>

<th class="text-center">value</th>
<th class="text-center">Action</th>
</tr>

</thead>
<tbody>

  
<tr>
<td></td>
 <td  class="text-center">Normal </td>

<td class="text-center">0</td>
<td>
<a class="fa fa-copy" onclick="copy('0')"> </a> 
</td>

</tr>
 <tr>
<td></td>
 <td  class="text-center">Variants</td>

<td class="text-center">1</td>
<td>
<a class="fa fa-copy" onclick="copy('1')"> </a> 
</td>
</tr>

</tbody>
</table>
</div>                                                
</div>
</div>


</div>
</div>
<?php } ?>









<?php   if($_GET['action'] == "status"){ ?>
<div class="row">
<div class="col-md-12">
<div class="box box-success">
<div class="box-header">
<div class="row">
<div class="col-md-12" style ="text-align:center">
<h4><b>Status</b><h4>
</div>
</div>
</div><!-- /.box-header -->
<div class="box-body">



<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<div class="table-responsive">
<table class="table table-striped "  class="table table-striped table-bordered dashServ display" id="example" >
<thead>

<tr>
<th  class="text-center">Option</th>
 <th  class="text-center">Option</th>

<th class="text-center">value</th>
<th class="text-center">Delete</th>
</tr>

</thead>
<tbody>
<?php
$it = new _spAllStoreForm;
$result3 = $it->readProductStatus();
if ($result3) {
while($row3 = mysqli_fetch_assoc($result3)){
?>
  
<tr>
<td></td>
 <td  class="text-center"><?php echo $row3['productStatusTitle']; ?> </td>

<td class="text-center"><?php echo $row3['productStatusTitle']; ?></td>

<td><a class="fa fa-trash" onclick="deletequa('<?php echo $BaseUrl.'/store/dashboard/deletequantity.php?postid='.$row3['idspProductStatus']; ?>')"> </a>

<a class="fa fa-copy" onclick="copy('<?php echo  $row3['productStatusTitle']; ?>')"> </a>


</td>

</tr>
 
	<?php
}
}
?>



<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script> 
<script>
function deletequa(a){
//alert(a);
Swal.fire({
title: 'Are you sure you want to delete ?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
confirmButtonText: 'Yes',
cancelButtonColor: '#FF0000',
cancelButtonText: 'No',


}).then((result) => {
if (result.isConfirmed) {
window.location.href = a;
}
});

}
</script>

</tbody>
</table>
</div>                                                
</div>
</div>


</div>
</div>
<?php } ?>

<?php   if($_GET['action'] == "industry_type"){ ?>
<div class="row">
<div class="col-md-12">
<div class="box box-success">
<div class="box-header">
<div class="row">
<div class="col-md-12" style ="text-align:center">
<h4><b>Industry Type</b><h4>
</div>
</div>
</div><!-- /.box-header -->
<div class="box-body">



<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<div class="table-responsive">
<table class="table table-striped "  class="table table-striped table-bordered dashServ display" id="example" >
<thead>

<tr>
<th  class="text-center">Option</th>
 <th  class="text-center">Option</th>

<th class="text-center">value</th>
<th class="text-center">Delete</th>
</tr>

</thead>
<tbody>
<?php
$it = new _spAllStoreForm;
$result2 = $it->readIndustryType();
if($result2) {
while ($row2 = mysqli_fetch_assoc($result2)) {
?>
  
<tr>
<td></td>
 <td  class="text-center"><?php echo ucwords(strtolower($row2['industryTitle'])); ?> </td>

<td class="text-center"><?php echo ucwords(strtolower($row2['industryTitle'])); ?></td>
<td><a class="fa fa-trash"  onclick="deleteind('<?php echo $BaseUrl.'/store/dashboard/deleteindustry.php?postid='.$row2['idspIndustry']; ?>')"> </a>

<a class="fa fa-copy"  onclick="copy('<?php echo  ucwords(strtolower($row2['industryTitle'])); ?>')"> </a>

</td>

</tr>
 
	<?php
}
}
?>


<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script> 
<script>
function deleteind(a){
//alert(a);
Swal.fire({
title: 'Are you sure you want to delete ?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
confirmButtonText: 'Yes',
cancelButtonColor: '#FF0000',
cancelButtonText: 'No',
}).then((result) => {
if (result.isConfirmed) {
window.location.href = a;
}
});

}
</script>

</tbody>
</table>
</div>                                                
</div>
</div>


</div>
</div>
<?php } ?>










<?php   if($_GET['action'] == "can_re"){ ?>
<div class="row">
<div class="col-md-12">
<div class="box box-success">
<div class="box-header">
<div class="row">
<div class="col-md-12" style ="text-align:center">
<h4><b>Cancel or Refund</b><h4> 
</div>
</div>
</div><!-- /.box-header -->
<div class="box-body">



<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<div class="table-responsive">
<table class="table table-striped "  class="table table-striped table-bordered dashServ display" id="example" >
<thead>

<tr>
<th  class="text-center">Option</th>
 <th  class="text-center">Option</th>

<th class="text-center">value</th>
</tr>

</thead>
<tbody>

  
<tr>
<td></td>
 <td  class="text-center">Yes </td>

<td class="text-center">1</td>

</tr>
 <tr>
<td></td>
 <td  class="text-center">No</td>

<td class="text-center">0</td>
</tr>

</tbody>
</table>
</div>                                                
</div>
</div>


</div>
</div>
<?php } ?>








<?php   if($_GET['action'] == "shipping_charge"){ ?>
<div class="row">
<div class="col-md-12">
<div class="box box-success">
<div class="box-header">
<div class="row">
<div class="col-md-12" style ="text-align:center">
<h4><b>Shipping Charge</b><h4>
</div>
</div>
</div><!-- /.box-header -->
<div class="box-body">



<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<div class="table-responsive">
<table class="table table-striped "  class="table table-striped table-bordered dashServ display" id="example" >
<thead>

<tr>
 <th  class="text-center">Option</th>
 <th  class="text-center">Option</th>

<th class="text-center">value</th>
<th class="text-center">Action</th>
</tr>

</thead>
<tbody>

  
<tr>
<td></td>
 <td  class="text-center">Free </td>

<td class="text-center">1</td>
<td> <a class="fa fa-copy" onclick="copy('1')"> </a> </td>

</tr>
 <tr>
<td></td>
 <td  class="text-center">Fixed Amount</td>

<td class="text-center">2</td>
</tr>
<tr>
<td></td>
 <td  class="text-center">Per Shipping Company</td>

<td class="text-center">3</td>
<td> <a class="fa fa-copy" onclick="copy('3')"> </a> </td>
</tr>

</tbody>
</table>
</div>                                                
</div>
</div>


</div>
</div>
<?php } ?>










<?php   if($_GET['action'] == "contact_by"){ ?>
<div class="row">
<div class="col-md-12">
<div class="box box-success">
<div class="box-header">
<div class="row">
<div class="col-md-12" style ="text-align:center">
<h4><b>Contact By</b><h4>
</div>
</div>
</div><!-- /.box-header -->
<div class="box-body">



<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<div class="table-responsive">
<table class="table table-striped "  class="table table-striped table-bordered dashServ display" id="example" >
<thead>

<tr>
 <th  class="text-center">Option</th>
 <th  class="text-center">Option</th>

<th class="text-center">value</th>
<th class="text-center">Action</th>
</tr>

</thead>
<tbody>

  
<tr>
<td></td>
 <td  class="text-center">Email </td>

<td class="text-center">1</td>
<td> <a class="fa fa-copy" onclick="copy('1')"> </a> </td>

</tr>
 <tr>
<td></td>
 <td  class="text-center">Phone</td>

<td class="text-center">0</td>
<td> <a class="fa fa-copy" onclick="copy('1')"> </a> </td>
</tr>

</tbody>
</table>
</div>                                                
</div>
</div>


</div>
</div>
<?php } ?>


</div>
</div>
</div>

</section>



<?php 
include('../../component/f_footer.php');
include('../../component/f_btm_script.php'); 
?>




</body>
</html>
<?php
} ?>
<!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script> -->
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>




<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script> 
<script>

function copy(myInput) {
 // alert('=======================');
  var copyText = myInput;
  navigator.clipboard.writeText(copyText);  
  Swal.fire({
  title: 'Copied Successfully',
  icon: 'success',
  showConfirmButton: true, // This will hide the "OK" button

});
}

</script>

<script type="text/javascript">
$(document).ready(function() {

var table = $('#example').DataTable({ 
select: false,
"columnDefs": [{
className: "Name", 
"targets":[0],
"visible": false,				"searchable":false
}]
});//End of create main table


$('#example tbody').on( 'click', 'tr', function () {

// alert(table.row( this ).data()[0]);

} );
});
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#example12').DataTable({
                paging: true, // Enable pagination
                select: false,
                columnDefs: [{
                    className: "Name",
                    targets: [0],
                    visible: false,
                    searchable: false
                }]
            });

            $('#example12 tbody').on('click', 'tr', function() {
                // Handle row click event here
            });
        });
    </script>

