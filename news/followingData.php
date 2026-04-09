




<div class="post1" id="post1_<?php 
  $Id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
echo $Id; ?>">

<div class="followingstructure" style="margin-top:20px;">


	  <tr>
       	   
	  <?php if($row2['spProfilePic']!=false){ ?>
	  <td><img  src="<?php echo $row2['spProfilePic'] ?>"style="padding:2px;width:80px;height:80px;border-radius:50%;"></td><?php } else
	  {		  ?>
  
  <td><img  src="https://www.freeiconspng.com/thumbs/no-image-icon/no-image-icon-15.png"style="padding:2px;width:80px;height:80px;border-radius:50%;"></td>
  <?php } ?>
	  <a href='<?php echo $BaseUrl;?>/news/profile.php?id=<?php echo $whom;?>'><td><?php echo $row2['spProfileName']."    <b>(".$rowww['spProfileTypeName'].")</b>";?></td></a>
	 
	  
	   
	  			<?php 
																						$ids=$_SESSION['pid'];
																						//echo $ids;
																						
																						//echo $row['whom'];
																						//die('###############'); 
                                                                         $pr = new _spprofiles;																						
																						$spres=$pr->spdataa($ids,$row['whom']);
																						$add=$_GET['records']; 
																						if($spres!=false){  ?>
																						<td><a href="followw.php?whom=<?php echo $whom; ?>&current_id=<?php echo $Id; ?>"><span style="font-size:18px;color:blue;margin-left:40px;float: right; padding: 23px;">Unfollow</span></a></td>
																						<?php  } else {
																						?>
																						<td><a href="followw.php?whom=<?php echo $whom; ?>&current_id=<?php echo $Id; ?>"> <span style="font-size:18px;color:blue;margin-left:40px;float: right; padding: 23px;">Follow</span></a></td>
																						<?php 
																						}			  ?>
	  
	 <!--  <?php //

																					//	$spres=$pr->spdataa($whom,$_GET['id']);
																					//	if($spres!=false){ ?>
																						<td><a href="operation1.php?whom=<?php // echo $spdata['idspProfiles']; ?>"><span style="font-size:20px;color:blue;margin-left:40px;float: right; padding: 23px;">Following</span></a></td>
																						<?php //  } else {
																						?>
																						<td><a href="operation.php?whom=<?php // echo $spdata['idspProfiles']; ?>"><span style="font-size:20px;color:blue;margin-left:40px;float: right; padding: 23px;">Not Following</span></a></td>
																						<?php 
																						// }			  ?>     -->
	 
	  </tr>
	  </div>

	  </div>
