      <?php
  //echo"here";
  include '../../../univ/baseurl.php';


      function sp_autoloader($class) {
      include '../../../mlayer/' . $class . '.class.php';
    }

    
    spl_autoload_register("sp_autoloader");




    $post_id = $_POST['postid'];  
  $sf  = new _milestone;
                                        //$res = $p->myExpireProduct(5, $_SESSION['pid']);
                                          $res = $sf->checkmilestone($post_id);


     
    if ($res != false){

             

                            while ($rows = mysqli_fetch_assoc($res)) {

//print_r($rows);

 $f = new _spprofiles;

                                                $pro = $f->read($rows['receiver_idspProfiles']);
                                                $pro_data = mysqli_fetch_assoc($pro);
                                    
                                    $freelancedata[]= array(
                                      "id"=> $rows['id'],
                                      "freelancer_projectid"=> $pro_data['freelancer_projectid'],
                                      "payment_gross"=> $rows['payment_gross'],
                                      "description"=> $rows['description'],
                                      "freelancer_profileid"=> $rows['freelancer_profileid'],
                                      "bussiness_profile_id"=> $rows['bussiness_profile_id'],
                                      "request_status"=> $rows['request_status'],
                                      "created"=> $rows['created'],
                                      "pay_id"=> $rows['pay_id'],
                                      "payer_email"=> $rows['payer_email'],
                                      "txn_id"=> $rows['txn_id'],
                                      "mc_currency"=> $rows['mc_currency'],

                                    );
                           
                            }

                              $data = array("status" => 200, "message" => "success","data"=>$freelancedata);

        }else{

         $data = array("status" => 1, "message" => "No Record Found.");

        }




      echo json_encode($data);
       