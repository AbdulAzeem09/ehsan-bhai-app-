<?php
if (!defined('WEB_ROOT')) {
exit;
}
$rowsPerPage = 39;  
$sql		=	"SELECT * FROM spmedia_add; ";  
//echo $sql; die();
$result = dbQuery($dbConn, $sql);

// custom pagignation
//$result     = dbQuery($dbConn, getPagingQuery($sql, $rowsPerPage));
//$pagingLink = getPagingLink($dbConn, $sql, $rowsPerPage);

?>

<!-- Content Header (Page header) -->
<section class="content-header">
<h1>Media<small>List</small>
<a href="?view=add"  class="btn btn-primary pull-right">Add Media</a>
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
      <form action="" method="POST">
      <div class="row text-center" ><h2>ADD</h2></div>      
     
         <div class="d-flex flex-row">
            <input type="hidden"  name="id"  id="depart_id">
            <input type="text" class="form-control" id="department_" name="department_in" placeholder="" required /><br>
              <textarea  class="form-control" id="department_" name="department_in" placeholder="" required /></textarea>
            
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
<div>
<?php 
if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
if($_SESSION['count'] <= 1){
$_SESSION['count'] +=1; ?>
<div class="space"></div>
<p class="alert alert-success"><?php echo $_SESSION['errorMessage'];  ?></p> <?php
unset($_SESSION['errorMessage']);
}
} ?>
</div>
<div class="box-body tbl-respon">
<table id="example1" class="table table-bordered table-striped tbl-respon2">
<thead>
<tr>
<th class="text-center" style="width: 80px;">Report No</th>

<th>Image</th>
<!--<th>Posted Date</th>
<th>Account Name</th>-->
<th>Media Name</th>
<!--<th>Block Reason</th>

<th>Status</th>-->
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
if ($result){
$i = 1;

while($row = dbFetchAssoc($result)) {
/*if($row['users']){
$user = $row['users'];
$sql2		=	"SELECT * FROM spprofiles WHERE idspProfiles = $user"; 
$result1  = dbQuery($dbConn, $sql2);
}

if($result1){

	$row1 = dbFetchAssoc($result1);
	$spProfileName =  $row1['spProfileName'];  
}*/

//print_r($row); die('----');
//extract($row);

/*$postDate = strtotime($spPostingDate);

if ($spPostingVisibility == -1) {
$status = "Active";
}else if($spPostingVisibility == 0){
$status = "Draft";
}else if($spPostingVisibility == 1){
$status = "Block";
}*/
//$status = "<img src='" .  WEB_ROOT_TEMPLATE . "/images/icon/active.png' alt='Active' width='24' height='24' />";
?>
<tr>

<td class="text-center"><?php echo $i;?></td>
<!--<td>
<?php //echo $spProfileName; ?>
     
</td>-->
<td> 
	<?php
  //echo $_SERVER["DOCUMENT_ROOT"];
   if($row['file']){ ?>
	<img height="50"  width="50" src="<?php $_SERVER["DOCUMENT_ROOT"]?>/upload/<?php echo  $row['file']; ?>">   
   <?php }else{?>

<img height="50"  width="50" src="blank-img.png">   
<?php 
   }  
   
   ?>
</td>   
<td><?php echo $row['media_name']; ?></td>
								
<!----------dumy-------->


<!---------->


<td class=" menu-action">  
<a href="javascript:modifySize(<?php echo $row['id'];?>)" data-original-title="Edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-pencil"></i> </a>

     <a href="javascript:deleteSize(<?php echo $row['id'];?>)" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>


</td>
</tr><?php
$i++;
}
}else { ?>
<tr>
<td height="20">No User/ Admin Added Yet</td>  
</tr>
<?php 
} //end while ?>

</tbody>

</table>
</div><!-- /.box-body -->


<!--- End Table ---------------->
</div>



</section><!-- /.content -->

<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script type="text/javascript">

$(document).ready( function () {
var table = $('#example1').DataTable( {

"order": [[ 0, "desc" ]],
pageLength : 10,
lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
} );



} );



function deleteSize(a){

//window.location.href = "delete.php?id="+a;

Swal.fire({
title: 'Are you sure want to delete?',

icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',

}).then((result) => {
if (result.isConfirmed) {
window.location.href = "delete.php?id="+a;
}
})  





}


function modifySize(b){
window.location.href = "?view=edit&id="+b;
}

</script>