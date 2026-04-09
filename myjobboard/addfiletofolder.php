<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/

include("../univ/baseurl.php");
include("../helpers/image.php");

function sp_autoloader($class){
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$p = new _postingalbum;

  if(isset($_FILES['spPostingMedia']['name'])){
    // Validate file extension
    $image = new Image();
    $image->validateFileVideoExtensions($_FILES['spPostingMedia']);
   
    
    // If validation passes, proceed with upload
    $file_tmp_name = $_FILES['spPostingMedia']['tmp_name'];
    $str = file_get_contents($file_tmp_name);
    $b64img=($str);
    $orext = pathinfo($_FILES['spPostingMedia']['name'], PATHINFO_EXTENSION);
    $folder = "images/";
    $data = $_FILES['spPostingMedia']['name'];
    move_uploaded_file($_FILES['spPostingMedia']["tmp_name"], "$folder".$_FILES['spPostingMedia']["name"]);

    $txtFolerName = $_POST["txtFolerName"];		
    $album = new _album;
    $res = $album->readresume($_POST["profileid"]);
      if($res != false){
        $row = mysqli_fetch_assoc($res);
        $albumid = $row["idspPostingAlbum"];
      }
      else{
        $albumid = $album->resumealbum($_POST["profileid"]);
      }			
    $createdate = date('Y-m-d');
    $mediaid = $p->addfile($data , $_POST["mediatitle"],$_POST["profileid"] , $albumid , $orext , $orext ,$_POST["grpid"], $txtFolerName);
}

// Redirect after upload
$re = new _redirect;
$location = $_POST['backPageUrl'];
$re->redirect($location);
?>
