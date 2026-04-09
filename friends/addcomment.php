<?php
    include('../univ/baseurl.php');
    function sp_autoloader($class){
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    
    $p = new _comment;
    $re = new _redirect;
   $p6 = new _spprofiles;

$rpvt6 = $p6->read($_POST["profileid"]);

$profilename = array('spPostings_idspPostings' => $_POST["spPostings_idspPostings"], 'spProfiles_idspProfiles'=>$_POST["spProfiles_idspProfiles"],'userid'=>$_POST["userid"],  'comment'=>$_POST["comment"]);

  $profile=  $_POST['profileid'];
    if(isset($_POST["idComment"]) && !empty($_POST["idComment"]) ){
        $p->updatecpmment($_POST["comment"],$_POST["idComment"]);
        if(isset($_POST['grouptimelines_']) && $_POST["grouptimelines_"] == 1){

            //header("Location:../grouptimelines/");
            $loc = $BaseUrl.'/grouptimelines';
            $re->redirect($loc);
        }else{

            $loc = $BaseUrl.'/timeline';
            $re->redirect($loc);
        }
        
    }else{
        if($_POST['comment'] == ""){

            //header("location:".$BaseUrl."/details");
            $loc = $BaseUrl.'/timeline';
            $re->redirect($loc);
        }else{

            $p->comment($profilename);
            if(isset($_POST['grouptimelines_']) && $_POST["grouptimelines_"] == 1){
                //header("Location:../grouptimelines/");
                $loc = $BaseUrl.'/grouptimelines';
                $re->redirect($loc);
            }else{
   


             
             $url = $BaseUrl."/friends/?profileid=$profile";
               
$re->redirect($url);            }
            //header("Location:../timeline/");
        }
    }
    
    
?>