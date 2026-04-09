	<?php
	$r = new _spprofilehasprofile;
	//$res = $r->read($_SESSION["uid"]);
	$res = $r->friendReequestAll($_SESSION["pid"]);
	$totalfriend = 0;
	if($res != false)
	{
		$totalfriend = $res->num_rows;
		while($rows = mysqli_fetch_assoc($res))
		{
			
			$p = new _spprofiles;
			$sender = $rows["spProfiles_idspProfileSender"];
			$receiver = $rows["spProfiles_idspProfilesReceiver"];
			$result = $p->read($rows["spProfiles_idspProfileSender"]);
			if($result != false)
			{	
				$row = mysqli_fetch_assoc($result);
				?>
                <div class="row no-margin">
                    <div class="col-md-2 no-padding">
                        <?php
                        echo "<img  alt='profile-Pic' class='img-responsive' style='width:46px; height: 46px;margin-top:5px;' src='" . (isset($row['spProfilePic']) ? " " . ($row['spProfilePic']) . "" : "../assets/images/icon/blank-img.png") . "'>";
                        ?>
                    </div>
                    <div class='col-md-10 friendsname no-padding-right'>
                        <a href="<?php echo $BaseUrl.'/friends/?profileid='. $rows["spProfiles_idspProfileSender"]?>"><?php echo $row["spProfileName"] . " (" . $row["spProfileTypeName"].")";?></a>
                        <div class='btn-group' role='group' aria-label='Basic example'>                                                          
                            <button type='button' class='btn btn-primary btn-sm acceptrequest' data-sender='<?php echo $sender; ?>' data-receiver='<?php echo $receiver; ?>'>Confirm</button>
                            <button type='button' class='btn btn-warning btn-sm rejectrequest' data-sender='<?php echo $sender; ?>' data-receiver='<?php echo $receiver; ?>'>Delete Request</button>
                        </div>
                    </div>
                </div>
                <hr>
                <?php
			}
			
		}
	}
	?>