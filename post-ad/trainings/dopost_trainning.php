
<?php

/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
//print_r($_POST); die;
session_start();


print_r($_POST);
function sp_autoloader($class)
{
  include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$p = new _postings;
if ($_POST["spCategories_idspCategory"] == 16) {
  //print_r($_POST);
  //die("++++");

  if (isset($_POST["idspPostings"])) {
    $postid = $p->update($_POST, "WHERE t.idspPostings =" . $_POST["idspPostings"]);
    echo trim($_POST["idspPostings"]);
  } else {
    if ($_POST["spProfiles_idspProfiles"] != "") {
      if (isset($_POST["spPostingAlbum_idspPostingAlbum_"]))
        $postid = $p->post($_POST, $_FILES, $_POST["spPostingAlbum_idspPostingAlbum_"]);
      else
        $postid = $p->post($_POST, $_FILES);
      echo trim($postid);
    }
  }
}




if ($_POST["spCategories_idspCategory"] == 8) {


  $c = $p->default_currency($_SESSION['uid']);
  if ($c != false) {
    $curr = mysqli_fetch_assoc($c);
    $default_currency = $curr['currency'];
  }

  //print_r($_POST); die("=========");
  $id = $_POST['idspPostings'];
  $data = array(
    "spuser_idspuser" => $_SESSION['uid'],
    "spprofiles_idspprofiles" => $_SESSION['pid'],
    "spPostingTitle" => $_POST['spPostingTitle'],
    "trainingcategory" => $_POST['trainingcategory_'],
    "spPostingCompany" => $_POST['spPostingCompany_'],
    "musiccost_type" => $_POST['musiccost_'],
    "spPostingPrice" => $_POST['spPostingPrice'],
    "txtDiscount" => $_POST['txtDiscount_'],
    "videolevel" => $_POST['videolevel_'],
    "totalhour" => $_POST['totalhour_'],
    "spPostingTraimnerBio" => $_POST['spPostingTraimnerBio_'],
    "spRequiremnt" => $_POST['spRequiremnt_'],
    "outline" => $_POST['outline_1'],
    "spPostingNotes" => $_POST['spPostingNotes'],
    "default_currency" => $default_currency,
    "status" => $_POST['spPostingVisibility'],
    "chkAcknw" => 1

  );

  if (isset($_POST["idspPostings"]) && $_POST["idspPostings"] != '') {
    die("+++++11111111");
    $postid = $p->update_training($data, $id);
    echo trim($_POST["idspPostings"]);
  } else {
    die("+++++");
    $postid = $p->create_training($data);
    echo trim($postid);
    die("+++++");
  }
}


?>
