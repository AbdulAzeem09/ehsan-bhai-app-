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


<?php
/*				
// for wholesaler 			
if(isset($_POST['submit'])){

if(isset($_FILES['spPostingPic'])){



$filename = $_FILES["spPostingPic"]["name"];
$tempname = $_FILES["spPostingPic"]["tmp_name"]; 
$folder = "../bulkimport/".$filename;


if (move_uploaded_file($tempname, $folder)) {
$msg = "Image uploaded successfully";



}



}




} */

?>

<style>
.fa {

font-size: 17px!important;
}

div:where(.swal2-container).swal2-center>.swal2-popup {
    height: 297px;
    font-size: 15px;
}

</style>



<div class="col-md-10">          

<div class="row">

<div class="col-md-12">

<form enctype="multipart/form-data" action=" <?php echo $BaseUrl.'/post-ad/bulkimage.php'; ?>" method="post" >
<div class="col-md-3"><br>
<div class="form-group">
<label for="featurepic">Upload Images <span class="lbl_15"></span></label><br>
<input type="file" class="" name="spPostingPic[]"  style="display: block;" id="" accept="image/*" required multiple="multiple">
<p class="help-block"><small>Browse files from your device</small></p>


</div>
</div>  
<div class="col-md-3"><br><br>	
<input type="submit" class="btn btn-submit  addprofile db_btn db_primarybtn " name="submit" value="Submit">
</div>  


</form>
</div>








</div>






<div class="row">
<div class="col-md-12">
<div class="box box-success">
<div class="box-header">

</div><!-- /.box-header -->
<div class="box-body">



<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<div class="table-responsive">
<table class="table table-striped "  class="table table-striped table-bordered dashServ display" id="example" >
<thead style="background-color: #303431;">
<tr>
<th  class="text-center">Image</th>
<th  class="text-center">Image</th>
<th  class="text-center">Url</th>



<th class="text-center">Action</th>
</tr>
</thead>
<tbody>
<?php
$pf = new _productpic;
// die("------------");
$result = $pf->readbulk($_SESSION['pid'],$_SESSION['uid']);


//echo $p->ta->sql;
if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {

$image = $row['file_name'];
//echo "<pre>";
//print_r($row); die("--------------------------");
?><tr>
<td></td>

<td class="text-center ">
<!-- <?php echo "<img src='$BaseUrl.'/store/bulkimport/".$row['file_name']."' alt='image' width='40' height='40' />";?>-->
<?php echo "<img src='$image' alt='image' width='40' height='40' />";?>
</td>
<td class="text-center "><span class="smalldot"><?php echo ($row['file_name']); ?></span></td>

<!-- <td class="text-center">
<?php echo "<img src='/dashboard/portfolio/image/".$row['spImg']."' alt='image' width='40' height='40' />";?>

</td>-->
<td class="text-center">
<!--<a  class="update-portfolio" class="" data-id="<?php echo $row['id'];?>"  data-title="<?php echo $row['spTitle'];?>" 
data-weblink="<?php echo $row['spWeblink'];?>" data-des="<?php echo $row['desPort'];?>"   data-toggle="modal" data-target="#exampleModal">
<i class="fa fa-edit "></i>
</a>-->
<!--<a  class="update-portfolio" href="<?php echo $BaseUrl.'/dashboard/portfolio/editPortfolio.php?id='.$row['id']; ?>" class="" data-id="<?php echo $row['id'];?>"  data-title="<?php echo $row['spTitle'];?>" 
data-weblink="<?php echo $row['spWeblink'];?>" data-des="<?php echo $row['desPort'];?>"   >
<i class="fa fa-edit "></i>
</a>-->				
<!--<a href="<?php echo $BaseUrl.'//?active=1&postid='.$row['spPid']; ?>" class="" data-postid="<?php echo $row['spPid'];?>"><i class="fa fa-edit"></i></a> -->


<a href="javascript:void(0);" class="disable-btn" data-work="delete" data-Id="<?php echo $row['id'];?>"><i style="color: red;" title="Delete" class="fa fa-trash disable-btn" data-disableId=""></i></a></td>

</td>

</tr>
<?php
// $i++
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
</div>
</div>
</div>

</section>



<?php 
include('../../component/f_footer.php');
include('../../component/f_btm_script.php'); 
?>

<!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script> -->
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

<script type="text/javascript">
$(document).ready(function() {

var table = $('#example').DataTable({ 
select: false,
"columnDefs": [{
className: "Name", 
"targets":[0],
"visible": false,
"searchable":false
}]
});//End of create main table


$('#example tbody').on( 'click', 'tr', function () {

// alert(table.row( this ).data()[0]);

} );
});
</script>

</body>
</html>
<?php
} ?>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>

<script type="text/javascript">
$(document).ready(function(){
$(document).on("click",".disable-btn",function() {
var dataId = $(this).attr("data-id");

var work = $(this).attr("data-work");
//alert(work);
if(work=='deactive'){
swal({
title: "Do You Want Deactive this Listing?",
/*text: "You Want to Logout!",*/
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes, Deactive!",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "Cancel",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
window.location.href = '/store/dashboard/delete_bulkimage.php?id=' +dataId+'&work='+work;
} 
});

}	
if(work=='delete'){
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
window.location.href = '/store/dashboard/delete_bulkimage.php?id=' +dataId+'&work='+work;
} 
});
}	

// alert(dataId);
});
});

// function deactiveProp(propId){ 
//     swal({
//           title: "Do You Want Delete this User?",
//           /*text: "You Want to Logout!",*/
//           type: "warning",
//           confirmButtonClass: "sweet_ok",
//           confirmButtonText: "Yes, Delete!",
//           cancelButtonClass: "sweet_cancel",
//           cancelButtonText: "Cancel",
//           showCancelButton: true,
//         },
//     function(isConfirm) {
//       if (isConfirm) {
//        window.location.href = <?php //echo $BaseUrl.'/real-estate/dashboard/deactivate_post.php?postid='?> + propId;
//       } 
//     });
// }
</script>
