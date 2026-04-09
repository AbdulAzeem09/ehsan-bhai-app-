<?php
session_start();

include '../univ/baseurl.php';

function sp_autoloader($class)
{
  include '../mlayer/' . $class . '.class.php'; 
}

spl_autoload_register("sp_autoloader");
require_once "../common.php";

$u          = new _spuser;
$re         = new _redirect;
$redirctUrl = $BaseUrl . "/sign-up.php";
$spUserEmail = isset($_POST['spUserEmail']) ? $_POST['spUserEmail'] : '';

if (isset($_POST["spProfileType_idspProfileType_"])) {
  $a = mt_rand(1000, 32700);

  if ($spUserEmail != '') {
    if (!filter_var($spUserEmail, FILTER_VALIDATE_EMAIL)) {
      echo "Invalid email format";
      exit;
    }

    $chkEmail = selectQ("select * from spuser where spUserEmail=? ", "s", [$spUserEmail]);

    if ($chkEmail) {
      $re->redirect($redirctUrl);
    } else {
      $ref_code = ( isset($_POST['refferalcodeused']) && !empty($_POST['refferalcodeused']) ? $_POST['refferalcodeused'] : 'LC6C2QUC' );

      if (!empty($ref_code)) {
        //$ref_code = $_POST['refferalcodeused'];
        $n = new _spuser;
        $i = '';
        $n1 = $n->read_ref_code($ref_code);
        if (!$n1) {
          $_SESSION["Error"]="Referal code is invalid"; 
          header("Location: $BaseUrl/sign-up.php");       
          exit;
        }
      }else{
        echo "referal code is empty";
        exit;
      }

      $_POST['spphone']= isset($_POST['spUserPhone']) ? $_POST['spUserPhone'] : '';
      // echo "<pre>";print_r($_POST); exit();
      $uid = $u->register($_POST, $a);
      $_SESSION['chkuid'] = $uid;
      $_SESSION["useridd"] = $uid;
      // DO NOT set $_SESSION["uid"] here - user must complete email verification and registration steps first
      // $_SESSION["uid"] = $uid;
      if ($uid > 0) {
        // add points to the user
        $po = new _spPoints;
        $result = $po->read(2);

        if ($result != false) {
          $row   = mysqli_fetch_array($result);
          $point = $row['point_total'];
          $data = array(
            "pointPercentage" => $point,
            "pointBalance"    => $point,
            "spUser_idspUser" => $uid,
            "spPointComment"  => "User Registration",
            "spPoint_type"    => "D",
          );
          $po->tad->create($data);
        }
        // ===END
      }
      header("Location: $BaseUrl/verifyemail.php");
      exit;            
    }
  }
}
/*} else {
//echo "<script>alert('PLease Verify Captcha')l</script>";
die('no verified');
} */
