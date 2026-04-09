<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


 $categoryId = $_POST['categoryId'];
   $co = new _spAllStoreForm;
    $result3 = $co->readInSubCategory($categoryId);

      if($result3){

           
while($rows = mysqli_fetch_assoc($result3)){


//print_r($rows);

 $freelancedata[]= array(
                                      "idsubCategory"=> $rows['idsubCategory'],
                                      "idinsubcategory"=> $rows['idinsubcategory'],
                                      "insubcatTitle"=> $rows['insubcatTitle'],
                                      "insubstatus"=> $rows['insubstatus']
                                  
                                     
                                    );

}




                          

          $data = array("status" => 200, "message" => "success","data"=>$freelancedata);

        }else{

         $data = array("status" => 1, "message" => "No Record Found.");

        }



   echo json_encode($data);
	
?>  