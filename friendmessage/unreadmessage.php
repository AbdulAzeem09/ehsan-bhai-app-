
<?php
		session_start();
		function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		
?>

<div class="panel panel-primary">
	<div class="panel-heading"><h3 class="panel-title friendtitle">Unread Message</h3></div>
	<div class="panel-body">
		<!--Previous Message-->
		<div style="height:449px; overflow-y: auto; overflow-x: hidden;" class="friend_message">
			<?php
				$message = new _friendchatting;
				$result = $message->asreceiver($_SESSION["uid"]);
				//echo $message->ta->sql;
				if($result != false)
				{
					$dt = new DateTime($row['spMessageDate']);
					echo "<table class='table table-hover table-condensed' style='table-layout: fixed'>";
					echo "<tbody>";					
					while($rows = mysqli_fetch_assoc($result))
					{
						if($rows["spfriendChattingUnread"] == 0){
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
								}
							}
							if($delete == ""){
							echo "<tr class='message messagehighlight'>";
							echo "<td width='10%'><a href='#' data-toggle='tooltip' data-placement='left'  title='".($archived == 2 ?"Archived":"Not Archive")."' data-messageid='".$rows["idspfriendChatting"]."' class='".($archived == 2 ?"unarchive":"archive")."' style='".($archived  == 2 ?"color:yellow;":"color:#1a936f;")."' data-profileid='".$rows["spprofiles_idspProfilesReciver"]."'><span class='glyphicon glyphicon-floppy-save'></span></a>
							
							<a href='#' data-messageid='".$rows["idspfriendChatting"]."' class='deletemessage' data-profileid='".$rows["spprofiles_idspProfilesReciver"]."'><span class='glyphicon glyphicon-trash '></span></a>
							
							<a href='#' data-messageid='".$rows["idspfriendChatting"]."' class='".($starred == 1 ?"unstarred":"starred")."' style='".($starred == 1 ?"color:yellow;":"color:#1a936f;")."' data-toggle='tooltip' data-placement='left' title='".($starred == 1 ?"Starred":"Not Starred")."' data-profileid='".$rows["spprofiles_idspProfilesReciver"]."'><span class='fa fa-star'></span></a>
							
							<a href='#' data-messageid='".$rows["idspfriendChatting"]."' class='<span class='fa fa-star'></span></a></td>";
							
							echo "<td width='15%'></td>";
							
							echo "<td width='57%' class='commentoverflow'><span class='messagechat readmessage' data-mid='".$rows["idspfriendChatting"]."' data-myid='".$rows["spprofiles_idspProfilesReciver"]."' data-friendid='".$rows["spprofiles_idspProfilesSender"]."' style='cursor:pointer;'>".$rows["spfriendChattingMessage"]."</td>";
							$d = strtotime($rows['spMessageDate']);
							echo "<td width='18%'>".$dt->format('d M')."  ".date("H:i", $d)."</td>";
							echo "</tr>";
						}
					}
				}
				echo "</tbody>";
				echo "</table>";
			}
			?>
		</div>
	</div>
</div>