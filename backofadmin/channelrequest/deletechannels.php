
<?php
 require_once '../library/config.php';
	require_once '../library/functions.php';
$ids=$_GET['id'];
$del="delete from rss_addchannel where id='$ids'";
$res=dbQuery($dbConn,$del);
 ?>
 <script>
window.location.replace("<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/channelrequest/index.php?view=worldnewsns");
 </script>