<?php
include('../univ/baseurl.php');
include('../univ/main.php');
session_start();
$dbConn = mysqli_connect(DOMAIN, UNAME, PASS, DBNAME);

if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "my-groups/";
    include_once("../authentication/check.php");
} else {
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");

    $pr = new _spprofiles;
    $result = $pr->read($_SESSION["pid"]);
    if ($result != false) {
        $sprows = mysqli_fetch_assoc($result);
        $profileCity = $sprows["spProfilesCity"];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['saveint'])) {
            $intr = new _groupsponsor;
            $intr->removeINT($_SESSION['uid'], $_SESSION['pid']);

            foreach ($data['intrest'] as $chk1) {
                $insertData = array(
                    "intrest_id" => $chk1,
                    "user_id" => $_SESSION['uid'],
                    "profile_id" => $_SESSION['pid']
                );
                $intr->createInt($insertData);
            }

            echo json_encode(['success' => true]);
            exit();
        }
    }

    $intr1 = new _groupsponsor;
    $interest = $intr1->readInterest($_SESSION['uid'], $_SESSION['pid']);
    $interest_usr = array();
    if ($interest) {
        while ($myfetch = mysqli_fetch_assoc($interest)) {
            $interest_usr[] = $myfetch['intrest_id'];
        }
    }
}
?>
