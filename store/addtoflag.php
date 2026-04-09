	
<?php


	include('../univ/baseurl.php');
	function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");


    $f = new _flagpost;
    $id = $f->create($_POST);

    $spPosting_idspPosting = isset($_POST['spPosting_idspPosting']) ? (int)$_POST['spPosting_idspPosting'] : 0;   
 
    // flag the post
    $p = new _postingview;
    $p->updateFlag($spPosting_idspPosting);

    $re = new _redirect;
    $re->redirect($BaseUrl."/store/detail.php?catid=1&postid=".$spPosting_idspPosting);







    
?>
		
