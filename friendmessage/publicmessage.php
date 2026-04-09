<!--Find sender id who is friend of receiver -->
<?php
	session_start();
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");	
	$r = new _spprofilehasprofile;
	//My profile as a Receiver
	$res = $r->myprofileidReciever($_SESSION["uid"] ,$_POST["friendid"]);
	if($res != false)
	{

		while($rows = mysqli_fetch_assoc($res))
		{
			$pr = new _spprofiles;
			$result = $pr->read($rows["spProfiles_idspProfilesReceiver"]);
			if($result != false)
			{
				$row = mysqli_fetch_assoc($result);
				$myname = $row["spProfileName"];
				$icon = $row["spprofiletypeicon"];
			}
		}
	}
	//My profile as a Sender
	$res = $r->myprofileidSender($_SESSION["uid"] ,$_POST["friendid"]);
	if($res != false)
	{

		while($rows = mysqli_fetch_assoc($res))
		{
			
			$pr = new _spprofiles;
			$result = $pr->read($rows["spProfiles_idspProfileSender"]);
			if($result != false)
			{
				$row = mysqli_fetch_assoc($result);
				$myname = $row["spProfileName"];
				$icon = $row["spprofiletypeicon"];
			}
		}
	}	
?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-7">
				<div id="friendlist">
					<!--Adding Friend-->
				</div>
			</div>	
			<div class="col-md-2">	
				<div class="form-group">
					<input type="text" class="form-control" id="srhfriend" placeholder="Search Friends...">
				</div>
			</div>

			<div class="col-md-3">
				<div class="dropdown pull-right">
					<span class="dropdown-toggle" type="button" data-toggle="dropdown">Send As <span id="glyphicon"class="<?php echo $icon;?>"></span> <span id="myprofileasfriend"><?php echo $myname;?></span><span class="caret"></span></span>
					<ul class="dropdown-menu">
						<?php
							$r = new _spprofilehasprofile;
							//My profile as a Receiver
							$res = $r->myprofileidReciever($_SESSION["uid"] ,$_POST["friendid"]);
							if($res != false)
							{

								while($rows = mysqli_fetch_assoc($res))
								{
									$pr = new _spprofiles;
									$result = $pr->read($rows["spProfiles_idspProfilesReceiver"]);
									if($result != false)
									{
										$row = mysqli_fetch_assoc($result);
										echo "<li><a href='#' data-myid='".$row["idspProfiles"]."' class='sendas' data-friendid='".$_POST["friendid"]."' data-ptypeicon='".$row["spprofiletypeicon"]."'><span class='".$row["spprofiletypeicon"]."'></span> ".$row["spProfileName"]."</a></li>";
										
										$myid =  $row["idspProfiles"];
										$myname = $row["spProfileName"];
									}
								}
							}
							//My profile as a Receiver
							$res = $r->myprofileidSender($_SESSION["uid"] ,$_POST["friendid"]);
							if($res != false)
							{

								while($rows = mysqli_fetch_assoc($res))
								{
									
									$pr = new _spprofiles;
									$result = $pr->read($rows["spProfiles_idspProfileSender"]);
									if($result != false)
									{
										$row = mysqli_fetch_assoc($result);
										
										echo "<li><a href='#' data-myid='".$row["idspProfiles"]."' class='sendas' data-friendid='".$_POST["friendid"]."' data-ptypeicon='".$row["spprofiletypeicon"]."'><span class='".$row["spprofiletypeicon"]."'></span> ".$row["spProfileName"]."</a></li>";
										
										$myid =  $row["idspProfiles"];
										$myname = $row["spProfileName"];
									}
								}
							}
						?>
						
					</ul>
				</div>
			</div>
		</div>	
	</div>
	<div class="panel-body">
		<!--Previous Message-->
		<div class="chattingsystem">
			<div style="height:449px; overflow-y: auto; overflow-x: hidden;" class="friend_message">
				<?php
					$message = new _friendchatting;
					$result = $message->read($myid , $_POST["friendid"]);
					//echo $message->ta->sql;
					echo "<table class='table table-hover table-condensed' style='table-layout: fixed' id='myTable'>";
					echo "<tbody>";
					if($result != false)
					{
						 
						while($rows = mysqli_fetch_assoc($result))
						{
								$dt = new DateTime($rows['spMessageDate']);
								//profile-details//
								$p = new _spprofiles;
								$pr = $p->read($rows["spprofiles_idspProfilesSender"]);
								if($pr != false)
								{
									$rw = mysqli_fetch_assoc($pr);
									$sender = $rw["spProfileName"];
								}
								
								$archived = "";
								$starred = "";
								$delete = "";
								$m = new _messageactivity;
								$res = $m->read($rows["idspfriendChatting"] , $_SESSION["uid"]);
								if($res != false)
								{
									while($row = mysqli_fetch_assoc($res))
									{
										if($row["idspMessageActivityFlag"] == 2)
											$archived = $row["idspMessageActivityFlag"];
										
										if($row["idspMessageActivityFlag"] == 1)
											$starred = $row["idspMessageActivityFlag"];
										
										if($row["idspMessageActivityFlag"] == 0)
											$delete = $row["idspMessageActivityFlag"];
										
										$myprofileid = $row["spMessageActivityProfile"];
									}
								}
								
							if($delete == ""){
							echo "<tr class='message'>";
								echo "<td width='10%'><a href='#' data-toggle='tooltip' data-placement='left'  title='".($archived == 2 ?"Archived":"Not Archive")."' data-messageid='".$rows["idspfriendChatting"]."' class='".($archived == 2 ?"unarchive":"archive")."' style='".($archived  == 2 ?"color:yellow;":"color:#1a936f;")."' data-profileid='".$myid."'><span class='glyphicon glyphicon-floppy-save'></span></a>
								
								<a href='#' data-messageid='".$rows["idspfriendChatting"]."' class='deletemessage' data-profileid='".$myid."'><span class='glyphicon glyphicon-trash '></span></a>
								
								<a href='#' data-messageid='".$rows["idspfriendChatting"]."' class='".($starred == 1 ?"unstarred":"starred")."' style='".($starred == 1 ?"color:yellow;":"color:#1a936f;")."' data-toggle='tooltip' data-placement='left' title='".($starred == 1 ?"Starred":"Not Starred")."' data-profileid='".$myid."'><span class='fa fa-star'></span></a></td>";
								
								echo "<td width='15%' class='commentoverflow'><b>".$sender."</b></td>";
								
								echo "<td width='60%' class='commentoverflow'>".$rows["spfriendChattingMessage"]."</td>";
								
								// $rows['spMessageDate']; $dt->format('d M')$dt->format('G:i:s')
								$d = strtotime($rows['spMessageDate']);
								echo "<td width='15%'>".$dt->format('d M')."  ".date("H:i", $d)."</td>";
								echo "</tr>";
							
							}
						}
						
					}
					echo "</tbody>";
					echo "</table>";
				?>
			</div>
		
		<!--Complete  action="sendmessage.php" method="post"-->
		<form method="post" id="myform">
			<input type="hidden" id="sender" name="spprofiles_idspProfilesSender" value="<?php echo $myid; ?>"/>
			
			<input type="hidden" id="myname" value="<?php echo $myname; ?>"/>
			
			<input type="hidden" id="receiver" name="spprofiles_idspProfilesReciver" value="<?php echo $_POST["friendid"];?>">
			
			<div class="form-group">
				<textarea class="form-control" id="freindmessage" name="spfriendChattingMessage" placeholder="Type your message here..." rows="4"/>
			</div>
			<button class="sendmessagetofriend" type="button" class="btn btn-success pull-right ">Send</button><br>
		</form>
	</div>
 </div>
</div>