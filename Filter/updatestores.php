<!--<div class="btn-group allcategory" data-toggle="buttons" style="padding-bottom:3px;">
		<?php
			$ca = new _categories;
			$result = $ca->read();
			if ($result != false)
			{
				//$rows['idspCategory'] != 16 && $rows['idspCategory'] != 17
				while($rows = mysqli_fetch_assoc($result)){
					if($rows['idspCategory'] != 16 && $rows['idspCategory'] != 17){
						echo "<label class='btn btn-primary searchcategory' data-action='".$rows["spCategoriesDashboard"]."' data-categoryid='" . $rows['idspCategory'] . "' data-categoryname='" . $rows['spCategoryName'] . "' style='font-size: 80%; color:white; padding-right:14px;'>".$rows['spCategoryName']."</label>";
					}
				}
			}
		?>
 </div>
	
		<span class="glyphicon glyphicon-backward leftarrow" style="cursor:pointer;"></span>-->
		 <div class="allcategory list-group-horizontal list-inline" style="text-align: center;">
			<?php
				$ca = new _categories;
				$result = $ca->read();
				if ($result != false)
				{
					//$rows['idspCategory'] != 16 && $rows['idspCategory'] != 17
					while($rows = mysqli_fetch_assoc($result)){
						if($rows['idspCategory'] != 17){
							echo "<a href='#' class='rightArrow list-group-item searchcategory' data-action='".$rows["spCategoriesDashboard"]."' data-categoryid='" . $rows['idspCategory'] . "' data-categoryname='" . $rows['spCategoryName'] . "' style='padding: 6px;'>".$rows['spCategoryName']."</a>";
						}
					}
				}
				
				if(isset($_GET["flag"]))
				{
					echo "<a href='#' class='list-group-item ".(isset($_GET["viewdraft"])?"active":"")."' style='padding: 6px;' id='mydrftflder'>Draft</a>";
				}
			?>
		 </div>
		<!--<span class="glyphicon glyphicon-forward rightarrow" style="cursor:pointer;"></span>-->
	 