
<div class="row">
<?php
$start = 0;
$limit = 1;
$p = new _postingviewartcraft;
$res = $p->publicpost($start,'13',$limitaa='8');
// echo $p->ta->sql; die;  
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
if($account_status!=1){
?>
<div class="col-md-3">
<div class="artBox">
<div class="topartBox">

<?php if(!empty($row['discountphoto'])){ ?>
<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" class="btn btn_custom bg_purple btn-border-radius">Sale</a>
<?php } ?>

<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" class="btn btn_custom bg_green_art btn-border-radius">New</a>
<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>">

<?php
$pic = new _postingpicartcraft;
$res2 = $pic->read($row['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >";

} else{
echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>"; 
} ?>
</a>
<a class="title" href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" title="<?php echo $row['spPostingTitle']; ?>" data-toggle="tooltip" >
<?php 
if (strlen($row['spPostingtitle']) < 28) {
echo $row['spPostingTitle'];
}else{
echo substr($row['spPostingtitle'], 0,28)."...";
}

?>
</a>
<p>
<?php
if(strlen($row['spPostingNotes']) < 50){
echo $row['spPostingNotes'];
}else{
echo substr($row['spPostingNotes'], 0,50)."...";

} ?>
<?php 
$userid=$_SESSION['uid'];
$c= new _orderSuccess;
$currency= $c->readcurrency($userid);
$res1= mysqli_fetch_assoc($currency);
$curr=$res1['currency'];
?>
</p>
<hr>
<div class="row">
<div class="col-md-12">
<!-- <strike>#40.00</strike> -->
<?php
if(empty($row['spPostingPrice'])){
echo "<span class='price'>Free</span>";
}else{
if(empty($row['discountphoto'])){	
echo '<span class="price"> ' .$curr.' '.$row['discountphoto'].'  </span>';
}else{
echo '<span class="price"> ' .$curr. ' '.$row['discountphoto']. '  </span>'; 
}
} 
if(empty($row['discountphoto'])){
}else{ 
echo '  <span class="price text-success" style="color:green;">  <del>  ' .$curr.' '.$row['spPostingPrice'].  '  </del></span>  ';

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
<li> 

<div  id="adremovetoboard<?php echo $row['idspPostings']; ?>">
<?php

$p = new _addtoboard;

$result = $p->chkExist($row['idspPostings'], $_SESSION['pid']);
if($result != false){  ?>

<a class="removetoboard" data-postid="<?php echo $row['idspPostings']; ?>" data-pid="<?php echo $_SESSION['pid'];?>" data-toggle="tooltip" title="Remove to board"><img src="<?php echo $BaseUrl?>/assets/images/art/icon-add.png" alt="" class="img-responsive"></a>
<?php	}else{ ?>

<a class="addtoboard" data-postid="<?php echo $row['idspPostings']; ?>" data-pid="<?php echo $_SESSION['pid'];?>" data-toggle="tooltip" title="Add to board">
<img src="<?php echo $BaseUrl?>/assets/images/art/icon-add.png" alt="" class="img-responsive"></a>
<?php		}
?>

</div>


</li>

<!---<li><a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" data-toggle="tooltip" title="Download"><img src="<?php echo $BaseUrl?>/assets/images/art/icon-download.png" alt="" class="img-responsive"></a></li>--->

<!-- <li><a href="javascrpit:void(0)" data-toggle="tooltip" title="Share"><img src="<?php echo $BaseUrl?>/assets/images/art/icon-share.png" alt="" class="img-responsive"></a></li> -->
<li data-toggle="tooltip" title="Share"><a href="javascrpit:void(0)" data-toggle='modal' data-target='#myshare'><span class='sp-share-art' data-postid='<?php echo $row['idspPostings'];?>' src='<?php echo ($pic2); ?>'><img src="<?php echo $BaseUrl?>/assets/images/art/icon-share.png" alt="" class="img-responsive"></span></a></li>
<li><a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" data-toggle="tooltip" title="View Product">
<i class="fa fa-info-circle" aria-hidden="true" style=" font-size: 27px; color: white; "></i>
</a></li>


</ul>
</div>
</div>
</div> <?php }
$limit++;
if($limit > 8){
break;
}
}
}
?>
</div>
