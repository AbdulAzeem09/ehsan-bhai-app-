<?php 
if (!defined('WEB_ROOT')) {
exit;
}

// print_r($_SESSION);

if(isset($_POST['submit'])){

//print_r($_POST); 
date_default_timezone_set('Asia/Kolkata');

$date=date("Y-m-d h:i:s");
$txtTitle = $_POST['txtTitle'];
$txtDuration = $_POST['txtDuration'];

$txtAmount = $_POST['txtAmount'];
$txtstatus = $_POST['status'];
$txtdescription = $_POST['txtdescription'];

$sql3 = "INSERT INTO  tbl_package (pack_name, pack_amount, pack_duration, pack_description,pack_status,created_date ) VALUES ('$txtTitle','$txtAmount','$txtDuration','$txtdescription','$txtstatus','$date')";
//echo $sql3; die("------------");
$result3  = dbQuery($dbConn, $sql3);

}


?> 
<style>
#mceu_19{
display: none!important;
}
#eg-editor_ifr{
height: 200px!important;
}
</style>

<!-- Content Header (Page header) -->
<section class="content-header top_heading">
<h1>Add Package</h1>
</section>
<!-- Main content -->
<section class="content" >
<!-- start any work here. -->
<form action=" " method="post" enctype="multipart/form-data" >

<div class="box box-success">
<div class="box-body">
<div class="row mg_btm_30">

<div class="col-md-4 col-sm-4 mg_btm_30">
<div class="form-group">
<label>Package Name:</label>
<input type="text" name="txtTitle" id="txtTitle" class="form-control" required="required" value="" />
</div>

</div>
<style>
.swal2-popup { 
font-size: small !important;
}
 </style>
<div class="col-md-4 col-sm-4 mg_btm_30">
<div class="form-group">
<label>Package Duration:</label>
<input type="text" name="txtDuration" id="txtDuration" class="form-control" required="required" value="" />
</div>
</div> 

<div class="col-md-4 col-sm-4 mg_btm_30">
<div class="form-group">
<label>Amount</label>
<input type="text" name="txtAmount" id="txtAmount" class="form-control" required="required" value="" />
</div>
</div> 

<div class="col-md-12 col-sm-4 mg_btm_30">
<div class="form-group">
<label>Description</label>
<textarea  class="form-control c-with-editor" id ="eg-editor" name="txtdescription" rows="" cols="" ></textarea>
<!--<input type="text" name="txtdescription" id="txtdescription" class="form-control" required="required" value="" />-->
</div>

</div>
<br>
<br>

<div class="col-md-4 col-sm-4 mg_btm_30">
<div class="form-group">
<label>Status</label><br>
<input type="radio" id="active" name="status" value="1">
                              <label for="html">Active</label>
                             <input type="radio" id="inactive" name="status" value="0">
                               <label for="css">Inactive</label><br>
</div>

</div>



</div>
</div>
<div class="box-footer"> 
<input type="submit" name="submit" value="Submit" class="btn vd_btn vd_bg-blue finish" /> &nbsp;
<!-- <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> &nbsp;-->
</div>
</div>

</form>

</section><!-- /.content -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<section class="content">
<div class="box box-success">
<div class="box-body">



<div class="table-responsive tbl-respon">
<table id="example1" class="table table-bordered table-striped tbl-respon2">

<thead>
<tr>

<th>Id</th>

<th>Name</th>
<th >Amount</th>
<th >Duration</th>
<th >Package Description</th>
<th >Created Date</th>
<th >Action</th>

</tr>
</thead>
<tbody>
<?php


$sql =  "SELECT * FROM tbl_package ORDER BY `id` asc";
$result2  = dbQuery($dbConn, $sql);
//$row2 = dbFetchAssoc($result2);
//print_r($aa);die('===');
$i=1;
while ($row = dbFetchAssoc($result2)) {
$ids=$row['id'];

?>
<tr>

<td><?php echo $i; ?></td>
<td><?php echo $row['pack_name']; ?></td>

<td><?php echo $row['pack_amount']; ?></td>

<td><?php echo $row['pack_duration']; ?></td>

<td><?php echo $row['pack_description']; ?></td>

<td><?php echo $row['created_date']; ?></td>

<td>
<a  class="btn btn-primary" href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/membership/index.php?view=update&id=<?php echo $ids; ?>"><i class="fa fa-edit" aria-hidden="true"></i></a>
<?php $href ="/backofadmin/membership/index.php?view=del_pack&id=" . $ids; ?> 
<a  class="btn btn-danger" onclick="deletePackage('<?php echo $href; ?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>




</tr>
<?php
$i++;
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
<script src="https://design.sleekr.id/assets/scripts/main.js"></script>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>      

<script type="text/javascript">
tinymce.init({ selector:'.c-with-editor', skin: "lightgray",  height: 100, menubar: false, statusbar: false, plugins: ['advlist autosave lists hr spellchecker nonbreaking'], toolbar: [ 'bold italic underline | alignleft aligncenter alignright alignjustify | styleselect | numlist bullist |' ], });  
</script>


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

</script>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script> 
    <script>
        function deletePackage(userId) {
        Swal.fire({
        title: 'Are You Sure You Want to Delete?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete!'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = userId;
        }
        });
        }
    </script>

<style>