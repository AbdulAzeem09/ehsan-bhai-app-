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

    $postid = isset($_POST["postid"]) ? (int)$_POST["postid"] : 0;
    $pid = isset($_POST["pid"]) ? (int)$_POST["pid"] : 0;

    $fe = new _freelance_favorites;

    $ev = new _event_favorites;

      $st = new _store_favorites;
			
	$pl = new _favorites;
	$flag = 0;
	$result = $pl->readfav();

	$resultdata = $pl->readcount($postid);
	$count = $resultdata->num_rows;
	echo $count+1;
	
	



//echo"hereccxxvxcv";
	
	//	print_r($_POST["postid"]);

		//print_r($_POST["pid"]);

	  

	if($result != false)
	{
		
		while($row = mysqli_fetch_assoc($result))
		{
			if($row["spPostings_idspPostings"] == $postid && $row["spProfiles_idspProfiles"] == $pid )
			{
				
				header("Location:../publicpost/index.php");

				$flag++;
			}
		}
		
	}
	


	if($flag == 0)
	{
	 
		 $ev->addeventfavoritestimeline(array("spProfiles_idspProfiles" => $pid, "spPostings_idspPostings" => $postid, "spUserid" => $_SESSION["uid"]));
		// die('oooojhjjjoooooooo');
		//echo  $fe->ta->sql;



	}


	   /* print_r($_POST["pid"]);
		

		print_r($_SESSION["uid"]);
		echo "<br>";

		  
		print_r($_POST["postid"]);
		echo "<br>";*/
		
		 $data = array(
		 	"spProfiles_idspProfiles" => $pid,
		 	 "spPostings_idspPostings" => $postid, 
		 	 "spUserid" => $_SESSION["uid"]);

		// print_r($data);

		 $id = $ev->addeventfavorites($data);
		 
		 //echo "Unfavorite";

		//echo  $ev->ta->sql;


		 	 $storedata = array(
		 	"spProfiles_idspProfiles" => $pid,
		 	 "spPostings_idspPostings" => $postid, 
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
		 	"spprofiles_idspprofiles" => $pid,
		 	 "sppostings_idsppostings" => $postid,
			 "added_on" => $date, 
		 	 "spuser_idspuser" => $_SESSION["uid"]);

	
         $id = $pl ->addfavorites_training($timelinedata);

         $js = new _job_favorites;



	$result1 = $js->get_username($postid);
	//var_dump($result1);
	if($result1!=false){
	           $row = mysqli_fetch_assoc($result1);
               $name = $row['spProfileName']; 
	

         	 $jobdata = array(
		 	"spProfiles_idspProfiles" => $pid,
		 	 "spPostings_idspPostings" => $postid, 
			 	 "seeker_name" => $name, 
		 	 "spUserid" => $_SESSION["uid"]);


		// print_r($data);

		 $id = $js->addjobfavorites($jobdata);
}

		 $ca = new _classified_fav;

         	 $jobdata = array(
		 	"spProfiles_idspProfiles" => $pid,
		 	 "spPostings_idspPostings" => $postid, 
		 	 "spUserid" => $_SESSION["uid"]);

		// print_r($data);

		 $id = $ca->addclassfavorites($jobdata);
