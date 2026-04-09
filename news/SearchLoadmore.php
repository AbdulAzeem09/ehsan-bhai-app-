<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 'On');

include '../univ/baseurl.php';
session_start();


	function sp_autoloader($class)
	{
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	

	







 
// configuration


$row = $_POST['row'];
$rowperpage = 5;

// selecting posts
//$query = 'SELECT * FROM posts limit '.$row.','.$rowperpage;
$pr = new _spprofiles;									
					
						$records=$_POST['records'];
						$spcmd=$pr->sprecordLoadmore($records,$row,$rowperpage);
						
						if($spcmd != false){ 
						while($spdata=mysqli_fetch_assoc($spcmd))
						{
							
							?>
							<div class="post1" id="post1_<?php echo $records; ?>">
							<a href='<?php echo $BaseUrl;?>/news/profile.php?id=<?php echo $spdata['idspProfiles'];?>'>
							<div class="form-group"style="border-color: red;border:2px solid blue;border-radius:5px">
								<tr style="border-color: red">
									<?php if($spdata['spProfilePic']!=false){ ?>
										<td><img  src="<?php echo $spdata['spProfilePic'] ?>"style="width:80px;height:80px;border-radius:50%;"></td><?php } else
										{		  ?>
										<td><img  src="https://www.freeiconspng.com/thumbs/no-image-icon/no-image-icon-15.png"style="width:80px;height:80px;border-radius:50%;"></td>
									<?php } ?>
									<td><?php echo $spdata['spProfileName'];?></td>
									<?php 
										$ids=$_SESSION['pid'];
										$spids=$spdata['idspProfiles'];
									 
										$spres=$pr->spdataa($ids,$spdata['idspProfiles']);
										$add=$_POST['records'];  
																													 $obb=new _news;
						                                                               $blockres=$obb->read_profile_block($spids,$_SESSION['pid']); 				if(!$blockres){	
										
										if($spids!=$ids){
											if($spres!=false){  
										?>
										<td><a href="operation1.php?whom=<?php echo $spdata['idspProfiles']; ?>&records=<?php echo $add;?>"><span style="font-size:20px;color:blue;margin-left:40px;float: right; padding: 23px;">Unfollow</span></a></td>
										<?php  } else {
										?>
										<td><a href="operation.php?whom=<?php echo $spdata['idspProfiles']; ?>&records=<?php echo $add;?>"><span style="font-size:20px;color:blue;margin-left:40px;float: right; padding: 23px;">Follow</span></a></td>
										<?php 
																					   }		}	}  ?>
								</tr>
							</div></div> 
</a>
							<?php 
								
								
							}
					}
					 ?> 
	
	

   