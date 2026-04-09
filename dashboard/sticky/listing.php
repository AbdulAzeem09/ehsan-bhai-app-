<?php
require_once("../../univ/baseurl.php");
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "dashboard/";
include_once("../../authentication/islogin.php");
} else {
function sp_autoloader($class)
{
include '../../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");
if (!isset($_SESSION['pid'])) {
include_once("../../authentication/check.php");
$_SESSION['afterlogin'] = $BaseUrl . "/my-profile/";
}
$pageactive = 3;

$re = new _redirect;

// if (!isset($_SESSION['pin']) && $_SESSION['pin'] != 1) {
//     $redirctUrl = $BaseUrl . "/dashboard/sticky/pin.php/";
//     $re->redirect($redirctUrl);
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php include('../../component/f_links.php'); ?>
<!-- ===========DSHBOARD LINKS================= -->
<?php include('../../component/dashboard-link.php'); ?>
<!-- ===========PAGE SCRIPT==================== -->
<style>
.dataTables_empty {
text-align: center !important;
}

.vd_green {
background-color: green !important;
}

.vd_yellow {
background-color: orange !important;
}

.vd_red {
background-color: red !important;
}
.sa-button-container button.confirm {
background-color: #b90000!important;
}
.sweet-alert button.cancel {
background-color: #032350!important;
}
.sweet-alert {
width: 400px!important;
padding: 0px 18px 11px 19px;
height: 317px;
}


.swal-wide{
width:550px !important;
}

</style>

</head>





<body class="bg_gray" onload="pageOnload('details')">
<?php

include_once("../../header.php");
?>

<section class="">
<div class="container-fluid no-padding">
<div class="row">
<!-- left side bar -->
<div class="col-md-2 no_pad_right">
<?php
include('../../component/left-dashboard.php');
?>
</div>
<!-- main content -->
<div class="col-md-10 no_pad_left">
<div class="rightContent">

<!-- breadcrumb -->
<section class="content-header">
<h1>Sticky Notes</h1>
<ol class="breadcrumb">
<li><a href="<?php echo $BaseUrl . '/dashboard'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Sticky Notes</li>
</ol>
</section>

<div class="content">
<div class="row">
<div class="col-md-12">
<div class="box">
<div class="box-header text-right">
<a href="<?php echo $BaseUrl . '/dashboard/sticky/index.php'; ?>" class="btn butn btn-border-radius"><i class="fa fa-file"></i> View Notes</a>
<a href="<?php echo $BaseUrl . '/dashboard/sticky/add.php'; ?>" class="btn butn btn-border-radius"><i class="fa fa-plus"></i> Add New Note</a>
</div><!-- /.box-header -->
<div class="box-body">
<table id="example1" class="table table-bordered table-striped ">
<thead>
<tr>
<th class="text-center">ID</th>
<th class="text-left">Title</th>
<th>Date</th>
<th class="text-center">Action</th>
</tr>
</thead>
<tbody>
<?php
$i = 1;
$p = new _spAllStoreForm;
$type = 0;
$result = $p->readSticky($_SESSION['pid'], $type);
if ($result) {
while ($row = mysqli_Fetch_assoc($result)) {
?>
<tr>
<td class="text-center"><?php echo $i; ?></td>
<td><?php echo $row['spStickyTitle'] ?></td>
<td><?php echo $row['spStickyDate']; ?></td>
<td class="menu-action" style="text-align: center;">
<a href="<?php echo $BaseUrl . '/dashboard/sticky/detail.php?id=' . $row['idspSticky']; ?>" data-original-title="view" data-toggle="tooltip" data-placement="top" > <i style="color: #428bca" class="fa fa-eye" style="color:orange"></i> </a>
<a href="<?php echo $BaseUrl . '/dashboard/sticky/modify.php?id=' . $row['idspSticky']; ?>" data-original-title="edit" data-toggle="tooltip" data-placement="top" > <i style="color: #428bca" class="fa fa-pencil"></i> </a>
<a href="<?php echo $BaseUrl . '/dashboard/sticky/proSticy.php?action=delete&id=' . $row['idspSticky']; ?>" data-original-title="delete" data-toggle="tooltip" data-placement="top"> <i class="fa fa-trash "></i> </a>
</td>
</tr>
<?php
$i++;
}
}
?>
</tbody>

</table>
</div><!-- /.box-body -->
</div><!-- /.box -->



</div>
</div>

</div>
</div>
</div>
</div>





</div>
</section>

<?php include('../../component/f_footer.php'); ?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../../component/f_btm_script.php'); ?>

<script src="<?php echo $BaseUrl; ?>/assets/admin/css/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo $BaseUrl; ?>/assets/admin/css/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
<!-- page script -->
<script type="text/javascript">
$(function() {
$("#example1").dataTable();
$('#example2').dataTable({
"bPaginate": true,
"bLengthChange": false,
"bFilter": false,
"bSort": true,
"bInfo": true,
"bAutoWidth": false
});
});
</script>
<script>
$(".delesticky").click(function(e) {
// alert();
e.preventDefault();
/*var postid = $(this).attr("data-postid");*/
var link = $(this).attr('href');

// alert(link)
;
// alert(postid);

swal({
title: "Are you sure you want to Delete ?",
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "No",
showCancelButton: true,
customClass: 'swal-wide',


},
function(isConfirm) {
if (isConfirm) {
window.location.href = link;
}
});

});
</script>
</body>

</html>
<?php
} ?>