<?php
  include('../univ/baseurl.php');
  function sp_autoloader($class)
  {
	  include '../mlayer/' . $class . '.class.php';
  }
  spl_autoload_register("sp_autoloader");
  //$re = new _redirect;
  $location = $BaseUrl . "/login.php";
  if (!isset($_SESSION['uid'])) {
	  //$re->redirect($location);
	  //header("location:$location");
?>
<script>
  window.location.replace('<?php echo $location; ?>');
</script>
<?php
  } else if(!isset($_SESSION['pid']) && isset($_SESSION['pageid'])){
    if($_SESSION['pageid'] == 1){
?>
<script>
  window.location.replace('<?php echo $BaseUrl.'/registration-steps.php'; ?>');
</script>
<?php
    } else if($_SESSION['pageid'] == 'verifyemail') {
?>
<script>
  window.location.replace('<?php echo $BaseUrl.'/verifyemail.php'; ?>');
</script>
<?php
    } else {
?>
<script>
  window.location.replace('<?php echo $BaseUrl.'/registration-steps.php?pageid='.$_SESSION['pageid']; ?>');
</script>
<?php
    }
  }
?>
