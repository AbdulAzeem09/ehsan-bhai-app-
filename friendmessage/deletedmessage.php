<!--Find sender id who is friend of receiver -->
<?php
		session_start();
		function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
?>

<div class="panel panel-primary">
	<div class="panel-heading"><h3 class="panel-title">Deleted Message</h3></div>
	<div class="panel-body">
		<div style="height:449px; overflow-y: auto; overflow-x: hidden;" class="friend_message">
			<?php
				$message = new _friendchatting;
				$result = $message->starredmessage();
				if($result != false)
				{
					$dt = new DateTime($row['spMessageDate']); 
					echo "<table class='table table-hover table-condensed' style='table-layout: fixed'>";
					echo "<tbody>";
					while($rows = mysqli_fetch_assoc($result))
					{
						$m = new _messageactivity;
						$res = $m->deletedmessage($rows["idspfriendChatting"] , $_SESSION["uid"]);
						if($res != false)
						{
							while($row = mysqli_fetch_assoc($res))
							{
								echo "<tr class='message'>";
								echo "<td width='20px'><a href='#' data-messageid='".$rows["idspfriendChatting"]."' class='restore' data-profileid='".$row["spMessageActivityProfile"]."'><span class='fa fa-refresh '></span></a></td>";
								
								echo "<td width='100%' class='commentoverflow'>".$rows["spfriendChattingMessage"]."</td>";
								$d = strtotime($rows['spMessageDate']);
								echo "<td width='130px'>".$dt->format('d M')."  ".date("H:i", $d)."</td>";
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