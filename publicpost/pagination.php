<div id="content">
	<?php
		$start=0;
		$limit=5;

		if(isset($_GET['id']))
		{
			$id=$_GET['id'];
			$start=($id-1)*$limit;
		}
		else
		{
			$id=1;
		}
		$total = ceil($totalpost/$limit);
	?>
	<ul class="page <?php echo ($totalpost <=5 ?"hidden":"");?>">
		
		<?php
			echo "<nav aria-label='Page navigation'>";
			echo "<ul class='pagination'>";
			if($id>1)
			{
				//Go to previous page to show previous 10 items
				echo "<li><a href='?id=".($id-1)."' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>";
			}
			if($id!=$total)
			{	
				//Go to nextss page to show next 10 items.
				echo "<li><a href='?id=".($id+1)."' aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>";
			}
			
			//show all the page link with page number.
			for($i=1; $i<=$total; $i++)
			{
				
				if($i==$id)
				{ 
					echo "<li class='active'><a href='#'>".$i."</a></li>"; 
				}

				else
				{
					echo "<li><a href='?id=".$i."'>".$i."</a></li>";
				}
			}
			echo "</ul>";
			echo "</nav>";
			
		?>
	</ul>
</div>
		