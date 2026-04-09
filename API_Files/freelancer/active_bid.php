<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


$profile_id = $_POST['profile_id'];
     $sf  = new _freelancerposting;

                                // print_r($_SESSION['pid']);

                                // $res = $p->client_publicpost(5, $_SESSION['pid']);

                                  $res = $sf->client_publicpost_posting(5, $profile_id);

                                        //echo $sf->ta->sql;

                                        $i = 1;
                                        if($res){
           
       while($row = mysqli_fetch_assoc($res)){
                                                $dt = new DateTime($row['spPostingExpDt']);
                                               
                                             //  echo "<pre>";
                                              // print_r($row);

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
                                      "spPostingExpDt"=> $row['spPostingExpDt']

                                    );

}




                          

          $data = array("status" => 200, "message" => "success","data"=>$biddata);

        }else{

         $data = array("status" => 1, "message" => "No Record Found.");

        }



   echo json_encode($data);
	
?>  