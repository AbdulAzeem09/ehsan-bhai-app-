      <?php
  //echo"here";
  include '../../../univ/baseurl.php';


      function sp_autoloader($class) {
      include '../../../mlayer/' . $class . '.class.php';
    }

    
    spl_autoload_register("sp_autoloader");




    $profile_id = $_POST['profile_id'];  



     
    if (!empty($_POST['postid'])){

               $fc = new _freelance_chat_project;
   /* print_r($_POST);*/
  $fc->updaterequeststatus($_POST['postid'],$_POST['status']);

                      



                                    
                                    $freelancedata[]= array(
                                      "idspPostings"=> $_POST['postid'],
                                      "status"=> $_POST['status']
                                    );
                           
                       

                              $data = array("status" => 200, "message" => "success","data"=>$freelancedata);

        }else{

         $data = array("status" => 1, "message" => "No Record Found.");

        }




      echo json_encode($data);
       