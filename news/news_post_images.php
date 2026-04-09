<?php
include '../univ/baseurl.php';
include '../helpers/image.php';
date_default_timezone_set('Asia/Kolkata');
session_start();

function sp_autoloader($class) {
    include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");

$obj = new _news();

$newsPic = $_FILES['newsPic'];
$document = $_FILES['newsDocument'];
$newsvideo = $_FILES['newsMedia'];
$randnum = $_POST['randnum'];
$pid = $_SESSION['pid'];

$image = new Image();

$image->validateFileImageExtensions($newsPic);

// Proceed with the upload if the image file format is valid
if ($_FILES['newsPic']['size'] != 0) {
    $temp = explode(".", $_FILES["newsPic"]["name"]);
    $name3 = round(microtime(true)) . '.' . end($temp);
    $tmp_name3 = $_FILES["newsPic"]["tmp_name"];
    $uploads_dir3 = 'news_upload';
    move_uploaded_file($tmp_name3, "$uploads_dir3/$name3");

    $data3 = array(
        'relation_id' => $randnum,
        'filename' => $name3,
        'file_type' => 3,
        'pid' => $pid
    );

    $lastid = $obj->create_news_attachment3($data3);
}

// Retrieve uploaded file details
$result = $obj->read_tempfiles($lastid, 3);
if ($result != false) {
    $row = mysqli_fetch_assoc($result);
}
$id = $row['id'];

// Display the uploaded image
echo '<div id="previewbox'.$lastid.'"><div class="col-md-4" style="float:left;"><span onclick="DelPriView('.$lastid.')"><i class="fa fa-times" aria-hidden="true"></i></span>   
    <img height="100" width="80"  src="'.$BaseUrl.'/news/news_upload/'.$row['filename'].'" alt="Card image">
    </div></div>';

?>

