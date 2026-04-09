<?php
/*ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);*/

//die('--------');
if (!defined('WEB_ROOT')) {
exit;
}
$id = $_GET['id'];
$sql		=	"SELECT * FROM spmedia_add WHERE id = $id  "; 
//echo  $sql;   
$result = dbQuery($dbConn, $sql); 

if($result){

	$row1 = dbFetchAssoc($result);   
	     
	$file =  $row1['file'];  
 	$users =  $row1['users'];       
	 $media_name =  $row1['media_name'];       
}

?>

<?php 

if(isset($_POST['btnButton'])){  




$media_id = $_POST['media_id'];
$media_name = $_POST['midea_name'];
$img_hidden = $_POST['img_hidden'];  
//$usertype = $_POST['usertype'];

  

$filesize = $_FILES["image"]["size"];

if($filesize != 0){
$filename = $_FILES["image"]["name"];
$tempname = $_FILES["image"]["tmp_name"];
$folder = "../../upload/" . $filename;    

if (move_uploaded_file($tempname, $folder)) {  
//echo "<script>alert('File uploaded successfully');</script>";


$sql = "UPDATE spmedia_add SET file ='$filename',media_name='$media_name' WHERE id = $media_id";
//echo $sql; die('-------');
$result1 = dbQuery($dbConn, $sql);     

}

} else{

$sql = "UPDATE spmedia_add SET file ='$img_hidden',media_name='$media_name' WHERE id = $media_id"; 
//echo $sql; die('-------');
$result1 = dbQuery($dbConn, $sql);        

}




?>
<script>
window.location.href = "index.php";
</script>

<?php 	

}




?>

<!-- Content Header (Page header) -->


<section class="content-header">
<h1>Update Media<small></small> 

</h1>
</section>

<!--modal---->


<div class="modal fade" id="form_fill" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel"></h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<form action="" method="POST" enctype="multipart/form-data">
<div class="row text-center" ><h2>ADD</h2></div>      

<div class="d-flex flex-row">

<input type="hidden"  name="id"  id="depart_id">

<textarea  class="form-control" id="department_" name="department_in" placeholder="" required /></textarea>


<input type="file" class="form-control" id="image_" name="image" placeholder=""  /><br> 


</div>

</div>
<div class="modal-footer">
<input type="submit" class="btn btn-success"  value="Submit" /> 
<button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>

</div>
</form>
</div>
</div>
</div>


<!-- Main content -->
<section class="content">
<div class="box box-success">
<div class="box-body">
<form action="" method="post" enctype="multipart/form-data"> 
<div class="row">
<input type="hidden" name="media_id" value="<?php echo $_GET['id']; ?>"> 
<!--<div class="col-md-4 col-sm-6" >
<div class="form-group">
<label>Users Type:</label>

<select class="form-control"  name="usertype" required >   
	<option>Select User Type</option>
<?php

$sql1		=	"SELECT * FROM spprofiles";
$result1 = dbQuery($dbConn, $sql1);

if ($result1){
while($row = dbFetchAssoc($result1)) { 
 
?>
<option value="<?php echo $row['idspProfiles'] ?>" <?php if($row['idspProfiles'] == $users){ echo 'selected';}  ?> ><?php echo $row['spProfileName'] ?></option>  

<?php 
}

}

 ?>
</select>
</div>
</div>-->
<div class="col-md-4 col-sm-6" >

<div class="form-group">   
<label>Media Name:</label>
<input type="text" name="midea_name" id="midea_name" class="form-control" value="<?php echo $media_name; ?>"  required>  

</div>
<div class="form-group">   
<label>File:</label>
<input type="file" name="image" id="image_file" class="form-control" >     
<input type="hidden" name="img_hidden" value="<?php echo $file; ?>">   
</div>
</div>

<div class="col-md-4 col-sm-6" >
<img height="200" id="preview_img" width="200" src="https://dev.thesharepage.com/upload/<?php echo  $file; ?>">   
 </div>       
</div>
<div class="box-footer"> 
<input type="submit" id="add" name="btnButton" value="Update" class="btn vd_btn vd_bg-green finish" /> &nbsp;

</div>
</form>
</div>



<!--- End Table ---------------->
</div>



</section><!-- /.content -->
<script type="text/javascript">

$(document).ready( function () {
var table = $('#example1').DataTable( {

"order": [[ 0, "desc" ]],
pageLength : 10,
lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
} );



} );



function fun_form(){
//alert(c);  

$("#form_fill").modal('show');  
/* $("#department_").val(b);

$("#depart_id").val(a);*/

}

</script>

<script>
	  image_file.onchange = evt => {
  const [file] = image_file.files
  if (file) {
    preview_img.src = URL.createObjectURL(file) 
  }
}
	  </script>