<?php

session_start();
include('../univ/baseurl.php');
include('../helpers/image.php');
include('../univ/main.php');
include('../common.php');

function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

// Function to handle image upload
function uploadPagePic($inputName, $uploadDir, $newW, $newH, $filename)
{
    $image     = $_FILES[$inputName];
    $imagePath = '';
    $thumbnailPath = '';
    $imgSize = getimagesize($image['tmp_name']);
    // if a file is given
    if (trim($image['tmp_name']) != '') {
        $ext = substr(strrchr($image['name'], "."), 1); //$extensions[$image['type']];
        // generate a random new file name to avoid name conflict
        $imagePath = $filename . ".$ext"; 
        list($width, $height, $type, $attr) = getimagesize($image['tmp_name']);
        // make sure the image width does not exceed the
        // maximum allowed width
        if ($width > $newW || $height > $newH) {
            $result  = createThumbnail($image['tmp_name'], $uploadDir . $imagePath, $newW, $newH);
            $imagePath = $result;
        } else {
            $result = move_uploaded_file($image['tmp_name'], $uploadDir . $imagePath);
        }
    }
    return $imagePath;
}

$grp = new _spgroup;
$id = 0;

$image = new Image();
$rfq_img = '';
if(isset($_FILES['spgroupimage'])){
    // Validate file extensions before upload
    $image->validateFileImageExtensions($_FILES['spgroupimage']);

    // Continue with image upload process
    $rfqImg = $_FILES['spgroupimage']['tmp_name'] ?? "";
    if ($rfqImg != '') {
        $filename = pathinfo($_POST['spgroupimage'], PATHINFO_FILENAME);
        $rfq_img = uploadPagePic('spgroupimage', "../uploadimage/", true, true, $filename);
    }
}

$_POST['spgroupimage'] = $rfq_img;

if (isset($_POST["idspGroup"])) {
    $id = $grp->update($_POST, "WHERE t.idspGroup =" . $_POST["idspGroup"]);
} else if (isset($_POST["idspGroup"])) {
    $id = $grp->updategroupdata($_POST['spGroupAbout'], $_POST['spgroupLocation'], $_POST["idspGroup"]);
} else {
    $dbConn = mysqli_connect(DBHOST, UNAME, PASS, DBNAME);
    $_POST['spGroupName'] = mysqli_real_escape_string($dbConn, $_POST['spGroupName']);
    $_POST['CreatedDate'] = date('Y-m-d');
    $_POST['spgroupLocation'] = getLocation($_POST['spUserCountry'], $_POST['spUserState'], $_POST['spUserCity']);
    $active_groups_count = $grp->getMemberLiveGroups($_POST['spProfiles_idspProfiles']);
    if($_POST['status'] != "draft" && $active_groups_count > 20){
        echo "limit_exceeds"; die();
    }else{
        //create grotp
        $id = $grp->create($_POST);      
        //create sp group link with profile
        $grp->create1($id, $_SESSION['pid']);
    }

    // // Create Misc folder for group files and save misc folder at directory.
    // $folderObj = new _postingalbum;
    // $miscFolderName = "Miscellaneous";
    // $groupId = $id;
    // $createdate = date('Y-m-d');
    // $createFolder = preg_replace('~[^\pL\d]+~u', '-', $miscFolderName);
    // $indGrpFldr = strtoupper(hash("joaat", (int)$groupId));
    // $saveFileName = $indGrpFldr;
    // $locationFold = '../group' . $saveFileName; //individual folder
    // mkdir($locationFold);
    // $miscFold = $locationFold .'/' . $createFolder; //Misc folder under individual folder
    // mkdir($miscFold);
    // $insertFolder = $folderObj->insert_folder($miscFolderName, $_SESSION['pid'], $createdate, $groupId, $indGrpFldr);
}

if (!empty($id)) {
    echo "/grouptimelines/?groupid=" . $id . "&groupname=" . $_POST['spGroupName'] . "&timeline&page=1";
}
die();
?>


