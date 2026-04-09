<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$p = new _updatemedia;

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$uploads_dir = '../uploadimage/';
$name = $_FILES["spPostingMedia"]["name"];
$tmp_name = $_FILES["spPostingMedia"]["tmp_name"];

move_uploaded_file($tmp_name, "$uploads_dir/$name");

$file = $uploads_dir . $name;

$result = $p->readawskey();

$row = mysqli_fetch_array($result);
$key_name = $row['key_name'];
$secret_name = $row['secret_name'];


$result1 = $p->readawskeyagain($ids = 13);

$row1 = mysqli_fetch_array($result1);
$region_name = $row1['region_name'];
$bucketName = $row1['bucketName'];
$BaseUrl = $_SERVER['DOCUMENT_ROOT'];

include $BaseUrl . '/aws/aws-autoloader.php';

use Aws\S3\S3Client;

$s3 = new S3Client([
    'version' => 'latest',
    'region' => $region_name,
    'credentials' => [
        'key'    => $key_name,
        'secret' => $secret_name
    ]
]);

$file_Path4 = $file;

$key = random_int(1000000000, 9999999999);

try {
    $result = $s3->putObject([
        'Bucket' => $bucketName,
        'Key'    => $key,
        'Body'   => fopen($file_Path4, 'r'),
        'ACL'    => 'public-read',
    ]);
    //  echo "Image uploaded successfully. Image path is: ". $result->get('ObjectURL');
} catch (Aws\S3\Exception\S3Exception $e) {
    echo "There was an error uploading the file.\n";
    echo $e->getMessage();
}

$data = 'https://' . $bucketName . '.s3.' . $region_name . '.amazonaws.com/' . $key;

unlink($file);



if ($_FILES['spPostingMedia']['size'] != 0) {
    $File_Name   = strtolower($_FILES['spPostingMedia']['name']);
}
$File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention

$FileExt = str_replace('.', '', $File_Ext);

if ($FileExt == 'mp3') {
    $spFileName = "audio";
} else if ($FileExt == 'mp4') {
    $spFileName = "video";
} else if ($FileExt == "pdf") {
    $spFileName = "pdf";
} else {
    $spFileName = "document";
}

$result = $p->updatemedia($data, $FileExt, $_POST['idspPostingMedia'],$File_Name);
//die('+++++++++++++++++++++');
