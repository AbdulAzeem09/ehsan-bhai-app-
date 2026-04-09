<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


$post_id = $_POST['post_id'];
     $sf  = new _freelancerposting;

                               

                                  $res = $sf->singletimelines1($post_id);

                                        //echo $sf->ta->sql;

                                        $i = 1;
                                        if($res){

                                          $row = mysqli_fetch_assoc($res);
           
/*       while($row = mysqli_fetch_assoc($res)){*/
                                                $dt = new DateTime($row['spPostingExpDt']);
                                               
                                             //  echo "<pre>";
                                            //print_r($row);

                                               // $pf = new _postfield;
                                                //$result_pf = $pf->totalbids($row['idspPostings']);

                                          $result_pf = $sf->totalbids1($row['idspPostings']);
                                                
                                                //echo $sf->ta->sql;
                                                if($result_pf){
                                                    //print_r($result_pf);
                                                    $totalBid = $result_pf->num_rows;
                                                }else{
                                                    $totalBid = 0;
                                                }
                                             


                     $biddata[]= array(
                                      "idspPostings"=> $row['idspPostings'],
                                      "spPostingTitle"=> $row['spPostingTitle'],
                                      "totalBid"=> $totalBid,
                                      "spPostingPrice"=> $row['spPostingPrice'],
                                      "spPostingExpDt"=> $row['spPostingExpDt'],
                                        "spPostingNotes"=> $row['spPostingNotes'],
                                        "spPostingDate"=> $row['spPostingDate'],
                                        "spProfiles_idspProfiles"=> $row['spProfiles_idspProfiles'],
                                        "spPostingCategory"=> $row['spPostingCategory'],
                                        "spPostInSubCategory"=> $row['spPostInSubCategory'],
                                        "spPostingSkill"=> $row['spPostingSkill'],
                                        "spPostingPriceHourly"=> $row['spPostingPriceHourly'],
                                        "spPostingPriceFixed"=> $row['spPostingPriceFixed'],
                                        "complete_status"=> $row['complete_status'],

                                    );

/*}*/




                          

          $data = array("status" => 200, "message" => "success","data"=>$biddata);

        }else{

         $data = array("status" => 1, "message" => "No Record Found.");

        }



   echo json_encode($data);
	
?>  