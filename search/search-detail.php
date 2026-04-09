<?php
	session_start();

	include('../univ/baseurl.php');
	require_once($_SERVER[ 'DOCUMENT_ROOT' ] . "/testing/univ/main.php" );  
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include('../files/links.php');?>
</head>
<body onload="pageOnload('cart')">
	<?php
		include_once("../files/home-header.php");
	?>
	<div class="container lock ">
		<hr class='hrline'>
		<div class="bhome <?php echo (isset($_GET["login"]) ? '"style="display: none;"' : 'curr"'); ?>">
		<div class="row" style="min-height: 400px;">
		
			<?php
				$p = new _postingview;
				$rd = $p->read($_GET["postid"]);
				  	if ($rd != false){
						$row = mysqli_fetch_assoc($rd);
						$price = $row['spPostingPrice'];
						$catid = $row["idspCategory"];
						$wholesaleflag = $row["spPostingsFlag"];
						$button = $row["spCategoriesButton"];
						$comment = $row["sppostingscommentstatus"];
				 	}
					  
					//Services Company Name
					$p = new _postfield;
					$res = $p->readfield($_GET["postid"]);
					if ($res != false)
					{
						while($rows = mysqli_fetch_assoc($res))
						{
							if($rows['spPostFieldLabel'] == "Company")
							 $company = $rows['spPostFieldValue'];
						    
							if($rows['spPostFieldLabel'] == "Discount")
								$discount = $rows['spPostFieldValue'];
								
						}
					}
					?>
					
					<div class="row" style="margin-top: 60px;">
						<div class="col-md-4 <?php echo ($catid !=2 && $catid !=5 ? "":"invisible");?>">
							<?php 
							
							$media = new _postingalbum;
							$result = $media->read($_GET["postid"]);
							if( $result != false)
							{
								if( $row['spCategoryFolder'] == "videos" || $row['spCategoryFolder']== "trainings" || $row['spCategoryFolder']== "recipes")
								{	
									$r = mysqli_fetch_assoc($result);
									$picture = $r['spPostingMedia'];
									echo "<div><video width='320' height='180' controls><source class='img-thumbnail imagehover sppointer postingpicture' src='data:video/mp4;base64, ".($picture)."'></video></div>"; 
								}
								
								elseif($row['spCategoryFolder'] == "music")
								{
									$r = mysqli_fetch_assoc($result);
									$picture = $r['spPostingMedia'];
									echo "<div><audio width='320' height='180' controls><source class='img-thumbnail imagehover sppointer postingpicture' src='data:audio/mp4;base64, ".($picture)."'></audio></div>";
								}
								
								elseif($row['spCategoryFolder'] == "documents")
								{
									$r = mysqli_fetch_assoc($result);
									$picture = $r['spPostingMedia'];
									echo " <div><iframe class='sppointer postingpicture' src='data:application/pdf;base64, ".($picture)."'></iframe></div>";
								}
								
								
								elseif($row['spCategoryFolder'] == "photos")
								{
									$r = mysqli_fetch_assoc($result);
									$picture = $r['spPostingMedia'];
									echo "<div style='width:100%;height:276px'><img  alt='Posting Pic' class='img-thumbnail imagehover postingpicture' style='width:400px; height: 276px;' src=' ".($picture)."' ></div>" ;
								}
								
							}
							
							 elseif($row['spCategoryFolder'] != "videos" && $row['spCategoryFolder'] != "music" && $row['spCategoryFolder'] != "documents" && $row['spCategoryFolder'] != "photos")
								{
									if($catid !=2 && $catid != 5){
										$picture= null;
										
										$pc = new _postingpic;
										$res = $pc->read($_GET["postid"]);
										if ($res != false)
										{
											$postr = mysqli_fetch_assoc($res);
											$picture = $postr['spPostingPic'];
											//echo "<div style='width:100%; height:276px;text-align: center;' class='divimgborder'><img  alt='Posting Pic' class='img-thumbnail imagehover sppointer postingpicture originalimg img-responsive' data-toggle='modal' data-target='#imageModal' src=' ".($picture)."' ></div>" ;
										}
										
										else
											echo "<div style='width:100%; height:276px;text-align: center;' class='divimgborder'><img  alt='Posting Pic' src='../img/no.png' class='img-thumbnail imagehover sppointer post-highlight originalimg img-responsive'></div>" ;
									}
								}
				
								else
									echo "<div style='width:100%; height:276px;text-align: center;' class='divimgborder'><img  alt='Empty-media' class='img-thumbnail imagehover sppointer post-highlight originalimg img-responsive'></div>" ;
						?>
						<!--Testing carausel-->
				
						<div id="myCarousel" class="carousel slide <?php echo (($catid ==2 ||$catid ==5 || $catid ==6 || $catid ==10 || $catid ==14 || $catid ==13 ||$picture == null) ?"hidden":"")?>" data-ride="carousel">
							<div style='width:100%; height:276px;'>
								<!-- Wrapper for slides -->
								 <div class="carousel-inner" role="listbox">
									<div class="item active checkactive">
										<img src="<?php echo ($postr['spPostingPic']); ?>" alt="Posting Pic" class="originalimg postingpicture "  data-toggle='modal' data-target='#imageModal' style='max-height:276px;'>
									</div>
									<?php
										$pc = new _postingpic;
										$postpicres = $pc->read($_GET["postid"]);
										if ($postpicres != false)
										{
											while($rows = mysqli_fetch_assoc($postpicres))
											{	
												$picture = $rows['spPostingPic'];
												echo "<div class='item checkactive'>";
													echo "<img  alt='Posting Pic'  src=' ".($picture)."' class='originalimg postingpicture checkactive' data-toggle='modal' data-target='#imageModal' style='max-height:276px;'>";
												echo "</div>";
												
											}
										}
									?>
								</div>
							</div>
							<!-- Left and right controls -->
							<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left prvnxt" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							
							<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right prvnxt" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
							</a>
						</div>

						<!--Complete-->
						<div style="padding:10px;" class="socials">
							<?php 
								//Small Image
								if($catid != 2 && $catid !=5){
									$pc = new _postingpic;
									$postpicres = $pc->read($_GET["postid"]);
									if ($postpicres != false)
									{
										while($rows = mysqli_fetch_assoc($postpicres))
										{	
											$picture = $rows['spPostingPic'];
											echo "<img  alt='Posting Pic' class='img-thumbnail imagehover sppointer post-highlight' style='width:72px; height: 72px;' src=' ".($picture)."' >" ;
											echo "\x20\x20\x20";
										}
									}
								}
										
							?>
						</div>



						</div>


							<div class="row">
								<!--<h5 class='title' style="color:#1a936f;"><?php echo ( isset($discount)?  $discount."% Discount":""); ?></h5>-->
								<h5 class='title'><?php if(isset($company)){echo  $company;} ?></h5><!--Service Company-->
								<h5 class='title' style="font-size:20px;<?php echo (isset($company)?"color:#434d56" : ""); ?>"><?php echo $row['spPostingtitle']; ?></h5>
								<h5 style="color:#1a936f;"><?php echo ( isset($discount)?  $discount."% Discount":""); ?></h5>
								<div class="col-md-6">
									<?php 
										$price = 0;
										if(isset($row['spPostingPrice']))
											$price = $row['spPostingPrice'];
										$productname = $row['spPostingtitle'];
										//echo "<p>".$row['spPostingNotes']."</p>";
										$postingnotes = $row['spPostingNotes'];
										
										if($price != false)
										{
											$pr = new _postfield;
											$re = $pr->readprice($_GET["postid"]);
											if($re != false)
											{	
												echo "Price $".$row['spPostingPrice']."/hour";
											}
											else
											{
												if($catid == 9)
												{
													$ticketprice = $row['spPostingPrice'];
													echo "Ticket Price $".$row['spPostingPrice'];
												}
												else
													echo "Price $".$row['spPostingPrice'];
													
											}
												
										}
									
										
										$dt = new DateTime($row['spPostingDate']);
										$postdate = strtotime($row['spPostingDate']);
										$currentdate = strtotime(date('Y-m-d h:i:sa'));
										$Diff = abs($currentdate - $postdate);
										$numberDays = $Diff/86400; 
										$numberDays = intval($numberDays); 
										
										//echo "<div>Posted on ".$dt->format('Y-m-d')."<span class='verticalline'></span> ".$numberDays ." "."days ago</div>";
										
										echo "<div>Country ".$row['spPostingsCountry']."</div>";
										
										echo "<div>City ".$row['spPostingsCity']."</div>";
										$catid = $row['idspCategory'];
										
										if($catid !=18 && $catid !=9 && $catid !=5 && $catid !=2 && $catid !=12 && $catid !=3)
										{
											if($row['sppostingShippingCharge'] == 0 )
											{
												echo "<h4><b>Free Shipping</b></h4>";
											}
											else
												echo "<h4><b>Delevery Charge :".$row['sppostingShippingCharge']."$</b></h4>";
										}
										
								//Quantity availability of this post
										$pr = new _postfield;
										$re = $pr->quantity($_GET["postid"]);
										//echo $pr->ta->sql;
										if($re != false)
										{	$i = 0;
											$rw = mysqli_fetch_assoc($re);
											$totalquantity = $rw["spPostFieldValue"];
										}
										
										else
										{
											if($catid == 8 || $catid == 10 || $catid == 11 ||$catid == 13 || $catid == 14)
												$totalquantity =  INF;
											else
												$totalquantity = 1;
										}
											
											
										
										$or = new _order;
										$total = 0;
										$res = $or->quantityavailable($_GET["postid"]);
										if($res != false)
										{
											while($order = mysqli_fetch_assoc($res))
											{
												if($order["spOrderStatus"] == 0)
												{
													$soldquantity += $order["spOrderQty"];
												}	
													
											}
										}
										if(isset($soldquantity)){
											$available = $totalquantity - $soldquantity;
										}
										
										//if($button == "Buy" && $catid != 3 )
										if($catid == 1 || $catid == 9 || $catid == 15)
											echo "<p> Quantity Available ".$available."</p>";
										
									?>
								<div class="<?php echo ($_GET["previewid"] == 1?"hidden":"");?>">
									
									
									
									<br>
									<div class="row <?php echo ($catid == 12 || $catid == 2 || $catid == 5 ? "hidden":"");?>">
										<div class="col-md-7">
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
										</div>
										<div class="col-md-5" style="margin-top:10px; color:#1a936f;">
											<?php 
												if(isset($ratings)){
													echo "Rating <span id='rate'>".round($ratings,2)."</span>";
												}
												
											?>
										</div>
									</div>
					<!--Most 3 recent review on this post-->
					
					<div class="friend_message">
						
						<?php
							$p = new _spprofiles;
							$r = new _sppostreview;
							$result = $r->topreview($_GET["postid"]);
							if($result != false)
							{	
								echo "<p class='title' style='font-size:20px;'>Reviews :</p>";
								echo "<div class='friend_message reviews'>";
								while($rows = mysqli_fetch_assoc($result))
								{
									$res = $p->read($rows["spProfiles_idspProfiles"]);

									if($res != false)
									{
										$row = mysqli_fetch_assoc($res);
										$profid = $row["idspProfiles"];
										$picture = $row['spProfilePic'];
										
											if(isset($picture))
												echo "<img  alt='Profilepic Pic' class='img-rounded' style='width:30px; height:30px;' src=' ".($picture)."' >" ;

											else
												echo "<img  alt='Posting Pic' class='img-rounded' style='width:30px; height:30px;' src='../img/default-profile.png' >" ;
											
											echo "<b class='searchtimelines' data-profileid='".$row["idspProfiles"]."' style='color:#1a936f; cursor:pointer'> " .$row["spProfileName"]."</b>";
											
											echo "<div style='padding-top:10px;'>".$rows["spPostReviewText"]."</div>";
											
										echo "<br>";
									}
								 echo "<hr></hr>";
								}
								echo "<a href='../customer_reviews/?postid=".$_GET["postid"]."' style='color:#1a936f;' class='pull-right'>See all reviews </a>";
								echo "</div>";
							}
						?>
					</div>
					</div>
					<!--Complete-->
				</div>
						<div class="col-md-6 stroredes <?php echo ($wholesaleflag == 0 && $catid == 1 ? '""' : "hidden"); ?>">
							<h4 style="color:#1a936f;font-size:18px;" class="title">Store Description</h4>
							<?php
								$s = new _spprofiles;
								 $res = $s->read($row['idspProfiles']);
								 if($res != false)
								 {
									 $rset = mysqli_fetch_assoc($res);
									 echo "<p style='padding:5px;'>".$rset["spProfilesAboutStore"]."</p>";
									 $prpic = $rset["spProfilePic"]; 
									 
								 }
							?>
						</div>
					</div>



				</div>
			</div>
			</div>
			<div class="row">

				<div class="col-md-6">
					<div class=" blog <?php echo (isset($_GET["login"]) ? ' curr"' : '" style="display: none;"'); ?>">
						<form id="blogin" class="container-fluid" method="post" action="../authentication/login.php">
							<div class="rgform">
								<div class="insidefrm loginform">
									<div class="row" >
										<h2>Login</h2>
										<div class="col-sm-12">
											<div class="form-group has-feedback">
												<label for="regname" >Username</label>
												<div class="input-group">
													<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
													<input type="text" id="loginame" class="spUserName form-control " data-lo="1" name="spUserName" placeholder="Username" pattern="[A-Za-z0-9\-_\.]{4,16}" autofocus required minlength="4" maxlength="16">
												</div>
												<span id="regnamecheck" class="hidden glyphicon form-control-feedback" aria-hidden="true"></span>
												<span id="bspUserNameSuccess1Status" class="sr-only">(success)</span> 
											</div> 
										</div>
										<div class="col-sm-12">
											<div class="form-group has-feedback">
												<label for="bpass" >Password</label>
												<div class="input-group">
												<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
												<input type="password" class="form-control " id="lpass" name="spUserPassword" placeholder="Password" required minlength="6"> 
												</div>
												<span class="hidden glyphicon glyphicon-ok form-control-feedback1"  aria-hidden="true"></span>
												<span id="bpassSuccess1Status" class="sr-only">(success)</span> 										
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<button id="bforpass" type="button" style="font-size:17px;padding-left: 0px" class="btn btn-link pull-left">Forgot Password?</button>
										</div>
										<div class="col-sm-6 ">
											<button id="signin" type="submit" data-loading-text="Authenticating..." class="btn butn-logo pull-right" autocomplete="off"><i class="fa fa-lock"></i> Sign In</button>
											
										</div>
									</div>
									
								</div>
							</div>
						</form>
					</div>

				</div>
				<div class="col-md-6">
					<div class=" blog <?php echo (isset($_GET["login"]) ? ' curr"' : '" style="display: none;"'); ?>">
						<div class="leftbordr"></div>
						<form id="buRegForm" class="container-fluid"  autocomplete="on" method="post" action="../authentication/register.php">
							<div class="rgform">
								<div class="insidefrm loginform">
									<input type="hidden" class="spProfileType_idspProfileType" name="spProfileType_idspProfileType_" value="4">
									<input id="uType" type="hidden" value="3">
									<div class="row"> 
										<h2>Register</h2>
										<div class="col-sm-12"> 
											<div class="form-group has-feedback">
												<label for="spUserName">Username</label>
												<div class="input-group">
													<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
													<input type="text" class="spUserName form-control" id="spUserName" data-lo="0" name="spUserName" placeholder="Username" pattern="[/^\S+$/0-9\-_\.]{4,250}" autofocus required minlength="4" maxlength="250" title="Must contain at least 4 or more characters">
												</div>
												<span class="hidden glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
												<span id="bspUserNameSuccess1Status" class="sr-only">(success)</span> 
											</div>
										</div>
										<div class="col-sm-12"> 
											<div class="form-group has-feedback">
												<label for="spUserEmail" >Email</label>
												<div class="input-group">
													<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
													<input type="email" class="form-control" id="spUserEmail" name="spUserEmail" placeholder="Email" required>
												</div>
												<span class="hidden glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
												<span id="bregemailSuccess1Status" class="sr-only">(success)</span> 
												<div id="checkemail" style="color:black"></div>
											</div>
										</div>
									</div>
									
									<div class="row">	
										<div class="col-sm-12">
											<div class="form-group has-feedback">
												<label for="spUserEnpass">Password</label>
												<div class="input-group">
												<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
												<input type="password" class="form-control" id="bpass" name="spUserPassword" placeholder="Password" required  title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"  >
												</div>
												<span class="hidden glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
												<span id="spUserEnpassSuccess1Status" class="sr-only">(success)</span>
											</div>
										</div>
										<div class="col-sm-12"> 
											<div class="form-group has-feedback">
												<label for="respUserEnpass" >Confirm Password</label>
												<div class="input-group">
												<span class="input-group-addon"><span class="glyphicon glyphicon-refresh"></span></span>
												<input type="password" class="form-control" id="respUserEnpass" name="respUserEnpass_" placeholder="Confirm password" required minlength="6">
												</div>
												<span class="hidden glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
												<span id="respUserEnpassSuccess1Status" class="sr-only">(success)</span> 										
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-9"></div>
										<!--Testing-->
										<!--<div class="col-md-2">
											<div class="form-group">
												<div class="dropdown">
													<button class="btn btn-success btn-md dropdown-toggle pull-right" type="button" id="profiletypes" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Select Profile<span class="caret"></span>
													</button>
													<ul class="dropdown-menu" id="iddropdown" aria-labelledby="profiletypes">
														<?php 
															$pt = new _profiletypes;
															$rpt = $pt->read();
															if ($rpt != false){
																while($row = mysqli_fetch_assoc($rpt)) {
																	echo "<li><a class='profiletypes-dd' data-ptid='".$row['idspProfileType']."' href='#' >".$row['spProfileTypeName']."</a></li>";
																}
															}
														?>
													</ul>
												</div>							
											</div>
										</div>-->
										<!--Testing complete-->
							
										<div class="col-md-3">
											<button id="buregister" type="submit" data-loading-text="Registering..."  name="submit" class="btn butn-logo pull-right" autocomplete="off"><i class="fa fa-user"></i> Register</button>&nbsp;
											
										</div>
									</div>
								</div>
							</div>
						</form> 
					</div>

				</div>
				
			
		
			</div>




		</div>
		<div class="space-lg"></div><div class="space-lg"></div>
	<?php include('../files/home-footer.php');?>
</body>
</html>