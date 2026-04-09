<div role="tabpanel" class="tab-pane fade" id="suggest" aria-labelledby="suggest-tab">
<div class="topstatus timeline-topstatus " style="margin-top: 23px;">
<div class="row">
<div class="col-sm-12">
<div class="heading01 text-center" style="background: white;height: auto;">
<div class="list-wrapper3">
<h4 style="color: #0b241e;margin-top: 0px;">SOME GROUPS YOU MIGHT BE INTERESTED IN <a class="pull-right" href="<?php //echo $BaseUrl;
?>/my-groups/group-intrest.php">VIEW/UPDATE MY INTEREST</a></h4>
<h5 style="color: #0b241e;border-bottom: 1px solid #0b241e;">
<?php $qry = "SELECT * FROM group_interest WHERE sp_profile_id = '" . $_SESSION['pid'] . "'";
$fetch_qry = mysqli_query($dbConn, $qry);
if (mysqli_num_rows($fetch_qry)) {
while ($fetch_data = mysqli_fetch_array($fetch_qry)) { ?>
<?php } ?>
</a>
</h5>
<?php } else {
?>
<h5 style="color: #0b241e;border-bottom: 1px solid #0b241e;cursor: pointer;" data-toggle="modal" data-target="#interestModal">ADD/UPDATE MY INTERESTS</h5>
<?php } ?>
<?php
$intrestshown = 1;
$proobj = new _groupconversation;
$result = $proobj->readPost33();

$intrestid = array();
if ($result != false) {

while ($row2 = mysqli_fetch_assoc($result)) {
//print_r($row2);

array_push($intrestid, $row2['intrest_id']);
}
}


$where = "";
foreach ($intrestid as $val) {
$where .=  "t.spgroupCategory=" . $val . ' OR ';
}


$where = $where . 'spgroupCategory = ' . $val;
$g = new _spgroup;
$result9 = $g->publicgroup_suggest($where);
// echo $g->tap->sql;
//die;
if ($result9 != false) {
$count_box = 0;
$count_g = 0;
while ($row5 = mysqli_fetch_assoc($result9)) {

$r = $g->check_mygroup($row5['idspGroup'], $_SESSION["pid"]);

if (!$r) {

/* */
$gid = $row5['idspGroup'];
$_SESSION['gid'] = $gid;
$st = $g->read_group_status($gid);
if ($st != false) {
$sta = mysqli_fetch_assoc($st);
$group_status = $sta['spgroupstatus'];
}
$gname = $row5['spGroupName'];
$_SESSION['gname'] = $gname;
$result6 = $g->public_not_join($row5['idspGroup'], $_SESSION['pid']);
if ($gid != '') {
//echo $row9['idspGroup'];
$result2 = $g->groupdetails_suggest($gid);
//  echo $g->tap->sql;
//die;
if ($result2 != false) {
//	die('=============');
$row2 = mysqli_fetch_assoc($result2);
//print_r($row2);
$gdes = $row2["spGroupAbout"];
$gimage = $row2["spgroupimage"];
}

//GET ADMIN  NAME OR IMAGE
$rpvt = $g->members($row5['idspGroup']);
//echo $g->ta->sql; 

if ($rpvt != false) {
while ($row3 = mysqli_fetch_assoc($rpvt)) {
//print_r($row3);
if ($row3['spUser_idspUser'] != NULL) {
$st = new _spuser;
$st1 = $st->readdatabybuyerid($row3['spUser_idspUser']);
if ($st1 != false) {
$stt = mysqli_fetch_assoc($st1);
$account_status = $stt['deactivate_status'];
}
}
if ($row3['spProfileIsAdmin'] == 0) {

$spProfilePic = $row3['spProfilePic'];
$Group_Admin_Name = $row3['spProfileName'];
}
}
}


if ($intrestshown > 9) {
break;
}


$intrestshown++;
if ($account_status != 1) {
if ($group_status == 0) {
?>
<div class="col-md-4 no-padding" style=" border-style: groove; ">
<div class="list-item3">
<div class="main_grop_box <?php echo ''; ?>" style="min-height: 160px !important;">
<a href="<?php echo $BaseUrl; ?>/grouptimelines/?groupid=<?php echo $row5['idspGroup'] ?>&groupname=<?php echo $row5['spGroupName'] ?>&timeline">
<?php
if ($gimage == "") { ?>
<img src="<?php echo $BaseUrl; ?>/assets/images/bg/xtop_banner.jpg.pagespeed.ic.pG0MpHuNM1.webp" class="img-responsive group_banner" alt="" style="height:160px;" /><?php
} else {
?>
<img src="<?php echo $BaseUrl; ?>/uploadimage/<?php echo $gimage; ?>" class="img-responsive group_banner" alt="" style="height:160px;" /><?php
}


?>
</a>
</div>
<div class="row">
<!--  <h2 style="font-size: 19px;"><?php echo ucfirst($Group_Admin_Name); ?></h2> -->
<a href="<?php echo $BaseUrl; ?>/grouptimelines/?groupid=<?php echo $row5['idspGroup'] ?>&groupname=<?php echo $row5['spGroupName'] ?>&timeline">
<?php if (strlen($row5['spGroupName']) < 11) { ?>
<h2 style="margin-top: -5px;"><?php echo ucwords(strtolower($row5['spGroupName'])); ?></h2>
<?php } else { ?>
<h2 style="margin-top: -5px;"><?php echo ucwords(strtolower(substr($row5['spGroupName'], 0, 11) . '...')); ?></h2>
<?php } ?>
</a>
<div class="row">
<div class="" style="float:left;margin-left: 10px;">
<?php if ($row5['spgroupflag'] == 1) {
echo '<h6 style="color:black;margin-top: -5px;"><i class="fa fa-lock"></i> Private Group</h6>';
} else {
echo '<h6 style="color:black;margin-top: -5px;"><i class="fa fa-globe"></i> Public Group</h6>';
} ?>
</div>
<div class="" style="float:right;margin-right: 13px;">
<h6 style="text-align:center;color:black;margin-top: -5px;">
<?php
//	echo $_GET["groupid"]; die("========");
$getPendingMembers = $g->joinedMembersOfGroup($row5['idspGroup']);

if ($getPendingMembers != false) {
$pendCounter = mysqli_num_rows($getPendingMembers);

if ($pendCounter > 0) {
?>
<p>Members <span>(<?php echo $pendCounter; ?>)</span></p>
</a>
<?php
} else { ?>
<p>0 Member</p>
</a>
<?php }
} else {

echo " <p>0 Member</p></a>";
} ?>
</h6>
</div>
</div>
</div>
<div class="pull-left" style="margin-left: 118px;margin-bottom:5px;">
<label>
<?php
$g = new _spgroup;

$d = $g->checkRequest($_SESSION['pid'], $row5['idspGroup']);

if (!$d) {
?>
<button class="join_timeline btn view_right_joinbtn" style="padding: 7px 20px 7px 20px!important;" onclick="joinGroup('<?php echo $_SESSION['pid'] ?>','<?php echo $row5['idspGroup']; ?>')">Join</button>
<?php } else { ?>
<button class="join_timeline btn view_right_joinbtn" style="padding: 7px 10px 7px 10px!important;margin-left: -30px;">Request sent</button>
<? } ?>
</label>
</div>
<?php
//count member old and new

$result3 = $g->allgrpmember($row5['idspGroup']);


// echo $g->tad->sql;
if (!empty($result3)) {
$total_member = mysqli_num_rows($result3);
$result4 = $g->newgrpmember($row5['idspGroup']);
if ($result4) {
$new_tot_member = mysqli_num_rows($result4);
}
} else {
$new_tot_member = 0;
}

?>
<?php if ($row5['spgroupCategory'] == '') { ?>
<h5 style="color: black;margin-top: 5px;"></h5>
<?php } else { ?>
<h5 style="color: black;margin-top: 5px;"><?php echo ucwords(strtolower($row5['spgroupCategory'])); ?></h5>
<?php } ?>
</div>
</div>
<?php }
}
}
}
}
}
?>
</div>
<div style="min-height:50px;"><span class="pull-right seemore" style="margin-right: 20px;">
<button class="view_right_joinbtn hover_on_btn">&nbsp;
<a class="pull-right" href="all_suggested_group.php" style="color: #fff; width:80px;">View More</a></button></span>
</div>
</div>
</div>
<!--  -->
</div>
</div>
</div>