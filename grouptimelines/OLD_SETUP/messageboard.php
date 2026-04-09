<div class="message" style="height:400px; overflow-y:auto; overflow-x:hidden;">
<!--Message Loading-->
<?php

$p = new _spprofiles;
$result = $p->readMember($_SESSION['uid'],$_GET["groupid"]);
if($result != false)
{
$row = mysqli_fetch_assoc($result);
$profileid = $row["idspProfiles"];
$profilename = $row["spProfileName"];
}

$g = new _spgroup;
$pr = $g->admin_Member($profileid,$_GET["groupid"]);
if($pr != false)
{
$row = mysqli_fetch_assoc($pr);
$admin = $row["spProfileIsAdmin"];
}


$m = new _spgroupmessage;
$res = $m->read($_GET["groupid"]);
if($res != false)
{
while($rows = mysqli_fetch_assoc($res))
{
echo "<div class='row messageboard '>";
if($admin == 0 && $rows["spGroupMessageFlag"] != 2)
{
echo "<div class='col-md-10'><span style='font-size:17px;' class='commentoverflow'><img alt='profilepic' class='img-circle' src=' ". ($rows["spProfilePic"])."' style='width: 40px; height: 40px;' >&nbsp;".$rows["spProfileName"]." &nbsp;</span><span>".$rows["spGroupMessage"]."</span></div>";
echo "<div class='col-md-2'>";
if($rows["spGroupMessageFlag"] == 1){
echo "<div class='btn-group' role='group' aria-label='Basic example'>
<button type='button' data-messageid='".$rows["idspGroupMessage"]."' class='btn btn-success approve btn-border-radius'>Approve</button>
<button type='button' data-messageid='".$rows["idspGroupMessage"]."' class='btn btn-danger reject btn-border-radius'>Reject</button>
</div>";
}
echo "</div>";
}
else
if($rows["spGroupMessageFlag"] == 0){
echo "<div class='col-md-10'><span style='font-size:17px;' class='commentoverflow'><img alt='profilepic' class='img-circle' src=' ". ($rows["spProfilePic"])."' style='width: 40px; height: 40px;' >&nbsp;".$rows["spProfileName"]." &nbsp;</span><span>".$rows["spGroupMessage"]."</span></div>";
echo "<div class='col-md-2'>".$rows["spGroupMessageDate"]."</div>";
}
echo "</div><br>";

}
}
?>
</div>
<br>						 
<form enctype="multipart/form-data" action="sendmessage.php" method="post" class="<?php echo ($sendmessage == 2 ? "hidden":"");?>">							
<input type="hidden" name="spSenderProfile" value="<?php echo $profileid;?>">							

<input type="hidden" value="<?php echo $profilename; ?>"> 

<input type="hidden" id="flag" name="spGroupMessageFlag" value="1">	

<input type="hidden" id="group" name="spGroup_idspGroup" value="
<?php echo $_GET["groupid"];?>">							

<div class="form-group">								
<label for="message-text" class="control-label">Message
</label>								
<textarea class="form-control" id="message-text" name="spGroupMessage" placeholder="Type message" rows="3">
</textarea>						    
</div>							
<div class="row">
<div class="col-md-5">						
<input type="file" name="spGroupMessagemedia[]" multiple="multiple"/>
</div>
<div class="col-md-6"></div>
<div class="col-md-1">
<button type="submit" id="groupmessage" class="btn btn-success pull-right btn-border-radius">Send</button>
</div>
</div>
</form>