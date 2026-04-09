<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

include '../univ/baseurl.php';
session_start();


	function sp_autoloader($class)
	{
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	

	







 
// configuration


				$row = $_POST['row'];
				$rowperpage = 1;   
				$np=new _news;
				$pids=$_SESSION['pid'];
				$sprow=$np->readnotificationloadmore($pids,$row,$rowperpage);
				
				if($sprow !=false){
				while($spresult=mysqli_fetch_assoc($sprow))
				{
					$spdata=$np->spprofilesdata($spresult['sender_pid']);
					$spname=mysqli_fetch_assoc($spdata);

					?>
						<div class="post1" id="post1_<?php echo $_SESSION['pid']; ?>">
						<ul>
						   
							<li class="listyle" style="margin-left: -25px;" >Your <a href=" <?php echo $spresult['news_link'];?>"target=" ">Link</a>
							  &nbsp;&nbsp;shared by <span style="color:red"><a href="https://dev.thesharepage.com/news/profile.php?id=<?php echo $_SESSION['pid']; ?>"><?php echo $spname['spProfileName']; ?></a></span>&nbsp;<span><?php echo $spresult['share_datetime'];?></span>&nbsp;<a href="delnotifications.php?id=<?php echo $spresult['id'];?>"><span class="fa fa-trash" name="deldata"style="font-size:13px;padding:5px 0px 5px 25px" onclick="return confirm('Are you sure you want to delete this item?');"></span></a></li>
						</ul></div> 
						
						
						<?php 
								
							}}
							
							?>
	 
	 

	


   