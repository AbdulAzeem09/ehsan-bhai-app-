
<div class="post1" id="post1_
<?php
	$Id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
echo $Id; 
?>"> 

<div class="followerstructure" style="margin-top: 20px;">
	  <tr style="border-color: red">
	  <?php if($row2['spProfilePic']!=false){ ?>
	  <td><img  src="<?php echo $row2['spProfilePic'] ?>"style="padding: 2px;width:70px;height:70px;border-radius:50%;"></td><?php } else
	  {		  ?>
  
  <td><img  src="https://www.freeiconspng.com/thumbs/no-image-icon/no-image-icon-15.png"style="padding: 2px;width:80px;height:80px;border-radius:50%;"></td>
  <?php } ?>
	 <a href='<?php echo $BaseUrl;?>/news/profile.php?id=<?php echo $who;?>'> <td><?php echo $row2['spProfileName'];?></td></a>
	 	  			<?php 
																						 $ids=$_SESSION['pid'];
																						//echo $who;
																						//die("###############");
																						$pr = new _spprofiles;
																						$spres=$pr->spdataa($ids,$who);
																						$add=$_GET['records']; 
																						if($spres!=false){  ?>
																						<td>
																						
																						<a href="followerr.php?whom=<?php echo $who; ?>&current_id=<?php echo $Id; ?>"><span style="font-size:18px;color:blue;margin-left:40px;float: right; padding: 20px;">Unfollow</span></a></td>
																						<?php  } else {
																						?>
																						<td><a href="followerr.php?whom=<?php echo $who; ?>&current_id=<?php echo $Id; ?>"><span style="font-size:18px;color:blue;margin-left:40px;float: right; padding: 20px;">Follow</span></a></td>
																						<?php 
																						}			  ?>
	  </tr></div>   </div>
