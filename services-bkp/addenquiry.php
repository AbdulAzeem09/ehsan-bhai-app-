	
<?php
   session_start();
	include('../univ/baseurl.php');
	function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

	$p = new _addServiceEnq;
    $id = $p->create($_POST);
    
    $_SESSION['count'] = 0;
     $_SESSION['data'] = "success";
     $_SESSION['err'] = "Enquiry Added Successfully.";
    $re = new _redirect;
   
    $re->redirect($BaseUrl."/services/dashboard/myenquiry.php");
    //$re->redirect($BaseUrl."/services/dashboard/detail.php?postid=".$_POST['spPosting_idspPosting']);
?>
		