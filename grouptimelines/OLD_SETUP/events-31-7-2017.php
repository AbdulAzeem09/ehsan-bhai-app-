<div class="row">
	<div class="col-md-7 eventcalender">
		<?php
			include("event.php");
		?>	
	</div>
	<div class="col-md-5">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title" align="center"><b>Events</b></h3>
			</div>
			<div class="panel-body">
				<?php
					$p = new _postingview;
					$res = $p->event($_GET["groupid"]);
					if($res != false)
					{
						echo "<table class='table table-bordered table-hover table-condensed'>";
							echo "<thead>
								<tr class='table-success'>
								  <th>#</th>
								  <th>Name</th>
								  <th>Date</th>
								</tr>
							  </thead>";
						echo "<tbody>";
							$i = 0;
							while($row = mysqli_fetch_assoc($res))
							{	$i++;
								$m = new _postfield;
								$rm = $m->read($row["idspPostings"]);
								if ($rm != false){
									
									while($rs = mysqli_fetch_assoc($rm)){
										if($rs["spPostFieldLabel"] == "Start Date"){
											$date = $rs["spPostFieldValue"];
											echo "<tr class='searchable'>";
												
												echo "<td><b>".$i."</b></td>";
												
												echo "<td><a href='../post-details/?postid=".$row["idspPostings"]."&back=back'><b>".$row["spPostingtitle"]."</b></a></td>";
												
												echo "<td><b>".$date."</b></td>";
												
											echo "</tr>";
										}
									}
								}
							}
						echo "</tbody>";
						echo "</table>";
					}
				?>
				</div>
			</div>
		</div>
	</div>