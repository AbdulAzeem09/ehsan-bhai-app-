<?php
    
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

   // print_r($_POST['postid']);
  
    $s = new _sponsorpic;

    $re = new _redirect;
    
   // print_r($_POST["sponsorId"]);

   // print_r($_POST);

    if(isset($_POST["idspSponsor"]) && $_POST['idspSponsor'] > 0){

     // print_r($_POST);

       $idspSponsor = $_POST['idspSponsor'];

        $id = $s->updateSponsor($_POST, "WHERE idspSponsor =" .  $_POST['idspSponsor']);
       echo $id;

   
       $redirctUrl = $BaseUrl . "/events/dashboard/sponsor-list.php";

       $re->redirect($redirctUrl);

    }else{
      //print_r($_POST);

       $id = $s->createsp($_POST);  
       echo $id;

       $redirctUrl = $BaseUrl . "/events/dashboard/sponsor-list.php";

       $re->redirect($redirctUrl);

    }
    
    


    
    
?>