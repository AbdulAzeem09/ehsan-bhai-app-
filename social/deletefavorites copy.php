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
	//print_r($_POST);

      $js = new _job_favorites;



       $ca = new _classified_fav;

	

	
	// echo $re->ta->sql;

	if ($_POST['model1'] == 'real') { 
		// die('xxxxxxx');
   $idd = $pl->remove_unfav_realstate1111($_POST["postid"]);   

//    echo $idd->tb->sql;
//    die('---');

	}else{ 
		
        $re->removefavorites1($_POST["postid"], $_SESSION['uid']);
		// print_r($data);

		 $id = $ev->removeeventfavorites($_POST["postid"], $_SESSION['uid'],$_SESSION['pid']);

		//echo  $ev->ta->sql;

		  $id = $st->removestorefavorites($_POST["postid"], $_SESSION['uid'],$_SESSION["pid"]);

		  $id = $js->removejobfavorites($_POST["postid"], $_SESSION['uid'],$_SESSION['pid']);
		  $id = $ca->removeclassfavorites($_POST["postid"], $_SESSION['uid'],$_SESSION['pid']);

		 $id = $pl->removefavorites_training($_POST["postid"], $_SESSION['uid']); 

		 $id1 = $pl->removefavorites_art($_POST["postid"], $_SESSION['uid']);
		 
		 $pt1 = $pl->removevideofavorites_del($_POST["postid"], $_SESSION['uid']);

		 $resultdata = $pl->readcount($_POST["postid"]);
		 $count = $resultdata->num_rows;
		 echo $count-1;


		// echo $js->ta->sql;

		}
?>