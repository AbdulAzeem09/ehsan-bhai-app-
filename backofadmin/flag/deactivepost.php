<?php
//print_r($_GET);

 	require_once '../../backofadmin/library/config.php';
		require_once '../../backofadmin/library/functions.php';
		
		
		//echo "hello"; die("--------------");
		if($_GET['catId'] == "time" ){
	
	//echo "hello"; die("--------------");
	
	$id=  $_GET['id'];
	//$cat =$_GET['view'];
	$deactive_time = date('Y-m-d H:i:s');
	 $sql = "UPDATE flagtimelinepost SET flag_status = 1,deactive_time= '$deactive_time' WHERE spPosting_idspPosting = $id";
	 
	// echo $sql;  die("----------------");
			dbQuery($dbConn, $sql);
			
			 $sql1 = "UPDATE sppostings SET spPostingsStatus = 1 WHERE idspPostings = $id";
          
			dbQuery($dbConn, $sql1);
			?>
			<script>
 
		window.location.href = "index.php?view=flagtimelinepost";
</script>
		<?php	
	
}

if($_GET['catId'] == 1 ){
	
	$id=  $_GET['id'];
	$cat =$_GET['catId'];
	
	$deactive_time = date('Y-m-d H:i:s');
       $sql = "UPDATE spproduct SET Status = 1,deactive_time= '$deactive_time' WHERE idspPostings = $id";
			
			//$sql =  "DELETE FROM spproduct WHERE idspPostings =" . $id . "";
			dbQuery($dbConn, $sql);
			?>
			<script>
 
		window.location.href = "index.php?catId=<?php echo  $cat; ?> ";
</script>
		<?php	
	
}

if($_GET['catId'] == 2 ){
	
	$id=  $_GET['id'];
	$cat =$_GET['catId'];
	
	$deactive_time = date('Y-m-d H:i:s');
       $sql = "UPDATE spjobboard SET flag_status = 1,deactive_time= '$deactive_time' WHERE idspPostings = $id";
	  // echo $sql; die("------------------");
			
			
			dbQuery($dbConn, $sql);
			?>
			<script>
 
		window.location.href = "index.php?catId=<?php echo  $cat; ?> ";
</script>
		<?php	
	
}

if($_GET['catId'] == 3 ){
	
	$id=  $_GET['id'];
	$cat =$_GET['catId'];
	
	$deactive_time = date('Y-m-d H:i:s');
       $sql = "UPDATE sprealstate SET flag_status = 1,deactive_time= '$deactive_time' WHERE idspPostings = $id";
	  // echo $sql; die("------------------");
			
			
			dbQuery($dbConn, $sql);
			?>
			<script>
 
		window.location.href = "index.php?catId=<?php echo  $cat; ?> ";
</script>
		<?php	
	
}


if($_GET['catId'] == 5 ){
	
	$id=  $_GET['id'];
	$cat =$_GET['catId'];
	
	$deactive_time = date('Y-m-d H:i:s');
       $sql = "UPDATE spfreelancer SET flag_status = 1,deactive_time= '$deactive_time' WHERE idspPostings = $id";
	  // echo $sql; die("------------------");
			
			
			dbQuery($dbConn, $sql);
			?>
			<script>
 
		window.location.href = "index.php?catId=<?php echo  $cat; ?> ";
</script>
		<?php	
	
}

if($_GET['catId'] == 7 ){
	
	$id=  $_GET['id'];
	$cat =$_GET['catId'];
	
	$deactive_time = date('Y-m-d H:i:s');
       $sql = "UPDATE spclassified SET flag_status = 1,deactive_time= '$deactive_time' WHERE idspPostings = $id";    
	  // echo $sql; die("------------------");
			
			
			dbQuery($dbConn, $sql);
			?>
			<script>
 
		window.location.href = "index.php?catId=<?php echo  $cat; ?> ";
</script>
		<?php	
	
}

if($_GET['catId'] == 9 ){
	
	$id=  $_GET['id'];
	$cat =$_GET['catId'];
	
	$deactive_time = date('Y-m-d H:i:s');
       $sql = "UPDATE spevent SET flag_status = 1,deactive_time= '$deactive_time' WHERE idspPostings = $id";    
	  // echo $sql; die("------------------");
			
			
			dbQuery($dbConn, $sql);
			?>
			<script>
 
		window.location.href = "index.php?catId=<?php echo  $cat; ?> ";
</script>
		<?php	
	
}

if($_GET['catId'] == 10 ){
	
	$id=  $_GET['id'];
	$cat =$_GET['catId'];
	
	$deactive_time = date('Y-m-d H:i:s');
       $sql = "UPDATE spvideo SET flag_status = 1,deactive_time= '$deactive_time' WHERE video_id = $id";    
	  // echo $sql; die("------------------");
			
			
			dbQuery($dbConn, $sql);
			?>
			<script>
 
		window.location.href = "index.php?catId=<?php echo  $cat; ?> ";
</script>
		<?php	
	
}


if($_GET['catId'] == 13 ){
	
	$id=  $_GET['id'];
	$cat =$_GET['catId'];
	
	$deactive_time = date('Y-m-d H:i:s');
       $sql = "UPDATE sppostingsartcraft SET flag_status = 1,deactive_time= '$deactive_time' WHERE idspPostings = $id";    
	  // echo $sql; die("------------------");
			
			
			dbQuery($dbConn, $sql);
			?>
			<script>
 
		window.location.href = "index.php?catId=<?php echo  $cat; ?> ";
</script>
		<?php	
	
}
?>

<?php 

/*echo"here";*/
//	 $con = mysqli_connect('localhost', 'osspdev', 'Office@256');

  /* if(!$con) {
        die('Not Connected To Server');
		die("-------------");
    }
 $postid = $_POST['postid'];
    //Connection to database
    if(!mysqli_select_db($con, 'thesharepage')) {
        echo 'Database Not Selected';
    }  

/*    function now($str_user_timezone,
       $str_server_timezone = CONST_SERVER_TIMEZONE,
       $str_server_dateformat = CONST_SERVER_DATEFORMAT) {
 
  // set timezone to user timezone
  date_default_timezone_set($str_user_timezone);
 
  $date = new DateTime('now');
  $date->setTimezone(new DateTimeZone($str_server_timezone));
  $str_server_now = $date->format($str_server_dateformat);
 
  // return timezone to server default
  date_default_timezone_set($str_server_timezone);
 
  return $str_server_now;
}*/
    //date_default_timezone_get();

 /* $deactive_time = date('Y-m-d H:i:s');
       $sql = "UPDATE flagtimelinepost SET flag_status = 1,deactive_time= '$deactive_time' WHERE spPosting_idspPosting = $postid";
     
       /* print_r($date);*/
       //print_r($sql);
    // $sql		=	"DELETE FROM flagtimelinepost WHERE flag_id = $flagid";

     /* if(!mysqli_query($con, $sql)) {
        echo 'Could not insert';
    }else {

    		$_SESSION['count'] = 0;
    		$_SESSION['errorMessage'] = "Deleted Successfully.";
    		$_SESSION['data'] = "success";

           $sql1 = "UPDATE sppostings SET spPostingsStatus = 1 WHERE idspPostings = $postid";
          
            if(!mysqli_query($con, $sql1)) {
              
               echo 'Could not update';

            }else{
              
               echo 'Updated';

            }
          
          }*/
		  

	?>