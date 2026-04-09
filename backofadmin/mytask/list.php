<?php
if (!defined('WEB_ROOT')) {
exit;
}
$userId = $_SESSION['userId'];
//print_r($_SESSION);
$sql =  "SELECT * FROM tbl_notes WHERE user_id_to = $userId AND spNotesStatus != 2 AND spNotesStatus != 1 ";
//echo $sql ;
$result  = dbQuery($dbConn, $sql);


?>

<!-- Content Header (Page header) -->
<section class="content-header">
<h1>My Task <small>[List]</small></h1>
</section>
<!-- Main content -->
<section class="content">
<div class="box box-success">

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
<div class="box-header text-right">
<a href="index.php?view=add" class="btn btn-primary"><i class="fa fa-plus"></i> Add Task</a>
</div>
<div class="box-body" >
<div class="table-responsive tbl-respon">
<table id="example1" class="table table-bordered table-striped tbl-respon2">
<thead>
<tr>
<th>ID</th>
<th>Title</th>
<th>Assigned By</th>
<th>Assign Date</th>
<th>Description</th>
<th>Status</th>
<th style="width: 100px;" class="text-center" >Action</th>
</tr>
</thead>
<tbody>
<?php
if ($result) {
$i = 1;
while ($row = dbFetchAssoc($result)) {
extract($row);
$postDate = strtotime($spNotesDate);

if ($spNotesStatus == 0) {
$status = "Pending";
}else if($spNotesStatus == 1){
$status = "Waiting";
}else if($spNotesStatus == -1){
$status = "Working";
}else{
$status = "Completed";
} 
?>
<tr>
<td class="text-center"><?php echo $i; ?></td>
<td><?php echo $spNotesTitle; ?></td>
<td><?php 
showUserName($dbConn, $user_id_from); 
if ($spNotesRead == 0 && $spNotesStatus != 1) {
echo '<small class="label bg-aqua">New</small>';
}
?></td>
<td><?php echo date("d-M-Y", $postDate); ?></td>
<td><?php 
if(strlen($spNotesDesc) > 70){
echo substr($spNotesDesc, 0,70)."...";

}else{
echo $spNotesDesc; 
}
?></td>
<td class="bg_<?php echo $status;?>"><?php echo $status; ?></td>
<td class="menu-action text-center">


<a href="javascript:detailTask(<?php echo $idspNotes;?>)" data-original-title="Edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-green" >
<i class="fa fa-eye"></i>
</a>&nbsp;
<?php
if ($spNotesStatus == 0) {
?>
<a href="javascript:approveTask(<?php echo $idspNotes;?>)" data-original-title="Edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-blue" >
<i class="fa fa-check"></i>
</a>&nbsp;
<?php
}
if ($spNotesStatus == -1) {
?>
<a href="javascript:closeWorkingTask(<?php echo $idspNotes;?>)" data-original-title="Complete Working" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow" >
<i class="fa fa-code-fork"></i>
</a>
<?php
}else{
?>
<a href="javascript:workingTask(<?php echo $idspNotes;?>)" data-original-title="Start Working" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow" >
<i class="fa fa-code-fork"></i>
</a>
<?php
}
?>
<a href="index.php?view=edit&idspNotes=<?php echo $idspNotes;?>" data-original-title="Edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-blue" >
<i class="fa fa-edit"></i>
</a>
</td>
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

</script>
