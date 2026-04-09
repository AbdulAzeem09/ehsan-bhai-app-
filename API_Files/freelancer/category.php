<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");



$m = new _subcategory;
              $catid = 5;
              $result = $m->read($catid);

      if($result){

           
while($rows = mysqli_fetch_assoc($result)){


 $freelancedata[]= array(
                                      "idsubCategory"=> $rows['idsubCategory'],
                                      "subCategoryTitle"=> $rows['subCategoryTitle'],
                                      "spCategories_idspCategory"=> $rows['spCategories_idspCategory'],
                                      "subCategoryStatus"=> $rows['subCategoryStatus']
                                  
                                     
                                    );

}




                          

          $data = array("status" => 200, "message" => "success","data"=>$freelancedata);

        }else{

         $data = array("status" => 1, "message" => "No Record Found.");

        }



   echo json_encode($data);
	
?>  