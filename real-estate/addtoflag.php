	
<?php
	include('../univ/baseurl.php');
	function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_POST['spPosting_idspPosting'] = isset($_POST['spPosting_idspPosting']) ? (int) $_POST['spPosting_idspPosting'] : 0;

    $f = new _flagpost;
    $id = $f->create($_POST);

    // flag the post
    $p = new _postingview;
    $p->updateFlag($_POST['spPosting_idspPosting']);

    $re = new _redirect;
    $re->redirect($BaseUrl."/real-estate/property-detail.php?postid=".$_POST['spPosting_idspPosting']);
?>
		
