<style>
.rcount {
margin-left: -19px !important;
}
</style>




<div class="row" id="timelinechange">
<div class="col-md-12 social 2">
<?php
//die('====================');
$conn = _data::getConnection();

//Finding friend
//$fr = new _spprofilehasprofile;
//$res = $fr->friendslist()
//get all hide posting
$hp = new _hidepost;
$results = $hp->getPost($_SESSION['pid']);
//echo $hp->ta->sql;
$hidepost = array();
if ($results != false) {
while ($rowh = mysqli_fetch_assoc($results)) {
array_push($hidepost, $rowh['spPostings_idspPostings']);
}
}

$p = new _postings;
if (isset($grouptimelines) && $grouptimelines == 1) {
$res = $p->grouptimelines($_GET["groupid"]);
} else {

if (isset($_GET['offset'])) {

$offset = 10 * $_GET['offset'];
} else {

$offset = 10;
}

$start = date('Y-m-d', strtotime('-7 days'));
/*$res = $p->globaltimelinesProfiletimeline($start, $_SESSION["pid"]);*/

// $res = $p->offsetglobaltimelinesProfiletimeline($start, $_SESSION["pid"],$offset);
$resforcount = $p->offsetglobaltimelinesProfiletimeline1($start, $_SESSION["pid"]);
$count_num_rows = $resforcount->num_rows;
$res = $p->offsetglobaltimelinesProfiletimelinelimit($start, $_SESSION["pid"]);
//$res = $p->globaltimelines($start, $_SESSION["uid"]);
}
?>


<?php
//echo $p->ta->sql;
echo "<div id='timeline-container'>";
//echo $p->ta->sql;

/*   $spid = $_SESSION['pid'];
$sql = "SELECT * FROM spshare WHERE  spShareToWhom = $spid";
$res3 = mysqli_query($conn, $sql);
if($res3 != false){
while($row3  = mysqli_fetch_assoc($res3)){


$sharepostid = $row3['spPostings_idspPostings'];


$created = $row3['created'];
$shareby = $row3['spShareByWhom'];
include "sharetimelinepost.php";
}
}*/
//$numbr = 0;
$resCount = 0;
if (isset($res) && $res != false) {
$resCount = $res->num_rows;
while ($timeline = mysqli_fetch_assoc($res)) {
//print_r($numbr);
//$numbr++;
//check the friend is blocked or not.
$pf = new _spprofilefeature;
$isBlocked = $pf->chkBlock($_SESSION['pid'], $timeline['spProfiles_idspProfiles']);

if ($isBlocked == false) {
if (in_array($timeline['idspPostings'], $hidepost)) {
/*echo "hi";*/
//$proid = $row31['spPostings_idspPostings'];
} else {

/* echo "here";*/
// $pid = $_SESSION['pid'];
// echo $sql2 = "SELECT s.spPostings_idspPostings, s.spShareByWhom FROM spshare AS s INNER JOIN allpostdata AS f ON f.idspPostings = s.spPostings_idspPostings WHERE spShareToWhom = $pid AND f.spPostingVisibility = -1 UNION ALL SELECT t.idspPostings, t.spPostingsFlag FROM allpostdata AS t inner join spprofiles as d on t.idspprofiles = d.idspprofiles where idspcategory = 17 ORDER BY spPostings_idspPostings DESC";
// $res2 = mysqli_query($conn, $sql2);
// if($res2 != false){
//     $shareby = $timeline['spShareByWhom'];
// }
//chek kry k post share ha frnd ki wall py ya ni
//$shareby = 158;
/*$pstid = $timeline['idspPostings'];*/

/*$sharepostid = $timeline['idspPostings'];*/
/* $_GET["timelineid"] = $timeline['idspPostings'];
include "timelineentry.php";*/

$pstid = $timeline['idspPostings'];
$spid = $_SESSION['pid'];
$sql3 = "SELECT * FROM share WHERE  spShareToWhom = $spid";
// echo $sql3;
$res31 = mysqli_query($conn, $sql3);

/*print_r($res31);*/
if ($res31 != false) {

while ($row31  = mysqli_fetch_assoc($res31)) {
# code...

/*print_r($row31);*/
$shareby = $row31['spShareByWhom'];
$_GET["timelineid"] = $row31['timelineid'];
/*$sharedesc = $row31['spShareComment'];*/
$proid = $row31['spPostings_idspPostings'];
}
}

$_GET["timelineid"] = $timeline['idspPostings'];
//print_r($_GET["timelineid"]);
//exit;


include "timelineentry.php";
//	die('aaaaaaaaaaaaaaaaaaaaaa');
}
}
}

/* echo "<a href=" ">Load More</a>";*/
}

?>

<?php
echo "</div>";
?>
<?php

if ($count_num_rows > 11) {
?>
<div>
<h1 class="load-more 111" style="text-align: center;color:#2784c5;padding: 6px;cursor:pointer">Load More</h1>
<input type="hidden" id="row" value="0">
<input type="hidden" id="all" value="<?php echo $count_num_rows; ?>">
<input type="hidden" id="profiddd" value="<?php echo $_SESSION["pid"]; ?>">
</div>

<?php }
if ($resCount > 0) {

if (!empty($offset)) {

$newoffset = $offset / 10;

$off = $newoffset + 1;
}
$p = new _postings;
$start = date('Y-m-d', strtotime('-7 days'));
$totalrow = $p->globaltimelinesProfiletimeline($start, $_SESSION["pid"]);
$totalRowCount = 0;
if($totalrow !== false){
  $totalRowCount = $totalrow->num_rows;
}
/*print_r($totalrow);
print_r($res->num_rows);*/

if ($resCount< $totalRowCount) {

?>

<!--  <div class="col-md-12" style="text-align: center;margin-top: 19px;"> <a href="<?php // echo $BaseUrl."/timeline/?offset=".$off."" 
?>" style="padding-top: 20px;font-weight: 600;font-size: 1.6rem;color: #0073b1;">See more</a></div> -->


<?php
}
}

?>





</div>

<input type="hidden" id="rowcount" value="0">
<input type="hidden" id="allcountres" class="allcountres" value="<?php echo $res->num_rows; ?>">
<input type="hidden" id="profile_id" class="profile_id" value="<?php echo $_SESSION['pid']; ?>">
<input type="hidden" id="user_id" class="user_id" value="<?php echo $_SESSION['uid']; ?>">
</div>

 
