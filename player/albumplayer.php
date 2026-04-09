<?php
	session_start(); 
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
?>

<table class="table" style="background-color:white;">
	<thead>
	  <tr>
		<th>Title</th>
		<th>Posted By</th>
	  </tr>
	</thead>
	<tbody>
	<?php
		$vm = new _postingview;
		$media = new _postingalbum;
		$result = $media->myplaylist($_POST["albumid"]);
		if($result != false)
		{
			while($rows = mysqli_fetch_assoc($result))
			{
				$res = $vm->read($rows["spPostings_idspPostings"]);
				if($res != false)
				{
					//musicpost playlistitem
					$row = mysqli_fetch_assoc($res);
					echo "<tr class='searchable'>";
						echo "<td width='65%' class='itemtitle ".($row["idspCategory"] == 10 ? "mediapost":"musicpost")."'  data-postid='".$row["idspPostings"]."'>".$row["spPostingtitle"]."</td>";
						
						echo "<td width='30%'>".$row["spProfileName"]."</td>";
						
						echo "<td width='5%'><button type='button' class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-remove delitemlist' data-mediaid='".$rows["idspPostingMedia"]."' ></span></button></td>";
					echo "</tr>";
				}
			}
		}
	
	?>
	</tbody>
</table>