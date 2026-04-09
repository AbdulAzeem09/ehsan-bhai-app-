<?php
	session_start();
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
?>

  <div style="height:449px; overflow-y: auto; overflow-x: hidden;" class="friend_message">
		<?php
			$message = new _friendchatting;
			$result = $message->read($_POST["myid"] , $_POST["friendid"]);
			//echo $message->ta->sql;
			echo "<table class='table table-hover table-condensed' style='table-layout: fixed' id='myTable'>";
			echo "<tbody>";
			if($result != false)
			{
				$dt = new DateTime($row['spMessageDate']); 
				while($rows = mysqli_fetch_assoc($result))
				{
					
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
						echo "<td width='70px'><a href='#' data-toggle='tooltip' data-placement='left'  title='".($archived == 2 ?"Archived":"Not Archive")."' data-messageid='".$rows["idspfriendChatting"]."' class='".($archived == 2 ?"unarchive":"archive")."' style='".($archived  == 2 ?"color:yellow;":"color:#1a936f;")."' data-profileid='".$_POST["myid"]."'><span class='glyphicon glyphicon-floppy-save'></span></a>
						
						<a href='#' data-messageid='".$rows["idspfriendChatting"]."' class='deletemessage' data-profileid='".$_POST["myid"]."'><span class='glyphicon glyphicon-trash '></span></a>
						
						<a href='#' data-messageid='".$rows["idspfriendChatting"]."' class='".($starred == 1 ?"unstarred":"starred")."' style='".($starred == 1 ?"color:yellow;":"color:#1a936f;")."' data-toggle='tooltip' data-placement='left' title='".($starred == 1 ?"Starred":"Not Starred")."' data-profileid='".$_POST["myid"]."'><span class='fa fa-star'></span></a></td>";
						
						echo "<td width='120px'><b>".$sender."</b></td>";
						
						echo "<td width='100%'>".$rows["spfriendChattingMessage"]."</td>";
						$d = strtotime($rows['spMessageDate']);
						echo "<td width='150px'>".$dt->format('d M')."  ".date("H:i", $d)."</td>";
						echo "</tr>";
					
					}
				}
				
			}
			echo "</tbody>";
			echo "</table>";
		?>
	</div>

<!--Complete-->
<form action="sendmessage.php" method="post">
	<input type="hidden" id="sender" name="spprofiles_idspProfilesSender" value="<?php echo $_POST["myid"]; ?>"/>
	
	<input type="hidden" id="myname" value="<?php echo $_POST["myname"]; ?>"/>
	
	<input type="hidden" id="receiver" name="spprofiles_idspProfilesReciver" value="<?php echo $_POST["friendid"];?>">
	
	<div class="form-group">
		<textarea class="form-control" id="freindmessage" name="spfriendChattingMessage" placeholder="Type your message here..." rows="4"/>
	</div>
	<button class="sendmessagetofriend" type="submit" class="btn btn-success pull-right ">Send</button><br>
</form>