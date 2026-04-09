<?php

	session_start();
	function sp_autoloader($class)
	{
		include '../mlayer/' . $class . '.class.php';

	}
	spl_autoload_register("sp_autoloader");
	//Testing
	$pc = new _postingalbum;
	$result = $pc->resume($_POST['mediaid']);
	if ($result != false)
	{
		$rw = mysqli_fetch_assoc($result);
		$resume = $rw["spPostingMedia"];
		$ext = $rw['sppostingmediaExtension'];
		$previewfile = $rw['idspPostingMedia'].".".$rw['sppostingmediaExt']."";
		//file_put_contents("../resume/".$previewfile, $resume);
		//data-src='http://dev.thesharepage.com/resume/".$previewfile."'
	}
	//Testing Complete


	$r = $d->read1($id, $cid);
	if ($r != false)
	{
		while($row = mysqli_fetch_array($r))
		{
			if ($row["dSize"] == -1)
			{
				header("location: " . $row["dName"]);
			}
			else
			{
				header("Content-length: " . $row["dSize"]);
				header("Content-type: " . $row["dType"]);
				header("Content-Disposition: attachment; filename=" . $row["dName"]);
				echo $row["dDocument"];
				exit;
			}
		}
	}

echo "No such document for your account. Please check link or report to member@webarrister.com for missing document.";
?>
