		<br><form action="../social/addcomment.php" method="post">
		
			<input type="hidden" name="spPostings_idspPostings" value="<?php echo $rows['idspPostings']?>">
			
			 <input type="hidden" name="grouptimelines_" value="<?php echo $grouptimelines;?>">
			 
			<input class="dynamic-pid enterkey" name="spProfiles_idspProfiles" type="hidden" value="<?php echo $_SESSION['pid']?>"> 
			
			<div class="row">
				<div class="col-md-12">
					<div class="input-group">
						<div class="input-group-addon commentprofile">
							<?php

								$p = new _spprofiles;
								$result = $p->read($_SESSION['pid']);
								if($result != false)
								{
									$row = mysqli_fetch_assoc($result);
									if(isset($row["spProfilePic"]))
										echo "<img alt='profilepic' class='img-circle' src=' ". ($row["spProfilePic"])."' style='width: 40px; height: 40px;' ><span style='font-weight:600;color:#1a936f;'>&nbsp;&nbsp;".$row["spProfileName"]."</span>" ;
									else
										echo "<img alt='profilepic' class='img-circle' src='../img/default-profile.png' style='width: 30px; height: 30px;' >" ;
								}
							?>
						</div>
						<input type="text" class="form-control" name="comment" id="comment"  placeholder="Write a comment..." style='height:60px;'>
					</div>
				</div>
			</div>
		</form>