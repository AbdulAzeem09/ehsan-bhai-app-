<?php

echo "string";
	include '../../univ/baseurl.php';

	//session_start();
	function sp_autoloader($class) {
		include '../../mlayer/' . $class . '.class.php';
	}


	spl_autoload_register("sp_autoloader");
	
  $fc = new _milestone;


  $mile = array(
                   "freelancer_projectid" => $_POST['freelancer_projectid'],
                   "freelancer_profileid" => $_POST['freelancer_profileid'],
                   "bussiness_profile_id" => $_POST['bussiness_profile_id'],
                   "amount" => $_POST['amount'],
                   "hired" => 0,
                   "description" => $_POST['description'],
                   "created"=> date('Y-m-d h:i:s')
               );


	   $id = $fc->create($mile);

if(!empty($id)){


     $fc = new _payment_milestone;
   /* echo "<pre>";
   print_r($_REQUEST);*/

   $pay = array(
                   "payer_email" => $_REQUEST['payer_email'],
                   "post_id" => $id,
                   "txn_id" => $_REQUEST['txn_id'],
                   "mc_currency" => $_REQUEST['mc_currency'],
                   "payment_gross" => $_REQUEST['payment_gross'],
                   "payment_date" => $_REQUEST['payment_date']

               );
  $fc->create($pay);
 

   $payment = array(
                   "id" =>$id,
                   "freelancer_projectid" =>$_POST['freelancer_projectid'],
                   "freelancer_profileid" =>$_POST['freelancer_profileid'],
                   "bussiness_profile_id" =>$_POST['bussiness_profile_id'],
                   "amount" =>$_POST['amount'],
                   "description" =>$_POST['description'],
                   "payer_email" => $_REQUEST['payer_email'],
                   "post_id" => $id,
                   "txn_id" => $_REQUEST['txn_id'],
                   "mc_currency" => $_REQUEST['mc_currency'],
                   "payment_gross" => $_REQUEST['payment_gross'],
                   "payment_date" => $_REQUEST['payment_date']

               );


           $data = array("status" => 200, "message" => "success","data"=>$payment);
          
           }else{

         $data = array("status" => 1, "message" => "No Record Found.");

        }

   echo json_encode($data);
    

    
?>


