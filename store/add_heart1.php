<?php
    session_start();

    include '../univ/baseurl.php';

    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");

    $fv = new _store_favorites;
    

    $data = array("spProfiles_idspProfiles"=>$_SESSION['pid'],
        "spPostings_idspPostings"=>$_POST['postid'],
        "spUserid"=>$_SESSION['uid'],
);

    $res_fv = $fv->addstorefavorites($data);

   

?>    