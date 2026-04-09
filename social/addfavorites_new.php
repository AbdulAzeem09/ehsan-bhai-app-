<?php
/*error_reporting(E_ALL);
ini_set('display_errors', 'On');*/
	session_start();
	function sp_autoloader($class){
				include '../mlayer/' . $class . '.class.php';
			}
			spl_autoload_register("sp_autoloader");

 //echo "herecode";

/*	print_r($_POST["postid"]);

    print_r($_POST["pid"]);*/

//print_r($_POST);
//die('ss');



    $fe = new _freelance_favorites;

    $ev = new _event_favorites;

      $st = new _store_favorites;
			
	$pl = new _favorites;
	$flag = 0;
	$result = $pl->readfav();



//echo"hereccxxvxcv";
	
	//	print_r($_POST["postid"]);

		//print_r($_POST["pid"]);

	  

	if($result != false)
	{
		
		while($row = mysqli_fetch_assoc($result))
		{
			if($row["spPostings_idspPostings"] == $_POST["postid"] && $row["spProfiles_idspProfiles"] == $_POST["pid"])
			{
				header("Location:../publicpost/index.php");
				$flag++;
			}
		}
	}
	


	if($flag == 0)
	{
	 
		 $ev->addeventfavoritesdetail(array("spProfiles_idspProfiles" => $_POST["pid"], "spPostings_idspPostings" => $_POST["postid"], "spUserid" => $_SESSION["uid"]));
		// die('oooojhjjjoooooooo');
		//echo  $fe->ta->sql;



	}


	   /* print_r($_POST["pid"]);
		

		print_r($_SESSION["uid"]);
		echo "<br>";

		  
		print_r($_POST["postid"]);
		echo "<br>";*/
		
		 $data = array(
		 	"spProfiles_idspProfiles" => $_POST["pid"],
		 	 "spPostings_idspPostings" => $_POST["postid"], 
		 	 "spUserid" => $_SESSION["uid"]);

		// print_r($data);

		 //$id = $ev->addeventfavorites($data); 
		 
		 //echo "Unfavorite";

		//echo  $ev->ta->sql;


		 	 $storedata = array(
		 	"spProfiles_idspProfiles" => $_POST["pid"],
		 	 "spPostings_idspPostings" => $_POST["postid"], 
		 	 "spUserid" => $_SESSION["uid"]);

		// print_r($data);

		 $id = $st->addstorefavorites($storedata);

		//echo  $st->ta->sql;
		/*$u = new _spuser;
		$res = $u->read($_SESSION["uid"]);
		if($res != false){
			$ruser = mysqli_fetch_assoc($res);
			
			$time_zone = $ruser["time_zone"]; 
			
		}*/
		
		//$date = date('Y-m-d H:i:s',strtotime($time_zone.'hours'));
		$date = date('Y-m-d H:i:s');
		
		
		 	 $timelinedata = array(
		 	"spprofiles_idspprofiles" => $_POST["pid"],
		 	 "sppostings_idsppostings" => $_POST["postid"],
			 "added_on" => $date, 
		 	 "spuser_idspuser" => $_SESSION["uid"]);

	
         $id = $pl ->addfavorites_training($timelinedata);

         $js = new _job_favorites;



	$result1 = $js->get_username($_POST["postid"]);
	//var_dump($result1);
	if($result1!=false){
	           $row = mysqli_fetch_assoc($result1);
               $name = $row['spProfileName']; 
	

         	 $jobdata = array(
		 	"spProfiles_idspProfiles" => $_POST["pid"],
		 	 "spPostings_idspPostings" => $_POST["postid"], 
			 	 "seeker_name" => $name, 
		 	 "spUserid" => $_SESSION["uid"]);


		// print_r($data);

		 $id = $js->addjobfavorites($jobdata);
}

		 $ca = new _classified_fav;

         	 $jobdata = array(
		 	"spProfiles_idspProfiles" => $_POST["pid"],
		 	 "spPostings_idspPostings" => $_POST["postid"], 
		 	 "spUserid" => $_SESSION["uid"]);

		// print_r($data);

		 $id = $ca->addclassfavorites($jobdata);
