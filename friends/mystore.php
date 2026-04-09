

<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="../assets/css/magnific-popup/magnific-popup.css">

<!-- Magnific Popup core JS file1111 -->


<?php

$p = new _productposting;
$resulttotal = $p->friendProduct(1,$_GET["profileid"]);
$count_num_rows4 = $resulttotal->num_rows;
$result3 = $p->friendProductlimit(1,$_GET["profileid"]);
$folder = 'store';
// exit;
//echo $pic->ta->sql;
if (isset($_GET["profileid"])) {
$active = 0;
if($result3 != false)
{
echo "<div class='row m_top_10 frndProfileImg no-margin gallery-img m_btm_5'>";
while($row3 = mysqli_fetch_assoc($result3)){
//print_r($row3);
$curr=$row3['default_currency'];
?>

<div class="item <?php echo ($active == 0)?'active':'';?>">
<div class="col-xs-5ths">
<div class="featured_box " style="border-radius: 15px;">
<div class="img_fe_box" style="border: 0px solid #ccc;">
<a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$row3['idspPostings'];?>">           
<?php
$pic = new _productpic;
$result = $pic->read($row3['idspPostings']);

//echo $pic->ta->sql;
if ($row3['spCategories_idspCategory'] != 5 && $row3['spCategories_idspCategory'] != 2) {
if ($result != false) {
$rp = mysqli_fetch_assoc($result);


$picture = $rp['spPostingPic'];
echo "<img style='border-radius: 10px;' alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
} else
echo "<img style='border-radius: 10px;' alt='Posting Pic' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
}else{
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img style='border-radius: 10px;' alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
} else
echo "<img style='border-radius: 10px;' alt='Posting Pic' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
}
?>
</a>
</div>
<ul style="padding-left: 10px;display: grid; list-style: none;">
<li>
<h4 style="background-color: unset;float: left;padding: 0px; ">
<?php 
if(!empty($row3['spPostingTitle'])){
if(strlen($row3['spPostingTitle']) < 15){
?><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$row3['idspPostings'];?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $row3['spPostingTitle']; ?>"><?php echo ucwords($row3['spPostingTitle']); ?></a><?php
}else{
?><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$row3['idspPostings'];?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $row3['spPostingTitle']; ?>"><?php echo ucwords(substr($row3['spPostingTitle'], 0,15)).'...'; ?></a><?php
}
}else{
echo "&nbsp;";
}
?>    
</h4>
</li>
<li>
<h5 style="float: left;">
<?php
/*if ($row3['spPostingPrice'] != false) {
echo "<div class='postprice' style='' data-price='" . $row3['spPostingPrice'] . "'>" .$curr.' '. $row3['spPostingPrice'] . "</div><span class='" . ($row3['spCategories_idspCategory'] == 5 || $row3['spCategories_idspCategory'] == 18 || $row3['spCategories_idspCategory'] == 9 || $row3['spCategories_idspCategory'] == 3 ? "hidden" : "") . "'></span>";
}*/
?>

<?php
if ($row3['spPostingPrice'] != '') { 


$curr=$row3['default_currency']; 
$price=$row3['spPostingPrice'];
$discount   = $row3['retailSpecDiscount'];

if($row3['sellType']=='Retail'){
if($row3['retailSpecDiscount']!=''){
$discount   = $row3['retailSpecDiscount'];
}
else{
$discount   = $row3['spPostingPrice'];
}
}
//echo $curr.' '.$discount;


if(($discount!='')&& ($row3['sellType']=="Retail")){  
if($price!=$discount){
echo $curr.' '.$discount; ?> &nbsp; <del class="text-success" style="color:green;"><?php echo $curr.' '.$price; ?></del>
<?php
}
}else{
echo $curr.' '.$price;
}			

}
?>   

</h5>
</li>
<?php
$mr = new _spstorereview_rating;
// echo $row3['idspPostings'];
$resultsum1 = $mr->readstorerating($row3['idspPostings']);

if($resultsum1 != false){
$totalmyreviews1 = $resultsum1->num_rows;
while($rowreview1 = mysqli_fetch_assoc($resultsum1)){
$sumrevrating1 = $rowreview1['rating'];
$rateingarr1[] =  $rowreview1['rating'];
}  

$count1 = count($rateingarr1);
$reviewaveragerate1 = $sumrevrating1 / $count1;
$totalreviewrate1  = round($reviewaveragerate1, 1);
}
?>
<li>
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
</p>
</li>           
</ul>
</div>
</div>
</div>

<?php $active++; }
echo "</div>";
}else{

echo"<h4 style='text-align:center;'>No Products found</h4>";
}
}


if($count_num_rows4 > 10){
?>
<div>
<h1 class="load-more8" style="text-align: center;color:#2784c5;padding: 6px;cursor:pointer" >Load More</h1>
<input type="hidden" id="row78" value="0">
<input type="hidden" id="all78" value="<?php echo $count_num_rows4; ?>"> 
<input type="hidden" id="profiddd78" value="<?php echo $_GET["profileid"]; ?>">
</div>

<?php } ?>

<script type="">

$('.thumbnail').magnificPopup({
type: 'image'
// other options
});

$(document).ready(function(){
// Load more data
$('.load-more8').click(function(){
      //alert("uyiyyyyyyyyyyyyyyyyy");
var row = Number($('#row78').val());
var allcount = $('#all78').val();
row = row + 10;

if(row <= allcount){

$("#row78").val(row);
var profileid = $("#profiddd78").val();


$.ajax({
url: 'more_store.php', 
type: 'post',
data: {row:row,profile:profileid},
beforeSend:function(){
$(".load-more8").text("Loading...");
},
success: function(response){

// Setting little delay while displaying new content
setTimeout(function() {
// appending posts after last post with class="post"
$(".item:last").after(response).show().fadeIn("slow");

$(".load-more8").text("Load More");
var rowno = row + 10;
// checking row value is greater than allcount or not
if(rowno > allcount){

$(".load-more8").css("display","none");
}else{

$(".load-more8").text("Load more");
}
$(".load-more8").text("Load More");
}, 2000);

}
});
}else{
$('.load-more8').text("Loading...");

// Setting little delay while removing contents
setTimeout(function() {

// When row is greater than allcount then remove all class='post' element after 3 element
$('.item:nth-child(3)').nextAll('.item').remove().fadeIn("slow");

// Reset the value of row
$("#row78").val(0); 

// Change the text and background
$('.load-more8').text("Load more");
$('.load-more8').css("background","#15a9ce");
}, 2000);
}
});
});

</script>	
