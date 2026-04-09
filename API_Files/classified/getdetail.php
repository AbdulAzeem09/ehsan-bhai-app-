<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


    $idspPostings = $_POST['idspPostings'];


                                  $p = new _classified;
                             

                                     $res = $p->singletimelines($idspPostings);
                                     
                                      //echo $p->ta->sql;
                                      if($res != false){
                                          while ($rows = mysqli_fetch_assoc($res)) {

                                            //print_r($rows);
                                              
                                              $pic = new _classifiedpic;
                                              $result = $pic->read($rows['idspPostings']);
                                           $pict=array();
                                          if ($result != false) {
                                              while ($rp = mysqli_fetch_assoc($result)) {

                                              //$rp = mysqli_fetch_assoc($result);

                                                //print_r($rp);
                                                  $pict[] = ($rp['spPostingPic']); 
                                              }
                                          } else{
                                              $pict = " ";
                                          }

                                           $productdata[]= array(
                                      "idspPostings"=> $rows['idspPostings'],
                                      "spPostingTitle"=> $rows['spPostingTitle'],
                                      "spCategories_idspCategory"=> $rows['spCategories_idspCategory'],
                                      "spPostingVisibility"=> $rows['spPostingVisibility'],
                                      "spProfiles_idspProfiles"=> $rows['spProfiles_idspProfiles'],
                                      "spPostingsCountry"=> $rows['spPostingsCountry'],
                                      "spPostingsState"=> $rows['spPostingsState'],
                                      "spPostingsCity"=> $rows['spPostingsCity'],
                                      "spPostingExpDt"=> $rows['spPostingExpDt'],
                                      "spPostingAlbum_idspPostingAlbum"=> $rows['spPostingAlbum_idspPostingAlbum'],
                                      "spPostCountry"=> $rows['spPostCountry'],
                                      "spPostState"=> $rows['spPostState'],
                                      "spPostPostalCode"=> $rows['spPostPostalCode'],
                                      "spPostSelection"=> $rows['spPostSelection'],
                                      "spPostSerComty"=> $rows['spPostSerComty'],
                                      "spPostingTitle"=> $rows['spPostingTitle'],
                                      "spPostingNotes"=> $rows['spPostingNotes'],
                                      "spPostingAgree"=> $rows['spPostingAgree'],
                                      "spPostShowPhone"=> $rows['spPostShowPhone'],
                                      "spPostShowEmail"=> $rows['spPostShowEmail'],
                                      "spPostingDate"=> $rows['spPostingDate'],
                                      "picture"=> $pict
                                     
                                    );
                                             /* $statedata[] = array('country_id' =>$row3['country_id'],'state_id' =>$row3['state_id'],'state' =>$row3['state_title']);*/
                                          }

                                          $data = array("status" => 200, "message" => "success","data"=>$productdata);
                                      }else{

                                         $data = array("status" => 1, "message" => "No Record Found.");

                                        }
                                                 
                             echo json_encode($data);
	
?>  