<?php
if (!defined('WEB_ROOT')) {
	exit;
}
if (!isset($_SESSION['username']) || $_SESSION['username'] == '') {
	redirect(WEB_ROOT_ADMIN . 'login.php');
}


?>

<!-- Content Header (Page header) -->
<section class="content-header top_heading">
	<h1>Blog Category</h1>
</section>
<!-- Main content -->
<section class="content">
	<div class="box box-success">


		<div class="box-header text-right">
			<button type="button" name="btnButton" class="btn btn-primary" onclick="addlokingJobContent()"><i
					class="fa fa-plus"></i> Add Category</button>
		</div><!-- /.box-header -->
		<?php
		if (isset($_SESSION['errorMessage']) && isset($_SESSION['count'])) {
			if ($_SESSION['count'] <= 1) {
				$_SESSION['count'] += 1; ?>
				<div class="row" id="alertmsg" style="margin: 5px 0px 0px 5px;">
					<div style="min-height:10px;"></div>
					<div class="alert alert-<?php echo $_SESSION['data']; ?>">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<?php echo $_SESSION['errorMessage']; ?>
					</div>
				</div><?php
				unset($_SESSION['errorMessage']);
			}
		} ?>

		<div class="box-body">
			<div id="content" class="table-responsive tbl-respon">

			</div>
		</div>
		<div id="pagination"></div>
		<!--- End Table ---------------->
	</div>


</section><!-- /.content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
	$(document).ready(function () {
		// Function to load pagination data
		function loadPaginationData(page) {

			$.ajax({
				url: 'processContent.php?action=ajax', // Corrected the URL to point to your pagination script
				type: 'POST',
				data: { page: page },
				success: function (data) {

					$('#content').html(data); // Update content div with fetched data
				},
				error: function (xhr, status, error) {
					console.error(xhr.responseText); // Log any errors to the console
				}
			});
		}

		// Load initial page content
		loadPaginationData(1);

		// Pagination click event
		$(document).on('click', '.pagination a', function (e) {
			e.preventDefault();
			var page = $(this).text();
			// Get the page number from the clicked link
			loadPaginationData(page); // Load data for clicked page
		});
	});
</script>