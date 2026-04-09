<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


			     $event = array(
				                  "spPostingTitle"=>$_POST["eventtitle"],
				                  "spPostingsCountry"=>$_POST["eventcountry"],
				                  "spPostingsState"=>$_POST["eventstate"],
				                  "spPostingsCity"=>$_POST["eventcity"],
				                  "eventcategory"=>$_POST["eventcategory"],
			                      "spPostingEventOrgName"=> $_POST["eventorgname"]        
				                  
			                  );

//print_r($event);
$r = new _spevent;

$eventdata = $r->createeventapi($event);

//echo $r->ta->sql;

if ($eventdata) {

      $data = array("status" => 200, "message" => "success","data"=>$eventdata);

        }

        else{

         $data = array("status" => 1, "message" => "No Record Found.");

        }


   echo json_encode($data);

	
?>  