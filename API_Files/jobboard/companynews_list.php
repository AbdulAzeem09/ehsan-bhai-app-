<?php
	
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


$profile_id = $_POST['profile_id'];
     $sf  = new _company_news;

                                // print_r($_SESSION['pid']);

                                // $res = $p->client_publicpost(5, $_SESSION['pid']);

                                  $res = $sf->readMyNews($profile_id);

                                        //echo $sf->ta->sql;

                                        $i = 1;
                                        if($res){
           
       while($rows = mysqli_fetch_assoc($res)){

        //print_r($rows);
                                                

                     $newsdata[]= array(
                                         "idcmpanynews"=> $rows['idcmpanynews'],
                                      "cmpanynewsTitle"=> $rows['cmpanynewsTitle'],
                                      "cmpanynewsDesc"=> $rows['cmpanynewsDesc'],
                                      "spProfiles_idspProfiles"=> $rows['spProfiles_idspProfiles'],
                                      "cmpanynewsdate"=> $rows['cmpanynewsdate'],
                                      "cmpanynewsStatus"=> $rows['cmpanynewsStatus']
                                    );               






}




                          

          $data = array("status" => 200, "message" => "success","data"=>$newsdata);

        }else{

         $data = array("status" => 1, "message" => "No Record Found.");

        }



   echo json_encode($data);
	
?>  