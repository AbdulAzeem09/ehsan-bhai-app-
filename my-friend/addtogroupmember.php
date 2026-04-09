<?php
include "../univ/baseurl.php";
function sp_autoloader($class)
{
	include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
//spProfileTypes_idspProfileTypesid,spGroup_idspGroup
$g = new _spgroup;
$id = 0;
$admin 		= 1;
$aprove 	= 2;
$assAdmin 	= 0;
/*print_r($_POST);*/
if (isset($_POST['btnspGroup'])) {

    $aprove 	= 2;
	$admin 		= 0;
	$date 	= $_POST['spDate'];
	$pid 	= $_POST['txtidspProfile'];
	$gid 	= $_POST['spProfileGroup'];

	$chkResult = $g->chkAlreadyAdded($pid, $gid);
	if ($chkResult->num_rows > 0) {
	} else {
		$result = $g->newaddmemberGroup($pid, $gid, $admin, $aprove, $assAdmin, $date,1);
	}
	//echo $g->tad->sql;
	header('location:../my-friend');
}

if (isset($_GET['pid']) && $_GET['pid'] > 0 && isset($_GET['gid']) && $_GET['gid'] > 0) {
	$date = date('Y-m-d');
	$aprove 	= 2;
	$admin 		= 0;

	$pid = $_GET['pid'];
	$gid = $_GET['gid'];
	$gname = strtolower($_GET['gname']);




	$chkResult = $g->chkAlreadyAdded($pid, $gid);
	if ($chkResult->num_rows > 0) {
	} else {
		$result = $g->newaddmemberGroup($pid, $gid, $admin, $aprove, $assAdmin, $date, 1);
	}
	//echo $g->tad->sql;
	/*	header('location:../grouptimelines/?groupid='.$gid.'&groupname='.$gname.'&timeline');

*/
?>
	<script type="text/javascript">
		window.location.href = "<?php echo $BaseUrl . '/grouptimelines/?groupid=' . $gid . '&groupname=' . $gname . '&timeline'; ?>";
	</script>
<?php
	$re = new _redirect;
	$location = $BaseUrl . '/grouptimelines/?groupid=' . $gid . '&groupname=' . $gname . '&timeline';
	$re->redirect($location);
}

?>