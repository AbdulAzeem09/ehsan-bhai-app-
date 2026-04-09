<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");
  $f = new _flagpost;

  $pro  = array( 
                  'spPosting_idspPosting' => $_POST['spPosting_idspPosting'],
                  'spProfile_idspProfile' => $_POST['spProfile_idspProfile'],
                  'spCategory_idspCategory' => 5,
                  'why_flag' => $_POST['why_flag'],
                  'flag_desc' => $_POST['flag_desc']

                 );




      if(!empty($_POST['why_flag'])){


    $id = $f->create($pro);

 $project_data  = array( 
                  'flag_id' => $id,
                  'spPosting_idspPosting' => $_POST['spPosting_idspPosting'],
                  'spProfile_idspProfile' => $_POST['spProfile_idspProfile'],
                  'spCategory_idspCategory' => 5,
                  'why_flag' => $_POST['why_flag'],
                  'flag_desc' => $_POST['flag_desc']

                 );


                          

          $data = array("status" => 200, "message" => "success","data"=>$project_data);

        }else{

         $data = array("status" => 1, "message" => "Enter ");

        }



   echo json_encode($data);
	
?>  