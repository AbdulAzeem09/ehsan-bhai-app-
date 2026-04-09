<?php 
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

$_GET["categoryID"] = 13;
if(isset($_GET['postid']) && $_GET['postid'] > 0){

$p = new _postingviewartcraft;
$pf  = new _postfield;

$result = $p->singletimelines($_GET['postid']);
//echo $p->ta->sql;
if($result != false){
$row = mysqli_fetch_assoc($result);
$spProfiles_idspProfilesid   = $row['spProfiles_idspProfiles'];
$posttype   = $row['ad_type'];
$ProTitle   = $row['spPostingTitle'];
$ProDes     = $row['spPostingNotes'];
$ArtistName = $row['spProfileName']; 
$ArtistId   = $row['idspProfiles'];
$ArtistAbout= $row['spProfileAbout'];
$ArtistPic  = $row['spProfilePic'];

if($row['ad_type']==1){
$ad_type = 'art';
$subcategoryforartcraft = $row['subcategoryforart'];
}
if($row['ad_type']==2){
$ad_type = 'craft';
$subcategoryforartcraft = $row['subcategoryforcraft'];
}


$price      = $row['discountphoto'];
if(empty($price)){
$price =  $row['spPostingPrice'];
}

$symbol      = $row['defaltcurrency'];

$country    = $row['spPostingsCountry'];
$city      = $row['spPostingsCity'];

$return_if_applicable      = $row['return_if_applicable'];
$return_within    = $row['return_within'];


$is_cancellable      = $row['is_cancellable'];

$sippingcharge      = $row['sippingcharge'];

$fixedamount      = $row['fixedamount'];

$weight_shipping      = $row['weight_shipping'];			
$width_shipping      = $row['width_shipping'];			
$height_shipping      = $row['height_shipping'];			
$depth_shipping      = $row['depth_shipping'];



$pr = new _spprofilehasprofile;
$result3 = $pr->frndLeevel($_SESSION['pid'], $row['idspProfiles']);
if($result3 == 0){
$level = '1st Connection';
}else if($result3 == 1){
$level = '1st Connection';
}else if($result3 == 2){
$level = '2nd Connection';
}else if($result3 == 3){
$level = '3rd Connection';
}else{
$level = '';
}

//posting fields
$result_pf = $pf->read($row['idspPostings']);
//echo $pf->ta->sql."<br>";
if($result_pf){
$catName = "";
$imageSize = "";
$printedYear    = "";
$OrganizerId = "";
$Quantity = "";
while ($row2 = mysqli_fetch_assoc($result_pf)) {

if($catName == ''){
if($row2['spPostFieldName'] == 'photos_'){
$catName = $row2['spPostFieldValue'];

}
}
if($imageSize == ''){
if($row2['spPostFieldName'] == 'imagesize_'){
$imageSize = $row2['spPostFieldValue'];

}
}
if($printedYear == ''){
if($row2['spPostFieldName'] == 'mediaprinted_'){
$printedYear = $row2['spPostFieldValue'];

}
}
if($OrganizerId == ''){
if($row2['spPostFieldName'] == 'spPostingEventOrgId_'){
$OrganizerId = $row2['spPostFieldValue'];

}
}
if($Quantity == ''){
if($row2['spPostFieldName'] == 'quantity_'){
$Quantity = $row2['spPostFieldValue'];

}
}
}
}
}

//rating
$r = new _sppostrating;
$res = $r->read($_SESSION["pid"],$_GET["postid"]);
if($res != false){
$rows = mysqli_fetch_assoc($res);
$rat = $rows["spPostRating"];
}else{
$rat = 0;
}

$result = $r->review($_GET["postid"]);
if($result != false){
$total = 0;
$count = $result->num_rows;
while($rows = mysqli_fetch_assoc($result)){
$total += $rows["spPostRating"];
}
$ratings = $total/$count;
}else{
$ratings = 0;
}
$r = new _sppostreview;
$result = $r->review($_GET["postid"]);
if($result != false)
{
$rows = mysqli_fetch_assoc($result);
$review = $result->num_rows;
}
else
$review = 0;
}else{
$re = new _redirect;
$redirctUrl = "../artandcraft";
$re->redirect($redirctUrl);
//header('location:../photos/');
}


$header_photo = "header_photo";
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php');?>

<!--This script for posting timeline data End-->
<!--NOTIFICATION-->
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>
<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/magnific-popup.css">
<!-- image gallery script strt -->
<link rel="stylesheet" href="<?php echo $BaseUrl;?>/assets/css/prettyPhoto.css">
<!-- image gallery script end -->
<!-- Magnific Popup core JS file -->
<script src="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/jquery.magnific-popup.js"></script>
<script>
function checkqty(txb) {                
var qty = parseInt(txb);
var actualQty = $("#spOrderQty").val();
//alert(actualQty);return false;
//console.log(actualQty);
if(qty > actualQty){
document.getElementById("newValue").value = actualQty;
}
if(qty < 1){
document.getElementById("newValue").value = 1;
//alert("less");
}
}
</script>


</head>

<body class="bg_gray">
<!-- Modal -->
<div id="flagPost" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<form method="post" action="addtoflag.php" class="sharestorepos">
<div class="modal-content no-radius">
<input type="hidden" name="spPosting_idspPosting" value="<?php echo $_GET['postid'];?>">
<input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
<input type="hidden" name="spCategory_idspCategory" value="<?php echo $_GET['categoryID']?>">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Flag Post</h4>
</div>
<div class="modal-body">
<div class="radio">
<label><input type="radio" name="why_flag" value="Duplicate post" checked="">Duplicate post</label>
</div>
<div class="radio">
<label><input type="radio" name="why_flag" value="Posting Violation">Posting Violation</label>
</div>
<div class="radio">
<label><input type="radio" name="why_flag" value="Suspicious Post">Suspicious Post</label>
</div>
<div class="radio">
<label><input type="radio" name="why_flag" value="Copied My Post">Copied My Post</label>
</div> 

<!-- <label>Why flag this post?</label> -->
<textarea class="form-control" name="flag_desc" placeholder="Add Comments"></textarea>
</div>
<div class="modal-footer">
<input type="submit" name="" class="btn butn_mdl_submit ">
<button type="button" class="btn butn_cancel" data-dismiss="modal">Cancel</button>
</div>
</div>
</form>
</div>
</div>
<?php include_once("../header.php");?>
<section class="innerArtBanner">
<?php include('top-search.php');?>
</section>
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
<!--Write Reviews-->
<div class="modal fade" id="reviews" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content no-radius">
<form action="../review/addreview.php" method="POST" class="sharestorepos">
<input type="hidden" class="dynamic-pid" name="spProfiles_idspProfiles" value="<?php echo $_SESSION['pid']?>"/>
<input type="hidden" name="spPostings_idspPostings" id="spPostings_idspPostings" value="<?php echo $_GET["postid"]?>">
<input type="hidden" name="spPostRating" id="spPostRating" value="<?php echo $rat;?>">

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h3 class="modal-title" id="exampleModalLabel"><b>Write Review</b></h3>
</div>
<div class="modal-body">
<?php
if(isset($folder)){
$_SESSION['folder'] = $folder;
}else{
$_SESSION['folder'] = "photos";
}
?>
<div class="form-group">
<textarea class="form-control" id="reviewtext" name="spPostReviewText" placeholder="Write your Review..." rows="5"></textarea>
</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary writereview btn-border-radius">Add Review</button>
</div>
</form>
</div>
</div>
</div> 
<!--Reviews Complete-->
<div class="space"></div>
<section class="m_btm_40">
<div class="container">
<div class="row">
<div class="col-md-9 topbread">
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/artandcraft';?>"><i class="fa fa-home"></i></a></li>
<?php
$m = new _subcategory;
if($posttype==1){
$result7 = $m->art_categorylist($catName);
if ($result7) {
$row7 = mysqli_fetch_assoc($result7);
$CatNameNew = $row7['spArtgalleryTitle'];
}else{
$CatNameNew = "";
}
}else{
$result7 = $m->craft_categorylist($catName); 
if ($result7) {
die;
$row7 = mysqli_fetch_assoc($result7);
$CatNameNew = $row7['craft_title'];
}else{
$CatNameNew = "";
}
}

?>                              
<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo $BaseUrl.'/artandcraft/search.php?txtSearchCategory=13&txtArtSearch=&Art='.$ad_type.'&btnArtSearch=Search';?>&page=1"><?php echo ucfirst($ad_type);?></a></li>

<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo $BaseUrl.'/artandcraft/shop-top-category.php?';?>catId=<?php echo $subcategoryforartcraft; ?>&for=<?php echo $ad_type; ?>&page=1"><?php echo $CatNameNew;?></a></li>
<li class="breadcrumb-item active" aria-current="page"><?php echo $ProTitle;?></li>
</ol>
</nav>
</div>
<div class="col-md-3 topbread text-right">
<p>Location: <?php
$rc = new _country; 
$result_cntry = $rc->readCountryName($country);
if ($result_cntry) {
$row4 = mysqli_fetch_assoc($result_cntry);
echo $countryName = $row4['country_title'];
}else{
echo "";
}
?> ,
<?php
$rcty = new _city;
$result_cty = $rcty->readCityName($city);
if ($result_cty) {
$row5 = mysqli_fetch_assoc($result_cty);
echo $cityName = $row5['city_title'];
}else{
echo "";
}
?></p>
</div>
</div>
<div class="row">				

<style type="text/css">
.flickity-enabled {
position: relative;
}

.flickity-enabled:focus { outline: none; }

.flickity-viewport {
overflow: hidden;
position: relative;
height: 100%;
}

.flickity-slider {
position: absolute;
width: 100%;
height: 100%;
}

.flickity-enabled.is-draggable {
-webkit-tap-highlight-color: transparent;
tap-highlight-color: transparent;
-webkit-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
user-select: none;
}

.flickity-enabled.is-draggable .flickity-viewport {
cursor: move;
cursor: -webkit-grab;
cursor: grab;
}

.flickity-enabled.is-draggable .flickity-viewport.is-pointer-down {
cursor: -webkit-grabbing;
cursor: grabbing;
}

.flickity-prev-next-button {
position: absolute;
top: 50%;
width: 44px;
height: 44px;
border: none;
border-radius: 50%;
background: white;
background: hsla(0, 0%, 100%, 0.75);
cursor: pointer;
/* vertically center */
-webkit-transform: translateY(-50%);
transform: translateY(-50%);
}

.flickity-prev-next-button:hover { background: white; }

.flickity-prev-next-button:focus {
outline: none;
box-shadow: 0 0 0 5px #09F;
}

.flickity-prev-next-button:active {
opacity: 0.6;
}

.flickity-prev-next-button.previous { left: 10px; }
.flickity-prev-next-button.next { right: 10px; }

.flickity-prev-next-button:disabled {
opacity: 0.3;
cursor: auto;
}

.flickity-prev-next-button svg {
position: absolute;
left: 20%;
top: 20%;
width: 60%;
height: 60%;
}

.flickity-prev-next-button .arrow {
fill: #333;
}

.carousel {
background: #FAFAFA;
}

.carousel-main {
margin-bottom: 8px;
}

.carousel-cell {
width: 100%;
margin-right: 8px;
background: #8C8;
border-radius: 5px;
}
.carousel-nav .carousel-cell {
height: 90px;
width: 120px;
}

.carousel-main img {
display: block;
margin: 0 auto; 
}
.pro_detail_box.dfhfgbhcgf.col-md-10 {
border: 1px solid #ccc;
border-radius: 12px !important;
padding: 5px;
background-color: #fff;
}
</style>
<div class="pro_detail_box dfhfgbhcgf col-md-10">
<div class="row">
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>

<script type="text/javascript">

function detect_old_ie(){if(/MSIE (\d+\.\d+);/.test(navigator.userAgent)){var o=new Number(RegExp.$1);return!(9<=o)&&(8<=o||(7<=o||(6<=o||(5<=o||void 0))))}return!1}window.requestAnimFrame=window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||window.oRequestAnimationFrame||window.msRequestAnimationFrame||function(o){window.setTimeout(o,20)},function(Ao){function n(s,o){this.xzoom=!0;var t,a,p,l,r,e,n,d,i,c,h,f,u,v,m,g,w,x,b,z,y,C,k,O,M,A,S,H,W,F,I,T,X,Y,R,q,E,L,D,Z,_,j,N,Q,$,B,G,J,K,P,U,V=this,oo={},to=(new Array,new Array),eo=0,io=0,so=0,no=0,ao=0,po=0,lo=0,ro=0,co=0,ho=0,fo=0,uo=0,vo=0,mo=detect_old_ie(),go=/MSIE (\d+\.\d+);/.test(navigator.userAgent),wo="";function xo(){var o=document.documentElement;return{left:(window.pageXOffset||o.scrollLeft)-(o.clientLeft||0),top:(window.pageYOffset||o.scrollTop)-(o.clientTop||0)}}function bo(){var o;"circle"==V.options.lensShape&&"lens"==V.options.position&&(o=((M=A=Math.max(M,A))+2*Math.max(F,W))/2,k.css({"-moz-border-radius":o,"-webkit-border-radius":o,"border-radius":o}))}function zo(o,t,e,i){"lens"==V.options.position?(C.css({top:-(t-n)*T+A/2,left:-(o-d)*I+M/2}),V.options.bg&&(k.css({"background-image":"url("+C.attr("src")+")","background-repeat":"no-repeat","background-position":-(o-d)*I+M/2+"px "+(-(t-n)*T+A/2)+"px"}),e&&i&&k.css({"background-size":e+"px "+i+"px"}))):C.css({top:-H*T,left:-S*I})}function yo(o,t){var e,i;1<(so=so<-1?-1:so)&&(so=1),X<Y?i=(e=l*(X-(X-1)*so))/R:e=(i=r*(Y-(Y-1)*so))*R,L?(no=o,ao=t,po=e,lo=i):(L||(ro=po=e,co=lo=i),M=l/(I=e/a),A=r/(T=i/p),bo(),ko(o,t),C.width(e),C.height(i),k.width(M),k.height(A),k.css({top:H-F,left:S-W}),O.css({top:-H,left:-S}),zo(o,t,e,i))}function Co(){var o=ho,t=fo,e=uo,i=vo,s=ro,n=co;o+=(no-o)/V.options.smoothLensMove,t+=(ao-t)/V.options.smoothLensMove,e+=(no-e)/V.options.smoothZoomMove,i+=(ao-i)/V.options.smoothZoomMove,s+=(po-s)/V.options.smoothScale,n+=(lo-n)/V.options.smoothScale,M=l/(I=s/a),A=r/(T=n/p),bo(),ko(o,t),C.width(s),C.height(n),k.width(M),k.height(A),k.css({top:H-F,left:S-W}),O.css({top:-H,left:-S}),ko(e,i),zo(o,t,s,n),ho=o,fo=t,uo=e,vo=i,ro=s,co=n,L&&requestAnimFrame(Co)}function ko(o,t){S=(o-=d)-M/2,H=(t-=n)-A/2,"lens"!=V.options.position&&V.options.lensCollision&&(S<0&&(S=0),M<=a&&a-M<S&&(S=a-M),a<M&&(S=a/2-M/2),H<0&&(H=0),A<=p&&p-A<H&&(H=p-A),p<A&&(H=p/2-A/2))}function Oo(){void 0!==m&&m.remove(),void 0!==w&&w.remove(),void 0!==N&&N.remove()}function Mo(o){var t=o.attr("title"),o=o.attr("xtitle");return o||t||""}this.adaptive=function(){0!=B&&0!=G||(s.css("width",""),s.css("height",""),B=s.width(),G=s.height()),Oo(),Q=Ao(window).width(),$=Ao(window).height(),J=s.width(),K=s.height(),B<J&&(J=B),G<K&&(K=G),(Q<B||$<G?!0:!1)?s.width("100%"):0!=B&&s.width(B),"fullscreen"!=P&&(!function(){var o=s.offset();l="auto"==V.options.zoomWidth?J:V.options.zoomWidth;r="auto"==V.options.zoomHeight?K:V.options.zoomHeight;"#"==V.options.position.substr(0,1)?oo=Ao(V.options.position):oo.length=0;if(0!=oo.length)return!0;switch(P){case"lens":case"inside":return!0;case"top":n=o.top,d=o.left,i=n-r,c=d;break;case"left":n=o.top,d=o.left,i=n,c=d-l;break;case"bottom":n=o.top,d=o.left,i=n+K,c=d;break;case"right":default:n=o.top,d=o.left,i=n,c=d+J}return!(Q<c+l||c<0)}()?V.options.position=V.options.mposition:V.options.position=P),V.options.lensReverse||(U=V.options.adaptiveReverse&&V.options.position==V.options.mposition)},this.xscroll=function(o){var t,e;u=o.pageX||o.originalEvent.pageX,v=o.pageY||o.originalEvent.pageY,o.preventDefault(),o.xscale?(so=o.xscale,yo(u,v)):(t=-o.originalEvent.detail||o.originalEvent.wheelDelta||o.xdelta,e=u,o=v,mo&&(e=D,o=Z),so+=t=0<t?-.05:.05,yo(e,o))},this.openzoom=function(o){switch(u=o.pageX,v=o.pageY,V.options.adaptive&&V.adaptive(),so=V.options.defaultScale,L=!1,m=Ao("<div></div>"),""!=V.options.sourceClass&&m.addClass(V.options.sourceClass),m.css("position","absolute"),x=Ao("<div></div>"),""!=V.options.loadingClass&&x.addClass(V.options.loadingClass),x.css("position","absolute"),g=Ao('<div style="position: absolute; top: 0; left: 0;"></div>'),m.append(x),w=Ao("<div></div>"),""!=V.options.zoomClass&&"fullscreen"!=V.options.position&&w.addClass(V.options.zoomClass),w.css({position:"absolute",overflow:"hidden",opacity:1}),V.options.title&&""!=wo&&(N=Ao("<div></div>"),j=Ao("<div></div>"),N.css({position:"absolute",opacity:1}),V.options.titleClass&&j.addClass(V.options.titleClass),j.html("<span>"+wo+"</span>"),N.append(j),V.options.fadeIn&&N.css({opacity:0})),k=Ao("<div></div>"),""!=V.options.lensClass&&k.addClass(V.options.lensClass),k.css({position:"absolute",overflow:"hidden"}),V.options.lens&&(lenstint=Ao("<div></div>"),lenstint.css({position:"absolute",background:V.options.lens,opacity:V.options.lensOpacity,width:"100%",height:"100%",top:0,left:0,"z-index":9999}),k.append(lenstint)),function(){switch(p="fullscreen"==V.options.position?(a=Ao(window).width(),Ao(window).height()):(a=s.width(),s.height()),x.css({top:p/2-x.height()/2,left:a/2-x.width()/2}),(e=V.options.rootOutput||"fullscreen"==V.options.position?s.offset():s.position()).top=Math.round(e.top),e.left=Math.round(e.left),V.options.position){case"fullscreen":n=xo().top,d=xo().left,c=i=0;break;case"inside":n=e.top,d=e.left,c=i=0;break;case"top":n=e.top,d=e.left,i=n-r,c=d;break;case"left":n=e.top,d=e.left,i=n,c=d-l;break;case"bottom":n=e.top,d=e.left,i=n+p,c=d;break;case"right":default:n=e.top,d=e.left,i=n,c=d+a}n-=m.outerHeight()/2,d-=m.outerWidth()/2,"#"==V.options.position.substr(0,1)?oo=Ao(V.options.position):oo.length=0,0==oo.length&&"inside"!=V.options.position&&"fullscreen"!=V.options.position?(V.options.adaptive&&B&&G||(B=a,G=p),l="auto"==V.options.zoomWidth?a:V.options.zoomWidth,r="auto"==V.options.zoomHeight?p:V.options.zoomHeight,i+=V.options.Yoffset,c+=V.options.Xoffset,w.css({width:l+"px",height:r+"px",top:i,left:c}),"lens"!=V.options.position&&t.append(w)):"inside"==V.options.position||"fullscreen"==V.options.position?(l=a,r=p,w.css({width:l+"px",height:r+"px"}),m.append(w)):(l=oo.width(),r=oo.height(),V.options.rootOutput?(i=oo.offset().top,c=oo.offset().left,t.append(w)):(i=oo.position().top,c=oo.position().left,oo.parent().append(w)),i+=(oo.outerHeight()-r-w.outerHeight())/2,c+=(oo.outerWidth()-l-w.outerWidth())/2,w.css({width:l+"px",height:r+"px",top:i,left:c})),V.options.title&&""!=wo&&("inside"==V.options.position||"lens"==V.options.position||"fullscreen"==V.options.position?(h=i,f=c,m.append(N)):(h=i+(w.outerHeight()-r)/2,f=c+(w.outerWidth()-l)/2,t.append(N)),N.css({width:l+"px",height:r+"px",top:h,left:f})),m.css({width:a+"px",height:p+"px",top:n,left:d}),g.css({width:a+"px",height:p+"px"}),V.options.tint&&"inside"!=V.options.position&&"fullscreen"!=V.options.position?g.css("background-color",V.options.tint):mo&&g.css({"background-image":"url("+s.attr("src")+")","background-color":"#fff"}),y=new Image;var o="";switch(go&&(o="?r="+(new Date).getTime()),y.src=s.attr("xoriginal")+o,(C=Ao(y)).css("position","absolute"),(y=new Image).src=s.attr("src"),(O=Ao(y)).css("position","absolute"),O.width(a),V.options.position){case"fullscreen":case"inside":w.append(C);break;case"lens":k.append(C),V.options.bg&&C.css({display:"none"});break;default:w.append(C),k.append(O)}}(),"inside"!=V.options.position&&"fullscreen"!=V.options.position?((V.options.tint||mo)&&m.append(g),V.options.fadeIn&&(g.css({opacity:0}),k.css({opacity:0}),w.css({opacity:0}))):V.options.fadeIn&&w.css({opacity:0}),t.append(m),V.eventmove(m),V.eventleave(m),V.options.position){case"inside":i-=(w.outerHeight()-w.height())/2,c-=(w.outerWidth()-w.width())/2;break;case"top":i-=w.outerHeight()-w.height(),c-=(w.outerWidth()-w.width())/2;break;case"left":i-=(w.outerHeight()-w.height())/2,c-=w.outerWidth()-w.width();break;case"bottom":c-=(w.outerWidth()-w.width())/2;break;case"right":i-=(w.outerHeight()-w.height())/2}w.css({top:i,left:c}),C.xon("load",function(o){if(x.remove(),!V.options.openOnSmall&&(C.width()<l||C.height()<r))return V.closezoom(),o.preventDefault(),!1;V.options.scroll&&V.eventscroll(m),"inside"!=V.options.position&&"fullscreen"!=V.options.position?(m.append(k),V.options.fadeIn?(g.fadeTo(300,V.options.tintOpacity),k.fadeTo(300,1),w.fadeTo(300,1)):(g.css({opacity:V.options.tintOpacity}),k.css({opacity:1}),w.css({opacity:1}))):V.options.fadeIn?w.fadeTo(300,1):w.css({opacity:1}),V.options.title&&""!=wo&&(V.options.fadeIn?N.fadeTo(300,1):N.css({opacity:1})),q=C.width(),E=C.height(),V.options.adaptive&&(a<B||p<G)&&(O.width(a),O.height(p),q*=a/B,E*=p/G,C.width(q),C.height(E)),ro=po=q,co=lo=E,R=q/E,X=q/l,Y=E/r;for(var t,e=["padding-","border-"],i=F=W=0;i<e.length;i++)t=parseFloat(k.css(e[i]+"top-width")),F+=t!=t?0:t,t=parseFloat(k.css(e[i]+"bottom-width")),F+=t!=t?0:t,t=parseFloat(k.css(e[i]+"left-width")),W+=t!=t?0:t,t=parseFloat(k.css(e[i]+"right-width")),W+=t!=t?0:t;F/=2,W/=2,uo=ho=no=u,vo=fo=ao=v,yo(u,v),V.options.smooth&&(L=!0,requestAnimFrame(Co)),V.eventclick(m)})},this.movezoom=function(o){u=o.pageX,v=o.pageY,mo&&(D=u,Z=v);var t=u-d,e=v-n;U&&(o.pageX-=2*(t-a/2),o.pageY-=2*(e-p/2)),(t<0||a<t||e<0||p<e)&&m.trigger("mouseleave"),V.options.smooth?(no=o.pageX,ao=o.pageY):(bo(),ko(o.pageX,o.pageY),k.css({top:H-F,left:S-W}),O.css({top:-H,left:-S}),zo(o.pageX,o.pageY,0,0))},this.eventdefault=function(){V.eventopen=function(o){o.xon("mouseenter",V.openzoom)},V.eventleave=function(o){o.xon("mouseleave",V.closezoom)},V.eventmove=function(o){o.xon("mousemove",V.movezoom)},V.eventscroll=function(o){o.xon("mousewheel DOMMouseScroll",V.xscroll)},V.eventclick=function(o){o.xon("click",function(o){s.trigger("click")})}},this.eventunbind=function(){s.xoff("mouseenter"),V.eventopen=function(o){},V.eventleave=function(o){},V.eventmove=function(o){},V.eventscroll=function(o){},V.eventclick=function(o){}},this.init=function(o){V.options=Ao.extend({},Ao.fn.xzoom.defaults,o),t=V.options.rootOutput?Ao("body"):s.parent(),P=V.options.position,U=V.options.lensReverse&&"inside"==V.options.position,V.options.smoothZoomMove<1&&(V.options.smoothZoomMove=1),V.options.smoothLensMove<1&&(V.options.smoothLensMove=1),V.options.smoothScale<1&&(V.options.smoothScale=1),V.options.adaptive&&Ao(window).xon("load",function(){B=s.width(),G=s.height(),V.adaptive(),Ao(window).resize(V.adaptive)}),V.eventdefault(),V.eventopen(s)},this.destroy=function(){V.eventunbind()},this.closezoom=function(){L=!1,V.options.fadeOut?(V.options.title&&""!=wo&&N.fadeOut(299),"inside"==V.options.position&&"fullscreen"==V.options.position||w.fadeOut(299),m.fadeOut(300,function(){Oo()})):Oo()},this.gallery=function(){for(var o=new Array,t=0,e=io;e<to.length;e++)o[t]=to[e],t++;for(e=0;e<io;e++)o[t]=to[e],t++;return{index:io,ogallery:to,cgallery:o}},this.xappend=function(e){var i=e.parent();function o(o){Oo(),o.preventDefault(),V.options.activeClass&&(_.removeClass(V.options.activeClass),(_=e).addClass(V.options.activeClass)),io=Ao(this).data("xindex"),V.options.fadeTrans&&((z=new Image).src=s.attr("src"),(b=Ao(z)).css({position:"absolute",top:s.offset().top,left:s.offset().left,width:s.width(),height:s.height()}),Ao(document.body).append(b),b.fadeOut(200,function(){b.remove()}));var t=i.attr("href"),o=e.attr("xpreview")||e.attr("src");wo=Mo(e),e.attr("title")&&s.attr("title",e.attr("title")),s.attr("xoriginal",t),s.removeAttr("style"),s.attr("src",o),V.options.adaptive&&(B=s.width(),G=s.height())}to[eo]=i.attr("href"),i.data("xindex",eo),0==eo&&V.options.activeClass&&(_=e).addClass(V.options.activeClass),0==eo&&V.options.title&&(wo=Mo(e)),eo++,V.options.hover&&i.xon("mouseenter",i,o),i.xon("click",i,o)},this.init(o)}Ao.fn.xon=Ao.fn.on||Ao.fn.bind,Ao.fn.xoff=Ao.fn.off||Ao.fn.bind,Ao.fn.xzoom=function(t){var e,i;if(this.selector){var o,s=this.selector.split(",");for(o in s)s[o]=Ao.trim(s[o]);this.each(function(o){if(1==s.length)if(0==o){if(void 0!==(e=Ao(this)).data("xzoom"))return e.data("xzoom");e.x=new n(e,t)}else void 0!==e.x&&(i=Ao(this),e.x.xappend(i));else if(Ao(this).is(s[0])&&0==o){if(void 0!==(e=Ao(this)).data("xzoom"))return e.data("xzoom");e.x=new n(e,t)}else void 0===e.x||Ao(this).is(s[0])||(i=Ao(this),e.x.xappend(i))})}else this.each(function(o){if(0==o){if(void 0!==(e=Ao(this)).data("xzoom"))return e.data("xzoom");e.x=new n(e,t)}else void 0!==e.x&&(i=Ao(this),e.x.xappend(i))});return void 0!==e&&(e.data("xzoom",e.x),Ao(e).trigger("xzoom_ready"),e.x)},Ao.fn.xzoom.defaults={position:"right",mposition:"inside",rootOutput:!0,Xoffset:0,Yoffset:0,fadeIn:!0,fadeTrans:!0,fadeOut:!1,smooth:!0,smoothZoomMove:3,smoothLensMove:1,smoothScale:6,defaultScale:0,scroll:!0,tint:!1,tintOpacity:.5,lens:!1,lensOpacity:.5,lensShape:"box",lensCollision:!0,lensReverse:!1,openOnSmall:!0,zoomWidth:"auto",zoomHeight:"auto",sourceClass:"xzoom-source",loadingClass:"xzoom-loading",lensClass:"xzoom-lens",zoomClass:"xzoom-preview",activeClass:"xactive",hover:!1,adaptive:!0,adaptiveReverse:!1,title:!1,titleClass:"xzoom-caption",bg:!1}}(jQuery);

</script>
<div class="col-md-6">
<?php 

$pic = new _postingpicartcraft;
$res2 = $pic->read($_GET['postid']);

if ($res2 != false) {
?>
<!-- Flickity HTML init --> 
<div class="carousel carousel-main" data-flickity='{"pageDots": false }'>
<?php
$x=4;
while ($rp = mysqli_fetch_assoc($res2)) {
$pic2 = $rp['spPostingPic'];
?>
<div class="carousel-cell">



<img style="height: 310px; width: 100%; " class="xzoom<?php echo $x; ?>" id="xzoom-magnific" src="<?php echo ($pic2);?>" xoriginal="<?php echo ($pic2);?>" />

<script>
(function ($) {
$(document).ready(function() {

$('.xzoom<?php echo $x; ?>').xzoom({tint: '#006699', Xoffset: 15});

//Integration with hammer.js  
var isTouchSupported = 'ontouchstart' in window;

if (isTouchSupported) {



$('.xzoom<?php echo $x; ?>').each(function() {
var xzoom = $(this).data('xzoom');
$(this).hammer().on("tap", function(event) {
event.pageX = event.gesture.center.pageX;
event.pageY = event.gesture.center.pageY;
var s = 1, ls;

xzoom.eventmove = function(element) {
element.hammer().on('drag', function(event) {
event.pageX = event.gesture.center.pageX;
event.pageY = event.gesture.center.pageY;
xzoom.movezoom(event);
event.gesture.preventDefault();
});
}

var counter = 0;
xzoom.eventclick = function(element) {
element.hammer().on('tap', function() {
counter++;
if (counter == 1) setTimeout(openmagnific,300);
event.gesture.preventDefault();
});
}

function openmagnific() {
if (counter == 2) {
xzoom.closezoom();
var gallery = xzoom.gallery().cgallery;
var i, images = new Array();
for (i in gallery) {
images[i] = {src: gallery[i]};
}
$.magnificPopup.open({items: images, type:'image', gallery: {enabled: true}});
} else {
xzoom.closezoom();
}
counter = 0;
}
xzoom.openzoom(event);
});
});

} else {
//If not touch device

//Integration with fancybox plugin
$('#xzoom-fancy').bind('click', function(event) {
var xzoom = $(this).data('xzoom');
xzoom.closezoom();
$.fancybox.open(xzoom.gallery().cgallery, {padding: 0, helpers: {overlay: {locked: false}}});
event.preventDefault();
});

//Integration with magnific popup plugin
$('#xzoom-magnific').bind('click', function(event) {
var xzoom = $(this).data('xzoom');
xzoom.closezoom();
var gallery = xzoom.gallery().cgallery;
var i, images = new Array();
for (i in gallery) {
images[i] = {src: gallery[i]};
}
$.magnificPopup.open({items: images, type:'image', gallery: {enabled: true}});
event.preventDefault();
});
}
});
})(jQuery);
</script>
</div>
<?php
$x++;	}                        
?>	 
</div>
<div class="carousel carousel-nav"
data-flickity='{ "asNavFor": ".carousel-main", "contain": true, "pageDots": false }'>
<?php
$pic = new _postingpicartcraft;
$res2 = $pic->read($_GET['postid']);

if ($res2 != false) {
while ($rp = mysqli_fetch_assoc($res2)) {
$pic2 = $rp['spPostingPic'];
?>
<div class="carousel-cell"><img style="width: 100%;height: 100%;" src="<?php echo ($pic2);?>"/></div>
<?php
}                        
} ?>
</div>


<?php } ?>
</div>


<script src='https://npmcdn.com/flickity@2/dist/flickity.pkgd.js'></script>


<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">		


<div class="col-md-6">

<div class="" style="margin-top: 10px;border-radius: 15px;">

<div class="row no-margin">
<div class="col-md-10 no-padding">
<h2><?php echo $ProTitle; ?></h2>
</div>
<div class="col-md-2 deatilproduct">
<table style="display: contents;">
<tbody style="float: right;">
<tr>
<td style="font-size: 12px;"><!-- <strong style="font-size: medium;"> -->Product:<!--   </strong> --></td>
<td style="font-size: 12px;"> &nbsp;<?php if($posttype==1){ echo 'Art'; }else{ echo 'Craft' ;} ?><?php echo  $_GET['postid'];?></td>
</tr><tr>
<td style="font-size: 12px;"><span class="listing_fvrt_art">
<?php
$fv = new _favorites; 
$res_fv = $fv->chekFavourite($_GET["postid"], $_SESSION['pid'], $_SESSION['uid']);
if($res_fv != false){ ?>
<a title="Remove to Wishlist" href="javascript:void(0)" id="remtofavoriteart" data-postid="<?php echo $_GET['postid'];?>" data-pid="<?php echo $_SESSION['pid'];?>">
<span id="removetofavouriteeve"><i class="fa fa-heart" style="font-size:20px;color:red;"></i></span>
</a><?php
}else{ 
?>
<a href="javascript:void(0)" id="addtofavouriteart" data-postid="<?php echo $_GET['postid'];?>" data-pid="<?php echo $_SESSION['pid'];?>">
<span  title="Add to Wishlist" id="addtofavouriteeve"><i class="fa fa-heart-o" style="font-size:20px;color:red;"></i></span>
</a>
<?php
}
?>
</span></td>
</tr>
</tbody>
</table>
</div>
</div>
<div class="no-margin">
<form action="../cart/addorder.php" method="post" class="form-inline detailform">
<input type="hidden" id="spOrderAdid_" name="spOrderAdid_" value="<?php echo $_GET["postid"]?>">
<input type="hidden" class="dynamic-pid" id="spByuerProfileId" name="spByuerProfileId" value="<?php echo $_SESSION['pid']?>"/>
<input type="hidden" class="orderamount" id="sporderAmount" name="sporderAmount" value="<?php echo $price ?>"/>
<input type="hidden" id="spSellerProfileId" name="spSellerProfileId" value="<?php  echo $ArtistId;?>"/>

<input type="hidden" class="dynamic-pid" id="spBuyeruserId" name="spBuyeruserId" value="<?php echo $_SESSION['uid']?>"/>
<input type="hidden" id="cartItemType" name="cartItemType" value="artandcraft"/>

<div class="product_detail_right">
<table class="table table-striped table-hovered">
<tr>
<?php
$userid=$_SESSION['uid'];
$c= new _orderSuccess;
$currency= $c->readcurrency($userid);
$res1= mysqli_fetch_assoc($currency);
$curr=$res1['currency'];
?>
<td style=" vertical-align: middle; "><strong>Price</strong></td>
<td>
<input type="text" class="form-control" value="<?php if(!empty($price)){ echo $price.' '.$curr; }else{ echo 'Free'; } ?>" readonly style="background-color: #f9f9f9;border: 0px;"></td>
</tr>
<tr>
<?php  	$result7 = $pf->readSizePost($_GET['postid']);
while ($row7 = mysqli_fetch_assoc($result7)) { 
		$data=$row7['spPostFieldValue'];
}

if($data!=""){
if($data!='None selected'){

?>

<td style=" vertical-align: middle; "><strong>Size</strong></td>
<td> 
<select class="form-control">
<?php
$result6 = $pf->readSizePost($_GET['postid']);
//echo $pf->ta->sql."<br>";
if($result6 != false){

while ($row6 = mysqli_fetch_assoc($result6)) { 
if($row6['spPostFieldValue'] != ''){?>
	<option value="<?php echo $row6['spPostFieldValue'];?>"><?php echo $row6['spPostFieldValue'];?></option>
	<?php
}
}
}
?>
</select>
</td>
<?php }  } ?>


</tr>
<tr>
<td style=" vertical-align: middle; "><strong>Quantity </strong></td>
<td>
<input type="hidden" id="spOrderQty" value="<?php echo (isset($Quantity))?$Quantity:'1';?>"> 



<!----<input type="number" class="form-control" id="newValue" name="spOrderQty" value="1" onkeyup="checkqty(this.value);" style="width: 80px;" >---->


<?php if($Quantity<=10){ ?>

<select name='spOrderQty' class="form-control" id="newValue" >
<?php 
for ($i=1; $i <= $Quantity ; $i++) { 
?>

<option value='<?php echo $i; ?>' ><?php echo $i; ?></option>

<?php } ?>
</select>

<?php }else{ ?>

<input type="text"  onkeyup="numericFilter(this);" maxlength="3" name='spOrderQty' class="form-control" id="newValue">
<script>
function numericFilter(txb) {
txb.value = txb.value.replace(/[^\0-9]/ig, "");
}
</script>

<?php  } echo '<br>';	echo $Quantity.' available'; 	?>
</td>
</tr>                        
</table>
<div class="btn_box ">
<!------<form action="../cart/addorder.php" method="post">
<input type="hidden" id="spOrderAdid_" name="spOrderAdid_" value="232">
<input type="hidden" class="dynamic-pid" id="spByuerProfileId" name="spByuerProfileId" value="2372">

<input type="hidden" class="dynamic-pid" id="spBuyeruserId" name="spBuyeruserId" value="2084">

<input type="hidden" class="dynamic-pid" id="size" name="size">

<input type="hidden" class="orderamount" id="sporderAmount" name="sporderAmount" value="500">
<input type="hidden" id="spSellerProfileId" name="spSellerProfileId" value="1604">
<input type="hidden" id="cartItemType" name="cartItemType" value="Store">
<input type="hidden" id="spOrdrQty" name="spOrderQty" value="1">------->  
<?php
$buyerid = $_SESSION['pid'];
$od = new  _order;
$res = $od->checkorder($_GET["postid"] , $buyerid);
if($buyerid!=$spProfiles_idspProfilesid){
?>						

<?php

echo "<button type='submit' class='btn btn_cart_buy btn_buy_now btn-border-radius' id='buytocart'  data-postid='".$_GET["postid"]."'  data-profileid='".$_SESSION["pid"]."' data-categoryid='13' style='background-color:#ff901d!important;'>Buy Now</button>";

echo "<button type='submit' class='btn btn_cart btn_add_to_cart btn-border-radius' id='addtocart'  data-postid='".$_GET["postid"]."'  data-profileid='".$_SESSION["pid"]."' data-categoryid='13'>Add to cart<i class = 'fas fa-shopping-cart'></i></button>";

/* if ($res != false){
echo "<button type='button' class='btn btn_cart btn_add_to_cart disabled' data-profileid='".$_SESSION["pid"]."' data-categoryid='13'>Added to cart<i class = 'fas fa-shopping-cart'></i></button>";
}else{
echo "<button type='submit' class='btn btn_cart btn_add_to_cart' id='addtocart'  data-postid='".$_GET["postid"]."'  data-profileid='".$_SESSION["pid"]."' data-categoryid='13'>Add to cart<i class = 'fas fa-shopping-cart'></i></button>";
}*/
}	
?>
<div id="ssaddtcart"></div>

</div>
</div>
</form>
</div>

</div>


<br>




<b>Shipping :</b>
<span>
<?php
if($sippingcharge == 1){
echo "Free";
}  
if($sippingcharge == 2){
echo "<b>{$fixedamount} {$symbol}</b> standard";
}
if($sippingcharge == 3){
echo "As Per Cartier";
}
?>   

</span>			                                                

<p style="color:red;margin-top: 12px;">




<?php if($return_if_applicable==''){
//	echo "Return Not Acceptable";
} ?>
<?php if($return_if_applicable==1 && $return_within!=0){ 
echo "{$return_within} days returns";
}
?>
</p>								


</div>


</div>
</div>
<div class="col-md-2">




<div class="seller_info bradius-15">
<div class="row no-margin">
<div class="col-md-12 no-padding">
<p class="adds">Seller Details</p>            
<p class="sel_chat">
<i class="fa fa-map-marker" style="color: #035049;
font-size: 15px;"></i> 
<a href="https://www.google.com/maps/place/ <?php
$rc = new _country; 
$result_cntry = $rc->readCountryName($country);
if ($result_cntry) {
$row4 = mysqli_fetch_assoc($result_cntry);
echo $countryName = $row4['country_title'];
}else{
echo "";
}
?> ,
<?php
$rcty = new _city;
$result_cty = $rcty->readCityName($city);
if ($result_cty) {
$row5 = mysqli_fetch_assoc($result_cty);
echo $cityName = $row5['city_title'];
}else{
echo "";
}
?> " target="_blank" style="padding-left: 10px;">Location: <?php
$rc = new _country; 
$result_cntry = $rc->readCountryName($country);
if ($result_cntry) {
$row4 = mysqli_fetch_assoc($result_cntry);
echo $countryName = $row4['country_title'];
}else{
echo "";
}
?> ,
<?php
$rcty = new _city;
$result_cty = $rcty->readCityName($city);
if ($result_cty) {
$row5 = mysqli_fetch_assoc($result_cty);
echo $cityName = $row5['city_title'];
}else{
echo "";
}
?></a>                
</p>
<p class="sel_chat">
<i class="fa fa-shopping-cart" style="color: #035049; font-size: 15px;" aria-hidden="true"></i> 
<a style="padding-left: 8px;" href="<?php echo $BaseUrl.'/artandcraft/seller-store.php?profileid='.$ArtistId.'&page=1'; ?>">Visit Store</a>
</p>

<p class="sel_chat">
<i class="fa fa-question-circle"  style="color: #035049; font-size: 15px;"  aria-hidden="true"></i>
<a  style="padding-left: 8px;" href="<?php echo $BaseUrl.'/artandcraft/enquiry.php?event='.$_GET["postid"];?>">Enquiry</a>
</p>

<p class="sel_chat">
<i class="fa fa-flag" style="color: #035049; font-size: 15px;"></i> &nbsp;
<a href="javascript:void(0)" style="padding-left: 4px;" data-toggle="modal" data-target="#flagPost">Flag this post</a>
</p>     
<div class = "social-links">
<a href = "https://www.facebook.com/sharer/sharer.php?u=<?php echo $BaseUrl.'/';?>artandcraft/detail.php?postid=<?php echo $_GET['postid']; ?>" target="_blanck">
<i class = "fab fa-facebook-f" style="color:#3b5998;font-size: 26px;margin-left: 17px;"></i>
</a>
<a href = "https://twitter.com/intent/tweet?text=<?php echo $BaseUrl.'/';?>artandcraft/detail.php?postid=<?php echo $_GET['postid']; ?>" target="_blanck">
<i class = "fab fa-twitter" style="color:#1DA1F2; font-size: 26px;"></i>
</a>
<a href = "https://www.instagram.com/?url=<?php echo $BaseUrl.'/';?>artandcraft/detail.php?postid=<?php echo $_GET['postid']; ?>" target="_blanck">
<i class = "fab fa-instagram" style="color:#cd486b; font-size: 26px;"></i>
</a>
<a href = "whatsapp://send?text=<?php echo $BaseUrl.'/';?>artandcraft/detail.php?postid=<?php echo $_GET['postid']; ?>" target="_blanck">
<i class = "fab fa-whatsapp" style="color:#34B7F1; font-size: 26px;"></i>
</a>
</div>				
</div>
</div>
</div>   






</div>





</div>	

<div class="space-lg"></div>


<div class="row">
<div class="col-md-12">
<div class="fulmainarttab">
<ul class='nav nav-tabs' id='navtabart' style="width: 70%">
<!---- <li role="presentation" class="active"><a href="#aboutArtist" aria-controls="home" role="tab" data-toggle="tab">About the Artist</a></li> 
<li role="presentation"><a href="#abtgallery" aria-controls="home" role="tab" data-toggle="tab">Gallery</a></li> ---->

<li role="presentation"><a href="#addesc" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>

<li role="presentation" class="active"><a href="#aboutWork" aria-controls="home" role="tab" data-toggle="tab" >About the work</a></li>

<li role="presentation"><a href="#organizerInfo" aria-controls="home" role="tab" data-toggle="tab">Event/Exhibition</a></li>


</ul>
<div class="linebtm"></div>
</div>
</div>
<div class="col-md-12">
<div class="tab-content no-radius otherTimleineBody m_top_20">
<!--PopularArt-->
<!---<div role="tabpanel" class="tab-pane active" id="aboutArtist">
<div class="row">
<div class="descbOx">
<div class="col-md-2">
<?php
if(isset($ArtistPic)){ ?>
<a href="<?php echo $BaseUrl.'/friends/?profileid='.$ArtistId; ?>">
<img src=" <?php echo ($ArtistPic);?>" class="img-responsive">
</a> <?php
}else{ ?>
<img src="../assets/images/blank-img/no-store.png.png" class="img-responsive">
<?php
}
?>
</div>
<div class="col-md-10">
<h2><a href="<?php echo $BaseUrl.'/friends/?profileid='.$ArtistId; ?>"><?php echo $ArtistName; ?></a> <small><?php echo $level;?></small></h2>
<p><?php echo $ArtistAbout;?></p>
</div>
</div>
</div>
</div>--->
<!--About the gallery start-->
<!---<div role="tabpanel" class="tab-pane" id="abtgallery">
<div class="row">
<div class="descbOx">
<div class="col-md-12">
<h3>Gallery</h3>
<div class="row">
<?php
$pic = new _postingpicartcraft;
$res2 = $pic->read($_GET['postid']);

if ($res2 != false) {
while ($rp = mysqli_fetch_assoc($res2)) {
$pic2 = $rp['spPostingPic'];
?>
<div class="col-md-3">
<div class="EvntImg">
<a class="thumbnail" rel="lightbox[group]" href="<?php echo ($pic2);?>" title="<?php echo $ProTitle;?>">
<img class="group1" src="<?php echo ($pic2);?>">
</a>

</div>
</div>
<?php
}                        
} ?>
</div>
</div>
</div>
</div>
</div>---->
<!--About the gallery end-->
<!--About the art-->
<div role="tabpanel" class="tab-pane active" id="aboutWork">
<div class="row">
<div class="descbOx">
<div class="col-md-12">
<h3>About the work</h3>
<p><?php //echo $ProDes;?></p>
<div class="table-responsive">
<table class="table table-striped table-bordered">
<tbody> 
<tr>
<td>Reference</td>
<td><?php echo "Art-00".$_GET['postid'];?></td>
</tr>
<tr>
<td>Artist</td>

<a style="padding-left: 8px;" href="<?php echo $BaseUrl.'/artandcraft/seller-store.php?profileid='.$ArtistId.'&page=1'; ?>">Visit Store</a>

<td><a href="<?php echo $BaseUrl.'/artandcraft/seller-store.php?profileid='.$ArtistId.'&page=1'; ?>"><?php echo $ArtistName;?></a></td>
</tr>
<tr>
<td>Category</td>
<td>
<?php 
$m = new _subcategory;
$result7 = $m->showName($catName);
if ($result7) {
$row7 = mysqli_fetch_assoc($result7);
echo $row7['subCategoryTitle'];
}else{
echo "Not Define";
}
?>

</td>
</tr>
<tr>
<td>Location</td>
<td>
<?php
$rcty = new _city;
$result_cty = $rcty->readCityName($city);
if ($result_cty) {
$row5 = mysqli_fetch_assoc($result_cty);
echo $cityName = $row5['city_title'];
}else{
echo "";
}
?>
</td>
</tr>

<tr>
<td>Country</td>
<td>
<?php
$rc = new _country; 
$result_cntry = $rc->readCountryName($country);
if ($result_cntry) {
$row4 = mysqli_fetch_assoc($result_cntry);
echo $countryName = $row4['country_title'];
}else{
echo "";
}
?>                                                 
</td>
</tr> 



<tr>
<td>Product Term</td>
<td>


<?php if($is_cancellable==0){ 
echo "Cancellation Not Allowed";
} ?>
<?php if($is_cancellable==1){ 
echo "Cancellation Allowed";
} ?>

</td>
</tr>   

<tr>
<td>Product Term</td>
<td>




<?php if($return_if_applicable==0){
echo "Return Not Acceptable";
} ?>
<?php if($return_if_applicable==1){ 
echo "Replacement in {$return_within} days";
}
?>


</td>
</tr>

<tr>
<td>Shipping Charges</td>
<td>
<?php
if($sippingcharge == 1){
echo "Free";
}
if($sippingcharge == 2){
echo "Fixed  ($".$fixedamount.")";
}
if($sippingcharge == 3){
echo "As Per Cartier";
}
?>   


</td>
</tr>



</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<div role="tabpanel" class="tab-pane" id="addesc">
<div class="row">
<div class="descbOx">
<div class="col-md-12">
<p style="overflow-wrap: break-word;"><?php echo $ProDes;?></p>
</div>
</div>
</div>  
</div> 

<div role="tabpanel" class="tab-pane" id="videoReview">
<div class="row">
<div class="descbOx">
<div class="col-md-12">
<h3>Video</h3>
<p></p>
</div>
</div>
</div>
</div>
<!-- show all organizer information -->
<div role="tabpanel" class="tab-pane" id="organizerInfo">
<div class="row">

<?php
$count = 0;
$pv = new _postingviewartcraft;
$result3 = $pv->totalArtistArt($ArtistId, 13);
if($result3 != false){
while ($row3 = mysqli_fetch_assoc($result3)) { ?>
<div class="col-md-3">
<div class="artBox m_btm_20">
<div class="topartBox">
<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row3['idspPostings'];?>" class="btn btn_custom bg_purple btn-border-radius">Sale</a>
<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row3['idspPostings'];?>" class="btn btn_custom bg_green_art btn-border-radius">New</a>
<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row3['idspPostings'];?>" >
<?php
$pic = new _postingpicartcraft;
$res2 = $pic->read($row3['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >"; ?>
<?php
} else{
echo "<a href='../img/no.png' class='test-popup-link' title='".$row3['spPostingtitle']."'><img alt='Posting Pic' src='../img/no.png' class='img-responsive'></a>"; ?>
<?php
} ?>
</a>
<a class="title" href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row3['idspPostings'];?>">aaaaaaa<?php echo $row3['spPostingtitle'];?></a>
<p>
<?php
if(strlen($row3['spPostingNotes']) < 80){
echo $row3['spPostingNotes'];
}else{
echo substr($row3['spPostingNotes'], 0,80)."...";

} ?>
</p> 

<hr>
<div class="row">
<div class="col-md-12">
<!-- <strike>#40.00</strike> -->
<?php
if(empty($row3['spPostingPrice'])){
echo "<span class='price'>Free</span>";
}else{
if(empty($row3['discountphoto'])){
echo '<span class="price">$ '.$row3['spPostingPrice'].'</span>';
}else{
echo '<span class="price">$ '.$row3['discountphoto'].'</span>';	
}
}
?>
</div>
</div>
</div>
<div class="btmartBox">
<ul class="social">
<li><a href="javascrpit:void(0)" class="addtoboard" data-postid="<?php echo $row3['idspPostings']; ?>" data-pid="<?php echo $_SESSION['pid'];?>" data-toggle="tooltip" title="Add to board"><img src="<?php echo $BaseUrl?>/assets/images/art/icon-add.png" alt="" class="img-responsive"></a></li>
<li><a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row3['idspPostings'];?>" data-toggle="tooltip" title="Download"><img src="<?php echo $BaseUrl?>/assets/images/art/icon-download.png" alt="" class="img-responsive"></a></li>
<li data-toggle="tooltip" title="Share"><a href="javascrpit:void(0)" data-toggle='modal' data-target='#myshare'><span class='sp-share-art' data-postid='<?php echo $row3['idspPostings'];?>' src='<?php echo ($pic2); ?>'><img src="<?php echo $BaseUrl?>/assets/images/art/icon-share.png" alt="" class="img-responsive"></span></a></li>
<li><a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row3['idspPostings'];?>" data-toggle="tooltip" title="View Product"><img src="<?php echo $BaseUrl?>/assets/images/art/icon-cart.png" alt="" class="img-responsive"></a></li>
</ul>
</div>
</div>
</div>
<?php
$count++;
if($count >7){
break;
}
}
}

?>
</div>
</div>
<!--Reviews-->
<div role="tabpanel" class="tab-pane " id="aboutReview">
<div class="row">
<div class="descbOx">
<div class="col-md-12">
<?php
$r = new _sppostrating;
$res = $r->read($_SESSION["pid"],$_GET["postid"]);
if($res != false){
$rows = mysqli_fetch_assoc($res);
$rat = $rows["spPostRating"];
}else{
$rat = 0;
}
?>

<div class="Review_box">
<h3>All Reviews</h3>
<?php
$r = new _sppostreview;
$result = $r->review_profile($_GET["postid"]);
//echo $r->ta->sql;
if($result != false){
while($rows = mysqli_fetch_assoc($result)){
?>
<div class="row mainreview no-margin">
<div class="col-md-1 no-padding-left">
<a href="<?php echo $BaseUrl.'/friends/?profileid='.$rows['idspProfiles']; ?>">
<?php
if(isset($rows['spProfilePic'])){
echo "<img  alt='Profile Pic' class='img-responsive reviewImg' src=' ".($rows['spProfilePic'])."' >" ;
}else{
echo "<img  alt='Profile Pic' class='img-responsive reviewImg' src='../img/no.png' >" ;
}

?>
</a>
</div>
<div class="col-md-11">
<h3><a href="<?php echo $BaseUrl.'/friends/?profileid='.$rows['idspProfiles']; ?>"><?php echo $rows['spProfileName']?></a></h3>
<p><?php echo $rows['spPostReviewText']?></p>
</div>
</div>
<?php
}
}
?>
</div>

</div>
</div>
</div>
</div>

</div>    
</div>
</div>
</div>
</section>
<section class="section_event_art">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="heading02 text-center">
<h1><span>More Products from Seller</span></h1>
</div>
</div>
<div class="col-md-12">

<!----<h2><span>Art</span> Work<a href="<?php //echo $BaseUrl.'/artandcraft/artist-product.php?cat=1&artist='.$ArtistId;?>" class="pull-right">View All</a></h2>----->
<?php

$pid = $_SESSION['pid'];
$con = mysqli_connect(DBHOST, UNAME, PASS);
if(mysqli_select_db($con, DBNAME)) {
$sql = "SELECT * FROM `sppostingsartcraft` where spProfiles_idspProfiles= $pid AND saveasdraft=0 ORDER BY spPostingDate ASC";
$result = mysqli_query($con, $sql);

if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {	
$postid = $row['idspPostings'];
if($postid!=$_GET['postid']){
if($i<=4){	 
$sqaal = "SELECT * FROM `sppostingpicsartcraft` where spPostings_idspPostings = $postid";
$res2 = mysqli_query($con, $sqaal);

if ($res2 != false) {
$rpaa = mysqli_fetch_assoc($res2);
//print_r($rpaa ); die('===============');
$pic2a = $rpaa['spPostingPic'];
}																
if ($pic2a == false) {
$pic2a = '/img/no.png';
}
?>		  
<div class="col-md-3 no-padding"> 

<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$postid;?>" data-toggle="tooltip" title="" data-original-title="<?php echo $row['spPostingTitle'] ; ?>"></a>   

<div class="product_box bradius-15">  
<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$postid;?>" data-toggle="tooltip" title="" data-original-title="<?php echo $row['spPostingTitle'] ; ?>">
<img alt="Posting Pic" class="img-responsive" src=" <?php echo ($pic2a); ?>">
</a>
<h2>


<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$postid;?>" data-toggle="tooltip" title="" data-original-title="<?php $row['spPostingTitle'] ; ?>"></a>
<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$postid;?>" data-toggle="tooltip" style="border-bottom: 0px solid #909295;" title="" data-original-title="Immuno First 60 VCaps">


<?php echo $row['spPostingTitle'] ; ?>
</a></h2>
<p class="price_pro">
<?php 
if(empty($row['spPostingPrice'])){
echo "<span class='price'>Free</span>";
}else{
if(empty($row['discountphoto'])){
echo '<span class="price"> '.$curr.' '.$row['spPostingPrice'].'</span>';
}else{
echo '<span class="price"> '.$curr.' '.$row['discountphoto'].'</span>';	
}
}

?>

</p>
<div class="rating-box">
<i class="fa fa-star" aria-hidden="true"></i>
<i class="fa fa-star" aria-hidden="true"></i>
<i class="fa fa-star" aria-hidden="true"></i>
<i class="fa fa-star" aria-hidden="true"></i>
<i class="fa fa-star" aria-hidden="true"></i>
<a href="#">(0)</a>
</div>
<p></p>
</div>
</div>	

<?php $i++; } } } } }  ?>



</div>                    
</div>
<div class="row">
<?php
$p = new _postingviewartcraft;
$result4 = $p->artistPost($ArtistId, 13);
if($result4 != false){
while ($row4 = mysqli_fetch_assoc($result4)) { ?>
<div class="col-md-3">
<div class="artistAcce">
<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row4['idspPostings'];?>" >
<?php
$pic = new _postingpicartcraft;
$res2 = $pic->read($row4['idspPostings']);
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



<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row4['idspPostings'];?>"><?php echo $row4['spPostingtitle'];?></a>
<hr>
<p class="price"><?php echo ($row4['spPostingPrice'] == '')? 'Free':'$'.$row4['spPostingPrice'];?> <span class="pull-right"><a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row4['idspPostings'];?>"><i class="fa fa-shopping-cart"></i></a></span></p>
</div>
</div> <?php
}
}

?>


</div>
</div>

</section>
<section class="cateHomeArt">
<div class="container">
<div class="row keywordbox ">
<div class="col-md-12">
<div class="titleTop text-center m_btm_40">
<h2>Browse Pictures by art category</h2>
</div>
</div>

<?php
$m = new _subcategory;
$catid = 13;
$result = $m->art_subcategoryalllist();

//echo $m->ta->sql; die;

$p = new _postingviewartcraft;

$rowCount = 1;
$colCount = 1;
if($result != false){
while($rows = mysqli_fetch_assoc($result)){
$count = 0;
$res = $p->sameCategoryPiccateart($rows["idspArtgallery"], 13);

//echo $p->ta->sql; die;

if($res != false){
$count = $res->num_rows;
}else{
$count = 0;
}
if($rowCount == 1){
echo '<div class="col-md-3 pad_left_right_5">';
}  
if (strlen($rows["subCategoryTitle"]) < 20) {  
?>
<a href="<?php echo $BaseUrl.'/artandcraft/shop-top-category.php?catId='.$rows['idspArtgallery'];?>&for=art&page=1" class=""><?php echo ucfirst(strtolower($rows["spArtgalleryTitle"]));?> <span class="pull-right">(<?php echo $count;?>)</span></a> 
<?php
}else{
?>
<a href="<?php echo $BaseUrl.'/artandcraft/shop-top-category.php?catId='.$rows['idspArtgallery'];?>&for=art&page=1" class=""><?php echo substr(ucfirst(strtolower($rows["spArtgalleryTitle"])), 0,20)."...";?> <span class="pull-right">(<?php echo $count;?>)</span></a> 
<?php
}

?>
<?php
if($colCount == 4){
$rowCount = 0;
$colCount = 0;
}

if($rowCount == 0){
echo '</div>';
}
$rowCount++;
$colCount++;
}
if($rowCount != 0){
echo '</div>';
}
}
?>
</div>
</div>
</section>
<section class="cateHomeArt">
<div class="container">
<div class="row keywordbox ">
<div class="col-md-12">
<div class="titleTop text-center m_btm_40">
<h2>Browse Pictures by craft category</h2>
</div>
</div>

<?php
$m = new _subcategory;
$catid = 13;
$result = $m->craft_categoryalllist();

$p = new _postingviewartcraft;

$rowCount = 1;
$colCount = 1;
if($result != false){
while($rows = mysqli_fetch_assoc($result)){
//print_r($rows); die;
$count = 0;
$res = $p->sameCategoryPiccatecraft($rows["idspCraftgallery"], 13);

//echo $p->ta->sql; die;

if($res != false){
$count = $res->num_rows;
}else{
$count = 0;
}
if($rowCount == 1){
echo '<div class="col-md-3 pad_left_right_5">';
}  
if (strlen($rows["subCategoryTitle"]) < 20) {  
?>
<a href="<?php echo $BaseUrl.'/artandcraft/shop-top-category.php?catId='.$rows['idspCraftgallery'];?>&for=craft&page=1" class=""><?php echo ucfirst(strtolower($rows["spCraftgalleryTitle"]));?> <span class="pull-right">(<?php echo $count;?>)</span></a> 
<?php
}else{
?>
<a href="<?php echo $BaseUrl.'/artandcraft/shop-top-category.php?catId='.$rows['idspCraftgallery'];?>&for=craft&page=1" class=""><?php echo substr(ucfirst(strtolower($rows["spCraftgalleryTitle"])), 0,20)."...";?> <span class="pull-right">(<?php echo $count;?>)</span></a> 
<?php
}

?>
<?php
if($colCount == 4){
$rowCount = 0;
$colCount = 0;
}

if($rowCount == 0){
echo '</div>';
}
$rowCount++;
$colCount++;
}
if($rowCount != 0){
echo '</div>';
}
}
?>
</div>
</div>
</section>

<?php include('postshare.php');?>


<?php 
include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>
<!-- notification js -->
<script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>
<!-- image gallery script strt -->
<script src="<?php echo $BaseUrl;?>/assets/js/jquery.prettyPhoto.js"></script>
<script>
var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
s.parentNode.insertBefore(g,s)}(document,'script'));
// Colorbox Call
$(document).ready(function(){
$("[rel^='lightbox']").prettyPhoto();
});
</script>
<!-- image gallery script end -->
</body>
</html>
<?php
}
?>