<?php
$start = 0;
$limit = 1;
$txtAddresss = '';
$PropertyType = '';

$pricefroms = '';
$pricetos = '';

$spPostingBedrooms = '';
$spPostingBathrooms = '';

$Squrefootfroms = '';
$Squrefoottos = '';

$spPostingTitles = '';
$spPostingOpenHouses = '';

$ltoh = '';
$htol = '';
$latest = '';

$p      = new _realstateposting;
$pf     = new _postfield;
$_GET["categoryID"] = "3";

$res = $p->myAllSellActiveProperty($_GET['categoryID'], $_GET['business'], $type);
if($res != false){?>
<div class="list-wrapper">
<?php
while ($row = mysqli_fetch_assoc($res)) {?>
<div class="list-item">
<?php
$address = "";
$bedroom = "";
$bathroom = "";
$sqrfoot = "";
$basement = "";
$propertyType = "";
$postListing = "";
$postListing = $row['spPostListing'];
$propertyType = $row['spPostingPropertyType'];

$address = $row['spPostingAddress'];
$bedroom = $row['spPostingBedroom'];
$bathroom = $row['spPostingBathroom'];

$sqrfoot = $row['spPostingSqurefoot'];
$basement = $row['spPostBasement'];
$result_pf = $p->read($row['idspPostings']);                                        
?>
<div class="col-md-3">
<div class="realBox" style="height:300px;">
<a href="<?php echo $BaseUrl.'/real-estate/property-detail.php?catid=1&postid='.$row['idspPostings'];?>">
<div class="boxHead">
<h2><?php $in =  $row['spPostingTitle'];
$out = strlen($in) > 25 ? substr($in,0,25)."..." :$in;
echo $out;?></h2>
<p>
<i class="fa fa-map-marker"></i> 
<?php
if(strlen($address) < 30){
echo $address;
}else{
echo substr($address, 0,30)."...";
}
?>
</p>
</div>
<?php
$pic = new _realstatepic;

$res2 = $pic->readFeature($row['idspPostings']);

if($res2 != false){
if($res2->num_rows > 0){
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >"; 
}
}else{
$res2 = $pic->read($row['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >"; 
}
}
}else{
$res2 = $pic->read($row['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >"; 
} else{
echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive imgMain'>"; 
}
}?>
<div class="midLayer">
<ul>
<li data-toggle="tooltip" title="Square Foot"><img src="<?php echo $BaseUrl;?>/assets/images/real/icon-1.png"><?php echo ($sqrfoot > 0)?$sqrfoot:0; ?></li>
<?php if($propertyType!='Land/lot'){ ?>
<li data-toggle="tooltip" title="Bed Room" class="text-center"><img src="<?php echo $BaseUrl;?>/assets/images/real/icon-2.png"><?php echo ($bedroom > 0)?$bedroom:0;?></li>
<li data-toggle="tooltip" title="Bath Room" class="text-center"><img src="<?php echo $BaseUrl;?>/assets/images/real/icon-3.png"><?php echo ($bathroom > 0)?$bathroom:0; ?></li>
<?php } ?>
<li data-toggle="tooltip" title="Basement" class="text-right pull-right"><img src="<?php echo $BaseUrl;?>/assets/images/real/icon-4.png"><?php echo ($basement > 0)?$basement:0; ?></li>
</ul>
</div>
<div class="boxFoot text-center"style="background-color: #9d9898;">
<?php if(strlen($propertyType) < 8){ ?> 
<p class="proType"><?php echo $propertyType;?>
<?php if($row['spPostingPrice'] != ''){ ?>
&nbsp;<span style="font-size:18px;">(<?php  echo $row['defaltcurrency'].' '.$row['spPostingPrice'];?>)</span>
<?php } ?>
</p>
<?php }else{ ?> 
<p class="proType"><?php echo substr($propertyType,0,8).'...';?>
<?php if($row['spPostingPrice'] != ''){ ?>
&nbsp;<span style="font-size:18px;">(<?php  echo $row['defaltcurrency'].' '.$row['spPostingPrice'];?>)</span>
<?php } ?>
</p>

<?php } ?>                                                     


</div>
</a>
<div class="text-right bokmarktabsssss">
<div id="sssssssssssssss<?php echo $row['idspPostings'];?>">
<?php
$fv = new _favorites;
$res_fv = $fv->chekFavourite($row['idspPostings'], $_SESSION['pid'], $_SESSION['uid']);
//echo $fv->ta->sql;
/*if($res_fv != false){ ?>
<button class="btn btn-outline-primary btn-sm" id="remtofavoritesevent" data-postid="<?php echo $row['idspPostings'];?>" data-pid="<?php echo $_SESSION['pid'];?>"  >
<span id="removetofavouriteeve"><i class="fa fa-heart"></i></span>
</button>
<?php }else{ ?>
<button class="btn btn-outline-primary btn-sm" id="addtofavouriteevent" data-postid="<?php echo $row['idspPostings'];?>" data-pid="<?php echo $_SESSION['pid'];?>"  >
<span id="addtofavouriteeve"><i class="fa fa-heart-o"></i></span>
</button>
<?php }*/ ?>
</div>
</div>
</div>
</div> <?php
//}?>
</div>
<?php
}?>
</div>
<?php } ?>