<div class="row">
<?php

$start = 0;
$limit = 1;
$_GET["categoryID"] = 13;
$p = new _postingviewartcraft;
$stt= new _orderSuccess;
$res = $stt->readname_art_all($_GET['business']);
//var_dump($res);die;
$numrowsw = $res->num_rows;

//echo $p->ta->sql;
if($account_status!=1){
if($res ){

while ($row = mysqli_fetch_assoc($res)) {
$pic = new _postingpicartcraft;
$res2 = $pic->read($row['idspPostings']); 
if($row['spuser_idspuser']!=NULL){
$st= new _spuser;
$st1=$st->readdatabybuyerid($row['spuser_idspuser']);
if($st1!=false){
$stt=mysqli_fetch_assoc($st1);
$account_status=$stt['deactivate_status'];
}}
if ($res2 != false) {?>

<?php

$rp = mysqli_fetch_assoc($res2);

if(empty($pic2)){
$pic2 =  'https://dev.thesharepage.com/img/no.png';	
}
else{
$pic2 = $rp['spPostingPic'];


}
//echo "<pre/>";
// print_r($row);					//die('-----000----');
?>


<div class="col-md-3">
<div class="artBox" style="background-color: #ddd7d7;">
<div class="topartBox">
<?php if(!empty($row['discountphoto'])){ ?>
<a  class="btn btn_custom bg_purple" style="cursor: default;">Sale</a>
<?php } ?>
<a  class="btn btn_custom bg_green_art" style="cursor: default;">New</a>
<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>">

<img alt="Posting Pic" src="<?php echo $pic2; ?>" class="img-responsive">						</a>
<a class="title22" href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" title="" data-toggle="tooltip" data-original-title="">
</a>
<p>

<a class="title111" href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>">
<?php echo $row['spPostingTitle'];?></a>
</p>
<hr>
<div class="row">
<div class="col-md-12">
<!-- <strike>#40.00</strike> -->

<?php

$curr="";

if(empty($row['spPostingPrice'])){
echo "<span class='price'>Free</span>";
}else{
if(empty($row['discountphoto'])){	
echo '<span class="price">' .$row['defaltcurrency'].' '.$row['spPostingPrice'].  '  </span>';
}else{
echo '<span class="price">'.$row['defaltcurrency'].' '.$row['discountphoto'].  '  </span>'; 
}
} 
if(empty($row['discountphoto'])){
}else{ 
echo '<span class="price text-success" style="color:green;"> <del> ' .$row['defaltcurrency'].' '.$row['spPostingPrice'].  '  </del></span>';

$perto =  ($row['spPostingPrice']-$row['discountphoto'])/$row['spPostingPrice']*100;
echo '  ('.round($perto, 2).'%)  ';
}
if($row['sippingcharge']==1){

echo '<br>  <span class="badge badge-success" style=" background-color: green; ">Free Delivery</span>';
}
else{

echo '<br><br>';
}
?>	

</div>
</div>
</div>
<div class="btmartBox">
<ul class="social">

<?php if($_SESSION['guet_yes'] != 'yes'){ ?>
<li> 


<div  id="adremovetoboard<?php echo $row['idspPostings']; ?>">
<?php

$aap = new _addtoboard;

$result = $aap->chkExist($row['idspPostings'], $_SESSION['pid']);
if($result != false){  ?>

<a class="removetoboard" data-postid="<?php echo $row['idspPostings']; ?>" data-pid="<?php echo $_SESSION['pid'];?>" data-toggle="tooltip" title="Remove to board"><img src="<?php echo $BaseUrl?>/assets/images/art/icon-add.png" alt="" class="img-responsive"></a>
<?php	}else{ ?>

<a class="addtoboard" data-postid="<?php echo $row['idspPostings']; ?>" data-pid="<?php echo $_SESSION['pid'];?>" data-toggle="tooltip" title="Add to board">
<img src="<?php echo $BaseUrl?>/assets/images/art/icon-add.png" alt="" class="img-responsive"></a>
<?php		}
?>

</div>


</li>

<!--	<li data-toggle="tooltip" title="" data-original-title="Share"><a href="javascrpit:void(0)" data-toggle="modal" data-target="#myshare"><span class="sp-share-art" data-postid="<?php echo $row['idspPostings']; ?>" src="<?php echo $pic2; ?>"><img src="https://dev.thesharepage.com/assets/images/art/icon-share.png" alt="" class="img-responsive"></span></a></li>-->
<?php } ?>
<li><a href="<?php echo $BaseUrl?>/artandcraft/detail.php?postid=<?php echo $row['idspPostings']; ?>" data-toggle="tooltip" title="" data-original-title="View Product">
<i class="fa fa-info-circle" aria-hidden="true" style=" font-size: 27px; color: white; "></i>
</a></li>


</ul>
</div>
</div>
</div>	
<?php
$limit++;

}
if($limit > 4){
break;
}
}
}}else{echo "<span style='font-size:20px;margin-left:512px;'>No New Listings</span>";}
?>



</div>