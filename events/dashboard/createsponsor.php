<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
include('../../univ/baseurl.php');
include('../../helpers/image.php');
function sp_autoloader($class)
{
    include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$p = new _sponsorpic;
$re = new _redirect;
$image = new Image();
if (isset($_POST["idspSponsor"]) && $_POST['idspSponsor'] > 0) {
    $idspSponsor = $_POST['idspSponsor'];
    $id = $p->updateSponsor($_POST, "WHERE t.idspSponsor =" . $_POST["idspSponsor"]);
    
    if ($_FILES["sponsorImg"]["size"] > 0) {
    
        $image->validateFileImageExtensions($_FILES["sponsorImg"]);
        

        $filename = $_FILES["sponsorImg"]["name"];
        $tempname = $_FILES["sponsorImg"]["tmp_name"];
        $folder = "../image/" . $filename;

        $p->updatepic($idspSponsor, $filename);

        if (move_uploaded_file($tempname, $folder)) {
            //echo "<h3>Image uploaded successfully!</h3>";
        } else {
            //echo "<h3>Failed to upload image!</h3>";
        }
    }

    $redirectUrl = $BaseUrl . "/events/dashboard/sponsor-list.php";
    $re->redirect($redirectUrl);
} else {
    $image->validateFileImageExtensions($_FILES["sponsorImg"]);
   

    $filename = $_FILES["sponsorImg"]["name"];
    $tempname = $_FILES["sponsorImg"]["tmp_name"];
    $folder = "../image/" . $filename;
    if (move_uploaded_file($tempname, $folder)) {

        $data = array(
            'sponsorTitle' => $_POST['sponsorTitle'],
            'sponsorWebsite' => $_POST['sponsorWebsite'],
            'sponsorImg' => $filename,
            'sponsorCategory' => $_POST['sponsorCategory'],
            'sponsorDesc' => $_POST['sponsorDesc'],
            'spProfile_idspProfile' => $_POST['spProfile_idspProfile'],
            'spsponsorPrice' => $_POST['spsponsorPrice'],
        );

        $id = $p->createsp($data);
        $redirectUrl = $BaseUrl . "/events/dashboard/sponsor-list.php";
        $re->redirect($redirectUrl);
    } else {
        //echo "<h3>Failed to upload image!</h3>";
    }
}
?>

