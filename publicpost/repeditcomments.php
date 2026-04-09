<?php
function sp_autoloader($class){
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$re = new _redirect;
$p6 = new _spprofiles;

$rpvt6 = $p6->read($_POST["profileid"]);
$profileid=$_POST['postid'];




$p = new _comment_reply();
$comment=$_POST['replycomment'];

$commentid=$_POST['repid'];


$p->updatecpmment($comment,$commentid);

$url = $BaseUrl."/publicpost/post_comment_details.php?postid=$profileid";

$re->redirect($url);

?>