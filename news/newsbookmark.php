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
	
	
	  $a=trim($_POST['id']);
	// echo $a;
	 //die(")))))))))))))))))))))))))))");
	  
	  $b=$_SESSION['uid'];
	  $c=$_SESSION['pid'];  
	 // $c=$_SESSION['pid'];  
	
	
	$res=$obj->readbookmarknews($b,$c,$a) ; 
	//print_r($res);
	//die("+++++++++++++++");
	if($res!=false){
	$obj->deletebookmarknews($b,$c,$a) ;  
        echo "<i class='fa fa-bookmark' style='color:gray; cursor:pointer;' title='bookmark'  ></i>";
	
	}
 
else{	  
	  
	   $data=array(
	   
	   'news_id'=>$a,
	   'uid'=>$b,
	   'pid'=>$c    
	 
	   );
	   
	 $obj->createbookmarknews( $data);
	 echo "<i class='fa fa-bookmark' style='color:blue; cursor:pointer;' title='Unbookmark'></i>";
}
			
	
	 
	 
	?>
	


   