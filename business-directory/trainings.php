

<div class="row">
<?php 

 $p = new _postings;
$res = $p->read_active_training_pid($_GET['business']);

if($res != false){
while ($row = mysqli_fetch_assoc($res)) {
   //print_r($row);
   //die('=====');
?>
<div class="col-md-3">
<div class="course_Box" style="background-color: #ddd7d7;"> 
<div class="img_fe_box">
<a href="<?php echo $BaseUrl.'/trainings/detail.php?postid='.$row['id'];?>">
<?php
$pic = new _postings;
//echo $row['id'];
$res2 = $pic->read_cover_images($row['id']);
//echo $pic->ta->sql;
if($res2 != false){                                                
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['filename'];
echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " .$BaseUrl.'/post-ad/uploads/'.($pic2) . "' >"; 

}else{
echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive blank'>";
}
?>
</a>
</div>
<div class="innerBoxvdo">
<a href="<?php echo $BaseUrl.'/trainings/detail.php?postid='.$row['id'];?>" class="title" data-toggle="tooltip" title="<?php echo $row['spPostingTitle'];?>" >
<?php 
if(strlen($row['spPostingTitle']) < 12){
echo $row['spPostingTitle'];
}else{
echo substr($row['spPostingTitle'], 0,12)."...";
} 
?>     
</a><br>
<?php 
$bR = new _trainingrating;
$resultsum1 = $bR->readrating($row['id']);
//$totalmyreviews1=0;
if($resultsum1 != false){
$sumrevrating1 = 0;
$totalmyreviews1 = $resultsum1->num_rows;
while($rowreview1 = mysqli_fetch_assoc($resultsum1)){
$sumrevrating1 += $rowreview1['rating'];

}  

$reviewaveragerate1 = $sumrevrating1 / $totalmyreviews1;
$totalreviewrate1  = round($reviewaveragerate1, 1);
} else{
   $totalmyreviews1=0;
}
?>
<p class="rating_box">

<div class="rating-box">
<?php if($totalreviewrate1 >= "5") { 
echo '<div class="ratings" style="width:100%;"></div>';
}else  if($totalreviewrate1 >= "4" && $totalreviewrate1 < "5") { 
echo '<div class="ratings" style="width:92%;"></div>';
}
else  if($totalreviewrate1 >= "4") { 
echo '<div class="ratings" style="width:80%;"></div>';
}else  if($totalreviewrate1 > "3" && $totalreviewrate1 < "4") { 
echo '<div class="ratings" style="width:72%;"></div>';
}else  if($totalreviewrate1 >= "3") { 
echo '<div class="ratings" style="width:60%;"></div>';
}else  if($totalreviewrate1 > "2" && $totalreviewrate1 < "3") { 
echo '<div class="ratings" style="width:51%;"></div>';
}else  if($totalreviewrate1 >= "2") { 
echo '<div class="ratings" style="width:38%;"></div>';
}else  if($totalreviewrate1 > "1" && $totalreviewrate1 < "2") { 
echo '<div class="ratings" style="width:29%;"></div>';
}else  if($totalreviewrate1 >= "1") { 
echo '<div class="ratings" style="width:16%;"></div>';
}else  if($totalreviewrate1 <= "0") { 
echo '<div class="ratings" style="width:0%;"></div>';
}

?>

</div>
<small>(<?php echo $totalmyreviews1; ?>)</small> 
</p>
<?php
$p = new _spprofiles;
$pres1 = $p->readUserId($row['idspProfiles']);
if($pres1 != false){
$prow = mysqli_fetch_assoc($pres1);
?>
<a href="<?php echo $BaseUrl.'/trainings/intructor-detail.php?intructor='.$prow['idspProfiles']?>" class="name"><?php echo $prow['spProfileName']; ?></a>
<?php

}
?>
<!--<a href="<?php echo $BaseUrl.'/trainings/detail.php?postid='.$row['id'];?>" class="btn butn_train_cart" style="margin-left:-8px; ">Add To Cart</a>-->
<p style="font-size:12px; margin-right:-7px;"><?php echo ($row['spPostingPrice'] > 0)?$row['default_currency'].' '.$row['spPostingPrice']:'Free';?></p>
</div>
</div>
</div>
<?php
}
}else{
echo "No more categories!";
}

?>
</div>