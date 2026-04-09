	
<?php
	include('../univ/baseurl.php');
	function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    
   // print_r($_POST);

    $f = new _flagpost;
    $id = $f->create($_POST);

    // flag the post
    $p = new _postingview;
    $p->updateFlag($_POST['spPosting_idspPosting']);

    $re = new _redirect;
    session_start();
    $_SESSION['count'] = 0;
    $_SESSION['data'] = "success";
    $_SESSION['errorMessage'] = "Flagged Successfully";
    $re->redirect($BaseUrl."/freelancer/project-detail.php?project=".$_POST['spPosting_idspPosting']);
     
?>
		