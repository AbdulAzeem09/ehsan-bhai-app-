<div class="row conectLevl pro_detail_box no-margin ">
	<div class="col-md-12 no-paddiing">
		<?php
			$ph = new _spprofilehasprofile; 
			$p = new _spprofiles;

			$UserProfileId = $SellId;
			$profileIds = $ph->frndLevelfrnd($UserProfileId);

			//echo "<pre>";
			//print_r($result);
			//echo "</pre>";
			$i = 1;
			$count = 1;
			foreach ($profileIds as $key => $value) {
				if($i == 1){
					$level = "1st";
				}else if($i == 2){
					$level = "2nd";
				}else{
					$level = "3rd";
				}
				echo '<h1>'.$level.' Level Friends</h1>';
				?>
				<div class="connnectionLevel">
					<?php
					foreach ($value as $key2 => $value2) {
						$profileid = $value2;
						$res = $p->read($value2);
						//echo $f->ta->sql;
						if($res != false){
						  	$row = mysqli_fetch_array($res);
						  	?>
						  	<a href="<?php echo '../friends/?profileid='.$profileid;?>" data-toggle="tooltip" data-placement="top" title="<?php echo $row["spProfileName"];?>" >
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
					} 
					$i++; ?>
				</div>
				<?php
			}
		?>
	</div>
</div>
