<!DOCTYPE html>
<html lang="en">
<head>
    <title>TheSharePage.com</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/jquery-ui.min.css">
	<link rel="stylesheet" href="../css/home.css">
	<script src="/js/jquery-2.1.4.min.js"></script>
	<script src="/js/jquery-1.11.4-ui.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/home.js"></script>
</head>
<body onload="pageOnload('cart')">

	<?php
		session_start();
		if(!isset($_SESSION['pid']))
		{	
			include_once ("../authentication/check.php");
			$_SESSION['afterlogin']="cart/";
		}
		function sp_autoloader($class)
		{
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		include_once("../header.php");
		$r = new _sppostrating;
			$res = $r->read($_SESSION["pid"],$_GET["postid"]);
			if($res != false)
			{
				$rows = mysqli_fetch_assoc($res);
				$rat = $rows["spPostRating"];
			}
			else
				$rat = 0;
				
			$result = $r->review($_GET["postid"]);
			if($result != false)
			{
				$total = 0;
				$count = $result->num_rows;
				while($rows = mysqli_fetch_assoc($result))
				{
					$total += $rows["spPostRating"];
				}
				$ratings = $total/$count;
			}
	?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-1">
				<?php
					include_once("../categorysidebar.php");
				?>
			</div>
			<div class="pop-up" style='margin-top:100px ; margin-left:150px;'><!--About Profile-->
				<p id="aboutprofile"></p>
			</div>
			<div class="col-md-8" style="margin-top:20px;">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h2 class="panel-title">
							<span>Customer Review</span>
							<span class="pull-right">Rating <span id="totalrating"><?php echo round($ratings,2);?></span></span>
						</h2>
					</div>
					<div class="panel-body">
						<div class="row">
						<div class="col-md-9">
						<?php
							$p = new _spprofiles;
							$r = new _sppostreview;
							$result = $r->review($_GET["postid"]);
							if($result != false)
							{
								while($rows = mysqli_fetch_assoc($result))
								{
									$res = $p->read($rows["spProfiles_idspProfiles"]);
									if($res != false)
									{
										$row = mysqli_fetch_assoc($res);
										$picture = $row['spProfilePic'];
										
											if(isset($picture))
												echo "<img  alt='Profilepic Pic' class='img-rounded' style='width:50px; height:50px;' src=' ".($picture)."' >" ;

											else
												echo "<img  alt='Posting Pic' class='img-rounded' style='width:80px; height:80px;' src='../img/default-profile.png' >" ;
											
											echo "<b class='searchtimelines' data-profileid='".$row["idspProfiles"]."' style='color:#1a936f; cursor:pointer'> " .$row["spProfileName"]."</b>";
											
											echo "<div style='padding-top:10px;'>".$rows["spPostReviewText"]."</div>";
											
											echo "<div style='color:#1a936f;'>Rating : <b id='latestrate'>".round($rows["spPostRating"])."</b></div>";
											
											//$percent = ($rows["spPostRating"] * 100)/5;
											//echo "<br>".$percent."%";
											//echo "<div style='width:140px;'><div><img src='../img/5star.png' width='100'></div></div>";
										echo "<br>";
									}
									$rs = $p->readProfiles($_SESSION["uid"]);
									if($rs != false)
									{
										while($rspid = mysqli_fetch_assoc($rs))
										{
											if($rspid["idspProfiles"] == $rows["spProfiles_idspProfiles"])
											{
												echo "<a href='#' data-profileid='".$rows["spProfiles_idspProfiles"]."' data-postid='".$_GET["postid"]."' data-toggle='modal' id='writereview' data-target='#reviews' class='editreview' data-reviewid='".$rows["sppostreviewid"]."' data-rvwtext='".$rows["spPostReviewText"]."'>Edit</a><span class='verticalline'></span> <a href='#' data-profileid='".$rows["spProfiles_idspProfiles"]."' data-postid='".$_GET["postid"]."' class='deletereview' data-reviewid='".$rows["sppostreviewid"]."'>Delete</a>";
											}
										}
									}
								 echo "<hr></hr>";
								}
							}
						?>
						
						</div>
						<div class="col-md-3">
						<!--edit/delete your reviews-->
						
							<!--Complete-->
						<?php
							$det = new _postingview;
							$res = $det->read($_GET["postid"]);
							if($res != false)
							{	
								$rows = mysqli_fetch_assoc($res);
									$postingtitle = $rows["spPostingtitle"];
									$postingnotes = $rows["spPostingNotes"];
									$pic = new _postingpic;//Posting Picture
									$result = $pic->read($_GET["postid"]);
									if($result!= false)
									{
										$rp = mysqli_fetch_assoc($result);
										$picture = $rp['spPostingPic'];
									}
									
							}
						?>
							<div><a href="../post-details/?postid=<?php echo $_GET["postid"];?>" style=" text-decoration:none;">
								<div class="thumbnail">
									 <img alt="Posting Pic" src="<?php echo ( $picture); ?>" width="200">
									  <div class="caption">
										<?php
											echo "<p class='title' style='font-size:20px;'>".$postingtitle."</p>";
											echo "<p>".$postingnotes."</p>"; 
										?>
									  </div>
								</div>
							</a></div>
							<!-- Write Review-->
							<div>
								<?php
									$r = new _sppostrating;
									$res = $r->read($_SESSION["pid"],$_GET["postid"]);
									if($res != false)
									{
										$rows = mysqli_fetch_assoc($res);
										$rat = $rows["spPostRating"];
									}
									else
										$rat = 0;
										
									$result = $r->review($_GET["postid"]);
									if($result != false)
									{
										$total = 0;
										$count = $result->num_rows;
										while($rows = mysqli_fetch_assoc($result))
										{
											$total += $rows["spPostRating"];
										}
										$ratings = $total/$count;
									}
									//echo "<img src='../img/5star.png' width='100'><br>" ;
									$r = new _sppostreview;
									$result = $r->review($_GET["postid"]);
									if($result != false)
									{
										$rows = mysqli_fetch_assoc($result);
										$review = $result->num_rows;
									}
									else
										$review = 0;
										
									echo  "<span style='color:blue;' id='review'>".round($ratings,2) ." </span><a href='../customer_reviews/?postid=".$_GET["postid"]."&rating=".round($ratings,2)."' style='color:#1a936f;'><span id='totalreview'>(".$review.")</span> Reviews </a>";
									/*echo "<span class='verticalline'></span>"; 
									echo "&nbsp;&nbsp;<a href='#' data-toggle='modal' id='writereview' class='newreview' data-target='#reviews'>Write Review</a>";*/
								?>
							</div>
								<fieldset id='postrating' class="rating">
									<input class="stars" type="radio" id="star5" name="rating" value="5" />
									<label  style="cursor:pointer" class = "full" for="star5" title="Awesome - 5 stars"></label>
									<input class="stars" type="radio" id="star4" name="rating" value="4" />
									<label style="cursor:pointer" class = "full" for="star4" title="Pretty good - 4 stars"></label>
									<input class="stars" type="radio" id="star3" name="rating" value="3" />
									<label style="cursor:pointer" class = "full" for="star3" title="Meh - 3 stars"></label>
									<input style="cursor:pointer" class="stars" type="radio" id="star2" name="rating" value="2" />
									<label style="cursor:pointer" class = "full" for="star2" title="Kinda bad - 2 stars"></label>
									<input class="stars" type="radio" id="star1" name="rating" value="1" />
									<label style="cursor:pointer" class = "full" for="star1" title="Sucks big time - 1 star"></label>
									
								</fieldset>
							<!--Button Complete-->
							
						</div>
					</div>
				</div>
			</div>
		</div>
			<div class="col-md-1">
				<?php
					include_once("../sidebar.php");
				?>
			</div>
			<div class="col-md-2 hidden-sm hidden-xs" style="margin-top:20px;">
				<?php
					include_once("../adverts.php");
				?>
			</div>
		</div>
		<!--Write Review-->
		<div class="modal fade" id="reviews" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="previouesreview">Write Review</h4>
					  </div>
					  <div class="modal-body">
						<form action="../post-details/addreview.php" method="POST">
							<input type="hidden" class="dynamic-pid" name="spProfiles_idspProfiles" value="<?php echo $_SESSION['pid']?>"/>
							
							<input type="hidden" name="flag_" value="1">
							
							<input type="hidden" id="reviewid" name="sppostreviewid">
							
							<input type="hidden"  name="spPostings_idspPostings" id="spPostings_idspPostings" value="<?php echo $_GET["postid"]?>">
							
							<input type="hidden"  name="spPostRating" id="spPostRating" value="<?php echo $rat;?>">
						  
						  <div class="form-group">
							<textarea class="form-control" id="reviewtext" name="spPostReviewText" placeholder="Write your Review..." rows="5"></textarea>
						  </div>
						  
						  <div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary writereview">Post</button>
						  </div>
						
						</form>
					  </div>
					</div>
				  </div>
				</div>
		<!--Complete-->
		
	</div>
</body>
</html>