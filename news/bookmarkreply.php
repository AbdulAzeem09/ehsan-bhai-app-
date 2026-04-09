<?php



error_reporting(E_ALL);
ini_set('display_errors', 'On');

include '../univ/baseurl.php';
session_start();


	function sp_autoloader($class)
	{
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	$obj=new _spprofiles;
	
	
	  $a=$_POST['comment_id'];
	  $b=$_SESSION['uid'];
	  $c=$_SESSION['pid'];
	
	
	$res=$obj->readreplybookmarkdata($b,$c,$a) ;
	//print_r($res);
	//die("@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@");
	if($res!=false){
	
		$obj->deletereplybookmarkdata($b,$c,$a) ;
         echo "<span class='fa fa-star' style='color:gray'></span>";
	}
	
	
else{	
	  
	   $data=array(
	   
	   'reply_id'=>$a,
	   'uid'=>$b,
	   'pid'=>$c,
	 
	   );
	   
	 $obj->createreplybookmarkdata( $data);
	   echo "<span class='fa fa-star' style='color:blue'></span>";
}
			
	
	 
	 
	?>
	


   