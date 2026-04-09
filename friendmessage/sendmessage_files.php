<?php
	//die('===========');
error_reporting(E_ALL);
ini_set('display_errors', '1');

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

date_default_timezone_set('Asia/Kolkata');
require_once('../helpers/image.php');
//print_r($_FILES);

//if(!empty($_FILES['files'])){
		
	/*	$count =count($_FILES['sale_file']);
		
		for($i=0;$i<$count-1;$i++)
		{*/

$image = new Image;
$image->validateFileImageExtensions($_FILES['files']);
		
	$name = $_FILES['files']['name'];
	//echo $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);die;
$tmp_name = $_FILES['files']["tmp_name"];	
move_uploaded_file($tmp_name,  "uploads/".$name);
//$ext = pathinfo($name, PATHINFO_EXTENSION);

  $temp= explode('.',$name);
  $extension = end($temp);
  //echo $extension;
  //die;
if(($extension=='png')|| ($extension=='jpg')|| ($extension=='jpeg'))
{
	$file_type=1;
}
if($extension=='mp4'){
	$file_type=3;
}
if(($extension=='mp3')||($extension=='m4a')){
	$file_type=2;
}
if($extension=='pdf'){
	$file_type=4;
}
$files=array(
"spfriendChattingMessage"=>$name,
"spprofiles_idspProfilesSender"=>$_POST["sender"],
"spprofiles_idspProfilesReciver"=>$_POST["receiver"],
"spMessageDate"=>date("Y-m-d H:i:s"),
"spfriendChattingUnread"=>0,
"msg_type"=>2,
"file_type"=>$file_type
);

$post= new _friendchatting;
$fi=$post->create_files($files);

		//}
		
		
?>
