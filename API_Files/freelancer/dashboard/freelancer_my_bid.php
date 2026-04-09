<?php
	//echo"here";
	include '../../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


   /* $offset = $_POST['offset'];*/

    $profile_id = $_POST['profile_id'];

 
		//$device_id = $_POST['device_id'];
         //$device_type = $_POST['device_type'];






                $sf = new _freelancerposting;
 //print_r($profile_id);

                                      // print_r($_SESSION['pid']);

                                    //  $res = $p->myBidProject(5, $_SESSION['pid']);


                                       $res = $sf->myBidProject1(5, $profile_id);


                                                  //echo "here";

                                                  //echo $sf->ta->sql;


                                                    if(!empty($res)){
                                                        
                                                        while($rows = mysqli_fetch_assoc($res)){


                                                            // $sf  = new _freelancerposting;

$fe = new _freelance_favorites;

                                  $re = $fe->read($rows['idspPostings']);
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
/*$res = $sf->read($_POST['idspPostings']);
                                  
                            

                                      $rows = mysqli_fetch_assoc($res);*/




                                                            $bids[]  = array(
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