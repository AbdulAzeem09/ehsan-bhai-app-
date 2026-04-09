
<?php
//print_r($_POST); die;
/* function sp_autoloader($class){
  include '../mlayer/' . $class . '.class.php';
  }
  spl_autoload_register("sp_autoloader");
  $p = new _postings;
  if(isset($_POST["idspPostings"]))
  {
  $postid = $p->update( $_POST, "WHERE t.idspPostings =" . $_POST["idspPostings"]);
  echo trim($_POST["idspPostings"]);
  }

  else
  {
  if($_POST["spProfiles_idspProfiles"]!=""){
  if(isset($_POST["spPostingAlbum_idspPostingAlbum_"]))
  $postid = $p->post($_POST, $_FILES, $_POST["spPostingAlbum_idspPostingAlbum_"]);
  else
  $postid = $p->post($_POST, $_FILES);
  echo trim($postid);
  }
  } */
require_once $_SERVER["DOCUMENT_ROOT"].'/common.php';
session_start();
function sp_autoloader($class)
{
  include '../mlayer/' . $class . '.class.php';
}

/*print_r($_POST);
exit;*/
//print_r($_FILES);
spl_autoload_register("sp_autoloader");
$p = new _postingsartcraft;


//print_r($_POST);
if ($_POST["discountphoto"] == "") { 

  $_POST["discountphoto"] = $_POST["spPostingPrice"];
}


if (isset($_POST["idspPostings"]) && $_POST["idspPostings"] != '') {
  unset($_POST['spProfileName']);
  unset($_POST['carrerhighlight']);
  unset($_POST['category']);
  $postid = $p->update($_POST, "WHERE t.idspPostings =" . $_POST["idspPostings"]);
 /// print_r($postid);
  echo trim($_POST["idspPostings"]);
} else {
  if(isset($_POST['spProfileName']) && $_POST['spProfileName'] !== "") {
    insertQ("update spprofiles set spProfilesDefault = ? where spUser_idspUser = ?", "ii", [0, $_SESSION['uid']]);
    $arr = [];
    $arr[] = $_POST['spProfileName'];
    $arr[] = 3;
    $arr[] = $_SESSION['uid'];
    $arr[] = isset($_SESSION['email']) ? $_SESSION['email'] : "";
    $arr[] = 1;

    $pid = insertQ("insert into spprofiles (spProfileName, spProfileType_idspProfileType, spUser_idspUser, spProfileEmail, spProfilesDefault) values (?, ?, ?, ?, ?)", "siisi", $arr);
    $_POST['spProfiles_idspProfiles'] = $pid;
    $proArr = [];
    $proArr[] = $pid;
    if(!empty($_POST['carrerhighlight'])){
      $proArr[] = $_POST['carrerhighlight'];
    } else {
      echo "Carrer highlights cannot be empty";die;
    }
    if(!empty($_POST['category'])){
      $proArr[] = $_POST['category'];
    } else {
      echo "Carrer Category cannot be empty";die;
    }
    $proArr[] = "";
    $proArr[] = "";
    $proArr[] = "";
    $proArr[] = "";
    $proArr[] = "";
    $proArr[] = "";
    $proArr[] = 0;
    $proArr[] = "";
    insertQ("insert into spprofessional_profile (spprofiles_idspProfiles, highlights, category, spProfileWebsite, spProfileAbout, spProfileeducation, sphobbies, sptags, spCertification, spExperience, splanguagefluency) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", "issssssssis", $proArr);
  }
  unset($_POST['spProfileName']);
  unset($_POST['carrerhighlight']);
  unset($_POST['category']);
  $postid = $p->post($_POST, $_FILES);
  echo trim($postid);
}








?>
