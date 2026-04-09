<?php
	session_start();
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");	
	$p = new _spprofiles;
	$res = $p->read($_POST["profileid"]);
	if ($res != false){
		
		//get compny Name 
		$c = new _profilefield;
		$r = $c->read($_POST["profileid"]);
		if($r){
			$cmpnyName = '';
			while ($row3 = mysqli_fetch_assoc($r)) {
				if($cmpnyName == ''){
					if($row3['spProfileFieldName'] == 'companyname_'){
						$cmpnyName = $row3['spProfileFieldValue']; 
					}
				}
			}
		}else{
			$cmpnyName = 'Not Define';
		}
		
		echo "<input type='hidden' id='cmpnyName' value='".$cmpnyName."'>";
		$r = mysqli_fetch_assoc($res);
		
		echo "<input type='hidden' id='profilecountry' value='".$r["spProfilesCountry"]."'>";
		echo "<input type='hidden' id='profilecity' value='".$r["spProfilesCity"]."'>";
		$picture = $r['spProfilePic'];
		if(isset($picture)){
			echo "<img  alt='Posting Pic' class='img-rounded pull-right' style='width:60px; height:60px;' src=' ".($picture)."' ><br>" ;
			echo "<div class='pull-right' style='font-weight:700;padding-right:15px;color:#114B5F;'><span class='".$r['spprofiletypeicon']."'></span> ".$r['spProfileName']."</div>";
		}
		else
		{
			echo "<img  alt='Posting Pic' class='img-rounded pull-right' style='width:60px; height:60px;' src='../../img/default-profile.png' ><br>" ;
			echo "<div class='pull-right' style='font-weight:700;padding-right:15px;color:#114B5F;'><span class='".$r['spprofiletypeicon']."'></span> ".$r['spProfileName']."</div>";
		}
				
	}

?>