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
$re = new _redirect;
$p = new _spAllStoreForm;

if (isset($_GET['id']) && $_GET['id'] > 0) {

$Id = (int)$_GET['id'];

$result = $p->readSinglSticky($Id);
if ($result) {
$row = mysqli_fetch_assoc($result);
$title = $row['spStickyTitle'];
$desc = $row['spStickyDes'];
} else {
$redirctUrl = $BaseUrl . "/dashboard/sticky/index.php/";
$re->redirect($redirctUrl);
}
} else {
$Id = 0;
$redirctUrl = $BaseUrl . "/dashboard/sticky/index.php/";
$re->redirect($redirctUrl);
}
$pageactive = 3;
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php include('../../component/f_links.php'); ?>
<!--This script for posting timeline data End-->
<!-- ===========DSHBOARD LINKS================= -->
<?php include('../../component/dashboard-link.php'); ?>
<!-- bootstrap wysihtml5 - text editor 
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
-->
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
<h1>Sticy Notes</h1>
<ol class="breadcrumb">
<li><a href="<?php echo $BaseUrl . '/dashboard'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li><a href="<?php echo $BaseUrl . '/dashboard/sticky'; ?>"> Sticky Notes</a></li>
<li class="active">Add</li>
</ol>
</section>

<div class="content">
<div class="row">
<div class="col-md-12">
<!-- general form elements disabled -->
<div class="box box-success">
<div class="box-header">
<h3 class="box-title">General Elements</h3>
</div><!-- /.box-header -->
<div class="box-body">
<form role="form" method="post" action="proSticy.php?action=modify">
<input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
<input type="hidden" name="hidId" value="<?php echo $Id; ?>">
<!-- text input -->
<div class="form-group">
<label>Title</label>
<input type="text" class="form-control" name="spStickyTitle" placeholder="Enter ..." required="" value="<?php echo $title; ?>" />
</div>
<div class="form-group">
<label>Description</label>
<link rel='stylesheet' href='https://cdn.quilljs.com/1.1.5/quill.snow.css'>
<textarea name="spStickyDes" id="spStickyDes"placeholder="Place some text here" style="width: 100%; display:none; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required><?php echo $desc; ?></textarea>
<div id="editor-container" style=" height: 135px; "><?php echo $desc ?></div>                                                      

</div>
<input type="submit" name="btnAdd" value="Update" class="btn btn-success btn-border-radius">
</form>
</div>
</div>


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

<!-- CK Editor
<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 
<script src="<?php echo $BaseUrl; ?>/assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(function () {
// Replace the <textarea id="editor1"> with a CKEditor
// instance, using default configuration.
//CKEDITOR.replace('editor1');
//bootstrap WYSIHTML5 - text editor
// $(".textarea").wysihtml5();
});
</script> -->
<script src='https://cdn.quilljs.com/1.3.6/quill.js'></script>
<script>
var quill = new Quill('#editor-container', {
modules: {
toolbar: [
[{ header: [1, 2, false] }],
['bold', 'italic', 'underline']
]
},
theme: 'snow'  // or 'bubble'
});
quill.on("text-change", function() {
var editor_content = quill.container.firstChild.innerHTML ;
//alert(editor_content);
document.getElementById("spStickyDes").value = editor_content;
});
</script>
</body>

</html>
<?php
} ?>
