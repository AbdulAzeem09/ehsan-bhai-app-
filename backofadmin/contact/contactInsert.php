<?php
//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
//error_reporting(E_ALL);
include('../../univ/baseurl.php');
     require_once '../library/config.php';
	require_once '../library/functions.php';
	
	
	
	if(isset($_POST['submit'])){
		//die('======');
	$spConCom1 = $_POST['spConCom'];
    $spConName1 = $_POST['spConName'];   
	$spConPho1 = $_POST['spConPho'];
	$spConEmail1 = $_POST['spConEmail'];
	$spConDesc1 = $_POST['spConDesc'];
	$spConStatus1 = $_POST['spConStatus'];
	$recaptcha1 = $_POST['g_recaptcha_response'];
	//echo $recaptcha1;
	//die('====');
	$spConTopic1 = $_POST['spConTopic'];
	$spConSubj1 = $_POST['spConSubj'];

 
	  
	 
	
	$sqli = "INSERT INTO tbl_contact (spConCom, spConName, spConPho, spConEmail, spConDesc, spConStatus,g_recaptcha_response,spConTopic,spConSubj) VALUES ('$spConCom1','$spConName1','$spConPho1','$spConEmail1','$spConDesc1','$spConStatus1', '$recaptcha1','$spConTopic1','$spConSubj1')";
	
	//echo $sqli; die("------------");
	
	$result3  = dbQuery($dbConn, $sqli);
	?>
	<script>
  window.location.replace('<?php echo $BaseUrl?>/backofadmin/contact/');
  </script>
  
<?php	}
	?>
	
	