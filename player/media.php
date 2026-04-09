<script>
	function myFunction() {
		var popup = document.getElementById('myPopup');
		popup.classList.toggle('show');
	}
</script>

<?php
	session_start(); 
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
			
 //Finding media
	$media = new _postingalbum;
	$res = $media->read($_POST["postid"]);
	if($res != false)
	{
		$row = mysqli_fetch_assoc($res);
		$media = $row["spPostingMedia"];
	}
	
	$vm = new _postingview;
	$res = $vm->read($_POST["postid"]);
	if($res != false)
	{
		$rows = mysqli_fetch_assoc($res);
		$title = $rows["spPostingtitle"];
		$desc = $rows["spPostingNotes"];
		$poster = $rows["spProfileName"];
		$views = $rows["sppostingsViews"];
		$category = $rows["idspCategory"];
		$pid = $rows["idspProfiles"];
		$posterdesc = $rows["spProfileAbout"];
		$img = $rows["spProfilePic"];
		
		
	}
	$total = $views + 1;
	//Update Views
	$p = new _postings;
	$p->totalview($_POST["postid"] , $total);
?>

<input class="dynamic-pid" id="sp-Profiles-idspProfiles" name="sp-Profiles-idspProfiles" type="hidden" value="<?php echo $_SESSION['pid']?>">
<div>
	<div class="videoWrapper">
		<iframe width="560" height="349" class="videoplay" src="data:video/mp4;base64,<?php echo ($media); ?>" frameborder="0" allowfullscreen></iframe>
	</div>
	
	<div class="hidden entertainment" data-entertain="data:video/mp4;base64,<?php echo ($media); ?>"></div>
	
	<div style="background-color:white;margin-top:10px;">
		<p class="videotitle"><?php echo $title; ?></p>
		<p class="videomusic"><?php echo $desc; ?></p>
		<div class="videomusic popup" onclick="myFunction()">
			<div class="row">
				<a href="/friends/?profileid=<?php echo $pid;?>"><p class="videoposter" style="cursor:pointer;margin-left:2px;" data-profileid="<?php echo $pid;?>"><span>Posted By :</span><?php echo $poster; ?></p></a>
			
			
				<!--<div class="card popuptext" id="myPopup">
					<img src="<?php echo ($img); ?>" alt="Avatar" style="width:100%">
					<div class="container">
						<h4><b><?php echo $poster;?></b></h4> 
						<p><?php echo $posterdesc;?></p> 
					</div>
				</div>-->
			</div>
		</div>
		<hr>
		
		
		<!--Socializing code-->
			<div class="vidmusic">
			<?php
			echo "<div class='row'>";
			echo "<div class='col-md-6'>";//SharePage Liked post
			include("addtomylist.php");
			$pl = new _postlike;
			$r = $pl->readnojoin($_POST["postid"]);
			if( $r != false)
			{	$i = 0;
				$liked = $r->num_rows;
				while($row = mysqli_fetch_assoc($r))
				{
					if($row['spProfiles_idspProfiles'] ==  $_SESSION['pid'])
					{
						echo "<span data-toggle='tooltip' data-placement='bottom' title='Unlike' class='icon-socialise fa fa-thumbs-up spunlike' data-postid='" . $rows['idspPostings'] . "' data-liked='". $r->num_rows ."'> (" . $r->num_rows . ")</span>";
						$i++;
					}
				}
				if($i == 0)
				{	
					echo "<span data-likeid='postid". $_POST["postid"] ."' data-toggle='tooltip' data-placement='bottom' title='Like' class='icon-socialise sp-like fa fa-thumbs-o-up' data-postid='" . $_POST["postid"] . "' data-liked='". $r->num_rows ."'> (" . $r->num_rows . ")</span>";
				}
			}

			else
			{
				$liked=0;
				echo "<span data-likeid='postid". $_POST["postid"] ."' data-toggle='tooltip' data-placement='bottom' title='Like' class='icon-socialise sp-like fa fa-thumbs-o-up' data-postid='" . $rows['idspPostings'] . "' data-liked='". $liked ."'></span>";
			}//SharePage like complete

			echo "<a href='#' data-toggle='modal' data-target='#myshare'><span data-toggle='tooltip' data-placement='bottom' title='Share' class='icon-share glyphicon glyphicon-share sp-share' style='margin-left:10px;' data-postid='" . $_POST["postid"] . "' src=' ".($picture)."'></span></a>";

			$pl = new _favorites;
			$re = $pl->read($_POST["postid"]);
			if( $re != false)
			{	$i = 0;
				while($rw = mysqli_fetch_assoc($re))
				{
					if($rw['spUserid'] ==  $_SESSION['uid'])
					{
						echo "<span data-toggle='tooltip' data-placement='bottom' title='favourite' class='icon-favorites fa fa-heart removefavorites' style='margin-left:10px;' data-postid='" .$_POST["postid"] ."'></span>";
						$i++;
					}
				}
				if($i == 0)
				{	
					echo "<span data-toggle='tooltip' data-placement='bottom' title='favourite' class='icon-favorites fa fa-heart-o sp-favorites' style='margin-left:10px;' data-postid='" . $_POST["postid"] ."'></span>";
				}
			}

			else
			{

				echo "<span data-toggle='tooltip' data-placement='bottom' title='favourite' class='icon-favorites fa fa-heart-o sp-favorites' style='margin-left:10px;' data-postid='" . $_POST["postid"] . "'></span>";
			}
			
			echo "</div>";
			//Total Views
			echo "<div class='col-md-6'>";
				echo "<div class='pull-right' style='padding-right:20px;'><span style='font-size:25px;font-weight:bold;color:gray;'>".$total."</span> <span style='font-size:15px;color:gray;'>Views</span></div>";
			echo "</div>";
			
			echo "</div>";
			?>
			</div><br>
		<!--Socializing Code Complete-->
	</div>
</div>
						







