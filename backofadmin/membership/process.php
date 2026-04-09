<?php
	require_once '../library/config.php';
	require_once '../library/functions.php';

	checkUser();
	$action = isset($_GET['action']) ? $_GET['action'] : '';
	switch ($action) {
		case 'modify' :
			modify($dbConn);
			break;

		default :
			// if action is not defined or unknown
			// move to main index page
			redirect('index.php');
	}
	// Add New User
	function modify($dbConn){
    $hidId = isset($_POST['hidId']) ? mysqli_real_escape_string ($dbConn, (int)$_POST['hidId']) : 0;
    $txtTitle = isset($_POST['txtTitle']) ? mysqli_real_escape_string($dbConn, $_POST['txtTitle']) : "";
    $txtPostLimit = isset($_POST['txtPostLimit']) ? mysqli_real_escape_string($dbConn, $_POST['txtPostLimit']) : 0;
    $txtDuration = isset($_POST['txtDuration']) ? mysqli_real_escape_string($dbConn, $_POST['txtDuration']) : 0;
    $txtAmount = isset($_POST['txtAmount']) ? mysqli_real_escape_string($dbConn, $_POST['txtAmount']) : "";
    $txticon = isset($_POST['txticon']) ? mysqli_real_escape_string($dbConn, $_POST['txticon']) : "";
    $txtDescription = isset($_POST['txtDescription']) ? mysqli_real_escape_string($dbConn, $_POST['txtDescription']) : "";

    $sql   = "UPDATE spmembership SET spMembershipName = '$txtTitle', spMembershipPostlimit = '$txtPostLimit', spMembershipDuration = '$txtDuration', spMembershipAmount = '$txtAmount',spMembershipIcon = '$txticon',spMembershipDesc = '$txtDescription' WHERE idspMembership = $hidId";
    $result = dbQuery($dbConn, $sql);
    $_SESSION['count'] = 0;
    $_SESSION['errorMessage'] = "Updated Successfully.";
    redirect('index.php');		
  }
?>
