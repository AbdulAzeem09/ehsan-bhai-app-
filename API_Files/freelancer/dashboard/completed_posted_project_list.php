<?php
  //echo"here";
  include '../../../univ/baseurl.php';


      function sp_autoloader($class) {
      include '../../../mlayer/' . $class . '.class.php';
    }

    
    spl_autoload_register("sp_autoloader");


$profile_id = $_POST['profile_id'];
    
                                         $sf  = new _freelancerposting;

                                    //   $res = $p->myCmpPro(5, $_SESSION['pid']);

                                         $res = $sf->myCmpletePro1(5, $profile_id);

                                        $i = 1;
                                        if($res){
           
       while($row = mysqli_fetch_assoc($res)){
                                                //$dt = new DateTime($row['spPostingExpDt']);
                                               
                                             //  echo "<pre>";
                                              // print_r($row);

                                         /* print_r($row);*/
                                                $f = new _spprofiles;

                                                $pro = $f->read($row['receiver_idspProfiles']);

                                                $pro_data = mysqli_fetch_assoc($pro);

                                                /*print_r($pro_data['spProfileName']);*/
                                                $dt = new DateTime($row['spPostingExpDt']);

                                                //echo $sf->ta->sql;
                                            

                                                      

                                                          $fc = new _freelance_recomndation;
                            $check = $fc->checkreview($profile_id,$row['id']);

                          /*  print_r($check);*/
                            $row21 = mysqli_fetch_assoc($check);
                             if($check->num_rows <= 0){

                              $review = 0;

                             }else{

                              $review = $row21['desc_recomndation'];

                             }

                              $sfbid = new  _freelance_placebid;

                                          // $respos = $pos->totalbids($_GET['project']);

                                          //$respos = $sfbid->totalbids1($_GET['project']);
                           // $bids = $po->totalbids($_GET['project']);

                             $bids = $sfbid->totalbids1($row['idspPostings']);
                            //echo $sf->ta->sql;
                            if($bids){
                                $totalbids = $bids->num_rows;
                            }else{
                                $totalbids = 0;
                            }

                                             


                     $completedata[]= array(
                                      "idspPostings"=> $row['idspPostings'],
                                      "spPostingTitle"=> $row['spPostingTitle'],
                                      "totalbids"=> $totalbids,
                                      "spPostingExpDt"=> $row['spPostingExpDt'],
                                      "spPostingPrice"=> $row['spPostingPrice']
                                      


                                    );

}




                          

          $data = array("status" => 200, "message" => "success","data"=>$completedata);

        }else{

         $data = array("status" => 1, "message" => "No Record Found.");

        }



   echo json_encode($data);
  
?>  