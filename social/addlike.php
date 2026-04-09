<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
session_start();
function sp_autoloader($class){
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$conn = _data::getConnection();
$reactionId = isset($_POST["Reaction_id"]) ? (int)$_POST["Reaction_id"] : 7;
$postid = isset($_POST["spPostings_idspPostings"]) ? (int)$_POST["spPostings_idspPostings"] : "";
$uid = $_SESSION['uid'];
$profId = $_SESSION['pid']; 

if(!$postid){
  die("Bad data");
}

$pl = new _postlike;
$r = $pl->likeread($postid, $profId, $uid);

if (!empty($r) && $r->num_rows > 0) {
$row22 = $r->num_rows;

if($row22 > 0){

$sql = "UPDATE splike SET Reaction_id = $reactionId WHERE spPostings_idspPostings = $postid AND spProfiles_idspProfiles = $profId AND uid= $uid";


mysqli_query($conn, $sql);
echo 0;

} }else {

$pl->addlike(array("spProfiles_idspProfiles" => $profId, "spPostings_idspPostings" => $postid, "uid" => $uid, "Reaction_id" => $reactionId));
echo 1;
}

?>
