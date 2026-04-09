<?php
	$d = new _spprofiles;
	$result = $d->myaccount($_SESSION["uid"]);
	if($result != false)
	{
		$row = mysqli_fetch_assoc($result);
		if($row["spProfileType_idspProfileType"] == 5)
		{
			$profileid = $row["idspProfiles"];
			$name= $row["spProfileName"];
			$email = $row["spProfileEmail"];
			$phone = $row["spProfilePhone"];
			$country = $row["spProfilesCountry"];
			$city = $row["spProfilesCity"];
			$about = $row["spProfileAbout"];
		}
		else
			echo "Please Select Your Jobseeker Profile !";
	}
	
	if(isset($profileid))
	{
		$j = new  _spjobseeker;
		$res = $j->read($profileid);
		if($res != false)
		{
			$rows = mysqli_fetch_assoc($res);
			$currentctc = $rows["currentCTC"];
			$expectedctc = $rows["expectedCTC"];
			$skill = $rows["skill"];
			$experience = $rows["experience"];
			$college = $rows["college"];
			$university = $rows["university"];
			$degree  = $rows["degree"];
			$startdate = $rows["start_year"];
			$enddate = $rows["end_year"];
			$grade = $rows["grade"];
		}
	}
	echo "<div class='row' ><div class='col-md-4' style=' background-color: lightblue; height:40px; border-radius:5px;'><h4 align='center'>Personal Information</h4></div></div><br>";//Highlight
	echo "<div class='row'>";
		echo "<div class='col-md-4'>Name : <b>" .$name."</b></div>";
		echo "<div class='col-md-4'>Email : <b>".$email."</b></div>";
		echo "<div class='col-md-4'>Phone : <b>".$phone."</b></div>";
	echo "</div><br>";
	
	echo "<div class='row'>";
		echo "<div class='col-md-4'>Country : <b>" .$country."</b></div>";
		echo "<div class='col-md-4'>City : <b>".$city."</b></div>";
		echo "<div class='col-md-4'>About : <b>".$about."</b></div>";
	echo "</div><br>";
	
	echo "<div class='row'>";
		echo "<div class='col-md-4'>Current CTC : <b>" .$currentctc." Lakhs</b></div>";
		echo "<div class='col-md-4'>Expected CTC : <b>".$expectedctc." Lakhs</b></div>";
		echo "<div class='col-md-4'>Experience : <b>" .$experience." Year</b></div>";
	echo "</div><br><br>";
	
	echo "<div class='row' ><div class='col-md-4' style=' background-color: lightblue; height:40px; border-radius:5px;'><h4 align='center'>Skills</h4></div></div><br>";//Highlight
		echo "<div class='class='row'>Skill : <b>".$skill."</b></div><br><br>";

	
	echo "<div class='row' ><div class='col-md-4' style=' background-color: lightblue; height:40px; border-radius:5px;'><h4 align='center'>Education</h4></div></div><br>";
	echo "<div class='row'>";//Highlight
		echo "<div class='col-md-4'>Collage : <b>".$college."</b></div>";
		echo "<div class='col-md-4'>Board/University : <b>".$university."</b></div>";
		echo "<div class='col-md-4'>Degree : <b>" .$degree."</b></div>";
	echo "</div><br>";
	
	echo "<div class='row'>";
		echo "<div class='col-md-4'>Start year : <b>".$startdate."</b></div>";
		echo "<div class='col-md-4'>End Year : <b>".$enddate."</b></div>";
		echo "<div class='col-md-4'>Grade : <b>".$grade." Out of 10</b></div>";
	echo "</div>";
	echo "<a class='btn btn-success pull-right' role='button' href='../my-profile/'><span class='glyphicon glyphicon-pencil'></span>  Edit</a>";
	
?>