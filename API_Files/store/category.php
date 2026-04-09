<?php
  //echo"here";
  include '../../univ/baseurl.php';


      function sp_autoloader($class) {
      include '../../mlayer/' . $class . '.class.php';
    }

    
    spl_autoload_register("sp_autoloader");





  
     
                                                                           $m = new _subcategory;
                                                                            $catid = 1;
                                                                            $result = $m->read($catid);
                                                                            if($result){
                                                                                while($rows = mysqli_fetch_assoc($result)){ 

                                                                                  /* print_r($rows);*/

                                                                                   $categorydata[] = $rows['subCategoryTitle'];
                                                                                   /* $categorydata[] = array('category' =>$rows['subCategoryTitle']);*/

                                                                                }

                                                                                  $data = array("status" => 200, "message" => "success","data"=>$categorydata);
                                                                            }else{

                                                                               $data = array("status" => 1, "message" => "No Record Found.");

                                                                              }
                                                                                       


   echo json_encode($categorydata);
  
?>  