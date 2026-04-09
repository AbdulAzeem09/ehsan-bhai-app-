    <?php
//     error_reporting(E_ALL);
// ini_set('display_errors', 'On');
//include('../univ/baseurl.php');
// include $_SERVER['DOCUMENT_ROOT'] . '/SHAREPAGE_CODES/univ/baseurl.php';
include $_SERVER['DOCUMENT_ROOT'] . '/univ/baseurl.php';


//-- to avoid session already started warning - ganesh
if(session_status() == PHP_SESSION_NONE){
  session_start();
}

    // include $_SERVER['DOCUMENT_ROOT'] . '/SHAREPAGE_CODES/common.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/common.php';


/*
 * checks if the user is logged in if not redirect to login
 * params $url url to redirect after log in
 * 
 */
function checkLogin($url = "/timeline"){
  global $BaseUrl;
  $location = $BaseUrl . "/login.php";
  if (!isset($_SESSION['uid'])) {
    $_SESSION['afterlogin'] = $url;
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
}
?>
