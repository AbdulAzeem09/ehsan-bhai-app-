<?php
session_start();
		function sp_autoloader($class){
				include '../mlayer/' . $class . '.class.php';
			}
			spl_autoload_register("sp_autoloader");
 //echo "herecode";

/*	print_r($_POST["postid"]);

    print_r($_POST["pid"]);*/



	$re = new _freelance_favorites;

	 $ev = new _event_favorites;


	  $st = new _store_favorites;
$pl = new _favorites;
	//print_r($_POST["postid"]); 

      $js = new _job_favorites;

       $ca = new _classified_fav;
	$re->removefavorites1($_POST["postid"], $_SESSION['uid']);

	
	// echo $re->ta->sql;


		// print_r($data);

		 $id = $ev->removeeventfavoritesdetail_del($_POST["postid"], $_SESSION['uid'],$_SESSION['pid']);

		//echo  $ev->ta->sql;

		  $id = $st->removestorefavorites($_POST["postid"], $_SESSION['uid'],$_POST["pid"]);

		  $id = $js->removejobfavorites($_POST["postid"], $_SESSION['uid'],$_SESSION['pid']);
		  $id = $ca->removeclassfavorites($_POST["postid"], $_SESSION['uid'],$_SESSION['pid']);

		 $id = $pl->removefavorites_training($_POST["postid"], $_SESSION['uid']); 

		// echo $js->ta->sql;
?>