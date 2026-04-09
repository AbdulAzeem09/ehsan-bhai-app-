<?php 
date_default_timezone_set('Asia/Kolkata');  

/*error_reporting(E_ALL);
ini_set('display_errors', 'On');*/  

 function sp_autoloader($class) {
    include '../mlayer/' . $class . '.class.php';
  }
  spl_autoload_register("sp_autoloader");
  
  session_start(); 
  
                                             $postid=$_POST['lastid'];    
  
  
  
												$obj2=new _spprofiles;
												$res4= $obj2->readsinglecomment($postid);
																// print_r($res4);
//die("*************");  
															//	die("9999999999999999999999999999999999999999999");  

												if($res4!=false){
													
													
										while(  $row4=mysqli_fetch_assoc($res4)){
														$id=$row4['id'];
														$pids=$row4['pid'];
														$uid=$row4['userid'];
											$msg1=$row4['comment'];  
											$shared=$row4['shared'];  
									$parrent_id=$row4['parrent_id'];  
											//echo $shared;
//die('=='); 


														$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
														if(preg_match($reg_exUrl, $msg1, $url)) {
															$msg= preg_replace($reg_exUrl, '<a target=" " href="'.$url[0].'" rel="nofollow">'.$url[0].'</a>', $msg1);

														} else {


															$msg= $msg1;

														}

																	//cccccccc
														$date=$row4['comment_date'];

														$ppid=$row4['pid'];


														$res5=$obj2->readcommentbypid($ppid);
														if($res5!=false){
														
														$row5=mysqli_fetch_assoc($res5);

														$pic=$row5['spProfilePic'];
														$name=$row5['spProfileName'];
																 // die("9999999999999999999999999999999999999999999");
														 
														 
														 
						include('rightSidebarDataduplicate.php');
														
														 
												}}  }    
  
  

?>