<!--Find sender id who is friend of receiver -->
<?php
		session_start();
		function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
?>

<div class="panel panel-primary">
	<div class="panel-heading"><h3 class="panel-title">Starred Message</h3></div>
	<div class="panel-body">
		<div style="height:449px; overflow-y: auto; overflow-x: hidden;" class="friend_message">
			<?php
				$message = new _friendchatting;
				$pr = new _spprofiles;
				$result = $message->starredmessage();
				//echo $message->ta->sql;
				if($result != false)
				{
					$dt = new DateTime($row['spMessageDate']); 
					echo "<table class='table table-hover table-condensed' style='table-layout: fixed'>";
					echo "<tbody>";
					while($rows = mysqli_fetch_assoc($result))
					{
						//Friendid
						$rs = $message->assenderfriendid($_SESSION["uid"] , $rows["idspfriendChatting"]);
						if($rs != false)
						{
							$rws = mysqli_fetch_assoc($rs);
							$friendid  = $rws["spprofiles_idspProfilesSender"];
						}
						else
							$friendid = $rows["spprofiles_idspProfilesReciver"];
						
						//sender Details
						$rslt = $pr->read($friendid);
						if($rslt != false)
						{
							$rw = mysqli_fetch_assoc($rslt);
							$myfriend = $rw["spProfileName"];
							$freindicon = $rw["spprofiletypeicon"];
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
								{
									$starred = $row["idspMessageActivityFlag"];
								}
								
								if($row["idspMessageActivityFlag"] == 0)
									$delete = $row["idspMessageActivityFlag"];
								
								$myprofileid = $row["spMessageActivityProfile"];
								
								if($starred == 1){
								echo "<tr class='message'>";
									echo "<td width='10%'><a href='#' data-toggle='tooltip' data-placement='left'  title='".($archived == 2 ?"Archived":"Not Archive")."' data-messageid='".$rows["idspfriendChatting"]."' class='".($archived == 2 ?"unarchive":"archive")."' style='".($archived  == 2 ?"color:yellow;":"color:#1a936f;")."' data-profileid='".$myprofileid."'><span class='glyphicon glyphicon-floppy-save'></span></a>
									
									<a href='#' data-messageid='".$rows["idspfriendChatting"]."' class='deletemessage' data-profileid='".$myprofileid."'><span class='glyphicon glyphicon-trash '></span></a>
									
									<a href='#' data-messageid='".$rows["idspfriendChatting"]."' class='".($starred == 1 ?"unstarred":"starred")."' style='".($starred == 1 ?"color:yellow;":"color:#1a936f;")."' data-toggle='tooltip' data-placement='left' title='".($starred == 1 ?"Starred":"Not Starred")."' data-profileid='".$myprofileid."'><span class='fa fa-star'></span></td>";
									
									echo "<td width='15%' class='commentoverflow'><b>Me,".$myfriend."</b></td>";
									
									echo "<td width='57%' class='commentoverflow'><span class='messagechat friendchat frdicon' data-mid='".$rows["idspfriendChatting"]."' data-myid='".$myprofileid."' data-friendid='".$friendid."' style='cursor:pointer;' data-frndicon='".$freindicon."' data-friendname='".$myfriend."'>".$rows["spfriendChattingMessage"]."</td>";
									$d = strtotime($rows['spMessageDate']);
									echo "<td width='18%'>".$dt->format('d M')."  ".date("H:i", $d)."</td>";
								echo "<tr>";
							}
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