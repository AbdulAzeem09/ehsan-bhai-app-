<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

	if (isset($_GET['postid']) && $_GET['postid'] > 0) {
		$postid = $_GET['postid'];
	}else {
		// redirect to index.php if user id is not present
		redirect('index.php?view=groups_c');
	}
?>
