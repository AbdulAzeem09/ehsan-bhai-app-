<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
session_start();

include '../univ/baseurl.php';
// include_once($BaseUrl.'/mlayer/_data.class.php');
// include_once($BaseUrl.'/mlayer/_tableadapter.class.php');
// include_once($BaseUrl.'/mlayer/_spuser.class.php');
// include_once($BaseUrl.'/mlayer/_redirect.class.php');
// include_once($BaseUrl.'/mlayer/_spprofiles.class.php');
// include_once($BaseUrl.'/mlayer/_album.class.php');
// include_once($BaseUrl.'/mlayer/_email.class.php');
// include_once($BaseUrl.'/mlayer/_spPoints.class.php');

function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$u          = new _spuser;
$re         = new _redirect;
$redirctUrl = $BaseUrl . "/sign-up.php";

//print_r($redirctUrl); exit();

$siteKey   = '6LdhaVseAAAAABXFYfmsWkm7JEe1PVY7XRwy8nAu';
$secretKey = '6LdhaVseAAAAAKdsDneId9_QsUSjH6m-6LUaGnKl';

if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {

    // Verify the reCAPTCHA response
    // $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$_POST['g-recaptcha-response']);
    $URL = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secretKey . '&response=' . $_POST['g-recaptcha-response'];
    $c   = curl_init();
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_URL, $URL);
    $verifyResponse = curl_exec($c);
    curl_close($c);

    // Decode json data
    $responseData = json_decode($verifyResponse);
    //    die('yes verified');

    if (isset($_POST["spProfileType_idspProfileType_"])) {

        $a = mt_rand(1000, 32700);
        //print_r($a);
        /*      echo "<br>";
        print_r($_POST);
         */
        /*$uid = $u->register($_POST,$a);
        print_r($uid);exit();*/

        if (isset($_POST['spUserEmail']) && $_POST['spUserEmail'] != '') {

            $chkEmail = $u->emailavailablecheck($_POST['spUserEmail']);
            //print_r($chkEmail);

            if ($chkEmail == 0) {
                echo 0;
                $re->redirect($redirctUrl);

            } else {

                $uid = $u->register($_POST, $a);
                //echo $u->ta->sql; exit;

                $_SESSION['chkuid'] = $uid;
                // echo"aa";print_r($uid); exit();


                if ($uid > 0) {
                    // add points to the user
                    $po     = new _spPoints;
                    $result = $po->read(2);
                    /*echo $po->ta->sql;
                    exit();*/

                    if ($result != false) {
                        //echo "33";
                        $row   = mysqli_fetch_array($result);
                        $point = $row['point_total'];

                        $data = array(
                            "pointPercentage" => $point,
                            "pointBalance"    => $point,
                            "spUser_idspUser" => $uid,
                            "spPointComment"  => "User Registration",
                            "spPoint_type"    => "D",
                        );

                        /*print_r($data);
                        exit();*/
                        $po->tad->create($data);
                    }
                    // ===END
                }
                echo 1;
            }
        }

    }
} else {
    //echo "<script>alert('PLease Verify Captcha')l</script>";
    die('no verified');
}
