<?php 
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "artandcraft/";
include_once ("../authentication/check.php");

}else{
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$txtSearchCategory = isset($_GET['txtSearchCategory']) ? (int) $_GET['txtSearchCategory'] : 0;

$_GET["categoryID"] = 13;
$header_photo = "header_photo";

if(isset($_GET['btnArtSearch']) && isset($_GET['btnArtSearch'])){
$txtArtSearch = $_GET['txtArtSearch'];
//$txtSearchCategory  = $_GET['txtSearchCategory'];


}else{
$re = new _redirect;
$redirctUrl = "../artandcraft";
//    $re->redirect($redirctUrl);
//header('location:../photos');
}

$userid=$_SESSION['uid'];
$c= new _orderSuccess;
$currency= $c->readcurrency($userid);
$res1= mysqli_fetch_assoc($currency);
$curr=$res1['currency'];


?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php');?>
<link rel='stylesheet prefetch' href='https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'>
<!--NOTIFICATION-->
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<style>
.leftArt.pro_detail_box {
padding-left: 40px;
padding-top: 15px;
padding-bottom: 18px;
margin-bottom: 20px;
border-radius: 15px;
}

#datalist p:nth-child(n+6) {
display:none;
}
#load_more_1 {
cursor: pointer;
col
or: #f00;
}

.topartBox {
height: 365px;
}



/* body {
font-family: 'Roboto', sans-serif;
font-size: 14px;
line-height: 18px;
background: #f4f4f4;
} */

.list-wrapper {
padding: 15px;
overflow: hidden;
}

.list-item {
/* border: 1px solid #EEE;
background: #FFF; */
margin-bottom: 10px;
/* padding: 10px; */
/*box-shadow: 0px 0px 10px 0px #EEE; */
}

/* .list-item h4 {
color: #FF7182;
font-size: 18px;
margin: 0 0 5px;	
} */

/* .list-item p {
margin: 0;
} */

.simple-pagination ul {
margin: 0 0 20px;
padding: 0;
list-style: none;
text-align: center;
}

.simple-pagination li {
display: inline-block;
margin-right: 5px;
}

.simple-pagination li a,
.simple-pagination li span {
color: #666;
padding: 5px 10px;
text-decoration: none;
border: 1px solid #EEE;
background-color: #FFF;
box-shadow: 0px 0px 10px 0px #EEE;
}

.simple-pagination .current {
color: #FFF;
background-color: #cb51be;
border-color: #cb51be;
}

.simple-pagination .prev.current,
.simple-pagination .next.current {
background: #99068a;
}

</style>      
</head>
<body class="bg_gray">
<?php include_once("../header.php");?>
<section class="innerArtBanner">
<?php include('top-search.php');?>
</section>

<style>


</style>
<section class="bg_white" style="border-bottom: 2px solid #CCC">
<div class="container">
<!---<div class="row">
<div class="col-md-12">
<ul class="art_scnd_levl">
<li><a href="<?php echo $BaseUrl.'/artandcraft/artist.php?cat=1';?>">Visual Artist</a></li>
<li><a href="<?php echo $BaseUrl.'/artandcraft/artist.php?cat=2';?>">Graphics Designer</a></li>
<li><a href="<?php echo $BaseUrl.'/artandcraft/artist.php?cat=3';?>">Contemporary</a></li>
<li><a href="<?php echo $BaseUrl.'/artandcraft/artist.php?cat=4';?>">Animation</a></li>
<li><a href="<?php echo $BaseUrl.'/artandcraft/artist.php?cat=5';?>">Musician</a></li>
</ul>
</div>
</div>--->
</div>
</section>  

<section class="m_btm_40">
<div class="container">
<div class="row 11111">
<div class="col-md-12 topbread">
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/artandcraft';?>"><i class="fa fa-home"></i></a></li>

<li class="breadcrumb-item active" aria-current="page">Search</li>
</ol>
</nav>
</div>
</div>
<div class="row 22222">
<div class="col-md-3">

<form >
<input type="hidden" name="txtSearchCategory" value="13">	


<div class="leftArt pro_detail_box">
<a href="<?php echo $BaseUrl.'/artandcraft/search.php?txtSearchCategory=13&txtArtSearch=&btnArtSearch=Search'?>">  <b style=" font-size: 20px; color: #97298a; ">All Categories</b></a>
<!--a href="<?php echo $BaseUrl.'/artandcraft/search.php?txtSearchCategory=13&txtArtSearch=&Art=art&btnArtSearch=Search'?>">  <b style=" font-size: 20px; color: #97298a; ">Art</b></a>
<a href="<?php echo $BaseUrl.'/artandcraft/search.php?txtSearchCategory=13&txtArtSearch=&Craft=craft&btnArtSearch=Search';?>"></i>  <b style=" font-size: 20px; color: #97298a; ">Craft</b></a-->

<!--<input class="form-control" type="text" name="txtArtSearch" value="<?php echo $_GET['txtArtSearch']; ?>" style=" margin-top: 24px; width: 100%; margin-left: -18px; ">	 
<b style=" font-size: 20px; color: #97298a; ">Art & Craft</b>-->

<label><input type="checkbox" name="Art"  <?php if($_GET['Art']=='art'){ echo 'checked="checked"'; } ?>  value="art"> Art</label><br>
<label><input type="checkbox" name="Craft"  <?php if($_GET['Craft']=='craft'){ echo 'checked="checked"'; } ?>   value="craft" > Craft</label><br>	

<a href="javascript:void(0)"><b style=" font-size: 20px; color: #97298a; ">Special Offers</b></a>

<label><input type="checkbox" name="Free"  <?php if($_GET['Free']=='freedelivery'){ echo 'checked="checked"'; } ?>  value="freedelivery"> Free delivery</label><br>
<label><input type="checkbox" name="Onsale"  <?php if($_GET['Onsale']=='onsale'){ echo 'checked="checked"'; } ?>   value="onsale" > On sale</label><br>		 


<a href="javascript:void(0)"><b style=" font-size: 20px; color: #97298a; ">Price ($)</b></a>

<label><input type="radio" name="Price" value="any"  <?php if($_GET['Price']=='any'){ echo 'checked="checked"'; } ?>  > Any price</label><br>
<label><input type="radio" name="Price" value="u25"  <?php if($_GET['Price']=='u25'){ echo 'checked="checked"'; } ?>  > Under $25</label><br>
<label><input type="radio" name="Price" value="ca25to50"  <?php if($_GET['Price']=='ca25to50'){ echo 'checked="checked"'; } ?>  > $25 to $50</label><br>
<label><input type="radio" name="Price" value="ca50to100"  <?php if($_GET['Price']=='ca50to100'){ echo 'checked="checked"'; } ?>  > $50 to $100</label><br>
<label><input type="radio" name="Price" value="over100"  <?php if($_GET['Price']=='over100'){ echo 'checked="checked"'; } ?>  > Over $100</label><br>

<?php 
$m = new _masterdetails;
// include('../component/left-artGallery.php');
?>




<?php

if($_GET['btnArtSearch']=='Filter'){
?>

<div class="leftArt">
<a href="javascript:void(0)"><b style=" font-size: 20px; color: #97298a; "> Categories</b></a>
<div id="datalist">
<?php
$m = new _subcategory;
$p = new _postingviewartcraft;
$catid = 13;
$result = $m->read($catid);
if($result){
while($rows = mysqli_fetch_assoc($result)){
//print_r($rows);
$count = 0;
$res = $p->sameCategoryPic($rows["idsubCategory"], 13);
//echo $p->ta->sql;
if($res != false){
$count = $res->num_rows;
}else{
$count = 0;
}

$selected='';	
foreach($_GET['Categories'] as $valueiid){
if($valueiid==$rows['idsubCategory']){
$selected = 'checked="checked"';
}
}

//echo $rows['idsubCategory'];
?>

<label style="display:block;"><input  <?php echo $selected; ?> type="checkbox" value="<?php echo $rows['idsubCategory']; ?>" name="Categories[]"> <?php echo $rows["subCategoryTitle"];?></label>

<?php
//echo "<option value='".$rows["idsubCategory"]."'>".$rows["subCategoryTitle"]."</option>";
}
}
?>
</div>
<span  id="load_more_1" style="margin-top:10px;"><i class="fa fa-angle-double-down"></i>Load More</span>
</div>
<?php } 
else{
?>


<div class="leftArt">
<a href="javascript:void(0)"><b style=" font-size: 20px; color: #97298a; "> Categories</b></a>
<div id="datalist">
<?php
$m = new _subcategory;
$p = new _postingviewartcraft;
$catid = 13;
$result = $m->read($catid);
if($result){
while($rows = mysqli_fetch_assoc($result)){
//print_r($rows);
$count = 0;
$res = $p->sameCategoryPic($rows["idsubCategory"], 13);
//echo $p->ta->sql;
if($res != false){
$count = $res->num_rows;
}else{
$count = 0;
}

$selected='';	
foreach($_GET['Categories'] as $valueiid){
if($valueiid==$rows['idsubCategory']){
$selected = 'checked="checked"';
}
}

//echo $rows['idsubCategory'];
?>

<label><input  <?php echo $selected; ?> type="checkbox" value="<?php echo $rows['idsubCategory']; ?>" name="Categories[]"> <?php echo $rows["subCategoryTitle"];?></label>
<br>
<?php
//echo "<option value='".$rows["idsubCategory"]."'>".$rows["subCategoryTitle"]."</option>";
}
}
?>
</div>
<span  id="load_more_1" style="margin-top:10px;"><i class="fa fa-angle-double-down"></i>Load More</span>
</div>

<?php } ?>


<input type="submit" class="btn btn_searchArt btn-border-radius" value="Filter" name="btnArtSearch" style=" margin-top: 24px; width: 100%; margin-left: -18px; color:white;">


</div>



</form>				

</div>
<div class="col-md-9 no-padding">
<div class="row 33333 list-wrapper">
<?php				


if(isset($_GET['Art']) && isset($_GET['Craft'])){

$ad_type = 0;
}elseif(isset($_GET['Art'])){
$ad_type = 1;
}elseif(isset($_GET['Craft'])){
$ad_type = 2;
}else{
$ad_type = 0;
}

//echo $ad_type;
if(isset($_GET['btnArtSearch'])){

// echo 1;
//$txtSearchCategory  = $_GET['txtSearchCategory'];
$txtArtSearch       = $_GET['txtArtSearch'];
$pv = new _postingviewartcraft;

if(isset($_GET['Categories'])){

$iss=1;	
foreach($_GET['Categories'] as $valueiid){

//echo "<pre>";
//print_r($valueiid);

if(isset($_GET['Price']) && $_GET['Price']!=='any'){
if($_GET['Price']=='u25'){
$spshort = 0; 
$epshort = 25; 
}
if($_GET['Price']=='ca25to50'){
$spshort = 25;
$epshort = 50;
}
if($_GET['Price']=='ca50to100'){
$spshort = 50;
$epshort = 100;
}
if($_GET['Price']=='over100'){
$spshort = 100;
$epshort = 1000000000;
}

if(isset($_GET['Free']) && isset($_GET['Onsale'])){

///echo 1;
$result3 = $pv->search_artgallerynew1shortprice($ad_type, $valueiid, $txtSearchCategory, $txtArtSearch, $spshort, $epshort);
}elseif(isset($_GET['Free'])){										
$result3 = $pv->search_artgallerynew1shortpricesippingcharge($ad_type, $valueiid, $txtSearchCategory, $txtArtSearch, $spshort, $epshort,1);
}	
elseif(isset($_GET['Onsale'])){									
$result3 = $pv->search_artgallerynew1shortpricesippingcharge($ad_type, $valueiid, $txtSearchCategory, $txtArtSearch, $spshort, $epshort,0);
}else{

$result3 = $pv->search_artgallerynew1shortprice($ad_type, $valueiid, $txtSearchCategory, $txtArtSearch, $spshort, $epshort);
}

}else{ 

//echo 2;
if(isset($_GET['Free']) && isset($_GET['Onsale'])){		
$result3 = $pv->search_artgallerynew1($ad_type, $valueiid, $txtSearchCategory, $txtArtSearch);
}elseif(isset($_GET['Free'])){	echo 2;									
$result3 = $pv->search_artgallerynew1sippingcharge($ad_type, $valueiid, $txtSearchCategory, $txtArtSearch,1);
}	
elseif(isset($_GET['Onsale'])){									
$result3 = $pv->search_artgallerynew1sippingcharge($ad_type, $valueiid, $txtSearchCategory, $txtArtSearch,0);
}else{ 	
//foreach($_GET['Categories'] as $valueiid){
//echo "<pre>";
//print_r($valueiid);
$result3 = $pv->search_artgallerynew1($ad_type, $valueiid, $txtSearchCategory, $txtArtSearch); 
}

}	

//   echo $pv->tr->sql; die;
//var_dump($result3);
if($result3 != false){
//die('====');
while ($row3 = mysqli_fetch_assoc($result3)) { 
//print_r($row3);die;
if($row3['spuser_idspuser']!=NULL){
$st= new _spuser;
$st1=$st->readdatabybuyerid($row3['spuser_idspuser']);
if($st1!=false){
$stt=mysqli_fetch_assoc($st1);
$account_status=$stt['deactivate_status'];
}}

if($account_status!=1){?>
<div class="col-md-4 ">
<div class="artBox m_btm_20">
<div class="topartBox">
<?php if(!empty($row3['discountphoto'])){ ?>
<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row3['idspPostings'];?>" class="btn btn_custom bg_purple btn-border-radius">Sale</a>
<?php } ?>
<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row3['idspPostings'];?>" class="btn btn_custom bg_green_art btn-border-radius">New</a>
<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row3['idspPostings'];?>">                                                   
<?php
$pic = new _postingpicartcraft;
$res2 = $pic->read($row3['idspPostings']);
//var_dump($res2);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
//print_r($rp);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >";
} else{
echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
}
?>
</a>
<a class="title" href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row3['idspPostings'];?>"><?php echo $row3['spPostingTitle'];?></a>
<p>
<?php
if(strlen($row3['spPostingNotes']) < 80){
echo $row3['spPostingNotes'];
}else{
echo substr($row3['spPostingNotes'], 0,80)."...";

} 


?>
</p>
<hr> 
<div class="row 44444">
<div class="col-md-12">
<!-- <strike>#40.00</strike> -->
<?php

if(empty($row3['spPostingPrice'])){
echo "<span class='price'>Free</span>";
}else{
if(empty($row3['discountphoto'])){	
echo '<span class="price">  ' .$curr.' '.$row3['spPostingPrice'].  '  </span>';
}else{
echo '<span class="price">  ' .$curr.''.$row3['discountphoto'].  '  </span>'; 
}
} 
if(empty($row3['discountphoto'])){
}else{ 

echo '  <span class="price text-success" style="color:green;">  <del>  ' .$curr.' '.$row3['spPostingPrice'].  '   </del></span>  ';

$perto =  ($row3['spPostingPrice']-$row3['discountphoto'])/$row3['spPostingPrice']*100;
echo '  ('.round($perto, 2).'%)  ';
}
if($row3['sippingcharge']==1){

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

<div  id="adremovetoboard<?php echo $row3['idspPostings']; ?>">
<?php

$aap = new _addtoboard;

$result = $aap->chkExist($row3['idspPostings'], $_SESSION['pid']);
if($result != false){  ?>

<a class="removetoboard" data-postid="<?php echo $row3['idspPostings']; ?>" data-pid="<?php echo $_SESSION['pid'];?>" data-toggle="tooltip" title="Remove to board"><img src="<?php echo $BaseUrl?>/assets/images/art/icon-add.png" alt="" class="img-responsive"></a>
<?php	}else{ ?>

<a class="addtoboard" data-postid="<?php echo $row3['idspPostings']; ?>" data-pid="<?php echo $_SESSION['pid'];?>" data-toggle="tooltip" title="Add to board">
<img src="<?php echo $BaseUrl?>/assets/images/art/icon-add.png" alt="" class="img-responsive"></a>
<?php		}
?>

</div>


</li>


<li data-toggle="tooltip" title="Share"><a href="javascrpit:void(0)" data-toggle='modal' data-target='#myshare'><span class='sp-share-art' data-postid='<?php echo $row3['idspPostings'];?>' src='<?php echo ($pic2); ?>'><img src="<?php echo $BaseUrl?>/assets/images/art/icon-share.png" alt="" class="img-responsive"></span></a></li>

<li><a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row3['idspPostings'];?>" data-toggle="tooltip" title="View Product"><img src="<?php echo $BaseUrl?>/assets/images/art/icon-cart.png" alt="" class="img-responsive"></a></li>
</ul>
</div>
</div>
</div>
<?php }
}
}else{
//die('=64587567');
//print_r($result3);die;

$iss++;	
}
}

if($result3 == false){

//if($iss==1){
echo "<h1 style='text-align: center; '>Sorry, we couldn't find any items matching this category ".$_GET['txtArtSearch']." Please search again. </h1>";
}
}   

else{ 

if(isset($_GET['Price']) && $_GET['Price']!='any'){ 
if($_GET['Price']=='u25'){
$spshort = 0;
$epshort = 25;
}
if($_GET['Price']=='ca25to50'){
$spshort = 25;
$epshort = 50;
}
if($_GET['Price']=='ca50to100'){
$spshort = 50;
$epshort = 100;
}
if($_GET['Price']=='over100'){
$spshort = 101;
$epshort = 1000000000;
}
if(isset($_GET['Free']) && isset($_GET['Onsale'])){	

$result3 = $pv->search_artgallerynewshortprice($ad_type, $txtSearchCategory, $txtArtSearch, $spshort, $epshort);
}elseif(isset($_GET['Free'])){									
$result3 = $pv->search_artgallerynewshortpricesippingcharge($ad_type, $txtSearchCategory, $txtArtSearch, $spshort, $epshort,1);
}	
elseif(isset($_GET['Onsale'])){									
$result3 = $pv->search_artgallerynewshortpricesippingcharge($ad_type, $txtSearchCategory, $txtArtSearch, $spshort, $epshort,0);
}else{ 

$result3 = $pv->search_artgallerynewshortprice($ad_type, $txtSearchCategory, $txtArtSearch, $spshort, $epshort);
//echo $pv->tr->sql;   
}	 
//echo $pv->tr->sql; die;
}else{ 

if(isset($_GET['Free']) && isset($_GET['Onsale'])){	

$result3 = $pv->search_artgallerynew($ad_type, $txtSearchCategory, $txtArtSearch);
//echo $result3->num_rows;
}elseif(isset($_GET['Free'])){						

$result3 = $pv->search_artgippingcharge($ad_type, $txtSearchCategory, $txtArtSearch,1);
}	
elseif(isset($_GET['Onsale'])){								
$result3 = $pv->search_artgallerynewsippingcharge($ad_type, $txtSearchCategory, $txtArtSearch,0);
} 
elseif(isset($_GET['Craft'])  && empty($_GET['Art'])){	 
$p = new _postingviewartcraft;
$result3 = $p->sameCategoryPicNEW(13, 5, $_GET['Craft']);
}

else{
$result3 = $pv->search_artgallerynew($ad_type, $txtSearchCategory, $txtArtSearch);

}

}	
//echo $pv->tr->sql; die;

if($result3 != false){
while ($row3 = mysqli_fetch_assoc($result3)) { 
//print_r($row3); die;
if($row3['spuser_idspuser']!=NULL){
$st= new _spuser;
$st1=$st->readdatabybuyerid($row3['spuser_idspuser']);
if($st1!=false){
$stt=mysqli_fetch_assoc($st1);
$account_status=$stt['deactivate_status'];
}}

$idposting=$row3['idspPostings'];
$pc = new _productposting;
$flagcmd=$pc->flagcount(13,$idposting);
$flagnums=$flagcmd->num_rows;
//echo $flagnums;
if($flagnums=='9')
{
$updatestatus=$pc->artstatus($idposting); 

}
if($account_status!=1){?>
<div class="col-md-4 list-item">
<div class="artBox m_btm_20">
<div class="topartBox">
<?php if(isset($row3['discountphoto'])){ ?>
<a <?php //echo $BaseUrl.'/artandcraft/detail.php?postid='.$row3['idspPostings'];?> class="btn btn_custom bg_purple btn-border-radius" style="cursor: context-menu;">Sale</a>
<?php } ?>
<a <?php //echo $BaseUrl.'/artandcraft/detail.php?postid='.$row3['idspPostings'];?> class="btn btn_custom bg_green_art btn-border-radius" style="    cursor: context-menu;">New</a>
<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row3['idspPostings'];?>">
<?php
$pic = new _postingpicartcraft;

$res2 = $pic->read($row3['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >";
} else{
echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
}
?>
</a>
<a class="title" href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row3['idspPostings'];?>">
<?php //echo $row3['spPostingTitle'];

if(strlen($row3['spPostingTitle']) < 20){
echo $row3['spPostingTitle'];
}else{
echo substr($row3['spPostingTitle'], 0,20)."...";

}


?></a>
<p>
<?php
if(strlen($row3['spPostingNotes']) < 50){
echo $row3['spPostingNotes'];
}else{
echo substr($row3['spPostingNotes'], 0,50)."...";

} ?>
</p>

<hr>
<div class="row 55555">
<div class="col-md-12">
<!-- <strike>#40.00</strike> -->
<?php
if(empty($row3['spPostingPrice'])){
echo "<span class='price'>Free</span>";
}else{
if(empty($row3['discountphoto'])){	
echo '<span class="price">  ' .$curr.' '.$row3['spPostingPrice'].  '  </span';
}else{
echo '<span class="price">  ' .$curr.' '.$row3['discountphoto'].  '  </span>'; 
}
} 
//
if(empty($row3['discountphoto'])){
}else{ 
//echo $curr;
if($row3['spPostingPrice'] != $row3['discountphoto'] ){
echo '  <span class="price text-success" style="color:green;">  <del>  ' .$curr.' '.$row3['spPostingPrice'].  '  </del></span>  ';

$perto =  ($row3['spPostingPrice']-$row3['discountphoto'])/$row3['spPostingPrice']*100;
echo '  ('.round($perto, 2).'%)  ';
} }
//print_r($row3);
//die('jhjhffj');
?>
<div class="row 6666" style="display:none;">


<?php		if($row3['sippingcharge']==1){
//if($row3['spPostingPrice'] != $row3['discountphoto'] ){

echo ' <div class="col-sm-6 badge badge-success" style=" background-color: green; width:115px; margin-left:15px;">Free Delivery</div>';
//}
}
else{

echo '<br><br>';
}
?>

</div>
</div>
</div>
</div>
<?php 	if($_SESSION['guet_yes']!='yes'){ ?>

<div class="btmartBox">





<ul class="social">


<li> 

<div  id="adremovetoboard<?php echo $row3['idspPostings']; ?>">
<?php

$aap = new _addtoboard;

$result = $aap->chkExist($row3['idspPostings'], $_SESSION['pid']);

if($result != false){  ?>
<a class="removetoboard" data-postid="<?php echo $row3['idspPostings']; ?>" data-pid="<?php echo $_SESSION['pid'];?>" data-toggle="tooltip" title="Remove to board"><i class="fa fa-times-circle-o" style="color:white;font-size:27px;"></i></a>
<?php	}else{ ?>

<a class="addtoboard" data-postid="<?php echo $row3['idspPostings']; ?>" data-pid="<?php echo $_SESSION['pid'];?>" data-toggle="tooltip" title="Add to board">
<img src="<?php echo $BaseUrl?>/assets/images/art/icon-add.png" alt="" class="img-responsive"></a>
<?php		}
?>

</div>


</li>


<li><a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row3['idspPostings'];?>" data-toggle="tooltip" title="View Product"><i class="fa fa-info-circle" aria-hidden="true" style=" font-size: 27px; color: white; "></i></a></li>
</ul>





</div>
<?php } ?>
</div>
</div>
<?php }
}
}else{

echo "<h1 style='text-align: center; '>Sorry, we couldn't find any items matching this category '".$_GET['txtArtSearch']."' Please search again. </h1>"; 

}
}




}
?>

</div>
<div id="pagination-container"></div>
</div>
</div>

</div>
</section>

<?php include('postshare.php');?>
<?php 
include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>
<script type="text/javascript">
$( function() {
$( "#slider-range" ).slider({
range: true,
min: 0,
max: 5000,
values: [ 1000, 4000 ],
slide: function( event, ui ) {
$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
}
});
$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );
} );

$(function () {
$('span').click(function () {
$('#datalist p:hidden').slice(0, 5).show();
if ($('#datalist p').length == $('#datalist p:visible').length) {
$('#load_more_1').hide();
}
});
});


</script>
<!-- price ranger end -->
<!-- notification js -->
<script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
<script>
var items = $(".list-wrapper .list-item");
var numItems = items.length;
var perPage = 15;

items.slice(perPage).hide();

$('#pagination-container').pagination({
items: numItems,
itemsOnPage: perPage,
prevText: "&laquo;",
nextText: "&raquo;",
onPageClick: function (pageNumber) {
var showFrom = perPage * (pageNumber - 1);
var showTo = showFrom + perPage;
items.hide().slice(showFrom, showTo).show();
}
});

</script>
</body>
</html>
<?php
}
?>
