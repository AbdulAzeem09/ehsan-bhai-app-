<?php
	$b = array();

	$r = new _spprofilehasprofile;
	$p = new _spprofiles;

	$res = $r->readall($_SESSION["pid"]);//As a receiver
	//echo $r->ta->sql;
	if($res != false){
		while($rows = mysqli_fetch_assoc($res)){
			$sender = $rows["spProfiles_idspProfileSender"];
			array_push($b,$sender);
		}
	}
	$res = $r->readallfriend($_SESSION["pid"]);//As a sender
	//echo $r->ta->sql;
	if($res != false){
		while($rows = mysqli_fetch_assoc($res)){
			$receiver = $rows["spProfiles_idspProfilesReceiver"];
			if(in_array($rows["spProfiles_idspProfilesReceiver"],$b)){

			}else{
				array_push($b,$receiver);
			}
		}
	}
	// print_r($b);
	// exit;
?>
	<div class='row conectLevl'>
		<div class='col-md-12'>
			<h1><i class="fa fa-birthday-cake"></i> Today Birthday</h1>
			<div class="connnectionLevel">
				<?php
				$today = 0;
				foreach ($b as $key => $value) {
					$result = $p->getTodayBirthday($value);
					//echo $p->ta->sql;
					if($result){
						$row = mysqli_fetch_assoc($result); ?>
						<a href="<?php echo '../friends/?profileid='.$value;?>" data-toggle="tooltip" data-placement="top" title="<?php echo $birthTitle; ?>" >
					  		<?php
		  					$picture = $row['spProfilePic'];
		  					if(isset($picture))
								echo "<img  alt='Profile Pic' class='img-circle' src=' ".($picture)."' >" ;
							else{
								echo "<img  alt='Profile Pic' class='img-circle' src='../assets/images/icon/blank-img.png' >" ;
							} ?>
					  	</a>
						<?php
					}
					$today++;
				}
				if($today == 0){
					echo "No Birthday's Found.";
				}
				?>
			</div>
			
			<?php
			$jan = 0;
			foreach ($b as $key => $value) {
				//$result = $p->getTodayBirthday($value);
				$result1 = $p->getMonthBirthday($value, 1); 
				if($result1) { 
					if($jan == 0) { ?>
						<h1><i class="fa fa-birthday-cake"></i> January</h1>
						
					<?php }
					$row = mysqli_fetch_assoc($result1);
					$birthDate = date("d M",strtotime($row["spProfilesDob"]));
					$birthTitle = $row["spProfileName"]." birthday is ". $birthDate; ?>
					<div class="connnectionLevel">
					<a href="<?php echo '../friends/?profileid='.$value;?>" data-toggle="tooltip" data-placement="top" title="<?php echo $birthTitle; ?>" >
				  		<?php
	  					$picture = $row['spProfilePic'];
	  					if(isset($picture))
							echo "<img  alt='Profile Pic' class='img-circle' src=' ".($picture)."' >" ;
						else{
							echo "<img  alt='Profile Pic' class='img-circle' src='../assets/images/icon/blank-img.png' >" ;
						} ?>
				  	</a>
				  	</div>
					<?php
					$jan++;
				}
			}
			?>
			
			
			<?php
			$feb = 0;
			foreach ($b as $key => $value) {
				//$result = $p->getTodayBirthday($value);
				$result1 = $p->getMonthBirthday($value, 2);
				//echo $p->ta->sql."<br>";
				if($result1){
					if($feb == 0) { ?>
						<h1><i class="fa fa-birthday-cake"></i> February</h1>
					<?php }
					$row = mysqli_fetch_assoc($result1);
					$birthDate = date("d M",strtotime($row["spProfilesDob"]));
					$birthTitle = $row["spProfileName"]." birthday is ". $birthDate; ?>
					<div class="connnectionLevel">
					<a href="<?php echo '../friends/?profileid='.$value;?>" data-toggle="tooltip" data-placement="top" title="<?php echo $birthTitle; ?>" >
				  		<?php
	  					$picture = $row['spProfilePic'];
	  					if(isset($picture))
							echo "<img  alt='Profile Pic' class='img-circle' src=' ".($picture)."' >" ;
						else{
							echo "<img  alt='Profile Pic' class='img-circle' src='../assets/images/icon/blank-img.png' >" ;
						} ?>
				  	</a>
					</div>
					<?php
					$feb++;
				}
			}
			?>
			
			<?php
			$mar = 0;
			foreach ($b as $key => $value) {
				//$result = $p->getTodayBirthday($value);
				$result1 = $p->getMonthBirthday($value, 3);
				//echo $p->ta->sql."<br>";
				if($result1){
					if($mar == 0) { ?>
						<h1><i class="fa fa-birthday-cake"></i> March</h1>
					<?php }
					$row = mysqli_fetch_assoc($result1);
					$birthDate = date("d M",strtotime($row["spProfilesDob"]));
					$birthTitle = $row["spProfileName"]." birthday is ". $birthDate; ?>
					<div class="connnectionLevel">
					<a href="<?php echo '../friends/?profileid='.$value;?>" data-toggle="tooltip" data-placement="top" title="<?php echo $birthTitle; ?>" >
				  		<?php
	  					$picture = $row['spProfilePic'];
	  					if(isset($picture))
							echo "<img  alt='Profile Pic' class='img-circle' src=' ".($picture)."' >" ;
						else{
							echo "<img  alt='Profile Pic' class='img-circle' src='../assets/images/icon/blank-img.png' >" ;
						} ?>
				  	</a></div>
					<?php
					$mar++;
				}
			}
			?>
	
			
			<?php
			$apr = 0;
			foreach ($b as $key => $value) {
				//$result = $p->getTodayBirthday($value);
				$result1 = $p->getMonthBirthday($value, 4);
				//echo $p->ta->sql."<br>";
				if($result1){
					if($apr == 0) { ?>
						<h1><i class="fa fa-birthday-cake"></i> April</h1>
					<?php }
					$row = mysqli_fetch_assoc($result1);
					$birthDate = date("d M",strtotime($row["spProfilesDob"]));
					$birthTitle = $row["spProfileName"]." birthday is ". $birthDate; ?>
					<div class="connnectionLevel">
					<a href="<?php echo '../friends/?profileid='.$value;?>" data-toggle="tooltip" data-placement="top" title="<?php echo $birthTitle; ?>" >
				  		<?php
	  					$picture = $row['spProfilePic'];
	  					if(isset($picture))
							echo "<img  alt='Profile Pic' class='img-circle' src=' ".($picture)."' >" ;
						else{
							echo "<img  alt='Profile Pic' class='img-circle' src='../assets/images/icon/blank-img.png' >" ;
						} ?>
				  	</a></div>
					<?php
					$apr++;
				}
			}
			?>
			
			
			<?php
			$may = 0;
			foreach ($b as $key => $value) {
				//$result = $p->getTodayBirthday($value);
				$result1 = $p->getMonthBirthday($value, 5);
				//echo $p->ta->sql."<br>";
				if($result1){
					if($may == 0) { ?>
						<h1><i class="fa fa-birthday-cake"></i> May</h1>
					<?php }
					$row = mysqli_fetch_assoc($result1);
					$birthDate = date("d M",strtotime($row["spProfilesDob"]));
					$birthTitle = $row["spProfileName"]." birthday is ". $birthDate; ?>
					<div class="connnectionLevel">
					<a href="<?php echo '../friends/?profileid='.$value;?>" data-toggle="tooltip" data-placement="top" title="<?php echo $birthTitle; ?>" >
				  		<?php
	  					$picture = $row['spProfilePic'];
	  					if(isset($picture))
							echo "<img  alt='Profile Pic' class='img-circle' src=' ".($picture)."' >" ;
						else{
							echo "<img  alt='Profile Pic' class='img-circle' src='../assets/images/icon/blank-img.png' >" ;
						} ?>
				  	</a></div>
					<?php
					$may++;
				}
			}
			?>
			
			
			<?php
			$june = 0;
			foreach ($b as $key => $value) {
				//$result = $p->getTodayBirthday($value);
				$result1 = $p->getMonthBirthday($value, 6);
				//echo $p->ta->sql."<br>";
				if($result1){
					if($june == 0) { ?>
						<h1><i class="fa fa-birthday-cake"></i> June</h1>
					<?php }
					$row = mysqli_fetch_assoc($result1);
					$birthDate = date("d M",strtotime($row["spProfilesDob"]));
					$birthTitle = $row["spProfileName"]." birthday is ". $birthDate; ?>
					<div class="connnectionLevel">
					<a href="<?php echo '../friends/?profileid='.$value;?>" data-toggle="tooltip" data-placement="top" title="<?php echo $birthTitle; ?>" >
				  		<?php
	  					$picture = $row['spProfilePic'];
	  					if(isset($picture))
							echo "<img  alt='Profile Pic' class='img-circle' src=' ".($picture)."' >" ;
						else{
							echo "<img  alt='Profile Pic' class='img-circle' src='../assets/images/icon/blank-img.png' >" ;
						} ?>
				  	</a></div>
					<?php
					$june++;
				}
			}
			?>
			
			
			<?php
			$july = 0;
			foreach ($b as $key => $value) {
				//$result = $p->getTodayBirthday($value);
				$result1 = $p->getMonthBirthday($value, 7);
				//echo $p->ta->sql."<br>";
				if($result1){
					if($july == 0) { ?>
						<h1><i class="fa fa-birthday-cake"></i> July</h1>
					<?php }
					$row = mysqli_fetch_assoc($result1);
					$birthDate = date("d M",strtotime($row["spProfilesDob"]));
					$birthTitle = $row["spProfileName"]." birthday is ". $birthDate; ?>
					<div class="connnectionLevel">
					<a href="<?php echo '../friends/?profileid='.$value;?>" data-toggle="tooltip" data-placement="top" title="<?php echo $birthTitle; ?>" >
				  		<?php
	  					$picture = $row['spProfilePic'];
	  					if(isset($picture))
							echo "<img  alt='Profile Pic' class='img-circle' src=' ".($picture)."' >" ;
						else{
							echo "<img  alt='Profile Pic' class='img-circle' src='../assets/images/icon/blank-img.png' >" ;
						} ?>
				  	</a></div>
					<?php
					$july++;
				}
			}
			?>
			
			<?php
			$aug = 0;
			foreach ($b as $key => $value) {
				//$result = $p->getTodayBirthday($value);
				$result1 = $p->getMonthBirthday($value, 8);
				//echo $p->ta->sql."<br>";
				if($result1){
					if($aug == 0) { ?>
						<h1><i class="fa fa-birthday-cake"></i> August</h1>
					<?php }
					$row = mysqli_fetch_assoc($result1);
					$birthDate = date("d M",strtotime($row["spProfilesDob"]));
					$birthTitle = $row["spProfileName"]." birthday is ". $birthDate;
					?>
					<div class="connnectionLevel">
					<a href="<?php echo '../friends/?profileid='.$value;?>" data-toggle="tooltip" data-placement="top" title="<?php echo $birthTitle; ?>">
					<?php
	  					$picture = $row['spProfilePic'];
	  					if(isset($picture))
							echo "<img  alt='Profile Pic' class='img-circle' src=' ".($picture)."' >" ;
						else{
							echo "<img  alt='Profile Pic' class='img-circle' src='../assets/images/icon/blank-img.png' >" ;
						} ?>
				  	</a>
					</div>
					<?php
					//}
					$aug++;
				}
			}
			?>
			
			<?php
			$sep = 0;
			foreach ($b as $key => $value) {
				//$result = $p->getTodayBirthday($value);
				$result1 = $p->getMonthBirthday($value, 9);
				//echo $p->ta->sql."<br>";
				if($result1){
					if($sep == 0) { ?>
						<h1><i class="fa fa-birthday-cake"></i> September</h1>
					<?php }
					$row = mysqli_fetch_assoc($result1);
					$birthDate = date("d M",strtotime($row["spProfilesDob"]));
					$birthTitle = $row["spProfileName"]." birthday is ". $birthDate; ?>
					<div class="connnectionLevel">
					<a href="<?php echo '../friends/?profileid='.$value;?>" data-toggle="tooltip" data-placement="top" title="<?php echo $birthTitle; ?>" >
				  		<?php
	  					$picture = $row['spProfilePic'];
	  					if(isset($picture))
							echo "<img  alt='Profile Pic' class='img-circle' src=' ".($picture)."' >" ;
						else{
							echo "<img  alt='Profile Pic' class='img-circle' src='../assets/images/icon/blank-img.png' >" ;
						} ?>
				  	</a></div>
					<?php
					$sep++;
				}
			}
			?>
			
			
			<?php
			$oct = 0;
			foreach ($b as $key => $value) {
				//$result = $p->getTodayBirthday($value);
				$result1 = $p->getMonthBirthday($value, 10);
				//echo $p->ta->sql."<br>";
				if($result1){
					if($oct == 0) { ?>
						<h1><i class="fa fa-birthday-cake"></i> October</h1>
					<?php } 
					$row = mysqli_fetch_assoc($result1);
					$birthDate = date("d M",strtotime($row["spProfilesDob"]));
					$birthTitle = $row["spProfileName"]." birthday is ". $birthDate; ?>
					<div class="connnectionLevel">
					<a href="<?php echo '../friends/?profileid='.$value;?>" data-toggle="tooltip" data-placement="top" title="<?php echo $birthTitle; ?>" >
				  		<?php
	  					$picture = $row['spProfilePic'];
	  					if(isset($picture))
							echo "<img  alt='Profile Pic' class='img-circle' src=' ".($picture)."' >" ;
						else{
							echo "<img  alt='Profile Pic' class='img-circle' src='../assets/images/icon/blank-img.png' >" ;
						} ?>
				  	</a></div>
					<?php
					$oct++;
				}
			}
			?>
			
			<?php
			$nov = 0;
			foreach ($b as $key => $value) {
				//$result = $p->getTodayBirthday($value);
				$result1 = $p->getMonthBirthday($value, 11);
				//echo $p->ta->sql."<br>";
				if($result1){
					if($nov == 0) { ?>
						<h1><i class="fa fa-birthday-cake"></i> November</h1>
					<?php }
					$row = mysqli_fetch_assoc($result1);
					$birthDate = date("d M",strtotime($row["spProfilesDob"]));
					$birthTitle = $row["spProfileName"]." birthday is ". $birthDate; ?>
					<div class="connnectionLevel">
					<a href="<?php echo '../friends/?profileid='.$value;?>" data-toggle="tooltip" data-placement="top" title="<?php echo $birthTitle; ?>" >
				  		<?php
	  					$picture = $row['spProfilePic'];
	  					if(isset($picture))
							echo "<img  alt='Profile Pic' class='img-circle' src=' ".($picture)."' >" ;
						else{
							echo "<img  alt='Profile Pic' class='img-circle' src='../assets/images/icon/blank-img.png' >" ;
						} ?>
				  	</a></div>
					<?php
					$nov++;
				}
			}
			?>
			
			<?php
			$dec = 0;
			foreach ($b as $key => $value) {
				//$result = $p->getTodayBirthday($value);
				$result1 = $p->getMonthBirthday($value, 12);
				//echo $p->ta->sql."<br>";
				if($result1){
					if($dec == 0) { ?>
						<h1><i class="fa fa-birthday-cake"></i> December</h1>
					<?php }
					$row = mysqli_fetch_assoc($result1);
					$birthDate = date("d M",strtotime($row["spProfilesDob"]));
					$birthTitle = $row["spProfileName"]." birthday is ". $birthDate; ?>
					<div class="connnectionLevel">
					<a href="<?php echo '../friends/?profileid='.$value;?>" data-toggle="tooltip" data-placement="top" title="<?php echo $birthTitle; ?>" >
				  		<?php
	  					$picture = $row['spProfilePic'];
	  					if(isset($picture))
							echo "<img  alt='Profile Pic' class='img-circle' src=' ".($picture)."' >" ;
						else{
							echo "<img  alt='Profile Pic' class='img-circle' src='../assets/images/icon/blank-img.png' >" ;
						} ?>
				  	</a></div>
					<?php
					$dec++;
				}
			}
			?>
			
		</div>
		
	</div>
 