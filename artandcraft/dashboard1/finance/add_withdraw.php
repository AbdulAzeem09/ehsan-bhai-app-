	
<?php
	include('../../univ/baseurl.php');
	function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");



   // print_r($_POST['module']);
    
    
   if ($_POST['module'] == 'event') {


       $f = new _spwithdraw;
    $id = $f->create($_POST);


    // flag the post
   
    $re = new _redirect;
    $re->redirect($BaseUrl."/dashboard/finance/event.php");
      
   }elseif ($_POST['module'] == 'store') {

       $f = new _spwithdraw;
    $id = $f->create($_POST);


    // flag the post
   
    $re = new _redirect;
    $re->redirect($BaseUrl."/dashboard/finance/store.php");
      
   }elseif ($_POST['module'] == 'private') {

       $f = new _spwithdraw;
    $id = $f->create($_POST);


    // flag the post
   
   $re = new _redirect;
 $re->redirect($BaseUrl."/dashboard/finance/privaterfq.php");
      
   }elseif ($_POST['module'] == 'public') {

       $f = new _spwithdraw;
    $id = $f->create($_POST);


    // flag the post
   
   $re = new _redirect;
 $re->redirect($BaseUrl."/dashboard/finance/publicrfq.php");
      
   }elseif ($_POST['module'] == 'GroupEvents') {

       $f = new _spwithdraw;
    $id = $f->create($_POST);


    // flag the post
   
   $re = new _redirect;
 $re->redirect($BaseUrl."/dashboard/finance/groupEvents.php");
      
   }elseif ($_POST['module'] == 'referral') {

       $f = new _spwithdraw;
    $id = $f->create($_POST);


    // flag the post
   
   $re = new _redirect;
 $re->redirect($BaseUrl."/dashboard/finance/finance.php");
      
   }

 
?>
		