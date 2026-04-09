<?php
include '../univ/baseurl.php';
session_start();

if (!isset($_SESSION['pid'])) {
	$_SESSION['afterlogin'] = "videos/";
	include_once "../authentication/check.php";

} else {
	function sp_autoloader($class)
	{
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");


	$_GET["categoryID"]   = "26";
	$_GET["categoryName"] = "News";

	$f = new _spprofilehasprofile;

	$totalFrnd = array();
	$result3   = $f->readallfriend($_SESSION['pid']);
	if ($result3 != false) {
		while ($row3 = mysqli_fetch_assoc($result3)) {
			array_push($totalFrnd, $row3['spProfiles_idspProfilesReceiver']);
		}
	}

	$result4 = $f->readall($_SESSION['pid']);
	if ($result4 != false) {
		while ($row4 = mysqli_fetch_assoc($result4)) {
			array_push($totalFrnd, $row4['spProfiles_idspProfileSender']);
		}
	}

	$friend_ids = implode("','", $totalFrnd);
	$friend_id  = "'" . $friend_ids . "'";
    //echo $friend_id; exit;

	$pageactive = 7;

	?>

	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php include '../component/f_links.php';?>

		<link rel="stylesheet" href="css/bootstrap.min.css" >
		<!-- Optional theme -->
		<link rel="stylesheet" href="css/bootstrap-theme.min.css">
		<!-- <link rel="stylesheet" type="text/css" href="css/docs.theme.min.css"> -->
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="css/newsviews.css">
		<script type="text/javascript">
			let h = window.innerHeight;
			document.getElementById("wrapper").style.height = h+'px';
			alert(h);
		</script>
		<script type="text/javascript" src="js/news.js"></script> 
	</head>
	<?php
		//session_start();

	$header_select = "header_video";
	include_once "../header.php";
	?>
	<body cz-shortcut-listen="true">
		<div class="container-fluid">
			<div class="row">
				<div class="lsbar">
					<a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><i class="fa fa-bars"></i></a>
					<div id="wrapper" class="wrapper">

						<?php  include_once("newsSidebar.php"); ?>

						<!-- Page Content -->
							<!-- Page Content -->
					<div id="page-content-wrapper">
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-6 h style-1">									
									<!-- Column -->
									<div class="row">
										<div class="card"> <img class="card-img-top img-responsive" src="img/pinksky.jpg" alt="Card image cap">
											<div class="card-body little-profile">
												<div class="col-lg-6 col-md-6 col-xs-6">
													<div class="pro-img">
														<?php

                                            	$p = new _spprofiles;
                                            	$result = $p->read($_SESSION['pid']);
                                            	if ($result != false) {
                                                $row = mysqli_fetch_assoc($result);
                                                if (isset($row["spProfilePic"]) && $row['spProfilePic'] != '')
                                                    echo "<img alt='user' class='img-responsive' src=' " . ($row["spProfilePic"]) . "'  >";
                                                else
                                                    echo "<img alt='user' class='img-responsive' src='".$BaseUrl."/assets/images/icon/blank-img.png' style='width: 40px; height: 40px;' >";
                                            	}
                                        	?>
														<!-- <img src="https://i.imgur.com/8RKXAIV.jpg" alt="user" class="img-responsive"> -->
													</div>
													<h3 class="" style="margin-top: 30px;"><?php echo (isset($_SESSION['MyProfileName'])? ucwords(strtolower($_SESSION['MyProfileName'])) : "Profile "); ?></h3>
													<p><?php echo $_SESSION['ptname']; ?></p> <a href="#" class="waves-effect waves-dark btn btn-primary btn-md btn-rounded" data-abc="true">Follow</a>
												</div>
												<div class="col-lg-2 col-md-2 col-xs-2">
													<a href="<?php echo $BaseUrl;?>/news/bucket.php">
														<h3 class="">
															<?php 
                                               	$n = new _news;
                                               	$bucketCountResult = $n->read_bookmark_news($_SESSION['uid'],$_SESSION['pid'],'bucket','DESC'); 
                                               	if($bucketCountResult != false){
							                               $bucketCount = mysqli_num_rows($bucketCountResult);
							                               echo $bucketCount;
							                            } else {
							                              echo "0 ";
							                            } 
                                               	?>
                                          </h3>
														<small>Bucket</small>
													</a>
												</div>
												<div class="col-lg-2 col-md-2 col-xs-2">
													<a href="<?php echo $BaseUrl;?>/news/follower.php?id=<?php echo $_SESSION['pid']; ?>"><h3 class=""><?php 
												$obj=new _spprofilefeature;
												$ress=$obj->readfollowers($_SESSION['pid']);
											
					                           $count=$ress->num_rows;
											   
											 if( $count){
												echo $count;
											 }
												else{
													echo "0";
												}
												?></h3><small>Followers</small></a>
												
												</div>
												<div class="col-lg-2 col-md-2 col-xs-2">
													<a href="<?php echo $BaseUrl;?>/news/following.php?id=<?php echo $_SESSION['pid']; ?>"><h3 class=""><?php 
												$obj=new _spprofilefeature;
												$ress2=$obj->readfollowing($_SESSION['pid']);
											
					                           $count2=$ress2->num_rows;
											   
											 if( $count2){
												echo $count2;
											 }
												else{
													echo "0";
												}
												?></h3><small>Following</small></a>
												</div>
											</div>
										</div>
									</div>
									<hr>
									<!-- article sec -->
									
								</div>
								<div class="col-md-6 h style-1">
                           <div class="viewscontent">
                              <h1> Views</h1>
                              <div class="post-comments">
                                 <form>
                                    <div class="form-group">
                                       <label for="comment">Your Views</label> <label class="pull-right">Follower <strong>250</strong> | Follwoing <strong>12</strong></label>
                                       <textarea name="comment" class="form-control" rows="3"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-default">Send</button>
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
                                 <div class="media">
                                    <!-- first comment -->
                                    <div class="media-heading">
                                       <button class="btn btn-default btn-xs" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseExample"><span class="fa fa-minus" aria-hidden="true"></span></button> <span class="label"><img src="img/uiface.jpg" class="img-circle"></span> <a href="profile.html">@terminator</a> 12 hours ago <span class="pull-right">1 comment</span>
                                    </div>
                                    <div class="panel-collapse collapse in" id="collapseOne">
                                       <div class="media-left">
                                          <div class="vote-wrap">
                                             <div class="save-post">
                                                <a href="#"><span class="fa fa-star" aria-label="Save"></span></a>
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
                                          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.
                                          </p>
                                          <div class="comment-meta">
                                             <span><a href="#">delete</a></span>
                                             <span><a href="#">report</a></span>
                                             <span><a href="#">hide</a></span>
                                             <span>
                                             <a class="" role="button" data-toggle="collapse" href="#replyCommentT" aria-expanded="false" aria-controls="collapseExample">reply</a>
                                             </span>
                                             <div class="collapse" id="replyCommentT">
                                                <form>
                                                   <div class="form-group">
                                                      <label for="comment">Your Comment</label>
                                                      <textarea name="comment" class="form-control" rows="3"></textarea>
                                                   </div>
                                                   <button type="submit" class="btn btn-default">Send</button>
                                                </form>
                                             </div>
                                          </div>
                                          <!-- comment-meta -->
                                          <div class="media">
                                             <!-- answer to the first comment -->
                                             <div class="media-heading">
                                                <button class="btn btn-default btn-collapse btn-xs" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseExample"><span class="fa fa-minus" aria-hidden="true"></span></button> <span class="label"><img src="img/uiface.jpg" class="img-circle"></span> <a href="profile.html">@veru</a> 12 sat once yazmis
                                             </div>
                                             <div class="panel-collapse collapse in" id="collapseTwo">
                                                <div class="media-left">
                                                   <div class="vote-wrap">
                                                      <div class="save-post">
                                                         <a href="#"><span class="fa fa-star" aria-label="Save"></span></a>
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
                                                   <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.
                                                   </p>
                                                   <div class="comment-meta">
                                                      <span><a href="#">delete</a></span>
                                                      <span><a href="#">report</a></span>
                                                      <span><a href="#">hide</a></span>
                                                      <span>
                                                      <a class="" role="button" data-toggle="collapse" href="#replyCommentThree" aria-expanded="false" aria-controls="collapseExample">reply</a>
                                                      </span>
                                                      <div class="collapse" id="replyCommentThree">
                                                         <form>
                                                            <div class="form-group">
                                                               <label for="comment">Your Comment</label>
                                                               <textarea name="comment" class="form-control" rows="3"></textarea>
                                                            </div>
                                                            <button type="submit" class="btn btn-default">Send</button>
                                                         </form>
                                                      </div>
                                                   </div>
                                                   <!-- comment-meta -->
                                                </div>
                                             </div>
                                             <!-- comments -->
                                          </div>
                                          <!-- answer to the first comment -->
                                       </div>
                                    </div>
                                    <!-- comments -->
                                 </div>
                                 <!-- first comment -->
                                 <div class="media">
                                    <!-- first comment -->
                                    <div class="media-heading">
                                       <button class="btn btn-default btn-xs" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseExample"><span class="fa fa-minus" aria-hidden="true"></span></button> <span class="label"><img src="img/uiface.jpg" class="img-circle"></span> <a href="profile.html">@guru</a> 12 min ago <span class="pull-right">4 comment</span>
                                    </div>
                                    <div class="panel-collapse collapse in" id="collapseThree">
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
                                          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.
                                          </p>
                                          <div class="comment-meta">
                                             <span><a href="#">delete</a></span>
                                             <span><a href="#">report</a></span>
                                             <span><a href="#">hide</a></span>
                                             <span>
                                             <a class="" role="button" data-toggle="collapse" href="#replyCommentFour" aria-expanded="false" aria-controls="collapseExample">reply</a>
                                             </span>
                                             <div class="collapse" id="replyCommentFour">
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
                                          <div class="media">
                                             <!-- answer to the first comment -->
                                             <div class="media-heading">
                                                <button class="btn btn-default btn-collapse btn-xs" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseExample"><span class="fa fa-minus" aria-hidden="true"></span></button> <span class="label"><img src="img/uiface.jpg" class="img-circle"></span> <a href="profile.html">@terminator</a> 12 days ago
                                             </div>
                                             <div class="panel-collapse collapse in" id="collapseFour">
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
                                                   <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.
                                                   </p>
                                                   <div class="comment-meta">
                                                      <span><a href="#">delete</a></span>
                                                      <span><a href="#">report</a></span>
                                                      <span><a href="#">hide</a></span>
                                                      <span>
                                                      <a class="" role="button" data-toggle="collapse" href="#replyCommentFive" aria-expanded="false" aria-controls="collapseExample">reply</a>
                                                      </span>
                                                      <div class="collapse" id="replyCommentFive">
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
                                                   <div class="media">
                                                      <!-- first comment -->
                                                      <div class="media-heading">
                                                         <button class="btn btn-default btn-xs" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseExample"><span class="fa fa-minus" aria-hidden="true"></span></button> <span class="label"><img src="img/uiface.jpg" class="img-circle"></span> <a href="profile.html">@terminator</a> 12 sat once yazmis
                                                      </div>
                                                      <div class="panel-collapse collapse in" id="collapseFive">
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
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.
                                                            </p>
                                                            <div class="comment-meta">
                                                               <span><a href="#">delete</a></span>
                                                               <span><a href="#">report</a></span>
                                                               <span><a href="#">hide</a></span>
                                                               <span>
                                                               <a class="" role="button" data-toggle="collapse" href="#replyCommentSix" aria-expanded="false" aria-controls="collapseExample">reply</a>
                                                               </span>
                                                               <div class="collapse" id="replyCommentSix">
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
                                                            <div class="media">
                                                               <!-- answer to the first comment -->
                                                               <div class="media-heading">
                                                                  <button class="btn btn-default btn-collapse btn-xs" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseExample"><span class="fa fa-minus" aria-hidden="true"></span></button> <span class="label"><a href="profile.html"><img src="img/uiface.jpg" class="img-circle"></span> @terminator</a> 12 sat once 
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
                                                                     <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.
                                                                     </p>
                                                                     <div class="comment-meta">
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
                                                            <!-- answer to the first comment -->
                                                         </div>
                                                      </div>
                                                      <!-- comments -->
                                                   </div>
                                                   <!-- first comment -->
                                                </div>
                                             </div>
                                             <!-- comments -->
                                          </div>
                                          <!-- answer to the first comment -->
                                       </div>
                                    </div>
                                    <!-- comments -->
                                 </div>
                                 <!-- first comment -->
                              </div>
                              <!-- post-comments -->
                           </div>
                        </div>
							</div>
						</div>
					</div>
						<!-- /#page-content-wrapper -->				
					</div>
				</div>
			</div>
		</div>
		<!--================================================== -->
		<script type="text/javascript">
			$("#menu-toggle").click(function(e) {
				e.preventDefault();
				$("#wrapper").toggleClass("toggled");
			});

		</script>
		<script type="text/javascript">
			$('[data-toggle="collapse"]').on('click', function() {
				var $this = $(this),
				$parent = typeof $this.data('parent')!== 'undefined' ? $($this.data('parent')) : undefined;
				if($parent === undefined) { /* Just toggle my  */
					$this.find('.fa').toggleClass('fa-plus fa-minus');
					return true;
				}

				/* Open element will be close if parent !== undefined */
				var currentIcon = $this.find('.fa');
				currentIcon.toggleClass('fa-plus fa-minus');
				$parent.find('.fa').not(currentIcon).removeClass('fa-minus').addClass('fa-plus');

			});
		</script>
	</body>
	</html>

	<?php 
	    include('../component/f_footer.php');
	    include('../component/f_btm_script.php'); 
    ?>
    <?php
		}
	?>