										<div class="viewscontent">
											<h1> Views</h1>
											<div class="post-comments">
											
												<form method="POST" id="NewsCommentForm" action="news_comment.php">
													<div class="form-group">
													<input type="hidden" id="news_id" name="news_id" value="">
														<label for="comment">Your Views</label><label class="pull-right"><a href="<?php echo $BaseUrl;?>/news/following.php?id=<?php echo $_SESSION['pid']; ?>"> Follower </a><strong><?php 
												$obj=new _spprofilefeature;
												$ress=$obj->readfollowers($_SESSION['pid']);
											
					                           $count=$ress->num_rows;
											   
											 if( $count){
												echo $count;
											 }
												else{
													echo "0";
												}
												
												
												
												
												
												
											
												
												
												
												
												
												
												?></strong> |<a href="<?php echo $BaseUrl;?>/news/follower.php?id=<?php echo $_SESSION['pid']; ?>">	 Follwoing </a><strong><?php 
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
														<textarea name="comment" class="form-control" rows="3" value=""></textarea>
													</div>
													<button type="save" class="btn btn-default">Comment</button>
												</form>
												<div class="comments-nav">
													<ul class="nav nav-pills">
														<li role="presentation" class="dropdown">
															<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
																Views 259 <span class="caret"></span>
															</a>
															<ul class="dropdown-menu">
																<li><a href="#">All</a></li>
																<li><a href="#">My Views</a></li>
																<li><a href="#">Follower Views</a></li>
															</ul>
														</li>
													</ul>
												</div>
												<?php
												  $obj2=new _news;
												  $pids=$_SESSION['pid'];
																  $res4= $obj2->readcommentdata2($pids);
																// print_r($res4);
																	//die("*************");
																//die("9999999999999999999999999999999999999999999");
														  
																  if($res4!=false){
																	while(  $row4=mysqli_fetch_assoc($res4)){
																	$id=$row4['id'];
																	$msg=$row4['comment'];
																	$date=$row4['comment_date'];
																	
																$ppid=$row4['pid'];
																
																
																$res5=$obj2->readcommentbypid($ppid);
																$row5=mysqli_fetch_assoc($res5);
																
																 $pic=$row5['spProfilePic'];
															$name=$row5['spProfileName'];
																 // die("9999999999999999999999999999999999999999999");
																 
																
																 
																 
														  ?>
																  
					                                          	  <div class="media">
                                                               <!-- answer to the first comment -->
                                                               <div class="media-heading">
                                                                  <button class="btn btn-default btn-collapse btn-xs" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseExample"><span class="fa fa-minus" aria-hidden="true"></span></button> <span class="label"><a href="profile.html"><img src="<?php echo $pic; ?>" class="img-circle"></span> <?php echo $name;?></a> <?php echo $date;?>
                                                               </div>
                                                               <div class="panel-collapse collapse in" id="collapseSix">
                                                                  <div class="media-left">
                                                                     <div class="vote-wrap">
                                                                        <div class="save-post">
                                                                           <a href="#"><span class="fa fa-star" aria-label="report"></span></a>
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
                                                                     <p><?php echo $msg;?>
                                                                     </p>
                                                                     <div class="comment-meta">
																	     <span><a class="commentlike" data-like="<?php echo $id; ?>">Like</a></span>
                                                                        <span><a href="#">delete</a></span>
                                                                        <span><a href="#">report</a></span>
                                                                        <span><a href="#">hide</a></span>
                                                                        <span>
                                                                        <a class="" role="button" data-toggle="collapse" href="#replyCommentOne" aria-expanded="false" aria-controls="collapseExample">reply</a>
                                                                        </span>
                                                                        <div class="collapse" id="replyCommentOne">
                                                                           <form>
                                                                              <div class="form-group">
                                                                                 <label for="comment">Yorumunuz</label>
                                                                                 <textarea name="comment" class="form-control" rows="3"></textarea>
                                                                              </div>
                                                                              <button type="submit" class="btn btn-default">Yolla</button>
                                                                           </form>
                                                                        </div>
                                                                     </div>
                                                                     <!-- comment-meta -->
                                                                  </div>
                                                               </div>
                                                               <!-- comments -->
                                                            </div>
						  
                                      <?php }}?>
											</div>
										</div>
										<script>
										$(document).ready(function(){
											$('.commentlike').click(function(){
											var a = $('.commentlike').attr('data-like');
												
												
												$.ajax({
												  url: "like.php",
												  type: "POST",
												 cache:false,
													data: {'comment_id':a
													
													},
												   success: function(data) {
														 location.reload();
														
															  
												}
												
											});
										});
										
										
										
										
										
										</script>