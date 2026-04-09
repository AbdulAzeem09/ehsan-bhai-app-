<?php

include('../../univ/baseurl.php');
session_start();

if (!isset($_SESSION['pid'])) {

  $_SESSION['afterlogin'] = "freelancer/";
  include_once("../../authentication/islogin.php");
} else {

  function sp_autoloader($class)
  {
    include '../../mlayer/' . $class . '.class.php';
  }

  spl_autoload_register("sp_autoloader");

  $p = new _contact;


  $postid = $_POST['postid'];
  $pid = $_SESSION['pid'];
  $uid = $_SESSION['uid'];
  $desc = $_POST['description'];
  $review = $_POST['review_rating'];
  $to_persom_m = $_POST['to_person'];

  $data = array(
    'uid' => $uid,
    'pid' => $pid,
    'postid' => $postid,
    'description' => $desc,
    'rating' => $review,
    'to_person' => $to_persom_m,
    'date' => date("Y-m-d h:i:s")
    
  );


  $res = $p->create_review($data);
}
?>
<script>
  window.location.replace('<?php echo $BaseUrl ?>/freelancer/dashboard/project-bid.php?postid=<?php echo $postid;  ?>');
</script>