<?php



//error_reporting(E_ALL);
//ini_set('display_errors', 'On');

include '../univ/baseurl.php';
session_start();


	function sp_autoloader($class)
	{
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	                                                   
													   
													   
													   
													 // Program to display URL of current page.
						   
													   
													   


                                                  //if(isset($_POST['submit'])) {
													$cid=$_POST['comment_id'];
													$userid=$_SESSION['uid'];
													$profileid=$_SESSION['pid'];
													$comment=$_POST['comment'];

													$data=array(
														'comment_id'=>$cid,
														'user_id'=>$userid,
														'profile_id'=>$profileid,
														'reply_message'=>$comment 
													);
													$obj6=new _spprofiles;
													$lasid = $obj6->commentcreatedata($data);
													
                                                          ?>	
												
				  
				  <span>
                  <a class="" role="button" data-toggle="collapse" id="repcount<?php echo $id; ?>" href="#replyCommentOne<?php echo $id; ?>" aria-expanded="false" aria-controls="collapseExample"  style="font-size:15px; padding-left:5px; color:purpal;"><i class="fa fa-comment" style="color: #a07eff;" title="Reply"></i>
                
				 <?php
                     $ob=new _spprofilefeature;
                     $resul=$ob->replydatacount($id);
                     
                     $num_rows=$resul->num_rows;
                     if($resul!=false){
                     	echo '('.$num_rows.')';
                     }
                     else{
                     	echo '(0)';    
                     }
                     ?>	
					 
                   
                  </a></span>|
												
												
				
												
												
												
												
												