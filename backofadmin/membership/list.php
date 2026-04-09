<?php
if (!defined('WEB_ROOT')) {
exit;
}





/*if($_GET['action']== 'del'){

$id=$_GET['id'];	
$sql2 ="DELETE FROM `spmembership` WHERE idspMembership=$id";

$result2  = dbQuery($dbConn, $sql2);

}*/

$sql =  "SELECT * FROM spmembership ";
$result  = dbQuery($dbConn, $sql);
?>
<!-- Content Header (Page header) -->
<section class="content-header top_heading">
<h1>All Membership</h1>
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
<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<?php echo $_SESSION['errorMessage'];  ?>
</div> 
</div><?php
unset($_SESSION['errorMessage']);
}
} ?>

<div class="box-body" >
<div class="table-responsive tbl-respon">
<table id="example1" class="table table-bordered table-striped tbl-respon2">
<thead>
<tr>
<th style="width: 80px;">Report No</th>
<th>Title</th>
<th>Post Limit</th>
<th>Membership Duration</th>
<th>Membership Amount</th>
<th>Icon Path</th>
<th>Description</th>
<th class="text-center">Action</th>
</tr>
</thead>
<tbody>
<?php
if ($result) {
$i = 1;
while ($row = dbFetchAssoc($result)) {
extract($row);
?>
<tr>
<td class="text-center"><?php echo $i; ?></td>
<td><?php echo $spMembershipName; ?></td>
<td><?php echo ($spMembershipPostlimit == 0)?"Unlimited":$spMembershipPostlimit; ?></td>
<td><?php echo $spMembershipDuration; ?></td>
<td><?php echo ($spMembershipAmount == 0)? "-": $spMembershipAmount; ?></td>
<td><?php echo $spMembershipIcon; ?></td>
<td><?php echo $spMembershipDesc; ?></td>

<td class="menu-action text-center">

<a href="javascript:modifyNode(<?php echo $idspMembership; ?>)" data-original-title="Edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-pencil"></i> </a>



<a href="<?php echo '?action=del&id='.$idspMembership; ?>" data-original-title="delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow" onclick="return confirm('Are you sure you want to delete this item')"> <i class="fa fa-trash"></i> </a>

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

