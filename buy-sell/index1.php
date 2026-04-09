<!DOCTYPE html>
<html lang="en">
<head>
  <title>SharePage.com</title>
  <link rel="stylesheet" href="../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../css/jquery-ui.min.css">
	<link rel="stylesheet" href="../css/home.css">   
  </head>
	<body>
		<?php 
			session_start(); 
			include_once("../header.php");
			function sp_autoloader($class){
				include '../mlayer/' . $class . '.class.php';
			}
			spl_autoload_register("sp_autoloader");
		?>
	<div class="container">
			   <div class="panel-body">
				  <?php
					$p = new _postingview;
					$rpvt = $p->read($_GET["postid"]);
					  if ($rpvt != false){
						$row = mysqli_fetch_assoc($rpvt);
						$price = $row['spPostingPrice'];
					  }
						$pc = new _postings;
						$res = $pc->postingpic($_GET["postid"]);
						if ($rpvt != false){
							$rows = mysqli_fetch_assoc($res);
						}
					?>
					<div class="row">
						<div class="col-md-5">
						<?php 
							echo "<a href='/".$row['spCategoryFolder']."' style='color:gray;'><span class='glyphicon glyphicon-home' aria-hidden='true'>" .$row['spCategoryname']."</span></a>";
						?>
						 <div style="width:400px;height:276px"><img id="profilepicture" src="<?php echo ($rows['spPostingPic']); ?>" alt="Posting Pic" class="img-rounded img-thumbnail sppointer" style="width:400px; height:276 px;" data-toggle="modal" data-target="#imageModal"></div><br>
				<!-- modal-->
					 <div class="modal fade" id="imageModal" role="dialog">
						<div class="modal-dialog modal-lg">
							 <div class="modal-content">
								<div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal">&times;</button>
									  <h4 class="modal-title" style=""><?php echo $row['spPostingtitle']?></h4>
								</div>
								<div class="modal-body">
									<img id="profilepicture" src="<?php echo ($rows['spPostingPic']); ?>" alt="Posting Pic" class="img-rounded img-thumbnail" style="width:800px; height:400px;">
								</div>
							  </div>
						</div>
					  </div>
				<!--Modal complete-->
				
							<!--<div style="padding:10px;">
								<?php 
									/*$pc = new _postings;
									$res = $pc->postingpic($_GET["postid"]);
									if ($rpvt != false){
										while($rows = mysqli_fetch_assoc($res))
										{
											$picture = $rows['spPostingPic'];
											echo "<img  alt='Posting Pic' class='img-thumbnail imagehover sppointer' style='width:72px; height: 72px;' src=' ".($picture)."' >" ;
											echo "\x20\x20\x20";
											
										}
								}*/
								?>
							</div>-->
						</div>
						<div class="col-md-4">
								<?php 
									echo "<h4>Title</h4>" .$row['spPostingtitle'] ;
									echo "<br><br>";
									echo   "<h4>Expiry</h4>" .$row['spPostingExpDt'] ;
									echo "<br><br>";
									if($price != false){
										echo   "<h4>Price</h4>" .$row['spPostingPrice'];
										echo "<br><br>";
									}
									$postdate = strtotime($row['spPostingDate']);
									$currentdate = strtotime(date('Y-m-d h:i:sa'));
									$Diff = abs($currentdate - $postdate);
									$numberDays = $Diff/86400;  // 86400 seconds in one day
									// it cinvert in integer form
									$numberDays = intval($numberDays);
									
									echo "<h4>Posting date</h4>".$numberDays ." "."days ago";
								?>
								
						</div>
						<div class="col-md-3">
							<img id="profilepicture" src="<?php echo ( $row['spProfilePic'] ); ?>" alt="Profile Pic" class="img-circle" style="width: 150px; height: 150px; margin-left:35px">
							<h4 style="color:black;margin-left:20px;"><?php  echo $row['spProfileName'];?></h4>
							 <a href="https://www.onlinesbi.com/" class="btn btn-success btn-md" style=" margin-top:2cm; margin-left:2cm; width:2cm;" role="button">Pay</a>
						</div>
				</div></br><!--first class row-->
				
				<div class="panel panel-success">
					<div class="panel-heading">
					 <h3 class="panel-title">Details <p class="pull-right">Ad ID :<?php echo $_GET["postid"] ?></p></h3>
				  </div>
					<div class="panel-body">
					<h4>Description</h4>
							<?php 
								echo $row['spPostingNotes'];
								echo  "</br></br>";
							?>
							
						<div class="row">
							<?php
								$p = new _postfield;
								$res = $p->read($_GET["postid"]);
								 if ($res != false){
									while($rows = mysqli_fetch_assoc($res))
									{
										echo  "<div class='col-md-3'>";
										echo  "<h4>" .$rows['spPostFieldLabel']."</h4>";
										echo $rows['spPostFieldValue'];
										echo "<br><br>";
										echo "</div>";
									}
								  }
							?>
						</div>
					</div><!--second panel body-->
				</div><!--panel success-->
			</div><!--first panel body-->
	</div><!--container-->
	<script src="../../js/jquery-2.1.4.min.js"></script>
	<script src="../../js/jquery-1.11.4-ui.min.js"></script>
	<script src="../../js/bootstrap.min.js"></script>
	<script src="../../js/home.js"></script>
	
</body>
</html>