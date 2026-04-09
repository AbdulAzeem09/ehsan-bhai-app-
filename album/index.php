<!DOCTYPE html>
<html lang="en">
<head>
	<title>Thethe-share-page.com</title>
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/jquery-ui.min.css">
	<link rel="stylesheet" href="/css/home.css"> 
	<script src="/js/jquery-2.1.4.min.js"></script>
	<script src="/js/jquery-1.11.4-ui.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/home.js"></script>
  </head>
<body><!--onload="pageOnload('admin')"-->
<?php 
	session_start();
	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
	spl_autoload_register("sp_autoloader");
	include_once("../header.php");
?>
<div class="container-fluid" style="margin-bottom:50x;">
	<div class="row">
		<div class="col-md-1 hidden-sm hidden-xs">
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
		<div class="row panel panel-default">
		<div class="panel-heading "><strong>Album</strong></div>
		<div class="panel-body">
				<div class="col-sm-3">
					<div class="list-group sp-album">
					  <!-- Album loading in this section -->
					  <?php
						$p = new _album;
							$result = $p->read($_SESSION['pid']);
							 if ($result != false){
							   while($row = mysqli_fetch_assoc($result)) {
									echo "<a  id='albumid". $row['idspPostingAlbum'] ."' href='albumdetails.php' class='list-group-item sp-album-label' data-albumid='" . $row['idspPostingAlbum'] . "'>";
									echo $row['spPostingAlbumName'] . "</a>";
								}
							}
						?>
					</div>
					
					<form action="createalbum.php" method="post" id="sp-create-album">
						<div class="form-group">
							<label for="spAlbumName" class="control-label">Create New Album</label>
							<input type="text" class="form-control" id="spAlbumName" name="spPostingAlbumName">
						</div>
						
						<input class="dynamic-pid" type="hidden" id="myprofileid" name="spProfiles_idspProfiles" value="<?php echo $_SESSION['pid'];?>">
						
						<div class="form-group">
							<label for="spAlbumDescription">Description</label>
							<textarea class="form-control" id="spAlbumDescription" name="spPostingAlbumDescription"></textarea>
						</div>
						
						<div class="col-md-12 text-right">
							<button id="spaddalbum" type="submit" class="btn btn-success">Add</button>
						</div>
					</form>
				</div>
				<div class="col-sm-9 sp-album-details">
				</div>
			</div>
		</div>
	</div>
		<div class="col-md-1 hidden-sm hidden-xs">
			<?php
					include_once("../sidebar.php");
				?>
		</div>
  </div>
</div>	
</body>	
</html>