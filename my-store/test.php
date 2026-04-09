<!DOCTYPE html>
<html lang="en">
<head>
	<title>SharePage.com</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/jquery-ui.min.css"> 
	<link rel="stylesheet" href="../css/home.css"> 
	<script src="../js/jquery-2.1.4.min.js"></script>
	<script src="../js/jquery-1.11.4-ui.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/home.js"></script>
</head>

<body onload="pageOnload('store')">
<?php 
	session_start();
		function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		include_once("../header.php");
	?>
<input class="dynamic-pid" id="sp-Profiles-idspProfiles" name="sp-Profiles-idspProfiles" type="hidden" value="<?php echo $_SESSION['pid']?>">
<div class="container-fluid">
	<div class="row">
		<div class="col-md-1">
			<?php
				include_once("../categorysidebar.php");
			?>
			</div>
		<div class="col-md-10">
			<div class="row">
				<div class="col-md-4 well"><h4>Logo</h4></div>
				<div class="col-md-4"><h4></h4></div>
				<div class="col-md-4 well"><h4>Banner</h4></div>
			</div>
			<?php
				include_once("../Filter/index.php");
			?>
			<div class="panel panel-success">
			  <div class="panel-heading">
				<h3 class="panel-title">My Store</h3>
				 <div class="buttons text-right" id="btngrid2list">
					<button class="btn btn-primary btn-sm active grid"><span class="glyphicon glyphicon-th" aria-hidden="true"></span></button>
					<button class="btn btn-primary btn-sm active list"><span class= "glyphicon glyphicon-th-list" aria-hidden="true"></span></button>
				</div>
			  </div>
			   <div class="panel-body">
					<div class="row">
							<ul class="list-group ">
							<?php
								$p = new _postingview;
								$res = $p-> myallpost($_SESSION['uid']);
								if( $res != false)
								{ 
									while($rows = mysqli_fetch_assoc($res))
									{		
										//echo "<div class='col-md-3 post-container'>";
										echo "<div class='post-grid-item'>";
										echo "<div class='thumbnail imagehover post-highlight'>";
										$pic = new _postingpic;
										$result = $pic->read($rows['idspPostings']);
										if($result!= false)
										{
											$row = mysqli_fetch_assoc($result);
											$picture = $row['spPostingPic'];
											//echo "<img alt='Posting Pic' class='img-thumbnail' style='width:300px; height: 200px;' src=' ".($picture)."' >" ;
												echo "<img alt='Posting Pic' class='img-thumbnail post-img' src=' ".($picture)."' >" ;
									
										}
										
										echo "<h4 style='color:gray;'>" . $rows['spCategoryname'] . "</h4>";
										
										echo  $rows['spPostingtitle'];
									
									if($rows['spPostingPrice'] != false)
									{
										echo "<div><img src='../img/USD-128.png' height='24' width='24'>"." " . $rows['spPostingPrice'] . "</div>";
									}
									else
									{
										echo "<div><img src='../img/USD-128.png' height='24' width='24'>"." " . '0000' . "</div>";
									}

									echo $rows['spPostingExpDt'];
									echo "<div><img src='../img/user.png' alt='...' class='img-circle height='25' width='25''>" ." " .$rows['spProfileName']."</div><br>";
									// messageid of enquired post only
									echo "<div class='row'>";
									echo "<div class='col-md-5'>";
									$e = new _postenquiry;
									$re = $e->read($rows["idspPostings"]);
									if ($re != false){
										echo "<button class='btn btn-default btn-sm dropdown-toggle' type='button' id='dropdownenquiry' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>Enquiries<span class='caret'></span></button>";
										echo "<ul class='dropdown-menu' aria-labelledby='dropdownenquiry'>";
											while($rw = mysqli_fetch_assoc($re))
											{
												echo "<li><span class='icon-enquery glyphicon glyphicon-phone-alt conv-enquire' data-toggle='modal' style='margin-left:10px;' data-target='#conversatation' data-messageid='".$rw['idspMessage']."'> </span> ".substr($rw['message'],0,30)."....</li>";
											}
											echo "</ul>";
										}	
									echo "</div>";
									echo "<div class='col-md-2'></div>";
									echo "<div class='col-md-5'>";
										echo "<span class='icon-bought glyphicon glyphicon-credit-card' style='margin-left:10px;'></span> Bought";
									echo "</div></div>";
									echo "</div></div>";
									}
								}
							?>
						</ul>
				</div><!--div class row-->
	<!--conversation Modal-->
			<div class="modal fade" id="conversatation" tabindex="-1" role="dialog" aria-labelledby="enquireModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
				  <div class="modal-content">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					  <h4 class="modal-title" id="enquireModalLabel">New message</h4>
					</div>
					<div class="modal-body">
						<form action="../enquiry/conversation.php" method="post">
							<input type="hidden" id="spMessaging_idspMessage" name="spMessaging_idspMessage">
							<p id="buyerEnquiry">Message loading...</p>
							<div class="form-group">
							  <label for="message" class="form-control-label">Message</label>
							  <textarea class="form-control" id="message" rows="4" name="spConversation"></textarea>
							</div>
					</div>
					<div class="modal-footer">
					  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					  <button type="submit" class="btn btn-primary">Send message</button>
					</div>
					 </form>
				  </div>
				</div>
			  </div>
	<!--complete-->
			</div>
		</div>
	</div><!--container-->
	<div class="col-md-1 rightposition">
			<?php
					include_once("../sidebar.php");
				?>
		</div>
   </div>
</div>
</body>
</html>
