		
<strong style="margin-left:20px; color:#1a936f; font-size:130%;">View Posts</strong>
<div class="catsidebar timelinevalue">
	<ul class="nav nav-pills nav-stacked well">
		<?php
			$c = new _categories;
			$rm = $c->read();
			if($rm != false)
			{
				while($rc = mysqli_fetch_assoc($rm))
				{
				echo "<li class='itm' role='presentation'><a href='/".$rc["spCategoryFolder"]."/' class='item post-share' data-catid='".$rc["idspCategory"]."'>".$rc["spCategoryName"]."</a></li>";
				}
			}
		?> 
	</ul>
</div>

	<!--<strong style="margin-left:20px; color:#1a936f; font-size:130%;">View Posts</strong>
		<div class="catsidebar timelinevalue">
			<ul class="nav nav-pills nav-stacked well">
				  <?php
					/*$c = new _categories;
					$result = $c->read();
					 if ($result != false)
					 {
						 while($rows=mysqli_fetch_assoc($result)){
							  echo "<li class='itm' role='presentation'><a href='/".$rows["spCategoryFolder"]."/'  class='list-group-item sppointer ".($rows['idspCategory'] == $_GET["categoryID"] ? "active" : "")."'  data-catid='".$rows["idspCategory"]."' style='font-weight:900;'>". $rows['spCategoryName']."</a></li>";
						 }
					 }*/
				  ?>
			</ul>
	</div>-->
				
			
				
			