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
	
	
	  $a=$_POST['id'];
	  $b=$_SESSION['uid'];
	  $c=$_SESSION['pid'];
	
	
	$res=$obj->readbucketdata22($b,$c,$a) ;
	if($res!=false){
	
		$obj->deletebucketdata($b,$c,$a) ;
        echo "<span class='fa fa-archive' title='archive' style='color:gray'></span>";  
	}
	   

else{	
    $a=$_POST['id'];  
	  $b=$_SESSION['uid'];
	  $c=$_SESSION['pid'];
	  
	   $data=array(
	   
	   'newsid'=>$a,
	   'uid'=>$b,
	   'pid'=>$c,
	 
	   );
	   
	 $obj->createbucketdata( $data);
	   echo "<span class='fa fa-archive' title='Unarchive' style='color:blue'></span>";
}
			
	
	 
	 
	?>
	


   