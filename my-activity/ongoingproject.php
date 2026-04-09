<?php
	$d = new _postingview;;
	switch($employer_freelancer)
	{
		case 1:
		$res = $d->asemployer($_SESSION['uid']);
		break;
		case 2:
		$res = $d->asfreelancer($_SESSION['uid']);
		//echo $d->ta->sql;
		break;
	}
	if($res != false)
	{
		while($rows = mysqli_fetch_assoc($res))
		{	$posterProfile =  $rows["idspProfiles"];
			$postid = $rows["idspPostings"];
			$biderProfileid = $rows["spPostingsBuyerid"];
			$dt = new DateTime($rows["spPostingDate"]);
			$title = $rows["spPostingtitle"]."<br>";
			$expdate = $rows["spPostingExpDt"]."<br>";
			echo "<div class='row'>";
				echo "<div class='col-md-3'>";
					echo "<div style='font-size:20px; color:#1a936f;'>" .$title."</div>" ;
					$dt = new DateTime($date);
					echo "<div style='font-size:17px;'><b>Posting Date : </b>" .$dt->format('Y-m-d')."</div>" ;
					echo "<div style='font-size:17px;'><b>Expiry Date : </b>" .$expdate."</div>" ;
				echo "</div>";
				echo "<div class='col-md-9'>";
					echo "<table class='table table-striped table-bordered table-hover table-condensed'>";
						echo "<thead>";
						  echo "<tr>";
							echo "<th>Comment</th>";
							echo "<th>Bid Price</th>";
							echo "<th>Total Days</th>";
							echo "<th>Initial Percentage</th>";
							if($employer_freelancer == 1)
								echo "<th>Bidder</th>";
							else
								echo "<th>Employer</th>";
								
						  echo "</tr>";
						echo "</thead>";
						echo "<tbody>";
							$rs = $p->allbids($biderProfileid,$postid);

							if($rs != false)
							{
									while($rw = mysqli_fetch_assoc($rs))
									{
										if($rw['spPostFieldName'] == "bidPrice")
											$price = $rw['spPostFieldValue'];
										
										elseif($rw['spPostFieldName'] == "comment")
											$comment= $rw['spPostFieldValue'];
										
										elseif($rw['spPostFieldName'] == "totalDays")
											$days = $rw['spPostFieldValue'];
										
										elseif($rw['spPostFieldName'] == "initialPercentage")
											$perc = $rw['spPostFieldValue'];
									}
									$profile = new _spprofiles;
									if($employer_freelancer == 1)
									{
										$resu = $profile->read($biderProfileid);
										if($resu != false)
										{
											$rset = mysqli_fetch_assoc($resu);
											$bidder = $rset["spProfileName"];
											$bidderid = $rset["idspProfiles"];
										}
									}
									else
									{
										$resu = $profile->read($posterProfile);
										if($resu != false)
										{
											$rset = mysqli_fetch_assoc($resu);
											$bidder = $rset["spProfileName"];
											$bidderid = $rset["idspProfiles"];
										}
									}
										
								echo "<tr>";
									echo "<td>".$comment. "</td>";
									echo "<td>".$price. " $</td>";
									echo "<td>".$days. " days</td>";
									echo "<td>".$perc." %</td>";
									echo "<td class='searchtimelines' style='cursor:pointer;' data-profileid='".$bidderid."'>".$bidder."</td>";
								echo "</tr>";
							}
							
						echo "</tbody>";
					echo "</table>";
				echo "</div>";
			echo "</div>";
			echo "<hr class='hrline' style='margin-top:10px;'><br>";
		}
	}
	?>