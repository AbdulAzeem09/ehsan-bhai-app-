      <?php
  //echo"here";
  include '../../../univ/baseurl.php';


      function sp_autoloader($class) {
      include '../../../mlayer/' . $class . '.class.php';
    }

    
    spl_autoload_register("sp_autoloader");




    $profile_id = $_POST['profile_id'];  
 $sf  = new _freelance_chat_project;
                                        //$res = $p->myExpireProduct(5, $_SESSION['pid']);
                                          $res = $sf->getbussinesConversation($profile_id);


     
    if ($res != false){

             

                            while ($rows = mysqli_fetch_assoc($res)) {

//print_r($rows);


 $f = new _spprofiles;

                                                $pro = $f->read($rows['receiver_idspProfiles']);
                                                $pro_data = mysqli_fetch_assoc($pro);

                                                       $fi = new _spfreelancer_profile;
                                            $result_fi = $fi->read($rows['receiver_idspProfiles']);

                                            $row_fi = mysqli_fetch_assoc($result_fi);

                                         
                        

                                              $skills = $row_fi['skill'];
                                               $perhour = $row_fi['hourlyrate'];
                                    
                                    $freelancedata[]= array(
                                      "idspPostings"=> $rows['id'],
                                      "receiver_idspProfiles"=> $rows['receiver_idspProfiles'],
                                      "sender_idspProfiles"=> $rows['sender_idspProfiles'],
                                      "spProfileName"=> $pro_data['spProfileName'],
                                      "bidPrice"=> $rows['bidPrice'],
                                      "PriceFixed"=> $rows['PriceFixed'],
                                      "created"=> $rows['chat_date'],
                                      "status"=> $rows['status'],
                                      "complete_status"=> $rows['complete_status'],
                                      "skill"=> $row_fi['skill'],
                                      "hourlyrate"=> $row_fi['hourlyrate'],
                                      "chat_conversation"=> $rows['chat_conversation']
                                    );
                           
                            }

                              $data = array("status" => 200, "message" => "success","data"=>$freelancedata);

        }else{

         $data = array("status" => 1, "message" => "No Record Found.");

        }




      echo json_encode($data);
       