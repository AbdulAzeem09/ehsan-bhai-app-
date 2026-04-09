<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


    $userid = $_POST['userid'];
    

     /*print_r($offset);*/
                                 $p = new _order;
                                $res = $p->readCartItemnew($userid);
                                    //echo $p->ta->sql;
                                      /*print_r($res);*/
                                       /*print_r($res);*/
                                      if($res != false){
                                        
                                          while ($rows = mysqli_fetch_assoc($res)) {

                                             /* print_r($rows);*/
                                               
                                              $pic = new _productpic;
                                              $result = $pic->read($rows['idspPostings']);
                                           $pict=array();
                                          if ($result != false) {
                                             /* while ($rp = mysqli_fetch_assoc($result)) {*/

                                              $rp = mysqli_fetch_assoc($result);

                                               // print_r($rp);
                                                  $pict = ($rp['spPostingPic']);
                                             /* }*/
                                          } else{
                                              $pict = " ";
                                          }

                                            $or = new _order;
                          $soldquantity  = 0;
                          $res1 = $or->quantityavailable($rows["idspPostings"]);
                          if($res1 != false)
                          {
                            while($order = mysqli_fetch_assoc($re1))
                            {
                              if($order["spOrderStatus"] == 0)
                              {
                                $soldquantity += $order["spOrderQty"];
                              } 
                                
                            }
                          }
                          $available = $totalquantity - $soldquantity;

                             $totalqtyprice = $rows['spOrderQty'] * $rows['spPostingPrice'];

                                  //echo ""

                          $price = $rows['spPostingPrice'];

                         $size= $rows['size'];

                          $totalprice+=$totalqtyprice;


                                           $productdata[]= array(
                                            
                                              "idspOrder"=> $rows['idspOrder'],
                                      "idspPostings"=> $rows['idspPostings'],
                                      "spPostingTitle"=> $rows['spPostingTitle'],
                                      "spPostingPrice"=> $rows['spPostingPrice'],
                                      "sellType"=> $rows['sellType'],
                                      "subcategory"=> $rows['subcategory'],
                                      "size"=> $rows['size'],
                                      "spOrderQty"=> $rows['spOrderQty'],
                                      "totalqtyprice"=> $rows['totalqtyprice'],
                                      "picture"=> $pict
                                     
                                    );
                                             /* $statedata[] = array('country_id' =>$row3['country_id'],'state_id' =>$row3['state_id'],'state' =>$row3['state_title']);*/
                                          }

                                          $data = array("status" => 200, "message" => "success","data"=>$productdata);
                                      }else{

                                         $data = array("status" => 1, "message" => "No Record Found.");

                                        }
                                                 


   echo json_encode($data);
	
?>  