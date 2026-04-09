<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 'On');
session_start();
	require_once '../../backofadmin/library/config.php';
		require_once '../../backofadmin/library/functions.php';
		
		
				       
	
		
		
//print_r($_GET); die("--------------------");

if( isset($_GET['idspProfil'])){
	$idspProfil= $_GET['idspProfil'];
	$sql74 =  "DELETE FROM `spprofiles` WHERE idspProfiles = $idspProfil";
	dbQuery($dbConn, $sql74);
	?>
	<script> window.location.href = "index.php?view=flaguser"; </script>
	<?php
}

if($_GET['cat_id'] == " time" ){
	
	//echo "hello"; die("--------------");
	
	$id=  $_GET['id'];
	$cat =$_GET['view'];
	
	 $sql1 =  "DELETE FROM sppostings WHERE idspPostings =" . $id . "";
			dbQuery($dbConn, $sql1);
			?>
<script>

window.location.href = "index.php?view=flagtimelinepost";
</script>
		<?php	
	
}


if($_GET['cat_id'] == 1 ){
	
	$id=  $_GET['id'];
	$cat =$_GET['cat_id'];
	
	 $sql1 =  "DELETE FROM flagpost WHERE spPosting_idspPosting =" . $id . "";
			dbQuery($dbConn, $sql1);
			
			$sql2 =  "DELETE FROM spproduct WHERE idspPostings =" . $id . "";
			dbQuery($dbConn, $sql2);
			?>
			<script>
 
		window.location.href = "index.php?catId=<?php echo  $cat; ?> ";
</script>
		<?php	
	
}


if($_GET['cat_id'] == 2 ){
	
	$id=  $_GET['id'];
	$cat =$_GET['cat_id'];
	
	 $sql1 =  "DELETE FROM flagpost WHERE spPosting_idspPosting =" . $id . "";
			dbQuery($dbConn, $sql1);
			
				$sql2 =  "DELETE FROM spjobboard WHERE idspPostings =" . $id . "";
			dbQuery($dbConn, $sql2);
			?>
			<script>
 
		window.location.href = "index.php?catId=<?php echo  $cat; ?> ";
</script>
		<?php	
	
}


if($_GET['cat_id'] == 3 ){
	
	$id=  $_GET['id'];
	$cat =$_GET['cat_id'];
	
	 $sql1 =  "DELETE FROM flagpost WHERE spPosting_idspPosting =" . $id . "";
			dbQuery($dbConn, $sql1);
			
				$sql2 =  "DELETE FROM sprealstate WHERE idspPostings =" . $id . "";
			dbQuery($dbConn, $sql2);
			?>
			<script>
 
		window.location.href = "index.php?catId=<?php echo  $cat; ?> ";
</script>
		<?php	
	
}


if($_GET['cat_id'] == 5 ){
	
	$id=  $_GET['id'];
	$cat =$_GET['cat_id'];
	
	 $sql1 =  "DELETE FROM flagpost WHERE spPosting_idspPosting =" . $id . "";
			dbQuery($dbConn, $sql1);
			
				$sql2 =  "DELETE FROM spfreelancer WHERE idspPostings =" . $id . "";
			dbQuery($dbConn, $sql2);
			?>
			<script>
 
		window.location.href = "index.php?catId=<?php echo  $cat; ?> ";
</script>
		<?php	
	
}


if($_GET['cat_id'] == 7 ){
	
	$id=  $_GET['id'];
	$cat =$_GET['cat_id'];
	
	 $sql1 =  "DELETE FROM flagpost WHERE spPosting_idspPosting =" . $id . "";
			dbQuery($dbConn, $sql1);
			
				$sql2 =  "DELETE FROM spclassified WHERE idspPostings =" . $id . "";
			dbQuery($dbConn, $sql2);
			?>
			<script>
 
		window.location.href = "index.php?catId=<?php echo  $cat; ?> ";
</script>
		<?php	
	
}


if($_GET['cat_id'] == 9 ){
	
	$id=  $_GET['id'];
	$cat =$_GET['cat_id'];
	
	 $sql1 =  "DELETE FROM flagpost WHERE spPosting_idspPosting =" . $id . "";
			dbQuery($dbConn, $sql1);
			
				$sql2 =  "DELETE FROM spevent WHERE idspPostings =" . $id . "";
			dbQuery($dbConn, $sql2);
			?>
			<script>
 
		window.location.href = "index.php?catId=<?php echo  $cat; ?> ";
</script>
		<?php	
	
}


if($_GET['cat_id'] == 10 ){
	
	$id=  $_GET['id'];
	$cat =$_GET['cat_id'];
	
	 $sql1 =  "DELETE FROM flagpost WHERE spPosting_idspPosting =" . $id . "";
			dbQuery($dbConn, $sql1);
			
				$sql2 =  "DELETE FROM spvideo WHERE video_id =" . $id . "";
			dbQuery($dbConn, $sql2);
			?>
			<script>
 
		window.location.href = "index.php?catId=<?php echo  $cat; ?> ";
</script>
		<?php	
	
}


if($_GET['cat_id'] == 13 ){
	
	$id=  $_GET['id'];
	$cat =$_GET['cat_id'];
	
	 $sql1 =  "DELETE FROM flagpost WHERE spPosting_idspPosting =" . $id . "";
			dbQuery($dbConn, $sql1);
			
				$sql2 =  "DELETE FROM sppostingsartcraft WHERE idspPostings =" . $id . "";
			dbQuery($dbConn, $sql2); 
			?>
			<script>
 
		window.location.href = "index.php?catId=<?php echo  $cat; ?> ";
</script>
		<?php	
	
}




		
		if($_GET['cat_id'] == 20 ){
	
	$id=  $_GET['id'];
	$cat =$_GET['cat_id'];
	
	 $sql1 =  "DELETE FROM flagpost WHERE spPosting_idspPosting =" . $id . "";
			dbQuery($dbConn, $sql1);
			
				//$sql2 =  "DELETE FROM sppostingsartcraft WHERE idspPostings =" . $id . "";
			//dbQuery($dbConn, $sql2); 
			?>
			<script>
 
		window.location.href = "index.php?catId=<?php echo  $cat; ?>&view=business ";
</script>
		<?php	
	
}



		?>

		
		