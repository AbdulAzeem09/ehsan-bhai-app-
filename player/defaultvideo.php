<?php
$vm = new _postingview;
$pic = new _postingpic;
$result = $vm->videolimit();
//$rows["spPostingtitle"]
if($result != false)
{
	echo "<div class='row'>";
		while($rows = mysqli_fetch_assoc($result))
		{
			$res = $pic->read($rows["idspPostings"]);
			echo "<div class='col-md-3' style='margin-bottom:10px;'>";
			if($res != false)
			{
				$row = mysqli_fetch_assoc($res);
				echo "<figure><a href='#' data-postid='".$rows["idspPostings"]."' class='mediapost'><img alt='Posting Pic' class='defaultvid imghover' src=' ".($row["spPostingPic"])."'></a></figure>";
			}
			else
				echo "<figure><a href='#' data-postid='".$rows["idspPostings"]."' class='mediapost'><img alt='Posting Pic' class='defaultvid imghover' src='../img/no.png'></a></figure>";
				
			echo "</div>";
		}
	echo "</div>";
}
?>