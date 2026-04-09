

<div class="viewscontent">	
	<!--h1> Views</h1-->
	<div class="post-comments">
		



	</form>		
	<form method="POST" id="NewsCommentForm1" action="news_comment.php" class="postForm" style="border:none;">
		<!-- div class="form-group" style="margin-bottom:5px;">
			<input type="hidden" id="news_id" name="news_id" value="">
			<label class="pull-right"><a href="<?php echo $BaseUrl;?>/news/following.php?id=<?php echo $_SESSION['pid']; ?>"> Follower </a><strong><?php 
			$obj=new _spprofilefeature;
			$ress=$obj->readfollowers($_SESSION['pid']);

			$count=$ress->num_rows;

			if( $count){
				echo $count;
			}
			else{
				echo "0";
			}
			?></strong> |<a href="<?php echo $BaseUrl;?>/news/follower.php?id=<?php echo $_SESSION['pid']; ?>">	 Following </a><strong><?php 
			$obj=new _spprofilefeature;
			$ress2=$obj->readfollowing($_SESSION['pid']);
			$count2=$ress2->num_rows;
			if( $count2){
				echo $count2;
			}
			else{
				echo "0"; 
			} 
		?></strong></label></a>
		<input type="hidden" name="spids"id="spids">
		<textarea name="comment" id="views_comment" class="form-control" rows="3" maxlength="300"  placeholder="Post your views here...." onkeyup="charcountupdate(this.value)" required></textarea><span id="charcount"></span><br>
	</div> 
	
	<div class=" form-group icons">
		<a href="#" data-toggle="modal" data-target="#flagPost3"  ><i class="fa fa-picture-o fa-lg"></i></a>
		<a href="#" style="margin-left: 10px;"><i class="fa fa-video-camera fa-lg"></i></a>
		<a href="#" style="margin-left: 10px;"><i class="fa fa-smile
		-o fa-lg"></i></a>
		<a href="#" style="margin-left: 10px;"><i class="fa fa-map-marker fa-lg"></i></a>
		<button type="save" class="btn  btn-small pull-right" style="margin-top: -15px;">Post</button>
	</div-->
	<div class="col-md-12">
	<?php // include('newsform.php'); ?>
	</div>
</form>
<div class="comments-nav">
	<ul class="nav nav-pills">
		<li role="presentation" class="dropdown">
															<!--a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
																Views 259 <span class="caret"></span>
															</a --> 
															<ul class="dropdown-menu">
																<li><a href="#">All</a></li>
																<li><a href="#">My Views</a></li>
																<li><a href="#">Follower Views</a></li>
															</ul>
														</li>
													</ul>
												</div>
												<?php
												if(isset($_POST['submit'])) {
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
													$obj6->commentcreatedata($data);
												}
												
                            $msgg =$_GET['records'];
							
												$obj2=new _spprofiles;
												$res4= $obj2->readcommentdatasearch($msgg);
																// print_r($res4);
																	//die("*************");
																//die("9999999999999999999999999999999999999999999");

												if($res4!=false){
													while(  $row4=mysqli_fetch_assoc($res4)){
														$id=$row4['id'];
														$pids=$row4['pid'];
														$uid=$row4['userid'];
														$msg1=$row4['comment'];


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
														$row5=mysqli_fetch_assoc($res5);

														$pic=$row5['spProfilePic'];
														$name=$row5['spProfileName'];
																 // die("9999999999999999999999999999999999999999999");
														?>
														<div id="commentbox2<?php echo $id; ?>">
															<div class="media"  style="display:block;">
																<!-- answer to the first comment -->
																<div class="media-heading" id="commentbox222<?php echo $id; ?>">
																	<button class="btn btn-default btn-collapse btn-xs" type="button" data-toggle="collapse" data-target="#collapseSix2<?php echo $id; ?>" aria-expanded="false" aria-controls="collapseExample"><span class="fa fa-minus" aria-hidden="true"></span></button> <span class="label"><a href="<?php echo $BaseUrl; ?>/news/profile.php?id=<?php echo $ppid; ?>"><img src="<?php echo $pic; ?>" class="img-circle" style="width: 50px; height: 50px;"></span> <?php echo $name;?></a> <?php echo $date;?>
																</div> 
																
																
																
																	
																	
																
																
																
																
																<div class="panel-collapse collapse in" id="collapseSix2<?php echo $id ;?>">
																	<div class="media-left" >
																		<div class="vote-wrap">
																			<div class="save-post">
																				<a><span id="appendbookmark1<?php echo $id ?>" data-mark="<?php echo $id; ?>" class="commentbookmark"    aria-label="report"> 
																					<?php
																					$bbb=$_SESSION['uid'];
																					$ccc=$_SESSION['pid'];

																					$obj5=new _spprofiles;
																					$rr5=$obj5->readbookmarkdata($bbb,$ccc,$id) ;
																					if($rr5!=false){
																						echo "<i class='fa fa-star' style='color:blue'></i>";	
																					}
																					else {
																						echo "<i class='fa fa-star' style='color:gray'></i>";	
																					}
																					?>
																				</span></a>


																			</div>
																			<div class="vote up">
																				<i class="fa fa-menu-up"></i>
																			</div>
																			<div class="vote inactive">
																				<i class="fa fa-menu-down"></i>
																			</div>
																		</div>
																		<!-- vote-wrap -->
																	</div>
																	<!-- media-left -->
																	
																	
																	
																	
																	<div class="media-body">
																	
																	
																	
																	
																	
																		<span style="text-justify: inter-word;  word-break: break-all;" id="commentbox444<?php echo $id; ?>"><?php
																		echo $msg;   
                                                                        ?>
																		</span><br>
																		
																		
																		 
																		 
																		 
																		 
																		 
																		 
																		 
																		 
																	
																	<div class="comment-meta">
																		<span><a class="commentlike" id="appendlike2<?php echo $id; ?>" data-like="<?php echo $id; ?>"  style="font-size:15px;">

																							<?php	 //$id=$_POST['comment_id'];
																							$bb=$_SESSION['uid'];
																							$cc=$_SESSION['pid'];

																							$obj5=new _spprofiles;
																							$r5=$obj5->readlikedata($bb,$cc,$id) ;
																							if($r5!=false){
																								echo "<i class='fa fa-thumbs-up'  title='Unlike'></i> ";	

																							}
																							else {
																								echo "<i class='fa fa-thumbs-o-up' style='color: #a07eff;' title='Like'></i> ";	
																							}
																							$r6=$obj5->readlikedata22($id) ;
																							if($r6!=false){
																								$count22=$r6->num_rows;
																								echo "(".$count22.")";
																							}else{
																								echo "(0)";
																							}
																							?>																			 

																						</a></span>|
																						<?php if($_SESSION['pid']==$ppid){?>

																							<span><a class="commentdel" data-del2="<?php echo $id; ?>"  style="font-size:15px;padding-left:5px;"><i class="fa fa-trash" style="color: red;" title="Delete"></i></a></span>|

																						<?php } 

																						$sppid=$_SESSION['pid'];
																						if($sppid!=$pids)
																						{
																							?>

																							<!--a href="javascript:void(0)" data-toggle="modal" data-target="#flagPost" ><i class="fa fa-flag"></i> Flag This Profile</a-->

																							<span><a href="javascript:void(0)"  data-toggle="modal" data-target="#flagPost22"  style="font-size:15px; padding-left:5px;"><i class="fa fa-flag" style="color: #a07eff;" title="Report"></i></a></span>|


																							<!--span><a class="reportcomment" data-report="<?php echo $id; ?>" data-toggle="modal" data-target="#exampleModal22"  style="font-size:15px; padding-left:5px;"><i class="fa fa-flag"  title="Report"></i></a></span-->|
																						<?php } ?>
																						<span><a  onclick="myFunction2(<?php echo $id; ?>)"   id="hideshow<?php echo $id; ?>"  style="font-size:15px;padding-left:5px;"><i class="fa fa-eye" style='color: #a07eff;' title="Hide"></i></a></span>|
																						<span>
																							<a class="" role="button" data-toggle="collapse" href="#replyCommentOne2<?php echo $id; ?>" aria-expanded="false" aria-controls="collapseExample"  style="font-size:15px; padding-left:5px; color:purpal;"><i class="fa fa-comment" style="color: #a07eff;" title="Reply"></i>
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
																							</a>
																						</span>|
																						<span class="sharepost" data-share="<?php echo $id ; ?>" id="appendshare2<?php echo $id ; ?>" >
																							<a class="" role="button"  style="font-size:15px; padding-left:5px;">
																								<?php
																								$obj123=new _spprofilefeature;
																								$res123=$obj123->readsharedata($_SESSION['uid'],$_SESSION['pid'],$id) ;
																								if($res123!=false){
																									echo "<i class='fa fa-share-alt' title='Unshare' style='color:purple;'></i>";
																								}
																								else{
																									echo "<i class='fa fa-share-alt' title='Share' style='color:#a07eff;'></i>";
																								}
																								$r6=$obj123->readsharedata22($id) ;
																								if($r6!=false){
																									$count22=$r6->num_rows;
																									echo "(".$count22.")";
																								}else{
																									echo "(0)";
																								}

																								?>




																							</a>
																						</span>
																						<br><br>

																						<?php

																						$objj=new _spprofiles;

																						$r3=$objj->readreplydata($id);
																						if($r3!=false){
																							while($row33=mysqli_fetch_assoc($r3)){
																								$reply_message=$row33['reply_message'];

																								$profile_id=$row33['profile_id'];
																								$id2=$row33['id'];
																								$rpdate=$row33['reply_date'];

																								$r1=$objj->readreplybypid($profile_id);

																								$row44=mysqli_fetch_assoc($r1);

																								$pname=$row44['spProfileName'];

																								$pic2=$row44['spProfilePic'];
																								?>
																								<div class="form-group" id="rpllybox2<?php echo $id2; ?>" >
																									<div class="form-group">	
																										<a href="<?php echo $BaseUrl; ?>/news/profile.php?id=<?php echo $profile_id; ?>"><span style="font-weight: normal; color:#115abc;"><img src="<?php echo $pic2; ?>" class="img img-circle" style="height:30px; width:30px;"><?php echo '  '.$pname;?></span><span><?php echo'   '.$rpdate; ?></span></a><br>


																										<span for="comment" style="margin:0px; word-break: break-all; color: purple; text:normal;"><?php 
																										echo $reply_message;  ?>          
                                                                                                             </span> 
																									<?php
																									
																									if($_SESSION['pid']==$profile_id){
																											?> 
																											<span><a class="delreply" data-reply2="<?php echo $id2; ?>" style="font-size:15px;padding-left:5px;"><i class="fa fa-trash" title="Delete"></i></a></span>|
																											<span><a class="bookmarkreply" data-bookmarkreply2="<?php echo $id ; ?>" id="appendbookmarkreply<?php echo $id; ?>" style="font-size:15px;padding-left:5px;">
																											
																											
																											
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




																							<div class="collapse" id="replyCommentOne2<?php echo $id; ?>">
																								<form action="" method="POST">
																									<div class="form-group" style="margin-bottom:none;
																									" >
																									<label for="comment">Reply</label>
																									<input type="hidden" name="comment_id" value="<?php echo $id; ?>"> 
																									<textarea name="comment" class="form-control" rows="3"></textarea>
																								</div>
																								<button type="submit" class="btn btn-default" name="submit">Send</button>
																							</form>
																						</div>
																					</div>
																					<!-- comment-meta -->
																				</div>
																			</div>
																			<!-- comments -->
																		</div>
																	</div>

																<?php }}
																else{  ?>
																
																<div class="alert alert-danger" role="alert">
																	Don't have any matching records!
																	</div>
																	
															<?php	
															
															        }
																
																
																?>
															</div>
															</div>
														

														<!--modal start -->   



														<!-- Button trigger modal -->


														<!-- Modal -->
<!--div class="modal fade" id="exampleModal22" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Report Messege</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="reportform" method="POST">
		<input type="hidden" name="report" class="form-control" id="hiddenid">
		<div class="form-group">
    <label for="exampleFormControlTextarea1">Write report messege</label>
    <textarea class="form-control" id="repmessege" rows="3"></textarea>
  </div>
		
      </div>
      <div class="modal-footer"> 
        
        <button data-dismiss="modal" type="button" class="btn btn-primary" name="submit" id="report_comment">Report</button>
      </div>
	  </form>
    </div>
  </div>
</div -->



<?php
if(isset($_POST['submit'])){

	$flag_pid =$_POST['flag_pid'];
	$user_pid=$_SESSION['pid'];
	$user_uid=$_SESSION['uid'];
	$why_flag =$_POST['why_flag'];
	$flag_desc =$_POST['flag_desc'];

	$data1=array(
		'flag_pid'=>$flag_pid,
		'user_pid'=>$user_pid,
		'user_uid'=>$user_uid,
		'why_flag'=>$why_flag,
		'flag_desc'=>$flag_desc
	);
	$object=new _spprofilefeature;
	$result1=$object->createpostflag($data1);



} 


?>


<div id="flagPost22" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<form method="post" action="" class="sharestorepos">
			<div class="modal-content no-radius">
                                        <!--input type="hidden" name="uid_idspPosting" value="<?php echo $_GET['postid'];?>">
                                        	<input type="hidden" name="_idspProfile" value="<?php echo $_SESSION['pid']; ?>"-->
                                        	<input type="hidden" name="flag_pid" value="<?php  echo $id;?>">
                                        	<div class="modal-header">
                                        		<button type="button" class="close" data-dismiss="modal">&times;</button>
                                        		<h4 class="modal-title">Flag Post</h4>
                                        	</div> 
                                        	<div class="modal-body">
                                        		<div class="radio">
                                        			<label><input type="radio" name="why_flag" value="Duplicate post" checked="">Duplicate Post</label>
                                        		</div>
                                        		<div class="radio">
                                        			<label><input type="radio" name="why_flag" value="Posting Violation">Posting Violation</label>
                                        		</div>
                                        		<div class="radio">
                                        			<label><input type="radio" name="why_flag" value="Suspicious Post">Suspicious Post</label>
                                        		</div>
                                        		<div class="radio">
                                        			<label><input type="radio" name="why_flag" value="Copied My Post">Copied My Post</label>
                                        		</div> 

                                        		<!-- <label>Why flag this post?</label> -->
                                        		<textarea class="form-control" name="flag_desc" placeholder="Add Comments"></textarea>
                                        	</div>
                                        	<div class="modal-footer">
                                        		<input type="submit" name="submit" class="btn butn_mdl_submit ">
                                        		<button type="button" class="btn butn_cancel" data-dismiss="modal">Cancel</button>
                                        	</div>
                                        </div>
                                     </form>
                                  </div>
                               </div>





<div id="flagPost3" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<form method="post" action="" class="sharestorepos">
			<div class="modal-content no-radius">
                                        <!--input type="hidden" name="uid_idspPosting" value="<?php echo $_GET['postid'];?>">
                                        	<input type="hidden" name="_idspProfile" value="<?php echo $_SESSION['pid']; ?>"-->
                                        	<input type="hidden" name="flag_pid" value="<?php  echo $id;?>">
                                        	<div class="modal-header">
                                        		<button type="button" class="close" data-dismiss="modal">&times;</button>
                                        		<h4 class="modal-title">Upload Image</h4>
                                        	</div> 
                                        	<div class="modal-body">
                                        		
                                        		<div class="form-group">

                                                       <img id="blah" src="#" alt="your image" />
												
												<input accept="image/*" type="file" name="img" id="imgInp" class="form-control">
												</div>
												
                                        		

                                        		<!-- <label>Why flag this post?</label> -->
                                        		
                                        	
                                        	<div class="modal-footer">
                                        		<input type="submit" name="submit" class="btn butn_mdl_submit btn-success ">
                                        		<button type="button" class="btn butn_cancel" data-dismiss="modal">Cancel</button>
                                        	</div>
											</div>
                                        </div>
                                     </form>
                                  </div>
                               </div>


                               <!--modal End -->




















                               <script>
                               	$(document).ready(function(){
                               		$('.commentlike').click(function(){
                               			var a = $(this).attr('data-like');


                               			$.ajax({
                               				url: "like.php",
                               				type: "POST",
                               				cache:false,
                               				data: {'comment_id':a


                               			},
                               			success: function(data) {
	                                              												// location.reload();
	                                              												$('#appendlike2'+a).html(data);	

	                                              											}

	                                              										});
                               		});



                               		$('.sharepost').click(function(){
                               			var z = $(this).attr('data-share'); 
												//alert(z);
												
												$.ajax({
													url: "share.php",
													type: "POST",
													cache:false,
													data: {'comment_id':z 
													
													
												},
												success: function(data) {
	                                              												// location.reload();
	                                              												$('#appendshare2'+z).html(data);	

	                                              											}

	                                              										});
											});




















                               		$('.commentbookmark').click(function(){
                               			var mark = $(this).attr('data-mark');


                               			$.ajax({
                               				url: "bookmark.php",
                               				type: "POST",
                               				cache:false,
                               				data: {'comment_id':mark


                               			},
                               			success: function(data) {
											// location.reload();
											$('#appendbookmark'+mark).html(data);	

										}

									});
                               		});
									
									
									
									
									
									
									
									
									
									
									$('.bookmarkreply').click(function(){
                               			var bookreply = $(this).attr('data-bookmarkreply2');

                                        //alert(bookreply);
										
                               			$.ajax({
                               				url: "bookmarkreply.php",
                               				type: "POST",
                               				cache:false,
                               				data: {'comment_id':bookreply


                               			},
                               			success: function(data) {
											// location.reload();
											$('#appendbookmarkreply'+bookreply).html(data);	

										}

									});
                               		});






                               		$('.delreply').click(function(){
                               			var i2 = $(this).attr('data-reply2');


                               			$.ajax({
                               				url: "rep_delete.php",
                               				type: "POST",
                               				cache:false,
                               				data: {'id':i2


                               			},
                               			success: function(data) {
	                                              												// location.reload();
	                                              												$('#rpllybox2'+i2).html(' ');	

	                                              											}

	                                              										});
                               		});




                               		$('.delbook').click(function(){
                               			var i2 = $(this).attr('data-reply');


                               			$.ajax({
                               				url: "rep_delete.php",
                               				type: "POST",
                               				cache:false,
                               				data: {'id':i2


                               			},
                               			success: function(data) {
	                                              												// location.reload();
	                                              												$('#rpllybox'+i2).html(' ');	

	                                              											}

	                                              										});
                               		});




                               		$('.commentdel').click(function(){
                               			var e = $(this).attr('data-del2');


                               			$.ajax({
                               				url: "delete.php",
                               				type: "POST",
                               				cache:false,
                               				data: {'comment_id':e


                               			},
                               			success: function(data) {
	                                              												// location.reload();
	                                              												$('#commentbox2'+e).html(' ');	

	                                              											}

	                                              										});
                               		});









                               	});



                               </script>



                               <script type="text/javascript">
							   
							   
							   imgInp.onchange = evt => {
  const [file] = imgInp.files
  if (file) {
    blah.src = URL.createObjectURL(file)
  }
}
							   
							   
							   
							   
							   
							   
                               	function myFunction2(id) {

                               		var x = document.getElementById("commentbox222"+id);
                               		var z = document.getElementById("commentbox444"+id);
													//var y = document.getElementById("commentbox33"+id);
													var a = document.getElementById("appendbookmark1"+id);
													
													var attachment = document.getElementById("attachment"+id);



													if (x.style.display === "none") {
														x.style.display = "block";
														a.style.display = "block";

														z.style.display = "block";
														attachment.style.display = "block";

														document.getElementById("hideshow"+id).innerHTML = "<i class='fa fa-eye' title='Hide' style='color:blue;'></i>";

													} else {
														x.style.display = "none";
														a.style.display = "none";
														z.style.display = "none";
														attachment.style.display = "none";

												//app = document.querySelector('#hideshow'+id);
                                             // app.html('Show');
                                             document.getElementById("hideshow"+id).innerHTML = "<i class='fa fa-eye-slash' title='Show' style='color:black;'></i>";

                                          }

                                       }

											/*  var y = document.getElementById("commentbox33"+id);
											 // alert(y);
											  if (y.style.display === "none") {
												y.style.display = "block";
												document.getElementById("hideshow"+id).innerHTML = "<i class='fa fa-eye-slash' title='Hide'></i>";
												
											  } else {
												y.style.display = "none";
												 document.getElementById("hideshow"+id).innerHTML = "<i class='fa fa-eye' title='Show'></i>";
											  }
											  
											  
											  
											  var z = document.getElementById("commentbox44"+id);
											  if (z.style.display === "none") {
												  alert('if44');
												z.style.display = "block";
												document.getElementById("hideshow"+id).innerHTML = "<i class='fa fa-eye-slash' title='Hide'></i>";
											  } else {
												    alert('else44');
												z.style.display = "none";
												 document.getElementById("hideshow"+id).innerHTML = "<i class='fa fa-eye' title='Show'></i>";
											  }
											  
											 
											}*/
										</script>
										<script>
											$( document ).ready(function() {
												$(".reportcomment").on("click", function (event) {

													var report = $(this).attr('data-report');
		//alert(report);

		$("#hiddenid").val(report);



	});
//report_comment

$("#report_comment").on("click", function (event) {
	var text= $('#repmessege').val();
	var  id2 = $('#hiddenid').val();
 //alert(id2);
   //alert(text);

   $.ajax({
   	url: "report.php",
   	type: "POST",
   	cache:false,
   	data: {'comment_id':id2,
   	'report_msg':text


   },
   success: function(data) {
	                                              												// location.reload();
					//$('#commentbox'+e).html(' ');	

				}

			});
});


});




</script>
<script>
	function charcountupdate(str) {
		var lng = str.length;
		document.getElementById("charcount").innerHTML = lng + ' out of 300 characters';
	}
	
	
	

	
	
	
	
	
	
	
</script>


