<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");
  $fc = new _freelance_chat_project;
    
  

  $pro  = array( 
                  'chat_date' => date('Y-m-d h:m'),
                  'sender_idspProfiles' => $_POST['sender_idspProfiles'],
                  'receiver_idspProfiles' => $_POST['receiver_idspProfiles'],
                  'PriceFixed' => $_POST['PriceFixed'],
                  'chat_conversation' => $_POST['chat_conversation'],
                  'bidPrice' => $_POST['bidPrice']
                

                 );


      if(!empty($_POST['bidPrice'])){

$postid = $fc->create($pro);

/*echo $fc->ta->sql;*/

 $project_data  = array( 
                 
                    'chat_date' => date('Y-m-d h:m'),
                  'sender_idspProfiles' => $_POST['sender_idspProfiles'],
                  'receiver_idspProfiles' => $_POST['receiver_idspProfiles'],
                  'PriceFixed' => $_POST['PriceFixed'],
                  'chat_conversation' => $_POST['chat_conversation'],
                  'bidPrice' => $_POST['bidPrice']
                                      
                 );

                                 
          $data = array("status" => 200, "message" => "success","data"=>$project_data);

        }else{

         $data = array("status" => 1, "message" => "No Record Found.");

        }



   echo json_encode($data);
	
?>  