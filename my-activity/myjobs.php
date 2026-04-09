<?php
	$m = new  _postingview;
	$j = new _sppost_has_spprofile;
	switch ($_GET["myjobfilter"]){
		case 1:
				$res = $m->myjobpost($_SESSION['uid']);
			break;
		
		case 2:
			$res = $m->myfavouritejob($_SESSION['uid']);
			break;
		
		case 3:
			$res = $j->appliedjob($_SESSION['uid']);
		break;
	}
	
	if($res != false)
	{	//$rows['spPostings_idspPostings'],$rows['spProfiles_idspProfiles']
		echo "<table class='table table-striped table-hover table-condensed'>";
			echo "<thead>";
				echo "<tr>";
					if($_GET["myjobfilter"]== 3)
						echo "<th>Applied Date</th>";
					else 
						echo "<th>Advertised Date</th>";
					echo "<th>Title</th>";
					echo "<th>Company</th>";
					echo "<th>Job Level</th>";
					echo "<th>Location</th>";
					echo "<th>Job Type</th>";
					if($_GET["myjobfilter"]== 1)
						echo "<th>Application</th>";
				 echo "</tr>";
			echo "</thead>";
		echo "<tbody>";
			while($rows = mysqli_fetch_assoc($res))
			{	
				$pid = $rows['idspPostings'];
				$catid = $rows['idspCategory'];
				$catname = $rows['spCategoryname'];
				
				//Total Applicants for this job
					$ac = new _sppost_has_spprofile;
					$result = $ac->job($rows["idspPostings"]);
					if($result != false)
					{
						$applicants = $result->num_rows;
					}
				//Code Complete
				
				if($_GET["myjobfilter"] == 1 || $_GET["myjobfilter"] == 2)
				{
					$postid = $rows['idspPostings'];
				}
				else
					$postid = $rows['spPostings_idspPostings'];
				
				echo "<tr>";
					if($_GET["myjobfilter"] == 3){
						$dt = new DateTime($rows["spActivityDate"]);
						echo "<td>".$dt->format('Y-m-d')."</td>";
						$det= new _postingview;
						$result = $det->read($postid);
						if($result != false){
							$row = mysqli_fetch_assoc($result);
							echo "<td>".$row["spPostingtitle"]."</td>";
							
						}
					}
					else
					{	$dt = new DateTime($rows['spPostingDate']);
						echo "<td>".$dt->format('Y-m-d')."</a></td>";
						echo "<td><a href='../jobresume/?jobid=".$rows["idspPostings"]."'>".$rows['spPostingtitle']."</a></td>";
					}
					
					$m = new _postfield;
					$rm = $m->field($postid);
					if ($rm != false){
					while($rw = mysqli_fetch_assoc($rm))
					{
						if($rw['spPostFieldLabel'] == "Company")
							$company = $rw['spPostFieldValue'];
						
						elseif($rw['spPostFieldLabel'] == "Job Level")
							$joblevel = $rw['spPostFieldValue'];
						
						elseif($rw['spPostFieldLabel'] == "Location")
							$location = $rw['spPostFieldValue'];
						
						elseif($rw['spPostFieldLabel'] == "Job Type")
							$jobtype = $rw['spPostFieldValue'];
					}
					echo "<td>".$company."</td>";
					echo "<td>".$joblevel."</td>";
					echo "<td>".$location."</td>";
					echo "<td>".$jobtype."</td>";
					if($_GET["myjobfilter"]== 1)
					{
						echo "<td>".$applicants."</td>";
						echo "<td><a href='../post-ad/?postid=" .$pid. "&categoryid=".$catid."&categoryname=".$catname."' class='edit'> <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Edit</a></td>";
					}
				}
				echo  "</tr>";
			}
		echo "</tbody></table>";
	}
	
?>