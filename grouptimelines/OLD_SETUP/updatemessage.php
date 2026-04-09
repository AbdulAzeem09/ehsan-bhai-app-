<?php
 include('../univ/baseurl.php');
 //die('====');
 // print_r($_POST);
 // exit();
 function sp_autoloader($class){
         include '../mlayer/' . $class . '.class.php';
     }
     spl_autoload_register("sp_autoloader");
	$m = new _spgroupmessage;
    $re = new _redirect;

if(isset($_POST['update'])){

   
   


    $id = $_POST['messageid1']; 
    $massage = $_POST['spGroupMessage1'];

    $data = array(
        'spGroupMessage' => $massage
    );
	$res = $m->updatedata($data, $id);


    $textid = $_POST['textid1'];
    $textname = $_POST['conversationText_'];

    $data1 = array(
        'spGroupConversationText' => $textname
    );

    $res = $m->updatedata1($data1, $textid);

        $groupid  = $_POST['spGroup_idspGroup1'];
        $groupname = $_POST['groupname1_'];

        $location = $BaseUrl."/grouptimelines/group-folder.php?groupid=$groupid&groupname=$groupname&disc";
        $re->redirect($location);
      
}


	

	
	


	
?>