<?php
$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
$id = (isset($_GET['id']) && $_GET['id'] != '') ? $_GET['id'] : '';


if (!defined('WEB_ROOT')) {
exit;
}



?>
<style type="text/css">
input{
width: 80px;
}
.table-responsive {
min-height: .01%;
overflow-x: unset !important;
}

</style>
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>Admin Commission Setting</small></h1>
</section>
<!-- Main content -->
<section class="content">
<div class="box box-success">

<form method="post" action="process.php?action=edit">
<div class="box-body">
<?php 
if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
if($_SESSION['count'] <= 1){
$_SESSION['count'] +=1; ?>
<div class="row" id="alertmsg" style="margin: 5px 0px 0px 5px;" >
<div style="min-height:10px;"></div>
<div class="alert alert-<?php echo $_SESSION['data'];?>">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<?php echo $_SESSION['errorMessage'];  ?>
</div> 
</div><?php
unset($_SESSION['errorMessage']);
}
} ?>


<div class="table-responsive tbl-respon">
<table class="table table-bordered table-striped text-center" id="example1">
<thead>
<tr>

<th class="text-center">Amount</th>
<th class="text-center">Type</th>
<th class="text-center">Action</th>

</tr>
</thead>
<tbody>
<?php

$sql =  "SELECT * FROM tbl_admcommission ORDER BY comm_id DESC ";
$result  = dbQuery($dbConn, $sql);


if ($result) {
$i = 1;
while ($row = dbFetchAssoc($result)) {
?>
<tr>

<td>  
<input type="text" name="commamt"  id="test1" oninput="validateNumber(this);" value="<?php echo $row['comm_amt']; ?>" >
</td>

<td>
<input type="hidden" name="commid" value="<?php echo $row['comm_id']; ?>" >
<select class="form-control" name="commtype">
<option value="0" <?php if($row['comm_type']==0) { echo "selected";} ?> >% Percent</option>
<option value="1" <?php if($row['comm_type']==1) { echo "selected";} ?> >Fixed</option>								
</select>


</td>

<td><input style="background-color: blue !important;" type="submit" class="btn btn-primary" name="btnSubmit" id="btnSubmit" value="Update"  ></td>

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
</form>
<!--- End Table ---------------->
</div>


</section><!-- /.content -->

<script type="text/javascript">  /*js start*/

function isNumber(evt) {
evt = (evt) ? evt : window.event;
var charCode = (evt.which) ? evt.which : evt.keyCode;
if (charCode > 31 && (charCode < 48 || charCode > 57)) {
return false;
}
return true;
}  	

</script>	<!-----js end------->

<script>
var validNumber = new RegExp(/^\d*\.?\d*$/);
var lastValid = document.getElementById("test1").value;  
function validateNumber(elem) {
  if (validNumber.test(elem.value)) {
    lastValid = elem.value;
  } else {
    elem.value = lastValid;
  }
}
</script>


<script type="text/javascript">

$(document).ready( function () {
var table = $('#example1').DataTable( {

"order": [[ 0, "desc" ]],
pageLength : 10,
searching: false, paging: false, info: false,"ordering": false,
lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
} );



} );

</script>	

