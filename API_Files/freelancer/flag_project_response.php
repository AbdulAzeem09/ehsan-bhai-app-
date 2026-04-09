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

 $f  = new _flagpost;

                            
  $sf  = new _freelancerposting;

                                        
                                       // $res = $pq->myflagresponse($_GET['categoryId'], $_SESSION['pid']);
                                        $res = $sf->myflagresponse1(5, $profile_id);

   if($res){
                                            while($row = mysqli_fetch_assoc($res)){




                                     
                                        $res1=  $f->myflagresponsenew(5, $row['idspPostings']);
//echo $f->ta->sql;
                                                while($row1 = mysqli_fetch_assoc($res1)){










 $flagresponse[]= array(
                                      "idspPostings"=> $row['idspPostings'],
                                      "spPostingTitle"=> $row['spPostingTitle'],
                                     
                                      "admin_comment"=> $row1['admin_comment']
                                     
                                     
                                    );






}




                                   
                            }

                              $data = array("status" => 200, "message" => "success","data"=>$flagresponse);

        }else{

         $data = array("status" => 1, "message" => "No Record Found.");

        }



   echo json_encode($data);
  
?>  