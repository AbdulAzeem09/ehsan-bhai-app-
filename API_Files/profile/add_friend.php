

    <?php


  include '../../univ/baseurl.php';


      function sp_autoloader($class) {
      include '../../mlayer/' . $class . '.class.php';
    }

    
    spl_autoload_register("sp_autoloader");





$sender = $_POST["sender"];;
$reciever = $_POST["reciever"];
$flag = $_POST['flag'];

  //echo $po->ta->sql;
  
  if(!empty($sender)){
      $s = new _spprofilehasprofile;  
  $result = $s->checkfriend($_POST["sender"],$_POST["reciever"]);
  if($result != false){
    if($flag == 'NULL'){
      //friend request pending
      $status = '';
      $s->againSendRequest($_POST["sender"],$_POST["reciever"], $status);
   

    }else if($flag == 1){
      //friends ko unfrnd krna ha.
      
      
    }else if($flag == -1){
      //request rejected
      $status = '-1';
      $s->againSendRequest($_POST["sender"],$_POST["reciever"], $status);
     
    }
    
  }else{
    $s->create($_POST["sender"],$_POST["reciever"]);
  
  }
$profiedata = array("sender"=> $sender,"reciever"=>$reciever);

     $data = array("status" => 200, "message" => "success","data"=>$profiedata);
  }else{

    $data = array("status" => 1, "message" => "No sender found");
  } 



echo json_encode($data);

?>