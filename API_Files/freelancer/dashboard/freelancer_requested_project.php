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
                                          $res = $sf->getfreelancerConversation($profile_id);


     
    if ($res != false){

             

                            while ($rows = mysqli_fetch_assoc($res)) {



 $f = new _spprofiles;

                                                $pro = $f->read($rows['sender_idspProfiles']);
                                                $pro_data = mysqli_fetch_assoc($pro);
                                    
                                    $freelancedata[]= array(
                                      "idspPostings"=> $rows['id'],
                                      "spProfileName"=> $pro_data['spProfileName'],
                                      "bidPrice"=> $rows['bidPrice'],
                                      "PriceFixed"=> $rows['PriceFixed'],
                                      "created"=> $rows['chat_date'],
                                      "status"=> $rows['status']
                                    );
                           
                            }

                              $data = array("status" => 200, "message" => "success","data"=>$freelancedata);

        }else{

         $data = array("status" => 1, "message" => "No Record Found.");

        }




      echo json_encode($data);
       