<?php
include('../../univ/baseurl.php');
     require_once '../library/config.php';
	require_once '../library/functions.php';

if(isset($_POST['update'])){
		//die('======');
		$id1 = $_POST['id'];
	$spConCom1 = $_POST['spConCom'];
    $spConName1 = $_POST['spConName'];   
	$spConPho1 = $_POST['spConPho'];
	$spConEmail1 = $_POST['spConEmail'];
	$spConDesc1 = $_POST['spConDesc'];
	$spConStatus1 = $_POST['spConStatus'];
	$g_recaptcha_response1 = $_POST['g_recaptcha_response'];
	//die('===');
	$spConTopic1 = $_POST['spConTopic'];
	$spConSubj1 = $_POST['spConSubj'];
		
	$sqlu="UPDATE tbl_contact SET spConCom='$spConCom1',spConName='$spConName1',spConPho='$spConPho1',spConEmail='$spConEmail1',spConDesc='$spConDesc1',spConStatus='$spConStatus1',g_recaptcha_response='$g_recaptcha_response1',spConTopic='$spConTopic1',spConSubj='$spConSubj1' WHERE spConId =$id1" ;
	//echo $sqlu;
	//die('=');
      $resU= dbQuery($dbConn, $sqlu); 
?>
<script>
  window.location.replace('<?php echo $BaseUrl?>/backofadmin/contact/?msg=update');
  </script>

<?php

}?>
	 



