<?php
  //echo"here";
  include '../../univ/baseurl.php';


      function sp_autoloader($class) {
      include '../../mlayer/' . $class . '.class.php';
    }

 spl_autoload_register("sp_autoloader");

    $pic = new _postingpic;
    $result3 = $pic->readimage($_POST["profile_id"]);
    //echo $pic->ta->sql;
    if($result3 != false)
    {
     
        while($row3 = mysqli_fetch_assoc($result3)){

         // print_r($row3);

          

        $postingpic = ($row3['spPostingPic']);


        /*
          if(isset($row3["spPostingPic"])){
        
          
          }*/

     $postingdata[]= array("idspPostingPic"=>$row3['idspPostingPic'],
      "spPostingPic"=>$postingpic);
                                     
      }
   $data = array("status" => 200, "message" => "success","data"=>$postingdata);

                                // print_r($timelinedata);

                               }else{

                                $data = array("status" => 1, "message" => "No Photos Found.");
                               }
                      





   echo json_encode($data);
  
?>  