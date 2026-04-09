<?php
function sp_autoloader($class){
include '../mlayer/' . $class . '.class.php';
}
require_once("../common.php");
ignore_user_abort(true);

$postid = $_POST["spPostings_idspPostings"];

spl_autoload_register("sp_autoloader");
$p = new _postingalbum;
$pid = $_POST['spProfiles_idspProfiles'];
$albumid = $_POST["spPostingAlbum_idspPostingAlbum"];
//$img = $_POST["spPostingVideo"];
//echo $_FILES["spPostingMedia"]["tmp_name"];

$UploadDirectory	= '../upload/';
if(isset($_FILES['spPostingPic'])){
  if(isset($_FILES['spPostingPic']['name'])){
    foreach($_FILES['spPostingPic']['name'] as $index => $name){
      $uploadResult = moveMedia($_FILES['spPostingPic']['size'][$index], $name, $_FILES['spPostingPic']['tmp_name'][$index]);
    }
  }
} else if(isset($_FILES['spPostingMedia'])){
  $uploadResult = moveMedia($_FILES['spPostingMedia']['size'], $_FILES['spPostingMedia']['name'], $_FILES['spPostingMedia']['tmp_name']);
}

function moveMedia($size, $name, $tmpName){
  global $p, $postid, $albumid, $pid, $UploadDirectory;
  if($size != 0){
    $File_Name   = strtolower($name);
    $File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention
    $Random_Number      = md5(rand() * time()); //Random number to be added to name.
    $FileExt = str_replace('.', '', $File_Ext);
    if($FileExt == 'mp3'){
      $spFileName = "audio";
    }else if($FileExt == 'mp4'){
      $spFileName = "video";
    }else if($FileExt == "pdf"){
      $spFileName = "pdf";
    }else{
      $spFileName = "document";
    }
    $NewFileName 		= $spFileName."-".$Random_Number.$File_Ext; //new file name
    //var_dump($tmpName);
    //var_dump($UploadDirectory.$NewFileName);die;
    if(copy($tmpName, $UploadDirectory.$NewFileName )){
      //die('Success! File Uploaded.');
    } else {
      return array('success' => false, 'message' => 'Failed to move the uploaded file.');
    }
    insertQ('insert into sppostingpicsartcraft (spPostingPic, spPostings_idspPostings) values (?, ?)', 'si', ["http://" . $_SERVER['HTTP_HOST']."/upload/".$NewFileName, $postid]);
    $result = $p->create($postid, $albumid, $NewFileName, $FileExt, $pid, $File_Name);
    if ($result) {
      return array('success' => true);
    } else {
      return array('success' => false, 'message' => 'Error in associating the file with posting.');
    }
  } else {
    return array('success' => false, 'message' => 'File size is zero or invalid.');
  }
}

header('Content-Type: application/json');
//echo $p->ta->sql;
?>
