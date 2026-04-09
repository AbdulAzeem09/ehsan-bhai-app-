<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


   // $senderprofileid = $_POST['senderprofileid'];
    $user_id = $_POST['user_id'];
     $offset = $_POST['offset'];
/*print_r($_POST);*/

//print_r($sell_type);
    $u = new _spuser;
    $res = $u->read($_POST["user_id"]);
    //echo $u->ta->sql;
    if($res != false){
        $ruser = mysqli_fetch_assoc($res);

        //print_r($ruser);
        $username = $ruser["spUserName"]; 
        $userpnone = $ruser["spUserCountryCode"].$ruser["spUserPhone"]; 
        $useremail = $ruser["spUserEmail"]; 
        $useraddress = $ruser["spUserAddress"];
        $usercountry = $ruser["spUserCountry"]; 
        $userstate = $ruser["spUserState"]; 
        $usercity = $ruser["spUserCity"]; 
        $address = $ruser["address"]; 
        $isPhoneVerify = $ruser["is_phone_verify"];
        $twostep = $ruser["twostep"];
        $userrefferalcode = $ruser["userrefferalcode"];

        
    }

              $limit = 10;
               if($offset > 0 ){

                  $offset = $limit * $offset;
               } 
 
                                   $reffral =   $u->readrefferaluser($userrefferalcode);

                                              // echo $u->ta->sql;

                                                   if($reffral != false){

                                                   while ($refuser = mysqli_fetch_assoc($reffral)) {



                                                    $proposting = new _productposting;

                                                    $proposted =   $proposting->refferaluserproduct($refuser['idspUser']);

                                                   /* echo $proposting->ta->sql;*/

                                                    $product = mysqli_fetch_assoc($proposted);

                                                    //print_r($proposted);
                                                     $conn = _data::getConnection();

                                                      

                                                     $sql="SELECT * FROM `reffaralaward`";

                                                     $award = mysqli_query($conn, $sql);

                                                    $awardprice = mysqli_fetch_assoc($award);

                                                     $ammount = $awardprice['ammount'];
                                                     $awardpro = $awardprice['totalproduct'];

                                                     if($proposted->num_rows > 0){

                                                      $projectpost = $proposted->num_rows;

                                                     }else{

                                                      $projectpost = 0;

                                                     }



                                                     if($projectpost >= $awardpro){

                                                   
                                                      $awardreferal = $projectpost * $ammount;
                                                      $finance = new _financereferral;


                                                      $finance_data = array('uid' =>$_POST['user_id'],
                                                                            'userrefferalid ' =>$refuser['idspUser'],
                                                                            'amount' =>$awardreferal
                                                                             );

                                                    $finadded =  $finance->read($_POST['user_id'],$refuser['idspUser']);

                                                    

                                                    if(empty($finadded)){

                                                      $proposted =   $finance->create($finance_data);

                                                    }else{

/*echo "here";*/
                                                        $findata = mysqli_fetch_assoc($finadded);
                                                       /* print_r($findata['id']);
                                                         print_r($awardreferal);*/

                                                      $proposted = $finance->updateamount($awardreferal,$findata['id']);
                                                      /*  echo $finance->ta->sql;*/
                                                    }


                                                      

                                                     }else{

                                                      $awardreferal = 0;
                                                     }

                              
                                           $referdata[]= array(
                                      "spUserName"=> $refuser['spUserName'],
                                      "spUserRegDate"=> $refuser['spUserRegDate'],
                                      "projectpost"=> $projectpost,
                                      "awardreferal"=> $awardreferal,
                                      "user_id" => $_POST['user_id'],
                                      "userrefferalcode" => $userrefferalcode
                                     
                                    );
                                            
                                          }

                                          $data = array("status" => 200, "message" => "success","data"=>$referdata);
                                      
                                      }else{

                                         $data = array("status" => 1, "message" => "No Record Found.");

                                        }

   echo json_encode($data);
	
?>  