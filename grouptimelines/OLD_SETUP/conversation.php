<?php
$profileid = $_SESSION['pid'];
//Admin Testing Complete
$g = new _spgroup;
$pr = $g->admin_Member($profileid, $_GET["groupid"]);
if ($pr != false) {
$row = mysqli_fetch_assoc($pr);
$admin = $row["spProfileIsAdmin"];
}

//Close
$gc = new _groupconversation;
$m = new _spgroupmessage;
echo "<div class='row'>"
. "<div class='col-md-5' >";
echo "<div class='grpconversation'>";
$res = $m->read($_GET["groupid"]);
//QUERY FOR CHEK HOW MANY PERSON IS ONLINE OR NOT
//echo $m->ta->sql;
if ($res != false) {

while ($rows = mysqli_fetch_assoc($res)) {
//echo "<pre>";
//print_r($rows);
//echo "</pre>";
if ($admin == 0 ) {
if($rows["spGroupMessageFlag"] == 2){
echo "<div class='hideunhide searchable' style='height: 0px;' >";
}else{
echo "<div class='hideunhide searchable'  >";
}


}else if($rows["spGroupMessageFlag"] == 0 ){
echo "<div class='hideunhide searchable'  >";
}else{
echo "<div class='hideunhide searchable' style='height: 0px;' >";
}

$latestreply = "";
$totalreply = 0;
$result = $gc->read($rows["idspGroupMessage"]);
if ($result != false) {
$totalreply = $result->num_rows;
while ($row = mysqli_fetch_assoc($result)) {
$latestreply = $row["spProfileName"];
$datetime = $row["spGroupConversationDate"];
$dt = new DateTime($datetime);
$date = $dt->format('m/d/Y');
$time = $dt->format('H:i:s A');
}
} else {
$datetime = isset($rows["spGroupMessageDate"]);
$latestreply = isset($rows["spProfileName"]);
$datetime = isset($row["spGroupConversationDate"]);
$dt = new DateTime($datetime);
$date = $dt->format('m/d/Y');
$time = $dt->format('H:i:s A');
}
echo "<div class='conversationmessage'>";

echo "<div class='conversation hidden'>"; //Reply 
echo "<div class='loadconversation'>";
$result = $gc->read($rows["idspGroupMessage"]);
if ($result != false) {
while ($row = mysqli_fetch_assoc($result)) {
echo "<div class='row'>";
echo "<div class='col-md-2' style='clor:#483D8B;font-weight:bold;margin-bottom:3px;'>"
. "<img  alt='Posting Pic' class='img-rounded' style='width:30px; height:30px;' src='" . (isset($row["spProfilePic"]) ? " " . ($row["spProfilePic"]) . "" : "../img/default-profile.png") . "' > " . $row["spProfileName"] . "</div>";

$dt = new DateTime($row['spGroupConversationDate']);
$d = strtotime($row['spGroupConversationDate']);
echo "<div class='col-md-5'>";
echo "<span style='margin-top:5px;'>" . $row["spGroupConversationText"] . "</span>";

echo "<span class='pull-right' style='color:gray;'>" . $dt->format('d M') . "  " . date("H:i", $d) . "</span>";
echo "</div>";

echo "</div>";
}
}
echo "<form action='' method='post'>
<input type='hidden' name='spGroupConProfile' value='" . $profileid . "'/>
<input type='hidden' id='spGroupMessage_idspGroupMessage' name='spGroupMessage_idspGroupMessage' value='" . $rows["idspGroupMessage"] . "'/>
<div class='form-group' style='width:10cm;'>
<textarea class='form-control spGroupConversationText' rows='2' name='spGroupConversationText' placeholder='Write message...'></textarea>
</div>
<button type='button' class='btn btn-primary addconversation btn-border-radius' data-gmesgid='" . $rows["idspGroupMessage"] . "'>Send message</button>				
<button type='button' class='btn btn-warning pull-right alldiscuss btn-border-radius' data-toggle='tooltip' data-placement='left' title='See all discussion'><span class='glyphicon glyphicon-remove'></span></button>
</form>";
echo "</div>";
echo "</div>"; //conversation
echo "</div><br>"; //conversationmessage
echo "</div>";
}
}
echo "</div>"
. "</div></div>";
echo '<div class="col-md-7 friendchatsystem myfriend"><!--Find sender id who is friend of receiver --> 

<div class="box box-primary">
<div class="panel-heading">
<div class="row">
<div class="col-md-7">				
</div>			
</div>	
</div>
<div class="panel-body">
<!--Previous Message-->
<div class="chattingsystem">
<div id="">	
<div style="height: 312px; overflow-y: auto; overflow-x: hidden;" class="friend_message">
<table class="table table-hover table-condensed" style="table-layout: fixed" id="myTable">';
echo '<thead><tr><th width="2%"></th><th>Participant</th><th>Message</th><th>Created Date</th></tr></thead><tbody>';
$dt = new DateTime(isset($row['spGroupConversationDate']));
$d = strtotime(isset($row['spGroupConversationDate']));
echo '<tr> 
<td width="2%">                                    				
</td>
<td width="20%" class="commentoverflow">
<b>' . isset($row["spProfileName"]) . '</b>
</td>
<td style="word-wrap: break-word;min-width: 57%;max-width: 57%;">' . isset($row["spGroupConversationText"]) . '</td>
<td width="18%">' . $dt->format('d M') . "  " . date("H:i", $d) . '</td>
</tr>                                                                      
</tbody>
</table>			
</div>
</div>
<!--Complete  action="sendmessage.php" method="post"-->		
</div>
</div>
</div></div></div></div>';
/*
<form method="post" action="addconversation.php">
<input type="hidden" name="spGroupConProfile" value="' . $profileid . '"/>
<input type="hidden" id="spGroupMessage_idspGroupMessage" name="spGroupMessage_idspGroupMessage" value="' . $rows["idspGroupMessage"] . '"/>			
<div class="form-group">
<textarea class="form-control spGroupConversationText" name="spGroupConversationText" placeholder="Type your message here..." rows="4"></textarea>
</div>
<button class="addconversation" type="button" data-gmesgid="' . $rows["idspGroupMessage"] . '">Send</button><br>
</form>
*  */
?>

<!--Conversation Subject-->
<div class="modal fade" id="conversationModal" tabindex="-1" role="dialog" aria-labelledby="enquireModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
<h4 class="modal-title" id="enquireModalLabel"><b>New Conversation</b></h4>
</div>
<div class="modal-body" style="background-color:white;">
<form action="sendmessage.php" method="post">

<input type="hidden" id='conversationinit' name="spSenderProfile" value="<?php echo $profileid; ?>"/>


<input type="hidden" id="starter" value="<?php echo $profilename; ?>"/>

<input type="hidden" name="spGroup_idspGroup" value="<?php echo $_GET['groupid'] ?>"/>

<input type="hidden" name="groupname_" value="<?php echo $_GET['groupname'] ?>"/>

<input type="hidden" name="spGroupMessageFlag" id="grpflag" value="<?php echo ($admin == 0 ? "0" : "1") ?>">

<div class="form-group">
<label for="message" class="form-control-label">New Topic</label>
<input type="text" class="form-control" id="message" name="spGroupMessage" />
</div>

<div class="form-group">
<label for="message" class="form-control-label">Message</label>
<textarea class="form-control" id="description" rows="5" name="conversationText_" ></textarea>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
<button type="submit" id="groupconversation" class="btn btn-primary btn-border-radius">Start</button>
</div>
</form>
</div>
</div>
</div>
</div>
