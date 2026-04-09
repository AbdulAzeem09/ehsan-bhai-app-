<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">
<?php
$getid = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;
$p = new _spgroup;
$rpvt = $p->members($getid);
$gcdate =    $p->groupCreatedDate($getid);
if ($gcdate) {
$groupCrDate = mysqli_fetch_assoc($gcdate);
}
$CreatedDate =  $groupCrDate['CreatedDate'];



//echo $p->ta->sql;
if ($rpvt != false) {
while ($row = mysqli_fetch_assoc($rpvt)) {
if ($row['spApproveRegect'] == 1) {
if ($row['spProfileIsAdmin'] == 0) { ?>
<div class="col-md-4">
<div class="member_box" id="ip2" style="background-color: #e78cdd">
<div class="row">
<div class="col-md-4" style="margin-top: 8px;">
<?php
//print_r($row['spProfilePic']);
if (isset($row['spProfilePic'])) { ?>
<img src='<?php echo ($row['spProfilePic']); ?>' class="img-responsive profilePic" alt="" /> <?php
} else { ?>
<!--<img src='<?php echo $BaseUrl; ?>/assets/images/icon/member/member_blank.jpg' class="img-responsive" alt="" />-->
<img src='<?php echo $BaseUrl; ?>/assets/images/icon/blank-img.png' class="img-responsive" alt="" />
<?php
}
?>
</div>
<div class="col-md-8 no-padding">
<h3><a href="<?php echo $BaseUrl . '/friends/?profileid=' . $row['idspProfiles']; ?>" style=" color: black;">
<?php
if (strlen($row['spProfileName']) > 0) {

echo ucwords(substr($row['spProfileName'], 0, 20) . '....');
} else {
echo ucwords($row['spProfileName']);
} ?>
</a></h3>
<!-- <h4><?php echo $row['spProfilesCity'] . " , " . $row['spProfilesCountry']; ?></h4> -->
<h5 style=" color: black;">Joined
<span class="pull-right" style="float: right;">
<img src="<?php echo $BaseUrl; ?>/assets/images/icon/member/group_admin.png" class="img-responsive" alt="">
</span>
</h5>
<p style=" color: black;">Added on <?php

if ($row['spGroup_newMember_Date'] == "0000-00-00") {
echo $CreatedDate;
} else {
echo $row['spGroup_newMember_Date'];
}; ?></p>
</div>
</div>
</div>
</div> <?php
//src=' ".($row['spProfilePic'])."'                                                                
}
}
}
}
?>
