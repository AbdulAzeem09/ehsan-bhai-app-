<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


   /* $offset = $_POST['offset'];*/

    $profile_id = $_POST['profile_id'];

   // print_r($profile_id);
		//$device_id = $_POST['device_id'];
         //$device_type = $_POST['device_type'];




           //$start = 0;
        $limit = 10;
               if($offset > 0 ){
                  //$offset = $offset 

                  $offset = $limit * $offset;
               } 

   $sf = new  _freelance_placebid;

                                          // $respos = $pos->totalbids($_GET['project']);


                                                

                                                   // print_r($row3);
                                                    //get bid detail
                                                    
                                                   

                                                     //echo $d->ta->sql;
                                                    
                                                /*$result_pf = $pos->allbids($row3['spProfiles_idspProfiles'], $_GET['project']);*/
                                                   
                                                 $bd = new  _freelance_placebid;

                                                  // print_r( $row3['idspPostings']);

                                         $result_pf = $bd->readallbids($_POST['idspPostings']);


                                                  //echo "here";

                                                  //echo $bd->ta->sql;


                                                    if($result_pf){
                                                        $bidPrice = "";
                                                        $totalDays = "";
                                                        
                                                        while($row2 = mysqli_fetch_assoc($result_pf)){
 $d = new _spprofiles;
                                                    $freelancerName = $d->getProfileName($row2['spProfiles_idspProfiles']);
                                                         // print_r($row2);
                                                            if($bidPrice == ""){
                                                                /*if($row2['spPostFieldName'] == 'bidPrice'){*/
                                                                $bidPrice = $row2['bidPrice'];
                                                                /*}*/
                                                            }
                                                            if($totalDays == ""){
                                                                /*if($row2['spPostFieldName'] == 'totalDays'){*/
                                                             $totalDays = $row2['totalDays'];
                                                               /* }*/
                                                            }

                                                             $sf  = new _freelancerposting;

$fe = new _freelance_favorites;

                                  $re = $fe->read($_POST['idspPostings']);
if ($re != false) {
while ($rw = mysqli_fetch_assoc($re)) {
if ($rw['spProfiles_idspProfiles'] == $profile_id) {

       $favourites =true;

}else{
  $favourites =false;
}
/*print_r($rw);*/
}
}else{
$favourites =false;
}
$res = $sf->read($_POST['idspPostings']);
                                  
                            

$rows = mysqli_fetch_assoc($res);







                                                            $bids[]  = array("spProfiles_idspProfiles" => $row2['spProfiles_idspProfiles'],
                                                            	"idspPostings"=>$_POST['idspPostings'],
                                                            	"bidPrice"=>$bidPrice,
                                                            	"totalDays"=>$totalDays ,
                                                            	"freelancerName"=>$freelancerName,
                                                            	  "idspPostings"=> $rows['idspPostings'],
							                                      "spPostingTitle"=> $rows['spPostingTitle'],
							                                      "spPostingNotes"=> $rows['spPostingNotes'],
							                                      "spPostingExpDt"=> $rows['spPostingExpDt'],
							                                      "spPostingPrice"=> $rows['spPostingPrice'],
							                                      "spPostingVisibility"=> $rows['spPostingVisibility'],
							                                      "spPostingDate"=> $rows['spPostingDate'],
							                                      "spCategories_idspCategory"=> $rows['spCategories_idspCategory'],
							                                      "spProfiles_idspProfiles"=> $rows['spProfiles_idspProfiles'],
							                                      "sppostingscommentstatus"=> $rows['sppostingscommentstatus'],
							                                      "spPostingCategory"=> $rows['spPostingCategory'],
							                                      "spPostInSubCategory"=> $rows['spPostInSubCategory'],
							                                      "spPostExperienceLevl"=> $rows['spPostExperienceLevl'],
							                                      "spPostingSkill"=> $rows['spPostingSkill'],
							                                      "spPostingPriceHourly"=> $rows['spPostingPriceHourly'],
							                                      "spPostingPriceFixed"=> $rows['spPostingPriceFixed'],
							                                      "favourites"=> $favourites
                                                            );

                                                        } 
                                                   
                                               
                                                 $data = array("status" => 200, "message" => "success","data"=>$bids);
                                            }else{

         $data = array("status" => 1, "message" => "No Record Found.");

        }



   echo json_encode($data);
	
?>  