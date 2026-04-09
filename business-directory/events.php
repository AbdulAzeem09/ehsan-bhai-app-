<style>
/*------------------Edit-button-css---------------*/
.upEventBox.upcomingbox {
position: relative;
}
.upEventBox.upcomingbox .eidt-con {
position: absolute;
left: auto;
right: 9px;
margin-top: 14px;
}
.upEventBox.upcomingbox .eidt-con a {
color: #fff;
}
.upEventBox.upcomingbox .eidt-con i.fa {
border: 1px solid #da1919;
background: -webkit-linear-gradient(90deg,#9c0202 0,#da1919 100%);
text-align: center;
border-radius: 6px;
padding: 4px 4px;
}
</style>
<style>
.dropdown-menu {
border: none;
}
#profileDropDown li.active {
background-color: #c11f50;
}
#profileDropDown li.active a {
color: #fff;
}
</style>





<div class="row">
<?php
$st= new _spuser;


$start = 0;
$p      = new _spevent;
// $pf     = new _postfield;
$_GET["categoryID"] = "9";
$res    = $p->getActiveEventsrecord($_GET['business'], -1, $_GET["categoryID"]);   
//$res    = $p->publicpost($start, $_GET["categoryID"]);
//echo $p->ta->sql;

if($res != false){
while ($row = mysqli_fetch_assoc($res)) { 

if($row['spuser_idspuser']!=NULL){
$st= new _spuser;
$st1=$st->readdatabybuyerid($row['spuser_idspuser']);
if($st1!=false){
$stt=mysqli_fetch_assoc($st1);
$account_status=$stt['deactivate_status'];
}
}

$pn = new _productposting;
$idposting=$row['idspPostings'];

$flagcmd=$pn->flagcount(9,$idposting);
$flagnums=$flagcmd->num_rows;
if($flagnums=='9')
{
$updatestatus=$pn->eventstatus($idposting); 

}

$venu = "";
$startDate = "";
$startTime    = "";
$endTime = "";
$OrganizerName = "";

$gid=$row['groupid'];
//echo $gid;
$venu = $row['spPostingEventVenue'];
$startDate = $row['spPostingStartDate'];
$startTime = $row['spPostingStartTime'];
$endTime = $row['spPostingEndTime'];
// $OrganizerName = $row2['spPostingEventOrgName'];

$dtstrtTime = strtotime($startTime);
$dtendTime = strtotime($endTime);
//posting fields
// $result_pf = $pf->read($row['idspPostings']);
//echo $pf->ta->sql."<br>";
/* if($result_pf){
$venu = "";
$startDate = "";
$startTime    = "";
$endTime = "";
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
}
$dtstrtTime = strtotime($startTime);
$dtendTime = strtotime($endTime);
}*/
if($account_status!=1){
?>
<div class="col-md-4">
<div class="upEventBox upcomingbox" style="width: 90%; margin-left: 22px; background-color: #ddd7d7;">
<div class="mainOverlay">
<!-- <div class="eidt-con">
<a href="<?php echo $BaseUrl.'/post-ad/events/?postid='.$row['idspPostings'];?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
</div> -->

<?php if($gid > 0){?>
<a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'].'&groupid='.$gid;?>" class="">
<?php } else{?>
<a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'];?>" class="">
<?php } ?>
<?php
$pic = new _eventpic;

$res2 = $pic->readFeature($row['idspPostings']);
if($res2 != false){
if($res2->num_rows > 0){
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' 
class='img-responsive upcomingimg eventimg' src=' " . ($pic2) . "' >"; 
} else{
echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive upcomingimg eventimg'>"; 
}
}else{
$res2 = $pic->read($row['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive upcomingimg eventimg' src=' " . ($pic2) . "' >"; 
} else{
echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive upcomingimg eventimg'>"; 
}
}
}else{
$res2 = $pic->read($row['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive eventimg' src=' " . ($pic2) . "' >"; 
} else{
echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive eventimg'>"; 
}
}
?>
</div>
</a>
<div class="bodyEventBox">
<?php
if(!empty($startDate)){
//echo $start_date;
$dy = new DateTime($startDate);
$day = $dy->format('d');
$month = $dy->format('M');
$weak = $dy->format('D');
}else{
$day = 0;
$month = "&nbsp;";
$weak = "&nbsp;";
}
?>

<span class="datetop pull-right">
<?php echo $month.' '.$day;?>&nbsp;&nbsp;<?php echo $weak;?></span>

<?php if($gid > 0){?>
<a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'].'&groupid='.$gid;?>" class=""><?php echo $row['spPostingTitle'];?></a>
<?php } else{ ?>

<a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'];?>" class=""><?php echo $row['spPostingTitle'];?></a>
<?php } ?>


<span  class="" style="margin-left: 0px;min-height: 0px"><i class="fa fa-map-marker"></i> <?php echo $venu;?></span>
<p class="text-justify" style="min-height: 0px;">
<?php
if(strlen($row['spPostingNotes']) < 170){

echo $row['spPostingNotes'];
}else{
echo substr($row['spPostingNotes'], 0,170)."...";

} ?>
</p>
<?php
$area2 = "";
$area1 = "";
$area0 = "";
$ei = new _eventIntrest;
$result = $ei->chekAlready($row['idspPostings'], $_SESSION['pid']);
//echo $ei->ta->sql;
if($result != false && $result->num_rows > 0){
$row3 = mysqli_fetch_assoc($result);
$area = $row3['intrestArea'];
if($area == 2){
$area2 = "<i class='fa fa-check'></i>";
$title = "Going";
}else if($area == 1){
$area1 = "<i class='fa fa-check'></i>";
$title = "Interested";                                
}else if($area == 0){
$area0 = "<i class='fa fa-check'></i>";
$title = "May Be";
}
}else{
$title = "Going";
}
?>
<div class="ie_<?php echo $row['idspPostings'];?>">
<div class="dropdown intrestEvent" style="display: inline">
<button class="btn btn_group_join dropdown-toggle eventiconbtn" type="button" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-star" aria-hidden="true" style="margin: 0px;"></i> <?php echo $title;?></button>
<ul class="dropdown-menu ">
<li><a href="javascript:void(0)" class="intestDetail" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $row['idspPostings'];?>" data-area="2"><?php echo $area2;?> Going</a></li>
<li><a href="javascript:void(0)" class="intestDetail" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $row['idspPostings'];?>" data-area="1"><?php echo $area1;?> Interested</a></li>
<li><a href="javascript:void(0)" class="intestDetail" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $row['idspPostings'];?>" data-area="0"><?php echo $area0;?> May Be</a></li>
</ul>
</div>
</div>
</div>
<div class="footEventBox footupcoming" style="background-color: #ddd7d7;">
<p><span class="date" 
style="margin-left: 10px;"><i class="fa fa-calendar" style="font-size: 15px;"></i> <?php echo $startDate;?>  | <?php echo date("h:i A", $dtstrtTime); ?> - <?php echo date("h:i A", $dtendTime);?></span></p>
</div>
</div>
</div> <?php  }
}
}
?>


</div>