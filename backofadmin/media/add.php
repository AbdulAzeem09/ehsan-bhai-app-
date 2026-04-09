<?php
/*ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);*/

//die('--------');
if (!defined('WEB_ROOT')) {
exit;
}

$sql		=	"SELECT * FROM spprofiles";
$result = dbQuery($dbConn, $sql);


?>

<?php 

if(isset($_POST['btnButton'])){   

//$usertype = $_POST['usertype'];
$midea_name = $_POST['midea_name'];


$filename = $_FILES["image"]["name"];
$tempname = $_FILES["image"]["tmp_name"];
$folder = "../../upload/" . $filename;    

if (move_uploaded_file($tempname, $folder)) {  
//echo "<script>alert('File uploaded successfully');</script>";

$sql		=	"INSERT INTO spmedia_add (file,media_name) VALUES ( '$filename','$midea_name');";
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
<h1>Add Media<small></small>

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


<input type="file" class="form-control" id="image_" name="image" placeholder="" required /><br>


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

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<section class="content">
<div class="box box-success">
<div class="box-body">
<form action="" method="post" enctype="multipart/form-data"> 
<div class="row">

<!--<div class="col-md-4 col-sm-6" >
<div class="form-group">
<label>Users Type:</label>

<select class="form-control"  name="usertype" required  id="inputGroupSelect" >   
	<option>Select User Type</option>
<?php
if ($result){
while($row = dbFetchAssoc($result)) {
print_r($row);  
?>
<option value="<?php echo $row['idspProfiles'] ?>"><?php echo $row['spProfileName'] ?></option>

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
<input type="text" name="midea_name" id="midea_name" class="form-control"  required>  

</div>
<div class="form-group">   
<label>File:</label>
<input type="file" name="image" id="image_" class="form-control"  required>  

</div>
</div>

</div>
<div class="box-footer"> 
<input type="submit" id="add" name="btnButton" value="Save" class="btn vd_btn vd_bg-green finish" /> &nbsp;

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


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script type="text/javascript">
  $('#inputGroupSelect').select2({
    selectOnClose: true
  });
</script>   