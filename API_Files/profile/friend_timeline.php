<?php
  //echo"here";
  include '../../univ/baseurl.php';


      function sp_autoloader($class) {
      include '../../mlayer/' . $class . '.class.php';
    }

    
    spl_autoload_register("sp_autoloader");


                         
                          $timeline = new _postings;
                          $resultr = $timeline->readtimelines($_POST["profile_id"]);

                         // echo $timeline->ta->sql;
                          if($resultr != false){

                            while($rows = mysqli_fetch_assoc($resultr)){
                                  

                                   // print_r($rows['idspPostings']);


                              $pp = new _spprofiles;
          $rpvt = $pp->read($rows['spProfiles_idspProfiles']);
          //echo $p->ta->sql;
          if ($rpvt != false){
            $row = mysqli_fetch_assoc($rpvt);
            //print_r($row);
            $name     = $row["spProfileName"];
            $picture  = $row['spProfilePic'];
            $about    = $row["spProfileAbout"];
            $phone    = $row["spProfilePhone"];
            $phonestatus    = $row["phone_status"];
            $emailstatus    = $row["email_status"];
            $relationship_status    = $row["relationship_status"];
            $uid = $row["spUser_idspUser"];

          
            $city     = $row["spProfilesCity"];
            $profiletype    = $row["spProfileType_idspProfileType"];
            $profileTypeName  = $row['spProfileTypeName'];
            $icon     = $row["spprofiletypeicon"];
            $ptypeid  = $row["idspProfileType"];
            $email    = $row["spProfileEmail"];
            $location   = $row["spprofilesLocation"];
            $language   = $row["spprofilesLanguage"];
            $address  = $row["spprofilesAddress"];
            $profileaddress   = $row["address"];
          }

                                        $pic = new _postingpic;
                        $result = $pic->read($rows['idspPostings']);
                        //echo $pic->ta->sql;
                        $pict=array();
                        if ($result != false) {
                            while ($rp = mysqli_fetch_assoc($result)) {

                             // print_r($rp);
                                $pict[] = ($rp['spPostingPic']);
                            }
                        } else{
                            $pict = " ";
                        }
                //print_r($pict);


                        $media = new _postingalbum;
                        $result1 = $media->read($rows['idspPostings']);
                        //echo $media->ta->sql;
                        //print_r($result);
                        $media = array();
                        if (!empty($result1)) {

                          while ($r = mysqli_fetch_assoc($result1)) {
                            //$r = mysqli_fetch_assoc($result);
                            
                            $sppostingmediaTitle = $r['sppostingmediaTitle'];
                             $sppostingmediaExt = $r['sppostingmediaExt'];
                             
                           /*  echo "here";
                               print_r($r);*/

                              // https://thesharepage.com/upload/

                             

                               $file=  $BaseUrl .'/upload/'.$sppostingmediaTitle;
                             
                             $media[] = array('sppostingmediaTitle' => $file,'sppostingmediaExt' => $sppostingmediaExt );

                           }
                               
                               }else{
                                
                                $media = array();
                               
                               }

                               

                                    //print_r($rows);
                                    $timelinedata[]= array(
                                      "idspPostings"=> $rows['idspPostings'],
                                      "spPostingDate"=> $rows['spPostingDate'],
                                      "spPostingNotes"=> $rows['spPostingNotes'],
                                      "idspProfiles"=> $rows['spProfiles_idspProfiles'],
                                      "spProfileName"=> $name,
                                      "spUser_idspUser"=> $uid,
                                      "spProfileType_idspProfileType"=>$profiletype,
                                      "media"=> $media,
                                      "picture"=> $pict
                                     
                                    );
                              }    
                                 
                                 $data = array("status" => 200, "message" => "success","data"=>$timelinedata);

                                // print_r($timelinedata);

                               }else{

                                $data = array("status" => 1, "message" => "No Post Found.");
                               }
                      





   echo json_encode($data);
  
?>  