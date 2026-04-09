<style>
.leftArt a {

padding: 2px;
font-size:15px;
}

</style>
<div class="row">
<?php 

if($_GET['page']==1){

$start = 0;
}else{

$sss = $_GET['page']-1;
$start = 10*$sss;
}
$limit = 1;

$limitaa = 10;

$catid=$_GET['catId'];
$p = new _postingviewartcraft;
/* if(isset($_GET['catId'])){


//echo 1;
$res = $p->sameCategoryPicNEW(13, $_GET['catId'], $_GET['for']);

//var_dump($res);
/*if($res){
$numrowsw = mysqli_num_rows($res); 
}*/

/*  }else{
//echo 2;
$res = $p->publicpost($start, $_GET["categoryID"], $limitaa);
$numrowsw = mysqli_num_rows($res); 
}*/

$res = $p->publicpost($start, $_GET["categoryID"], $limitaa);
$numrowsw = mysqli_num_rows($res); 

//echo $p->ta->sql; die;
if($res != false){

while ($row = mysqli_fetch_assoc($res)) {
$idsp=$row['idspPostings'];
$conn = mysqli_connect(DOMAIN, UNAME, PASS);
if(mysqli_select_db($conn, DBNAME)) {
$sqli = "SELECT * FROM `sppostfield` WHERE spPostings_idspPostings= $idsp AND spPostFieldName='photos_'  AND spPostFieldValue = $catid";
//echo $sqli; 
//echo "====================================" ;
$resu = mysqli_query($conn, $sqli);
$num_rows=$resu->num_rows;
//print_r($resu); die("=================");

if($num_rows==0){
continue;
}

}

//print_r($row);
?>
<div class="col-md-4">
<div class="artBox m_btm_20">
<div class="topartBox" id="shpBycat">
<?php if(!empty($row['discountphoto'])){ ?>
<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" class="btn btn_custom bg_purple btn-border-radius">Sale</a>
<?php } ?>
<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" class="btn btn_custom bg_green_art btn-border-radius">New</a>
<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" >
<?php 
$pic = new _postingpicartcraft;
$res2 = $pic->read($row['idspPostings']);
if ($res2 != false) {    
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >"; ?>
<?php
} else{
echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>"; ?>
<?php
} ?>
</a>
<a class="title" href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>"><?php echo $row['spPostingTitle'];?></a>
<p>
<?php
if(strlen($row['spPostingNotes']) < 40){
echo $row['spPostingNotes'];
}else{
echo substr($row['spPostingNotes'], 0,40)."...";

} ?>
</p>
<hr>
<div class="row">
<div class="col-md-12">
<!-- <strike>#40.00</strike> -->
<?php
$userid=$_SESSION['uid'];
$c= new _orderSuccess;
$currency= $c->readcurrency($userid);
$res1= mysqli_fetch_assoc($currency);
$curr=$res1['currency'];
?>
<?php
if(empty($row['spPostingPrice'])){
echo "<span class='price'>Free</span>";
}else{
if(empty($row['discountphoto'])){	
echo '<span class="price">  ' .$curr.' '.$row['spPostingPrice'].  '  </span>';
}else{
echo '<span class="price"> ' .$curr.' '.$row['discountphoto'].  '  </span>'; 
}
} 
if(empty($row['discountphoto'])){
}else{ 
echo '  <span class="price text-success" style="color:green;">  <del>  ' .$curr.' '.$row['spPostingPrice'].  '  </del></span>  ';

$perto =  ($row['spPostingPrice']-$row['discountphoto'])/$row['spPostingPrice']*100;
echo '  ('.round($perto, 2).'%)  ';
}
if($row['sippingcharge']==1){

echo ' <span class="badge badge-success" style=" background-color: green; ">Free Delivery</span>';
}
else{


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

<!--    <li><a href="<?php // echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" data-toggle="tooltip" title="Download"><img src="<?php //echo //$BaseUrl?>/assets/images/art/icon-download.png" alt="" class="img-responsive"></a></li> -->
<li data-toggle="tooltip" title="Share"><a href="javascrpit:void(0)" data-toggle='modal' data-target='#myshare'><span class='sp-share-art' data-postid='<?php echo $row['idspPostings'];?>' src='<?php echo ($pic2); ?>'><img src="<?php echo $BaseUrl?>/assets/images/art/icon-share.png" alt="" class="img-responsive"></span></a></li>
<li><a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" data-toggle="tooltip" title="View Product">

<i class="fa fa-info-circle" aria-hidden="true" style=" font-size: 27px; color: white; "></i>

</a></li>
</ul>
</div>
</div>
</div> <?php

}
}
?>



</div>

