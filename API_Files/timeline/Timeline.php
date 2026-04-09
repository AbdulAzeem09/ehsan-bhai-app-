<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");

		$profile_id = $_GET['profile_id'];
    $offset = $_GET['offset'];

    //$profile_id = $_GET['profile_id'];

   // print_r($profile_id);
		//$device_id = $_GET['device_id'];
         //$device_type = $_GET['device_type'];
          $hp = new _hidepost;
            $results = $hp->getPost($profile_id );
           //echo $hp->ta->sql;
            $hidepost = array();
            if($results != false){
                while ($rowh = mysqli_fetch_assoc($results)) {
                    array_push($hidepost, $rowh['spPostings_idspPostings']);
                }
            }


        $p = new _postings;

           //$start = 0;
        $limit = 5;
               if($offset > 0 ){
                  //$offset = $offset 

                  $offset = $limit * $offset;
               } 

             $start = date('Y-m-d', strtotime('-7 days'));

                $res = $p->globaltimelinesProfileapi($offset,$limit, $profile_id,$start);
                //echo $p->ta->sql;
                //print_r($res);

        if ($res != false){

           while ($timeline = mysqli_fetch_assoc($res)) {
                 
                 //echo"<pre>";
               //  print_r($timeline);

                  if(in_array($timeline['idspPostings'], $hidepost)){
                       // echo "hi";
                    
                    }else{

                      //echo "here";
                       //  $media[] = array();
                          
                        $_GET["timelineid"] = $timeline['idspPostings'];

                        $res2 = $p->singletimelinespost($_GET["timelineid"]);

                         
                          if ($res2 != false){
                                    
                                   while ($rows = mysqli_fetch_assoc($res2)) 
                                   {

                                   // print_r($rows['idspPostings']);

                                        $pic = new _postingpic;
                        $result = $pic->read($rows['idspPostings']);
                        //echo $pic->ta->sql;
                        $pict=array();
                        if ($result != false) {
                            while ($rp = mysqli_fetch_assoc($result)) {

                             // print_r($rp);
                                $pict[] = $rp['spPostingPic'];
                            }
                        } else{
                            $pict = " ";
                        }
                //print_r($pict);


                        $media = new _postingalbum;
                        $result1 = $media->read($rows['idspPostings']);
                        //echo $media->ta->sql;
                        //print_r($result);

                        $pic = new _postingpic;
                        $result = $pic->read($rows['idspPostings']);
                        //echo $pic->ta->sql;
                        $pict=array();
                        //$media = array();
                        if (!empty($result1)) {

                          while ($r = mysqli_fetch_assoc($result1)) {
                            //$r = mysqli_fetch_assoc($result);
                            
                            $sppostingmediaTitle = $r['sppostingmediaTitle'];
                             $sppostingmediaExt = $r['sppostingmediaExt'];
                             
                           /*  echo "here";
                               print_r($r);*/

                              // https://dev.thesharepage.com/upload/

                             

                               $file=  $BaseUrl .'/upload/'.$sppostingmediaTitle;
                             
                             $media = array('sppostingmediasrc' => $sppostingmediaTitle,'sppostingmediaExt' => $sppostingmediaExt );

                           }
                               
                               }                
                        else if ($result != false) {
                            while ($rp = mysqli_fetch_assoc($result)) {

                             // print_r($rp);
                                $media = array('spPostingPic' => $rp['spPostingPic'],'sppostingmediaExt' => "base64" );;
                            }
                        }else{
                                
                                $media = NULL;
                               
                               }


                                 $pr = new _spprofiles;
                                 $rpvt = $pr->read($rows['spProfiles_idspProfiles']);
                                       // echo $pr->ta->sql;
                                        if ($rpvt != false){
                                            while($row = mysqli_fetch_assoc($rpvt)) {

                                                 //print_r($row);
                                             
                                             $blob_data = $row['spProfilePic'];
                                              //print_r($blob_data);


                                            
                                                $idspProfiles=$row['idspProfiles'];
                                                
                                                $spProfileName=$row['spProfileName'];
                                                $spUser_idspUser=$row['spUser_idspUser'];
                                                $idspProfileType=$row['idspProfileType'];
                                                $spProfileTypeName=$row['spProfileTypeName'];
                                                if(!empty($row['spProfilePic'])){
                                                	$spProfilePic=$blob_data;
                                                }else{

                                                	$spProfilePic=NULL;
                                                }
                                                
                                            

                                            }

                                        //$data = array("status" => 200, "message" => "success","data"=>$profile_data);
                                        }

                               
                                    $pl = new _postlike;
                                    $r = $pl->readnojoin($rows['idspPostings']);

                                    if ($r != false) {

                                    	while ($row3 = mysqli_fetch_assoc($r)) {

                                            
                                            if ($row3['spProfiles_idspProfiles'] == $profile_id) {

                                                $liked = True;

                                            }else{

                                            	$liked = false;

                                            }
                                    	}


                                    }else{

                                        $liked = false;
                                    }


                                            $pl = new _favorites;
                                    $re = $pl->read($rows['idspPostings']);

                                    if ($re != false) {

                                    	while ($rw = mysqli_fetch_assoc($re)) {

                                            
                                            if ($rw['spProfiles_idspProfiles'] == $profile_id) {

                                                $favorite = True;

                                            }else{

                                            	$favorite = false;

                                            }
                                    	}


                                    }else{

                                        $favorite = false;
                                    }

									///////////////

									  $c = new _comment;
                            $result = $c->read($rows['idspPostings']);
                            
                            $totalcmt = 0;
                            if ($result != false) {
                                $totalcmt = $result->num_rows;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $profilename = $row["spProfileName"];
                                    $comment = $row["comment"];
                                    $picture = $row["spProfilePic"];
                                    //$date = $row["commentdate"];
                                }

							}
						///////////////////////////

                                    //print_r($rows);
                                    $timelinedata[]= array(
                                      "idspPostings"=> $rows['idspPostings'],
                                      "spPostingDate"=> $rows['spPostingDate'],
                                      "spPostingNotes"=> $rows['spPostingNotes'],
                                      "idspProfiles"=> $rows['spProfiles_idspProfiles'],
                                      "spProfileName"=> $spProfileName,
                                      "spUser_idspUser"=> $spUser_idspUser,
                                      "spProfileType_idspProfileType"=> $idspProfileType,
                                      "media"=> $media,
                                      "spProfilePic"=> $spProfilePic,
                                      "liked"=> $liked,
                                      "favorite"=> $favorite,
									  "totalcomments"=> $totalcmt
                                     
                                    );
                              }    
                                 
                                 $data = array("status" => 200, "message" => "success","data"=>$timelinedata);

                                // print_r($timelinedata);

                               }else{

                                $data = array("status" => 1, "message" => "No Post Found.");
                               }
                      



                    }


           }


        }else{

         $data = array("status" => 1, "message" => "No Record Found.");

        }


                  /*  if ($res != false){
                while ($timeline = mysqli_fetch_assoc($res)) {

                  print_r($timeline['idspPostings'])
                    if(in_array($timeline['idspPostings'], $hidepost)){
                        //echo "hi";
                    }else{
                       
                        $pstid = $timeline['idspPostings'];
                        $spid = $_SESSION['pid'];
                        $sql = "SELECT spPostings_idspPostings, spShareByWhom FROM spshare WHERE spPostings_idspPostings = $pstid AND spShareToWhom = $spid";
                        $res3 = mysqli_query($conn, $sql);
                        if($res3 != false){
                            $row3  = mysqli_fetch_assoc($res3);
                            $shareby = $row3['spShareByWhom'];
                        }
                        $_GET["timelineid"] = $timeline['idspPostings'];

                        $res2 = $p->singletimelinespost($_GET["timelineid"]);

                               if ($res2 != false){
                                    
                                   while ($rows = mysqli_fetch_assoc($res2)) 
                                   {

                               print_r($rows);

                                   }    


                               }
                      





                       // include "timelineentry.php";
                    }
                    
                }
            }else{

                 $data = array("status" => 1, "message" => "No Record Found.");

            }*/



   echo json_encode($data);
	
?>  