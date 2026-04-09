<?php
session_start();
function sp_autoloader($class)
{
  include '../mlayer/' . $class . '.class.php';
}
require_once "../common.php";

spl_autoload_register("sp_autoloader");
$p = new _postings;

// print_r($_POST); exit; //-- ganesh

$_POST['spPostingDate']=date('Y-m-d h:i:s');
if ($_POST["spCategories_idspCategory"] == 16) {
  

  $maxChars = 1000; // Maximum character limit
  $maxEmojis = 10;  // Maximum emoji limit
  // Get submitted content (assuming you are using POST method)
  $submittedContent = $_POST['spPostingNotes'] ?? '';
  // Trim whitespace
  $submittedContent = trim($submittedContent);
  // Validate total number of characters
  $totalChars = mb_strlen($submittedContent, 'UTF-8'); // Count characters in UTF-8 encoding
  // Validate number of emojis using regex
  $emojiRegex = '/(\p{Emoji_Presentation}|\p{Extended_Pictographic})/u';
  preg_match_all($emojiRegex, $submittedContent, $matches);
  $emojiCount = count($matches[0]); 
  // Check for character limit violation
  if ($totalChars > $maxChars) {
      die('Error: Content exceeds the maximum character limit of ' . $maxChars);
  }

  // Check for emoji limit violation
  if ($emojiCount > $maxEmojis) {
      die('Error: Content exceeds the maximum emoji limit of ' . $maxEmojis);
  }




  $arr = [];
  $arr[] = isset($_POST['groupid']) ? $_POST['groupid'] : 0;
  $arr[] = isset($_POST['spCategories_idspCategory']) ? (int) trim($_POST['spCategories_idspCategory']) : 0;
  $arr[] = isset($_POST['spPostingVisibility']) ? (int) trim($_POST['spPostingVisibility']) : 0;
  $arr[] = isset($_POST['spProfiles_idspProfiles']) ? (int) trim($_POST['spProfiles_idspProfiles']) : 0;
  $arr[] = $_POST['spPostingDate'];
  $arr[] = isset($_POST['spPostingNotes']) ? htmlspecialchars(trim($_POST['spPostingNotes'])) : '';
  if (isset($_POST["idspPostings"])) {
    $postid = $p->update($_POST, "WHERE t.idspPostings =" . $_POST["idspPostings"]);
    echo trim($_POST["idspPostings"]);
  } else {
    if ($_POST["spProfiles_idspProfiles"] != "") {
      $postid = insertQ('insert into sppostings (groupid, spCategories_idspCategory, spPostingVisibility, spProfiles_idspProfiles, spPostingDate, spPostingNotes) values (?, ?, ?, ?, ?, ?)', 'iiiiss', $arr);
      echo $postid;
    }
    else { echo "Posting failed";}
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
    $postid = $p->update_training($data, $id);
    echo trim($_POST["idspPostings"]);
  }
   else {

    $postid = $p->create_training($data);
    echo trim($postid);
  }
}


?>
