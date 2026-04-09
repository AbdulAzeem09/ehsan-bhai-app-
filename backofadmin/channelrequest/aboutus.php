<?php
if (!defined('WEB_ROOT')) {
exit;
}
if(isset($_POST['savesubmit']))
{
$title=$_POST['txtTitle'];
$content=$_POST['contents'];
$current_date = date('Y-m-d H:i:s');
$cmd="update spnews_about set title='$title',content='$content',created_date='$current_date' where id=1";
$result = dbQuery($dbConn, $cmd);
}
$datacmd="select*from spnews_about";
$rows = dbQuery($dbConn, $datacmd);
$mydata=mysqli_fetch_assoc($rows);
?>
<!-- Content Header (Page header) -->
<link rel='stylesheet' href='https://cdn.quilljs.com/1.1.5/quill.snow.css'>
<link href="<?php echo $_SERVER['REQUEST_URI'];?>/backofadmin/template/xpert/assets/admin/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
<section class="content-header top_heading">
<h1>About Us</h1>
</section>
<!-- Main content -->
<section class="content" >
<!-- start any work here. -->
<form action="" method="post">

<div class="box box-success">
<div class="box-body">
<div class="row" id="alertmsg" style="margin: 10px 0px 0px 5px;">
<?php 
if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
if($_SESSION['count'] <= 1){
$_SESSION['count'] +=1; ?>
<div style="min-height:10px;"></div>
<div class="alert alert-<?php echo $_SESSION['data'];?>">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<?php echo $_SESSION['errorMessage'];  ?>
</div> <?php
unset($_SESSION['errorMessage']);
}
} ?>
</div>
<div class="row">

<div class="col-md-12 pro_detail_box" style="margin-bottom:20px; width:90%;">
<label>Page Title:</label></br>
<input type="text" name="txtTitle" id="txtTitle" class="form-control" required="required" value="<?php echo $mydata['title']; ?>" />
</div>
<div class="col-md-12 pro_detail_box" style=" width:90%">
<!--<input type="hidden" value="<?php echo $receiver_id; ?>" name="receiver_id">-->
<textarea  name="contents" class="form-control c-with-editor" id="content" rows="30" style="display:none;" required> </textarea>
<div id="editor-container" style="height:200px;"><?php echo $mydata['content'];?></div>
</div>

</div>
</div>
<div class="box-footer"> 
<input type="submit" value="Update" class="btn btn-primary vd_btn" name="savesubmit">&nbsp;
<input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> &nbsp;
</div>
</div>

</form>
</section><!-- /.content -->
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
document.getElementById("content").value = editor_content;
});
</script>