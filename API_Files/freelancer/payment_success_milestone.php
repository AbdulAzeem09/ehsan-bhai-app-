<?php

echo "string";
	include '../../univ/baseurl.php';

	//session_start();
	function sp_autoloader($class) {
		include '../../mlayer/' . $class . '.class.php';
	}


	spl_autoload_register("sp_autoloader");
	
   $fc = new _payment_milestone;
   /* echo "<pre>";
   print_r($_REQUEST);*/

/*   $pay = array(
                   "payer_email" => $_REQUEST['payer_email'],
                   "post_id" => $_REQUEST['postid'],
                   "txn_id" => $_REQUEST['txn_id'],
                   "mc_currency" => $_REQUEST['mc_currency'],
                   "payment_gross" => $_REQUEST['payment_gross'],
                   "payment_date" => $_REQUEST['payment_date']

               );*/




if(!empty($_REQUEST['txn_id'])){
 

     $fc = new _payment_milestone;
   /* echo "<pre>";
   print_r($_REQUEST);*/

   $pay = array(
                   "payer_email" => $_REQUEST['payer_email'],
                   "post_id" => $_REQUEST['postid'],
                   "txn_id" => $_REQUEST['txn_id'],
                   "mc_currency" => $_REQUEST['mc_currency'],
                   "payment_gross" => $_REQUEST['payment_gross'],
                   "payment_date" => $_REQUEST['payment_date']

               );
  $fc->create($pay);

           $data = array("status" => 200, "message" => "success","data"=>$pay);
          
           }else{

         $data = array("status" => 1, "message" => "No Record Found.");

        }

   echo json_encode($data);
    

    
?>


