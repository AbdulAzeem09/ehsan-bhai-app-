<?php

include('../univ/baseurl.php');
session_start();

function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}

$group_id = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;
spl_autoload_register("sp_autoloader");

if (!isset($_SESSION['pid'])) {
    include_once("../authentication/check.php");
    $_SESSION['afterlogin'] = "../grouptimelines/?groupid=" . $group_id . "&groupname=" . htmlspecialchars($_GET['groupname'], ENT_QUOTES, 'UTF-8') . "&timeline";
}

try {
    $pid = $_SESSION['pid'];
    $getid = $group_id;
    $obj2 = new _spAllStoreForm;
    $ress2 = $obj2->readdatabymulid($getid, $pid);
    if ($ress2 == false) {
        throw new Exception("You do not have access to this group.");
    }

    $g = new _spgroup;
    $result = $g->groupdetails($group_id);
    if ($result != false) {
        $row = mysqli_fetch_assoc($result);
        $gimage = htmlspecialchars($row["spgroupimage"], ENT_QUOTES, 'UTF-8');
        $spGroupflag = htmlspecialchars($row['spgroupflag'], ENT_QUOTES, 'UTF-8');
    } else {
        throw new Exception("Group details not found.");
    }
} catch (Exception $e) {
    header("Location: $BaseUrl/my-groups/?msg=" . urlencode($e->getMessage()));
    exit();
}

include('../helpers/image.php');

if (isset($_POST['upload'])) {
    $image = new Image();
    $image->validateFileVideoExtensions($_FILES['file']);

    $id = $_POST['id'];

    $uid = $_SESSION['uid'];
    $pid = $_SESSION['pid'];
    $gid = $_POST['gid'];
    $dir = 'group_video_upload/';
    $tmp_file = $_FILES['file']['tmp_name'];
    $file = $_FILES['file']['name'];
    move_uploaded_file($tmp_file, "$dir/$file");
    $date = $_POST['date'];
    $dt = array(
        "user_id" => $uid,
        "profile_id" => $pid,
        "group_id" => $gid,
        "file" => $file,
        "date_created" => $date
    );
    $obj = new _postingalbum;
    $obj->insertfile($dt);
    header('Location: http://sharepage.codes/grouptimelines/group-folder.php?groupid=' . $_POST['gid'] . '&groupname=' . $_GET['groupname'] . '&files&video');
    exit();
}
    