<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


    $profileid = $_POST['profileid'];
   /* $reciverprofileid = $_POST['profileid'];*/
     $offset = $_POST['offset'];
/*print_r($_POST);*/

//print_r($sell_type);


              $limit = 10;
               if($offset > 0 ){
                  //$offset = $offset 

                  $offset = $limit * $offset;
               } 
     /*print_r($offset);*/
                                  $p = new _freelance_project_status;
                               
                                     $res = $p->myAssignProject($profileid);
                                     
                                
                                  
                                                    //echo $p->ta->sql;
                                      if($res != false){
                                          while ($row = mysqli_fetch_assoc($res)) {

                                              $sf = new _freelancerposting;

                               /*$result = $p->singletimelines($row['spPosting_idspPostings']);*/

                                      $result = $sf->singletimelines1($row['spPosting_idspPostings']);


                                                if($result){
                                                    $row2 = mysqli_fetch_assoc($result);


                                                 

                                                  }


                              
                                           $awarddata[]= array(
                                      "spPosting_idspPostings"=> $row['spPosting_idspPostings'],
                                      "spPostingTitle"=> $row2['spPostingTitle'],
                                      "fps_price"=> $row['fps_price'],
                                      "spProfiles_idspProfiles"=> $row['spProfiles_idspProfiles'],
                                      "fps_start_date"=> $row['fps_start_date'],
                                      "status"=> $row['status']
      
                                    );
                                            
                                          }

                                          $data = array("status" => 200, "message" => "success","data"=>$awarddata);
                                      
                                      }else{

                                         $data = array("status" => 1, "message" => "No Record Found.");

                                        }

   echo json_encode($data);
	
?>  