<?php
	$p = new _postfield;
	switch ($_GET["activity"]){
		case 1:
			$res = $p->mybiddenproject($_SESSION['uid']);
		break;
		
		case 2:
			$res = $p->mybid($_SESSION['uid']);
			//echo $p->ta->sql;
		break;
		
	}
	
	if($res != false)
	{
	
		while($rows = mysqli_fetch_assoc($res))
		{	
			$detail = new _postingview;
				$result = $detail->read($rows['spPostings_idspPostings']);
				if($result != false){
					while($row = mysqli_fetch_assoc($result)){
						$title = $row["spPostingtitle"];
						$date = $row["spPostingDate"];
						$expdate = $row["spPostingExpDt"];
						$bid = $row["spPostingsBought"];
						$posterProfile = $row["spProfileName"];
						$posterProfileid = $row["idspProfiles"];
						$catid = $row["idspCategory"];
						$catname = $row["spCategoryname"];
					}
				}
			echo "<div class='row bidproject'>";
				
				//Details of my bid
					echo "<div class='col-md-3'>";
						$rm = $p->totalbids($rows['spPostings_idspPostings']);
						if ($rm != false){
							$total = $rm->num_rows; 
						}
						echo "<div style='font-size:20px; color:#1a936f;'>" .$title."</div>" ;
						$dt = new DateTime($date);
						echo "<div style='font-size:17px;'><b>Posting Date : </b>" .$dt->format('Y-m-d')."</div>" ;
						
						echo "<div style='font-size:17px;'><b>Expiry Date : </b>" .$expdate."</div>" ;
						echo "<div style='font-size:17px; cursor:pointer' class='searchtimelines' data-profileid='".$posterProfileid."'><b>Employer : </b>" .$posterProfile."</div>" ;
						echo "<div style='font-size:17px;'><b>Total Bid : </b>" .$total."</div>" ;
						echo "<a href='../post-ad/?postid=" .$rows['spPostings_idspPostings']. "&categoryid=".$catid."&categoryname=".$catname."' class='edit btn btn-success' role='button'> <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</a>";
					echo "</div>";
			
		
					echo "<div class='col-md-9'>";
							$result = $p->biddetails($rows['spPostings_idspPostings']);
							if($result != false)
							{	
								echo "<table class='table table-striped table-bordered table-hover table-condensed'>";
									echo "<thead>";					
									echo "<tr>";
									echo "<th>Comment</th>";
									echo "<th>Bid Price</th>";
									echo "<th>Total Days</th>";
									echo "<th>Initial Percentage</th>";
									if($_GET["activity"] == 1)
									{
										echo "<th>Bidder</th>";
										echo "<th>Accept Bid</th>";
										echo "<th>Reject Bid</th>";
									}
									echo "</tr>";
									echo "</thead>";
									
								echo "<tbody>";
									while($row = mysqli_fetch_assoc($result)){
									   echo "<tr>";
										$rs = $p->allbids($row['spProfiles_idspProfiles'],$rows['spPostings_idspPostings']);
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
												
												echo "<td>".$comment. "</td>";
												echo "<td>".$price. " $</td>";
												echo "<td>".$days. " days</td>";
												echo "<td>".$perc." %</td>";
												//Bidder Name
												if($_GET["activity"] == 1)
												{
													$profile = new _spprofiles;
													$resu = $profile->read($row['spProfiles_idspProfiles']);
													if($resu != false)
													{
														$rset = mysqli_fetch_assoc($resu);
														$bidder = $rset["spProfileName"];
														$bidderid = $rset["idspProfiles"];
													}
													echo "<td class='searchtimelines' data-profileid='".$bidderid."' style='cursor:pointer;'>".$bidder."</td>";
													
													echo "<td><button class='btn btn-success btn-xs acceptbid' data-postid='".$rows['spPostings_idspPostings']."' data-profileid='".$row['spProfiles_idspProfiles']."'><span class='glyphicon glyphicon-ok-sign'></span></button></td>";
													
													echo "<td><button class='btn btn-danger btn-xs rejectbid' data-postid='".$rows['spPostings_idspPostings']."' data-profileid='".$row['spProfiles_idspProfiles']."'><span class='glyphicon glyphicon-remove'></span></button></td>";
												}
										}
										echo "</tr>";
									
									}
							}
						
							echo "</tbody>";	
						echo "</table>";	
					echo "</div>";
			echo "</div>";
			echo "<hr class='hrline' style='margin-top:10px;'><br>";
	}
}
?>


