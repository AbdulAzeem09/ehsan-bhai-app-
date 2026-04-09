	
<?php
	include('../univ/baseurl.php');
	function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

$postid=$_POST['spPosting_idspPosting'];
    $f = new _flagpost;
    $id = $f->create($_POST);
    // flag the post
    $p = new _postingview;
    $p->updateFlag($_POST['spPosting_idspPosting']);

    $re = new _redirect;
    $re->redirect($BaseUrl."/trainings/?msg=flag_success");
?>
		