<!DOCTYPE html>
<html lang="en">
<head>
	<title>SharePage.com</title>
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/jquery-ui.min.css">
	<link rel="stylesheet" href="/css/font-awesome.min.css"> 
	<link rel="stylesheet" href="/css/home.css"> 
	<script src="/js/jquery-2.1.4.min.js"></script>
	<script src="/js/jquery-1.11.4-ui.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/gdocsviewer.min.js"></script>
	<script src="/js/home.js"></script>
	
	<!--Testing-->
	<meta name="author" content="Script Tutorials" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

</head>
	<body style="background-color:#e6e6e6;">
		<?php 
			session_start(); 
			function sp_autoloader($class){
				include '../mlayer/' . $class . '.class.php';
			}
			spl_autoload_register("sp_autoloader");
			include_once("../header.php");
		?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-1">
			<?php
					include_once("../categorysidebar.php");
				?>
		</div>
			
	<div class="col-md-10">
	
		<div class="row <?php echo (isset($_GET["myplaylist"])?"hidden":"");?>">
			<div class="col-md-8">
				<!--Video Search box-->
				<div class="input-group" style="margin-bottom:10px;">
				  <input type="text" class="form-control" placeholder="Search" aria-describedby="basic-addon2" id="searchtx">
				  <span class="input-group-addon" id="basic-addon2"><span class="glyphicon glyphicon-search"></span></span>
				</div>
				
				
				<div class="video social">
					<!--Dynamic media load-->
					<div id="defvid" class="loadmyplayer">
						<?php 
							if(isset($_GET["video"]))
								include ("defaultvideo.php");
						?>
					</div>
				</div>
				
			</div>
			<div class="col-md-4" style="background-color:white;">
			
			<!--Myplaylist-->
			<div class="dropdown loadmyplayer" style="padding:10px;">
				<button class="btn btn-primary dropdown-toggle playlistddown"  data-toggle="dropdown"><span id="plyname">My Playlists</span> <span class="glyphicon glyphicon-headphones" data-toggle="tooltip" data-placement="left" title="Playlist"></span><span class="caret"></span></button>
				<ul class="dropdown-menu myplaylist" id="plylistdd">
				<?php
					$p = new _album;
					$res = $p->myalbum($_SESSION['uid']);
					if ($res != false){
						while($rows = mysqli_fetch_assoc($res)) {
							echo "<li><a href='#' class='playlistdd' data-albumid='".$rows['idspPostingAlbum']."'>".$rows['spPostingAlbumName']."<span class='pull-right ".($rows['sppostingalbumFlag'] == 10 ?"glyphicon glyphicon-facetime-video":"glyphicon glyphicon-music")."' ><span></a></li>";					
						}
					}
				?>
				</ul>
				<button type="button" class="btn btn-primary pull-right autoplay"><span class="fa fa-play-circle-o"></span> Play all</button>
			</div><br>
		
			
			
			<!--Myplaylist for video complete-->
			<div class="loadmyplayer playlistitm">
			<div class="freeplayer" style="max-height:600px; overflow-y: auto; overflow-x: hidden;">
			<?php
				$vm = new _postingview;
				$media = new _postingalbum;
				
				if(isset($_GET["video"])) //Video
				{
					$result = $vm->video();
					if($result != false)
					{
						while($rows = mysqli_fetch_assoc($result))
						{
						    $res = $media->read($rows["idspPostings"]);
							if($res != false)
							{ 
								$row = mysqli_fetch_assoc($res);
								echo "<div class='row searchable' style='margin-bottom:10px;'>";
								echo "<div class='col-md-6'>";
									echo "<a href='#' data-postid='".$rows["idspPostings"]."' class='mediapost'><video width='100%' height='120px;' style='background-color:black;' ><source class='img-thumbnail imagehover sppointer videothumb' src='data:video/mp4;base64, ".($row["spPostingMedia"])."'></video></a>";
									
								echo "</div>";
								echo "<div class='col-md-6'>";
									echo "<p style='font-size:15px;font-weight:bold;'>".$rows["spPostingtitle"]."</p>";
									echo "<p class='searchtimelines' data-profileid='".$rows["idspProfiles"]."' style='cursor:pointer;'>Posted by : ".$rows["spProfileName"]."</p>";
								echo "</div>";
								echo "</div>";
							}
						}
					}
				}
			?>
			</div>
			
			<div class="pop-up" style="margin-top:150px;margin-left:-250px;">
				<p id="aboutprofile"></p>
			</div>
			<!--My Playlist For Audio-->
			<div class="freeplayer <?php echo (isset($_GET["audio"])?"":"hidden")?>" style="max-height:900px; overflow-y: auto; overflow-x: hidden;">
			<table class="table table-hover <?php echo (isset($_GET["audio"])?"":"hidden")?>">
				<thead>
				  <tr>
					<th>Title</th>
					<th>Posted By</th>
					<th>Album</th>
				  </tr>
				</thead>
				<tbody>
				<?php
				$vm = new _postingview;
				$media = new _postingalbum;
				$result = $vm->music();
					if($result != false)
					{
						while($rows = mysqli_fetch_assoc($result))
						{
						   $res = $media->read($rows["idspPostings"]);
						   
							if($res != false)
							{ 
						
								$row = mysqli_fetch_assoc($res);
								echo "<tr class='searchable musicpost' style='cursor:pointer;' data-postid='".$rows["idspPostings"]."'>";
									$_POST["postid"]= $rows["idspPostings"];
									//Adding in playlistdd
									
									echo "<td>".$rows["spPostingtitle"]."</td>";
									
									echo "<td><span class='searchtimelines' data-profileid='".$rows["idspProfiles"]."'>".$rows["spProfileName"]."</span></td>";
									
									echo "<td>".$row["spPostingAlbumName"]."</td>";
								echo "</tr>";
							/*echo "<div class='row'>";
								//echo "<div class='col-md-2'></div>";
								echo "<div class='col-md-12'>";
							//Music Details Code 	
								echo "<div class='row searchable musicpost' style='cursor:pointer;' data-postid='".$rows["idspPostings"]."'>";
									echo "<div class='searchable musicpost' style='cursor:pointer;' data-postid='".$rows["idspPostings"]."'>";
									echo "<div class='col-md-5'>".$rows["spPostingtitle"]."</div>";
									
									echo "<div class='col-md-4'>".$rows["spProfileName"]."</div>";
									
									echo "<div class='col-md-3'>".$row["spPostingAlbumName"]."</div>";
								echo "</div>";
								echo "</div>";
								echo "<hr class='hrline' style='margin-top:5px;'>";
							//Music Details Code Complete
							echo "</div>";
							echo "</div>";*/
							}
						}
					}
				?>
				</tbody>
			 </table>
			</div>
			</div>
		</div>
	</div>
	<!--Myplaylist Code testing-->
	<div class="<?php echo (isset($_GET["myplaylist"])?"":"hidden");?>">
		<?php include("myplaylist.php"); ?>
	</div>
	<!--Myplaylist Code testing complete-->
	
</div><!--Col-md-10-->
	
	<div class="col-md-1">
		<?php
			include_once("../sidebar.php");
		?>
	</div>
</div>
	<?php include("share.php");//share Post?>
</div><!--container-->
</body>
</html>