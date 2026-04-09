	
<?php
 session_start();
	include('../univ/baseurl.php');
	function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");



  /*  print_r($_POST);*/


    $f = new _flageventpost;
    $id = $f->create($_POST);
    
  /*  echo $f->ta->sql;exit;*/

    // flag the post
    $p = new _postingview;
    $p->updateFlag($_POST['spPosting_idspPosting']);

   $_SESSION['count'] = 0;
    $_SESSION['errorMessage'] = "<strong>Success!</strong> Event Flagged Successfully!";
    $re = new _redirect;
    $re->redirect($BaseUrl."/grouptimelines/group-eventdetail.php?postid=".$_POST['spPosting_idspPosting']);
?>
		