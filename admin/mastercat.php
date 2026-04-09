<div style="position:fixed; width: 8%; margin: 0 auto; padding-right: 4px;" class="hidden-sm hidden-md">
	<div  class="text-center" style="margin-bottom:5px;"><button class="btn btn-primary" type="button" id="button" style="background-color:yellow;color:black;"><b>Manage Post</b></button></div>
	<?php
		$colors = array("#7892c2", "#b8e356", "#599bb3", "#44c767", "#77b55a", "#2dabf9", "#7d5d3b", "#fc8d83", "#007dc1", "#33bdef", "#637aad", "#89c403", "#c123de", "#3d94f6", "#241d13","#c62d1f");
		$ca = new _categories;
		$result = $ca->read();
		if ($result != false)
		{
			$i = 0;
			while($rows = mysqli_fetch_assoc($result))
			{
				if($rows["idspCategory"] != 16 && $rows["idspCategory"] != 17)
					echo "<a href='/admin/".$rows["spCategoryFolder"]."/' class='myButton' style='background-color:".$colors[$i]."'><span class='".$rows['spcategoriesicon']."'></span> ".$rows["spCategoryName"]."</a>";
				$i++;
			}
		}
	?>
</div>