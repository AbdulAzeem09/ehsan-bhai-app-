<?php 


include('../../univ/baseurl.php');


require_once '../library/config.php';
	require_once '../library/functions.php';


//echo $_GET['action'];
 $id=$_GET['id'];
//die('============');


if($_GET['action']=="pending"){
		//die('00');
		$sql = "UPDATE sptraining SET status='0' WHERE id=$id";

		$result1 = dbQuery($dbConn, $sql);

		$result  = dbQuery($dbConn, $sql);
		if($result){

		?>
		<script>
		window.location.replace('<?php echo $BaseUrl?>/backofadmin/courses/index.php');
		</script>
		<?php
		}
	}

if($_GET['action']=="active"){
	//die('00');
	$sql = "UPDATE sptraining SET status='2' WHERE id=$id";
	//	  	$result1 = dbQuery($dbConn, $sql1);
	$result  = dbQuery($dbConn, $sql);
	if($result){
	?>	
	<script>
	window.location.replace('<?php echo $BaseUrl?>/backofadmin/courses/index.php?view=approved');
	</script>

	<?php	

	}
}

if($_GET['action']=="reject"){
	//die('00');
	$sql = "UPDATE sptraining SET status='1' WHERE id=$id";
	//	  	$result1 = dbQuery($dbConn, $sql1);
	$result  = dbQuery($dbConn, $sql);
	if($result){
	?>	
	<script>
	window.location.replace('<?php echo $BaseUrl?>/backofadmin/courses/index.php?view=rejected');
	</script>

	<?php	

	}
}

if($_GET['action']=="pendingReject"){
	//die('00');
	$sql = "UPDATE sptraining SET status='2' WHERE id=$id";
	//	  	$result1 = dbQuery($dbConn, $sql1);
	$result  = dbQuery($dbConn, $sql);
	if($result){
	?>	
	<script>
	window.location.replace('<?php echo $BaseUrl?>/backofadmin/courses/index.php?view=pending');
	</script>

	<?php	

	}
}

if($_GET['action']=="pendingActive"){
	//die('00');
	$sql = "UPDATE sptraining SET status='1' WHERE id=$id";
	//	  	$result1 = dbQuery($dbConn, $sql1);
	$result  = dbQuery($dbConn, $sql);
	if($result){
	?>	
	<script>
	window.location.replace('<?php echo $BaseUrl?>/backofadmin/courses/index.php?view=pending');
	</script>

	<?php	

	}
}
?>