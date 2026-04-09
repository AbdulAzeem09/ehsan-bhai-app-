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

	

	?>

	
	<?php
		//session_start();
	
	 $a=$_POST['comment_id'];
	  $b=$_SESSION['uid'];
  $c=$_SESSION['pid'];
	
	 $obj=new _spprofiles;
	 
	 $res2=$obj->readforlike($a);
	 $row=mysqli_fetch_assoc($res2);
	 
	 
$objectt=new _news;

$settres=$objectt->read_settings($row['pid']);
			// if($settres != false){
$setrow=mysqli_fetch_assoc($settres);
$can_like=$setrow['can_like']; 
//print_r($setrow);
	 	//die("&&&&&&&&&&&&&&&&&&&&");
if($can_like==1){
$res=$obj->readlikedata($b,$c,$a) ;
	
	
	
	if($res!=false){
		
			 $obj=new _spprofiles;
		$obj->deletelikedata($b,$c,$a) ;
		
		$r6=$obj->readlikedata22($a) ;
			if($r6!=false){
			$count22=$r6->num_rows;
			}
			
			else{
				$count22=0;
			}
		
		echo "<i class='fa fa-thumbs-o-up' style='color: #a07eff;margin-top: 5px;cursor:pointer;' title='Like'></i> (".$count22.")";
		
	}
	
	 
	else{
	  $a=$_POST['comment_id'];
	  $b=$_SESSION['uid'];
	  $c=$_SESSION['pid'];
	  
	   $data=array(
	   
	   'comment_id'=>$a,
	   'userid'=>$b,
	   'profileid'=>$c,
	 
	   );
	   $obj=new _spprofiles;
	 $obj->likecreatedata( $data);
	 
	 $r6=$obj->readlikedata22($a) ;
			if($r6!=false){
			$count22=$r6->num_rows;
			}else{
				$count22=0;
			}
	 echo "<i class='fa fa-thumbs-up'  style='cursor:pointer;margin-top:5px;'  title='Unlike' ></i> (".$count22.")";
	 }
	 
	 }
	 
	 else{
		 $rress=$objectt->followers($_SESSION['pid'],$setrow['pid']);
											   
                                                 if($rress!=false){ 
                   $res=$obj->readlikedata($b,$c,$a) ;
	
	
	
	if($res!=false){
		
			 $obj=new _spprofiles;
		$obj->deletelikedata($b,$c,$a) ;
		
		$r6=$obj->readlikedata22($a) ;
			if($r6!=false){
			$count22=$r6->num_rows;
			}
			
			else{
				$count22=0;
			}
		
		echo "<i class='fa fa-thumbs-o-up' style='color: #a07eff;margin-top: 5px;cursor:pointer;' title='Like'></i> (".$count22.")";
		
	}
	
	 
	else{
	  $a=$_POST['comment_id'];
	  $b=$_SESSION['uid'];
	  $c=$_SESSION['pid'];
	  
	   $data=array(
	   
	   'comment_id'=>$a,
	   'userid'=>$b,
	   'profileid'=>$c,
	 
	   );
	   $obj=new _spprofiles;
	 $obj->likecreatedata( $data);
	 
	 $r6=$obj->readlikedata22($a) ;
			if($r6!=false){
			$count22=$r6->num_rows;
			}else{
				$count22=0;
			}
	 echo "<i class='fa fa-thumbs-up'  style='cursor:pointer'  title='Unlike' style=' margin-top: 5px;'></i> (".$count22.")";
 }
												 
	 }
	 else{
		 echo "0";
		 
	 }
	 }
	 
	?>  
	


   