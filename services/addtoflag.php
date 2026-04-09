	
<?php
session_start();
	include('../univ/baseurl.php');
	function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");


    $f = new _flagpost;
    $id = $f->create($_POST);
    // flag the post
    $p = new _classified;
    $p->updateFlag($_POST['spPosting_idspPosting']);
    // $p = new _postingview;
    //$p->updateFlag($_POST['spPosting_idspPosting']);
     $_SESSION['count'] = 0;
     $_SESSION['data'] = "success";
     $_SESSION['err'] = "Flagged Successfully.";
    $re = new _redirect;
    //$re->redirect($BaseUrl."/services/");

    $re->redirect($BaseUrl."/services/detail.php?postid=".$_POST['spPosting_idspPosting']);
?>
		