<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");

    //print_r($_POST['offset']);


    $offset = $_POST['offset'];

    //$profile_id = $_GET['profile_id'];

   // print_r($profile_id);
		//$device_id = $_POST['device_id'];
         //$device_type = $_POST['device_type'];
       
        $p = new _spevent;

           //$start = 0;
        $limit = 5;
               if($offset > 0 ){
                  //$offset = $offset 

                  $offset = $limit * $offset;
               } 

            

                $res = $p->publicpost_eventnewapi($offset,$limit);
              // echo $p->ta->sql;
                //print_r($res);

        if ($res != false){

         while ($row = mysqli_fetch_assoc($res)) { 
         // print_r($row);
                              $venu = $row['spPostingEventVenue'];
                                     $startDate = $row['spPostingStartDate'];
                                     $startTime = $row['spPostingStartTime'];
                                     $endTime = $row['spPostingEndTime'];
                                     $row['spPostingNotes'];
                                     $row['spPostingTitle'];

                                     $dtstrtTime = strtotime($startTime);
                                     $dtendTime = strtotime($endTime);
                                     $pic = new _eventpic;
                                        
                                        $res2 = $pic->readFeature($row['idspPostings']);
                                        $pic2 = array();
                                        if($res2 != false){
                                            if($res2->num_rows > 0){
                                                if ($res2 != false) {
                                                    $rp = mysqli_fetch_assoc($res2);
                                                    $pic2[] = ($rp['spPostingPic']);

                                                  }
                                                }
                                        }else{
                                               
                                               $pic2 = array();
                                        }

                                          $ei = new _eventIntrest;
                                        $result = $ei->chekAlready($row['idspPostings'], $_SESSION['pid']);
                                        if($result != false){
                                            $row3 = mysqli_fetch_assoc($result);
                                            $area = $row3['intrestArea'];

                                            if($area == 2){
                                              
                                                $title = "Going";
                                            }else if($area == 1){
                                                
                                                $title = "Interested";                                
                                            }else if($area == 0){
                                                
                                                $title = "May Be";
                                            }
                                        }
                                 $eventdata[]= array(
                                      "idspPostings"=> $row['idspPostings'],
                                      "spPostingTitle"=> $row['spPostingTitle'],
                                      "spPostingNotes"=> $row['spPostingNotes'],
                                      "spPostingPrice"=> $row['spPostingPrice'],
                                      "image"=> $pic2,
                                      "spPostingDate"=> $row['spPostingDate'],
                                      "spProfiles_idspProfiles"=> $row['spProfiles_idspProfiles'],
                                      "eventcategory"=> $row['eventcategory'],
                                      "spPostingEventOrgName"=> $row['spPostingEventOrgName'],
                                      "spPostingEventVenue"=>$row['spPostingEventVenue'],
                                      "hallcapacity"=> $row['hallcapacity'],
                                      "ticketcapacity"=> $row['ticketcapacity'],
                                      "spPostingStartDate"=> $row['spPostingStartDate'],
                                      "spPostingEndTime"=> $row['spPostingEndTime'],
                                      "spPostingStartTime"=> $row['spPostingStartTime'],
                                      "spPostingExpDt"=> $row['spPostingExpDt'],
                                      "intrest"=> $title,
                                      
                                     
                                    );

                                   }
                          $data = array("status" => 200, "message" => "success","data"=>$eventdata);

        }else{

         $data = array("status" => 1, "message" => "No Record Found.");

        }






   echo json_encode($data);
	
?>  