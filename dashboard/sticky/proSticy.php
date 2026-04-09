<?php
session_start();
include('../../univ/baseurl.php');
include('../../common.php');
function sp_autoloader($class){
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$p = new _spAllStoreForm;
$re = new _redirect;

if (isset($_POST['btnPin'])) {
$pid = $_POST['pid'];
$pin = $_POST['txtPin'];
$result = $p->readpinvalid($pid, $pin);
if ($result) {
$row = mysqli_fetch_assoc($result);
$_SESSION['pin'] = 1;
}else{
$redirctUrl = $BaseUrl . "/dashboard/sticky/pin.php/";
$re->redirect($redirctUrl);
}


}
else if (isset($_GET['action']) && $_GET['action'] == 'modify') {
  $hidId = isset($_POST['hidId']) ? (int)trim($_POST['hidId']) : 0;
  $title = isset($_POST['spStickyTitle']) ? trim(htmlspecialchars($_POST['spStickyTitle'], ENT_QUOTES, 'UTF-8')) : '';
  $desc = isset($_POST['spStickyDes']) ? trim(htmlspecialchars($_POST['spStickyDes'], ENT_QUOTES, 'UTF-8')) : '';
  $pid = isset($_POST['spProfile_idspProfile']) ? trim($_POST['spProfile_idspProfile']) : 0;

  $params = array($title, $desc, $pid, $hidId);

  if (!empty($hidId)) {
    insertQ('UPDATE tbl_sticky_notes SET spStickyTitle=?, spStickyDes=?, spProfile_idspProfile=? WHERE idspSticky=?', 'ssii', $params);
  }

}
else if(isset($_GET['action']) && $_GET['action'] == 'delete'){
  $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
  $p->deletSticky($id);

  $redirctUrl = $BaseUrl . "/dashboard/sticky/listing.php";
  $re->redirect($redirctUrl);
  die();

}
else if (isset($_POST['btnAdd'])) { 
  $title = isset($_POST['spStickyTitle']) ? trim(htmlspecialchars($_POST['spStickyTitle'], ENT_QUOTES, 'UTF-8')) : '';
  $desc = isset($_POST['spStickyDes']) ? trim(htmlspecialchars($_POST['spStickyDes'], ENT_QUOTES, 'UTF-8')) : '';
  $pid = isset($_POST['spProfile_idspProfile']) ? trim($_POST['spProfile_idspProfile']) : 0 ;
  $type = 0;

  // add in tbl_sticy_notes;
  $params = array($title, $desc, $pid, $type);
  insertQ('INSERT INTO tbl_sticky_notes (spStickyTitle, spStickyDes, spProfile_idspProfile, spStickyVault) VALUES (?, ?, ?, ?)', 'ssii', $params);
 
}

$redirctUrl = $BaseUrl . "/dashboard/sticky/";
$re->redirect($redirctUrl);

?>
