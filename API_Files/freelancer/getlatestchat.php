<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


    $senderprofileid = $_POST['senderprofileid'];
    $reciverprofileid = $_POST['reciverprofileid'];
    $after_date = $_POST['after_date'];
     $offset = $_POST['offset'];
/*print_r($_POST);*/

//print_r($sell_type);


              $limit = 10;
               if($offset > 0 ){
                  //$offset = $offset 

                  $offset = $limit * $offset;
               } 
     /*print_r($offset);*/
                                  $p = new _spchat;
                               
                                     $res = $p->latestchat($after_date,$senderprofileid,$reciverprofileid,$offset,$limit);
                                     
                                
                                  
                                                    //echo $p->ta->sql;
                                      if($res != false){
                                          while ($rows = mysqli_fetch_assoc($res)) {

                              
                                           $chatdata[]= array(
                                      "spfriendChattingMessage"=> $rows['spfriendChattingMessage'],
                                      "spprofiles_idspProfilesSender"=> $rows['spprofiles_idspProfilesSender'],
                                      "spprofiles_idspProfilesReciver"=> $rows['spprofiles_idspProfilesReciver'],
                                      "spMessageDate"=> $rows['spMessageDate'],
                                      "idspfriendChatting"=> $rows['idspfriendChatting']
                                     
                                    );
                                            
                                          }

                                          $data = array("status" => 200, "message" => "success","data"=>$chatdata);
                                      
                                      }else{

                                         $data = array("status" => 1, "message" => "No Record Found.");

                                        }

   echo json_encode($data);
	
?>  