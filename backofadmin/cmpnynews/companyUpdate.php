<?php
include('../../univ/baseurl.php');
     require_once '../library/config.php';
	require_once '../library/functions.php';

if(isset($_POST['update'])){
		//die('======');
		$id1 = $_POST['id'];
		$companynewsTitle1 = $_POST['companynewsTitle'];
	  $cmpanynewsDesc1 = $_POST['cmpanynewsDesc'];   
	$spProfiles_idspProfiles1 = $_POST['spProfiles_idspProfiles'];
	$cmpanynewsdate1 = $_POST['cmpanynewsdate'];
	$cmpanynewsStatus1 = $_POST['cmpanynewsStatus'];
	//echo $cmpanynewsStatus1;
	//die('=====');
	$banDesc1 = $_POST['banDesc'];
		
	$sqlu="UPDATE company_news SET cmpanynewsTitle='$companynewsTitle1',cmpanynewsDesc='$cmpanynewsDesc1',spProfiles_idspProfiles='$spProfiles_idspProfiles1',cmpanynewsdate='$cmpanynewsdate1',cmpanynewsStatus='$cmpanynewsStatus1',banDesc='$banDesc1' WHERE idcmpanynews=$id1" ;
	//echo $sqlu;
	//die('=');
      $resU= dbQuery($dbConn, $sqlu);
?>
<script>
  window.location.replace('<?php echo $BaseUrl?>/backofadmin/cmpnynews/index.php?msg=update');
  </script>

<?php

}?>
	 



