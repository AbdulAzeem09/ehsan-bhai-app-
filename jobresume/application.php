<?php
$ac = new _sppost_has_spprofile;
$result = $ac->job($_GET["jobid"]);
if($result != false)
{
	while($row = mysqli_fetch_assoc($result))
	{
		echo "<div class='row'>";
			echo "<div class='col-md-3'>";
				echo "<div><img  alt='profile-Pic' class='img-rounded' style='width:50px; height:50px;' src=' ".($row['spProfilePic'])."' ><span class='jobseeker'>".$row["spProfileName"]."</span></div>" ;
				
				//Cv Preview Code-->
				$pc = new _postingalbum;
				$res = $pc->resume($row["sppostingResume"]);
				if ($res != false)
				{
					$rw = mysqli_fetch_assoc($res);
					$title = $rw["sppostingmediaTitle"];
					$resume = $rw["spPostingMedia"];
					
					$previewfile = $rw['idspPostingMedia'].".".$rw['sppostingmediaExt']."";
				}
				echo "<div style='margin-left:70px;'>".$row["spProfileAbout"]."</div>";
			echo "</div>";
			
			/*echo "<div class='col-md-2'>
				<p style='padding-top:10px;'>".$title."</p>
			</div>";*/
			
			echo "<div class='col-md-8'>";
				echo "<p style='padding-top:10px;'>".$row["sppostingscoverletter"]."</p>";
			echo "</div>";
			
			echo "<div class='col-md-1'>";
				echo "<button type='button' class='btn btn-link preview pull-right' data-toggle='modal' data-target='#previewresume' data-src='http://sp.localhost/resume/".$previewfile."'><span class='glyphicon glyphicon-search'></span> Preview CV</button>";
			echo "</div>";
		echo "</div>";
		echo "<hr>";
	}
}
//Cv Preview Modal
include("cvpreview.php");
?>