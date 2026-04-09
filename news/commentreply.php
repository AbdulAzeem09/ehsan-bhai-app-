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
													 
													 
   				 $actual_link = $_SERVER['HTTP_REFERER'];
      
    
      
    // Print the link
    //echo $actual_link;   
	$link2=explode("/",$actual_link);	
 $end =end($link2);

//print_r($link2);	
//die("0000000nnnnnnnnnnn000000");				   
													   
													   
													   


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
													

													
													//header("location:$BaseUrl/news/rightSidebar.php"); 
												//	header("location:$BaseUrl/news/$end");  
													
											//	}
												
												?>
												
												
	                     <?php
						 
					//echo $lasid;
					///die("kkkkkkkkkkkkkkkkk");

					$objj=new _spprofiles;

					$r3=$objj->readreplydataappend($cid,$lasid);
					if($r3!=false){
						
						
						//die("PPPPPPPPPPPPPP");
						while($row33=mysqli_fetch_assoc($r3)){
							$reply_message=$row33['reply_message'];

							$profile_id=$row33['profile_id'];
							$id2=$row33['id'];  
							$rpdate=$row33['reply_date'];

							$r1=$objj->readreplybypid($profile_id);
								   if($r1!=false){
							$row44=mysqli_fetch_assoc($r1);
							
								   }

							$pname=$row44['spProfileName'];

							$pic2=$row44['spProfilePic'];
							?>
							
							<div id="appendreply<?php echo $id ;?>" style="margin-bottom:-15px;"></div><br>  
							<div class="form-group" id="rpllybox<?php echo $id2; ?>" >
								<div class="form-group" style="border:1px solid gray; margin-right:10px; padding:8px 8px" >	
									<a href="<?php echo $BaseUrl; ?>/news/profile.php?id=<?php echo $profile_id; ?>"><span style="font-weight: normal; color:#115abc;"><img src="<?php echo $pic2; ?>" class="img img-circle" style="height:30px; width:30px;"><?php echo '  '.$pname;?></span><span><?php echo'   '.$rpdate; ?></span></a><br>


									<span for="comment" style="margin:0px; word-break: break-all; color: purple; text:normal;"><?php 
									echo $reply_message;  ?>          
										 </span> <br/>
								<?php
								
								if($_SESSION['pid']==$profile_id){
										?> 
										<span><a class="delreply" onclick="DelreplyReply(<?php echo $lasid; ?>,<?php echo $_POST['comment_id']; ?>)" data-reply="<?php echo $id2; ?>" style="font-size:15px;padding-left:5px;"><i class="fa fa-trash" title="Delete"></i></a></span>|
										<span><a class="bookmarkreply" onclick="BookmarkReply(<?php echo $lasid; ?>)" data-bookmarkreply="<?php echo $id ; ?>" id="appendbookmarkreply<?php echo $id2; ?>" style="font-size:15px;padding-left:5px;">
										
										
										
										<?php 
				$b3=$_SESSION['uid'];
				$c3=$_SESSION['pid'];

				$object5=new _spprofiles;
				$result44=$object5->readreplybookmarkdata($b3,$c3,$id) ;
				
	   // print_r($result44);
		//die("9999999999999999999999999");
				
				if($result44!=false){  
					echo "<i class='fa fa-star' style='color:blue' title='Unbookmark'></i>";	
				} 
				else {
					echo "<i class='fa fa-star' style='color:gray' title='Bookmark'></i>";	
				}
				?>
										
										
										
										
										
										</a></span>
										
									<?php } ?>  
								</div>
								<input type="hidden" name="comment_id" value="<?php echo $id; ?>">

							</div>	
							

						<?php } }?>
												
												
												
												
												
												
												