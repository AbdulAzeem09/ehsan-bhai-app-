<?php
    session_start();
    include('../../univ/baseurl.php');

    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");

    
    $h = new _help;
    if (isset($_POST['btnCreate'])) {
        $pid        = $_POST['pid'];
        $spCategory = $_POST['spCategory'];
        $txtTitle   = $_POST['txtTitle'];
        $txtDesc    = $_POST['txtDesc'];
        
        $data = array(
            "spCategories_idspCategory" => $spCategory,
            "spProfiles_idspProfile"    => $pid,
            "help_title"                => $txtTitle,
            "help_desc"                 => $txtDesc
        );

        $result = $h->create($data);
        //echo $p->ta->sql;
        
        $_SESSION['count'] = 0;
        $_SESSION['errorMessage'] = "<strong>Success!</strong> Ticket created Successfully!";

        $re = new _redirect;
        $re->redirect("help.php");
        
    }else if(isset($_GET['id']) && $_GET['id'] > 0){
        $id = $_GET['id'];
        $result = $h->delete($id);

        $_SESSION['count'] = 0;
        $_SESSION['errorMessage'] = "Deleted Successfully!";

        $re = new _redirect;
        $re->redirect("help.php");
    }else{
        $_SESSION['count'] = 0;
        $_SESSION['errorMessage'] = "Entered incorrect path";

        $re = new _redirect;
        $re->redirect("help.php");
    }
    
    
?>