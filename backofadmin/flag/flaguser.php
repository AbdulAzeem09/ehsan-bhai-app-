<?php
if (!defined('WEB_ROOT')) {
exit;
}


$sql =  "SELECT * FROM flagpost AS t INNER JOIN sppostings AS p ON t.spPosting_idspPosting = p.idspPostings INNER JOIN spprofiles AS u ON p.spProfiles_idspProfiles = u.idspProfiles WHERE flag_status = 0 GROUP BY u.idspProfiles";
$result  = dbQuery($dbConn, $sql);


?>
<style>
.swal2-popup { 
font-size: small !important;
}
</style>
<!-- Content Header (Page header) -->
<section class="content-header top_heading">
<h1>Flagged User</h1>
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

<div class="box-body" >
<div class="table-responsive tbl-respon">
<table id="example1" class="table table-bordered table-striped tbl-respon2">
<thead>
<tr>
<th style="width: 80px;">ID</th>
<th>Profile Name</th>
<th>Total Post Flagged</th>
<th style="width: 80px;">Action</th>
</tr>
</thead>
<tbody>
<?php
if ($result) {
$i = 1;
while ($row = dbFetchAssoc($result)) {
//print_r($row);die('ddddddddddd');
extract($row);
?>
<tr>
<td class="text-center"><?php echo $i; ?></td>

<td><a href="<?php echo $BaseUrl . '/friends/?profileid=' . $idspProfiles; ?>"><?php echo $spProfileName; ?></a></td>

<td><?php totalFlagPost($dbConn, $idspProfiles); ?></td>
<td class="menu-action text-center">

<a href="javascript:flagUser(<?php echo $idspProfiles;?>)" data-original-title="Detail" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-info"></i> </a>

<a onclick="permanentDelete(<?php echo $idspProfiles; ?>)"  class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>

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

<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script> 
<script>
function permanentDelete(userId) {
Swal.fire({
title: 'Are You Sure You Want to Delete?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, Delete!'
}).then((result) => {
if (result.isConfirmed) {
window.location.href = 'deleteflag.php?idspProfil=' + userId;
}
});
}
</script>


