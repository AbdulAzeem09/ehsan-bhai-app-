

<?php
$strt = 1;
$p      = new _postingview;
$pf     = new _postfield;
$result = $p->readUpcoming();

$ex = new _exhibition;
//$result = $ex->readUpcoming();
//echo $ex->ta->sql;
if($result != false){
while ($row = mysqli_fetch_assoc($result)) {
$result_pf = $pf->read($row['idspPostings']);
//echo $pf->ta->sql."<br>";
if($result_pf){
$venu = "";
$startDate = "";
$endDate = "";
$startTime    = "";
$endTime = "";
$OrganizerName = "";
while ($row2 = mysqli_fetch_assoc($result_pf)) {

if($venu == ''){
if($row2['spPostFieldName'] == 'spPostingEventVenue_'){
$venu = $row2['spPostFieldValue'];

}
}
if($startDate == ''){
if($row2['spPostFieldName'] == 'spPostingStartDate_'){
$startDate = $row2['spPostFieldValue'];

}
}
if($endDate == ''){
if($row2['spPostFieldName'] == 'spPostingEndDate_'){
$endDate = $row2['spPostFieldValue'];

}
}
if($startTime == ''){
if($row2['spPostFieldName'] == 'spPostingStartTime_'){
$startTime = $row2['spPostFieldValue'];

}
}
if($endTime == ''){
if($row2['spPostFieldName'] == 'spPostingEndTime_'){
$endTime = $row2['spPostFieldValue'];

}
}
if($OrganizerName == ''){
if($row2['spPostFieldName'] == 'spPostingEventOrgName_'){
$OrganizerName = $row2['spPostFieldValue'];

}
}
}
$dtstrtTime = strtotime($startTime);
$dtendTime = strtotime($endTime);
} 
$today = date('Y-m-d');
if($startDate < $today){ ?>
<div class="row artExhibBox">
<div class="col-md-3">
<a href="<?php echo $BaseUrl.'/photos/event-detail.php?postid='.$row['idspPostings'];?>" >
<?php
$pic = new _postingpic;
$res2 = $pic->read($row['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >";

} else{
echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>"; 
} ?>
</a>
</div>
<div class="col-md-7">
<a class="title" href="<?php echo $BaseUrl.'/photos/event-detail.php?postid='.$row['idspPostings'];?>"><?php echo $row['spPostingtitle'];?></a>
<p><?php echo $row['spPostingNotes'];?></p>
<p class="desc">on <?php echo $startDate;?></p>
</div>
<div class="col-md-2 text-center">
<a href="<?php echo $BaseUrl.'/photos/event-detail.php?postid='.$row['idspPostings'];?>" class="btn btn_morePhoto btn-border-radius">Read More</a>
</div>
</div> <?php
$strt++;
if($strt > 3){
break;
}

} 
}
}

?>

