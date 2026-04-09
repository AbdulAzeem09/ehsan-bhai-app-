<?php

require_once '../library/config.php';
	require_once '../library/functions.php';

	
//echo"hereresult ="; print_r($_POST);

$sp_status=$_POST['status'];

//print_r($sp_status);

$sp_userid=$_POST['userid'];
//print_r($sp_userid);

$update_sql = "UPDATE useridentity SET status='$sp_status' WHERE uid= '$sp_userid'";

print_r($update_sql);
$result  = dbQuery($dbConn, $update_sql);

//$result = $con -> query($update_sql);

 print_r($result);
 redirect('index.php?view=vaccount');
/*if ($result = $con -> query($update_sql)) {

   // print_r($result);
  $row = $result -> fetch_row(); 

  print_r($row);
*/
  
  
	//while($row = dbFetchAssoc($result)) {
        

        ?>