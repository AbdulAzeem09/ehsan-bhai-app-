      <?php
  //echo"here";
  include '../../../univ/baseurl.php';


      function sp_autoloader($class) {
      include '../../../mlayer/' . $class . '.class.php';
    }

    
    spl_autoload_register("sp_autoloader");




     $fc = new _freelancerposting;
    //print_r($_GET);
  $fc->updatecompletestatus($_GET['postid'],$_GET['status']);

     
    if (!empty($_POST['status'])){

             

                         
                                    
                                    $freelancedata[]= array(
                                      "idspPostings"=> $_POST['postid'],
                                      "complete_status"=> $_POST['status']
                                     
                                    );
                         

                              $data = array("status" => 200, "message" => "success","data"=>$freelancedata);

        }else{

         $data = array("status" => 1, "message" => "No Record Found.");

        }




      echo json_encode($data);
       