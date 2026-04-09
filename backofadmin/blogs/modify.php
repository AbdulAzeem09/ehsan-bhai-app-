<?php
require_once '../library/config.php';
if (!defined('WEB_ROOT')) {
	exit;
}
if (!isset($_SESSION['username']) || $_SESSION['username'] == '') {
	redirect(WEB_ROOT_ADMIN . 'login.php');
}

$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

if (isset($_GET['contId']) && ($_GET['contId']) > 0) {
	$Id = $_GET['contId'];
} else {
	redirect('index.php');
}
$row = selectQ("SELECT * from blogs where id=?", "i", [$Id], "one");
$res_data = selectQ("SELECT * from blog_category", "i", "");

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.css" />
<style>
	.note-editable {
		height: 300px !important;
	}
</style>
<!-- Content Header (Page header) -->
<section class="content-header top_heading">
	<h1>Modify Blogs</h1>
</section>
<!-- Main content -->
<section class="content">
	<!-- start any work here. -->
	<form name="frmAddMainNav" id="frmAddMainNav" method="post" enctype="multipart/form-data"
		onsubmit="return validate(this)">
		<input type="hidden" name="hidId" id="hidId" value="<?php echo $row['id']; ?>" />

		<div class="box box-success">
			<div class="box-body">
				<div class="row" id="alertmsg" style="margin: 10px 0px 0px 5px;">
					<?php
					if (isset($_SESSION['errorMessage']) && isset($_SESSION['count'])) {
						if ($_SESSION['count'] <= 1) {
							$_SESSION['count'] += 1; ?>
							<div style="min-height:10px;"></div>
							<div class="alert alert-<?php echo $_SESSION['data']; ?>">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<?php echo $_SESSION['errorMessage']; ?>
							</div> <?php
							unset($_SESSION['errorMessage']);
						}
					} ?>
				</div>
				<input type="hidden" class="form-control" name="id" id="id" value="<?php echo $row['id']; ?>" />

				<div class="row">
					<div class="col-md-12 col-sm-12" style="margin-bottom:20px;">
						<label>Title:</label></br>
						<input type="text" class="form-control detaild" value="<?php echo $row['title']; ?>" id="title"
							name="title" maxlength="160" required>
					</div>

					<div class="col-md-12 col-sm-12" style="margin-bottom:20px;">
						<label>Category:</label></br>
						<select class="form-control detaild" name="categories" id="blogcategory">
							<?php foreach ($res_data as $rows) { ?>
								<option value="<?php echo $rows['id']; ?>" <?php echo ($rows['id'] == $row['category']) ? 'selected' : ''; ?>><?php echo ucfirst($rows['name']); ?></option>
							<?php } ?>
						</select>
					</div>

					<div class="col-md-12 col-sm-12" style="margin-bottom:20px;">
						<label>Description:</label></br>
						<div id="summernote"><?php echo $row['description']; ?></div>
					</div>
					<div class="col-md-12 col-sm-12" style="margin-bottom:20px;">
						<label>Image:</label></br>
						<img width="100" height="100" src="<?php echo $row['image']; ?>">
						<input type="file" class="form-control detaild" value="" id="choosefile" name="choosefile"
							maxlength="160">

					</div>

				</div>
			</div>
			<div class="box-footer">
				<input id="submitBtn" name="btnButton" value="Update" class="btn vd_btn vd_bg-green finish" /> &nbsp;
				<input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow"
					onclick="window.location.href='index.php'" /> &nbsp;
			</div>
		</div>

	</form>
</section><!-- /.content -->

<script>
	$(document).ready(function () {
		$("#submitBtn").click(function () {

			var txtDesc = $('#summernote').summernote('code');
			var title = $("#title").val();
			var id = $("#id").val();
			// Get the file input element
			var fileInput = document.getElementById('choosefile');
			var blogcategory = $("#blogcategory").val();
			// Get the selected file
			var file = fileInput.files[0];


			// Create a FormData object
			var formData = new FormData();
			// Append the file and text content to the FormData object
			formData.append('choosefile', file);
			formData.append('txtDesc', txtDesc);
			formData.append('title', title);
			formData.append('hidId', id);
			formData.append('blogcategory', blogcategory);

			$.ajax({
				type: "POST",
				url: "processContent.php?action=modify",
				data: formData,
				processData: false, // Prevent jQuery from automatically processing FormData
				contentType: false, // Prevent jQuery from automatically setting contentType
				success: function (response) {
					if (response) {
						window.location.href = '<?php echo $BaseUrl . '/backofadmin/blogs' ?>';
					} else {
						window.location.href = '<?php echo $BaseUrl . '/backofadmin/blogs/index.php?view=add' ?>';
					}
				}
			});
		});
	});
</script>

<script type="text/javascript">
	var maxLength = 160;
	$('.detaild').keyup(function () {
		var length = $(this).val().length;
		var length = maxLength - length;
		$('#chars').text(length);
	});
</script>
<script src="<?php echo $BaseUrl ?>/backofadmin/js/summernote-lite.js"></script>
<script>
	$('#summernote').summernote({
		placeholder: 'Hello stand alone ui',
		tabsize: 2,
		height: 100,
		toolbar: [
			['style', ['style']],
			['font', ['bold', 'underline', 'clear']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['table', ['table']],
			['insert', ['link', 'picture', 'video']],
			['view', ['fullscreen', 'codeview', 'help']]
		]
	});
</script>
<script language="JavaScript" type="text/javascript"
	src="<?php echo $BaseUrl ?>/backofadmin/js/modules/quill_editor.js"></script>