<div>
	<?php
		$pic = new _postingpic;
		$result = $pic->read($rows['idspPostings']);
		if($result!= false)
		{	$imgcount = $result->num_rows;
			if($imgcount > 1)
			{
				echo "<div style='padding:10px;'>";
					while($rp = mysqli_fetch_assoc($result))
					{
						$pict = $rp['spPostingPic'];
						echo "<img  alt='Posting Pic' class='img-thumbnail imagehover sppointer post-highlight' style='width:72px; height: 72px;' src=' ".($pict)."' >" ;
						echo "\x20\x20\x20";
					}
				echo "</div>";
			}
		}
	?>
</div>