
<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="../assets/css/magnific-popup/magnific-popup.css">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


<link rel="stylesheet" href="https://dev.thesharepage.com/assets/css/magnific-popup/A.magnific-popup.css.pagespeed.cf.XLQo-C-WDC.css">

<!-- Magnific Popup core JS file -->




<style>
.smalldot{
width : 100px;
overflow:hidden;
display:inline-block;
text-overflow: ellipsis;
white-space: nowrap;
}

#hw{

white-space: nowrap;
position: relative;
}		

.frndProfileImg img {
width: 100%;
height: 250px;
}
.gallery-img .thumbnail img {
height: 250px;
width: 100%;

}

.gallery-img .thumbnail {
padding: 0px;
border-radius: 0;
border: none;
margin-bottom: 0;
}



<!--pagination start -->
body {
font-family: 'Roboto', sans-serif;
font-size: 14px;
line-height: 18px;
background: #f4f4f4;
}

.list-wrapper {
padding: 15px;
overflow: hidden;
}

.list-item {
display:contents!important;
border: 1px solid #EEE;
background: #FFF;
margin-bottom: 10px;
padding: 10px;
box-shadow: 0px 0px 10px 0px #EEE;
}

.list-item h4 {
color: ;
font-size: 18px;
margin: 0 0 5px;	
}


.simple-pagination ul {
margin: -30px 0 20px;
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
background-color: #c45508;
border-color: #c45508;
}

.simple-pagination .prev.current,
.simple-pagination .next.current {
background: #c45508;
}
<!--pagination end -->


</style>


<?php
$pf = new _spPortfolio;
//  var_dump($_GET["profileid"]);

if($profiletype == 1){
$profiletype = 'portBussiness';
}


if($profiletype == 2){
$profiletype = 'portFreelancer';
}

if($profiletype == 3){
$profiletype = 'portProfessional';
}

if($profiletype == 4){
$profiletype = 'portPersonal';
}


if($profiletype == 5){
$profiletype = 'portEmployment';
}

if($profiletype == 6){
$profiletype = 'portFamily';
}

$result = $pf->get_profile_portfolio($_GET["profileid"], $profiletype);
//echo $pf->ta->sql;

if($result != false)
{
echo '<div class="">';
while($row = mysqli_fetch_assoc($result)){

$folioid= $row['id'];
echo '<div class="">';

?>
<div class='row m_top_10 frndProfileImg no-margin gallery-img m_btm_5' style=" border-style: groove; border-radius: 10px; margin-bottom: 10px; ">

<div class="col-md-6" >

<div class=" card w3-content w3-display-container" ><br>
<h4 style="text-align:center; color:#613f90;"><span  class=" card-title  " ><b><?php  echo $row['spTitle']; ?></b></span></h4>


<?php 	$resimg = $pf->readimg($folioid);

if ($resimg) {


$i = 1;
while ($row1 = mysqli_fetch_assoc($resimg)) {

$count =  mysqli_num_rows($resimg);

$spImg =   $row1['image']; 

?> 


<!-- <a class="thumbnail mag " data-effect="mfp-newspaper"  href="<?php echo $baseurl."/dashboard/portfolio/image/". $spImg ; ?>">-->
<img id="myImg<?= $row1['id'] ?>" class="card-img-top mySlides img<?= $row1['portfolio_id'] ?>" src="<?php  echo $baseurl."/dashboard/portfolio/image/". $spImg ; ?>" alt="Card image"  > 
<?php
if($count>1){ ?>
<button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1,'img<?= $row1['portfolio_id'] ?>')">	 &#10094;
</button>
<button class="w3-button w3-black w3-display-right" onclick="plusDivs(1,'img<?= $row1['portfolio_id'] ?>')">&#10095;</button>

<?php 	} ?>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg<?= $row1['id']; ?>");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
modal.style.display = "block";
modalImg.src = this.src;
captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
//var span = document.getElementsByClassName("close");

// When the user clicks on <span> (x), close the modal
//span.onclick = function() { 
//console.log("hfiuhyhferiu");
// modal.style.display = "none";
// } 
</script>

<div id="myModal" class="modal">
<span class="close">&times;</span>
<img class="modal-content" id="img01">
<div id="caption"></div>
</div>	

<script>

var slideIndex = 1;
showDivs(slideIndex,"img<?= $row1['portfolio_id'] ?>");
</script>
<script>
function plusDivs(n,slider) {
showDivs(slideIndex += n,slider);
}

function showDivs(n,slider) {
var i;
var x = document.getElementsByClassName(slider);
if (n > x.length) {slideIndex = 1}
if (n < 1) {slideIndex = x.length}
for (i = 0; i < x.length; i++) {
x[i].style.display = "none";  
}
x[slideIndex-1].style.display = "block";  
}
</script>

<?php

}}  
?>



</div><br>

</div>
<div class="col-md-6" ><br>
<h4>About this work:</h4>
<div class="card-body text-center" style="">

<p class="ticket-text<?php echo $row1['id'];?>" style="overflow-wrap: break-word;; " ><span><?php  echo $row['desPort']; ?></p>
<a class="profileLinkField" href="//<?php   echo $row['spWeblink'];  ?>" style="margin-bottom:2px;color: #428bca;"><?php   echo $row['spWeblink'];  ?></a>

</div>

</div>
</div>

<script type="text/javascript"> 
$('.ticket-text<?php echo $row1['id'];?>').each(function(){
var words = $(this).text().split(" ");
var maxWords = 40;

if(words.length > maxWords){
html = words.slice(0,maxWords) +'<span class="more_text" style="display:none;"> '+words.slice(maxWords, words.length)+'</span>' + '<a href="#" class="read_more" style="color: #428bca;">...<br/>[Read More]</a>'

$(this).html(html)

$(this).find('a.read_more').click(function(event){
$(this).toggleClass("less");
event.preventDefault();
if($(this).hasClass("less")){
$(this).html("<br/>[Read Less]")
$(this).parent().find(".more_text").show();
}else{
$(this).html("...<br/>[Read More]")
$(this).parent().find(".more_text").hide();
}
})

}

})

</script>

<?php echo '</div>';	} echo '</div>';




} 
else{


echo"<h4 style='text-align:center;'>No Portfolio found</h4>";
}

// if($result)
// {


// echo '<div id="pagination-container"></div>';  
// }
?>



<style>


#myImg<?= $row1['id'] ;?> {
border-radius: 5px;
cursor: pointer;
transition: 0.3s;
}

#myImg<?= $row1['id'] ;?>:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
display: none; /* Hidden by default */
position: fixed; /* Stay in place */
z-index: 1; /* Sit on top */
padding-top: 100px; /* Location of the box */
left: 0;
top: 0;
width: 100%; /* Full width */
height: 100%; /* Full height */
overflow: auto; /* Enable scroll if needed */

}
/* background-color: rgb(0,0,0); /* Fallback color 
background-color: rgba(0,0,0,0.9); Black w/ opacity */
/* Modal Content (image) */
.modal-content {
margin: auto;
display: block;
width: 80%;
max-width: 700px;
}

/* Caption of Modal Image */
#caption{
margin: auto;
display: block;
width: 80%;
max-width: 700px;
text-align: center;
color: #ccc;
padding: 10px 0;
height: 150px;
}

/* Add Animation */
.modal-content, #caption{  
-webkit-animation-name: zoom;
-webkit-animation-duration: 0.6s;
animation-name: zoom;
animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
from {-webkit-transform:scale(0)} 
to {-webkit-transform:scale(1)}
}

@keyframes zoom {
from {transform:scale(0)} 
to {transform:scale(1)}
}

/* The Close Button */
.close {
position: absolute;
top: 15px;
right: 35px;
color: #f1f1f1;
font-size: 40px;
font-weight: bold;
transition: 0.3s;
}

.close:hover,
.close:focus {
color: #bbb;
text-decoration: none;
cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
.modal-content {
width: 100%;
}
}
</style>


<script>

$(".close").click(function(){
modal.style.display = "none";
});
// Get the <span> element that closes the modal
//var span = document.getElementsByClassName("close");

// When the user clicks on <span> (x), close the modal
//span.onclick = function() { 
//console.log("hfiuhyhferiu");
// modal.style.display = "none";
// } 
</script>



<script type="text/javascript">

$('.thumbnail').magnificPopup({
type: 'image'
// other options
});

</script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>

<script>
//111 jQuery Plugin: http://flaviusmatis.github.io/simplePagination.js/

// var items = $(".list-wrapper .list-item");
// var numItems = items.length;
// var perPage = 4;

// items.slice(perPage).hide();

// $('#pagination-container').pagination({
// items: numItems,
// itemsOnPage: perPage,
// prevText: "&laquo;",
// nextText: "&raquo;",
// onPageClick: function (pageNumber) {
// var showFrom = perPage * (pageNumber - 1);
// var showTo = showFrom + perPage;
// items.hide().slice(showFrom, showTo).show();
// }
// });
</script> 


